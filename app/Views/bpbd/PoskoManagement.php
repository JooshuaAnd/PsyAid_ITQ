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

    /* LIGHT GREEN BUTTON: PRIMARY ACTION */
    .frost-btn-primary {
        background: linear-gradient(135deg, #059669 0%, #047857 100%);
        color: #ffffff !important;
        border: 1px solid #047857;
        font-weight: 700;
        font-size: 0.85rem;
        padding: 0.5rem 1.1rem;
        transition: all 0.2s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        box-shadow: 0 2px 8px rgba(5, 150, 105, 0.25);
        cursor: pointer;
    }

    .frost-btn-primary:hover {
        background: linear-gradient(135deg, #047857 0%, #064e3b 100%);
        color: #ffffff !important;
        box-shadow: 0 4px 14px rgba(5, 150, 105, 0.35);
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

    /* CUSTOM FROSTED SEARCH BAR WITH ACTION BUTTON */
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
        background: linear-gradient(135deg, #059669 0%, #047857 100%);
        color: #ffffff !important;
        border: 1.5px solid #047857;
        font-weight: 700;
        font-size: 0.85rem;
        padding: 0.6rem 1.25rem;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.4rem;
        cursor: pointer;
        transition: all 0.2s ease;
        box-shadow: 0 2px 6px rgba(5, 150, 105, 0.2);
        white-space: nowrap;
        flex-shrink: 0;
    }

    .frost-btn-search-submit:hover {
        background: linear-gradient(135deg, #047857 0%, #064e3b 100%);
        box-shadow: 0 4px 12px rgba(5, 150, 105, 0.3);
        transform: translateY(-1px);
    }

    /* POSKO CARD POLISHED STYLING & HIGH CONTRAST BADGES */
    .posko-card-body {
        padding: 1.25rem !important;
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

    .posko-info-box {
        background-color: #ffffff !important;
        border: 1px solid #e2e8f0 !important;
        border-radius: 8px !important;
        padding: 0.85rem !important;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.03) !important;
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

    .fs-7 { font-size: 0.8125rem; }
    .fs-8 { font-size: 0.75rem; }
    .fs-9 { font-size: 0.6875rem; }

    @keyframes fadeInDown {
        from { opacity: 0; transform: translateY(-6px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* Mobile Responsive Spacing & Padding Optimization for Filter Card */
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
            min-height: 46px;
            font-size: 0.875rem;
            padding-top: 0.65rem;
            padding-bottom: 0.65rem;
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
    }

    @media (max-width: 575.98px) {
        .frost-search-group {
            flex-direction: column;
            gap: 0.6rem;
        }

        .frost-btn-search-submit {
            width: 100%;
            padding: 0.65rem 1rem;
        }
    }
</style>

<!-- Alert Notifications -->
<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert" style="background-color: #ecfdf5; color: #047857; border-left: 4px solid #10b981 !important;">
        <i class="bi bi-check-circle-fill me-2 fs-5 align-middle"></i>
        <strong>Berhasil!</strong> <?= session()->getFlashdata('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4" role="alert" style="background-color: #fef2f2; color: #991b1b; border-left: 4px solid #ef4444 !important;">
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
                    Tambah, perbarui, dan atur kuota relawan posko bencana berdasarkan Provinsi, Kabupaten/Kota, dan Jenis Bencana. Posko aktif secara otomatis akan ditayangkan pada portal Rekrutmen Relawan.
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
            <a href="<?= site_url('/bpbd/manage-posko') ?>" id="btn-reset-filter" class="frost-btn-reset text-decoration-none">
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
                    <div class="frost-custom-option <?= empty($filterProvinceId) ? 'selected' : '' ?>" data-value="">Semua Provinsi</div>
                    <?php foreach ($provinces as $prov): ?>
                        <div class="frost-custom-option <?= $filterProvinceId == $prov['id'] ? 'selected' : '' ?>" data-value="<?= esc($prov['id']) ?>">
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
                <div class="frost-custom-trigger <?= empty($filterProvinceId) ? 'disabled' : '' ?>" id="trigger-kabupaten">
                    <span class="trigger-label text-truncate"><?= esc($selectedKabName) ?></span>
                    <i class="bi bi-chevron-down chevron-icon"></i>
                </div>
                <div class="frost-custom-menu" id="menu-kabupaten">
                    <div class="frost-custom-option <?= empty($filterRegencyId) ? 'selected' : '' ?>" data-value="">
                        <?= empty($filterProvinceId) ? 'Pilih Provinsi Dahulu' : 'Semua Kabupaten' ?>
                    </div>
                    <?php foreach ($regencies as $reg): ?>
                        <div class="frost-custom-option <?= $filterRegencyId == $reg['id'] ? 'selected' : '' ?>" data-value="<?= esc($reg['id']) ?>">
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
                    <div class="frost-custom-option <?= empty($filterJenisBencana) ? 'selected' : '' ?>" data-value="">Semua Jenis Bencana</div>
                    <?php foreach ($distinctJenisBencana as $jb): ?>
                        <div class="frost-custom-option <?= $filterJenisBencana == $jb ? 'selected' : '' ?>" data-value="<?= esc($jb) ?>">
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
                    <div class="frost-custom-option <?= empty($filterStatus) ? 'selected' : '' ?>" data-value="">Semua Status</div>
                    <div class="frost-custom-option <?= $filterStatus === 'aktif' ? 'selected' : '' ?>" data-value="aktif">Aktif</div>
                    <div class="frost-custom-option <?= $filterStatus === 'recovery' ? 'selected' : '' ?>" data-value="recovery">Recovery</div>
                    <div class="frost-custom-option <?= $filterStatus === 'closed' ? 'selected' : '' ?>" data-value="closed">Closed</div>
                </div>
            </div>
        </div>

        <!-- Custom Search Bar with Working Search Button -->
        <div class="col-12">
            <div class="frost-search-group">
                <div class="frost-search-input-wrapper">
                    <i class="bi bi-search frost-search-icon-inside"></i>
                    <input type="text" name="q" id="search-input-query" class="frost-search-input"
                        placeholder="Cari nama posko, lokasi, atau jenis bencana..."
                        value="<?= esc($searchQuery) ?>" autocomplete="off">
                    <?php if (!empty($searchQuery)): ?>
                        <button type="button" id="btn-clear-search" class="frost-search-clear-inside" title="Bersihkan Pencarian">
                            <i class="bi bi-x-circle-fill"></i>
                        </button>
                    <?php else: ?>
                        <button type="button" id="btn-clear-search" class="frost-search-clear-inside d-none" title="Bersihkan Pencarian">
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
                    <span class="badge bg-light text-dark border px-2 py-1 fs-8 me-1">Prov: <?= esc($selectedProvName) ?></span>
                <?php endif; ?>
                <?php if (!empty($filterRegencyId)): ?>
                    <span class="badge bg-light text-dark border px-2 py-1 fs-8 me-1">Kab: <?= esc($selectedKabName) ?></span>
                <?php endif; ?>
                <?php if (!empty($filterJenisBencana)): ?>
                    <span class="badge bg-light text-dark border px-2 py-1 fs-8 me-1">Bencana: <?= esc($filterJenisBencana) ?></span>
                <?php endif; ?>
                <?php if (!empty($filterStatus)): ?>
                    <span class="badge bg-light text-dark border px-2 py-1 fs-8 me-1">Status: <?= esc(ucfirst($filterStatus)) ?></span>
                <?php endif; ?>
                <?php if (!empty($searchQuery)): ?>
                    <span class="badge bg-light text-dark border px-2 py-1 fs-8 me-1">Cari: "<?= esc($searchQuery) ?>"</span>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Mobile Reset Button -->
    <div class="d-flex d-md-none align-items-center justify-content-end frost-mobile-reset-wrapper border-top mt-3 pt-2">
        <a href="<?= site_url('/bpbd/manage-posko') ?>" class="frost-btn-reset-sm text-decoration-none">
            <i class="bi bi-arrow-counterclockwise"></i> Reset Filter
        </a>
    </div>
</div>

<!-- 3. Posko Grid System (High Contrast & Polished UI Cards) -->
<div class="mb-5">
    <div class="d-flex align-items-center justify-content-between mb-3 flex-wrap gap-2">
        <h5 class="fw-bold text-dark mb-0 d-flex align-items-center">
            <i class="bi bi-grid-3x3-gap-fill text-success me-2 fs-5"></i> Daftar Posko Kebencanaan (<?= count($poskoList) ?> Total)
        </h5>
        <button type="button" class="frost-btn-primary" data-bs-toggle="modal" data-bs-target="#createPoskoModal">
            <i class="bi bi-plus-lg fs-6 me-1"></i> Tambah Posko Baru
        </button>
    </div>

    <div class="row g-3">
        <?php if (empty($poskoList)): ?>
            <div class="col-12">
                <div class="card frost-card p-5 text-center text-muted">
                    <i class="bi bi-inbox fs-2 d-block mb-2 text-secondary"></i>
                    <h6 class="fw-bold text-dark mb-1">Tidak Ada Data Posko</h6>
                    <p class="small text-muted mb-0">Belum ada posko yang dibuat atau sesuai dengan filter yang Anda tentukan.</p>
                </div>
            </div>
        <?php else: ?>
            <?php foreach ($poskoList as $posko): ?>
                <div class="col-12 col-md-6 col-xl-4">
                    <div class="card frost-card h-100 border-0 shadow-sm overflow-hidden">
                        <div class="posko-card-body">
                            <div>
                                <!-- Header Info: Posko Title & Status Badge -->
                                <div class="d-flex align-items-start justify-content-between mb-2 gap-2">
                                    <h6 class="fw-bold text-dark mb-0 pe-2 text-truncate" title="<?= esc($posko['name']) ?>" style="font-size: 1.05rem;">
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
                                        <span class="text-secondary"><i class="bi bi-people-fill me-1 text-success"></i> Slot Relawan Terisi</span>
                                        <span class="text-dark tabular-nums fw-bold">
                                            <span class="text-success fs-7 fw-extrabold"><?= $posko['approved_volunteers'] ?></span> / <?= $posko['quota'] ?> Personel
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

                                <!-- Details Box (Positions, Requirements, Contact Info) -->
                                <?php if (!empty($posko['positions']) || !empty($posko['requirements']) || !empty($posko['contact_person'])): ?>
                                    <div class="posko-details-box mb-3">
                                        <?php if (!empty($posko['positions'])): ?>
                                            <div class="mb-1.5">
                                                <strong class="text-dark"><i class="bi bi-briefcase-fill me-1 text-primary"></i> Posisi:</strong>
                                                <span class="text-slate-800"><?= esc($posko['positions']) ?></span>
                                            </div>
                                        <?php endif; ?>

                                        <?php if (!empty($posko['requirements'])): ?>
                                            <div class="mb-1.5">
                                                <strong class="text-dark"><i class="bi bi-card-checklist me-1 text-warning"></i> Syarat:</strong>
                                                <span class="text-slate-800"><?= esc($posko['requirements']) ?></span>
                                            </div>
                                        <?php endif; ?>

                                        <?php if (!empty($posko['contact_person'])): ?>
                                            <div>
                                                <strong class="text-dark"><i class="bi bi-telephone-fill me-1 text-success"></i> Kontak:</strong>
                                                <span class="fw-bold text-success"><?= esc($posko['contact_person']) ?></span>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <!-- Card Footer Action Buttons -->
                            <div class="d-flex align-items-center justify-content-end gap-2 border-top pt-3 mt-2">
                                <button type="button" class="btn btn-sm btn-outline-primary fw-bold fs-8 px-3"
                                    onclick="openEditModal(<?= htmlspecialchars(json_encode($posko), ENT_QUOTES, 'UTF-8') ?>)">
                                    <i class="bi bi-pencil-square me-1"></i> Edit
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-danger fw-bold fs-8 px-3"
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
            <div class="modal-header border-bottom p-4" style="background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 100%);">
                <h5 class="modal-title fw-bold text-dark" id="createPoskoModalLabel">
                    <i class="bi bi-house-add-fill text-success me-2"></i> Tambah Posko Kebencanaan Baru
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="<?= site_url('/bpbd/manage-posko/store') ?>" method="POST" class="p-4">
                <?= csrf_field() ?>

                <div class="row g-3">
                    <div class="col-12 col-md-8">
                        <label class="form-label small fw-bold text-dark">Nama Posko Kebencanaan <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control fs-8" placeholder="Contoh: Posko Tanggap Cianjur 01" required>
                    </div>

                    <div class="col-12 col-md-4">
                        <label class="form-label small fw-bold text-dark">Jenis Bencana <span class="text-danger">*</span></label>
                        <select name="jenis_bencana" class="form-select fs-8" required>
                            <option value="">-- Pilih Jenis Bencana --</option>
                            <option value="Gempa Bumi">Gempa Bumi</option>
                            <option value="Banjir">Banjir</option>
                            <option value="Tanah Longsor">Tanah Longsor</option>
                            <option value="Erupsi Gunung">Erupsi Gunung</option>
                            <option value="Tsunami">Tsunami</option>
                            <option value="Angin Puting Beliung">Angin Puting Beliung</option>
                            <option value="Kebakaran Hutan">Kebakaran Hutan</option>
                        </select>
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label small fw-bold text-dark">Provinsi <span class="text-danger">*</span></label>
                        <select name="province_id" id="create-province_id" class="form-select fs-8" required>
                            <option value="">-- Pilih Provinsi --</option>
                            <?php foreach ($provinces as $prov): ?>
                                <option value="<?= esc($prov['id']) ?>"><?= esc($prov['name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label small fw-bold text-dark">Kabupaten / Kota <span class="text-danger">*</span></label>
                        <select name="regency_id" id="create-regency_id" class="form-select fs-8" disabled required>
                            <option value="">Pilih Provinsi Dahulu</option>
                        </select>
                    </div>

                    <div class="col-12 col-md-4">
                        <label class="form-label small fw-bold text-dark">Kuota Relawan Dibutuhkan <span class="text-danger">*</span></label>
                        <input type="number" name="quota" class="form-control fs-8" value="10" min="1" max="500" required>
                    </div>

                    <div class="col-12 col-md-4">
                        <label class="form-label small fw-bold text-dark">Tingkat Urgensi <span class="text-danger">*</span></label>
                        <select name="urgency" class="form-select fs-8" required>
                            <option value="Urgent" selected>Urgent (Dibutuhkan Segera)</option>
                            <option value="Terbuka">Terbuka (Standby Normal)</option>
                        </select>
                    </div>

                    <div class="col-12 col-md-4">
                        <label class="form-label small fw-bold text-dark">Status Operasional <span class="text-danger">*</span></label>
                        <select name="status" class="form-select fs-8" required>
                            <option value="aktif" selected>Aktif (Tayang di Rekrutmen)</option>
                            <option value="recovery">Recovery</option>
                            <option value="closed">Closed (Ditutup)</option>
                        </select>
                    </div>

                    <div class="col-12">
                        <label class="form-label small fw-bold text-dark">Posisi Relawan Dibutuhkan</label>
                        <input type="text" name="positions" class="form-control fs-8" placeholder="Contoh: Logistik, Medis, Konseling Psikologi Pertama (PFA), Dapur Umum">
                    </div>

                    <div class="col-12">
                        <label class="form-label small fw-bold text-dark">Persyaratan Khusus Relawan</label>
                        <textarea name="requirements" class="form-control fs-8" rows="2" placeholder="Contoh: Sehat jasmani rohani, bersedia ditempatkan minimal 3 hari"></textarea>
                    </div>

                    <div class="col-12">
                        <label class="form-label small fw-bold text-dark">Kontak Person / Call Center BPBD Posko</label>
                        <input type="text" name="contact_person" class="form-control fs-8" placeholder="Contoh: BPBD Cianjur (+62 812-3456-7890)">
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 border-top pt-3 mt-4">
                    <button type="button" class="btn btn-light border fw-semibold fs-8" data-bs-dismiss="modal">Batal</button>
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
            <div class="modal-header border-bottom p-4" style="background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);">
                <h5 class="modal-title fw-bold text-dark" id="editPoskoModalLabel">
                    <i class="bi bi-pencil-square text-primary me-2"></i> Edit Posko Kebencanaan
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="editPoskoForm" method="POST" class="p-4">
                <?= csrf_field() ?>

                <div class="row g-3">
                    <div class="col-12 col-md-8">
                        <label class="form-label small fw-bold text-dark">Nama Posko Kebencanaan <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="edit-name" class="form-control fs-8" required>
                    </div>

                    <div class="col-12 col-md-4">
                        <label class="form-label small fw-bold text-dark">Jenis Bencana <span class="text-danger">*</span></label>
                        <select name="jenis_bencana" id="edit-jenis_bencana" class="form-select fs-8" required>
                            <option value="Gempa Bumi">Gempa Bumi</option>
                            <option value="Banjir">Banjir</option>
                            <option value="Tanah Longsor">Tanah Longsor</option>
                            <option value="Erupsi Gunung">Erupsi Gunung</option>
                            <option value="Tsunami">Tsunami</option>
                            <option value="Angin Puting Beliung">Angin Puting Beliung</option>
                            <option value="Kebakaran Hutan">Kebakaran Hutan</option>
                        </select>
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label small fw-bold text-dark">Provinsi <span class="text-danger">*</span></label>
                        <select name="province_id" id="edit-province_id" class="form-select fs-8" required>
                            <?php foreach ($provinces as $prov): ?>
                                <option value="<?= esc($prov['id']) ?>"><?= esc($prov['name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label small fw-bold text-dark">Kabupaten / Kota <span class="text-danger">*</span></label>
                        <select name="regency_id" id="edit-regency_id" class="form-select fs-8" required>
                            <option value="">Pilih Provinsi Dahulu</option>
                        </select>
                    </div>

                    <div class="col-12 col-md-4">
                        <label class="form-label small fw-bold text-dark">Kuota Relawan Dibutuhkan <span class="text-danger">*</span></label>
                        <input type="number" name="quota" id="edit-quota" class="form-control fs-8" min="1" max="500" required>
                    </div>

                    <div class="col-12 col-md-4">
                        <label class="form-label small fw-bold text-dark">Tingkat Urgensi <span class="text-danger">*</span></label>
                        <select name="urgency" id="edit-urgency" class="form-select fs-8" required>
                            <option value="Urgent">Urgent (Dibutuhkan Segera)</option>
                            <option value="Terbuka">Terbuka (Standby Normal)</option>
                        </select>
                    </div>

                    <div class="col-12 col-md-4">
                        <label class="form-label small fw-bold text-dark">Status Operasional <span class="text-danger">*</span></label>
                        <select name="status" id="edit-status" class="form-select fs-8" required>
                            <option value="aktif">Aktif (Tayang di Rekrutmen)</option>
                            <option value="recovery">Recovery</option>
                            <option value="closed">Closed (Ditutup)</option>
                        </select>
                    </div>

                    <div class="col-12">
                        <label class="form-label small fw-bold text-dark">Posisi Relawan Dibutuhkan</label>
                        <input type="text" name="positions" id="edit-positions" class="form-control fs-8">
                    </div>

                    <div class="col-12">
                        <label class="form-label small fw-bold text-dark">Persyaratan Khusus Relawan</label>
                        <textarea name="requirements" id="edit-requirements" class="form-control fs-8" rows="2"></textarea>
                    </div>

                    <div class="col-12">
                        <label class="form-label small fw-bold text-dark">Kontak Person / Call Center BPBD Posko</label>
                        <input type="text" name="contact_person" id="edit-contact_person" class="form-control fs-8">
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 border-top pt-3 mt-4">
                    <button type="button" class="btn btn-light border fw-semibold fs-8" data-bs-dismiss="modal">Batal</button>
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
                <p class="small text-muted mb-4" id="delete-posko-name-text">Apakah Anda yakin ingin menghapus posko ini?</p>

                <form id="deletePoskoForm" method="POST">
                    <?= csrf_field() ?>
                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-light border w-100 fw-semibold fs-8" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger w-100 fw-bold fs-8">Hapus Posko</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript for Custom Floating Dropdowns, Search Button Submission & Cascading Select -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const filterForm  = document.getElementById('filter-manage-form');
        const provSelect  = document.getElementById('filter-provinsi');
        const kabSelect   = document.getElementById('filter-kabupaten');
        const bencSelect  = document.getElementById('filter-bencana');
        const statSelect  = document.getElementById('filter-status');

        const searchInput = document.getElementById('search-input-query');
        const clearBtn    = document.getElementById('btn-clear-search');

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

        // Setup Custom Floating Dropdowns
        function setupCustomDropdown(key) {
            const wrapper = document.getElementById('custom-wrapper-' + key);
            const trigger = document.getElementById('trigger-' + key);
            const menu    = document.getElementById('menu-' + key);
            const native  = document.getElementById('filter-' + key);

            if (!wrapper || !trigger || !menu || !native) return;

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
                    if (key === 'provinsi') {
                        onProvinceChange(val);
                    } else {
                        filterForm.submit();
                    }
                }
            });
        }

        setupCustomDropdown('provinsi');
        setupCustomDropdown('kabupaten');
        setupCustomDropdown('bencana');
        setupCustomDropdown('status');

        // Close dropdowns on outside click
        document.addEventListener('click', function () {
            document.querySelectorAll('.frost-custom-menu').forEach(m => m.classList.remove('show'));
            document.querySelectorAll('.frost-custom-trigger').forEach(t => t.classList.remove('active'));
            document.querySelectorAll('.frost-custom-select-wrapper').forEach(w => w.classList.remove('active-dropdown'));
        });

        // Province Change Event with Cascading Regency Fetching
        function onProvinceChange(provinceId) {
            const triggerKab = document.getElementById('trigger-kabupaten');
            const menuKab    = document.getElementById('menu-kabupaten');

            kabSelect.innerHTML = '<option value="">Semua Kabupaten</option>';
            kabSelect.value = '';
            kabSelect.disabled = true;

            triggerKab.classList.add('disabled');
            triggerKab.querySelector('.trigger-label').textContent = provinceId ? 'Memuat Kabupaten...' : 'Pilih Provinsi Dahulu';
            menuKab.innerHTML = `<div class="frost-custom-option selected" data-value="">${provinceId ? 'Memuat Kabupaten...' : 'Pilih Provinsi Dahulu'}</div>`;

            if (!provinceId) {
                filterForm.submit();
                return;
            }

            const url = window.location.origin + '/bpbd/manage-posko/get-regencies/' + provinceId;

            fetch(url)
                .then(res => res.json())
                .then(res => {
                    if (res.status === 'success') {
                        triggerKab.querySelector('.trigger-label').textContent = 'Semua Kabupaten';
                        triggerKab.classList.remove('disabled');

                        let menuHtml = '<div class="frost-custom-option selected" data-value="">Semua Kabupaten</div>';
                        res.data.forEach(reg => {
                            const opt = document.createElement('option');
                            opt.value = reg.id;
                            opt.textContent = reg.name;
                            kabSelect.appendChild(opt);

                            menuHtml += `<div class="frost-custom-option" data-value="${reg.id}">${escapeHtml(reg.name)}</div>`;
                        });
                        kabSelect.disabled = false;
                        menuKab.innerHTML = menuHtml;
                    }
                    filterForm.submit();
                })
                .catch(err => {
                    console.error('Error loading regencies:', err);
                    filterForm.submit();
                });
        }

        // Helper for Create & Edit Modals (Cascading Regencies)
        function loadRegencies(provinceId, targetSelect) {
            targetSelect.innerHTML = '<option value="">Memuat...</option>';
            targetSelect.disabled = true;

            if (!provinceId) {
                targetSelect.innerHTML = '<option value="">Pilih Provinsi Dahulu</option>';
                return;
            }

            const url = window.location.origin + '/bpbd/manage-posko/get-regencies/' + provinceId;
            fetch(url)
                .then(res => res.json())
                .then(res => {
                    if (res.status === 'success') {
                        let html = '<option value="">-- Pilih Kabupaten / Kota --</option>';
                        res.data.forEach(reg => {
                            html += `<option value="${reg.id}">${reg.name}</option>`;
                        });
                        targetSelect.innerHTML = html;
                        targetSelect.disabled = false;
                    } else {
                        targetSelect.innerHTML = '<option value="">Gagal Memuat</option>';
                    }
                })
                .catch(err => {
                    console.error('Error loading regencies:', err);
                    targetSelect.innerHTML = '<option value="">Error Memuat</option>';
                });
        }

        const createProv = document.getElementById('create-province_id');
        const createKab  = document.getElementById('create-regency_id');
        const editProv   = document.getElementById('edit-province_id');
        const editKab    = document.getElementById('edit-regency_id');

        if (createProv && createKab) {
            createProv.addEventListener('change', function () {
                loadRegencies(this.value, createKab);
            });
        }

        if (editProv && editKab) {
            editProv.addEventListener('change', function () {
                loadRegencies(this.value, editKab);
            });
        }

        function escapeHtml(str) {
            if (!str) return '';
            return str.replace(/[&<>"']/g, function (m) {
                return { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#039;' }[m];
            });
        }
    });

    // Modal Edit Handler
    function openEditModal(posko) {
        document.getElementById('editPoskoForm').action = window.location.origin + '/bpbd/manage-posko/update/' + posko.id;
        document.getElementById('edit-name').value = posko.name || '';
        document.getElementById('edit-quota').value = posko.quota || 10;
        document.getElementById('edit-urgency').value = posko.urgency || 'Urgent';
        document.getElementById('edit-status').value = posko.status || 'aktif';
        document.getElementById('edit-positions').value = posko.positions || '';
        document.getElementById('edit-requirements').value = posko.requirements || '';
        document.getElementById('edit-contact_person').value = posko.contact_person || '';

        const editProv = document.getElementById('edit-province_id');
        const editKab = document.getElementById('edit-regency_id');

        if (posko.province_id) {
            editProv.value = posko.province_id;

            const url = window.location.origin + '/bpbd/manage-posko/get-regencies/' + posko.province_id;
            fetch(url)
                .then(res => res.json())
                .then(res => {
                    if (res.status === 'success') {
                        let html = '<option value="">-- Pilih Kabupaten / Kota --</option>';
                        res.data.forEach(reg => {
                            const isSel = reg.id == posko.regency_id ? 'selected' : '';
                            html += `<option value="${reg.id}" ${isSel}>${reg.name}</option>`;
                        });
                        editKab.innerHTML = html;
                        editKab.disabled = false;
                    }
                });
        }

        if (posko.jenis_bencana) {
            document.getElementById('edit-jenis_bencana').value = posko.jenis_bencana;
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
