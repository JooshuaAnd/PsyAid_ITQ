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
    
    .mse-list dt { font-weight: 600; color: #475569; }
    .mse-list dd { margin-bottom: 0.5rem; color: #0f172a; }
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
                <?php if($volunteerScreening): ?>
                    <span class="badge bg-light text-dark"><i class="bi bi-check-all"></i> Selesai</span>
                <?php else: ?>
                    <span class="badge bg-light text-secondary">Belum ada</span>
                <?php endif; ?>
            </div>
            <div class="p-3">
                <?php if($volunteerScreening): ?>
                    <div class="row">
                        <div class="col-md-4 mb-2 border-end">
                            <h6 class="fw-bold">Profil & Identitas</h6>
                            <ul class="list-unstyled small mb-2">
                                <li><strong>Gender:</strong> <?= esc($victim['jenis_kelamin'] === 'L' ? 'Laki-Laki' : 'Perempuan') ?></li>
                                <li><strong>Umur:</strong> <?= esc($victim['umur']) ?> Thn</li>
                                <li><strong>Datang:</strong> <?= esc($victim['tanggal_datang'] ?? '-') ?></li>
                            </ul>
                            <h6 class="fw-bold mt-2">Observasi Interaksi</h6>
                            <ul class="list-unstyled small">
                                <li><strong>Kontak Mata:</strong> <?= esc($volunteerScreening['kontak_mata'] ?? '-') ?></li>
                                <li><strong>Bicara:</strong> <?= esc($volunteerScreening['bicara'] ?? '-') ?></li>
                            </ul>
                        </div>
                        <div class="col-md-4 mb-2 border-end">
                            <h6 class="fw-bold">Kondisi Observasi Skrining</h6>
                            <ul class="mb-0 small ps-3">
                                <?php if($volunteerScreening['mampu_sebut_nama']) echo "<li>Mampu Sebut Nama</li>"; ?>
                                <?php if($volunteerScreening['mampu_sebut_lokasi']) echo "<li>Mampu Sebut Lokasi</li>"; ?>
                                <?php if($volunteerScreening['mampu_sebut_tanggal']) echo "<li>Mampu Sebut Tanggal</li>"; ?>
                                <?php if($volunteerScreening['menangis_terus']) echo "<li>Menangis Terus</li>"; ?>
                                <?php if($volunteerScreening['tampak_panik']) echo "<li>Tampak Panik</li>"; ?>
                                <?php if($volunteerScreening['gemetar']) echo "<li>Gemetar</li>"; ?>
                                <?php if($volunteerScreening['berteriak_histeris']) echo "<li>Berteriak Histeris</li>"; ?>
                                <?php if($volunteerScreening['diam_total']) echo "<li>Cenderung Diam/Stupor</li>"; ?>
                                <?php if($volunteerScreening['sulit_tidur']) echo "<li>Sulit Tidur</li>"; ?>
                                <?php if($volunteerScreening['tidak_mau_makan']) echo "<li>Sulit Makan</li>"; ?>
                                <?php if($volunteerScreening['mencari_keluarga']) echo "<li>Mencari/Terpisah Keluarga</li>"; ?>
                                <?php if($volunteerScreening['menyebut_ingin_mati']) echo "<li class='text-danger fw-bold'>Menyebut Ingin Mati</li>"; ?>
                                <?php if($volunteerScreening['melukai_diri']) echo "<li class='text-danger fw-bold'>Melukai Diri</li>"; ?>
                                <?php if($volunteerScreening['mengancam_bunuh_diri']) echo "<li class='text-danger fw-bold'>Mengancam Bunuh Diri</li>"; ?>
                                <?php if($volunteerScreening['agresif']) echo "<li class='text-danger fw-bold'>Agresif</li>"; ?>
                            </ul>
                            <div class="mt-2">
                                <strong>Catatan Relawan:</strong><br>
                                <small class="fst-italic text-muted">"<?= esc($volunteerScreening['catatan_tambahan'] ?? 'Tidak ada catatan') ?>"</small>
                            </div>
                        </div>
                        <div class="col-md-4 mb-2">
                            <h6 class="fw-bold d-flex justify-content-between align-items-center">
                                <span>Analisis AI (Relawan)</span>
                                <?php if(isset($aiByFase[-1])): ?>
                                    <button type="button" class="btn btn-sm btn-link py-0 px-1" onclick="toggleEditAi(-1)"><i class="bi bi-pencil"></i> Edit</button>
                                <?php endif; ?>
                            </h6>
                            <?php if(isset($aiByFase[-1])): ?>
                                <div class="mb-2">
                                    <span class="badge bg-<?= $aiByFase[-1]['risk_level'] === 'high' ? 'danger' : ($aiByFase[-1]['risk_level'] === 'medium' ? 'warning' : 'success') ?>">
                                        <?= strtoupper($aiByFase[-1]['risk_level']) ?> RISK
                                    </span>
                                </div>
                                <div><strong>Rekomendasi Diagnosis:</strong><br><small><?= esc($aiByFase[-1]['kemungkinan_diagnosis'] ?? '-') ?></small></div>
                                <div class="mt-2">
                                    <strong>Summary AI:</strong><br>
                                    <div id="ai-summary-display--1" class="small fst-italic text-muted" style="white-space: pre-wrap;"><?= esc($aiByFase[-1]['ai_summary']) ?></div>
                                    <div id="ai-summary-edit--1" class="d-none">
                                        <textarea class="form-control form-control-sm mb-2" id="ai-textarea--1" rows="6"><?= esc($aiByFase[-1]['ai_summary']) ?></textarea>
                                        <button type="button" class="btn btn-sm btn-success w-100" onclick="saveAiSummary(<?= $victim['id'] ?>, -1)">Simpan Perubahan AI</button>
                                    </div>
                                </div>
                            <?php else: ?>
                                <span class="text-muted small">Belum ada analisis AI Relawan.</span>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="text-muted small">Belum ada data relawan.</div>
                <?php endif; ?>
            </div>
        </div>

        <!-- HELPER FUNCTION FOR MSE -->
        <?php
        function renderMseDetail($review, $ca, $victim, $ke) {
            if (!$review) {
                return '
                <a href="' . site_url('/psychologist-review/' . $victim['id'] . '?fase_ke=' . $ke) . '" class="btn btn-sm btn-outline-primary mb-2">
                    <i class="bi bi-file-earmark-medical"></i> Isi Form MSE (Psikolog)
                </a>';
            }
            $mseHtml = '<dl class="row mse-list small mb-0">';
            $fields = [
                'Chief Complaint' => ['val' => $review['chief_complaint'], 'note' => null],
                'Appearance'      => ['val' => $review['mse_appearance'], 'note' => $review['mse_appearance_note']],
                'Behavior'        => ['val' => $review['mse_behavior'], 'note' => $review['mse_behavior_note']],
                'Speech'          => ['val' => $review['mse_speech'], 'note' => $review['mse_speech_note']],
                'Mood'            => ['val' => $review['mse_mood'], 'note' => $review['mse_mood_note']],
                'Affect'          => ['val' => $review['mse_affect'], 'note' => $review['mse_affect_note']],
                'Thought'         => ['val' => $review['mse_thought'], 'note' => $review['mse_thought_note']],
                'Orientation'     => ['val' => $review['mse_orientation'], 'note' => $review['mse_orientation_note']],
                'Insight'         => ['val' => $review['mse_insight'], 'note' => $review['mse_insight_note']],
                'Perception'      => ['val' => $review['mse_perception'], 'note' => $review['mse_perception_note']],
                'Risk Assessment' => ['val' => $review['risk_assessment'], 'note' => $review['risk_assessment_note']],
            ];

            foreach ($fields as $label => $data) {
                $val = esc($data['val'] ?? '-');
                $note = $data['note'] ? '<br><span class="text-muted fst-italic">"'.esc($data['note']).'"</span>' : '';
                $mseHtml .= "<dt class='col-sm-4'>{$label}</dt><dd class='col-sm-8'>{$val}{$note}</dd>";
            }
            
            $diag = esc($ca['diagnosis_sementara'] ?? '-');
            $interv = esc($ca['intervensi'] ?? '-');
            $catatan = esc($ca['catatan_klinis'] ?? '-');
            
            $mseHtml .= "<hr class='my-2'><dt class='col-sm-4'>Diagnosis</dt><dd class='col-sm-8'>{$diag}</dd>";
            $mseHtml .= "<dt class='col-sm-4'>Intervensi</dt><dd class='col-sm-8'>{$interv}</dd>";
            $mseHtml .= "<dt class='col-sm-4'>Catatan</dt><dd class='col-sm-8'>{$catatan}</dd>";
            $mseHtml .= '</dl>';
            return $mseHtml;
        }
        ?>

        <!-- FASE 0: BASELINE -->
        <div class="card-followup position-relative">
            <div class="timeline-dot"></div>
            <div class="card-followup-header text-white d-flex justify-content-between align-items-center" style="background-color: #3b82f6;">
                <span><i class="bi bi-journal-medical"></i> Konsultasi Awal (Baseline - Hari 0)</span>
                <?php if(isset($itqByFase[0]) && isset($reviewByFase[0])): ?>
                    <span class="badge bg-light text-primary"><i class="bi bi-check-all"></i> Selesai</span>
                <?php else: ?>
                    <span class="badge bg-light text-secondary">Pending</span>
                <?php endif; ?>
            </div>
            <div class="p-3">
                <div class="row">
                    <div class="col-md-3 mb-2 border-end">
                        <h6 class="fw-bold text-primary">Hasil ITQ</h6>
                        <?php if(isset($itqByFase[0])): ?>
                            <div><strong>Skor PTSD:</strong> <?= esc($itqByFase[0]['ptsd_score']) ?></div>
                            <div><strong>Skor DSO:</strong> <?= esc($itqByFase[0]['dso_score']) ?></div>
                            <div class="mt-2"><strong>Diagnosis ITQ:</strong><br>
                                <span class="badge bg-<?= strpos($itqByFase[0]['final_diagnosis'] ?? '', 'PTSD') !== false ? 'danger' : 'success' ?>">
                                    <?= esc($itqByFase[0]['final_diagnosis']) ?>
                                </span>
                            </div>
                            <a href="<?= site_url('/itq/result/' . $victim['id'] . '?fase_ke=0') ?>" class="btn btn-sm btn-outline-primary mt-3">
                                <i class="bi bi-graph-up"></i> Detail Grafik & Skor
                            </a>
                        <?php else: ?>
                            <a href="<?= site_url('/itq/form/' . $victim['id'] . '?fase_ke=0') ?>" class="btn btn-sm btn-outline-primary mb-2">
                                <i class="bi bi-pencil-square"></i> Isi ITQ Awal
                            </a>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-5 mb-2 border-end">
                        <h6 class="fw-bold text-primary">Evaluasi Mental Status (MSE) Psikolog</h6>
                        <?= renderMseDetail($reviewByFase[0] ?? null, $caByFase[0] ?? null, $victim, 0) ?>
                    </div>
                    <div class="col-md-4 mb-2">
                        <h6 class="fw-bold text-primary d-flex justify-content-between align-items-center">
                            <span>Analisis AI (Konsultasi Awal)</span>
                            <?php if(isset($aiByFase[0])): ?>
                                <button type="button" class="btn btn-sm btn-link py-0 px-1" onclick="toggleEditAi(0)"><i class="bi bi-pencil"></i> Edit</button>
                            <?php endif; ?>
                        </h6>
                        <?php if(isset($aiByFase[0])): ?>
                            <div id="ai-summary-display-0" class="small fst-italic text-muted" style="white-space: pre-wrap;"><?= esc($aiByFase[0]['ai_summary']) ?></div>
                            <div id="ai-summary-edit-0" class="d-none">
                                <textarea class="form-control form-control-sm mb-2" id="ai-textarea-0" rows="6"><?= esc($aiByFase[0]['ai_summary']) ?></textarea>
                                <button type="button" class="btn btn-sm btn-success w-100" onclick="saveAiSummary(<?= $victim['id'] ?>, 0)">Simpan Perubahan AI</button>
                            </div>
                        <?php else: ?>
                            <span class="text-muted small">Otomatis terisi setelah form ITQ & MSE disimpan.</span>
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
                    <div class="col-md-3 mb-2 border-end">
                        <h6 class="fw-bold" style="color: #6d28d9;">Hasil ITQ</h6>
                        <?php if(isset($itqByFase[$ke])): ?>
                            <div><strong>Skor PTSD:</strong> <?= esc($itqByFase[$ke]['ptsd_score']) ?></div>
                            <div><strong>Skor DSO:</strong> <?= esc($itqByFase[$ke]['dso_score']) ?></div>
                            <div class="mt-2"><strong>Diagnosis ITQ:</strong><br>
                                <span class="badge bg-<?= strpos($itqByFase[$ke]['final_diagnosis'] ?? '', 'PTSD') !== false ? 'danger' : 'success' ?>">
                                    <?= esc($itqByFase[$ke]['final_diagnosis']) ?>
                                </span>
                            </div>
                            <a href="<?= site_url('/itq/result/' . $victim['id'] . '?fase_ke=' . $ke) ?>" class="btn btn-sm btn-outline-primary mt-3" style="color: #6d28d9; border-color: #6d28d9;">
                                <i class="bi bi-graph-up"></i> Detail Grafik & Skor
                            </a>
                        <?php else: ?>
                            <a href="<?= site_url('/itq/form/' . $victim['id'] . '?fase_ke=' . $ke) ?>" class="btn btn-sm btn-outline-primary mb-2">
                                <i class="bi bi-pencil-square"></i> Isi Follow-Up ITQ
                            </a>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-5 mb-2 border-end">
                        <h6 class="fw-bold" style="color: #6d28d9;">Evaluasi Mental Status (MSE) Psikolog</h6>
                        <?= renderMseDetail($reviewByFase[$ke] ?? null, $caByFase[$ke] ?? null, $victim, $ke) ?>
                    </div>
                    <div class="col-md-4 mb-2">
                        <h6 class="fw-bold d-flex justify-content-between align-items-center" style="color: #6d28d9;">
                            <span>Analisis AI (Follow-up)</span>
                            <?php if(isset($aiByFase[$ke])): ?>
                                <button type="button" class="btn btn-sm btn-link py-0 px-1" onclick="toggleEditAi(<?= $ke ?>)"><i class="bi bi-pencil"></i> Edit</button>
                            <?php endif; ?>
                        </h6>
                        <?php if(isset($aiByFase[$ke])): ?>
                            <div id="ai-summary-display-<?= $ke ?>" class="small fst-italic text-muted" style="white-space: pre-wrap;"><?= esc($aiByFase[$ke]['ai_summary']) ?></div>
                            <div id="ai-summary-edit-<?= $ke ?>" class="d-none">
                                <textarea class="form-control form-control-sm mb-2" id="ai-textarea-<?= $ke ?>" rows="6"><?= esc($aiByFase[$ke]['ai_summary']) ?></textarea>
                                <button type="button" class="btn btn-sm btn-success w-100" onclick="saveAiSummary(<?= $victim['id'] ?>, <?= $ke ?>)">Simpan Perubahan AI</button>
                            </div>
                        <?php else: ?>
                            <span class="text-muted small">Otomatis terisi setelah form ITQ & MSE selesai dihitung.</span>
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
                    <form action="<?= site_url('/psikolog/monitoring/store-final-decision/' . $victim['id']) ?>" method="POST">
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

<script>
    function toggleEditAi(faseKe) {
        document.getElementById('ai-summary-display-' + faseKe).classList.toggle('d-none');
        document.getElementById('ai-summary-edit-' + faseKe).classList.toggle('d-none');
    }

    function saveAiSummary(victimId, faseKe) {
        const text = document.getElementById('ai-textarea-' + faseKe).value;
        const btn = document.querySelector('#ai-summary-edit-' + faseKe + ' button');
        btn.disabled = true;
        btn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Menyimpan...';
        
        fetch('<?= site_url('/psikolog/monitoring/update-ai-summary/') ?>' + victimId + '/' + faseKe, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: 'ai_summary=' + encodeURIComponent(text) + '&<?= csrf_token() ?>=' + '<?= csrf_hash() ?>'
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                document.getElementById('ai-summary-display-' + faseKe).innerText = text;
                toggleEditAi(faseKe);
                // Optionally show a toast notification here
            } else {
                alert('Gagal menyimpan: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan jaringan.');
        })
        .finally(() => {
            btn.disabled = false;
            btn.innerText = 'Simpan Perubahan AI';
        });
    }
</script>
<?= $this->endSection() ?>
