<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Rekrutmen Relawan Posko Bencana - PsyAid') ?></title>

    <!-- Fonts: Plus Jakarta Sans & Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap"
        rel="stylesheet" />

    <!-- Bootstrap 5 CSS & Icons CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- Tailwind CSS 3.4 CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Lucide Icons CDN -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        html,
        body {
            font-family: 'Plus Jakarta Sans', 'Inter', sans-serif;
            background-color: #f4fbf7;
            color: #0f172a;
            overflow-x: hidden;
        }

        /* High Transparency iOS Liquid Glass Design System (for page cards & floating elements) */
        .glass-card,
        .liquid-glass-card {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.40) 0%, rgba(209, 250, 229, 0.18) 100%),
                rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(10px) saturate(150%);
            -webkit-backdrop-filter: blur(10px) saturate(150%);
            border: 1px solid rgba(16, 185, 129, 0.35);
            box-shadow: 0 15px 35px rgba(6, 78, 59, 0.06),
                inset 0 1.5px 1.5px rgba(255, 255, 255, 0.8),
                inset 0 -1px 2px rgba(0, 0, 0, 0.03);
            position: relative;
            border-radius: 0.5rem;
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .glass-pill,
        .liquid-glass-pill {
            background: linear-gradient(180deg, rgba(255, 255, 255, 0.45) 0%, rgba(209, 250, 229, 0.20) 100%),
                rgba(255, 255, 255, 0.30);
            backdrop-filter: blur(10px) saturate(150%);
            -webkit-backdrop-filter: blur(10px) saturate(150%);
            border: 1px solid rgba(16, 185, 129, 0.35);
            box-shadow: 0 10px 25px rgba(6, 78, 59, 0.05),
                inset 0 1.5px 1.5px rgba(255, 255, 255, 0.85);
            border-radius: 0.5rem;
        }

        /* iOS Liquid Glass Button Style */
        .liquid-glass-btn {
            background: linear-gradient(145deg, rgba(255, 255, 255, 0.45) 0%, rgba(209, 250, 229, 0.20) 100%),
                rgba(255, 255, 255, 0.30);
            backdrop-filter: blur(10px) saturate(150%);
            -webkit-backdrop-filter: blur(10px) saturate(150%);
            border: 1px solid rgba(16, 185, 129, 0.4);
            box-shadow: 0 10px 25px rgba(6, 78, 59, 0.06),
                inset 0 1.5px 1.5px rgba(255, 255, 255, 0.85),
                inset 0 -1px 2px rgba(0, 0, 0, 0.03);
            border-radius: 0.5rem;
            transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .liquid-glass-btn:hover {
            background: linear-gradient(145deg, rgba(255, 255, 255, 0.75) 0%, rgba(236, 253, 245, 0.45) 100%),
                rgba(255, 255, 255, 0.5);
            border-color: rgba(16, 185, 129, 0.6);
            box-shadow: 0 15px 35px rgba(16, 185, 129, 0.22),
                inset 0 1.5px 2px rgba(255, 255, 255, 0.95);
        }

        /* Solid Emerald Button for Modal CTAs */
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

        .card-hover-lift {
            transition: transform 0.25s ease, box-shadow 0.25s ease;
        }

        .card-hover-lift:hover {
            transform: translateY(-4px);
            box-shadow: 0 16px 32px rgba(16, 185, 129, 0.16) !important;
        }

        .fs-7 {
            font-size: 0.8rem;
        }

        .fs-8 {
            font-size: 0.725rem;
        }

        /* Chatbot Custom Styles */
        .chat-bubble-bot {
            background-color: #d1fae5;
            color: #022c22;
            border-radius: 1rem 1rem 1rem 0.2rem;
            border: 1px solid #a7f3d0;
        }

        .chat-bubble-user {
            background-color: #047857;
            color: #ffffff;
            border-radius: 1rem 1rem 0.2rem 1rem;
        }

        /* CUSTOM FROSTED DROPDOWN & SEARCH FIELD SYSTEM (MATCHING BPBD POSKO MANAGEMENT) */
        .frost-custom-select-wrapper {
            position: relative;
            z-index: 10;
        }

        .frost-custom-select-wrapper.active-dropdown {
            z-index: 1060 !important;
        }

        .frost-custom-trigger {
            background: #ffffff;
            border: 1.5px solid #cbd5e1;
            border-radius: 8px !important;
            padding: 0.55rem 0.85rem;
            font-size: 0.875rem;
            font-weight: 600;
            color: #0f172a;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            cursor: pointer;
            transition: all 0.2s ease;
            box-shadow: 0 1px 3px rgba(15, 23, 42, 0.04);
            user-select: none;
        }

        .frost-custom-trigger:hover:not(.disabled) {
            border-color: #059669;
            background-color: #f4fbf7;
        }

        .frost-custom-trigger.active {
            border-color: #059669;
            box-shadow: 0 0 0 3.5px rgba(5, 150, 105, 0.18);
            background-color: #ffffff;
        }

        .frost-custom-trigger .chevron-icon {
            color: #059669;
            font-size: 0.9rem;
            transition: transform 0.2s ease;
        }

        .frost-custom-trigger.active .chevron-icon {
            transform: rotate(180deg);
        }

        .frost-custom-menu {
            position: absolute;
            top: calc(100% + 6px);
            left: 0;
            right: 0;
            z-index: 1070 !important;
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(20px) saturate(180%);
            -webkit-backdrop-filter: blur(20px) saturate(180%);
            border: 1px solid rgba(5, 150, 105, 0.3);
            box-shadow: 0 16px 40px -4px rgba(15, 23, 42, 0.18), 0 4px 16px rgba(0, 0, 0, 0.06);
            border-radius: 8px !important;
            max-height: 260px;
            overflow-y: auto;
            padding: 0.35rem;
            display: none;
            animation: fadeInDown 0.15s ease-out;
        }

        .frost-custom-menu.show {
            display: block;
        }

        .frost-custom-option {
            padding: 0.55rem 0.75rem;
            font-size: 0.85rem;
            font-weight: 500;
            color: #1e293b;
            border-radius: 6px !important;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: space-between;
            transition: all 0.15s ease;
        }

        .frost-custom-option:hover {
            background-color: #ecfdf5;
            color: #047857;
            font-weight: 600;
        }

        .frost-custom-option.selected {
            background-color: #059669;
            color: #ffffff;
            font-weight: 600;
        }

        .frost-search-input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
            width: 100%;
        }

        .frost-search-icon-inside {
            position: absolute;
            left: 1rem;
            color: #059669;
            font-size: 1rem;
            pointer-events: none;
        }

        .frost-search-input {
            width: 100%;
            background: #ffffff;
            border: 1.5px solid #cbd5e1;
            border-radius: 8px !important;
            padding: 0.55rem 2.25rem 0.55rem 2.65rem;
            font-size: 0.875rem;
            font-weight: 600;
            color: #0f172a;
            text-align: left;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 1px 3px rgba(15, 23, 42, 0.04);
        }

        .frost-search-input:focus {
            background: #ffffff;
            border-color: #059669;
            box-shadow: 0 0 0 3.5px rgba(5, 150, 105, 0.18);
            outline: none;
        }

        .frost-search-clear-inside {
            position: absolute;
            right: 0.75rem;
            color: #94a3b8;
            font-size: 1rem;
            cursor: pointer;
            background: none;
            border: none;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: color 0.2s ease;
        }

        .frost-search-clear-inside:hover {
            color: #dc2626;
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-6px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body class="min-vh-100 flex flex-col justify-between relative bg-[#f4fbf7]">

    <!-- Interactive HTML5 Canvas: Mental Health Neural Nodes & Heartbeat Pulses -->
    <canvas id="health-canvas" class="fixed inset-0 pointer-events-none z-0 opacity-80"></canvas>

    <!-- Standalone Back Button (Top-Left, No Top Header Bar, No Login Button) -->
    <div class="relative z-20 pt-4 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto w-full">
        <a href="<?= site_url('/') ?>"
            class="liquid-glass-btn text-emerald-950 font-bold px-4 py-2 rounded-lg inline-flex items-center gap-2 text-xs shadow-sm hover:scale-105 transition-all">
            <i data-lucide="arrow-left" class="w-4 h-4 text-emerald-600"></i>
            <span>Kembali ke Beranda</span>
        </a>
    </div>

    <!-- Main Content Section -->
    <main class="flex-grow-1 relative z-10 py-4 py-md-5">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Hero Section: Logo Icon Only (No Text) Above Title -->
            <div class="text-center max-w-3xl mx-auto mb-4 mb-md-5">
                <!-- Circular PsyAid Logo Icon Only -->
                <div
                    class="mb-4 w-20 h-20 sm:w-24 sm:h-24 md:w-28 md:h-28 rounded-full flex items-center justify-center mx-auto transition-transform hover:scale-105">
                    <img src="<?= base_url('images/Logo_PsyAid.png') ?>" alt="PsyAid Logo"
                        class="w-full h-full object-contain drop-shadow-md" />
                </div>

                <span
                    class="inline-flex items-center gap-1.5 bg-emerald-100/90 text-emerald-950 px-3 py-1 rounded-lg text-xs font-bold border border-emerald-300/70 mb-3 shadow-sm">
                    <i data-lucide="shield-check" class="w-4 h-4 text-emerald-600"></i> Informasi Resmi BPBD Command
                    Center
                </span>
                <h1
                    class="text-2xl sm:text-3xl md:text-4xl font-bold text-emerald-950 tracking-tight mb-2 leading-tight">
                    Lowongan Rekrutmen Relawan Posko Bencana
                </h1>
                <p class="text-slate-600 text-sm sm:text-base leading-relaxed mb-0 font-medium">
                    Daftar kebutuhan personel relawan di berbagai posko bencana daerah yang dipublikasikan secara
                    terpusat oleh BPBD untuk dukungan logistik, medis, dan pendampingan psikososial.
                </p>
            </div>

            <!-- Filter & Search Box -->
            <div class="liquid-glass-card border-0 shadow-sm rounded-lg mb-4 p-3.5 p-md-4" style="position: relative; z-index: 100; overflow: visible !important;">
                <form id="landing-filter-form" action="<?= site_url('/rekrutmen-relawan') ?>" method="GET" class="row g-3 align-items-center">
                    <div class="col-12 col-md-5 col-lg-6">
                        <label for="q" class="form-label small fw-bold text-slate-700 mb-1">Cari Posko / Lokasi / Bencana</label>
                        <div class="frost-search-input-wrapper">
                            <i class="bi bi-search frost-search-icon-inside"></i>
                            <input type="text" name="q" id="q" class="frost-search-input"
                                value="<?= esc($searchQuery) ?>" placeholder="Contoh: Cianjur, Gempa, Merapi..." autocomplete="off">
                            <?php if (!empty($searchQuery)): ?>
                                <button type="button" id="btn-clear-search-landing" class="frost-search-clear-inside"
                                    title="Bersihkan Pencarian">
                                    <i class="bi bi-x-circle-fill"></i>
                                </button>
                            <?php else: ?>
                                <button type="button" id="btn-clear-search-landing" class="frost-search-clear-inside d-none"
                                    title="Bersihkan Pencarian">
                                    <i class="bi bi-x-circle-fill"></i>
                                </button>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-12 col-md-4 col-lg-4">
                        <label for="bencana" class="form-label small fw-bold text-slate-700 mb-1">Kategori Bencana</label>
                        <select name="bencana" id="bencana" class="d-none">
                            <option value="">Semua Jenis Bencana</option>
                            <?php foreach ($distinctBencana as $jenis): ?>
                                <option value="<?= esc($jenis) ?>" <?= $selectedBencana === $jenis ? 'selected' : '' ?>>
                                    <?= esc($jenis) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <?php
                            $selectedBencanaText = !empty($selectedBencana) ? $selectedBencana : 'Semua Jenis Bencana';
                        ?>
                        <div class="frost-custom-select-wrapper" id="custom-wrapper-landing-bencana">
                            <div class="frost-custom-trigger" id="trigger-landing-bencana">
                                <span class="trigger-label text-truncate"><?= esc($selectedBencanaText) ?></span>
                                <i class="bi bi-chevron-down chevron-icon"></i>
                            </div>
                            <div class="frost-custom-menu" id="menu-landing-bencana">
                                <div class="frost-custom-option <?= empty($selectedBencana) ? 'selected' : '' ?>" data-value="">
                                    Semua Jenis Bencana
                                </div>
                                <?php foreach ($distinctBencana as $jenis): ?>
                                    <div class="frost-custom-option <?= $selectedBencana === $jenis ? 'selected' : '' ?>"
                                        data-value="<?= esc($jenis) ?>">
                                        <?= esc($jenis) ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-3 col-lg-2 d-flex gap-2 align-self-end">
                        <button type="submit"
                            class="btn liquid-glass-btn text-emerald-950 w-100 fw-bold py-2 rounded-lg shadow-sm d-flex align-items-center justify-content-center gap-2">
                            <i class="bi bi-funnel-fill text-emerald-600"></i> Filter
                        </button>
                        <?php if (!empty($searchQuery) || !empty($selectedBencana)): ?>
                            <a href="<?= site_url('/rekrutmen-relawan') ?>"
                                class="btn btn-light border fw-semibold py-2 px-3 rounded-lg" title="Reset Filter">
                                <i class="bi bi-x-lg"></i>
                            </a>
                        <?php endif; ?>
                    </div>
                </form>
            </div>

            <!-- Recruitment Listings Grid -->
            <div class="row g-3 g-md-4">
                <?php if (empty($recruitmentListings)): ?>
                    <div class="col-12">
                        <div class="liquid-glass-card shadow-sm rounded-lg text-center py-5 px-3">
                            <div class="avatar-lg bg-emerald-100 text-emerald-700 rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center"
                                style="width: 60px; height: 60px;">
                                <i class="bi bi-briefcase fs-3"></i>
                            </div>
                            <h5 class="fw-bold text-slate-800 mb-1">Tidak Ada Lowongan Ditemukan</h5>
                            <p class="text-muted small max-w-md mx-auto mb-3">Tidak ada lowongan relawan posko yang cocok
                                dengan pencarian Anda.</p>
                            <div>
                                <a href="<?= site_url('/rekrutmen-relawan') ?>"
                                    class="liquid-glass-btn text-emerald-950 btn-sm rounded-lg fw-bold px-4 py-2 inline-flex items-center gap-1.5">Tampilkan
                                    Semua Lowongan</a>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <?php foreach ($recruitmentListings as $listing): ?>
                        <div class="col-12 col-md-6 col-xl-4">
                            <div
                                class="liquid-glass-card shadow-sm rounded-lg h-100 overflow-hidden card-hover-lift flex flex-col justify-between">
                                <div
                                    class="p-3.5 border-bottom border-emerald-900/10 d-flex align-items-center justify-content-between">
                                    <span
                                        class="badge bg-danger-subtle text-danger border border-danger-subtle px-2.5 py-1 rounded-lg small fw-bold">
                                        Status: <?= esc($listing['urgency']) ?>
                                    </span>
                                    <span
                                        class="badge bg-emerald-100 text-emerald-950 px-2.5 py-1 rounded-lg small fw-semibold">
                                        <?= esc($listing['jenis_bencana']) ?>
                                    </span>
                                </div>

                                <div class="p-3.5 p-md-4 d-flex flex-column justify-content-between flex-grow-1">
                                    <div>
                                        <h2 class="h6 fw-extrabold text-slate-900 mb-1.5 line-clamp-2">
                                            <?= esc($listing['name']) ?>
                                        </h2>
                                        <div class="text-muted small mb-3 d-flex align-items-center gap-1.5">
                                            <i class="bi bi-geo-alt-fill text-danger fs-6"></i>
                                            <span><?= esc($listing['regency_name'] ?? 'Kabupaten') ?>,
                                                <?= esc($listing['province_name'] ?? 'Indonesia') ?></span>
                                        </div>

                                        <!-- Quota Progress Bar -->
                                        <div class="bg-white/60 p-2.5 rounded-lg mb-3 border border-emerald-100">
                                            <div class="d-flex justify-content-between text-muted fs-8 fw-bold mb-1">
                                                <span>Kuota Relawan</span>
                                                <span class="text-emerald-700"><?= $listing['filled'] ?> /
                                                    <?= $listing['quota'] ?> Personel
                                                    (<?= round(($listing['filled'] / $listing['quota']) * 100) ?>%)</span>
                                            </div>
                                            <div class="progress rounded-lg" style="height: 6px;">
                                                <div class="progress-bar bg-emerald-600" role="progressbar"
                                                    style="width: <?= round(($listing['filled'] / $listing['quota']) * 100) ?>%;"
                                                    aria-valuenow="<?= $listing['filled'] ?>" aria-valuemin="0"
                                                    aria-valuemax="<?= $listing['quota'] ?>"></div>
                                            </div>
                                        </div>

                                        <!-- Requirements Summary -->
                                        <div class="mb-3">
                                            <div class="text-slate-700 fs-8 fw-bold text-uppercase mb-1">Persyaratan Khusus:</div>
                                            <?php 
                                                $reqItems = [];
                                                if (is_array($listing['requirements'])) {
                                                    $reqItems = array_values(array_filter(array_map('trim', $listing['requirements'])));
                                                } else if (!empty($listing['requirements'])) {
                                                    if (strpos($listing['requirements'], "\n") !== false) {
                                                        $reqItems = array_values(array_filter(array_map('trim', explode("\n", $listing['requirements']))));
                                                    } else if (strpos($listing['requirements'], ",") !== false) {
                                                        $reqItems = array_values(array_filter(array_map('trim', explode(",", $listing['requirements']))));
                                                    } else {
                                                        $reqItems = [trim($listing['requirements'])];
                                                    }
                                                }
                                            ?>
                                            <?php if (count($reqItems) > 1): ?>
                                                <ol class="text-muted fs-8 mb-0 ps-3 list-decimal" style="list-style-type: decimal !important;">
                                                    <?php foreach ($reqItems as $req): ?>
                                                        <li class="mb-1"><?= esc($req) ?></li>
                                                    <?php endforeach; ?>
                                                </ol>
                                            <?php elseif (count($reqItems) === 1): ?>
                                                <span class="text-muted fs-8"><?= esc($reqItems[0] ?? '') ?></span>
                                            <?php else: ?>
                                                <div class="text-muted fs-8 fst-italic">Tidak ada persyaratan khusus.</div>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <!-- Action CTA Button -->
                                    <div class="pt-2 border-t border-emerald-900/10 mt-2">
                                        <button type="button"
                                            class="btn liquid-glass-btn text-emerald-950 w-100 py-2 fw-bold rounded-lg shadow-sm d-flex align-items-center justify-content-center gap-2 hover:scale-[1.02]"
                                            data-bs-toggle="modal" data-bs-target="#applyModal<?= $listing['id'] ?>">
                                            <i class="bi bi-telephone-outbound-fill text-emerald-600"></i> Hubungi BPBD &amp;
                                            Daftar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

        </div>
    </main>

    <!-- Modals Placed at Root Level (Solid Opaque White Cards to Prevent Dark Backdrop Bleed) -->
    <?php if (!empty($recruitmentListings)): ?>
        <?php foreach ($recruitmentListings as $listing): ?>
            <div class="modal fade" id="applyModal<?= $listing['id'] ?>" tabindex="-1"
                aria-labelledby="applyModalLabel<?= $listing['id'] ?>" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content bg-white border-0 shadow-2xl rounded-lg overflow-hidden">
                        <div class="modal-header bg-emerald-700 text-white border-0 p-3.5">
                            <h5 class="modal-title h6 fw-bold mb-0 d-flex align-items-center gap-2"
                                id="applyModalLabel<?= $listing['id'] ?>">
                                <i class="bi bi-building-fill-check"></i> Kontak Pendaftaran Relawan BPBD
                            </h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body p-4 text-start bg-white text-slate-900">
                            <h6 class="fw-extrabold text-slate-900 mb-1"><?= esc($listing['name']) ?></h6>
                            <div class="text-muted small mb-3">
                                <i class="bi bi-geo-alt-fill text-danger me-1"></i>
                                <?= esc($listing['regency_name'] ?? 'Kabupaten') ?>,
                                <?= esc($listing['province_name'] ?? 'Indonesia') ?>
                            </div>

                            <div class="bg-emerald-50 border border-emerald-200 p-3 rounded-lg mb-3">
                                <div class="fw-bold text-emerald-950 small mb-1">Status Penugasan &amp; Kontak Resmi:</div>
                                <div class="text-emerald-800 small fw-semibold">
                                    <i class="bi bi-headset me-1 text-emerald-600"></i> <?= esc($listing['contact_person']) ?>
                                </div>
                            </div>

                            <div class="small text-slate-700 mb-3">
                                <strong class="d-block mb-1 text-slate-900">Prosedur Registrasi:</strong>
                                <ol class="ps-3 mb-0 text-slate-600 list-decimal" style="list-style-type: decimal !important;">
                                    <li class="mb-1">Akun relawan dapat didaftarkan langsung oleh Admin BPBD setempat.</li>
                                    <li class="mb-1">Silakan hubungi nomor kontak BPBD Command Center di atas untuk konfirmasi
                                        kehadiran &amp; penugasan posko.</li>
                                    <li>Setelah akun dibuat oleh BPBD, Anda dapat langsung login dengan Nomor WhatsApp Anda.
                                    </li>
                                </ol>
                            </div>
                        </div>
                        <div class="modal-footer bg-slate-50 border-t border-slate-200 p-3">
                            <button type="button"
                                class="btn btn-light border text-slate-700 btn-sm fw-semibold rounded-lg px-3.5 py-2"
                                data-bs-dismiss="modal">Tutup</button>
                            <button type="button"
                                class="btn btn-emerald btn-sm fw-bold rounded-lg d-inline-flex align-items-center gap-1.5 open-chatbot-btn shadow-sm hover:scale-[1.02] px-3.5 py-2"
                                data-posko-name="<?= esc($listing['name']) ?>" data-bs-dismiss="modal">
                                <i class="bi bi-person-plus-fill"></i> Daftar Relawan
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>

    <!-- Interactive Chatbot Assistant Modal (Solid White Card for Crisp Legibility) -->
    <div class="modal fade" id="chatbotModal" tabindex="-1" aria-labelledby="chatbotModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content bg-white border-0 shadow-2xl rounded-lg overflow-hidden">
                <!-- Modal Header / Chatbot Bar -->
                <div class="modal-header bg-emerald-800 text-white border-0 p-3 flex items-center justify-between">
                    <div class="flex items-center gap-2.5">
                        <div
                            class="w-9 h-9 rounded-full bg-emerald-600 text-white flex items-center justify-center font-bold text-sm shadow-inner relative">
                            <i class="bi bi-robot fs-5"></i>
                            <span
                                class="absolute bottom-0 right-0 w-2.5 h-2.5 bg-emerald-400 border-2 border-emerald-800 rounded-full"></span>
                        </div>
                        <div>
                            <h5 class="modal-title h6 fw-bold mb-0 leading-tight">Asisten Relawan BPBD</h5>
                            <span class="text-[10px] text-emerald-200 font-medium">Online • Command Center</span>
                        </div>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>

                <!-- Chat Messages Container -->
                <div id="chat-messages-body"
                    class="modal-body p-3.5 sm:p-4 bg-slate-50 flex flex-col gap-3 overflow-y-auto"
                    style="height: 380px;">
                    <!-- Dynamically populated messages -->
                </div>

                <!-- Choice Action Buttons Container (Step 0) -->
                <div id="chat-choices-container" class="p-3 bg-white border-t border-slate-200 flex flex-col gap-2">
                    <button id="btn-choice-yes" type="button"
                        class="btn btn-emerald text-white fw-bold py-2 rounded-lg text-xs w-100 shadow-sm flex items-center justify-center gap-1.5 hover:scale-[1.01]">
                        <i class="bi bi-check-circle-fill"></i> Benar, Saya Mau Mendaftarkan Diri
                    </button>
                    <button id="btn-choice-no" type="button"
                        class="btn btn-light border text-slate-700 fw-semibold py-2 rounded-lg text-xs w-100 hover:bg-slate-100">
                        <i class="bi bi-x-circle-fill text-slate-400 me-1"></i> Tidak Jadi
                    </button>
                </div>

                <!-- Step Input Form Bar (Hidden initially, shown after user accepts) -->
                <form id="chat-input-form" class="p-3 bg-white border-t border-slate-200 d-none">
                    <div class="input-group">
                        <input type="text" id="chat-user-input"
                            class="form-control text-xs py-2.5 rounded-start-lg border-slate-300 bg-white"
                            placeholder="Ketik jawaban Anda..." autocomplete="off" required>
                        <button type="submit" id="chat-send-btn"
                            class="btn btn-emerald px-4 text-xs font-bold rounded-end-lg d-flex align-items-center gap-1.5 shadow-sm">
                            <span>Kirim</span> <i class="bi bi-send-fill"></i>
                        </button>
                    </div>
                </form>

                <!-- Completion / Closed Footer (Shown when finished/cancelled) -->
                <div id="chat-completed-container" class="p-3 bg-white border-t border-slate-200 d-none">
                    <button type="button" class="btn btn-secondary w-100 py-2 text-xs font-bold rounded-lg shadow-sm"
                        data-bs-dismiss="modal">Tutup Percakapan</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Public Footer (Light Theme) -->
    <footer
        class="py-8 border-t border-emerald-900/10 bg-[#e6f4ed] text-center text-slate-600 text-xs relative z-10 font-medium mt-auto">
        <div class="max-w-7xl mx-auto px-4 flex flex-col sm:flex-row items-center justify-between gap-3">
            <div class="flex items-center gap-2">
                <img src="<?= base_url('images/Logo_PsyAid.png') ?>" alt="PsyAid Logo" class="w-6 h-6 object-contain" />
                <span class="font-bold text-emerald-950">PsyAid</span>
                <span>- Disaster Mental Health Command Center</span>
            </div>
            <div class="flex items-center gap-4 flex-wrap justify-center">
                <a href="<?= site_url('/rekrutmen-relawan') ?>"
                    class="text-slate-600 hover:text-emerald-700 font-semibold transition-colors">
                    Rekrutmen Relawan
                </a>
                <span class="text-slate-400">•</span>
                <span>&copy; <?= date('Y') ?> PsyAid. All rights reserved.</span>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Interactive HTML5 Canvas & Chatbot Assistant Script -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            if (window.lucide) {
                lucide.createIcons();
            }

            // Interactive HTML5 Canvas: Mental Health Neural Nodes & Heartbeat Pulses
            (function initHealthCanvas() {
                const canvas = document.getElementById('health-canvas');
                if (!canvas) return;
                const ctx = canvas.getContext('2d');
                if (!ctx) return;

                let width = canvas.width = window.innerWidth;
                let height = canvas.height = window.innerHeight;

                window.addEventListener('resize', () => {
                    width = canvas.width = window.innerWidth;
                    height = canvas.height = window.innerHeight;
                });

                const nodeCount = Math.min(45, Math.floor(width / 30));
                const nodes = [];
                for (let i = 0; i < nodeCount; i++) {
                    nodes.push({
                        x: Math.random() * width,
                        y: Math.random() * height,
                        vx: (Math.random() - 0.5) * 0.4,
                        vy: (Math.random() - 0.5) * 0.4,
                        radius: Math.random() * 2.5 + 1.5,
                        pulse: Math.random() * Math.PI * 2
                    });
                }

                function draw() {
                    ctx.clearRect(0, 0, width, height);

                    for (let i = 0; i < nodes.length; i++) {
                        for (let j = i + 1; j < nodes.length; j++) {
                            const dx = nodes[i].x - nodes[j].x;
                            const dy = nodes[i].y - nodes[j].y;
                            const dist = Math.sqrt(dx * dx + dy * dy);
                            if (dist < 160) {
                                const alpha = (1 - dist / 160) * 0.35;
                                ctx.strokeStyle = `rgba(5, 150, 105, ${alpha})`;
                                ctx.lineWidth = 1.2;
                                ctx.beginPath();
                                ctx.moveTo(nodes[i].x, nodes[i].y);
                                ctx.lineTo(nodes[j].x, nodes[j].y);
                                ctx.stroke();
                            }
                        }
                    }

                    nodes.forEach(node => {
                        node.x += node.vx;
                        node.y += node.vy;
                        node.pulse += 0.03;

                        if (node.x < 0 || node.x > width) node.vx *= -1;
                        if (node.y < 0 || node.y > height) node.vy *= -1;

                        const currentRadius = node.radius + Math.sin(node.pulse) * 0.8;
                        ctx.fillStyle = 'rgba(5, 150, 105, 0.85)';
                        ctx.shadowBlur = 8;
                        ctx.shadowColor = 'rgba(16, 185, 129, 0.6)';
                        ctx.beginPath();
                        ctx.arc(node.x, node.y, Math.max(0.5, currentRadius), 0, Math.PI * 2);
                        ctx.fill();
                        ctx.shadowBlur = 0;
                    });

                    requestAnimationFrame(draw);
                }

                draw();
            })();

            // -------------------------------------------------------------
            // CHATBOT REGISTRATION ENGINE WITH FORMAT VALIDATION & DATE TYPE
            // -------------------------------------------------------------
            const chatbotModalEl = document.getElementById('chatbotModal');
            const chatbotModal = chatbotModalEl ? new bootstrap.Modal(chatbotModalEl) : null;
            const chatMessagesBody = document.getElementById('chat-messages-body');
            const chatChoicesContainer = document.getElementById('chat-choices-container');
            const chatInputForm = document.getElementById('chat-input-form');
            const chatUserInput = document.getElementById('chat-user-input');
            const chatCompletedContainer = document.getElementById('chat-completed-container');

            const btnChoiceYes = document.getElementById('btn-choice-yes');
            const btnChoiceNo = document.getElementById('btn-choice-no');

            let activePoskoName = '';
            let currentStep = 0; // 0 = Greeting, 1 = NIK, 2 = Nama, 3 = Provinsi, 4 = Tanggal Lahir (DATE), 5 = WA, 6 = Done
            let formData = { nik: '', nama: '', provinsi: '', tgl_lahir: '', whatsapp: '' };

            function formatMarkdown(text) {
                if (!text) return '';
                return text.replace(/\*\*(.*?)\*\*/g, '<strong class="font-bold text-emerald-950">$1</strong>');
            }

            function appendBotBubble(message) {
                const bubble = document.createElement('div');
                bubble.className = 'chat-bubble-bot p-3 text-xs max-w-[85%] shadow-xs whitespace-pre-line';
                bubble.innerHTML = formatMarkdown(message);
                chatMessagesBody.appendChild(bubble);
                chatMessagesBody.scrollTop = chatMessagesBody.scrollHeight;
            }

            function appendUserBubble(message) {
                const bubble = document.createElement('div');
                bubble.className = 'chat-bubble-user p-3 text-xs max-w-[85%] ms-auto shadow-xs font-medium whitespace-pre-line';
                bubble.innerText = message;
                chatMessagesBody.appendChild(bubble);
                chatMessagesBody.scrollTop = chatMessagesBody.scrollHeight;
            }

            // Open Chatbot when clicking "Daftar Relawan"
            document.querySelectorAll('.open-chatbot-btn').forEach(btn => {
                btn.addEventListener('click', (e) => {
                    activePoskoName = btn.getAttribute('data-posko-name') || 'Posko Bencana';
                    initChatConversation();
                    if (chatbotModal) {
                        chatbotModal.show();
                    }
                });
            });

            function updateInputConfigForStep() {
                chatUserInput.value = '';
                if (currentStep === 1) { // NIK
                    chatUserInput.type = 'text';
                    chatUserInput.inputMode = 'numeric';
                    chatUserInput.maxLength = 16;
                    chatUserInput.placeholder = "Ketik 16 Digit NIK Anda (angka saja)...";
                } else if (currentStep === 2) { // Nama
                    chatUserInput.type = 'text';
                    chatUserInput.inputMode = 'text';
                    chatUserInput.removeAttribute('maxLength');
                    chatUserInput.placeholder = "Ketik Nama Lengkap Anda (huruf saja)...";
                } else if (currentStep === 3) { // Provinsi
                    chatUserInput.type = 'text';
                    chatUserInput.inputMode = 'text';
                    chatUserInput.removeAttribute('maxLength');
                    chatUserInput.placeholder = "Ketik Nama Provinsi Domisili...";
                } else if (currentStep === 4) { // Tanggal Lahir -> INPUT DATE TYPE!
                    chatUserInput.type = 'date';
                    chatUserInput.inputMode = '';
                    chatUserInput.removeAttribute('maxLength');
                    const today = new Date().toISOString().split('T')[0];
                    chatUserInput.max = today;
                } else if (currentStep === 5) { // WhatsApp
                    chatUserInput.type = 'text';
                    chatUserInput.inputMode = 'numeric';
                    chatUserInput.maxLength = 15;
                    chatUserInput.placeholder = "Contoh: 081234567890 (angka saja)";
                }
            }

            // Realtime Input Filtering & Restriction
            chatUserInput?.addEventListener('input', (e) => {
                if (currentStep === 1) {
                    // NIK: digits only up to 16
                    e.target.value = e.target.value.replace(/\D/g, '').slice(0, 16);
                } else if (currentStep === 2) {
                    // Nama: letters, spaces, dot, quote only
                    e.target.value = e.target.value.replace(/[^a-zA-Z\s'.]/g, '');
                } else if (currentStep === 3) {
                    // Provinsi: letters and spaces only
                    e.target.value = e.target.value.replace(/[^a-zA-Z\s]/g, '');
                } else if (currentStep === 5) {
                    // WhatsApp: digits only up to 15
                    e.target.value = e.target.value.replace(/\D/g, '').slice(0, 15);
                }
            });

            function initChatConversation() {
                currentStep = 0;
                formData = { nik: '', nama: '', provinsi: '', tgl_lahir: '', whatsapp: '' };
                chatMessagesBody.innerHTML = '';

                chatChoicesContainer.classList.remove('d-none');
                chatInputForm.classList.add('d-none');
                chatCompletedContainer.classList.add('d-none');

                appendBotBubble(`Halo! Selamat datang di Portal Pendaftaran Relawan BPBD 👋\n\nApakah Anda ingin mendaftar sebagai relawan untuk penugasan di **${activePoskoName}**?`);
            }

            // Choice: "Benar, Saya Mau Mendaftarkan Diri"
            btnChoiceYes?.addEventListener('click', () => {
                appendUserBubble("Benar, Saya Mau Mendaftarkan Diri");
                chatChoicesContainer.classList.add('d-none');

                setTimeout(() => {
                    currentStep = 1;
                    updateInputConfigForStep();
                    appendBotBubble("Terima kasih atas kesiapan Anda! 📋\n\n**Langkah 1/5**: Silakan masukkan **NIK (Tepat 16 Digit Angka)** Anda untuk verifikasi data:");
                    chatInputForm.classList.remove('d-none');
                    chatUserInput.focus();
                }, 400);
            });

            // Choice: "Tidak Jadi"
            btnChoiceNo?.addEventListener('click', () => {
                appendUserBubble("Tidak Jadi");
                chatChoicesContainer.classList.add('d-none');

                setTimeout(() => {
                    currentStep = 6;
                    appendBotBubble("Baik, pendaftaran dibatalkan. Terima kasih atas kepedulian Anda terhadap sesama! Sampai jumpa 🙏");
                    chatCompletedContainer.classList.remove('d-none');
                }, 400);
            });

            function validateStepInput(val) {
                if (currentStep === 1) { // NIK
                    if (!/^\d{16}$/.test(val)) {
                        appendBotBubble("⚠️ **Format NIK Salah!**\nNIK harus terdiri dari **tepat 16 digit angka**. Silakan ketik ulang NIK Anda:");
                        return false;
                    }
                } else if (currentStep === 2) { // Nama
                    if (val.length < 3 || !/^[a-zA-Z\s'.]+$/.test(val)) {
                        appendBotBubble("⚠️ **Format Nama Salah!**\nNama lengkap harus berupa huruf (minimal 3 karakter). Silakan masukkan Nama Anda:");
                        return false;
                    }
                } else if (currentStep === 3) { // Provinsi
                    if (val.length < 3 || !/^[a-zA-Z\s]+$/.test(val)) {
                        appendBotBubble("⚠️ **Format Provinsi Salah!**\nSilakan masukkan nama Provinsi yang valid (minimal 3 huruf):");
                        return false;
                    }
                } else if (currentStep === 4) { // Tanggal Lahir (DATE)
                    if (!val) {
                        appendBotBubble("⚠️ **Tanggal Lahir Belum Dipilih!**\nSilakan pilih tanggal lahir Anda menggunakan pemilih tanggal:");
                        return false;
                    }
                } else if (currentStep === 5) { // WA
                    if (!/^\d{10,15}$/.test(val)) {
                        appendBotBubble("⚠️ **Format Nomor WhatsApp Salah!**\nNomor WhatsApp harus terdiri dari 10 - 15 digit angka (contoh: 081234567890). Silakan masukkan ulang:");
                        return false;
                    }
                }
                return true;
            }

            // Handle Input Form Submissions (Steps 1 to 5)
            chatInputForm?.addEventListener('submit', (e) => {
                e.preventDefault();
                const userVal = chatUserInput.value.trim();
                if (!userVal) return;

                if (!validateStepInput(userVal)) {
                    return;
                }

                appendUserBubble(userVal);

                setTimeout(() => {
                    processNextStep(userVal);
                }, 400);
            });

            function processNextStep(inputVal) {
                if (currentStep === 1) {
                    // NIK
                    formData.nik = inputVal;
                    currentStep = 2;
                    updateInputConfigForStep();
                    appendBotBubble("Terima kasih!\n\n**Langkah 2/5**: Silakan tuliskan **Nama Lengkap** Anda sesuai KTP:");
                } else if (currentStep === 2) {
                    // Nama
                    formData.nama = inputVal;
                    currentStep = 3;
                    updateInputConfigForStep();
                    appendBotBubble(`Baik, Salam Kenal kak **${formData.nama}**! 😊\n\n**Langkah 3/5**: Masukkan **Domisili Provinsi** Anda saat ini:`);
                } else if (currentStep === 3) {
                    // Provinsi
                    formData.provinsi = inputVal;
                    currentStep = 4;
                    updateInputConfigForStep();
                    appendBotBubble("Terima kasih.\n\n**Langkah 4/5**: Pilih **Tanggal Lahir** Anda pada kalender berikut:");
                } else if (currentStep === 4) {
                    // Tanggal Lahir
                    formData.tgl_lahir = inputVal;
                    currentStep = 5;
                    updateInputConfigForStep();
                    appendBotBubble("**Langkah Terakhir (5/5)**: Masukkan **Nomor WhatsApp** aktif Anda yang dapat dihubungi BPBD:");
                } else if (currentStep === 5) {
                    // No WA
                    formData.whatsapp = inputVal;
                    currentStep = 6;

                    // Send data to backend API for BPBD Approval
                    const bodyPayload = new FormData();
                    bodyPayload.append('nik', formData.nik);
                    bodyPayload.append('nama', formData.nama);
                    bodyPayload.append('provinsi', formData.provinsi);
                    bodyPayload.append('tgl_lahir', formData.tgl_lahir);
                    bodyPayload.append('whatsapp', formData.whatsapp);
                    bodyPayload.append('posko_name', activePoskoName);

                    fetch('<?= site_url('/api/register-volunteer-request') ?>', {
                        method: 'POST',
                        body: bodyPayload
                    })
                    .then(res => res.json())
                    .then(data => {
                        console.log('Permohonan relawan tersimpan ke BPBD:', data);
                    })
                    .catch(err => {
                        console.error('Error menyimpan permohonan relawan:', err);
                    });

                    // Complete!
                    chatInputForm.classList.add('d-none');
                    chatCompletedContainer.classList.remove('d-none');

                    appendBotBubble(`🎉 **Pendaftaran Relawan Berhasil Terkirim!**\n\nData pendaftaran Anda untuk **${activePoskoName}** telah berhasil dikirimkan ke BPBD Command Center untuk peninjauan (approval).\n\n**Ringkasan Biodata Relawan:**\n• **NIK**: ${formData.nik}\n• **Nama**: ${formData.nama}\n• **Domisili**: ${formData.provinsi}\n• **Tgl Lahir**: ${formData.tgl_lahir}\n• **No WhatsApp**: ${formData.whatsapp}\n\nPetugas BPBD akan melakukan verifikasi & menghubungi nomor WhatsApp Anda setelah akun disetujui.`);
                }
            }

            // -------------------------------------------------------------
            // CUSTOM FROSTED SELECT & SEARCH CLEAR HANDLERS (MATCHING BPBD)
            // -------------------------------------------------------------
            function setupCustomSelectGeneric(wrapperId, triggerId, menuId, nativeId, onChange) {
                const wrapper = document.getElementById(wrapperId);
                const trigger = document.getElementById(triggerId);
                const menu = document.getElementById(menuId);
                const native = document.getElementById(nativeId);

                if (!wrapper || !trigger || !menu || !native) return;

                trigger.addEventListener('click', function (e) {
                    e.stopPropagation();
                    if (trigger.classList.contains('disabled')) return;

                    const isAlreadyShow = menu.classList.contains('show');

                    document.querySelectorAll('.frost-custom-menu').forEach(m => m.classList.remove('show'));
                    document.querySelectorAll('.frost-custom-trigger').forEach(t => t.classList.remove('active'));
                    document.querySelectorAll('.frost-custom-select-wrapper').forEach(w => w.classList.remove('active-dropdown'));

                    if (!isAlreadyShow) {
                        menu.classList.add('show');
                        trigger.classList.add('active');
                        wrapper.classList.add('active-dropdown');
                    }
                });

                menu.addEventListener('click', function (e) {
                    const opt = e.target.closest('.frost-custom-option');
                    if (!opt) return;

                    const val = opt.getAttribute('data-value');
                    const txt = opt.textContent.trim();

                    menu.querySelectorAll('.frost-custom-option').forEach(o => o.classList.remove('selected'));
                    opt.classList.add('selected');

                    trigger.querySelector('.trigger-label').textContent = txt;

                    menu.classList.remove('show');
                    trigger.classList.remove('active');
                    wrapper.classList.remove('active-dropdown');

                    if (native.value !== val) {
                        native.value = val;
                        if (typeof onChange === 'function') {
                            onChange(val, txt);
                        }
                    }
                });
            }

            // Setup Custom Select for Kategori Bencana
            setupCustomSelectGeneric('custom-wrapper-landing-bencana', 'trigger-landing-bencana', 'menu-landing-bencana', 'bencana', function () {
                if (landingFilterForm) landingFilterForm.submit();
            });

            // Close custom dropdowns on click outside
            document.addEventListener('click', function () {
                document.querySelectorAll('.frost-custom-menu').forEach(m => m.classList.remove('show'));
                document.querySelectorAll('.frost-custom-trigger').forEach(t => t.classList.remove('active'));
                document.querySelectorAll('.frost-custom-select-wrapper').forEach(w => w.classList.remove('active-dropdown'));
            });

            // Search Clear Input Button Handler
            const searchInputLanding = document.getElementById('q');
            const clearBtnLanding = document.getElementById('btn-clear-search-landing');
            const landingFilterForm = document.getElementById('landing-filter-form');

            if (searchInputLanding && clearBtnLanding) {
                searchInputLanding.addEventListener('input', function () {
                    if (this.value.trim().length > 0) {
                        clearBtnLanding.classList.remove('d-none');
                    } else {
                        clearBtnLanding.classList.add('d-none');
                    }
                });

                clearBtnLanding.addEventListener('click', function () {
                    searchInputLanding.value = '';
                    clearBtnLanding.classList.add('d-none');
                    if (landingFilterForm) landingFilterForm.submit();
                });
            }
        });
    </script>
</body>

</html>