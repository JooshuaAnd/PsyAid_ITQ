<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<style>
    .frost-hero { background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 60%, #a7f3d0 100%); border: 1.5px solid #a7f3d0; color: #064e3b; border-radius: 8px; }
    .frost-btn-reset { background: #ffffff !important; color: #475569 !important; border: 1.5px solid #cbd5e1 !important; border-radius: 8px !important; font-weight: 600 !important; font-size: 0.8125rem !important; padding: 0.45rem 0.85rem !important; text-decoration: none; }
    .posko-item-card { background: #ffffff !important; border: 1.5px solid #e2e8f0 !important; box-shadow: 0 4px 12px -2px rgba(15, 23, 42, 0.04) !important; border-radius: 8px; }
    .btn-frost { background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%); color: #065f46 !important; border: 1.5px solid #34d399; font-weight: 700; border-radius: 8px; }
    .card-followup { border: 1px solid #cbd5e1; border-radius: 8px; background-color: #f8fafc; }
    .card-followup-header { background-color: #e2e8f0; border-bottom: 1px solid #cbd5e1; padding: 10px 15px; font-weight: bold; border-radius: 8px 8px 0 0; }
</style>

<div class="container-fluid px-0">
    <div class="card frost-hero mb-4">
        <div class="card-body p-4 position-relative">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <span class="badge px-3 py-1.5 fs-8 fw-bold" style="background-color: rgba(6, 95, 70, 0.12); color: #065f46; border: 1px solid rgba(6, 95, 70, 0.25);">
                    <i class="bi bi-heart-pulse-fill me-1"></i> MONITORING PENYINTAS
                </span>
                <a href="<?= site_url('/psikolog/monitoring') ?>" class="frost-btn-reset">
                    <i class="bi bi-arrow-left me-1"></i> Kembali
                </a>
            </div>
            <h3 class="fw-bold mb-1" style="color: #064e3b;"><?= esc($victim['nama']) ?> (<?= esc($victim['nik']) ?>)</h3>
            <p class="small mb-0" style="color: #047857;">
                Diagnosis Awal: <strong><?= esc($clinicalAction['diagnosis_sementara'] ?? 'Belum ada') ?></strong> | 
                Intervensi: <strong><?= esc($clinicalAction['intervensi'] ?? 'Belum ada') ?></strong>
            </p>
        </div>
    </div>

    <!-- AI SUMMARY SECTION -->
    <div class="card posko-item-card p-4 mb-4" style="background-color: #eff6ff !important; border-color: #bfdbfe !important;">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="fw-bold text-primary mb-0"><i class="bi bi-robot"></i> Analisis Perkembangan AI PsyAid</h5>
            <button class="btn btn-sm btn-primary" id="btnGenerateAi"><i class="bi bi-magic me-1"></i> Generate AI Summary</button>
        </div>
        <div id="aiSummaryContent" class="p-3 bg-white border rounded">
            <span class="text-muted small fst-italic">Klik tombol "Generate AI Summary" untuk menganalisis data follow-up.</span>
        </div>
        <div id="aiLoading" class="d-none mt-2 text-center text-primary">
            <div class="spinner-border spinner-border-sm" role="status"></div> Sedang menganalisis data klinis...
        </div>
    </div>

    <h5 class="fw-bold mb-3"><i class="bi bi-calendar-check me-2"></i> Data Longitudinal Follow-up</h5>
    
    <div class="row g-4 mb-4">
        <!-- Follow Up 1 -->
        <div class="col-12 col-md-4">
            <div class="card-followup h-100">
                <div class="card-followup-header d-flex justify-content-between align-items-center">
                    <span>Follow-Up #1 (Hari ke-7)</span>
                    <?php if($organizedFollowups[1]): ?>
                        <span class="badge bg-success"><i class="bi bi-check"></i> Selesai</span>
                    <?php else: ?>
                        <span class="badge bg-secondary">Pending</span>
                    <?php endif; ?>
                </div>
                <div class="p-3">
                    <?php if($organizedFollowups[1]): ?>
                        <div class="mb-2"><strong>Skor PTSD:</strong> <?= $organizedFollowups[1]['ptsd_score'] ?></div>
                        <div class="mb-2"><strong>Skor DSO:</strong> <?= $organizedFollowups[1]['dso_score'] ?></div>
                        <div><strong>Catatan:</strong><br><small><?= esc($organizedFollowups[1]['catatan_psikolog']) ?></small></div>
                    <?php else: ?>
                        <div class="text-center text-muted py-4"><small>Belum dilakukan</small></div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Follow Up 2 -->
        <div class="col-12 col-md-4">
            <div class="card-followup h-100">
                <div class="card-followup-header d-flex justify-content-between align-items-center">
                    <span>Follow-Up #2 (Hari ke-14)</span>
                    <?php if($organizedFollowups[2]): ?>
                        <span class="badge bg-success"><i class="bi bi-check"></i> Selesai</span>
                    <?php else: ?>
                        <span class="badge bg-secondary">Pending</span>
                    <?php endif; ?>
                </div>
                <div class="p-3">
                    <?php if($organizedFollowups[2]): ?>
                        <div class="mb-2"><strong>Skor PTSD:</strong> <?= $organizedFollowups[2]['ptsd_score'] ?></div>
                        <div class="mb-2"><strong>Skor DSO:</strong> <?= $organizedFollowups[2]['dso_score'] ?></div>
                        <div><strong>Catatan:</strong><br><small><?= esc($organizedFollowups[2]['catatan_psikolog']) ?></small></div>
                    <?php else: ?>
                        <div class="text-center text-muted py-4"><small>Belum dilakukan</small></div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Follow Up 3 -->
        <div class="col-12 col-md-4">
            <div class="card-followup h-100">
                <div class="card-followup-header d-flex justify-content-between align-items-center">
                    <span>Follow-Up #3 (Hari ke-30)</span>
                    <?php if($organizedFollowups[3]): ?>
                        <span class="badge bg-success"><i class="bi bi-check"></i> Selesai</span>
                    <?php else: ?>
                        <span class="badge bg-secondary">Pending</span>
                    <?php endif; ?>
                </div>
                <div class="p-3">
                    <?php if($organizedFollowups[3]): ?>
                        <div class="mb-2"><strong>Skor PTSD:</strong> <?= $organizedFollowups[3]['ptsd_score'] ?></div>
                        <div class="mb-2"><strong>Skor DSO:</strong> <?= $organizedFollowups[3]['dso_score'] ?></div>
                        <div><strong>Catatan:</strong><br><small><?= esc($organizedFollowups[3]['catatan_psikolog']) ?></small></div>
                    <?php else: ?>
                        <div class="text-center text-muted py-4"><small>Belum dilakukan</small></div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('btnGenerateAi').addEventListener('click', function() {
    const btn = this;
    const loading = document.getElementById('aiLoading');
    const content = document.getElementById('aiSummaryContent');
    const victimId = <?= $victim['id'] ?>;

    btn.disabled = true;
    loading.classList.remove('d-none');

    fetch('<?= site_url('/psikolog/monitoring/generate-ai-summary/') ?>' + victimId)
        .then(res => res.json())
        .then(data => {
            loading.classList.add('d-none');
            btn.disabled = false;
            
            if (data.status === 'success') {
                // Convert newlines to br for html display
                content.innerHTML = data.summary.replace(/\n/g, '<br/>');
                content.classList.add('fw-semibold');
            } else {
                content.innerHTML = '<span class="text-danger">Gagal memuat AI Summary. ' + (data.message || '') + '</span>';
            }
        })
        .catch(err => {
            loading.classList.add('d-none');
            btn.disabled = false;
            content.innerHTML = '<span class="text-danger">Terjadi kesalahan teknis.</span>';
        });
});
</script>
<?= $this->endSection() ?>
