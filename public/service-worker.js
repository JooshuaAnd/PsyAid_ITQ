/* PsyAid offline-first service worker.
 *
 * - Public app-shell assets live in a versioned static cache.
 * - HTML and JSON snapshots live in a cache isolated by user id + role.
 * - Failed mutations are serialized in IndexedDB and replayed in order.
 * - Background Sync is used when available; pwa.js also triggers a manual
 *   replay on the `online` event for browsers without Background Sync.
 */

'use strict';

const VERSION = 'v6';
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

const NEVER_CACHE_PATHS = ['/logout', '/offline/bootstrap', '/health/'];
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

function pageCacheName(scope = activeScope) {
  return `${PAGE_CACHE_PREFIX}${sanitizeScope(scope)}-${VERSION}`;
}

function isNeverCached(pathname) {
  return NEVER_CACHE_PATHS.some((path) => pathname === path || pathname.startsWith(path));
}

function isNeverQueued(pathname) {
  return NEVER_QUEUE_PATHS.some((path) => pathname === path || pathname.startsWith(path));
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
  let cached = await cache.match(request);
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
      }));
      if (cached) {
        return cached;
      }
    }

    const withoutSearch = new Request(`${url.origin}${url.pathname}`, {
      method: 'GET',
      credentials: 'include'
    });
    cached = await cache.match(withoutSearch);
  }

  return cached;
}

async function networkFirstPage(request, requestedScope = activeScope) {
  await contextReady;
  let scope = sanitizeScope(requestedScope || activeScope);

  try {
    const response = await fetch(request);
    if (isUsableNetworkResponse(response)) {
      scope = await scopeForResponse(response, scope);
      const cache = await caches.open(pageCacheName(scope));
      await safeCachePut(cache, request, response);
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

async function reportQueueStatus(extra = {}) {
  const mutations = await getMutations(activeScope);
  await broadcast({
    type: 'QUEUE_STATUS',
    scope: activeScope,
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

async function replayMutations(reason = 'manual') {
  await contextReady;
  const mutations = await getMutations(activeScope);
  if (!mutations.length) {
    await reportQueueStatus({ syncState: 'idle', reason });
    return;
  }

  await broadcast({ type: 'SYNC_STATE', state: 'syncing', total: mutations.length, reason });
  let synced = 0;

  for (const mutation of mutations) {
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
        await broadcast({ type: 'SYNC_AUTH_REQUIRED', pending: mutations.length - synced });
        break;
      }

      if ((response.status >= 200 && response.status < 400) || response.status === 208) {
        await deleteMutation(mutation.id);
        synced += 1;
        await reportQueueStatus({ synced: mutation.id, syncState: 'syncing' });
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
          status: response.status
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

  await reportQueueStatus({ syncState: 'complete', syncedCount: synced, reason });
  await broadcast({ type: 'SYNC_COMPLETE', synced, reason });
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

async function cacheSnapshotAsset(url, scopeCache) {
  const assetUrl = new URL(url);
  if (assetUrl.origin !== self.location.origin) {
    return cacheExternalUrl(assetUrl.href);
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
  if (!isUsableNetworkResponse(response)) {
    return false;
  }

  return safeCachePut(targetCache, request, response);
}

async function warmOfflineSnapshot(urls, scope) {
  await setActiveScope(scope);
  const uniqueUrls = [...new Set((urls || []).map((url) => new URL(url, self.location.origin).href))];
  const total = uniqueUrls.length;
  const cache = await caches.open(pageCacheName(activeScope));
  const discoveredAssets = new Set();
  let completed = 0;
  let cached = 0;

  await broadcast({ type: 'WARM_PROGRESS', state: 'started', total });

  const workers = Array.from({ length: Math.min(4, Math.max(1, uniqueUrls.length)) }, async () => {
    while (uniqueUrls.length) {
      const url = uniqueUrls.shift();
      try {
        const request = new Request(url, { credentials: 'include', cache: 'no-store' });
        const response = await fetch(request);
        if (isUsableNetworkResponse(response)) {
          const assets = await discoverHtmlAssets(response, url);
          assets.forEach((assetUrl) => discoveredAssets.add(assetUrl));
          if (await safeCachePut(cache, request, response)) {
            cached += 1;
          }
        }
      } catch (error) {
        // A partial snapshot remains usable; the next online pass retries it.
      }
      completed += 1;
      if (completed === 1 || completed % 5 === 0 || completed === total) {
        await broadcast({ type: 'WARM_PROGRESS', state: 'running', completed, total });
      }
    }
  });

  await Promise.all(workers);
  const assetUrls = [...new Set([...EXTERNAL_ASSETS, ...discoveredAssets])];
  const assetResults = await Promise.allSettled(assetUrls.map((url) => cacheSnapshotAsset(url, cache)));
  const externalCached = assetResults.filter((result) => result.status === 'fulfilled' && result.value).length;
  await trimCache(EXTERNAL_CACHE, 250);
  await setMeta(`snapshot:${activeScope}`, {
    cachedAt: Date.now(),
    pages: cached,
    externalAssets: externalCached
  });
  await broadcast({
    type: 'WARM_PROGRESS',
    state: 'complete',
    completed,
    total,
    cached,
    externalCached,
    scope: activeScope
  });
}

async function clearScope(scope, clearQueue = false) {
  const safeScope = sanitizeScope(scope);
  await caches.delete(pageCacheName(safeScope));

  if (clearQueue) {
    const mutations = await getMutations(safeScope);
    await Promise.all(mutations.map((mutation) => deleteMutation(mutation.id)));
  }

  if (activeScope === safeScope) {
    await setActiveScope('public');
  }
}

self.addEventListener('install', (event) => {
  event.waitUntil(
    caches.open(STATIC_CACHE)
      .then((cache) => cache.addAll(PRECACHE_URLS))
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
    event.respondWith(fetch(request, { cache: 'no-store' }));
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
    event.waitUntil(setActiveScope(message.scope).then((scope) => respond({ ok: true, scope })));
    return;
  }

  if (message.type === 'WARM_URLS') {
    event.waitUntil(warmOfflineSnapshot(message.urls, message.scope));
    respond({ ok: true });
    return;
  }

  if (message.type === 'SYNC_MUTATIONS') {
    event.waitUntil(replayMutations(message.reason || 'manual'));
    respond({ ok: true });
    return;
  }

  if (message.type === 'GET_STATUS') {
    event.waitUntil((async () => {
      await contextReady;
      const mutations = await getMutations(message.scope || activeScope);
      const snapshot = await getMeta(`snapshot:${sanitizeScope(message.scope || activeScope)}`, null);
      respond({
        ok: true,
        scope: activeScope,
        pending: mutations.filter((item) => item.state !== 'failed').length,
        failed: mutations.filter((item) => item.state === 'failed').length,
        snapshot
      });
    })());
    return;
  }

  if (message.type === 'CLEAR_SCOPE') {
    event.waitUntil(clearScope(message.scope, message.clearQueue === true).then(() => respond({ ok: true })));
    return;
  }

  if (message.type === 'SKIP_WAITING') {
    self.skipWaiting();
  }
});
