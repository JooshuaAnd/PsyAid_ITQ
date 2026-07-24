<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'PsyAid — Disaster Mental Health Command Center') ?></title>
    <!-- Bootstrap 5 CSS & FontAwesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f8fafc;
            color: #1e293b;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .navbar-brand {
            font-weight: 800;
            letter-spacing: -0.5px;
        }
        .badge-role {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 0.35em 0.7em;
            border-radius: 50rem;
        }
        .badge-bpbd_admin { background-color: #dc2626; color: #fff; }
        .badge-relawan { background-color: #059669; color: #fff; }
        .badge-psikolog { background-color: #2563eb; color: #fff; }
        .card-custom {
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);
        }
        footer {
            margin-top: auto;
            background: #ffffff;
            border-top: 1px solid #e2e8f0;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top shadow-sm py-2">
        <div class="container-fluid px-4">
            <a class="navbar-brand text-danger d-flex align-items-center gap-2" href="<?= site_url() ?>">
                <i class="bi bi-heart-pulse-fill fs-4 text-danger"></i>
                <span class="text-white">Psy<span class="text-danger">Aid</span></span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-link navbar-nav me-auto mb-2 mb-lg-0">
                    <?php if (session()->get('logged_in')): ?>
                        <?php if (session()->get('role') === 'bpbd_admin'): ?>
                            <li class="nav-item"><a class="nav-link text-white fw-medium" href="<?= site_url('/command-center') ?>"><i class="bi bi-speedometer2 me-1"></i> Command Center</a></li>
                        <?php elseif (session()->get('role') === 'relawan'): ?>
                            <li class="nav-item"><a class="nav-link text-white fw-medium" href="<?= site_url('/relawan/posko/' . (session()->get('posko_id') ?? 1)) ?>"><i class="bi bi-geo-alt me-1"></i> Posko Relawan</a></li>
                        <?php elseif (session()->get('role') === 'psikolog'): ?>
                            <li class="nav-item"><a class="nav-link text-white fw-medium" href="<?= site_url('/psikolog/dashboard') ?>"><i class="bi bi-person-badge me-1"></i> Clinical Workspace</a></li>
                        <?php endif; ?>
                    <?php endif; ?>
                </ul>

                <div class="d-flex align-items-center gap-3">
                    <?php if (session()->get('logged_in')): ?>
                        <div class="text-end text-white-50 small d-none d-md-block">
                            <div class="text-white fw-semibold"><?= esc(session()->get('user_name')) ?></div>
                            <div>
                                <span class="badge badge-role badge-<?= session()->get('role') ?>"><?= esc(session()->get('role')) ?></span>
                                <?php if (session()->get('posko_id')): ?>
                                    <span class="badge bg-secondary">Posko #<?= session()->get('posko_id') ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <a href="<?= site_url('/logout') ?>" class="btn btn-outline-light btn-sm"><i class="bi bi-box-arrow-right me-1"></i> Logout</a>
                    <?php else: ?>
                        <a href="<?= site_url('/login') ?>" class="btn btn-danger btn-sm px-3 fw-semibold"><i class="bi bi-box-arrow-in-right me-1"></i> Login</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content Container -->
    <main class="container-fluid px-4 py-4">
        <!-- Flash Messages -->
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show shadow-sm border-0" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> <?= session()->getFlashdata('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show shadow-sm border-0" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i> <?= session()->getFlashdata('error') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <?= $this->renderSection('content') ?>
    </main>

    <!-- Footer -->
    <footer class="py-3 text-center text-muted small">
        <div class="container-fluid">
            &copy; <?= date('Y') ?> <strong>PsyAid</strong> — Disaster Mental Health Command Center (CodeIgniter 4 + MySQL)
        </div>
    </footer>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
