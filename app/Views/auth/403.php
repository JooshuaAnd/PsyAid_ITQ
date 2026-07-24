<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="row justify-content-center align-items-center my-5">
    <div class="col-12 col-md-8 col-lg-6 text-center">
        <div class="card card-custom p-5 bg-white shadow-sm border-danger border-top border-4">
            <div class="display-1 text-danger mb-3">
                <i class="bi bi-shield-x"></i>
            </div>
            <h1 class="display-6 fw-bold text-dark mb-2">403 — Akses Ditolak</h1>
            <p class="lead text-muted mb-4">
                Maaf, akun Anda (<strong><?= esc(session()->get('role') ?? 'Guest') ?></strong>) tidak memiliki hak akses untuk membuka halaman ini.
            </p>

            <div class="d-flex justify-content-center gap-3">
                <?php if (session()->get('logged_in')): ?>
                    <?php if (session()->get('role') === 'bpbd_admin'): ?>
                        <a href="<?= site_url('/command-center') ?>" class="btn btn-danger px-4 py-2"><i class="bi bi-arrow-left me-1"></i> Kembali ke Command Center</a>
                    <?php elseif (session()->get('role') === 'relawan'): ?>
                        <a href="<?= site_url('/relawan/posko/' . (session()->get('posko_id') ?? 1)) ?>" class="btn btn-success px-4 py-2"><i class="bi bi-arrow-left me-1"></i> Kembali ke Posko Relawan</a>
                    <?php elseif (session()->get('role') === 'psikolog'): ?>
                        <a href="<?= site_url('/psikolog/dashboard') ?>" class="btn btn-primary px-4 py-2"><i class="bi bi-arrow-left me-1"></i> Kembali ke Dashboard Psikolog</a>
                    <?php endif; ?>
                <?php else: ?>
                    <a href="<?= site_url('/login') ?>" class="btn btn-secondary px-4 py-2"><i class="bi bi-box-arrow-in-right me-1"></i> Ke Halaman Login</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
