<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

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

    <!-- Tailwind CSS 3.4 CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Lucide Icons CDN -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- Motion / Framer Animation Library CDN -->
    <script src="https://cdn.jsdelivr.net/npm/motion@10.16.2/dist/motion.js"></script>

    <style>
        html,
        body {
            font-family: 'Plus Jakarta Sans', 'Inter', sans-serif;
            background-color: #f4fbf7;
            color: #0f172a;
            overflow-x: hidden;
        }

        /* High Transparency iOS Liquid Glass Design System */
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
            border-radius: 0.75rem;
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .glass-card::after,
        .liquid-glass-card::after {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: inherit;
            padding: 1px;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.9), rgba(16, 185, 129, 0.25));
            -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            -webkit-mask-composite: xor;
            mask-composite: exclude;
            pointer-events: none;
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
            border-radius: 0.75rem;
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
            border-radius: 0.75rem;
            transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .liquid-glass-btn:hover {
            background: linear-gradient(145deg, rgba(255, 255, 255, 0.75) 0%, rgba(236, 253, 245, 0.45) 100%),
                rgba(255, 255, 255, 0.5);
            border-color: rgba(16, 185, 129, 0.6);
            box-shadow: 0 15px 35px rgba(16, 185, 129, 0.22),
                inset 0 1.5px 2px rgba(255, 255, 255, 0.95);
        }

        /* iOS Liquid Glass Sheen on Hover */
        .glass-card:hover {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.65) 0%, rgba(209, 250, 229, 0.35) 100%),
                rgba(255, 255, 255, 0.45);
            border-color: rgba(16, 185, 129, 0.55);
            box-shadow: 0 20px 45px rgba(16, 185, 129, 0.18),
                inset 0 1.5px 2px rgba(255, 255, 255, 0.95);
        }

        /* Heartbeat Pulse Line Animation */
        @keyframes pulseGlow {

            0%,
            100% {
                opacity: 0.4;
                transform: scale(1);
            }

            50% {
                opacity: 0.9;
                transform: scale(1.08);
            }
        }

        .animate-pulse-glow {
            animation: pulseGlow 4s infinite ease-in-out;
        }

        /* Interactive Canvas Container for Smooth Zoom & Left Shift */
        #interactive-health-bg {
            will-change: transform, opacity;
            transition: transform 0.1s linear, opacity 0.1s linear;
            transform-origin: center center;
        }
    </style>
</head>

