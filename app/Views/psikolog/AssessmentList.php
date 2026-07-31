<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<style>
    /* Strict Max Rounded 8px Policy for matching PsyAid theme */
    .frost-card,
    .frost-hero,
    .frost-btn-primary,
    .posko-item-card,
    .badge,
    .card {
        border-radius: 8px !important;
    }

    /* LIGHT GREEN BUTTON: PRIMARY ACTION */
    .frost-btn-primary {
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
        cursor: pointer;
    }

    .frost-btn-primary:hover {
        background: linear-gradient(135deg, #a7f3d0 0%, #6ee7b7 100%);
        color: #064e3b !important;
        border-color: #10b981;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.25);
        transform: translateY(-1px);
    }

    /* POSKO ITEM CARD: SOFT MINT & PURE WHITE DISTINCT SURFACE */
    .posko-item-card {
        background: #ffffff !important;
        border: 1.5px solid #d1fae5 !important;
        box-shadow: 0 4px 12px -2px rgba(16, 185, 129, 0.08), 0 2px 5px -1px rgba(15, 23, 42, 0.04) !important;
        transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1) !important;
    }

    .posko-item-card:hover {
        border-color: #34d399 !important;
        box-shadow: 0 12px 28px -4px rgba(16, 185, 129, 0.18), 0 4px 10px -2px rgba(15, 23, 42, 0.04) !important;
        transform: translateY(-2px) !important;
    }

    /* Pagination Styling matching Relawan page */
    .frost-pagination-wrapper {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 1.5rem;
        padding-top: 1.5rem;
        border-top: 1.5px solid #e2e8f0;
    }

    .frost-pagination-info {
        font-size: 0.875rem;
        color: #64748b;
    }

    .frost-pagination-nav {
        display: flex;
        gap: 0.35rem;
    }

    .frost-page-btn {
        background: #ffffff;
        border: 1.5px solid #e2e8f0;
        color: #475569;
        font-weight: 600;
        font-size: 0.875rem;
        padding: 0.35rem 0.85rem;
        border-radius: 6px;
        transition: all 0.2s ease;
    }

    .frost-page-btn:hover:not(.disabled):not(.active) {
        background: #f8fafc;
        border-color: #cbd5e1;
        color: #0f172a;
    }

    .frost-page-btn.active {
        background: #059669;
        border-color: #059669;
        color: #ffffff;
    }

    .frost-page-btn.disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }
</style>

<div class="container-fluid py-4">

    <!-- Card Layout -->
    <div class="card posko-item-card p-4 mb-4">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3 border-bottom pb-3">
            <h5 class="fw-bold mb-0 d-flex align-items-center" style="color: #064e3b;">
                <i class="bi bi-file-earmark-medical-fill text-success me-2 fs-5"></i> Data Assessment Penyintas
            </h5>
            <span class="badge px-3 py-1.5 fs-8"
                style="background-color: rgba(6, 95, 70, 0.08); color: #047857; border: 1px solid rgba(6, 95, 70, 0.18);">
                <?= count($assignedVictims) ?> Penyintas
            </span>
        </div>

        <div class="row g-4" id="assessment-card-container">
            <?php if (empty($assignedVictims)): ?>
                <div class="col-12 empty-state">
                    <div class="text-center py-4 text-muted border rounded" style="background-color: #f8fafc;">
                        <i class="bi bi-inbox fs-3 d-block mb-1 text-emerald-600"></i>
                        Saat ini belum ada data assessment yang tersedia.
                    </div>
                </div>
            <?php else: ?>
                <?php foreach ($assignedVictims as $v): ?>
                    <div class="col-12 col-md-6 col-lg-4 assessment-card-item">
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
                                            <i class="bi bi-check-all me-1"></i> Direview
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
        <div id="assessment-pagination-container" class="frost-pagination-wrapper d-none"></div>
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

        initClientPagination('assessment-card-container', 'assessment-pagination-container', 6, '.assessment-card-item');
    });
</script>
<?= $this->endSection() ?>
