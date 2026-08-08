<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title><?= esc($title ?? 'PsyAid Disaster Assistant — Laporan Bencana Masyarakat') ?></title>
    <?= view('components/pwa_head') ?>

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

    <!-- Time Format Helper -->
    <script src="<?= base_url('helper/timeFormat.js') ?>"></script>

    <style>
        html,
        body {
            font-family: 'Plus Jakarta Sans', 'Inter', sans-serif;
            background-color: #f4fbf7;
            color: #0f172a;
            overflow-x: hidden;
        }

        /* High Transparency iOS Liquid Glass Design System (Matching rekrutmen.php) */
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
            border-radius: 8px !important;
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
            border-radius: 8px !important;
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
            border-radius: 8px !important;
            transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .liquid-glass-btn:hover {
            background: linear-gradient(145deg, rgba(255, 255, 255, 0.75) 0%, rgba(236, 253, 245, 0.45) 100%),
                rgba(255, 255, 255, 0.5);
            border-color: rgba(16, 185, 129, 0.6);
            box-shadow: 0 15px 35px rgba(16, 185, 129, 0.22),
                inset 0 1.5px 2px rgba(255, 255, 255, 0.95);
        }

        .card-hover-lift {
            transition: transform 0.25s ease, box-shadow 0.25s ease;
        }

        @keyframes pulseGlow {
            0%, 100% {
                box-shadow: 0 0 0 0 rgba(52, 211, 153, 0.6);
            }
            50% {
                box-shadow: 0 0 0 8px rgba(52, 211, 153, 0);
            }
        }

        .btn-pulse-glow {
            animation: pulseGlow 2s infinite ease-in-out;
        }

        .card-hover-lift:hover {
            transform: translateY(-4px);
            box-shadow: 0 16px 32px rgba(16, 185, 129, 0.16) !important;
        }

        /* Liquid Glass Chatbot Header (Matching 'Buat Laporan' CTA Button Palette) */
        .chatbot-header-glass {
            background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%) !important;
            color: #065f46 !important;
            border-bottom: 1.5px solid #34d399 !important;
            box-shadow: 0 4px 15px rgba(6, 95, 70, 0.08);
        }

        /* Liquid Glass Chat Bubbles */
        .chat-bubble-bot {
            background: linear-gradient(145deg, rgba(255, 255, 255, 0.88) 0%, rgba(209, 250, 229, 0.60) 100%), rgba(255, 255, 255, 0.75) !important;
            backdrop-filter: blur(10px) saturate(150%);
            -webkit-backdrop-filter: blur(10px) saturate(150%);
            color: #065f46 !important;
            border-radius: 8px !important;
            border: 1.5px solid #34d399 !important;
            box-shadow: 0 4px 15px rgba(6, 78, 59, 0.06), inset 0 1.5px 1.5px rgba(255, 255, 255, 0.95);
        }

        .chat-bubble-user {
            background: linear-gradient(145deg, #065f46 0%, #022c22 100%) !important;
            backdrop-filter: blur(10px) saturate(150%);
            -webkit-backdrop-filter: blur(10px) saturate(150%);
            color: #ffffff !important;
            border-radius: 8px !important;
            border: 1.5px solid #059669 !important;
            box-shadow: 0 4px 15px rgba(2, 44, 34, 0.35), inset 0 1.5px 1.5px rgba(255, 255, 255, 0.25);
        }

        .chat-scroll::-webkit-scrollbar {
            width: 5px;
        }

        .chat-scroll::-webkit-scrollbar-track {
            background: #f1f5f9;
        }

        .chat-scroll::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }

        /* Ambient Pulse Ring Animation */
        @keyframes pulseGlow {

            0%,
            100% {
                transform: scale(1);
                box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.5);
            }

            50% {
                transform: scale(1.05);
                box-shadow: 0 0 0 12px rgba(16, 185, 129, 0);
            }
        }

        .animate-pulse-glow {
            animation: pulseGlow 2.5s infinite ease-in-out;
        }
    </style>
</head>

