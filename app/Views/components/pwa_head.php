<!-- PsyAid Progressive Web App -->
<?php
$offlineUserId = (int) (session()->get('user_id') ?? 0);
$offlineRole = (string) (session()->get('role') ?? 'public');
$offlineScope = session()->get('logged_in')
    ? 'user-' . $offlineUserId . '-' . preg_replace('/[^a-z0-9_-]/i', '-', $offlineRole)
    : 'public';
$pwaIconVersion = '20260808-2';
$pwaRuntimeVersion = '20260808-8';
?>
<meta name="theme-color" content="#064e3b">
<meta name="application-name" content="PsyAid">
<meta name="msapplication-TileColor" content="#064e3b">
<meta name="msapplication-TileImage" content="<?= base_url('icons/pwa-512x512.png') . '?v=' . $pwaIconVersion ?>">
<meta name="psyaid-user-scope" content="<?= esc($offlineScope, 'attr') ?>">
<meta name="psyaid-user-role" content="<?= esc($offlineRole, 'attr') ?>">
<?php if (session()->get('logged_in')): ?>
<meta name="psyaid-offline-bootstrap" content="<?= base_url('offline/bootstrap') ?>">
<?php endif; ?>
<meta name="mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<meta name="apple-mobile-web-app-title" content="PsyAid">
<link rel="manifest" href="<?= base_url('manifest.webmanifest') . '?v=' . $pwaIconVersion ?>">
<link rel="shortcut icon" type="image/x-icon" sizes="32x32" href="<?= base_url('favicon.ico') . '?v=' . $pwaIconVersion ?>">
<link rel="icon" type="image/png" sizes="32x32" href="<?= base_url('icons/favicon-32x32.png') . '?v=' . $pwaIconVersion ?>">
<link rel="icon" type="image/png" sizes="192x192" href="<?= base_url('icons/pwa-192x192.png') . '?v=' . $pwaIconVersion ?>">
<link rel="icon" type="image/png" sizes="512x512" href="<?= base_url('icons/pwa-512x512.png') . '?v=' . $pwaIconVersion ?>">
<link rel="apple-touch-icon" sizes="180x180" href="<?= base_url('icons/pwa-180x180.png') . '?v=' . $pwaIconVersion ?>">
<link rel="apple-touch-icon-precomposed" sizes="180x180" href="<?= base_url('icons/pwa-180x180.png') . '?v=' . $pwaIconVersion ?>">
<link rel="stylesheet" href="<?= base_url('pwa.css') . '?v=' . $pwaRuntimeVersion ?>">
<script src="<?= base_url('pwa.js') . '?v=' . $pwaRuntimeVersion ?>" defer></script>
