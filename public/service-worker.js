/* PsyAid offline-first service worker.
 *
 * - Public app-shell assets live in a versioned static cache.
 * - HTML and JSON snapshots live in a cache isolated by user id + role.
 * - Failed mutations are serialized in IndexedDB and replayed in order.
 * - Background Sync is used when available; pwa.js also triggers a manual
 *   replay on the `online` event for browsers without Background Sync.
 */

'use strict';

const VERSION = 'v11';
const CACHE_PREFIX = 'psyaid-';
const STATIC_CACHE = `${CACHE_PREFIX}static-${VERSION}`;
const EXTERNAL_CACHE = `${CACHE_PREFIX}external-${VERSION}`;
const PAGE_CACHE_PREFIX = `${CACHE_PREFIX}pages-`;
const OFFLINE_URL = '/offline.html';
const DB_NAME = 'psyaid-offline';
const DB_VERSION = 1;
const MUTATION_STORE = 'mutations';
const META_STORE = 'meta';
const SYNC_TAG = 'psyaid-sync-mutations';

const PRECACHE_URLS = [
  OFFLINE_URL,
  '/manifest.webmanifest',
  '/pwa.css',
  '/pwa.js',
  '/helper/timeFormat.js',
  '/js/helper/timeFormat.js',
  '/favicon.ico',
  '/icons/favicon-32x32.png',
  '/data/regencies_grouped.json',
  '/images/Logo_PsyAid.png',
  '/images/profile.svg',
  '/images/paper_laporan-bencana.png',
  '/images/page_ai-disaster.png',
  '/images/disaster_assistant_wide_banner.png',
  '/images/disaster_assistant_illustration.png',
  '/images/creator1.jpeg',
  '/images/creator2.jpeg',
  '/images/creator3.jpeg',
  '/icons/pwa-180x180.png',
  '/icons/pwa-192x192.png',
  '/icons/pwa-512x512.png',
  '/icons/pwa-maskable-512x512.png'
];

const EXTERNAL_ASSETS = [
  'https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap',
  'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css',
  'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css',
  'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js',
  'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css',
  'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js',
  'https://unpkg.com/leaflet@1.9.4/dist/leaflet.css',
  'https://unpkg.com/leaflet@1.9.4/dist/leaflet.js',
  'https://cdn.jsdelivr.net/npm/chart.js',
  'https://cdn.tailwindcss.com',
  'https://unpkg.com/lucide@latest',
  'https://cdn.jsdelivr.net/npm/motion@10.16.2/dist/motion.js'
];

const NEVER_CACHE_PATHS = [
  '/login',
  '/logout',
  '/register',
  '/forbidden',
  '/offline/bootstrap',
  '/health/'
];
const NEVER_QUEUE_PATHS = [
  '/login',
  '/logout',
  '/register',
  '/offline/bootstrap',
  '/api/register-volunteer-request',
  '/api/store-disaster-report'
];
const STATIC_PATHS = new Set(PRECACHE_URLS);
let activeScope = 'public';
let snapshotRunSequence = 0;
const snapshotRuns = new Map();

function openDatabase() {
  return new Promise((resolve, reject) => {
    const request = indexedDB.open(DB_NAME, DB_VERSION);

    request.onupgradeneeded = () => {
      const db = request.result;
      if (!db.objectStoreNames.contains(MUTATION_STORE)) {
        const mutations = db.createObjectStore(MUTATION_STORE, { keyPath: 'id' });
        mutations.createIndex('scope_created', ['scope', 'createdAt'], { unique: false });
      }
      if (!db.objectStoreNames.contains(META_STORE)) {
        db.createObjectStore(META_STORE, { keyPath: 'key' });
      }
    };

    request.onsuccess = () => resolve(request.result);
    request.onerror = () => reject(request.error);
  });
}

