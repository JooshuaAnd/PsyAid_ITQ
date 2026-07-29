<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<!-- Leaflet CSS & Radar Custom Animations -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<style>
    .tabular-nums {
        font-variant-numeric: tabular-nums;
        font-feature-settings: "tnum";
    }

    /* Strict Max Rounded 8px (lg) Policy Matching PoskoManagement.php */
    .frost-card,
    .frost-hero,
    .frost-btn-primary,
    .frost-btn-reset,
    .posko-item-card,
    .posko-info-box,
    .posko-details-box,
    .btn,
    .modal-content,
    .badge,
    .form-control,
    .form-select,
    .progress,
    .radar-container,
    #earthquakeMap,
    .glass-radar-card {
        border-radius: 8px !important;
    }

    /* Frosted Glass UI Card System */
    .frost-card {
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.92) 0%, rgba(244, 251, 247, 0.75) 100%);
        backdrop-filter: blur(12px) saturate(160%);
        -webkit-backdrop-filter: blur(12px) saturate(160%);
        border: 1px solid rgba(226, 232, 240, 0.8);
        box-shadow: 0 8px 24px -4px rgba(15, 23, 42, 0.06),
            0 2px 6px -1px rgba(15, 23, 42, 0.02),
            inset 0 1px 1.5px 0 rgba(255, 255, 255, 0.95);
        transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
    }

    /* LIGHT GREEN PSYAID HERO CARD SYSTEM */
    .frost-hero {
        background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 60%, #a7f3d0 100%);
        border: 1.5px solid #a7f3d0;
        color: #064e3b;
        position: relative;
        overflow: hidden;
        box-shadow: 0 10px 30px -4px rgba(16, 185, 129, 0.12),
            inset 0 1.5px 2px rgba(255, 255, 255, 0.85);
    }

    /* LIGHT GREEN BUTTON: PRIMARY ACTION (MATCHING COMMANDCENTER FROST-BTN-POSKO) */
    .frost-btn-primary {
        background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
        color: #065f46 !important;
        border: 1.5px solid #34d399;
        border-radius: 8px !important;
        font-weight: 700;
        font-size: 0.8125rem;
        padding: 0.45rem 0.95rem;
        transition: all 0.2s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        box-shadow: 0 2px 6px rgba(16, 185, 129, 0.15);
        cursor: pointer;
    }

    .frost-btn-primary:hover {
        background: linear-gradient(135deg, #a7f3d0 0%, #6ee7b7 100%);
        color: #064e3b !important;
        border-color: #10b981;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.25);
        transform: translateY(-1px);
    }

    /* INNER POSKO ITEM CARD: SOFT MINT & PURE WHITE DISTINCT SURFACE */
    .posko-item-card {
        background: #ffffff !important;
        border: 1.5px solid #d1fae5 !important;
        border-radius: 8px !important;
        box-shadow: 0 4px 12px -2px rgba(16, 185, 129, 0.08), 0 2px 5px -1px rgba(15, 23, 42, 0.04) !important;
        transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1) !important;
    }

    .posko-item-card:hover {
        background: #ffffff !important;
        border-color: #34d399 !important;
        box-shadow: 0 12px 28px -4px rgba(16, 185, 129, 0.18), 0 4px 10px -2px rgba(15, 23, 42, 0.04) !important;
        transform: translateY(-2px) !important;
    }

    .badge-status-aktif {
        background-color: #059669 !important;
        color: #ffffff !important;
        font-weight: 700 !important;
        font-size: 0.75rem !important;
        padding: 0.35rem 0.65rem !important;
    }

    .radar-container {
        position: relative;
        border-radius: 8px !important;
        overflow: hidden;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
        border: 1.5px solid #cbd5e1;
    }

    #earthquakeMap {
        height: 620px;
        width: 100%;
        background-color: #0f172a;
        border-radius: 8px !important;
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
        background-color: #fef2f2 !important;
        color: #dc2626 !important;
        border: 1px solid #fecdd3 !important;
        font-weight: 700 !important;
    }

    .badge-mag-medium {
        background-color: #fffbeb !important;
        color: #d97706 !important;
        border: 1px solid #fde68a !important;
        font-weight: 700 !important;
    }

    .badge-mag-low {
        background-color: #ecfdf5 !important;
        color: #047857 !important;
        border: 1px solid #a7f3d0 !important;
        font-weight: 700 !important;
    }

    .earthquake-item {
        transition: all 0.2s ease-in-out;
        cursor: pointer;
        border: 1.5px solid #e2e8f0 !important;
        border-radius: 8px !important;
        margin-bottom: 8px;
        background-color: #ffffff;
    }

    .earthquake-item:hover {
        background-color: #f4fbf7 !important;
        border-color: #34d399 !important;
        box-shadow: 0 2px 8px rgba(16, 185, 129, 0.15) !important;
    }

    .earthquake-item.active {
        background-color: #ecfdf5 !important;
        border-color: #059669 !important;
        box-shadow: 0 2px 8px rgba(16, 185, 129, 0.20) !important;
    }

    .glass-radar-card {
        background: rgba(255, 255, 255, 0.96);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border-radius: 8px !important;
        border: 1.5px solid #d1fae5;
        box-shadow: 0 8px 24px -4px rgba(15, 23, 42, 0.12);
    }

    @keyframes spin {
        100% {
            transform: rotate(360deg);
        }
    }

    .spin-anim {
        animation: spin 1s linear infinite;
        display: inline-block;
    }

    .fs-7 {
        font-size: 0.8125rem;
    }

    .fs-8 {
        font-size: 0.75rem;
    }

    .fs-9 {
        font-size: 0.6875rem;
    }

    /* Mobile Responsive Controls (< 768px) */
    @media (max-width: 767.98px) {
        #earthquakeMap {
            height: 360px !important;
        }

        #earthquakeListContainer {
            max-height: 380px !important;
            padding: 0.25rem !important;
        }

        .earthquake-item {
            padding: 0.7rem 0.85rem !important;
            margin-bottom: 6px !important;
        }

        .glass-radar-card {
            max-width: 190px !important;
            padding: 0.5rem 0.65rem !important;
            font-size: 0.7rem !important;
            margin: 0.4rem !important;
            box-shadow: 0 4px 12px rgba(15, 23, 42, 0.15) !important;
        }
    }
