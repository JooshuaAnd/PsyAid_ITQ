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

  let deferredInstallPrompt = null;
  let controlRegion = null;
  let installButton = null;
  let installHelp = null;
  let installHelpTimer = null;
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

    return '<svg aria-hidden="true" viewBox="0 0 24 24"><path d="M4 12h3l2-4 3 8 2-4h6"/></svg>';
  }

  function createControls() {
    const region = document.createElement('div');
    region.id = 'pwa-control-cluster';
    region.className = 'pwa-control-cluster';
    region.setAttribute('aria-label', 'Status aplikasi PsyAid');

    if (document.getElementById('volunteer-popup-widget')) {
      document.body.classList.add('pwa-public-landing');
    }

    installButton = document.createElement('button');
    installButton.id = 'pwa-install-button';
    installButton.className = 'pwa-install-button';
    installButton.type = 'button';
    installButton.hidden = true;
    installButton.innerHTML = iconMarkup('install');
    installButton.setAttribute('aria-label', 'Pasang aplikasi PsyAid');
    installButton.title = 'Pasang aplikasi PsyAid';
    installButton.addEventListener('click', installApplication);

    if (isAuthenticated) {
      syncButton = document.createElement('button');
      syncButton.id = 'pwa-sync-button';
      syncButton.className = 'pwa-sync-button';
      syncButton.type = 'button';
      syncButton.innerHTML = iconMarkup('sync');
      syncButton.setAttribute('aria-label', 'Sinkronkan data offline sekarang');
      syncButton.title = 'Perbarui snapshot dan kirim antrean offline';
      syncButton.addEventListener('click', manualSync);
    }

    networkStatus = document.createElement('div');
    networkStatus.id = 'pwa-network-status';
    networkStatus.className = 'pwa-network-status';
    networkStatus.setAttribute('role', 'status');
    networkStatus.setAttribute('aria-live', 'polite');

    region.append(installButton);
    if (syncButton) {
      region.append(syncButton);
    }
    region.append(networkStatus);
    document.body.appendChild(region);
    controlRegion = region;

    showQueuedRedirectNotice();
    updateNetworkStatus();
    updateInstallButton();
  }

  function updateInstallButton() {
    if (!installButton) {
      return;
    }
    installButton.hidden = standalone || (deferredInstallPrompt === null && !iosDevice);
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

  function showIosInstallGuide() {
    if (!controlRegion) {
      return;
    }

    if (!installHelp) {
      installHelp = document.createElement('div');
      installHelp.className = 'pwa-install-help';
      installHelp.setAttribute('role', 'status');
      installHelp.textContent = 'Di iPhone, tekan Bagikan lalu pilih Tambahkan ke Layar Utama.';
      controlRegion.appendChild(installHelp);
    }

    installHelp.hidden = false;
    window.clearTimeout(installHelpTimer);
    installHelpTimer = window.setTimeout(() => {
      installHelp.hidden = true;
    }, 8000);
  }

  async function installApplication() {
    if (!deferredInstallPrompt || !installButton) {
      if (iosDevice) {
        showIosInstallGuide();
      }
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
    if (!force && cachedAt && Date.now() - cachedAt < SNAPSHOT_MAX_AGE) {
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

      await workerRequest({ type: 'WARM_URLS', scope: userScope, urls: manifest.urls });
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
      await workerRequest({ type: 'SYNC_MUTATIONS', reason: 'manual-button' });
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
      await workerRequest({ type: 'SYNC_MUTATIONS', reason: 'online-event' });
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
        await workerRequest({ type: 'SYNC_MUTATIONS', reason: 'application-start' });
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
        await workerRequest({ type: 'SYNC_MUTATIONS', reason: 'before-logout' });
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
      warmState = message.state === 'complete' ? 'idle' : 'running';
      updateNetworkStatus();
      if (message.state === 'complete') {
        showNotice(`Mode offline siap: ${message.cached} halaman/data terbaru tersimpan.`, 'success');
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
    }, { once: true });
  } else {
    createControls();
    installLogoutGuard();
  }

  if ('serviceWorker' in navigator) {
    navigator.serviceWorker.addEventListener('message', handleWorkerMessage);
    window.addEventListener('load', () => {
      navigator.serviceWorker.register('/service-worker.js', {
        scope: '/',
        updateViaCache: 'none'
      }).then(initializeOfflineMode).catch((error) => {
        console.warn('PsyAid PWA tidak dapat diaktifkan:', error.message);
      });
    }, { once: true });
  }
}());
