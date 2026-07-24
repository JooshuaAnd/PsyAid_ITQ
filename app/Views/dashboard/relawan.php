<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="row mb-4 align-items-center">
    <div class="col">
        <h2 class="fw-bold text-dark mb-1"><i class="bi bi-geo-alt-fill text-success me-2"></i> Posko Relawan Lapangan</h2>
        <p class="text-muted mb-0">Halaman Kerja Relawan — Posko ID #<?= esc($poskoId) ?></p>
    </div>
    <div class="col-auto">
        <span class="badge bg-success fs-6 px-3 py-2"><i class="bi bi-person-heart me-1"></i> Relawan Access</span>
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-12 col-md-6">
        <div class="card card-custom bg-white p-4">
            <div class="d-flex align-items-center gap-3">
                <div class="fs-1 text-success"><i class="bi bi-person-plus-fill"></i></div>
                <div>
                    <h5 class="fw-bold mb-1">Input Data Penyintas & Skrining</h5>
                    <p class="text-muted small mb-0">Registrasi korban baru dan lakukan skrining awal gejala distres.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6">
        <div class="card card-custom bg-white p-4">
            <div class="d-flex align-items-center gap-3">
                <div class="fs-1 text-info"><i class="bi bi-journal-text"></i></div>
                <div>
                    <h5 class="fw-bold mb-1">Daftar Skrining Hari Ini</h5>
                    <p class="text-muted small mb-0">Pantau status hasil skrining yang telah dimasukkan di Posko #<?= esc($poskoId) ?>.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
