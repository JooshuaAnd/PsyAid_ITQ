<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="row mb-4 align-items-center">
    <div class="col">
        <a href="<?= site_url('/psikolog/dashboard') ?>" class="btn btn-outline-secondary btn-sm mb-2">
            <i class="bi bi-arrow-left me-1"></i> Kembali ke Dashboard Psikolog
        </a>
        <h3 class="fw-bold text-dark mb-1">
            <i class="bi bi-person-lines-fill text-primary me-2"></i> Form Review Klinis & Mental Status Examination (MSE)
        </h3>
        <p class="text-muted small mb-0">Penyintas: <strong><?= esc($victim['nama']) ?></strong> (NIK: <?= esc($victim['nik'] ?? '-') ?>) • <?= esc($victim['posko_name']) ?></p>
    </div>
</div>

<!-- Read-Only Summary Section of Victim's Data -->
<div class="card card-custom bg-white p-4 shadow-sm mb-4">
    <h6 class="fw-bold text-secondary mb-3 border-bottom pb-2">
        <i class="bi bi-file-earmark-medical text-primary me-1"></i> Ringkasan Data Lapangan (Read-Only Summary for Clinical Decision)
    </h6>
    
    <div class="row g-3">
        <!-- Identitas & Bencana -->
        <div class="col-12 col-md-6 col-lg-3">
            <div class="p-3 bg-light rounded border h-100">
                <div class="fw-bold text-dark small mb-1">Identitas & Bencana</div>
                <div class="small text-muted">Gender: <strong><?= esc($victim['jenis_kelamin']) ?></strong>, Umur: <strong><?= esc($victim['umur']) ?> Thn</strong></div>
                <div class="small text-muted">Datang: <strong><?= esc($victim['tanggal_datang']) ?></strong></div>
                <div class="small text-muted">Bencana: <strong><?= esc($disaster['jenis_bencana'] ?? $victim['posko_bencana']) ?></strong></div>
                <div class="small text-muted">Terjebak: <strong class="text-danger"><?= esc($disaster['durasi_terjebak'] ?? '<1 jam') ?></strong></div>
            </div>
        </div>

        <!-- Riwayat Psikologis -->
        <div class="col-12 col-md-6 col-lg-3">
            <div class="p-3 bg-light rounded border h-100">
                <div class="fw-bold text-dark small mb-1">Riwayat Medis/Psikologis</div>
                <div class="small text-muted">Konsultasi: <strong><?= ! empty($psychHist['pernah_konsultasi']) ? 'Ya' : 'Tidak' ?></strong></div>
                <div class="small text-muted">Psikiater: <strong><?= ! empty($psychHist['pernah_dirawat_psikiater']) ? 'Ya' : 'Tidak' ?></strong></div>
                <div class="small text-muted">Self-Harm/Bunuh Diri: <strong class="text-danger"><?= (! empty($psychHist['riwayat_percobaan_bunuh_diri']) || ! empty($psychHist['riwayat_melukai_diri'])) ? 'Ya' : 'Tidak' ?></strong></div>
            </div>
        </div>

        <!-- Screening Relawan -->
        <div class="col-12 col-md-6 col-lg-3">
            <div class="p-3 bg-light rounded border h-100">
                <div class="fw-bold text-dark small mb-1">Skrining Relawan</div>
                <div class="small text-muted">Skala Distress: <strong class="text-danger"><?= esc($screening['skala_distress'] ?? 0) ?>/10</strong></div>
                <div class="small text-muted">Kontak Mata: <strong><?= esc($screening['kontak_mata'] ?? '-') ?></strong></div>
                <div class="small text-muted">Bicara: <strong><?= esc($screening['bicara'] ?? '-') ?></strong></div>
            </div>
        </div>

        <!-- AI Decision Support -->
        <div class="col-12 col-md-6 col-lg-3">
            <div class="p-3 bg-light rounded border border-warning h-100">
                <div class="fw-bold text-dark small mb-1">AI Clinical Decision Support</div>
                <div class="mb-1">
                    <span class="badge bg-danger"><?= esc(strtoupper($aiAssessment['risk_level'] ?? 'LOW')) ?> RISK</span>
                    <span class="badge bg-light text-dark border"><?= esc($aiAssessment['confidence'] ?? 85) ?>% Conf</span>
                </div>
                <div class="small text-muted"><?= esc($aiAssessment['kemungkinan_diagnosis'] ?? 'Acute Stress Disorder') ?></div>
            </div>
        </div>
    </div>
</div>

