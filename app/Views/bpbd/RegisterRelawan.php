<?= $this->extend('layouts/main') ?>

<?php
if (!function_exists('format_wa_url')) {
    function format_wa_url($number)
    {
        $clean = preg_replace('/\D/', '', (string) $number);
        if (str_starts_with($clean, '0')) {
            $clean = '62' . substr($clean, 1);
        }
        return 'https://wa.me/' . $clean;
    }
}
?>

<?= $this->section('content') ?>
<style>
    .tabular-nums {
        font-variant-numeric: tabular-nums;
        font-feature-settings: "tnum";
    }

    /* Strict Max Rounded 8px (lg) Policy Matching EarthquakeRadar.php */
    .frost-card,
    .frost-hero,
    .frost-btn-primary,
    .frost-btn-danger,
    .posko-item-card,
    .btn,
    .modal-content,
    .badge,
    .form-control,
    .form-select,
    .progress,
    .alert,
    .input-group-text,
    .filter-btn,
    .request-item-card {
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

    /* LIGHT RED BUTTON: DANGER / REJECT ACTION */
    .frost-btn-danger {
        background: linear-gradient(135deg, #fef2f2 0%, #fee2e2 100%);
        color: #991b1b !important;
        border: 1.5px solid #fca5a5;
        border-radius: 8px !important;
        font-weight: 700;
        font-size: 0.8125rem;
        padding: 0.45rem 0.95rem;
        transition: all 0.2s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        box-shadow: 0 2px 6px rgba(239, 68, 68, 0.12);
        cursor: pointer;
    }

    .frost-btn-danger:hover {
        background: linear-gradient(135deg, #fee2e2 0%, #fca5a5 100%);
        color: #7f1d1d !important;
        border-color: #ef4444;
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.2);
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

    .filter-stat-card.active {
        background: #ecfdf5 !important;
        border-color: #059669 !important;
        box-shadow: 0 4px 14px -2px rgba(16, 185, 129, 0.20) !important;
    }

    /* Status Badges Matching EarthquakeRadar Theme */
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

    /* Filter Buttons */
    .filter-btn {
        background-color: #ffffff;
        border: 1.5px solid #e2e8f0;
        color: #475569;
        font-weight: 600;
        font-size: 0.8125rem;
        padding: 0.35rem 0.75rem;
        border-radius: 8px !important;
        transition: all 0.2s ease;
        cursor: pointer;
    }

    .filter-btn:hover {
        background-color: #ecfdf5;
        border-color: #a7f3d0;
        color: #064e3b;
    }

    .filter-btn.active {
        background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
        border-color: #34d399;
        color: #065f46 !important;
        font-weight: 700;
    }

    .filter-btn.active .badge {
        background-color: rgba(6, 95, 70, 0.15) !important;
        color: #065f46 !important;
    }

    /* Clean Target Posko Badge Styling */
    .posko-badge {
        background-color: rgba(6, 95, 70, 0.08) !important;
        color: #047857 !important;
        border: 1px solid rgba(6, 95, 70, 0.18) !important;
        border-radius: 8px !important;
        font-weight: 700 !important;
        font-size: 0.75rem !important;
        padding: 0.35rem 0.65rem !important;
        display: inline-flex !important;
        align-items: center !important;
        gap: 0.4rem !important;
        max-width: 210px;
        white-space: normal;
        text-align: left;
        line-height: 1.35;
    }

    .posko-badge i {
        color: #dc2626 !important;
        font-size: 0.8125rem;
        flex-shrink: 0;
    }

    /* CUSTOM FROSTED SEARCH BAR WITH ACTION BUTTON (MATCHING POSKOMANAGEMENT.PHP) */
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
        border-radius: 8px !important;
        padding: 0.55rem 2.25rem 0.55rem 2.65rem;
        font-size: 0.85rem;
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
        font-size: 0.8125rem;
        padding: 0.55rem 1.15rem;
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
            padding: 0.45rem 0.75rem !important;
            font-size: 0.75rem !important;
            gap: 0.25rem !important;
            flex-shrink: 0 !important;
            border-radius: 8px !important;
        }

        .frost-btn-search-submit span {
            font-size: 0.75rem !important;
        }
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
</style>

<div class="container-fluid px-0">

    <!-- 1. Hero Header Card (Matching EarthquakeRadar.php) -->
    <div class="card frost-hero mb-4">
        <div class="card-body p-4 position-relative">
            <div class="row align-items-center g-3">
                <div class="col-12 col-lg-8">
                    <div class="d-flex align-items-center gap-2 mb-2 flex-wrap">
                        <span class="badge px-3 py-1.5 fs-8 fw-bold"
                            style="background-color: rgba(6, 95, 70, 0.12); color: #065f46; border: 1px solid rgba(6, 95, 70, 0.25);">
                            <i class="bi bi-shield-check me-1"></i> KHUSUS BPBD ADMIN
                        </span>
                        <span class="badge px-3 py-1.5 fs-8"
                            style="background-color: rgba(6, 95, 70, 0.08); color: #047857; border: 1px solid rgba(6, 95, 70, 0.18);">
                            Review &amp; Approval System
                        </span>
                    </div>
                    <h3 class="fw-bold mb-1" style="color: #064e3b;">
                        <i class="bi bi-person-check-fill me-2" style="color: #059669;"></i> Approval Akun Relawan
                    </h3>
                    <p class="small mb-0" style="color: #047857; max-width: 75ch;">
                        Review dan verifikasi permohonan pendaftaran akun relawan baru yang masuk melalui portal chatbot rekrutmen BPBD.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Flash Notifications -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert border-0 shadow-sm rounded-lg mb-4 p-3.5 p-md-4 bg-success-subtle text-success-emphasis position-relative"
            role="alert" style="border-radius: 8px !important; border: 1px solid #a7f3d0 !important;">
            <div class="d-flex flex-column flex-sm-row align-items-start align-items-sm-center justify-content-between gap-3 pe-4 pe-sm-0">
                <!-- Text & Icon -->
                <div class="d-flex align-items-start align-items-sm-center gap-2.5 flex-grow-1">
                    <i class="bi bi-check-circle-fill fs-5 text-success flex-shrink-0 mt-0.5 mt-sm-0"></i>
                    <div class="small fw-bold" style="line-height: 1.45;"><?= session()->getFlashdata('success') ?></div>
                </div>
                <!-- Action Button & Close Button Wrapper -->
                <div class="d-flex align-items-center gap-3 ms-0 ms-sm-3 flex-shrink-0 w-100 w-sm-auto justify-content-between justify-content-sm-end pt-2 pt-sm-0 border-top border-sm-0 border-success-subtle">
                    <?php if (session()->getFlashdata('wa_redirect')): ?>
                        <a href="<?= session()->getFlashdata('wa_redirect') ?>" target="_blank"
                            class="frost-btn-primary w-100 w-sm-auto justify-content-center py-2 px-3 fs-8">
                            <i class="bi bi-whatsapp text-success fs-7"></i>
                            <span>Kirim WA Konfirmasi</span>
                        </a>
                    <?php endif; ?>
                    <button type="button" class="btn-close position-static p-2 ms-2 flex-shrink-0" data-bs-dismiss="alert"
                        aria-label="Close" title="Tutup Notifikasi"></button>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('info')): ?>
        <div class="alert border-0 shadow-sm rounded-lg mb-4 p-3.5 p-md-4 bg-info-subtle text-info-emphasis position-relative"
            role="alert" style="border-radius: 8px !important; border: 1px solid #7dd3fc !important;">
            <div class="d-flex flex-column flex-sm-row align-items-start align-items-sm-center justify-content-between gap-3 pe-4 pe-sm-0">
                <!-- Text & Icon -->
                <div class="d-flex align-items-start align-items-sm-center gap-2.5 flex-grow-1">
                    <i class="bi bi-info-circle-fill fs-5 text-info flex-shrink-0 mt-0.5 mt-sm-0"></i>
                    <div class="small fw-bold" style="line-height: 1.45;"><?= session()->getFlashdata('info') ?></div>
                </div>
                <!-- Action Button & Close Button Wrapper -->
                <div class="d-flex align-items-center gap-3 ms-0 ms-sm-3 flex-shrink-0 w-100 w-sm-auto justify-content-between justify-content-sm-end pt-2 pt-sm-0 border-top border-sm-0 border-info-subtle">
                    <?php if (session()->getFlashdata('wa_redirect')): ?>
                        <a href="<?= session()->getFlashdata('wa_redirect') ?>" target="_blank"
                            class="frost-btn-danger w-100 w-sm-auto justify-content-center py-2 px-3 fs-8">
                            <i class="bi bi-whatsapp fs-7"></i>
                            <span>Kirim WA Penolakan</span>
                        </a>
                    <?php endif; ?>
                    <button type="button" class="btn-close position-static p-2 ms-2 flex-shrink-0" data-bs-dismiss="alert"
                        aria-label="Close" title="Tutup Notifikasi"></button>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert border-0 shadow-sm rounded-lg mb-4 p-3.5 p-md-4 bg-danger-subtle text-danger-emphasis position-relative"
            role="alert" style="border-radius: 8px !important; border: 1px solid #fca5a5 !important;">
            <div class="d-flex align-items-start align-items-sm-center justify-content-between gap-3">
                <div class="d-flex align-items-start align-items-sm-center gap-2.5 flex-grow-1">
                    <i class="bi bi-exclamation-triangle-fill fs-5 text-danger flex-shrink-0 mt-0.5 mt-sm-0"></i>
                    <div class="small fw-bold" style="line-height: 1.45;"><?= session()->getFlashdata('error') ?></div>
                </div>
                <button type="button" class="btn-close position-static p-2 ms-3 flex-shrink-0" data-bs-dismiss="alert"
                    aria-label="Close" title="Tutup Notifikasi"></button>
            </div>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('wa_redirect')): ?>
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const waUrl = <?= json_encode(session()->getFlashdata('wa_redirect')) ?>;
                if (waUrl) {
                    setTimeout(() => {
                        window.open(waUrl, '_blank');
                    }, 300);
                }
            });
        </script>
    <?php endif; ?>

    <!-- Summary Stats Row (Interactive Filter Cards matching EarthquakeRadar KPI System) -->
    <?php
    $totalCount = count($requests ?? []);
    $pendingCount = count(array_filter($requests ?? [], fn($r) => $r['status'] === 'pending'));
    $approvedCount = count(array_filter($requests ?? [], fn($r) => $r['status'] === 'approved'));
    $rejectedCount = count(array_filter($requests ?? [], fn($r) => $r['status'] === 'rejected'));
    ?>
    <div class="row g-3 mb-4">
        <div class="col-6 col-md-3">
            <div class="card posko-item-card p-3 p-md-3.5 h-100 filter-stat-card active" data-filter="all" role="button">
                <div class="text-secondary fs-8 fw-bold text-uppercase" style="letter-spacing: 0.03em;">Total Permohonan</div>
                <hr class="my-2 opacity-25" style="color: #059669;" />
                <div class="fs-3 fw-bold mb-1 text-truncate tabular-nums" style="color: #064e3b;"><?= $totalCount ?></div>
                <div class="fs-9 text-muted fw-semibold">Semua Pendaftaran</div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card posko-item-card p-3 p-md-3.5 h-100 filter-stat-card" data-filter="pending" role="button">
                <div class="text-secondary fs-8 fw-bold text-uppercase" style="letter-spacing: 0.03em;">Menunggu Review</div>
                <hr class="my-2 opacity-25" style="color: #d97706;" />
                <div class="fs-3 fw-bold mb-1 text-truncate tabular-nums" style="color: #d97706;"><?= $pendingCount ?></div>
                <div class="fs-9 text-muted fw-semibold">Perlu Verifikasi</div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card posko-item-card p-3 p-md-3.5 h-100 filter-stat-card" data-filter="approved" role="button">
                <div class="text-secondary fs-8 fw-bold text-uppercase" style="letter-spacing: 0.03em;">Disetujui &amp; Aktif</div>
                <hr class="my-2 opacity-25" style="color: #059669;" />
                <div class="fs-3 fw-bold mb-1 text-truncate tabular-nums" style="color: #047857;"><?= $approvedCount ?></div>
                <div class="fs-9 text-muted fw-semibold">Telah Diverifikasi</div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card posko-item-card p-3 p-md-3.5 h-100 filter-stat-card" data-filter="rejected" role="button">
                <div class="text-secondary fs-8 fw-bold text-uppercase" style="letter-spacing: 0.03em;">Ditolak</div>
                <hr class="my-2 opacity-25" style="color: #dc2626;" />
                <div class="fs-3 fw-bold mb-1 text-truncate tabular-nums" style="color: #dc2626;"><?= $rejectedCount ?></div>
                <div class="fs-9 text-muted fw-semibold">Tidak Memenuhi Syarat</div>
            </div>
        </div>
    </div>

    <!-- Main List & Filter Card (Frosted Glass Card) -->
    <div class="card frost-card overflow-hidden border-0 mb-4" style="border-radius: 8px !important;">

        <!-- Filter Bar & Search Box Header -->
        <div class="card-header bg-transparent border-bottom p-3 p-md-4" style="border-color: rgba(226, 232, 240, 0.8) !important;">
            <div class="row g-3 align-items-center justify-content-between">
                <!-- Status Filter Pills -->
                <div class="col-12 col-md-auto">
                    <div class="d-flex flex-wrap gap-2">
                        <button type="button" class="filter-btn active" data-filter="all">
                            Semua <span class="badge bg-secondary-subtle text-slate-800 ms-1" style="border-radius: 8px !important;"><?= $totalCount ?></span>
                        </button>
                        <button type="button" class="filter-btn" data-filter="pending">
                            Menunggu Review <span class="badge bg-warning-subtle text-warning-emphasis ms-1" style="border-radius: 8px !important;"><?= $pendingCount ?></span>
                        </button>
                        <button type="button" class="filter-btn" data-filter="approved">
                            Disetujui <span class="badge bg-success-subtle text-success-emphasis ms-1" style="border-radius: 8px !important;"><?= $approvedCount ?></span>
                        </button>
                        <button type="button" class="filter-btn" data-filter="rejected">
                            Ditolak <span class="badge bg-danger-subtle text-danger-emphasis ms-1" style="border-radius: 8px !important;"><?= $rejectedCount ?></span>
                        </button>
                    </div>
                </div>

                <!-- Custom Frosted Search Bar (Matching PoskoManagement.php) -->
                <div class="col-12 col-md-6 col-lg-5">
                    <div class="frost-search-group">
                        <div class="frost-search-input-wrapper">
                            <i class="bi bi-search frost-search-icon-inside"></i>
                            <input type="text" id="search-input" class="frost-search-input"
                                placeholder="Cari Nama, NIK, WhatsApp, Posko..." autocomplete="off">
                            <button type="button" id="btn-clear-search" class="frost-search-clear-inside d-none"
                                title="Bersihkan Pencarian">
                                <i class="bi bi-x-circle-fill"></i>
                            </button>
                        </div>
                        <button type="button" id="btn-submit-search" class="frost-btn-search-submit">
                            <i class="bi bi-search"></i>
                            <span>Cari</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- 1. DESKTOP TABLE VIEW (Visible on >= 768px) -->
        <div class="d-none d-md-block table-responsive">
            <table class="table table-hover align-middle mb-0" id="volunteer-table">
                <thead class="fs-8 text-uppercase fw-bold" style="background-color: rgba(244, 251, 247, 0.85); color: #064e3b;">
                    <tr>
                        <th class="ps-4 text-center" style="width: 40px;">#</th>
                        <th>Biodata Pemohon</th>
                        <th>No. WhatsApp</th>
                        <th>Domisili &amp; Tgl Lahir</th>
                        <th style="max-width: 180px;">Target Posko</th>
                        <th>Waktu Request</th>
                        <th>Status</th>
                        <th class="pe-4 text-center" style="min-width: 220px;">Aksi Review</th>
                    </tr>
                </thead>
                <tbody class="fs-7">
                    <?php if (empty($requests)): ?>
                        <tr class="empty-row">
                            <td colspan="8" class="text-center py-5 text-muted">
                                <i class="bi bi-inbox fs-2 d-block mb-2 text-slate-400"></i>
                                Belum ada permohonan pendaftaran akun relawan yang masuk.
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($requests as $idx => $req): ?>
                            <tr class="request-item-row" data-status="<?= esc($req['status']) ?>"
                                data-search="<?= esc(strtolower($req['nama'] . ' ' . $req['nik'] . ' ' . $req['whatsapp'] . ' ' . $req['provinsi'] . ' ' . $req['posko_name'])) ?>">
                                <td class="ps-4 text-center fw-bold text-muted"><?= $idx + 1 ?></td>
                                <td>
                                    <div class="fw-bold text-dark mb-0.5" style="color: #064e3b !important;"><?= esc($req['nama']) ?></div>
                                    <div class="fs-8 text-muted">NIK: <?= esc($req['nik']) ?></div>
                                </td>
                                <td>
                                    <a href="<?= format_wa_url($req['whatsapp']) ?>" target="_blank"
                                        class="badge badge-mag-low px-3 py-1.5 text-decoration-none d-inline-flex align-items-center gap-2"
                                        style="border-radius: 8px !important; font-size: 0.75rem;">
                                        <i class="bi bi-whatsapp text-success fs-7"></i>
                                        <span><?= esc($req['whatsapp']) ?></span>
                                    </a>
                                </td>
                                <td>
                                    <div class="fw-semibold text-dark"><?= esc($req['provinsi']) ?></div>
                                    <div class="fs-8 text-muted">
                                        <?= !empty($req['tgl_lahir']) ? date('d M Y', strtotime($req['tgl_lahir'])) : '-' ?>
                                    </div>
                                </td>
                                <td>
                                    <span class="posko-badge">
                                        <i class="bi bi-geo-alt-fill"></i>
                                        <span><?= esc($req['posko_name'] ?? 'Posko Bencana') ?></span>
                                    </span>
                                </td>
                                <td class="text-muted fs-8">
                                    <?= date('d M Y H:i', strtotime($req['created_at'])) ?>
                                </td>
                                <td>
                                    <?php if ($req['status'] === 'approved'): ?>
                                        <span class="badge badge-mag-low px-2.5 py-1 fs-8 d-inline-flex align-items-center gap-1" style="border-radius: 8px !important;">
                                            <i class="bi bi-check-circle-fill"></i> Disetujui
                                        </span>
                                    <?php elseif ($req['status'] === 'rejected'): ?>
                                        <span class="badge badge-mag-high px-2.5 py-1 fs-8 d-inline-flex align-items-center gap-1" style="border-radius: 8px !important;">
                                            <i class="bi bi-x-circle-fill"></i> Ditolak
                                        </span>
                                    <?php else: ?>
                                        <span class="badge badge-mag-medium px-2.5 py-1 fs-8 d-inline-flex align-items-center gap-1" style="border-radius: 8px !important;">
                                            <i class="bi bi-hourglass-split"></i> Menunggu Review
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td class="pe-4 text-center">
                                    <?php if ($req['status'] === 'pending'): ?>
                                        <div class="d-inline-flex align-items-center justify-content-center gap-2">
                                            <form action="<?= site_url('/bpbd/approval-relawan/approve/' . $req['id']) ?>" method="POST" class="d-inline">
                                                <?= csrf_field() ?>
                                                <button type="submit" class="frost-btn-primary" style="font-size: 0.75rem; padding: 0.35rem 0.75rem;">
                                                    <i class="bi bi-check-lg"></i> Setujui
                                                </button>
                                            </form>
                                            <form action="<?= site_url('/bpbd/approval-relawan/reject/' . $req['id']) ?>" method="POST" class="d-inline">
                                                <?= csrf_field() ?>
                                                <button type="submit" class="frost-btn-danger" style="font-size: 0.75rem; padding: 0.35rem 0.75rem;"
                                                    onclick="return confirm('Apakah Anda yakin ingin menolak permohonan relawan ini?')">
                                                    <i class="bi bi-x-lg"></i> Tolak
                                                </button>
                                            </form>
                                        </div>
                                    <?php else: ?>
                                        <span class="text-muted fs-8 fst-italic">Selesai direview</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- 2. MOBILE CARDS VIEW (Visible on < 768px) -->
        <div class="d-md-none p-3 p-sm-4 d-flex flex-column gap-3.5" id="mobile-cards-container">
            <?php if (empty($requests)): ?>
                <div class="text-center py-5 text-muted bg-white p-4 border" style="border-radius: 8px !important;">
                    <i class="bi bi-inbox fs-2 d-block mb-2 text-slate-400"></i>
                    Belum ada permohonan pendaftaran akun relawan yang masuk.
                </div>
            <?php else: ?>
                <?php foreach ($requests as $idx => $req): ?>
                    <div class="card posko-item-card p-4 request-item-card" style="border-radius: 8px !important;"
                        data-status="<?= esc($req['status']) ?>"
                        data-search="<?= esc(strtolower($req['nama'] . ' ' . $req['nik'] . ' ' . $req['whatsapp'] . ' ' . $req['provinsi'] . ' ' . $req['posko_name'])) ?>">

                        <!-- Header: Name & Status -->
                        <div class="d-flex align-items-start justify-content-between gap-3 mb-3 border-bottom pb-3" style="border-color: #d1fae5 !important;">
                            <div class="pt-0.5">
                                <h6 class="fw-bold mb-1 text-dark" style="color: #064e3b !important; font-size: 0.95rem; line-height: 1.35;"><?= esc($req['nama']) ?></h6>
                                <span class="fs-8 text-muted fw-semibold d-inline-flex align-items-center"><i class="bi bi-card-text me-1 text-emerald-600"></i>NIK: <?= esc($req['nik']) ?></span>
                            </div>
                            <div class="flex-shrink-0 pt-0.5">
                                <?php if ($req['status'] === 'approved'): ?>
                                    <span class="badge badge-mag-low px-3 py-1.5 fs-8 fw-bold d-inline-flex align-items-center gap-1" style="border-radius: 8px !important;">
                                        <i class="bi bi-check-circle-fill"></i> Disetujui
                                    </span>
                                <?php elseif ($req['status'] === 'rejected'): ?>
                                    <span class="badge badge-mag-high px-3 py-1.5 fs-8 fw-bold d-inline-flex align-items-center gap-1" style="border-radius: 8px !important;">
                                        <i class="bi bi-x-circle-fill"></i> Ditolak
                                    </span>
                                <?php else: ?>
                                    <span class="badge badge-mag-medium px-3 py-1.5 fs-8 fw-bold d-inline-flex align-items-center gap-1" style="border-radius: 8px !important;">
                                        <i class="bi bi-hourglass-split"></i> Pending
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Details Body -->
                        <div class="p-3 mb-3 fs-8 d-flex flex-column gap-2" style="background: rgba(244, 251, 247, 0.75); border: 1px solid #d1fae5; border-radius: 8px !important;">
                            <div class="d-flex justify-content-between align-items-center gap-2">
                                <span class="text-muted flex-shrink-0">Target Posko:</span>
                                <span class="posko-badge">
                                    <i class="bi bi-geo-alt-fill"></i>
                                    <span><?= esc($req['posko_name'] ?? 'Posko Bencana') ?></span>
                                </span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-muted">Domisili:</span>
                                <span class="fw-semibold text-dark"><?= esc($req['provinsi']) ?></span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-muted">Tgl Lahir:</span>
                                <span class="fw-semibold text-dark"><?= !empty($req['tgl_lahir']) ? date('d M Y', strtotime($req['tgl_lahir'])) : '-' ?></span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-muted">Waktu Request:</span>
                                <span class="text-muted fw-medium"><?= date('d M Y H:i', strtotime($req['created_at'])) ?></span>
                            </div>
                        </div>

                        <!-- WhatsApp & Actions -->
                        <div class="d-flex flex-column gap-2">
                            <a href="<?= format_wa_url($req['whatsapp']) ?>" target="_blank"
                                class="frost-btn-primary w-100 justify-content-center py-2.5 fs-8" style="border-radius: 8px !important;">
                                <i class="bi bi-whatsapp text-success fs-7"></i> Chat WhatsApp (<?= esc($req['whatsapp']) ?>)
                            </a>

                            <?php if ($req['status'] === 'pending'): ?>
                                <div class="row g-2 pt-1">
                                    <div class="col-6">
                                        <form action="<?= site_url('/bpbd/approval-relawan/approve/' . $req['id']) ?>" method="POST">
                                            <?= csrf_field() ?>
                                            <button type="submit" class="frost-btn-primary w-100 justify-content-center py-2.5 fs-8" style="border-radius: 8px !important;">
                                                <i class="bi bi-check-lg fs-7"></i> Setujui
                                            </button>
                                        </form>
                                    </div>
                                    <div class="col-6">
                                        <form action="<?= site_url('/bpbd/approval-relawan/reject/' . $req['id']) ?>" method="POST">
                                            <?= csrf_field() ?>
                                            <button type="submit" class="frost-btn-danger w-100 justify-content-center py-2.5 fs-8" style="border-radius: 8px !important;"
                                                onclick="return confirm('Apakah Anda yakin ingin menolak permohonan relawan ini?')">
                                                <i class="bi bi-x-lg fs-7"></i> Tolak
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>

                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const filterBtns = document.querySelectorAll('.filter-btn, .filter-stat-card');
        const searchInput = document.getElementById('search-input');
        const btnClearSearch = document.getElementById('btn-clear-search');
        const btnSubmitSearch = document.getElementById('btn-submit-search');
        const rows = document.querySelectorAll('.request-item-row');
        const cards = document.querySelectorAll('.request-item-card');

        let currentFilter = 'all';
        let currentSearch = '';

        function toggleClearBtn() {
            if (searchInput && searchInput.value.trim().length > 0) {
                btnClearSearch?.classList.remove('d-none');
            } else {
                btnClearSearch?.classList.add('d-none');
            }
        }

        function applyFilter() {
            // Filter Desktop Rows
            rows.forEach(row => {
                const status = row.getAttribute('data-status');
                const text = row.getAttribute('data-search');

                const matchesStatus = (currentFilter === 'all') || (status === currentFilter);
                const matchesSearch = (!currentSearch) || text.includes(currentSearch);

                if (matchesStatus && matchesSearch) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });

            // Filter Mobile Cards
            cards.forEach(card => {
                const status = card.getAttribute('data-status');
                const text = card.getAttribute('data-search');

                const matchesStatus = (currentFilter === 'all') || (status === currentFilter);
                const matchesSearch = (!currentSearch) || text.includes(currentSearch);

                if (matchesStatus && matchesSearch) {
                    card.style.display = '';
                } else {
                    card.style.display = 'none';
                }
            });
        }

        filterBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                currentFilter = btn.getAttribute('data-filter') || 'all';

                // Update active states
                document.querySelectorAll('.filter-btn').forEach(b => {
                    if (b.getAttribute('data-filter') === currentFilter) {
                        b.classList.add('active');
                    } else {
                        b.classList.remove('active');
                    }
                });

                document.querySelectorAll('.filter-stat-card').forEach(c => {
                    if (c.getAttribute('data-filter') === currentFilter) {
                        c.classList.add('active');
                    } else {
                        c.classList.remove('active');
                    }
                });

                applyFilter();
            });
        });

        searchInput?.addEventListener('input', (e) => {
            currentSearch = e.target.value.toLowerCase().trim();
            toggleClearBtn();
            applyFilter();
        });

        btnClearSearch?.addEventListener('click', () => {
            if (searchInput) {
                searchInput.value = '';
                currentSearch = '';
                toggleClearBtn();
                applyFilter();
                searchInput.focus();
            }
        });

        btnSubmitSearch?.addEventListener('click', () => {
            if (searchInput) {
                currentSearch = searchInput.value.toLowerCase().trim();
                applyFilter();
            }
        });
    });
</script>
<?= $this->endSection() ?>