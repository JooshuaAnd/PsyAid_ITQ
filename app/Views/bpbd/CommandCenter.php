<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<!-- Swiper 11 CSS & JS CDN -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<!-- Frosted Glass UI Custom Styling & PsyAid Light Green Theme (Matching landing/index.php) -->
<style>
    /* BPBD Dynamic Swiper Card Styling System */
    .bpbd-swiper-container {
        width: 100%;
        position: relative;
        padding-bottom: 2.25rem !important;
        overflow: hidden;
        border-radius: 14px !important;
    }

    .bpbd-swiper-slide {
        height: auto;
    }

    .swiper-card-inner {
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(240, 253, 244, 0.88) 100%);
        backdrop-filter: blur(16px) saturate(180%);
        -webkit-backdrop-filter: blur(16px) saturate(180%);
        border: 1.5px solid rgba(16, 185, 129, 0.28);
        border-radius: 14px !important;
        padding: 1.35rem 1.65rem;
        box-shadow: 0 10px 30px -5px rgba(6, 78, 59, 0.08), inset 0 1px 2px rgba(255, 255, 255, 1);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .swiper-card-inner::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 5px;
        height: 100%;
        background: linear-gradient(180deg, #10b981 0%, #059669 100%);
        border-radius: 14px 0 0 14px;
    }

    .swiper-card-emergency::before {
        background: linear-gradient(180deg, #ef4444 0%, #dc2626 100%);
    }

    .swiper-card-triase::before {
        background: linear-gradient(180deg, #3b82f6 0%, #1d4ed8 100%);
    }

    .swiper-card-personnel::before {
        background: linear-gradient(180deg, #10b981 0%, #047857 100%);
    }

    .swiper-card-radar::before {
        background: linear-gradient(180deg, #f59e0b 0%, #d97706 100%);
    }

    .swiper-card-onboarding::before {
        background: linear-gradient(180deg, #8b5cf6 0%, #6d28d9 100%);
    }

    /* Swiper Controls & Progress Indicator */
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
        width: 34px;
        height: 34px;
        background: #ffffff;
        border: 1px solid #a7f3d0;
        border-radius: 50%;
        color: #047857;
        box-shadow: 0 4px 12px rgba(15, 23, 42, 0.08);
        transition: all 0.2s ease;
        top: 45% !important;
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
        transform: scale(1.1);
    }
    .tabular-nums {
        font-variant-numeric: tabular-nums;
        font-feature-settings: "tnum";
    }

    /* Strict Max Rounded 8px (lg) Policy */
    .frost-card,
    .frost-hero,
    .frost-custom-trigger,
    .frost-custom-menu,
    .frost-btn-posko,
    .frost-btn-reset,
    .frost-btn-primary,
    .posko-item-card,
    .btn,
    .modal-content,
    .badge,
    .form-control,
    .form-select,
    .progress {
        border-radius: 8px !important;
    }

    /* Frosted Glass UI Card System */
    .frost-card {
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.85) 0%, rgba(244, 251, 247, 0.65) 100%);
        backdrop-filter: blur(12px) saturate(160%);
        -webkit-backdrop-filter: blur(12px) saturate(160%);
        border: 1px solid rgba(255, 255, 255, 0.85);
        box-shadow: 0 8px 24px -4px rgba(15, 23, 42, 0.06),
            0 2px 6px -1px rgba(15, 23, 42, 0.02),
            inset 0 1px 1.5px 0 rgba(255, 255, 255, 0.95);
        transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .frost-card:hover {
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(236, 253, 245, 0.75) 100%);
        border-color: rgba(16, 185, 129, 0.4);
        box-shadow: 0 14px 32px -4px rgba(16, 185, 129, 0.12),
            0 4px 10px -2px rgba(15, 23, 42, 0.04),
            inset 0 1px 2px 0 rgba(255, 255, 255, 1);
        transform: translateY(-3px);
    }

    /* Special Overflow & Stacking Context for Filter Card */
    .frost-card-filter {
        position: relative;
        z-index: 100;
        overflow: visible !important;
    }

    /* LIGHT GREEN PSYAID HERO CARD SYSTEM (Matching landing/index.php) */
    .frost-hero {
        background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 60%, #a7f3d0 100%);
        border: 1.5px solid #a7f3d0;
        color: #064e3b;
        position: relative;
        overflow: hidden;
        box-shadow: 0 10px 30px -4px rgba(16, 185, 129, 0.12),
            inset 0 1.5px 2px rgba(255, 255, 255, 0.85);
    }

    .frost-badge-priority {
        background: linear-gradient(90deg, rgba(254, 226, 226, 0.9) 0%, rgba(254, 242, 242, 0.9) 100%);
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
        border-bottom: 1px solid #fecdd3;
        color: #991b1b;
        font-size: 0.75rem;
        font-weight: 700;
        padding: 0.45rem 0.85rem;
    }

    /* CURATED PSYAID BRAND AI RISK CARDS */
    .risk-card-high {
        background: #fef2f2;
        border: 1px solid #fecdd3;
        border-radius: 6px;
    }

    .risk-card-high .risk-val {
        color: #dc2626;
        font-weight: 800;
    }

    .risk-card-high .risk-lbl {
        color: #991b1b;
        font-weight: 700;
        font-size: 0.6875rem;
        letter-spacing: 0.05em;
    }

    .risk-card-medium {
        background: #fffbeb;
        border: 1px solid #fde68a;
        border-radius: 6px;
    }

    .risk-card-medium .risk-val {
        color: #d97706;
        font-weight: 800;
    }

    .risk-card-medium .risk-lbl {
        color: #92400e;
        font-weight: 700;
        font-size: 0.6875rem;
        letter-spacing: 0.05em;
    }

    .risk-card-low {
        background: #ecfdf5;
        border: 1px solid #a7f3d0;
        border-radius: 6px;
    }

    .risk-card-low .risk-val {
        color: #059669;
        font-weight: 800;
    }

    .risk-card-low .risk-lbl {
        color: #047857;
        font-weight: 700;
        font-size: 0.6875rem;
        letter-spacing: 0.05em;
    }

    /* SEARCHABLE CUSTOM FROSTED DROPDOWN SYSTEM */
    .frost-menu-search-wrapper {
        position: sticky;
        top: -0.35rem;
        z-index: 1080;
        background: rgba(255, 255, 255, 0.98);
        backdrop-filter: blur(12px);
        margin: -0.35rem -0.35rem 0.35rem -0.35rem;
        padding: 0.5rem;
        border-bottom: 1px solid rgba(226, 232, 240, 0.9);
    }

    .frost-dropdown-search-input {
        background: #f8fafc;
        border: 1.5px solid #cbd5e1;
        border-radius: 6px !important;
        font-size: 0.8125rem;
        font-weight: 600;
        color: #0f172a;
        transition: all 0.2s ease;
    }

    .frost-dropdown-search-input:focus {
        background: #ffffff;
        border-color: #059669;
        box-shadow: 0 0 0 3px rgba(5, 150, 105, 0.18);
        outline: none;
    }

    /* LIGHT GREEN BUTTON: PRIMARY ACTION */
    .frost-btn-primary,
    .frost-btn-posko {
        background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
        color: #065f46 !important;
        border: 1.5px solid #34d399;
        border-radius: 8px !important;
        font-weight: 700;
        font-size: 0.78125rem;
        padding: 0.4rem 0.85rem;
        transition: all 0.2s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        box-shadow: 0 2px 6px rgba(16, 185, 129, 0.15);
        cursor: pointer;
        white-space: nowrap;
        flex-shrink: 0;
    }

    .frost-btn-primary:hover,
    .frost-btn-posko:hover {
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
        transform: translateY(-3px) !important;
    }

    .posko-card-header-bar {
        background: linear-gradient(135deg, #f0fdf4 0%, #ecfdf5 100%) !important;
        border-bottom: 1px solid #d1fae5 !important;
        padding: 0.85rem 1.15rem !important;
    }

    .posko-card-body {
        padding: 1.15rem !important;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        height: 100%;
    }

    .badge-bencana {
        background-color: #eff6ff !important;
        color: #1d4ed8 !important;
        border: 1px solid #bfdbfe !important;
        font-weight: 600 !important;
        font-size: 0.75rem !important;
        padding: 0.35rem 0.65rem !important;
    }

    .badge-status-aktif {
        background-color: #059669 !important;
        color: #ffffff !important;
        font-weight: 700 !important;
        font-size: 0.75rem !important;
        padding: 0.35rem 0.65rem !important;
    }

    .badge-status-recovery {
        background-color: #d97706 !important;
        color: #ffffff !important;
        font-weight: 700 !important;
        font-size: 0.75rem !important;
        padding: 0.35rem 0.65rem !important;
    }

    .badge-status-closed {
        background-color: #64748b !important;
        color: #ffffff !important;
        font-weight: 700 !important;
        font-size: 0.75rem !important;
        padding: 0.35rem 0.65rem !important;
    }

    /* CUSTOM FROSTED DROPDOWN COMPONENT */
    .frost-custom-select-wrapper {
        position: relative;
        z-index: 10;
    }

    .frost-custom-select-wrapper.active-dropdown {
        z-index: 1060 !important;
    }

    .frost-custom-trigger {
        background: #ffffff;
        border: 1.5px solid #cbd5e1;
        padding: 0.55rem 0.85rem;
        font-size: 0.875rem;
        font-weight: 600;
        color: #0f172a;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: space-between;
        cursor: pointer;
        transition: all 0.2s ease;
        box-shadow: 0 1px 3px rgba(15, 23, 42, 0.04);
        user-select: none;
    }

    .frost-custom-trigger:hover:not(.disabled) {
        border-color: #059669;
        background-color: #f4fbf7;
    }

    .frost-custom-trigger.active {
        border-color: #059669;
        box-shadow: 0 0 0 3.5px rgba(5, 150, 105, 0.18);
        background-color: #ffffff;
    }

    .frost-custom-trigger.disabled {
        background-color: #f8fafc;
        color: #94a3b8;
        border-color: #e2e8f0;
        cursor: not-allowed;
        opacity: 0.75;
    }

    .frost-custom-trigger .chevron-icon {
        color: #059669;
        font-size: 0.9rem;
        transition: transform 0.2s ease;
    }

    /* SEARCHABLE CUSTOM DROPDOWN SEARCH WRAPPER */
    .frost-menu-search-wrapper {
        position: sticky;
        top: 0;
        z-index: 1080;
        background: #ffffff;
        padding: 0.5rem 0.6rem;
        margin: -0.35rem -0.35rem 0.4rem -0.35rem;
        border-bottom: 1.5px solid #e2e8f0;
        border-top-left-radius: 8px;
        border-top-right-radius: 8px;
        box-shadow: 0 2px 6px rgba(15, 23, 42, 0.04);
    }

    .frost-menu-search-box {
        position: relative;
        display: flex;
        align-items: center;
        width: 100%;
    }

    .frost-menu-search-icon {
        position: absolute;
        left: 0.75rem;
        top: 50%;
        transform: translateY(-50%);
        color: #059669;
        font-size: 0.85rem;
        pointer-events: none;
        z-index: 2;
    }

    .frost-dropdown-search-input {
        width: 100%;
        background: #f8fafc;
        border: 1.5px solid #cbd5e1;
        border-radius: 6px !important;
        font-size: 0.8125rem;
        font-weight: 600;
        color: #0f172a;
        padding: 0.45rem 0.75rem 0.45rem 2.25rem !important;
        transition: all 0.2s ease;
    }

    .frost-dropdown-search-input:focus {
        background: #ffffff;
        border-color: #059669;
        box-shadow: 0 0 0 3px rgba(5, 150, 105, 0.18);
        outline: none;
    }

    .frost-custom-menu {
        position: absolute;
        top: calc(100% + 6px);
        left: 0;
        right: 0;
        z-index: 1070 !important;
        background: rgba(255, 255, 255, 0.98);
        backdrop-filter: blur(20px) saturate(180%);
        -webkit-backdrop-filter: blur(20px) saturate(180%);
        border: 1px solid rgba(5, 150, 105, 0.3);
        box-shadow: 0 16px 40px -4px rgba(15, 23, 42, 0.18), 0 4px 16px rgba(0, 0, 0, 0.06);
        max-height: 260px;
        overflow-y: auto;
        padding: 0.35rem;
        display: none;
        animation: fadeInDown 0.15s ease-out;
    }

    .frost-custom-menu.show {
        display: block;
    }

    .frost-custom-option {
        padding: 0.55rem 0.75rem;
        font-size: 0.85rem;
        font-weight: 500;
        color: #1e293b;
        border-radius: 6px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: space-between;
        transition: all 0.15s ease;
    }

    .frost-custom-option:hover {
        background-color: #ecfdf5;
        color: #047857;
        font-weight: 600;
    }

    .frost-custom-option.selected {
        background-color: #059669;
        color: #ffffff;
        font-weight: 600;
    }

    .step-num-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 20px;
        height: 20px;
        border-radius: 4px;
        background-color: #ecfdf5;
        color: #047857;
        font-size: 0.7rem;
        font-weight: 700;
        margin-right: 6px;
        border: 1px solid #a7f3d0;
    }

    /* Desktop Buttons */
    .frost-btn-reset {
        background: #ffffff;
        color: #475569;
        border: 1.5px solid #cbd5e1;
        font-weight: 600;
        font-size: 0.8125rem;
        padding: 0.5rem 0.95rem;
        transition: all 0.2s ease;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
    }

    .frost-btn-reset:hover {
        background-color: #f8fafc;
        color: #0f172a;
        border-color: #94a3b8;
    }

    /* Compact Mobile Action Buttons */
    .frost-btn-reset-sm {
        background: #ffffff;
        color: #475569;
        border: 1px solid #cbd5e1;
        border-radius: 6px;
        font-weight: 600;
        font-size: 0.75rem;
        padding: 0.35rem 0.65rem;
        transition: all 0.2s ease;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
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

    .posko-header-title-group {
        display: flex;
        align-items: center;
        gap: 0.75rem !important;
    }

    .posko-header-title-text {
        display: flex;
        align-items: center;
    }

    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-6px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Mobile Responsive Spacing & Layout Optimization for Filter Card & Section Header */
    @media (max-width: 767.98px) {
        .frost-card-filter {
            padding: 1.25rem 1rem !important;
            margin-bottom: 1.25rem !important;
        }

        .frost-card-filter .border-bottom {
            padding-bottom: 0.85rem !important;
            margin-bottom: 1rem !important;
        }

        .frost-custom-trigger {
            min-height: 44px;
            font-size: 0.875rem;
            padding-top: 0.6rem;
            padding-bottom: 0.6rem;
        }

        .frost-custom-option {
            padding: 0.75rem 0.85rem;
            font-size: 0.875rem;
        }

        #filter-form {
            --bs-gutter-y: 1.15rem;
        }

        #filter-form .form-label {
            margin-bottom: 0.45rem !important;
            font-size: 0.8125rem;
        }

        #active-filters-chips-container {
            margin-top: 1.15rem !important;
            padding-top: 0.85rem !important;
        }

        .frost-mobile-reset-wrapper {
            margin-top: 1.15rem !important;
            padding-top: 0.85rem !important;
        }

        /* Section Header Mobile Optimizations: Clean 2-Row Mobile Layout */
        .posko-main-card-container {
            padding: 1rem 0.85rem !important;
        }

        .posko-main-card-header {
            flex-direction: column !important;
            align-items: stretch !important;
            gap: 0.75rem !important;
            padding-bottom: 0.75rem !important;
            margin-bottom: 1rem !important;
        }

        .posko-header-title-group {
            width: 100% !important;
            display: flex !important;
            align-items: center !important;
            justify-content: space-between !important;
            gap: 0.5rem !important;
        }

        .posko-header-title-text i {
            margin-right: 0.5rem !important;
        }

        .posko-header-badge {
            font-size: 0.7rem !important;
            padding: 0.25rem 0.5rem !important;
        }

        .posko-header-btn-wrapper {
            width: 100% !important;
        }

        .posko-header-btn-wrapper .frost-btn-primary {
            width: 100% !important;
            justify-content: center !important;
            padding: 0.5rem 0.85rem !important;
            font-size: 0.8125rem !important;
        }
    }
