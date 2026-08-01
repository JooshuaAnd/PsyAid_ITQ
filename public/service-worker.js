/* PsyAid PWA service worker.
 *
 * Privacy rule: authenticated pages, clinical records, API responses, and form
 * submissions are always network-only. Only the public PWA shell below is
 * stored in Cache Storage.
 */

'use strict';

const CACHE_PREFIX = 'psyaid-';
const STATIC_CACHE = `${CACHE_PREFIX}static-v4`;
const OFFLINE_URL = '/offline.html';

const PRECACHE_URLS = [
  OFFLINE_URL,
  '/manifest.webmanifest',
  '/pwa.css',
  '/pwa.js',
  '/helper/timeFormat.js',
  '/images/Logo_PsyAid.png',
  '/icons/pwa-180x180.png',
  '/icons/pwa-192x192.png',
  '/icons/pwa-512x512.png',
  '/icons/pwa-maskable-512x512.png'
];

const SAFE_STATIC_PATHS = new Set(PRECACHE_URLS);
const NETWORK_ONLY_PREFIXES = [
  '/api/',
  '/health/',
  '/bpbd/',
  '/command-center',
  '/relawan/',
  '/posko/',
  '/victim/',
  '/screening/',
  '/psikolog/',
  '/psychologist-review/',
  '/psychologist-mapping',
  '/itq/',
  '/clinical-action/',
  '/login',
  '/logout',
  '/register'
];

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
      .then((cacheNames) => Promise.all(
        cacheNames
          .filter((cacheName) => cacheName.startsWith(CACHE_PREFIX) && cacheName !== STATIC_CACHE)
          .map((cacheName) => caches.delete(cacheName))
      ))
      .then(() => self.clients.claim())
  );
});

function isNetworkOnlyPath(pathname) {
  return NETWORK_ONLY_PREFIXES.some((prefix) => pathname.startsWith(prefix));
}

async function cacheFirst(request) {
  const cachedResponse = await caches.match(request);
  if (cachedResponse) {
    return cachedResponse;
  }

  const networkResponse = await fetch(request);
  if (networkResponse.ok && networkResponse.type === 'basic') {
    const cache = await caches.open(STATIC_CACHE);
    await cache.put(request, networkResponse.clone());
  }

  return networkResponse;
}

self.addEventListener('fetch', (event) => {
  const { request } = event;

  if (request.method !== 'GET') {
    return;
  }

  const url = new URL(request.url);

  if (url.origin !== self.location.origin) {
    return;
  }

  // HTML navigations stay network-only. When offline, show a neutral shell
  // instead of a potentially stale page containing personal or clinical data.
  if (request.mode === 'navigate') {
    event.respondWith(
      fetch(request, { cache: 'no-store' })
        .catch(() => caches.match(OFFLINE_URL))
    );
    return;
  }

  // Never persist session-aware data requests or API responses.
  if (isNetworkOnlyPath(url.pathname)) {
    event.respondWith(fetch(request, { cache: 'no-store' }));
    return;
  }

  if (SAFE_STATIC_PATHS.has(url.pathname)) {
    event.respondWith(cacheFirst(request));
  }
});
