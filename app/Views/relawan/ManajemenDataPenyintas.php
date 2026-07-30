<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<style>
    .tabular-nums {
        font-variant-numeric: tabular-nums;
        font-feature-settings: "tnum";
    }

    /* Strict Max Rounded 8px (lg) Policy */
    .frost-card,
    .frost-hero,
    .frost-btn-primary,
    .frost-btn-danger,
    .frost-btn-reset,
    .posko-item-card,
    .btn,
    .modal-content,
    .badge,
    .form-control,
    .form-select,
    .progress,
    .alert,
    .table-responsive {
        border-radius: 8px !important;
    }

    /* Frosted Glass UI Card System */
    .frost-card {
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(244, 251, 247, 0.85) 100%);
        backdrop-filter: blur(12px) saturate(160%);
        -webkit-backdrop-filter: blur(12px) saturate(160%);
        border: 1.5px solid #a7f3d0;
        box-shadow: 0 8px 24px -4px rgba(15, 23, 42, 0.06), 0 2px 6px -1px rgba(15, 23, 42, 0.02);
    }

    /* LIGHT GREEN PSYAID HERO CARD SYSTEM */
    .frost-hero {
        background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 60%, #a7f3d0 100%);
        border: 1.5px solid #a7f3d0;
        color: #064e3b;
        position: relative;
        overflow: hidden;
        box-shadow: 0 10px 30px -4px rgba(16, 185, 129, 0.12), inset 0 1.5px 2px rgba(255, 255, 255, 0.85);
    }

    /* LIGHT GREEN BUTTON: PRIMARY ACTION */
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

    .frost-btn-reset {
        background: #ffffff !important;
        color: #475569 !important;
        border: 1.5px solid #cbd5e1 !important;
        border-radius: 8px !important;
        font-weight: 600 !important;
        font-size: 0.8125rem !important;
        padding: 0.45rem 0.85rem !important;
        transition: all 0.2s ease;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        text-decoration: none;
    }

    .frost-btn-reset:hover {
        background-color: #f8fafc !important;
        color: #0f172a !important;
        border-color: #94a3b8 !important;
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

    /* CUSTOM INPUT & SELECT FIELD */
    .frost-input-field {
        background: #ffffff !important;
        border: 1.5px solid #cbd5e1 !important;
        border-radius: 8px !important;
        padding: 0.45rem 0.75rem !important;
        font-size: 0.875rem !important;
        font-weight: 600 !important;
        color: #0f172a !important;
        width: 100%;
        transition: all 0.2s ease;
        box-shadow: 0 1px 3px rgba(15, 23, 42, 0.04);
    }

    .frost-input-field:focus {
        border-color: #059669 !important;
        box-shadow: 0 0 0 3.5px rgba(5, 150, 105, 0.18) !important;
        outline: none;
    }

    /* Status Badges */
    .badge-status-aktif {
        background-color: #059669 !important;
        color: #ffffff !important;
        font-weight: 700 !important;
    }

    /* CUSTOM FLOATING DROPDOWN SYSTEM MATCHING POSKODETAIL */
    .frost-custom-select-wrapper {
        position: relative;
        z-index: 50;
    }

    .frost-custom-select-wrapper.active-dropdown {
        z-index: 99999 !important;
    }

    .frost-custom-trigger {
        background: #ffffff;
        border: 1.5px solid #cbd5e1;
        border-radius: 8px !important;
        padding: 0.45rem 0.75rem;
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

    .frost-custom-trigger:hover {
        border-color: #059669;
        background-color: #f4fbf7;
    }

    .frost-custom-trigger.active {
        border-color: #059669;
        box-shadow: 0 0 0 3.5px rgba(5, 150, 105, 0.18);
        background-color: #ffffff;
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
        z-index: 999999 !important;
        background: #ffffff;
        backdrop-filter: blur(20px) saturate(180%);
        -webkit-backdrop-filter: blur(20px) saturate(180%);
        border: 1.5px solid #059669;
        border-radius: 8px !important;
        box-shadow: 0 16px 40px -4px rgba(15, 23, 42, 0.22), 0 4px 16px rgba(0, 0, 0, 0.08);
        max-height: 260px;
        overflow-y: auto;
        padding: 0.35rem;
        display: none;
    }

    .frost-custom-menu.show {
        display: block;
    }

    .frost-custom-option {
        padding: 0.55rem 0.75rem;
        font-size: 0.85rem;
        font-weight: 600;
        color: #334155;
        border-radius: 6px !important;
        cursor: pointer;
        transition: all 0.15s ease;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .frost-custom-option:hover {
        background-color: #ecfdf5;
        color: #047857;
    }

    .frost-custom-option.selected {
        background-color: #059669;
        color: #ffffff;
        font-weight: 600;
    }

    /* PSYAID MINT PAGINATION SYSTEM */
    .frost-pagination-wrapper {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 0.75rem;
        padding-top: 1rem;
        margin-top: 1rem;
        border-top: 1.5px solid #e2e8f0;
    }

    .frost-pagination-info {
        font-size: 0.8125rem;
        font-weight: 600;
        color: #475569;
    }

    .frost-pagination-nav {
        display: flex;
        align-items: center;
        gap: 0.35rem;
    }

    .frost-page-btn {
        background: #ffffff;
        color: #065f46;
        border: 1.5px solid #a7f3d0;
        border-radius: 8px !important;
        font-size: 0.8125rem;
        font-weight: 700;
        padding: 0.35rem 0.75rem;
        cursor: pointer;
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        user-select: none;
    }

    .frost-page-btn:hover:not(.disabled):not(.active) {
        background: #ecfdf5;
        border-color: #34d399;
        color: #047857;
        transform: translateY(-1px);
    }

    .frost-page-btn.active {
        background: linear-gradient(135deg, #059669 0%, #047857 100%);
        color: #ffffff !important;
        border-color: #047857;
        box-shadow: 0 2px 6px rgba(5, 150, 105, 0.25);
    }

    .frost-page-btn.disabled {
        background: #f8fafc;
        color: #cbd5e1;
        border-color: #e2e8f0;
        cursor: not-allowed;
        opacity: 0.6;
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

    /* MOBILE RESPONSIVE UI OPTIMIZATION (MAX-WIDTH 767.98px) */
    @media (max-width: 767.98px) {
        .frost-hero .card-body {
            padding: 1.15rem !important;
        }

        .frost-hero h3 {
            font-size: 1.25rem !important;
        }

        .posko-item-card {
            padding: 1.15rem !important;
        }

        .posko-filter-form {
            padding: 1.15rem 0.95rem !important;
        }

        /* Filter form search & reset action buttons alignment on mobile */
        .filter-action-group {
            display: flex;
            gap: 0.65rem !important;
            width: 100%;
            margin-top: 0.35rem !important;
        }

        .filter-action-group .frost-btn-primary,
        .filter-action-group .frost-btn-reset {
            flex: 1;
            justify-content: center;
            padding: 0.6rem 0.85rem !important;
            font-size: 0.85rem !important;
        }

        /* Custom dropdown trigger size tuning on mobile */
        .frost-custom-trigger {
            padding: 0.55rem 0.75rem !important;
            font-size: 0.8125rem !important;
        }

        .frost-custom-option {
            padding: 0.5rem 0.65rem !important;
            font-size: 0.8125rem !important;
        }

        /* Pagination alignment on mobile */
        .frost-pagination-wrapper {
            flex-direction: column !important;
            align-items: center !important;
            text-align: center !important;
            gap: 0.65rem !important;
        }

        .frost-pagination-nav {
            width: 100%;
            justify-content: center;
            flex-wrap: wrap;
        }

        /* Mobile Header Button & Badges */
        .card-header-actions {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 0.5rem;
            margin-top: 0.25rem;
        }

        .card-header-actions .frost-btn-primary {
            flex: 1;
            justify-content: center;
        }
    }

    @media (max-width: 575.98px) {
        .frost-hero h3 {
            font-size: 1.15rem !important;
        }

        .frost-hero .badge {
            font-size: 0.7rem !important;
            padding: 0.3rem 0.5rem !important;
        }

        .posko-item-card {
            padding: 1rem !important;
        }

        /* Table cells touch scrolling on mobile */
        .table-responsive .table td,
        .table-responsive .table th {
            padding: 0.5rem 0.55rem !important;
            font-size: 0.8125rem !important;
        }
    }

    /* PSYAID VACCINE/RELAWAN TABS HEADER STYLING */
    .victim-tabs-header {
        border-bottom: 2px solid #a7f3d0 !important;
        gap: 0.5rem;
    }

    .victim-tabs-header .nav-link {
        color: #047857;
        font-weight: 700;
        font-size: 0.875rem;
        border: 1.5px solid transparent;
        border-radius: 8px 8px 0 0 !important;
        padding: 0.65rem 1.25rem;
        transition: all 0.2s ease;
        background: rgba(236, 253, 245, 0.5);
    }

    .victim-tabs-header .nav-link:hover:not(.active) {
        background: #ecfdf5;
        color: #065f46;
        border-color: #a7f3d0;
    }

    .victim-tabs-header .nav-link.active {
        background: linear-gradient(135deg, #059669 0%, #047857 100%) !important;
        color: #ffffff !important;
        border-color: #047857 !important;
        box-shadow: 0 4px 12px rgba(5, 150, 105, 0.25);
    }
</style>

<div class="container-fluid px-0">

    <!-- 1. Hero Header Card -->
    <div class="card frost-hero mb-4">
        <div class="card-body p-4 position-relative">
            <div class="d-flex align-items-center gap-2 mb-2 flex-wrap">
                <span class="badge px-3 py-1.5 fs-8 fw-bold"
                    style="background-color: rgba(6, 95, 70, 0.12); color: #065f46; border: 1px solid rgba(6, 95, 70, 0.25);">
                    <i class="bi bi-people-fill me-1"></i> MANAJEMEN DATA PENYINTAS
                </span>
                <?php if (!empty($posko['name'])): ?>
                    <span class="badge px-3 py-1.5 fs-8"
                        style="background-color: rgba(6, 95, 70, 0.08); color: #047857; border: 1px solid rgba(6, 95, 70, 0.18);">
                        <i class="bi bi-house-heart-fill me-1"></i> <?= esc($posko['name']) ?>
                    </span>
                <?php endif; ?>
                <span class="badge px-3 py-1.5 fs-8 fw-bold"
                    style="background-color: rgba(6, 95, 70, 0.08); color: #047857; border: 1px solid rgba(6, 95, 70, 0.18);">
                    <i class="bi bi-database-check me-1" style="color: #059669;"></i> Total:
                    <?= count($victims ?? []) ?> Penyintas
                </span>
            </div>
            <h3 class="fw-bold mb-1" style="color: #064e3b;">
                <i class="bi bi-person-lines-fill me-2" style="color: #059669;"></i> Manajemen Data Penyintas (Victims)
            </h3>
            <p class="small mb-0" style="color: #047857; max-width: 75ch;">
                Kelola data penyintas bencana, status skrining awal relawan, serta prioritas intervensi berbasis AI
                Clinical Decision Support.
            </p>
        </div>
    </div>

    <!-- Manajemen Tabel Penyintas (Victims Management Card) -->
    <div class="card posko-item-card p-4 mb-4" style="overflow: visible !important;">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3 border-bottom pb-3">
            <h5 class="fw-bold mb-0 d-flex align-items-center" style="color: #064e3b;">
                <i class="bi bi-person-lines-fill text-success me-2 fs-5"></i> Daftar Manajemen Penyintas (Victims)
            </h5>
            <div class="d-flex align-items-center gap-2 flex-wrap card-header-actions">
                <span class="badge px-3 py-1.5 fs-8"
                    style="background-color: rgba(6, 95, 70, 0.08); color: #047857; border: 1px solid rgba(6, 95, 70, 0.18);">
                    <?= count($victims ?? []) ?> Penyintas Tampil
                </span>
                <a href="<?= site_url('/victim/create/' . ($posko['id'] ?? 1)) ?>" class="frost-btn-primary">
                    <i class="bi bi-person-plus-fill me-1"></i> + <span class="d-none d-sm-inline">Tambah Korban
                        Baru</span><span class="d-inline d-sm-none">Tambah Korban</span>
                </a>
            </div>
        </div>

        <!-- Form Filter & Pencarian Penyintas -->
        <form method="GET" action="<?= current_url() ?>" class="row g-2.5 gy-3 align-items-center mb-4 pb-3 border-bottom"
            style="overflow: visible !important;">
            <div class="col-12 col-md-5">
                <input type="text" name="q" class="frost-input-field" placeholder="Cari Nama Penyintas atau NIK..."
                    value="<?= esc($searchFilters['keyword'] ?? '') ?>">
            </div>

            <!-- Custom Floating Dropdown: Status Skrining -->
            <div class="col-12 col-sm-6 col-md-3">
                <select id="filter-screening-status" name="screening_status" class="d-none">
                    <option value="" <?= empty($searchFilters['screening_status']) ? 'selected' : '' ?>>Semua Status
                        Skrining</option>
                    <option value="sudah" <?= ($searchFilters['screening_status'] ?? '') === 'sudah' ? 'selected' : '' ?>>
                        Sudah Skrining</option>
                    <option value="belum" <?= ($searchFilters['screening_status'] ?? '') === 'belum' ? 'selected' : '' ?>>
                        Belum Skrining</option>
                </select>

                <?php
                $scrMap = [
                    'sudah' => 'Sudah Skrining',
                    'belum' => 'Belum Skrining',
                ];
                $selectedScrLabel = isset($scrMap[$searchFilters['screening_status'] ?? '']) ? $scrMap[$searchFilters['screening_status']] : 'Semua Status Skrining';
                ?>
                <div class="frost-custom-select-wrapper" id="custom-wrapper-screening">
                    <div class="frost-custom-trigger" id="trigger-screening" tabindex="0">
                        <span class="trigger-label text-truncate"
                            id="label-screening"><?= esc($selectedScrLabel) ?></span>
                        <i class="bi bi-chevron-down chevron-icon ms-2"></i>
                    </div>
                    <div class="frost-custom-menu" id="menu-screening">
                        <div class="frost-custom-option <?= empty($searchFilters['screening_status']) ? 'selected' : '' ?>"
                            data-value="">
                            <span>Semua Status Skrining</span>
                            <?php if (empty($searchFilters['screening_status'])): ?><i
                                    class="bi bi-check-lg text-emerald-600"></i><?php endif; ?>
                        </div>
                        <div class="frost-custom-option <?= ($searchFilters['screening_status'] ?? '') === 'sudah' ? 'selected' : '' ?>"
                            data-value="sudah">
                            <span>Sudah Skrining</span>
                            <?php if (($searchFilters['screening_status'] ?? '') === 'sudah'): ?><i
                                    class="bi bi-check-lg text-emerald-600"></i><?php endif; ?>
                        </div>
                        <div class="frost-custom-option <?= ($searchFilters['screening_status'] ?? '') === 'belum' ? 'selected' : '' ?>"
                            data-value="belum">
                            <span>Belum Skrining</span>
                            <?php if (($searchFilters['screening_status'] ?? '') === 'belum'): ?><i
                                    class="bi bi-check-lg text-emerald-600"></i><?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Custom Floating Dropdown: Risk Level -->
            <div class="col-12 col-sm-6 col-md-3">
                <select id="filter-risk-level" name="risk_level" class="d-none">
                    <option value="" <?= empty($searchFilters['risk_level']) ? 'selected' : '' ?>>Semua Risk Level
                    </option>
                    <option value="high" <?= ($searchFilters['risk_level'] ?? '') === 'high' ? 'selected' : '' ?>>High Risk
                    </option>
                    <option value="medium" <?= ($searchFilters['risk_level'] ?? '') === 'medium' ? 'selected' : '' ?>>
                        Medium Risk</option>
                    <option value="low" <?= ($searchFilters['risk_level'] ?? '') === 'low' ? 'selected' : '' ?>>Low Risk
                    </option>
                </select>

                <?php
                $riskMap = [
                    'high' => 'High Risk',
                    'medium' => 'Medium Risk',
                    'low' => 'Low Risk',
                ];
                $selectedRiskLabel = isset($riskMap[$searchFilters['risk_level'] ?? '']) ? $riskMap[$searchFilters['risk_level']] : 'Semua Risk Level';
                ?>
                <div class="frost-custom-select-wrapper" id="custom-wrapper-risk">
                    <div class="frost-custom-trigger" id="trigger-risk" tabindex="0">
                        <span class="trigger-label text-truncate" id="label-risk"><?= esc($selectedRiskLabel) ?></span>
                        <i class="bi bi-chevron-down chevron-icon ms-2"></i>
                    </div>
                    <div class="frost-custom-menu" id="menu-risk">
                        <div class="frost-custom-option <?= empty($searchFilters['risk_level']) ? 'selected' : '' ?>"
                            data-value="">
                            <span>Semua Risk Level</span>
                            <?php if (empty($searchFilters['risk_level'])): ?><i
                                    class="bi bi-check-lg text-emerald-600"></i><?php endif; ?>
                        </div>
                        <div class="frost-custom-option <?= ($searchFilters['risk_level'] ?? '') === 'high' ? 'selected' : '' ?>"
                            data-value="high">
                            <span>High Risk</span>
                            <?php if (($searchFilters['risk_level'] ?? '') === 'high'): ?><i
                                    class="bi bi-check-lg text-emerald-600"></i><?php endif; ?>
                        </div>
                        <div class="frost-custom-option <?= ($searchFilters['risk_level'] ?? '') === 'medium' ? 'selected' : '' ?>"
                            data-value="medium">
                            <span>Medium Risk</span>
                            <?php if (($searchFilters['risk_level'] ?? '') === 'medium'): ?><i
                                    class="bi bi-check-lg text-emerald-600"></i><?php endif; ?>
                        </div>
                        <div class="frost-custom-option <?= ($searchFilters['risk_level'] ?? '') === 'low' ? 'selected' : '' ?>"
                            data-value="low">
                            <span>Low Risk</span>
                            <?php if (($searchFilters['risk_level'] ?? '') === 'low'): ?><i
                                    class="bi bi-check-lg text-emerald-600"></i><?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-1 d-flex gap-1 filter-action-group">
                <button type="submit" class="frost-btn-primary w-100 justify-content-center" title="Cari"><i
                        class="bi bi-search"></i></button>
                <a href="<?= current_url() ?>" class="frost-btn-reset" title="Reset Filter"><i
                        class="bi bi-arrow-counterclockwise"></i></a>
            </div>
        </form>

        <!-- Table Victim List -->
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead style="background-color: #f8fafc;" class="text-secondary small text-uppercase">
                    <tr>
                        <th style="width: 5%;">No</th>
                        <th style="width: 25%;">Nama & NIK</th>
                        <th style="width: 12%;">GENDER & UMUR</th>
                        <th style="width: 15%;">Waktu Datang</th>
                        <th style="width: 15%;">Status Skrining</th>
                        <th style="width: 13%;">AI Risk Level</th>
                        <th style="width: 15%;">Psikolog Assigned</th>
                        <th style="width: 10%;" class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody id="victims-tbody">
                    <?php if (empty($victims)): ?>
                        <tr>
                            <td colspan="8" class="text-center py-4 text-muted">
                                <i class="bi bi-inbox fs-3 d-block mb-1 text-emerald-600"></i>
                                Tidak ada data penyintas yang sesuai dengan kriteria pencarian.
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php $no = 1;
                        foreach ($victims as $v): ?>
                            <tr>
                                <td class="fw-bold text-muted"><?= $no++ ?></td>
                                <td>
                                    <a href="javascript:void(0)" onclick="openVictimDetailModal(<?= $v['id'] ?>)" class="fw-bold text-decoration-none"
                                        style="color: #064e3b !important;">
                                        <?= esc($v['nama']) ?>
                                    </a>
                                    <div class="fs-8 text-muted">NIK: <?= esc($v['nik'] ?? '-') ?></div>
                                </td>
                                <td>
                                    <span
                                        class="badge bg-light text-dark border me-1 fs-9"><?= esc($v['jenis_kelamin']) ?></span>
                                    <span class="small text-muted fs-8"><?= esc($v['umur']) ?> Thn</span>
                                </td>
                                <td class="small text-muted">
                                    <div><i class="bi bi-calendar3 me-1 text-emerald-600"></i> <span
                                            data-device-time="<?= esc($v['tanggal_datang']) ?>"
                                            data-format-type="date-only"><?= esc($v['tanggal_datang']) ?></span>
                                    </div>
                                    <div class="fs-8"><i class="bi bi-clock me-1 text-emerald-600"></i> <span
                                            data-device-time="<?= esc($v['tanggal_datang'] . ' ' . $v['jam_datang']) ?>"
                                            data-format-type="time-only" data-show-tz="true"><?= esc($v['jam_datang']) ?></span>
                                    </div>
                                </td>
                                <td>
                                    <?php if (!empty($v['screening_id'])): ?>
                                        <span class="badge bg-success-subtle text-success border border-success-subtle mb-1 fs-8">
                                            <i class="bi bi-check-circle-fill me-1"></i> Sudah Skrining
                                        </span>
                                        <div class="fs-8 text-muted">Distress:
                                            <strong><?= esc($v['skala_distress'] ?? 0) ?>/10</strong>
                                        </div>
                                    <?php else: ?>
                                        <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle fs-8">
                                            <i class="bi bi-clock-history me-1"></i> Belum Skrining
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if (($v['risk_level'] ?? '') === 'high'): ?>
                                        <span class="badge bg-danger-subtle text-danger border border-danger-subtle fs-8 px-2 py-1">
                                            <i class="bi bi-exclamation-triangle-fill me-1"></i> HIGH RISK
                                        </span>
                                    <?php elseif (($v['risk_level'] ?? '') === 'medium'): ?>
                                        <span
                                            class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle fs-8 px-2 py-1">
                                            <i class="bi bi-dash-circle-fill me-1"></i> MEDIUM RISK
                                        </span>
                                    <?php elseif (($v['risk_level'] ?? '') === 'low'): ?>
                                        <span
                                            class="badge bg-info-subtle text-info-emphasis border border-info-subtle fs-8 px-2 py-1">
                                            <i class="bi bi-check-circle-fill me-1"></i> LOW RISK
                                        </span>
                                    <?php else: ?>
                                        <span class="badge bg-light text-muted border fs-9">Belum AI</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if (!empty($v['psikolog_name'])): ?>
                                        <span class="badge bg-primary-subtle text-primary border border-primary-subtle fs-8">
                                            <i class="bi bi-person-check-fill me-1"></i> <?= esc($v['psikolog_name']) ?>
                                        </span>
                                    <?php else: ?>
                                        <span class="badge bg-light text-muted border fs-9">Belum Ditugaskan</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-end">
                                    <button type="button" class="frost-btn-primary py-1 px-2.5 fs-8"
                                        onclick="openVictimDetailModal(<?= $v['id'] ?>)" title="Lihat Summary & Hasil AI">
                                        Detail <i class="bi bi-eye ms-1"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <!-- Pagination Victims -->
        <div id="victims-pagination-container" class="frost-pagination-wrapper d-none"></div>
    </div>

</div>

<!-- Modal Dynamic Summary & AI Assessment -->
<div class="modal fade" id="victimDetailModal" tabindex="-1" aria-labelledby="victimDetailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content frost-card border-0 shadow-lg" style="border: 1.5px solid #a7f3d0 !important; border-radius: 14px !important;">
            <div class="modal-header border-bottom pb-3" style="background: linear-gradient(135deg, #ecfdf5 0%, #ffffff 100%); border-bottom: 1.5px solid #a7f3d0 !important;">
                <div class="d-flex align-items-center gap-2">
                    <div class="d-flex align-items-center justify-content-center rounded-circle flex-shrink-0" style="width: 40px; height: 40px; background: #ecfdf5; color: #047857; border: 1px solid #a7f3d0;">
                        <i class="bi bi-person-vcard fs-5"></i>
                    </div>
                    <div>
                        <h5 class="modal-title fw-bold fs-6 mb-0" id="victimDetailModalLabel" style="color: #064e3b;">
                            Ringkasan & AI Assessment: <span id="mdl-nama" class="text-dark fw-bold">-</span>
                        </h5>
                        <div class="small text-muted fs-8">
                            NIK: <span id="mdl-nik">-</span> • Posko: <span id="mdl-posko">-</span>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <div class="modal-body p-3 p-md-4" style="background: #f8fafc;">
                <!-- Nav Tabs for Modal -->
                <ul class="nav nav-tabs victim-tabs-header mb-4" id="modalDetailTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="mdl-summary-tab" data-bs-toggle="tab" data-bs-target="#mdl-tab-summary" type="button" role="tab">
                            <i class="bi bi-file-earmark-text me-1"></i> 1. Ringkasan Data (Summary)
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="mdl-ai-tab" data-bs-toggle="tab" data-bs-target="#mdl-tab-ai" type="button" role="tab">
                            <i class="bi bi-cpu me-1"></i> 2. Hasil AI Assessment & Rekomendasi
                        </button>
                    </li>
                </ul>

                <div class="tab-content" id="modalDetailTabContent">
                    <!-- Tab 1: Summary -->
                    <div class="tab-pane fade show active" id="mdl-tab-summary" role="tabpanel">
                        <div id="mdl-summary-body">
                            <div class="text-center py-5 text-muted">
                                <div class="spinner-border text-success mb-2" role="status"></div>
                                <div>Memuat data ringkasan penyintas...</div>
                            </div>
                        </div>
                    </div>

                    <!-- Tab 2: AI Assessment -->
                    <div class="tab-pane fade" id="mdl-tab-ai" role="tabpanel">
                        <div id="mdl-ai-body">
                            <div class="text-center py-5 text-muted">
                                <div class="spinner-border text-success mb-2" role="status"></div>
                                <div>Memuat data analisis AI Assessment...</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer bg-white border-top py-2.5">
                <button type="button" class="frost-btn-reset px-3 py-1.5 fs-7" data-bs-dismiss="modal">
                    <i class="bi bi-x-lg me-1"></i> Tutup
                </button>
                <a id="mdl-full-edit-btn" href="#" class="frost-btn-primary px-3 py-1.5 fs-7">
                    <i class="bi bi-pencil-square me-1"></i> Buka Rekam Medis Utuh <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<script>
    function openVictimDetailModal(victimId) {
        const modalEl = document.getElementById('victimDetailModal');
        const modal = new bootstrap.Modal(modalEl);
        
        document.getElementById('mdl-nama').textContent = 'Memuat...';
        document.getElementById('mdl-nik').textContent = '-';
        document.getElementById('mdl-posko').textContent = '-';
        document.getElementById('mdl-full-edit-btn').href = `<?= site_url('/victim/detail/') ?>${victimId}`;
        
        document.getElementById('mdl-summary-body').innerHTML = `
            <div class="text-center py-5 text-muted">
                <div class="spinner-border text-success mb-2" role="status"></div>
                <div>Memuat data ringkasan penyintas...</div>
            </div>`;
        document.getElementById('mdl-ai-body').innerHTML = `
            <div class="text-center py-5 text-muted">
                <div class="spinner-border text-success mb-2" role="status"></div>
                <div>Memuat data analisis AI Assessment...</div>
            </div>`;
            
        // Reset tab focus to summary
        const summaryTabBtn = document.getElementById('mdl-summary-tab');
        if (summaryTabBtn) new bootstrap.Tab(summaryTabBtn).show();
        
        modal.show();

        fetch(`<?= site_url('/victim/detail-json/') ?>${victimId}`)
            .then(res => res.json())
            .then(res => {
                if (!res.success) {
                    document.getElementById('mdl-summary-body').innerHTML = `<div class="alert alert-danger">Gagal memuat data penyintas.</div>`;
                    document.getElementById('mdl-ai-body').innerHTML = `<div class="alert alert-danger">Gagal memuat data AI.</div>`;
                    return;
                }

                const v = res.victim;
                const d = res.disasterInfo || {};
                const p = res.psychHist || {};
                const s = res.screening || {};
                const ai = res.aiAssessment || {};
                const itq = res.itqResult || {};

                document.getElementById('mdl-nama').textContent = v.nama || '-';
                document.getElementById('mdl-nik').textContent = v.nik || '-';
                document.getElementById('mdl-posko').textContent = v.posko_name || '-';

                // Format Waktu Tiba
                const arrivalFormatted = typeof formatDeviceTime === 'function' && (v.tanggal_datang || v.jam_datang)
                    ? formatDeviceTime(`${v.tanggal_datang || ''} ${v.jam_datang || ''}`) + ' ' + (typeof getDeviceTimezoneAbbr === 'function' ? getDeviceTimezoneAbbr() : '')
                    : `${v.tanggal_datang || '-'} ${v.jam_datang || ''}`;

                // 1. RENDER SUMMARY TAB CONTENT
                const jkText = v.jenis_kelamin === 'L' ? 'Laki-Laki (L)' : 'Perempuan (P)';
                const diagnosesText = res.savedDiagnoses && res.savedDiagnoses.length > 0 ? res.savedDiagnoses.join(', ') : 'Tidak Ada Diagnosis Sebelumnya';

                document.getElementById('mdl-summary-body').innerHTML = `
                    <!-- 1. IDENTITAS PENYINTAS -->
                    <div class="card posko-item-card p-3 p-md-4 mb-3">
                        <h6 class="fw-bold text-dark mb-3 fs-6"><i class="bi bi-card-heading text-success me-2"></i> 1. Identitas Penyintas</h6>
                        <div class="bg-white p-3 rounded border">
                            <div class="row g-3">
                                <div class="col-12 col-md-4">
                                    <span class="text-muted small d-block">Nama Lengkap</span>
                                    <strong class="text-dark fs-6">${v.nama || '-'}</strong>
                                </div>
                                <div class="col-6 col-md-4">
                                    <span class="text-muted small d-block">Jenis Kelamin</span>
                                    <strong class="text-dark">${jkText}</strong>
                                </div>
                                <div class="col-6 col-md-4">
                                    <span class="text-muted small d-block">Umur</span>
                                    <strong class="text-dark">${v.umur || '-'} Tahun</strong>
                                </div>
                                <div class="col-12 col-md-6">
                                    <span class="text-muted small d-block">NIK</span>
                                    <strong class="text-dark">${v.nik || '-'}</strong>
                                </div>
                                <div class="col-12 col-md-6">
                                    <span class="text-muted small d-block">Kontak Keluarga / No HP</span>
                                    <strong class="text-dark">${v.no_hp_keluarga || '-'}</strong>
                                </div>
                                <div class="col-12">
                                    <span class="text-muted small d-block">Alamat Asal</span>
                                    <span class="text-dark">${v.alamat || '-'}</span>
                                </div>
                                <div class="col-12 col-md-6">
                                    <span class="text-muted small d-block">Waktu Tiba di Posko</span>
                                    <strong class="text-dark">${arrivalFormatted}</strong>
                                </div>
                                <div class="col-12 col-md-6">
                                    <span class="text-muted small d-block">Ditemukan Oleh Relawan</span>
                                    <strong class="text-dark">${v.relawan_nama || 'Relawan Posko'}</strong>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 1. IDENTITAS PENYINTAS -->
                    <div class="card posko-item-card p-3 p-md-4 mb-3">
                        <h6 class="fw-bold mb-3 fs-6" style="color: #064e3b;"><i class="bi bi-card-heading text-success me-2"></i> 1. Identitas Penyintas</h6>
                        <div class="bg-white p-3 rounded" style="border: 1px solid #e2e8f0;">
                            <div class="row g-3">
                                <div class="col-12 col-md-4">
                                    <span class="text-muted small d-block">Nama Lengkap</span>
                                    <strong style="color: #064e3b;" class="fs-6">${v.nama || '-'}</strong>
                                </div>
                                <div class="col-6 col-md-4">
                                    <span class="text-muted small d-block">Jenis Kelamin</span>
                                    <strong class="text-dark">${jkText}</strong>
                                </div>
                                <div class="col-6 col-md-4">
                                    <span class="text-muted small d-block">Umur</span>
                                    <strong class="text-dark">${v.umur || '-'} Tahun</strong>
                                </div>
                                <div class="col-12 col-md-6">
                                    <span class="text-muted small d-block">NIK</span>
                                    <strong class="text-dark">${v.nik || '-'}</strong>
                                </div>
                                <div class="col-12 col-md-6">
                                    <span class="text-muted small d-block">Kontak Keluarga / No HP</span>
                                    <strong class="text-dark">${v.no_hp_keluarga || '-'}</strong>
                                </div>
                                <div class="col-12">
                                    <span class="text-muted small d-block">Alamat Asal</span>
                                    <span class="text-dark">${v.alamat || '-'}</span>
                                </div>
                                <div class="col-12 col-md-6">
                                    <span class="text-muted small d-block">Waktu Tiba di Posko</span>
                                    <strong class="text-dark">${arrivalFormatted}</strong>
                                </div>
                                <div class="col-12 col-md-6">
                                    <span class="text-muted small d-block">Ditemukan Oleh Relawan</span>
                                    <strong class="text-dark">${v.relawan_nama || 'Relawan Posko'}</strong>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 2. INFORMASI & DAMPAK BENCANA -->
                    <div class="card posko-item-card p-3 p-md-4 mb-3">
                        <h6 class="fw-bold mb-3 fs-6" style="color: #064e3b;"><i class="bi bi-tsunami text-danger me-2"></i> 2. Informasi & Dampak Bencana</h6>
                        <div class="bg-white p-3 rounded" style="border: 1px solid #e2e8f0;">
                            <div class="row g-3">
                                <div class="col-12 col-md-4">
                                    <span class="text-muted small d-block">Jenis Bencana</span>
                                    <strong class="text-dark">${d.jenis_bencana || v.posko_bencana || 'Gempa Bumi'}</strong>
                                </div>
                                <div class="col-12 col-md-4">
                                    <span class="text-muted small d-block">Lokasi Posko</span>
                                    <strong class="text-dark">${(v.regency_name || '') + ', ' + (v.province_name || '')}</strong>
                                </div>
                                <div class="col-12 col-md-4">
                                    <span class="text-muted small d-block">Tanggal Kejadian Bencana</span>
                                    <strong class="text-dark">${d.tanggal || '-'}</strong>
                                </div>
                                <div class="col-12">
                                    <span class="text-muted small d-block mb-1">Durasi Terjebak Reruntuhan / Bencana</span>
                                    <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle px-3 py-1.5 fs-7">${d.durasi_terjebak || '<1 jam'}</span>
                                </div>
                                <div class="col-12">
                                    <span class="text-muted small d-block mb-2">Indikator Dampak Trauma Bencana</span>
                                    <div class="d-flex flex-wrap gap-2">
                                        ${d.mengungsi ? '<span class="badge px-3 py-1.5 fs-8" style="background-color: rgba(6, 95, 70, 0.12); color: #065f46; border: 1px solid rgba(6, 95, 70, 0.25);">✓ Mengungsi</span>' : '<span class="badge bg-light text-muted border px-3 py-1.5 fs-8">✗ Tidak Mengungsi</span>'}
                                        ${d.kehilangan_rumah ? '<span class="badge bg-danger-subtle text-danger border border-danger-subtle px-3 py-1.5 fs-8">✓ Rumah Hancur/Kehilangan</span>' : '<span class="badge bg-light text-muted border px-3 py-1.5 fs-8">✗ Rumah Utuh</span>'}
                                        ${d.kehilangan_keluarga ? '<span class="badge bg-danger-subtle text-danger border border-danger-subtle px-3 py-1.5 fs-8">✓ Kehilangan Keluarga</span>' : '<span class="badge bg-light text-muted border px-3 py-1.5 fs-8">✗ Keluarga Utuh</span>'}
                                        ${d.cedera ? '<span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle px-3 py-1.5 fs-8">✓ Cedera Fisik</span>' : '<span class="badge bg-light text-muted border px-3 py-1.5 fs-8">✗ Tidak Cedera</span>'}
                                        ${d.rawat_inap ? '<span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle px-3 py-1.5 fs-8">✓ Rawat Inap</span>' : '<span class="badge bg-light text-muted border px-3 py-1.5 fs-8">✗ Tidak Rawat Inap</span>'}
                                        ${d.saksi_kematian ? '<span class="badge bg-danger-subtle text-danger border border-danger-subtle px-3 py-1.5 fs-8">✓ Saksi Kematian</span>' : '<span class="badge bg-light text-muted border px-3 py-1.5 fs-8">✗ Bukan Saksi Kematian</span>'}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 3. RIWAYAT MEDIS & PSIKOLOGIS -->
                    <div class="card posko-item-card p-3 p-md-4 mb-3">
                        <h6 class="fw-bold mb-3 fs-6" style="color: #064e3b;"><i class="bi bi-journal-medical text-primary me-2"></i> 3. Riwayat Medis & Psikologis</h6>
                        <div class="bg-white p-3 rounded" style="border: 1px solid #e2e8f0;">
                            <div class="row g-3">
                                <div class="col-12 col-md-6">
                                    <span class="text-muted small d-block">Pernah Konsultasi / Dirawat Psikiater</span>
                                    <strong class="text-dark">${p.pernah_konsultasi ? 'Pernah Konsultasi' : 'Belum Pernah'} • ${p.pernah_dirawat_psikiater ? 'Pernah Dirawat' : 'Tidak Pernah Dirawat'}</strong>
                                </div>
                                <div class="col-12 col-md-6">
                                    <span class="text-muted small d-block">Riwayat Risiko Melukai Diri / Suicide / NAPZA</span>
                                    <div>
                                        ${p.riwayat_percobaan_bunuh_diri ? '<span class="badge bg-danger-subtle text-danger border border-danger-subtle me-1">Percobaan Bunuh Diri</span>' : ''}
                                        ${p.riwayat_melukai_diri ? '<span class="badge bg-danger-subtle text-danger border border-danger-subtle me-1">Melukai Diri</span>' : ''}
                                        ${p.riwayat_napza ? '<span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle me-1">Riwayat NAPZA</span>' : ''}
                                        ${!p.riwayat_percobaan_bunuh_diri && !p.riwayat_melukai_diri && !p.riwayat_napza ? '<span class="text-muted fs-7">Tidak Ada Riwayat Krisis</span>' : ''}
                                    </div>
                                </div>
                                <div class="col-12">
                                    <span class="text-muted small d-block">Diagnosis Sebelumnya</span>
                                    <strong class="text-dark">${diagnosesText}</strong>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 4. SKRINING AWAL RELAWAN -->
                    <div class="card posko-item-card p-3 p-md-4">
                        <h6 class="fw-bold mb-3 fs-6" style="color: #064e3b;"><i class="bi bi-clipboard-pulse text-success me-2"></i> 4. Skrining Awal Relawan</h6>
                        ${s.id ? `
                            <div class="bg-white p-3 rounded" style="border: 1px solid #e2e8f0;">
                                <div class="row g-3">
                                    <div class="col-12 col-md-4">
                                        <span class="text-muted small d-block">Kemampuan Orientasi</span>
                                        <strong class="text-dark">${s.mampu_sebut_nama ? '✓ Nama' : '✗ Nama'} • ${s.mampu_sebut_lokasi ? '✓ Lokasi' : '✗ Lokasi'} • ${s.mampu_sebut_tanggal ? '✓ Tanggal' : '✗ Tanggal'}</strong>
                                    </div>
                                    <div class="col-6 col-md-4">
                                        <span class="text-muted small d-block">Kontak Mata</span>
                                        <strong class="text-dark text-capitalize">${s.kontak_mata || 'baik'}</strong>
                                    </div>
                                    <div class="col-6 col-md-4">
                                        <span class="text-muted small d-block">Cara Berbicara</span>
                                        <strong class="text-dark text-capitalize">${s.bicara || 'normal'}</strong>
                                    </div>
                                    <div class="col-12">
                                        <span class="text-muted small d-block mb-1">Skala Distress Teramati</span>
                                        <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-3 py-1.5 fs-7 fw-bold">Skala Distress: ${s.skala_distress || 0}/10</span>
                                    </div>
                                </div>
                            </div>
                        ` : `
                            <div class="alert alert-warning mb-0 fs-7 border border-warning-subtle">
                                <i class="bi bi-exclamation-triangle me-1"></i> Belum ada data Skrining Relawan.
                            </div>
                        `}
                    </div>
                `;

                // 2. RENDER AI ASSESSMENT TAB CONTENT
                if (!ai.id && !ai.risk_level) {
                    document.getElementById('mdl-ai-body').innerHTML = `
                        <div class="alert alert-warning border-start border-4 border-warning p-4 shadow-sm my-3">
                            <h6 class="fw-bold mb-1" style="color: #064e3b;"><i class="bi bi-info-circle-fill me-2"></i> Belum Ada AI Assessment</h6>
                            <p class="mb-0 small text-dark">Penyintas ini belum memiliki hasil analisis AI Clinical Decision Support. Silakan selesaikan skrining relawan untuk memicu analisis AI.</p>
                        </div>`;
                    return;
                }

                const riskBadgeMap = {
                    'high': '<span class="badge bg-danger-subtle text-danger border border-danger-subtle px-3 py-1.5 fs-7 fw-bold"><i class="bi bi-exclamation-triangle-fill me-1"></i> HIGH RISK</span>',
                    'medium': '<span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle px-3 py-1.5 fs-7 fw-bold"><i class="bi bi-dash-circle-fill me-1"></i> MEDIUM RISK</span>',
                    'low': '<span class="badge bg-info-subtle text-info-emphasis border border-info-subtle px-3 py-1.5 fs-7 fw-bold"><i class="bi bi-check-circle-fill me-1"></i> LOW RISK</span>'
                };
                const riskBadge = riskBadgeMap[ai.risk_level] || '<span class="badge bg-secondary fs-7">Unknown</span>';
                
                let confidenceText = '88%';
                if (ai.confidence !== undefined && ai.confidence !== null && ai.confidence !== '') {
                    let confNum = parseFloat(ai.confidence);
                    if (!isNaN(confNum)) {
                        if (confNum <= 1 && confNum > 0) {
                            confNum = Math.round(confNum * 100);
                        } else {
                            confNum = Math.round(confNum);
                        }
                        confidenceText = confNum + '%';
                    }
                }

                const confidence = confidenceText;
                const priority = ai.clinical_priority || (ai.risk_level === 'high' ? 'P1 - Urgensi Tinggi' : 'P2 - Intervensi Sedang');

                let itqStatusBadge = '<span class="badge bg-light text-muted border px-2.5 py-1 fs-8 fw-semibold">Belum Diisi ITQ</span>';
                if (itq.id || itq.cptsd_diagnosis) {
                    if (itq.cptsd_diagnosis === 'CPTSD' || itq.is_cptsd) {
                        itqStatusBadge = '<span class="badge bg-danger-subtle text-danger border border-danger-subtle px-2.5 py-1 fs-8 fw-bold">Terindikasi CPTSD</span>';
                    } else if (itq.ptsd_diagnosis === 'PTSD' || itq.is_ptsd) {
                        itqStatusBadge = '<span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle px-2.5 py-1 fs-8 fw-bold">Terindikasi PTSD</span>';
                    } else {
                        itqStatusBadge = '<span class="badge bg-success-subtle text-success border border-success-subtle px-2.5 py-1 fs-8 fw-bold">Dalam Batas Normal</span>';
                    }
                }

                const evidenceText = ai.evidence_sources || 'Memenuhi kriteria indikator risiko klinis trauma bencana.';
                const summaryText = ai.ai_summary || 'Menunjukkan respon adaptif terhadap situasi darurat bencana.';
                const formattedGenTime = typeof formatDeviceTime === 'function' && ai.generated_at
                    ? formatDeviceTime(ai.generated_at) + ' ' + (typeof getDeviceTimezoneAbbr === 'function' ? getDeviceTimezoneAbbr() : '')
                    : (ai.generated_at || '-');

                document.getElementById('mdl-ai-body').innerHTML = `
                    <!-- 4 KPI CARDS -->
                    <div class="row g-3 mb-4">
                        <div class="col-12 col-sm-6 col-lg-3">
                            <div class="card posko-item-card p-3 p-md-3.5 h-100">
                                <div class="text-secondary fs-8 fw-bold text-uppercase" style="letter-spacing: 0.03em;">Risk Level</div>
                                <hr class="my-2 opacity-25" style="color: #059669;" />
                                <div class="mt-1">${riskBadge}</div>
                                <div class="fs-9 text-muted fw-semibold mt-2">Kategori AI Decision</div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-lg-3">
                            <div class="card posko-item-card p-3 p-md-3.5 h-100">
                                <div class="text-secondary fs-8 fw-bold text-uppercase" style="letter-spacing: 0.03em;">Confidence Ratio</div>
                                <hr class="my-2 opacity-25" style="color: #059669;" />
                                <div class="fs-3 fw-bold mb-1 text-truncate tabular-nums" style="color: #064e3b;">${confidence}</div>
                                <div class="fs-9 text-muted fw-semibold">Tingkat Keyakinan Engine</div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-lg-3">
                            <div class="card posko-item-card p-3 p-md-3.5 h-100">
                                <div class="text-secondary fs-8 fw-bold text-uppercase" style="letter-spacing: 0.03em;">Clinical Priority</div>
                                <hr class="my-2 opacity-25" style="color: #059669;" />
                                <div class="fs-6 fw-bold mb-1 text-truncate" style="color: #064e3b;">${priority}</div>
                                <div class="fs-9 text-muted fw-semibold">Prioritas Penanganan</div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-lg-3">
                            <div class="card posko-item-card p-3 p-md-3.5 h-100">
                                <div class="text-secondary fs-8 fw-bold text-uppercase" style="letter-spacing: 0.03em;">Instrumen ITQ</div>
                                <hr class="my-2 opacity-25" style="color: #059669;" />
                                <div class="mt-1">${itqStatusBadge}</div>
                                <div class="fs-9 text-muted fw-semibold mt-2">Status Asesmen Lanjutan</div>
                            </div>
                        </div>
                    </div>

                    <!-- RAG INFO BANNER -->
                    <div class="card posko-item-card p-3 p-md-4 mb-3 mb-md-4" style="background: linear-gradient(135deg, #f0fdf4 0%, #ffffff 100%); border-color: #a7f3d0 !important;">
                        <div class="d-flex align-items-start justify-content-between flex-column flex-md-row gap-2.5 gap-md-3">
                            <div class="d-flex align-items-start gap-2 me-md-2">
                                <i class="bi bi-search-heart text-emerald-600 fs-5 mt-0.5 flex-shrink-0"></i>
                                <div>
                                    <h6 class="fw-bold mb-1 fs-6" style="color: #064e3b;">RAG Clinical Knowledge Base & Web Search Grounding</h6>
                                    <div class="small text-muted lh-sm" style="font-size: 0.8125rem;">Diperkuat pedoman klinis WHO PFA, IASC MHPSS, HIMPSI Crisis Protocol & Penelusuran Web Gemini.</div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center flex-wrap flex-md-nowrap gap-1.5 gap-md-2 mt-2 mt-md-0 flex-shrink-0 text-nowrap">
                                <span class="badge px-2.5 px-md-3 py-1.5 fs-8 fw-semibold text-nowrap" style="background: #d1fae5; color: #065f46; border: 1px solid #6ee7b7;">
                                    <i class="bi bi-database-check me-1"></i> WHO / IASC / HIMPSI RAG
                                </span>
                                <span class="badge px-2.5 px-md-3 py-1.5 fs-8 fw-semibold text-nowrap" style="background: #e0f2fe; color: #0369a1; border: 1px solid #7dd3fc;">
                                    <i class="bi bi-globe me-1"></i> Google Search Grounded
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- KEMUNGKINAN DIAGNOSIS -->
                    <div class="card posko-item-card p-3 p-md-4 mb-3 mb-md-4">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <i class="bi bi-journal-check text-danger fs-5"></i>
                            <h6 class="fw-bold mb-0 fs-6" style="color: #064e3b;">Kemungkinan Diagnosis Klinis</h6>
                        </div>
                        <div class="p-3 rounded" style="background: #f8fafc; border: 1px solid #e2e8f0;">
                            <div class="small fw-semibold" style="color: #334155;">
                                Indikasi Diagnosis Terdeteksi: <strong class="text-danger me-2">${ai.diagnosis_indication || 'Mild Stress Response / Respon Adaptif Bencana Normal'}</strong>
                            </div>
                        </div>
                    </div>

                    <!-- AI SUMMARY & REKOMENDASI -->
                    <div class="card posko-item-card p-3 p-md-4 mb-3 mb-md-4">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <i class="bi bi-chat-left-quote-fill text-emerald-600 fs-5"></i>
                            <h6 class="fw-bold mb-0 fs-6" style="color: #064e3b;">AI Summary & Rekomendasi Naratif</h6>
                        </div>
                        <div class="p-3 rounded bg-white" style="border: 1px solid #d1fae5; font-size: 0.875rem; line-height: 1.6; color: #1e293b; white-space: pre-wrap;">${summaryText}</div>
                    </div>

                    <!-- SUMBER BUKTI -->
                    <div class="card posko-item-card p-3 p-md-4">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <i class="bi bi-list-check text-emerald-600 fs-5"></i>
                            <h6 class="fw-bold mb-0 fs-6" style="color: #064e3b;">Sumber Bukti & Indikator (Evidence Sources)</h6>
                        </div>
                        <div class="p-3 rounded bg-white" style="border: 1px solid #d1fae5; font-size: 0.875rem; line-height: 1.6; color: #334155; white-space: pre-wrap;">${evidenceText}</div>
                    </div>
                `;
            })
            .catch(err => {
                document.getElementById('mdl-summary-body').innerHTML = `<div class="alert alert-danger">Terjadi kesalahan koneksi sistem.</div>`;
                document.getElementById('mdl-ai-body').innerHTML = `<div class="alert alert-danger">Terjadi kesalahan koneksi sistem.</div>`;
            });
    }

    document.addEventListener('DOMContentLoaded', function () {
        function setupCustomSelect(triggerId, menuId, nativeSelectId, labelId, wrapperId) {
            const trigger = document.getElementById(triggerId);
            const menu = document.getElementById(menuId);
            const nativeSelect = document.getElementById(nativeSelectId);
            const label = document.getElementById(labelId);
            const wrapper = document.getElementById(wrapperId);

            if (!trigger || !menu || !nativeSelect || !label || !wrapper) return;

            trigger.addEventListener('click', function (e) {
                e.stopPropagation();
                const isShowing = menu.classList.contains('show');

                document.querySelectorAll('.frost-custom-menu').forEach(m => m.classList.remove('show'));
                document.querySelectorAll('.frost-custom-trigger').forEach(t => t.classList.remove('active'));
                document.querySelectorAll('.frost-custom-select-wrapper').forEach(w => w.classList.remove('active-dropdown'));

                if (!isShowing) {
                    menu.classList.add('show');
                    trigger.classList.add('active');
                    wrapper.classList.add('active-dropdown');
                }
            });

            menu.querySelectorAll('.frost-custom-option').forEach(option => {
                option.addEventListener('click', function (e) {
                    e.stopPropagation();
                    const val = this.getAttribute('data-value');
                    const textSpan = this.querySelector('span') ? this.querySelector('span').innerText : this.innerText;

                    label.innerText = textSpan;
                    nativeSelect.value = val;

                    menu.querySelectorAll('.frost-custom-option').forEach(opt => {
                        opt.classList.remove('selected');
                        const icon = opt.querySelector('.bi-check-lg');
                        if (icon) icon.remove();
                    });

                    this.classList.add('selected');
                    if (!this.querySelector('.bi-check-lg')) {
                        const checkIcon = document.createElement('i');
                        checkIcon.className = 'bi bi-check-lg text-emerald-600';
                        this.appendChild(checkIcon);
                    }

                    menu.classList.remove('show');
                    trigger.classList.remove('active');
                    wrapper.classList.remove('active-dropdown');
                });
            });
        }

        setupCustomSelect('trigger-screening', 'menu-screening', 'filter-screening-status', 'label-screening', 'custom-wrapper-screening');
        setupCustomSelect('trigger-risk', 'menu-risk', 'filter-risk-level', 'label-risk', 'custom-wrapper-risk');

        document.addEventListener('click', function () {
            document.querySelectorAll('.frost-custom-menu').forEach(m => m.classList.remove('show'));
            document.querySelectorAll('.frost-custom-trigger').forEach(t => t.classList.remove('active'));
            document.querySelectorAll('.frost-custom-select-wrapper').forEach(w => w.classList.remove('active-dropdown'));
        });

        // CLIENT-SIDE PAGINATION LOGIC (> 10 ITEMS)
        function initClientPagination(tableBodyId, paginationContainerId, itemsPerPage = 10) {
            const tbody = document.getElementById(tableBodyId);
            const container = document.getElementById(paginationContainerId);
            if (!tbody || !container) return;

            const rows = Array.from(tbody.querySelectorAll('tr'));
            const validRows = rows.filter(r => !r.querySelector('td[colspan]'));

            if (validRows.length <= itemsPerPage) {
                container.innerHTML = '';
                container.classList.add('d-none');
                validRows.forEach(r => r.style.display = '');
                return;
            }

            container.classList.remove('d-none');
            let currentPage = 1;
            const totalPages = Math.ceil(validRows.length / itemsPerPage);

            function renderPage(page) {
                currentPage = page;
                const start = (page - 1) * itemsPerPage;
                const end = start + itemsPerPage;

                validRows.forEach((row, idx) => {
                    if (idx >= start && idx < end) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });

                const displayedEnd = Math.min(end, validRows.length);
                const infoHtml = `<span class="frost-pagination-info">Menampilkan <strong class="text-dark">${start + 1} - ${displayedEnd}</strong> dari <strong class="text-dark">${validRows.length}</strong> Data</span>`;

                let navHtml = `<div class="frost-pagination-nav">`;

                navHtml += `<button type="button" class="frost-page-btn ${page === 1 ? 'disabled' : ''}" data-page="${page - 1}" ${page === 1 ? 'disabled' : ''}>
                                <i class="bi bi-chevron-left"></i> Prev
                            </button>`;

                for (let i = 1; i <= totalPages; i++) {
                    if (i === 1 || i === totalPages || (i >= page - 1 && i <= page + 1)) {
                        navHtml += `<button type="button" class="frost-page-btn ${i === page ? 'active' : ''}" data-page="${i}">${i}</button>`;
                    } else if (i === page - 2 || i === page + 2) {
                        navHtml += `<span class="px-1 text-muted">...</span>`;
                    }
                }

                navHtml += `<button type="button" class="frost-page-btn ${page === totalPages ? 'disabled' : ''}" data-page="${page + 1}" ${page === totalPages ? 'disabled' : ''}>
                                Next <i class="bi bi-chevron-right"></i>
                            </button>`;
                navHtml += `</div>`;

                container.innerHTML = infoHtml + navHtml;

                container.querySelectorAll('.frost-page-btn[data-page]').forEach(btn => {
                    btn.addEventListener('click', function () {
                        const targetPage = parseInt(this.getAttribute('data-page'));
                        if (targetPage >= 1 && targetPage <= totalPages && targetPage !== currentPage) {
                            renderPage(targetPage);
                            if (typeof formatAllDeviceTimeElements === 'function') {
                                formatAllDeviceTimeElements();
                            }
                        }
                    });
                });
            }

            renderPage(1);
        }

        initClientPagination('victims-tbody', 'victims-pagination-container', 10);
    });
</script>
<?= $this->endSection() ?>