</style>

<?php
// Safely resolve jenis bencana variable from controller (handles both jenisBencana and distinctJenisBencana)
$bencanaOptions = $jenisBencana ?? $distinctJenisBencana ?? [];
?>

<!-- 1. Hero Command Center Card (With original "BPBD Command Center", "Real Time Data", and live device time badge) -->
<div class="card frost-hero mb-4">
    <div class="card-body p-4 position-relative">
        <div class="row align-items-center g-3">
            <div class="col-12 col-lg-8">
                <div class="d-flex align-items-center gap-2 mb-2 flex-wrap">
                    <span class="badge px-3 py-1.5 fs-8 fw-bold"
                        style="background-color: rgba(6, 95, 70, 0.12); color: #065f46; border: 1px solid rgba(6, 95, 70, 0.25);">
                        <i class="bi bi-shield-fill-check me-1"></i> BPBD Command Center
                    </span>
                    <span class="badge px-3 py-1.5 fs-8 fw-bold"
                        style="background-color: rgba(6, 95, 70, 0.08); color: #047857; border: 1px solid rgba(6, 95, 70, 0.18);">
                        <i class="bi bi-broadcast me-1 text-success"></i> Real Time Data
                    </span>
                </div>
                <h3 class="fw-bold mb-1" style="color: #064e3b;">
                    <i class="bi bi-shield-fill-check me-2" style="color: #059669;"></i> Command Center BPBD
                </h3>
                <p class="small mb-0" style="color: #047857; max-width: 75ch;">
                    Monitoring real-time sebaran posko bencana, triase kesehatan mental penyintas (AI Assessment), dan
                    kesiapan personel lapangan di seluruh wilayah Indonesia.
                </p>
            </div>
            <div class="col-12 col-lg-4 text-lg-end">
                <span
                    class="badge px-3 py-2 fs-8 fw-bold live-device-clock text-uppercase d-inline-flex align-items-center gap-2"
                    data-live-clock
                    style="background-color: rgba(6, 95, 70, 0.1); color: #065f46; border: 1px solid rgba(6, 95, 70, 0.22); border-radius: 8px;">
                    <i class="bi bi-clock-history me-2" style="color: #059669; font-size: 0.85rem;"></i>
                    <span class="time-text"></span>
                </span>
            </div>
        </div>
    </div>
