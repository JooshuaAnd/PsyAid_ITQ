<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="row justify-content-center align-items-center my-4">
    <div class="col-12 col-sm-10 col-md-8 col-lg-5 col-xl-4">
        <div class="card card-custom p-4 bg-white shadow-sm">
            <div class="text-center mb-4">
                <div class="display-6 text-danger mb-2">
                    <i class="bi bi-shield-lock-fill"></i>
                </div>
                <h4 class="fw-bold mb-1">Masuk ke PsyAid</h4>
                <p class="text-muted small">Disaster Mental Health Command Center</p>
            </div>

            <form action="<?= site_url('/login') ?>" method="POST">
                <?= csrf_field() ?>

                <div class="mb-3">
                    <label for="email" class="form-label fw-semibold">Alamat Email</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light text-muted"><i class="bi bi-envelope"></i></span>
                        <input type="email" class="form-control" id="email" name="email" value="<?= old('email') ?>" placeholder="nama@psyaid.id" required autofocus>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="password" class="form-label fw-semibold">Password</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light text-muted"><i class="bi bi-key"></i></span>
                        <input type="password" class="form-control" id="password" name="password" placeholder="••••••••" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-danger w-100 py-2 fw-semibold shadow-sm mb-3">
                    <i class="bi bi-box-arrow-in-right me-1"></i> Masuk Sistem
                </button>
            </form>

            <hr class="my-3">

            <div class="bg-light p-3 rounded-3 border">
                <div class="fw-bold text-dark small mb-2"><i class="bi bi-info-circle me-1 text-primary"></i> Testing Credentials:</div>
                <div class="d-grid gap-2">
                    <button type="button" onclick="fillCreds('admin@psyaid.id', 'password123')" class="btn btn-outline-danger btn-sm text-start py-1 fs-7">
                        <i class="bi bi-person-fill-gear me-1"></i> <strong>Admin BPBD:</strong> admin@psyaid.id
                    </button>
                    <button type="button" onclick="fillCreds('relawan1@psyaid.id', 'password123')" class="btn btn-outline-success btn-sm text-start py-1 fs-7">
                        <i class="bi bi-person-badge-fill me-1"></i> <strong>Relawan Posko 1:</strong> relawan1@psyaid.id
                    </button>
                    <button type="button" onclick="fillCreds('psikolog1@psyaid.id', 'password123')" class="btn btn-outline-primary btn-sm text-start py-1 fs-7">
                        <i class="bi bi-heart-pulse me-1"></i> <strong>Psikolog 1:</strong> psikolog1@psyaid.id
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function fillCreds(email, password) {
        document.getElementById('email').value = email;
        document.getElementById('password').value = password;
    }
</script>
<?= $this->endSection() ?>
