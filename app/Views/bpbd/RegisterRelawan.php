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
<div class="container-fluid px-3 px-md-4 py-4">

    <!-- Top Header Section -->
    <div
        class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center mb-4 gap-3">
        <div>
            <div class="d-flex align-items-center gap-2 mb-1.5 flex-wrap">
                <span
                    class="badge bg-emerald-100 text-emerald-950 px-2.5 py-1 rounded-lg fs-7 fw-semibold border border-emerald-200">
                    <i class="bi bi-shield-check me-1"></i> Khusus BPBD Admin
                </span>
                <span class="text-muted small">•</span>
                <span class="text-muted small fw-medium">Review &amp; Approval System</span>
            </div>
            <h1 class="h3 fw-bold text-slate-900 mb-1">Approval Akun Relawan</h1>
            <p class="text-muted small mb-0">Review daftar pengajuan akun relawan baru yang masuk melalui portal chatbot
                rekrutmen BPBD.</p>
        </div>
        <a href="<?= site_url('/command-center') ?>"
            class="btn btn-outline-secondary btn-sm rounded-lg fw-semibold d-inline-flex align-items-center gap-2 shadow-sm align-self-start align-self-sm-center">
            <i class="bi bi-arrow-left"></i> Kembali ke Command Center
        </a>
    </div>

    <!-- Flash Notifications -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success border-0 shadow-sm rounded-lg mb-4 p-3 p-md-3.5 bg-success-subtle text-success-emphasis"
            role="alert">
            <div
                class="d-flex flex-column flex-sm-row align-items-start align-items-sm-center justify-content-between gap-3">
                <div class="d-flex align-items-center gap-3">
                    <i class="bi bi-check-circle-fill fs-5 text-success flex-shrink-0 me-1"></i>
                    <div class="small fw-semibold"><?= session()->getFlashdata('success') ?></div>
                </div>
                <div class="d-flex align-items-center gap-2.5 ms-auto ms-sm-0 flex-shrink-0">
                    <?php if (session()->getFlashdata('wa_redirect')): ?>
                        <a href="<?= session()->getFlashdata('wa_redirect') ?>" target="_blank"
                            class="btn btn-emerald text-white btn-sm fw-bold rounded-lg px-3 py-1.5 shadow-sm d-inline-flex align-items-center gap-2">
                            <i class="bi bi-whatsapp fs-6"></i>
                            <span>Kirim WA Konfirmasi</span>
                        </a>
                    <?php endif; ?>
                    <button type="button" class="btn-close position-static p-1" data-bs-dismiss="alert"
                        aria-label="Close"></button>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('info')): ?>
        <div class="alert alert-info border-0 shadow-sm rounded-lg mb-4 p-3 p-md-3.5 bg-info-subtle text-info-emphasis"
            role="alert">
            <div
                class="d-flex flex-column flex-sm-row align-items-start align-items-sm-center justify-content-between gap-3">
                <div class="d-flex align-items-center gap-3">
                    <i class="bi bi-info-circle-fill fs-5 text-info flex-shrink-0 me-1"></i>
                    <div class="small fw-semibold"><?= session()->getFlashdata('info') ?></div>
                </div>
                <div class="d-flex align-items-center gap-2.5 ms-auto ms-sm-0 flex-shrink-0">
                    <?php if (session()->getFlashdata('wa_redirect')): ?>
                        <a href="<?= session()->getFlashdata('wa_redirect') ?>" target="_blank"
                            class="btn btn-outline-danger btn-sm fw-bold rounded-lg px-3 py-1.5 shadow-sm d-inline-flex align-items-center gap-2">
                            <i class="bi bi-whatsapp fs-6"></i>
                            <span>Kirim WA Penolakan</span>
                        </a>
                    <?php endif; ?>
                    <button type="button" class="btn-close position-static p-1" data-bs-dismiss="alert"
                        aria-label="Close"></button>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger border-0 shadow-sm rounded-lg mb-4 p-3 p-md-3.5 bg-danger-subtle text-danger-emphasis"
            role="alert">
            <div class="d-flex align-items-center justify-content-between gap-3">
                <div class="d-flex align-items-center gap-3">
                    <i class="bi bi-exclamation-triangle-fill fs-5 text-danger flex-shrink-0 me-1"></i>
                    <div class="small fw-semibold"><?= session()->getFlashdata('error') ?></div>
                </div>
                <button type="button" class="btn-close position-static p-1" data-bs-dismiss="alert"
                    aria-label="Close"></button>
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

    <!-- Summary Stats Row (Interactive Filter Cards) -->
    <?php
    $totalCount = count($requests ?? []);
    $pendingCount = count(array_filter($requests ?? [], fn($r) => $r['status'] === 'pending'));
    $approvedCount = count(array_filter($requests ?? [], fn($r) => $r['status'] === 'approved'));
    $rejectedCount = count(array_filter($requests ?? [], fn($r) => $r['status'] === 'rejected'));
    ?>
    <div class="row g-3 mb-4">
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm rounded-lg bg-white p-3 p-md-3.5 h-100 filter-stat-card active"
                data-filter="all" role="button">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted fs-8 fw-bold text-uppercase d-block mb-1">Total Permohonan</span>
                        <h3 class="h4 fw-bold text-slate-900 mb-0"><?= $totalCount ?></h3>
                    </div>
                    <div class="p-2.5 p-md-3 bg-slate-100 text-slate-700 rounded-lg">
                        <i class="bi bi-file-earmark-person fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm rounded-lg bg-white p-3 p-md-3.5 h-100 filter-stat-card"
                data-filter="pending" role="button">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted fs-8 fw-bold text-uppercase d-block mb-1">Menunggu Review</span>
                        <h3 class="h4 fw-bold text-warning mb-0"><?= $pendingCount ?></h3>
                    </div>
                    <div class="p-2.5 p-md-3 bg-warning-subtle text-warning-emphasis rounded-lg">
                        <i class="bi bi-hourglass-split fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm rounded-lg bg-white p-3 p-md-3.5 h-100 filter-stat-card"
                data-filter="approved" role="button">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted fs-8 fw-bold text-uppercase d-block mb-1">Disetujui &amp; Aktif</span>
                        <h3 class="h4 fw-bold text-emerald-700 mb-0"><?= $approvedCount ?></h3>
                    </div>
                    <div class="p-2.5 p-md-3 bg-emerald-100 text-emerald-700 rounded-lg">
                        <i class="bi bi-check-circle-fill fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm rounded-lg bg-white p-3 p-md-3.5 h-100 filter-stat-card"
                data-filter="rejected" role="button">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted fs-8 fw-bold text-uppercase d-block mb-1">Ditolak</span>
                        <h3 class="h4 fw-bold text-danger mb-0"><?= $rejectedCount ?></h3>
                    </div>
                    <div class="p-2.5 p-md-3 bg-danger-subtle text-danger-emphasis rounded-lg">
                        <i class="bi bi-x-circle-fill fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main List & Filter Card -->
    <div class="card border-0 shadow-sm rounded-lg bg-white overflow-hidden">

        <!-- Filter Bar & Search Box Header -->
        <div class="card-header bg-white border-bottom border-light p-3 p-md-4">
            <div class="row g-3 align-items-center justify-content-between">
                <!-- Status Filter Pills -->
                <div class="col-12 col-md-auto">
                    <div class="d-flex flex-wrap gap-1.5">
                        <button type="button" class="btn btn-sm rounded-lg fw-semibold filter-btn active"
                            data-filter="all">
                            Semua <span
                                class="badge bg-secondary-subtle text-slate-800 ms-1 rounded-lg"><?= $totalCount ?></span>
                        </button>
                        <button type="button" class="btn btn-sm rounded-lg fw-semibold filter-btn"
                            data-filter="pending">
                            Menunggu Review <span
                                class="badge bg-warning-subtle text-warning-emphasis ms-1 rounded-lg"><?= $pendingCount ?></span>
                        </button>
                        <button type="button" class="btn btn-sm rounded-lg fw-semibold filter-btn"
                            data-filter="approved">
                            Disetujui <span
                                class="badge bg-success-subtle text-success-emphasis ms-1 rounded-lg"><?= $approvedCount ?></span>
                        </button>
                        <button type="button" class="btn btn-sm rounded-lg fw-semibold filter-btn"
                            data-filter="rejected">
                            Ditolak <span
                                class="badge bg-danger-subtle text-danger-emphasis ms-1 rounded-lg"><?= $rejectedCount ?></span>
                        </button>
                    </div>
                </div>

                <!-- Search Input -->
                <div class="col-12 col-md-5 col-lg-4">
                    <div class="input-group input-group-sm">
                        <span class="input-group-text bg-light border-end-0 text-muted"><i
                                class="bi bi-search"></i></span>
                        <input type="text" id="search-input" class="form-control border-start-0 bg-light rounded-end-lg"
                            placeholder="Cari Nama, NIK, WhatsApp, Posko...">
                    </div>
                </div>
            </div>
        </div>

        <!-- 1. DESKTOP TABLE VIEW (Visible on >= 768px) -->
        <div class="d-none d-md-block table-responsive">
            <table class="table table-hover align-middle mb-0" id="volunteer-table">
                <thead class="table-light fs-8 text-uppercase text-muted fw-bold">
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
                                    <div class="fw-bold text-slate-900 mb-0.5"><?= esc($req['nama']) ?></div>
                                    <div class="fs-8 text-muted">NIK: <?= esc($req['nik']) ?></div>
                                </td>
                                <td>
                                    <a href="<?= format_wa_url($req['whatsapp']) ?>" target="_blank"
                                        class="badge bg-emerald-50 text-emerald-800 border border-emerald-200 px-3 py-1.5 rounded-lg text-decoration-none d-inline-flex align-items-center gap-2 hover:bg-emerald-100 transition-colors">
                                        <i class="bi bi-whatsapp text-success fs-7"></i>
                                        <span><?= esc($req['whatsapp']) ?></span>
                                    </a>
                                </td>
                                <td>
                                    <div class="fw-semibold text-slate-800"><?= esc($req['provinsi']) ?></div>
                                    <div class="fs-8 text-muted">
                                        <?= !empty($req['tgl_lahir']) ? date('d M Y', strtotime($req['tgl_lahir'])) : '-' ?>
                                    </div>
                                </td>
                                <td>
                                    <span
                                        class="badge bg-slate-100 border border-slate-300 px-3 py-1.5 rounded-lg fw-bold d-inline-flex align-items-center gap-2 text-wrap text-start"
                                        style="color: #1e293b !important; max-width: 180px; line-height: 1.4;">
                                        <i class="bi bi-geo-alt-fill text-danger flex-shrink-0 me-1"></i>
                                        <span
                                            style="color: #1e293b !important; font-weight: 700; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;"><?= esc($req['posko_name'] ?? 'Posko Bencana') ?></span>
                                    </span>
                                </td>
                                <td class="text-muted fs-8">
                                    <?= date('d M Y H:i', strtotime($req['created_at'])) ?>
                                </td>
                                <td>
                                    <?php if ($req['status'] === 'approved'): ?>
                                        <span
                                            class="badge bg-success-subtle text-success-emphasis border border-success-subtle px-2.5 py-1 rounded-lg fw-bold d-inline-flex align-items-center gap-1">
                                            <i class="bi bi-check-circle-fill"></i> Disetujui
                                        </span>
                                    <?php elseif ($req['status'] === 'rejected'): ?>
                                        <span
                                            class="badge bg-danger-subtle text-danger-emphasis border border-danger-subtle px-2.5 py-1 rounded-lg fw-bold d-inline-flex align-items-center gap-1">
                                            <i class="bi bi-x-circle-fill"></i> Ditolak
                                        </span>
                                    <?php else: ?>
                                        <span
                                            class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle px-2.5 py-1 rounded-lg fw-bold d-inline-flex align-items-center gap-1">
                                            <i class="bi bi-hourglass-split"></i> Menunggu Review
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td class="pe-4 text-center">
                                    <?php if ($req['status'] === 'pending'): ?>
                                        <div class="d-inline-flex align-items-center justify-content-center gap-4">
                                            <form action="<?= site_url('/bpbd/approval-relawan/approve/' . $req['id']) ?>"
                                                method="POST" class="d-inline">
                                                <?= csrf_field() ?>
                                                <button type="submit"
                                                    class="btn btn-emerald text-white fw-bold rounded-lg px-3.5 py-1.5 shadow-xs d-inline-flex align-items-center gap-1.5"
                                                    style="font-size: 0.75rem;">
                                                    <i class="bi bi-check-lg"></i> Setujui
                                                </button>
                                            </form>
                                            <form action="<?= site_url('/bpbd/approval-relawan/reject/' . $req['id']) ?>"
                                                method="POST" class="d-inline">
                                                <?= csrf_field() ?>
                                                <button type="submit"
                                                    class="btn btn-outline-danger fw-semibold rounded-lg px-3.5 py-1.5 d-inline-flex align-items-center gap-1.5"
                                                    style="font-size: 0.75rem;"
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
        <div class="d-md-none p-3 bg-slate-50 flex flex-col gap-3" id="mobile-cards-container">
            <?php if (empty($requests)): ?>
                <div class="text-center py-5 text-muted bg-white rounded-lg p-4 border">
                    <i class="bi bi-inbox fs-2 d-block mb-2 text-slate-400"></i>
                    Belum ada permohonan pendaftaran akun relawan yang masuk.
                </div>
            <?php else: ?>
                <?php foreach ($requests as $idx => $req): ?>
                    <div class="card border border-slate-200 shadow-sm rounded-lg bg-white p-3.5 request-item-card"
                        data-status="<?= esc($req['status']) ?>"
                        data-search="<?= esc(strtolower($req['nama'] . ' ' . $req['nik'] . ' ' . $req['whatsapp'] . ' ' . $req['provinsi'] . ' ' . $req['posko_name'])) ?>">

                        <!-- Header: Name & Status -->
                        <div class="d-flex align-items-start justify-content-between gap-2 mb-2">
                            <div>
                                <h6 class="fw-bold text-slate-900 mb-0.5 leading-snug"><?= esc($req['nama']) ?></h6>
                                <span class="fs-8 text-muted">NIK: <?= esc($req['nik']) ?></span>
                            </div>
                            <div>
                                <?php if ($req['status'] === 'approved'): ?>
                                    <span
                                        class="badge bg-success-subtle text-success-emphasis border border-success-subtle px-2 py-1 rounded-lg fs-8 fw-bold">
                                        Disetujui
                                    </span>
                                <?php elseif ($req['status'] === 'rejected'): ?>
                                    <span
                                        class="badge bg-danger-subtle text-danger-emphasis border border-danger-subtle px-2 py-1 rounded-lg fs-8 fw-bold">
                                        Ditolak
                                    </span>
                                <?php else: ?>
                                    <span
                                        class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle px-2 py-1 rounded-lg fs-8 fw-bold">
                                        Pending
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Details Body -->
                        <div class="bg-slate-50 border border-slate-100 rounded-lg p-2.5 mb-3 fs-8 flex flex-col gap-1.5">
                            <div class="d-flex justify-content-between">
                                <span class="text-muted">Target Posko:</span>
                                <span class="fw-bold text-slate-900"><i
                                        class="bi bi-geo-alt-fill text-danger me-1"></i><?= esc($req['posko_name'] ?? 'Posko Bencana') ?></span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span class="text-muted">Domisili:</span>
                                <span class="fw-semibold text-slate-800"><?= esc($req['provinsi']) ?></span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span class="text-muted">Tgl Lahir:</span>
                                <span
                                    class="fw-semibold text-slate-800"><?= !empty($req['tgl_lahir']) ? date('d M Y', strtotime($req['tgl_lahir'])) : '-' ?></span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span class="text-muted">Waktu Request:</span>
                                <span class="text-muted"><?= date('d M Y H:i', strtotime($req['created_at'])) ?></span>
                            </div>
                        </div>

                        <!-- WhatsApp & Actions -->
                        <div class="d-flex flex-col gap-2">
                            <a href="<?= format_wa_url($req['whatsapp']) ?>" target="_blank"
                                class="btn btn-light border text-emerald-800 btn-sm fw-bold rounded-lg w-100 d-flex align-items-center justify-content-center gap-2 py-2">
                                <i class="bi bi-whatsapp text-success"></i> Chat WhatsApp (<?= esc($req['whatsapp']) ?>)
                            </a>

                            <?php if ($req['status'] === 'pending'): ?>
                                <div class="row g-2">
                                    <div class="col-6">
                                        <form action="<?= site_url('/bpbd/approval-relawan/approve/' . $req['id']) ?>"
                                            method="POST">
                                            <?= csrf_field() ?>
                                            <button type="submit"
                                                class="btn btn-emerald text-white btn-sm fw-bold rounded-lg w-100 py-2 shadow-sm d-flex align-items-center justify-content-center gap-1.5"
                                                style="font-size: 0.775rem;">
                                                <i class="bi bi-check-lg"></i> Setujui
                                            </button>
                                        </form>
                                    </div>
                                    <div class="col-6">
                                        <form action="<?= site_url('/bpbd/approval-relawan/reject/' . $req['id']) ?>" method="POST">
                                            <?= csrf_field() ?>
                                            <button type="submit"
                                                class="btn btn-outline-danger btn-sm fw-semibold rounded-lg w-100 py-2 d-flex align-items-center justify-content-center gap-1.5"
                                                style="font-size: 0.775rem;"
                                                onclick="return confirm('Apakah Anda yakin ingin menolak permohonan relawan ini?')">
                                                <i class="bi bi-x-lg"></i> Tolak
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

