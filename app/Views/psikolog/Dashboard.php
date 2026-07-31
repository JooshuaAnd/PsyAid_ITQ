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

    <!-- Hero Header Psikolog Workspace Card -->
    <div class="card frost-hero mb-4">
        <div class="card-body p-4 position-relative">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-2">
                <div class="d-flex align-items-center gap-2 flex-wrap">
                    <span class="badge px-3 py-1.5 fs-8 fw-bold"
                        style="background-color: rgba(6, 95, 70, 0.12); color: #065f46; border: 1px solid rgba(6, 95, 70, 0.25);">
                        <i class="bi bi-heart-pulse-fill me-1" style="color: #059669;"></i> CLINICAL WORKSPACE
                    </span>
                    <span class="badge px-3 py-1.5 fs-8"
                        style="background-color: rgba(6, 95, 70, 0.08); color: #047857; border: 1px solid rgba(6, 95, 70, 0.18);">
                        Dokter/Psikolog: <strong><?= esc(session()->get('user_name')) ?></strong>
                    </span>
                </div>
            </div>
            <h3 class="fw-bold mb-1" style="color: #064e3b;">
                <i class="bi bi-heart-pulse-fill me-2" style="color: #059669;"></i> Clinical Workspace Psikolog
            </h3>
            <p class="small mb-0" style="color: #047857; max-width: 75ch;">
                Daftar Penugasan Kasus Penyintas - Dokter/Psikolog:
                <strong><?= esc(session()->get('user_name')) ?></strong>
            </p>
        </div>
    </div>

    <!-- Summary Cards for Psikolog Workspace -->
    <div class="row g-3 mb-4">
        <div class="col-12 col-sm-6 col-md-4">
            <div class="card posko-item-card p-3 p-md-3.5 h-100">
                <div class="text-secondary fs-8 fw-bold text-uppercase" style="letter-spacing: 0.03em;">Kasus High Risk
                    Membutuhkan Review</div>
                <hr class="my-2 opacity-25" style="color: #dc2626;" />
                <?php
                $highCount = count(array_filter($assignedVictims, function ($v) {
                    return $v['risk_level'] === 'high' && empty($v['review_id']);
                }));
                ?>
                <div class="d-flex align-items-baseline justify-content-between mb-1">
                    <div class="fs-3 fw-bold tabular-nums text-danger"><?= $highCount ?> Kasus</div>
                    <?php if ($highCount > 0): ?>
                        <span class="badge bg-danger-subtle text-danger border border-danger-subtle fs-9 fw-bold">Perlu
                            Review</span>
                    <?php endif; ?>
                </div>
                <div class="fs-9 text-muted fw-semibold">Belum Memiliki Review MSE</div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-4">
            <div class="card posko-item-card p-3 p-md-3.5 h-100">
                <div class="text-secondary fs-8 fw-bold text-uppercase" style="letter-spacing: 0.03em;">Total Ditugaskan
                    Kepada Anda</div>
                <hr class="my-2 opacity-25" style="color: #059669;" />
                <div class="fs-3 fw-bold mb-1 tabular-nums" style="color: #064e3b;"><?= count($assignedVictims) ?>
                    Penyintas</div>
                <div class="fs-9 text-muted fw-semibold">Penugasan Active</div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-4">
            <div class="card posko-item-card p-3 p-md-3.5 h-100">
                <div class="text-secondary fs-8 fw-bold text-uppercase" style="letter-spacing: 0.03em;">Telah Di-Review
                    (MSE Complete)</div>
                <hr class="my-2 opacity-25" style="color: #059669;" />
                <?php
                $reviewedCount = count(array_filter($assignedVictims, function ($v) {
                    return !empty($v['review_id']);
                }));
                ?>
                <div class="fs-3 fw-bold mb-1 tabular-nums text-success"><?= $reviewedCount ?> Penyintas</div>
                <div class="fs-9 text-muted fw-semibold">Status MSE Selesai</div>
            </div>
        </div>
    </div>

    <!-- Tabel Daftar Tim Personel Bertugas (Personnel Management Section) -->
    <div class="card posko-item-card p-4 mb-4">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3 border-bottom pb-3">
            <h5 class="fw-bold mb-0 d-flex align-items-center" style="color: #064e3b;">
                <i class="bi bi-people-fill text-success me-2 fs-5"></i> Daftar Tim Personel Bertugas Posko
            </h5>
            <span class="badge px-3 py-1.5 fs-8"
                style="background-color: rgba(6, 95, 70, 0.08); color: #047857; border: 1px solid rgba(6, 95, 70, 0.18);">
                <?= count($personnel ?? []) ?> Personel Bertugas
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

    <!-- Manajemen Assessment (Card Layout) -->
    <div class="card posko-item-card p-4 mb-4">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3 border-bottom pb-3">
            <h5 class="fw-bold mb-0 d-flex align-items-center" style="color: #064e3b;">
                <i class="bi bi-list-task text-success me-2 fs-5"></i> Manajemen Assessment
            </h5>
            <span class="badge px-3 py-1.5 fs-8"
                style="background-color: rgba(6, 95, 70, 0.08); color: #047857; border: 1px solid rgba(6, 95, 70, 0.18);">
                <?= count($assignedVictims) ?> Penyintas
            </span>
        </div>

        <div class="row g-4" id="psychologist-card-container">
            <?php if (empty($assignedVictims)): ?>
                <div class="col-12 empty-state">
                    <div class="text-center py-4 text-muted border rounded" style="background-color: #f8fafc;">
                        <i class="bi bi-inbox fs-3 d-block mb-1 text-emerald-600"></i>
                        Saat ini belum ada penyintas yang ditugaskan kepada Anda.
                    </div>
                </div>
            <?php else: ?>
                <?php foreach ($assignedVictims as $v): ?>
                    <div class="col-12 col-md-6 col-lg-4 psychologist-card-item">
                        <div class="p-3 h-100 d-flex flex-column" style="background: #ffffff; border: 1.5px solid #e2e8f0; border-radius: 8px !important; box-shadow: 0 2px 6px rgba(15, 23, 42, 0.04);">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <div>
                                    <h6 class="fw-bold mb-1" style="color: #064e3b;"><?= esc($v['victim_nama']) ?></h6>
                                    <div class="fs-8 text-muted">
                                        <?= esc($v['jenis_kelamin']) ?> • <?= esc($v['umur']) ?> Thn • NIK: <?= esc($v['nik'] ?? '-') ?>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="small text-muted mb-3 fs-8">
                                <i class="bi bi-geo-alt me-1 text-emerald-600"></i> <?= esc($v['posko_name']) ?>
                            </div>

                            <div class="mb-3 mt-auto">
                                <?php if ($v['risk_level'] === 'high'): ?>
                                    <span class="badge bg-danger-subtle text-danger border border-danger-subtle fs-8 px-2.5 py-1 fw-bold">
                                        <i class="bi bi-exclamation-triangle-fill me-1"></i> HIGH RISK
                                    </span>
                                <?php elseif ($v['risk_level'] === 'medium'): ?>
                                    <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle fs-8 px-2.5 py-1 fw-bold">
                                        <i class="bi bi-dash-circle-fill me-1"></i> MEDIUM RISK
                                    </span>
                                <?php else: ?>
                                    <span class="badge bg-success-subtle text-success border border-success-subtle fs-8 px-2.5 py-1 fw-bold">
                                        <i class="bi bi-check-circle-fill me-1"></i> LOW RISK
                                    </span>
                                <?php endif; ?>
                            </div>
                            
                            <div class="d-flex align-items-center justify-content-between mt-3 border-top pt-3">
                                <div>
                                    <?php if ($v['review_id']): ?>
                                        <span class="badge bg-success-subtle text-success border border-success-subtle fs-8 px-2.5 py-1">
                                            <i class="bi bi-check-all me-1"></i> Reviewed
                                        </span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle fs-8 px-2.5 py-1">
                                            <i class="bi bi-clock-history me-1"></i> AI Generated
                                        </span>
                                    <?php endif; ?>
                                </div>
                                <a href="<?= site_url('/psikolog/assessment-history/detail/' . $v['victim_id']) ?>" class="frost-btn-primary fs-8 text-nowrap">
                                    Detail <i class="bi bi-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <!-- Pagination Assigned Victims -->
        <div id="psychologist-pagination-container" class="frost-pagination-wrapper d-none"></div>
    </div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // CLIENT-SIDE PAGINATION LOGIC
        function initClientPagination(containerId, paginationContainerId, itemsPerPage = 10, itemSelector = 'tr') {
            const containerEl = document.getElementById(containerId);
            const paginationContainer = document.getElementById(paginationContainerId);
            if (!containerEl || !paginationContainer) return;

            const items = Array.from(containerEl.querySelectorAll(itemSelector));
            const validItems = items.filter(item => {
                // Filter out empty state messages
                if (item.tagName.toLowerCase() === 'tr' && item.querySelector('td[colspan]')) return false;
                if (item.classList.contains('empty-state')) return false;
                return true;
            });

            if (validItems.length <= itemsPerPage) {
                paginationContainer.innerHTML = '';
                paginationContainer.classList.add('d-none');
                validItems.forEach(i => i.style.display = '');
                return;
            }

            paginationContainer.classList.remove('d-none');
            let currentPage = 1;
            const totalPages = Math.ceil(validItems.length / itemsPerPage);

            function renderPage(page) {
                currentPage = page;
                const start = (page - 1) * itemsPerPage;
                const end = start + itemsPerPage;

                validItems.forEach((item, idx) => {
                    if (idx >= start && idx < end) {
                        item.style.display = '';
                    } else {
                        item.style.display = 'none';
                    }
                });

                const displayedEnd = Math.min(end, validItems.length);
                const infoHtml = `<span class="frost-pagination-info">Menampilkan <strong class="text-dark">${start + 1} - ${displayedEnd}</strong> dari <strong class="text-dark">${validItems.length}</strong> Data</span>`;

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

                paginationContainer.innerHTML = infoHtml + navHtml;

                paginationContainer.querySelectorAll('.frost-page-btn[data-page]').forEach(btn => {
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

        initClientPagination('personnel-tbody', 'personnel-pagination-container', 10, 'tr');
        initClientPagination('psychologist-card-container', 'psychologist-pagination-container', 6, '.psychologist-card-item');
    });
</script>
<?= $this->endSection() ?>