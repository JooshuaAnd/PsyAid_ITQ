<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<style>
    .tabular-nums { font-variant-numeric: tabular-nums; font-feature-settings: "tnum"; }
    .frost-card, .frost-hero, .frost-btn-primary, .frost-btn-reset, .frost-input-field, .frost-custom-trigger, .frost-custom-menu, .posko-item-card, .clinical-panel, .clinical-action-form, .btn, .badge, .form-control, .form-select, .card, .table-responsive { border-radius: 8px !important; }
    .frost-hero { background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 60%, #a7f3d0 100%); border: 1.5px solid #a7f3d0; color: #064e3b; position: relative; overflow: hidden; box-shadow: 0 10px 30px -4px rgba(16, 185, 129, 0.12), inset 0 1.5px 2px rgba(255, 255, 255, 0.85); }
    .frost-btn-primary { background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%); color: #065f46 !important; border: 1.5px solid #34d399; font-weight: 700; font-size: 0.8125rem; padding: 0.45rem 0.95rem; transition: all 0.2s ease; display: inline-flex; align-items: center; gap: 0.35rem; cursor: pointer; box-shadow: 0 2px 6px rgba(16, 185, 129, 0.15); }
    .frost-btn-primary:hover { background: linear-gradient(135deg, #a7f3d0 0%, #6ee7b7 100%); color: #064e3b !important; border-color: #10b981; box-shadow: 0 4px 12px rgba(16, 185, 129, 0.25); transform: translateY(-1px); }
    .frost-btn-reset { background: #ffffff !important; color: #475569 !important; border: 1.5px solid #cbd5e1 !important; border-radius: 8px !important; font-weight: 600 !important; font-size: 0.8125rem !important; padding: 0.45rem 0.85rem !important; transition: all 0.2s ease; cursor: pointer; display: inline-flex; align-items: center; gap: 0.35rem; text-decoration: none; }
    .frost-btn-reset:hover { background-color: #f8fafc !important; color: #0f172a !important; border-color: #94a3b8 !important; }
    .posko-item-card { background: #ffffff !important; border: 1.5px solid #d1fae5 !important; box-shadow: 0 4px 12px -2px rgba(16, 185, 129, 0.08), 0 2px 5px -1px rgba(15, 23, 42, 0.04) !important; transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1) !important; }
    .posko-item-card:hover { background: #ffffff !important; border-color: #34d399 !important; box-shadow: 0 12px 28px -4px rgba(16, 185, 129, 0.18), 0 4px 10px -2px rgba(15, 23, 42, 0.04) !important; transform: translateY(-2px) !important; }
    .table-itq { width: 100%; border-collapse: collapse; margin-bottom: 2rem; font-size: 0.875rem; }
    .table-itq th, .table-itq td { border: 1px solid #cbd5e1; padding: 11px 14px; text-align: center; line-height: 1.45; vertical-align: middle; }
    .table-itq th { background-color: #f8fafc; font-weight: 600; color: #334155; }
    .table-itq .header-row { background: linear-gradient(135deg, #065f46 0%, #047857 100%); text-align: left; font-size: 1rem; font-weight: 700; color: #ffffff; padding: 12px 16px; border: none; }
    .table-itq .sub-header { border-bottom: 2px solid #a7f3d0; }
    .table-itq td.text-start { text-align: left; }
    .bg-severe { background-color: #fecaca !important; color: #991b1b; }
    .bg-very-severe { background-color: #fca5a5 !important; color: #7f1d1d; }
    .bg-moderate { background-color: #fef08a !important; color: #854d0e; }
    .bg-mild { background-color: #fef9c3 !important; color: #a16207; }
    .bg-minimal { background-color: #ffffff !important; color: #475569; }
    .frost-input-field {
        width: 100%;
        background: #ffffff;
        border: 1.5px solid #cbd5e1;
        padding: 0.55rem 0.85rem;
        color: #0f172a;
        font-size: 0.875rem;
        font-weight: 600;
        line-height: 1.5;
        box-shadow: 0 1px 3px rgba(15, 23, 42, 0.04);
        transition: all 0.2s ease;
    }
    .frost-input-field:hover:not(:disabled), .clinical-action-form .form-control:hover:not(:disabled), .clinical-action-form .form-select:hover:not(:disabled) { border-color: #059669; background-color: #f4fbf7; }
    .frost-input-field:focus, .clinical-action-form .form-control:focus, .clinical-action-form .form-select:focus { border-color: #059669; box-shadow: 0 0 0 3.5px rgba(5, 150, 105, 0.18); background-color: #ffffff; outline: none; }
    .frost-input-field::placeholder { color: #94a3b8; font-weight: 500; }
    .frost-date-field { position: relative; }
    .frost-date-field .date-icon { position: absolute; left: 0.85rem; top: 50%; transform: translateY(-50%); color: #059669; pointer-events: none; z-index: 2; }
    .frost-date-field .frost-input-field { padding-left: 2.45rem; }
    .frost-custom-select-wrapper { position: relative; z-index: 10; }
    .frost-custom-select-wrapper.active-dropdown { z-index: 1060 !important; }
    .frost-custom-trigger {
        background: #ffffff;
        border: 1.5px solid #cbd5e1;
        padding: 0.55rem 0.85rem;
        font-size: 0.875rem;
        font-weight: 600;
        color: #0f172a;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: space-between;
        cursor: pointer;
        transition: all 0.2s ease;
        box-shadow: 0 1px 3px rgba(15, 23, 42, 0.04);
        user-select: none;
    }
    .frost-custom-trigger:hover { border-color: #059669; background-color: #f4fbf7; }
    .frost-custom-trigger.active { border-color: #059669; box-shadow: 0 0 0 3.5px rgba(5, 150, 105, 0.18); background-color: #ffffff; }
    .frost-custom-trigger .chevron-icon { color: #059669; font-size: 0.9rem; transition: transform 0.2s ease; }
    .frost-custom-trigger.active .chevron-icon { transform: rotate(180deg); }
    .frost-custom-menu {
        position: absolute;
        top: calc(100% + 6px);
        left: 0;
        right: 0;
        z-index: 1070 !important;
        background: rgba(255, 255, 255, 0.98);
        backdrop-filter: blur(20px) saturate(180%);
        -webkit-backdrop-filter: blur(20px) saturate(180%);
        border: 1px solid rgba(5, 150, 105, 0.3);
        box-shadow: 0 16px 40px -4px rgba(15, 23, 42, 0.18), 0 4px 16px rgba(0, 0, 0, 0.06);
        max-height: 260px;
        overflow-y: auto;
        padding: 0.35rem;
        display: none;
    }
    .frost-custom-menu.show { display: block; }
    .frost-custom-option {
        padding: 0.55rem 0.75rem;
        font-size: 0.85rem;
        font-weight: 500;
        color: #334155;
        border-radius: 6px;
        cursor: pointer;
        transition: all 0.15s ease;
        display: flex;
        align-items: center;
        gap: 0.45rem;
    }
    .frost-custom-option:hover { background-color: #ecfdf5; color: #065f46; }
    .frost-custom-option.selected { background-color: #d1fae5; color: #065f46; font-weight: 700; }
    .frost-custom-option.selected::before { content: "\2713"; color: #059669; font-weight: 800; }
    .clinical-badge {
        border: 1px solid transparent !important;
        font-weight: 700 !important;
        font-size: 0.75rem !important;
        padding: 0.4rem 0.65rem !important;
        box-shadow: 0 1px 2px rgba(15, 23, 42, 0.04);
    }
    .clinical-badge--success { background-color: #ecfdf5 !important; color: #047857 !important; border-color: #a7f3d0 !important; }
    .clinical-badge--warning { background-color: #fffbeb !important; color: #b45309 !important; border-color: #fde68a !important; }
    .clinical-badge--danger { background-color: #fef2f2 !important; color: #dc2626 !important; border-color: #fecdd3 !important; }
    .clinical-badge--neutral { background-color: #f8fafc !important; color: #475569 !important; border-color: #e2e8f0 !important; }
    .clinical-badge--critical { background-color: #fef2f2 !important; color: #dc2626 !important; border-color: #fecdd3 !important; }
    .clinical-badge--ai { background-color: #ecfdf5 !important; color: #065f46 !important; border-color: #a7f3d0 !important; }

    /* Informasi terpadu & aksi klinis */
    .clinical-integration-card { padding: clamp(1rem, 2.5vw, 1.5rem); }
    .clinical-section-title { display: flex; align-items: center; gap: 0.625rem; margin-bottom: 1.25rem; color: #0f172a; }
    .clinical-section-title i { flex: 0 0 auto; }
    .clinical-panel { height: 100%; padding: 1.25rem; border: 1.5px solid #d1fae5; border-radius: 8px; overflow-wrap: anywhere; box-shadow: 0 1px 3px rgba(15, 23, 42, 0.03); }
    .clinical-panel--volunteer { background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%); }
    .clinical-panel--ai { background: linear-gradient(135deg, #ffffff 0%, #ecfdf5 100%); }
    .clinical-panel--mse { background: linear-gradient(135deg, #ffffff 0%, #f0fdf4 100%); }
    .clinical-panel__title { display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1rem; padding-bottom: 0.75rem; border-bottom: 1px solid #d1fae5; color: #065f46 !important; }
    .clinical-panel__content { display: grid; gap: 1rem; }
    .clinical-field { min-width: 0; }
    .clinical-field__label { display: block; margin-bottom: 0.3rem; color: #64748b; font-size: 0.78rem; font-weight: 600; line-height: 1.35; }
    .clinical-field__value { margin: 0; color: #1e293b; line-height: 1.55; }
    .clinical-field__note { display: block; margin-top: 0.3rem; color: #64748b; font-size: 0.78rem; font-style: italic; line-height: 1.45; }
    .clinical-badge-list { display: flex; flex-wrap: wrap; align-items: flex-start; gap: 0.4rem; }
    .clinical-badge-list .badge { line-height: 1.2; white-space: normal; text-align: left; }
    .clinical-quote { margin: 0; padding: 0.65rem 0.8rem; border: 1px solid #e2e8f0; background: rgba(255, 255, 255, 0.78); border-radius: 8px; color: #334155; font-style: italic; line-height: 1.55; }
    .clinical-empty { margin: 0; color: #64748b; font-size: 0.875rem; line-height: 1.5; }
    .mse-grid { display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: 1rem; }
    .mse-item { min-width: 0; padding: 0.75rem; background: rgba(255, 255, 255, 0.78); border: 1px solid #d1fae5; border-radius: 8px; }
    .mse-item .clinical-field__label { padding-bottom: 0.45rem; margin-bottom: 0.55rem; border-bottom: 1px solid #e2e8f0; }
    .mse-chief-complaint { margin-bottom: 1rem; padding: 0.85rem 1rem; background: rgba(255, 255, 255, 0.82); border: 1px solid #e2e8f0; border-radius: 8px; }
    .clinical-action-form { margin-top: 1.5rem; padding: 1.25rem; background: linear-gradient(135deg, rgba(255, 255, 255, 0.96) 0%, rgba(244, 251, 247, 0.8) 100%); border: 1.5px solid #d1fae5; border-radius: 8px; box-shadow: inset 0 1px 1.5px rgba(255, 255, 255, 0.95); }
    .clinical-action-form__title { display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1.25rem; padding-bottom: 0.75rem; border-bottom: 1px solid #d1fae5; color: #065f46; }
    .clinical-action-form .form-label { margin-bottom: 0.45rem; color: #334155; font-size: 0.875rem; }

    @media (max-width: 991.98px) {
        .mse-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
    }
    @media (max-width: 575.98px) {
        .clinical-panel, .clinical-action-form { padding: 1rem; }
        .mse-grid { grid-template-columns: 1fr; gap: 0.75rem; }
        .clinical-action-form .frost-btn-primary { width: 100%; justify-content: center; }
    }
</style>

<?php
function getSeverityClass($sev) {
    if ($sev === 'Very Severe') return 'bg-very-severe';
    if ($sev === 'Severe') return 'bg-severe';
    if ($sev === 'Moderate') return 'bg-moderate';
    if ($sev === 'Mild') return 'bg-mild';
    return 'bg-minimal';
}
function getCriteriaClass($met) {
    return $met ? 'bg-severe' : 'bg-minimal';
}
?>

<div class="container-fluid px-0">

    <div class="card frost-hero mb-4">
        <div class="card-body p-4 position-relative">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-2">
                <div class="d-flex align-items-center gap-2 flex-wrap">
                    <span class="badge px-3 py-1.5 fs-8 fw-bold" style="background-color: rgba(6, 95, 70, 0.12); color: #065f46; border: 1px solid rgba(6, 95, 70, 0.25);">
                        <i class="bi bi-clipboard2-data-fill me-1" style="color: #059669;"></i> HASIL SKORING ITQ
                    </span>
                    <span class="badge px-3 py-1.5 fs-8" style="background-color: rgba(6, 95, 70, 0.08); color: #047857; border: 1px solid rgba(6, 95, 70, 0.18);">
                        ICD-11 PTSD & DSO
                    </span>
                </div>
                <div>
                    <a href="<?= site_url('/psikolog/dashboard') ?>" class="frost-btn-reset">
                        <i class="bi bi-arrow-left me-1"></i> Kembali ke Dashboard
                    </a>
                </div>
            </div>
            <h3 class="fw-bold mb-1" style="color: #064e3b;">
                <i class="bi bi-bar-chart-line-fill me-2" style="color: #059669;"></i> Laporan Klinis & Analisis ITQ
            </h3>
            <p class="small mb-0" style="color: #047857; max-width: 75ch;">
                Penyintas: <strong><?= esc($victim['nama']) ?></strong> (NIK: <?= esc($victim['nik'] ?? '-') ?>)
            </p>
        </div>
    </div>

    <!-- 1. TABEL HASIL ITQ (IMAGE 1) -->
    <div class="card posko-item-card p-4 mb-4">
        <h5 class="fw-bold mb-3" style="color: #0f172a;"><i class="bi bi-table text-primary me-2"></i> Laporan Detail Skor ITQ</h5>
        
        <div class="table-responsive">
            <table class="table-itq">
                <!-- RESULTS TABLE -->
                <tr><td colspan="5" class="header-row">Results</td></tr>
                <tr class="sub-header">
                    <th style="width: 30%;"></th>
                    <th style="width: 15%;">Raw Score (0-24)</th>
                    <th style="width: 15%;">Percentile</th>
                    <th style="width: 20%;">Descriptor</th>
                    <th style="width: 20%;">Diagnostic Criteria</th>
                </tr>
                <tr>
                    <td class="fw-bold bg-light">PTSD</td>
                    <td><?= $detailedSubScores['overall']['ptsd']['score'] ?></td>
                    <td><?= $detailedSubScores['overall']['ptsd']['percentile'] ?></td>
                    <td class="<?= getSeverityClass($detailedSubScores['overall']['ptsd']['severity']) ?>"><?= $detailedSubScores['overall']['ptsd']['severity'] ?></td>
                    <td class="<?= getCriteriaClass($detailedSubScores['overall']['ptsd']['criteria']) ?>"><?= $detailedSubScores['overall']['ptsd']['criteria'] ? 'Criteria met' : 'Criteria not met' ?></td>
                </tr>
                <tr>
                    <td class="fw-bold" style="background-color: #eff6ff;">DSO</td>
                    <td><?= $detailedSubScores['overall']['dso']['score'] ?></td>
                    <td><?= $detailedSubScores['overall']['dso']['percentile'] ?></td>
                    <td class="<?= getSeverityClass($detailedSubScores['overall']['dso']['severity']) ?>"><?= $detailedSubScores['overall']['dso']['severity'] ?></td>
                    <td class="<?= getCriteriaClass($detailedSubScores['overall']['dso']['criteria']) ?>"><?= $detailedSubScores['overall']['dso']['criteria'] ? 'Criteria met' : 'Criteria not met' ?></td>
                </tr>
                
                <tr><td colspan="5" style="border:none; height:28px;"></td></tr>

                <!-- PTSD SYMPTOMS TABLE -->
                <tr><td colspan="5" class="header-row">PTSD Symptoms and Functioning</td></tr>
                <tr class="sub-header">
                    <th></th>
                    <th>Raw Score</th>
                    <th>Percentile</th>
                    <th>Descriptor</th>
                    <th>Diagnostic Criteria</th>
                </tr>
                <?php foreach([
                    'Re-experiencing (0-8)' => $detailedSubScores['ptsd_symptoms']['reexp'],
                    'Avoidance (0-8)' => $detailedSubScores['ptsd_symptoms']['avoid'],
                    'Sense of threat (0-8)' => $detailedSubScores['ptsd_symptoms']['threat'],
                    'Functional impairment (0-12)' => $detailedSubScores['ptsd_symptoms']['impairment']
                ] as $label => $data): ?>
                <tr>
                    <td class="text-start ps-4"><?= $label ?></td>
                    <td><?= $data['score'] ?></td>
                    <td><?= $data['percentile'] ?></td>
                    <td class="<?= getSeverityClass($data['severity']) ?>"><?= $data['severity'] ?></td>
                    <td class="<?= getCriteriaClass($data['present']) ?>"><?= $data['present'] ? 'Present' : 'Absent' ?></td>
                </tr>
                <?php endforeach; ?>

                <tr><td colspan="5" style="border:none; height:28px;"></td></tr>

                <!-- DSO SYMPTOMS TABLE -->
                <tr><td colspan="5" class="header-row">DSO Symptoms and Functioning</td></tr>
                <tr class="sub-header">
                    <th></th>
                    <th>Raw Score</th>
                    <th>Percentile</th>
                    <th>Descriptor</th>
                    <th>Diagnostic Criteria</th>
                </tr>
                <?php foreach([
                    'Affective dysregulation (0-8)' => $detailedSubScores['dso_symptoms']['affect'],
                    'Negative self-concept (0-8)' => $detailedSubScores['dso_symptoms']['self'],
                    'Disturbances in relationships (0-8)' => $detailedSubScores['dso_symptoms']['rel'],
                    'Functional impairment (0-12)' => $detailedSubScores['dso_symptoms']['impairment']
                ] as $label => $data): ?>
                <tr>
                    <td class="text-start ps-4"><?= $label ?></td>
                    <td><?= $data['score'] ?></td>
                    <td><?= $data['percentile'] ?></td>
                    <td class="<?= getSeverityClass($data['severity']) ?>"><?= $data['severity'] ?></td>
                    <td class="<?= getCriteriaClass($data['present']) ?>"><?= $data['present'] ? 'Present' : 'Absent' ?></td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>

    <!-- 2. GRAFIK ITQ (IMAGE 2 & 3) -->
    <div class="card posko-item-card p-4 mb-4">
        <h5 class="fw-bold mb-4" style="color: #0f172a;"><i class="bi bi-graph-up text-primary me-2"></i> Visualisasi Data Klinis</h5>
        <div class="row g-4">
            <div class="col-12">
                <div class="p-3 bg-white" style="border: 1px solid #cbd5e1; border-radius: 8px;">
                    <h6 class="fw-bold text-center mb-3">ITQ Subscale Scores Compared to Normative Samples</h6>
                    <div style="position: relative; height: 350px;">
                        <canvas id="barChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="p-3 bg-white" style="border: 1px solid #cbd5e1; border-radius: 8px;">
                    <h6 class="fw-bold text-center mb-3">ITQ PTSD and DSO Symptom Severity Scores (Longitudinal)</h6>
                    <div style="position: relative; height: 350px;">
                        <canvas id="lineChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 3. SEGMEN INFORMASI TERPADU & FORM AKSI FINAL -->
    <div class="card posko-item-card clinical-integration-card mb-4">
        <h5 class="fw-bold clinical-section-title">
            <i class="bi bi-file-earmark-medical text-primary"></i>
            <span>Informasi Terpadu &amp; Aksi Klinis</span>
        </h5>
        
        <div class="row g-4">
            <!-- Review Relawan -->
            <div class="col-12 col-md-6">
                <section class="clinical-panel clinical-panel--volunteer">
                    <h6 class="clinical-panel__title fw-bold text-primary">
                        <i class="bi bi-person-badge"></i>
                        <span>Review Screening Relawan</span>
                    </h6>
                    <?php if($volunteerScreening): ?>
                        <div class="clinical-panel__content">
                            <div class="clinical-field">
                                <span class="clinical-field__label">Kondisi Observasi</span>
                                <div class="clinical-badge-list">
                            <?php 
                                $observations = [];
                                if(!empty($volunteerScreening['mampu_sebut_nama'])) $observations[] = '<span class="badge clinical-badge clinical-badge--success">Mampu Sebut Nama</span>';
                                if(!empty($volunteerScreening['mampu_sebut_lokasi']) && !empty($volunteerScreening['mampu_sebut_tanggal'])) $observations[] = '<span class="badge clinical-badge clinical-badge--success">Orientasi Baik</span>';
                                if(empty($volunteerScreening['mampu_sebut_nama']) || empty($volunteerScreening['mampu_sebut_lokasi'])) $observations[] = '<span class="badge clinical-badge clinical-badge--danger">Disorientasi</span>';
                                if(!empty($volunteerScreening['menangis_terus'])) $observations[] = '<span class="badge clinical-badge clinical-badge--danger">Menangis Terus</span>';
                                if(!empty($volunteerScreening['tampak_panik'])) $observations[] = '<span class="badge clinical-badge clinical-badge--warning">Tampak Panik</span>';
                                if(!empty($volunteerScreening['gemetar'])) $observations[] = '<span class="badge clinical-badge clinical-badge--warning">Gemetar</span>';
                                if(!empty($volunteerScreening['diam_total'])) $observations[] = '<span class="badge clinical-badge clinical-badge--neutral">Cenderung Diam/Stupor</span>';
                                if(!empty($volunteerScreening['berteriak_histeris'])) $observations[] = '<span class="badge clinical-badge clinical-badge--danger">Teriak Histeris</span>';
                                if(!empty($volunteerScreening['sulit_tidur'])) $observations[] = '<span class="badge clinical-badge clinical-badge--warning">Sulit Tidur</span>';
                                if(!empty($volunteerScreening['tidak_mau_makan'])) $observations[] = '<span class="badge clinical-badge clinical-badge--warning">Sulit Makan</span>';
                                if(!empty($volunteerScreening['mencari_keluarga'])) $observations[] = '<span class="badge clinical-badge clinical-badge--danger">Mencari/Terpisah Keluarga</span>';
                                if(!empty($volunteerScreening['menyebut_ingin_mati'])) $observations[] = '<span class="badge clinical-badge clinical-badge--critical">Menyebut Ingin Mati</span>';
                                if(!empty($volunteerScreening['melukai_diri'])) $observations[] = '<span class="badge clinical-badge clinical-badge--critical">Melukai Diri</span>';
                                if(!empty($volunteerScreening['mengancam_bunuh_diri'])) $observations[] = '<span class="badge clinical-badge clinical-badge--critical">Mengancam Bunuh Diri</span>';
                                if(!empty($volunteerScreening['agresif'])) $observations[] = '<span class="badge clinical-badge clinical-badge--danger">Agresif</span>';

                                echo empty($observations) ? '<span class="clinical-empty">Tidak ada temuan observasi.</span>' : implode('', $observations);
                            ?>
                                </div>
                            </div>
                            <div class="clinical-field">
                                <span class="clinical-field__label">Catatan Relawan</span>
                                <?php if(!empty($volunteerScreening['catatan_relawan'])): ?>
                                    <blockquote class="clinical-quote"><?= esc($volunteerScreening['catatan_relawan']) ?></blockquote>
                                <?php else: ?>
                                    <p class="clinical-empty">Tidak ada catatan tambahan.</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php else: ?>
                        <p class="clinical-empty">Tidak ada data screening relawan.</p>
                    <?php endif; ?>
                </section>
            </div>

            <!-- Analisis AI -->
            <div class="col-12 col-md-6">
                <section class="clinical-panel clinical-panel--ai">
                    <h6 class="clinical-panel__title fw-bold text-primary">
                        <i class="bi bi-robot"></i>
                        <span>Analisis Awal AI PsyAid</span>
                    </h6>
                    <?php if($aiAssessment): ?>
                        <div class="clinical-panel__content">
                            <div class="clinical-field">
                                <span class="clinical-field__label">Risk Level</span>
                                <?php
                                    $riskLevel = strtolower($aiAssessment['risk_level'] ?? '');
                                    $riskBadgeClass = in_array($riskLevel, ['high', 'tinggi', 'urgent'], true) ? 'clinical-badge--danger' : 'clinical-badge--ai';
                                ?>
                                <span class="badge clinical-badge <?= $riskBadgeClass ?>"><?= esc(strtoupper($aiAssessment['risk_level'] ?? '-')) ?></span>
                            </div>
                            <div class="clinical-field">
                                <span class="clinical-field__label">Rekomendasi Diagnosis</span>
                                <p class="clinical-field__value fw-semibold"><?= esc($aiAssessment['kemungkinan_diagnosis']) ?></p>
                            </div>
                            <div class="clinical-field">
                                <span class="clinical-field__label">Ringkasan AI</span>
                                <blockquote class="clinical-quote"><?= esc($aiAssessment['ai_summary']) ?></blockquote>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-info small mb-0 border-0 py-3 px-3" style="background: rgba(59, 130, 246, 0.1); line-height: 1.55;">
                            <i class="bi bi-info-circle me-1"></i> Analisis AI untuk Fase <?= $fase_ke ?> akan digenerate <b>secara otomatis</b> oleh sistem setelah Anda menyimpan form <i>Catatan & Rencana Follow-up Psikolog</i> di bawah ini.
                        </div>
                    <?php endif; ?>
                </section>
            </div>

            <!-- Review Klinis Psikolog (MSE) -->
            <div class="col-12">
                <section class="clinical-panel clinical-panel--mse">
                    <h6 class="clinical-panel__title fw-bold" style="color: #be185d;">
                        <i class="bi bi-stethoscope"></i>
                        <span>Evaluasi Mental Status (MSE) Psikolog</span>
                    </h6>
                    <?php if(isset($psychologistReview) && $psychologistReview): ?>
                        <div class="mse-chief-complaint">
                            <span class="clinical-field__label">Chief Complaint</span>
                            <p class="clinical-field__value fw-semibold"><?= esc($psychologistReview['chief_complaint']) ?></p>
                        </div>
                        <div class="mse-grid">
                            <div class="mse-item">
                                <span class="clinical-field__label">Appearance</span>
                                <p class="clinical-field__value fw-semibold"><?= esc($psychologistReview['mse_appearance']) ?></p>
                                <?php if(!empty($psychologistReview['mse_appearance_note'])): ?><small class="clinical-field__note"><?= esc($psychologistReview['mse_appearance_note']) ?></small><?php endif; ?>
                            </div>
                            <div class="mse-item">
                                <span class="clinical-field__label">Behavior</span>
                                <p class="clinical-field__value fw-semibold"><?= esc($psychologistReview['mse_behavior']) ?></p>
                                <?php if(!empty($psychologistReview['mse_behavior_note'])): ?><small class="clinical-field__note"><?= esc($psychologistReview['mse_behavior_note']) ?></small><?php endif; ?>
                            </div>
                            <div class="mse-item">
                                <span class="clinical-field__label">Speech</span>
                                <p class="clinical-field__value fw-semibold"><?= esc($psychologistReview['mse_speech']) ?></p>
                                <?php if(!empty($psychologistReview['mse_speech_note'])): ?><small class="clinical-field__note"><?= esc($psychologistReview['mse_speech_note']) ?></small><?php endif; ?>
                            </div>
                            <div class="mse-item">
                                <span class="clinical-field__label">Mood</span>
                                <p class="clinical-field__value fw-semibold"><?= esc($psychologistReview['mse_mood']) ?></p>
                                <?php if(!empty($psychologistReview['mse_mood_note'])): ?><small class="clinical-field__note"><?= esc($psychologistReview['mse_mood_note']) ?></small><?php endif; ?>
                            </div>
                            <div class="mse-item">
                                <span class="clinical-field__label">Affect</span>
                                <p class="clinical-field__value fw-semibold"><?= esc($psychologistReview['mse_affect']) ?></p>
                                <?php if(!empty($psychologistReview['mse_affect_note'])): ?><small class="clinical-field__note"><?= esc($psychologistReview['mse_affect_note']) ?></small><?php endif; ?>
                            </div>
                            <div class="mse-item">
                                <span class="clinical-field__label">Thought</span>
                                <p class="clinical-field__value fw-semibold"><?= esc($psychologistReview['mse_thought']) ?></p>
                                <?php if(!empty($psychologistReview['mse_thought_note'])): ?><small class="clinical-field__note"><?= esc($psychologistReview['mse_thought_note']) ?></small><?php endif; ?>
                            </div>
                            <div class="mse-item">
                                <span class="clinical-field__label">Orientation</span>
                                <p class="clinical-field__value fw-semibold"><?= esc($psychologistReview['mse_orientation']) ?></p>
                                <?php if(!empty($psychologistReview['mse_orientation_note'])): ?><small class="clinical-field__note"><?= esc($psychologistReview['mse_orientation_note']) ?></small><?php endif; ?>
                            </div>
                            <div class="mse-item">
                                <span class="clinical-field__label">Insight</span>
                                <p class="clinical-field__value fw-semibold"><?= esc($psychologistReview['mse_insight']) ?></p>
                                <?php if(!empty($psychologistReview['mse_insight_note'])): ?><small class="clinical-field__note"><?= esc($psychologistReview['mse_insight_note']) ?></small><?php endif; ?>
                            </div>
                            <div class="mse-item">
                                <span class="clinical-field__label">Perception</span>
                                <p class="clinical-field__value fw-semibold"><?= esc($psychologistReview['mse_perception'] ?? 'Normal') ?></p>
                                <?php if(!empty($psychologistReview['mse_perception_note'])): ?><small class="clinical-field__note"><?= esc($psychologistReview['mse_perception_note']) ?></small><?php endif; ?>
                            </div>
                            <div class="mse-item">
                                <span class="clinical-field__label text-danger">Risk Assessment</span>
                                <p class="clinical-field__value fw-semibold text-danger"><?= esc($psychologistReview['risk_assessment'] ?? 'Aman') ?></p>
                                <?php if(!empty($psychologistReview['risk_assessment_note'])): ?><small class="clinical-field__note text-danger"><?= esc($psychologistReview['risk_assessment_note']) ?></small><?php endif; ?>
                            </div>
                        </div>
                    <?php else: ?>
                        <p class="clinical-empty">Belum ada review MSE Psikolog yang disimpan.</p>
                    <?php endif; ?>
                </section>
            </div>
        </div>

        <form class="clinical-action-form" action="<?= site_url('/clinical-action/save/' . $victim['id'] . '?fase_ke=' . $fase_ke) ?>" method="POST">
            <?= csrf_field() ?>
            <h6 class="clinical-action-form__title fw-bold">
                <i class="bi bi-journal-medical text-primary"></i>
                <span>Catatan &amp; Rencana Follow-up Psikolog</span>
            </h6>
            <div class="row g-3">
                <div class="col-12 col-md-6">
                    <label class="form-label fw-semibold">Intervensi Utama <span class="text-danger">*</span></label>
                    <?php
                        $interventionOptions = [
                            'PFA' => 'Psychological First Aid (PFA)',
                            'CBT' => 'Cognitive Behavioral Therapy (CBT)',
                            'Konseling Individu' => 'Konseling Individu Trauma',
                            'Rujukan Psikiater' => 'Rujukan Psikiater',
                        ];
                        $int = old('intervensi', $clinicalAction['intervensi'] ?? 'PFA');
                        $selectedInterventionLabel = $interventionOptions[$int] ?? $interventionOptions['PFA'];
                    ?>
                    <select class="d-none" name="intervensi" id="clinical-intervention" required>
                        <?php foreach($interventionOptions as $value => $label): ?>
                            <option value="<?= esc($value) ?>" <?= $int === $value ? 'selected' : '' ?>><?= esc($label) ?></option>
                        <?php endforeach; ?>
                    </select>
                    <div class="frost-custom-select-wrapper" id="custom-wrapper-clinical-intervention">
                        <div class="frost-custom-trigger" id="trigger-clinical-intervention">
                            <span class="trigger-label text-truncate"><?= esc($selectedInterventionLabel) ?></span>
                            <i class="bi bi-chevron-down chevron-icon"></i>
                        </div>
                        <div class="frost-custom-menu" id="menu-clinical-intervention">
                            <?php foreach($interventionOptions as $value => $label): ?>
                                <div class="frost-custom-option <?= $int === $value ? 'selected' : '' ?>" data-value="<?= esc($value) ?>"><?= esc($label) ?></div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <label class="form-label fw-semibold">Jadwal Follow-up <span class="text-danger">*</span></label>
                    <div class="frost-date-field">
                        <i class="bi bi-calendar2-week date-icon"></i>
                        <input type="date" class="frost-input-field form-control" name="jadwal_followup" required
                               value="<?= old('jadwal_followup', $clinicalAction['jadwal_followup'] ?? date('Y-m-d', strtotime('+7 days'))) ?>">
                    </div>
                </div>
                <div class="col-12">
                    <label class="form-label fw-semibold">Diagnosis Sementara <span class="text-danger">*</span></label>
                    <textarea class="frost-input-field form-control" name="diagnosis_sementara" rows="2" required><?= old('diagnosis_sementara', $clinicalAction['diagnosis_sementara'] ?? $itqResult['final_diagnosis']) ?></textarea>
                </div>
                <div class="col-12">
                    <label class="form-label fw-semibold">Catatan Klinis Tambahan</label>
                    <textarea class="frost-input-field form-control" name="catatan_klinis" rows="3"><?= old('catatan_klinis', $clinicalAction['catatan_klinis'] ?? '') ?></textarea>
                </div>
            </div>
            
            <div class="mt-4 text-end">
                <button type="submit" class="frost-btn-primary">
                    <i class="bi bi-save me-1"></i> Simpan Laporan Final
                </button>
            </div>
        </form>
    </div>

</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function setupClinicalCustomSelect(wrapperId, triggerId, menuId, nativeId) {
        const wrapper = document.getElementById(wrapperId);
        const trigger = document.getElementById(triggerId);
        const menu = document.getElementById(menuId);
        const nativeSelect = document.getElementById(nativeId);

        if (!wrapper || !trigger || !menu || !nativeSelect) {
            return;
        }

        trigger.addEventListener('click', function(event) {
            event.stopPropagation();
            const shouldOpen = !menu.classList.contains('show');

            document.querySelectorAll('.frost-custom-menu').forEach(item => item.classList.remove('show'));
            document.querySelectorAll('.frost-custom-trigger').forEach(item => item.classList.remove('active'));
            document.querySelectorAll('.frost-custom-select-wrapper').forEach(item => item.classList.remove('active-dropdown'));

            if (shouldOpen) {
                menu.classList.add('show');
                trigger.classList.add('active');
                wrapper.classList.add('active-dropdown');
            }
        });

        menu.querySelectorAll('.frost-custom-option').forEach(option => {
            option.addEventListener('click', function(event) {
                event.stopPropagation();
                const value = this.dataset.value || '';
                const label = this.textContent.trim();

                nativeSelect.value = value;
                trigger.querySelector('.trigger-label').textContent = label;
                menu.querySelectorAll('.frost-custom-option').forEach(item => item.classList.remove('selected'));
                this.classList.add('selected');
                menu.classList.remove('show');
                trigger.classList.remove('active');
                wrapper.classList.remove('active-dropdown');
            });
        });
    }

    setupClinicalCustomSelect('custom-wrapper-clinical-intervention', 'trigger-clinical-intervention', 'menu-clinical-intervention', 'clinical-intervention');

    document.addEventListener('click', function() {
        document.querySelectorAll('.frost-custom-menu').forEach(item => item.classList.remove('show'));
        document.querySelectorAll('.frost-custom-trigger').forEach(item => item.classList.remove('active'));
        document.querySelectorAll('.frost-custom-select-wrapper').forEach(item => item.classList.remove('active-dropdown'));
    });

    // Dynamic data from controller
    const ptsdScore = <?= $detailedSubScores['overall']['ptsd']['score'] ?>;
    const dsoScore = <?= $detailedSubScores['overall']['dso']['score'] ?>;

    // Custom Plugin to draw background bands
    const bgBandsPlugin = {
        id: 'bgBands',
        beforeDraw: (chart, args, options) => {
            const { ctx, chartArea, scales } = chart;
            const y = scales.y;
            if (!y) return;
            
            const drawBand = (min, max, color) => {
                const yTop = Math.max(chartArea.top, y.getPixelForValue(max));
                const yBottom = Math.min(chartArea.bottom, y.getPixelForValue(min));
                ctx.fillStyle = color;
                ctx.fillRect(chartArea.left, yTop, chartArea.right - chartArea.left, yBottom - yTop);
            };

            // Draw bands for 0-24 scale
            drawBand(0, 3.5, 'rgba(255, 255, 255, 1)'); // Minimal
            drawBand(3.5, 6.5, 'rgba(254, 240, 138, 0.4)'); // Mild
            drawBand(6.5, 10.5, 'rgba(253, 186, 116, 0.4)'); // Moderate
            drawBand(10.5, 16.5, 'rgba(252, 165, 165, 0.4)'); // Severe
            drawBand(16.5, 24, 'rgba(248, 113, 113, 0.4)'); // Very Severe
        }
    };

    // BAR CHART
    const ctxBar = document.getElementById('barChart').getContext('2d');
    new Chart(ctxBar, {
        type: 'bar',
        data: {
            labels: ['PTSD', 'DSO'],
            datasets: [{
                label: 'Score',
                data: [ptsdScore, dsoScore],
                backgroundColor: ['#dc2626', '#0284c7'],
                barPercentage: 0.5,
                categoryPercentage: 0.8
            }]
        },
        options: {
            indexAxis: 'y',
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: {
                    min: 0, max: 24,
                    ticks: { stepSize: 1 }
                }
            },
            plugins: {
                legend: { display: false }
            }
        }
    });

    // LINE CHART Longitudinal
    fetch('<?= site_url('/itq/chart-data/' . $victim['id']) ?>')
        .then(res => res.json())
        .then(data => {
            let labels = ['Initial Assessment', 'Current'];
            let ptsdData = [ptsdScore, ptsdScore];
            let dsoData = [dsoScore, dsoScore];

            if (data.status === 'success' && data.chart4.has_data) {
                labels = ['Initial', ...data.chart4.labels];
                ptsdData = [ptsdScore, ...data.chart4.ptsd];
                dsoData = [dsoScore, ...data.chart4.dso];
            }

            const ctxLine = document.getElementById('lineChart').getContext('2d');
            new Chart(ctxLine, {
                type: 'line',
                plugins: [bgBandsPlugin],
                data: {
                    labels: labels,
                    datasets: [
                        { label: 'PTSD', data: ptsdData, borderColor: '#dc2626', backgroundColor: '#dc2626', pointRadius: 5 },
                        { label: 'DSO', data: dsoData, borderColor: '#0284c7', backgroundColor: '#0284c7', pointRadius: 5 }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            min: 0, max: 24,
                            title: { display: true, text: 'ITQ Scores' }
                        }
                    }
                }
            });
        }).catch(e => {
            console.error("Failed to load chart data:", e);
        });
});
</script>
<?= $this->endSection() ?>