</div>

<!-- 2. Cascading Select Filter Bar (Frosted Floating Dropdown UI System) -->
<div class="card frost-card frost-card-filter p-3.5 p-md-4 mb-4">
    <div class="d-flex align-items-center justify-content-between mb-3 border-bottom pb-3 flex-wrap gap-2">
        <h6 class="fw-bold text-dark mb-0 d-flex align-items-center">
            <i class="bi bi-funnel-fill text-success me-2 fs-5"></i> Filter Pembagian Posko
        </h6>
        <!-- Desktop Reset Button -->
        <div class="d-none d-md-flex align-items-center">
            <button type="button" id="btn-reset-filter" class="frost-btn-reset">
                <i class="bi bi-arrow-counterclockwise"></i> Reset Filter
            </button>
        </div>
    </div>

    <form id="filter-form" class="row g-3">
        <!-- Hidden Native Selects for Logic & Sync -->
        <select id="filter-provinsi" class="d-none">
            <option value="">Semua Provinsi</option>
            <?php foreach ($provinces as $prov): ?>
                <option value="<?= esc($prov['id']) ?>"><?= esc($prov['name']) ?></option>
            <?php endforeach; ?>
        </select>

        <select id="filter-kabupaten" class="d-none" disabled>
            <option value="">Pilih Provinsi Dahulu</option>
        </select>

        <select id="filter-bencana" class="d-none">
            <option value="">Semua Bencana</option>
            <?php foreach ($bencanaOptions as $jb): ?>
                <option value="<?= esc($jb) ?>"><?= esc($jb) ?></option>
            <?php endforeach; ?>
        </select>

        <select id="filter-status" class="d-none">
            <option value="">Semua Status</option>
            <option value="aktif">Aktif</option>
            <option value="recovery">Recovery</option>
            <option value="closed">Closed</option>
        </select>

        <!-- 1. Custom Floating Dropdown: Provinsi -->
        <div class="col-12 col-sm-6 col-lg-3">
            <label class="form-label small fw-bold text-secondary mb-1.5 d-flex align-items-center">
                <span class="step-num-badge">1</span> Provinsi
            </label>
            <div class="frost-custom-select-wrapper" id="custom-wrapper-provinsi">
                <div class="frost-custom-trigger" id="trigger-provinsi">
                    <span class="trigger-label text-truncate">Semua Provinsi</span>
                    <i class="bi bi-chevron-down chevron-icon"></i>
                </div>
                <div class="frost-custom-menu" id="menu-provinsi">
                    <div class="frost-custom-option selected" data-value="">Semua Provinsi</div>
                    <?php foreach ($provinces as $prov): ?>
                        <div class="frost-custom-option" data-value="<?= esc($prov['id']) ?>"><?= esc($prov['name']) ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <!-- 2. Custom Floating Dropdown: Kabupaten (Populated via Cascading AJAX) -->
        <div class="col-12 col-sm-6 col-lg-3">
            <label class="form-label small fw-bold text-secondary mb-1.5 d-flex align-items-center">
                <span class="step-num-badge">2</span> Kabupaten / Kota
            </label>
            <div class="frost-custom-select-wrapper" id="custom-wrapper-kabupaten">
                <div class="frost-custom-trigger disabled" id="trigger-kabupaten">
                    <span class="trigger-label text-truncate">Pilih Provinsi Dahulu</span>
                    <i class="bi bi-chevron-down chevron-icon"></i>
                </div>
                <div class="frost-custom-menu" id="menu-kabupaten">
                    <div class="frost-custom-option selected" data-value="">Pilih Provinsi Dahulu</div>
                </div>
            </div>
        </div>

        <!-- 3. Custom Floating Dropdown: Jenis Bencana -->
        <div class="col-12 col-sm-6 col-lg-3">
            <label class="form-label small fw-bold text-secondary mb-1.5 d-flex align-items-center">
                <span class="step-num-badge">3</span> Jenis Bencana
            </label>
            <div class="frost-custom-select-wrapper" id="custom-wrapper-bencana">
                <div class="frost-custom-trigger" id="trigger-bencana">
                    <span class="trigger-label text-truncate">Semua Bencana</span>
                    <i class="bi bi-chevron-down chevron-icon"></i>
                </div>
                <div class="frost-custom-menu" id="menu-bencana">
                    <div class="frost-custom-option selected" data-value="">Semua Bencana</div>
                    <?php foreach ($bencanaOptions as $jb): ?>
                        <div class="frost-custom-option" data-value="<?= esc($jb) ?>"><?= esc($jb) ?></div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <!-- 4. Custom Floating Dropdown: Status Posko -->
        <div class="col-12 col-sm-6 col-lg-3">
            <label class="form-label small fw-bold text-secondary mb-1.5 d-flex align-items-center">
                <span class="step-num-badge">4</span> Status Posko
            </label>
            <div class="frost-custom-select-wrapper" id="custom-wrapper-status">
                <div class="frost-custom-trigger" id="trigger-status">
                    <span class="trigger-label text-truncate">Semua Status</span>
                    <i class="bi bi-chevron-down chevron-icon"></i>
                </div>
                <div class="frost-custom-menu" id="menu-status">
                    <div class="frost-custom-option selected" data-value="">Semua Status</div>
                    <div class="frost-custom-option" data-value="aktif">Aktif</div>
                    <div class="frost-custom-option" data-value="recovery">Recovery</div>
                    <div class="frost-custom-option" data-value="closed">Closed</div>
                </div>
            </div>
        </div>
    </form>

    <!-- Filter Aktif Chips -->
    <div id="active-filters-chips-container" class="d-none mt-3 pt-2.5 border-top">
        <div class="d-flex align-items-center flex-wrap gap-2">
            <span class="fs-8 fw-semibold text-muted me-1"><i class="bi bi-tags me-1"></i> Filter Aktif:</span>
            <div id="active-chips-list" class="d-flex flex-wrap gap-1.5"></div>
        </div>
    </div>

    <!-- Mobile Reset Button (Positioned Below Active Filter Chips) -->
    <div class="d-flex d-md-none align-items-center justify-content-end frost-mobile-reset-wrapper border-top">
        <button type="button" id="btn-reset-filter-mobile" class="frost-btn-reset-sm">
            <i class="bi bi-arrow-counterclockwise"></i> Reset Filter
        </button>
    </div>
