<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'PsyAid - Disaster Mental Health Command Center') ?></title>
    <!-- Bootstrap 5 CSS & FontAwesome / Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <style>
        :root {
            --sidebar-width-expanded: 260px;
            --sidebar-width-collapsed: 72px;
            --emerald-50: #ecfdf5;
            --emerald-100: #d1fae5;
            --emerald-600: #059669;
            --emerald-700: #047857;
            --emerald-950: #022c22;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f8fafc;
            color: #1e293b;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* Desktop Sidebar Styling */
        #app-sidebar {
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            width: var(--sidebar-width-expanded);
            background: #ffffff;
            border-right: 1px solid #e2e8f0;
            z-index: 1040;
            display: flex;
            flex-direction: column;
            transition: width 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 2px 0 12px rgba(0, 0, 0, 0.03);
        }

        /* Collapsed Desktop Sidebar */
        body.sidebar-collapsed #app-sidebar {
            width: var(--sidebar-width-collapsed);
        }

        /* Sticky Sidebar Toggle Button Outside Top Header (Desktop) */
        #sidebar-toggle-btn {
            position: fixed;
            top: 14px;
            left: calc(var(--sidebar-width-expanded) - 18px);
            z-index: 1050;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background-color: #ffffff;
            border: 1px solid #cbd5e1;
            color: #047857;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: left 0.3s cubic-bezier(0.4, 0, 0.2, 1), transform 0.2s, background-color 0.2s;
        }

        #sidebar-toggle-btn:hover {
            background-color: var(--emerald-50);
            color: var(--emerald-700);
            transform: scale(1.08);
        }

        body.sidebar-collapsed #sidebar-toggle-btn {
            left: calc(var(--sidebar-width-collapsed) - 18px);
        }

        /* Sidebar Header (Logo) */
        .sidebar-header {
            height: 70px;
            padding: 0 1rem;
            display: flex;
            align-items: center;
            border-bottom: 1px solid #f1f5f9;
            overflow: hidden;
            white-space: nowrap;
        }

        .sidebar-brand-logo {
            width: 42px;
            height: 42px;
            object-fit: contain;
            flex-shrink: 0;
        }

        .sidebar-brand-text {
            margin-left: 0.75rem;
            transition: opacity 0.25s, visibility 0.25s;
        }

        .sidebar-brand-title {
            color: #047857 !important;
            font-weight: 800;
            font-size: 1rem;
            letter-spacing: -0.2px;
        }

        body.sidebar-collapsed .sidebar-brand-text {
            opacity: 0;
            visibility: hidden;
            width: 0;
            display: none;
        }

        /* Sidebar Body / Nav Menu */
        .sidebar-body {
            flex: 1;
            padding: 1rem 0.75rem;
            overflow-y: auto;
            overflow-x: hidden;
        }

        .sidebar-menu-title {
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #94a3b8;
            padding: 0.5rem 0.75rem 0.25rem;
            white-space: nowrap;
        }

        body.sidebar-collapsed .sidebar-menu-title {
            display: none;
        }

        .sidebar-nav-item {
            display: flex;
            align-items: center;
            padding: 0.65rem 0.85rem;
            color: #334155;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.875rem;
            border-radius: 0.5rem;
            margin-bottom: 0.25rem;
            transition: all 0.2s ease;
            white-space: nowrap;
        }

        .sidebar-nav-item i {
            font-size: 1.15rem;
            width: 24px;
            text-align: center;
            flex-shrink: 0;
            margin-right: 0.75rem;
            transition: margin 0.3s;
        }

        .sidebar-nav-item:hover {
            background-color: var(--emerald-50);
            color: var(--emerald-700);
        }

        .sidebar-nav-item.active {
            background-color: var(--emerald-100);
            color: var(--emerald-950);
            font-weight: 700;
        }

        body.sidebar-collapsed .sidebar-nav-item {
            justify-content: center;
            padding: 0.65rem 0;
        }

        body.sidebar-collapsed .sidebar-nav-item i {
            margin-right: 0;
        }

        body.sidebar-collapsed .sidebar-label {
            display: none;
        }

        /* Sidebar Footer (Logout Button at Very Bottom) */
        .sidebar-footer {
            padding: 0.85rem 0.75rem;
            border-top: 1px solid #f1f5f9;
            background: #ffffff;
            overflow: hidden;
            white-space: nowrap;
        }

        .btn-sidebar-logout {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            padding: 0.65rem 0.85rem;
            color: #dc2626;
            background-color: #fef2f2;
            border: 1px solid #fecdd3;
            border-radius: 0.5rem;
            font-weight: 600;
            font-size: 0.875rem;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .btn-sidebar-logout i {
            font-size: 1.15rem;
            width: 24px;
            text-align: center;
            flex-shrink: 0;
            margin-right: 0.75rem;
        }

        .btn-sidebar-logout:hover {
            background-color: #dc2626;
            color: #ffffff;
            border-color: #dc2626;
        }

        body.sidebar-collapsed .btn-sidebar-logout {
            justify-content: center;
            padding: 0.65rem 0;
        }

        body.sidebar-collapsed .btn-sidebar-logout i {
            margin-right: 0;
        }

        /* Main Wrapper Shift */
        #app-main-wrapper {
            margin-left: var(--sidebar-width-expanded);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            transition: margin-left 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        body.sidebar-collapsed #app-main-wrapper {
            margin-left: var(--sidebar-width-collapsed);
        }

        /* Fullwidth wrapper for Auth / Landing pages */
        body.no-sidebar #app-main-wrapper {
            margin-left: 0 !important;
        }

        /* Non-Sticky Top Header Navbar */
        .top-header-navbar {
            background-color: #ffffff;
            border-bottom: 1px solid #e2e8f0;
            padding: 0.85rem 1.5rem;
            position: relative;
            z-index: 1030;
        }

        /* Dynamic Liquid Glass Breadcrumb */
        .glass-breadcrumb {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.85) 0%, rgba(209, 250, 229, 0.45) 100%);
            backdrop-filter: blur(12px) saturate(160%);
            -webkit-backdrop-filter: blur(12px) saturate(160%);
            border: 1px solid rgba(16, 185, 129, 0.35);
            box-shadow: 0 4px 15px rgba(6, 78, 59, 0.06), inset 0 1px 1px rgba(255, 255, 255, 0.8);
            border-radius: 6px;
            padding: 0.35rem 1rem;
        }

        .glass-breadcrumb .breadcrumb-item+.breadcrumb-item::before {
            color: #059669;
            content: "›";
            font-size: 1.1rem;
            font-weight: 700;
            line-height: 1;
            vertical-align: middle;
        }

        /* Profile Avatar Box */
        .profile-avatar-box {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            overflow: hidden;
            border: 2px solid #10b981;
            background-color: #f0fdf4;
            box-shadow: 0 2px 8px rgba(16, 185, 129, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .profile-avatar-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .badge-role {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 0.35em 0.7em;
            border-radius: 6px;
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

        /* Mobile Responsiveness Controls (< 768px) */
        @media (max-width: 767.98px) {

            #app-sidebar,
            #sidebar-toggle-btn {
                display: none !important;
            }

            #app-main-wrapper {
                margin-left: 0 !important;
            }

            /* STICKY Mobile Toggle Button ONLY (Top Header remains non-sticky) */
            .mobile-nav-toggle-btn {
                display: inline-flex !important;
                align-items: center;
                justify-content: center;
                position: fixed !important;
                top: 12px !important;
                left: 14px !important;
                z-index: 1050 !important;
                width: 42px !important;
                height: 42px !important;
                padding: 0;
                background-color: #ffffff !important;
                border: 1px solid #cbd5e1 !important;
                border-radius: 50% !important;
                color: #047857 !important;
                cursor: pointer;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15) !important;
                transition: transform 0.2s, background-color 0.2s;
            }

            .mobile-nav-toggle-btn:hover {
                background-color: var(--emerald-50) !important;
                transform: scale(1.08);
            }

            /* Shift Non-Sticky Top Header content on mobile to clear sticky toggle button */
            .top-header-navbar {
                padding: 0.75rem 1rem 0.75rem 4.25rem !important;
            }

            /* Fixed Floating Mobile Dropdown Menu */
            #mobile-dropdown-menu {
                display: none;
                position: fixed !important;
                top: 64px !important;
                left: 12px !important;
                right: 12px !important;
                max-height: calc(100vh - 80px) !important;
                overflow-y: auto !important;
                background-color: #ffffff;
                border: 1px solid #cbd5e1;
                border-radius: 0.75rem;
                box-shadow: 0 15px 30px -5px rgba(0, 0, 0, 0.2), 0 0 0 1px rgba(0, 0, 0, 0.05);
                padding: 1.25rem;
                z-index: 1045 !important;
                animation: slideDownMobile 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            }

            #mobile-dropdown-menu.show {
                display: block;
            }
        }

        @media (min-width: 768px) {

            .mobile-nav-toggle-btn,
            #mobile-dropdown-menu {
                display: none !important;
            }
        }

        @keyframes slideDownMobile {
            from {
                opacity: 0;
                transform: translateY(-8px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

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

<body class="<?= $isLoginPage ? 'no-sidebar' : '' ?>">

    <?php if (!$isLoginPage): ?>
        <!-- Sticky Sidebar Toggle Button Outside Top Header (Desktop Only) -->
        <button type="button" id="sidebar-toggle-btn" title="Toggle Sidebar (On/Off)">
            <i class="bi bi-chevron-left" id="toggle-icon"></i>
        </button>

        <!-- STICKY Mobile Toggle Button Outside Top Header (Mobile Only) -->
        <button type="button" class="mobile-nav-toggle-btn" id="mobile-nav-toggle-btn" title="Menu Navigasi Mobile">
            <i class="bi bi-list fs-4" id="mobile-hamburger-icon"></i>
        </button>

        <!-- Desktop Sidebar Navigation -->
        <aside id="app-sidebar">
            <!-- Sidebar Header: Logo PsyAid -->
            <div class="sidebar-header">
                <a href="<?= site_url('/') ?>" class="d-flex align-items-center text-decoration-none">
                    <img src="<?= base_url('images/Logo_PsyAid.png') ?>" alt="PsyAid Logo" class="sidebar-brand-logo">
                    <div class="sidebar-brand-text">
                        <span class="sidebar-brand-title">PsyAid</span>
                    </div>
                </a>
            </div>

            <!-- Sidebar Body: Role-Based Menu -->
            <div class="sidebar-body">
                <div class="sidebar-menu-title">Navigasi Utama</div>

                <?php if (session()->get('logged_in')): ?>
                    <?php $role = session()->get('role'); ?>

                    <?php if ($role === 'bpbd_admin'): ?>
                        <!-- BPBD Admin Menu -->
                        <a href="<?= site_url('/command-center') ?>"
                            class="sidebar-nav-item <?= url_is('command-center*') ? 'active' : '' ?>" title="Command Center BPBD">
                            <i class="bi bi-speedometer2 text-danger"></i>
                            <span class="sidebar-label">Command Center</span>
                        </a>
                        <a href="<?= site_url('/bpbd/earthquake-radar') ?>"
                            class="sidebar-nav-item <?= url_is('bpbd/earthquake-radar*') ? 'active' : '' ?>"
                            title="Peta Radar Gempa Real-Time BMKG">
                            <i class="bi bi-radar text-warning"></i>
                            <span class="sidebar-label">Peta Radar Gempa</span>
                        </a>
                        <a href="<?= site_url('/psychologist-mapping') ?>"
                            class="sidebar-nav-item <?= url_is('psychologist-mapping*') ? 'active' : '' ?>"
                            title="Pemetaan Tim Psikolog">
                            <i class="bi bi-diagram-3-fill text-primary"></i>
                            <span class="sidebar-label">Pemetaan Psikolog</span>
                        </a>

                        <!-- Dropdown Registrasi Akun -->
                        <?php $isRegisterActive = url_is('bpbd/register*') || (url_is('register*') && ! url_is('bpbd/register*')); ?>
                        <div class="sidebar-dropdown-container mb-1">
                            <a href="#desktopRegisterSubmenu" data-bs-toggle="collapse"
                                class="sidebar-nav-item d-flex align-items-center justify-content-between <?= $isRegisterActive ? 'active' : '' ?>"
                                role="button" aria-expanded="<?= $isRegisterActive ? 'true' : 'false' ?>" aria-controls="desktopRegisterSubmenu"
                                title="Registrasi Akun">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-person-plus-fill text-success"></i>
                                    <span class="sidebar-label">Registrasi Akun</span>
                                </div>
                                <i class="bi bi-chevron-down ms-auto sidebar-label" style="font-size: 0.75rem;"></i>
                            </a>
                            <div class="collapse <?= $isRegisterActive ? 'show' : '' ?>" id="desktopRegisterSubmenu">
                                <div class="ps-3 py-1">
                                    <a href="<?= site_url('/bpbd/register-relawan') ?>"
                                        class="sidebar-nav-item py-1.5 <?= url_is('bpbd/register-relawan*') ? 'active' : '' ?>"
                                        title="Registrasi Akun Relawan Baru">
                                        <i class="bi bi-person-heart text-success" style="font-size: 0.95rem;"></i>
                                        <span class="sidebar-label">Registrasi Relawan</span>
                                    </a>
                                    <a href="<?= site_url('/bpbd/register-psikolog') ?>"
                                        class="sidebar-nav-item py-1.5 <?= url_is('bpbd/register-psikolog*') ? 'active' : '' ?>"
                                        title="Registrasi Akun Psikolog Klinis Baru">
                                        <i class="bi bi-person-badge-fill text-primary" style="font-size: 0.95rem;"></i>
                                        <span class="sidebar-label">Registrasi Psikolog</span>
                                    </a>
                                    <a href="<?= site_url('/register') ?>"
                                        class="sidebar-nav-item py-1.5 <?= (url_is('register*') && ! url_is('bpbd/register*')) ? 'active' : '' ?>"
                                        title="Registrasi Admin BPBD Baru">
                                        <i class="bi bi-shield-plus text-danger" style="font-size: 0.95rem;"></i>
                                        <span class="sidebar-label">Registrasi Admin BPBD</span>
                                    </a>
                                </div>
                            </div>
                        </div>

                    <?php elseif ($role === 'relawan'): ?>
                        <!-- Relawan Posko Menu -->
                        <?php $poskoId = session()->get('posko_id') ?? 1; ?>
                        <a href="<?= site_url('/relawan/posko/' . $poskoId) ?>"
                            class="sidebar-nav-item <?= (url_is('relawan/posko*') || url_is('posko*')) ? 'active' : '' ?>"
                            title="Posko Relawan Saya">
                            <i class="bi bi-geo-alt-fill text-success"></i>
                            <span class="sidebar-label">Posko Saya</span>
                        </a>
                        <a href="<?= site_url('/victim/create/' . $poskoId) ?>"
                            class="sidebar-nav-item <?= url_is('victim/create*') ? 'active' : '' ?>" title="Tambah Penyintas Baru">
                            <i class="bi bi-person-plus-fill text-emerald-600"></i>
                            <span class="sidebar-label">Tambah Korban</span>
                        </a>

                    <?php elseif ($role === 'psikolog'): ?>
                        <!-- Psikolog Klinis Menu -->
                        <a href="<?= site_url('/psikolog/dashboard') ?>"
                            class="sidebar-nav-item <?= url_is('psikolog/dashboard*') ? 'active' : '' ?>"
                            title="Clinical Workspace Psikolog">
                            <i class="bi bi-person-badge-fill text-primary"></i>
                            <span class="sidebar-label">Clinical Workspace</span>
                        </a>
                        <a href="<?= site_url('/psychologist-mapping') ?>"
                            class="sidebar-nav-item <?= url_is('psychologist-mapping*') ? 'active' : '' ?>"
                            title="Mapping Penugasan Posko">
                            <i class="bi bi-diagram-3-fill text-info"></i>
                            <span class="sidebar-label">Mapping Posko</span>
                        </a>
                    <?php endif; ?>

                <?php else: ?>
                    <!-- Guest Menu -->
                    <a href="<?= site_url('/') ?>" class="sidebar-nav-item <?= url_is('/') ? 'active' : '' ?>" title="Beranda">
                        <i class="bi bi-house-door-fill text-success"></i>
                        <span class="sidebar-label">Beranda</span>
                    </a>
                    <a href="<?= site_url('/login') ?>" class="sidebar-nav-item <?= url_is('login*') ? 'active' : '' ?>"
                        title="Login System">
                        <i class="bi bi-box-arrow-in-right text-danger"></i>
                        <span class="sidebar-label">Masuk System</span>
                    </a>
                <?php endif; ?>
            </div>

            <!-- Sidebar Footer: Logout Button at Very Bottom -->
            <div class="sidebar-footer">
                <?php if (session()->get('logged_in')): ?>
                    <button type="button" class="btn-sidebar-logout" data-bs-toggle="modal" data-bs-target="#logoutConfirmModal"
                        title="Logout">
                        <i class="bi bi-box-arrow-right"></i>
                        <span class="sidebar-label">Logout</span>
                    </button>
                <?php else: ?>
                    <a href="<?= site_url('/login') ?>" class="btn-sidebar-logout text-success border-success bg-light"
                        title="Login System">
                        <i class="bi bi-box-arrow-in-right"></i>
                        <span class="sidebar-label">Login</span>
                    </a>
                <?php endif; ?>
            </div>
        </aside>
    <?php endif; ?>

    <!-- Main Content Wrapper -->
    <div id="app-main-wrapper">
        <?php if (!$isLoginPage): ?>
            <!-- Non-Sticky Top Header Navbar -->
            <header class="top-header-navbar d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center gap-2">
                    <!-- Mobile Brand Logo -->
                    <a href="<?= site_url('/') ?>" class="d-md-none d-flex align-items-center text-decoration-none">
                        <img src="<?= base_url('images/Logo_PsyAid.png') ?>" alt="PsyAid Logo"
                            style="height: 34px; width: auto;" class="me-1">
                        <span class="sidebar-brand-title">PsyAid</span>
                    </a>

                    <!-- Desktop Dynamic Liquid Glass Breadcrumb -->
                    <nav aria-label="breadcrumb" class="d-none d-md-block">
                        <ol class="breadcrumb mb-0 glass-breadcrumb align-items-center">
                            <li class="breadcrumb-item small fw-semibold">
                                <a href="<?= site_url('/') ?>"
                                    class="text-decoration-none text-success hover-emerald d-inline-flex align-items-center gap-1">
                                    <i class="bi bi-house-door-fill text-success"></i> Beranda
                                </a>
                            </li>
                            <?php if (!empty($title)): ?>
                                <li class="breadcrumb-item active small fw-bold text-dark" aria-current="page">
                                    <?= esc(explode(' — ', explode(' - ', $title)[0])[0]) ?>
                                </li>
                            <?php endif; ?>
                        </ol>
                    </nav>
                </div>

                <!-- User Profile Summary (Desktop & Mobile Header) -->
                <div class="d-flex align-items-center gap-3">
                    <?php if (session()->get('logged_in')): ?>
                        <div class="d-flex align-items-center gap-2.5">
                            <div class="text-end text-muted small">
                                <div class="text-dark fw-bold"><?= esc(session()->get('user_name')) ?></div>
                                <div class="mt-0.5">
                                    <span
                                        class="badge badge-role badge-<?= session()->get('role') ?>"><?= esc(session()->get('role')) ?></span>
                                    <?php if (session()->get('posko_id')): ?>
                                        <span class="badge bg-secondary">Posko #<?= session()->get('posko_id') ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <!-- User Profile Avatar Image -->
                            <div class="profile-avatar-box ms-1">
                                <img src="<?= base_url('images/profile.svg') ?>" alt="User Avatar" class="profile-avatar-img">
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </header>

            <!-- Floating Mobile Dropdown Menu Sidebar -->
            <div id="mobile-dropdown-menu">
                <div class="text-muted small fw-bold text-uppercase mb-2 pb-1 border-bottom">Navigasi Utama</div>

                <?php if (session()->get('logged_in')): ?>
                    <?php $role = session()->get('role'); ?>

                    <?php if ($role === 'bpbd_admin'): ?>
                        <a href="<?= site_url('/command-center') ?>"
                            class="sidebar-nav-item py-2 px-3 mb-1 <?= url_is('command-center*') ? 'active' : '' ?>">
                            <i class="bi bi-speedometer2 text-danger"></i> Command Center
                        </a>
                        <a href="<?= site_url('/bpbd/earthquake-radar') ?>"
                            class="sidebar-nav-item py-2 px-3 mb-1 <?= url_is('bpbd/earthquake-radar*') ? 'active' : '' ?>">
                            <i class="bi bi-radar text-warning"></i> Peta Radar Gempa
                        </a>
                        <a href="<?= site_url('/psychologist-mapping') ?>"
                            class="sidebar-nav-item py-2 px-3 mb-1 <?= url_is('psychologist-mapping*') ? 'active' : '' ?>">
                            <i class="bi bi-diagram-3-fill text-primary"></i> Pemetaan Psikolog
                        </a>

                        <!-- Mobile Dropdown Registrasi Akun -->
                        <?php $isRegisterActive = url_is('bpbd/register*') || (url_is('register*') && ! url_is('bpbd/register*')); ?>
                        <div class="mb-1">
                            <a href="#mobileRegisterSubmenu" data-bs-toggle="collapse"
                                class="sidebar-nav-item py-2 px-3 d-flex align-items-center justify-content-between <?= $isRegisterActive ? 'active' : '' ?>"
                                role="button" aria-expanded="<?= $isRegisterActive ? 'true' : 'false' ?>">
                                <div>
                                    <i class="bi bi-person-plus-fill text-success me-2"></i> Registrasi Akun
                                </div>
                                <i class="bi bi-chevron-down" style="font-size: 0.75rem;"></i>
                            </a>
                            <div class="collapse <?= $isRegisterActive ? 'show' : '' ?> ps-3 mt-1" id="mobileRegisterSubmenu">
                                <a href="<?= site_url('/bpbd/register-relawan') ?>"
                                    class="sidebar-nav-item py-1.5 px-3 mb-1 <?= url_is('bpbd/register-relawan*') ? 'active' : '' ?>">
                                    <i class="bi bi-person-heart text-success me-2"></i> Registrasi Relawan
                                </a>
                                <a href="<?= site_url('/bpbd/register-psikolog') ?>"
                                    class="sidebar-nav-item py-1.5 px-3 mb-1 <?= url_is('bpbd/register-psikolog*') ? 'active' : '' ?>">
                                    <i class="bi bi-person-badge-fill text-primary me-2"></i> Registrasi Psikolog
                                </a>
                                <a href="<?= site_url('/register') ?>"
                                    class="sidebar-nav-item py-1.5 px-3 mb-1 <?= (url_is('register*') && ! url_is('bpbd/register*')) ? 'active' : '' ?>">
                                    <i class="bi bi-shield-plus text-danger me-2"></i> Registrasi Admin BPBD
                                </a>
                            </div>
                        </div>

                    <?php elseif ($role === 'relawan'): ?>
                        <?php $poskoId = session()->get('posko_id') ?? 1; ?>
                        <a href="<?= site_url('/relawan/posko/' . $poskoId) ?>"
                            class="sidebar-nav-item py-2 px-3 mb-1 <?= (url_is('relawan/posko*') || url_is('posko*')) ? 'active' : '' ?>">
                            <i class="bi bi-geo-alt-fill text-success"></i> Posko Saya
                        </a>
                        <a href="<?= site_url('/victim/create/' . $poskoId) ?>"
                            class="sidebar-nav-item py-2 px-3 mb-1 <?= url_is('victim/create*') ? 'active' : '' ?>">
                            <i class="bi bi-person-plus-fill text-emerald-600"></i> Tambah Korban
                        </a>

                    <?php elseif ($role === 'psikolog'): ?>
                        <a href="<?= site_url('/psikolog/dashboard') ?>"
                            class="sidebar-nav-item py-2 px-3 mb-1 <?= url_is('psikolog/dashboard*') ? 'active' : '' ?>">
                            <i class="bi bi-person-badge-fill text-primary"></i> Clinical Workspace
                        </a>
                        <a href="<?= site_url('/psychologist-mapping') ?>"
                            class="sidebar-nav-item py-2 px-3 mb-1 <?= url_is('psychologist-mapping*') ? 'active' : '' ?>">
                            <i class="bi bi-diagram-3-fill text-info"></i> Mapping Posko
                        </a>
                    <?php endif; ?>

                    <hr class="my-3 text-muted">
                    <button type="button"
                        class="btn btn-outline-danger w-100 fw-bold d-flex align-items-center justify-content-center gap-2"
                        data-bs-toggle="modal" data-bs-target="#logoutConfirmModal">
                        <i class="bi bi-box-arrow-right"></i> Logout
                    </button>

                <?php else: ?>
                    <a href="<?= site_url('/') ?>" class="sidebar-nav-item py-2 px-3 mb-1 <?= url_is('/') ? 'active' : '' ?>">
                        <i class="bi bi-house-door-fill text-success"></i> Beranda
                    </a>
                    <a href="<?= site_url('/login') ?>"
                        class="sidebar-nav-item py-2 px-3 mb-1 <?= url_is('login*') ? 'active' : '' ?>">
                        <i class="bi bi-box-arrow-in-right text-danger"></i> Masuk System
                    </a>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <!-- Main Content Area -->
        <main class="container-fluid px-3 px-md-4 py-4 flex-fill">
            <!-- Flash Messages -->
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success alert-dismissible fade show shadow-sm border-0 mb-4" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i> <?= session()->getFlashdata('success') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show shadow-sm border-0 mb-4" role="alert">
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
    </div>

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

    <!-- Modal Peringatan Darurat Gempa (>= 5.0 SR) Khusus Peran BPBD Admin -->
    <?php if (session()->get('logged_in') && session()->get('role') === 'bpbd_admin'): ?>
        <div class="modal fade" id="earthquakeEmergencyModal" tabindex="-1" aria-labelledby="earthquakeEmergencyLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow-lg rounded-6 overflow-hidden">
                    <div class="modal-header border-0 bg-danger text-white py-3">
                        <h6 class="modal-title fw-bold d-flex align-items-center gap-2 mb-0" id="earthquakeEmergencyLabel">
                            <i class="bi bi-exclamation-triangle-fill fs-5 text-warning"></i>
                            <span>PERINGATAN DARURAT GEMPA (BMKG)</span>
                        </h6>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4 text-center" id="earthquakeEmergencyBody">
                        <!-- Dynamic Content -->
                    </div>
                    <div class="modal-footer border-0 bg-light justify-content-between py-3 px-4">
                        <button type="button" class="btn btn-outline-secondary btn-sm rounded-6 px-3 fw-semibold" data-bs-dismiss="modal">
                            Abaikan
                        </button>
                        <a href="<?= site_url('/bpbd/earthquake-radar') ?>" class="btn btn-danger btn-sm text-white fw-bold rounded-6 px-4 shadow-sm">
                            <i class="bi bi-radar me-1"></i> Buka Peta Radar Gempa
                        </a>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Sidebar Toggle (Desktop) & Mobile Dropdown Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Desktop Sidebar Toggle
            const toggleBtn = document.getElementById('sidebar-toggle-btn');
            const toggleIcon = document.getElementById('toggle-icon');
            const body = document.body;

            // Load saved desktop sidebar state
            const isCollapsed = localStorage.getItem('psyaid_sidebar_collapsed') === 'true';
            if (isCollapsed) {
                body.classList.add('sidebar-collapsed');
                if (toggleIcon) {
                    toggleIcon.classList.remove('bi-chevron-left');
                    toggleIcon.classList.add('bi-chevron-right');
                }
            }

            if (toggleBtn) {
                toggleBtn.addEventListener('click', function () {
                    body.classList.toggle('sidebar-collapsed');
                    const nowCollapsed = body.classList.contains('sidebar-collapsed');
                    localStorage.setItem('psyaid_sidebar_collapsed', nowCollapsed);

                    if (toggleIcon) {
                        if (nowCollapsed) {
                            toggleIcon.classList.remove('bi-chevron-left');
                            toggleIcon.classList.add('bi-chevron-right');
                        } else {
                            toggleIcon.classList.remove('bi-chevron-right');
                            toggleIcon.classList.add('bi-chevron-left');
                        }
                    }
                });
            }

            // Mobile Sticky Toggle Button (Ikon Garis Tiga)
            const mobileToggleBtn = document.getElementById('mobile-nav-toggle-btn');
            const mobileDropdown = document.getElementById('mobile-dropdown-menu');
            const mobileHamburgerIcon = document.getElementById('mobile-hamburger-icon');

            if (mobileToggleBtn && mobileDropdown) {
                mobileToggleBtn.addEventListener('click', function () {
                    mobileDropdown.classList.toggle('show');
                    if (mobileHamburgerIcon) {
                        if (mobileDropdown.classList.contains('show')) {
                            mobileHamburgerIcon.classList.remove('bi-list');
                            mobileHamburgerIcon.classList.add('bi-x-lg');
                        } else {
                            mobileHamburgerIcon.classList.remove('bi-x-lg');
                            mobileHamburgerIcon.classList.add('bi-list');
                        }
                    }
                });
            }
        });
    </script>

    <!-- Background Earthquake Alert Poller for BPBD Admin -->
    <?php if (session()->get('logged_in') && session()->get('role') === 'bpbd_admin'): ?>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const BACKGROUND_POLL_INTERVAL = 30000; // 30 seconds real-time background polling
                let lastNotifiedEvents = JSON.parse(localStorage.getItem('psyaid_notified_earthquakes') || '[]');

                // AudioContext instance management & auto-unlock on user gesture
                let psyaidAudioCtx = null;

                function getPsyaidAudioContext() {
                    if (!psyaidAudioCtx) {
                        const AudioCtxClass = window.AudioContext || window.webkitAudioContext;
                        if (AudioCtxClass) {
                            psyaidAudioCtx = new AudioCtxClass();
                        }
                    }
                    return psyaidAudioCtx;
                }

                function unlockAudioContext() {
                    const ctx = getPsyaidAudioContext();
                    if (ctx && ctx.state === 'suspended') {
                        ctx.resume().catch(e => console.log('AudioContext unlock catch:', e));
                    }
                }

                ['click', 'touchstart', 'keydown', 'pointerdown'].forEach(evt => {
                    window.addEventListener(evt, unlockAudioContext, { passive: true });
                });

                function scheduleSirenBeep(ctx, startTime, freqStart, freqEnd, duration) {
                    const osc = ctx.createOscillator();
                    const gain = ctx.createGain();

                    osc.type = 'sawtooth';
                    osc.frequency.setValueAtTime(freqStart, startTime);
                    osc.frequency.exponentialRampToValueAtTime(freqEnd, startTime + duration);

                    gain.gain.setValueAtTime(0.7, startTime);
                    gain.gain.exponentialRampToValueAtTime(0.01, startTime + duration);

                    osc.connect(gain);
                    gain.connect(ctx.destination);

                    osc.start(startTime);
                    osc.stop(startTime + duration);
                }

                function playSirenTones(ctx) {
                    try {
                        const now = ctx.currentTime;
                        // 3 Loud & Urgent Disaster Emergency Siren Pulses
                        scheduleSirenBeep(ctx, now + 0.00, 960, 680, 0.35);
                        scheduleSirenBeep(ctx, now + 0.40, 960, 680, 0.35);
                        scheduleSirenBeep(ctx, now + 0.80, 1080, 750, 0.45);
                    } catch (err) {
                        console.error('Error rendering siren tones:', err);
                    }
                }

                function playWarningChime() {
                    try {
                        const ctx = getPsyaidAudioContext();
                        if (!ctx) return;

                        if (ctx.state === 'suspended') {
                            ctx.resume().then(() => playSirenTones(ctx)).catch(() => playSirenTones(ctx));
                        } else {
                            playSirenTones(ctx);
                        }
                    } catch (e) {
                        console.log('Web Audio chime error:', e);
                    }
                }

                let sirenRepeatInterval = null;

                function startSirenLoop() {
                    stopSirenLoop();
                    playWarningChime();
                    sirenRepeatInterval = setInterval(function () {
                        playWarningChime();
                    }, 1700); // Continuous 3-pulse emergency siren repeat every 1.7 seconds
                }

                function stopSirenLoop() {
                    if (sirenRepeatInterval) {
                        clearInterval(sirenRepeatInterval);
                        sirenRepeatInterval = null;
                    }
                }

                // Stop repeating siren sound & cleanup backdrop state as soon as BPBD Admin closes or dismisses modal
                const modalEl = document.getElementById('earthquakeEmergencyModal');

                function cleanupEmergencyModalState() {
                    stopSirenLoop();
                    setTimeout(function () {
                        document.querySelectorAll('.modal-backdrop').forEach(function (el) {
                            el.remove();
                        });
                        document.body.classList.remove('modal-open');
                        document.body.style.removeProperty('overflow');
                        document.body.style.removeProperty('padding-right');
                    }, 150);
                }

                if (modalEl) {
                    modalEl.addEventListener('hidden.bs.modal', cleanupEmergencyModalState);
                    modalEl.addEventListener('hide.bs.modal', cleanupEmergencyModalState);
                }

                // Expose globally so views (like Earthquake Radar) can trigger audio test or control loop
                window.playEarthquakeWarningSound = playWarningChime;
                window.startEarthquakeSirenLoop = startSirenLoop;
                window.stopEarthquakeSirenLoop = stopSirenLoop;

                function checkBackgroundEarthquakes() {
                    fetch('<?= site_url('/api/earthquake-data') ?>')
                        .then(res => res.json())
                        .then(res => {
                            if (res.status === 'success' && Array.isArray(res.data)) {
                                const highRiskEvents = res.data.filter(item => item.magnitude >= 5.0);

                                highRiskEvents.forEach(item => {
                                    const eventId = item.datetime + '_' + item.magnitude;

                                    if (!lastNotifiedEvents.includes(eventId)) {
                                        lastNotifiedEvents.push(eventId);
                                        if (lastNotifiedEvents.length > 50) lastNotifiedEvents.shift();
                                        localStorage.setItem('psyaid_notified_earthquakes', JSON.stringify(lastNotifiedEvents));

                                        showEmergencyModal(item);
                                    }
                                });
                            }
                        })
                        .catch(err => console.error('Background earthquake check error:', err));
                }

                function showEmergencyModal(item) {
                    const modalBody = document.getElementById('earthquakeEmergencyBody');
                    const modalElement = document.getElementById('earthquakeEmergencyModal');

                    if (modalBody && modalElement) {
                        modalBody.innerHTML = `
                            <div class="mb-3">
                                <span class="badge bg-danger fs-4 px-3 py-2 rounded-6 fw-bold shadow-sm">
                                    MAGNITUDO ${item.magnitude} SR
                                </span>
                            </div>
                            <h5 class="fw-bold text-dark mb-2">${item.wilayah}</h5>
                            <div class="text-muted small mb-3">
                                <i class="bi bi-clock me-1"></i> Terdeteksi: <strong>${item.jam}</strong> (${item.tanggal})
                            </div>

                            <div class="row g-2 mb-3">
                                <div class="col-6">
                                    <div class="p-2.5 bg-light rounded-6 text-center">
                                        <div class="text-muted fs-8 fw-semibold">Kedalaman</div>
                                        <div class="fw-bold text-dark small"><i class="bi bi-arrow-down-circle text-primary me-1"></i> ${item.kedalaman}</div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="p-2.5 bg-light rounded-6 text-center">
                                        <div class="text-muted fs-8 fw-semibold">Koordinat</div>
                                        <div class="fw-bold text-dark small"><i class="bi bi-geo-alt text-danger me-1"></i> ${item.lintang}, ${item.bujur}</div>
                                    </div>
                                </div>
                            </div>

                            <div class="p-3 bg-danger bg-opacity-10 text-danger rounded-6 border border-danger border-opacity-25 text-start">
                                <div class="fw-bold small mb-1"><i class="bi bi-broadcast me-1"></i> Laporan Wilayah Dirasakan (MMI):</div>
                                <div class="small">${item.dirasakan || 'Tidak ada catatan spesifik MMI.'}</div>
                            </div>
                        `;
                        const modal = bootstrap.Modal.getOrCreateInstance(modalElement);
                        modal.show();

                        // Start continuous siren loop until modal is closed
                        startSirenLoop();
                    }
                }

                checkBackgroundEarthquakes();
                setInterval(checkBackgroundEarthquakes, BACKGROUND_POLL_INTERVAL);
            });
        </script>
    <?php endif; ?>
</body>

</html>