<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<!-- Leaflet CSS & Radar Custom Animations -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<style>
    /* Native CSS 6px border-radius helper */
    .rounded-6 {
        border-radius: 6px !important;
    }

    .rounded-top-6 {
        border-top-left-radius: 6px !important;
        border-top-right-radius: 6px !important;
    }

    .rounded-bottom-6 {
        border-bottom-left-radius: 6px !important;
        border-bottom-right-radius: 6px !important;
    }

    .radar-container {
        position: relative;
        border-radius: 6px !important;
        overflow: hidden;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
        border: 1px solid #cbd5e1;
    }

    #earthquakeMap {
        height: 620px;
        width: 100%;
        background-color: #0f172a;
        border-radius: 6px !important;
    }

    /* Radar Pulsating Marker Wave CSS */
    .radar-marker-pulse {
        position: relative;
        width: 24px;
        height: 24px;
    }

    .radar-center-dot {
        width: 14px;
        height: 14px;
        border-radius: 50%;
        position: absolute;
        top: 5px;
        left: 5px;
        box-shadow: 0 0 10px currentColor;
        z-index: 2;
    }

    .radar-wave {
        position: absolute;
        top: -8px;
        left: -8px;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        border: 2px solid currentColor;
        opacity: 0;
        animation: radarPulse 2s infinite cubic-bezier(0.215, 0.61, 0.355, 1);
    }

    .radar-wave-delay {
        animation-delay: 0.75s;
    }

    @keyframes radarPulse {
        0% {
            transform: scale(0.2);
            opacity: 0.9;
        }

        100% {
            transform: scale(2.2);
            opacity: 0;
        }
    }

    /* Magnitude Color Themes */
    .mag-high {
        color: #ef4444 !important;
        background-color: #ef4444 !important;
    }

    .mag-medium {
        color: #f59e0b !important;
        background-color: #f59e0b !important;
    }

    .mag-low {
        color: #10b981 !important;
        background-color: #10b981 !important;
    }

    .badge-mag-high {
        background-color: #fef2f2;
        color: #dc2626;
        border: 1px solid #fecdd3;
    }

    .badge-mag-medium {
        background-color: #fffbeb;
        color: #d97706;
        border: 1px solid #fde68a;
    }

    .badge-mag-low {
        background-color: #ecfdf5;
        color: #059669;
        border: 1px solid #a7f3d0;
    }

    .earthquake-item {
        transition: all 0.2s ease-in-out;
        cursor: pointer;
        border-left: 4px solid transparent;
    }

    .earthquake-item:hover {
        background-color: #f8fafc;
        border-left-color: #059669;
        transform: translateX(3px);
    }

    .earthquake-item.active {
        background-color: #ecfdf5;
        border-left-color: #047857;
    }

    .glass-radar-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 6px !important;
        border: 1px solid #e2e8f0;
    }

    /* Mobile Responsive Controls (< 768px) */
    @media (max-width: 767.98px) {
        #earthquakeMap {
            height: 420px !important;
        }

        .kpi-icon-box {
            padding: 0.55rem !important;
        }

        .kpi-icon-box i {
            font-size: 1.2rem !important;
        }

        .kpi-card-body {
            padding: 0.75rem !important;
            gap: 0.5rem !important;
        }

        .kpi-val-text {
            font-size: 1.1rem !important;
        }

        .kpi-label-text {
            font-size: 0.68rem !important;
            line-height: 1.15;
        }

        .glass-radar-card {
            max-width: 210px !important;
            padding: 0.65rem !important;
            font-size: 0.72rem !important;
            margin: 0.5rem !important;
        }

        .header-title-text {
            font-size: 1.15rem !important;
        }
    }
</style>

