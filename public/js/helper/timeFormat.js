/**
 * timeFormat.js
 * Utility helper untuk memformat dan menyinkronkan tampilan waktu secara real-time
 * sesuai dengan tanggal, jam, dan zona waktu pada perangkat device masing-masing pengguna.
 */

/**
 * Mengubah string tanggal/waktu ke objek Date sesuai timezone & jam lokal device.
 * @param {Date|string|number} dateInput 
 * @returns {Date}
 */
function parseDeviceDate(dateInput) {
    if (dateInput instanceof Date) return dateInput;
    if (typeof dateInput === 'number') return new Date(dateInput);
    if (!dateInput || typeof dateInput !== 'string') return new Date(NaN);

    const str = dateInput.trim();

    // Match "YYYY-MM-DD HH:mm:ss" atau "YYYY-MM-DDTHH:mm:ss"
    const match = str.match(/^(\d{4})-(\d{2})-(\d{2})[T\s]+(\d{2}):(\d{2})(?::(\d{2}))?/);
    if (match) {
        const year = parseInt(match[1], 10);
        const month = parseInt(match[2], 10) - 1;
        const day = parseInt(match[3], 10);
        const hour = parseInt(match[4], 10);
        const minute = parseInt(match[5], 10);
        const second = match[6] ? parseInt(match[6], 10) : 0;
        return new Date(year, month, day, hour, minute, second);
    }

    // Match "YYYY-MM-DD" saja
    const dateOnlyMatch = str.match(/^(\d{4})-(\d{2})-(\d{2})$/);
    if (dateOnlyMatch) {
        const year = parseInt(dateOnlyMatch[1], 10);
        const month = parseInt(dateOnlyMatch[2], 10) - 1;
        const day = parseInt(dateOnlyMatch[3], 10);
        return new Date(year, month, day);
    }

    // Match "HH:mm" atau "HH:mm:ss" saja
    const timeOnlyMatch = str.match(/^(\d{2}):(\d{2})(?::(\d{2}))?/);
    if (timeOnlyMatch) {
        const now = new Date();
        const hour = parseInt(timeOnlyMatch[1], 10);
        const minute = parseInt(timeOnlyMatch[2], 10);
        const second = timeOnlyMatch[3] ? parseInt(timeOnlyMatch[3], 10) : 0;
        return new Date(now.getFullYear(), now.getMonth(), now.getDate(), hour, minute, second);
    }

    return new Date(str);
}

/**
 * Memformat objek Date / timestamp sesuai zona waktu & locale device user.
 * @param {Date|string|number} dateInput 
 * @param {Object} options 
 * @returns {string} Format tanggal & waktu terformat
 */
function formatDeviceTime(dateInput = new Date(), options = {}) {
    const date = parseDeviceDate(dateInput);
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

/**
 * Memformat semua elemen HTML yang memiliki attribute `data-device-time`
 */
function formatAllDeviceTimeElements() {
    document.querySelectorAll('[data-device-time]').forEach(el => {
        const rawTime = el.getAttribute('data-device-time');
        if (!rawTime || rawTime.trim() === '' || rawTime.trim() === '-') return;

        // Mendukung penanganan string gabungan atau tanggal tersendiri
        let validIso = rawTime.trim();
        if (/^\d{4}-\d{2}-\d{2}\s+\d{2}:\d{2}/.test(validIso)) {
            validIso = validIso.replace(' ', 'T');
        }

        const formatType = el.getAttribute('data-format-type') || 'full';
        let options = {};
        if (formatType === 'date-only') {
            options = { hour: undefined, minute: undefined };
        } else if (formatType === 'time-only') {
            options = { day: undefined, month: undefined, year: undefined };
        }

        const formatted = formatDeviceTime(validIso, options);
        if (formatted) {
            const showTz = el.getAttribute('data-show-tz') === 'true';
            const tz = showTz ? ' ' + getDeviceTimezoneAbbr() : '';
            const prefix = el.getAttribute('data-time-prefix') || '';
            const suffix = el.getAttribute('data-time-suffix') || '';
            el.textContent = prefix + formatted + tz + suffix;
        }
    });
}

// Inisialisasi otomatis pada elemen dengan attribute `data-live-clock`, `data-device-time`, atau class `.live-device-clock`
document.addEventListener('DOMContentLoaded', function() {
    updateLiveClock('[data-live-clock]');
    updateLiveClock('.live-device-clock');
    formatAllDeviceTimeElements();
});
