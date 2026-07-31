<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<style>
    /* Strict Max Rounded 8px (lg) Policy */
    .frost-card,
    .frost-hero,
    .frost-btn-primary,
    .posko-item-card,
    .btn,
    .badge,
    .card {
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

    /* LIGHT GREEN BUTTON: PRIMARY ACTION */
    .frost-btn-primary {
        background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
        color: #065f46 !important;
        border: 1.5px solid #34d399;
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

    /* POSKO ITEM CARD */
    .posko-item-card {
        background: #ffffff !important;
        border: 1.5px solid #d1fae5 !important;
        box-shadow: 0 4px 12px -2px rgba(16, 185, 129, 0.08), 0 2px 5px -1px rgba(15, 23, 42, 0.04) !important;
        transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1) !important;
    }
</style>

<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold mb-0" style="color: #064e3b;">
            <i class="bi bi-person-vcard text-success me-2"></i> Detail Assessment: <?= esc($victim['nama']) ?>
        </h4>
        <a href="<?= site_url('/psychologist-review/' . $victim['id']) ?>" class="frost-btn-primary px-4 py-2 text-nowrap shadow-sm">
            <i class="bi bi-clipboard-pulse me-2"></i> Lakukan Review MSE
        </a>
    </div>

    <!-- 1. IDENTITAS PENYINTAS -->
    <div class="card posko-item-card p-3 p-md-4 mb-3 mb-md-4">
        <h6 class="fw-bold text-dark mb-3 mb-md-4 fs-6"><i class="bi bi-person-vcard text-primary me-2"></i> 1. Identitas Penyintas</h6>
        <div class="bg-white p-3 p-md-4 rounded border">
            <div class="row g-3 g-md-4">
                <div class="col-12 col-md-6">
                    <span class="text-muted small d-block">Nama Lengkap</span>
                    <strong class="text-dark fs-6"><?= esc($victim['nama']) ?></strong>
                </div>
                <div class="col-6 col-md-3">
                    <span class="text-muted small d-block">Jenis Kelamin</span>
                    <strong class="text-dark"><?= esc($victim['jenis_kelamin'] === 'L' ? 'Laki-Laki (L)' : 'Perempuan (P)') ?></strong>
                </div>
                <div class="col-6 col-md-3">
                    <span class="text-muted small d-block">Umur</span>
                    <strong class="text-dark"><?= esc($victim['umur']) ?> Tahun</strong>
                </div>
                <div class="col-12 col-md-6">
                    <span class="text-muted small d-block">NIK</span>
                    <strong class="text-dark tabular-nums"><?= esc($victim['nik'] ?? 'Tidak ada data') ?></strong>
                </div>
                <div class="col-12 col-md-6">
                    <span class="text-muted small d-block">Kontak Darurat (No. HP)</span>
                    <strong class="text-dark tabular-nums"><?= esc($victim['kontak_darurat'] ?? 'Tidak ada data') ?></strong>
                </div>
            </div>
        </div>
    </div>

    <!-- 2. HASIL AI ASSESSMENT -->
    <div class="card posko-item-card p-3 p-md-4 mb-3 mb-md-4">
        <div class="d-flex justify-content-between align-items-center mb-3 mb-md-4">
            <h6 class="fw-bold text-dark mb-0 fs-6"><i class="bi bi-robot text-danger me-2"></i> 2. Hasil AI Assessment</h6>
            <?php if (!empty($aiAssessment['created_at'])): ?>
                <span class="badge bg-light text-dark border fs-7">
                    <i class="bi bi-clock-history me-1"></i> <span data-device-time="<?= esc($aiAssessment['created_at']) ?>"></span>
                </span>
            <?php endif; ?>
        </div>
        
        <?php if (!$aiAssessment): ?>
            <div class="alert alert-secondary border-0 text-center py-4">
                <i class="bi bi-hourglass-split fs-2 d-block mb-2 text-muted"></i>
                Data skrining awal belum diisi atau AI sedang memproses hasil assessment.
            </div>
        <?php else: ?>
            <div class="bg-white p-3 p-md-4 rounded border mb-3">
                <div class="row g-4 align-items-center">
                    <div class="col-12 col-md-5">
                        <div class="p-4 rounded border h-100 d-flex flex-column justify-content-center text-center frost-card">
                            <span class="text-muted mb-2 fw-semibold">Tingkat Risiko Triage</span>
                            <?php if ($aiAssessment['risk_level'] === 'high'): ?>
                                <h3 class="fw-bold text-danger mb-0 text-uppercase"><i class="bi bi-exclamation-triangle-fill me-2"></i>HIGH RISK</h3>
                            <?php elseif ($aiAssessment['risk_level'] === 'medium'): ?>
                                <h3 class="fw-bold text-warning mb-0 text-uppercase"><i class="bi bi-dash-circle-fill me-2"></i>MEDIUM RISK</h3>
                            <?php else: ?>
                                <h3 class="fw-bold text-success mb-0 text-uppercase"><i class="bi bi-check-circle-fill me-2"></i>LOW RISK</h3>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-12 col-md-7">
                        <div class="p-3">
                            <span class="text-muted small d-block mb-1">Status AI</span>
                            <?php if (in_array($aiAssessment['status'], ['completed', 'ai_generated'], true)): ?>
                                <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-1.5 fs-7 fw-bold mb-3 d-inline-block">
                                    <i class="bi bi-check-all me-1"></i> Completed
                                </span>
                            <?php else: ?>
                                <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle px-3 py-1.5 fs-7 fw-bold mb-3 d-inline-block">
                                    <i class="bi bi-arrow-repeat me-1"></i> Processing
                                </span>
                            <?php endif; ?>

                            <span class="text-muted small d-block mb-1">Rekomendasi Prioritas Klinis</span>
                            <div class="p-3 bg-light border rounded">
                                <span class="fw-semibold text-dark"><?= esc($aiAssessment['clinical_priority'] ?? 'Tidak ada data') ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white p-3 p-md-4 rounded border">
                <h6 class="fw-bold text-dark mb-3"><i class="bi bi-chat-left-quote-fill text-primary me-2"></i> Analisis AI</h6>
                <div class="p-3 p-md-4 bg-light border rounded" style="font-size: 0.95rem; line-height: 1.7;">
                    <?= nl2br(esc($aiAssessment['ai_summary'] ?? 'Belum ada hasil analisis AI yang dapat ditampilkan.')) ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
    
    <!-- 3. HASIL ITQ -->
    <div class="card posko-item-card p-3 p-md-4 mb-3 mb-md-4">
        <div class="d-flex justify-content-between align-items-center mb-3 mb-md-4">
            <h6 class="fw-bold text-dark mb-0 fs-6"><i class="bi bi-journal-medical text-primary me-2"></i> 3. Hasil Assessment ITQ</h6>
            <?php if (!empty($itqAnswers['created_at'])): ?>
                <span class="badge bg-light text-dark border fs-7">
                    <i class="bi bi-clock-history me-1"></i> <span data-device-time="<?= esc($itqAnswers['created_at']) ?>"></span>
                </span>
            <?php endif; ?>
        </div>
        
        <?php if (!$itqAnswers): ?>
            <div class="alert alert-secondary border-0 text-center py-4">
                <i class="bi bi-hourglass-split fs-2 d-block mb-2 text-muted"></i>
                Instrumen ITQ belum dikerjakan oleh penyintas.
            </div>
        <?php else: ?>
            <div class="bg-white p-3 p-md-4 rounded border">
                <div class="alert alert-success border-0 text-center">
                    <i class="bi bi-check-circle-fill fs-2 d-block mb-2 text-success"></i>
                    Penyintas telah menyelesaikan kuesioner ITQ.
                    <br>
                    <a href="<?= site_url('/itq/result/' . $victim['id']) ?>" class="btn btn-sm btn-outline-success mt-3 fw-bold">
                        <i class="bi bi-box-arrow-up-right me-1"></i> Lihat Hasil ITQ Lengkap
                    </a>
                </div>
            </div>
        <?php endif; ?>
    </div>

</div>
<?= $this->endSection() ?>
