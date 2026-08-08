<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <title><?= esc($title ?? 'Posko Relawan Belum Tersedia - PsyAid') ?></title>
    <?= view('components/pwa_head') ?>
    <style>
        :root {
            color-scheme: light;
            --forest: #064e3b;
            --emerald: #059669;
            --mint: #d1fae5;
            --mist: #f4fbf7;
            --ink: #0f172a;
            --muted: #526173;
        }
        * { box-sizing: border-box; }
        body {
            margin: 0;
            min-height: 100vh;
            display: grid;
            place-items: center;
            padding: 1.25rem;
            font-family: "Plus Jakarta Sans", Inter, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            color: var(--ink);
            background: radial-gradient(circle at 12% 18%, rgba(16, 185, 129, 0.15), transparent 28rem), var(--mist);
        }
        .card {
            width: min(100%, 38rem);
            padding: clamp(1.5rem, 6vw, 3rem);
            border: 1px solid rgba(5, 150, 105, 0.18);
            border-radius: 1.5rem;
            background: rgba(255, 255, 255, 0.94);
            box-shadow: 0 24px 70px rgba(6, 78, 59, 0.14);
        }
        .brand { display: flex; align-items: center; gap: 0.75rem; color: var(--forest); font-weight: 800; }
        .brand img { width: 2.75rem; height: 2.75rem; border-radius: 50%; }
        h1 { margin: 2rem 0 0.75rem; color: var(--forest); font-size: clamp(1.8rem, 7vw, 2.8rem); line-height: 1.05; }
        p { margin: 0; color: var(--muted); line-height: 1.7; }
        .notice { margin-top: 1.4rem; padding: 1rem; border-radius: 1rem; background: var(--mist); border: 1px solid var(--mint); }
        .actions { display: flex; flex-wrap: wrap; gap: 0.75rem; margin-top: 1.5rem; }
        .action { display: inline-flex; min-height: 2.8rem; align-items: center; justify-content: center; padding: 0.7rem 1rem; border-radius: 0.85rem; text-decoration: none; font-weight: 800; }
        .primary { color: #fff; background: linear-gradient(135deg, var(--forest), #047857); }
        .secondary { color: var(--forest); background: #fff; border: 1px solid rgba(6, 78, 59, 0.2); }
    </style>
</head>
<body>
    <main class="card">
        <div class="brand">
            <img src="<?= base_url('icons/pwa-192x192.png') ?>" alt="">
            <span>PsyAid</span>
        </div>
        <h1>Posko akun belum tersedia.</h1>
        <p>Login Anda berhasil, tetapi akun Relawan ini belum terhubung ke data posko yang dapat dibuka. Kondisi ini bukan masalah koneksi perangkat.</p>
        <p class="notice">Minta Admin BPBD memeriksa penugasan posko akun Anda. Setelah diperbarui, tekan coba lagi.</p>
        <div class="actions">
            <a class="action primary" href="<?= site_url('/relawan/posko-tidak-tersedia') ?>">Coba lagi</a>
            <a class="action secondary" href="<?= site_url('/logout') ?>">Keluar</a>
        </div>
    </main>
</body>
</html>
