<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="row mb-4 align-items-center">
    <div class="col">
        <h3 class="fw-bold text-dark mb-1">
            <i class="bi bi-heart-pulse-fill text-primary me-2"></i> Clinical Workspace Psikolog
        </h3>
        <p class="text-muted small mb-0">Daftar Penugasan Kasus Penyintas — Dokter/Psikolog: <strong><?= esc(session()->get('user_name')) ?></strong></p>
    </div>
    <div class="col-auto">
        <a href="<?= site_url('/psychologist-mapping') ?>" class="btn btn-outline-primary btn-sm">
            <i class="bi bi-diagram-3 me-1"></i> Tinjau Mapping Posko
        </a>
    </div>
</div>

<!-- Summary Cards for Psikolog Workspace -->
<div class="row g-3 mb-4">
    <div class="col-12 col-sm-6 col-md-4">
        <div class="card card-custom bg-white p-3 border-start border-4 border-danger h-100">
            <div class="text-muted small fw-semibold text-uppercase">Kasus High Risk Membutuhkan Review</div>
            <?php 
            $highCount = count(array_filter($assignedVictims, function($v) {
                return $v['risk_level'] === 'high' && empty($v['review_id']);
            }));
            ?>
            <div class="fs-2 fw-bold text-danger mt-1"><?= $highCount ?> Kasus</div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-4">
        <div class="card card-custom bg-white p-3 border-start border-4 border-primary h-100">
            <div class="text-muted small fw-semibold text-uppercase">Total Ditugaskan Kepada Anda</div>
            <div class="fs-2 fw-bold text-primary mt-1"><?= count($assignedVictims) ?> Penyintas</div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-4">
        <div class="card card-custom bg-white p-3 border-start border-4 border-success h-100">
            <div class="text-muted small fw-semibold text-uppercase">Telah Di-Review (MSE Complete)</div>
            <?php 
            $reviewedCount = count(array_filter($assignedVictims, function($v) {
                return ! empty($v['review_id']);
            }));
            ?>
            <div class="fs-2 fw-bold text-success mt-1"><?= $reviewedCount ?> Penyintas</div>
        </div>
    </div>
</div>

<!-- Table Assigned Victims for Psikolog -->
<div class="card card-custom bg-white p-4 shadow-sm mb-4">
    <div class="d-flex align-items-center justify-content-between mb-3">
        <h5 class="fw-bold text-dark mb-0">
            <i class="bi bi-list-task text-primary me-2"></i> Daftar Penyintas Ter-Assign (Ditinjau Berdasarkan Prioritas Risiko)
        </h5>
        <span class="badge bg-light text-dark border px-3 py-2">
            <?= count($assignedVictims) ?> Penugasan Active
        </span>
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0" id="psychologist-table">
            <thead class="table-light text-muted small text-uppercase">
                <tr>
                    <th style="width: 5%;">No</th>
                    <th style="width: 25%;">Nama & NIK</th>
                    <th style="width: 15%;">Posko</th>
                    <th style="width: 15%;">AI Risk Level</th>
                    <th style="width: 15%;">Clinical Priority</th>
                    <th style="width: 12%;">Status Review</th>
                    <th style="width: 13%;" class="text-end">Aksi Klinis</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($assignedVictims)): ?>
                    <tr>
                        <td colspan="7" class="text-center py-4 text-muted">
                            <i class="bi bi-inbox fs-3 d-block mb-1"></i>
                            Saat ini belum ada penyintas yang ditugaskan kepada Anda.
                        </td>
                    </tr>
                <?php else: ?>
                    <?php $no = 1; foreach ($assignedVictims as $v): ?>
                        <tr class="<?= $v['risk_level'] === 'high' && empty($v['review_id']) ? 'table-danger bg-opacity-10' : '' ?>">
                            <td class="fw-bold text-muted"><?= $no++ ?></td>
                            <td>
                                <a href="<?= site_url('/psychologist-review/' . $v['victim_id']) ?>" class="fw-bold text-dark text-decoration-none hover-danger">
                                    <?= esc($v['victim_nama']) ?>
                                </a>
                                <div class="fs-8 text-muted"><?= esc($v['jenis_kelamin']) ?> • <?= esc($v['umur']) ?> Thn • NIK: <?= esc($v['nik'] ?? '-') ?></div>
                            </td>
                            <td class="small text-muted">
                                <i class="bi bi-geo-alt me-1"></i> <?= esc($v['posko_name']) ?>
                            </td>
                            <td>
                                <?php if ($v['risk_level'] === 'high'): ?>
                                    <span class="badge bg-danger fs-7 px-2 py-1"><i class="bi bi-exclamation-triangle-fill me-1"></i> HIGH RISK</span>
                                <?php elseif ($v['risk_level'] === 'medium'): ?>
                                    <span class="badge bg-warning text-dark fs-7 px-2 py-1"><i class="bi bi-dash-circle-fill me-1"></i> MEDIUM RISK</span>
                                <?php else: ?>
                                    <span class="badge bg-info text-dark fs-7 px-2 py-1"><i class="bi bi-check-circle-fill me-1"></i> LOW RISK</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <span class="badge bg-light text-dark border fw-semibold">
                                    <?= esc($v['clinical_priority'] ?? 'Normal') ?>
                                </span>
                            </td>
                            <td>
                                <?php if ($v['review_id']): ?>
                                    <span class="badge bg-success"><i class="bi bi-check-all me-1"></i> Reviewed</span>
                                <?php else: ?>
                                    <span class="badge bg-secondary"><i class="bi bi-clock-history me-1"></i> AI Generated</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-end">
                                <a href="<?= site_url('/psychologist-review/' . $v['victim_id']) ?>" class="btn btn-sm btn-primary px-3 py-1">
                                    <i class="bi bi-clipboard-pulse me-1"></i> Review MSE
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>
