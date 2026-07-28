/**
 * timeFormat.js
 * Utility helper untuk memformat dan menyinkronkan tampilan waktu secara real-time
 * sesuai dengan tanggal, jam, dan zona waktu pada perangkat device masing-masing pengguna.
 */

/**
 * Memformat objek Date / timestamp sesuai zona waktu & locale device user.
 * @param {Date|string|number} dateInput 
 * @param {Object} options 
 * @returns {string} Format tanggal & waktu terformat
 */
function formatDeviceTime(dateInput = new Date(), options = {}) {
    const date = (dateInput instanceof Date) ? dateInput : new Date(dateInput);
    if (isNaN(date.getTime())) return '';

    const defaultOptions = {
        day: '2-digit',
        month: 'short',
        year: 'numeric',
        hour: '2-digit',
        minute: '2-digit',
        hour12: false
    };

    const mergedOptions = { ...defaultOptions, ...options };
    try {
        const formatted = new Intl.DateTimeFormat('id-ID', mergedOptions).format(date);
        return formatted.replace(',', ' —');
    } catch (e) {
        return date.toLocaleString();
    }
}

/**
 * Mengambil nama singkatan zona waktu device pengguna (contoh: WIB, WITA, WIT, atau GMT+X).
 * @returns {string}
 */
function getDeviceTimezoneAbbr() {
    try {
        const now = new Date();
        const offsetMinutes = -now.getTimezoneOffset();
        if (offsetMinutes === 420) return 'WIB';
        if (offsetMinutes === 480) return 'WITA';
        if (offsetMinutes === 540) return 'WIT';
        const hours = Math.floor(Math.abs(offsetMinutes) / 60);
        const sign = offsetMinutes >= 0 ? '+' : '-';
        return `GMT${sign}${hours}`;
    } catch (e) {
        return '';
    }
}

/**
 * Memperbarui elemen HTML dengan tampilan tanggal & waktu real-time yang tersinkronisasi.
 * @param {string|HTMLElement} target 
 * @param {Object} options 
 */
function updateLiveClock(target, options = {}) {
    const elements = typeof target === 'string'
        ? document.querySelectorAll(target)
        : (target instanceof HTMLElement ? [target] : []);

    const render = () => {
        const now = new Date();
        const formattedTime = formatDeviceTime(now, options);
        const tzAbbr = getDeviceTimezoneAbbr();
        const fullString = `${formattedTime} ${tzAbbr}`.trim();

        elements.forEach(el => {
            if (el) {
                const clockText = el.querySelector('.time-text');
                if (clockText) {
                    clockText.textContent = fullString;
                } else {
                    el.textContent = fullString;
                }
            }
        });
    };

    render();
    setInterval(render, 1000);
}

// Inisialisasi otomatis pada elemen dengan attribute `data-live-clock` atau class `.live-device-clock`
document.addEventListener('DOMContentLoaded', function() {
    updateLiveClock('[data-live-clock]');
    updateLiveClock('.live-device-clock');
});
