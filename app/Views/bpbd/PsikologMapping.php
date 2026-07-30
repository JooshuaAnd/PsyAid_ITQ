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

    /* Status Badges */
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

    <!-- 1. Hero Header Card (Matching BPBD Command Center Theme) -->
    <div class="card frost-hero mb-4">
        <div class="card-body p-4 position-relative">
            <div class="row align-items-center g-3">
                <div class="col-12 col-lg-8">
                    <div class="d-flex align-items-center gap-2 mb-2 flex-wrap">
                        <span class="badge px-3 py-1.5 fs-8 fw-bold"
                            style="background-color: rgba(6, 95, 70, 0.12); color: #065f46; border: 1px solid rgba(6, 95, 70, 0.25); border-radius: 8px !important;">
                            <i class="bi bi-shield-check me-1"></i> KHUSUS BPBD ADMIN
                        </span>
                        <span class="badge px-3 py-1.5 fs-8"
                            style="background-color: rgba(6, 95, 70, 0.08); color: #047857; border: 1px solid rgba(6, 95, 70, 0.18); border-radius: 8px !important;">
                            Management &amp; Workload Distribution
                        </span>
                    </div>
                    <h3 class="fw-bold mb-1" style="color: #064e3b;">
                        <i class="bi bi-diagram-3-fill me-2" style="color: #059669;"></i> Auto-Mapping &amp; Penugasan
                        Psikolog Posko
                    </h3>
                    <p class="small mb-0" style="color: #047857; max-width: 75ch;">
                        Manajemen beban kerja personel psikolog klinis &amp; distribusi kasus pendampingan penyintas di
                        setiap posko bencana daerah.
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

    <!-- 2. Posko & Psychologist Mapping Grid -->
    <div class="row g-4">
        <?php foreach ($mappingData as $data): ?>
            <?php $posko = $data['posko']; ?>
            <div class="col-12 col-md-6 col-lg-4">
                <div
                    class="card posko-item-card bg-white h-100 shadow-sm overflow-hidden d-flex flex-column justify-content-between">
                    <div>
                        <!-- Card Header: Posko Name & Bencana Badge Below -->
                        <div class="card-header bg-transparent border-bottom px-3.5 py-3 d-flex flex-column gap-2"
                            style="border-color: rgba(209, 250, 229, 0.8) !important;">
                            <div class="d-flex align-items-start gap-2">
                                <i class="bi bi-geo-alt-fill text-danger fs-6 flex-shrink-0 mt-0.5"></i>
                                <h6 class="fw-bold text-dark mb-0"
                                    style="color: #064e3b !important; font-size: 0.9375rem; line-height: 1.4; word-break: break-word;">
                                    <?= esc($posko['name']) ?>
                                </h6>
                            </div>
                            <div class="ms-4 ps-0.5">
                                <span class="badge badge-mag-low px-2.5 py-1 fs-8 fw-bold"
                                    style="border-radius: 8px !important;">
                                    <?= esc($posko['jenis_bencana']) ?>
                                </span>
                            </div>
                        </div>

                        <!-- Card Body: Assigned Psychologists -->
                        <div class="card-body p-3.5">
                            <div
                                class="small fw-semibold text-muted mb-3 d-flex align-items-center justify-content-between flex-wrap gap-2">
                                <span class="d-inline-flex align-items-center gap-2">
                                    <i class="bi bi-people-fill text-emerald-600 me-1.5 fs-7"></i> <span>Tim Psikolog
                                        Bertugas:</span>
                                </span>
                                <span class="badge bg-secondary-subtle text-dark fs-9 fw-bold"
                                    style="border-radius: 8px !important;">
                                    <?= count($data['psychologists']) ?> Psikolog
                                </span>
                            </div>

                            <?php if (empty($data['psychologists'])): ?>
                                <div class="text-center py-4 text-muted small rounded border"
                                    style="background: rgba(244, 251, 247, 0.6); border-color: #d1fae5 !important; border-radius: 8px !important;">
                                    <i class="bi bi-person-x fs-3 d-block mb-1 text-slate-400"></i>
                                    Belum ada psikolog khusus yang ditugaskan di posko ini.
                                </div>
                            <?php else: ?>
                                <div class="d-flex flex-column gap-2.5">
                                    <?php foreach ($data['psychologists'] as $p): ?>
                                        <div class="p-3 rounded"
                                            style="background: rgba(244, 251, 247, 0.75); border: 1px solid #d1fae5; border-radius: 8px !important;">
                                            <div class="d-flex align-items-start justify-content-between gap-2 mb-2">
                                                <div class="d-flex align-items-start gap-2">
                                                    <i class="bi bi-heart-pulse-fill text-emerald-600 flex-shrink-0 mt-0.5"
                                                        style="font-size: 0.875rem;"></i>
                                                    <div>
                                                        <div class="fw-bold fs-8"
                                                            style="color: #064e3b !important; line-height: 1.35;">
                                                            <?= esc($p['name']) ?></div>
                                                        <div class="fs-9 text-muted"><i
                                                                class="bi bi-envelope me-1"></i><?= esc($p['email']) ?></div>
                                                    </div>
                                                </div>
                                                <span class="badge badge-mag-medium px-2 py-1 fs-9 fw-bold flex-shrink-0"
                                                    style="border-radius: 6px !important;">
                                                    <?= $p['active_unreviewed'] ?> Kasus Aktif
                                                </span>
                                            </div>
                                            <div class="fs-9 text-muted d-flex justify-content-between align-items-center pt-2 border-top"
                                                style="border-color: rgba(209, 250, 229, 0.7) !important;">
                                                <span>Total Pernah Ditugaskan:</span>
                                                <strong class="text-dark fw-bold"><?= $p['total_assigned'] ?> Penyintas</strong>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Card Footer: Edit Button -->
                    <div class="card-footer bg-transparent border-top p-3"
                        style="border-color: rgba(209, 250, 229, 0.8) !important;">
                        <button type="button" class="frost-btn-primary w-100 justify-content-center py-2 fs-8"
                            data-bs-toggle="modal" data-bs-target="#editMappingModal<?= $posko['id'] ?>">
                            <i class="bi bi-pencil-square me-1"></i> Edit Penugasan Psikolog
                        </button>
                    </div>
                </div>
            </div>

            <!-- Modal Atur Penugasan Psikolog per Posko -->
            <div class="modal fade" id="editMappingModal<?= $posko['id'] ?>" tabindex="-1"
                aria-labelledby="editMappingModalLabel<?= $posko['id'] ?>" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content border-0 shadow-2xl overflow-hidden" style="border-radius: 8px !important;">

                        <!-- Modal Header -->
                        <div class="modal-header text-white border-0 p-3.5" style="background-color: #047857;">
                            <h5 class="modal-title h6 fw-bold mb-0 d-flex align-items-center gap-2"
                                id="editMappingModalLabel<?= $posko['id'] ?>">
                                <i class="bi bi-person-gear fs-5"></i> Atur Penugasan Psikolog - <?= esc($posko['name']) ?>
                            </h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>

                        <!-- Modal Body & Form -->
                        <form action="<?= site_url('/bpbd/psychologist-mapping/update/' . $posko['id']) ?>" method="POST">
                            <?= csrf_field() ?>
                            <div class="modal-body p-4 bg-white text-slate-900">

                                <!-- Information Banner -->
                                <div class="px-4 py-3.5 mb-4 rounded border d-flex align-items-start gap-3"
                                    style="background: #ecfdf5; border-color: #a7f3d0 !important; border-radius: 8px !important;">
                                    <div class="pt-0.5 pe-1 flex-shrink-0">
                                        <i class="bi bi-info-circle-fill text-emerald-600 fs-5"></i>
                                    </div>
                                    <div class="fs-8 text-slate-700" style="line-height: 1.55;">
                                        <strong class="d-block text-emerald-950 mb-1" style="font-size: 0.8125rem;">Petunjuk
                                            Penugasan Personel:</strong>
                                        Pilih personel psikolog klinis yang akan ditugaskan di
                                        <strong><?= esc($posko['name']) ?></strong> (<?= esc($posko['jenis_bencana']) ?>).
                                        Hilangkan centang jika ingin memindahkan atau mengosongkan penugasan personel.
                                    </div>
                                </div>

                                <div class="fw-bold text-dark fs-8 text-uppercase mt-4 mb-2.5 pt-1"
                                    style="letter-spacing: 0.03em; color: #064e3b !important;">
                                    Daftar Seluruh Psikolog Terdaftar Sistem:
                                </div>

                                <?php if (empty($allPsychologists)): ?>
                                    <div class="text-center py-4 text-muted small bg-light rounded border"
                                        style="border-radius: 8px !important;">
                                        <i class="bi bi-emoji-frown fs-3 d-block mb-1 text-slate-400"></i>
                                        Belum ada akun psikolog yang terdaftar di sistem.
                                    </div>
                                <?php else: ?>
                                    <div class="d-flex flex-column gap-2.5" style="max-height: 340px; overflow-y: auto;">
                                        <?php foreach ($allPsychologists as $psych): ?>
                                            <?php
                                            $isAssignedToThisPosko = ((int) $psych['posko_id'] === (int) $posko['id']);
                                            ?>
                                            <label
                                                class="p-3 rounded border d-flex align-items-start justify-content-between gap-3 cursor-pointer user-select-none transition-all hover:bg-slate-50"
                                                style="border-color: <?= $isAssignedToThisPosko ? '#34d399' : '#cbd5e1' ?> !important; background-color: <?= $isAssignedToThisPosko ? '#f4fbf7' : '#ffffff' ?>; border-radius: 8px !important;">
                                                <div class="d-flex align-items-start gap-3 flex-grow-1" style="min-width: 0;">
                                                    <input class="form-check-input flex-shrink-0 mt-1" type="checkbox"
                                                        name="psychologist_ids[]" value="<?= $psych['id'] ?>"
                                                        <?= $isAssignedToThisPosko ? 'checked' : '' ?>
                                                        style="width: 1.2rem; height: 1.2rem; cursor: pointer; accent-color: #059669;">
                                                    <div style="min-width: 0;" class="flex-grow-1">
                                                        <div class="fw-bold text-dark fs-8 mb-1"
                                                            style="color: #064e3b !important; line-height: 1.3;">
                                                            <?= esc($psych['name']) ?>
                                                        </div>
                                                        <div class="fs-9 text-muted d-flex align-items-center gap-1 text-truncate">
                                                            <i class="bi bi-envelope flex-shrink-0 me-0.5"></i>
                                                            <span class="text-truncate"><?= esc($psych['email']) ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="flex-shrink-0 ms-2 text-end">
                                                    <?php if ($isAssignedToThisPosko): ?>
                                                        <span class="badge badge-mag-low px-2.5 py-1.5 fs-9 fw-bold"
                                                            style="border-radius: 6px !important;">
                                                            <i class="bi bi-check-circle-fill me-1"></i> Ditugaskan
                                                        </span>
                                                    <?php elseif (!empty($psych['posko_id'])): ?>
                                                        <span
                                                            class="badge bg-secondary-subtle text-secondary px-2.5 py-1.5 fs-9 fw-semibold"
                                                            style="border-radius: 6px !important;">
                                                            <i class="bi bi-geo-alt me-1"></i> Posko Lain
                                                        </span>
                                                    <?php else: ?>
                                                        <span class="badge bg-light text-muted border px-2.5 py-1.5 fs-9"
                                                            style="border-radius: 6px !important;">
                                                            Belum Ditugaskan
                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                            </label>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>

                            </div>
                            <div class="modal-footer bg-slate-50 border-top p-3 d-flex align-items-center justify-content-between"
                                style="border-color: #e2e8f0 !important;">
                                <button type="button"
                                    class="btn btn-light border text-slate-700 btn-sm fw-semibold px-3.5 py-2"
                                    style="border-radius: 8px !important;" data-bs-dismiss="modal">
                                    Batal
                                </button>
                                <button type="submit" class="frost-btn-primary py-2 px-4 fs-8">
                                    <i class="bi bi-check-circle-fill me-1"></i> Simpan Penugasan Tim
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

</div>
<?= $this->endSection() ?>