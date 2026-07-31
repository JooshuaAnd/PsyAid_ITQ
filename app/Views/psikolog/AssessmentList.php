<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<style>
    .assessment-hero,
    .posko-item-card,
    .assessment-item-card,
    .assessment-empty-state,
    .btn,
    .badge,
    .alert {
        border-radius: 8px !important;
    }

    .tabular-nums {
        font-variant-numeric: tabular-nums;
        font-feature-settings: "tnum";
    }

    .fs-8 {
        font-size: 0.75rem;
    }

    .fs-9 {
        font-size: 0.6875rem;
    }

    .assessment-hero {
        background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 60%, #a7f3d0 100%);
        border: 1.5px solid #a7f3d0;
        color: #064e3b;
        position: relative;
        overflow: hidden;
        box-shadow: 0 10px 30px -4px rgba(16, 185, 129, 0.12), inset 0 1.5px 2px rgba(255, 255, 255, 0.85);
    }

    .posko-item-card {
        background: #ffffff !important;
        border: 1.5px solid #d1fae5 !important;
        box-shadow: 0 4px 12px -2px rgba(16, 185, 129, 0.08), 0 2px 5px -1px rgba(15, 23, 42, 0.04) !important;
        transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1) !important;
    }

    .posko-item-card:hover {
        background: #ffffff !important;
        border-color: #34d399 !important;
        box-shadow: 0 12px 28px -4px rgba(16, 185, 129, 0.18), 0 4px 10px -2px rgba(15, 23, 42, 0.04) !important;
        transform: translateY(-2px) !important;
    }

    .assessment-card-header {
        border-bottom: 1.5px solid #e2e8f0;
        padding-bottom: 1rem;
        margin-bottom: 1rem;
    }

    .assessment-card-title,
    .victim-title {
        color: #064e3b;
    }

    .assessment-count-badge {
        background-color: rgba(6, 95, 70, 0.08) !important;
        color: #047857 !important;
        border: 1px solid rgba(6, 95, 70, 0.18) !important;
    }

    .assessment-item-card {
        background: #ffffff;
        border: 1.5px solid #d1fae5;
        box-shadow: 0 4px 12px -2px rgba(16, 185, 129, 0.07), 0 2px 5px -1px rgba(15, 23, 42, 0.035);
        transition: all 0.22s ease;
    }

    .assessment-item-card:hover {
        border-color: #34d399;
        box-shadow: 0 10px 22px -4px rgba(16, 185, 129, 0.16), 0 4px 10px -2px rgba(15, 23, 42, 0.04);
        transform: translateY(-2px);
    }

    .victim-meta,
    .victim-posko {
        color: #64748b;
    }

    .assessment-divider {
        border-top: 1.5px solid #e2e8f0;
    }

    .soft-badge {
        border: 1px solid transparent !important;
        font-size: 0.75rem !important;
        font-weight: 700 !important;
        padding: 0.4rem 0.65rem !important;
        white-space: normal;
    }

    .soft-badge-success {
        background-color: #ecfdf5 !important;
        color: #047857 !important;
        border-color: #a7f3d0 !important;
    }

    .soft-badge-danger {
        background-color: #fef2f2 !important;
        color: #dc2626 !important;
        border-color: #fecdd3 !important;
    }

    .soft-badge-warning {
        background-color: #fffbeb !important;
        color: #b45309 !important;
        border-color: #fde68a !important;
    }

    .soft-badge-neutral {
        background-color: #f8fafc !important;
        color: #64748b !important;
        border-color: #e2e8f0 !important;
    }

    .btn-frost {
        background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
        color: #065f46 !important;
        border: 1.5px solid #34d399;
        font-weight: 700;
        font-size: 0.8125rem;
        padding: 0.45rem 0.95rem;
        transition: all 0.2s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        box-shadow: 0 2px 6px rgba(16, 185, 129, 0.15);
    }

    .btn-frost:hover {
        background: linear-gradient(135deg, #a7f3d0 0%, #6ee7b7 100%);
        color: #064e3b !important;
        border-color: #10b981;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.25);
        transform: translateY(-1px);
    }

    .assessment-empty-state {
        background-color: #f8fafc;
        border: 1.5px solid #e2e8f0;
        padding: 1.5rem;
    }

    .frost-pagination-wrapper {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 0.75rem;
        margin-top: 1.5rem;
        padding-top: 1.5rem;
        border-top: 1.5px solid #e2e8f0;
    }

    .frost-pagination-info {
        font-size: 0.8125rem;
        font-weight: 600;
        color: #64748b;
    }

    .frost-pagination-nav {
        display: flex;
        align-items: center;
        gap: 0.35rem;
        flex-wrap: wrap;
    }

    .frost-page-btn {
        background: #ffffff;
        border: 1.5px solid #a7f3d0;
        color: #065f46;
        font-weight: 700;
        font-size: 0.8125rem;
        padding: 0.35rem 0.85rem;
        border-radius: 8px !important;
        transition: all 0.2s ease;
    }

    .frost-page-btn:hover:not(.disabled):not(.active) {
        background: #ecfdf5;
        border-color: #34d399;
        color: #064e3b;
    }

    .frost-page-btn.active {
        background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
        border-color: #34d399;
        color: #064e3b;
    }

    .frost-page-btn.disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }

    @media (max-width: 575.98px) {
        .assessment-hero .card-body,
        .posko-item-card {
            padding: 1.15rem !important;
        }

        .assessment-card-header {
            align-items: flex-start !important;
        }

        .btn-frost {
            width: 100%;
            justify-content: center;
        }

        .frost-pagination-wrapper {
            justify-content: center;
            text-align: center;
        }
    }
