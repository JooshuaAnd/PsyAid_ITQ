<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="row mb-4 align-items-center">
    <div class="col">
        <h3 class="fw-bold text-dark mb-1">
            <i class="bi bi-diagram-3-fill text-primary me-2"></i> Auto-Mapping & Penugasan Psikolog Posko
        </h3>
        <p class="text-muted small mb-0">Manajemen Beban Kerja Personel Psikolog & Distribusi Kasus Penyintas</p>
    </div>
</div>

<div class="row g-4">
    <?php foreach ($mappingData as $data): ?>
        <?php $posko = $data['posko']; ?>
        <div class="col-12 col-md-6 col-lg-4">
            <div class="card card-custom bg-white h-100 shadow-sm border">
                <div class="card-header bg-light py-3 d-flex align-items-center justify-content-between">
                    <h6 class="fw-bold text-dark mb-0"><i class="bi bi-geo-alt-fill text-danger me-1"></i> <?= esc($posko['name']) ?></h6>
                    <span class="badge bg-secondary"><?= esc($posko['jenis_bencana']) ?></span>
                </div>
                <div class="card-body p-3">
                    <div class="small text-muted mb-3"><i class="bi bi-people me-1"></i> Tim Psikolog Bertugas di Posko Ini:</div>

                    <?php if (empty($data['psychologists'])): ?>
                        <div class="text-center py-3 text-muted small bg-light rounded border">
                            <i class="bi bi-person-x fs-4 d-block mb-1"></i>
                            Belum ada psikolog khusus yang ditugaskan di posko ini.
                        </div>
                    <?php else: ?>
                        <div class="d-flex flex-column gap-2">
                            <?php foreach ($data['psychologists'] as $p): ?>
                                <div class="p-3 bg-light rounded border border-primary border-opacity-25">
                                    <div class="d-flex align-items-center justify-content-between mb-1">
                                        <strong class="text-primary small"><i class="bi bi-heart-pulse-fill me-1"></i> <?= esc($p['name']) ?></strong>
                                        <span class="badge bg-primary fs-8"><?= $p['active_unreviewed'] ?> Kasus Aktif</span>
                                    </div>
                                    <div class="fs-8 text-muted d-flex justify-content-between">
                                        <span>Total Pernah Ditugaskan:</span>
                                        <strong class="text-dark"><?= $p['total_assigned'] ?> Penyintas</strong>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<?= $this->endSection() ?>