<div class="container-fluid px-0">
    <!-- Header Controls -->
    <div class="row align-items-center mb-4">
        <div class="col-md-7">
            <h4 class="fw-bold text-dark mb-1 d-flex align-items-center gap-2 header-title-text">
                <i class="bi bi-radar text-success fs-3"></i>
                <span>Peta Radar Gempa Dirasakan (BMKG TEWS)</span>
            </h4>
            <p class="text-muted small mb-0">
                Pemantauan aktivitas gempa bumi terdeteksi BMKG secara real-time untuk kewaspadaan dini BPBD (Sumber: BMKG)
            </p>
        </div>
        <div class="col-md-5 text-md-end mt-3 mt-md-0 d-flex align-items-center justify-content-md-end gap-2 flex-wrap">
            <!-- Live Indicator Badge -->
            <span
                class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-3 py-2 rounded-6 fw-semibold small d-inline-flex align-items-center gap-2">
                <span class="spinner-grow spinner-grow-sm text-success" role="status"></span>
                <span id="liveBadgeText">LIVE FEED (Refresh in <span id="countdownSeconds">30</span>s)</span>
            </span>

            <button type="button"
                class="btn btn-outline-success btn-sm rounded-6 px-3 fw-semibold d-inline-flex align-items-center gap-1 shadow-sm"
                id="btnManualRefresh">
                <i class="bi bi-arrow-clockwise" id="refreshSpinner"></i> Refresh Radar
            </button>
        </div>
    </div>

    <!-- Summary KPI Cards (Strict 6px border-radius & Mobile Responsive) -->
    <div class="row g-2 g-md-3 mb-4">
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm rounded-6 h-100 bg-white">
                <div class="card-body p-3 kpi-card-body d-flex align-items-center gap-3">
                    <div class="p-3 kpi-icon-box bg-danger bg-opacity-10 text-danger rounded-6 flex-shrink-0">
                        <i class="bi bi-activity fs-3"></i>
                    </div>
                    <div class="flex-grow-1 overflow-hidden">
                        <div class="text-muted small kpi-label-text fw-semibold">Total Gempa Dirasakan</div>
                        <h4 class="fw-bold text-dark mb-0 text-truncate kpi-val-text" id="statTotalGempa">-</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm rounded-6 h-100 bg-white">
                <div class="card-body p-3 kpi-card-body d-flex align-items-center gap-3">
                    <div class="p-3 kpi-icon-box bg-warning bg-opacity-10 text-warning rounded-6 flex-shrink-0">
                        <i class="bi bi-lightning-charge-fill fs-3"></i>
                    </div>
                    <div class="flex-grow-1 overflow-hidden">
                        <div class="text-muted small kpi-label-text fw-semibold">Magnitudo Terkuat</div>
                        <h4 class="fw-bold text-dark mb-0 text-truncate kpi-val-text" id="statMaxMag">-</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm rounded-6 h-100 bg-white">
                <div class="card-body p-3 kpi-card-body d-flex align-items-center gap-3">
                    <div class="p-3 kpi-icon-box bg-primary bg-opacity-10 text-primary rounded-6 flex-shrink-0">
                        <i class="bi bi-geo-alt-fill fs-3"></i>
                    </div>
                    <div class="flex-grow-1 overflow-hidden">
                        <div class="text-muted small kpi-label-text fw-semibold">Gempa Terakhir</div>
                        <h4 class="fw-bold text-dark mb-0 text-truncate kpi-val-text" id="statLatestWilayah">-</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm rounded-6 h-100 bg-white">
                <div class="card-body p-3 kpi-card-body d-flex align-items-center gap-3">
                    <div class="p-3 kpi-icon-box bg-emerald-100 text-emerald-700 rounded-6 flex-shrink-0">
                        <i class="bi bi-clock-history fs-3"></i>
                    </div>
                    <div class="flex-grow-1 overflow-hidden">
                        <div class="text-muted small kpi-label-text fw-semibold">Waktu Terakhir BMKG</div>
                        <h4 class="fw-bold text-dark mb-0 text-truncate kpi-val-text" id="statLatestTime">-</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content: Interactive Map & Live Sidebar List -->
    <div class="row g-4">
        <!-- Interactive Leaflet Map -->
        <div class="col-lg-8">
            <div class="radar-container bg-dark position-relative rounded-6">
                <div id="earthquakeMap" class="rounded-6"></div>

                <!-- Floating Legend -->
                <div class="position-absolute bottom-0 start-0 m-3 glass-radar-card p-3 shadow-lg rounded-6"
                    style="z-index: 1000; max-width: 260px;">
                    <div class="fw-bold text-dark small mb-2 d-flex align-items-center gap-1">
                        <i class="bi bi-info-circle text-primary"></i> Skala Magnitudo Gempa
                    </div>
                    <div class="d-flex flex-column gap-1 small">
                        <div class="d-flex align-items-center justify-content-between">
                            <span class="d-inline-flex align-items-center gap-1 text-danger fw-semibold">
                                <span class="d-inline-block rounded-circle mag-high"
                                    style="width:10px; height:10px;"></span> &ge; 5.0 SR (Tinggi)
                            </span>
                            <span class="badge badge-mag-high rounded-6 px-2">Bahaya</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                            <span class="d-inline-flex align-items-center gap-1 text-warning fw-semibold">
                                <span class="d-inline-block rounded-circle mag-medium"
                                    style="width:10px; height:10px;"></span> 4.0 - 4.9 SR (Sedang)
                            </span>
                            <span class="badge badge-mag-medium rounded-6 px-2">Waspada</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                            <span class="d-inline-flex align-items-center gap-1 text-success fw-semibold">
                                <span class="d-inline-block rounded-circle mag-low"
                                    style="width:10px; height:10px;"></span> &lt; 4.0 SR (Rendah)
                            </span>
                            <span class="badge badge-mag-low rounded-6 px-2">Kecil</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Live Earthquake List Sidebar -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-6 h-100">
                <div
                    class="card-header bg-white border-bottom py-3 d-flex align-items-center justify-content-between rounded-top-6">
                    <h6 class="fw-bold text-dark mb-0 d-flex align-items-center gap-2">
                        <i class="bi bi-list-stars text-success"></i> Daftar Gempa Dirasakan
                    </h6>
                    <span class="badge bg-secondary rounded-6" id="badgeCountGempa">0 Kejadian</span>
                </div>
                <div class="card-body p-0 rounded-bottom-6" style="max-height: 550px; overflow-y: auto;"
                    id="earthquakeListContainer">
                    <div class="text-center py-5 text-muted">
                        <div class="spinner-border text-success mb-2" role="status"></div>
                        <div class="small fw-semibold">Mengambil data gempa BMKG...</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Detail Gempa -->
