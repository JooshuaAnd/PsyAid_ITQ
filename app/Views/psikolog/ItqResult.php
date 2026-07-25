<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="row mb-4 align-items-center">
    <div class="col">
        <a href="<?= site_url('/psikolog/dashboard') ?>" class="btn btn-outline-secondary btn-sm mb-2">
            <i class="bi bi-arrow-left me-1"></i> Kembali ke Dashboard Psikolog
        </a>
        <h3 class="fw-bold text-dark mb-1">
            <i class="bi bi-bar-chart-line-fill text-primary me-2"></i> Hasil Skoring ITQ & Visualisasi Grafik Klinis
        </h3>
        <p class="text-muted small mb-0">Penyintas: <strong><?= esc($victim['nama']) ?></strong> (NIK: <?= esc($victim['nik'] ?? '-') ?>) • Evaluasi Kriteria ICD-11 (PTSD & DSO)</p>
    </div>
</div>

<!-- Display Flash Messages -->
<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
        <i class="bi bi-check-circle-fill me-1"></i> <?= session()->getFlashdata('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<!-- 1. CARD RINGKASAN SKORING ITQ (SEGMEN 13) -->
<div class="card card-custom bg-white p-4 shadow-sm mb-4">
    <div class="d-flex align-items-center justify-content-between border-bottom pb-3 mb-4">
        <div>
            <h5 class="fw-bold text-dark mb-1"><i class="bi bi-journal-check text-primary me-2"></i> Ringkasan Kriteria Diagnosis ITQ (ICD-11)</h5>
            <p class="text-muted small mb-0">Diskor otomatis berdasarkan algoritma resmi Cloitre et al.</p>
        </div>
        <div class="text-end">
            <span class="badge bg-dark px-3 py-2 fs-7"><i class="bi bi-person-check-fill me-1"></i> Reviewed by <?= esc($itqResult['reviewed_by_name']) ?></span>
            <div class="fs-8 text-muted mt-1"><?= esc($itqResult['reviewed_at']) ?></div>
        </div>
    </div>

    <div class="row g-4 mb-3">
        <!-- Cluster PTSD -->
        <div class="col-12 col-md-6">
            <div class="p-3 bg-light rounded border border-primary border-opacity-25 h-100">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <h6 class="fw-bold text-primary mb-0"><i class="bi bi-activity me-1"></i> A. PTSD (Post-Traumatic Stress Disorder)</h6>
                    <?php if (! empty($itqResult['ptsd_criteria_met'])): ?>
                        <span class="badge bg-danger"><i class="bi bi-exclamation-octagon-fill me-1"></i> CRITERIA MET</span>
                    <?php else: ?>
                        <span class="badge bg-secondary"><i class="bi bi-dash-circle me-1"></i> NOT MET</span>
                    <?php endif; ?>
                </div>

                <div class="row align-items-center mt-3">
                    <div class="col-6">
                        <div class="text-muted small">Skor PTSD:</div>
                        <div class="fs-2 fw-bold text-dark"><?= esc($itqResult['ptsd_score']) ?> <span class="fs-6 text-muted">/ 24</span></div>
                    </div>
                    <div class="col-6 text-end">
                        <div class="text-muted small">Tingkat Keparahan:</div>
                        <span class="badge bg-warning text-dark fs-6 px-3 py-1"><?= esc($itqResult['ptsd_severity']) ?></span>
                        <div class="fs-8 text-muted mt-1">Persentil: <strong><?= esc($itqResult['ptsd_percentile']) ?>%</strong></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Cluster DSO -->
        <div class="col-12 col-md-6">
            <div class="p-3 bg-light rounded border border-danger border-opacity-25 h-100">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <h6 class="fw-bold text-danger mb-0"><i class="bi bi-heart-pulse me-1"></i> B. DSO (Disturbances in Self-Organization)</h6>
                    <?php if (! empty($itqResult['dso_criteria_met'])): ?>
                        <span class="badge bg-danger"><i class="bi bi-exclamation-octagon-fill me-1"></i> CRITERIA MET</span>
                    <?php else: ?>
                        <span class="badge bg-secondary"><i class="bi bi-dash-circle me-1"></i> NOT MET</span>
                    <?php endif; ?>
                </div>

                <div class="row align-items-center mt-3">
                    <div class="col-6">
                        <div class="text-muted small">Skor DSO:</div>
                        <div class="fs-2 fw-bold text-dark"><?= esc($itqResult['dso_score']) ?> <span class="fs-6 text-muted">/ 24</span></div>
                    </div>
                    <div class="col-6 text-end">
                        <div class="text-muted small">Tingkat Keparahan:</div>
                        <span class="badge bg-warning text-dark fs-6 px-3 py-1"><?= esc($itqResult['dso_severity']) ?></span>
                        <div class="fs-8 text-muted mt-1">Persentil: <strong><?= esc($itqResult['dso_percentile']) ?>%</strong></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Overall Risk Banner -->
    <div class="p-3 rounded border text-center <?= $itqResult['overall_risk'] === 'HIGH' ? 'bg-danger bg-opacity-10 border-danger' : 'bg-light' ?>">
        <span class="text-muted small fw-semibold text-uppercase me-2">Overall ITQ Clinical Risk:</span>
        <?php if ($itqResult['overall_risk'] === 'HIGH'): ?>
            <span class="badge bg-danger fs-6 px-3 py-1"><i class="bi bi-exclamation-triangle-fill me-1"></i> HIGH RISK (Complex PTSD / High Trauma Risk)</span>
        <?php elseif ($itqResult['overall_risk'] === 'MEDIUM'): ?>
            <span class="badge bg-warning text-dark fs-6 px-3 py-1"><i class="bi bi-dash-circle-fill me-1"></i> MEDIUM RISK</span>
        <?php else: ?>
            <span class="badge bg-success fs-6 px-3 py-1"><i class="bi bi-check-circle-fill me-1"></i> LOW RISK</span>
        <?php endif; ?>
    </div>
</div>

<!-- 2. VISUALISASI 4 GRAFIK CHART.JS (SEGMEN 14) -->
<div class="card card-custom bg-white p-4 shadow-sm mb-4">
    <div class="border-bottom pb-3 mb-4">
        <h5 class="fw-bold text-dark mb-1"><i class="bi bi-pie-chart-fill text-primary me-2"></i> Visualisasi Grafik Klinis (Chart.js)</h5>
        <p class="text-muted small mb-0">Analisis profil kluster gejala dan tren longitudinal follow-up penyintas.</p>
    </div>

    <div class="row g-4">
        <!-- Grafik 1: Horizontal Bar PTSD vs DSO -->
        <div class="col-12 col-md-6">
            <div class="p-3 bg-light rounded border h-100">
                <h6 class="fw-bold text-dark small mb-3">1. Skor Total PTSD vs DSO (Skala 0-24)</h6>
                <div style="position: relative; height: 220px;">
                    <canvas id="chart1Canvas"></canvas>
                </div>
            </div>
        </div>

        <!-- Grafik 2: Cluster Bar PTSD -->
        <div class="col-12 col-md-6">
            <div class="p-3 bg-light rounded border h-100">
                <h6 class="fw-bold text-dark small mb-3">2. Profil Rata-Rata Kluster PTSD</h6>
                <div style="position: relative; height: 220px;">
                    <canvas id="chart2Canvas"></canvas>
                </div>
            </div>
        </div>

        <!-- Grafik 3: Cluster Bar DSO -->
        <div class="col-12 col-md-6">
            <div class="p-3 bg-light rounded border h-100">
                <h6 class="fw-bold text-dark small mb-3">3. Profil Rata-Rata Kluster DSO</h6>
                <div style="position: relative; height: 220px;">
                    <canvas id="chart3Canvas"></canvas>
                </div>
            </div>
        </div>

        <!-- Grafik 4: Line Chart Longitudinal -->
        <div class="col-12 col-md-6">
            <div class="p-3 bg-light rounded border h-100">
                <h6 class="fw-bold text-dark small mb-3">4. Tren Longitudinal Follow-up (Hari 1-90)</h6>
                <div id="chart4Container" style="position: relative; height: 220px;">
                    <canvas id="chart4Canvas"></canvas>
                    <div id="noFollowupMsg" class="d-none text-center py-5 text-muted small">
                        <i class="bi bi-graph-up-arrow fs-2 d-block mb-1"></i>
                        Belum ada data follow-up berkala untuk penyintas ini.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 3. FORM AKSI FINAL PSIKOLOG & FOLLOW-UP (SEGMEN 15) -->
<div class="card card-custom bg-white p-4 shadow-sm mb-4">
    <div class="border-bottom pb-3 mb-4">
        <h5 class="fw-bold text-dark mb-1"><i class="bi bi-clipboard-check-fill text-success me-2"></i> Form Aksi Final Psikolog & Rencana Follow-up</h5>
        <p class="text-muted small mb-0">Tetapkan diagnosis sementara, intervensi, dan jadwal pemantauan klinis.</p>
    </div>

    <form action="<?= site_url('/clinical-action/save/' . $victim['id']) ?>" method="POST">
        <?= csrf_field() ?>

        <div class="row g-4">
            <!-- Approval / Override Switch -->
            <div class="col-12 col-md-6">
                <div class="p-3 bg-light rounded border">
                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" id="ai_recommendation_approved" name="ai_recommendation_approved" value="1"
                               <?= old('ai_recommendation_approved', $clinicalAction['ai_recommendation_approved'] ?? 1) ? 'checked' : '' ?>
                               onchange="toggleOverrideDropdown(this.checked)">
                        <label class="form-check-label fw-bold text-dark" for="ai_recommendation_approved">Setujui Rekomendasi Prioritas AI</label>
                    </div>

                    <div id="override-container" class="<?= old('ai_recommendation_approved', $clinicalAction['ai_recommendation_approved'] ?? 1) ? 'd-none' : '' ?>">
                        <label for="priority_override" class="form-label small fw-semibold">Ubah Prioritas (Override Psikolog)</label>
                        <select class="form-select form-select-sm" id="priority_override" name="priority_override">
                            <option value="High" <?= old('priority_override', $clinicalAction['priority_override'] ?? '') === 'High' ? 'selected' : '' ?>>High Risk (Prioritas 1)</option>
                            <option value="Medium" <?= old('priority_override', $clinicalAction['priority_override'] ?? '') === 'Medium' ? 'selected' : '' ?>>Medium Risk (Prioritas 2)</option>
                            <option value="Low" <?= old('priority_override', $clinicalAction['priority_override'] ?? '') === 'Low' ? 'selected' : '' ?>>Low Risk (Prioritas 3)</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Intervensi Dropdown -->
            <div class="col-12 col-md-6">
                <div class="p-3 bg-light rounded border">
                    <label for="intervensi" class="form-label fw-semibold">Pilih Intervensi Utama <span class="text-danger">*</span></label>
                    <?php $int = old('intervensi', $clinicalAction['intervensi'] ?? 'PFA'); ?>
                    <select class="form-select" id="intervensi" name="intervensi" required>
                        <option value="PFA" <?= $int === 'PFA' ? 'selected' : '' ?>>Psychological First Aid (PFA)</option>
                        <option value="CBT" <?= $int === 'CBT' ? 'selected' : '' ?>>Cognitive Behavioral Therapy (CBT)</option>
                        <option value="Konseling Individu" <?= $int === 'Konseling Individu' ? 'selected' : '' ?>>Konseling Individu Trauma</option>
                        <option value="Terapi Kelompok" <?= $int === 'Terapi Kelompok' ? 'selected' : '' ?>>Terapi Kelompok Support Group</option>
                        <option value="Rujukan Psikiater" <?= $int === 'Rujukan Psikiater' ? 'selected' : '' ?>>Rujukan Psikiater / Rumah Sakit</option>
                    </select>
                </div>
            </div>

            <!-- Diagnosis Sementara -->
            <div class="col-12 col-md-6">
                <label for="diagnosis_sementara" class="form-label fw-semibold">Diagnosis Sementara Psikolog <span class="text-danger">*</span></label>
                <textarea class="form-control" id="diagnosis_sementara" name="diagnosis_sementara" rows="3" 
                          placeholder="Misal: F43.1 PTSD pasca bencana gempa bumi..." required><?= old('diagnosis_sementara', $clinicalAction['diagnosis_sementara'] ?? 'Acute Stress Disorder pasca bencana') ?></textarea>
            </div>

            <!-- Catatan Klinis -->
            <div class="col-12 col-md-6">
                <label for="catatan_klinis" class="form-label fw-semibold">Catatan Klinis & Rekomendasi Lapangan</label>
                <textarea class="form-control" id="catatan_klinis" name="catatan_klinis" rows="3" 
                          placeholder="Catatan tambahan untuk relawan posko atau instruksi pendampingan..."><?= old('catatan_klinis', $clinicalAction['catatan_klinis'] ?? '') ?></textarea>
            </div>

            <!-- Jadwal Follow-up -->
            <div class="col-12 col-md-4">
                <label for="jadwal_followup" class="form-label fw-semibold">Jadwal Follow-up Berkelanjutan</label>
                <input type="date" class="form-control" id="jadwal_followup" name="jadwal_followup" 
                       value="<?= old('jadwal_followup', $clinicalAction['jadwal_followup'] ?? date('Y-m-d', strtotime('+7 days'))) ?>">
            </div>
        </div>

        <div class="border-top pt-3 mt-4 text-end">
            <button type="submit" class="btn btn-success px-4 py-2 fw-bold shadow-sm">
                <i class="bi bi-check-all me-1"></i> Simpan Aksi Klinis & Finalisasi Review
            </button>
        </div>
    </form>
</div>

<!-- Load Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
function toggleOverrideDropdown(approved) {
    const el = document.getElementById('override-container');
    if (el) {
        if (!approved) el.classList.remove('d-none');
        else el.classList.add('d-none');
    }
}

// Fetch Chart.js data via AJAX JSON API (SEGMEN 14)
document.addEventListener('DOMContentLoaded', function() {
    fetch('<?= site_url('/itq/chart-data/' . $victim['id']) ?>')
        .then(res => res.json())
        .then(data => {
            if (data.status === 'success') {
                renderCharts(data);
            }
        })
        .catch(err => console.error('Error fetching Chart.js data:', err));
});

function renderCharts(data) {
    // 1. Chart 1: Horizontal Bar PTSD vs DSO
    new Chart(document.getElementById('chart1Canvas'), {
        type: 'bar',
        data: {
            labels: ['PTSD Score', 'DSO Score'],
            datasets: [{
                label: 'Skor Penyintas (0-24)',
                data: [data.chart1.ptsd_score, data.chart1.dso_score],
                backgroundColor: ['rgba(220, 53, 69, 0.7)', 'rgba(13, 110, 253, 0.7)'],
                borderColor: ['#dc3545', '#0d6efd'],
                borderWidth: 1
            }]
        },
        options: {
            indexAxis: 'y',
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: { min: 0, max: 24 }
            }
        }
    });

    // 2. Chart 2: Cluster Bar PTSD
    new Chart(document.getElementById('chart2Canvas'), {
        type: 'bar',
        data: {
            labels: data.chart2.labels,
            datasets: [{
                label: 'Rata-Rata Skala Kluster PTSD',
                data: data.chart2.data,
                backgroundColor: 'rgba(255, 193, 7, 0.7)',
                borderColor: '#ffc107',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: { min: 0, max: 4 }
            }
        }
    });

    // 3. Chart 3: Cluster Bar DSO
    new Chart(document.getElementById('chart3Canvas'), {
        type: 'bar',
        data: {
            labels: data.chart3.labels,
            datasets: [{
                label: 'Rata-Rata Skala Kluster DSO',
                data: data.chart3.data,
                backgroundColor: 'rgba(25, 135, 84, 0.7)',
                borderColor: '#198754',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: { min: 0, max: 4 }
            }
        }
    });

    // 4. Chart 4: Line Chart Longitudinal
    const canvas4 = document.getElementById('chart4Canvas');
    const msg4 = document.getElementById('noFollowupMsg');

    if (data.chart4.has_data) {
        new Chart(canvas4, {
            type: 'line',
            data: {
                labels: data.chart4.labels,
                datasets: [
                    {
                        label: 'Skor PTSD',
                        data: data.chart4.ptsd,
                        borderColor: '#dc3545',
                        tension: 0.3
                    },
                    {
                        label: 'Skor DSO',
                        data: data.chart4.dso,
                        borderColor: '#0d6efd',
                        tension: 0.3
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: { min: 0, max: 24 }
                }
            }
        });
    } else {
        canvas4.style.display = 'none';
        msg4.classList.remove('d-none');
    }
}
</script>
<?= $this->endSection() ?>
