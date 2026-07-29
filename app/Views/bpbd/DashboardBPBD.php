<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<!-- Swiper 11 CSS & JS CDN -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<!-- Frosted Glass UI Custom Styling & PsyAid Theme -->
<style>
    .tabular-nums {
        font-variant-numeric: tabular-nums;
        font-feature-settings: "tnum";
    }

    /* Custom Utility Font Sizes for Micro-Typography */
    .fs-8 {
        font-size: 0.75rem !important; /* 12px */
    }

    .fs-9 {
        font-size: 0.6875rem !important; /* 11px */
    }

    .metric-card-title {
        font-size: 0.72rem !important;
        font-weight: 700 !important;
        text-transform: uppercase !important;
        letter-spacing: 0.03em !important;
        color: #64748b !important;
    }

    /* Authentic Frosted Glass UI Card System - Compact Rounded LG Styling */
    .frost-card {
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.88) 0%, rgba(244, 251, 247, 0.65) 100%);
        backdrop-filter: blur(14px) saturate(160%);
        -webkit-backdrop-filter: blur(14px) saturate(160%);
        border: 1px solid rgba(255, 255, 255, 0.85);
        border-radius: 12px !important;
        box-shadow: 0 8px 24px -4px rgba(15, 23, 42, 0.06),
            0 2px 6px -1px rgba(15, 23, 42, 0.02);
        transition: all 0.25s ease;
    }

    .frost-card:hover {
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.98) 0%, rgba(236, 253, 245, 0.8) 100%);
        border-color: rgba(16, 185, 129, 0.4);
        box-shadow: 0 14px 32px -4px rgba(16, 185, 129, 0.12);
        transform: translateY(-2px);
    }

    /* LIGHT GREEN PSYAID HERO CARD SYSTEM */
    .frost-hero {
        background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 60%, #a7f3d0 100%);
        border: 1.5px solid #a7f3d0;
        border-radius: 12px !important;
        box-shadow: 0 10px 30px -5px rgba(16, 185, 129, 0.15);
    }

    /* Swiper Container & Pagination Controls */
    .bpbd-swiper-container {
        width: 100%;
        position: relative;
        padding-bottom: 2.5rem !important;
        overflow: hidden;
    }

    .bpbd-swiper-slide {
        height: auto;
        background: transparent !important;
    }

    /* Individual Swiper Slide Frosted Glass UI Card Styling - Compact Rounded-LG */
    .frost-card-slide {
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.92) 0%, rgba(244, 251, 247, 0.75) 100%) !important;
        backdrop-filter: blur(16px) saturate(180%) !important;
        -webkit-backdrop-filter: blur(16px) saturate(180%) !important;
        border: 1.5px solid rgba(255, 255, 255, 0.95) !important;
        border-radius: 14px !important;
        padding: 1.5rem 3.75rem !important; /* 60px horizontal padding pushes content safely towards center */
        box-shadow: 0 8px 24px -4px rgba(15, 23, 42, 0.06), 0 2px 6px -1px rgba(15, 23, 42, 0.02) !important;
        transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1) !important;
        overflow: hidden !important;
        position: relative;
    }

    .frost-card-slide:hover {
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.98) 0%, rgba(236, 253, 245, 0.85) 100%) !important;
        border-color: rgba(16, 185, 129, 0.4) !important;
        box-shadow: 0 12px 28px -4px rgba(16, 185, 129, 0.14) !important;
    }

    @media (max-width: 767.98px) {
        .frost-card-slide {
            padding: 1.25rem 1.25rem !important;
        }
    }

    /* Soft PsyAid Color Palette Metric Pill Boxes */
    .metric-pill-box {
        min-width: 92px;
        padding: 0.55rem 0.85rem;
        border-radius: 12px !important;
        transition: all 0.2s ease;
    }

    /* Soft Rose / Coral (High Risk / Emergency) */
    .pill-soft-rose {
        background: rgba(244, 63, 94, 0.08) !important;
        border: 1px solid rgba(244, 63, 94, 0.2) !important;
        color: #e11d48 !important;
    }

    /* Soft Amber / Sand (Medium Risk / Warning / BMKG) */
    .pill-soft-amber {
        background: rgba(245, 158, 11, 0.08) !important;
        border: 1px solid rgba(245, 158, 11, 0.2) !important;
        color: #d97706 !important;
    }

    /* Soft Emerald / Mint (Low Risk / Success / Online) */
    .pill-soft-emerald {
        background: rgba(16, 185, 129, 0.08) !important;
        border: 1px solid rgba(16, 185, 129, 0.2) !important;
        color: #059669 !important;
    }

    /* Soft Indigo / Purple (Volunteer / Review / Ready) */
    .pill-soft-indigo {
        background: rgba(99, 102, 241, 0.08) !important;
        border: 1px solid rgba(99, 102, 241, 0.2) !important;
        color: #4f46e5 !important;
    }

    /* Soft Sky / Cyan (Psikolog / Field Personel) */
    .pill-soft-sky {
        background: rgba(14, 165, 233, 0.08) !important;
        border: 1px solid rgba(14, 165, 233, 0.2) !important;
        color: #0284c7 !important;
    }

    /* Soft Executive Slider Action Buttons (Distinct from Metric Pills) */
    .btn-slide-soft-crimson {
        background: linear-gradient(135deg, #fff1f2 0%, #ffe4e6 100%) !important;
        border: 1.5px solid #fecdd3 !important;
        color: #9f1239 !important;
        transition: all 0.22s ease !important;
    }
    .btn-slide-soft-crimson:hover {
        background: linear-gradient(135deg, #ffe4e6 0%, #fecdd3 100%) !important;
        border-color: #fda4af !important;
        color: #881337 !important;
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(225, 29, 72, 0.15) !important;
    }

    .btn-slide-soft-violet {
        background: linear-gradient(135deg, #f5f3ff 0%, #ede9fe 100%) !important;
        border: 1.5px solid #ddd6fe !important;
        color: #5b21b6 !important;
        transition: all 0.22s ease !important;
    }
    .btn-slide-soft-violet:hover {
        background: linear-gradient(135deg, #ede9fe 0%, #ddd6fe 100%) !important;
        border-color: #c4b5fd !important;
        color: #4c1d95 !important;
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(91, 33, 182, 0.15) !important;
    }

    .btn-slide-soft-teal {
        background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%) !important;
        border: 1.5px solid #bbf7d0 !important;
        color: #14532d !important;
        transition: all 0.22s ease !important;
    }
    .btn-slide-soft-teal:hover {
        background: linear-gradient(135deg, #dcfce7 0%, #bbf7d0 100%) !important;
        border-color: #86efac !important;
        color: #14532d !important;
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(20, 83, 45, 0.15) !important;
    }

    .btn-slide-soft-amber {
        background: linear-gradient(135deg, #fffbeb 0%, #fef3c7 100%) !important;
        border: 1.5px solid #fde68a !important;
        color: #78350f !important;
        transition: all 0.22s ease !important;
    }
    .btn-slide-soft-amber:hover {
        background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%) !important;
        border-color: #fcd34d !important;
        color: #451a03 !important;
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(120, 53, 15, 0.15) !important;
    }

    .btn-slide-soft-plum {
        background: linear-gradient(135deg, #faf5ff 0%, #f3e8ff 100%) !important;
        border: 1.5px solid #e9d5ff !important;
        color: #581c87 !important;
        transition: all 0.22s ease !important;
    }
    .btn-slide-soft-plum:hover {
        background: linear-gradient(135deg, #f3e8ff 0%, #e9d5ff 100%) !important;
        border-color: #d8b4fe !important;
        color: #3b0764 !important;
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(88, 28, 135, 0.15) !important;
    }

    /* Swiper Navigation Buttons Positioning Perfectly Vertically Centered Relative to Card (Desktop & Mobile) */
    .bpbd-swiper-container .swiper-button-next {
        right: 12px !important;
    }

    .bpbd-swiper-container .swiper-button-prev {
        left: 12px !important;
    }

    .bpbd-swiper-container .swiper-pagination {
        bottom: 0px !important;
    }

    .bpbd-swiper-container .swiper-pagination-bullet {
        width: 10px;
        height: 10px;
        background: #cbd5e1;
        opacity: 0.7;
        transition: all 0.3s ease;
    }

    .bpbd-swiper-container .swiper-pagination-bullet-active {
        width: 26px;
        border-radius: 6px;
        background: #059669 !important;
        opacity: 1;
    }

    .bpbd-swiper-container .swiper-button-next,
    .bpbd-swiper-container .swiper-button-prev {
        width: 38px;
        height: 38px;
        background: #ffffff;
        border: 1.5px solid #a7f3d0;
        border-radius: 50%;
        color: #047857;
        box-shadow: 0 4px 14px rgba(15, 23, 42, 0.12);
        transition: all 0.2s ease;
        top: calc(50% - 1.25rem) !important;
        transform: translateY(-50%) !important;
        margin-top: 0 !important;
        z-index: 10 !important;
    }

    .bpbd-swiper-container .swiper-button-next::after,
    .bpbd-swiper-container .swiper-button-prev::after {
        font-size: 0.85rem !important;
        font-weight: 800;
    }

    .bpbd-swiper-container .swiper-button-next:hover,
    .bpbd-swiper-container .swiper-button-prev:hover {
        background: #ecfdf5;
        color: #064e3b;
        transform: translateY(-50%) scale(1.1) !important;
    }

    @media (max-width: 767.98px) {
        .bpbd-swiper-container .swiper-button-next {
            right: 6px !important;
        }

        .bpbd-swiper-container .swiper-button-prev {
            left: 6px !important;
        }

        .bpbd-swiper-container .swiper-button-next,
        .bpbd-swiper-container .swiper-button-prev {
            width: 34px;
            height: 34px;
            top: calc(50% - 1.25rem) !important;
            transform: translateY(-50%) !important;
        }
    }

    /* Quick Access Action Tiles */
    .quick-action-tile {
        display: flex;
        align-items: center;
        padding: 1.1rem 1.25rem;
        background: #ffffff;
        border: 1.5px solid #e8f3ec;
        border-radius: 12px !important;
        text-decoration: none;
        color: #1e293b;
        transition: all 0.22s ease;
        box-shadow: 0 4px 14px rgba(15, 23, 42, 0.03);
    }

    .quick-action-tile:hover {
        background: #f0fdf4;
        border-color: #34d399;
        color: #064e3b;
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(16, 185, 129, 0.15);
    }

    .quick-action-icon {
        width: 44px;
        height: 44px;
        border-radius: 10px !important;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.35rem;
        flex-shrink: 0;
        margin-right: 1rem;
    }
</style>

<!-- 1. Hero Welcome Header Banner -->
<div class="card frost-hero mb-4">
    <div class="card-body p-4 position-relative">
        <div class="row align-items-center g-3">
            <div class="col-12 col-lg-8">
                <div class="d-flex align-items-center gap-2 mb-2 flex-wrap">
                    <span class="badge px-3 py-1.5 fs-8 fw-bold rounded-lg"
                        style="background-color: rgba(6, 95, 70, 0.12); color: #065f46; border: 1px solid rgba(6, 95, 70, 0.25);">
                        <i class="bi bi-shield-fill-check me-1"></i> Executive Dashboard BPBD
                    </span>
                    <span class="badge px-3 py-1.5 fs-8 fw-bold rounded-lg"
                        style="background-color: rgba(6, 95, 70, 0.08); color: #047857; border: 1px solid rgba(6, 95, 70, 0.18);">
                        <i class="bi bi-broadcast me-1 text-success"></i> Real Time Data Sync
                    </span>
                </div>
                <h3 class="fw-bold mb-1" style="color: #064e3b;">
                    Selamat Datang, Admin BPBD Command Center
                </h3>
                <p class="small mb-0" style="color: #047857; max-width: 75ch;">
                    Pusat kendali eksekutif penanggulangan bencana, monitoring triase kesehatan mental penyintas (AI Assessment), dan manajemen kesiapsiagaan personel posko nasional.
                </p>
            </div>
            <div class="col-12 col-lg-4 text-lg-end">
                <span
                    class="badge px-3 py-2 fs-8 fw-bold live-device-clock text-uppercase d-inline-flex align-items-center gap-2 rounded-lg"
                    data-live-clock
                    style="background-color: rgba(6, 95, 70, 0.1); color: #065f46; border: 1px solid rgba(6, 95, 70, 0.22);">
                    <i class="bi bi-clock-history me-2" style="color: #059669; font-size: 0.85rem;"></i>
                    <span class="time-text"></span>
                </span>
            </div>
        </div>
    </div>
</div>

<!-- 2. BPBD Executive Dynamic Swiper Cards Carousel (Auto-playing every 4s) -->
<div class="mb-4">
    <div class="d-flex align-items-center justify-content-between mb-3 px-1">
        <h6 class="fw-bold text-dark mb-0 d-flex align-items-center gap-2">
            <span class="d-inline-block rounded-circle bg-success bg-opacity-10 p-1.5 text-success">
                <i class="bi bi-arrow-repeat fs-6"></i>
            </span>
            Ringkasan Eksekutif BPBD
        </h6>
    </div>

    <!-- Swiper Container -->
    <div class="swiper bpbdSwiper bpbd-swiper-container">
        <div class="swiper-wrapper">
            <!-- Slide 1: Hotspot Bencana Prioritas Emergency -->
            <div class="swiper-slide bpbd-swiper-slide">
                <div class="frost-card-slide">
                    <div class="row align-items-center g-3">
                        <div class="col-12 col-lg-7">
                            <div class="d-flex align-items-center mb-3 flex-wrap">
                                <span class="badge pill-soft-rose fw-bold px-3 py-2 fs-8 rounded-lg me-3">
                                    HOTSPOT PRIORITAS OPERASIONAL
                                </span>
                                <span class="badge bg-white text-dark border px-3 py-2 fs-8 rounded-lg shadow-xs">
                                    <?= esc($highestPriorityPosko['jenis_bencana'] ?? 'Bencana Alam') ?>
                                </span>
                            </div>
                            <h5 class="fw-bold mb-1" style="color: #064e3b;">
                                <?= esc($highestPriorityPosko['posko_name'] ?? 'Posko Bencana Utama') ?>
                            </h5>
                            <p class="small text-muted mb-0 d-flex align-items-center gap-1">
                                <i class="bi bi-geo-alt-fill text-danger"></i>
                                <span><?= esc($highestPriorityPosko['regency_name'] ?? '-') ?>, <?= esc($highestPriorityPosko['province_name'] ?? '-') ?></span>
                            </p>
                        </div>
                        <div class="col-12 col-lg-5 text-lg-end">
                            <div class="d-flex align-items-center justify-content-start justify-content-lg-end gap-3 mb-3 flex-wrap">
                                <div class="metric-pill-box pill-soft-rose text-center flex-fill flex-lg-grow-0">
                                    <div class="fs-5 fw-extrabold tabular-nums"><?= $highestPriorityPosko['high_risk_count'] ?? 0 ?></div>
                                    <div class="fs-9 fw-bold text-uppercase opacity-75">High Risk</div>
                                </div>
                                <div class="metric-pill-box pill-soft-amber text-center flex-fill flex-lg-grow-0">
                                    <div class="fs-5 fw-extrabold tabular-nums"><?= $highestPriorityPosko['medium_risk_count'] ?? 0 ?></div>
                                    <div class="fs-9 fw-bold text-uppercase opacity-75">Med Risk</div>
                                </div>
                                <div class="metric-pill-box pill-soft-emerald text-center flex-fill flex-lg-grow-0">
                                    <div class="fs-5 fw-extrabold tabular-nums"><?= $highestPriorityPosko['total_korban'] ?? 0 ?></div>
                                    <div class="fs-9 fw-bold text-uppercase opacity-75">Penyintas</div>
                                </div>
                            </div>
                            <a href="<?= site_url('/posko/' . ($highestPriorityPosko['id'] ?? 1)) ?>" class="btn btn-slide-soft-crimson fw-bold rounded-lg px-4 py-2 shadow-sm d-inline-flex align-items-center justify-content-center gap-2">
                                <i class="bi bi-box-arrow-up-right"></i>
                                <span>Buka Posko Prioritas Ini</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Slide 2: Ringkasan Triase AI & Skrining Mental Penyintas -->
            <div class="swiper-slide bpbd-swiper-slide">
                <div class="frost-card-slide">
                    <div class="row align-items-center g-3">
                        <div class="col-12 col-lg-7">
                            <div class="d-flex align-items-center mb-3 flex-wrap">
                                <span class="badge pill-soft-indigo fw-bold px-3 py-2 fs-8 rounded-lg me-3">
                                    AI ASSESSMENT SUMMARY
                                </span>
                                <span class="badge bg-white text-primary border border-primary border-opacity-25 px-3 py-2 fs-8 rounded-lg shadow-xs">
                                    <?= number_format($stats['total_korban'] ?? 0) ?> Total Penyintas
                                </span>
                            </div>
                            <h5 class="fw-bold mb-1" style="color: #064e3b;">
                                Progress Skrining & Risk Assessment AI
                            </h5>
                            <p class="small text-muted mb-0">
                                Evaluasi otomatis tingkat trauma psikologis penyintas pasca bencana oleh sistem AI PsyAid.
                            </p>
                        </div>
                        <div class="col-12 col-lg-5 text-lg-end">
                            <div class="d-flex align-items-center justify-content-start justify-content-lg-end gap-3 mb-3 flex-wrap">
                                <div class="metric-pill-box pill-soft-rose text-center flex-fill flex-lg-grow-0">
                                    <div class="fs-5 fw-extrabold tabular-nums"><?= number_format($stats['risk_high'] ?? 0) ?></div>
                                    <div class="fs-9 fw-bold text-uppercase opacity-75">High Risk</div>
                                </div>
                                <div class="metric-pill-box pill-soft-amber text-center flex-fill flex-lg-grow-0">
                                    <div class="fs-5 fw-extrabold tabular-nums"><?= number_format($stats['risk_medium'] ?? 0) ?></div>
                                    <div class="fs-9 fw-bold text-uppercase opacity-75">Med Risk</div>
                                </div>
                                <div class="metric-pill-box pill-soft-emerald text-center flex-fill flex-lg-grow-0">
                                    <div class="fs-5 fw-extrabold tabular-nums"><?= number_format($stats['risk_low'] ?? 0) ?></div>
                                    <div class="fs-9 fw-bold text-uppercase opacity-75">Low Risk</div>
                                </div>
                            </div>
                            <a href="<?= site_url('/psychologist-mapping') ?>" class="btn btn-slide-soft-violet fw-bold rounded-lg px-4 py-2 shadow-sm d-inline-flex align-items-center justify-content-center gap-2">
                                <i class="bi bi-diagram-3-fill"></i>
                                <span>Lihat Pemetaan Psikolog</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Slide 3: Kesiapsiagaan Posko & Personel Lapangan -->
            <div class="swiper-slide bpbd-swiper-slide">
                <div class="frost-card-slide">
                    <div class="row align-items-center g-3">
                        <div class="col-12 col-lg-7">
                            <div class="d-flex align-items-center mb-3 flex-wrap">
                                <span class="badge pill-soft-emerald fw-bold px-3 py-2 fs-8 rounded-lg me-3">
                                    POSKO & PERSONEL DISPATCH
                                </span>
                                <span class="badge bg-white text-success border border-success border-opacity-25 px-3 py-2 fs-8 rounded-lg shadow-xs">
                                    <?= count($poskoList) ?> Posko Terdaftar
                                </span>
                            </div>
                            <h5 class="fw-bold mb-1" style="color: #064e3b;">
                                Mobilisasi Kesiapsiagaan Tim Lapangan
                            </h5>
                            <p class="small text-muted mb-0">
                                Distribusi relawan posko dan tim psikolog klinis pendamping penyintas di setiap posko bencana.
                            </p>
                        </div>
                        <div class="col-12 col-lg-5 text-lg-end">
                            <div class="d-flex align-items-center justify-content-start justify-content-lg-end gap-3 mb-3 flex-wrap">
                                <div class="metric-pill-box pill-soft-emerald text-center flex-fill flex-lg-grow-0">
                                    <div class="fs-5 fw-extrabold tabular-nums"><?= count($poskoList) ?></div>
                                    <div class="fs-9 fw-bold text-uppercase opacity-75">Posko</div>
                                </div>
                                <div class="metric-pill-box pill-soft-indigo text-center flex-fill flex-lg-grow-0">
                                    <div class="fs-5 fw-extrabold tabular-nums"><?= number_format($stats['jumlah_psikolog'] ?? 0) ?></div>
                                    <div class="fs-9 fw-bold text-uppercase opacity-75">Psikolog</div>
                                </div>
                                <div class="metric-pill-box pill-soft-sky text-center flex-fill flex-lg-grow-0">
                                    <div class="fs-5 fw-extrabold tabular-nums"><?= number_format($stats['jumlah_relawan'] ?? 0) ?></div>
                                    <div class="fs-9 fw-bold text-uppercase opacity-75">Relawan</div>
                                </div>
                            </div>
                            <a href="<?= site_url('/bpbd/manage-posko') ?>" class="btn btn-slide-soft-teal fw-bold rounded-lg px-4 py-2 shadow-sm d-inline-flex align-items-center justify-content-center gap-2">
                                <i class="bi bi-house-gear-fill"></i>
                                <span>Kelola Posko Bencana</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Slide 4: Radar Gempa BMKG & Early Warning -->
            <div class="swiper-slide bpbd-swiper-slide">
                <div class="frost-card-slide">
                    <div class="row align-items-center g-3">
                        <div class="col-12 col-lg-7">
                            <div class="d-flex align-items-center mb-3 flex-wrap">
                                <span class="badge pill-soft-amber fw-bold px-3 py-2 fs-8 rounded-lg me-3">
                                    BMKG SEISMIC RADAR
                                </span>
                                <span class="badge bg-white text-dark border px-3 py-2 fs-8 rounded-lg shadow-xs">
                                    Real-Time Stream
                                </span>
                            </div>
                            <h5 class="fw-bold mb-1" style="color: #064e3b;">
                                Pemantauan Radar Gempa Bumi Real-Time
                            </h5>
                            <p class="small text-muted mb-0">
                                Integrasi langsung dengan API BMKG untuk deteksi guncangan gempa & potensi tsunami nasional.
                            </p>
                        </div>
                        <div class="col-12 col-lg-5 text-lg-end">
                            <div class="d-flex align-items-center justify-content-start justify-content-lg-end gap-3 mb-3 flex-wrap">
                                <div class="metric-pill-box pill-soft-amber text-center flex-fill flex-lg-grow-0">
                                    <div class="fs-5 fw-extrabold tabular-nums">BMKG</div>
                                    <div class="fs-9 fw-bold text-uppercase opacity-75">API Live</div>
                                </div>
                                <div class="metric-pill-box pill-soft-emerald text-center flex-fill flex-lg-grow-0">
                                    <div class="fs-5 fw-extrabold tabular-nums">ONLINE</div>
                                    <div class="fs-9 fw-bold text-uppercase opacity-75">Radar Sync</div>
                                </div>
                                <div class="metric-pill-box pill-soft-sky text-center flex-fill flex-lg-grow-0">
                                    <div class="fs-5 fw-extrabold tabular-nums">ACTIVE</div>
                                    <div class="fs-9 fw-bold text-uppercase opacity-75">Early Warn</div>
                                </div>
                            </div>
                            <a href="<?= site_url('/bpbd/earthquake-radar') ?>" class="btn btn-slide-soft-amber fw-bold rounded-lg px-4 py-2 shadow-sm d-inline-flex align-items-center justify-content-center gap-2">
                                <i class="bi bi-radar"></i>
                                <span>Buka Peta Radar Gempa</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Slide 5: Review Approval Relawan Baru -->
            <div class="swiper-slide bpbd-swiper-slide">
                <div class="frost-card-slide">
                    <div class="row align-items-center g-3">
                        <div class="col-12 col-lg-7">
                            <div class="d-flex align-items-center mb-3 flex-wrap">
                                <span class="badge pill-soft-indigo fw-bold px-3 py-2 fs-8 rounded-lg me-3">
                                    VOLUNTEER ONBOARDING
                                </span>
                                <span class="badge bg-white text-dark border px-3 py-2 fs-8 rounded-lg shadow-xs">
                                    Verifikasi Registrasi
                                </span>
                            </div>
                            <h5 class="fw-bold mb-1" style="color: #064e3b;">
                                Verifikasi & Approval Akun Relawan Posko
                            </h5>
                            <p class="small text-muted mb-0">
                                Tinjau pendaftaran relawan baru dari landing page PsyAid dan tetapkan ke posko tujuan.
                            </p>
                        </div>
                        <div class="col-12 col-lg-5 text-lg-end">
                            <div class="d-flex align-items-center justify-content-start justify-content-lg-end gap-3 mb-3 flex-wrap">
                                <div class="metric-pill-box pill-soft-indigo text-center flex-fill flex-lg-grow-0">
                                    <div class="fs-5 fw-extrabold tabular-nums">REVIEW</div>
                                    <div class="fs-9 fw-bold text-uppercase opacity-75">Pending</div>
                                </div>
                                <div class="metric-pill-box pill-soft-emerald text-center flex-fill flex-lg-grow-0">
                                    <div class="fs-5 fw-extrabold tabular-nums">VERIFIED</div>
                                    <div class="fs-9 fw-bold text-uppercase opacity-75">Database</div>
                                </div>
                                <div class="metric-pill-box pill-soft-sky text-center flex-fill flex-lg-grow-0">
                                    <div class="fs-5 fw-extrabold tabular-nums">READY</div>
                                    <div class="fs-9 fw-bold text-uppercase opacity-75">Dispatch</div>
                                </div>
                            </div>
                            <a href="<?= site_url('/bpbd/register-relawan') ?>" class="btn btn-slide-soft-plum fw-bold rounded-lg px-4 py-2 shadow-sm d-inline-flex align-items-center justify-content-center gap-2">
                                <i class="bi bi-person-check-fill"></i>
                                <span>Review Approval Relawan</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Swiper Pagination & Navigation Controls -->
        <div class="swiper-pagination"></div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
</div>

<!-- 3. Key Metric Overview Cards (Symmetrical Bottom Divider Line & Compact Title Typography) -->
<div class="row g-3 mb-4">
    <!-- Card 1: Posko Kebencanaan -->
    <div class="col-12 col-sm-6 col-lg-3">
        <div class="card frost-card p-3 h-100 rounded-lg d-flex flex-column justify-content-between">
            <div>
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 rounded-lg px-2.5 py-1 fs-9 fw-bold">
                        Aktif
                    </span>
                    <i class="bi bi-house-gear-fill text-success fs-5"></i>
                </div>
                <div class="metric-card-title mb-1">
                    Posko Kebencanaan
                </div>
                <div class="display-6 fw-bold text-dark tabular-nums">
                    <?= count($poskoList) ?>
                </div>
            </div>
            <div class="small text-muted pt-2 border-top mt-3">
                Lokasi posko terdaftar di sistem
            </div>
        </div>
    </div>

    <!-- Card 2: Total Penyintas -->
    <div class="col-12 col-sm-6 col-lg-3">
        <div class="card frost-card p-3 h-100 rounded-lg d-flex flex-column justify-content-between">
            <div>
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 rounded-lg px-2.5 py-1 fs-9 fw-bold">
                        Terdaftar
                    </span>
                    <i class="bi bi-people-fill text-primary fs-5"></i>
                </div>
                <div class="metric-card-title mb-1">
                    Total Penyintas
                </div>
                <div class="display-6 fw-bold text-dark tabular-nums">
                    <?= number_format($stats['total_korban'] ?? 0) ?>
                </div>
            </div>
            <div class="small text-muted pt-2 border-top mt-3">
                <span class="fw-bold text-primary"><?= number_format($stats['sudah_screening'] ?? 0) ?></span> Sudah skrining AI
            </div>
        </div>
    </div>

    <!-- Card 3: Kasus High Risk AI -->
    <div class="col-12 col-sm-6 col-lg-3">
        <div class="card frost-card p-3 h-100 rounded-lg d-flex flex-column justify-content-between">
            <div>
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25 rounded-lg px-2.5 py-1 fs-9 fw-bold">
                        Prioritas
                    </span>
                    <i class="bi bi-exclamation-triangle-fill text-danger fs-5"></i>
                </div>
                <div class="metric-card-title mb-1">
                    Kasus High Risk AI
                </div>
                <div class="display-6 fw-bold text-danger tabular-nums">
                    <?= number_format($stats['risk_high'] ?? 0) ?>
                </div>
            </div>
            <div class="small text-muted pt-2 border-top mt-3">
                Perlu pendampingan psikolog
            </div>
        </div>
    </div>

    <!-- Card 4: Total Personel Field -->
    <div class="col-12 col-sm-6 col-lg-3">
        <div class="card frost-card p-3 h-100 rounded-lg d-flex flex-column justify-content-between">
            <div>
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="badge bg-info bg-opacity-10 text-info text-dark border border-info border-opacity-25 rounded-lg px-2.5 py-1 fs-9 fw-bold">
                        Siap Siaga
                    </span>
                    <i class="bi bi-person-badge-fill text-info fs-5"></i>
                </div>
                <div class="metric-card-title mb-1">
                    Total Personel Field
                </div>
                <div class="display-6 fw-bold text-dark tabular-nums">
                    <?= number_format(($stats['jumlah_psikolog'] ?? 0) + ($stats['jumlah_relawan'] ?? 0)) ?>
                </div>
            </div>
            <div class="small text-muted pt-2 border-top mt-3">
                <span class="fw-bold text-dark"><?= number_format($stats['jumlah_psikolog'] ?? 0) ?></span> Psikolog &bull; <span class="fw-bold text-dark"><?= number_format($stats['jumlah_relawan'] ?? 0) ?></span> Relawan
            </div>
        </div>
    </div>
</div>

<!-- 4. Quick Action Navigation Hub Grid -->
<div class="card frost-card p-4 mb-4">
    <h6 class="fw-bold text-dark mb-3 d-flex align-items-center">
        <i class="bi bi-grid-fill text-success me-2 fs-5"></i> Pusat Akses Cepat System BPBD
    </h6>
    <div class="row g-3">
        <div class="col-12 col-md-6 col-lg-4">
            <a href="<?= site_url('/command-center') ?>" class="quick-action-tile">
                <div class="quick-action-icon bg-danger bg-opacity-10 text-danger">
                    <i class="bi bi-shield-fill-check"></i>
                </div>
                <div>
                    <div class="fw-bold fs-7 mb-0.5">Command Center BPBD</div>
                    <div class="small text-muted">Monitoring real-time posko & triase</div>
                </div>
            </a>
        </div>
        <div class="col-12 col-md-6 col-lg-4">
            <a href="<?= site_url('/bpbd/manage-posko') ?>" class="quick-action-tile">
                <div class="quick-action-icon bg-success bg-opacity-10 text-success">
                    <i class="bi bi-house-gear-fill"></i>
                </div>
                <div>
                    <div class="fw-bold fs-7 mb-0.5">Kelola Posko Bencana</div>
                    <div class="small text-muted">Manajemen lokasi & penugasan</div>
                </div>
            </a>
        </div>
        <div class="col-12 col-md-6 col-lg-4">
            <a href="<?= site_url('/bpbd/earthquake-radar') ?>" class="quick-action-tile">
                <div class="quick-action-icon bg-warning bg-opacity-15 text-warning text-dark">
                    <i class="bi bi-radar"></i>
                </div>
                <div>
                    <div class="fw-bold fs-7 mb-0.5">Peta Radar Gempa</div>
                    <div class="small text-muted">Deteksi real-time gempa BMKG</div>
                </div>
            </a>
        </div>
        <div class="col-12 col-md-6 col-lg-4">
            <a href="<?= site_url('/psychologist-mapping') ?>" class="quick-action-tile">
                <div class="quick-action-icon bg-primary bg-opacity-10 text-primary">
                    <i class="bi bi-diagram-3-fill"></i>
                </div>
                <div>
                    <div class="fw-bold fs-7 mb-0.5">Pemetaan Psikolog</div>
                    <div class="small text-muted">Mapping tim psikologis posko</div>
                </div>
            </a>
        </div>
        <div class="col-12 col-md-6 col-lg-4">
            <a href="<?= site_url('/bpbd/register-relawan') ?>" class="quick-action-tile">
                <div class="quick-action-icon bg-info bg-opacity-10 text-info text-dark">
                    <i class="bi bi-person-check-fill"></i>
                </div>
                <div>
                    <div class="fw-bold fs-7 mb-0.5">Approval Akun Relawan</div>
                    <div class="small text-muted">Verifikasi pendaftaran relawan</div>
                </div>
            </a>
        </div>
        <div class="col-12 col-md-6 col-lg-4">
            <a href="<?= site_url('/bpbd/register-psikolog') ?>" class="quick-action-tile">
                <div class="quick-action-icon bg-purple bg-opacity-10 text-purple" style="background-color: rgba(139, 92, 246, 0.1); color: #7c3aed;">
                    <i class="bi bi-person-badge-fill"></i>
                </div>
                <div>
                    <div class="fw-bold fs-7 mb-0.5">Registrasi Akun Psikolog</div>
                    <div class="small text-muted">Pendaftaran psikolog klinis baru</div>
                </div>
            </a>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Initialize BPBD Dynamic Swiper Carousel with smooth 24px spacing and 4s Autoplay
        if (typeof Swiper !== 'undefined') {
            new Swiper('.bpbdSwiper', {
                slidesPerView: 1,
                spaceBetween: 24,
                loop: true,
                autoplay: {
                    delay: 4000,
                    disableOnInteraction: false,
                    pauseOnMouseEnter: true,
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
            });
        }
    });
</script>

<?= $this->endSection() ?>