<body class="bg-[#f4fbf7] text-slate-900 antialiased selection:bg-emerald-500 selection:text-white">

    <!-- Interactive Mental Health Background (Canvas + Neural Nodes - Light Mode) -->
    <div id="interactive-health-bg" class="fixed inset-0 pointer-events-none z-0 overflow-hidden">
        <canvas id="health-canvas" class="w-full h-full block opacity-90"></canvas>

        <!-- Ambient Glowing Mental Health Orbs (Light Mode Tints) -->
        <div
            class="absolute -top-32 -left-32 w-[450px] h-[450px] bg-emerald-300/30 rounded-full blur-[140px] animate-pulse-glow">
        </div>
        <div class="absolute top-1/2 -right-40 w-[550px] h-[550px] bg-teal-300/25 rounded-full blur-[160px] animate-pulse-glow"
            style="animation-delay: 2s;"></div>
        <div class="absolute -bottom-40 left-1/4 w-[600px] h-[600px] bg-green-300/30 rounded-full blur-[180px] animate-pulse-glow"
            style="animation-delay: 1s;"></div>
    </div>

    <!-- Fixed Navbar (Transparent Header: Small Circle Logo Left, Desktop Nav Center, CTA Right) -->
    <nav
        class="fixed top-0 left-0 right-0 z-50 flex items-center justify-between px-4 sm:px-8 md:px-12 py-4 bg-transparent border-none transition-all">

        <!-- Far Left: Small Circular PsyAid Logo (Only Logo) -->
        <a href="<?= site_url('/') ?>"
            class="w-10 h-10 rounded-full flex items-center justify-center transition-transform hover:scale-105">
            <img src="<?= base_url('images/Logo_PsyAid.png') ?>" alt="PsyAid Logo"
                class="w-full h-full object-contain drop-shadow-md" />
        </a>

        <!-- Center: Desktop Navigation -->
        <div class="hidden lg:flex items-center gap-1 glass-pill rounded-xl px-6 py-1.5 shadow-sm">
            <a href="#hero"
                class="text-xs font-bold px-4 py-2 text-emerald-950 hover:text-emerald-600 transition-colors">Beranda</a>
            <a href="#features"
                class="text-xs font-semibold px-4 py-2 text-slate-700 hover:text-emerald-700 transition-colors">Stakeholder
                &amp;
                Fitur</a>
            <a href="#tech"
                class="text-xs font-semibold px-4 py-2 text-slate-700 hover:text-emerald-700 transition-colors">AI &amp;
                ICD-11 ITQ</a>
            <a href="#creators"
                class="text-xs font-semibold px-4 py-2 text-slate-700 hover:text-emerald-700 transition-colors">Creators</a>
            <a href="<?= site_url('/laporan-masyarakat') ?>"
                class="text-xs font-semibold px-4 py-2 text-slate-700 hover:text-emerald-700 transition-colors">Laporkan
                Bencana</a>
        </div>

        <!-- Far Right: Action Buttons -->
        <div class="flex items-center gap-3">
            <?php if (!empty($isLoggedIn)): ?>
                <a href="<?= site_url($role === 'bpbd_admin' ? '/bpbd/dashboard' : ($role === 'psikolog' ? '/psikolog/dashboard' : '/relawan/posko/' . ($poskoId ?? 1))) ?>"
                    class="flex items-center gap-2 text-xs font-bold liquid-glass-btn text-emerald-950 px-5 py-2.5 rounded-xl shadow-sm">
                    <i data-lucide="layout-dashboard" class="w-4 h-4"></i>
                    Buka Dashboard
                </a>
            <?php else: ?>
                <a href="<?= site_url('/login') ?>"
                    class="flex items-center gap-2 text-xs font-bold liquid-glass-btn text-emerald-950 px-5 py-2.5 rounded-xl shadow-sm">
                    <i data-lucide="log-in" class="w-4 h-4"></i>
                    Masuk System
                </a>
            <?php endif; ?>

            <!-- Mobile Menu Button -->
            <button id="mobile-menu-btn" class="lg:hidden p-2 rounded-xl liquid-glass-btn text-emerald-950"
                aria-label="Toggle Navigation">
                <i data-lucide="menu" id="menu-icon-open" class="w-5 h-5"></i>
                <i data-lucide="x" id="menu-icon-close" class="w-5 h-5 hidden"></i>
            </button>
        </div>
    </nav>

    <!-- Mobile Drawer (Clean Floating PsyAid Light Green Frosted Card) -->
    <div id="mobile-drawer"
        class="fixed inset-x-4 top-[72px] sm:left-auto sm:right-6 sm:w-80 z-50 rounded-2xl hidden transition-all flex-col p-5 gap-1.5 lg:hidden shadow-2xl overflow-hidden animate-fadeInDown"
        style="background: linear-gradient(135deg, rgba(255, 255, 255, 0.98) 0%, rgba(236, 253, 245, 0.98) 100%); backdrop-filter: blur(20px) saturate(180%); -webkit-backdrop-filter: blur(20px) saturate(180%); border: 1.5px solid #a7f3d0; box-shadow: 0 16px 40px -4px rgba(16, 185, 129, 0.18);">
        <a href="#hero"
            class="mobile-link text-sm font-semibold text-emerald-950 py-2.5 px-3.5 rounded-xl hover:bg-emerald-100/60 hover:text-emerald-700 transition-colors block">Beranda</a>
        <a href="#features"
            class="mobile-link text-sm font-semibold text-emerald-950 py-2.5 px-3.5 rounded-xl hover:bg-emerald-100/60 hover:text-emerald-700 transition-colors block">Stakeholder
            &amp; Fitur</a>
        <a href="#tech"
            class="mobile-link text-sm font-semibold text-emerald-950 py-2.5 px-3.5 rounded-xl hover:bg-emerald-100/60 hover:text-emerald-700 transition-colors block">AI
            &amp; ICD-11 ITQ</a>
        <a href="#creators"
            class="mobile-link text-sm font-semibold text-emerald-950 py-2.5 px-3.5 rounded-xl hover:bg-emerald-100/60 hover:text-emerald-700 transition-colors block">Creators</a>
        <a href="<?= site_url('/laporan-masyarakat') ?>"
            class="mobile-link text-sm font-semibold text-emerald-950 py-2.5 px-3.5 rounded-xl hover:bg-emerald-100/60 hover:text-emerald-700 transition-colors block">Laporkan
            Bencana</a>

        <div class="pt-2 border-t border-emerald-200/60 mt-1">
            <?php if (!empty($isLoggedIn)): ?>
                <a href="<?= site_url($role === 'bpbd_admin' ? '/bpbd/dashboard' : ($role === 'psikolog' ? '/psikolog/dashboard' : '/relawan/posko/' . ($poskoId ?? 1))) ?>"
                    class="w-full text-center font-bold text-xs sm:text-sm py-2.5 px-4 rounded-xl shadow-sm block transition-all hover:scale-[1.01]"
                    style="background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%); color: #065f46; border: 1.5px solid #34d399;">
                    Buka Dashboard
                </a>
            <?php else: ?>
                <a href="<?= site_url('/login') ?>"
                    class="w-full text-center font-bold text-xs sm:text-sm py-2.5 px-4 rounded-xl shadow-sm block transition-all hover:scale-[1.01]"
                    style="background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%); color: #065f46; border: 1.5px solid #34d399;">
                    Masuk Ke System
                </a>
            <?php endif; ?>
        </div>
    </div>

    <!-- Main Content -->
    <main class="relative z-10">

        <!-- Hero Section (Fits 100vh Viewport) -->
        <section id="hero"
            class="relative min-h-screen pt-20 pb-8 px-4 sm:px-6 md:px-12 flex flex-col items-center justify-center text-center">

            <!-- Full Circular PsyAid Logo Above Title -->
            <div
                class="mb-3 sm:mb-4 w-20 h-20 sm:w-24 sm:h-24 md:w-28 md:h-28 rounded-full flex items-center justify-center transition-transform hover:scale-105">
                <img src="<?= base_url('images/Logo_PsyAid.png') ?>" alt="PsyAid Logo"
                    class="w-full h-full object-contain drop-shadow-md" />
            </div>

            <!-- Title with Typewriter Effect -->
            <h1
                class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold tracking-tight max-w-5xl leading-[1.08] text-emerald-700 flex items-center justify-center gap-1 min-h-[1em]">
                <span id="typewriter-title"></span><span id="cursor-title"
                    class="inline-block w-1 sm:w-2 h-[0.8em] bg-emerald-600 animate-pulse"></span>
            </h1>

            <p
                class="mt-4 text-slate-600 text-sm sm:text-base md:text-lg max-w-2xl leading-relaxed font-medium min-h-[3.2em]">
                <span id="typewriter-desc"></span><span id="cursor-desc"
                    class="inline-block w-0.5 sm:w-1 h-[1em] bg-emerald-600 animate-pulse hidden"></span>
            </p>

            <!-- CTA Buttons -->
            <div class="mt-6 flex items-center justify-center gap-4 flex-wrap">
                <a href="<?= site_url('/laporan-masyarakat') ?>"
                    class="liquid-glass-btn text-emerald-950 font-bold px-6 py-3 rounded-xl flex items-center gap-2.5 text-xs sm:text-sm shadow-sm">
                    <i data-lucide="siren" class="w-4 h-4 sm:w-5 sm:h-5 text-emerald-600"></i>
                    Laporkan Bencana
                </a>
                <a href="<?= site_url('/login') ?>"
                    class="liquid-glass-btn text-emerald-950 font-bold px-6 py-3 rounded-xl flex items-center gap-2.5 text-xs sm:text-sm shadow-sm">
                    <i data-lucide="sparkles" class="w-4 h-4 sm:w-5 sm:h-5 text-emerald-600"></i>
                    Masuk System
                </a>
            </div>

            <!-- Mental Health Live KPI Indicators (Fits Perfectly on Initial Screen) -->
            <div class="mt-8 sm:mt-10 grid grid-cols-2 md:grid-cols-4 gap-3.5 max-w-4xl w-full">
                <div class="glass-card p-3.5 sm:p-4 rounded-xl text-center border border-emerald-500/30 shadow-sm">
                    <span class="text-xl sm:text-2xl font-extrabold text-emerald-700 block mb-0.5">3 Level</span>
                    <span class="text-[11px] sm:text-xs text-slate-600 font-semibold">BPBD, Posko &amp; Klinisi</span>
                </div>
                <div class="glass-card p-3.5 sm:p-4 rounded-xl text-center border border-emerald-500/30 shadow-sm">
                    <span class="text-xl sm:text-2xl font-extrabold text-teal-700 block mb-0.5">ICD-11 ITQ</span>
                    <span class="text-[11px] sm:text-xs text-slate-600 font-semibold">PTSD &amp; CPTSD Assessor</span>
                </div>
                <div class="glass-card p-3.5 sm:p-4 rounded-xl text-center border border-emerald-500/30 shadow-sm">
                    <span class="text-xl sm:text-2xl font-extrabold text-emerald-700 block mb-0.5">Gemini AI</span>
                    <span class="text-[11px] sm:text-xs text-slate-600 font-semibold">Clinical RAG Engine</span>
                </div>
                <div class="glass-card p-3.5 sm:p-4 rounded-xl text-center border border-emerald-500/30 shadow-sm">
                    <span class="text-xl sm:text-2xl font-extrabold text-teal-700 block mb-0.5">Real-Time</span>
                    <span class="text-[11px] sm:text-xs text-slate-600 font-semibold">High Risk Crisis Alerts</span>
                </div>
            </div>
        </section>

        <!-- Stakeholders & Features Section (Light Mode) -->
        <section id="features" class="py-24 px-4 sm:px-8 md:px-12 max-w-7xl mx-auto border-t border-emerald-900/10">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-xs uppercase font-bold tracking-widest text-emerald-700 mb-3">Ekosistem PsyAid</h2>
                <h3 class="text-3xl sm:text-4xl font-extrabold text-slate-900">Alur Kolaborasi Tanggap Krisis Trauma
                </h3>
                <p class="mt-4 text-slate-600 text-sm sm:text-base leading-relaxed">
                    Sinkronisasi data cepat antara posko pengungsian, psikolog klinis, dan komando bencana daerah.
                </p>
            </div>

            <!-- Stakeholder Cards Grid with Curved Connecting Flow Arrows -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 relative">

                <!-- Curved Connecting Arrow: Card 1 (BPBD) -> Card 2 (Relawan) -->
                <div
                    class="hidden md:flex absolute top-10 left-[31.5%] -translate-x-1/2 z-20 items-center justify-center pointer-events-none">
                    <svg class="w-24 h-12 text-emerald-600 drop-shadow-sm" viewBox="0 0 100 40" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M 10 32 C 35 8, 65 8, 90 26" stroke="currentColor" stroke-width="2.5"
                            stroke-dasharray="5 3" stroke-linecap="round" />
                        <path d="M 82 16 L 92 28 L 78 28" fill="currentColor" />
                    </svg>
                </div>

                <!-- Curved Connecting Arrow: Card 2 (Relawan) -> Card 3 (Psikolog) -->
                <div
                    class="hidden md:flex absolute top-10 left-[64.5%] -translate-x-1/2 z-20 items-center justify-center pointer-events-none">
                    <svg class="w-24 h-12 text-teal-600 drop-shadow-sm" viewBox="0 0 100 40" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M 10 32 C 35 8, 65 8, 90 26" stroke="currentColor" stroke-width="2.5"
                            stroke-dasharray="5 3" stroke-linecap="round" />
                        <path d="M 82 16 L 92 28 L 78 28" fill="currentColor" />
                    </svg>
                </div>

                <!-- Card 1: BPBD Command Center -->
                <div
                    class="glass-card rounded-xl p-8 hover:border-emerald-500/50 transition-all duration-300 hover:-translate-y-2 group">
                    <span class="text-xs font-bold text-red-600 uppercase tracking-wider block mb-2">BPBD Admin</span>
                    <h4 class="text-xl font-bold text-slate-900 mb-3">Command Center</h4>
                    <p class="text-slate-600 text-sm leading-relaxed mb-6">
                        Monitoring makro real-time indikator tingkat risiko krisis mental (*High Risk Alert*), filter
                        statistik posko, dan alokasi tim psikolog klinis secara cepat.
                    </p>
                    <ul class="text-xs text-slate-700 space-y-2.5 font-medium">
                        <li class="flex items-center gap-2"><i data-lucide="check-circle-2"
                                class="w-4 h-4 text-emerald-600"></i> Dashboard Agregat Wilayah</li>
                        <li class="flex items-center gap-2"><i data-lucide="check-circle-2"
                                class="w-4 h-4 text-emerald-600"></i> Penentuan Posko Prioritas Utama</li>
                        <li class="flex items-center gap-2"><i data-lucide="check-circle-2"
                                class="w-4 h-4 text-emerald-600"></i> Pemetaan Beban Kerja Psikolog</li>
                    </ul>
                </div>

                <!-- Card 2: Relawan Lapangan -->
                <div
                    class="glass-card rounded-xl p-8 hover:border-emerald-500/50 transition-all duration-300 hover:-translate-y-2 group">
                    <span class="text-xs font-bold text-emerald-700 uppercase tracking-wider block mb-2">Relawan
                        Lapangan</span>
                    <h4 class="text-xl font-bold text-slate-900 mb-3">Posko Pengungsian</h4>
                    <p class="text-slate-600 text-sm leading-relaxed mb-6">
                        Registrasi penyintas di posko pengungsian, skrining observasi krisis (SRQ-20), upload bukti
                        foto/suara/video, serta pemicu deteksi krisis mandiri.
                    </p>
                    <ul class="text-xs text-slate-700 space-y-2.5 font-medium">
                        <li class="flex items-center gap-2"><i data-lucide="check-circle-2"
                                class="w-4 h-4 text-emerald-600"></i> Form Tab Multidimensi Korban</li>
                        <li class="flex items-center gap-2"><i data-lucide="check-circle-2"
                                class="w-4 h-4 text-emerald-600"></i> Upload Media Gejala Lapangan</li>
                        <li class="flex items-center gap-2"><i data-lucide="check-circle-2"
                                class="w-4 h-4 text-emerald-600"></i> Auto Alert Deteksi Risiko Bunuh Diri</li>
                    </ul>
                </div>

                <!-- Card 3: Psikolog Klinis -->
                <div
                    class="glass-card rounded-xl p-8 hover:border-emerald-500/50 transition-all duration-300 hover:-translate-y-2 group">
                    <span class="text-xs font-bold text-teal-700 uppercase tracking-wider block mb-2">Psikolog
                        Klinis</span>
                    <h4 class="text-xl font-bold text-slate-900 mb-3">Clinical Workspace</h4>
                    <p class="text-slate-600 text-sm leading-relaxed mb-6">
                        Clinical Workspace terpadu untuk analisis mendalam instrumen ICD-11 ITQ, rekomendasi intervensi
                        AI Gemini RAG, dan persetujuan tindakan medis.
                    </p>
                    <ul class="text-xs text-slate-700 space-y-2.5 font-medium">
                        <li class="flex items-center gap-2"><i data-lucide="check-circle-2"
                                class="w-4 h-4 text-emerald-600"></i> Instrumen ICD-11 ITQ Assessor</li>
                        <li class="flex items-center gap-2"><i data-lucide="check-circle-2"
                                class="w-4 h-4 text-emerald-600"></i> AI Decision Support RAG Engine</li>
                        <li class="flex items-center gap-2"><i data-lucide="check-circle-2"
                                class="w-4 h-4 text-emerald-600"></i> Pemodelan Grafik PTSD &amp; CPTSD</li>
                    </ul>
                </div>
            </div>
        </section>

        <!-- Technology Section: AI Gemini & ICD-11 ITQ (Light Mode) -->
        <section id="tech" class="py-20 px-4 sm:px-8 md:px-12 max-w-7xl mx-auto">
            <div
                class="glass-card rounded-xl p-8 sm:p-12 relative overflow-hidden border border-emerald-500/30 shadow-lg">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">
                    <div>
                        <div
                            class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-xl bg-emerald-500/15 text-emerald-800 text-xs font-bold mb-4">
                            <i data-lucide="cpu" class="w-4 h-4 text-emerald-700"></i> Integrated AI Clinical Engine
                        </div>
                        <h3 class="text-2xl sm:text-4xl font-extrabold text-slate-900 mb-4">
                            Kombinasi Google Gemini AI &amp; Standar ICD-11 ITQ
                        </h3>
                        <p class="text-slate-600 text-sm sm:text-base leading-relaxed mb-6">
                            Menyatukan baku ilmiah <strong>ICD-11 International Trauma Questionnaire</strong> dengan
                            daya analisis
                            spasial &amp; naratif <strong>Google Gemini AI</strong> untuk mempercepat klasifikasi trauma
                            penyintas
                            pasca bencana.
                        </p>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="p-4 rounded-xl glass-card border border-emerald-500/30 shadow-sm">
                                <h4 class="text-emerald-700 font-bold text-lg mb-1">ICD-11 ITQ</h4>
                                <p class="text-xs text-slate-600 font-medium">Assessor Baku PTSD &amp; CPTSD</p>
                            </div>
                            <div class="p-4 rounded-xl glass-card border border-emerald-500/30 shadow-sm">
                                <h4 class="text-teal-700 font-bold text-lg mb-1">Gemini AI</h4>
                                <p class="text-xs text-slate-600 font-medium">Rekomendasi Intervensi Psikologis</p>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-center items-center relative">
                        <div
                            class="w-64 h-64 sm:w-72 sm:h-72 rounded-2xl glass-card border border-emerald-500/30 flex items-center justify-center p-2 text-center shadow-lg relative overflow-hidden group">

                            <!-- Mental Health Brain & Head Profile Illustration Component (Centered) -->
                            <div class="w-full h-full flex items-center justify-center">
                                <svg class="w-full h-full text-emerald-600 drop-shadow-md overflow-visible"
                                    viewBox="0 0 240 240" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <defs>
                                        <!-- Emerald Glow Filter -->
                                        <filter id="brain-glow" x="-20%" y="-20%" width="140%" height="140%">
                                            <feGaussianBlur stdDeviation="2.5" result="blur" />
                                            <feComposite in="SourceGraphic" in2="blur" operator="over" />
                                        </filter>
                                        <!-- Gradient Fill for Head Silhouette -->
                                        <linearGradient id="head-grad" x1="0%" y1="0%" x2="100%" y2="100%">
                                            <stop offset="0%" stop-color="rgba(16, 185, 129, 0.15)" />
                                            <stop offset="100%" stop-color="rgba(5, 150, 105, 0.05)" />
                                        </linearGradient>
                                    </defs>

                                    <!-- Anatomically Precise Human Head Profile Silhouette (Centered Facing Right) -->
                                    <path d="M 120 30
                                             C 168 30 200 55 198 90
                                             C 196 98 216 108 212 118
                                             C 206 122 196 124 198 130
                                             C 202 134 198 142 192 146
                                             C 184 154 168 165 146 165
                                             C 126 165 102 176 92 195
                                             L 45 195
                                             C 45 160 42 135 42 110
                                             C 42 70 65 30 120 30 Z" fill="url(#head-grad)" stroke="#059669"
                                        stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" />

                                    <!-- Organic Brain Container Outline (Upper Head Cavity) -->
                                    <path d="M 75 75
                                             C 75 48, 110 42, 142 42
                                             C 172 42, 185 58, 185 82
                                             C 185 106, 160 120, 138 118
                                             C 118 118, 108 132, 94 125
                                             C 78 116, 75 96, 75 75 Z" fill="rgba(255, 255, 255, 0.65)"
                                        stroke="#10b981" stroke-width="2" stroke-dasharray="4 2" />

                                    <!-- Intricate Brain Gyri & Sulci Fold Loops (Reference Art Style) -->
                                    <g stroke="#047857" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                        fill="none" opacity="0.9" filter="url(#brain-glow)">
                                        <path d="M 85 62 Q 100 52, 118 64 T 148 58 T 172 65" />
                                        <path d="M 80 75 Q 98 66, 114 78 T 146 72 T 178 80" />
                                        <path d="M 82 88 Q 102 80, 118 92 T 150 85 T 180 94" />
                                        <path d="M 86 100 Q 106 92, 124 104 T 154 98 T 175 106" />
                                        <path d="M 92 112 Q 112 105, 130 115 T 158 110" />
                                        <!-- Cerebellum Folds -->
                                        <path d="M 82 110 Q 90 120, 102 116 T 112 122" />
                                        <path d="M 85 120 Q 94 126, 106 123" />
                                    </g>

                                    <!-- Animated Pulsating Synaptic Nodes -->
                                    <circle cx="118" cy="64" r="3.5" fill="#10b981" class="animate-ping" />
                                    <circle cx="118" cy="64" r="2.5" fill="#047857" />

                                    <circle cx="150" cy="85" r="3.5" fill="#14b8a6" class="animate-ping"
                                        style="animation-delay: 0.5s;" />
                                    <circle cx="150" cy="85" r="2.5" fill="#0f766e" />

                                    <circle cx="130" cy="104" r="4" fill="#10b981" class="animate-pulse"
                                        style="animation-duration: 1.5s;" />
                                    <circle cx="130" cy="104" r="2.5" fill="#047857" />

                                    <circle cx="168" cy="98" r="3.5" fill="#34d399" class="animate-ping"
                                        style="animation-delay: 1s;" />
                                    <circle cx="168" cy="98" r="2.5" fill="#059669" />

                                    <circle cx="102" cy="116" r="3.5" fill="#10b981" class="animate-pulse"
                                        style="animation-delay: 0.7s;" />
                                    <circle cx="102" cy="116" r="2" fill="#047857" />

                                    <!-- Neural Synapse Flow Rays -->
                                    <path d="M 118 64 L 150 85 L 168 98 L 130 104 L 102 116 L 118 64" stroke="#34d399"
                                        stroke-width="1.2" stroke-dasharray="3 3" opacity="0.8" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CREATORS SECTION: 3 Large Horizontal Photo Cards (Light Mode) -->
        <section id="creators"
            class="py-28 px-4 sm:px-8 md:px-12 max-w-7xl mx-auto border-t border-emerald-900/10 relative z-10">

            <div class="text-center max-w-3xl mx-auto mb-16">
                <div
                    class="inline-flex items-center gap-2 px-4 py-1.5 rounded-xl bg-emerald-500/15 text-emerald-800 text-xs font-bold mb-4">
                    <i data-lucide="sparkles" class="w-4 h-4 text-emerald-700"></i> System Creators
                </div>
                <h2 class="text-3xl sm:text-5xl font-extrabold text-slate-900 tracking-tight">
                    Creators System PsyAid
                </h2>
            </div>

            <!-- Horizontal Grid of 3 Large Photo Cards (Light Liquid Glass) -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8 items-center">

                <!-- Creator Photo Card 1 -->
                <div
                    class="glass-card rounded-xl overflow-hidden p-2.5 border border-white hover:border-emerald-500/60 transition-all duration-500 hover:scale-[1.03] group shadow-xl flex flex-col items-center">
                    <div
                        class="relative w-full h-[450px] sm:h-[500px] md:h-[540px] lg:h-[580px] rounded-lg overflow-hidden bg-slate-100">
                        <img src="<?= base_url('images/creator1.jpeg') ?>" alt="Clara Angelita Karunia Dewi"
                            class="w-full h-full object-cover rounded-lg filter brightness-95 group-hover:brightness-105 transition-all duration-500" />
                    </div>
                    <div class="pt-3.5 pb-1 px-2 text-center w-full">
                        <h3
                            class="font-bold text-emerald-700 text-sm sm:text-base tracking-tight group-hover:text-emerald-700 transition-colors">
                            Clara Angelita Karunia Dewi
                        </h3>
                    </div>
                </div>

                <!-- Creator Photo Card 2 -->
                <div
                    class="glass-card rounded-xl overflow-hidden p-2.5 border border-white hover:border-emerald-500/60 transition-all duration-500 hover:scale-[1.03] group shadow-xl flex flex-col items-center">
                    <div
                        class="relative w-full h-[450px] sm:h-[500px] md:h-[540px] lg:h-[580px] rounded-lg overflow-hidden bg-slate-100">
                        <img src="<?= base_url('images/creator2.jpeg') ?>" alt="Joshua Andrean Mulyadinata"
                            class="w-full h-full object-cover rounded-lg filter brightness-95 group-hover:brightness-105 transition-all duration-500" />
                    </div>
                    <div class="pt-3.5 pb-1 px-2 text-center w-full">
                        <h3
                            class="font-bold text-emerald-700 text-sm sm:text-base tracking-tight group-hover:text-emerald-700 transition-colors">
                            Joshua Andrean Mulyadinata
                        </h3>
                    </div>
                </div>

                <!-- Creator Photo Card 3 -->
                <div
                    class="glass-card rounded-xl overflow-hidden p-2.5 border border-white hover:border-emerald-500/60 transition-all duration-500 hover:scale-[1.03] group shadow-xl flex flex-col items-center">
                    <div
                        class="relative w-full h-[450px] sm:h-[500px] md:h-[540px] lg:h-[580px] rounded-lg overflow-hidden bg-slate-100">
                        <img src="<?= base_url('images/creator3.jpeg') ?>" alt="Rafael Evan Kristanto"
                            class="w-full h-full object-cover rounded-lg filter brightness-95 group-hover:brightness-105 transition-all duration-500" />
                    </div>
                    <div class="pt-3.5 pb-1 px-2 text-center w-full">
                        <h3
                            class="font-bold text-emerald-700 text-sm sm:text-base tracking-tight group-hover:text-emerald-700 transition-colors">
                            Rafael Evan Kristanto
                        </h3>
                    </div>
                </div>

            </div>
        </section>

    </main>

    <!-- Footer (Light Theme) -->
    <footer
        class="py-10 border-t border-emerald-900/10 bg-[#e6f4ed] text-center text-slate-600 text-xs relative z-10 font-medium">
        <div class="max-w-7xl mx-auto px-4 flex flex-col sm:flex-row items-center justify-between gap-4">
            <div class="flex items-center gap-2">
                <img src="<?= base_url('images/Logo_PsyAid.png') ?>" alt="PsyAid Logo" class="w-6 h-6 object-contain" />
                <span class="font-bold text-emerald-950">PsyAid</span>
                <span>- Disaster Mental Health Command Center</span>
            </div>
            <div class="flex items-center gap-4 flex-wrap justify-center">
                <a href="<?= site_url('/laporan-masyarakat') ?>"
                    class="text-slate-600 hover:text-emerald-700 font-semibold transition-colors">
                    Laporkan Bencana
                </a>
                <span class="text-slate-400">•</span>
                <a href="<?= site_url('/rekrutmen-relawan') ?>"
                    class="text-slate-600 hover:text-emerald-700 font-semibold transition-colors">
                    Rekrutmen Relawan
                </a>
                <span class="text-slate-400">•</span>
                <span>&copy; <?= date('Y') ?> PsyAid. All rights reserved.</span>
            </div>
        </div>
    </footer>

    <!-- Floating Bouncing Popup Widget: Rekrutmen Relawan (iOS Liquid Glass Theme) -->
    <div id="volunteer-popup-widget"
        class="fixed bottom-5 right-5 sm:bottom-6 sm:right-6 z-50 animate-bounce transition-all duration-300">
        <div
            class="relative liquid-glass-card border-2 border-emerald-500/60 shadow-2xl rounded-2xl p-4 sm:p-4.5 max-w-[280px] sm:max-w-xs flex flex-col gap-3 text-left">
            <!-- Close Button -->
            <button id="close-volunteer-popup" type="button" aria-label="Tutup Popup"
                class="absolute -top-2.5 -right-2.5 w-7 h-7 bg-emerald-950 hover:bg-slate-900 text-white rounded-full flex items-center justify-center text-xs shadow-md transition-transform hover:scale-110">
                <i data-lucide="x" class="w-4 h-4"></i>
            </button>

            <!-- Popup Header & Icon -->
            <div class="flex items-center gap-2.5">
                <div
                    class="w-9 h-9 rounded-xl bg-emerald-500/15 border border-emerald-500/30 text-emerald-700 flex items-center justify-center flex-shrink-0 shadow-sm">
                    <i data-lucide="heart-handshake" class="w-5 h-5 text-emerald-600"></i>
                </div>
                <div>
                    <h4 class="text-xs sm:text-sm font-bold text-emerald-950 leading-snug">
                        Ambil Peran Jadi Relawan Sekarang
                    </h4>
                </div>
            </div>

            <!-- CTA Button Link with Liquid Glass Styling -->
            <a href="<?= site_url('/rekrutmen-relawan') ?>"
                class="w-full liquid-glass-btn text-emerald-950 font-bold text-xs py-2.5 px-4 rounded-xl shadow-md flex items-center justify-center gap-2 transition-all hover:scale-[1.02]">
                <span>Jadilah Relawan Sekarang</span>
            </a>
        </div>
    </div>

    <!-- Interactive Scripts: Lucide Icons, Light Mode Canvas Mental Health Node Animation, Framer Motion Scroll Trigger -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Initialize Lucide icons
            if (window.lucide) {
                lucide.createIcons();
            }

            // Close Volunteer Popup Widget
            const popupWidget = document.getElementById('volunteer-popup-widget');
            const closeBtn = document.getElementById('close-volunteer-popup');
            closeBtn?.addEventListener('click', () => {
                if (popupWidget) {
                    popupWidget.style.display = 'none';
                }
            });

            // Mobile menu toggle
            const menuBtn = document.getElementById('mobile-menu-btn');
            const drawer = document.getElementById('mobile-drawer');
            const iconOpen = document.getElementById('menu-icon-open');
            const iconClose = document.getElementById('menu-icon-close');
            const mobileLinks = document.querySelectorAll('.mobile-link');

            let drawerOpen = false;
            menuBtn?.addEventListener('click', () => {
                drawerOpen = !drawerOpen;
                if (drawerOpen) {
                    drawer.classList.remove('hidden');
                    drawer.classList.add('flex');
                    iconOpen.classList.add('hidden');
                    iconClose.classList.remove('hidden');
                } else {
                    drawer.classList.add('hidden');
                    drawer.classList.remove('flex');
                    iconOpen.classList.remove('hidden');
                    iconClose.classList.add('hidden');
                }
            });

            mobileLinks.forEach(link => {
                link.addEventListener('click', () => {
                    drawerOpen = false;
                    drawer.classList.add('hidden');
                    drawer.classList.remove('flex');
                    iconOpen.classList.remove('hidden');
                    iconClose.classList.add('hidden');
                });
            });

            // 1. Interactive HTML5 Canvas: Mental Health Neural Nodes & Heartbeat Pulses (Light Mode Colors)
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

                // Generate Nodes (Mental Health Neural Network)
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

                let pulseLineX = 0;

                function draw() {
                    ctx.clearRect(0, 0, width, height);

                    // Draw connecting synaptic lines (High visibility in Light Mode)
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

                    // Update & draw nodes
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

                    // Heartbeat Pulse Wave Effect
                    pulseLineX = (pulseLineX + 2) % (width + 300);
                    const gradient = ctx.createLinearGradient(pulseLineX - 300, 0, pulseLineX, 0);
                    gradient.addColorStop(0, 'rgba(16, 185, 129, 0)');
                    gradient.addColorStop(0.5, 'rgba(5, 150, 105, 0.12)');
                    gradient.addColorStop(1, 'rgba(16, 185, 129, 0)');

                    ctx.fillStyle = gradient;
                    ctx.fillRect(0, 0, width, height);

                    requestAnimationFrame(draw);
                }

                draw();
            })();

            // 2. Framer Motion Scroll Trigger: Zoom In Background & Shift To Left
            (function initScrollFramerAnimation() {
                const healthBg = document.getElementById('interactive-health-bg');
                const creatorsSection = document.getElementById('creators');
                if (!healthBg || !creatorsSection) return;

                window.addEventListener('scroll', () => {
                    const scrollY = window.scrollY || window.pageYOffset;
                    const creatorsTop = creatorsSection.offsetTop;
                    const maxScroll = Math.max(1, creatorsTop);

                    // Scroll progress (0 to 1) towards Creators section
                    let progress = Math.min(1, Math.max(0, scrollY / (maxScroll * 0.8)));

                    // Calculate Zoom In (scale from 1.0 up to 1.45)
                    const scaleVal = 1 + (progress * 0.45);

                    // Calculate Left Shift (translateX from 0% to -28% on desktop)
                    const isDesktop = window.innerWidth >= 1024;
                    const translateXVal = isDesktop ? (-progress * 28) : (-progress * 10);

                    // Apply Framer-like smooth transform to background
                    healthBg.style.transform = `scale(${scaleVal}) translateX(${translateXVal}%)`;
                });
            })();

            // 3. Typewriter Effect for Title & Description with 4-second Repeat Loop
            (function initTypewriter() {
                const titleEl = document.getElementById('typewriter-title');
                const descEl = document.getElementById('typewriter-desc');
                const titleCursor = document.getElementById('cursor-title');
                const descCursor = document.getElementById('cursor-desc');

                if (!titleEl || !descEl) return;

                const titleText = "PsyAid";
                const descHTML = 'Ekosistem pintar yang menghubungkan <strong class="text-emerald-700">Komando BPBD</strong>, Relawan Lapangan Posko Pengungsian, dan <strong class="text-emerald-700">Psikolog Klinis</strong> berlandaskan kecerdasan <span class="underline decoration-emerald-500 decoration-2 font-semibold text-slate-900">Google Gemini AI</span> &amp; Standar Klinis <span class="underline decoration-teal-500 decoration-2 font-semibold text-slate-900">ICD-11 ITQ</span>.';

                const titleCharDelay = 140;  // Slow title typing speed (140ms per char)
                const descCharDelay = 35;    // Rhythmic description typing speed (35ms per char)
                const repeatHoldTime = 4000; // 4 seconds hold delay after completion before repeat

                function startTypewriterLoop() {
                    titleEl.textContent = '';
                    descEl.innerHTML = '';
                    titleCursor?.classList.remove('hidden');
                    descCursor?.classList.add('hidden');

                    let titleIdx = 0;

                    // Type Title
                    function typeTitleStep() {
                        if (titleIdx < titleText.length) {
                            titleEl.textContent += titleText.charAt(titleIdx);
                            titleIdx++;
                            setTimeout(typeTitleStep, titleCharDelay);
                        } else {
                            // Title finished typing, switch blinking cursor to paragraph
                            titleCursor?.classList.add('hidden');
                            descCursor?.classList.remove('hidden');
                            setTimeout(typeDescStep, 350);
                        }
                    }

                    // Type Description with HTML Tag Parsing
                    let descIdx = 0;
                    let currentHTML = '';

                    function typeDescStep() {
                        if (descIdx < descHTML.length) {
                            if (descHTML[descIdx] === '<') {
                                // Find closing '>' for HTML tag and append whole tag at once
                                const tagEnd = descHTML.indexOf('>', descIdx);
                                if (tagEnd !== -1) {
                                    currentHTML += descHTML.substring(descIdx, tagEnd + 1);
                                    descIdx = tagEnd + 1;
                                    descEl.innerHTML = currentHTML;
                                    setTimeout(typeDescStep, 10);
                                    return;
                                }
                            }

                            // Regular character typing
                            currentHTML += descHTML.charAt(descIdx);
                            descEl.innerHTML = currentHTML;
                            descIdx++;
                            setTimeout(typeDescStep, descCharDelay);
                        } else {
                            // Description typing completed! Hide cursor after brief delay
                            setTimeout(() => {
                                descCursor?.classList.add('hidden');
                            }, 1000);

                            // Hold full text for 4 seconds, then repeat animation
                            setTimeout(() => {
                                startTypewriterLoop();
                            }, repeatHoldTime);
                        }
                    }

                    typeTitleStep();
                }

                startTypewriterLoop();
            })();
        });
    </script>
</body>

</html>