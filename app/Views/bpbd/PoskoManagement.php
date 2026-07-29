<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<!-- Frosted Glass UI Custom Styling & PsyAid Light Green Theme (Max Rounded: 8px / lg) -->
<style>
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
    .frost-search-input,
    .frost-btn-search-submit,
    .frost-btn-primary,
    .posko-item-card,
    .posko-info-box,
    .posko-details-box,
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
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.92) 0%, rgba(244, 251, 247, 0.75) 100%);
        backdrop-filter: blur(12px) saturate(160%);
        -webkit-backdrop-filter: blur(12px) saturate(160%);
        border: 1px solid rgba(226, 232, 240, 0.8);
        box-shadow: 0 8px 24px -4px rgba(15, 23, 42, 0.06),
            0 2px 6px -1px rgba(15, 23, 42, 0.02),
            inset 0 1px 1.5px 0 rgba(255, 255, 255, 0.95);
        transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .frost-card:hover {
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.98) 0%, rgba(236, 253, 245, 0.85) 100%);
        border-color: rgba(16, 185, 129, 0.4);
        box-shadow: 0 14px 32px -4px rgba(16, 185, 129, 0.12),
            0 4px 10px -2px rgba(15, 23, 42, 0.04),
            inset 0 1px 2px 0 rgba(255, 255, 255, 1);
        transform: translateY(-2px);
    }

    .frost-card-filter {
        position: relative;
        z-index: 100;
        overflow: visible !important;
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
        font-size: 0.78125rem;
        padding: 0.4rem 0.85rem;
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

    .frost-custom-trigger.active .chevron-icon {
        transform: rotate(180deg);
    }

    /* CUSTOM FROSTED INPUT FIELD COMPONENT (MATCHING FROST-CUSTOM-TRIGGER) */
    .frost-input-field {
        background: #ffffff;
        border: 1.5px solid #cbd5e1;
        border-radius: 8px !important;
        padding: 0.55rem 0.85rem;
        font-size: 0.875rem;
        font-weight: 600;
        color: #0f172a;
        width: 100%;
        transition: all 0.2s ease;
        box-shadow: 0 1px 3px rgba(15, 23, 42, 0.04);
    }

    .frost-input-field:hover:not(:disabled) {
        border-color: #059669;
        background-color: #f4fbf7;
    }

    .frost-input-field:focus {
        border-color: #059669;
        box-shadow: 0 0 0 3.5px rgba(5, 150, 105, 0.18);
        background-color: #ffffff;
        outline: none;
    }

    .frost-input-field::placeholder {
        color: #94a3b8;
        font-weight: 500;
    }

    /* SEARCHABLE CUSTOM FROSTED DROPDOWN SYSTEM */
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
        border-radius: 6px !important;
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

    /* CUSTOM FROSTED SEARCH BAR WITH ACTION BUTTON (MATCHING COMMANDCENTER FROST-BTN-POSKO) */
    .frost-search-group {
        display: flex;
        align-items: center;
        width: 100%;
        gap: 0.5rem;
    }

    .frost-search-input-wrapper {
        position: relative;
        display: flex;
        align-items: center;
        flex: 1;
    }

    .frost-search-icon-inside {
        position: absolute;
        left: 1rem;
        color: #059669;
        font-size: 1rem;
        pointer-events: none;
    }

    .frost-search-input {
        width: 100%;
        background: #ffffff;
        border: 1.5px solid #cbd5e1;
        padding: 0.6rem 2.25rem 0.6rem 2.65rem;
        font-size: 0.875rem;
        font-weight: 600;
        color: #0f172a;
        text-align: left;
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 1px 3px rgba(15, 23, 42, 0.04);
    }

    .frost-search-input:focus {
        background: #ffffff;
        border-color: #059669;
        box-shadow: 0 0 0 3.5px rgba(5, 150, 105, 0.18);
        outline: none;
    }

    .frost-search-clear-inside {
        position: absolute;
        right: 0.75rem;
        color: #94a3b8;
        font-size: 1rem;
        cursor: pointer;
        background: none;
        border: none;
        padding: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: color 0.2s ease;
    }

    .frost-search-clear-inside:hover {
        color: #dc2626;
    }

    .frost-btn-search-submit {
        background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
        color: #065f46 !important;
        border: 1.5px solid #34d399;
        border-radius: 8px !important;
        font-weight: 700;
        font-size: 0.85rem;
        padding: 0.6rem 1.25rem;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.4rem;
        cursor: pointer;
        transition: all 0.2s ease;
        box-shadow: 0 2px 6px rgba(16, 185, 129, 0.15);
        white-space: nowrap;
        flex-shrink: 0;
    }

    .frost-btn-search-submit:hover {
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

    /* POSKO CARD POLISHED STYLING & HIGH CONTRAST BADGES */
    .posko-card-body {
        padding: 1.15rem !important;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        height: 100%;
    }

    .badge-urgent {
        background-color: #fef2f2 !important;
        color: #dc2626 !important;
        border: 1px solid #fecdd3 !important;
        font-weight: 700 !important;
        font-size: 0.75rem !important;
        padding: 0.35rem 0.65rem !important;
    }

    .badge-open {
        background-color: #ecfdf5 !important;
        color: #047857 !important;
        border: 1px solid #a7f3d0 !important;
        font-weight: 700 !important;
        font-size: 0.75rem !important;
        padding: 0.35rem 0.65rem !important;
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

    /* CUSTOM CARD ACTION BUTTONS MATCHING BADGE BENCANA & BADGE URGENT */
    .btn-posko-edit {
        background-color: #eff6ff !important;
        color: #1d4ed8 !important;
        border: 1.5px solid #bfdbfe !important;
        font-weight: 700 !important;
        font-size: 0.75rem !important;
        padding: 0.35rem 0.85rem !important;
        border-radius: 6px !important;
        transition: all 0.2s ease-in-out !important;
        box-shadow: 0 1px 2px rgba(29, 78, 216, 0.05) !important;
    }

    .btn-posko-edit:hover {
        background-color: #1d4ed8 !important;
        color: #ffffff !important;
        border-color: #1d4ed8 !important;
        box-shadow: 0 4px 12px rgba(29, 78, 216, 0.25) !important;
        transform: translateY(-1px) !important;
    }

    .btn-posko-delete {
        background-color: #fef2f2 !important;
        color: #dc2626 !important;
        border: 1.5px solid #fecdd3 !important;
        font-weight: 700 !important;
        font-size: 0.75rem !important;
        padding: 0.35rem 0.85rem !important;
        border-radius: 6px !important;
        transition: all 0.2s ease-in-out !important;
        box-shadow: 0 1px 2px rgba(220, 38, 38, 0.05) !important;
    }

    .btn-posko-delete:hover {
        background-color: #dc2626 !important;
        color: #ffffff !important;
        border-color: #dc2626 !important;
        box-shadow: 0 4px 12px rgba(220, 38, 38, 0.25) !important;
        transform: translateY(-1px) !important;
    }

    .posko-info-box {
        background-color: #f8fafc !important;
        border: 1px solid #e2e8f0 !important;
        border-radius: 8px !important;
        padding: 0.85rem !important;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.02) !important;
    }

    .posko-details-box {
        background-color: #f8fafc !important;
        border: 1px solid #e2e8f0 !important;
        border-radius: 8px !important;
        padding: 0.85rem !important;
        font-size: 0.8125rem !important;
        color: #334155 !important;
    }

    .step-num-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 20px;
        height: 20px;
        border-radius: 4px !important;
        background-color: #ecfdf5;
        color: #047857;
        font-size: 0.7rem;
        font-weight: 700;
        margin-right: 6px;
        border: 1px solid #a7f3d0;
    }

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
        border-radius: 6px !important;
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

    /* Mobile Responsive Spacing & Layout Optimization for Filter Card & Search Bar */
    @media (max-width: 767.98px) {
        .frost-card-filter {
            padding: 1.25rem 1rem !important;
            margin-bottom: 1.25rem !important;
        }

        .frost-card-filter .border-bottom {
            padding-bottom: 0.85rem !important;
            margin-bottom: 1rem !important;
        }

        .frost-custom-trigger,
        .frost-search-input {
            min-height: 44px;
            font-size: 0.875rem;
            padding-top: 0.6rem;
            padding-bottom: 0.6rem;
        }

        .frost-custom-option {
            padding: 0.75rem 0.85rem;
            font-size: 0.875rem;
        }

        #filter-manage-form {
            --bs-gutter-y: 1.15rem;
        }

        #filter-manage-form .form-label {
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

        /* Section 3 Header Mobile Optimizations: Clean 2-Row Mobile Layout */
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

    /* Mobile Layout Optimizations for Search Bar (< 575.98px) */
    @media (max-width: 575.98px) {
        .frost-search-group {
            flex-direction: row !important;
            gap: 0.4rem !important;
            align-items: center !important;
            width: 100% !important;
        }

        .frost-search-input-wrapper {
            flex: 1 !important;
            min-width: 0 !important;
            width: 100% !important;
        }

        .frost-search-input {
            text-align: left !important;
            padding-left: 2.35rem !important;
            padding-right: 2rem !important;
            font-size: 0.8125rem !important;
        }

        .frost-btn-search-submit {
            width: auto !important;
            padding: 0.5rem 0.75rem !important;
            font-size: 0.75rem !important;
            gap: 0.25rem !important;
            flex-shrink: 0 !important;
            border-radius: 8px !important;
        }

        .frost-btn-search-submit span {
            font-size: 0.75rem !important;
        }

        .posko-card-header-bar {
            padding: 0.7rem 0.85rem !important;
        }

        .posko-card-header-bar h6 {
            font-size: 0.875rem !important;
            line-height: 1.3 !important;
        }

        .posko-card-body {
            padding: 0.85rem !important;
        }

        .posko-info-box,
        .posko-details-box {
            padding: 0.7rem 0.75rem !important;
            border-radius: 6px !important;
        }

        .posko-details-box {
            font-size: 0.78125rem !important;
        }

        .posko-card-body .btn-outline-primary,
        .posko-card-body .btn-outline-danger {
            padding: 0.35rem 0.65rem !important;
            font-size: 0.75rem !important;
        }
    }
</style>

<!-- Alert Notifications -->
<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert"
        style="background-color: #ecfdf5; color: #047857; border-left: 4px solid #10b981 !important;">
        <i class="bi bi-check-circle-fill me-2 fs-5 align-middle"></i>
        <strong>Berhasil!</strong> <?= session()->getFlashdata('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4" role="alert"
        style="background-color: #fef2f2; color: #991b1b; border-left: 4px solid #ef4444 !important;">
        <i class="bi bi-exclamation-triangle-fill me-2 fs-5 align-middle"></i>
        <strong>Gagal!</strong> <?= session()->getFlashdata('error') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<!-- 1. Hero Header Card -->
<div class="card frost-hero mb-4">
    <div class="card-body p-4 position-relative">
        <div class="row align-items-center g-3">
            <div class="col-12">
                <div class="d-flex align-items-center gap-2 mb-2 flex-wrap">
                    <span class="badge px-3 py-1.5 fs-8 fw-bold"
                        style="background-color: rgba(6, 95, 70, 0.12); color: #065f46; border: 1px solid rgba(6, 95, 70, 0.25);">
                        <i class="bi bi-house-gear-fill me-1"></i> MANAJEMEN POSKO BENCANA
                    </span>
                    <span class="badge px-3 py-1.5 fs-8"
                        style="background-color: rgba(6, 95, 70, 0.08); color: #047857; border: 1px solid rgba(6, 95, 70, 0.18);">
                        BPBD Panel
                    </span>
                </div>
                <h3 class="fw-bold mb-1" style="color: #064e3b;">
                    <i class="bi bi-geo-alt-fill me-2" style="color: #059669;"></i> Kelola Posko Kebencanaan
                </h3>
                <p class="small mb-0" style="color: #047857; max-width: 75ch;">
                    Tambah, perbarui, dan atur kuota relawan posko bencana berdasarkan Provinsi, Kabupaten/Kota, dan
                    Jenis Bencana. Posko aktif secara otomatis akan ditayangkan pada portal Rekrutmen Relawan.
                </p>
            </div>
        </div>
    </div>
</div>

<!-- 2. Cascading Select & Search Filter Bar (Frosted Floating Dropdown UI System) -->
<div class="card frost-card frost-card-filter p-3.5 p-md-4 mb-4">
    <div class="d-flex align-items-center justify-content-between mb-3 border-bottom pb-3 flex-wrap gap-2">
        <h6 class="fw-bold text-dark mb-0 d-flex align-items-center">
            <i class="bi bi-funnel-fill text-success me-2 fs-5"></i> Filter Pembagian Posko
        </h6>
        <!-- Desktop Reset Button -->
        <div class="d-none d-md-flex align-items-center">
            <a href="<?= site_url('/bpbd/manage-posko') ?>" id="btn-reset-filter"
                class="frost-btn-reset text-decoration-none">
                <i class="bi bi-arrow-counterclockwise"></i> Reset Filter
            </a>
        </div>
    </div>

    <form id="filter-manage-form" method="GET" action="<?= site_url('/bpbd/manage-posko') ?>" class="row g-3">
        <!-- Hidden Native Selects for Form Submission & Sync -->
        <select id="filter-provinsi" name="province_id" class="d-none">
            <option value="">Semua Provinsi</option>
            <?php foreach ($provinces as $prov): ?>
                <option value="<?= esc($prov['id']) ?>" <?= $filterProvinceId == $prov['id'] ? 'selected' : '' ?>>
                    <?= esc($prov['name']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <select id="filter-kabupaten" name="regency_id" class="d-none" <?= empty($filterProvinceId) ? 'disabled' : '' ?>>
            <option value=""><?= empty($filterProvinceId) ? 'Pilih Provinsi Dahulu' : 'Semua Kabupaten' ?></option>
            <?php foreach ($regencies as $reg): ?>
                <option value="<?= esc($reg['id']) ?>" <?= $filterRegencyId == $reg['id'] ? 'selected' : '' ?>>
                    <?= esc($reg['name']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <select id="filter-bencana" name="jenis_bencana" class="d-none">
            <option value="">Semua Jenis Bencana</option>
            <?php foreach ($distinctJenisBencana as $jb): ?>
                <option value="<?= esc($jb) ?>" <?= $filterJenisBencana == $jb ? 'selected' : '' ?>>
                    <?= esc($jb) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <select id="filter-status" name="status" class="d-none">
            <option value="">Semua Status</option>
            <option value="aktif" <?= $filterStatus === 'aktif' ? 'selected' : '' ?>>Aktif</option>
            <option value="recovery" <?= $filterStatus === 'recovery' ? 'selected' : '' ?>>Recovery</option>
            <option value="closed" <?= $filterStatus === 'closed' ? 'selected' : '' ?>>Closed</option>
        </select>

        <?php
        // Helper text lookup for selected labels
        $selectedProvName = 'Semua Provinsi';
        if (!empty($filterProvinceId)) {
            foreach ($provinces as $pr) {
                if ($pr['id'] == $filterProvinceId) {
                    $selectedProvName = $pr['name'];
                    break;
                }
            }
        }

        $selectedKabName = empty($filterProvinceId) ? 'Pilih Provinsi Dahulu' : 'Semua Kabupaten';
        if (!empty($filterRegencyId)) {
            foreach ($regencies as $rg) {
                if ($rg['id'] == $filterRegencyId) {
                    $selectedKabName = $rg['name'];
                    break;
                }
            }
        }

        $selectedBencanaName = !empty($filterJenisBencana) ? $filterJenisBencana : 'Semua Jenis Bencana';
        $selectedStatusName = !empty($filterStatus) ? ucfirst($filterStatus) : 'Semua Status';
        ?>

        <!-- 1. Custom Floating Dropdown: Provinsi -->
        <div class="col-12 col-sm-6 col-lg-3">
            <label class="form-label small fw-bold text-secondary mb-1.5 d-flex align-items-center">
                <span class="step-num-badge">1</span> Provinsi
            </label>
            <div class="frost-custom-select-wrapper" id="custom-wrapper-provinsi">
                <div class="frost-custom-trigger" id="trigger-provinsi">
                    <span class="trigger-label text-truncate"><?= esc($selectedProvName) ?></span>
                    <i class="bi bi-chevron-down chevron-icon"></i>
                </div>
                <div class="frost-custom-menu" id="menu-provinsi">
                    <div class="frost-custom-option <?= empty($filterProvinceId) ? 'selected' : '' ?>" data-value="">
                        Semua Provinsi</div>
                    <?php foreach ($provinces as $prov): ?>
                        <div class="frost-custom-option <?= $filterProvinceId == $prov['id'] ? 'selected' : '' ?>"
                            data-value="<?= esc($prov['id']) ?>">
                            <?= esc($prov['name']) ?>
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
                <div class="frost-custom-trigger <?= empty($filterProvinceId) ? 'disabled' : '' ?>"
                    id="trigger-kabupaten">
                    <span class="trigger-label text-truncate"><?= esc($selectedKabName) ?></span>
                    <i class="bi bi-chevron-down chevron-icon"></i>
                </div>
                <div class="frost-custom-menu" id="menu-kabupaten">
                    <div class="frost-custom-option <?= empty($filterRegencyId) ? 'selected' : '' ?>" data-value="">
                        <?= empty($filterProvinceId) ? 'Pilih Provinsi Dahulu' : 'Semua Kabupaten' ?>
                    </div>
                    <?php foreach ($regencies as $reg): ?>
                        <div class="frost-custom-option <?= $filterRegencyId == $reg['id'] ? 'selected' : '' ?>"
                            data-value="<?= esc($reg['id']) ?>">
                            <?= esc($reg['name']) ?>
                        </div>
                    <?php endforeach; ?>
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
                    <span class="trigger-label text-truncate"><?= esc($selectedBencanaName) ?></span>
                    <i class="bi bi-chevron-down chevron-icon"></i>
                </div>
                <div class="frost-custom-menu" id="menu-bencana">
                    <div class="frost-custom-option <?= empty($filterJenisBencana) ? 'selected' : '' ?>" data-value="">
                        Semua Jenis Bencana</div>
                    <?php foreach ($distinctJenisBencana as $jb): ?>
                        <div class="frost-custom-option <?= $filterJenisBencana == $jb ? 'selected' : '' ?>"
                            data-value="<?= esc($jb) ?>">
                            <?= esc($jb) ?>
                        </div>
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
                    <span class="trigger-label text-truncate"><?= esc($selectedStatusName) ?></span>
                    <i class="bi bi-chevron-down chevron-icon"></i>
                </div>
                <div class="frost-custom-menu" id="menu-status">
                    <div class="frost-custom-option <?= empty($filterStatus) ? 'selected' : '' ?>" data-value="">Semua
                        Status</div>
                    <div class="frost-custom-option <?= $filterStatus === 'aktif' ? 'selected' : '' ?>"
                        data-value="aktif">Aktif</div>
                    <div class="frost-custom-option <?= $filterStatus === 'recovery' ? 'selected' : '' ?>"
                        data-value="recovery">Recovery</div>
                    <div class="frost-custom-option <?= $filterStatus === 'closed' ? 'selected' : '' ?>"
                        data-value="closed">Closed</div>
                </div>
            </div>
        </div>

        <!-- Custom Search Bar with Working Search Button (Mobile Inline & Right Aligned Button) -->
        <div class="col-12">
            <div class="frost-search-group">
                <div class="frost-search-input-wrapper">
                    <i class="bi bi-search frost-search-icon-inside"></i>
                    <input type="text" name="q" id="search-input-query" class="frost-search-input"
                        placeholder="Cari nama posko, lokasi, atau jenis bencana..." value="<?= esc($searchQuery) ?>"
                        autocomplete="off">
                    <?php if (!empty($searchQuery)): ?>
                        <button type="button" id="btn-clear-search" class="frost-search-clear-inside"
                            title="Bersihkan Pencarian">
                            <i class="bi bi-x-circle-fill"></i>
                        </button>
                    <?php else: ?>
                        <button type="button" id="btn-clear-search" class="frost-search-clear-inside d-none"
                            title="Bersihkan Pencarian">
                            <i class="bi bi-x-circle-fill"></i>
                        </button>
                    <?php endif; ?>
                </div>
                <button type="submit" id="btn-submit-search" class="frost-btn-search-submit">
                    <i class="bi bi-search"></i>
                    <span>Cari Posko</span>
                </button>
            </div>
        </div>
    </form>

    <!-- Active Filter Chips -->
    <?php
    $hasActiveFilters = !empty($filterProvinceId) || !empty($filterRegencyId) || !empty($filterJenisBencana) || !empty($filterStatus) || !empty($searchQuery);
    ?>
    <div id="active-filters-chips-container" class="<?= $hasActiveFilters ? '' : 'd-none' ?> mt-3 pt-2.5 border-top">
        <div class="d-flex align-items-center flex-wrap gap-2">
            <span class="fs-8 fw-semibold text-muted me-1"><i class="bi bi-tags me-1"></i> Filter Aktif:</span>
            <div id="active-chips-list" class="d-flex flex-wrap gap-1.5">
                <?php if (!empty($filterProvinceId)): ?>
                    <span class="badge bg-light text-dark border px-2 py-1 fs-8 me-1">Prov:
                        <?= esc($selectedProvName) ?></span>
                <?php endif; ?>
                <?php if (!empty($filterRegencyId)): ?>
                    <span class="badge bg-light text-dark border px-2 py-1 fs-8 me-1">Kab:
                        <?= esc($selectedKabName) ?></span>
                <?php endif; ?>
                <?php if (!empty($filterJenisBencana)): ?>
                    <span class="badge bg-light text-dark border px-2 py-1 fs-8 me-1">Bencana:
                        <?= esc($filterJenisBencana) ?></span>
                <?php endif; ?>
                <?php if (!empty($filterStatus)): ?>
                    <span class="badge bg-light text-dark border px-2 py-1 fs-8 me-1">Status:
                        <?= esc(ucfirst($filterStatus)) ?></span>
                <?php endif; ?>
                <?php if (!empty($searchQuery)): ?>
                    <span class="badge bg-light text-dark border px-2 py-1 fs-8 me-1">Cari:
                        "<?= esc($searchQuery) ?>"</span>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Mobile Reset Button -->
    <div
        class="d-flex d-md-none align-items-center justify-content-end frost-mobile-reset-wrapper border-top mt-3 pt-2">
        <a href="<?= site_url('/bpbd/manage-posko') ?>" class="frost-btn-reset-sm text-decoration-none">
            <i class="bi bi-arrow-counterclockwise"></i> Reset Filter
        </a>
    </div>
</div>

<!-- 3. Posko Grid Main Card Container (Mobile Responsive Clean Layout) -->
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
                style="background-color: rgba(6, 95, 70, 0.08); color: #047857; border: 1px solid rgba(6, 95, 70, 0.18); font-weight: 700;">
                <i class="bi bi-layers-fill me-1" style="font-size: 0.7rem;"></i> <?= count($poskoList) ?> Total
            </span>
        </div>
        <!-- Primary Action Button Wrapper -->
        <div class="posko-header-btn-wrapper">
            <button type="button" class="frost-btn-primary rounded-lg" data-bs-toggle="modal"
                data-bs-target="#createPoskoModal">
                <i class="bi bi-plus-lg fs-7 me-1"></i> Tambah Posko Baru
            </button>
        </div>
    </div>

    <!-- Inner Posko Cards Grid -->
    <div class="row g-3">
        <?php if (empty($poskoList)): ?>
            <div class="col-12">
                <div class="p-4 text-center text-muted">
                    <i class="bi bi-inbox fs-2 d-block mb-2 text-secondary"></i>
                    <h6 class="fw-bold text-dark mb-1">Tidak Ada Data Posko</h6>
                    <p class="small text-muted mb-0">Belum ada posko yang dibuat atau sesuai dengan filter yang Anda
                        tentukan.</p>
                </div>
            </div>
        <?php else: ?>
            <?php foreach ($poskoList as $posko): ?>
                <div class="col-12 col-md-6 col-xl-4">
                    <div class="card posko-item-card h-100 overflow-hidden">
                        <!-- Soft Mint Header Bar -->
                        <div class="posko-card-header-bar d-flex align-items-center justify-content-between gap-2">
                            <h6 class="fw-bold mb-0 text-truncate" title="<?= esc($posko['name']) ?>"
                                style="font-size: 0.98rem; color: #064e3b !important;">
                                <?= esc($posko['name']) ?>
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
                                <!-- Location Info -->
                                <div class="small mb-3 d-flex align-items-center gap-1 text-secondary">
                                    <i class="bi bi-geo-alt-fill text-danger me-1"></i>
                                    <span class="fw-bold text-dark"><?= esc($posko['regency_name'] ?? 'Kabupaten') ?></span>,
                                    <span><?= esc($posko['province_name'] ?? 'Provinsi') ?></span>
                                </div>

                                <!-- Badges Bar (Jenis Bencana & Urgensi Status) -->
                                <div class="d-flex align-items-center flex-wrap gap-2 mb-3">
                                    <span class="badge badge-bencana rounded-2">
                                        <i class="bi bi-tag-fill me-1"></i><?= esc($posko['jenis_bencana']) ?>
                                    </span>
                                    <?php if (($posko['urgency'] ?? 'Urgent') === 'Urgent'): ?>
                                        <span class="badge badge-urgent rounded-2">
                                            <i class="bi bi-exclamation-triangle-fill me-1"></i>Urgent
                                        </span>
                                    <?php else: ?>
                                        <span class="badge badge-open rounded-2">
                                            <i class="bi bi-check-circle-fill me-1"></i>Terbuka
                                        </span>
                                    <?php endif; ?>
                                </div>

                                <!-- Volunteer Quota Progress Box -->
                                <div class="posko-info-box mb-3">
                                    <div class="d-flex justify-content-between text-muted fs-8 fw-bold mb-1.5">
                                        <span class="text-secondary"><i class="bi bi-people-fill me-1 text-success"></i> Slot
                                            Relawan Terisi</span>
                                        <span class="text-dark tabular-nums fw-bold">
                                            <span
                                                class="text-success fs-7 fw-extrabold"><?= $posko['approved_volunteers'] ?></span>
                                            / <?= $posko['quota'] ?> Personel
                                        </span>
                                    </div>
                                    <div class="progress mb-1" style="height: 8px; background-color: #e2e8f0;">
                                        <div class="progress-bar bg-success rounded-2" role="progressbar"
                                            style="width: <?= round(($posko['approved_volunteers'] / max(1, $posko['quota'])) * 100) ?>%">
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center fs-9 text-muted">
                                        <span>Cakupan Slot Terisi</span>
                                        <span class="fw-bold text-success tabular-nums">
                                            <?= round(($posko['approved_volunteers'] / max(1, $posko['quota'])) * 100) ?>%
                                        </span>
                                    </div>
                                </div>

                                <!-- Details Box (Requirements, Contact Info) -->
                                <?php if (!empty($posko['requirements']) || !empty($posko['contact_person'])): ?>
                                    <div class="posko-details-box mb-3">
                                        <?php if (!empty($posko['requirements'])): ?>
                                            <?php 
                                                $reqItems = [];
                                                if (strpos($posko['requirements'], "\n") !== false) {
                                                    $reqItems = array_values(array_filter(array_map('trim', explode("\n", $posko['requirements']))));
                                                } else if (strpos($posko['requirements'], ",") !== false) {
                                                    $reqItems = array_values(array_filter(array_map('trim', explode(",", $posko['requirements']))));
                                                } else {
                                                    $reqItems = [trim($posko['requirements'])];
                                                }
                                            ?>
                                            <div class="mb-1.5">
                                                <strong class="text-dark d-block mb-1"><i class="bi bi-card-checklist me-1 text-warning"></i>
                                                    Syarat Khusus:</strong>
                                                <?php if (count($reqItems) > 1): ?>
                                                    <ol class="ps-3 mb-0 text-slate-800 fs-8">
                                                        <?php foreach ($reqItems as $rq): ?>
                                                            <li class="mb-0.5"><?= esc($rq) ?></li>
                                                        <?php endforeach; ?>
                                                    </ol>
                                                <?php else: ?>
                                                    <span class="text-slate-800 fs-8"><?= esc($reqItems[0] ?? '') ?></span>
                                                <?php endif; ?>
                                            </div>
                                        <?php endif; ?>

                                        <?php if (!empty($posko['contact_person'])): ?>
                                            <div>
                                                <strong class="text-dark"><i class="bi bi-telephone-fill me-1 text-success"></i>
                                                    Kontak:</strong>
                                                <span class="fw-bold text-success"><?= esc($posko['contact_person']) ?></span>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <!-- Card Footer Action Buttons -->
                            <div class="d-flex align-items-center justify-content-end gap-2 border-top pt-3 mt-2">
                                <button type="button" class="btn btn-sm btn-posko-edit"
                                    onclick="openEditModal(<?= htmlspecialchars(json_encode($posko), ENT_QUOTES, 'UTF-8') ?>)">
                                    <i class="bi bi-pencil-square me-1"></i> Edit
                                </button>
                                <button type="button" class="btn btn-sm btn-posko-delete"
                                    onclick="openDeleteModal(<?= $posko['id'] ?>, '<?= esc($posko['name'], 'js') ?>')">
                                    <i class="bi bi-trash-fill me-1"></i> Hapus
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<!-- Modal 1: Create Posko Modal -->
<div class="modal fade" id="createPoskoModal" tabindex="-1" aria-labelledby="createPoskoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 8px !important;">
            <div class="modal-header border-bottom p-4"
                style="background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 100%);">
                <h5 class="modal-title fw-bold text-dark" id="createPoskoModalLabel">
                    <i class="bi bi-house-add-fill text-success me-2"></i> Tambah Posko Kebencanaan Baru
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="<?= site_url('/bpbd/manage-posko/store') ?>" method="POST" class="p-4">
                <?= csrf_field() ?>

                <div class="row g-3">
                    <div class="col-12 col-md-8">
                        <label class="form-label small fw-bold text-dark">Nama Posko Kebencanaan <span
                                class="text-danger">*</span></label>
                        <input type="text" name="name" class="frost-input-field"
                            placeholder="Contoh: Posko Tanggap Cianjur 01" required>
                    </div>

                    <div class="col-12 col-md-4">
                        <label class="form-label small fw-bold text-dark">Jenis Bencana <span
                                class="text-danger">*</span></label>
                        <select name="jenis_bencana" id="create-jenis_bencana" class="d-none" required>
                            <option value="">Pilih Jenis Bencana</option>
                            <option value="Gempa Bumi">Gempa Bumi</option>
                            <option value="Banjir">Banjir</option>
                            <option value="Tanah Longsor">Tanah Longsor</option>
                            <option value="Erupsi Gunung">Erupsi Gunung</option>
                            <option value="Tsunami">Tsunami</option>
                            <option value="Angin Puting Beliung">Angin Puting Beliung</option>
                            <option value="Kebakaran Hutan">Kebakaran Hutan</option>
                        </select>
                        <div class="frost-custom-select-wrapper" id="custom-wrapper-create-bencana">
                            <div class="frost-custom-trigger" id="trigger-create-bencana">
                                <span class="trigger-label text-truncate">Pilih Jenis Bencana</span>
                                <i class="bi bi-chevron-down chevron-icon"></i>
                            </div>
                            <div class="frost-custom-menu" id="menu-create-bencana">
                                <div class="frost-custom-option selected" data-value="">Pilih Jenis Bencana</div>
                                <div class="frost-custom-option" data-value="Gempa Bumi">Gempa Bumi</div>
                                <div class="frost-custom-option" data-value="Banjir">Banjir</div>
                                <div class="frost-custom-option" data-value="Tanah Longsor">Tanah Longsor</div>
                                <div class="frost-custom-option" data-value="Erupsi Gunung">Erupsi Gunung</div>
                                <div class="frost-custom-option" data-value="Tsunami">Tsunami</div>
                                <div class="frost-custom-option" data-value="Angin Puting Beliung">Angin Puting Beliung
                                </div>
                                <div class="frost-custom-option" data-value="Kebakaran Hutan">Kebakaran Hutan</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label small fw-bold text-dark">Provinsi <span
                                class="text-danger">*</span></label>
                        <select name="province_id" id="create-province_id" class="d-none" required>
                            <option value="">Pilih Provinsi</option>
                            <?php foreach ($provinces as $prov): ?>
                                <option value="<?= esc($prov['id']) ?>"><?= esc($prov['name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="frost-custom-select-wrapper" id="custom-wrapper-create-provinsi">
                            <div class="frost-custom-trigger" id="trigger-create-provinsi">
                                <span class="trigger-label text-truncate">Pilih Provinsi</span>
                                <i class="bi bi-chevron-down chevron-icon"></i>
                            </div>
                            <div class="frost-custom-menu" id="menu-create-provinsi">
                                <div class="frost-custom-option selected" data-value="">Pilih Provinsi</div>
                                <?php foreach ($provinces as $prov): ?>
                                    <div class="frost-custom-option" data-value="<?= esc($prov['id']) ?>">
                                        <?= esc($prov['name']) ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label small fw-bold text-dark">Kabupaten / Kota <span
                                class="text-danger">*</span></label>
                        <select name="regency_id" id="create-regency_id" class="d-none" disabled required>
                            <option value="">Pilih Provinsi Dahulu</option>
                        </select>
                        <div class="frost-custom-select-wrapper" id="custom-wrapper-create-kabupaten">
                            <div class="frost-custom-trigger disabled" id="trigger-create-kabupaten">
                                <span class="trigger-label text-truncate">Pilih Provinsi Dahulu</span>
                                <i class="bi bi-chevron-down chevron-icon"></i>
                            </div>
                            <div class="frost-custom-menu" id="menu-create-kabupaten">
                                <div class="frost-custom-option selected" data-value="">Pilih Provinsi Dahulu</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-4">
                        <label class="form-label small fw-bold text-dark">Kuota Relawan Dibutuhkan <span
                                class="text-danger">*</span></label>
                        <input type="number" name="quota" class="frost-input-field" value="10" min="1" max="500"
                            required>
                    </div>

                    <div class="col-12 col-md-4">
                        <label class="form-label small fw-bold text-dark">Tingkat Urgensi <span
                                class="text-danger">*</span></label>
                        <select name="urgency" id="create-urgency" class="d-none" required>
                            <option value="Urgent" selected>Urgent (Dibutuhkan Segera)</option>
                            <option value="Terbuka">Terbuka (Standby Normal)</option>
                        </select>
                        <div class="frost-custom-select-wrapper" id="custom-wrapper-create-urgency">
                            <div class="frost-custom-trigger" id="trigger-create-urgency">
                                <span class="trigger-label text-truncate">Urgent (Dibutuhkan Segera)</span>
                                <i class="bi bi-chevron-down chevron-icon"></i>
                            </div>
                            <div class="frost-custom-menu" id="menu-create-urgency">
                                <div class="frost-custom-option selected" data-value="Urgent">Urgent (Dibutuhkan Segera)
                                </div>
                                <div class="frost-custom-option" data-value="Terbuka">Terbuka (Standby Normal)</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-4">
                        <label class="form-label small fw-bold text-dark">Status Operasional <span
                                class="text-danger">*</span></label>
                        <select name="status" id="create-status" class="d-none" required>
                            <option value="aktif" selected>Aktif (Tayang di Rekrutmen)</option>
                            <option value="recovery">Recovery</option>
                            <option value="closed">Closed (Ditutup)</option>
                        </select>
                        <div class="frost-custom-select-wrapper" id="custom-wrapper-create-status">
                            <div class="frost-custom-trigger" id="trigger-create-status">
                                <span class="trigger-label text-truncate">Aktif (Tayang di Rekrutmen)</span>
                                <i class="bi bi-chevron-down chevron-icon"></i>
                            </div>
                            <div class="frost-custom-menu" id="menu-create-status">
                                <div class="frost-custom-option selected" data-value="aktif">Aktif (Tayang di Rekrutmen)
                                </div>
                                <div class="frost-custom-option" data-value="recovery">Recovery</div>
                                <div class="frost-custom-option" data-value="closed">Closed (Ditutup)</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="d-flex justify-content-between align-items-center mb-1.5">
                            <label class="form-label small fw-bold text-dark mb-0">Persyaratan Khusus Relawan</label>
                            <button type="button" class="btn btn-sm btn-outline-success border-0 fw-bold fs-9 py-0 px-1.5" id="btn-add-create-requirement">
                                <i class="bi bi-plus-circle-fill me-1"></i> Tambah Syarat
                            </button>
                        </div>
                        <div id="create-requirements-wrapper" class="d-flex flex-column gap-2">
                            <div class="d-flex align-items-center gap-2 requirement-item-row">
                                <span class="badge bg-light text-secondary border fw-bold px-2 py-2 fs-9 req-num-label flex-shrink-0" style="min-width: 68px; text-align: center;">Syarat 1</span>
                                <input type="text" name="requirements_options[]" class="frost-input-field form-control form-control-sm flex-grow-1"
                                    placeholder="Contoh: Sehat jasmani &amp; rohani">
                                <button type="button" class="btn btn-sm btn-outline-danger btn-remove-req flex-shrink-0 px-2.5 py-1.5" title="Hapus syarat" style="display:none; border-radius: 6px;">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <label class="form-label small fw-bold text-dark">Kontak Person / Call Center BPBD Posko</label>
                        <input type="text" name="contact_person" class="frost-input-field"
                            placeholder="Contoh: BPBD Cianjur (+62 812-3456-7890)">
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 border-top pt-3 mt-4">
                    <button type="button" class="btn btn-light border fw-semibold fs-8"
                        data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="frost-btn-primary fs-8">Simpan Posko Baru</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal 2: Edit Posko Modal -->
<div class="modal fade" id="editPoskoModal" tabindex="-1" aria-labelledby="editPoskoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 8px !important;">
            <div class="modal-header border-bottom p-4"
                style="background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);">
                <h5 class="modal-title fw-bold text-dark" id="editPoskoModalLabel">
                    <i class="bi bi-pencil-square text-primary me-2"></i> Edit Posko Kebencanaan
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="editPoskoForm" method="POST" class="p-4">
                <?= csrf_field() ?>

                <div class="row g-3">
                    <div class="col-12 col-md-8">
                        <label class="form-label small fw-bold text-dark">Nama Posko Kebencanaan <span
                                class="text-danger">*</span></label>
                        <input type="text" name="name" id="edit-name" class="frost-input-field" required>
                    </div>

                    <div class="col-12 col-md-4">
                        <label class="form-label small fw-bold text-dark">Jenis Bencana <span
                                class="text-danger">*</span></label>
                        <select name="jenis_bencana" id="edit-jenis_bencana" class="d-none" required>
                            <option value="Gempa Bumi">Gempa Bumi</option>
                            <option value="Banjir">Banjir</option>
                            <option value="Tanah Longsor">Tanah Longsor</option>
                            <option value="Erupsi Gunung">Erupsi Gunung</option>
                            <option value="Tsunami">Tsunami</option>
                            <option value="Angin Puting Beliung">Angin Puting Beliung</option>
                            <option value="Kebakaran Hutan">Kebakaran Hutan</option>
                        </select>
                        <div class="frost-custom-select-wrapper" id="custom-wrapper-edit-bencana">
                            <div class="frost-custom-trigger" id="trigger-edit-bencana">
                                <span class="trigger-label text-truncate">Gempa Bumi</span>
                                <i class="bi bi-chevron-down chevron-icon"></i>
                            </div>
                            <div class="frost-custom-menu" id="menu-edit-bencana">
                                <div class="frost-custom-option" data-value="Gempa Bumi">Gempa Bumi</div>
                                <div class="frost-custom-option" data-value="Banjir">Banjir</div>
                                <div class="frost-custom-option" data-value="Tanah Longsor">Tanah Longsor</div>
                                <div class="frost-custom-option" data-value="Erupsi Gunung">Erupsi Gunung</div>
                                <div class="frost-custom-option" data-value="Tsunami">Tsunami</div>
                                <div class="frost-custom-option" data-value="Angin Puting Beliung">Angin Puting Beliung
                                </div>
                                <div class="frost-custom-option" data-value="Kebakaran Hutan">Kebakaran Hutan</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label small fw-bold text-dark">Provinsi <span
                                class="text-danger">*</span></label>
                        <select name="province_id" id="edit-province_id" class="d-none" required>
                            <?php foreach ($provinces as $prov): ?>
                                <option value="<?= esc($prov['id']) ?>"><?= esc($prov['name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="frost-custom-select-wrapper" id="custom-wrapper-edit-provinsi">
                            <div class="frost-custom-trigger" id="trigger-edit-provinsi">
                                <span class="trigger-label text-truncate">Pilih Provinsi</span>
                                <i class="bi bi-chevron-down chevron-icon"></i>
                            </div>
                            <div class="frost-custom-menu" id="menu-edit-provinsi">
                                <?php foreach ($provinces as $prov): ?>
                                    <div class="frost-custom-option" data-value="<?= esc($prov['id']) ?>">
                                        <?= esc($prov['name']) ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label small fw-bold text-dark">Kabupaten / Kota <span
                                class="text-danger">*</span></label>
                        <select name="regency_id" id="edit-regency_id" class="d-none" required>
                            <option value="">Pilih Provinsi Dahulu</option>
                        </select>
                        <div class="frost-custom-select-wrapper" id="custom-wrapper-edit-kabupaten">
                            <div class="frost-custom-trigger disabled" id="trigger-edit-kabupaten">
                                <span class="trigger-label text-truncate">Pilih Provinsi Dahulu</span>
                                <i class="bi bi-chevron-down chevron-icon"></i>
                            </div>
                            <div class="frost-custom-menu" id="menu-edit-kabupaten">
                                <div class="frost-custom-option selected" data-value="">Pilih Provinsi Dahulu</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-4">
                        <label class="form-label small fw-bold text-dark">Kuota Relawan Dibutuhkan <span
                                class="text-danger">*</span></label>
                        <input type="number" name="quota" id="edit-quota" class="frost-input-field" min="1" max="500"
                            required>
                    </div>

                    <div class="col-12 col-md-4">
                        <label class="form-label small fw-bold text-dark">Tingkat Urgensi <span
                                class="text-danger">*</span></label>
                        <select name="urgency" id="edit-urgency" class="d-none" required>
                            <option value="Urgent">Urgent (Dibutuhkan Segera)</option>
                            <option value="Terbuka">Terbuka (Standby Normal)</option>
                        </select>
                        <div class="frost-custom-select-wrapper" id="custom-wrapper-edit-urgency">
                            <div class="frost-custom-trigger" id="trigger-edit-urgency">
                                <span class="trigger-label text-truncate">Urgent (Dibutuhkan Segera)</span>
                                <i class="bi bi-chevron-down chevron-icon"></i>
                            </div>
                            <div class="frost-custom-menu" id="menu-edit-urgency">
                                <div class="frost-custom-option" data-value="Urgent">Urgent (Dibutuhkan Segera)</div>
                                <div class="frost-custom-option" data-value="Terbuka">Terbuka (Standby Normal)</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-4">
                        <label class="form-label small fw-bold text-dark">Status Operasional <span
                                class="text-danger">*</span></label>
                        <select name="status" id="edit-status" class="d-none" required>
                            <option value="aktif">Aktif (Tayang di Rekrutmen)</option>
                            <option value="recovery">Recovery</option>
                            <option value="closed">Closed (Ditutup)</option>
                        </select>
                        <div class="frost-custom-select-wrapper" id="custom-wrapper-edit-status">
                            <div class="frost-custom-trigger" id="trigger-edit-status">
                                <span class="trigger-label text-truncate">Aktif (Tayang di Rekrutmen)</span>
                                <i class="bi bi-chevron-down chevron-icon"></i>
                            </div>
                            <div class="frost-custom-menu" id="menu-edit-status">
                                <div class="frost-custom-option" data-value="aktif">Aktif (Tayang di Rekrutmen)</div>
                                <div class="frost-custom-option" data-value="recovery">Recovery</div>
                                <div class="frost-custom-option" data-value="closed">Closed (Ditutup)</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="d-flex justify-content-between align-items-center mb-1.5">
                            <label class="form-label small fw-bold text-dark mb-0">Persyaratan Khusus Relawan</label>
                            <button type="button" class="btn btn-sm btn-outline-success border-0 fw-bold fs-9 py-0 px-1.5" id="btn-add-edit-requirement">
                                <i class="bi bi-plus-circle-fill me-1"></i> Tambah Syarat
                            </button>
                        </div>
                        <div id="edit-requirements-wrapper" class="d-flex flex-column gap-2">
                            <!-- Populated dynamically via JS -->
                        </div>
                    </div>

                    <div class="col-12">
                        <label class="form-label small fw-bold text-dark">Kontak Person / Call Center BPBD Posko</label>
                        <input type="text" name="contact_person" id="edit-contact_person" class="frost-input-field">
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 border-top pt-3 mt-4">
                    <button type="button" class="btn btn-light border fw-semibold fs-8"
                        data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary fw-bold fs-8 px-4">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal 3: Delete Confirmation Modal -->
<div class="modal fade" id="deletePoskoModal" tabindex="-1" aria-labelledby="deletePoskoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 8px !important;">
            <div class="modal-body text-center p-4">
                <div class="avatar-lg bg-danger bg-opacity-10 text-danger rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center"
                    style="width: 54px; height: 54px;">
                    <i class="bi bi-trash-fill fs-3"></i>
                </div>
                <h6 class="fw-bold text-dark mb-1">Hapus Posko Kebencanaan?</h6>
                <p class="small text-muted mb-4" id="delete-posko-name-text">Apakah Anda yakin ingin menghapus posko
                    ini?</p>

                <form id="deletePoskoForm" method="POST">
                    <?= csrf_field() ?>
                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-light border w-100 fw-semibold fs-8"
                            data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger w-100 fw-bold fs-8">Hapus Posko</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript for Custom Floating Dropdowns, Search Button Submission & Cascading Select -->
<script>
    let ALL_REGENCIES_MAP = <?= $allRegenciesJson ?? '{}' ?>;
    const regencyCache = {};

    function escapeHtml(text) {
        if (!text) return '';
        return String(text)
            .replace(/&/g, "&amp;")
            .replace(/</g, "&lt;")
            .replace(/>/g, "&gt;")
            .replace(/"/g, "&quot;")
            .replace(/'/g, "&#039;");
    }

    function getRegenciesData(provinceId) {
        if (!provinceId) return Promise.resolve([]);
        const keyStr = String(provinceId);
        const keyNum = Number(provinceId);

        if (ALL_REGENCIES_MAP[keyStr]) {
            return Promise.resolve(ALL_REGENCIES_MAP[keyStr]);
        }
        if (ALL_REGENCIES_MAP[keyNum]) {
            return Promise.resolve(ALL_REGENCIES_MAP[keyNum]);
        }
        if (regencyCache[keyStr]) {
            return Promise.resolve(regencyCache[keyStr]);
        }

        const jsonUrl = window.location.origin + '/data/regencies_grouped.json';
        return fetch(jsonUrl)
            .then(res => res.json())
            .then(map => {
                ALL_REGENCIES_MAP = map || {};
                const list = ALL_REGENCIES_MAP[keyStr] || ALL_REGENCIES_MAP[keyNum] || [];
                regencyCache[keyStr] = list;
                return list;
            })
            .catch(() => {
                const url = window.location.origin + '/bpbd/manage-posko/get-regencies/' + provinceId;
                return fetch(url)
                    .then(res => res.json())
                    .then(res => {
                        const list = (res.status === 'success' && res.data) ? res.data : [];
                        regencyCache[keyStr] = list;
                        return list;
                    })
                    .catch(() => []);
            });
    }

    // Helper for progressive rate-limited chunk loading (10 items immediately, then 10 items every 1.5s)
    function populateKabupatenProgressive(triggerKab, nativeKab, menuId, data, selectedRegencyId = null, defaultLabel = 'Semua Kabupaten', onComplete = null) {
        if (!triggerKab) return;

        if (triggerKab._progressiveTimer) {
            clearInterval(triggerKab._progressiveTimer);
            triggerKab._progressiveTimer = null;
        }

        triggerKab.classList.remove('disabled');

        if (!data || data.length === 0) {
            triggerKab.querySelector('.trigger-label').textContent = defaultLabel;
            updateCustomMenuOptions(menuId, `<div class="frost-custom-option selected" data-value="">${defaultLabel}</div>`);
            if (typeof onComplete === 'function') onComplete();
            return;
        }

        const CHUNK_SIZE = 10;
        let offset = 0;
        let nativeHtml = `<option value="">${defaultLabel}</option>`;
        let menuHtml = `<div class="frost-custom-option selected" data-value="">${defaultLabel}</div>`;
        let selectedName = defaultLabel;

        function appendChunk(chunk) {
            chunk.forEach(reg => {
                const isSel = selectedRegencyId && reg.id == selectedRegencyId;
                nativeHtml += `<option value="${reg.id}" ${isSel ? 'selected' : ''}>${escapeHtml(reg.name)}</option>`;
                menuHtml += `<div class="frost-custom-option ${isSel ? 'selected' : ''}" data-value="${reg.id}">${escapeHtml(reg.name)}</div>`;
                if (isSel) selectedName = reg.name;
            });

            if (nativeKab) {
                nativeKab.innerHTML = nativeHtml;
                if (selectedRegencyId) nativeKab.value = selectedRegencyId;
                nativeKab.disabled = false;
            }

            updateCustomMenuOptions(menuId, menuHtml);
            triggerKab.querySelector('.trigger-label').textContent = selectedName;
        }

        // Render initial 10 items INSTANTLY (0ms)
        const firstChunk = data.slice(offset, offset + CHUNK_SIZE);
        offset += CHUNK_SIZE;
        appendChunk(firstChunk);

        if (typeof onComplete === 'function') onComplete();

        // Rate-limited progressive streaming for remaining items (10 items every 1.5s)
        if (offset < data.length) {
            triggerKab._progressiveTimer = setInterval(() => {
                if (offset >= data.length) {
                    clearInterval(triggerKab._progressiveTimer);
                    triggerKab._progressiveTimer = null;
                    return;
                }
                const nextChunk = data.slice(offset, offset + CHUNK_SIZE);
                offset += CHUNK_SIZE;
                appendChunk(nextChunk);
            }, 1500);
        }
    }

    // Helper to update custom menu options
    function updateCustomMenuOptions(menuId, menuHtml) {
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

    // Province Change Event for Filter Bar
    function onProvinceChange(provinceId) {
        const triggerKab = document.getElementById('trigger-kabupaten');
        const kabSelect = document.getElementById('filter-kabupaten');
        const filterForm = document.getElementById('filter-manage-form');

        if (kabSelect) {
            kabSelect.innerHTML = '<option value="">Semua Kabupaten</option>';
            kabSelect.value = '';
            kabSelect.disabled = true;
        }

        if (triggerKab) {
            triggerKab.classList.add('disabled');
            triggerKab.querySelector('.trigger-label').textContent = provinceId ? 'Memuat Kabupaten...' : 'Pilih Provinsi Dahulu';
        }
        updateCustomMenuOptions('menu-kabupaten', `<div class="frost-custom-option selected" data-value="">${provinceId ? 'Memuat Kabupaten...' : 'Pilih Provinsi Dahulu'}</div>`);

        if (!provinceId) {
            if (filterForm) filterForm.submit();
            return;
        }

        getRegenciesData(provinceId).then(data => {
            populateKabupatenProgressive(triggerKab, kabSelect, 'menu-kabupaten', data, null, 'Semua Kabupaten', function () {
                if (filterForm) filterForm.submit();
            });
        }).catch(err => {
            console.error('Error on province change:', err);
            if (triggerKab) {
                triggerKab.classList.remove('disabled');
                triggerKab.querySelector('.trigger-label').textContent = 'Semua Kabupaten';
            }
            if (filterForm) filterForm.submit();
        });
    }

    // Helper to load regencies for Create Posko Modal
    function loadCreateRegencies(provinceId, selectedRegencyId = null) {
        const nativeKab = document.getElementById('create-regency_id');
        const triggerKab = document.getElementById('trigger-create-kabupaten');

        if (nativeKab) {
            nativeKab.innerHTML = '<option value="">Pilih Provinsi Dahulu</option>';
            nativeKab.value = '';
            nativeKab.disabled = true;
        }

        if (triggerKab) {
            triggerKab.classList.add('disabled');
            triggerKab.querySelector('.trigger-label').textContent = provinceId ? 'Memuat Kabupaten...' : 'Pilih Provinsi Dahulu';
        }
        updateCustomMenuOptions('menu-create-kabupaten', `<div class="frost-custom-option selected" data-value="">${provinceId ? 'Memuat Kabupaten...' : 'Pilih Provinsi Dahulu'}</div>`);

        if (!provinceId) return;

        getRegenciesData(provinceId).then(data => {
            populateKabupatenProgressive(triggerKab, nativeKab, 'menu-create-kabupaten', data, selectedRegencyId, 'Pilih Kabupaten / Kota');
        }).catch(err => {
            console.error('Error loading create regencies:', err);
            if (triggerKab) {
                triggerKab.classList.remove('disabled');
                triggerKab.querySelector('.trigger-label').textContent = 'Pilih Kabupaten / Kota';
            }
        });
    }

    // Helper to load regencies for Edit Posko Modal
    function loadEditRegencies(provinceId, selectedRegencyId = null) {
        const nativeKab = document.getElementById('edit-regency_id');
        const triggerKab = document.getElementById('trigger-edit-kabupaten');

        if (nativeKab) {
            nativeKab.innerHTML = '<option value="">Pilih Provinsi Dahulu</option>';
            nativeKab.value = '';
            nativeKab.disabled = true;
        }

        if (triggerKab) {
            triggerKab.classList.add('disabled');
            triggerKab.querySelector('.trigger-label').textContent = provinceId ? 'Memuat Kabupaten...' : 'Pilih Provinsi Dahulu';
        }
        updateCustomMenuOptions('menu-edit-kabupaten', `<div class="frost-custom-option selected" data-value="">${provinceId ? 'Memuat Kabupaten...' : 'Pilih Provinsi Dahulu'}</div>`);

        if (!provinceId) return;

        getRegenciesData(provinceId).then(data => {
            populateKabupatenProgressive(triggerKab, nativeKab, 'menu-edit-kabupaten', data, selectedRegencyId, 'Pilih Kabupaten / Kota');
        }).catch(err => {
            console.error('Error loading edit regencies:', err);
            if (triggerKab) {
                triggerKab.classList.remove('disabled');
                triggerKab.querySelector('.trigger-label').textContent = 'Pilih Kabupaten / Kota';
            }
        });
    }

    // Helper to set custom select value programmatically
    function setCustomSelectValue(wrapperId, triggerId, menuId, nativeId, val) {
        const native = document.getElementById(nativeId);
        const trigger = document.getElementById(triggerId);
        const menu = document.getElementById(menuId);

        if (!native || !trigger || !menu) return;

        native.value = val;
        let foundTxt = '';

        menu.querySelectorAll('.frost-custom-option').forEach(opt => {
            if (opt.getAttribute('data-value') == val) {
                opt.classList.add('selected');
                foundTxt = opt.textContent.trim();
            } else {
                opt.classList.remove('selected');
            }
        });

        if (foundTxt) {
            trigger.querySelector('.trigger-label').textContent = foundTxt;
        }
    }

    // Helper to add requirement row dynamically
    function addRequirementRow(container, textValue = '', num = 1) {
        if (!container) return;
        const row = document.createElement('div');
        row.className = 'd-flex align-items-center gap-2 requirement-item-row';
        row.innerHTML = `
            <span class="badge bg-light text-secondary border fw-bold px-2 py-2 fs-9 req-num-label flex-shrink-0" style="min-width: 68px; text-align: center;">Syarat ${num}</span>
            <input type="text" name="requirements_options[]" class="frost-input-field form-control form-control-sm flex-grow-1" value="${escapeHtml(textValue)}" placeholder="Contoh: Sehat jasmani &amp; rohani">
            <button type="button" class="btn btn-sm btn-outline-danger btn-remove-req flex-shrink-0 px-2.5 py-1.5" title="Hapus syarat" style="border-radius: 6px;">
                <i class="bi bi-trash-fill"></i>
            </button>
        `;
        container.appendChild(row);

        row.querySelector('.btn-remove-req').addEventListener('click', function () {
            if (container.querySelectorAll('.requirement-item-row').length > 1) {
                row.remove();
                updateRequirementNumbers(container);
            }
        });

        updateRequirementNumbers(container);
    }

    function updateRequirementNumbers(container) {
        if (!container) return;
        const rows = container.querySelectorAll('.requirement-item-row');
        rows.forEach((row, index) => {
            const lbl = row.querySelector('.req-num-label');
            if (lbl) lbl.textContent = `Syarat ${index + 1}`;
            const btnRemove = row.querySelector('.btn-remove-req');
            if (btnRemove) {
                btnRemove.style.display = rows.length > 1 ? 'inline-block' : 'none';
            }
        });
    }

    function renderEditRequirements(reqString) {
        const container = document.getElementById('edit-requirements-wrapper');
        if (!container) return;
        container.innerHTML = '';

        let items = [];
        if (reqString) {
            if (typeof reqString === 'string') {
                try {
                    const parsed = JSON.parse(reqString);
                    if (Array.isArray(parsed)) items = parsed;
                } catch (e) {
                    if (reqString.includes('\n')) {
                        items = reqString.split('\n');
                    } else if (reqString.includes(',')) {
                        items = reqString.split(',');
                    } else {
                        items = [reqString];
                    }
                }
            } else if (Array.isArray(reqString)) {
                items = reqString;
            }
        }

        items = items.map(s => String(s).trim()).filter(s => s.length > 0);
        if (items.length === 0) items = [''];

        items.forEach((txt, idx) => {
            addRequirementRow(container, txt, idx + 1);
        });
    }

    document.addEventListener('DOMContentLoaded', function () {
        const filterForm = document.getElementById('filter-manage-form');
        const kabSelect = document.getElementById('filter-kabupaten');
        const searchInput = document.getElementById('search-input-query');
        const clearBtn = document.getElementById('btn-clear-search');

        // Dynamic Requirement Button Handlers
        const btnAddCreate = document.getElementById('btn-add-create-requirement');
        if (btnAddCreate) {
            btnAddCreate.addEventListener('click', function () {
                const container = document.getElementById('create-requirements-wrapper');
                if (container) {
                    addRequirementRow(container, '', container.querySelectorAll('.requirement-item-row').length + 1);
                }
            });
        }

        const btnAddEdit = document.getElementById('btn-add-edit-requirement');
        if (btnAddEdit) {
            btnAddEdit.addEventListener('click', function () {
                const container = document.getElementById('edit-requirements-wrapper');
                if (container) {
                    addRequirementRow(container, '', container.querySelectorAll('.requirement-item-row').length + 1);
                }
            });
        }

        // Toggle Clear (X) icon when typing inside search input
        if (searchInput) {
            searchInput.addEventListener('input', function () {
                const val = this.value.trim();
                if (clearBtn) {
                    if (val.length > 0) {
                        clearBtn.classList.remove('d-none');
                    } else {
                        clearBtn.classList.add('d-none');
                    }
                }
            });
        }

        if (clearBtn) {
            clearBtn.addEventListener('click', function () {
                if (searchInput) {
                    searchInput.value = '';
                    clearBtn.classList.add('d-none');
                    filterForm.submit();
                }
            });
        }

        // Generic Custom Dropdown Binder with optional Live Auto-Recommendation Search
        function setupCustomSelectGeneric(wrapperId, triggerId, menuId, nativeId, onChange, isSearchable = false, searchPlaceholder = 'Cari...') {
            const wrapper = document.getElementById(wrapperId);
            const trigger = document.getElementById(triggerId);
            const menu = document.getElementById(menuId);
            const native = document.getElementById(nativeId);

            if (!wrapper || !trigger || !menu || !native) return;

            // Ensure options are grouped inside .frost-options-list
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
                    if (typeof onChange === 'function') {
                        onChange(val, txt);
                    }
                }
            });
        }

        // Filter Bar Custom Dropdowns
        setupCustomSelectGeneric('custom-wrapper-provinsi', 'trigger-provinsi', 'menu-provinsi', 'filter-provinsi', function (val) {
            onProvinceChange(val);
        }, true, 'Cari provinsi...');
        setupCustomSelectGeneric('custom-wrapper-kabupaten', 'trigger-kabupaten', 'menu-kabupaten', 'filter-kabupaten', function () {
            if (filterForm) filterForm.submit();
        }, true, 'Cari kabupaten / kota...');
        setupCustomSelectGeneric('custom-wrapper-bencana', 'trigger-bencana', 'menu-bencana', 'filter-bencana', function () {
            if (filterForm) filterForm.submit();
        });
        setupCustomSelectGeneric('custom-wrapper-status', 'trigger-status', 'menu-status', 'filter-status', function () {
            if (filterForm) filterForm.submit();
        });

        // Create Posko Modal Custom Dropdowns
        setupCustomSelectGeneric('custom-wrapper-create-bencana', 'trigger-create-bencana', 'menu-create-bencana', 'create-jenis_bencana');
        setupCustomSelectGeneric('custom-wrapper-create-urgency', 'trigger-create-urgency', 'menu-create-urgency', 'create-urgency');
        setupCustomSelectGeneric('custom-wrapper-create-status', 'trigger-create-status', 'menu-create-status', 'create-status');
        setupCustomSelectGeneric('custom-wrapper-create-provinsi', 'trigger-create-provinsi', 'menu-create-provinsi', 'create-province_id', function (provId) {
            loadCreateRegencies(provId);
        }, true, 'Cari provinsi...');
        setupCustomSelectGeneric('custom-wrapper-create-kabupaten', 'trigger-create-kabupaten', 'menu-create-kabupaten', 'create-regency_id', null, true, 'Cari kabupaten / kota...');

        // Edit Posko Modal Custom Dropdowns
        setupCustomSelectGeneric('custom-wrapper-edit-bencana', 'trigger-edit-bencana', 'menu-edit-bencana', 'edit-jenis_bencana');
        setupCustomSelectGeneric('custom-wrapper-edit-urgency', 'trigger-edit-urgency', 'menu-edit-urgency', 'edit-urgency');
        setupCustomSelectGeneric('custom-wrapper-edit-status', 'trigger-edit-status', 'menu-edit-status', 'edit-status');
        setupCustomSelectGeneric('custom-wrapper-edit-provinsi', 'trigger-edit-provinsi', 'menu-edit-provinsi', 'edit-province_id', function (provId) {
            loadEditRegencies(provId);
        }, true, 'Cari provinsi...');
        setupCustomSelectGeneric('custom-wrapper-edit-kabupaten', 'trigger-edit-kabupaten', 'menu-edit-kabupaten', 'edit-regency_id', null, true, 'Cari kabupaten / kota...');

        // Close dropdowns on outside click
        document.addEventListener('click', function () {
            document.querySelectorAll('.frost-custom-menu').forEach(m => m.classList.remove('show'));
            document.querySelectorAll('.frost-custom-trigger').forEach(t => t.classList.remove('active'));
            document.querySelectorAll('.frost-custom-select-wrapper').forEach(w => w.classList.remove('active-dropdown'));
        });
    });

    function escapeHtml(str) {
        if (!str) return '';
        return str.replace(/[&<>"']/g, function (m) {
            return { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#039;' }[m];
        });
    }

    // Modal Edit Handler
    function openEditModal(posko) {
        document.getElementById('editPoskoForm').action = window.location.origin + '/bpbd/manage-posko/update/' + posko.id;
        document.getElementById('edit-name').value = posko.name || '';
        document.getElementById('edit-quota').value = posko.quota || 10;
        renderEditRequirements(posko.requirements || '');
        document.getElementById('edit-contact_person').value = posko.contact_person || '';

        setCustomSelectValue('custom-wrapper-edit-bencana', 'trigger-edit-bencana', 'menu-edit-bencana', 'edit-jenis_bencana', posko.jenis_bencana || 'Gempa Bumi');
        setCustomSelectValue('custom-wrapper-edit-urgency', 'trigger-edit-urgency', 'menu-edit-urgency', 'edit-urgency', posko.urgency || 'Urgent');
        setCustomSelectValue('custom-wrapper-edit-status', 'trigger-edit-status', 'menu-edit-status', 'edit-status', posko.status || 'aktif');

        if (posko.province_id) {
            setCustomSelectValue('custom-wrapper-edit-provinsi', 'trigger-edit-provinsi', 'menu-edit-provinsi', 'edit-province_id', posko.province_id);
            loadEditRegencies(posko.province_id, posko.regency_id);
        } else {
            setCustomSelectValue('custom-wrapper-edit-provinsi', 'trigger-edit-provinsi', 'menu-edit-provinsi', 'edit-province_id', '');
            loadEditRegencies('', null);
        }

        const editModal = new bootstrap.Modal(document.getElementById('editPoskoModal'));
        editModal.show();
    }

    // Modal Delete Handler
    function openDeleteModal(poskoId, poskoName) {
        document.getElementById('deletePoskoForm').action = window.location.origin + '/bpbd/manage-posko/delete/' + poskoId;
        document.getElementById('delete-posko-name-text').textContent = 'Anda akan menghapus posko "' + poskoName + '". Posko yang dihapus tidak akan tayang lagi pada portal rekrutmen.';

        const deleteModal = new bootstrap.Modal(document.getElementById('deletePoskoModal'));
        deleteModal.show();
    }
</script>
<?= $this->endSection() ?>