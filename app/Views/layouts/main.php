<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'PsyAid - Disaster Mental Health Command Center') ?></title>

    <!-- Fonts: Plus Jakarta Sans & Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap"
        rel="stylesheet" />

    <!-- Bootstrap 5 CSS & Icons CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- Global Time Format Helper -->
    <script src="<?= base_url('helper/timeFormat.js') ?>"></script>

    <!-- Custom System Theme Variables & Responsive Design -->
    <style>
        :root {
            --sidebar-width: 260px;
            --sidebar-width-collapsed: 78px;
            --emerald-50: #ecfdf5;
            --emerald-100: #d1fae5;
            --emerald-600: #059669;
            --emerald-700: #047857;
            --emerald-800: #065f46;
            --emerald-950: #064e3b;
        }

        html,
        body {
            font-family: 'Plus Jakarta Sans', 'Inter', sans-serif;
            background-color: #f4fbf7;
            color: #0f172a;
            overflow-x: hidden;
            min-height: 100vh;
        }

        /* Sidebar Styling */
        #app-sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1040;
            background-color: #ffffff;
            border-right: 1px solid #e2e8f0;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            flex-direction: column;
            box-shadow: 4px 0 24px rgba(0, 0, 0, 0.02);
        }

        body.sidebar-collapsed #app-sidebar {
            width: var(--sidebar-width-collapsed);
        }

        /* Sidebar Header (Logo) */
        .sidebar-header {
            padding: 1.25rem 1.25rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid #f1f5f9;
        }

        .sidebar-brand-logo {
            height: 38px;
            width: auto;
            object-fit: contain;
            flex-shrink: 0;
        }

        .sidebar-brand-text {
            display: flex;
            flex-direction: column;
            margin-left: 0.75rem;
            overflow: hidden;
            white-space: nowrap;
        }

        .sidebar-brand-title {
            font-weight: 800;
            font-size: 1.15rem;
            color: var(--emerald-950);
            letter-spacing: -0.02em;
            line-height: 1.1;
        }

        body.sidebar-collapsed .sidebar-brand-text {
            display: none !important;
        }

        /* Sidebar Body & Links */
        .sidebar-body {
            padding: 1rem 0.75rem;
            flex: 1;
            overflow-y: auto;
            overflow-x: hidden;
        }

        .sidebar-menu-title {
            font-size: 0.7rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #94a3b8;
            padding: 0.5rem 0.75rem;
            margin-bottom: 0.25rem;
            white-space: nowrap;
        }

        body.sidebar-collapsed .sidebar-menu-title {
            display: none;
        }

        .sidebar-nav-item {
            display: flex;
            align-items: center;
            padding: 0.65rem 0.85rem;
            color: #475569;
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
            justify-content: center !important;
            padding: 0.65rem 0;
        }

        body.sidebar-collapsed .sidebar-nav-item i {
            margin-right: 0 !important;
        }

        body.sidebar-collapsed .sidebar-label,
        body.sidebar-collapsed .dropdown-chevron {
            display: none !important;
        }

        body.sidebar-collapsed .sidebar-dropdown-container .collapse {
            display: none !important;
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

        .btn-sidebar-logout:hover {
            background-color: #fee2e2;
            color: #b91c1c;
        }

        .btn-sidebar-logout i {
            font-size: 1.15rem;
            margin-right: 0.5rem;
        }

        body.sidebar-collapsed .btn-sidebar-logout i {
            margin-right: 0 !important;
        }

        /* App Main Content Area */
        #app-main-wrapper {
            margin-left: var(--sidebar-width);
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

        /* Top Header User Profile Styling (Name Only) */
        .header-profile-toggle {
            cursor: pointer;
        }

        .header-profile-toggle::after {
            display: none !important; /* Hide caret arrow icon everywhere */
        }

        .header-profile-name {
            font-size: 0.875rem !important; /* 14px */
            font-weight: 700 !important;
            color: #0f172a !important;
            line-height: 1.2 !important;
        }

        .header-profile-avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            overflow: hidden;
            border: 2px solid #10b981;
            background-color: #f0fdf4;
            box-shadow: 0 2px 8px rgba(16, 185, 129, 0.2);
            transition: transform 0.2s ease, border-color 0.2s ease;
        }

        .header-profile-toggle:hover .header-profile-avatar {
            transform: scale(1.05);
            border-color: #059669;
        }

        /* Mobile View Navigation Overrides (< 768px) */
        @media (max-width: 767.98px) {
            #app-sidebar {
                display: none !important;
            }

            #app-main-wrapper {
                margin-left: 0 !important;
            }

            /* Sticky Mobile Header Navbar Toggle Button */
            .mobile-nav-toggle-btn {
                position: fixed !important;
                top: 12px !important;
                left: 12px !important;
                z-index: 1050 !important;
                background-color: #ffffff !important;
                border: 1.5px solid #cbd5e1 !important;
                box-shadow: 0 4px 14px rgba(0, 0, 0, 0.12) !important;
                border-radius: 0.5rem !important;
                width: 42px;
                height: 42px;
                display: flex !important;
                align-items: center;
                justify-content: center;
                color: #0f172a;
                font-size: 1.3rem;
                cursor: pointer;
                transition: all 0.2s ease;
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

// Internal dashboard routes (BPBD, Relawan, Psikolog) must always show sidebar and top header
$isBpbdRoute = (strpos($uriPath, 'bpbd') !== false)
    || (strpos($uriPath, 'command-center') !== false)
    || (strpos($uriPath, 'psychologist-mapping') !== false)
    || (strpos($uriPath, 'relawan') !== false)
    || (strpos($uriPath, 'psikolog') !== false);

$isLoginPage = ($hideNavbar ?? false)
    || (!$isBpbdRoute && (
        url_is('login*')
        || url_is('login')
        || url_is('/')
        || url_is('landing')
    ));

// Fetch true real-time user profile name & details from database if logged in
$sessionName  = session()->get('name') ?? session()->get('user_name');
$sessionEmail = session()->get('email');
$sessionRole  = session()->get('role');
$userId       = session()->get('user_id');

if (session()->get('logged_in') && $userId) {
    $db = \Config\Database::connect();
    $dbUser = $db->table('users')->where('id', $userId)->get()->getRowArray();
    if ($dbUser) {
        $sessionName  = $dbUser['name'];
        $sessionEmail = $dbUser['email'];
        $sessionRole  = $dbUser['role'];
    }
}

$userName    = !empty($sessionName) ? $sessionName : 'User';
$userEmail   = !empty($sessionEmail) ? $sessionEmail : '';
$userRole    = !empty($sessionRole) ? str_replace('_', ' ', strtoupper($sessionRole)) : '';
$userInitial = !empty($userName) ? strtoupper(substr(trim($userName), 0, 1)) : 'U';
?>

<body class="<?= $isLoginPage ? 'no-sidebar' : '' ?>">

    <?php if (!$isLoginPage): ?>
        <!-- Mobile Sticky Floating Navbar Toggle Button -->
        <button type="button" class="mobile-nav-toggle-btn" id="btn-mobile-nav-toggle" aria-label="Toggle Navigation">
            <i class="bi bi-list"></i>
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
                        <a href="<?= site_url('/bpbd/manage-posko') ?>"
                            class="sidebar-nav-item <?= url_is('bpbd/manage-posko*') ? 'active' : '' ?>" title="Kelola Posko Bencana">
                            <i class="bi bi-house-gear-fill text-success"></i>
                            <span class="sidebar-label">Kelola Posko Bencana</span>
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
                                <i class="bi bi-person-plus-fill text-success"></i>
                                <span class="sidebar-label">Registrasi Akun</span>
                                <i class="bi bi-chevron-down ms-auto sidebar-label dropdown-chevron" style="font-size: 0.75rem;"></i>
                            </a>
                            <div class="collapse <?= $isRegisterActive ? 'show' : '' ?>" id="desktopRegisterSubmenu">
                                <div class="ps-3 py-1">
                                    <a href="<?= site_url('/bpbd/register-relawan') ?>"
                                        class="sidebar-nav-item py-1.5 <?= url_is('bpbd/register-relawan*') ? 'active' : '' ?>"
                                        title="Approval & Review Akun Relawan">
                                        <i class="bi bi-person-check-fill text-success" style="font-size: 0.95rem;"></i>
                                        <span class="sidebar-label">Approval Akun Relawan</span>
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
                            class="sidebar-nav-item <?= url_is('psikolog/dashboard*') ? 'active' : '' ?>" title="Workspace Psikolog">
                            <i class="bi bi-person-badge-fill text-primary"></i>
                            <span class="sidebar-label">Clinical Workspace</span>
                        </a>
                        <a href="<?= site_url('/psychologist-mapping') ?>"
                            class="sidebar-nav-item <?= url_is('psychologist-mapping*') ? 'active' : '' ?>"
                            title="Pemetaan Posko & Korban">
                            <i class="bi bi-diagram-3-fill text-info"></i>
                            <span class="sidebar-label">Mapping Posko</span>
                        </a>
                    <?php endif; ?>

                <?php else: ?>
                    <!-- Guest Links -->
                    <a href="<?= site_url('/') ?>" class="sidebar-nav-item <?= url_is('/') ? 'active' : '' ?>"
                        title="Halaman Beranda Utama">
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

                <!-- User Profile Summary (Desktop & Mobile Header - Name Only) -->
                <div class="d-flex align-items-center gap-2">
                    <?php if (session()->get('logged_in')): ?>
                        <div class="dropdown">
                            <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle header-profile-toggle text-dark"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <div
                                    class="header-profile-avatar me-sm-2 d-flex align-items-center justify-content-center fw-bold text-success">
                                    <?= esc($userInitial) ?>
                                </div>
                                <div class="d-none d-sm-block text-start me-1">
                                    <div class="header-profile-name me-1">
                                        <?= esc($userName) ?>
                                    </div>
                                </div>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 rounded-3 mt-2 p-2" style="z-index: 1065;">
                                <li>
                                    <div class="px-3 py-2 border-bottom mb-1">
                                        <div class="fw-bold small text-dark"><?= esc($userName) ?></div>
                                        <div class="text-muted fs-8" style="font-size: 0.75rem;"><?= esc($userEmail) ?></div>
                                    </div>
                                </li>
                                <li>
                                    <button type="button" class="dropdown-item text-danger fw-semibold rounded-2 py-1.5"
                                        data-bs-toggle="modal" data-bs-target="#logoutConfirmModal">
                                        <i class="bi bi-box-arrow-right me-2"></i> Logout
                                    </button>
                                </li>
                            </ul>
                        </div>
                    <?php else: ?>
                        <a href="<?= site_url('/login') ?>" class="btn btn-sm btn-emerald fw-bold rounded-2 px-3">
                            <i class="bi bi-box-arrow-in-right me-1"></i> Login
                        </a>
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
                        <a href="<?= site_url('/bpbd/manage-posko') ?>"
                            class="sidebar-nav-item py-2 px-3 mb-1 <?= url_is('bpbd/manage-posko*') ? 'active' : '' ?>">
                            <i class="bi bi-house-gear-fill text-success"></i> Kelola Posko Bencana
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
                                    <i class="bi bi-person-check-fill text-success me-2"></i> Approval Akun Relawan
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
            <!-- Render Dynamic Page View Content -->
            <?= $this->renderSection('content') ?>
        </main>
    </div>

    <!-- Global Logout Confirmation Modal -->
    <?php if (session()->get('logged_in')): ?>
        <div class="modal fade" id="logoutConfirmModal" tabindex="-1" aria-labelledby="logoutConfirmModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content border-0 shadow-lg rounded-3">
                    <div class="modal-body text-center p-4">
                        <div class="avatar-lg bg-danger bg-opacity-10 text-danger rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center"
                            style="width: 54px; height: 54px;">
                            <i class="bi bi-box-arrow-right fs-3"></i>
                        </div>
                        <h6 class="fw-bold text-dark mb-1">Konfirmasi Logout</h6>
                        <p class="small text-muted mb-4">Apakah Anda yakin ingin keluar dari sesi sistem PsyAid?</p>
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-light border w-100 fw-semibold fs-8"
                                data-bs-dismiss="modal">Batal</button>
                            <a href="<?= site_url('/logout') ?>" class="btn btn-danger w-100 fw-bold fs-8">Logout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <!-- Bootstrap 5 JS Bundle CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Mobile Navigation Toggle Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const btnToggle = document.getElementById('btn-mobile-nav-toggle');
            const mobileMenu = document.getElementById('mobile-dropdown-menu');

            if (btnToggle && mobileMenu) {
                btnToggle.addEventListener('click', function (e) {
                    e.stopPropagation();
                    mobileMenu.classList.toggle('show');

                    // Toggle Icon between List and X
                    const icon = btnToggle.querySelector('i');
                    if (mobileMenu.classList.contains('show')) {
                        icon.className = 'bi bi-x-lg';
                    } else {
                        icon.className = 'bi bi-list';
                    }
                });

                // Close Mobile Menu when clicking outside
                document.addEventListener('click', function (e) {
                    if (!mobileMenu.contains(e.target) && !btnToggle.contains(e.target)) {
                        mobileMenu.classList.remove('show');
                        const icon = btnToggle.querySelector('i');
                        if (icon) icon.className = 'bi bi-list';
                    }
                });
            }
        });
    </script>
</body>

</html>