(function () {
  'use strict';

  const scopeMeta = document.querySelector('meta[name="psyaid-user-scope"]');
  const roleMeta = document.querySelector('meta[name="psyaid-user-role"]');
  const bootstrapMeta = document.querySelector('meta[name="psyaid-offline-bootstrap"]');
  const userScope = scopeMeta ? scopeMeta.content : 'public';
  const userRole = roleMeta ? roleMeta.content : 'public';
  const bootstrapUrl = bootstrapMeta ? bootstrapMeta.content : null;
  const isAuthenticated = userScope !== 'public';
  const SNAPSHOT_MAX_AGE = 15 * 60 * 1000;
  const SERVICE_WORKER_RELEASE = '20260808-8';
  const PAGE_CACHE_VERSION = 'v11';

  let deferredInstallPrompt = null;
  let controlRegion = null;
  let controlToggle = null;
  let controlPanel = null;
  let installButton = null;
  let networkStatus = null;
  let syncButton = null;
  let notice = null;
  let pendingCount = 0;
  let failedCount = 0;
  let syncState = 'idle';
  let warmState = 'idle';

  const standalone = window.matchMedia('(display-mode: standalone)').matches
    || window.navigator.standalone === true;
  const iosDevice = /iphone|ipad|ipod/i.test(window.navigator.userAgent)
    || (window.navigator.platform === 'MacIntel' && window.navigator.maxTouchPoints > 1);

  function iconMarkup(name) {
    if (name === 'install') {
      return '<svg aria-hidden="true" viewBox="0 0 24 24"><path d="M12 3v11m0 0 4-4m-4 4-4-4M5 17v2h14v-2"/></svg>';
    }

    if (name === 'sync') {
      return '<svg aria-hidden="true" viewBox="0 0 24 24"><path d="M20 7h-5V2"/><path d="M20 7a8 8 0 1 0 1 7"/></svg>';
    }

    if (name === 'controls') {
      return '<svg aria-hidden="true" viewBox="0 0 24 24"><path d="M5 7h14M5 12h14M5 17h14"/><circle cx="9" cy="7" r="1.6"/><circle cx="15" cy="12" r="1.6"/><circle cx="11" cy="17" r="1.6"/></svg>';
    }

    return '<svg aria-hidden="true" viewBox="0 0 24 24"><path d="M4 12h3l2-4 3 8 2-4h6"/></svg>';
  }

  function createControls() {
    const region = document.createElement('div');
    region.id = 'pwa-control-cluster';
    region.className = 'pwa-control-cluster';
    region.setAttribute('aria-label', 'Status aplikasi PsyAid');

    const normalizedPath = window.location.pathname.replace(/\/+$/, '') || '/';
    if (['/', '/landing'].includes(normalizedPath) || document.getElementById('volunteer-popup-widget')) {
      document.body.classList.add('pwa-public-landing');
    }

    controlPanel = document.createElement('div');
    controlPanel.id = 'pwa-control-panel';
    controlPanel.className = 'pwa-control-panel';
    controlPanel.setAttribute('role', 'group');
    controlPanel.setAttribute('aria-label', 'Kontrol aplikasi');
    controlPanel.hidden = true;

    controlToggle = document.createElement('button');
    controlToggle.id = 'pwa-control-toggle';
    controlToggle.className = 'pwa-control-toggle';
    controlToggle.type = 'button';
    controlToggle.innerHTML = `${iconMarkup('controls')}<span class="pwa-toggle-indicator" aria-hidden="true"></span>`;
    controlToggle.setAttribute('aria-label', 'Buka kontrol aplikasi PsyAid');
    controlToggle.setAttribute('aria-controls', controlPanel.id);
    controlToggle.setAttribute('aria-haspopup', 'true');
    controlToggle.setAttribute('aria-expanded', 'false');
    controlToggle.title = 'Kontrol aplikasi';
    controlToggle.addEventListener('click', () => {
      setControlPanelOpen(controlPanel.hidden);
    });

    if (!iosDevice) {
      installButton = document.createElement('button');
      installButton.id = 'pwa-install-button';
      installButton.className = 'pwa-panel-button pwa-install-button';
      installButton.type = 'button';
      installButton.hidden = true;
      installButton.innerHTML = `${iconMarkup('install')}<span>Pasang aplikasi</span>`;
      installButton.setAttribute('aria-label', 'Pasang aplikasi PsyAid');
      installButton.title = 'Pasang aplikasi PsyAid';
      installButton.addEventListener('click', installApplication);
      controlPanel.appendChild(installButton);
    }

    if (isAuthenticated) {
      syncButton = document.createElement('button');
      syncButton.id = 'pwa-sync-button';
      syncButton.className = 'pwa-panel-button pwa-sync-button';
      syncButton.type = 'button';
      syncButton.innerHTML = `${iconMarkup('sync')}<span>Sinkronkan</span>`;
      syncButton.setAttribute('aria-label', 'Sinkronkan data offline sekarang');
      syncButton.title = 'Perbarui snapshot dan kirim antrean offline';
      syncButton.addEventListener('click', manualSync);
      controlPanel.appendChild(syncButton);
    }

    networkStatus = document.createElement('div');
    networkStatus.id = 'pwa-network-status';
    networkStatus.className = 'pwa-network-status';
    networkStatus.setAttribute('role', 'status');
    networkStatus.setAttribute('aria-live', 'polite');

    controlPanel.appendChild(networkStatus);
    region.append(controlPanel, controlToggle);
    document.body.appendChild(region);
    controlRegion = region;

    document.addEventListener('click', (event) => {
      if (controlPanel && !controlPanel.hidden && !region.contains(event.target)) {
        setControlPanelOpen(false);
      }
    });
    document.addEventListener('keydown', (event) => {
      if (event.key === 'Escape' && controlPanel && !controlPanel.hidden) {
        setControlPanelOpen(false);
        controlToggle.focus();
      }
    });

    showQueuedRedirectNotice();
    updateNetworkStatus();
    updateInstallButton();
  }

  function setControlPanelOpen(open) {
    if (!controlPanel || !controlToggle) {
      return;
    }

    controlPanel.hidden = !open;
    controlPanel.classList.toggle('is-open', open);
    controlToggle.classList.toggle('is-open', open);
    controlToggle.setAttribute('aria-expanded', String(open));
    controlToggle.setAttribute('aria-label', `${open ? 'Tutup' : 'Buka'} kontrol aplikasi PsyAid`);
  }

  function updateInstallButton() {
    if (!installButton) {
      return;
    }
    installButton.hidden = standalone || deferredInstallPrompt === null;
  }

  function updateNetworkStatus() {
    if (!networkStatus) {
      return;
    }

    const online = navigator.onLine;
    let label = online ? 'Online' : 'Offline';

    if (syncState === 'syncing') {
      label = 'Menyinkronkan…';
    } else if (warmState === 'running') {
      label = 'Memperbarui data…';
    } else if (pendingCount || failedCount) {
      label += ` • ${pendingCount + failedCount} antrean`;
    } else if (!online && isAuthenticated) {
      label += ' • snapshot aktif';
    }

    networkStatus.classList.toggle('is-offline', !online);
    networkStatus.classList.toggle('has-queue', pendingCount + failedCount > 0);
    networkStatus.innerHTML = `<span>${label}</span>`;
    networkStatus.setAttribute('aria-label', `Status koneksi: ${label}`);
    networkStatus.title = online
      ? 'Data server tersedia. Tekan sinkronisasi untuk memperbarui snapshot.'
      : 'PsyAid memakai snapshot lokal. Perubahan baru akan masuk antrean perangkat.';

    if (controlToggle) {
      controlToggle.classList.toggle('is-offline', !online);
      controlToggle.classList.toggle('has-queue', pendingCount + failedCount > 0);
      controlToggle.title = `${label} · buka kontrol aplikasi`;
    }

    if (syncButton) {
      syncButton.disabled = !online || syncState === 'syncing' || warmState === 'running';
      syncButton.classList.toggle('is-pending', syncState === 'syncing' || warmState === 'running');
    }
  }

  function showNotice(message, tone) {
    if (!controlRegion) {
      return;
    }

    if (!notice) {
      notice = document.createElement('div');
      notice.className = 'pwa-notice';
      notice.setAttribute('role', 'status');
      notice.setAttribute('aria-live', 'polite');
      controlRegion.appendChild(notice);
    }

    notice.className = `pwa-notice is-${tone || 'info'}`;
    notice.textContent = message;
    notice.hidden = false;
    window.clearTimeout(notice.hideTimer);
    notice.hideTimer = window.setTimeout(() => {
      notice.hidden = true;
    }, 8000);
  }

  function showQueuedRedirectNotice() {
    const url = new URL(window.location.href);
    if (!url.searchParams.has('offline_queued')) {
      return;
    }

    showNotice('Perubahan tersimpan di perangkat dan akan dikirim otomatis saat koneksi pulih.', 'warning');
    url.searchParams.delete('offline_queued');
    window.history.replaceState({}, '', `${url.pathname}${url.search}${url.hash}`);
  }

  async function installApplication() {
    if (!deferredInstallPrompt || !installButton) {
      return;
    }

    installButton.disabled = true;
    installButton.classList.add('is-pending');
    installButton.setAttribute('aria-label', 'Menyiapkan instalasi PsyAid');
    deferredInstallPrompt.prompt();
    await deferredInstallPrompt.userChoice;
    deferredInstallPrompt = null;
    installButton.disabled = false;
    installButton.classList.remove('is-pending');
    installButton.setAttribute('aria-label', 'Pasang aplikasi PsyAid');
    updateInstallButton();
  }

  async function workerRequest(message, timeoutMs) {
    if (!('serviceWorker' in navigator)) {
      return null;
    }

    const registration = await navigator.serviceWorker.ready;
    const worker = navigator.serviceWorker.controller || registration.active;
    if (!worker) {
      return null;
    }

    return new Promise((resolve, reject) => {
      const channel = new MessageChannel();
      const timer = window.setTimeout(() => reject(new Error('Service worker tidak merespons.')), timeoutMs || 10000);
      channel.port1.onmessage = (event) => {
        window.clearTimeout(timer);
        resolve(event.data);
      };
      worker.postMessage(message, [channel.port2]);
    });
  }

  async function getOfflineStatus() {
    const status = await workerRequest({ type: 'GET_STATUS', scope: userScope });
    if (status) {
      pendingCount = status.pending || 0;
      failedCount = status.failed || 0;
      updateNetworkStatus();
    }
    return status;
  }

  async function synchronizeSnapshot(force) {
    if (!navigator.onLine || !bootstrapUrl) {
      return;
    }

    const status = await getOfflineStatus();
    const cachedAt = status && status.snapshot ? Number(status.snapshot.cachedAt || 0) : 0;
    const snapshotIsUsable = Boolean(
      status
      && status.snapshot
      && status.snapshot.version === status.cacheVersion
      && status.snapshot.complete === true
      && status.pageCount > 0
      && status.pageCount >= Number(status.snapshot.pageEntries || status.snapshot.pages || 0)
    );
    if (!force && snapshotIsUsable && cachedAt && Date.now() - cachedAt < SNAPSHOT_MAX_AGE) {
      return;
    }

    warmState = 'running';
    updateNetworkStatus();

    try {
      const response = await fetch(bootstrapUrl, {
        credentials: 'same-origin',
        cache: 'no-store',
        headers: { Accept: 'application/json' }
      });
      if (!response.ok) {
        throw new Error(`HTTP ${response.status}`);
      }

      const manifest = await response.json();
      if (manifest.status !== 'success' || manifest.scope !== userScope || !Array.isArray(manifest.urls)) {
        throw new Error('Manifest offline tidak sesuai dengan sesi aktif.');
      }

      const warmRequest = await workerRequest({ type: 'WARM_URLS', scope: userScope, urls: manifest.urls });
      if (!warmRequest || warmRequest.ok !== true) {
        throw new Error('Konteks akun berubah sebelum snapshot dimulai.');
      }
    } catch (error) {
      warmState = 'idle';
      updateNetworkStatus();
      console.warn('Snapshot offline PsyAid belum dapat diperbarui:', error.message);
    }
  }

  async function manualSync() {
    if (!navigator.onLine) {
      showNotice('Perangkat masih offline. Antrean tetap aman di perangkat.', 'warning');
      return;
    }

    syncState = 'syncing';
    updateNetworkStatus();
    try {
      await workerRequest({ type: 'SYNC_MUTATIONS', reason: 'manual-button', scope: userScope });
      if (pendingCount + failedCount === 0) {
        await synchronizeSnapshot(true);
      }
    } catch (error) {
      syncState = 'idle';
      updateNetworkStatus();
      showNotice('Sinkronisasi belum dapat dimulai. Coba beberapa saat lagi.', 'danger');
    }
  }

  async function handleOnline() {
    updateNetworkStatus();
    if (!isAuthenticated) {
      return;
    }

    try {
      await workerRequest({ type: 'SYNC_MUTATIONS', reason: 'online-event', scope: userScope });
      const status = await getOfflineStatus();
      if (!status || (status.pending + status.failed === 0)) {
        await synchronizeSnapshot(true);
      }
    } catch (error) {
      console.warn('Sinkronisasi otomatis PsyAid tertunda:', error.message);
    }
  }

  async function initializeOfflineMode(registration) {
    await workerRequest({ type: 'SET_CONTEXT', scope: userScope, role: userRole });
    const status = await getOfflineStatus();

    if (navigator.onLine && isAuthenticated) {
      if (status && status.pending + status.failed > 0) {
        await workerRequest({ type: 'SYNC_MUTATIONS', reason: 'application-start', scope: userScope });
      } else {
        await synchronizeSnapshot(false);
      }
    }

    if (registration.waiting) {
      registration.waiting.postMessage({ type: 'SKIP_WAITING' });
    }
  }

  async function waitUntilQueueEmpty(timeoutMs) {
    const deadline = Date.now() + timeoutMs;
    while (Date.now() < deadline) {
      const status = await getOfflineStatus();
      if (!status || status.pending + status.failed === 0) {
        return true;
      }
      await new Promise((resolve) => window.setTimeout(resolve, 500));
    }
    return false;
  }

  function installLogoutGuard() {
    document.addEventListener('click', async (event) => {
      const link = event.target.closest('a[href]');
      if (!link) {
        return;
      }

      const target = new URL(link.href, window.location.href);
      if (target.origin !== window.location.origin || target.pathname !== '/logout' || link.dataset.offlineLogoutReady === 'true') {
        return;
      }

      event.preventDefault();
      const status = await getOfflineStatus();
      const queued = status ? status.pending + status.failed : 0;

      if (queued > 0 && !navigator.onLine) {
        showNotice(`Logout ditunda: ${queued} perubahan belum tersinkron. Hubungkan internet terlebih dahulu.`, 'danger');
        return;
      }

      if (queued > 0) {
        showNotice('Mengirim antrean sebelum logout…', 'info');
        await workerRequest({ type: 'SYNC_MUTATIONS', reason: 'before-logout', scope: userScope });
        if (!await waitUntilQueueEmpty(15000)) {
          const discard = window.confirm(
            'Masih ada perubahan yang gagal dikirim. Jika logout dilanjutkan, antrean dan snapshot akun ini akan dihapus dari perangkat. Lanjutkan logout?'
          );
          if (!discard) {
            showNotice('Logout dibatalkan; antrean tetap tersimpan di perangkat.', 'danger');
            return;
          }
          await workerRequest({ type: 'CLEAR_SCOPE', scope: userScope, clearQueue: true });
        }
      }

      await workerRequest({ type: 'CLEAR_SCOPE', scope: userScope, clearQueue: false });
      link.dataset.offlineLogoutReady = 'true';
      window.location.assign(target.href);
    }, true);
  }

  async function findCachedNavigation(targetUrl) {
    if (!('caches' in window) || !isAuthenticated) {
      return null;
    }

    const cacheName = `psyaid-pages-${userScope}-${PAGE_CACHE_VERSION}`;
    const availableCaches = await window.caches.keys();
    if (!availableCaches.includes(cacheName)) {
      return null;
    }

    const cache = await window.caches.open(cacheName);
    let response = await cache.match(targetUrl.href, { ignoreVary: true });
    if (response) {
      return response;
    }

    if (targetUrl.searchParams.has('offline_queued')) {
      const withoutQueueMarker = new URL(targetUrl.href);
      withoutQueueMarker.searchParams.delete('offline_queued');
      response = await cache.match(withoutQueueMarker.href, { ignoreVary: true });
      if (response) {
        return response;
      }
    }

    if (targetUrl.search) {
      const withoutSearch = `${targetUrl.origin}${targetUrl.pathname}`;
      response = await cache.match(withoutSearch, { ignoreVary: true });
    }

    return response || null;
  }

  async function renderCachedNavigation(response, targetUrl) {
    const contentType = response.headers.get('Content-Type') || '';
    if (!contentType.includes('text/html')) {
      return false;
    }

    const html = await response.text();
    if (!/<html[\s>]/i.test(html) || !html.includes('psyaid-user-scope')) {
      return false;
    }

    const parsed = new DOMParser().parseFromString(html, 'text/html');
    const stylesheetLinks = Array.from(parsed.querySelectorAll('link[rel~="stylesheet"][href]'));
    for (const link of stylesheetLinks) {
      try {
        const resourceUrl = new URL(link.getAttribute('href'), targetUrl.href);
        const cachedResource = await window.caches.match(resourceUrl.href, {
          ignoreSearch: true,
          ignoreVary: true
        });
        if (!cachedResource || cachedResource.type === 'opaque') {
          continue;
        }

        let css = await cachedResource.text();
        css = css.replace(/url\((['"]?)([^'"\)]+)\1\)/g, (full, quote, value) => {
          if (/^(?:data:|blob:|#)/i.test(value)) {
            return full;
          }
          return `url("${new URL(value, resourceUrl.href).href}")`;
        });
        const style = parsed.createElement('style');
        style.setAttribute('data-psyaid-offline-source', resourceUrl.href);
        style.textContent = css;
        link.replaceWith(style);
      } catch (error) {
        // Keep the original link; a controlling service worker may still load it.
      }
    }

    const externalScripts = Array.from(parsed.querySelectorAll('script[src]'));
    for (const script of externalScripts) {
      try {
        const resourceUrl = new URL(script.getAttribute('src'), targetUrl.href);
        const cachedResource = await window.caches.match(resourceUrl.href, {
          ignoreSearch: true,
          ignoreVary: true
        });
        if (!cachedResource || cachedResource.type === 'opaque') {
          continue;
        }

        const inlineScript = parsed.createElement('script');
        inlineScript.setAttribute('data-psyaid-offline-source', resourceUrl.href);
        inlineScript.textContent = (await cachedResource.text()).replace(/<\/script/gi, '<\\/script');
        script.replaceWith(inlineScript);
      } catch (error) {
        // Keep the original script; a controlling service worker may still load it.
      }
    }

    window.history.pushState({ psyaidOfflineNavigation: true }, '', targetUrl.href);
    document.open();
    document.write(`<!doctype html>${parsed.documentElement.outerHTML}`);
    document.close();
    return true;
  }

  function installOfflineNavigationFallback() {
    document.addEventListener('click', async (event) => {
      if (navigator.onLine || event.defaultPrevented || event.button !== 0
        || event.metaKey || event.ctrlKey || event.shiftKey || event.altKey) {
        return;
      }

      const link = event.target.closest('a[href]');
      if (!link || link.target === '_blank' || link.hasAttribute('download')) {
        return;
      }

      const rawHref = link.getAttribute('href') || '';
      if (rawHref === '' || rawHref.startsWith('#') || rawHref.startsWith('javascript:')) {
        return;
      }

      const target = new URL(link.href, window.location.href);
      if (target.origin !== window.location.origin || ['/logout', '/login'].includes(target.pathname)) {
        return;
      }

      event.preventDefault();
      try {
        const cached = await findCachedNavigation(target);
        if (cached && await renderCachedNavigation(cached, target)) {
          return;
        }
      } catch (error) {
        console.warn('Navigasi cache lokal gagal:', error.message);
      }

      showNotice('Halaman ini belum tersedia di snapshot lokal. Sambungkan internet dan tekan tombol sinkronisasi.', 'danger');
    }, true);
  }

  function handleWorkerMessage(event) {
    const message = event.data || {};

    if (message.scope && message.scope !== userScope) {
      return;
    }

    if (message.type === 'QUEUE_STATUS') {
      pendingCount = message.pending || 0;
      failedCount = message.failed || 0;
      if (message.syncState) {
        syncState = message.syncState === 'complete' ? 'idle' : message.syncState;
      }
      updateNetworkStatus();
      if (message.queued) {
        showNotice('Perubahan masuk antrean perangkat.', 'warning');
      }
      return;
    }

    if (message.type === 'SYNC_STATE') {
      syncState = message.state;
      updateNetworkStatus();
      return;
    }

    if (message.type === 'SYNC_CANCELLED') {
      syncState = 'idle';
      updateNetworkStatus();
      return;
    }

    if (message.type === 'SYNC_COMPLETE') {
      syncState = 'idle';
      updateNetworkStatus();
      if (message.synced > 0) {
        showNotice(`${message.synced} perubahan berhasil dikirim ke server.`, 'success');
        synchronizeSnapshot(true);
      }
      return;
    }

    if (message.type === 'SYNC_AUTH_REQUIRED') {
      syncState = 'idle';
      updateNetworkStatus();
      showNotice('Sesi telah berakhir. Login kembali untuk mengirim antrean.', 'danger');
      return;
    }

    if (message.type === 'SYNC_ITEM_FAILED') {
      showNotice(`Satu perubahan ditolak server (HTTP ${message.status}). Data tetap ada di antrean.`, 'danger');
      return;
    }

    if (message.type === 'WARM_PROGRESS') {
      warmState = ['complete', 'cancelled'].includes(message.state) ? 'idle' : 'running';
      updateNetworkStatus();
      if (message.state === 'cancelled') {
        return;
      }
      if (message.state === 'complete') {
        if (message.complete) {
          showNotice(`Mode offline siap: ${message.cached} halaman/data terbaru tersimpan.`, 'success');
        } else {
          showNotice(`Snapshot belum lengkap (${message.requiredCached}/${message.requiredTotal}). Tetap online lalu tekan sinkronisasi untuk mencoba lagi.`, 'danger');
        }
      }
    }
  }

  window.addEventListener('beforeinstallprompt', (event) => {
    event.preventDefault();
    deferredInstallPrompt = event;
    updateInstallButton();
  });

  window.addEventListener('appinstalled', () => {
    deferredInstallPrompt = null;
    updateInstallButton();
  });

  window.addEventListener('online', handleOnline);
  window.addEventListener('offline', updateNetworkStatus);

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => {
      createControls();
      installLogoutGuard();
      installOfflineNavigationFallback();
    }, { once: true });
  } else {
    createControls();
    installLogoutGuard();
    installOfflineNavigationFallback();
  }

  if ('serviceWorker' in navigator) {
    navigator.serviceWorker.addEventListener('message', handleWorkerMessage);
    navigator.serviceWorker.addEventListener('controllerchange', () => {
      const reloadKey = `psyaid-sw-reloaded-${SERVICE_WORKER_RELEASE}`;
      if (navigator.onLine && window.sessionStorage.getItem(reloadKey) !== 'true') {
        window.sessionStorage.setItem(reloadKey, 'true');
        window.location.reload();
      }
    });
    window.addEventListener('load', () => {
      navigator.serviceWorker.register(`/service-worker.js?v=${SERVICE_WORKER_RELEASE}`, {
        scope: '/',
        updateViaCache: 'none'
      }).then(async (registration) => {
        if (navigator.onLine) {
          await registration.update();
        }
        return initializeOfflineMode(registration);
      }).catch((error) => {
        console.warn('PsyAid PWA tidak dapat diaktifkan:', error.message);
      });
    }, { once: true });
  }
}());
