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

    .badge-status-recovery {
        background-color: #d97706 !important;
        color: #ffffff !important;
        font-weight: 700 !important;
    }

    .badge-status-closed {
        background-color: #64748b !important;
        color: #ffffff !important;
        font-weight: 700 !important;
    }

    /* CUSTOM FLOATING DROPDOWN SYSTEM MATCHING POSKOMANAGEMENT */
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
</style>

<div class="container-fluid px-0">

    <!-- 1. Hero Header Posko Card -->
    <div class="card frost-hero mb-4">
        <div class="card-body p-4 position-relative">
            <div class="d-flex align-items-center gap-2 mb-2 flex-wrap">
                <span class="badge px-3 py-1.5 fs-8 fw-bold"
                    style="background-color: rgba(6, 95, 70, 0.12); color: #065f46; border: 1px solid rgba(6, 95, 70, 0.25);">
                    <i class="bi bi-geo-alt-fill me-1"></i> POSKO BENCANA WORKSPACE
                </span>
                <span class="badge px-3 py-1.5 fs-8"
                    style="background-color: rgba(6, 95, 70, 0.08); color: #047857; border: 1px solid rgba(6, 95, 70, 0.18);">
                    <?= esc($posko['regency_name']) ?>, <?= esc($posko['province_name']) ?>
                </span>
                <?php if ($posko['status'] === 'aktif'): ?>
                    <span class="badge px-3 py-1.5 fs-8 fw-bold"
                        style="background-color: rgba(6, 95, 70, 0.08); color: #047857; border: 1px solid rgba(6, 95, 70, 0.18);">
                        <i class="bi bi-check-circle-fill me-1" style="color: #059669;"></i> Posko Aktif
                    </span>
                <?php elseif ($posko['status'] === 'recovery'): ?>
                    <span class="badge px-3 py-1.5 fs-8 fw-bold"
                        style="background-color: rgba(217, 119, 6, 0.08); color: #b45309; border: 1px solid rgba(217, 119, 6, 0.25);">
                        <i class="bi bi-arrow-repeat me-1" style="color: #d97706;"></i> Masa Recovery
                    </span>
                <?php else: ?>
                    <span class="badge px-3 py-1.5 fs-8 fw-bold"
                        style="background-color: rgba(100, 116, 139, 0.08); color: #475569; border: 1px solid rgba(100, 116, 139, 0.25);">
                        <i class="bi bi-x-circle-fill me-1" style="color: #64748b;"></i> Posko Closed
                    </span>
                <?php endif; ?>
            </div>
            <h3 class="fw-bold mb-1" style="color: #064e3b;">
                <i class="bi bi-house-heart-fill me-2" style="color: #059669;"></i> <?= esc($posko['name']) ?>
            </h3>
            <p class="small mb-0" style="color: #047857; max-width: 75ch;">
                Jenis Bencana: <strong class="fw-bold"
                    style="color: #064e3b;"><?= esc($posko['jenis_bencana']) ?></strong>
            </p>
        </div>
    </div>

    <!-- 2. KPI Stats Overview Cards (Matched with RegisterRelawan.php & CommandCenter.php style) -->
    <div class="row g-3 mb-4">
        <!-- Card 1: Total Penyintas -->
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="card posko-item-card p-3 p-md-3.5 h-100">
                <div class="text-secondary fs-8 fw-bold text-uppercase" style="letter-spacing: 0.03em;">Total Penyintas
                    Posko</div>
                <hr class="my-2 opacity-25" style="color: #059669;" />
                <div class="fs-3 fw-bold mb-1 text-truncate tabular-nums" style="color: #064e3b;">
                    <?= esc($stats['total_korban']) ?>
                </div>
                <div class="fs-9 text-muted fw-semibold">Penyintas Terdaftar</div>
            </div>
        </div>

        <!-- Card 2: Status Skrining Relawan (Matched with CommandCenter.php style) -->
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="card posko-item-card p-3 h-100 d-flex flex-column justify-content-between">
                <div>
                    <div class="text-secondary fs-8 fw-bold text-uppercase" style="letter-spacing: 0.03em;">Status
                        Skrining Relawan</div>
                    <div class="mt-2">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <span class="small fw-semibold text-success"><i class="bi bi-check-circle-fill me-1"></i>
                                Sudah Skrining</span>
                            <span class="fw-bold text-dark tabular-nums"><?= esc($stats['sudah_screening']) ?></span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="small text-muted"><i class="bi bi-clock-history me-1"></i> Belum
                                Skrining</span>
                            <span
                                class="fw-bold text-secondary tabular-nums"><?= esc($stats['belum_screening']) ?></span>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="progress" style="height: 6px; border-radius: 4px !important;">
                        <div class="progress-bar bg-success" role="progressbar"
                            style="width: <?= ($stats['total_korban'] ?? 0) > 0 ? round(($stats['sudah_screening'] / $stats['total_korban']) * 100) : 0 ?>%">
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-1.5 fs-8 text-muted">
                        <span>Cakupan Skrining</span>
                        <span class="fw-semibold text-dark tabular-nums">
                            <?= ($stats['total_korban'] ?? 0) > 0 ? round(($stats['sudah_screening'] / $stats['total_korban']) * 100) : 0 ?>%
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 3: AI Risk High -->
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="card posko-item-card p-3 p-md-3.5 h-100">
                <div class="text-secondary fs-8 fw-bold text-uppercase" style="letter-spacing: 0.03em;">AI Risk: High
                    Risk</div>
                <hr class="my-2 opacity-25" style="color: #dc2626;" />
                <div class="d-flex align-items-baseline justify-content-between mb-1">
                    <div class="fs-3 fw-bold tabular-nums text-danger"><?= esc($stats['risk_high']) ?></div>
                    <span class="badge bg-danger-subtle text-danger border border-danger-subtle fs-9 fw-bold">Prioritas
                        Intervensi</span>
                </div>
                <div class="fs-9 text-muted fw-semibold">Penyintas Perlu Atensi</div>
            </div>
        </div>

        <!-- Card 4: AI Risk Medium / Low -->
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="card posko-item-card p-3 p-md-3.5 h-100">
                <div class="text-secondary fs-8 fw-bold text-uppercase" style="letter-spacing: 0.03em;">AI Risk: Medium
                    / Low</div>
                <hr class="my-2 opacity-25" style="color: #d97706;" />
                <div class="mt-2.5">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="small text-muted fw-semibold">Medium Risk</span>
                        <span class="fw-bold tabular-nums"
                            style="color: #064e3b;"><?= esc($stats['risk_medium']) ?></span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="small text-muted fw-semibold">Low Risk</span>
                        <span class="fw-bold tabular-nums" style="color: #064e3b;"><?= esc($stats['risk_low']) ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 3. Tabel Daftar Tim Personel Bertugas (Personnel Management Section) -->
    <div class="card posko-item-card p-4 mb-4">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3 border-bottom pb-3">
            <h5 class="fw-bold mb-0 d-flex align-items-center" style="color: #064e3b;">
                <i class="bi bi-people-fill text-success me-2 fs-5"></i> Daftar Tim Personel Bertugas Posko
            </h5>
            <span class="badge px-3 py-1.5 fs-8"
                style="background-color: rgba(6, 95, 70, 0.08); color: #047857; border: 1px solid rgba(6, 95, 70, 0.18);">
                <?= count($personnel) ?> Personel Bertugas
            </span>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead style="background-color: #f8fafc;" class="text-secondary small text-uppercase">
                    <tr>
                        <th style="width: 8%;">No</th>
                        <th style="width: 32%;">Nama Personel</th>
                        <th style="width: 25%;">Peran / Role</th>
                        <th style="width: 20%;">Kontak WhatsApp</th>
                        <th style="width: 15%;" class="text-end">Status Tugas</th>
                    </tr>
                </thead>
                <tbody id="personnel-tbody">
                    <?php if (empty($personnel)): ?>
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted">
                                <i class="bi bi-person-x fs-3 d-block mb-1 text-emerald-600"></i>
                                Belum ada personel yang ditugaskan di posko ini.
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php $noP = 1;
                        foreach ($personnel as $p): ?>
                            <tr>
                                <td class="fw-bold text-muted"><?= $noP++ ?></td>
                                <td>
                                    <strong class="text-dark d-block"
                                        style="color: #064e3b !important;"><?= esc($p['name']) ?></strong>
                                    <span class="fs-8 text-muted"><?= esc($p['email'] ?? '-') ?></span>
                                </td>
                                <td>
                                    <?php if ($p['role'] === 'psikolog'): ?>
                                        <span class="badge px-2.5 py-1 fs-8 fw-bold"
                                            style="background-color: #e0f2fe; color: #0369a1; border: 1px solid #7dd3fc; border-radius: 6px !important;">
                                            <i class="bi bi-heart-pulse-fill me-1"></i> Psikolog
                                        </span>
                                    <?php elseif ($p['role'] === 'relawan'): ?>
                                        <span class="badge px-2.5 py-1 fs-8 fw-bold"
                                            style="background-color: #ecfdf5; color: #047857; border: 1px solid #a7f3d0; border-radius: 6px !important;">
                                            <i class="bi bi-person-badge-fill me-1"></i> Relawan Posko
                                        </span>
                                    <?php else: ?>
                                        <span class="badge bg-light text-dark border fs-8">
                                            <?= esc(ucfirst($p['role'])) ?>
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if (!empty($p['whatsapp'])): ?>
                                        <?php
                                        $waClean = preg_replace('/[^0-9]/', '', $p['whatsapp']);
                                        if (strpos($waClean, '0') === 0) {
                                            $waClean = '62' . substr($waClean, 1);
                                        }
                                        ?>
                                        <a href="https://wa.me/<?= $waClean ?>" target="_blank"
                                            class="text-decoration-none text-emerald-700 fw-bold fs-8 d-inline-flex align-items-center">
                                            <i class="bi bi-whatsapp text-success me-1"></i> <?= esc($p['whatsapp']) ?>
                                        </a>
                                    <?php else: ?>
                                        <span class="text-muted fs-8">-</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-end">
                                    <span
                                        class="badge bg-success-subtle text-success border border-success-subtle fs-8 px-2.5 py-1">
                                        <i class="bi bi-check-circle-fill me-1"></i> Bertugas Aktif
                                    </span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <!-- Pagination Personnel -->
        <div id="personnel-pagination-container" class="frost-pagination-wrapper d-none"></div>
    </div>

    <!-- 3. Manajemen Tabel Penyintas (Victims Management Card) -->
    <div class="card posko-item-card p-4 mb-4" style="overflow: visible !important;">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3 border-bottom pb-3">
            <h5 class="fw-bold mb-0 d-flex align-items-center" style="color: #064e3b;">
                <i class="bi bi-person-lines-fill text-success me-2 fs-5"></i> Daftar Manajemen Penyintas (Victims)
            </h5>
            <div class="d-flex align-items-center gap-2 flex-wrap card-header-actions">
                <span class="badge px-3 py-1.5 fs-8"
                    style="background-color: rgba(6, 95, 70, 0.08); color: #047857; border: 1px solid rgba(6, 95, 70, 0.18);">
                    <?= count($victims) ?> Penyintas Tampil
                </span>
                <a href="<?= site_url('/victim/create/' . $posko['id']) ?>" class="frost-btn-primary">
                    <i class="bi bi-person-plus-fill me-1"></i> + <span class="d-none d-sm-inline">Tambah Korban Baru</span><span class="d-inline d-sm-none">Tambah Korban</span>
                </a>
            </div>
        </div>

        <!-- Form Filter & Pencarian Penyintas -->
        <form method="GET" action="<?= site_url('/posko/' . $posko['id']) ?>" class="row g-2.5 gy-3 posko-filter-form mb-4 p-3 rounded"
            style="background: rgba(236, 253, 245, 0.7); border: 1.5px solid #a7f3d0 !important; overflow: visible !important;">
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
                <a href="<?= site_url('/posko/' . $posko['id']) ?>" class="frost-btn-reset" title="Reset Filter"><i
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
                                    <a href="<?= site_url('/victim/detail/' . $v['id']) ?>" class="fw-bold text-decoration-none"
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
                                    <div><i class="bi bi-calendar3 me-1 text-emerald-600"></i> <?= esc($v['tanggal_datang']) ?>
                                    </div>
                                    <div class="fs-8"><i class="bi bi-clock me-1 text-emerald-600"></i>
                                        <?= esc($v['jam_datang']) ?>
                                    </div>
                                </td>
                                <td>
                                    <?php if ($v['screening_id']): ?>
                                        <span class="badge bg-success-subtle text-success border border-success-subtle mb-1 fs-8">
                                            <i class="bi bi-check-circle-fill me-1"></i> Sudah Skrining
                                        </span>
                                        <div class="fs-8 text-muted">Distress: <strong><?= esc($v['skala_distress']) ?>/10</strong>
                                        </div>
                                    <?php else: ?>
                                        <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle fs-8">
                                            <i class="bi bi-clock-history me-1"></i> Belum Skrining
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($v['risk_level'] === 'high'): ?>
                                        <span class="badge bg-danger-subtle text-danger border border-danger-subtle fs-8 px-2 py-1">
                                            <i class="bi bi-exclamation-triangle-fill me-1"></i> HIGH RISK
                                        </span>
                                    <?php elseif ($v['risk_level'] === 'medium'): ?>
                                        <span
                                            class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle fs-8 px-2 py-1">
                                            <i class="bi bi-dash-circle-fill me-1"></i> MEDIUM RISK
                                        </span>
                                    <?php elseif ($v['risk_level'] === 'low'): ?>
                                        <span
                                            class="badge bg-info-subtle text-info-emphasis border border-info-subtle fs-8 px-2 py-1">
                                            <i class="bi bi-check-circle-fill me-1"></i> LOW RISK
                                        </span>
                                    <?php else: ?>
                                        <span class="badge bg-light text-muted border fs-9">Belum AI</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($v['psikolog_name']): ?>
                                        <span class="badge bg-primary-subtle text-primary border border-primary-subtle fs-8">
                                            <i class="bi bi-person-check-fill me-1"></i> <?= esc($v['psikolog_name']) ?>
                                        </span>
                                    <?php else: ?>
                                        <span class="badge bg-light text-muted border fs-9">Belum Ditugaskan</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-end">
                                    <a href="<?= site_url('/victim/detail/' . $v['id']) ?>"
                                        class="frost-btn-primary py-1 px-2.5 fs-8" title="Buka Detail Penyintas">
                                        Detail <i class="bi bi-arrow-right"></i>
                                    </a>
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

<script>
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
                        }
                    });
                });
            }

            renderPage(1);
        }

        initClientPagination('personnel-tbody', 'personnel-pagination-container', 10);
        initClientPagination('victims-tbody', 'victims-pagination-container', 10);
    });
</script>
<?= $this->endSection() ?>