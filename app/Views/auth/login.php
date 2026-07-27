<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<!-- Custom Styles following Landing Page Palette & Glassmorphism Theme -->
<style>
    .login-body-bg {
        background-color: #f4fbf7;
        min-height: calc(100vh - 80px);
        position: relative;
    }

    /* Ambient Pulse Animation */
    @keyframes pulseGlow {
        0%, 100% {
            opacity: 0.4;
            transform: scale(1);
        }
        50% {
            opacity: 0.85;
            transform: scale(1.08);
        }
    }

    .animate-pulse-glow {
        animation: pulseGlow 4s infinite ease-in-out;
    }

    .login-glass-card {
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.88) 0%, rgba(236, 253, 245, 0.72) 100%);
        backdrop-filter: blur(16px) saturate(160%);
        -webkit-backdrop-filter: blur(16px) saturate(160%);
        border: 1px solid rgba(16, 185, 129, 0.35);
        box-shadow: 0 20px 40px rgba(6, 78, 59, 0.08),
            inset 0 1.5px 1.5px rgba(255, 255, 255, 0.9);
        border-radius: 0.75rem; /* rounded-xl (maksimal) */
        position: relative;
        z-index: 10;
    }

    /* Unified Input Group Container without Internal Outlines */
    .custom-input-group {
        display: flex;
        align-items: center;
        border: 1px solid #cbd5e1;
        border-radius: 0.375rem; /* rounded-md */
        background-color: #ffffff;
        transition: border-color 0.2s, box-shadow 0.2s;
        overflow: hidden;
    }

    .custom-input-group:focus-within {
        border-color: #10b981;
        box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.2);
    }

    .custom-input-group .input-icon-text {
        padding: 0.6rem 0.2rem 0.6rem 0.85rem;
        color: #64748b;
        background: transparent;
        display: flex;
        align-items: center;
        font-size: 0.9rem;
    }

    .custom-input-group .form-control {
        border: none !important;
        box-shadow: none !important;
        padding: 0.6rem 0.75rem;
        background: transparent;
        color: #0f172a;
        font-size: 0.9rem;
    }

    .custom-input-group .btn-toggle-eye {
        border: none;
        outline: none;
        background: transparent;
        padding: 0.6rem 0.85rem;
        color: #64748b;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: color 0.2s;
        font-size: 0.9rem;
    }

    .custom-input-group .btn-toggle-eye:hover {
        color: #059669;
    }

    .btn-emerald-submit {
        background: linear-gradient(135deg, #059669 0%, #10b981 100%);
        color: #ffffff;
        border: none;
        border-radius: 0.5rem; /* rounded-lg */
        font-weight: 600;
        padding: 0.75rem 1.25rem;
        box-shadow: 0 8px 20px rgba(5, 150, 105, 0.25);
        transition: all 0.3s ease;
    }

    .btn-emerald-submit:hover {
        background: linear-gradient(135deg, #047857 0%, #059669 100%);
        color: #ffffff;
        box-shadow: 0 12px 25px rgba(5, 150, 105, 0.35);
        transform: translateY(-1px);
    }

    .testing-creds-box {
        background-color: rgba(248, 250, 252, 0.85);
        border: 1px solid #e2e8f0;
        border-radius: 0.5rem; /* rounded-lg */
    }
</style>

<div class="login-body-bg d-flex align-items-center justify-content-center py-4 px-3 overflow-hidden">
    <!-- Interactive Mental Health Background (Canvas + Neural Nodes + Ambient Orbs) -->
    <div id="interactive-health-bg" class="position-fixed top-0 start-0 w-100 h-100 pointer-events-none overflow-hidden" style="z-index: 0;">
        <canvas id="health-canvas" class="w-100 h-100 d-block" style="opacity: 0.9;"></canvas>

        <!-- Ambient Glowing Mental Health Orbs -->
        <div class="position-absolute rounded-circle animate-pulse-glow" 
             style="top: -120px; left: -120px; width: 450px; height: 450px; background: rgba(110, 231, 183, 0.3); filter: blur(140px);"></div>
        <div class="position-absolute rounded-circle animate-pulse-glow" 
             style="top: 40%; right: -140px; width: 500px; height: 500px; background: rgba(94, 234, 212, 0.25); filter: blur(150px); animation-delay: 2s;"></div>
        <div class="position-absolute rounded-circle animate-pulse-glow" 
             style="bottom: -140px; left: 20%; width: 550px; height: 550px; background: rgba(134, 239, 172, 0.3); filter: blur(160px); animation-delay: 1s;"></div>
    </div>

    <!-- Main Form Container -->
    <div class="container position-relative" style="max-width: 520px; z-index: 10;">
        <div class="login-glass-card p-4 p-md-5">
            <!-- Header Logo & Title -->
            <div class="text-center mb-4">
                <a href="<?= site_url('/') ?>" class="d-inline-block mb-2">
                    <img src="<?= base_url('images/Logo_PsyAid.png') ?>" alt="PsyAid Logo"
                        style="height: 65px; width: auto; object-fit: contain;">
                </a>
                <h3 class="fw-bold text-dark mb-1">Masuk ke PsyAid</h3>
                <p class="text-muted small mb-0">Disaster Mental Health Command Center</p>
            </div>

            <!-- Flash Message Alerts -->
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success rounded-md mb-4 p-3 border-0 small shadow-sm">
                    <i class="bi bi-check-circle-fill me-1"></i> <?= esc(session()->getFlashdata('success')) ?>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger rounded-md mb-4 p-3 border-0 shadow-sm small">
                    <i class="bi bi-exclamation-circle-fill me-1"></i> <?= esc(session()->getFlashdata('error')) ?>
                </div>
            <?php endif; ?>

            <!-- Login Form -->
            <form action="<?= site_url('/login') ?>" method="POST" id="loginForm">
                <?= csrf_field() ?>

                <!-- Email / WhatsApp Field -->
                <div class="mb-3">
                    <label for="email" class="form-label fw-semibold text-dark small mb-1">Email / No. WhatsApp <span class="text-danger">*</span></label>
                    <div class="custom-input-group">
                        <span class="input-icon-text"><i class="bi bi-person-badge"></i></span>
                        <input type="text" class="form-control" id="email" name="email" value="<?= old('email') ?>"
                            placeholder="Email / No. WhatsApp (0812...)" required autofocus>
                    </div>
                </div>

                <!-- Password Field -->
                <div class="mb-4">
                    <label for="password" class="form-label fw-semibold text-dark small mb-1">Password <span class="text-danger">*</span></label>
                    <div class="custom-input-group">
                        <span class="input-icon-text"><i class="bi bi-key"></i></span>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                        <button type="button" class="btn-toggle-eye" onclick="togglePassword('password', 'togglePassIcon')">
                            <i class="bi bi-eye" id="togglePassIcon"></i>
                        </button>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-emerald-submit w-100 mb-3">
                    <i class="bi bi-box-arrow-in-right me-1"></i> Masuk Sistem
                </button>
            </form>

            <!-- Register Navigation Link -->
            <div class="text-center mb-3">
                <span class="text-muted small">Belum memiliki akun Admin BPBD?</span>
                <a href="<?= site_url('/register') ?>" class="fw-bold text-success text-decoration-none ms-1 small hover-underline">
                    <i class="bi bi-person-plus-fill me-1"></i> Daftar Akun Baru
                </a>
            </div>

            <hr class="my-3 border-emerald-200">

            <!-- Testing Credentials Helper -->
            <div class="testing-creds-box p-3">
                <div class="fw-bold text-dark small mb-2 d-flex align-items-center gap-1">
                    <i class="bi bi-info-circle-fill text-primary"></i> Quick Testing Credentials:
                </div>
                <div class="d-grid gap-2">
                    <button type="button" onclick="fillCreds('admin@psyaid.id', 'password123')"
                        class="btn btn-outline-danger btn-sm text-start py-1 px-2 rounded-md fs-7">
                        <i class="bi bi-person-fill-gear me-1"></i> <strong>Admin BPBD:</strong> admin@psyaid.id
                    </button>
                    <button type="button" onclick="fillCreds('relawan1@psyaid.id', 'password123')"
                        class="btn btn-outline-success btn-sm text-start py-1 px-2 rounded-md fs-7">
                        <i class="bi bi-person-badge-fill me-1"></i> <strong>Relawan Posko 1:</strong> relawan1@psyaid.id
                    </button>
                    <button type="button" onclick="fillCreds('psikolog1@psyaid.id', 'password123')"
                        class="btn btn-outline-primary btn-sm text-start py-1 px-2 rounded-md fs-7">
                        <i class="bi bi-heart-pulse-fill me-1"></i> <strong>Psikolog 1:</strong> psikolog1@psyaid.id
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function fillCreds(email, password) {
        document.getElementById('email').value = email;
        document.getElementById('password').value = password;
    }

    function togglePassword(inputId, iconId) {
        const input = document.getElementById(inputId);
        const icon = document.getElementById(iconId);
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('bi-eye');
            icon.classList.add('bi-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.remove('bi-eye-slash');
            icon.classList.add('bi-eye');
        }
    }

    // Interactive Mental Health Background (Neural Nodes + Pulse Wave Effect)
    document.addEventListener('DOMContentLoaded', function () {
        (function initHealthCanvas() {
            const canvas = document.getElementById('health-canvas');
            if (!canvas) return;
            const ctx = canvas.getContext('2d');

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
                    vx: (Math.random() - 0.5) * 0.45,
                    vy: (Math.random() - 0.5) * 0.45,
                    radius: Math.random() * 2.2 + 1,
                    pulse: Math.random() * Math.PI * 2
                });
            }

            let pulseLineX = -300;

            function draw() {
                ctx.clearRect(0, 0, width, height);

                // Draw connecting lines between close nodes
                for (let i = 0; i < nodes.length; i++) {
                    for (let j = i + 1; j < nodes.length; j++) {
                        const dx = nodes[i].x - nodes[j].x;
                        const dy = nodes[i].y - nodes[j].y;
                        const dist = Math.sqrt(dx * dx + dy * dy);
                        const maxDist = 140;

                        if (dist < maxDist) {
                            const alpha = (1 - dist / maxDist) * 0.22;
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
    });
</script>
<?= $this->endSection() ?>