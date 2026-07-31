<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'PsyAid - Disaster Mental Health Command Center') ?></title>
    <link rel="shortcut icon" type="image/png" href="<?= base_url('images/Logo_PsyAid.png') ?>">
    <link rel="icon" type="image/png" href="<?= base_url('images/Logo_PsyAid.png') ?>">

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

        /* Minimalist + Claymorphism Hybrid Sidebar Styling System */
        #app-sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1040;
            background: #f7fbf8; /* Clean soft mint-tinted canvas */
            border-right: 1px solid #e2eaf0;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            flex-direction: column;
            box-shadow: 4px 0 20px rgba(16, 185, 129, 0.04);
        }

        body.sidebar-collapsed #app-sidebar {
            width: var(--sidebar-width-collapsed) !important;
        }

        /* Sidebar Header (Clean Brand Logo Area) */
        .sidebar-header {
            padding: 1.25rem 1.25rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid #e8f3ec;
            background: transparent;
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

        /* Claymorphic Floating Sticky Edge Toggle Button */
        .sidebar-edge-toggle-btn {
            position: fixed !important;
            top: 18px !important;
            left: calc(var(--sidebar-width) - 14px) !important;
            z-index: 1045 !important;
            width: 28px !important;
            height: 28px !important;
            border-radius: 50% !important;
            background: linear-gradient(135deg, #ffffff 0%, #f0fdf4 100%) !important;
            border: 1.5px solid #a7f3d0 !important;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.18), inset -2px -2px 4px rgba(16, 185, 129, 0.12), inset 2px 2px 4px #ffffff !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            color: #047857 !important;
            font-size: 0.8rem !important;
            cursor: pointer !important;
            transition: left 0.3s cubic-bezier(0.4, 0, 0.2, 1), transform 0.2s ease, background-color 0.2s ease, box-shadow 0.2s ease !important;
        }

        .sidebar-edge-toggle-btn:hover {
            background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%) !important;
            border-color: #34d399 !important;
            color: #064e3b !important;
            box-shadow: 0 6px 16px rgba(16, 185, 129, 0.25), inset -2px -2px 4px rgba(5, 150, 105, 0.2), inset 2px 2px 4px #ffffff !important;
            transform: scale(1.1) !important;
        }

        body.sidebar-collapsed .sidebar-edge-toggle-btn {
            left: calc(var(--sidebar-width-collapsed) - 14px) !important;
        }

        @media (max-width: 767.98px) {
            .sidebar-edge-toggle-btn {
                display: none !important;
            }
        }

        /* Sidebar Body Container */
        .sidebar-body {
            padding: 1rem 0.75rem;
            flex: 1;
            overflow-y: auto;
            overflow-x: hidden;
        }

        body.sidebar-collapsed .sidebar-body {
            padding: 1rem 0.5rem !important;
        }

        .sidebar-menu-title {
            font-size: 0.6875rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #94a3b8;
            padding: 0.5rem 0.75rem;
            margin-bottom: 0.35rem;
            white-space: nowrap;
        }

        body.sidebar-collapsed .sidebar-menu-title {
            display: none !important;
        }

        /* Strict Unified Top-Level Nav Item Styling */
        .sidebar-nav-item {
            display: flex !important;
            align-items: center !important;
            padding: 0.65rem 0.85rem !important;
            color: #334155 !important;
            text-decoration: none !important;
            font-weight: 600 !important;
            font-size: 0.875rem !important;
            border-radius: 12px !important;
            margin-bottom: 0.4rem !important;
            background: #ffffff !important;
            border: 1px solid #e8f3ec !important;
            box-shadow: 0 2px 8px rgba(15, 23, 42, 0.03), inset -2px -2px 4px rgba(0, 0, 0, 0.02), inset 2px 2px 4px #ffffff !important;
            transition: all 0.22s cubic-bezier(0.16, 1, 0.3, 1) !important;
            white-space: nowrap !important;
            width: 100% !important;
            box-sizing: border-box !important;
        }

        /* Fixed Icon Slot for Top-Level Nav Items */
        .sidebar-nav-item .nav-icon {
            font-size: 1.15rem !important;
            width: 24px !important;
            min-width: 24px !important;
            height: 24px !important;
            line-height: 24px !important;
            text-align: center !important;
            flex-shrink: 0 !important;
            margin-right: 0.75rem !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            transition: margin 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
        }

        /* Nav Text Label */
        .sidebar-nav-item .sidebar-label {
            font-size: 0.875rem !important;
            font-weight: 600 !important;
            line-height: 1.2 !important;
        }

        /* Decoupled Dropdown Chevron Icon Styling */
        .sidebar-nav-item .dropdown-chevron {
            font-size: 0.75rem !important;
            margin-left: auto !important;
            margin-right: 0 !important;
            flex-shrink: 0 !important;
            transition: transform 0.25s cubic-bezier(0.4, 0, 0.2, 1) !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            transform: rotate(0deg) !important;
        }

        a[aria-expanded="true"] .dropdown-chevron {
            transform: rotate(180deg) !important;
        }

        /* Claymorphism Hover State: Volumetric Lift */
        .sidebar-nav-item:hover {
            background: #f0fdf4 !important;
            color: #047857 !important;
            border-color: #a7f3d0 !important;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.1), inset -2px -2px 5px rgba(16, 185, 129, 0.08), inset 2px 2px 5px #ffffff !important;
            transform: translateY(-2px) !important;
        }

        /* Claymorphism Active State: 3D Volumetric Pill */
        .sidebar-nav-item.active {
            background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%) !important;
            color: #064e3b !important;
            font-weight: 800 !important;
            border: 1.5px solid #34d399 !important;
            box-shadow: 0 6px 16px -2px rgba(16, 185, 129, 0.25), inset -3px -3px 6px rgba(5, 150, 105, 0.18), inset 3px 3px 6px #ffffff !important;
            transform: translateY(0) !important;
        }

        /* Collapsed Sidebar State (Desktop < 78px width) */
        body.sidebar-collapsed .sidebar-nav-item {
            justify-content: center !important;
            padding: 0.65rem 0 !important;
            width: 100% !important;
        }

        body.sidebar-collapsed .sidebar-nav-item .nav-icon {
            margin-right: 0 !important;
        }

        body.sidebar-collapsed .sidebar-label,
        body.sidebar-collapsed .dropdown-chevron {
            display: none !important;
        }

        body.sidebar-collapsed .sidebar-dropdown-container .collapse {
            display: none !important;
        }

        /* Sidebar Dropdown Container Spacing */
        .sidebar-dropdown-container {
            margin-bottom: 0.4rem;
            width: 100%;
        }

        .sidebar-dropdown-container > .sidebar-nav-item {
            margin-bottom: 0 !important;
        }

        .sidebar-dropdown-container .collapse {
            background: #eef7f2;
            border-radius: 12px;
            margin-top: 0.35rem;
            padding: 0.35rem;
            border: 1px solid #e0ede5;
            box-shadow: inset 2px 2px 6px rgba(166, 185, 174, 0.2), inset -2px -2px 6px #ffffff;
        }

        /* Submenu Items Styling */
        .sidebar-nav-submenu-item {
            display: flex !important;
            align-items: center !important;
            padding: 0.5rem 0.75rem !important;
            color: #475569 !important;
            text-decoration: none !important;
            font-weight: 600 !important;
            font-size: 0.8125rem !important;
            border-radius: 8px !important;
            margin-bottom: 0.25rem !important;
            transition: all 0.2s ease !important;
            white-space: nowrap !important;
            width: 100% !important;
            background: transparent !important;
            border: 1px solid transparent !important;
            box-sizing: border-box !important;
        }

        .sidebar-nav-submenu-item:last-child {
            margin-bottom: 0 !important;
        }

        .sidebar-nav-submenu-item .submenu-icon {
            font-size: 0.95rem !important;
            width: 22px !important;
            min-width: 22px !important;
            height: 22px !important;
            line-height: 22px !important;
            text-align: center !important;
            flex-shrink: 0 !important;
            margin-right: 0.65rem !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
        }

        .sidebar-nav-submenu-item:hover {
            background: rgba(16, 185, 129, 0.12) !important;
            color: #047857 !important;
            border-color: rgba(16, 185, 129, 0.2) !important;
        }

        .sidebar-nav-submenu-item.active {
            background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%) !important;
            color: #064e3b !important;
            font-weight: 700 !important;
            border: 1px solid #34d399 !important;
            box-shadow: 0 3px 8px rgba(16, 185, 129, 0.15), inset -2px -2px 4px rgba(5, 150, 105, 0.15), inset 2px 2px 4px #ffffff !important;
        }

        /* Sidebar Footer & Claymorphic Logout Tile */
        .sidebar-footer {
            padding: 0.85rem 0.75rem;
            border-top: 1px solid #e8f3ec;
            background: transparent;
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
            background: linear-gradient(135deg, #fef2f2 0%, #fee2e2 100%);
            border: 1.5px solid #fecdd3;
            border-radius: 12px !important;
            box-shadow: 0 4px 12px rgba(220, 38, 38, 0.1), inset -2px -2px 5px rgba(220, 38, 38, 0.1), inset 2px 2px 5px #ffffff;
            font-weight: 700;
            font-size: 0.875rem;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.22s ease;
        }

        .btn-sidebar-logout:hover {
            background: linear-gradient(135deg, #fee2e2 0%, #fecdd3 100%);
            color: #b91c1c;
            box-shadow: 0 6px 16px rgba(220, 38, 38, 0.18), inset -2px -2px 5px rgba(185, 28, 28, 0.15), inset 2px 2px 5px #ffffff;
            transform: translateY(-1px);
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
            max-width: min(64vw, 820px);
            flex-wrap: wrap;
            row-gap: 0.2rem;
        }

        .glass-breadcrumb .breadcrumb-item+.breadcrumb-item::before {
            color: #059669;
            content: "›";
            font-size: 1.1rem;
            font-weight: 700;
            line-height: 1;
            vertical-align: middle;
        }

        .glass-breadcrumb .breadcrumb-item a {
            color: #047857 !important;
            transition: color 0.18s ease;
        }

        .glass-breadcrumb .breadcrumb-item a:hover {
            color: #064e3b !important;
        }

        .glass-breadcrumb .breadcrumb-item.active {
            color: #0f172a !important;
            max-width: 32ch;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        /* Top Header User Profile Styling (Name Only) */
        .header-profile-toggle {
            cursor: pointer;
        }

        .header-profile-toggle::after {
            display: none !important;
            /* Hide caret arrow icon everywhere */
        }

        .header-profile-name {
            font-size: 0.875rem !important;
            /* 14px */
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
$sessionName = session()->get('name') ?? session()->get('user_name');
$sessionEmail = session()->get('email');
$sessionRole = session()->get('role');
$userId = session()->get('user_id');

if (session()->get('logged_in') && $userId) {
    $db = \Config\Database::connect();
    $dbUser = $db->table('users')->where('id', $userId)->get()->getRowArray();
    if ($dbUser) {
        $sessionName = $dbUser['name'];
        $sessionEmail = $dbUser['email'];
        $sessionRole = $dbUser['role'];
    }
}

$userName = !empty($sessionName) ? $sessionName : 'User';
$userEmail = !empty($sessionEmail) ? $sessionEmail : '';
$userRole = !empty($sessionRole) ? str_replace('_', ' ', strtoupper($sessionRole)) : '';
$userInitial = !empty($userName) ? strtoupper(substr(trim($userName), 0, 1)) : 'U';

// Dynamically resolve Home/Beranda destination URL based on user role
$homeUrl = '/';
if (session()->get('logged_in')) {
    if ($sessionRole === 'bpbd_admin') {
        $homeUrl = '/bpbd/dashboard';
    } elseif ($sessionRole === 'relawan') {
        $poskoId = session()->get('posko_id') ?? 1;
        $homeUrl = '/relawan/posko/' . $poskoId;
    } elseif ($sessionRole === 'psikolog') {
        $homeUrl = '/psikolog/dashboard';
    }
}
?>

<body class="<?= $isLoginPage ? 'no-sidebar' : '' ?>">

    <?php if (!$isLoginPage): ?>
        <!-- Mobile Sticky Floating Navbar Toggle Button -->
        <button type="button" class="mobile-nav-toggle-btn" id="btn-mobile-nav-toggle" aria-label="Toggle Navigation">
            <i class="bi bi-list"></i>
        </button>

        <!-- Desktop Sticky Edge Sidebar Toggle Button (Positioned at Boundary between Sidebar & Top Header, hidden on mobile) -->
        <button type="button" class="sidebar-edge-toggle-btn d-none d-md-flex" id="btn-sidebar-edge-toggle"
            title="Sembunyikan / Tampilkan Sidebar">
            <i class="bi bi-chevron-left" id="sidebar-edge-toggle-icon"></i>
        </button>

        <!-- Desktop Sidebar Navigation -->
        <aside id="app-sidebar">
            <!-- Sidebar Header: Logo PsyAid -->
            <div class="sidebar-header">
                <a href="<?= site_url($homeUrl) ?>" class="d-flex align-items-center text-decoration-none min-w-0">
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
                        <a href="<?= site_url('/bpbd/dashboard') ?>"
                            class="sidebar-nav-item <?= url_is('bpbd/dashboard*') ? 'active' : '' ?>"
                            title="Dashboard Utama BPBD">
                            <i class="nav-icon bi bi-speedometer2 text-success"></i>
                            <span class="sidebar-label">Dashboard BPBD</span>
                        </a>
                        <a href="<?= site_url('/command-center') ?>"
                            class="sidebar-nav-item <?= url_is('command-center*') ? 'active' : '' ?>" title="Command Center BPBD">
                            <i class="nav-icon bi bi-shield-fill-check text-danger"></i>
                            <span class="sidebar-label">Command Center</span>
                        </a>
                        <a href="<?= site_url('/bpbd/manage-posko') ?>"
                            class="sidebar-nav-item <?= url_is('bpbd/manage-posko*') ? 'active' : '' ?>"
                            title="Kelola Posko Bencana">
                            <i class="nav-icon bi bi-house-gear-fill text-success"></i>
                            <span class="sidebar-label">Kelola Posko Bencana</span>
                        </a>
                        <a href="<?= site_url('/bpbd/earthquake-radar') ?>"
                            class="sidebar-nav-item <?= url_is('bpbd/earthquake-radar*') ? 'active' : '' ?>"
                            title="Peta Radar Gempa Real-Time BMKG">
                            <i class="nav-icon bi bi-radar text-warning"></i>
                            <span class="sidebar-label">Peta Radar Gempa</span>
                        </a>
                        <a href="<?= site_url('/psychologist-mapping') ?>"
                            class="sidebar-nav-item <?= url_is('psychologist-mapping*') ? 'active' : '' ?>"
                            title="Pemetaan Tim Psikolog">
                            <i class="nav-icon bi bi-diagram-3-fill text-primary"></i>
                            <span class="sidebar-label">Pemetaan Psikolog</span>
                        </a>
                        <a href="<?= site_url('/bpbd/ticketing-laporan') ?>"
                            class="sidebar-nav-item <?= url_is('bpbd/ticketing-laporan*') ? 'active' : '' ?>"
                            title="Ticketing Laporan Bencana">
                            <i class="nav-icon bi bi-ticket-perforated-fill text-emerald-600"></i>
                            <span class="sidebar-label">Ticketing Laporan</span>
                        </a>

                        <!-- Dropdown Registrasi Akun -->
                        <?php $isRegisterActive = url_is('bpbd/register*') || (url_is('register*') && !url_is('bpbd/register*')); ?>
                        <div class="sidebar-dropdown-container">
                            <a href="#desktopRegisterSubmenu" data-bs-toggle="collapse"
                                class="sidebar-nav-item <?= $isRegisterActive ? 'active' : 'collapsed' ?>"
                                role="button" aria-expanded="<?= $isRegisterActive ? 'true' : 'false' ?>"
                                aria-controls="desktopRegisterSubmenu" title="Registrasi Akun">
                                <i class="nav-icon bi bi-person-plus-fill text-success"></i>
                                <span class="sidebar-label">Registrasi Akun</span>
                                <i class="dropdown-chevron bi bi-chevron-down"></i>
                            </a>
                            <div class="collapse <?= $isRegisterActive ? 'show' : '' ?>" id="desktopRegisterSubmenu">
                                <a href="<?= site_url('/bpbd/register-relawan') ?>"
                                    class="sidebar-nav-submenu-item <?= url_is('bpbd/register-relawan*') ? 'active' : '' ?>"
                                    title="Approval & Review Akun Relawan">
                                    <i class="submenu-icon bi bi-person-check-fill text-success"></i>
                                    <span class="sidebar-label">Approval Akun Relawan</span>
                                </a>
                                <a href="<?= site_url('/bpbd/register-psikolog') ?>"
                                    class="sidebar-nav-submenu-item <?= url_is('bpbd/register-psikolog*') ? 'active' : '' ?>"
                                    title="Registrasi Akun Psikolog Klinis Baru">
                                    <i class="submenu-icon bi bi-person-badge-fill text-primary"></i>
                                    <span class="sidebar-label">Registrasi Psikolog</span>
                                </a>
                                <a href="<?= site_url('/register') ?>"
                                    class="sidebar-nav-submenu-item <?= (url_is('register*') && !url_is('bpbd/register*')) ? 'active' : '' ?>"
                                    title="Registrasi Admin BPBD Baru">
                                    <i class="submenu-icon bi bi-shield-plus text-danger"></i>
                                    <span class="sidebar-label">Registrasi Admin BPBD</span>
                                </a>
                            </div>
                        </div>

                    <?php elseif ($role === 'relawan'): ?>
                        <!-- Relawan Posko Menu -->
                        <?php $poskoId = session()->get('posko_id') ?? 1; ?>
                        <a href="<?= site_url('/relawan/posko/' . $poskoId) ?>"
                            class="sidebar-nav-item <?= (url_is('relawan/posko*') || (url_is('posko*') && !url_is('relawan/manajemen-penyintas*'))) ? 'active' : '' ?>"
                            title="Posko Relawan Saya">
                            <i class="nav-icon bi bi-geo-alt-fill text-success"></i>
                            <span class="sidebar-label">Posko Saya</span>
                        </a>
                        <a href="<?= site_url('/relawan/manajemen-penyintas') ?>"
                            class="sidebar-nav-item <?= url_is('relawan/manajemen-penyintas*') ? 'active' : '' ?>"
                            title="Manajemen Data Penyintas">
                            <i class="nav-icon bi bi-person-lines-fill text-success"></i>
                            <span class="sidebar-label">Data Penyintas</span>
                        </a>
                        <a href="<?= site_url('/victim/create/' . $poskoId) ?>"
                            class="sidebar-nav-item <?= url_is('victim/create*') ? 'active' : '' ?>" title="Tambah Penyintas Baru">
                            <i class="nav-icon bi bi-person-plus-fill text-emerald-600"></i>
                            <span class="sidebar-label">Tambah Korban</span>
                        </a>

                    <?php elseif ($role === 'psikolog'): ?>
                        <!-- Psikolog Klinis Menu -->
                        <a href="<?= site_url('/psikolog/dashboard') ?>"
                            class="sidebar-nav-item <?= url_is('psikolog/dashboard*') ? 'active' : '' ?>"
                            title="Workspace Psikolog">
                            <i class="nav-icon bi bi-person-badge-fill text-primary"></i>
                            <span class="sidebar-label">Clinical Workspace</span>
                        </a>
                        <a href="<?= site_url('/psikolog/assessment-history') ?>"
                            class="sidebar-nav-item <?= url_is('psikolog/assessment-history*') ? 'active' : '' ?>"
                            title="Data Assessment Penyintas">
                            <i class="nav-icon bi bi-file-earmark-medical-fill text-success"></i>
                            <span class="sidebar-label">Assessment Penyintas</span>
                        </a>
                        <a href="<?= site_url('/psikolog/monitoring') ?>"
                            class="sidebar-nav-item <?= url_is('psikolog/monitoring*') ? 'active' : '' ?>"
                            title="Monitoring & Follow-Up">
                            <i class="nav-icon bi bi-heart-pulse-fill text-danger"></i>
                            <span class="sidebar-label">Monitoring & Follow-Up</span>
                        </a>
                    <?php endif; ?>

                <?php else: ?>
                    <!-- Guest Links -->
                    <a href="<?= site_url('/') ?>" class="sidebar-nav-item <?= url_is('/') ? 'active' : '' ?>"
                        title="Halaman Beranda Utama">
                        <i class="nav-icon bi bi-house-door-fill text-success"></i>
                        <span class="sidebar-label">Beranda</span>
                    </a>
                    <a href="<?= site_url('/login') ?>" class="sidebar-nav-item <?= url_is('login*') ? 'active' : '' ?>"
                        title="Login System">
                        <i class="nav-icon bi bi-box-arrow-in-right text-danger"></i>
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
                <div class="d-flex align-items-center gap-2.5">
                    <!-- Mobile Brand Logo -->
                    <a href="<?= site_url($homeUrl) ?>" class="d-md-none d-flex align-items-center text-decoration-none">
                        <img src="<?= base_url('images/Logo_PsyAid.png') ?>" alt="PsyAid Logo"
                            style="height: 34px; width: auto;" class="me-1">
                        <span class="sidebar-brand-title">PsyAid</span>
                    </a>

                    <!-- Desktop Dynamic Liquid Glass Breadcrumb -->
                    <?php
                    $currentUri = trim(uri_string(), '/');
                    $targetHome = trim($homeUrl, '/');
                    $isDashboardPage = ($currentUri === $targetHome) || url_is('bpbd/dashboard*') || url_is('psikolog/dashboard*');
                    $rawBreadcrumbTitle = trim((string) ($title ?? ''));
                    $titleParts = preg_split('/\s+(?:—|-)\s+/u', $rawBreadcrumbTitle, 2);
                    $currentPageLabel = trim($titleParts[0] ?? $rawBreadcrumbTitle);
                    $currentPageLabel = $currentPageLabel !== '' ? $currentPageLabel : 'Halaman';

                    $breadcrumbItems = [
                        [
                            'label' => 'Beranda',
                            'url' => $homeUrl,
                            'icon' => 'bi bi-house-door-fill',
                        ],
                    ];

                    if (! $isDashboardPage) {
                        $parentBreadcrumb = null;

                        if (url_is('psikolog/monitoring/detail*')) {
                            $parentBreadcrumb = ['label' => 'Monitoring & Follow-Up', 'url' => '/psikolog/monitoring'];
                            $currentPageLabel = 'Detail Monitoring';
                        } elseif (url_is('psikolog/monitoring*')) {
                            $currentPageLabel = 'Monitoring & Follow-Up';
                        } elseif (url_is('psikolog/assessment-history/detail*')) {
                            $parentBreadcrumb = ['label' => 'Assessment Penyintas', 'url' => '/psikolog/assessment-history'];
                            $currentPageLabel = 'Detail Assessment';
                        } elseif (url_is('psikolog/assessment-history*')) {
                            $currentPageLabel = 'Assessment Penyintas';
                        } elseif (url_is('psychologist-review*')) {
                            $parentBreadcrumb = ['label' => 'Assessment Penyintas', 'url' => '/psikolog/assessment-history'];
                            $currentPageLabel = 'Review Klinis Psikolog';
                        } elseif (url_is('itq/form*')) {
                            $parentBreadcrumb = ['label' => 'Assessment Penyintas', 'url' => '/psikolog/assessment-history'];
                            $currentPageLabel = 'Form ITQ';
                        } elseif (url_is('itq/result*')) {
                            $parentBreadcrumb = ['label' => 'Assessment Penyintas', 'url' => '/psikolog/assessment-history'];
                            $currentPageLabel = 'Hasil ITQ Assessment';
                        } elseif (url_is('command-center*')) {
                            $currentPageLabel = 'Command Center';
                        } elseif (url_is('bpbd/manage-posko*')) {
                            $currentPageLabel = 'Kelola Posko Bencana';
                        } elseif (url_is('bpbd/earthquake-radar*')) {
                            $currentPageLabel = 'Peta Radar Gempa';
                        } elseif (url_is('psychologist-mapping*') || url_is('bpbd/psychologist-mapping*')) {
                            $currentPageLabel = 'Pemetaan Psikolog';
                        } elseif (url_is('bpbd/ticketing-laporan*')) {
                            $currentPageLabel = 'Ticketing Laporan';
                        } elseif (url_is('bpbd/register-relawan*')) {
                            $parentBreadcrumb = ['label' => 'Registrasi Akun', 'url' => null];
                            $currentPageLabel = 'Approval Akun Relawan';
                        } elseif (url_is('bpbd/register-psikolog*')) {
                            $parentBreadcrumb = ['label' => 'Registrasi Akun', 'url' => null];
                            $currentPageLabel = 'Registrasi Psikolog';
                        } elseif (url_is('register*')) {
                            $parentBreadcrumb = ['label' => 'Registrasi Akun', 'url' => null];
                            $currentPageLabel = 'Registrasi Admin BPBD';
                        } elseif (url_is('relawan/manajemen-penyintas*')) {
                            $currentPageLabel = 'Data Penyintas';
                        } elseif (url_is('victim/create*')) {
                            $parentBreadcrumb = ['label' => 'Data Penyintas', 'url' => session()->get('role') === 'relawan' ? '/relawan/manajemen-penyintas' : null];
                            $currentPageLabel = 'Tambah Penyintas';
                        } elseif (url_is('victim/detail*')) {
                            $parentBreadcrumb = ['label' => 'Data Penyintas', 'url' => session()->get('role') === 'relawan' ? '/relawan/manajemen-penyintas' : null];
                            $currentPageLabel = 'Detail Penyintas';
                        }

                        if ($parentBreadcrumb !== null) {
                            $breadcrumbItems[] = $parentBreadcrumb;
                        }

                        $breadcrumbItems[] = [
                            'label' => $currentPageLabel,
                            'url' => null,
                            'icon' => null,
                        ];
                    }
                    ?>
                    <nav aria-label="breadcrumb" class="d-none d-md-block">
                        <ol class="breadcrumb mb-0 glass-breadcrumb align-items-center">
                            <?php foreach ($breadcrumbItems as $index => $item): ?>
                                <?php $isLastBreadcrumb = $index === array_key_last($breadcrumbItems); ?>
                                <li class="breadcrumb-item small <?= $isLastBreadcrumb ? 'active fw-bold' : 'fw-semibold' ?>"
                                    <?= $isLastBreadcrumb ? 'aria-current="page"' : '' ?>>
                                    <?php if (! $isLastBreadcrumb && ! empty($item['url'])): ?>
                                        <a href="<?= site_url($item['url']) ?>"
                                            class="text-decoration-none d-inline-flex align-items-center gap-1">
                                            <?php if (! empty($item['icon'])): ?>
                                                <i class="<?= esc($item['icon']) ?>"></i>
                                            <?php endif; ?>
                                            <?= esc($item['label']) ?>
                                        </a>
                                    <?php else: ?>
                                        <span class="d-inline-flex align-items-center gap-1">
                                            <?php if (! empty($item['icon'])): ?>
                                                <i class="<?= esc($item['icon']) ?>"></i>
                                            <?php endif; ?>
                                            <?= esc($item['label']) ?>
                                        </span>
                                    <?php endif; ?>
                                </li>
                            <?php endforeach; ?>
                        </ol>
                    </nav>
                </div>

                <!-- User Profile Summary (Desktop & Mobile Header - Name Only) -->
                <div class="d-flex align-items-center gap-2">
                    <?php if (session()->get('logged_in')): ?>
                        <div class="dropdown">
                            <a href="#"
                                class="d-flex align-items-center text-decoration-none dropdown-toggle header-profile-toggle text-dark"
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
                            <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 rounded-3 mt-2 p-2"
                                style="z-index: 1065;">
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
                        <a href="<?= site_url('/bpbd/dashboard') ?>"
                            class="sidebar-nav-item py-2 px-3 mb-1 <?= url_is('bpbd/dashboard*') ? 'active' : '' ?>">
                            <i class="nav-icon bi bi-speedometer2 text-success"></i>
                            <span class="sidebar-label">Dashboard BPBD</span>
                        </a>
                        <a href="<?= site_url('/command-center') ?>"
                            class="sidebar-nav-item py-2 px-3 mb-1 <?= url_is('command-center*') ? 'active' : '' ?>">
                            <i class="nav-icon bi bi-shield-fill-check text-danger"></i>
                            <span class="sidebar-label">Command Center</span>
                        </a>
                        <a href="<?= site_url('/bpbd/manage-posko') ?>"
                            class="sidebar-nav-item py-2 px-3 mb-1 <?= url_is('bpbd/manage-posko*') ? 'active' : '' ?>">
                            <i class="nav-icon bi bi-house-gear-fill text-success"></i>
                            <span class="sidebar-label">Kelola Posko Bencana</span>
                        </a>
                        <a href="<?= site_url('/bpbd/earthquake-radar') ?>"
                            class="sidebar-nav-item py-2 px-3 mb-1 <?= url_is('bpbd/earthquake-radar*') ? 'active' : '' ?>">
                            <i class="nav-icon bi bi-radar text-warning"></i>
                            <span class="sidebar-label">Peta Radar Gempa</span>
                        </a>
                        <a href="<?= site_url('/psychologist-mapping') ?>"
                            class="sidebar-nav-item py-2 px-3 mb-1 <?= url_is('psychologist-mapping*') ? 'active' : '' ?>">
                            <i class="nav-icon bi bi-diagram-3-fill text-primary"></i>
                            <span class="sidebar-label">Pemetaan Psikolog</span>
                        </a>
                        <a href="<?= site_url('/bpbd/ticketing-laporan') ?>"
                            class="sidebar-nav-item py-2 px-3 mb-1 <?= url_is('bpbd/ticketing-laporan*') ? 'active' : '' ?>">
                            <i class="nav-icon bi bi-ticket-perforated-fill text-emerald-600"></i>
                            <span class="sidebar-label">Ticketing Laporan</span>
                        </a>

                        <!-- Mobile Dropdown Registrasi Akun -->
                        <?php $isRegisterActive = url_is('bpbd/register*') || (url_is('register*') && !url_is('bpbd/register*')); ?>
                        <div class="sidebar-dropdown-container">
                            <a href="#mobileRegisterSubmenu" data-bs-toggle="collapse"
                                class="sidebar-nav-item py-2 px-3 <?= $isRegisterActive ? 'active' : 'collapsed' ?>"
                                role="button" aria-expanded="<?= $isRegisterActive ? 'true' : 'false' ?>">
                                <i class="nav-icon bi bi-person-plus-fill text-success"></i>
                                <span class="sidebar-label">Registrasi Akun</span>
                                <i class="dropdown-chevron bi bi-chevron-down"></i>
                            </a>
                            <div class="collapse <?= $isRegisterActive ? 'show' : '' ?>" id="mobileRegisterSubmenu">
                                <a href="<?= site_url('/bpbd/register-relawan') ?>"
                                    class="sidebar-nav-submenu-item <?= url_is('bpbd/register-relawan*') ? 'active' : '' ?>">
                                    <i class="submenu-icon bi bi-person-check-fill text-success"></i>
                                    <span>Approval Akun Relawan</span>
                                </a>
                                <a href="<?= site_url('/bpbd/register-psikolog') ?>"
                                    class="sidebar-nav-submenu-item <?= url_is('bpbd/register-psikolog*') ? 'active' : '' ?>">
                                    <i class="submenu-icon bi bi-person-badge-fill text-primary"></i>
                                    <span>Registrasi Psikolog</span>
                                </a>
                                <a href="<?= site_url('/register') ?>"
                                    class="sidebar-nav-submenu-item <?= (url_is('register*') && !url_is('bpbd/register*')); ?>">
                                    <i class="submenu-icon bi bi-shield-plus text-danger"></i>
                                    <span>Registrasi Admin BPBD</span>
                                </a>
                            </div>
                        </div>

                    <?php elseif ($role === 'relawan'): ?>
                        <?php $poskoId = session()->get('posko_id') ?? 1; ?>
                        <a href="<?= site_url('/relawan/posko/' . $poskoId) ?>"
                            class="sidebar-nav-item py-2 px-3 mb-1 <?= (url_is('relawan/posko*') || (url_is('posko*') && !url_is('relawan/manajemen-penyintas*'))) ? 'active' : '' ?>">
                            <i class="nav-icon bi bi-geo-alt-fill text-success"></i>
                            <span class="sidebar-label">Posko Saya</span>
                        </a>
                        <a href="<?= site_url('/relawan/manajemen-penyintas') ?>"
                            class="sidebar-nav-item py-2 px-3 mb-1 <?= url_is('relawan/manajemen-penyintas*') ? 'active' : '' ?>">
                            <i class="nav-icon bi bi-person-lines-fill text-success"></i>
                            <span class="sidebar-label">Data Penyintas</span>
                        </a>
                        <a href="<?= site_url('/victim/create/' . $poskoId) ?>"
                            class="sidebar-nav-item py-2 px-3 mb-1 <?= url_is('victim/create*') ? 'active' : '' ?>">
                            <i class="nav-icon bi bi-person-plus-fill text-emerald-600"></i>
                            <span class="sidebar-label">Tambah Korban</span>
                        </a>

                    <?php elseif ($role === 'psikolog'): ?>
                        <a href="<?= site_url('/psikolog/dashboard') ?>"
                            class="sidebar-nav-item py-2 px-3 mb-1 <?= url_is('psikolog/dashboard*') ? 'active' : '' ?>">
                            <i class="nav-icon bi bi-person-badge-fill text-primary"></i>
                            <span class="sidebar-label">Clinical Workspace</span>
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
                        <i class="nav-icon bi bi-house-door-fill text-success"></i>
                        <span class="sidebar-label">Beranda</span>
                    </a>
                    <a href="<?= site_url('/login') ?>"
                        class="sidebar-nav-item py-2 px-3 mb-1 <?= url_is('login*') ? 'active' : '' ?>">
                        <i class="nav-icon bi bi-box-arrow-in-right text-danger"></i>
                        <span class="sidebar-label">Masuk System</span>
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

    <!-- Mobile Navigation & Desktop Sticky Edge Sidebar Toggle Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Desktop Sticky Edge Sidebar Toggle Logic
            const edgeToggle = document.getElementById('btn-sidebar-edge-toggle');
            const edgeIcon = document.getElementById('sidebar-edge-toggle-icon');

            // Restore saved collapse preference
            if (localStorage.getItem('sidebar_collapsed') === 'true') {
                document.body.classList.add('sidebar-collapsed');
                if (edgeIcon) edgeIcon.className = 'bi bi-chevron-right';
            } else {
                if (edgeIcon) edgeIcon.className = 'bi bi-chevron-left';
            }

            function toggleDesktopSidebar() {
                document.body.classList.toggle('sidebar-collapsed');
                const isCollapsed = document.body.classList.contains('sidebar-collapsed');
                localStorage.setItem('sidebar_collapsed', isCollapsed ? 'true' : 'false');

                if (edgeIcon) {
                    edgeIcon.className = isCollapsed ? 'bi bi-chevron-right' : 'bi bi-chevron-left';
                }
            }

            if (edgeToggle) edgeToggle.addEventListener('click', toggleDesktopSidebar);

            // Mobile Navigation Toggle Logic
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
