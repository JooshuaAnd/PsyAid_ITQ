<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<style>
    .tabular-nums { font-variant-numeric: tabular-nums; font-feature-settings: "tnum"; }
    .frost-card, .frost-hero, .frost-btn-primary, .frost-btn-danger, .frost-btn-reset, .posko-item-card, .btn, .modal-content, .badge, .form-control, .form-select, .progress, .alert, .card, .table-responsive { border-radius: 8px !important; }
    .frost-card { background: linear-gradient(135deg, rgba(255, 255, 255, 0.98) 0%, rgba(244, 251, 247, 0.9) 100%); backdrop-filter: blur(12px) saturate(160%); -webkit-backdrop-filter: blur(12px) saturate(160%); border: 1.5px solid #a7f3d0; box-shadow: 0 8px 24px -4px rgba(15, 23, 42, 0.06), 0 2px 6px -1px rgba(15, 23, 42, 0.02); }
    .frost-hero { background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 60%, #a7f3d0 100%); border: 1.5px solid #a7f3d0; color: #064e3b; position: relative; overflow: hidden; box-shadow: 0 10px 30px -4px rgba(16, 185, 129, 0.12), inset 0 1.5px 2px rgba(255, 255, 255, 0.85); }
    .frost-btn-primary { background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%); color: #065f46 !important; border: 1.5px solid #34d399; border-radius: 8px !important; font-weight: 700; font-size: 0.8125rem; padding: 0.45rem 0.95rem; transition: all 0.2s ease; text-decoration: none; display: inline-flex; align-items: center; gap: 0.35rem; box-shadow: 0 2px 6px rgba(16, 185, 129, 0.15); cursor: pointer; }
    .frost-btn-primary:hover { background: linear-gradient(135deg, #a7f3d0 0%, #6ee7b7 100%); color: #064e3b !important; border-color: #10b981; box-shadow: 0 4px 12px rgba(16, 185, 129, 0.25); transform: translateY(-1px); }
    .frost-btn-reset { background: #ffffff !important; color: #475569 !important; border: 1.5px solid #cbd5e1 !important; border-radius: 8px !important; font-weight: 600 !important; font-size: 0.8125rem !important; padding: 0.45rem 0.85rem !important; transition: all 0.2s ease; cursor: pointer; display: inline-flex; align-items: center; gap: 0.35rem; text-decoration: none; }
    .frost-btn-reset:hover { background-color: #f8fafc !important; color: #0f172a !important; border-color: #94a3b8 !important; }
    .posko-item-card { background: #ffffff !important; border: 1.5px solid #d1fae5 !important; border-radius: 8px !important; box-shadow: 0 4px 12px -2px rgba(16, 185, 129, 0.08), 0 2px 5px -1px rgba(15, 23, 42, 0.04) !important; transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1) !important; }
    .posko-item-card:hover { background: #ffffff !important; border-color: #34d399 !important; box-shadow: 0 12px 28px -4px rgba(16, 185, 129, 0.18), 0 4px 10px -2px rgba(15, 23, 42, 0.04) !important; transform: translateY(-2px) !important; }
    .form-control, .form-select { background: #ffffff !important; border: 1.5px solid #cbd5e1 !important; border-radius: 8px !important; padding: 0.5rem 0.75rem !important; font-size: 0.875rem !important; font-weight: 600 !important; color: #0f172a !important; transition: all 0.2s ease; box-shadow: 0 1px 3px rgba(15, 23, 42, 0.04); }
    .form-control:focus, .form-select:focus { border-color: #059669 !important; box-shadow: 0 0 0 3.5px rgba(5, 150, 105, 0.18) !important; outline: none; }
    .fs-7 { font-size: 0.8125rem; } .fs-8 { font-size: 0.75rem; } .fs-9 { font-size: 0.6875rem; }
    @media (max-width: 767.98px) { .frost-hero .card-body, .posko-item-card { padding: 1.15rem !important; } .frost-hero h3 { font-size: 1.25rem !important; } }
</style>

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
                        <i class="bi bi-arrow-left me-1"></i> Kembali ke Dashboard Psikolog
                    </a>
                </div>
            </div>
            <h3 class="fw-bold mb-1" style="color: #064e3b;">
                <i class="bi bi-bar-chart-line-fill me-2" style="color: #059669;"></i> Hasil Skoring ITQ & Visualisasi Grafik Klinis
            </h3>
            <p class="small mb-0" style="color: #047857; max-width: 75ch;">
                Penyintas: <strong><?= esc($victim['nama']) ?></strong> (NIK: <?= esc($victim['nik'] ?? '-') ?>) • Evaluasi Kriteria ICD-11 (PTSD & DSO)
            </p>
        </div>
    </div>

<!-- Display Flash Messages -->
<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" style="border-radius: 8px !important;" role="alert">
        <i class="bi bi-check-circle-fill me-1"></i> <?= session()->getFlashdata('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<!-- 1. CARD RINGKASAN SKORING ITQ (SEGMEN 13) -->
<div class="card posko-item-card p-4 mb-4">
    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 border-bottom pb-3 mb-4">
        <div>
            <h5 class="fw-bold mb-1" style="color: #064e3b;"><i class="bi bi-journal-check text-success me-2"></i> Ringkasan Kriteria Diagnosis ITQ (ICD-11)</h5>
            <p class="text-muted small mb-0">Diskor otomatis berdasarkan algoritma resmi Cloitre et al.</p>
        </div>
        <div class="text-end">
            <span class="badge px-3 py-2 fs-7" style="background-color: #f1f5f9; color: #334155; border: 1px solid #cbd5e1;"><i class="bi bi-person-check-fill me-1 text-primary"></i> Reviewed by <?= esc($itqResult['reviewed_by_name']) ?></span>
            <div class="fs-8 text-muted mt-1"><?= esc($itqResult['reviewed_at']) ?></div>
        </div>
    </div>

    <div class="row g-4 mb-3">
        <!-- Cluster PTSD -->
        <div class="col-12 col-md-6">
            <div class="p-3 h-100" style="background: #f8fafc; border: 1.5px solid #e2e8f0; border-radius: 8px !important;">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <h6 class="fw-bold mb-0" style="color: #0f172a;"><i class="bi bi-activity me-1 text-primary"></i> A. PTSD (Post-Traumatic Stress Disorder)</h6>
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
            <div class="p-3 h-100" style="background: #fdf2f8; border: 1.5px solid #fbcfe8; border-radius: 8px !important;">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <h6 class="fw-bold mb-0" style="color: #9d174d;"><i class="bi bi-heart-pulse me-1 text-danger"></i> B. DSO (Disturbances in Self-Organization)</h6>
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
    <div class="p-3 mt-1 text-center" style="border-radius: 8px !important; <?= $itqResult['overall_risk'] === 'HIGH' ? 'background-color: #fef2f2; border: 1.5px solid #fecaca;' : 'background-color: #f8fafc; border: 1.5px solid #e2e8f0;' ?>">
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
<div class="card posko-item-card p-4 mb-4">
    <div class="border-bottom pb-3 mb-4">
        <h5 class="fw-bold mb-1" style="color: #064e3b;"><i class="bi bi-pie-chart-fill text-success me-2"></i> Visualisasi Grafik Klinis (Chart.js)</h5>
        <p class="text-muted small mb-0">Analisis profil kluster gejala dan tren longitudinal follow-up penyintas.</p>
    </div>

    <div class="row g-4">
        <!-- Grafik 1: Horizontal Bar PTSD vs DSO -->
        <div class="col-12 col-md-6">
            <div class="p-3 h-100 bg-white" style="border: 1.5px solid #cbd5e1; border-radius: 8px !important;">
                <h6 class="fw-bold text-dark small mb-3">1. Skor Total PTSD vs DSO (Skala 0-24)</h6>
                <div style="position: relative; height: 220px;">
                    <canvas id="chart1Canvas"></canvas>
                </div>
            </div>
        </div>

        <!-- Grafik 2: Cluster Bar PTSD -->
        <div class="col-12 col-md-6">
            <div class="p-3 h-100 bg-white" style="border: 1.5px solid #cbd5e1; border-radius: 8px !important;">
                <h6 class="fw-bold text-dark small mb-3">2. Profil Rata-Rata Kluster PTSD</h6>
                <div style="position: relative; height: 220px;">
                    <canvas id="chart2Canvas"></canvas>
                </div>
            </div>
        </div>

        <!-- Grafik 3: Cluster Bar DSO -->
        <div class="col-12 col-md-6">
            <div class="p-3 h-100 bg-white" style="border: 1.5px solid #cbd5e1; border-radius: 8px !important;">
                <h6 class="fw-bold text-dark small mb-3">3. Profil Rata-Rata Kluster DSO</h6>
                <div style="position: relative; height: 220px;">
                    <canvas id="chart3Canvas"></canvas>
                </div>
            </div>
        </div>

        <!-- Grafik 4: Line Chart Longitudinal -->
        <div class="col-12 col-md-6">
            <div class="p-3 h-100 bg-white" style="border: 1.5px solid #cbd5e1; border-radius: 8px !important;">
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
<div class="card posko-item-card p-4 mb-4">
    <div class="border-bottom pb-3 mb-4">
        <h5 class="fw-bold mb-1" style="color: #064e3b;"><i class="bi bi-clipboard-check-fill text-success me-2"></i> Form Aksi Final Psikolog & Rencana Follow-up</h5>
        <p class="text-muted small mb-0">Tetapkan diagnosis sementara, intervensi, dan jadwal pemantauan klinis.</p>
    </div>

    <form action="<?= site_url('/clinical-action/save/' . $victim['id']) ?>" method="POST">
        <?= csrf_field() ?>

        <div class="row g-4">
            <!-- Approval / Override Switch -->
            <div class="col-12 col-md-6">
                <div class="p-3 h-100" style="background: #f8fafc; border: 1.5px solid #e2e8f0; border-radius: 8px !important;">
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
                <div class="p-3 h-100" style="background: #f8fafc; border: 1.5px solid #e2e8f0; border-radius: 8px !important;">
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

        <div class="border-top pt-3 mt-4 d-flex justify-content-end">
            <button type="submit" class="frost-btn-primary px-4 py-2">
                <i class="bi bi-check-all me-1"></i> Simpan Aksi Klinis & Finalisasi Review
            </button>
        </div>
    </form>
</div>

</div> <!-- container-fluid -->

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
