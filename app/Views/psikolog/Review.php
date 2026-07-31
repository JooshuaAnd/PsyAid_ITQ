<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<style>
    .tabular-nums {
        font-variant-numeric: tabular-nums;
        font-feature-settings: "tnum";
    }

    /* Strict Max Rounded 8px (lg) Policy */
    .frost-card,
    .frost-hero,
    .frost-btn-primary,
    .frost-btn-danger,
    .frost-btn-reset,
    .posko-item-card,
    .btn,
    .modal-content,
    .badge,
    .form-control,
    .form-select,
    .progress,
    .alert,
    .card,
    .table-responsive {
        border-radius: 8px !important;
    }

    /* Frosted Glass UI Card System */
    .frost-card {
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.98) 0%, rgba(244, 251, 247, 0.9) 100%);
        backdrop-filter: blur(12px) saturate(160%);
        -webkit-backdrop-filter: blur(12px) saturate(160%);
        border: 1.5px solid #a7f3d0;
        box-shadow: 0 8px 24px -4px rgba(15, 23, 42, 0.06), 0 2px 6px -1px rgba(15, 23, 42, 0.02);
    }

    /* LIGHT GREEN PSYAID HERO CARD SYSTEM MATCHING POSKODETAIL */
    .frost-hero {
        background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 60%, #a7f3d0 100%);
        border: 1.5px solid #a7f3d0;
        color: #064e3b;
        position: relative;
        overflow: hidden;
        box-shadow: 0 10px 30px -4px rgba(16, 185, 129, 0.12), inset 0 1.5px 2px rgba(255, 255, 255, 0.85);
    }

    /* LIGHT GREEN BUTTON: PRIMARY ACTION */
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

    .frost-btn-reset {
        background: #ffffff !important;
        color: #475569 !important;
        border: 1.5px solid #cbd5e1 !important;
        border-radius: 8px !important;
        font-weight: 600 !important;
        font-size: 0.8125rem !important;
        padding: 0.45rem 0.85rem !important;
        transition: all 0.2s ease;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        text-decoration: none;
    }

    .frost-btn-reset:hover {
        background-color: #f8fafc !important;
        color: #0f172a !important;
        border-color: #94a3b8 !important;
    }

    /* INNER POSKO ITEM CARD: SOFT MINT & PURE WHITE DISTINCT SURFACE */
    .posko-item-card {
        background: #ffffff !important;
        border: 1.5px solid #d1fae5 !important;
        border-radius: 8px !important;
        box-shadow: 0 4px 12px -2px rgba(16, 185, 129, 0.08), 0 2px 5px -1px rgba(15, 23, 42, 0.04) !important;
        transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1) !important;
    }

    .posko-item-card:hover {
        background: #ffffff !important;
        border-color: #34d399 !important;
        box-shadow: 0 12px 28px -4px rgba(16, 185, 129, 0.18), 0 4px 10px -2px rgba(15, 23, 42, 0.04) !important;
        transform: translateY(-2px) !important;
    }

    /* CUSTOM INPUT & SELECT FIELD */
    .form-control,
    .form-select {
        background: #ffffff !important;
        border: 1.5px solid #cbd5e1 !important;
        border-radius: 8px !important;
        padding: 0.5rem 0.75rem !important;
        font-size: 0.875rem !important;
        font-weight: 600 !important;
        color: #0f172a !important;
        transition: all 0.2s ease;
        box-shadow: 0 1px 3px rgba(15, 23, 42, 0.04);
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #059669 !important;
        box-shadow: 0 0 0 3.5px rgba(5, 150, 105, 0.18) !important;
        outline: none;
    }

    .form-check-input:checked {
        background-color: #059669 !important;
        border-color: #059669 !important;
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

    @media (max-width: 767.98px) {
        .frost-hero .card-body {
            padding: 1.15rem !important;
        }

        .frost-hero h3 {
            font-size: 1.25rem !important;
        }

        .posko-item-card {
            padding: 1.15rem !important;
        }
    }
</style>

<div class="container-fluid px-0">

    <!-- Hero Header Card (Matching VictimDetail style) -->
    <div class="card frost-hero mb-4">
        <div class="card-body p-4 position-relative">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-2">
                <div class="d-flex align-items-center gap-2 flex-wrap">
                    <span class="badge px-3 py-1.5 fs-8 fw-bold"
                        style="background-color: rgba(6, 95, 70, 0.12); color: #065f46; border: 1px solid rgba(6, 95, 70, 0.25);">
                        <i class="bi bi-clipboard2-pulse-fill me-1" style="color: #059669;"></i> CLINICAL EVALUATION
                        WORKSPACE
                    </span>
                    <span class="badge px-3 py-1.5 fs-8"
                        style="background-color: rgba(6, 95, 70, 0.08); color: #047857; border: 1px solid rgba(6, 95, 70, 0.18);">
                        <i class="bi bi-house-heart-fill me-1"></i> <?= esc($victim['posko_name']) ?>
                    </span>
                </div>
            </div>
            <h3 class="fw-bold mb-1" style="color: #064e3b;">
                <i class="bi bi-person-lines-fill me-2" style="color: #059669;"></i> Form Review Klinis & Mental Status
                Examination (MSE)
            </h3>
            <p class="small mb-0" style="color: #047857; max-width: 75ch;">
                Penyintas: <strong><?= esc($victim['nama']) ?></strong> (NIK: <?= esc($victim['nik'] ?? '-') ?>) •
                <?= esc($victim['posko_name']) ?>
            </p>
        </div>
    </div>

    <!-- Read-Only Summary Section of Victim's Data (Matched with VictimDetail Section 5 Summary Style) -->
    <div class="card posko-item-card p-4 mb-4">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3 border-bottom pb-3">
            <h5 class="fw-bold mb-0 d-flex align-items-center" style="color: #064e3b;">
                <i class="bi bi-file-earmark-medical text-success me-2 fs-5"></i> Ringkasan Data Lapangan (Read-Only
                Summary for Clinical Decision)
            </h5>
        </div>

        <div class="row g-3">
            <!-- Identitas & Bencana -->
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card posko-item-card p-3 p-md-3.5 h-100">
                    <div class="text-secondary fs-8 fw-bold text-uppercase" style="letter-spacing: 0.03em;">Identitas &
                        Bencana</div>
                    <hr class="my-2 opacity-25" style="color: #059669;" />
                    <div class="small text-muted mb-1">Gender: <strong><?= esc($victim['jenis_kelamin']) ?></strong> •
                        Umur: <strong><?= esc($victim['umur']) ?> Thn</strong></div>
                    <div class="small text-muted mb-1">Datang: <strong><?= esc($victim['tanggal_datang']) ?></strong>
                    </div>
                    <div class="small text-muted mb-1">Bencana:
                        <strong><?= esc($disaster['jenis_bencana'] ?? $victim['posko_bencana']) ?></strong></div>
                    <div class="small text-muted">Terjebak: <strong
                            class="text-danger"><?= esc($disaster['durasi_terjebak'] ?? '<1 jam') ?></strong></div>
                </div>
            </div>

            <!-- Riwayat Psikologis -->
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card posko-item-card p-3 p-md-3.5 h-100">
                    <div class="text-secondary fs-8 fw-bold text-uppercase" style="letter-spacing: 0.03em;">Riwayat
                        Medis/Psikologis</div>
                    <hr class="my-2 opacity-25" style="color: #059669;" />
                    <div class="small text-muted mb-1">Konsultasi:
                        <strong><?= !empty($psychHist['pernah_konsultasi']) ? 'Ya' : 'Tidak' ?></strong></div>
                    <div class="small text-muted mb-1">Psikiater:
                        <strong><?= !empty($psychHist['pernah_dirawat_psikiater']) ? 'Ya' : 'Tidak' ?></strong></div>
                    <div class="small text-muted">Self-Harm/Bunuh Diri: <strong
                            class="<?= (!empty($psychHist['riwayat_percobaan_bunuh_diri']) || !empty($psychHist['riwayat_melukai_diri'])) ? 'text-danger fw-bold' : '' ?>"><?= (!empty($psychHist['riwayat_percobaan_bunuh_diri']) || !empty($psychHist['riwayat_melukai_diri'])) ? 'Ya' : 'Tidak' ?></strong>
                    </div>
                </div>
            </div>

            <!-- Skrining Relawan -->
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card posko-item-card p-3 p-md-3.5 h-100">
                    <div class="text-secondary fs-8 fw-bold text-uppercase" style="letter-spacing: 0.03em;">Skrining
                        Relawan</div>
                    <hr class="my-2 opacity-25" style="color: #059669;" />
                    <div class="small text-muted mb-1">Kontak Mata:
                        <strong><?= esc($screening['kontak_mata'] ?? '-') ?></strong></div>
                    <div class="small text-muted">Bicara: <strong><?= esc($screening['bicara'] ?? '-') ?></strong></div>
                </div>
            </div>

            <!-- AI Decision Support -->
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card posko-item-card p-3 p-md-3.5 h-100">
                    <div class="text-secondary fs-8 fw-bold text-uppercase" style="letter-spacing: 0.03em;">AI Clinical
                        Decision Support</div>
                    <hr class="my-2 opacity-25" style="color: #059669;" />
                    <div class="mb-1.5 d-flex align-items-center gap-1 flex-wrap">
                        <?php $risk = strtolower($aiAssessment['risk_level'] ?? 'low'); ?>
                        <?php if ($risk === 'high'): ?>
                            <span class="badge fs-8 px-2.5 py-1 fw-bold"
                                style="background: #fee2e2; color: #991b1b; border: 1px solid #fca5a5;">
                                <i class="bi bi-exclamation-triangle-fill me-1"></i> HIGH RISK
                            </span>
                        <?php elseif ($risk === 'medium'): ?>
                            <span class="badge fs-8 px-2.5 py-1 fw-bold"
                                style="background: #fef3c7; color: #92400e; border: 1px solid #fcd34d;">
                                <i class="bi bi-dash-circle-fill me-1"></i> MEDIUM RISK
                            </span>
                        <?php else: ?>
                            <span class="badge fs-8 px-2.5 py-1 fw-bold"
                                style="background: #d1fae5; color: #065f46; border: 1px solid #a7f3d0;">
                                <i class="bi bi-check-circle-fill me-1"></i> LOW RISK
                            </span>
                        <?php endif; ?>
                        <span
                            class="badge bg-light text-dark border fs-8"><?= esc($aiAssessment['confidence'] ?? 85) ?>%
                            Conf</span>
                    </div>
                    <div class="fs-8 text-muted fw-semibold text-break">
                        <?= esc($aiAssessment['kemungkinan_diagnosis'] ?? 'Acute Stress Disorder') ?></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Psychologist Review Form (Chief Complaint & MSE) -->
    <div class="card posko-item-card p-4 mb-4">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3 border-bottom pb-3">
            <div>
                <h5 class="fw-bold mb-1 d-flex align-items-center" style="color: #064e3b;">
                    <i class="bi bi-stethoscope text-success me-2 fs-5"></i> Form Evaluasi Klinis Psikolog
                </h5>
                <p class="text-muted small mb-0">Isi keluhan utama (Chief Complaint) dan 8 komponen Mental Status
                    Examination (MSE).</p>
            </div>
        </div>

        <form action="<?= site_url('/psychologist-review/store/' . $victim['id']) ?>" method="POST">
            <?= csrf_field() ?>

            <!-- Chief Complaint -->
            <div class="mb-4">
                <label for="chief_complaint" class="form-label fw-semibold" style="color: #064e3b;">Chief Complaint
                    (Keluhan Utama Penyintas) <span class="text-danger">*</span></label>
                <textarea class="form-control" id="chief_complaint" name="chief_complaint" rows="3"
                    placeholder="Tuliskan keluhan utama yang disampaikan langsung oleh penyintas atau keluarga..."
                    required><?= old('chief_complaint', $review['chief_complaint'] ?? '') ?></textarea>
            </div>

            <!-- 8 Komponen Mental Status Examination (MSE) -->
            <h6 class="fw-bold mb-3" style="color: #064e3b;"><i class="bi bi-clipboard2-pulse me-1 text-success"></i>
                Mental Status Examination (MSE)</h6>

            <div class="p-3.5 p-md-4 rounded-3 mb-4"
                style="background: #f8fafc; border: 1.5px solid #e2e8f0; border-radius: 8px !important;">
                <div class="row g-3">
                    <!-- 1. Appearance -->
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="card posko-item-card p-3 h-100">
                            <label class="form-label small fw-bold d-block mb-2 pb-1 border-bottom" style="color: #064e3b;">1. Appearance (Penampilan)</label>
                            <?php $app = old('mse_appearance', $review['mse_appearance'] ?? 'Normal'); ?>
                            <div class="form-check mb-1">
                                <input class="form-check-input" type="radio" name="mse_appearance" id="app1" value="Normal" <?= $app === 'Normal' ? 'checked' : '' ?>>
                                <label class="form-check-label small" for="app1">Normal / Rapi</label>
                            </div>
                            <div class="form-check mb-1">
                                <input class="form-check-input" type="radio" name="mse_appearance" id="app2" value="Kurang terawat" <?= $app === 'Kurang terawat' ? 'checked' : '' ?>>
                                <label class="form-check-label small text-warning" for="app2">Kurang terawat</label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="mse_appearance" id="app3" value="Cedera" <?= $app === 'Cedera' ? 'checked' : '' ?>>
                                <label class="form-check-label small text-danger" for="app3">Cedera / Kotor Bencana</label>
                            </div>
                            <input type="text" class="form-control form-control-sm mt-auto" name="mse_appearance_note" placeholder="Catatan tambahan (opsional)..." value="<?= esc(old('mse_appearance_note', $review['mse_appearance_note'] ?? '')) ?>">
                        </div>
                    </div>

                    <!-- 2. Behavior -->
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="card posko-item-card p-3 h-100">
                            <label class="form-label small fw-bold d-block mb-2 pb-1 border-bottom" style="color: #064e3b;">2. Behavior (Perilaku / Sikap)</label>
                            <?php $beh = old('mse_behavior', $review['mse_behavior'] ?? 'Kooperatif'); ?>
                            <div class="form-check mb-1">
                                <input class="form-check-input" type="radio" name="mse_behavior" id="beh1" value="Kooperatif" <?= $beh === 'Kooperatif' ? 'checked' : '' ?>>
                                <label class="form-check-label small" for="beh1">Kooperatif</label>
                            </div>
                            <div class="form-check mb-1">
                                <input class="form-check-input" type="radio" name="mse_behavior" id="beh2" value="Gelisah" <?= $beh === 'Gelisah' ? 'checked' : '' ?>>
                                <label class="form-check-label small text-warning" for="beh2">Gelisah / Agitasi</label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="mse_behavior" id="beh3" value="Agresif" <?= $beh === 'Agresif' ? 'checked' : '' ?>>
                                <label class="form-check-label small text-danger" for="beh3">Agresif / Unkooperatif</label>
                            </div>
                            <input type="text" class="form-control form-control-sm mt-auto" name="mse_behavior_note" placeholder="Catatan tambahan (opsional)..." value="<?= esc(old('mse_behavior_note', $review['mse_behavior_note'] ?? '')) ?>">
                        </div>
                    </div>

                    <!-- 3. Speech -->
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="card posko-item-card p-3 h-100">
                            <label class="form-label small fw-bold d-block mb-2 pb-1 border-bottom" style="color: #064e3b;">3. Speech (Bicara)</label>
                            <?php $sp = old('mse_speech', $review['mse_speech'] ?? 'Normal'); ?>
                            <div class="form-check mb-1">
                                <input class="form-check-input" type="radio" name="mse_speech" id="sp1" value="Normal" <?= $sp === 'Normal' ? 'checked' : '' ?>>
                                <label class="form-check-label small" for="sp1">Normal</label>
                            </div>
                            <div class="form-check mb-1">
                                <input class="form-check-input" type="radio" name="mse_speech" id="sp2" value="Lambat" <?= $sp === 'Lambat' ? 'checked' : '' ?>>
                                <label class="form-check-label small text-warning" for="sp2">Lambat / Terbata</label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="mse_speech" id="sp3" value="Cepat" <?= $sp === 'Cepat' ? 'checked' : '' ?>>
                                <label class="form-check-label small text-danger" for="sp3">Cepat / Pressured</label>
                            </div>
                            <input type="text" class="form-control form-control-sm mt-auto" name="mse_speech_note" placeholder="Catatan tambahan (opsional)..." value="<?= esc(old('mse_speech_note', $review['mse_speech_note'] ?? '')) ?>">
                        </div>
                    </div>

                    <!-- 4. Mood -->
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="card posko-item-card p-3 h-100">
                            <label class="form-label small fw-bold d-block mb-2 pb-1 border-bottom" style="color: #064e3b;">4. Mood (Suasana Hati)</label>
                            <?php $mo = old('mse_mood', $review['mse_mood'] ?? 'Sedih'); ?>
                            <div class="form-check mb-1">
                                <input class="form-check-input" type="radio" name="mse_mood" id="mo1" value="Sedih" <?= $mo === 'Sedih' ? 'checked' : '' ?>>
                                <label class="form-check-label small" for="mo1">Sedih / Depresif</label>
                            </div>
                            <div class="form-check mb-1">
                                <input class="form-check-input" type="radio" name="mse_mood" id="mo2" value="Cemas" <?= $mo === 'Cemas' ? 'checked' : '' ?>>
                                <label class="form-check-label small text-warning" for="mo2">Cemas / Anxious</label>
                            </div>
                            <div class="form-check mb-1">
                                <input class="form-check-input" type="radio" name="mse_mood" id="mo3" value="Marah" <?= $mo === 'Marah' ? 'checked' : '' ?>>
                                <label class="form-check-label small text-danger" for="mo3">Marah / Irritabel</label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="mse_mood" id="mo4" value="Netral" <?= $mo === 'Netral' ? 'checked' : '' ?>>
                                <label class="form-check-label small text-muted" for="mo4">Netral / Eutimik</label>
                            </div>
                            <input type="text" class="form-control form-control-sm mt-auto" name="mse_mood_note" placeholder="Catatan tambahan (opsional)..." value="<?= esc(old('mse_mood_note', $review['mse_mood_note'] ?? '')) ?>">
                        </div>
                    </div>

                    <!-- 5. Affect -->
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="card posko-item-card p-3 h-100">
                            <label class="form-label small fw-bold d-block mb-2 pb-1 border-bottom" style="color: #064e3b;">5. Affect (Afek)</label>
                            <?php $af = old('mse_affect', $review['mse_affect'] ?? 'Sesuai'); ?>
                            <div class="form-check mb-1">
                                <input class="form-check-input" type="radio" name="mse_affect" id="af1" value="Sesuai" <?= $af === 'Sesuai' ? 'checked' : '' ?>>
                                <label class="form-check-label small" for="af1">Sesuai (Appropriate)</label>
                            </div>
                            <div class="form-check mb-1">
                                <input class="form-check-input" type="radio" name="mse_affect" id="af2" value="Datar" <?= $af === 'Datar' ? 'checked' : '' ?>>
                                <label class="form-check-label small text-warning" for="af2">Datar / Tumpul (Blunted)</label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="mse_affect" id="af3" value="Labil" <?= $af === 'Labil' ? 'checked' : '' ?>>
                                <label class="form-check-label small text-danger" for="af3">Labil (Labile)</label>
                            </div>
                            <input type="text" class="form-control form-control-sm mt-auto" name="mse_affect_note" placeholder="Catatan tambahan (opsional)..." value="<?= esc(old('mse_affect_note', $review['mse_affect_note'] ?? '')) ?>">
                        </div>
                    </div>

                    <!-- 6. Thought -->
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="card posko-item-card p-3 h-100">
                            <label class="form-label small fw-bold d-block mb-2 pb-1 border-bottom" style="color: #064e3b;">6. Thought (Proses/Isi Pikir)</label>
                            <?php $th = old('mse_thought', $review['mse_thought'] ?? 'Normal'); ?>
                            <div class="form-check mb-1">
                                <input class="form-check-input" type="radio" name="mse_thought" id="th1" value="Normal" <?= $th === 'Normal' ? 'checked' : '' ?>>
                                <label class="form-check-label small" for="th1">Normal / Realistis</label>
                            </div>
                            <div class="form-check mb-1">
                                <input class="form-check-input" type="radio" name="mse_thought" id="th2" value="Obsesi" <?= $th === 'Obsesi' ? 'checked' : '' ?>>
                                <label class="form-check-label small text-warning" for="th2">Obsesi / Ruminasi</label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="mse_thought" id="th3" value="Delusi" <?= $th === 'Delusi' ? 'checked' : '' ?>>
                                <label class="form-check-label small text-danger" for="th3">Delusi / Waham</label>
                            </div>
                            <input type="text" class="form-control form-control-sm mt-auto" name="mse_thought_note" placeholder="Catatan tambahan (opsional)..." value="<?= esc(old('mse_thought_note', $review['mse_thought_note'] ?? '')) ?>">
                        </div>
                    </div>

                    <!-- 7. Orientation -->
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="card posko-item-card p-3 h-100">
                            <label class="form-label small fw-bold d-block mb-2 pb-1 border-bottom" style="color: #064e3b;">7. Orientation (Orientasi)</label>
                            <?php $or = old('mse_orientation', $review['mse_orientation'] ?? 'Baik'); ?>
                            <div class="form-check mb-1">
                                <input class="form-check-input" type="radio" name="mse_orientation" id="or1" value="Baik" <?= $or === 'Baik' ? 'checked' : '' ?>>
                                <label class="form-check-label small" for="or1">Baik (Orang/Tempat/Waktu)</label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="mse_orientation" id="or2" value="Kurang" <?= $or === 'Kurang' ? 'checked' : '' ?>>
                                <label class="form-check-label small text-danger" for="or2">Kurang / Disorientasi</label>
                            </div>
                            <input type="text" class="form-control form-control-sm mt-auto" name="mse_orientation_note" placeholder="Catatan tambahan (opsional)..." value="<?= esc(old('mse_orientation_note', $review['mse_orientation_note'] ?? '')) ?>">
                        </div>
                    </div>

                    <!-- 8. Insight -->
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="card posko-item-card p-3 h-100">
                            <label class="form-label small fw-bold d-block mb-2 pb-1 border-bottom" style="color: #064e3b;">8. Insight (Daya Nilai Diri)</label>
                            <?php $in = old('mse_insight', $review['mse_insight'] ?? 'Baik'); ?>
                            <div class="form-check mb-1">
                                <input class="form-check-input" type="radio" name="mse_insight" id="in1" value="Baik" <?= $in === 'Baik' ? 'checked' : '' ?>>
                                <label class="form-check-label small" for="in1">Baik (Menyadari Kondisi)</label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="mse_insight" id="in2" value="Kurang" <?= $in === 'Kurang' ? 'checked' : '' ?>>
                                <label class="form-check-label small text-danger" for="in2">Kurang / Denial</label>
                            </div>
                            <input type="text" class="form-control form-control-sm mt-auto" name="mse_insight_note" placeholder="Catatan tambahan (opsional)..." value="<?= esc(old('mse_insight_note', $review['mse_insight_note'] ?? '')) ?>">
                        </div>
                    </div>

                    <!-- 9. Perception -->
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="card posko-item-card p-3 h-100">
                            <label class="form-label small fw-bold d-block mb-2 pb-1 border-bottom" style="color: #064e3b;">9. Perception (Persepsi/Halusinasi)</label>
                            <?php $per = old('mse_perception', $review['mse_perception'] ?? 'Normal'); ?>
                            <div class="form-check mb-1">
                                <input class="form-check-input" type="radio" name="mse_perception" id="per1" value="Normal" <?= $per === 'Normal' ? 'checked' : '' ?>>
                                <label class="form-check-label small" for="per1">Normal (Tidak ada kelainan)</label>
                            </div>
                            <div class="form-check mb-1">
                                <input class="form-check-input" type="radio" name="mse_perception" id="per2" value="Ilusi" <?= $per === 'Ilusi' ? 'checked' : '' ?>>
                                <label class="form-check-label small text-warning" for="per2">Ilusi / Miskonsepsi</label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="mse_perception" id="per3" value="Halusinasi" <?= $per === 'Halusinasi' ? 'checked' : '' ?>>
                                <label class="form-check-label small text-danger" for="per3">Halusinasi (Visual/Auditori)</label>
                            </div>
                            <input type="text" class="form-control form-control-sm mt-auto" name="mse_perception_note" placeholder="Catatan tambahan (opsional)..." value="<?= esc(old('mse_perception_note', $review['mse_perception_note'] ?? '')) ?>">
                        </div>
                    </div>

                    <!-- 10. Risk Assessment -->
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="card posko-item-card p-3 h-100 border-danger" style="border-width: 2px !important;">
                            <label class="form-label small fw-bold d-block mb-2 pb-1 border-bottom text-danger">10. Risk Assessment (Risiko Kritis)</label>
                            <?php $risk = old('risk_assessment', $review['risk_assessment'] ?? 'Aman'); ?>
                            <div class="form-check mb-1">
                                <input class="form-check-input" type="radio" name="risk_assessment" id="risk1" value="Aman" <?= $risk === 'Aman' ? 'checked' : '' ?>>
                                <label class="form-check-label small" for="risk1">Aman (Tidak berisiko)</label>
                            </div>
                            <div class="form-check mb-1">
                                <input class="form-check-input" type="radio" name="risk_assessment" id="risk2" value="Self-Harm" <?= $risk === 'Self-Harm' ? 'checked' : '' ?>>
                                <label class="form-check-label small text-warning" for="risk2">Potensi Self-Harm</label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="risk_assessment" id="risk3" value="Suicide/Homicide" <?= $risk === 'Suicide/Homicide' ? 'checked' : '' ?>>
                                <label class="form-check-label small text-danger fw-bold" for="risk3">Potensi Bunuh Diri/Kekerasan</label>
                            </div>
                            <input type="text" class="form-control form-control-sm mt-auto" name="risk_assessment_note" placeholder="Catatan tambahan (opsional)..." value="<?= esc(old('risk_assessment_note', $review['risk_assessment_note'] ?? '')) ?>">
                        </div>
                    </div>
                </div>
            </div>

            <div class="border-top pt-3 mt-4 text-end">
                <button type="submit" class="frost-btn-primary px-4 py-2">
                    <i class="bi bi-floppy-fill me-1"></i> Simpan Review MSE & Lanjut ke Form ITQ <i
                        class="bi bi-arrow-right ms-1"></i>
                </button>
            </div>
        </form>
    </div>

</div>
<?= $this->endSection() ?>