</div>
</div>

<style>
    .btn-emerald {
        background-color: #059669;
        color: #ffffff;
        border: none;
        transition: all 0.2s ease;
    }

    .btn-emerald:hover {
        background-color: #047857;
        color: #ffffff;
    }

    .bg-emerald-50 {
        background-color: #ecfdf5;
    }

    .bg-emerald-100 {
        background-color: #d1fae5;
    }

    .text-emerald-700 {
        color: #047857;
    }

    .text-emerald-800 {
        color: #065f46;
    }

    .text-emerald-950 {
        color: #022c22;
    }

    .border-emerald-200 {
        border-color: #a7f3d0 !important;
    }

    .fs-7 {
        font-size: 0.8rem;
    }

    .fs-8 {
        font-size: 0.725rem;
    }

    /* Interactive Stat Cards */
    .filter-stat-card {
        transition: all 0.2s ease;
        border: 2px solid transparent !important;
    }

    .filter-stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.06) !important;
    }

    .filter-stat-card.active {
        border-color: #10b981 !important;
        background-color: #f0fdf4 !important;
    }

    /* Filter Buttons */
    .filter-btn {
        background-color: #f8fafc;
        border: 1px solid #e2e8f0;
        color: #475569;
    }

    .filter-btn:hover {
        background-color: #f1f5f9;
        color: #0f172a;
    }

    .filter-btn.active {
        background-color: #047857;
        border-color: #047857;
        color: #ffffff;
    }

    .filter-btn.active .badge {
        background-color: rgba(255, 255, 255, 0.2) !important;
        color: #ffffff !important;
    }
</style>

<!-- Client-side Interactive Filter & Search Script -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const filterBtns = document.querySelectorAll('.filter-btn, .filter-stat-card');
        const searchInput = document.getElementById('search-input');
        const rows = document.querySelectorAll('.request-item-row');
        const cards = document.querySelectorAll('.request-item-card');

        let currentFilter = 'all';
        let currentSearch = '';

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
            applyFilter();
        });
    });
</script>
<?= $this->endSection() ?>