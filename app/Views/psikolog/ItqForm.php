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

    /* ITQ LIKERT RADIO BUTTON STYLING */
    .itq-likert-btn {
        background-color: #ffffff !important;
        color: #065f46 !important;
        border: 1.5px solid #a7f3d0 !important;
        border-radius: 8px !important;
        font-weight: 700 !important;
        padding: 0.35rem 0.5rem !important;
        transition: all 0.2s ease !important;
        cursor: pointer !important;
        box-shadow: 0 1px 2px rgba(15, 23, 42, 0.04) !important;
    }

    .itq-likert-btn:hover {
        background-color: #d1fae5 !important;
        color: #064e3b !important;
        border-color: #10b981 !important;
        box-shadow: 0 3px 8px rgba(16, 185, 129, 0.2) !important;
        transform: translateY(-1px);
    }

    .btn-check:checked + .itq-likert-btn {
        background: linear-gradient(135deg, #059669 0%, #047857 100%) !important;
        color: #ffffff !important;
        border-color: #047857 !important;
        box-shadow: 0 3px 10px rgba(5, 150, 105, 0.3) !important;
    }

    .btn-check:checked + .itq-likert-btn:hover {
        background: linear-gradient(135deg, #047857 0%, #065f46 100%) !important;
        color: #ffffff !important;
        border-color: #064e3b !important;
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
                        <i class="bi bi-file-earmark-text-fill me-1" style="color: #059669;"></i> ITQ TRAUMA INSTRUMENT
                    </span>
                    <span class="badge px-3 py-1.5 fs-8"
                        style="background-color: rgba(6, 95, 70, 0.08); color: #047857; border: 1px solid rgba(6, 95, 70, 0.18);">
                        ICD-11 PTSD & DSO
                    </span>
                </div>
                <div>
                    <a href="<?= site_url('/psychologist-review/' . $victim['id']) ?>" class="frost-btn-reset">
                        <i class="bi bi-arrow-left me-1"></i> Kembali ke Review MSE
                    </a>
                </div>
            </div>
            <h3 class="fw-bold mb-1" style="color: #064e3b;">
                <i class="bi bi-journal-medical me-2" style="color: #059669;"></i> Form Instrumen ITQ (International
                Trauma Questionnaire)
            </h3>
            <p class="small mb-0" style="color: #047857; max-width: 75ch;">
                Penyintas: <strong><?= esc($victim['nama']) ?></strong> (NIK: <?= esc($victim['nik'] ?? '-') ?>) •
                Evaluasi 18 Item Resmi PTSD & DSO (ICD-11)
            </p>
        </div>
    </div>

    <!-- Display Validation Errors -->
    <?php if (session()->getFlashdata('errors')): ?>
        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4" role="alert"
            style="border-radius: 8px !important;">
            <h6 class="fw-bold mb-2"><i class="bi bi-exclamation-triangle-fill me-1"></i> Mohon lengkapi semua pertanyaan
                ITQ:</h6>
            <ul class="mb-0 ps-3">
                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach; ?>
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <!-- ITQ Instruction Box -->
    <div class="card posko-item-card p-4 mb-4"
        style="background: linear-gradient(135deg, #ecfdf5 0%, #ffffff 100%); border-color: #a7f3d0 !important;">
        <h6 class="fw-bold mb-3 fs-6 d-flex align-items-center gap-2" style="color: #064e3b;">
            <i class="bi bi-info-circle-fill fs-5 flex-shrink-0" style="color: #059669;"></i>
            <span>Petunjuk Pengisian Skala Likert (0 - 4):</span>
        </h6>
        <div class="d-flex flex-wrap gap-3 row-gap-3">
            <span class="badge px-3 py-2 fs-8" style="background: #ffffff; color: #334155; border: 1.5px solid #cbd5e1; font-weight: 600; box-shadow: 0 1px 3px rgba(0,0,0,0.03);">
                <strong class="me-1" style="color: #059669;">0</strong> = Tidak sama sekali
            </span>
            <span class="badge px-3 py-2 fs-8" style="background: #ffffff; color: #334155; border: 1.5px solid #cbd5e1; font-weight: 600; box-shadow: 0 1px 3px rgba(0,0,0,0.03);">
                <strong class="me-1" style="color: #059669;">1</strong> = Sedikit
            </span>
            <span class="badge px-3 py-2 fs-8" style="background: #ffffff; color: #334155; border: 1.5px solid #cbd5e1; font-weight: 600; box-shadow: 0 1px 3px rgba(0,0,0,0.03);">
                <strong class="me-1" style="color: #059669;">2</strong> = Sedang
            </span>
            <span class="badge px-3 py-2 fs-8" style="background: #ffffff; color: #334155; border: 1px solid #cbd5e1; font-weight: 600; box-shadow: 0 1px 3px rgba(0,0,0,0.03);">
                <strong class="me-1" style="color: #059669;">3</strong> = Cukup berat
            </span>
            <span class="badge px-3 py-2 fs-8" style="background: #ffffff; color: #334155; border: 1.5px solid #cbd5e1; font-weight: 600; box-shadow: 0 1px 3px rgba(0,0,0,0.03);">
                <strong class="me-1" style="color: #059669;">4</strong> = Sangat berat (Mengganggu dalam 1 bulan terakhir)
            </span>
        </div>
    </div>

    <?php $faseKe = isset($_GET['fase_ke']) ? (int)$_GET['fase_ke'] : 0; ?>
    <form action="<?= site_url('/itq/store/' . $victim['id']) ?>?fase_ke=<?= $faseKe ?>" method="POST">
        <?= csrf_field() ?>

        <?php foreach ($itqQuestions as $secKey => $sec): ?>
            <div class="card posko-item-card p-4 mb-4">
                <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3.5 border-bottom pb-3">
                    <h5 class="fw-bold mb-0 d-flex align-items-center" style="color: #064e3b;">
                        <i class="bi bi-clipboard2-check text-success me-2 fs-5"></i> <?= esc($sec['title']) ?>
                    </h5>
                </div>

                <?php foreach ($sec['groups'] as $group): ?>
                    <div class="p-3 p-md-3.5 rounded-3 mb-4"
                        style="background: #f8fafc; border: 1.5px solid #e2e8f0; border-radius: 8px !important;">
                        <h6 class="fw-bold p-2.5 px-3 mb-3 d-flex align-items-center"
                            style="background: #ecfdf5; color: #064e3b; border-radius: 8px !important; border: 1.5px solid #a7f3d0;">
                            <i class="bi bi-tag-fill me-2 fs-7" style="color: #059669;"></i> <?= esc($group['name']) ?>
                        </h6>

                        <div class="d-flex flex-column gap-2.5">
                            <?php foreach ($group['items'] as $itemNum => $itemText): ?>
                                <?php $val = old('item_' . $itemNum, $existing['item_' . $itemNum] ?? null); ?>
                                <div class="p-3 bg-white rounded-3"
                                    style="border: 1.5px solid #cbd5e1 !important; border-radius: 8px !important;">
                                    <div class="row align-items-center g-3">
                                        <div class="col-12 col-lg-7">
                                            <label class="form-label fw-semibold mb-0" style="color: #0f172a;">
                                                <strong style="color: #059669;">Pertanyaan <?= $itemNum ?>:</strong>
                                                <?= esc($itemText) ?>
                                            </label>
                                        </div>
                                        <div class="col-12 col-lg-5">
                                            <div class="d-flex justify-content-between text-center gap-2 gap-md-2.5">
                                                <?php for ($score = 0; $score <= 4; $score++): ?>
                                                    <div class="flex-fill">
                                                        <input type="radio" class="btn-check" name="item_<?= $itemNum ?>"
                                                            id="item_<?= $itemNum ?>_<?= $score ?>" value="<?= $score ?>"
                                                            <?= (string) $val === (string) $score ? 'checked' : '' ?> required>
                                                        <label class="btn itq-likert-btn btn-sm w-100 py-1.5"
                                                            for="item_<?= $itemNum ?>_<?= $score ?>">
                                                            <strong><?= $score ?></strong>
                                                        </label>
                                                    </div>
                                                <?php endfor; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>

        <div class="card posko-item-card p-3 mb-4">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                <div class="small text-muted d-flex align-items-center">
                    <i class="bi bi-shield-check fs-5 flex-shrink-0 me-3" style="color: #059669; margin-right: 12px !important;"></i>
                    <span>Hasil evaluasi ITQ akan otomatis dihitung secara instan sesuai standar ICD-11.</span>
                </div>
                <button type="submit" class="frost-btn-primary px-3.5 py-2">
                    <i class="bi bi-check-circle-fill me-1"></i> Simpan & Hitung Hasil ITQ
                </button>
            </div>
        </div>
    </form>

</div>
<?= $this->endSection() ?>