<div class="modal fade" id="modalGempaDetail" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-6">
            <div class="modal-header border-0 bg-light rounded-top-6 py-3">
                <h6 class="modal-title fw-bold text-dark d-flex align-items-center gap-2">
                    <i class="bi bi-radar text-danger fs-5"></i> Rincian Kejadian Gempa BMKG
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4" id="modalGempaBody">
                <!-- Dynamic Content -->
            </div>
            <div class="modal-footer border-0 bg-light rounded-bottom-6 justify-content-end py-2 px-3">
                <button type="button" class="btn btn-secondary btn-sm rounded-6 px-3"
                    data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Leaflet JS & Radar Integration Script -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        let map;
        let markersLayer = L.layerGroup();
        let earthquakeData = [];
        let countdownTimer;
        let secondsLeft = 30;

        // Initialize Leaflet Map centered on Indonesia
        function initMap() {
            map = L.map('earthquakeMap', {
                center: [-2.548926, 118.0148634],
                zoom: 5,
                zoomControl: true
            });

            // CartoDB Dark Matter tiles for realistic radar screen aesthetic
            L.tileLayer('https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors &copy; <a href="https://carto.com/attributions">CARTO</a>',
                subdomains: 'abcd',
                maxZoom: 19
            }).addTo(map);

            markersLayer.addTo(map);
        }

        // Create Custom Radar Marker with Animated Pulsating Circles
        function createRadarIcon(mag) {
            let colorClass = 'mag-low';
            if (mag >= 5.0) {
                colorClass = 'mag-high';
            } else if (mag >= 4.0) {
                colorClass = 'mag-medium';
            }

            const html = `
                <div class="radar-marker-pulse ${colorClass}">
                    <div class="radar-center-dot ${colorClass}"></div>
                    <div class="radar-wave ${colorClass}"></div>
                    <div class="radar-wave radar-wave-delay ${colorClass}"></div>
                </div>
            `;

            return L.divIcon({
                html: html,
                className: '',
                iconSize: [24, 24],
                iconAnchor: [12, 12]
            });
        }

        // Render Data to Map & List
        function renderEarthquakes(data) {
            markersLayer.clearLayers();
            const listContainer = document.getElementById('earthquakeListContainer');
            listContainer.innerHTML = '';

            if (!data || data.length === 0) {
                listContainer.innerHTML = `
                    <div class="text-center py-5 text-muted">
                        <i class="bi bi-check-circle fs-1 text-success d-block mb-2"></i>
                        Tidak ada catatan gempa dirasakan terkini.
                    </div>`;
                return;
            }

            // Stats update
            document.getElementById('statTotalGempa').textContent = data.length;
            document.getElementById('badgeCountGempa').textContent = data.length + ' Kejadian';

            let maxMag = 0;
            data.forEach(item => {
                if (item.magnitude > maxMag) maxMag = item.magnitude;
            });
            document.getElementById('statMaxMag').textContent = maxMag > 0 ? maxMag.toFixed(1) + ' SR' : '-';

            const latest = data[0];
            let mainLocation = latest.wilayah ? latest.wilayah : '-';

            // Extract main location name (e.g. "Berau", "Ternate", "Mandailing Natal")
            const kmMatch = mainLocation.match(/km\s+(?:[a-z]+\s+)?(.*)$/i);
            if (kmMatch && kmMatch[1] && kmMatch[1].trim().length > 0) {
                mainLocation = kmMatch[1].trim();
            } else {
                mainLocation = mainLocation.replace(/^Pusat gempa berada (di|didarat)\s*/i, '').trim();
            }

            if (mainLocation && mainLocation.length > 0) {
                mainLocation = mainLocation.charAt(0).toUpperCase() + mainLocation.slice(1);
            }

            const statLatestEl = document.getElementById('statLatestWilayah');
            if (statLatestEl) {
                statLatestEl.textContent = mainLocation || latest.wilayah;
                statLatestEl.title = latest.wilayah;
            }
            document.getElementById('statLatestTime').textContent = latest.jam || '-';

            // Populate Map & Sidebar
            data.forEach((item, index) => {
                // Add Leaflet Marker
                if (item.lat !== 0 && item.lng !== 0) {
                    const marker = L.marker([item.lat, item.lng], {
                        icon: createRadarIcon(item.magnitude)
                    });

                    const popupContent = `
                        <div class="p-2" style="min-width: 220px;">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="badge ${item.magnitude >= 5.0 ? 'bg-danger' : (item.magnitude >= 4.0 ? 'bg-warning text-dark' : 'bg-success')} fw-bold rounded-6">
                                    M ${item.magnitude}
                                </span>
                                <span class="small text-muted">${item.jam}</span>
                            </div>
                            <h6 class="fw-bold mb-1 text-dark">${item.wilayah}</h6>
                            <div class="small text-muted mb-1"><i class="bi bi-arrow-down-circle"></i> Kedalaman: ${item.kedalaman}</div>
                            <div class="small text-muted mb-2"><i class="bi bi-geo-alt"></i> ${item.lintang}, ${item.bujur}</div>
                            <button class="btn btn-sm btn-outline-success w-100 fw-bold rounded-6 btn-detail-gempa" data-index="${index}">
                                Rincian Dampak
                            </button>
                        </div>
                    `;

                    marker.bindPopup(popupContent);
                    markersLayer.addLayer(marker);
                }

                // Add Sidebar Item
                let magBadgeClass = 'badge-mag-low';
                if (item.magnitude >= 5.0) magBadgeClass = 'badge-mag-high';
                else if (item.magnitude >= 4.0) magBadgeClass = 'badge-mag-medium';

                const listEl = document.createElement('div');
                listEl.className = 'earthquake-item p-3 border-bottom';
                listEl.setAttribute('data-index', index);
                listEl.innerHTML = `
                    <div class="d-flex align-items-center justify-content-between mb-1">
                        <span class="badge ${magBadgeClass} fw-bold rounded-6">M ${item.magnitude} SR</span>
                        <span class="small text-muted fw-semibold">${item.jam}</span>
                    </div>
                    <div class="fw-bold text-dark small mb-1 line-clamp-2">${item.wilayah}</div>
                    <div class="d-flex align-items-center justify-content-between text-muted fs-8">
                        <span><i class="bi bi-arrow-down-short"></i> ${item.kedalaman}</span>
                        <span><i class="bi bi-calendar3"></i> ${item.tanggal}</span>
                    </div>
                `;

                listEl.addEventListener('click', function () {
                    document.querySelectorAll('.earthquake-item').forEach(el => el.classList.remove('active'));
                    listEl.classList.add('active');

                    if (item.lat !== 0 && item.lng !== 0) {
                        map.flyTo([item.lat, item.lng], 8, {
                            duration: 1.5
                        });
                    }
                    showDetailModal(item);
                });

                listContainer.appendChild(listEl);
            });

            // Delegate click for popup detail button
            map.on('popupopen', function (e) {
                const btn = e.popup._container.querySelector('.btn-detail-gempa');
                if (btn) {
                    btn.addEventListener('click', function () {
                        const idx = btn.getAttribute('data-index');
                        if (data[idx]) {
                            showDetailModal(data[idx]);
                        }
                    });
                }
            });
        }

        // Show Modal Detail Gempa
        function showDetailModal(item) {
            let magBadgeClass = 'badge-mag-low';
            if (item.magnitude >= 5.0) magBadgeClass = 'badge-mag-high';
            else if (item.magnitude >= 4.0) magBadgeClass = 'badge-mag-medium';

            const modalBody = document.getElementById('modalGempaBody');
            modalBody.innerHTML = `
                <div class="text-center mb-4">
                    <span class="badge ${magBadgeClass} fs-4 px-3 py-2 rounded-6 fw-bold mb-2">
                        Magnitude ${item.magnitude} SR
                    </span>
                    <h5 class="fw-bold text-dark mb-1">${item.wilayah}</h5>
                    <div class="text-muted small"><i class="bi bi-clock me-1"></i> ${item.jam} — ${item.tanggal}</div>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-6">
                        <div class="p-3 bg-light rounded-6 text-center">
                            <div class="text-muted small fw-semibold">Kedalaman</div>
                            <div class="fw-bold text-dark fs-6"><i class="bi bi-arrow-down-circle text-primary me-1"></i> ${item.kedalaman}</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="p-3 bg-light rounded-6 text-center">
                            <div class="text-muted small fw-semibold">Koordinat</div>
                            <div class="fw-bold text-dark fs-6"><i class="bi bi-geo-alt text-danger me-1"></i> ${item.lintang}, ${item.bujur}</div>
                        </div>
                    </div>
                </div>

                <div class="p-3 bg-emerald-50 rounded-6 border border-emerald-100">
                    <div class="fw-bold text-emerald-950 small mb-1"><i class="bi bi-broadcast text-success me-1"></i> Wilayah Dirasakan (MMI):</div>
                    <div class="text-dark small">${item.dirasakan || 'Tidak ada laporan wilayah dirasakan spesifik.'}</div>
                </div>
            `;

            const modal = new bootstrap.Modal(document.getElementById('modalGempaDetail'));
            modal.show();
        }

        // Fetch Live BMKG Data via API Proxy
        function fetchBmkgData() {
            const refreshSpinner = document.getElementById('refreshSpinner');
            if (refreshSpinner) refreshSpinner.classList.add('spin-anim');

            fetch('<?= site_url('/api/earthquake-data') ?>')
                .then(res => res.json())
                .then(res => {
                    if (res.status === 'success' && res.data) {
                        earthquakeData = res.data;
                        renderEarthquakes(earthquakeData);
                    }
                })
                .catch(err => {
                    console.error('Failed fetching BMKG data:', err);
                })
                .finally(() => {
                    if (refreshSpinner) refreshSpinner.classList.remove('spin-anim');
                    resetCountdown();
                });
        }

        // Real-time Countdown Timer (30s)
        function startCountdown() {
            clearInterval(countdownTimer);
            secondsLeft = 30;
            const el = document.getElementById('countdownSeconds');

            countdownTimer = setInterval(() => {
                secondsLeft--;
                if (el) el.textContent = secondsLeft;

                if (secondsLeft <= 0) {
                    fetchBmkgData();
                }
            }, 1000);
        }

        function resetCountdown() {
            secondsLeft = 30;
            startCountdown();
        }

        // Manual Refresh Button Event
        document.getElementById('btnManualRefresh').addEventListener('click', function () {
            fetchBmkgData();
        });

        // Initialize Map & Start Data Fetch
        initMap();
        fetchBmkgData();
    });
</script>
<?= $this->endSection() ?>