</div>

<!-- 3. Summary Metric Cards Grid (Frosted Glass UI Style) -->
<div class="row g-3 mb-4">
    <!-- Card 1: Total Korban -->
    <div class="col-12 col-sm-6 col-lg-3">
        <div class="card frost-card p-3 h-100">
            <div class="text-muted fs-8 fw-bold text-uppercase">Total Korban Bencana</div>
            <div class="d-flex align-items-baseline justify-content-between mt-2">
                <div class="display-6 fw-bold text-dark tabular-nums" id="stat-total-korban">
                    <?= esc($stats['total_korban']) ?>
                </div>
                <div class="text-muted fs-3"><i class="bi bi-people-fill"></i></div>
            </div>
            <div class="small text-muted mt-2 pt-2 border-top">Terdata di posko terpilih</div>
        </div>
    </div>

    <!-- Card 2: Status Skrining -->
    <div class="col-12 col-sm-6 col-lg-3">
        <div class="card frost-card p-3 h-100">
            <div class="text-muted fs-8 fw-bold text-uppercase">Status Skrining Relawan</div>
            <div class="mt-2">
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <span class="small fw-semibold text-success"><i class="bi bi-check-circle-fill me-1"></i> Sudah
                        Skrining</span>
                    <span class="fw-bold text-dark tabular-nums"
                        id="stat-sudah-screening"><?= esc($stats['sudah_screening']) ?></span>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="small text-muted"><i class="bi bi-clock-history me-1"></i> Belum Skrining</span>
                    <span class="fw-bold text-secondary tabular-nums"
                        id="stat-belum-screening"><?= esc($stats['belum_screening']) ?></span>
                </div>
            </div>
            <div class="progress" style="height: 6px;">
                <div id="prog-screening" class="progress-bar bg-success" role="progressbar"
                    style="width: <?= $stats['total_korban'] > 0 ? round(($stats['sudah_screening'] / $stats['total_korban']) * 100) : 0 ?>%">
                </div>
            </div>
            <div class="d-flex justify-content-between align-items-center mt-1 fs-8 text-muted">
                <span>Cakupan</span>
                <span class="fw-semibold text-dark tabular-nums" id="prog-screening-pct">
                    <?= $stats['total_korban'] > 0 ? round(($stats['sudah_screening'] / $stats['total_korban']) * 100) : 0 ?>%
                </span>
            </div>
        </div>
    </div>

    <!-- Card 3: AI Risk Level Breakdown (Curated PsyAid Brand Risk Cards) -->
    <div class="col-12 col-sm-6 col-lg-3">
        <div class="card frost-card p-3 h-100">
            <div class="text-muted fs-8 fw-bold text-uppercase">Tingkat Risiko (AI Assessment)</div>
            <div class="d-flex justify-content-between align-items-center mt-2 gap-1.5 text-center">
                <div class="risk-card-high p-2 flex-fill">
                    <div class="risk-val fs-5 tabular-nums" id="stat-risk-high">
                        <?= esc($stats['risk_high']) ?>
                    </div>
                    <div class="risk-lbl">HIGH</div>
                </div>
                <div class="risk-card-medium p-2 flex-fill">
                    <div class="risk-val fs-5 tabular-nums" id="stat-risk-medium">
                        <?= esc($stats['risk_medium']) ?>
                    </div>
                    <div class="risk-lbl">MEDIUM</div>
                </div>
                <div class="risk-card-low p-2 flex-fill">
                    <div class="risk-val fs-5 tabular-nums" id="stat-risk-low">
                        <?= esc($stats['risk_low']) ?>
                    </div>
                    <div class="risk-lbl">LOW</div>
                </div>
            </div>
            <div class="small text-muted mt-2 pt-2 border-top">Dianalisis otomatis dari skrining</div>
        </div>
    </div>

    <!-- Card 4: Personel Aktif -->
    <div class="col-12 col-sm-6 col-lg-3">
        <div class="card frost-card p-3 h-100">
            <div class="text-muted fs-8 fw-bold text-uppercase">Personel Aktif Lapangan</div>
            <div class="mt-2">
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <span class="small fw-semibold text-primary"><i class="bi bi-heart-pulse-fill me-1"></i> Psikolog
                        Aktif</span>
                    <span class="fw-bold text-dark tabular-nums"
                        id="stat-jumlah-psikolog"><?= esc($stats['jumlah_psikolog']) ?> Orang</span>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <span class="small text-muted"><i class="bi bi-person-badge me-1"></i> Relawan Aktif</span>
                    <span class="fw-bold text-dark tabular-nums"
                        id="stat-jumlah-relawan"><?= esc($stats['jumlah_relawan']) ?> Orang</span>
                </div>
            </div>
            <div class="small text-muted mt-3 pt-2 border-top">Ditugaskan pada lokasi posko</div>
        </div>
    </div>
