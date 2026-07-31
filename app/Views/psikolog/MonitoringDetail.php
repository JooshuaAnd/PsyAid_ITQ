<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<style>
    .frost-hero { background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 60%, #a7f3d0 100%); border: 1.5px solid #a7f3d0; color: #064e3b; border-radius: 8px; }
    .frost-btn-reset { background: #ffffff !important; color: #475569 !important; border: 1.5px solid #cbd5e1 !important; border-radius: 8px !important; font-weight: 600 !important; font-size: 0.8125rem !important; padding: 0.45rem 0.85rem !important; text-decoration: none; }
    .posko-item-card { background: #ffffff !important; border: 1.5px solid #e2e8f0 !important; box-shadow: 0 4px 12px -2px rgba(15, 23, 42, 0.04) !important; border-radius: 8px; }
    .btn-frost { background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%); color: #065f46 !important; border: 1.5px solid #34d399; font-weight: 700; border-radius: 8px; }
    .card-followup { border: 1px solid #cbd5e1; border-radius: 8px; background-color: #f8fafc; margin-bottom: 1rem; }
    .card-followup-header { background-color: #e2e8f0; border-bottom: 1px solid #cbd5e1; padding: 10px 15px; font-weight: bold; border-radius: 8px 8px 0 0; }
    .timeline-container { position: relative; border-left: 2px solid #3b82f6; padding-left: 20px; margin-left: 10px; }
    .timeline-dot { position: absolute; left: -11px; top: 15px; width: 20px; height: 20px; border-radius: 50%; background-color: #3b82f6; border: 4px solid white; box-shadow: 0 0 0 2px #3b82f6; }
</style>

<div class="container-fluid px-0">
    <div class="card frost-hero mb-4">
        <div class="card-body p-4 position-relative">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <span class="badge px-3 py-1.5 fs-8 fw-bold" style="background-color: rgba(6, 95, 70, 0.12); color: #065f46; border: 1px solid rgba(6, 95, 70, 0.25);">
                    <i class="bi bi-heart-pulse-fill me-1"></i> REKAM MEDIS & MONITORING (PATIENT JOURNEY)
                </span>
                <a href="<?= site_url('/psikolog/monitoring') ?>" class="frost-btn-reset">
                    <i class="bi bi-arrow-left me-1"></i> Kembali
                </a>
            </div>
            <h3 class="fw-bold mb-1" style="color: #064e3b;"><?= esc($victim['nama']) ?> (<?= esc($victim['nik']) ?>)</h3>
            <p class="small mb-0" style="color: #047857;">
                Gender: <?= esc($victim['jenis_kelamin'] === 'L' ? 'Laki-Laki' : 'Perempuan') ?> | Umur: <?= esc($victim['umur']) ?> Thn
            </p>
        </div>
    </div>

    <div class="timeline-container">
        
        <!-- FASE: RELAWAN -->
        <div class="card-followup position-relative">
            <div class="timeline-dot" style="background-color: #f59e0b; box-shadow: 0 0 0 2px #f59e0b;"></div>
            <div class="card-followup-header text-dark d-flex justify-content-between align-items-center" style="background-color: #fde68a;">
                <span><i class="bi bi-person-badge"></i> Data Triase Relawan</span>
                <span class="badge bg-light text-dark"><i class="bi bi-check-all"></i> Selesai</span>
            </div>
            <div class="p-3">
                <?php if($volunteerScreening): ?>
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <strong>Kondisi Observasi Utama:</strong>
                            <ul class="mb-0 small">
                                <?php if($volunteerScreening['menangis_terus']) echo "<li>Menangis Terus</li>"; ?>
                                <?php if($volunteerScreening['tampak_panik']) echo "<li>Tampak Panik</li>"; ?>
                                <?php if($volunteerScreening['gemetar']) echo "<li>Gemetar</li>"; ?>
                                <?php if($volunteerScreening['menyebut_ingin_mati']) echo "<li class='text-danger fw-bold'>Menyebut Ingin Mati</li>"; ?>
                            </ul>
                        </div>
                        <div class="col-md-6 mb-2">
                            <strong>Catatan Relawan:</strong><br>
                            <small class="fst-italic text-muted">"<?= esc($volunteerScreening['catatan_tambahan'] ?? 'Tidak ada catatan') ?>"</small>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="text-muted small">Belum ada data relawan.</div>
                <?php endif; ?>
            </div>
        </div>

        <!-- FASE 0: BASELINE -->
        <div class="card-followup position-relative">
            <div class="timeline-dot"></div>
            <div class="card-followup-header text-white d-flex justify-content-between align-items-center" style="background-color: #3b82f6;">
                <span><i class="bi bi-journal-medical"></i> Konsultasi Awal (Baseline - Hari 0)</span>
                <span class="badge bg-light text-primary"><i class="bi bi-check-all"></i> Selesai</span>
            </div>
            <div class="p-3">
                <div class="row">
                    <div class="col-md-4 mb-2 border-end">
                        <h6 class="fw-bold text-primary">Hasil ITQ</h6>
                        <?php if(isset($itqByFase[0])): ?>
                            <div><strong>Skor PTSD:</strong> <?= esc($itqByFase[0]['ptsd_score']) ?></div>
                            <div><strong>Skor DSO:</strong> <?= esc($itqByFase[0]['dso_score']) ?></div>
                            <div><strong>Diagnosis ITQ:</strong> <?= esc($itqByFase[0]['final_diagnosis']) ?></div>
                        <?php else: ?>
                            <span class="text-muted small">Belum ada.</span>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-4 mb-2 border-end">
                        <h6 class="fw-bold text-primary">Hasil MSE (Psikolog)</h6>
                        <?php if(isset($reviewByFase[0])): ?>
                            <div><strong>Keluhan:</strong> <?= esc($reviewByFase[0]['chief_complaint']) ?></div>
                            <div><strong>Diagnosis:</strong> <?= esc($caByFase[0]['diagnosis_sementara'] ?? '-') ?></div>
                            <div><strong>Intervensi:</strong> <?= esc($caByFase[0]['intervensi'] ?? '-') ?></div>
                        <?php else: ?>
                            <span class="text-muted small">Belum ada.</span>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-4 mb-2">
                        <h6 class="fw-bold text-primary">Analisis AI</h6>
                        <?php if(isset($aiByFase[0])): ?>
                            <div class="small fst-italic text-muted"><?= esc($aiByFase[0]['ai_summary']) ?></div>
                        <?php else: ?>
                            <span class="text-muted small">Belum ada.</span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- FASE 1, 2, 3: FOLLOW-UPS -->
        <?php foreach ([1 => 7, 2 => 14, 3 => 30] as $ke => $hari): ?>
        <div class="card-followup position-relative">
            <div class="timeline-dot" style="background-color: #8b5cf6; box-shadow: 0 0 0 2px #8b5cf6;"></div>
            <div class="card-followup-header text-white d-flex justify-content-between align-items-center" style="background-color: #8b5cf6;">
                <span><i class="bi bi-calendar2-check"></i> Follow-Up #<?= $ke ?> (Hari ke-<?= $hari ?>)</span>
                <?php if(isset($itqByFase[$ke]) && isset($reviewByFase[$ke])): ?>
                    <span class="badge bg-light text-success"><i class="bi bi-check-all"></i> Selesai</span>
                <?php else: ?>
                    <span class="badge bg-light text-secondary">Pending</span>
                <?php endif; ?>
            </div>
            <div class="p-3">
                <div class="row">
                    <div class="col-md-4 mb-2 border-end">
                        <h6 class="fw-bold" style="color: #6d28d9;">Hasil ITQ</h6>
                        <?php if(isset($itqByFase[$ke])): ?>
                            <div><strong>Skor PTSD:</strong> <?= esc($itqByFase[$ke]['ptsd_score']) ?></div>
                            <div><strong>Skor DSO:</strong> <?= esc($itqByFase[$ke]['dso_score']) ?></div>
                            <div><strong>Diagnosis ITQ:</strong> <?= esc($itqByFase[$ke]['final_diagnosis']) ?></div>
                        <?php else: ?>
                            <a href="<?= site_url('/itq/form/' . $victim['id'] . '?fase_ke=' . $ke) ?>" class="btn btn-sm btn-outline-primary mb-2">
                                <i class="bi bi-pencil-square"></i> Isi Follow-Up ITQ
                            </a>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-4 mb-2 border-end">
                        <h6 class="fw-bold" style="color: #6d28d9;">Hasil MSE (Psikolog)</h6>
                        <?php if(isset($reviewByFase[$ke])): ?>
                            <div><strong>Keluhan:</strong> <?= esc($reviewByFase[$ke]['chief_complaint']) ?></div>
                            <div class="small text-muted mt-1">"<?= esc($reviewByFase[$ke]['mse_appearance']) ?>"</div>
                        <?php else: ?>
                            <a href="<?= site_url('/psychologist-review/' . $victim['id'] . '?fase_ke=' . $ke) ?>" class="btn btn-sm btn-outline-primary mb-2">
                                <i class="bi bi-file-earmark-medical"></i> Isi Follow-Up MSE
                            </a>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-4 mb-2">
                        <h6 class="fw-bold" style="color: #6d28d9;">Analisis AI</h6>
                        <?php if(isset($aiByFase[$ke])): ?>
                            <div class="small fst-italic text-muted"><?= esc($aiByFase[$ke]['ai_summary']) ?></div>
                        <?php else: ?>
                            <span class="text-muted small">Otomatis terisi setelah ITQ/MSE selesai dihitung.</span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>

        <!-- KEPUTUSAN AKHIR -->
        <?php if(isset($itqByFase[3]) && isset($reviewByFase[3])): ?>
        <div class="card-followup position-relative">
            <div class="timeline-dot" style="background-color: #10b981; box-shadow: 0 0 0 2px #10b981;"></div>
            <div class="card-followup-header text-white d-flex justify-content-between align-items-center" style="background-color: #10b981;">
                <span><i class="bi bi-flag-fill"></i> Keputusan Akhir</span>
                <?php if($finalDecision): ?>
                    <span class="badge bg-light text-success"><i class="bi bi-check-all"></i> Tersimpan</span>
                <?php endif; ?>
            </div>
            <div class="p-3">
                <?php if($finalDecision): ?>
                    <div class="mb-2"><strong>Status Akhir:</strong> <span class="badge bg-success"><?= esc($finalDecision['status_akhir']) ?></span></div>
                    <div><strong>Catatan Akhir:</strong><br><?= esc($finalDecision['catatan_akhir']) ?></div>
                <?php else: ?>
                    <form action="<?= site_url('/psikolog/monitoring/store-final/' . $victim['id']) ?>" method="POST">
                        <?= csrf_field() ?>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Status/Tindak Lanjut Akhir</label>
                            <select name="status_akhir" class="form-select" required>
                                <option value="">-- Pilih --</option>
                                <option value="Selesai (Pulih)">Selesai (Pulih)</option>
                                <option value="Rujuk ke Psikiater">Rujuk ke Psikiater</option>
                                <option value="Perlu Perawatan Lanjutan">Perlu Perawatan Lanjutan</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Catatan Klinis Akhir</label>
                            <textarea name="catatan_akhir" class="form-control" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-success"><i class="bi bi-save"></i> Simpan Keputusan Akhir</button>
                    </form>
                <?php endif; ?>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>
<?= $this->endSection() ?>
