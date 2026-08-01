(function () {
  'use strict';

  let deferredInstallPrompt = null;
  let controlRegion = null;
  let installButton = null;
  let installHelp = null;
  let installHelpTimer = null;
  let networkStatus = null;

  const standalone = window.matchMedia('(display-mode: standalone)').matches
    || window.navigator.standalone === true;
  const iosDevice = /iphone|ipad|ipod/i.test(window.navigator.userAgent)
    || (window.navigator.platform === 'MacIntel' && window.navigator.maxTouchPoints > 1);

  function iconMarkup(name) {
    if (name === 'install') {
      return '<svg aria-hidden="true" viewBox="0 0 24 24"><path d="M12 3v11m0 0 4-4m-4 4-4-4M5 17v2h14v-2"/></svg>';
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

    networkStatus = document.createElement('div');
    networkStatus.id = 'pwa-network-status';
    networkStatus.className = 'pwa-network-status';
    networkStatus.setAttribute('role', 'status');
    networkStatus.setAttribute('aria-live', 'polite');

    region.append(installButton, networkStatus);
    document.body.appendChild(region);
    controlRegion = region;

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
    networkStatus.classList.toggle('is-offline', !online);
    networkStatus.innerHTML = `<span>${online ? 'Online' : 'Offline'}</span>`;
    networkStatus.setAttribute('aria-label', `Status koneksi: ${online ? 'Online' : 'Offline'}`);
    networkStatus.title = online
      ? 'Terhubung. Data ditampilkan langsung dari server.'
      : 'Data klinis tidak disimpan di cache perangkat.';
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

  window.addEventListener('beforeinstallprompt', (event) => {
    event.preventDefault();
    deferredInstallPrompt = event;
    updateInstallButton();
  });

  window.addEventListener('appinstalled', () => {
    deferredInstallPrompt = null;
    updateInstallButton();
  });

  window.addEventListener('online', updateNetworkStatus);
  window.addEventListener('offline', updateNetworkStatus);

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', createControls, { once: true });
  } else {
    createControls();
  }

  if ('serviceWorker' in navigator) {
    window.addEventListener('load', () => {
      navigator.serviceWorker.register('/service-worker.js', {
        scope: '/',
        updateViaCache: 'none'
      }).catch((error) => {
        console.warn('PsyAid PWA tidak dapat diaktifkan:', error.message);
      });
    }, { once: true });
  }
}());