</div>

<!-- 4. Posko Grid Main Card Container (Unified Parent Container with Side-by-Side Mobile Header & Styled Total Badge) -->
<div class="card frost-card posko-main-card-container p-3.5 p-md-4 mb-5">
    <!-- Main Card Header: Clean 2-Row Mobile (<768px) / 1-Row Desktop (>=768px) Layout -->
    <div
        class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-3 border-bottom pb-3 gap-3 posko-main-card-header">
        <!-- Title & Total Badge Group -->
        <div
            class="d-flex align-items-center justify-content-between justify-content-md-start gap-3 min-w-0 posko-header-title-group">
            <h6 class="fw-bold text-dark mb-0 d-flex align-items-center posko-header-title-text">
                <i class="bi bi-grid-3x3-gap-fill text-success me-2 fs-5 flex-shrink-0"></i>
                <span>Daftar Posko Kebencanaan</span>
            </h6>
            <span class="badge px-2.5 py-1 fs-8 flex-shrink-0 posko-header-badge ms-md-1"
                style="background-color: rgba(6, 95, 70, 0.08); color: #047857; border: 1px solid rgba(6, 95, 70, 0.18); font-weight: 700;"
                id="posko-card-count-badge">
                <i class="bi bi-layers-fill me-1" style="font-size: 0.7rem;"></i> <?= count($poskoList) ?> Total
            </span>
        </div>
        <!-- Primary Action Button Wrapper -->
        <div class="posko-header-btn-wrapper">
            <a href="<?= site_url('/bpbd/manage-posko') ?>" class="frost-btn-primary rounded-lg text-decoration-none">
                <i class="bi bi-house-gear-fill me-1"></i> Kelola &amp; Tambah Posko
            </a>
        </div>
    </div>

    <!-- Inner Posko Cards Grid -->
    <div class="row g-3" id="posko-cards-container">
        <?php if (empty($poskoList)): ?>
            <div class="col-12">
                <div class="p-4 text-center text-muted">
                    <i class="bi bi-inbox fs-2 d-block mb-2 text-secondary"></i>
                    <h6 class="fw-bold text-dark mb-1">Tidak Ada Data Posko</h6>
                    <p class="small text-muted mb-0">Tidak ada data posko yang sesuai dengan filter yang dipilih.</p>
                </div>
            </div>
        <?php else: ?>
            <?php foreach ($poskoList as $posko): ?>
                <div class="col-12 col-md-6 col-lg-4">
                    <div
                        class="card posko-item-card h-100 overflow-hidden <?= $posko['is_highest_priority'] ? 'border-danger border-2' : '' ?>">
                        <?php if ($posko['is_highest_priority']): ?>
                            <div class="frost-badge-priority d-flex align-items-center justify-content-between">
                                <span><i class="bi bi-exclamation-triangle-fill me-1 text-danger"></i> Prioritas Operasional</span>
                                <span class="badge bg-white text-danger fw-bold rounded-1">Kasus High Terbanyak</span>
                            </div>
                        <?php endif; ?>

                        <!-- Soft Mint Header Bar -->
                        <div class="posko-card-header-bar d-flex align-items-center justify-content-between gap-2">
                            <h6 class="fw-bold mb-0 text-truncate" title="<?= esc($posko['posko_name']) ?>"
                                style="color: #064e3b !important;">
                                <a href="<?= site_url('/posko/' . $posko['id']) ?>" class="text-decoration-none"
                                    style="color: #064e3b !important;">
                                    <?= esc($posko['posko_name']) ?>
                                </a>
                            </h6>
                            <?php if ($posko['status'] === 'aktif'): ?>
                                <span class="badge badge-status-aktif rounded-2 flex-shrink-0">Aktif</span>
                            <?php elseif ($posko['status'] === 'recovery'): ?>
                                <span class="badge badge-status-recovery rounded-2 flex-shrink-0">Recovery</span>
                            <?php else: ?>
                                <span class="badge badge-status-closed rounded-2 flex-shrink-0">Closed</span>
                            <?php endif; ?>
                        </div>

                        <!-- Posko Card Body -->
                        <div class="posko-card-body">
                            <div>
                                <!-- Location Info & Jenis Bencana -->
                                <div
                                    class="small text-muted mb-3 d-flex align-items-center justify-content-between flex-wrap gap-1">
                                    <span>
                                        <i class="bi bi-geo-alt-fill text-danger me-1"></i>
                                        <strong class="text-dark"><?= esc($posko['regency_name']) ?></strong>,
                                        <?= esc($posko['province_name']) ?>
                                    </span>
                                    <span class="badge badge-bencana rounded-2"><?= esc($posko['jenis_bencana']) ?></span>
                                </div>

                                <!-- AI Risk Breakdown Grid -->
                                <div class="bg-light bg-opacity-75 p-2.5 rounded-2 mb-3 border">
                                    <div class="small text-muted fw-bold mb-2 fs-8 text-uppercase">Breakdown Kasus AI Risk
                                        Level:</div>
                                    <div class="d-flex justify-content-between text-center gap-1.5">
                                        <div class="risk-card-high p-1.5 flex-fill">
                                            <div class="risk-val fs-6 tabular-nums"><?= esc($posko['high_risk_count']) ?></div>
                                            <div class="risk-lbl">High</div>
                                        </div>
                                        <div class="risk-card-medium p-1.5 flex-fill">
                                            <div class="risk-val fs-6 tabular-nums"><?= esc($posko['medium_risk_count']) ?>
                                            </div>
                                            <div class="risk-lbl">Medium</div>
                                        </div>
                                        <div class="risk-card-low p-1.5 flex-fill">
                                            <div class="risk-val fs-6 tabular-nums"><?= esc($posko['low_risk_count']) ?></div>
                                            <div class="risk-lbl">Low</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Card Footer Action Bar -->
                            <div
                                class="d-flex align-items-center justify-content-between border-top pt-2.5 mt-2 flex-wrap gap-2">
                                <div class="small text-muted me-auto">
                                    Total: <strong class="text-dark tabular-nums"><?= $posko['total_korban'] ?></strong>
                                    Penyintas
                                </div>
                                <a href="<?= site_url('/posko/' . $posko['id']) ?>" class="frost-btn-primary">
                                    Buka Posko <i class="bi bi-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<!-- JavaScript for Custom Floating Dropdowns & Cascading Real-Time Filtering -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Initialize BPBD Executive Dynamic Swiper Carousel with 4s Autoplay
        if (typeof Swiper !== 'undefined') {
            new Swiper('.bpbdSwiper', {
                slidesPerView: 1,
                spaceBetween: 20,
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
                effect: 'fade',
                fadeEffect: {
                    crossFade: true,
                },
            });
        }
    });
