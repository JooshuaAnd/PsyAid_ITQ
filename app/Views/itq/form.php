<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="row mb-4 align-items-center">
    <div class="col">
        <a href="<?= site_url('/psychologist-review/' . $victim['id']) ?>" class="btn btn-outline-secondary btn-sm mb-2">
            <i class="bi bi-arrow-left me-1"></i> Kembali ke Review MSE
        </a>
        <h3 class="fw-bold text-dark mb-1">
            <i class="bi bi-file-earmark-text-fill text-primary me-2"></i> Form Instrumen ITQ (International Trauma Questionnaire)
        </h3>
        <p class="text-muted small mb-0">Penyintas: <strong><?= esc($victim['nama']) ?></strong> (NIK: <?= esc($victim['nik'] ?? '-') ?>) • Evaluasi 18 Item Resmi PTSD & DSO (ICD-11)</p>
    </div>
</div>

<!-- Display Validation Errors -->
<?php if (session()->getFlashdata('errors')): ?>
    <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
        <h6 class="fw-bold mb-2"><i class="bi bi-exclamation-triangle-fill me-1"></i> Mohon lengkapi semua pertanyaan ITQ:</h6>
        <ul class="mb-0 ps-3">
            <?php foreach (session()->getFlashdata('errors') as $error): ?>
                <li><?= esc($error) ?></li>
            <?php endforeach; ?>
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<!-- ITQ Instruction Box -->
<div class="alert alert-info border-start border-4 border-info p-3 mb-4 shadow-sm">
    <div class="d-flex align-items-center gap-2">
        <i class="bi bi-info-circle-fill fs-4 text-info"></i>
        <div>
            <strong class="text-dark">Petunjuk Pengisian Skala Likert (0 - 4):</strong>
            <div class="small text-muted">
                <strong>0</strong> = Tidak sama sekali | 
                <strong>1</strong> = Sedikit | 
                <strong>2</strong> = Sedang | 
                <strong>3</strong> = Cukup berat | 
                <strong>4</strong> = Sangat berat (Mengganggu dalam 1 bulan terakhir)
            </div>
        </div>
    </div>
</div>

<form action="<?= site_url('/itq/store/' . $victim['id']) ?>" method="POST">
    <?= csrf_field() ?>

    <?php foreach ($itqQuestions as $secKey => $sec): ?>
        <div class="card card-custom bg-white p-4 shadow-sm mb-4">
            <div class="border-bottom pb-2 mb-4">
                <h5 class="fw-bold text-primary mb-0"><?= esc($sec['title']) ?></h5>
            </div>

            <?php foreach ($sec['groups'] as $group): ?>
                <div class="mb-4">
                    <h6 class="fw-semibold text-dark bg-light p-2 rounded border border-start border-3 border-primary mb-3">
                        <?= esc($group['name']) ?>
                    </h6>

                    <div class="d-flex flex-column gap-3">
                        <?php foreach ($group['items'] as $itemNum => $itemText): ?>
                            <?php $val = old('item_' . $itemNum, $existing['item_' . $itemNum] ?? null); ?>
                            <div class="p-3 bg-white rounded border">
                                <div class="row align-items-center g-3">
                                    <div class="col-12 col-lg-7">
                                        <label class="form-label fw-medium text-dark mb-0">
                                            <strong>Pertanyaan <?= $itemNum ?>:</strong> <?= esc($itemText) ?>
                                        </label>
                                    </div>
                                    <div class="col-12 col-lg-5">
                                        <div class="d-flex justify-content-between text-center gap-1">
                                            <?php for ($score = 0; $score <= 4; $score++): ?>
                                                <div class="flex-fill">
                                                    <input type="radio" class="btn-check" name="item_<?= $itemNum ?>" id="item_<?= $itemNum ?>_<?= $score ?>" value="<?= $score ?>" <?= (string)$val === (string)$score ? 'checked' : '' ?> required>
                                                    <label class="btn btn-outline-primary btn-sm w-100 py-1" for="item_<?= $itemNum ?>_<?= $score ?>">
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

    <div class="card card-custom bg-white p-3 shadow-sm mb-4 text-end">
        <button type="submit" class="btn btn-success px-4 py-2 fw-bold shadow-sm">
            <i class="bi bi-check-circle-fill me-1"></i> Simpan Jawaban ITQ & Hitung Assessment Results
        </button>
    </div>
</form>
<?= $this->endSection() ?>
