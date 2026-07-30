<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<style>
    /* Custom Styling for PsyAid BPBD Theme & Frosted Cards */
    .frost-hero {
        background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 60%, #a7f3d0 100%) !important;
        border: 1.5px solid #a7f3d0 !important;
        border-radius: 8px !important;
        box-shadow: 0 4px 15px rgba(16, 185, 129, 0.08) !important;
    }

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

    .report-card {
        background: #ffffff !important;
        border: 1.5px solid #d1fae5 !important;
        border-radius: 8px !important;
        box-shadow: 0 4px 12px -2px rgba(16, 185, 129, 0.08), 0 2px 5px -1px rgba(15, 23, 42, 0.04) !important;
        transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1) !important;
    }

    .report-card:hover {
        border-color: #34d399 !important;
        box-shadow: 0 12px 28px -4px rgba(16, 185, 129, 0.18), 0 4px 10px -2px rgba(15, 23, 42, 0.04) !important;
        transform: translateY(-2px) !important;
    }

    /* MINT BUTTON: PRIMARY ACTION */
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

    /* WHATSAPP BUTTON */
    .frost-btn-whatsapp {
        background: #25d366 !important;
        color: #ffffff !important;
        border: 1.5px solid #16a34a !important;
        border-radius: 8px !important;
        font-weight: 700;
        font-size: 0.8125rem;
        padding: 0.45rem 0.95rem;
        transition: all 0.2s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        box-shadow: 0 2px 6px rgba(37, 211, 102, 0.25);
        cursor: pointer;
    }

    .frost-btn-whatsapp:hover {
        background: #16a34a !important;
        color: #ffffff !important;
        border-color: #15803d !important;
        box-shadow: 0 4px 12px rgba(37, 211, 102, 0.35);
        transform: translateY(-1px);
    }

    /* DANGER / DELETE BUTTON */
    .frost-btn-danger {
        background: #fef2f2 !important;
        color: #dc2626 !important;
        border: 1.5px solid #fca5a5 !important;
        border-radius: 8px !important;
        font-weight: 600;
        font-size: 0.8125rem;
        padding: 0.45rem 0.95rem;
        transition: all 0.2s ease;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
    }

    .frost-btn-danger:hover {
        background: #fee2e2 !important;
        color: #991b1b !important;
        border-color: #f87171 !important;
    }

    /* CUSTOM FROSTED SEARCH & INPUT FIELD COMPONENT (MATCHING PoskoManagement.php) */
    .frost-search-input-wrapper {
        position: relative;
        display: flex;
        align-items: center;
        width: 100%;
    }

    .frost-search-icon-inside {
        position: absolute;
        left: 1rem;
        color: #059669;
        font-size: 1rem;
        pointer-events: none;
        z-index: 2;
    }

    .frost-search-input {
        width: 100%;
        background: #ffffff !important;
        border: 1.5px solid #cbd5e1 !important;
        border-radius: 8px !important;
        padding: 0.55rem 2.25rem 0.55rem 2.65rem !important;
        font-size: 0.875rem !important;
        font-weight: 600 !important;
        color: #0f172a !important;
        text-align: left;
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 1px 3px rgba(15, 23, 42, 0.04);
    }

    .frost-search-input:hover:not(:disabled) {
        border-color: #059669 !important;
        background-color: #f4fbf7 !important;
    }

    .frost-search-input:focus {
        background: #ffffff !important;
        border-color: #059669 !important;
        box-shadow: 0 0 0 3.5px rgba(5, 150, 105, 0.18) !important;
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
        text-decoration: none;
    }

    .frost-search-clear-inside:hover {
        color: #dc2626;
    }

    /* CUSTOM FROSTED DROPDOWN COMPONENT (MATCHING PoskoManagement.php) */
    .frost-custom-select-wrapper {
        position: relative;
        z-index: 50;
    }

    .frost-custom-select-wrapper.active-dropdown {
        z-index: 99999 !important;
    }

    .frost-card-filter-container {
        position: relative;
        z-index: 100;
        overflow: visible !important;
    }

    .frost-card-filter-body {
        overflow: visible !important;
        position: relative;
        z-index: 100;
    }

    .modal-content-overflow-visible {
        overflow: visible !important;
    }

    .modal-body-overflow-visible {
        overflow: visible !important;
        position: relative;
        z-index: 1050;
    }

    .frost-custom-trigger {
        background: #ffffff;
        border: 1.5px solid #cbd5e1;
        border-radius: 8px !important;
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
        background-color: #d1fae5;
        color: #065f46;
        font-weight: 700;
    }

    /* CUSTOM FROSTED SELECT DROPDOWN (MATCHING PoskoManagement.php) */
    .frost-input-field {
        background: #ffffff !important;
        border: 1.5px solid #cbd5e1 !important;
        border-radius: 8px !important;
        padding: 0.55rem 0.85rem !important;
        font-size: 0.875rem !important;
        font-weight: 600 !important;
        color: #0f172a !important;
        width: 100%;
        transition: all 0.2s ease;
        box-shadow: 0 1px 3px rgba(15, 23, 42, 0.04);
        cursor: pointer;
    }

    .frost-input-field:hover:not(:disabled) {
        border-color: #059669 !important;
        background-color: #f4fbf7 !important;
    }

    .frost-input-field:focus {
        border-color: #059669 !important;
        box-shadow: 0 0 0 3.5px rgba(5, 150, 105, 0.18) !important;
        background-color: #ffffff !important;
        outline: none;
    }

    /* SUBMIT & RESET BUTTONS MATCHING PoskoManagement.php */
    .frost-btn-search-submit {
        background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%) !important;
        color: #065f46 !important;
        border: 1.5px solid #34d399 !important;
        border-radius: 8px !important;
        font-weight: 700 !important;
        font-size: 0.85rem !important;
        padding: 0.55rem 1.15rem !important;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.4rem;
        cursor: pointer;
        transition: all 0.2s ease;
        box-shadow: 0 2px 6px rgba(16, 185, 129, 0.15);
        white-space: nowrap;
    }

    .frost-btn-search-submit:hover {
        background: linear-gradient(135deg, #a7f3d0 0%, #6ee7b7 100%) !important;
        color: #064e3b !important;
        border-color: #10b981 !important;
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
        padding: 0.55rem 0.95rem !important;
        transition: all 0.2s ease;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        text-decoration: none;
    }

    /* Mobile Responsiveness for Search & Filter Bar (< 768px) */
    @media (max-width: 767.98px) {
        .frost-search-input {
            padding: 0.65rem 2.25rem 0.65rem 2.4rem !important;
            font-size: 0.8125rem !important;
        }

        .frost-search-icon-inside {
            left: 0.85rem !important;
            font-size: 0.9rem !important;
        }

        .frost-custom-trigger {
            padding: 0.6rem 0.75rem !important;
            font-size: 0.8125rem !important;
        }

        .frost-custom-option {
            padding: 0.55rem 0.65rem !important;
            font-size: 0.8125rem !important;
        }

        .frost-btn-search-submit {
            padding: 0.55rem 0.85rem !important;
            font-size: 0.8125rem !important;
        }
    }

    /* Status Badges */
    .badge-status-pending {
        background-color: #fffbeb !important;
        color: #d97706 !important;
        border: 1px solid #fde68a !important;
        font-weight: 700 !important;
    }

    .badge-status-proses {
        background-color: #eff6ff !important;
        color: #2563eb !important;
        border: 1px solid #bfdbfe !important;
        font-weight: 700 !important;
    }

    .badge-status-selesai {
        background-color: #ecfdf5 !important;
        color: #047857 !important;
        border: 1px solid #a7f3d0 !important;
        font-weight: 700 !important;
    }

    .badge-status-ditolak {
        background-color: #fef2f2 !important;
        color: #dc2626 !important;
        border: 1px solid #fecdd3 !important;
        font-weight: 700 !important;
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

    <!-- 1. Hero Header Card -->
    <div class="card frost-hero mb-4">
        <div class="card-body p-4 position-relative">
            <div class="row align-items-center g-3">
                <div class="col-12 col-lg-8">
                    <div class="d-flex align-items-center gap-2 mb-2 flex-wrap">
                        <span class="badge px-3 py-1.5 fs-8 fw-bold"
                            style="background-color: rgba(6, 95, 70, 0.12); color: #065f46; border: 1px solid rgba(6, 95, 70, 0.25); border-radius: 8px !important;">
                            <i class="bi bi-shield-check me-1"></i> BPBD COMMAND CENTER
                        </span>
                        <span class="badge px-3 py-1.5 fs-8"
                            style="background-color: rgba(6, 95, 70, 0.08); color: #047857; border: 1px solid rgba(6, 95, 70, 0.18); border-radius: 8px !important;">
                            Public Incident Reporting &amp; Dispatch
                        </span>
                    </div>
                    <h3 class="fw-bold mb-1" style="color: #064e3b;">
                        <i class="bi bi-ticket-perforated-fill me-2" style="color: #059669;"></i> Ticketing Laporan
                        Bencana Masyarakat
                    </h3>
                    <p class="small mb-0" style="color: #047857; max-width: 75ch;">
                        Monitoring, verifikasi, dan penanganan cepat atas laporan kebencanaan darurat yang dikirimkan
                        oleh masyarakat melalui PsyAid Assistant.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Flash Notifications -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert border-0 shadow-sm rounded-lg mb-4 p-3.5 p-md-4 bg-success-subtle text-success-emphasis position-relative"
            role="alert" style="border-radius: 8px !important; border: 1px solid #a7f3d0 !important;">
            <div class="d-flex align-items-center justify-content-between gap-3">
                <div class="d-flex align-items-center gap-2.5 flex-grow-1">
                    <i class="bi bi-check-circle-fill fs-5 text-success flex-shrink-0"></i>
                    <div class="small fw-bold" style="line-height: 1.45;"><?= session()->getFlashdata('success') ?></div>
                </div>
                <button type="button" class="btn-close position-static p-2 ms-2 flex-shrink-0" data-bs-dismiss="alert"
                    aria-label="Close" title="Tutup Notifikasi"></button>
            </div>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert border-0 shadow-sm rounded-lg mb-4 p-3.5 p-md-4 bg-danger-subtle text-danger-emphasis position-relative"
            role="alert" style="border-radius: 8px !important; border: 1px solid #fca5a5 !important;">
            <div class="d-flex align-items-center justify-content-between gap-3">
                <div class="d-flex align-items-center gap-2.5 flex-grow-1">
                    <i class="bi bi-exclamation-triangle-fill fs-5 text-danger flex-shrink-0"></i>
                    <div class="small fw-bold" style="line-height: 1.45;"><?= session()->getFlashdata('error') ?></div>
                </div>
                <button type="button" class="btn-close position-static p-2 ms-2 flex-shrink-0" data-bs-dismiss="alert"
                    aria-label="Close" title="Tutup Notifikasi"></button>
            </div>
        </div>
    <?php endif; ?>

    <!-- 2. KPI Summary Stat Cards (Matching EarthquakeRadar.php style) -->
    <div class="row g-3 mb-4">
        <!-- Card 1: Total Reports -->
        <div class="col-6 col-md-3">
            <div class="card posko-item-card p-3 p-md-3.5 h-100">
                <div class="text-secondary fs-8 fw-bold text-uppercase" style="letter-spacing: 0.03em;">Total Tiket
                    Laporan</div>
                <hr class="my-2 opacity-25" style="color: #059669;" />
                <div class="fs-3 fw-bold mb-1 text-truncate tabular-nums" style="color: #064e3b;">
                    <?= number_format($stats['total']) ?>
                </div>
                <div class="fs-9 text-muted fw-semibold">Semua Tiket Masuk</div>
            </div>
        </div>

        <!-- Card 2: Menunggu Respon (Pending) -->
        <div class="col-6 col-md-3">
            <div class="card posko-item-card p-3 p-md-3.5 h-100">
                <div class="text-secondary fs-8 fw-bold text-uppercase" style="letter-spacing: 0.03em;">Menunggu Respon
                </div>
                <hr class="my-2 opacity-25" style="color: #d97706;" />
                <div class="fs-3 fw-bold mb-1 text-truncate tabular-nums" style="color: #b45309;">
                    <?= number_format($stats['pending']) ?>
                </div>
                <div class="fs-9 text-muted fw-semibold">Perlu Verifikasi</div>
            </div>
        </div>

        <!-- Card 3: Dalam Penanganan (Proses) -->
        <div class="col-6 col-md-3">
            <div class="card posko-item-card p-3 p-md-3.5 h-100">
                <div class="text-secondary fs-8 fw-bold text-uppercase" style="letter-spacing: 0.03em;">Dalam Penanganan
                </div>
                <hr class="my-2 opacity-25" style="color: #2563eb;" />
                <div class="fs-3 fw-bold mb-1 text-truncate tabular-nums" style="color: #1d4ed8;">
                    <?= number_format($stats['proses']) ?>
                </div>
                <div class="fs-9 text-muted fw-semibold">Tim BPBD Dikirim</div>
            </div>
        </div>

        <!-- Card 4: Selesai / Teratasi -->
        <div class="col-6 col-md-3">
            <div class="card posko-item-card p-3 p-md-3.5 h-100">
                <div class="text-secondary fs-8 fw-bold text-uppercase" style="letter-spacing: 0.03em;">Selesai /
                    Teratasi</div>
                <hr class="my-2 opacity-25" style="color: #059669;" />
                <div class="fs-3 fw-bold mb-1 text-truncate tabular-nums" style="color: #047857;">
                    <?= number_format($stats['selesai']) ?>
                </div>
                <div class="fs-9 text-muted fw-semibold">Tindak Lanjut Tuntas</div>
            </div>
        </div>
    </div>

    <!-- 3. Frosted Filter & Search Bar (Matching PoskoManagement.php) -->
    <div class="card mb-4 border-0 shadow-sm frost-card-filter-container"
        style="background: rgba(236, 253, 245, 0.7); border: 1.5px solid #a7f3d0 !important; border-radius: 8px !important;">
        <div class="card-body p-3.5 frost-card-filter-body">
            <form method="GET" action="<?= site_url('/bpbd/ticketing-laporan') ?>" class="row g-3 align-items-center">

                <!-- Search Query Input Wrapper -->
                <div class="col-12 col-md-6 col-lg-7">
                    <div class="frost-search-input-wrapper">
                        <i class="bi bi-search frost-search-icon-inside"></i>
                        <input type="text" name="q" value="<?= esc($searchQuery) ?>" class="frost-search-input"
                            placeholder="Cari kode tiket, nama pelapor, nomor WA, lokasi, atau jenis bencana...">
                        <?php if (!empty($searchQuery)): ?>
                            <a href="<?= site_url('/bpbd/ticketing-laporan' . (!empty($statusFilter) ? '?status=' . esc($statusFilter) : '')) ?>"
                                class="frost-search-clear-inside" title="Hapus Pencarian">
                                <i class="bi bi-x-circle-fill"></i>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Status Filter Custom Floating Dropdown System (Matching PoskoManagement.php) -->
                <div class="col-12 col-sm-6 col-md-3 col-lg-3">
                    <!-- Hidden native select for form submission -->
                    <select id="filter-status" name="status" class="d-none">
                        <option value="" <?= empty($statusFilter) ? 'selected' : '' ?>>Semua Status Penanganan</option>
                        <option value="pending" <?= $statusFilter === 'pending' ? 'selected' : '' ?>>Menunggu Respon
                            (Pending)</option>
                        <option value="proses" <?= $statusFilter === 'proses' ? 'selected' : '' ?>>Dalam Penanganan
                            (Proses)</option>
                        <option value="selesai" <?= $statusFilter === 'selesai' ? 'selected' : '' ?>>Selesai / Teratasi
                        </option>
                        <option value="ditolak" <?= $statusFilter === 'ditolak' ? 'selected' : '' ?>>Invalid / Ditolak
                        </option>
                    </select>

                    <?php
                    $statusMap = [
                        'pending' => 'Menunggu Respon (Pending)',
                        'proses' => 'Dalam Penanganan (Proses)',
                        'selesai' => 'Selesai / Teratasi',
                        'ditolak' => 'Invalid / Ditolak',
                    ];
                    $selectedStatusLabel = isset($statusMap[$statusFilter]) ? $statusMap[$statusFilter] : 'Semua Status Penanganan';
                    ?>
                    <div class="frost-custom-select-wrapper" id="custom-wrapper-status">
                        <div class="frost-custom-trigger" id="trigger-status" tabindex="0">
                            <span class="trigger-label text-truncate"
                                id="label-status"><?= esc($selectedStatusLabel) ?></span>
                            <i class="bi bi-chevron-down chevron-icon ms-2"></i>
                        </div>
                        <div class="frost-custom-menu" id="menu-status">
                            <div class="frost-custom-option <?= empty($statusFilter) ? 'selected' : '' ?>"
                                data-value="">
                                <span>Semua Status Penanganan</span>
                                <?php if (empty($statusFilter)): ?><i
                                        class="bi bi-check-lg text-emerald-600"></i><?php endif; ?>
                            </div>
                            <div class="frost-custom-option <?= $statusFilter === 'pending' ? 'selected' : '' ?>"
                                data-value="pending">
                                <span>Menunggu Respon (Pending)</span>
                                <?php if ($statusFilter === 'pending'): ?><i
                                        class="bi bi-check-lg text-emerald-600"></i><?php endif; ?>
                            </div>
                            <div class="frost-custom-option <?= $statusFilter === 'proses' ? 'selected' : '' ?>"
                                data-value="proses">
                                <span>Dalam Penanganan (Proses)</span>
                                <?php if ($statusFilter === 'proses'): ?><i
                                        class="bi bi-check-lg text-emerald-600"></i><?php endif; ?>
                            </div>
                            <div class="frost-custom-option <?= $statusFilter === 'selesai' ? 'selected' : '' ?>"
                                data-value="selesai">
                                <span>Selesai / Teratasi</span>
                                <?php if ($statusFilter === 'selesai'): ?><i
                                        class="bi bi-check-lg text-emerald-600"></i><?php endif; ?>
                            </div>
                            <div class="frost-custom-option <?= $statusFilter === 'ditolak' ? 'selected' : '' ?>"
                                data-value="ditolak">
                                <span>Invalid / Ditolak</span>
                                <?php if ($statusFilter === 'ditolak'): ?><i
                                        class="bi bi-check-lg text-emerald-600"></i><?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="col-12 col-sm-6 col-md-3 col-lg-2 d-flex gap-2">
                    <button type="submit" class="frost-btn-search-submit w-100">
                        <i class="bi bi-filter"></i> <span>Filter</span>
                    </button>
                    <?php if (!empty($searchQuery) || !empty($statusFilter)): ?>
                        <a href="<?= site_url('/bpbd/ticketing-laporan') ?>" class="frost-btn-reset" title="Reset Filter">
                            <i class="bi bi-arrow-counterclockwise"></i> Reset
                        </a>
                    <?php endif; ?>
                </div>

            </form>
        </div>
    </div>

    <!-- 4. Disaster Reports Card Grid -->
    <?php if (empty($reports)): ?>
        <div class="card bg-white shadow-xs border-0 text-center py-5"
            style="border: 1.5px solid #d1fae5 !important; border-radius: 8px !important;">
            <div class="card-body py-4">
                <i class="bi bi-inbox fs-1 text-emerald-400 d-block mb-2"></i>
                <h5 class="fw-bold text-dark mb-1" style="color: #064e3b !important;">Tidak Ada Tiket Laporan</h5>
                <p class="text-muted small mb-0">Belum ada data laporan masyarakat yang sesuai dengan pencarian atau filter
                    yang dipilih.</p>
            </div>
        </div>
    <?php else: ?>
        <div class="row g-4">
            <?php foreach ($reports as $report): ?>
                <div class="col-12 col-md-6 col-lg-4">
                    <div
                        class="card report-card bg-white h-100 shadow-sm overflow-hidden d-flex flex-column justify-content-between">
                        <div>
                            <!-- Header: Ticket Code & Status Badge -->
                            <div class="card-header bg-transparent border-bottom px-3.5 py-3 d-flex align-items-center justify-content-between gap-2 flex-wrap"
                                style="border-color: #d1fae5 !important; background: linear-gradient(135deg, #f0fdf4 0%, #ecfdf5 100%) !important;">
                                <div class="d-flex align-items-center gap-2">
                                    <i class="bi bi-ticket-perforated-fill text-emerald-600 fs-5"></i>
                                    <span class="font-mono fw-bold fs-8"
                                        style="color: #064e3b !important; letter-spacing: 0.02em;">
                                        <?= esc($report['ticket_code']) ?>
                                    </span>
                                </div>
                                <div>
                                    <?php if ($report['status'] === 'pending'): ?>
                                        <span class="badge badge-status-pending px-2.5 py-1 fs-9"
                                            style="border-radius: 8px !important;">
                                            <i class="bi bi-clock me-1"></i> Menunggu Respon
                                        </span>
                                    <?php elseif ($report['status'] === 'proses'): ?>
                                        <span class="badge badge-status-proses px-2.5 py-1 fs-9"
                                            style="border-radius: 8px !important;">
                                            <i class="bi bi-gear-wide-connected me-1"></i> Dalam Penanganan
                                        </span>
                                    <?php elseif ($report['status'] === 'selesai'): ?>
                                        <span class="badge badge-status-selesai px-2.5 py-1 fs-9"
                                            style="border-radius: 8px !important;">
                                            <i class="bi bi-check-circle-fill me-1"></i> Selesai
                                        </span>
                                    <?php else: ?>
                                        <span class="badge badge-status-ditolak px-2.5 py-1 fs-9"
                                            style="border-radius: 8px !important;">
                                            <i class="bi bi-x-circle-fill me-1"></i> Invalid / Ditolak
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <!-- Card Body: Report Details -->
                            <div class="card-body p-3.5">

                                <!-- Pelapor Name & WA Info Box -->
                                <div class="p-3 mb-3 rounded"
                                    style="background: #f8fafc; border: 1.5px solid #e2e8f0; border-radius: 8px !important;">
                                    <div class="d-flex align-items-center justify-content-between mb-2 flex-wrap gap-1">
                                        <strong class="small fw-bold d-flex align-items-center" style="color: #0f172a;">
                                            <i class="bi bi-person-fill text-emerald-600 me-2"></i><?= esc($report['nama']) ?>
                                        </strong>
                                        <span class="badge px-2.5 py-1 fs-9 fw-bold d-inline-flex align-items-center"
                                            style="background-color: #ecfdf5; color: #047857; border: 1px solid #a7f3d0; border-radius: 6px !important;">
                                            Pelapor
                                            Masyarakat
                                        </span>
                                    </div>
                                    <div class="fs-8 text-muted d-flex align-items-center">
                                        <i class="bi bi-whatsapp text-success me-2"></i>
                                        <a href="https://wa.me/<?= preg_replace('/[^0-9]/', '', $report['whatsapp']) ?>"
                                            target="_blank" class="text-decoration-none text-emerald-700 fw-bold">
                                            <?= esc($report['whatsapp']) ?>
                                        </a>
                                    </div>
                                </div>

                                <!-- Disaster Info Grid -->
                                <div class="d-flex flex-column gap-2.5 fs-8">
                                    <div class="d-flex align-items-start gap-2">
                                        <i class="bi bi-exclamation-triangle-fill text-amber-500 flex-shrink-0 mt-0.5 me-1"></i>
                                        <div>
                                            <span class="text-muted d-block fs-9">Jenis Bencana:</span>
                                            <strong
                                                class="text-dark fw-bold"><?= esc($report['jenis_bencana'] ?: 'Bencana Alam') ?></strong>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-start gap-2">
                                        <i class="bi bi-geo-alt-fill text-danger flex-shrink-0 mt-0.5 me-1"></i>
                                        <div>
                                            <span class="text-muted d-block fs-9">Lokasi Bencana:</span>
                                            <strong class="text-dark fw-semibold"
                                                style="line-height: 1.35;"><?= esc($report['lokasi_bencana']) ?></strong>
                                        </div>
                                    </div>

                                    <?php if (!empty($report['tanggal_bencana'])): ?>
                                        <div class="d-flex align-items-start gap-2">
                                            <i class="bi bi-calendar-event text-emerald-600 flex-shrink-0 mt-0.5 me-1"></i>
                                            <div>
                                                <span class="text-muted d-block fs-9">Waktu Bencana:</span>
                                                <span class="text-dark fw-medium"><?= esc($report['tanggal_bencana']) ?></span>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <div class="d-flex align-items-center justify-content-between pt-2 border-top"
                                        style="border-color: #f1f5f9 !important;">
                                        <span class="text-muted fs-9">Status Keberlangsungan:</span>
                                        <span
                                            class="badge <?= $report['status_berlangsung'] === 'Ya' ? 'bg-danger-subtle text-danger border border-danger-subtle' : 'bg-secondary-subtle text-dark' ?> fs-9 fw-bold"
                                            style="border-radius: 6px !important;">
                                            <?= $report['status_berlangsung'] === 'Ya' ? 'Masih Berlangsung' : 'Sudah Selesai' ?>
                                        </span>
                                    </div>

                                    <?php if (!empty($report['skala_keparahan'])): ?>
                                        <div class="d-flex align-items-center justify-content-between mt-2">
                                            <span class="text-muted fs-9">Skala Keparahan:</span>
                                            <span
                                                class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle fs-9 fw-bold"
                                                style="border-radius: 6px !important;">
                                                <i class="bi bi-speedometer2 me-1"></i> <?= esc($report['skala_keparahan']) ?>
                                            </span>
                                        </div>
                                    <?php endif; ?>

                                    <?php if (!empty($report['catatan_tambahan'])): ?>
                                        <div class="p-3 rounded text-slate-700 fs-8 mt-2.5"
                                            style="border-radius: 8px !important; background-color: #f8fafc !important; border: 1px solid #e2e8f0 !important;">
                                            <strong class="d-block text-emerald-950 mb-1 fs-9"><i
                                                    class="bi bi-chat-left-text me-2 text-emerald-600"></i>Informasi
                                                Tambahan:</strong>
                                            <span
                                                class="fst-italic text-secondary lh-sm d-block">"<?= esc($report['catatan_tambahan']) ?>"</span>
                                        </div>
                                    <?php endif; ?>

                                    <div class="fs-9 text-muted text-end pt-1">
                                        <i class="bi bi-clock-history me-1"></i>Diterima:
                                        <?= date('d M Y, H:i', strtotime($report['created_at'])) ?> WIB
                                    </div>
                                </div>

                            </div>
                        </div>

                        <!-- Card Footer: Actions -->
                        <div class="card-footer bg-white border-top p-3 d-flex flex-column gap-2"
                            style="border-color: #e2e8f0 !important;">
                            <div class="d-flex gap-2">
                                <!-- Status Update Button -->
                                <button type="button" class="frost-btn-primary flex-grow-1 justify-content-center py-2 fs-8"
                                    data-bs-toggle="modal" data-bs-target="#updateStatusModal<?= $report['id'] ?>">
                                    <i class="bi bi-pencil-square me-1"></i> Update Status
                                </button>

                                <!-- WhatsApp Contact Button -->
                                <?php
                                $waNumber = preg_replace('/[^0-9]/', '', $report['whatsapp']);
                                if (strpos($waNumber, '0') === 0) {
                                    $waNumber = '62' . substr($waNumber, 1);
                                }
                                $waText = rawurlencode("Halo Bpk/Ibu " . $report['nama'] . ", kami dari BPBD Command Center terkait Laporan Bencana " . $report['ticket_code'] . " (" . $report['jenis_bencana'] . " di " . $report['lokasi_bencana'] . ").");
                                ?>
                                <a href="https://wa.me/<?= $waNumber ?>?text=<?= $waText ?>" target="_blank"
                                    class="frost-btn-whatsapp justify-content-center py-2 px-3 fs-8"
                                    title="Kirim WA Konfirmasi">
                                    <i class="bi bi-whatsapp"></i> WA
                                </a>
                            </div>

                            <!-- Delete Button -->
                            <button type="button" class="frost-btn-danger w-100 justify-content-center py-1.5 fs-9"
                                data-bs-toggle="modal" data-bs-target="#deleteReportModal<?= $report['id'] ?>">
                                <i class="bi bi-trash me-1"></i> Hapus Tiket
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Modal Update Status Penanganan -->
                <div class="modal fade" id="updateStatusModal<?= $report['id'] ?>" tabindex="-1"
                    aria-labelledby="updateStatusModalLabel<?= $report['id'] ?>" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content border-0 shadow-2xl modal-content-overflow-visible"
                            style="border-radius: 8px !important;">

                            <div class="modal-header text-white border-0 p-3.5" style="background-color: #047857;">
                                <h5 class="modal-title h6 fw-bold mb-0 d-flex align-items-center gap-2"
                                    id="updateStatusModalLabel<?= $report['id'] ?>">
                                    <i class="bi bi-pencil-square fs-5"></i> Update Status — Tiket
                                    <?= esc($report['ticket_code']) ?>
                                </h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>

                            <form action="<?= site_url('/bpbd/ticketing-laporan/update-status/' . $report['id']) ?>"
                                method="POST">
                                <?= csrf_field() ?>
                                <div class="modal-body p-4 bg-white text-slate-900 modal-body-overflow-visible">

                                    <div class="p-3 mb-3 rounded border"
                                        style="background: #ecfdf5; border-color: #a7f3d0 !important; border-radius: 8px !important;">
                                        <div class="fw-bold text-emerald-950 fs-8 mb-1"><?= esc($report['nama']) ?>
                                            (<?= esc($report['whatsapp']) ?>)</div>
                                        <div class="fs-9 text-slate-600 mb-0.5"><i
                                                class="bi bi-geo-alt me-1"></i><?= esc($report['lokasi_bencana']) ?></div>
                                        <div class="fs-9 text-slate-600"><i
                                                class="bi bi-exclamation-circle me-1"></i><?= esc($report['jenis_bencana']) ?>
                                        </div>
                                    </div>

                                    <label class="form-label fw-bold text-dark fs-8 mb-1.5" style="color: #064e3b !important;">
                                        Pilih Status Penanganan Terbaru:
                                    </label>

                                    <!-- Hidden input for modal form submission -->
                                    <input type="hidden" name="status" id="modal-status-input-<?= $report['id'] ?>"
                                        value="<?= esc($report['status']) ?>">

                                    <?php
                                    $modalStatusMap = [
                                        'pending' => 'Menunggu Respon (Pending)',
                                        'proses' => 'Dalam Penanganan (Proses)',
                                        'selesai' => 'Selesai / Teratasi',
                                        'ditolak' => 'Invalid / Ditolak',
                                    ];
                                    $currentModalStatusLabel = isset($modalStatusMap[$report['status']]) ? $modalStatusMap[$report['status']] : 'Menunggu Respon (Pending)';
                                    ?>
                                    <div class="frost-custom-select-wrapper" id="custom-modal-wrapper-<?= $report['id'] ?>">
                                        <div class="frost-custom-trigger frost-modal-trigger"
                                            data-report-id="<?= $report['id'] ?>" tabindex="0">
                                            <span class="trigger-label text-truncate"
                                                id="modal-label-status-<?= $report['id'] ?>"><?= esc($currentModalStatusLabel) ?></span>
                                            <i class="bi bi-chevron-down chevron-icon ms-2"></i>
                                        </div>
                                        <div class="frost-custom-menu frost-modal-menu"
                                            id="modal-menu-status-<?= $report['id'] ?>">
                                            <div class="frost-custom-option <?= $report['status'] === 'pending' ? 'selected' : '' ?>"
                                                data-report-id="<?= $report['id'] ?>" data-value="pending">
                                                <span>Menunggu Respon (Pending)</span>
                                                <?php if ($report['status'] === 'pending'): ?><i
                                                        class="bi bi-check-lg text-emerald-600"></i><?php endif; ?>
                                            </div>
                                            <div class="frost-custom-option <?= $report['status'] === 'proses' ? 'selected' : '' ?>"
                                                data-report-id="<?= $report['id'] ?>" data-value="proses">
                                                <span>Dalam Penanganan (Proses)</span>
                                                <?php if ($report['status'] === 'proses'): ?><i
                                                        class="bi bi-check-lg text-emerald-600"></i><?php endif; ?>
                                            </div>
                                            <div class="frost-custom-option <?= $report['status'] === 'selesai' ? 'selected' : '' ?>"
                                                data-report-id="<?= $report['id'] ?>" data-value="selesai">
                                                <span>Selesai / Teratasi</span>
                                                <?php if ($report['status'] === 'selesai'): ?><i
                                                        class="bi bi-check-lg text-emerald-600"></i><?php endif; ?>
                                            </div>
                                            <div class="frost-custom-option <?= $report['status'] === 'ditolak' ? 'selected' : '' ?>"
                                                data-report-id="<?= $report['id'] ?>" data-value="ditolak">
                                                <span>Invalid / Ditolak</span>
                                                <?php if ($report['status'] === 'ditolak'): ?><i
                                                        class="bi bi-check-lg text-emerald-600"></i><?php endif; ?>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="modal-footer bg-slate-50 border-top p-3 d-flex align-items-center justify-content-between"
                                    style="border-color: #e2e8f0 !important;">
                                    <button type="button"
                                        class="btn btn-light border text-slate-700 btn-sm fw-semibold px-3.5 py-2"
                                        style="border-radius: 8px !important;" data-bs-dismiss="modal">
                                        Batal
                                    </button>
                                    <button type="submit" class="frost-btn-primary py-2 px-4 fs-8">
                                        <i class="bi bi-check-circle-fill me-1"></i> Simpan Status
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Modal Hapus Tiket Laporan -->
                <div class="modal fade" id="deleteReportModal<?= $report['id'] ?>" tabindex="-1"
                    aria-labelledby="deleteReportModalLabel<?= $report['id'] ?>" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content border-0 shadow-2xl overflow-hidden" style="border-radius: 8px !important;">
                            <div class="modal-header bg-danger text-white border-0 p-3.5">
                                <h5 class="modal-title h6 fw-bold mb-0 d-flex align-items-center gap-2"
                                    id="deleteReportModalLabel<?= $report['id'] ?>">
                                    <i class="bi bi-exclamation-triangle-fill fs-5"></i> Konfirmasi Hapus Tiket
                                </h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form action="<?= site_url('/bpbd/ticketing-laporan/delete/' . $report['id']) ?>" method="POST">
                                <?= csrf_field() ?>
                                <div class="modal-body p-4 bg-white text-slate-900 text-center">
                                    <i class="bi bi-trash3 fs-1 text-danger d-block mb-2"></i>
                                    <h6 class="fw-bold text-dark mb-1">Apakah Anda yakin ingin menghapus tiket ini?</h6>
                                    <p class="text-muted small mb-0">
                                        Tiket <strong><?= esc($report['ticket_code']) ?></strong> dari pelapor
                                        <strong><?= esc($report['nama']) ?></strong> akan dihapus permanen.
                                    </p>
                                </div>
                                <div class="modal-footer bg-slate-50 border-top p-3 d-flex align-items-center justify-content-between"
                                    style="border-color: #e2e8f0 !important;">
                                    <button type="button"
                                        class="btn btn-light border text-slate-700 btn-sm fw-semibold px-3.5 py-2"
                                        style="border-radius: 8px !important;" data-bs-dismiss="modal">
                                        Batal
                                    </button>
                                    <button type="submit" class="btn btn-danger btn-sm fw-bold px-4 py-2"
                                        style="border-radius: 8px !important;">
                                        <i class="bi bi-trash-fill me-1"></i> Ya, Hapus Tiket
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            <?php endforeach; ?>
        </div>
    <?php endif; ?>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // 1. Page Filter Custom Dropdown
        const filterTrigger = document.getElementById('trigger-status');
        const filterMenu = document.getElementById('menu-status');
        const filterWrapper = document.getElementById('custom-wrapper-status');
        const filterNativeSelect = document.getElementById('filter-status');
        const filterForm = filterTrigger ? filterTrigger.closest('form') : null;

        if (filterTrigger && filterMenu && filterNativeSelect) {
            filterTrigger.addEventListener('click', function (e) {
                e.stopPropagation();
                const isOpen = filterMenu.classList.contains('show');
                closeAllCustomDropdowns();
                if (!isOpen) {
                    filterMenu.classList.add('show');
                    filterTrigger.classList.add('active');
                    filterWrapper.classList.add('active-dropdown');
                }
            });

            filterMenu.querySelectorAll('.frost-custom-option').forEach(opt => {
                opt.addEventListener('click', function (e) {
                    e.stopPropagation();
                    const val = this.getAttribute('data-value');
                    filterNativeSelect.value = val;
                    closeAllCustomDropdowns();
                    if (filterForm) filterForm.submit();
                });
            });
        }

        // 2. Modal Status Custom Dropdowns
        document.querySelectorAll('.frost-modal-trigger').forEach(trigger => {
            const reportId = trigger.getAttribute('data-report-id');
            const menu = document.getElementById('modal-menu-status-' + reportId);
            const wrapper = document.getElementById('custom-modal-wrapper-' + reportId);
            const hiddenInput = document.getElementById('modal-status-input-' + reportId);
            const labelSpan = document.getElementById('modal-label-status-' + reportId);

            if (trigger && menu) {
                trigger.addEventListener('click', function (e) {
                    e.stopPropagation();
                    const isOpen = menu.classList.contains('show');
                    closeAllCustomDropdowns();
                    if (!isOpen) {
                        menu.classList.add('show');
                        trigger.classList.add('active');
                        wrapper.classList.add('active-dropdown');
                    }
                });
            }

            if (menu && hiddenInput && labelSpan) {
                menu.querySelectorAll('.frost-custom-option').forEach(opt => {
                    opt.addEventListener('click', function (e) {
                        e.stopPropagation();
                        const val = this.getAttribute('data-value');
                        const textSpan = this.querySelector('span');
                        hiddenInput.value = val;
                        labelSpan.textContent = textSpan ? textSpan.textContent : val;

                        // Update checkmark UI inside modal dropdown menu
                        menu.querySelectorAll('.frost-custom-option').forEach(o => {
                            o.classList.remove('selected');
                            const check = o.querySelector('.bi-check-lg');
                            if (check) check.remove();
                        });
                        this.classList.add('selected');
                        const newCheck = document.createElement('i');
                        newCheck.className = 'bi bi-check-lg text-emerald-600';
                        this.appendChild(newCheck);

                        closeAllCustomDropdowns();
                    });
                });
            }
        });

        document.addEventListener('click', function () {
            closeAllCustomDropdowns();
        });

        function closeAllCustomDropdowns() {
            document.querySelectorAll('.frost-custom-menu').forEach(m => m.classList.remove('show'));
            document.querySelectorAll('.frost-custom-trigger').forEach(t => t.classList.remove('active'));
            document.querySelectorAll('.frost-custom-select-wrapper').forEach(w => w.classList.remove('active-dropdown'));
        }
    });
</script>
<?= $this->endSection() ?>