</script>

<!-- JavaScript for Real-Time AJAX Filters & Interactive Statistics -->
<script>
    const ALL_REGENCIES_MAP_CC = <?= $allRegenciesJson ?? '{}' ?>;
    const regencyCacheCC = {};

    function getRegenciesDataCC(provinceId) {
        if (!provinceId) return Promise.resolve([]);
        const keyStr = String(provinceId);
        const keyNum = Number(provinceId);

        if (ALL_REGENCIES_MAP_CC[keyStr]) {
            return Promise.resolve(ALL_REGENCIES_MAP_CC[keyStr]);
        }
        if (ALL_REGENCIES_MAP_CC[keyNum]) {
            return Promise.resolve(ALL_REGENCIES_MAP_CC[keyNum]);
        }
        if (regencyCacheCC[keyStr]) {
            return Promise.resolve(regencyCacheCC[keyStr]);
        }
        const regencyApiUrl = window.location.origin + '/command-center/get-regencies/' + provinceId;
        return fetch(regencyApiUrl)
            .then(res => res.json())
            .then(res => {
                const list = (res.status === 'success' && res.data) ? res.data : [];
                regencyCacheCC[keyStr] = list;
                return list;
            })
            .catch(() => []);
    }

    document.addEventListener('DOMContentLoaded', function () {
        const provSelect = document.getElementById('filter-provinsi');
        const kabSelect = document.getElementById('filter-kabupaten');
        const bencSelect = document.getElementById('filter-bencana');
        const statSelect = document.getElementById('filter-status');

        const resetBtn = document.getElementById('btn-reset-filter');
        const resetBtnMob = document.getElementById('btn-reset-filter-mobile');

        function updateCustomMenuOptionsCC(menuId, menuHtml) {
            const menu = document.getElementById(menuId);
            if (!menu) return;
            let optionsList = menu.querySelector('.frost-options-list');
            if (!optionsList) {
                optionsList = document.createElement('div');
                optionsList.className = 'frost-options-list';
                menu.appendChild(optionsList);
            }
            optionsList.innerHTML = menuHtml;

            const searchInput = menu.querySelector('.frost-dropdown-search-input');
            if (searchInput) {
                searchInput.value = '';
                optionsList.querySelectorAll('.frost-custom-option').forEach(opt => opt.style.display = 'flex');
                const noResults = menu.querySelector('.frost-no-results');
                if (noResults) noResults.classList.add('d-none');
            }
        }

        // Setup Custom Floating Dropdown Interactivity with Auto-Recommendation Search
        function setupCustomDropdown(key, defaultText, isSearchable = false, searchPlaceholder = 'Cari...') {
            const wrapper = document.getElementById('custom-wrapper-' + key);
            const trigger = document.getElementById('trigger-' + key);
            const menu = document.getElementById('menu-' + key);
            const native = document.getElementById('filter-' + key);

            if (!wrapper || !trigger || !menu || !native) return;

            let optionsList = menu.querySelector('.frost-options-list');
            if (!optionsList) {
                optionsList = document.createElement('div');
                optionsList.className = 'frost-options-list';
                const children = Array.from(menu.childNodes);
                children.forEach(child => optionsList.appendChild(child));
                menu.appendChild(optionsList);
            }

            let searchInput = null;
            let noResults = null;

            if (isSearchable) {
                if (!menu.querySelector('.frost-menu-search-wrapper')) {
                    const searchBoxWrapper = document.createElement('div');
                    searchBoxWrapper.className = 'frost-menu-search-wrapper';
                    searchBoxWrapper.innerHTML = `
                        <div class="frost-menu-search-box">
                            <i class="bi bi-search frost-menu-search-icon"></i>
                            <input type="text" class="frost-dropdown-search-input form-control form-control-sm" placeholder="${escapeHtml(searchPlaceholder)}" autocomplete="off">
                        </div>
                        <div class="frost-no-results p-2 text-muted fs-8 text-center d-none">Tidak ditemukan rekomendasi nama</div>
                    `;
                    menu.insertBefore(searchBoxWrapper, optionsList);
                }

                searchInput = menu.querySelector('.frost-dropdown-search-input');
                noResults = menu.querySelector('.frost-no-results');

                if (searchInput) {
                    searchInput.addEventListener('click', function (e) {
                        e.stopPropagation();
                    });

                    searchInput.addEventListener('input', function () {
                        const query = this.value.toLowerCase().trim();
                        const currentList = menu.querySelector('.frost-options-list') || optionsList;
                        const options = currentList.querySelectorAll('.frost-custom-option');
                        let matchCount = 0;

                        options.forEach(opt => {
                            const txt = opt.textContent.toLowerCase();
                            if (!query || txt.includes(query)) {
                                opt.style.display = 'flex';
                                matchCount++;
                            } else {
                                opt.style.display = 'none';
                            }
                        });

                        if (noResults) {
                            if (matchCount === 0) {
                                noResults.classList.remove('d-none');
                            } else {
                                noResults.classList.add('d-none');
                            }
                        }
                    });

                    searchInput.addEventListener('keydown', function (e) {
                        if (e.key === 'Enter') {
                            e.preventDefault();
                            const currentList = menu.querySelector('.frost-options-list') || optionsList;
                            const firstVisible = Array.from(currentList.querySelectorAll('.frost-custom-option')).find(opt => opt.style.display !== 'none');
                            if (firstVisible) {
                                firstVisible.click();
                            }
                        }
                    });
                }
            }

            trigger.addEventListener('click', function (e) {
                e.stopPropagation();
                if (trigger.classList.contains('disabled')) return;

                const isAlreadyShow = menu.classList.contains('show');

                // Close all other open dropdowns
                document.querySelectorAll('.frost-custom-menu').forEach(m => m.classList.remove('show'));
                document.querySelectorAll('.frost-custom-trigger').forEach(t => t.classList.remove('active'));
                document.querySelectorAll('.frost-custom-select-wrapper').forEach(w => w.classList.remove('active-dropdown'));

                if (!isAlreadyShow) {
                    menu.classList.add('show');
                    trigger.classList.add('active');
                    wrapper.classList.add('active-dropdown');

                    if (searchInput) {
                        searchInput.value = '';
                        const currentList = menu.querySelector('.frost-options-list') || optionsList;
                        currentList.querySelectorAll('.frost-custom-option').forEach(opt => opt.style.display = 'flex');
                        if (noResults) noResults.classList.add('d-none');
                        setTimeout(() => searchInput.focus(), 60);
                    }
                }
            });

            menu.addEventListener('click', function (e) {
                const opt = e.target.closest('.frost-custom-option');
                if (!opt) return;

                const val = opt.getAttribute('data-value');
                const txt = opt.textContent.trim();

                menu.querySelectorAll('.frost-custom-option').forEach(o => o.classList.remove('selected'));
                opt.classList.add('selected');

                trigger.querySelector('.trigger-label').textContent = txt;

                menu.classList.remove('show');
                trigger.classList.remove('active');
                wrapper.classList.remove('active-dropdown');

                if (native.value !== val) {
                    native.value = val;
                    native.dispatchEvent(new Event('change'));
                }
            });
        }

        setupCustomDropdown('provinsi', 'Semua Provinsi', true, 'Cari provinsi...');
        setupCustomDropdown('kabupaten', 'Pilih Provinsi Dahulu', true, 'Cari kabupaten / kota...');
        setupCustomDropdown('bencana', 'Semua Bencana');
        setupCustomDropdown('status', 'Semua Status');

        // Close custom menus when clicking outside
        document.addEventListener('click', function () {
            document.querySelectorAll('.frost-custom-menu').forEach(m => m.classList.remove('show'));
            document.querySelectorAll('.frost-custom-trigger').forEach(t => t.classList.remove('active'));
            document.querySelectorAll('.frost-custom-select-wrapper').forEach(w => w.classList.remove('active-dropdown'));
        });

        // 1. Cascading Select: Fetch Regencies on Province Change
        provSelect.addEventListener('change', function () {
            const provinceId = this.value;
            const triggerKab = document.getElementById('trigger-kabupaten');

            kabSelect.innerHTML = '<option value="">Semua Kabupaten</option>';
            kabSelect.value = '';
            kabSelect.disabled = true;

            if (triggerKab) {
                triggerKab.classList.add('disabled');
                triggerKab.querySelector('.trigger-label').textContent = provinceId ? 'Memuat Kabupaten...' : 'Pilih Provinsi Dahulu';
            }
            updateCustomMenuOptionsCC('menu-kabupaten', `<div class="frost-custom-option selected" data-value="">${provinceId ? 'Memuat Kabupaten...' : 'Pilih Provinsi Dahulu'}</div>`);

            if (!provinceId) {
                updateActiveChips();
                fetchStats();
                return;
            }

            getRegenciesDataCC(provinceId).then(data => {
                if (triggerKab) {
                    triggerKab.querySelector('.trigger-label').textContent = 'Semua Kabupaten';
                    triggerKab.classList.remove('disabled');
                }

                let menuHtml = '<div class="frost-custom-option selected" data-value="">Semua Kabupaten</div>';
                data.forEach(reg => {
                    const opt = document.createElement('option');
                    opt.value = reg.id;
                    opt.textContent = reg.name;
                    kabSelect.appendChild(opt);

                    menuHtml += `<div class="frost-custom-option" data-value="${reg.id}">${escapeHtml(reg.name)}</div>`;
                });
                kabSelect.disabled = false;
                updateCustomMenuOptionsCC('menu-kabupaten', menuHtml);
                updateActiveChips();
                fetchStats();
            });
        });

        // Instant Real-Time Fetching on Option Selection
        kabSelect.addEventListener('change', function () { updateActiveChips(); fetchStats(); });
        bencSelect.addEventListener('change', function () { updateActiveChips(); fetchStats(); });
        statSelect.addEventListener('change', function () { updateActiveChips(); fetchStats(); });

        // Reset Filter Handler
        const handleReset = function (e) {
            if (e) e.preventDefault();

            provSelect.value = '';
            kabSelect.value = '';
            bencSelect.value = '';
            statSelect.value = '';

            kabSelect.disabled = true;
            kabSelect.innerHTML = '<option value="">Pilih Provinsi Dahulu</option>';

            // Reset Custom Triggers & Menus
            document.querySelector('#trigger-provinsi .trigger-label').textContent = 'Semua Provinsi';
            document.querySelector('#trigger-kabupaten .trigger-label').textContent = 'Pilih Provinsi Dahulu';
            document.getElementById('trigger-kabupaten').classList.add('disabled');
            document.querySelector('#trigger-bencana .trigger-label').textContent = 'Semua Bencana';
            document.querySelector('#trigger-status .trigger-label').textContent = 'Semua Status';

            document.querySelectorAll('.frost-custom-menu').forEach(m => {
                m.querySelectorAll('.frost-custom-option').forEach((o, i) => {
                    if (i === 0) o.classList.add('selected');
                    else o.classList.remove('selected');
                });
            });

            updateActiveChips();
            fetchStats();
        };

        if (resetBtn) resetBtn.addEventListener('click', handleReset);
        if (resetBtnMob) resetBtnMob.addEventListener('click', handleReset);

        function updateActiveChips() {
            const container = document.getElementById('active-filters-chips-container');
            const list = document.getElementById('active-chips-list');
            list.innerHTML = '';

            let count = 0;
            if (provSelect.value) {
                const txt = document.querySelector('#trigger-provinsi .trigger-label').textContent;
                count++;
                list.innerHTML += `<span class="badge bg-light text-dark border px-2 py-1 fs-8 rounded-1 me-1">Prov: ${escapeHtml(txt)}</span>`;
            }
            if (!kabSelect.disabled && kabSelect.value) {
                const txt = document.querySelector('#trigger-kabupaten .trigger-label').textContent;
                count++;
                list.innerHTML += `<span class="badge bg-light text-dark border px-2 py-1 fs-8 rounded-1 me-1">Kab: ${escapeHtml(txt)}</span>`;
            }
            if (bencSelect.value) {
                count++;
                list.innerHTML += `<span class="badge bg-light text-dark border px-2 py-1 fs-8 rounded-1 me-1">Bencana: ${escapeHtml(bencSelect.value)}</span>`;
            }
            if (statSelect.value) {
                count++;
                list.innerHTML += `<span class="badge bg-light text-dark border px-2 py-1 fs-8 rounded-1 me-1">Status: ${escapeHtml(statSelect.value)}</span>`;
            }

            if (count > 0) {
                container.classList.remove('d-none');
            } else {
                container.classList.add('d-none');
            }
        }

        // Fetch Stats & Posko Grid via relative URL endpoint
        function fetchStats() {
            const params = new URLSearchParams({
                province_id: provSelect.value || '',
                regency_id: kabSelect.value || '',
                jenis_bencana: bencSelect.value || '',
                status: statSelect.value || ''
            });

            const container = document.getElementById('posko-cards-container');
            if (container) container.style.opacity = '0.5';

            const statsApiUrl = window.location.origin + '/command-center/get-stats?' + params.toString();

            fetch(statsApiUrl)
                .then(res => res.json())
                .then(res => {
                    if (container) container.style.opacity = '1';
                    if (res.status === 'success') {
                        updateCards(res.data);
                        updatePoskoCardsGrid(res.poskoList);
                    }
                })
                .catch(err => {
                    if (container) container.style.opacity = '1';
                    console.error('Error fetching stats:', err);
                });
        }

        function updateCards(d) {
            if (document.getElementById('stat-total-korban')) document.getElementById('stat-total-korban').textContent = d.total_korban;
            if (document.getElementById('stat-sudah-screening')) document.getElementById('stat-sudah-screening').textContent = d.sudah_screening;
            if (document.getElementById('stat-belum-screening')) document.getElementById('stat-belum-screening').textContent = d.belum_screening;
            if (document.getElementById('stat-risk-high')) document.getElementById('stat-risk-high').textContent = d.risk_high;
            if (document.getElementById('stat-risk-medium')) document.getElementById('stat-risk-medium').textContent = d.risk_medium;
            if (document.getElementById('stat-risk-low')) document.getElementById('stat-risk-low').textContent = d.risk_low;
            if (document.getElementById('stat-jumlah-psikolog')) document.getElementById('stat-jumlah-psikolog').textContent = d.jumlah_psikolog + ' Orang';
            if (document.getElementById('stat-jumlah-relawan')) document.getElementById('stat-jumlah-relawan').textContent = d.jumlah_relawan + ' Orang';

            const pct = d.total_korban > 0 ? Math.round((d.sudah_screening / d.total_korban) * 100) : 0;
            const progBar = document.getElementById('prog-screening');
            const progPct = document.getElementById('prog-screening-pct');

            if (progBar) progBar.style.width = pct + '%';
            if (progPct) progPct.textContent = pct + '%';
        }

        function updatePoskoCardsGrid(list) {
            const container = document.getElementById('posko-cards-container');
            const badge = document.getElementById('posko-card-count-badge');
            if (badge) badge.innerHTML = `<i class="bi bi-layers-fill me-1" style="font-size: 0.7rem;"></i> ${list.length} Total`;

            if (!container) return;

            if (list.length === 0) {
                container.innerHTML = `
                <div class="col-12">
                    <div class="p-4 text-center text-muted">
                        <i class="bi bi-inbox fs-2 d-block mb-2 text-secondary"></i>
                        <h6 class="fw-bold text-dark mb-1">Tidak Ada Data Posko</h6>
                        <p class="small text-muted mb-0">Tidak ada data posko yang sesuai dengan filter yang dipilih.</p>
                    </div>
                </div>`;
                return;
            }

            const basePoskoUrl = window.location.origin + '/posko/';

            let html = '';
            list.forEach(p => {
                let statusBadge = '<span class="badge badge-status-closed rounded-2 flex-shrink-0">Closed</span>';
                if (p.status === 'aktif') {
                    statusBadge = '<span class="badge badge-status-aktif rounded-2 flex-shrink-0">Aktif</span>';
                } else if (p.status === 'recovery') {
                    statusBadge = '<span class="badge badge-status-recovery rounded-2 flex-shrink-0">Recovery</span>';
                }

                const priorityHeader = p.is_highest_priority ? `
                <div class="frost-badge-priority d-flex align-items-center justify-content-between">
                    <span><i class="bi bi-exclamation-triangle-fill me-1 text-danger"></i> Prioritas Operasional</span>
                    <span class="badge bg-white text-danger fw-bold rounded-1">Kasus High Terbanyak</span>
                </div>` : '';

                const borderClass = p.is_highest_priority ? 'border-danger border-2' : '';

                html += `
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card posko-item-card h-100 overflow-hidden ${borderClass}">
                        ${priorityHeader}
                        <div class="posko-card-header-bar d-flex align-items-center justify-content-between gap-2">
                            <h6 class="fw-bold mb-0 text-truncate" title="${escapeHtml(p.posko_name)}" style="color: #064e3b !important;">
                                <a href="${basePoskoUrl}${p.id}" class="text-decoration-none" style="color: #064e3b !important;">
                                    ${escapeHtml(p.posko_name)}
                                </a>
                            </h6>
                            ${statusBadge}
                        </div>

                        <div class="posko-card-body">
                            <div>
                                <div class="small text-muted mb-3 d-flex align-items-center justify-content-between flex-wrap gap-1">
                                    <span>
                                        <i class="bi bi-geo-alt-fill text-danger me-1"></i>
                                        <strong class="text-dark">${escapeHtml(p.regency_name)}</strong>, ${escapeHtml(p.province_name)}
                                    </span>
                                    <span class="badge badge-bencana rounded-2">${escapeHtml(p.jenis_bencana)}</span>
                                </div>

                                <div class="bg-light bg-opacity-75 p-2.5 rounded-2 mb-3 border">
                                    <div class="small text-muted fw-bold mb-2 fs-8 text-uppercase">Breakdown Kasus AI Risk Level:</div>
                                    <div class="d-flex justify-content-between text-center gap-1.5">
                                        <div class="risk-card-high p-1.5 flex-fill">
                                            <div class="risk-val fs-6 tabular-nums">${p.high_risk_count}</div>
                                            <div class="risk-lbl">High</div>
                                        </div>
                                        <div class="risk-card-medium p-1.5 flex-fill">
                                            <div class="risk-val fs-6 tabular-nums">${p.medium_risk_count}</div>
                                            <div class="risk-lbl">Medium</div>
                                        </div>
                                        <div class="risk-card-low p-1.5 flex-fill">
                                            <div class="risk-val fs-6 tabular-nums">${p.low_risk_count}</div>
                                            <div class="risk-lbl">Low</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex align-items-center justify-content-between border-top pt-2.5 mt-2 flex-wrap gap-2">
                                <div class="small text-muted me-auto">
                                    Total: <strong class="text-dark tabular-nums">${p.total_korban}</strong> Penyintas
                                </div>
                                <a href="${basePoskoUrl}${p.id}" class="frost-btn-primary">
                                    Buka Posko <i class="bi bi-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>`;
            });
            container.innerHTML = html;
        }

        function escapeHtml(str) {
            if (!str) return '';
            return str.replace(/[&<>"']/g, function (m) {
                return { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#039;' }[m];
            });
        }
    });
</script>
<?= $this->endSection() ?>