<!-- Psychologist Review Form (Chief Complaint & MSE) -->
<div class="card card-custom bg-white p-4 shadow-sm mb-4">
    <div class="border-bottom pb-3 mb-4">
        <h5 class="fw-bold text-dark mb-1"><i class="bi bi-stethoscope text-primary me-2"></i> Form Evaluasi Klinis Psikolog</h5>
        <p class="text-muted small mb-0">Isi keluhan utama (Chief Complaint) dan 8 komponen Mental Status Examination (MSE).</p>
    </div>

    <form action="<?= site_url('/psychologist-review/store/' . $victim['id']) ?>" method="POST">
        <?= csrf_field() ?>

        <!-- Chief Complaint -->
        <div class="mb-4">
            <label for="chief_complaint" class="form-label fw-semibold">Chief Complaint (Keluhan Utama Penyintas) <span class="text-danger">*</span></label>
            <textarea class="form-control" id="chief_complaint" name="chief_complaint" rows="3" 
                      placeholder="Tuliskan keluhan utama yang disampaikan langsung oleh penyintas atau keluarga..." required><?= old('chief_complaint', $review['chief_complaint'] ?? '') ?></textarea>
        </div>

        <!-- 8 Komponen Mental Status Examination (MSE) -->
        <h6 class="fw-bold text-dark mb-3"><i class="bi bi-clipboard2-pulse me-1 text-primary"></i> Mental Status Examination (MSE)</h6>
        
        <div class="row g-3 bg-light p-3 rounded border mb-4">
            <!-- 1. Appearance -->
            <div class="col-12 col-md-6 col-lg-3">
                <label class="form-label small fw-semibold d-block">1. Appearance (Penampilan)</label>
                <?php $app = old('mse_appearance', $review['mse_appearance'] ?? 'Normal'); ?>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="mse_appearance" id="app1" value="Normal" <?= $app === 'Normal' ? 'checked' : '' ?>>
                    <label class="form-check-label small" for="app1">Normal / Rapi</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="mse_appearance" id="app2" value="Kurang terawat" <?= $app === 'Kurang terawat' ? 'checked' : '' ?>>
                    <label class="form-check-label small text-warning" for="app2">Kurang terawat</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="mse_appearance" id="app3" value="Cedera" <?= $app === 'Cedera' ? 'checked' : '' ?>>
                    <label class="form-check-label small text-danger" for="app3">Cedera / Kotor Bencana</label>
                </div>
            </div>

            <!-- 2. Behavior -->
            <div class="col-12 col-md-6 col-lg-3">
                <label class="form-label small fw-semibold d-block">2. Behavior (Perilaku / Sikap)</label>
                <?php $beh = old('mse_behavior', $review['mse_behavior'] ?? 'Kooperatif'); ?>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="mse_behavior" id="beh1" value="Kooperatif" <?= $beh === 'Kooperatif' ? 'checked' : '' ?>>
                    <label class="form-check-label small" for="beh1">Kooperatif</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="mse_behavior" id="beh2" value="Gelisah" <?= $beh === 'Gelisah' ? 'checked' : '' ?>>
                    <label class="form-check-label small text-warning" for="beh2">Gelisah / Agitasi</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="mse_behavior" id="beh3" value="Agresif" <?= $beh === 'Agresif' ? 'checked' : '' ?>>
                    <label class="form-check-label small text-danger" for="beh3">Agresif / Unkooperatif</label>
                </div>
            </div>

            <!-- 3. Speech -->
            <div class="col-12 col-md-6 col-lg-3">
                <label class="form-label small fw-semibold d-block">3. Speech (Bicara)</label>
                <?php $sp = old('mse_speech', $review['mse_speech'] ?? 'Normal'); ?>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="mse_speech" id="sp1" value="Normal" <?= $sp === 'Normal' ? 'checked' : '' ?>>
                    <label class="form-check-label small" for="sp1">Normal</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="mse_speech" id="sp2" value="Lambat" <?= $sp === 'Lambat' ? 'checked' : '' ?>>
                    <label class="form-check-label small text-warning" for="sp2">Lambat / Terbata</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="mse_speech" id="sp3" value="Cepat" <?= $sp === 'Cepat' ? 'checked' : '' ?>>
                    <label class="form-check-label small text-danger" for="sp3">Cepat / Pressured</label>
                </div>
            </div>

            <!-- 4. Mood -->
            <div class="col-12 col-md-6 col-lg-3">
                <label class="form-label small fw-semibold d-block">4. Mood (Suasana Hati)</label>
                <?php $mo = old('mse_mood', $review['mse_mood'] ?? 'Sedih'); ?>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="mse_mood" id="mo1" value="Sedih" <?= $mo === 'Sedih' ? 'checked' : '' ?>>
                    <label class="form-check-label small" for="mo1">Sedih / Depresif</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="mse_mood" id="mo2" value="Cemas" <?= $mo === 'Cemas' ? 'checked' : '' ?>>
                    <label class="form-check-label small text-warning" for="mo2">Cemas / Anxious</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="mse_mood" id="mo3" value="Marah" <?= $mo === 'Marah' ? 'checked' : '' ?>>
                    <label class="form-check-label small text-danger" for="mo3">Marah / Irritabel</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="mse_mood" id="mo4" value="Netral" <?= $mo === 'Netral' ? 'checked' : '' ?>>
                    <label class="form-check-label small text-muted" for="mo4">Netral / Eutimik</label>
                </div>
            </div>

            <!-- 5. Affect -->
            <div class="col-12 col-md-6 col-lg-3">
                <label class="form-label small fw-semibold d-block">5. Affect (Afek)</label>
                <?php $af = old('mse_affect', $review['mse_affect'] ?? 'Sesuai'); ?>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="mse_affect" id="af1" value="Sesuai" <?= $af === 'Sesuai' ? 'checked' : '' ?>>
                    <label class="form-check-label small" for="af1">Sesuai (Appropriate)</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="mse_affect" id="af2" value="Datar" <?= $af === 'Datar' ? 'checked' : '' ?>>
                    <label class="form-check-label small text-warning" for="af2">Datar / Tumpul (Blunted)</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="mse_affect" id="af3" value="Labil" <?= $af === 'Labil' ? 'checked' : '' ?>>
                    <label class="form-check-label small text-danger" for="af3">Labil (Labile)</label>
                </div>
            </div>

            <!-- 6. Thought -->
            <div class="col-12 col-md-6 col-lg-3">
                <label class="form-label small fw-semibold d-block">6. Thought (Proses/Isi Pikir)</label>
                <?php $th = old('mse_thought', $review['mse_thought'] ?? 'Normal'); ?>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="mse_thought" id="th1" value="Normal" <?= $th === 'Normal' ? 'checked' : '' ?>>
                    <label class="form-check-label small" for="th1">Normal / Realistis</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="mse_thought" id="th2" value="Obsesi" <?= $th === 'Obsesi' ? 'checked' : '' ?>>
                    <label class="form-check-label small text-warning" for="th2">Obsesi / Ruminasi</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="mse_thought" id="th3" value="Delusi" <?= $th === 'Delusi' ? 'checked' : '' ?>>
                    <label class="form-check-label small text-danger" for="th3">Delusi / Waham</label>
                </div>
            </div>

            <!-- 7. Orientation -->
            <div class="col-12 col-md-6 col-lg-3">
                <label class="form-label small fw-semibold d-block">7. Orientation (Orientasi)</label>
                <?php $or = old('mse_orientation', $review['mse_orientation'] ?? 'Baik'); ?>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="mse_orientation" id="or1" value="Baik" <?= $or === 'Baik' ? 'checked' : '' ?>>
                    <label class="form-check-label small" for="or1">Baik (Orang/Tempat/Waktu)</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="mse_orientation" id="or2" value="Kurang" <?= $or === 'Kurang' ? 'checked' : '' ?>>
                    <label class="form-check-label small text-danger" for="or2">Kurang / Disorientasi</label>
                </div>
            </div>

            <!-- 8. Insight -->
            <div class="col-12 col-md-6 col-lg-3">
                <label class="form-label small fw-semibold d-block">8. Insight (Daya Nilai Diri)</label>
                <?php $in = old('mse_insight', $review['mse_insight'] ?? 'Baik'); ?>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="mse_insight" id="in1" value="Baik" <?= $in === 'Baik' ? 'checked' : '' ?>>
                    <label class="form-check-label small" for="in1">Baik (Menyadari Kondisi)</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="mse_insight" id="in2" value="Kurang" <?= $in === 'Kurang' ? 'checked' : '' ?>>
                    <label class="form-check-label small text-danger" for="in2">Kurang / Denial</label>
                </div>
            </div>
        </div>

        <div class="border-top pt-3 mt-4 text-end">
            <button type="submit" class="btn btn-primary px-4 py-2 fw-semibold shadow-sm">
                <i class="bi bi-floppy-fill me-1"></i> Simpan Review MSE & Lanjut ke Form ITQ <i class="bi bi-arrow-right ms-1"></i>
            </button>
        </div>
    </form>
</div>
<?= $this->endSection() ?>