async function withStore(storeName, mode, operation) {
  const db = await openDatabase();
  return new Promise((resolve, reject) => {
    const transaction = db.transaction(storeName, mode);
    const store = transaction.objectStore(storeName);
    const result = operation(store);
    transaction.oncomplete = () => resolve(result && result.result);
    transaction.onerror = () => reject(transaction.error);
    transaction.onabort = () => reject(transaction.error);
  }).finally(() => db.close());
}

async function getMeta(key, fallback = null) {
  const db = await openDatabase();
  return new Promise((resolve, reject) => {
    const transaction = db.transaction(META_STORE, 'readonly');
    const request = transaction.objectStore(META_STORE).get(key);
    request.onsuccess = () => resolve(request.result ? request.result.value : fallback);
    request.onerror = () => reject(request.error);
    transaction.oncomplete = () => db.close();
  });
}

async function setMeta(key, value) {
  await withStore(META_STORE, 'readwrite', (store) => store.put({ key, value }));
}

async function deleteMeta(key) {
  await withStore(META_STORE, 'readwrite', (store) => store.delete(key));
}

const contextReady = getMeta('activeScope', 'public')
  .then((scope) => {
    activeScope = sanitizeScope(scope);
  })
  .catch(() => {
    activeScope = 'public';
  });

function sanitizeScope(scope) {
  const normalized = String(scope || 'public').replace(/[^a-zA-Z0-9_-]/g, '-');
  return normalized || 'public';
}

async function setActiveScope(scope) {
  activeScope = sanitizeScope(scope);
  await setMeta('activeScope', activeScope);
  return activeScope;
}

async function switchActiveScope(scope) {
  const nextScope = sanitizeScope(scope);
  for (const runningScope of snapshotRuns.keys()) {
    if (runningScope !== nextScope) {
      snapshotRuns.delete(runningScope);
    }
  }
  return setActiveScope(nextScope);
}

function pageCacheName(scope = activeScope) {
  return `${PAGE_CACHE_PREFIX}${sanitizeScope(scope)}-${VERSION}`;
}

function isNeverCached(pathname) {
  return NEVER_CACHE_PATHS.some((path) => matchesConfiguredPath(pathname, path));
}

function isNeverQueued(pathname) {
  return NEVER_QUEUE_PATHS.some((path) => matchesConfiguredPath(pathname, path));
}

function matchesConfiguredPath(pathname, configuredPath) {
  const path = configuredPath.replace(/\/+$/, '') || '/';
  return pathname === path || pathname.startsWith(`${path}/`);
}

function isStaticRequest(request, url) {
  if (STATIC_PATHS.has(url.pathname)) {
    return true;
  }
  return ['style', 'script', 'font'].includes(request.destination)
    && !url.pathname.startsWith('/uploads/');
}

