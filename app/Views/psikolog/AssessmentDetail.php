<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<style>
    .assessment-hero,
    .posko-item-card,
    .detail-panel,
    .detail-field,
    .risk-summary-card,
    .assessment-empty-state,
    .btn,
    .badge,
    .alert {
        border-radius: 8px !important;
    }

    .assessment-hero {
        background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 60%, #a7f3d0 100%);
        border: 1.5px solid #a7f3d0;
        color: #064e3b;
        position: relative;
        overflow: hidden;
        box-shadow: 0 10px 30px -4px rgba(16, 185, 129, 0.12), inset 0 1.5px 2px rgba(255, 255, 255, 0.85);
    }

    .posko-item-card {
        background: #ffffff !important;
        border: 1.5px solid #d1fae5 !important;
        box-shadow: 0 4px 12px -2px rgba(16, 185, 129, 0.08), 0 2px 5px -1px rgba(15, 23, 42, 0.04) !important;
        transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1) !important;
    }

    .posko-item-card:hover {
        background: #ffffff !important;
        border-color: #34d399 !important;
        box-shadow: 0 12px 28px -4px rgba(16, 185, 129, 0.18), 0 4px 10px -2px rgba(15, 23, 42, 0.04) !important;
        transform: translateY(-2px) !important;
    }

    .section-header {
        border-bottom: 1.5px solid #e2e8f0;
        padding-bottom: 1rem;
        margin-bottom: 1rem;
    }

    .section-title,
    .detail-value,
    .summary-title {
        color: #064e3b;
    }

    .summary-title.risk-high {
        color: #dc2626;
    }

    .summary-title.risk-medium {
        color: #b45309;
    }

    .summary-title.risk-low {
        color: #047857;
    }

    .priority-value.priority-urgent {
        color: #dc2626 !important;
    }

    .hero-badge,
    .count-badge {
        background-color: rgba(6, 95, 70, 0.08) !important;
        color: #047857 !important;
        border: 1px solid rgba(6, 95, 70, 0.18) !important;
    }

    .detail-panel,
    .detail-field,
    .risk-summary-card,
    .analysis-box {
        background: #ffffff;
        border: 1.5px solid #e2e8f0;
    }

    .detail-field {
        padding: 0.9rem 1rem;
        height: 100%;
    }

    .detail-label {
        display: block;
        color: #64748b;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.035em;
        margin-bottom: 0.55rem;
        padding-bottom: 0.45rem;
        border-bottom: 1.5px solid #e2e8f0;
    }

    .detail-value {
        font-weight: 700;
        overflow-wrap: anywhere;
    }

    .risk-summary-card {
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.98) 0%, rgba(244, 251, 247, 0.9) 100%);
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.07);
    }

    .risk-summary-card .summary-title {
        border-top: 1.5px solid #e2e8f0;
        padding-top: 0.85rem;
    }

    .soft-badge {
        border: 1px solid transparent !important;
        font-size: 0.75rem !important;
        font-weight: 700 !important;
        padding: 0.4rem 0.65rem !important;
        white-space: normal;
    }

    .soft-badge-success {
        background-color: #ecfdf5 !important;
        color: #047857 !important;
        border-color: #a7f3d0 !important;
    }

    .soft-badge-danger {
        background-color: #fef2f2 !important;
        color: #dc2626 !important;
        border-color: #fecdd3 !important;
    }

    .soft-badge-warning {
        background-color: #fffbeb !important;
        color: #b45309 !important;
        border-color: #fde68a !important;
    }

    .soft-badge-neutral {
        background-color: #f8fafc !important;
        color: #64748b !important;
        border-color: #e2e8f0 !important;
    }

    .btn-frost,
    .btn-outline-frost:hover {
        background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
        color: #065f46 !important;
        border: 1.5px solid #34d399;
        font-weight: 700;
        transition: all 0.2s ease;
        box-shadow: 0 2px 6px rgba(16, 185, 129, 0.15);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.35rem;
        text-decoration: none;
    }

    .btn-frost:hover {
        background: linear-gradient(135deg, #a7f3d0 0%, #6ee7b7 100%);
        color: #064e3b !important;
        border-color: #10b981;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.25);
        transform: translateY(-1px);
    }

    .btn-outline-frost {
        background: #ffffff !important;
        color: #047857 !important;
        border: 1.5px solid #a7f3d0 !important;
        font-weight: 700;
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.35rem;
        text-decoration: none;
    }

    .hero-action-row {
        margin-top: 1.15rem;
        padding-top: 1rem;
        border-top: 1px solid rgba(6, 95, 70, 0.14);
    }

    .hero-action-btn {
        min-height: 38px;
        padding: 0.48rem 0.95rem;
        font-size: 0.8125rem;
        line-height: 1.2;
    }

    .assessment-empty-state {
        background-color: #f8fafc;
        border: 1.5px solid #e2e8f0;
        color: #64748b;
        padding: 1.5rem;
    }

    .analysis-box {
        background-color: #f8fafc;
        color: #334155;
        line-height: 1.7;
        padding: 1rem;
    }

    .tabular-nums {
        font-variant-numeric: tabular-nums;
        font-feature-settings: "tnum";
    }

    .fs-8 {
        font-size: 0.75rem;
    }

    @media (max-width: 575.98px) {
        .assessment-hero .card-body,
        .posko-item-card {
            padding: 1.15rem !important;
        }

        .btn-frost,
        .btn-outline-frost {
            width: 100%;
        }

        .hero-action-row {
            width: 100%;
            align-items: stretch !important;
        }
    }
</style>

<?php
$victim = $victim ?? [];
$aiAssessment = $aiAssessment ?? null;
$itqAnswers = $itqAnswers ?? null;
$riskLevel = strtolower($aiAssessment['risk_level'] ?? 'low');
$riskLabel = $riskLevel === 'high' ? 'HIGH RISK' : ($riskLevel === 'medium' ? 'MEDIUM RISK' : 'LOW RISK');
$riskIcon = $riskLevel === 'high' ? 'bi-exclamation-triangle-fill' : ($riskLevel === 'medium' ? 'bi-dash-circle-fill' : 'bi-check-circle-fill');
$riskTitleClass = $riskLevel === 'high' ? 'risk-high' : ($riskLevel === 'medium' ? 'risk-medium' : 'risk-low');
$clinicalPriority = $aiAssessment['clinical_priority'] ?? 'Tidak ada data';
$priorityClass = strtolower(trim((string) $clinicalPriority)) === 'urgent' ? 'priority-urgent' : '';
$aiCompleted = $aiAssessment && in_array($aiAssessment['status'] ?? '', ['completed', 'ai_generated'], true);
?>

<div class="container-fluid px-0">

    <div class="card assessment-hero mb-4">
        <div class="card-body p-4 position-relative">
            <div class="d-flex align-items-center gap-2 flex-wrap mb-2">
                <div class="d-flex align-items-center gap-2 flex-wrap">
                    <span class="badge hero-badge px-3 py-1.5 fs-8 fw-bold">
                        <i class="bi bi-person-vcard-fill me-1" style="color: #059669;"></i> DETAIL ASSESSMENT
                    </span>
                    <span class="badge hero-badge px-3 py-1.5 fs-8">
                        <?= esc(($victim['jenis_kelamin'] ?? '') === 'L' ? 'Laki-Laki' : 'Perempuan') ?> &bull; <?= esc($victim['umur'] ?? '-') ?> Tahun
                    </span>
                </div>
            </div>
            <h3 class="fw-bold mb-1" style="color: #064e3b;">
                <i class="bi bi-clipboard2-pulse-fill me-2" style="color: #059669;"></i> Detail Assessment: <?= esc($victim['nama'] ?? '-') ?>
            </h3>
            <p class="small mb-0" style="color: #047857; max-width: 75ch;">
                Ringkasan identitas, hasil triase AI, dan status pengisian ITQ untuk membantu review klinis psikolog.
            </p>
            <div class="hero-action-row d-flex justify-content-end align-items-center gap-2 flex-wrap">
                <a href="<?= site_url('/psikolog/assessment-history') ?>" class="btn btn-outline-frost hero-action-btn">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
                <a href="<?= site_url('/psychologist-review/' . ($victim['id'] ?? '')) ?>" class="btn btn-frost hero-action-btn">
                    <i class="bi bi-clipboard-pulse"></i> Lakukan Review MSE
                </a>
            </div>
        </div>
    </div>

    <div class="card posko-item-card p-3 p-md-4 mb-3 mb-md-4">
        <div class="section-header d-flex align-items-center justify-content-between flex-wrap gap-2">
            <h5 class="section-title fw-bold mb-0 d-flex align-items-center">
                <i class="bi bi-person-vcard text-success me-2 fs-5"></i> Identitas Penyintas
            </h5>
            <span class="badge count-badge px-3 py-1.5 fs-8">
                <i class="bi bi-shield-check me-1"></i> Data Profil
            </span>
        </div>

        <div class="detail-panel p-3 p-md-4">
            <div class="row g-3">
                <div class="col-12 col-md-6">
                    <div class="detail-field">
                        <span class="detail-label">Nama Lengkap</span>
                        <div class="detail-value fs-6"><?= esc($victim['nama'] ?? '-') ?></div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="detail-field">
                        <span class="detail-label">Jenis Kelamin</span>
                        <div class="detail-value"><?= esc(($victim['jenis_kelamin'] ?? '') === 'L' ? 'Laki-Laki (L)' : 'Perempuan (P)') ?></div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="detail-field">
                        <span class="detail-label">Umur</span>
                        <div class="detail-value"><?= esc($victim['umur'] ?? '-') ?> Tahun</div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="detail-field">
                        <span class="detail-label">NIK</span>
                        <div class="detail-value tabular-nums"><?= esc($victim['nik'] ?? 'Tidak ada data') ?></div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="detail-field">
                        <span class="detail-label">Kontak Darurat</span>
                        <div class="detail-value tabular-nums"><?= esc($victim['kontak_darurat'] ?? 'Tidak ada data') ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card posko-item-card p-3 p-md-4 mb-3 mb-md-4">
        <div class="section-header d-flex justify-content-between align-items-center flex-wrap gap-2">
            <h5 class="section-title fw-bold mb-0 d-flex align-items-center">
                <i class="bi bi-robot text-success me-2 fs-5"></i> Hasil AI Assessment
            </h5>
            <?php if (!empty($aiAssessment['created_at'])): ?>
                <span class="badge soft-badge soft-badge-neutral">
                    <i class="bi bi-clock-history me-1"></i> <span data-device-time="<?= esc($aiAssessment['created_at']) ?>"></span>
                </span>
            <?php endif; ?>
        </div>

        <?php if (!$aiAssessment): ?>
            <div class="assessment-empty-state text-center">
                <i class="bi bi-hourglass-split fs-2 d-block mb-2 text-success"></i>
                Data skrining awal belum diisi atau AI sedang memproses hasil assessment.
            </div>
        <?php else: ?>
            <div class="detail-panel p-3 p-md-4 mb-3">
                <div class="row g-4 align-items-stretch">
                    <div class="col-12 col-md-5">
                        <div class="risk-summary-card h-100 p-4 d-flex flex-column justify-content-center text-center">
                            <span class="text-muted mb-2 fw-semibold fs-8 text-uppercase" style="letter-spacing: 0.035em;">Tingkat Risiko Triage</span>
                            <div class="summary-title <?= esc($riskTitleClass) ?> fw-bold fs-4 text-uppercase">
                                <i class="bi <?= esc($riskIcon) ?> me-2"></i><?= esc($riskLabel) ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-7">
                        <div class="h-100 d-flex flex-column gap-3">
                            <div class="detail-field">
                                <span class="detail-label">Status AI</span>
                                <?php if ($aiCompleted): ?>
                                    <span class="badge soft-badge soft-badge-success">
                                        <i class="bi bi-check-all me-1"></i> Completed
                                    </span>
                                <?php else: ?>
                                    <span class="badge soft-badge soft-badge-warning">
                                        <i class="bi bi-arrow-repeat me-1"></i> Processing
                                    </span>
                                <?php endif; ?>
                            </div>
                            <div class="detail-field flex-fill">
                                <span class="detail-label">Rekomendasi Prioritas Klinis</span>
                                <div class="detail-value priority-value <?= esc($priorityClass) ?>"><?= esc($clinicalPriority) ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="detail-panel p-3 p-md-4">
                <h6 class="section-title fw-bold mb-3 d-flex align-items-center">
                    <i class="bi bi-chat-left-quote-fill text-success me-2"></i> Analisis AI
                </h6>
                <div class="analysis-box">
                    <?= nl2br(esc($aiAssessment['ai_summary'] ?? 'Belum ada hasil analisis AI yang dapat ditampilkan.')) ?>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <div class="card posko-item-card p-3 p-md-4 mb-3 mb-md-4">
        <div class="section-header d-flex justify-content-between align-items-center flex-wrap gap-2">
            <h5 class="section-title fw-bold mb-0 d-flex align-items-center">
                <i class="bi bi-journal-medical text-success me-2 fs-5"></i> Hasil Assessment ITQ
            </h5>
            <?php if (!empty($itqAnswers['created_at'])): ?>
                <span class="badge soft-badge soft-badge-neutral">
                    <i class="bi bi-clock-history me-1"></i> <span data-device-time="<?= esc($itqAnswers['created_at']) ?>"></span>
                </span>
            <?php endif; ?>
        </div>

        <?php if (!$itqAnswers): ?>
            <div class="assessment-empty-state text-center">
                <i class="bi bi-hourglass-split fs-2 d-block mb-2 text-success"></i>
                Instrumen ITQ belum dikerjakan oleh penyintas.
            </div>
        <?php else: ?>
            <div class="detail-panel p-3 p-md-4">
                <div class="assessment-empty-state text-center">
                    <i class="bi bi-check-circle-fill fs-2 d-block mb-2 text-success"></i>
                    <div class="fw-bold mb-1" style="color: #064e3b;">Kuesioner ITQ Selesai</div>
                    <div class="small mb-3">Penyintas telah menyelesaikan kuesioner ITQ dan hasil lengkap dapat ditinjau.</div>
                    <a href="<?= site_url('/itq/result/' . ($victim['id'] ?? '')) ?>" class="btn btn-sm btn-frost">
                        <i class="bi bi-box-arrow-up-right"></i> Lihat Hasil ITQ Lengkap
                    </a>
                </div>
            </div>
        <?php endif; ?>
    </div>

</div>
<?= $this->endSection() ?>