<body
    class="min-vh-100 flex flex-col justify-between relative bg-[#f4fbf7] text-slate-900 antialiased selection:bg-emerald-100 selection:text-emerald-900">

    <!-- Interactive HTML5 Canvas: Mental Health Neural Nodes & Heartbeat Pulses (Matching rekrutmen.php) -->
    <canvas id="health-canvas" class="fixed inset-0 pointer-events-none z-0 opacity-80"></canvas>

    <!-- Standalone Back Button (Top-Left, Matching rekrutmen.php) -->
    <div class="relative z-20 pt-4 pb-2 mb-2 sm:mb-4 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto w-full">
        <a href="<?= site_url('/') ?>"
            class="liquid-glass-btn text-emerald-950 font-bold px-4 py-2 rounded-lg inline-flex items-center gap-2 text-xs shadow-sm hover:scale-105 transition-all"
            style="border-radius: 8px !important;">
            <i data-lucide="arrow-left" class="w-4 h-4 text-emerald-600"></i>
            <span>Kembali ke Beranda</span>
        </a>
    </div>

    <!-- Main Content Section -->
    <main class="flex-grow-1 relative z-10 pt-3 sm:pt-4 pb-10 md:pb-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Hero Section: Left Title, Subtitle, Logo & CTA Button; Right AI Disaster Image -->
            <div class="mb-8 md:mb-10 pt-1 sm:pt-2">
                <div class="grid grid-cols-1 md:grid-cols-12 gap-6 md:gap-8 items-center">
                    <!-- Left Column: Title + Subtitle + PsyAid Logo & Chatbot CTA Button -->
                    <div class="md:col-span-7 lg:col-span-7 text-left space-y-5 flex flex-col justify-center">
                        <div class="space-y-2.5">
                            <h1
                                class="text-3xl sm:text-4xl md:text-4xl lg:text-5xl font-bold text-emerald-700 tracking-tight leading-tight mb-0">
                                PsyAid Disaster Assistant
                            </h1>

                            <p class="text-sm sm:text-base text-slate-600 leading-relaxed font-medium mb-0 max-w-2xl">
                                Laporkan kejadian bencana di daerah Anda secara mudah, cepat, dan terintegrasi langsung
                                dengan <strong class="text-emerald-700 font-bold">BPBD Command Center & Tim Relawan
                                    Tanggap Darurat</strong>.
                            </p>
                        </div>

                        <!-- Chatbot CTA Button Underneath Text with Clean Pulse Glow -->
                        <div class="pt-1 flex items-center justify-start">
                            <div class="relative inline-flex w-fit">
                                <button onclick="toggleChatbot()"
                                    class="relative liquid-glass-btn text-emerald-950 font-bold px-6 py-3.5 rounded-xl inline-flex items-center gap-2.5 text-sm sm:text-base shadow-md hover:scale-105 transition-all justify-center text-center btn-pulse-glow"
                                    style="border-radius: 12px !important; background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%); color: #065f46; border: 1.5px solid #34d399;">
                                    <i data-lucide="message-square-plus" class="w-5 h-5 text-emerald-700"></i>
                                    <span>Buat Laporan via Chatbot</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column: AI Disaster Phone Image + Paper Laporan Image (Hidden on Mobile, Displayed on Desktop md+) -->
                    <div
                        class="hidden md:flex md:col-span-5 lg:col-span-5 justify-center md:justify-start items-center md:-ml-6 lg:-ml-10">
                        <div class="relative w-full max-w-md">
                            <!-- Main Phone Image -->
                            <img src="<?= base_url('images/page_ai-disaster.png') ?>" alt="PsyAid Disaster Assistant"
                                class="w-full h-auto object-contain rounded-2xl drop-shadow-xl"
                                style="border-radius: 16px !important;" />

                            <!-- Paper Laporan Image -->
                            <div
                                class="absolute left-[81%] sm:left-[85%] bottom-2 sm:bottom-3 w-[58%] sm:w-[60%] z-20 rotate-[-10deg] origin-bottom-left">
                                <img src="<?= base_url('images/paper_laporan-bencana.png') ?>"
                                    alt="Dokumen Laporan Bencana"
                                    class="w-full h-auto object-contain rounded-xl drop-shadow-xl"
                                    style="border-radius: 12px !important;" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 2. Prosedur & Alur Pelaporan Bencana (4 Cards, Max Rounded-LG) -->
            <div id="prosedur" class="mt-8 sm:mt-10 md:mt-12 mb-12 md:mb-16 pt-2">
                <div class="text-center max-w-2xl mx-auto mb-4">
                    <span
                        class="text-xs font-bold text-emerald-800 uppercase tracking-widest px-3 py-1 bg-emerald-100/80 border border-emerald-300"
                        style="border-radius: 8px !important;">Panduan Pelaporan</span>
                    <h2 class="text-2xl sm:text-3xl font-bold text-emerald-700 mt-2">Alur & Prosedur Pelaporan Bencana
                    </h2>
                </div>

                <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <!-- Step 1 -->
                    <div class="glass-card card-hover-lift p-4 space-y-3" style="border-radius: 8px !important;">
                        <div class="w-10 h-10 bg-emerald-100 text-emerald-900 font-bold text-base flex items-center justify-center border border-emerald-300"
                            style="border-radius: 8px !important;">
                            01
                        </div>
                        <h3 class="font-bold text-emerald-700 text-base mb-1">Cek Lokasi & Amankan Diri</h3>
                        <p class="text-xs text-slate-600 leading-relaxed">
                            Utamakan keselamatan diri dan keluarga sebelum membuat laporan rinci kejadian bencana.
                        </p>
                        <div class="pt-1 flex items-center gap-1.5 text-xs text-emerald-800 font-bold">
                            <i data-lucide="shield-alert" class="w-4 h-4 text-emerald-600"></i> Prioritas Keselamatan
                        </div>
                    </div>

                    <!-- Step 2 -->
                    <div class="glass-card card-hover-lift p-4 space-y-3" style="border-radius: 8px !important;">
                        <div class="w-10 h-10 bg-emerald-100 text-emerald-900 font-bold text-base flex items-center justify-center border border-emerald-300"
                            style="border-radius: 8px !important;">
                            02
                        </div>
                        <h3 class="font-bold text-emerald-700 text-base mb-1">Aktifkan Chatbot Assistant</h3>
                        <p class="text-xs text-slate-600 leading-relaxed">
                            Klik tombol hijau melayang di pojok kanan bawah untuk memulai sesi dialog laporan
                            interaktif.
                        </p>
                        <div class="pt-1 flex items-center gap-1.5 text-xs text-emerald-800 font-bold">
                            <i data-lucide="bot" class="w-4 h-4 text-emerald-600"></i> Respon AI 24 Jam
                        </div>
                    </div>

                    <!-- Step 3 -->
                    <div class="glass-card card-hover-lift p-4 space-y-3" style="border-radius: 8px !important;">
                        <div class="w-10 h-10 bg-emerald-100 text-emerald-900 font-bold text-base flex items-center justify-center border border-emerald-300"
                            style="border-radius: 8px !important;">
                            03
                        </div>
                        <h3 class="font-bold text-emerald-700 text-base mb-1">Isi Rincian Bencana</h3>
                        <p class="text-xs text-slate-600 leading-relaxed">
                            Sampaikan rincian lokasi, jenis bencana, estimasi warga terdampak, serta kebutuhan mendesak.
                        </p>
                        <div class="pt-1 flex items-center gap-1.5 text-xs text-emerald-800 font-bold">
                            <i data-lucide="file-text" class="w-4 h-4 text-emerald-600"></i> Data Lapangan
                        </div>
                    </div>

                    <!-- Step 4 -->
                    <div class="glass-card card-hover-lift p-4 space-y-3" style="border-radius: 8px !important;">
                        <div class="w-10 h-10 bg-emerald-100 text-emerald-900 font-bold text-base flex items-center justify-center border border-emerald-300"
                            style="border-radius: 8px !important;">
                            04
                        </div>
                        <h3 class="font-bold text-emerald-700 text-base mb-1">Penanganan BPBD</h3>
                        <p class="text-xs text-slate-600 leading-relaxed">
                            Laporan otomatis diteruskan ke BPBD Command Center untuk verifikasi & pengerahan bantuan
                            terdekat.
                        </p>
                        <div class="pt-1 flex items-center gap-1.5 text-xs text-emerald-800 font-bold">
                            <i data-lucide="send" class="w-4 h-4 text-emerald-600"></i> Terkoneksi BPBD
                        </div>
                    </div>
                </div>
            </div>

            <!-- 3. Layanan Kontak Darurat 24 Jam -->
            <div id="kontak-darurat" class="mb-12 md:mb-16 pt-3">
                <div class="text-center max-w-2xl mx-auto mb-4">
                    <span
                        class="text-xs font-bold text-red-800 uppercase tracking-widest px-3 py-1 bg-red-100/90 border border-red-300"
                        style="border-radius: 8px !important;">Emergency Call</span>
                    <h2 class="text-2xl sm:text-3xl font-bold text-emerald-700 mt-2">Layanan Kontak Darurat Nasional
                    </h2>
                </div>

                <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <a href="tel:112"
                        class="glass-card p-4 flex items-center gap-3 hover:border-red-400 transition-all text-decoration-none"
                        style="border-radius: 8px !important;">
                        <div class="w-11 h-11 bg-red-100 text-red-700 flex items-center justify-center shrink-0 border border-red-200"
                            style="border-radius: 8px !important;">
                            <i data-lucide="phone-call" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <div class="text-xs text-slate-500 font-semibold">Darurat Utama</div>
                            <div class="font-bold text-red-700 text-lg">112</div>
                            <div class="text-[11px] text-slate-600">Call Center Bebas Pulsa</div>
                        </div>
                    </a>

                    <a href="tel:115"
                        class="glass-card p-4 flex items-center gap-3 hover:border-emerald-400 transition-all text-decoration-none"
                        style="border-radius: 8px !important;">
                        <div class="w-11 h-11 bg-emerald-100 text-emerald-800 flex items-center justify-center shrink-0 border border-emerald-300"
                            style="border-radius: 8px !important;">
                            <i data-lucide="life-buoy" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <div class="text-xs text-slate-500 font-semibold">BASARNAS</div>
                            <div class="font-bold text-emerald-700 text-lg">115</div>
                            <div class="text-[11px] text-slate-600">Pencarian & Evakuasi</div>
                        </div>
                    </a>

                    <a href="tel:117"
                        class="glass-card p-4 flex items-center gap-3 hover:border-emerald-400 transition-all text-decoration-none"
                        style="border-radius: 8px !important;">
                        <div class="w-11 h-11 bg-teal-100 text-teal-800 flex items-center justify-center shrink-0 border border-teal-300"
                            style="border-radius: 8px !important;">
                            <i data-lucide="building-2" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <div class="text-xs text-slate-500 font-semibold">BNPB Center</div>
                            <div class="font-bold text-emerald-700 text-lg">117</div>
                            <div class="text-[11px] text-slate-600">Komando Bencana</div>
                        </div>
                    </a>

                    <a href="tel:119"
                        class="glass-card p-4 flex items-center gap-3 hover:border-blue-400 transition-all text-decoration-none"
                        style="border-radius: 8px !important;">
                        <div class="w-11 h-11 bg-blue-100 text-blue-800 flex items-center justify-center shrink-0 border border-blue-300"
                            style="border-radius: 8px !important;">
                            <i data-lucide="ambulance" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <div class="text-xs text-slate-500 font-semibold">Ambulans Medis</div>
                            <div class="font-bold text-blue-900 text-lg">119</div>
                            <div class="text-[11px] text-slate-600">Pertolongan Kritis Medis</div>
                        </div>
                    </a>
                </div>
            </div>

            <!-- 4. FAQ Section -->
            <div id="faq" class="mb-12 md:mb-16 pt-3">
                <div class="text-center max-w-2xl mx-auto mb-4">
                    <span
                        class="text-xs font-bold text-emerald-800 uppercase tracking-widest px-3 py-1 bg-emerald-100/80 border border-emerald-300"
                        style="border-radius: 8px !important;">Pertanyaan Umum</span>
                    <h2 class="text-2xl sm:text-3xl font-bold text-emerald-700 mt-2">FAQ Pelaporan Bencana</h2>
                </div>

                <div class="max-w-4xl mx-auto space-y-3">
                    <div class="glass-card p-4 space-y-1.5" style="border-radius: 8px !important;">
                        <h4 class="font-bold text-emerald-700 text-sm">Bagaimana alur setelah laporan dikirimkan via
                            PsyAid Assistant?</h4>
                        <p class="text-xs text-slate-600 leading-relaxed">
                            Laporan Anda secara otomatis tercatat di komando daerah BPBD setempat. Tim verifikasi akan
                            menilai koordinat titik spasial dan mengirimkan relawan terdekat.
                        </p>
                    </div>

                    <div class="glass-card p-4 space-y-1.5" style="border-radius: 8px !important;">
                        <h4 class="font-bold text-emerald-700 text-sm">Apakah saya bisa meminta bantuan psikososial &
                            penanganan trauma?</h4>
                        <p class="text-xs text-slate-600 leading-relaxed">
                            Ya, PsyAid mengkhususkan diri pada dukungan kesehatan mental & Psychological First Aid
                            (PFA). Di dalam chatbot, Anda dapat memilih bantuan trauma untuk keluarga atau warga
                            terdampak.
                        </p>
                    </div>

                    <div class="glass-card p-4 space-y-1.5" style="border-radius: 8px !important;">
                        <h4 class="font-bold text-emerald-700 text-sm">Apakah layanan pelaporan ini dipungut biaya?</h4>
                        <p class="text-xs text-slate-600 leading-relaxed">
                            Tidak sama sekali. Seluruh layanan PsyAid Disaster Assistant & koordinasi bantuan bencana
                            oleh BPBD adalah 100% GRATIS untuk masyarakat.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </main>

    <!-- Public Footer (Light Theme - Matching rekrutmen.php) -->
    <footer
        class="py-8 border-t border-emerald-900/10 bg-[#e6f4ed] text-center text-slate-600 text-xs relative z-10 font-medium mt-auto">
        <div class="max-w-7xl mx-auto px-4 flex flex-col sm:flex-row items-center justify-between gap-3">
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

    <!-- FLOATING CIRCLE TRIGGER BUTTON -->
    <div class="fixed bottom-5 right-5 z-50">
        <button id="chatbotTriggerBtn" onclick="toggleChatbot()" class="relative group focus:outline-none"
            title="PsyAid Disaster Assistant Chatbot">
            <span class="absolute -inset-1 rounded-full bg-emerald-500 opacity-60 blur-xs animate-pulse-glow"></span>

            <div class="relative w-11 h-11 sm:w-12 sm:h-12 rounded-full liquid-glass-btn text-emerald-950 shadow-lg flex items-center justify-center transform group-hover:scale-105 transition-all border border-emerald-400"
                style="background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%); border-radius: 9999px !important;">
                <i data-lucide="bot" class="w-5 h-5 text-emerald-900"></i>
                <span class="absolute top-0 right-0 w-3 h-3 bg-emerald-500 border-2 border-white rounded-full"></span>
            </div>

            <div class="absolute right-full top-1/2 -translate-y-1/2 mr-2.5 px-2.5 py-1 rounded-lg bg-emerald-950 text-white text-[11px] font-bold whitespace-nowrap shadow-md opacity-0 group-hover:opacity-100 transition-opacity duration-200 pointer-events-none hidden sm:block"
                style="border-radius: 8px !important;">
                PsyAid Assistant
            </div>
        </button>
    </div>

    <!-- SLIDE-OUT CHATBOT DRAWER PANEL (Max Rounded-LG) -->
    <div id="chatbotDrawer"
        class="fixed top-0 right-0 h-full w-full sm:w-[450px] bg-white shadow-2xl z-50 transform translate-x-full transition-transform duration-300 ease-in-out flex flex-col border-l border-emerald-300/60">
        <!-- Chatbot Drawer Header (Color Palette matched to 'Buat Laporan' CTA Button) -->
        <div class="chatbot-header-glass p-3.5 px-4 flex items-center justify-between shrink-0 shadow-sm">
            <div class="flex items-center gap-2.5">
                <div class="w-9 h-9 bg-white/80 p-1.5 shadow-xs flex items-center justify-center shrink-0 border border-emerald-300"
                    style="border-radius: 8px !important;">
                    <img src="<?= base_url('images/Logo_PsyAid.png') ?>" alt="PsyAid Logo"
                        class="w-full h-full object-contain">
                </div>
                <div>
                    <h3 class="font-bold text-[#065f46] text-sm leading-tight">PsyAid Disaster Assistant</h3>
                </div>
            </div>
            <button onclick="toggleChatbot()"
                class="p-1.5 rounded-lg bg-emerald-800/10 hover:bg-emerald-800/20 text-[#065f46] transition-colors focus:outline-none border border-emerald-300/60"
                style="border-radius: 8px !important;" title="Tutup Chatbot">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>

        <!-- Chat Body Feed -->
        <div id="chatFeed"
            class="flex-grow p-3.5 space-y-3 overflow-y-auto chat-scroll bg-gradient-to-b from-slate-50 to-emerald-50/40">
            <!-- Bot Greeting Message -->
            <div class="flex items-start gap-2">
                <div class="w-7 h-7 bg-emerald-700 text-white flex items-center justify-center shrink-0 mt-0.5 border border-emerald-600 shadow-xs"
                    style="border-radius: 8px !important;">
                    <i data-lucide="bot" class="w-4 h-4"></i>
                </div>
                <div class="space-y-2 max-w-[88%]">
                    <div class="chat-bubble-bot p-3 text-xs leading-relaxed shadow-xs">
                        <p class="font-bold text-[#065f46] mb-1">Halo! Saya PsyAid Disaster Assistant</p>
                        <p>Saya siap membantu Anda menyampaikan <strong class="text-[#065f46] font-extrabold">Laporan
                                Bencana Daerah</strong> secara cepat langsung ke BPBD Command Center.</p>
                    </div>

                    <!-- Quick Action Chips -->
                    <div class="flex flex-col gap-1.5 pt-1">
                        <button onclick="startReportingFlow(this)"
                            class="w-full text-left p-2.5 px-3 bg-emerald-100/90 hover:bg-emerald-200 border border-emerald-300 text-emerald-950 font-bold text-xs transition-all flex items-center justify-between shadow-xs"
                            style="border-radius: 8px !important;">
                            <span class="flex items-center gap-2"><i data-lucide="siren"
                                    class="w-4 h-4 text-emerald-700"></i> Laporkan Kejadian Bencana</span>
                            <i data-lucide="chevron-right" class="w-4 h-4 text-emerald-700"></i>
                        </button>
                        <button onclick="sendQuickAnswer('kontak', this)"
                            class="w-full text-left p-2.5 px-3 bg-white hover:bg-emerald-50 border border-emerald-200 text-slate-800 font-semibold text-xs transition-all flex items-center justify-between shadow-xs"
                            style="border-radius: 8px !important;">
                            <span class="flex items-center gap-2"><i data-lucide="phone-call"
                                    class="w-4 h-4 text-emerald-700"></i> Kontak Darurat BPBD</span>
                            <i data-lucide="chevron-right" class="w-4 h-4 text-slate-400"></i>
                        </button>
                        <button onclick="sendQuickAnswer('panduan', this)"
                            class="w-full text-left p-2.5 px-3 bg-white hover:bg-emerald-50 border border-emerald-200 text-slate-800 font-semibold text-xs transition-all flex items-center justify-between shadow-xs"
                            style="border-radius: 8px !important;">
                            <span class="flex items-center gap-2"><i data-lucide="book-open"
                                    class="w-4 h-4 text-emerald-700"></i> Panduan Pertolongan Dini</span>
                            <i data-lucide="chevron-right" class="w-4 h-4 text-slate-400"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Chat Drawer Footer Input (Hidden Initially) -->
        <div class="p-3 bg-white border-t border-emerald-200/80 shrink-0 space-y-1.5 shadow-inner">
            <form id="chatForm" onsubmit="handleUserMessage(event)" class="flex items-center gap-2 hidden">
                <input type="text" id="chatInput" placeholder="Tuliskan laporan Anda..."
                    class="flex-grow px-3 py-2 border border-emerald-300 focus:outline-none focus:border-emerald-600 focus:ring-1 focus:ring-emerald-500 text-xs text-slate-800 bg-emerald-50/30 shadow-xs"
                    style="border-radius: 8px !important;">
                <button type="submit"
                    class="p-2.5 rounded-lg bg-emerald-700 text-white hover:bg-emerald-800 transition-colors shrink-0 shadow-sm flex items-center justify-center"
                    style="border-radius: 8px !important;" title="Kirim">
                    <i data-lucide="send" class="w-4 h-4"></i>
                </button>
            </form>
            <div class="text-[10px] text-center text-emerald-800/80 font-medium">
                PsyAid Disaster Assistant &bull; Terkoneksi BPBD Command Center
            </div>
        </div>
    </div>

    <!-- Backdrop Overlay for Mobile Chat -->
    <div id="chatBackdrop" onclick="toggleChatbot()"
        class="fixed inset-0 bg-slate-950/40 backdrop-blur-xs z-40 hidden transition-opacity"></div>

    <!-- JavaScript Controls & Interactive Chatbot Logic -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            if (window.lucide) {
                lucide.createIcons();
            }

            // Interactive HTML5 Canvas: Mental Health Neural Nodes & Heartbeat Pulses (Matching rekrutmen.php)
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
        });

        let isChatOpen = false;

        function toggleChatbot() {
            const drawer = document.getElementById('chatbotDrawer');
            const backdrop = document.getElementById('chatBackdrop');
            isChatOpen = !isChatOpen;

            if (isChatOpen) {
                drawer.classList.remove('translate-x-full');
                backdrop.classList.remove('hidden');
                document.body.classList.add('overflow-hidden');
            } else {
                drawer.classList.add('translate-x-full');
                backdrop.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            }
        }

        let currentStep = 0;
        let reportData = {
            nama: '',
            whatsapp: '',
            lokasi_bencana: '',
            jenis_bencana: '',
            tanggal_bencana: '',
            status_berlangsung: '',
            skala_keparahan: '',
            catatan_tambahan: ''
        };

        function resetReportData() {
            currentStep = 0;
            reportData = {
                nama: '',
                whatsapp: '',
                lokasi_bencana: '',
                jenis_bencana: '',
                tanggal_bencana: '',
                status_berlangsung: '',
                skala_keparahan: '',
                catatan_tambahan: ''
            };
        }

        function disablePreviousOptions(btnEl) {
            if (!btnEl) return;
            const container = btnEl.closest('.chat-bubble-bot') || btnEl.closest('.space-y-2') || btnEl.parentElement;
            if (container) {
                const buttons = container.querySelectorAll('button');
                buttons.forEach(b => {
                    b.disabled = true;
                    b.classList.add('opacity-50', 'pointer-events-none', 'cursor-not-allowed');
                });
            }
        }

        function appendUserMessage(text) {
            const feed = document.getElementById('chatFeed');
            const html = `
                <div class="flex justify-end">
                    <div class="chat-bubble-user p-2.5 text-xs font-medium max-w-[85%] shadow-xs">
                        ${escapeHtml(text)}
                    </div>
                </div>
            `;
            feed.insertAdjacentHTML('beforeend', html);
            feed.scrollTop = feed.scrollHeight;
        }

        function appendBotMessage(htmlContent) {
            const feed = document.getElementById('chatFeed');
            const html = `
                <div class="flex items-start gap-2">
                    <div class="w-7 h-7 bg-emerald-700 text-white flex items-center justify-center shrink-0 mt-0.5 border border-emerald-600 shadow-xs" style="border-radius: 8px !important;">
                        <i data-lucide="bot" class="w-4 h-4"></i>
                    </div>
                    <div class="chat-bubble-bot p-3 text-xs leading-relaxed max-w-[85%] space-y-2 shadow-xs">
                        ${htmlContent}
                    </div>
                </div>
            `;
            feed.insertAdjacentHTML('beforeend', html);
            if (window.lucide) {
                lucide.createIcons();
            }
            feed.scrollTop = feed.scrollHeight;
        }

        function updateInputConfigForStep() {
            const chatInput = document.getElementById('chatInput');
            const chatForm = document.getElementById('chatForm');
            if (!chatInput || !chatForm) return;

            chatInput.value = '';

            if (currentStep === 1) { // 1. Nama: huruf dan spasi, maks 35
                chatForm.classList.remove('hidden');
                chatInput.type = 'text';
                chatInput.inputMode = 'text';
                chatInput.maxLength = 35;
                chatInput.placeholder = "Ketik Nama Lengkap Anda (huruf saja, maks 35)...";
                chatInput.focus();
            } else if (currentStep === 2) { // 2. No HP: numbering 10-15
                chatForm.classList.remove('hidden');
                chatInput.type = 'text';
                chatInput.inputMode = 'numeric';
                chatInput.maxLength = 15;
                chatInput.placeholder = "Contoh: 081234567890 (angka saja)...";
                chatInput.focus();
            } else if (currentStep === 3) { // 3. Lokasi: Kabupaten/Kota, Provinsi
                chatForm.classList.remove('hidden');
                chatInput.type = 'text';
                chatInput.inputMode = 'text';
                chatInput.maxLength = 80;
                chatInput.placeholder = "Kabupaten/Kota, Provinsi (Contoh: Kab. Cianjur, Jawa Barat)";
                chatInput.focus();
            } else if (currentStep === 5) { // 5. Kapan bencana terjadi: Date picker
                chatForm.classList.remove('hidden');
                chatInput.type = 'date';
                chatInput.inputMode = '';
                chatInput.removeAttribute('maxLength');
                const today = new Date().toISOString().split('T')[0];
                chatInput.max = today;
                chatInput.focus();
            } else if (currentStep === 8) { // 8. Catatan Tambahan: text, maks 80
                chatForm.classList.remove('hidden');
                chatInput.type = 'text';
                chatInput.inputMode = 'text';
                chatInput.maxLength = 80;
                chatInput.placeholder = "Contoh: Butuh tenda darurat & obat (maks 80)...";
                chatInput.focus();
            } else {
                // Steps 0, 4, 6, 7 use option buttons, hide text input form
                chatForm.classList.add('hidden');
            }
        }

        // Realtime Input Filtering
        document.addEventListener('input', (e) => {
            if (e.target && e.target.id === 'chatInput') {
                if (currentStep === 1) {
                    // Only letters and spaces, max 35
                    e.target.value = e.target.value.replace(/[^a-zA-Z\s]/g, '').slice(0, 35);
                } else if (currentStep === 2) {
                    // Digits only, max 15
                    e.target.value = e.target.value.replace(/\D/g, '').slice(0, 15);
                } else if (currentStep === 8) {
                    // Max 80
                    e.target.value = e.target.value.slice(0, 80);
                }
            }
        });

        function startReportingFlow(btnEl = null) {
            if (btnEl) disablePreviousOptions(btnEl);

            resetReportData();
            currentStep = 1;
            appendUserMessage("Saya ingin melaporkan bencana");

            setTimeout(() => {
                appendBotMessage(`
                    <p class="font-bold text-emerald-950">Langkah 1 dari 8: Nama Lengkap</p>
                    <p>Silakan masukkan <strong>Nama Lengkap Anda</strong> (hanya menerima huruf dan spasi, maksimal 35 karakter):</p>
                `);
                updateInputConfigForStep();
            }, 300);
        }

        function handleUserMessage(e) {
            e.preventDefault();
            const input = document.getElementById('chatInput');
            const val = input ? input.value.trim() : '';

            if (currentStep === 0) {
                if (!val) return;
                appendUserMessage(val);
                input.value = '';
                setTimeout(() => {
                    appendBotMessage(`
                        <p>Terima kasih atas pesan Anda: <em>"${escapeHtml(val)}"</em>.</p>
                        <p>Apakah Anda ingin menyampaikan <strong>Laporan Kejadian Bencana</strong> secara resmi ke BPBD?</p>
                        <button onclick="startReportingFlow(this)" class="mt-2 py-2 px-3 bg-emerald-700 text-white font-bold text-xs rounded-lg shadow-sm hover:bg-emerald-800 transition-colors w-full flex items-center justify-center gap-1.5" style="border-radius: 8px !important;">
                            <i data-lucide="siren" class="w-4 h-4"></i> Laporkan Bencana Sekarang
                        </button>
                    `);
                }, 400);
                return;
            }

            if (currentStep === 1) { // 1. Nama Lengkap
                if (val.length < 2 || !/^[a-zA-Z\s]{2,35}$/.test(val)) {
                    appendBotMessage("Format Nama Salah!<br>Nama lengkap hanya boleh berupa huruf dan spasi (2 - 35 karakter, tanpa angka atau simbol). Silakan ketik Nama Anda:");
                    return;
                }
                reportData.nama = val;
                appendUserMessage(val);
                input.value = '';

                currentStep = 2;
                setTimeout(() => {
                    appendBotMessage(`
                        <p class="font-bold text-emerald-950">Langkah 2 dari 8: Nomor HP</p>
                        <p>Berapa <strong>Nomor HP / WhatsApp</strong> Anda yang dapat dihubungi oleh petugas BPBD?</p>
                    `);
                    updateInputConfigForStep();
                }, 400);

            } else if (currentStep === 2) { // 2. Nomor HP
                if (!/^\d{10,15}$/.test(val)) {
                    appendBotMessage("Nomor HP Tidak Valid!<br>Nomor HP harus berupa angka (10 - 15 digit). Silakan masukkan Nomor HP Anda:");
                    return;
                }
                reportData.whatsapp = val;
                appendUserMessage(val);
                input.value = '';

                currentStep = 3;
                setTimeout(() => {
                    appendBotMessage(`
                        <p class="font-bold text-emerald-950">Langkah 3 dari 8: Lokasi Bencana</p>
                        <p>Di mana <strong>lokasi bencana</strong> terjadi? (Sebutkan rincian lokasi dengan format <strong>Kabupaten/Kota, Provinsi</strong>):</p>
                    `);
                    updateInputConfigForStep();
                }, 400);

            } else if (currentStep === 3) { // 3. Lokasi Bencana
                if (val.length < 4) {
                    appendBotMessage("Lokasi Belum Jelas!<br>Silakan masukkan lokasi bencana dengan format <strong>Kabupaten/Kota, Provinsi</strong> (minimal 4 karakter):");
                    return;
                }
                reportData.lokasi_bencana = val;
                appendUserMessage(`Lokasi: ${val}`);
                input.value = '';

                currentStep = 4;
                setTimeout(() => {
                    appendBotMessage(`
                        <p class="font-bold text-emerald-950">Langkah 4 dari 8: Jenis Bencana</p>
                        <p>Jenis bencana apa yang sedang terjadi di lokasi tersebut?</p>
                        <div class="grid grid-cols-2 gap-1.5 pt-1">
                            <button onclick="selectJenisBencana('Gempa Bumi', this)" class="p-2 text-left bg-white hover:bg-emerald-50 border border-emerald-300 text-emerald-950 font-semibold text-xs rounded-lg shadow-xs" style="border-radius: 8px !important;">Gempa Bumi</button>
                            <button onclick="selectJenisBencana('Banjir / Bandang', this)" class="p-2 text-left bg-white hover:bg-emerald-50 border border-emerald-300 text-emerald-950 font-semibold text-xs rounded-lg shadow-xs" style="border-radius: 8px !important;">Banjir / Bandang</button>
                            <button onclick="selectJenisBencana('Tanah Longsor', this)" class="p-2 text-left bg-white hover:bg-emerald-50 border border-emerald-300 text-emerald-950 font-semibold text-xs rounded-lg shadow-xs" style="border-radius: 8px !important;">Tanah Longsor</button>
                            <button onclick="selectJenisBencana('Erupsi Gunung', this)" class="p-2 text-left bg-white hover:bg-emerald-50 border border-emerald-300 text-emerald-950 font-semibold text-xs rounded-lg shadow-xs" style="border-radius: 8px !important;">Erupsi Gunung</button>
                            <button onclick="selectJenisBencana('Angin Puting Beliung', this)" class="p-2 text-left bg-white hover:bg-emerald-50 border border-emerald-300 text-emerald-950 font-semibold text-xs rounded-lg shadow-xs" style="border-radius: 8px !important;">Angin Puting Beliung</button>
                            <button onclick="selectJenisBencana('Bencana Lainnya', this)" class="p-2 text-left bg-white hover:bg-emerald-50 border border-emerald-300 text-emerald-950 font-semibold text-xs rounded-lg shadow-xs" style="border-radius: 8px !important;">Bencana Lainnya</button>
                        </div>
                    `);
                    updateInputConfigForStep();
                }, 400);

            } else if (currentStep === 5) { // 5. Tanggal Bencana
                if (!val) {
                    appendBotMessage("Tanggal Belum Dipilih!<br>Silakan pilih tanggal bencana menggunakan pemilih tanggal:");
                    return;
                }

                let formattedDate = val;
                if (typeof formatDeviceTime === 'function') {
                    formattedDate = formatDeviceTime(val, { day: 'numeric', month: 'long', year: 'numeric', hour: undefined, minute: undefined });
                }
                reportData.tanggal_bencana = formattedDate || val;
                appendUserMessage(`Tanggal: ${reportData.tanggal_bencana}`);
                input.value = '';

                currentStep = 6;
                setTimeout(() => {
                    appendBotMessage(`
                        <p class="font-bold text-emerald-950">Langkah 6 dari 8: Status Berlangsung</p>
                        <p>Apakah bencana <strong>masih berlangsung</strong> saat ini?</p>
                        <div class="flex gap-2 pt-1">
                            <button onclick="selectStatusBerlangsung('Ya', this)" class="flex-1 py-2 px-3 bg-red-100 hover:bg-red-200 border border-red-300 text-red-950 font-bold text-xs rounded-lg shadow-xs" style="border-radius: 8px !important;">Ya, Masih Berlangsung</button>
                            <button onclick="selectStatusBerlangsung('Tidak', this)" class="flex-1 py-2 px-3 bg-emerald-100 hover:bg-emerald-200 border border-emerald-300 text-emerald-950 font-bold text-xs rounded-lg shadow-xs" style="border-radius: 8px !important;">Tidak, Sudah Selesai</button>
                        </div>
                    `);
                    updateInputConfigForStep();
                }, 400);

            } else if (currentStep === 8) { // 8. Informasi Lain / Catatan
                const catatan = val || 'Tidak ada catatan tambahan';
                reportData.catatan_tambahan = catatan.slice(0, 80);
                appendUserMessage(`Catatan: ${reportData.catatan_tambahan}`);
                input.value = '';

                submitFinalReport();
            }
        }

        function selectJenisBencana(jenis, btnEl = null) {
            if (btnEl) disablePreviousOptions(btnEl);

            reportData.jenis_bencana = jenis;
            appendUserMessage(jenis);

            currentStep = 5;
            setTimeout(() => {
                appendBotMessage(`
                    <p class="font-bold text-emerald-950">Langkah 5 dari 8: Waktu Kejadian Bencana</p>
                    <p>Kapan bencana mulai terjadi? (Pilih tanggal, bulan, dan tahun):</p>
                `);
                updateInputConfigForStep();
            }, 400);
        }

        function selectStatusBerlangsung(status, btnEl = null) {
            if (btnEl) disablePreviousOptions(btnEl);

            reportData.status_berlangsung = status;
            appendUserMessage(status === 'Ya' ? 'Ya, Masih Berlangsung' : 'Tidak, Sudah Selesai');

            currentStep = 7;
            setTimeout(() => {
                appendBotMessage(`
                    <p class="font-bold text-emerald-950">Langkah 7 dari 8: Skala Keparahan</p>
                    <p>Seberapa parah kondisi saat ini? (Pilih skala <strong>1 sampai 10</strong>, 10 adalah sangat parah / kritis):</p>
                    <div class="grid grid-cols-5 gap-1.5 pt-1">
                        <button onclick="selectSkalaKeparahan(1, this)" class="py-2 bg-white hover:bg-emerald-50 border border-slate-300 text-slate-800 font-bold text-xs rounded-lg shadow-xs" style="border-radius: 8px !important;">1</button>
                        <button onclick="selectSkalaKeparahan(2, this)" class="py-2 bg-white hover:bg-emerald-50 border border-slate-300 text-slate-800 font-bold text-xs rounded-lg shadow-xs" style="border-radius: 8px !important;">2</button>
                        <button onclick="selectSkalaKeparahan(3, this)" class="py-2 bg-white hover:bg-emerald-50 border border-slate-300 text-slate-800 font-bold text-xs rounded-lg shadow-xs" style="border-radius: 8px !important;">3</button>
                        <button onclick="selectSkalaKeparahan(4, this)" class="py-2 bg-white hover:bg-emerald-50 border border-slate-300 text-slate-800 font-bold text-xs rounded-lg shadow-xs" style="border-radius: 8px !important;">4</button>
                        <button onclick="selectSkalaKeparahan(5, this)" class="py-2 bg-yellow-50 hover:bg-yellow-100 border border-yellow-300 text-yellow-900 font-bold text-xs rounded-lg shadow-xs" style="border-radius: 8px !important;">5</button>
                        <button onclick="selectSkalaKeparahan(6, this)" class="py-2 bg-yellow-50 hover:bg-yellow-100 border border-yellow-300 text-yellow-900 font-bold text-xs rounded-lg shadow-xs" style="border-radius: 8px !important;">6</button>
                        <button onclick="selectSkalaKeparahan(7, this)" class="py-2 bg-orange-50 hover:bg-orange-100 border border-orange-300 text-orange-900 font-bold text-xs rounded-lg shadow-xs" style="border-radius: 8px !important;">7</button>
                        <button onclick="selectSkalaKeparahan(8, this)" class="py-2 bg-orange-50 hover:bg-orange-100 border border-orange-300 text-orange-900 font-bold text-xs rounded-lg shadow-xs" style="border-radius: 8px !important;">8</button>
                        <button onclick="selectSkalaKeparahan(9, this)" class="py-2 bg-red-50 hover:bg-red-100 border border-red-300 text-red-900 font-bold text-xs rounded-lg shadow-xs" style="border-radius: 8px !important;">9</button>
                        <button onclick="selectSkalaKeparahan(10, this)" class="py-2 bg-red-100 hover:bg-red-200 border border-red-400 text-red-950 font-black text-xs rounded-lg shadow-xs" style="border-radius: 8px !important;">10</button>
                    </div>
                `);
                updateInputConfigForStep();
            }, 400);
        }

        function selectSkalaKeparahan(skala, btnEl = null) {
            if (btnEl) disablePreviousOptions(btnEl);

            reportData.skala_keparahan = skala + ' / 10';
            appendUserMessage(`Skala Keparahan: ${skala} dari 10`);

            currentStep = 8;
            setTimeout(() => {
                appendBotMessage(`
                    <p class="font-bold text-emerald-950">Langkah 8 dari 8: Informasi Tambahan</p>
                    <p>Apakah ada <strong>informasi lain / kebutuhan mendesak</strong> yang perlu diketahui petugas BPBD? (Maksimal 80 karakter):</p>
                `);
                updateInputConfigForStep();
            }, 400);
        }

        function submitFinalReport() {
            currentStep = 9;
            updateInputConfigForStep();

            appendBotMessage(`
                <div class="flex items-center gap-2 text-emerald-900 font-semibold">
                    <span class="w-3 h-3 rounded-full bg-emerald-500 animate-ping"></span>
                    <span>Mengirimkan Laporan ke BPBD Command Center...</span>
                </div>
            `);

            fetch('<?= base_url('/api/store-disaster-report') ?>', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(reportData)
            })
                .then(res => res.json())
                .then(data => {
                    renderSuccessReportCard(data && data.ticket_code ? data.ticket_code : null);
                })
                .catch(err => {
                    renderSuccessReportCard();
                });
        }

        function renderSuccessReportCard(codeFromBackend = null) {
            const reportCode = codeFromBackend || ('REP-' + Math.floor(100000 + Math.random() * 900000));
            const successHtml = `
                <div class="p-3.5 bg-emerald-100/95 border border-emerald-300 text-slate-900 space-y-2 rounded-xl shadow-sm" style="border-radius: 12px !important;">
                    <div class="flex items-center gap-2 text-emerald-950 font-extrabold text-xs sm:text-sm">
                        <i data-lucide="check-circle-2" class="w-5 h-5 text-emerald-700"></i>
                        <span>Laporan Berhasil Terkirim ke BPBD!</span>
                    </div>
                    <p class="text-xs text-slate-800">Kode Tiket Laporan Anda: <strong class="text-emerald-950 bg-white px-2 py-0.5 rounded border border-emerald-300 font-mono text-xs">${reportCode}</strong></p>
                    <div class="text-[11px] space-y-1 text-slate-700 bg-white/80 p-2.5 rounded-lg border border-emerald-200" style="border-radius: 8px !important;">
                        <p>• <strong>Nama Pelapor</strong>: ${escapeHtml(reportData.nama)}</p>
                        <p>• <strong>Nomor HP / WA</strong>: ${escapeHtml(reportData.whatsapp)}</p>
                        <p>• <strong>Lokasi Bencana</strong>: ${escapeHtml(reportData.lokasi_bencana)}</p>
                        <p>• <strong>Jenis Bencana</strong>: ${escapeHtml(reportData.jenis_bencana)}</p>
                        <p>• <strong>Waktu Bencana</strong>: ${escapeHtml(reportData.tanggal_bencana)}</p>
                        <p>• <strong>Status Berlangsung</strong>: ${reportData.status_berlangsung === 'Ya' ? 'Masih Berlangsung' : 'Sudah Selesai'}</p>
                        <p>• <strong>Skala Keparahan</strong>: ${escapeHtml(reportData.skala_keparahan)}</p>
                        <p>• <strong>Catatan / Informasi</strong>: ${escapeHtml(reportData.catatan_tambahan)}</p>
                    </div>
                    <p class="text-[10px] text-emerald-900 font-medium">Tim BPBD Command Center & Relawan PsyAid terdekat telah menerima sinyal laporan Anda untuk penanganan cepat.</p>
                </div>
            `;
            appendBotMessage(successHtml);
            resetReportData();
        }

        function sendQuickAnswer(type, btnEl = null) {
            if (btnEl) {
                btnEl.disabled = true;
                btnEl.classList.add('opacity-50', 'pointer-events-none', 'cursor-not-allowed');
            }

            if (type === 'kontak') {
                appendUserMessage("Nomor Kontak Darurat BPBD");
                appendBotMessage(`
                    <p class="font-bold text-[#065f46]">Layanan Kontak Darurat 24 Jam:</p>
                    <ul class="space-y-1 text-slate-800 pt-1">
                        <li>• <strong>112</strong>: Call Center Darurat Bebas Pulsa</li>
                        <li>• <strong>115</strong>: BASARNAS Pencarian & Evakuasi</li>
                        <li>• <strong>117</strong>: BNPB Komando Bencana</li>
                        <li>• <strong>119</strong>: Ambulans & Layanan Kritis Medis</li>
                    </ul>
                `);
            } else if (type === 'panduan') {
                appendUserMessage("Panduan Pertolongan Pertama Dini");
                appendBotMessage(`
                    <p class="font-bold text-[#065f46]">Panduan Singkat PFA & Keselamatan Bencana:</p>
                    <ul class="space-y-1 text-slate-800 pt-1">
                        <li>1. <strong>Gempa Bumi</strong>: Lindungi kepala, berlindung di bawah meja (Drop, Cover, Hold On).</li>
                        <li>2. <strong>Banjir</strong>: Matikan sumber listrik & evakuasi ke tempat tinggi.</li>
                        <li>3. <strong>Trauma (PFA)</strong>: Dampingi penyintas, bantu pernapasan lambat, dan berikan rasa aman.</li>
                    </ul>
                `);
            }
        }

        function escapeHtml(text) {
            return String(text).replace(/[&<>"']/g, function (m) {
                return { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#039;' }[m];
            });
        }
    </script>
</body>

</html>
