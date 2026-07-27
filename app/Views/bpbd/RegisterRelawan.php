<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid px-3 px-md-4 py-4">

    <!-- Top Header Section -->
    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center mb-4 gap-3">
        <div>
            <div class="d-flex align-items-center gap-2 mb-1.5 flex-wrap">
                <span class="badge bg-emerald-100 text-emerald-950 px-2.5 py-1 rounded-pill fs-7 fw-semibold border border-emerald-200">
                    <i class="bi bi-shield-check me-1"></i> Khusus BPBD Admin
                </span>
                <span class="text-muted small">•</span>
                <span class="text-muted small fw-medium">Registrasi Akun</span>
            </div>
            <h1 class="h3 fw-bold text-slate-900 mb-1">Registrasi Akun Relawan</h1>
            <p class="text-muted small mb-0">Formulir pendaftaran personel relawan baru ke sistem PsyAid ITQ.</p>
        </div>
        <a href="<?= site_url('/command-center') ?>" class="btn btn-outline-secondary btn-sm rounded-3 fw-semibold d-inline-flex align-items-center gap-2 shadow-sm align-self-start align-self-sm-center">
            <i class="bi bi-arrow-left"></i> Kembali ke Command Center
        </a>
    </div>

    <!-- Centered Form Container -->
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">

            <!-- Flash Notifications -->
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3 mb-4 p-3 d-flex align-items-center gap-3 bg-success-subtle text-success-emphasis" role="alert">
                    <i class="bi bi-check-circle-fill fs-5 flex-shrink-0"></i>
                    <div class="small fw-semibold"><?= session()->getFlashdata('success') ?></div>
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm rounded-3 mb-4 p-3 d-flex align-items-center gap-3 bg-danger-subtle text-danger-emphasis" role="alert">
                    <i class="bi bi-exclamation-triangle-fill fs-5 flex-shrink-0"></i>
                    <div class="small fw-semibold"><?= session()->getFlashdata('error') ?></div>
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <?php $errors = session()->getFlashdata('errors'); ?>

            <!-- Form Card -->
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white">
                <div class="card-header bg-white border-bottom border-light p-3.5 p-md-4 d-flex align-items-center gap-3">
                    <div class="p-2.5 bg-emerald-100 text-emerald-700 rounded-3 d-flex align-items-center justify-content-center" style="width: 42px; height: 42px;">
                        <i class="bi bi-person-plus-fill fs-5"></i>
                    </div>
                    <div>
                        <h2 class="h6 fw-bold text-slate-800 mb-0">Form Registrasi Relawan</h2>
                        <span class="text-muted fs-8">Lengkapi formulir di bawah ini untuk mendaftarkan relawan</span>
                    </div>
                </div>

                <div class="card-body p-3.5 p-md-4">
                    <form action="<?= site_url('/bpbd/register-relawan') ?>" method="POST" autocomplete="off">
                        <?= csrf_field() ?>

                        <!-- Nama Lengkap -->
                        <div class="mb-3.5">
                            <label for="name" class="form-label small fw-bold text-slate-700 mb-1">Nama Lengkap Relawan <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-person"></i></span>
                                <input type="text" class="form-control border-start-0 <?= isset($errors['name']) ? 'is-invalid' : '' ?>" 
                                    id="name" name="name" value="<?= old('name') ?>" placeholder="Contoh: Budi Santoso" required autofocus>
                                <?php if (isset($errors['name'])): ?>
                                    <div class="invalid-feedback"><?= $errors['name'] ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- No WhatsApp -->
                        <div class="mb-3.5">
                            <label for="whatsapp" class="form-label small fw-bold text-slate-700 mb-1">No. WhatsApp Relawan <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 text-success"><i class="bi bi-whatsapp"></i></span>
                                <input type="tel" class="form-control border-start-0 <?= isset($errors['whatsapp']) ? 'is-invalid' : '' ?>" 
                                    id="whatsapp" name="whatsapp" value="<?= old('whatsapp') ?>" placeholder="Contoh: 081234567890" pattern="[0-9]+" required>
                                <?php if (isset($errors['whatsapp'])): ?>
                                    <div class="invalid-feedback"><?= $errors['whatsapp'] ?></div>
                                <?php endif; ?>
                            </div>
                            <div class="form-text text-muted fs-8 mt-1">Nomor WhatsApp ini digunakan relawan untuk masuk/login ke sistem.</div>
                        </div>

                        <!-- Password -->
                        <div class="mb-3.5">
                            <label for="password" class="form-label small fw-bold text-slate-700 mb-1">Password <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-key"></i></span>
                                <input type="password" class="form-control border-start-0 border-end-0 <?= isset($errors['password']) ? 'is-invalid' : '' ?>" 
                                    id="password" name="password" placeholder="Minimal 6 karakter" required>
                                <button type="button" class="btn btn-outline-secondary bg-light border-start-0 toggle-pwd-btn" data-target="password">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <?php if (isset($errors['password'])): ?>
                                    <div class="invalid-feedback"><?= $errors['password'] ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Konfirmasi Password -->
                        <div class="mb-4">
                            <label for="password_confirm" class="form-label small fw-bold text-slate-700 mb-1">Konfirmasi Password <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-shield-lock"></i></span>
                                <input type="password" class="form-control border-start-0 border-end-0 <?= isset($errors['password_confirm']) ? 'is-invalid' : '' ?>" 
                                    id="password_confirm" name="password_confirm" placeholder="Ulangi password di atas" required>
                                <button type="button" class="btn btn-outline-secondary bg-light border-start-0 toggle-pwd-btn" data-target="password_confirm">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <?php if (isset($errors['password_confirm'])): ?>
                                    <div class="invalid-feedback"><?= $errors['password_confirm'] ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-emerald w-100 py-2.5 fw-bold rounded-3 shadow-sm d-flex align-items-center justify-content-center gap-2">
                            <i class="bi bi-person-plus-fill"></i> Daftarkan Akun Relawan
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<style>
    .btn-emerald {
        background-color: #059669;
        color: #ffffff;
        border: none;
        transition: all 0.2s ease;
    }
    .btn-emerald:hover {
        background-color: #047857;
        color: #ffffff;
    }
    .bg-emerald-100 {
        background-color: #d1fae5;
    }
    .text-emerald-700 {
        color: #047857;
    }
    .text-emerald-950 {
        color: #022c22;
    }
    .border-emerald-200 {
        border-color: #a7f3d0 !important;
    }
    .fs-7 { font-size: 0.8rem; }
    .fs-8 { font-size: 0.725rem; }
    .mb-3\.5 { margin-bottom: 0.95rem; }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Toggle password visibility
        document.querySelectorAll('.toggle-pwd-btn').forEach(button => {
            button.addEventListener('click', function () {
                const targetId = this.getAttribute('data-target');
                const input = document.getElementById(targetId);
                const icon = this.querySelector('i');
                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.replace('bi-eye', 'bi-eye-slash');
                } else {
                    input.type = 'password';
                    icon.classList.replace('bi-eye-slash', 'bi-eye');
                }
            });
        });
    });
</script>
<?= $this->endSection() ?>