</style>

<?php
$assignedVictims = $assignedVictims ?? [];
$highRiskCount = count(array_filter($assignedVictims, static fn($v) => strtolower($v['risk_level'] ?? '') === 'high'));
$reviewedCount = count(array_filter($assignedVictims, static fn($v) => !empty($v['review_id'])));
?>

<div class="container-fluid px-0">

    <div class="card assessment-hero mb-4">
        <div class="card-body p-4">
            <div class="d-flex align-items-center gap-2 flex-wrap mb-2">
                <span class="badge assessment-count-badge px-3 py-1.5 fs-8 fw-bold">
                    <i class="bi bi-file-earmark-medical-fill me-1"></i> ASSESSMENT HISTORY
                </span>
                <span class="badge assessment-count-badge px-3 py-1.5 fs-8">
                    <?= count($assignedVictims) ?> Penyintas Ditugaskan
                </span>
            </div>
            <h3 class="fw-bold mb-1" style="color: #064e3b;">
                <i class="bi bi-clipboard2-pulse-fill me-2" style="color: #059669;"></i> Data Assessment Penyintas
            </h3>
            <p class="small mb-0" style="color: #047857; max-width: 75ch;">
                Riwayat assessment klinis penyintas yang ditugaskan kepada Anda, termasuk status review dan level risiko.
            </p>
        </div>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-12 col-sm-4">
            <div class="card posko-item-card p-3 h-100">
                <div class="text-secondary fs-8 fw-bold text-uppercase" style="letter-spacing: 0.03em;">Total Assessment</div>
                <hr class="my-2 opacity-25" style="color: #059669;" />
                <div class="fs-3 fw-bold tabular-nums" style="color: #064e3b;"><?= count($assignedVictims) ?></div>
                <div class="fs-9 text-muted fw-semibold">Penyintas dalam penugasan</div>
            </div>
        </div>
        <div class="col-12 col-sm-4">
            <div class="card posko-item-card p-3 h-100">
                <div class="text-secondary fs-8 fw-bold text-uppercase" style="letter-spacing: 0.03em;">High Risk</div>
                <hr class="my-2 opacity-25" style="color: #dc2626;" />
                <div class="fs-3 fw-bold tabular-nums text-danger"><?= $highRiskCount ?></div>
                <div class="fs-9 text-muted fw-semibold">Membutuhkan perhatian prioritas</div>
            </div>
        </div>
        <div class="col-12 col-sm-4">
            <div class="card posko-item-card p-3 h-100">
                <div class="text-secondary fs-8 fw-bold text-uppercase" style="letter-spacing: 0.03em;">Sudah Direview</div>
                <hr class="my-2 opacity-25" style="color: #059669;" />
                <div class="fs-3 fw-bold tabular-nums text-success"><?= $reviewedCount ?></div>
                <div class="fs-9 text-muted fw-semibold">Review MSE telah tersimpan</div>
            </div>
        </div>
    </div>

    <div class="card posko-item-card p-4 mb-4">
        <div class="assessment-card-header d-flex align-items-center justify-content-between flex-wrap gap-2">
            <h5 class="assessment-card-title fw-bold mb-0 d-flex align-items-center">
                <i class="bi bi-file-earmark-medical-fill text-success me-2 fs-5"></i> Data Assessment Penyintas
            </h5>
            <span class="badge assessment-count-badge px-3 py-1.5 fs-8">
                <?= count($assignedVictims) ?> Penyintas
            </span>
        </div>

        <div class="row g-4" id="assessment-card-container">
            <?php if (empty($assignedVictims)): ?>
                <div class="col-12 empty-state">
                    <div class="assessment-empty-state text-center text-muted">
                        <i class="bi bi-inbox fs-3 d-block mb-1 text-success"></i>
                        Saat ini belum ada data assessment yang tersedia.
                    </div>
                </div>
            <?php else: ?>
                <?php foreach ($assignedVictims as $v): ?>
                    <?php $riskLevel = strtolower($v['risk_level'] ?? 'low'); ?>
                    <div class="col-12 col-md-6 col-lg-4 assessment-card-item">
                        <div class="assessment-item-card p-3 h-100 d-flex flex-column">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <div>
                                    <h6 class="victim-title fw-bold mb-1"><?= esc($v['victim_nama']) ?></h6>
                                    <div class="victim-meta fs-8">
                                        <?= esc($v['jenis_kelamin']) ?> &bull; <?= esc($v['umur']) ?> Thn &bull; NIK: <?= esc($v['nik'] ?? '-') ?>
                                    </div>
                                </div>
                            </div>

                            <div class="victim-posko small mb-3 fs-8">
                                <i class="bi bi-geo-alt me-1 text-success"></i> <?= esc($v['posko_name']) ?>
                            </div>

                            <div class="mb-3 mt-auto">
                                <?php if ($riskLevel === 'high'): ?>
                                    <span class="badge soft-badge soft-badge-danger">
                                        <i class="bi bi-exclamation-triangle-fill me-1"></i> HIGH RISK
                                    </span>
                                <?php elseif ($riskLevel === 'medium'): ?>
                                    <span class="badge soft-badge soft-badge-warning">
                                        <i class="bi bi-dash-circle-fill me-1"></i> MEDIUM RISK
                                    </span>
                                <?php else: ?>
                                    <span class="badge soft-badge soft-badge-success">
                                        <i class="bi bi-check-circle-fill me-1"></i> LOW RISK
                                    </span>
                                <?php endif; ?>
                            </div>

                            <div class="assessment-divider d-flex align-items-center justify-content-between gap-2 flex-wrap mt-3 pt-3">
                                <div>
                                    <?php if ($v['review_id']): ?>
                                        <span class="badge soft-badge soft-badge-success">
                                            <i class="bi bi-check-all me-1"></i> Direview
                                        </span>
                                    <?php else: ?>
                                        <span class="badge soft-badge soft-badge-neutral">
                                            <i class="bi bi-clock-history me-1"></i> AI Generated
                                        </span>
                                    <?php endif; ?>
                                </div>
                                <a href="<?= site_url('/psikolog/assessment-history/detail/' . $v['victim_id']) ?>" class="btn btn-sm btn-frost text-nowrap">
                                    Detail <i class="bi bi-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <div id="assessment-pagination-container" class="frost-pagination-wrapper d-none"></div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        function initClientPagination(containerId, paginationContainerId, itemsPerPage = 10, itemSelector = 'tr') {
            const containerEl = document.getElementById(containerId);
            const paginationContainer = document.getElementById(paginationContainerId);
            if (!containerEl || !paginationContainer) return;

            const items = Array.from(containerEl.querySelectorAll(itemSelector));
            const validItems = items.filter(item => {
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
                    item.style.display = idx >= start && idx < end ? '' : 'none';
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

        initClientPagination('assessment-card-container', 'assessment-pagination-container', 6, '.assessment-card-item');
    });
</script>
<?= $this->endSection() ?>