</style>

<div class="container-fluid px-0">

    <!-- 1. Hero Header Card (Matching PoskoManagement.php) -->
    <div class="card frost-hero mb-4">
        <div class="card-body p-4 position-relative">
            <div class="row align-items-center g-3">
                <div class="col-12 col-lg-7">
                    <div class="d-flex align-items-center gap-2 mb-2 flex-wrap">
                        <span class="badge px-3 py-1.5 fs-8 fw-bold"
                            style="background-color: rgba(6, 95, 70, 0.12); color: #065f46; border: 1px solid rgba(6, 95, 70, 0.25);">
                            <i class="bi bi-radar me-1"></i> BMKG TEWS RADAR SYSTEM
                        </span>
                        <span class="badge px-3 py-1.5 fs-8"
                            style="background-color: rgba(6, 95, 70, 0.08); color: #047857; border: 1px solid rgba(6, 95, 70, 0.18);">
                            BPBD Radar Panel
                        </span>
                    </div>
                    <h3 class="fw-bold mb-1" style="color: #064e3b;">
                        <i class="bi bi-geo-alt-fill me-2" style="color: #059669;"></i> Peta Radar Gempa Dirasakan (BMKG
                        TEWS)
                    </h3>
                    <p class="small mb-0" style="color: #047857; max-width: 75ch;">
                        Pemantauan aktivitas gempa bumi terdeteksi BMKG secara real-time untuk kewaspadaan dini BPBD.
                        Data terhubung langsung melalui API resmi BMKG Indonesia.
                    </p>
                </div>
                <div class="col-12 col-lg-5 d-flex align-items-center justify-content-lg-end gap-2 flex-wrap">
                    <!-- Live Indicator Badge -->
                    <span class="badge px-3 py-2 fs-8 fw-bold d-inline-flex align-items-center gap-2"
                        style="background-color: rgba(6, 95, 70, 0.12); color: #065f46; border: 1px solid rgba(6, 95, 70, 0.25);">
                        <span class="spinner-grow spinner-grow-sm text-success" role="status"></span>
                        <span id="liveBadgeText">LIVE FEED (Refresh in <span id="countdownSeconds">30</span>s)</span>
                    </span>

                    <button type="button" class="frost-btn-primary" id="btnManualRefresh">
                        <i class="bi bi-arrow-clockwise" id="refreshSpinner"></i> Refresh Radar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- 2. Summary KPI Cards (Refined Clean Layout Matching CommandCenter.php) -->
    <div class="row g-3 mb-4">
        <div class="col-6 col-md-3">
            <div class="card posko-item-card p-3 p-md-3.5 h-100">
                <div class="text-secondary fs-8 fw-bold text-uppercase" style="letter-spacing: 0.03em;">Total Gempa
                    Dirasakan</div>
                <hr class="my-2 opacity-25" style="color: #059669;" />
                <div class="fs-3 fw-bold mb-1 text-truncate tabular-nums" style="color: #064e3b;" id="statTotalGempa">-
                </div>
                <div class="fs-9 text-muted fw-semibold">Kejadian BMKG</div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card posko-item-card p-3 p-md-3.5 h-100">
                <div class="text-secondary fs-8 fw-bold text-uppercase" style="letter-spacing: 0.03em;">Magnitudo
                    Terkuat</div>
                <hr class="my-2 opacity-25" style="color: #059669;" />
                <div class="fs-3 fw-bold mb-1 text-truncate tabular-nums" style="color: #064e3b;" id="statMaxMag">-
                </div>
                <div class="fs-9 text-muted fw-semibold">Skala Richter (SR)</div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card posko-item-card p-3 p-md-3.5 h-100">
                <div class="text-secondary fs-8 fw-bold text-uppercase" style="letter-spacing: 0.03em;">Gempa Terakhir
                </div>
                <hr class="my-2 opacity-25" style="color: #059669;" />
                <div class="fs-3 fw-bold mb-1 text-truncate" style="color: #064e3b;" id="statLatestWilayah">-</div>
                <div class="fs-9 text-muted fw-semibold text-truncate">Lokasi Kejadian</div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card posko-item-card p-3 p-md-3.5 h-100">
                <div class="text-secondary fs-8 fw-bold text-uppercase" style="letter-spacing: 0.03em;">Waktu Terakhir
                    BMKG</div>
                <hr class="my-2 opacity-25" style="color: #059669;" />
                <div class="fs-3 fw-bold mb-1 text-truncate tabular-nums" style="color: #064e3b;" id="statLatestTime">-
                </div>
                <div class="fs-9 text-muted fw-semibold">Waktu WIB / UTC+7</div>
            </div>
        </div>
    </div>

    <!-- 3. Main Content: Interactive Map & Live Sidebar List -->
    <div class="row g-4 mb-5">
        <!-- Interactive Leaflet Map -->
        <div class="col-12 col-lg-8">
            <div class="card frost-card p-3 p-md-4 h-100">
                <div class="d-flex align-items-center justify-content-between mb-3 border-bottom pb-3 gap-2">
                    <div class="d-flex align-items-center gap-2 min-w-0">
                        <i class="bi bi-geo-alt-fill text-success fs-5 flex-shrink-0"></i>
                        <h6 class="fw-bold mb-0 text-truncate" style="color: #064e3b; font-size: 0.9375rem;">Peta Spasial Gempa BMKG</h6>
                    </div>
                    <span class="badge px-2.5 py-1 fs-8 flex-shrink-0 d-none d-md-inline-flex align-items-center"
                        style="background-color: rgba(6, 95, 70, 0.08); color: #047857; border: 1px solid rgba(6, 95, 70, 0.18); font-weight: 700; border-radius: 8px !important;">
                        <i class="bi bi-layers-fill me-1"></i> Live CartoDB Map
                    </span>
                </div>
                <div class="radar-container bg-dark position-relative" style="border-radius: 8px !important;">
                    <div id="earthquakeMap" style="border-radius: 8px !important;"></div>

                    <!-- Floating Glass Legend -->
                    <div class="position-absolute bottom-0 start-0 m-3 glass-radar-card p-3 shadow-lg"
                        style="z-index: 1000; max-width: 260px; border-radius: 8px !important;">
                        <div class="fw-bold text-dark small mb-2 d-flex align-items-center gap-1">
                            <i class="bi bi-info-circle text-primary me-1"></i> Skala Magnitudo Gempa
                        </div>
                        <div class="d-flex flex-column gap-1.5 small">
                            <div class="d-flex align-items-center justify-content-between">
                                <span class="d-inline-flex align-items-center gap-1 text-danger fw-semibold">
                                    <span class="d-inline-block rounded-circle mag-high"
                                        style="width:10px; height:10px;"></span> &ge; 5.0 SR (Tinggi)
                                </span>
                                <span class="badge badge-mag-high px-2"
                                    style="border-radius: 8px !important;">Bahaya</span>
                            </div>
                            <div class="d-flex align-items-center justify-content-between">
                                <span class="d-inline-flex align-items-center gap-1 text-warning fw-semibold">
                                    <span class="d-inline-block rounded-circle mag-medium"
                                        style="width:10px; height:10px;"></span> 4.0 - 4.9 SR (Sedang)
                                </span>
                                <span class="badge badge-mag-medium px-2"
                                    style="border-radius: 8px !important;">Waspada</span>
                            </div>
                            <div class="d-flex align-items-center justify-content-between">
                                <span class="d-inline-flex align-items-center gap-1 text-success fw-semibold">
                                    <span class="d-inline-block rounded-circle mag-low"
                                        style="width:10px; height:10px;"></span> &lt; 4.0 SR (Rendah)
                                </span>
                                <span class="badge badge-mag-low px-2"
                                    style="border-radius: 8px !important;">Kecil</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Live Earthquake List Sidebar -->
        <div class="col-12 col-lg-4">
            <div class="card frost-card p-3 p-md-4 h-100 overflow-hidden">
                <div class="d-flex align-items-center justify-content-between mb-3 border-bottom pb-3 gap-2">
                    <div class="d-flex align-items-center gap-2 min-w-0">
                        <i class="bi bi-list-stars text-success fs-5 flex-shrink-0"></i>
                        <h6 class="fw-bold mb-0 text-truncate" style="color: #064e3b; font-size: 0.9375rem;">Gempa Dirasakan</h6>
                    </div>
                    <span class="badge px-2.5 py-1 fs-8 flex-shrink-0" id="badgeCountGempa"
                        style="background-color: rgba(6, 95, 70, 0.08); color: #047857; border: 1px solid rgba(6, 95, 70, 0.18); font-weight: 700; border-radius: 8px !important;">0
                        Kejadian</span>
                </div>
                <div class="p-1.5 overflow-y-auto" style="max-height: 570px; border-radius: 8px !important;"
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
        <div class="modal-content border-0 shadow-lg" style="border-radius: 8px !important;">
            <div class="modal-header border-bottom p-4"
                style="background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 100%);">
                <h6 class="modal-title fw-bold text-dark d-flex align-items-center gap-2"
                    style="color: #064e3b !important;">
                    <i class="bi bi-radar text-success fs-5"></i> Rincian Kejadian Gempa BMKG
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4" id="modalGempaBody">
                <!-- Dynamic Content -->
            </div>
            <div class="modal-footer border-top bg-light justify-content-end py-2.5 px-3"
                style="border-radius: 0 0 8px 8px !important;">
                <button type="button" class="btn btn-light border fw-semibold fs-8"
                    style="border-radius: 8px !important;" data-bs-dismiss="modal">Tutup</button>
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
                                <span class="badge ${item.magnitude >= 5.0 ? 'bg-danger' : (item.magnitude >= 4.0 ? 'bg-warning text-dark' : 'bg-success')} fw-bold" style="border-radius: 8px !important;">
                                    M ${item.magnitude}
                                </span>
                                <span class="small text-muted">${item.jam}</span>
                            </div>
                            <h6 class="fw-bold mb-1 text-dark">${item.wilayah}</h6>
                            <div class="small text-muted mb-1"><i class="bi bi-arrow-down-circle"></i> Kedalaman: ${item.kedalaman}</div>
                            <div class="small text-muted mb-2"><i class="bi bi-geo-alt"></i> ${item.lintang}, ${item.bujur}</div>
                            <button class="frost-btn-primary w-100 justify-content-center btn-detail-gempa" data-index="${index}">
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
                listEl.className = 'earthquake-item p-3';
                listEl.setAttribute('data-index', index);
                listEl.innerHTML = `
                    <div class="d-flex align-items-center justify-content-between mb-1">
                        <span class="badge ${magBadgeClass} fw-bold" style="border-radius: 8px !important;">M ${item.magnitude} SR</span>
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
                    <span class="badge ${magBadgeClass} fs-4 px-3 py-2 fw-bold mb-2" style="border-radius: 8px !important;">
                        Magnitude ${item.magnitude} SR
                    </span>
                    <h5 class="fw-bold text-dark mb-1">${item.wilayah}</h5>
                    <div class="text-muted small"><i class="bi bi-clock me-1"></i> ${item.jam} — ${item.tanggal}</div>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-6">
                        <div class="p-3 bg-light text-center" style="border-radius: 8px !important; border: 1px solid #e2e8f0;">
                            <div class="text-muted small fw-semibold">Kedalaman</div>
                            <div class="fw-bold text-dark fs-6"><i class="bi bi-arrow-down-circle text-primary me-1"></i> ${item.kedalaman}</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="p-3 bg-light text-center" style="border-radius: 8px !important; border: 1px solid #e2e8f0;">
                            <div class="text-muted small fw-semibold">Koordinat</div>
                            <div class="fw-bold text-dark fs-6"><i class="bi bi-geo-alt text-danger me-1"></i> ${item.lintang}, ${item.bujur}</div>
                        </div>
                    </div>
                </div>

                <div class="p-3 bg-emerald-50 border border-emerald-100" style="border-radius: 8px !important;">
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