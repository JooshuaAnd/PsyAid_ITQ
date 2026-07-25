<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'PsyAid - Disaster Mental Health Command Center') ?></title>
    <!-- Bootstrap 5 CSS & FontAwesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
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

        .badge-bpbd_admin {
            background-color: #dc2626;
            color: #fff;
        }

        .badge-relawan {
            background-color: #059669;
            color: #fff;
        }

        .badge-psikolog {
            background-color: #2563eb;
            color: #fff;
        }

        .card-custom {
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        }

        footer {
            margin-top: auto;
            background: #ffffff;
            border-top: 1px solid #e2e8f0;
        }

        .navbar-soft-green {
            background-color: #d1fae5 !important;
            border-bottom: 1px solid #a7f3d0 !important;
            box-shadow: 0 2px 10px rgba(16, 185, 129, 0.12) !important;
        }

        .navbar-soft-green .nav-link {
            color: #064e3b !important;
            font-weight: 600;
        }

        .navbar-soft-green .nav-link:hover {
            color: #059669 !important;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <?php
    $req = service('request');
    $uriPath = strtolower(trim($req->getUri()->getPath(), '/'));
    $isLoginPage = ($hideNavbar ?? false)
        || url_is('login*')
        || url_is('register*')
        || url_is('login')
        || url_is('register')
        || url_is('/')
        || strpos($uriPath, 'login') !== false
        || strpos($uriPath, 'register') !== false
        || ($uriPath === '' && !session()->get('logged_in'));
    ?>
    <?php if (!$isLoginPage): ?>
        <nav class="navbar navbar-expand-lg navbar-light navbar-soft-green sticky-top py-2">
            <div class="container-fluid px-4">
                <a class="navbar-brand d-flex align-items-center gap-2 py-0" href="<?= site_url() ?>">
                    <img src="<?= base_url('images/Logo_PsyAid.png') ?>" alt="PsyAid Logo"
                        style="height: 42px; width: auto; object-fit: contain;">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-link navbar-nav me-auto mb-2 mb-lg-0">
                        <?php if (session()->get('logged_in')): ?>
                            <?php if (session()->get('role') === 'bpbd_admin'): ?>
                                <li class="nav-item">
                                    <a class="nav-link text-dark fw-semibold" href="<?= site_url('/command-center') ?>">
                                        <i class="bi bi-speedometer2 me-1 text-danger"></i> Command Center
                                    </a>
                                </li>
                            <?php elseif (session()->get('role') === 'relawan'): ?>
                                <li class="nav-item">
                                    <a class="nav-link text-dark fw-semibold"
                                        href="<?= site_url('/relawan/posko/' . (session()->get('posko_id') ?? 1)) ?>">
                                        <i class="bi bi-geo-alt me-1 text-success"></i> Posko Relawan
                                    </a>
                                </li>
                            <?php elseif (session()->get('role') === 'psikolog'): ?>
                                <li class="nav-item">
                                    <a class="nav-link text-dark fw-semibold" href="<?= site_url('/psikolog/dashboard') ?>">
                                        <i class="bi bi-person-badge me-1 text-primary"></i> Clinical Workspace
                                    </a>
                                </li>
                            <?php endif; ?>
                        <?php endif; ?>
                    </ul>

                    <div class="d-flex align-items-center gap-3">
                        <?php if (session()->get('logged_in')): ?>
                            <div class="text-end text-muted small d-none d-md-block">
                                <div class="text-dark fw-bold"><?= esc(session()->get('user_name')) ?></div>
                                <div>
                                    <span
                                        class="badge badge-role badge-<?= session()->get('role') ?>"><?= esc(session()->get('role')) ?></span>
                                    <?php if (session()->get('posko_id')): ?>
                                        <span class="badge bg-secondary">Posko #<?= session()->get('posko_id') ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <button type="button" class="btn btn-outline-danger btn-sm fw-semibold" data-bs-toggle="modal"
                                data-bs-target="#logoutConfirmModal">
                                <i class="bi bi-box-arrow-right me-1"></i> Logout
                            </button>
                        <?php else: ?>
                            <a href="<?= site_url('/login') ?>" class="btn btn-danger btn-sm px-3 fw-semibold shadow-sm">
                                <i class="bi bi-box-arrow-in-right me-1"></i> Login
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </nav>
    <?php endif; ?>

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
            &copy; <?= date('Y') ?> <strong>PsyAid</strong> - Disaster Mental Health Command Center (CodeIgniter 4 +
            MySQL)
        </div>
    </footer>

    <!-- Modal Konfirmasi Logout -->
    <?php if (session()->get('logged_in')): ?>
        <div class="modal fade" id="logoutConfirmModal" tabindex="-1" aria-labelledby="logoutConfirmModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content border-0 shadow-lg rounded-4">
                    <div class="modal-header border-0 bg-light rounded-top-4 py-3">
                        <h6 class="modal-title fw-bold text-dark" id="logoutConfirmModalLabel">
                            <i class="bi bi-exclamation-triangle-fill text-danger me-2"></i> Konfirmasi Logout
                        </h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center py-4 px-3">
                        <div class="display-6 text-danger mb-3">
                            <i class="bi bi-box-arrow-right"></i>
                        </div>
                        <h6 class="fw-bold text-dark mb-1">Apakah Anda yakin ingin keluar?</h6>
                        <p class="text-muted small mb-0">Sesi pengguna Anda akan diakhiri dan Anda harus login kembali.</p>
                    </div>
                    <div class="modal-footer border-0 bg-light rounded-bottom-4 justify-content-center gap-2 py-3">
                        <button type="button" class="btn btn-outline-secondary btn-sm px-3 fw-semibold rounded-3"
                            data-bs-dismiss="modal">
                            Batal
                        </button>
                        <a href="<?= site_url('/logout') ?>"
                            class="btn btn-danger btn-sm text-white fw-bold px-4 rounded-3 shadow-sm">
                            <i class="bi bi-box-arrow-right me-1"></i> Ya, Logout
                        </a>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>