function extractScopeFromHtml(html) {
  const match = html.match(/<meta\s+name=["']psyaid-user-scope["']\s+content=["']([^"']+)["']/i);
  return match ? sanitizeScope(match[1]) : null;
}

async function scopeForResponse(response, fallbackScope) {
  const contentType = response.headers.get('Content-Type') || '';
  if (!contentType.includes('text/html')) {
    return fallbackScope;
  }

  try {
    const responseScope = extractScopeFromHtml(await response.clone().text());
    if (responseScope) {
      await setActiveScope(responseScope);
      return responseScope;
    }
  } catch (error) {
    // A body that cannot be inspected can still be served to the caller.
  }

  return fallbackScope;
}

function isUsableNetworkResponse(response) {
  if (!response || !response.ok) {
    return false;
  }

  try {
    const finalUrl = new URL(response.url);
    return finalUrl.pathname !== '/login' && finalUrl.pathname !== '/forbidden';
  } catch (error) {
    return true;
  }
}

async function safeCachePut(cache, request, response) {
  if (!response || response.status === 206 || response.headers.get('Vary') === '*') {
    return false;
  }

  try {
    await cache.put(request, response.clone());
    return true;
  } catch (error) {
    return false;
  }
}

async function networkOnly(request) {
  try {
    return await fetch(request, { cache: 'no-store' });
  } catch (error) {
    if (request.mode === 'navigate') {
      return (await caches.match(OFFLINE_URL)) || Response.error();
    }

    throw error;
  }
}

async function cacheFirstStatic(request) {
  const cache = await caches.open(STATIC_CACHE);
  const cached = await cache.match(request);
  if (cached) {
    return cached;
  }

  const response = await fetch(request);
  if (response.ok) {
    await safeCachePut(cache, request, response);
  }
  return response;
}

async function externalCacheFirst(request) {
  const cache = await caches.open(EXTERNAL_CACHE);
  const cached = await cache.match(request);
  if (cached) {
    return cached;
  }

  const response = await fetch(request);
  if (response.ok || response.type === 'opaque') {
    await safeCachePut(cache, request, response);
    await trimCache(EXTERNAL_CACHE, 250);
  }
  return response;
}

async function trimCache(cacheName, maxEntries) {
  const cache = await caches.open(cacheName);
  const keys = await cache.keys();
  if (keys.length > maxEntries) {
    await Promise.all(keys.slice(0, keys.length - maxEntries).map((key) => cache.delete(key)));
  }
}

async function matchPageCache(request, scope) {
  const cache = await caches.open(pageCacheName(scope));
  let cached = await cache.match(request, { ignoreVary: true });
  if (cached) {
    return cached;
  }

  const url = new URL(request.url);
  if (url.search) {
    if (url.searchParams.has('offline_queued')) {
      const withoutQueueMarker = new URL(url.href);
      withoutQueueMarker.searchParams.delete('offline_queued');
      cached = await cache.match(new Request(withoutQueueMarker.href, {
        method: 'GET',
        credentials: 'include'
      }), { ignoreVary: true });
      if (cached) {
        return cached;
      }
    }

    const withoutSearch = new Request(`${url.origin}${url.pathname}`, {
      method: 'GET',
      credentials: 'include'
    });
    cached = await cache.match(withoutSearch, { ignoreVary: true });
  }

  return cached;
}

function waitForNavigationRetry(milliseconds) {
  return new Promise((resolve) => setTimeout(resolve, milliseconds));
}

async function fetchPageWithTransientRetry(request) {
  try {
    return await fetch(request);
  } catch (firstError) {
    if (request.mode !== 'navigate') {
      throw firstError;
    }

    // During login the session, worker scope, and destination page change at
    // almost the same time. A single navigation fetch can be interrupted by
    // that hand-off even though the server is reachable. Give the GET one
    // bounded retry before showing the genuine offline fallback.
    await waitForNavigationRetry(200);
    return fetch(request.clone(), { cache: 'no-store' });
  }
}

async function networkFirstPage(request, requestedScope = activeScope) {
  await contextReady;
  let scope = sanitizeScope(requestedScope || activeScope);

  try {
    const response = await fetchPageWithTransientRetry(request);
    if (isUsableNetworkResponse(response)) {
      scope = await scopeForResponse(response, scope);
      const cache = await caches.open(pageCacheName(scope));
      await safeCachePut(cache, request, response);
      return response;
    }

    // Every real HTTP response proves that the network request completed.
    // Auth redirects/4xx are returned unchanged. For 5xx, prefer an existing
    // snapshot, but never mislabel a server error as an offline device.
    if (response.status > 0) {
      if (response.status >= 500) {
        const cached = await matchPageCache(request, scope);
        if (cached) {
          return cached;
        }
      }
      return response;
    }

    if (response.status === 0) {
      const cached = await matchPageCache(request, scope);
      if (cached) {
        return cached;
      }

      if (request.mode === 'navigate') {
        return (await caches.match(OFFLINE_URL)) || Response.error();
      }
    }

    return response;
  } catch (error) {
    const cached = await matchPageCache(request, scope);
    if (cached) {
      return cached;
    }

    if (request.mode === 'navigate') {
      return (await caches.match(OFFLINE_URL)) || Response.error();
    }

    throw error;
  }
}

function createMutationId() {
  if (self.crypto && typeof self.crypto.randomUUID === 'function') {
    return self.crypto.randomUUID();
  }
  return `offline-${Date.now()}-${Math.random().toString(16).slice(2)}`;
}

async function serializeMutation(request) {
  const headers = {};
  request.headers.forEach((value, key) => {
    if (!['content-length', 'cookie', 'host'].includes(key.toLowerCase())) {
      headers[key] = value;
    }
  });

  return {
    id: createMutationId(),
    scope: sanitizeScope(activeScope),
    url: request.url,
    method: request.method,
    headers,
    body: await request.clone().arrayBuffer(),
    referrer: request.referrer || '/',
    isNavigation: request.mode === 'navigate',
    createdAt: Date.now(),
    attempts: 0,
    state: 'pending',
    lastError: null
  };
}

async function putMutation(mutation) {
  await withStore(MUTATION_STORE, 'readwrite', (store) => store.put(mutation));
}

async function deleteMutation(id) {
  await withStore(MUTATION_STORE, 'readwrite', (store) => store.delete(id));
}

async function getMutations(scope = activeScope) {
  const db = await openDatabase();
  return new Promise((resolve, reject) => {
    const transaction = db.transaction(MUTATION_STORE, 'readonly');
    const request = transaction.objectStore(MUTATION_STORE).getAll();
    request.onsuccess = () => resolve(
      request.result
        .filter((item) => item.scope === sanitizeScope(scope))
        .sort((a, b) => a.createdAt - b.createdAt)
    );
    request.onerror = () => reject(request.error);
    transaction.oncomplete = () => db.close();
  });
}

async function broadcast(message) {
  const windows = await self.clients.matchAll({ type: 'window', includeUncontrolled: true });
  windows.forEach((client) => client.postMessage(message));
}

async function reportQueueStatus(extra = {}, requestedScope = activeScope) {
  const queueScope = sanitizeScope(requestedScope);
  const mutations = await getMutations(queueScope);
  await broadcast({
    type: 'QUEUE_STATUS',
    scope: queueScope,
    pending: mutations.filter((item) => item.state !== 'failed').length,
    failed: mutations.filter((item) => item.state === 'failed').length,
    ...extra
  });
  return mutations;
}

async function registerBackgroundSync() {
  if (self.registration.sync) {
    try {
      await self.registration.sync.register(SYNC_TAG);
    } catch (error) {
      // pwa.js will retry manually when the online event fires.
    }
  }
}

function queuedResponse(mutation) {
  if (mutation.isNavigation) {
    const referrer = new URL(mutation.referrer || '/', self.location.origin);
    if (referrer.origin !== self.location.origin) {
      referrer.href = `${self.location.origin}/`;
    }
    referrer.searchParams.set('offline_queued', mutation.id);
    return Response.redirect(referrer.href, 303);
  }

  return new Response(JSON.stringify({
    status: 'success',
    success: true,
    sync_status: 'queued',
    offline: true,
    mutation_id: mutation.id,
    message: 'Perubahan tersimpan di perangkat dan akan disinkronkan saat online.'
  }), {
    status: 202,
    headers: {
      'Content-Type': 'application/json; charset=utf-8',
      'X-PsyAid-Offline-Queued': mutation.id
    }
  });
}

async function networkOrQueue(request) {
  await contextReady;

  try {
    return await fetch(request.clone());
  } catch (error) {
    const mutation = await serializeMutation(request);
    await putMutation(mutation);
    await registerBackgroundSync();
    await reportQueueStatus({ queued: mutation.id });
    return queuedResponse(mutation);
  }
}

async function replayMutations(reason = 'manual', requestedScope = activeScope) {
  await contextReady;
  const replayScope = sanitizeScope(requestedScope);
  if (replayScope !== activeScope) {
    await broadcast({ type: 'SYNC_CANCELLED', scope: replayScope, reason: 'scope-changed' });
    return;
  }

  const mutations = await getMutations(replayScope);
  if (!mutations.length) {
    await reportQueueStatus({ syncState: 'idle', reason }, replayScope);
    return;
  }

  await broadcast({ type: 'SYNC_STATE', state: 'syncing', total: mutations.length, reason, scope: replayScope });
  let synced = 0;

  for (const mutation of mutations) {
    if (activeScope !== replayScope) {
      await broadcast({ type: 'SYNC_CANCELLED', scope: replayScope, reason: 'scope-changed' });
      break;
    }

    const headers = new Headers(mutation.headers || {});
    headers.set('X-PsyAid-Mutation-Id', mutation.id);
    headers.set('X-PsyAid-User-Scope', mutation.scope);
    headers.set('X-Requested-With', headers.get('X-Requested-With') || 'PsyAid-Offline-Sync');

    try {
      const response = await fetch(mutation.url, {
        method: mutation.method,
        headers,
        body: mutation.body && mutation.body.byteLength ? mutation.body : undefined,
        credentials: 'include',
        redirect: 'follow',
        cache: 'no-store'
      });

      const redirectPath = response.url ? new URL(response.url).pathname : '';
      if ([401, 403].includes(response.status)
        || ['/login', '/forbidden'].includes(redirectPath)) {
        mutation.attempts += 1;
        mutation.lastError = 'Sesi perlu diperbarui';
        mutation.state = 'pending';
        await putMutation(mutation);
        await broadcast({ type: 'SYNC_AUTH_REQUIRED', pending: mutations.length - synced, scope: replayScope });
        break;
      }

      if ((response.status >= 200 && response.status < 400) || response.status === 208) {
        await deleteMutation(mutation.id);
        synced += 1;
        await reportQueueStatus({ synced: mutation.id, syncState: 'syncing' }, replayScope);
        continue;
      }

      mutation.attempts += 1;
      mutation.lastError = `HTTP ${response.status}`;
      mutation.state = [400, 404, 409, 422].includes(response.status) ? 'failed' : 'pending';
      await putMutation(mutation);

      if (mutation.state === 'failed') {
        await broadcast({
          type: 'SYNC_ITEM_FAILED',
          id: mutation.id,
          url: mutation.url,
          status: response.status,
          scope: replayScope
        });
        continue;
      }

      break;
    } catch (error) {
      mutation.attempts += 1;
      mutation.lastError = error.message || 'Network error';
      mutation.state = 'pending';
      await putMutation(mutation);
      await registerBackgroundSync();
      break;
    }
  }

  await reportQueueStatus({ syncState: 'complete', syncedCount: synced, reason }, replayScope);
  await broadcast({ type: 'SYNC_COMPLETE', synced, reason, scope: replayScope });
}

async function cacheExternalUrl(url) {
  const cache = await caches.open(EXTERNAL_CACHE);
  const request = new Request(url, { mode: 'cors', credentials: 'omit' });
  const response = await fetch(request);
  if (!response.ok && response.type !== 'opaque') {
    return false;
  }

  await safeCachePut(cache, request, response);

  const contentType = response.headers.get('Content-Type') || '';
  if (contentType.includes('text/css')) {
    const css = await response.clone().text();
    const nestedUrls = [...css.matchAll(/url\((?:['"])?([^'"\)]+)(?:['"])?\)/g)]
      .map((match) => new URL(match[1], url).href)
      .filter((nestedUrl) => nestedUrl.startsWith('http'));
    await Promise.allSettled(nestedUrls.map(async (nestedUrl) => {
      const nestedRequest = new Request(nestedUrl, { mode: 'cors', credentials: 'omit' });
      const nestedResponse = await fetch(nestedRequest);
      if (nestedResponse.ok || nestedResponse.type === 'opaque') {
        await safeCachePut(cache, nestedRequest, nestedResponse);
      }
    }));
  }

  return true;
}

function discoverHtmlAssets(response, baseUrl) {
  const contentType = response.headers.get('Content-Type') || '';
  if (!contentType.includes('text/html')) {
    return Promise.resolve([]);
  }

  return response.clone().text().then((html) => {
    const assets = [];
    const sourcePattern = /<(?:script|img|source|audio|video)\b[^>]*\bsrc=["']([^"']+)["'][^>]*>/gi;
    const linkPattern = /<link\b([^>]*)\bhref=["']([^"']+)["']([^>]*)>/gi;
    let match;

    while ((match = sourcePattern.exec(html)) !== null) {
      assets.push(match[1]);
    }

    while ((match = linkPattern.exec(html)) !== null) {
      const attributes = `${match[1]} ${match[3]}`;
      if (/\brel=["'][^"']*(?:stylesheet|icon|manifest)[^"']*["']/i.test(attributes)) {
        assets.push(match[2]);
      }
    }

    return assets
      .filter((url) => url && !url.startsWith('data:') && !url.startsWith('blob:'))
      .map((url) => new URL(url, baseUrl).href)
      .filter((url) => url.startsWith('http'));
  }).catch(() => []);
}

async function cacheSnapshotAsset(url, scopeCache, isCurrent = () => true) {
  if (!isCurrent()) {
    return false;
  }

  const assetUrl = new URL(url);
  if (assetUrl.origin !== self.location.origin) {
    const cached = await cacheExternalUrl(assetUrl.href);
    return isCurrent() ? cached : false;
  }

  const request = new Request(assetUrl.href, { credentials: 'include', cache: 'no-store' });
  const targetCache = assetUrl.pathname.startsWith('/uploads/')
    ? scopeCache
    : await caches.open(STATIC_CACHE);
  const existing = await targetCache.match(request);
  if (existing) {
    return true;
  }

  const response = await fetch(request);
  if (!isCurrent() || !isUsableNetworkResponse(response)) {
    return false;
  }

  return safeCachePut(targetCache, request, response);
}

async function warmOfflineSnapshot(urls, scope) {
  const snapshotScope = sanitizeScope(scope);
  const runId = ++snapshotRunSequence;
  snapshotRuns.set(snapshotScope, runId);
  const isCurrent = () => snapshotRuns.get(snapshotScope) === runId;

  const uniqueUrls = [...new Set((urls || []).map((url) => new URL(url, self.location.origin).href))];
  const total = uniqueUrls.length;
  const optionalPaths = new Set(['/api/earthquake-data']);
  const requiredTotal = uniqueUrls.filter((url) => !optionalPaths.has(new URL(url).pathname)).length;
  const cache = await caches.open(pageCacheName(snapshotScope));
  const discoveredAssets = new Set();
  let completed = 0;
  let cached = 0;
  let requiredCached = 0;
  const failedUrls = [];

  await broadcast({ type: 'WARM_PROGRESS', state: 'started', total, scope: snapshotScope });

  const workers = Array.from({ length: Math.min(4, Math.max(1, uniqueUrls.length)) }, async () => {
    while (uniqueUrls.length && isCurrent()) {
      const url = uniqueUrls.shift();
      const optional = optionalPaths.has(new URL(url).pathname);
      try {
        const request = new Request(url, { credentials: 'include', cache: 'no-store' });
        const response = await fetch(request);
        if (!isCurrent()) {
          break;
        }
        if (isUsableNetworkResponse(response)) {
          const assets = await discoverHtmlAssets(response, url);
          assets.forEach((assetUrl) => discoveredAssets.add(assetUrl));
          if (await safeCachePut(cache, request, response)) {
            cached += 1;
            if (!optional) {
              requiredCached += 1;
            }
          } else if (!optional) {
            failedUrls.push(url);
          }
        } else if (!optional) {
          failedUrls.push(url);
        }
      } catch (error) {
        if (!optional) {
          failedUrls.push(url);
        }
      }
      completed += 1;
      if (completed === 1 || completed % 5 === 0 || completed === total) {
        await broadcast({ type: 'WARM_PROGRESS', state: 'running', completed, total, scope: snapshotScope });
      }
    }
  });

  await Promise.all(workers);
  if (!isCurrent()) {
    await broadcast({ type: 'WARM_PROGRESS', state: 'cancelled', scope: snapshotScope });
    return;
  }

  const assetUrls = [...new Set([...EXTERNAL_ASSETS, ...discoveredAssets])];
  const assetResults = await Promise.allSettled(
    assetUrls.map((url) => cacheSnapshotAsset(url, cache, isCurrent))
  );
  if (!isCurrent()) {
    await broadcast({ type: 'WARM_PROGRESS', state: 'cancelled', scope: snapshotScope });
    return;
  }

  const externalCached = assetResults.filter((result) => result.status === 'fulfilled' && result.value).length;
  await trimCache(EXTERNAL_CACHE, 250);
  if (!isCurrent()) {
    await broadcast({ type: 'WARM_PROGRESS', state: 'cancelled', scope: snapshotScope });
    return;
  }

  const pageKeys = await cache.keys();
  const snapshotComplete = requiredCached === requiredTotal;
  await setMeta(`snapshot:${snapshotScope}`, {
    version: VERSION,
    cachedAt: Date.now(),
    pages: cached,
    requiredPages: requiredTotal,
    pageEntries: pageKeys.length,
    externalAssets: externalCached,
    complete: snapshotComplete,
    failed: failedUrls.length
  });
  if (!isCurrent()) {
    if (!snapshotRuns.has(snapshotScope)) {
      await deleteMeta(`snapshot:${snapshotScope}`);
    }
    await broadcast({ type: 'WARM_PROGRESS', state: 'cancelled', scope: snapshotScope });
    return;
  }

  await broadcast({
    type: 'WARM_PROGRESS',
    state: 'complete',
    completed,
    total,
    cached,
    requiredCached,
    requiredTotal,
    complete: snapshotComplete,
    failed: failedUrls.length,
    externalCached,
    scope: snapshotScope
  });
  snapshotRuns.delete(snapshotScope);
}

async function clearScope(scope, clearQueue = false) {
  const safeScope = sanitizeScope(scope);
  snapshotRuns.delete(safeScope);

  // Change the in-memory context before asynchronous cleanup so a late
  // message from the logged-out page cannot start another scoped snapshot.
  if (activeScope === safeScope) {
    await setActiveScope('public');
  }

  await caches.delete(pageCacheName(safeScope));
  await deleteMeta(`snapshot:${safeScope}`);

  if (clearQueue) {
    const mutations = await getMutations(safeScope);
    await Promise.all(mutations.map((mutation) => deleteMutation(mutation.id)));
  }

}

async function precacheApplicationShell() {
  const cache = await caches.open(STATIC_CACHE);

  // One optional image that is missing in a deployment must not prevent a new
  // worker from replacing an older worker. cache.addAll() rejects the entire
  // install in that situation and can leave clients on an already-fixed bug.
  await Promise.allSettled(PRECACHE_URLS.map(async (url) => {
    const response = await fetch(new Request(url, { cache: 'reload' }));
    if (!response.ok) {
      throw new Error(`Precache ${url} gagal (HTTP ${response.status})`);
    }
    await safeCachePut(cache, url, response);
  }));

  // The offline document is the only mandatory shell entry because it is the
  // final navigation fallback. Retry it explicitly and fail installation only
  // when this essential response is genuinely unavailable.
  if (!await cache.match(OFFLINE_URL)) {
    const offlineResponse = await fetch(new Request(OFFLINE_URL, { cache: 'reload' }));
    if (!offlineResponse.ok || !await safeCachePut(cache, OFFLINE_URL, offlineResponse)) {
      throw new Error('Dokumen fallback offline tidak dapat disimpan.');
    }
  }
}

self.addEventListener('install', (event) => {
  event.waitUntil(
    precacheApplicationShell()
      .then(() => self.skipWaiting())
  );
});

self.addEventListener('activate', (event) => {
  event.waitUntil(
    caches.keys()
      .then((names) => Promise.all(names
        .filter((name) => name.startsWith(CACHE_PREFIX)
          && ((name.startsWith(`${CACHE_PREFIX}static-`) && name !== STATIC_CACHE)
            || (name.startsWith(`${CACHE_PREFIX}external-`) && name !== EXTERNAL_CACHE)
            || (name.startsWith(PAGE_CACHE_PREFIX) && !name.endsWith(`-${VERSION}`))))
        .map((name) => caches.delete(name))))
      .then(() => self.clients.claim())
  );
});

self.addEventListener('fetch', (event) => {
  const request = event.request;
  const url = new URL(request.url);

  if (url.origin !== self.location.origin) {
    if (request.method === 'GET' && ['style', 'script', 'font', 'image'].includes(request.destination)) {
      event.respondWith(externalCacheFirst(request).catch(async () => (
        (await caches.match(request)) || Response.error()
      )));
    }
    return;
  }

  if (request.method !== 'GET') {
    if (!isNeverQueued(url.pathname)) {
      event.respondWith(networkOrQueue(request));
    }
    return;
  }

  if (isNeverCached(url.pathname)) {
    event.respondWith(networkOnly(request));
    return;
  }

  if (isStaticRequest(request, url)) {
    event.respondWith(cacheFirstStatic(request));
    return;
  }

  event.respondWith(networkFirstPage(request));
});

self.addEventListener('sync', (event) => {
  if (event.tag === SYNC_TAG) {
    event.waitUntil(replayMutations('background-sync'));
  }
});

self.addEventListener('message', (event) => {
  const message = event.data || {};
  const respond = (payload) => {
    if (event.ports && event.ports[0]) {
      event.ports[0].postMessage(payload);
    }
  };

  if (message.type === 'SET_CONTEXT') {
    event.waitUntil((async () => {
      await contextReady;
      const scope = await switchActiveScope(message.scope);
      respond({ ok: true, scope });
    })());
    return;
  }

  if (message.type === 'WARM_URLS') {
    event.waitUntil((async () => {
      await contextReady;
      const requestedScope = sanitizeScope(message.scope);
      if (requestedScope !== activeScope) {
        respond({ ok: false, staleContext: true, scope: activeScope });
        return;
      }
      respond({ ok: true, scope: requestedScope });
      await warmOfflineSnapshot(message.urls, requestedScope);
    })());
    return;
  }

  if (message.type === 'SYNC_MUTATIONS') {
    event.waitUntil((async () => {
      await contextReady;
      const requestedScope = sanitizeScope(message.scope || activeScope);
      if (requestedScope !== activeScope) {
        respond({ ok: false, staleContext: true, scope: activeScope });
        return;
      }
      respond({ ok: true, scope: requestedScope });
      await replayMutations(message.reason || 'manual', requestedScope);
    })());
    return;
  }

  if (message.type === 'GET_STATUS') {
    event.waitUntil((async () => {
      await contextReady;
      const mutations = await getMutations(message.scope || activeScope);
      const requestedScope = sanitizeScope(message.scope || activeScope);
      const snapshot = await getMeta(`snapshot:${requestedScope}`, null);
      const pageCache = await caches.open(pageCacheName(requestedScope));
      const pageCount = (await pageCache.keys()).length;
      respond({
        ok: true,
        scope: activeScope,
        cacheVersion: VERSION,
        pageCount,
        pending: mutations.filter((item) => item.state !== 'failed').length,
        failed: mutations.filter((item) => item.state === 'failed').length,
        snapshot
      });
    })());
    return;
  }

  if (message.type === 'CLEAR_SCOPE') {
    event.waitUntil((async () => {
      await contextReady;
      await clearScope(message.scope, message.clearQueue === true);
      respond({ ok: true });
    })());
    return;
  }

  if (message.type === 'SKIP_WAITING') {
    self.skipWaiting();
  }
});
