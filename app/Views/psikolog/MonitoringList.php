<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<style>
    .frost-hero, .posko-item-card, .btn, .badge, .table-responsive, .alert { border-radius: 8px !important; }
    .frost-hero { background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 60%, #a7f3d0 100%); border: 1.5px solid #a7f3d0; color: #064e3b; position: relative; overflow: hidden; box-shadow: 0 10px 30px -4px rgba(16, 185, 129, 0.12), inset 0 1.5px 2px rgba(255, 255, 255, 0.85); border-radius: 8px !important; }
    .posko-item-card { background: #ffffff !important; border: 1.5px solid #d1fae5 !important; box-shadow: 0 4px 12px -2px rgba(16, 185, 129, 0.08), 0 2px 5px -1px rgba(15, 23, 42, 0.04) !important; border-radius: 8px !important; transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1) !important; }
    .posko-item-card:hover { background: #ffffff !important; border-color: #34d399 !important; box-shadow: 0 12px 28px -4px rgba(16, 185, 129, 0.18), 0 4px 10px -2px rgba(15, 23, 42, 0.04) !important; transform: translateY(-2px) !important; }
    .monitoring-card-header { border-bottom: 1.5px solid #e2e8f0; padding-bottom: 1rem; margin-bottom: 1rem; }
    .monitoring-card-title { color: #064e3b; }
    .monitoring-count-badge { background-color: rgba(6, 95, 70, 0.08) !important; color: #047857 !important; border: 1px solid rgba(6, 95, 70, 0.18) !important; }
    .table-monitoring { margin-bottom: 0; }
    .table-monitoring thead { background-color: #f8fafc; }
    .table-monitoring th { color: #64748b; font-size: 0.75rem; font-weight: 700; letter-spacing: 0.035em; text-transform: uppercase; border-bottom: 1.5px solid #e2e8f0; padding: 0.85rem 0.9rem; white-space: nowrap; }
    .table-monitoring td { color: #334155; padding: 0.9rem; border-color: #f1f5f9; vertical-align: middle; }
    .victim-name { color: #064e3b; }
    .soft-badge { border: 1px solid transparent !important; font-weight: 700 !important; font-size: 0.75rem !important; padding: 0.4rem 0.65rem !important; white-space: normal; }
    .soft-badge-success { background-color: #ecfdf5 !important; color: #047857 !important; border-color: #a7f3d0 !important; }
    .soft-badge-danger { background-color: #fef2f2 !important; color: #dc2626 !important; border-color: #fecdd3 !important; }
    .soft-badge-warning { background-color: #fffbeb !important; color: #b45309 !important; border-color: #fde68a !important; }
    .soft-badge-info { background-color: #e0f2fe !important; color: #0369a1 !important; border-color: #7dd3fc !important; }
    .soft-badge-neutral { background-color: #f8fafc !important; color: #64748b !important; border-color: #e2e8f0 !important; }
    .btn-frost { background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%); color: #065f46 !important; border: 1.5px solid #34d399; font-weight: 700; border-radius: 8px; transition: all 0.2s ease; box-shadow: 0 2px 6px rgba(16, 185, 129, 0.15); display: inline-flex; align-items: center; gap: 0.35rem; }
    .btn-frost:hover { background: linear-gradient(135deg, #a7f3d0 0%, #6ee7b7 100%); color: #064e3b !important; border-color: #10b981; box-shadow: 0 4px 12px rgba(16, 185, 129, 0.25); transform: translateY(-1px); }
    .empty-monitoring-state { background-color: #f8fafc; border: 1.5px solid #e2e8f0; border-radius: 8px; padding: 1.5rem; }
    @media (max-width: 575.98px) {
        .frost-hero .card-body, .posko-item-card { padding: 1.15rem !important; }
        .table-monitoring th, .table-monitoring td { padding: 0.65rem 0.7rem; font-size: 0.8125rem; }
        .btn-frost { width: 100%; justify-content: center; }
    }
</style>

<div class="container-fluid px-0">

    <div class="card frost-hero mb-4">
        <div class="card-body p-4">
            <h3 class="fw-bold mb-1" style="color: #064e3b;">
                <i class="bi bi-heart-pulse-fill me-2" style="color: #059669;"></i> Monitoring & Follow-Up Penyintas
            </h3>
            <p class="small mb-0" style="color: #047857;">
                Daftar penyintas yang membutuhkan follow up klinis.
            </p>
        </div>
    </div>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <div class="card posko-item-card p-4">
        <div class="monitoring-card-header d-flex align-items-center justify-content-between flex-wrap gap-2">
            <h5 class="monitoring-card-title fw-bold mb-0 d-flex align-items-center">
                <i class="bi bi-clipboard2-pulse-fill text-success me-2 fs-5"></i> Tabel Data Penyintas Monitoring
            </h5>
            <span class="badge monitoring-count-badge px-3 py-1.5 fs-8">
                <?= count($monitoredVictims ?? []) ?> Penyintas
            </span>
        </div>
        <div class="table-responsive">
            <table class="table table-monitoring align-middle mb-0">
                <thead class="text-secondary small text-uppercase">
                    <tr>
                        <th>Nama Penyintas</th>
                        <th>Umur / JK</th>
                        <th>Diagnosis Sementara</th>
                        <th>Jadwal Follow-Up</th>
                        <th>Status ITQ</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($monitoredVictims)): ?>
                        <tr>
                            <td colspan="6" class="text-center py-4">
                                <div class="empty-monitoring-state text-muted">
                                    <i class="bi bi-calendar2-x fs-3 d-block mb-1 text-success"></i>
                                    Belum ada penyintas yang masuk jadwal follow-up.
                                </div>
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach($monitoredVictims as $v): ?>
                            <tr>
                                <td>
                                    <strong class="victim-name d-block"><?= esc($v['victim_nama']) ?></strong>
                                    <span class="fs-8 text-muted"><?= esc($v['nik']) ?></span>
                                </td>
                                <td><?= esc($v['umur']) ?> thn / <?= $v['jenis_kelamin'] === 'L' ? 'Laki-Laki' : 'Perempuan' ?></td>
                                <td><span class="badge soft-badge soft-badge-info"><?= esc($v['diagnosis_sementara']) ?></span></td>
                                <td>
                                    <?php 
                                        $d = date('Y-m-d');
                                        $f = $v['jadwal_followup'];
                                        $isPast = $f < $d;
                                        $isToday = $f === $d;
                                    ?>
                                    <?php if($isPast): ?>
                                        <span class="badge soft-badge soft-badge-danger">Terlewat (<?= esc($f) ?>)</span>
                                    <?php elseif($isToday): ?>
                                        <span class="badge soft-badge soft-badge-warning">Hari Ini</span>
                                    <?php else: ?>
                                        <span class="badge soft-badge soft-badge-success"><?= esc($f) ?></span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if($v['final_diagnosis']): ?>
                                        <span class="badge soft-badge soft-badge-success"><i class="bi bi-check-circle me-1"></i> Selesai</span>
                                    <?php else: ?>
                                        <span class="badge soft-badge soft-badge-neutral">Belum ITQ</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <a href="<?= site_url('/psikolog/monitoring/detail/' . $v['victim_id']) ?>" class="btn btn-sm btn-frost">
                                        Detail Monitoring <i class="bi bi-arrow-right ms-1"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
