<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<style>
    .tabular-nums { font-variant-numeric: tabular-nums; font-feature-settings: "tnum"; }
    .frost-card, .frost-hero, .frost-btn-primary, .posko-item-card, .btn, .badge, .form-control, .form-select, .card, .table-responsive { border-radius: 8px !important; }
    .frost-hero { background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 60%, #a7f3d0 100%); border: 1.5px solid #a7f3d0; color: #064e3b; position: relative; overflow: hidden; box-shadow: 0 10px 30px -4px rgba(16, 185, 129, 0.12), inset 0 1.5px 2px rgba(255, 255, 255, 0.85); }
    .frost-btn-primary { background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%); color: #065f46 !important; border: 1.5px solid #34d399; font-weight: 700; font-size: 0.8125rem; padding: 0.45rem 0.95rem; transition: all 0.2s ease; display: inline-flex; align-items: center; gap: 0.35rem; cursor: pointer; }
    .frost-btn-primary:hover { background: linear-gradient(135deg, #a7f3d0 0%, #6ee7b7 100%); color: #064e3b !important; border-color: #10b981; }
    .frost-btn-reset { background: #ffffff !important; color: #475569 !important; border: 1.5px solid #cbd5e1 !important; border-radius: 8px !important; font-weight: 600 !important; font-size: 0.8125rem !important; padding: 0.45rem 0.85rem !important; transition: all 0.2s ease; cursor: pointer; display: inline-flex; align-items: center; gap: 0.35rem; text-decoration: none; }
    .posko-item-card { background: #ffffff !important; border: 1.5px solid #e2e8f0 !important; box-shadow: 0 4px 12px -2px rgba(15, 23, 42, 0.04) !important; }
    .table-itq { width: 100%; border-collapse: collapse; margin-bottom: 2rem; font-size: 0.875rem; }
    .table-itq th, .table-itq td { border: 1px solid #cbd5e1; padding: 8px 12px; text-align: center; }
    .table-itq th { background-color: #f8fafc; font-weight: 600; color: #334155; }
    .table-itq .header-row { background-color: #e0f2fe; text-align: left; font-size: 1rem; font-weight: 700; color: #0f172a; padding: 12px 16px; border: none; }
    .table-itq .sub-header { border-bottom: 2px solid #94a3b8; }
    .table-itq td.text-start { text-align: left; }
    .bg-severe { background-color: #fecaca !important; color: #991b1b; }
    .bg-very-severe { background-color: #fca5a5 !important; color: #7f1d1d; }
    .bg-moderate { background-color: #fef08a !important; color: #854d0e; }
    .bg-mild { background-color: #fef9c3 !important; color: #a16207; }
    .bg-minimal { background-color: #ffffff !important; color: #475569; }
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
                
                <tr><td colspan="5" style="border:none; height:20px;"></td></tr>

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

                <tr><td colspan="5" style="border:none; height:20px;"></td></tr>

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
    <div class="card posko-item-card p-4 mb-4">
        <h5 class="fw-bold mb-4" style="color: #0f172a;"><i class="bi bi-file-earmark-medical text-primary me-2"></i> Informasi Terpadu & Aksi Klinis</h5>
        
        <div class="row g-4 mb-4">
            <!-- Review Relawan -->
            <div class="col-12 col-md-6">
                <div class="p-3 h-100" style="background: #f8fafc; border: 1.5px solid #e2e8f0; border-radius: 8px;">
                    <h6 class="fw-bold text-primary mb-3"><i class="bi bi-person-badge"></i> Review Screening Relawan</h6>
                    <?php if($volunteerScreening): ?>
                        <div class="mb-2"><span class="text-muted small">Skala Distress:</span> <strong><?= $volunteerScreening['skala_distress'] ?>/10</strong></div>
                        <div class="mb-2"><span class="text-muted small">Kondisi Observasi:</span><br>
                            <?php 
                                $observations = [];
                                if($volunteerScreening['mampu_sebut_nama']) $observations[] = '<span class="badge bg-success">Mampu Sebut Nama</span>';
                                if($volunteerScreening['tahu_waktu_tempat']) $observations[] = '<span class="badge bg-success">Orientasi Baik</span>';
                                if($volunteerScreening['disorientasi']) $observations[] = '<span class="badge bg-danger">Disorientasi</span>';
                                if($volunteerScreening['menangis_terus']) $observations[] = '<span class="badge bg-danger">Menangis Terus</span>';
                                if($volunteerScreening['tampak_panik']) $observations[] = '<span class="badge bg-warning text-dark">Tampak Panik</span>';
                                if($volunteerScreening['gemetar']) $observations[] = '<span class="badge bg-warning text-dark">Gemetar</span>';
                                if($volunteerScreening['tatapan_kosong']) $observations[] = '<span class="badge bg-secondary">Tatapan Kosong</span>';
                                if($volunteerScreening['teriak_histeris']) $observations[] = '<span class="badge bg-danger">Teriak Histeris</span>';
                                if($volunteerScreening['cenderung_diam']) $observations[] = '<span class="badge bg-secondary">Cenderung Diam</span>';
                                if($volunteerScreening['sulit_tidur']) $observations[] = '<span class="badge bg-warning text-dark">Sulit Tidur</span>';
                                if($volunteerScreening['sulit_makan']) $observations[] = '<span class="badge bg-warning text-dark">Sulit Makan</span>';
                                if($volunteerScreening['keluhan_fisik']) $observations[] = '<span class="badge bg-danger">Keluhan Fisik (Luka/Sakit)</span>';
                                if($volunteerScreening['konflik_keluarga']) $observations[] = '<span class="badge bg-warning text-dark">Konflik Keluarga</span>';
                                if($volunteerScreening['terpisah_keluarga']) $observations[] = '<span class="badge bg-danger">Terpisah Keluarga</span>';
                                if($volunteerScreening['kehilangan_anggota']) $observations[] = '<span class="badge bg-danger">Kehilangan Anggota</span>';
                                if($volunteerScreening['kehilangan_harta']) $observations[] = '<span class="badge bg-warning text-dark">Kehilangan Harta</span>';
                                if($volunteerScreening['menyebut_ingin_mati']) $observations[] = '<span class="badge bg-dark text-white">Menyebut Ingin Mati</span>';
                                if($volunteerScreening['melukai_diri']) $observations[] = '<span class="badge bg-dark text-white">Melukai Diri</span>';
                                if($volunteerScreening['perlu_rujukan_medis']) $observations[] = '<span class="badge bg-danger">Perlu Rujukan Medis</span>';

                                echo empty($observations) ? '<span class="text-muted small">Tidak ada</span>' : implode(' ', $observations);
                            ?>
                        </div>
                        <div class="mb-2"><span class="text-muted small">Catatan Relawan:</span><br/>
                            <p class="mb-0 fst-italic border-start border-3 border-primary ps-2">"<?= esc($volunteerScreening['catatan_relawan']) ?>"</p>
                        </div>
                    <?php else: ?>
                        <p class="text-muted small">Tidak ada data screening relawan.</p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Analisis AI -->
            <div class="col-12 col-md-6">
                <div class="p-3 h-100" style="background: #eff6ff; border: 1.5px solid #bfdbfe; border-radius: 8px;">
                    <h6 class="fw-bold text-primary mb-3"><i class="bi bi-robot"></i> Analisis Awal AI PsyAid</h6>
                    <?php if($aiAssessment): ?>
                        <div class="mb-2"><span class="text-muted small">Risk Level:</span> 
                            <span class="badge bg-dark"><?= strtoupper($aiAssessment['risk_level']) ?></span>
                        </div>
                        <div class="mb-2"><span class="text-muted small">Rekomendasi Diagnosis:</span><br/>
                            <strong><?= esc($aiAssessment['kemungkinan_diagnosis']) ?></strong>
                        </div>
                        <div class="mb-0"><span class="text-muted small">Summary AI:</span><br/>
                            <p class="mb-0 fst-italic">"<?= esc($aiAssessment['ai_summary']) ?>"</p>
                        </div>
                    <?php else: ?>
                        <p class="text-muted small">Tidak ada analisis AI.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <form action="<?= site_url('/clinical-action/save/' . $victim['id']) ?>" method="POST">
            <?= csrf_field() ?>
            <h6 class="fw-bold text-dark border-bottom pb-2 mb-3">Catatan & Rencana Follow-up Psikolog</h6>
            <div class="row g-3">
                <div class="col-12 col-md-6">
                    <label class="form-label fw-semibold">Intervensi Utama <span class="text-danger">*</span></label>
                    <select class="form-select" name="intervensi" required>
                        <?php $int = old('intervensi', $clinicalAction['intervensi'] ?? 'PFA'); ?>
                        <option value="PFA" <?= $int==='PFA'?'selected':'' ?>>Psychological First Aid (PFA)</option>
                        <option value="CBT" <?= $int==='CBT'?'selected':'' ?>>Cognitive Behavioral Therapy (CBT)</option>
                        <option value="Konseling Individu" <?= $int==='Konseling Individu'?'selected':'' ?>>Konseling Individu Trauma</option>
                        <option value="Rujukan Psikiater" <?= $int==='Rujukan Psikiater'?'selected':'' ?>>Rujukan Psikiater</option>
                    </select>
                </div>
                <div class="col-12 col-md-6">
                    <label class="form-label fw-semibold">Jadwal Follow-up <span class="text-danger">*</span></label>
                    <input type="date" class="form-control" name="jadwal_followup" required 
                           value="<?= old('jadwal_followup', $clinicalAction['jadwal_followup'] ?? date('Y-m-d', strtotime('+7 days'))) ?>">
                </div>
                <div class="col-12">
                    <label class="form-label fw-semibold">Diagnosis Sementara <span class="text-danger">*</span></label>
                    <textarea class="form-control" name="diagnosis_sementara" rows="2" required><?= old('diagnosis_sementara', $clinicalAction['diagnosis_sementara'] ?? $itqResult['final_diagnosis']) ?></textarea>
                </div>
                <div class="col-12">
                    <label class="form-label fw-semibold">Catatan Klinis Tambahan</label>
                    <textarea class="form-control" name="catatan_klinis" rows="3"><?= old('catatan_klinis', $clinicalAction['catatan_klinis'] ?? '') ?></textarea>
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
