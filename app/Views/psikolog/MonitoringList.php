<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<style>
    .frost-hero { background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 60%, #a7f3d0 100%); border: 1.5px solid #a7f3d0; color: #064e3b; position: relative; overflow: hidden; box-shadow: 0 10px 30px -4px rgba(16, 185, 129, 0.12), inset 0 1.5px 2px rgba(255, 255, 255, 0.85); border-radius: 8px !important; }
    .posko-item-card { background: #ffffff !important; border: 1.5px solid #e2e8f0 !important; box-shadow: 0 4px 12px -2px rgba(15, 23, 42, 0.04) !important; border-radius: 8px !important; }
    .table-monitoring th { background-color: #f8fafc; font-weight: 600; color: #334155; }
    .btn-frost { background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%); color: #065f46 !important; border: 1.5px solid #34d399; font-weight: 700; border-radius: 8px; transition: all 0.2s ease; }
    .btn-frost:hover { background: linear-gradient(135deg, #a7f3d0 0%, #6ee7b7 100%); color: #064e3b !important; border-color: #10b981; }
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
        <div class="table-responsive">
            <table class="table table-hover table-monitoring align-middle">
                <thead>
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
                        <tr><td colspan="6" class="text-center text-muted py-4">Belum ada penyintas yang masuk jadwal follow-up.</td></tr>
                    <?php else: ?>
                        <?php foreach($monitoredVictims as $v): ?>
                            <tr>
                                <td class="fw-bold"><?= esc($v['victim_nama']) ?><br/><small class="text-muted"><?= esc($v['nik']) ?></small></td>
                                <td><?= esc($v['umur']) ?> thn / <?= $v['jenis_kelamin'] === 'L' ? 'Laki-Laki' : 'Perempuan' ?></td>
                                <td><span class="badge bg-primary"><?= esc($v['diagnosis_sementara']) ?></span></td>
                                <td>
                                    <?php 
                                        $d = date('Y-m-d');
                                        $f = $v['jadwal_followup'];
                                        $isPast = $f < $d;
                                        $isToday = $f === $d;
                                    ?>
                                    <?php if($isPast): ?>
                                        <span class="badge bg-danger">Terlewat (<?= $f ?>)</span>
                                    <?php elseif($isToday): ?>
                                        <span class="badge bg-warning text-dark">Hari Ini</span>
                                    <?php else: ?>
                                        <span class="badge bg-info text-dark"><?= $f ?></span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if($v['final_diagnosis']): ?>
                                        <span class="badge bg-success"><i class="bi bi-check-circle"></i> Selesai</span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary">Belum ITQ</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <a href="<?= site_url('/psikolog/monitoring/detail/' . $v['victim_id']) ?>" class="btn btn-sm btn-frost">
                                        <i class="bi bi-list-check"></i> Detail Monitoring
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
