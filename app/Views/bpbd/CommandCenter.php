<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<!-- Frosted Glass UI Custom Styling & PsyAid Light Green Theme (Matching landing/index.php) -->
<style>
    .tabular-nums {
        font-variant-numeric: tabular-nums;
        font-feature-settings: "tnum";
    }

    /* Frosted Glass UI Card System */
    .frost-card {
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.85) 0%, rgba(244, 251, 247, 0.65) 100%);
        backdrop-filter: blur(12px) saturate(160%);
        -webkit-backdrop-filter: blur(12px) saturate(160%);
        border: 1px solid rgba(255, 255, 255, 0.85);
        border-radius: 8px;
        box-shadow: 0 8px 24px -4px rgba(15, 23, 42, 0.06),
            0 2px 6px -1px rgba(15, 23, 42, 0.02),
            inset 0 1px 1.5px 0 rgba(255, 255, 255, 0.95);
        transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .frost-card:hover {
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(236, 253, 245, 0.75) 100%);
        border-color: rgba(16, 185, 129, 0.4);
        box-shadow: 0 14px 32px -4px rgba(16, 185, 129, 0.12),
            0 4px 10px -2px rgba(15, 23, 42, 0.04),
            inset 0 1px 2px 0 rgba(255, 255, 255, 1);
        transform: translateY(-3px);
    }

    /* Special Overflow & Stacking Context for Filter Card */
    .frost-card-filter {
        position: relative;
        z-index: 100;
        overflow: visible !important;
    }

    /* LIGHT GREEN PSYAID HERO CARD SYSTEM (Matching landing/index.php) */
    .frost-hero {
        background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 60%, #a7f3d0 100%);
        border: 1.5px solid #a7f3d0;
        border-radius: 8px;
        color: #064e3b;
        position: relative;
        overflow: hidden;
        box-shadow: 0 10px 30px -4px rgba(16, 185, 129, 0.12),
            inset 0 1.5px 2px rgba(255, 255, 255, 0.85);
    }

    .frost-badge-priority {
        background: linear-gradient(90deg, rgba(254, 226, 226, 0.9) 0%, rgba(254, 242, 242, 0.9) 100%);
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
        border-bottom: 1px solid #fecdd3;
        color: #991b1b;
        font-size: 0.75rem;
        font-weight: 700;
        padding: 0.45rem 0.85rem;
    }

    /* CURATED PSYAID BRAND AI RISK CARDS */
    .risk-card-high {
        background: #fef2f2;
        border: 1px solid #fecdd3;
        border-radius: 6px;
    }

    .risk-card-high .risk-val {
        color: #dc2626;
        font-weight: 800;
    }

    .risk-card-high .risk-lbl {
        color: #991b1b;
        font-weight: 700;
        font-size: 0.6875rem;
        letter-spacing: 0.05em;
    }

    .risk-card-medium {
        background: #fffbeb;
        border: 1px solid #fde68a;
        border-radius: 6px;
    }

    .risk-card-medium .risk-val {
        color: #d97706;
        font-weight: 800;
    }

    .risk-card-medium .risk-lbl {
        color: #92400e;
        font-weight: 700;
        font-size: 0.6875rem;
        letter-spacing: 0.05em;
    }

    .risk-card-low {
        background: #ecfdf5;
        border: 1px solid #a7f3d0;
        border-radius: 6px;
    }

    .risk-card-low .risk-val {
        color: #059669;
        font-weight: 800;
    }

    .risk-card-low .risk-lbl {
        color: #047857;
        font-weight: 700;
        font-size: 0.6875rem;
        letter-spacing: 0.05em;
    }

    /* LIGHT GREEN BUTTON: BUKA POSKO / KELOLA POSKO (Matching landing/index.php) */
    .frost-btn-posko {
        background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
        color: #065f46 !important;
        border: 1.5px solid #34d399;
        border-radius: 6px;
        font-weight: 700;
        font-size: 0.8125rem;
        padding: 0.4rem 0.95rem;
        transition: all 0.2s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        box-shadow: 0 2px 6px rgba(16, 185, 129, 0.15);
        white-space: nowrap;
        flex-shrink: 0;
    }

    .frost-btn-posko:hover {
        background: linear-gradient(135deg, #a7f3d0 0%, #6ee7b7 100%);
        color: #064e3b !important;
        border-color: #10b981;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.25);
        transform: translateY(-1px);
    }

    /* CUSTOM FROSTED DROPDOWN COMPONENT */
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
        border-radius: 8px;
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

    .frost-custom-trigger.disabled {
        background-color: #f8fafc;
        color: #94a3b8;
        border-color: #e2e8f0;
        cursor: not-allowed;
        opacity: 0.75;
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
        border-radius: 8px;
        box-shadow: 0 16px 40px -4px rgba(15, 23, 42, 0.18), 0 4px 16px rgba(0, 0, 0, 0.06);
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
        border-radius: 6px;
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

    .step-num-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 20px;
        height: 20px;
        border-radius: 4px;
        background-color: #ecfdf5;
        color: #047857;
        font-size: 0.7rem;
        font-weight: 700;
        margin-right: 6px;
        border: 1px solid #a7f3d0;
    }

    /* Desktop Buttons */
    .frost-btn-reset {
        background: #ffffff;
        color: #475569;
        border: 1.5px solid #cbd5e1;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.8125rem;
        padding: 0.5rem 0.95rem;
        transition: all 0.2s ease;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
    }

    .frost-btn-reset:hover {
        background-color: #f8fafc;
        color: #0f172a;
        border-color: #94a3b8;
    }

    /* Compact Mobile Action Buttons */
    .frost-btn-reset-sm {
        background: #ffffff;
        color: #475569;
        border: 1px solid #cbd5e1;
        border-radius: 6px;
        font-weight: 600;
        font-size: 0.75rem;
        padding: 0.35rem 0.65rem;
        transition: all 0.2s ease;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
    }

    .fs-7 {
        font-size: 0.8125rem;
    }

    .fs-8 {
        font-size: 0.75rem;
    }

    .fs-9 {
        font-size: 0.6875rem;
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

    /* Mobile Responsive Spacing & Padding Optimization for Filter Card */
    @media (max-width: 767.98px) {
        .frost-card-filter {
            padding: 1.25rem 1rem !important;
            margin-bottom: 1.25rem !important;
        }

        .frost-card-filter .border-bottom {
            padding-bottom: 0.85rem !important;
            margin-bottom: 1rem !important;
        }

        .frost-custom-trigger {
            min-height: 46px;
            font-size: 0.875rem;
            padding: 0.65rem 0.95rem;
        }

        .frost-custom-option {
            padding: 0.75rem 0.85rem;
            font-size: 0.875rem;
        }

        #filter-form {
            --bs-gutter-y: 1.15rem;
        }

        #filter-form .form-label {
            margin-bottom: 0.45rem !important;
            font-size: 0.8125rem;
        }

        #active-filters-chips-container {
            margin-top: 1.15rem !important;
            padding-top: 0.85rem !important;
        }

        .frost-mobile-reset-wrapper {
            margin-top: 1.15rem !important;
            padding-top: 0.85rem !important;
        }
    }
</style>

<!-- 1. Header Command Center Hero Banner (PsyAid Light Green Theme) -->
<div class="card frost-hero mb-4">
    <div class="card-body p-4 position-relative">
        <div class="row align-items-center g-3">
            <div class="col-12 col-md-8">
                <div class="d-flex align-items-center gap-2 mb-2 flex-wrap">
                    <span class="badge px-3 py-1.5 fs-8 fw-bold rounded-2"
                        style="background-color: rgba(6, 95, 70, 0.12); color: #065f46; border: 1px solid rgba(6, 95, 70, 0.25);">
                        <i class="bi bi-circle-fill me-1" style="font-size: 0.5rem; vertical-align: middle;"></i> DATA
                        TERINTEGRASI REAL-TIME
                    </span>
                    <span class="badge px-3 py-1.5 fs-8 rounded-2"
                        style="background-color: rgba(6, 95, 70, 0.08); color: #047857; border: 1px solid rgba(6, 95, 70, 0.18);">
                        BPBD Command Center
                    </span>
                </div>
                <h3 class="fw-bold mb-1" style="color: #064e3b;">
                    <i class="bi bi-shield-shaded me-2" style="color: #059669;"></i> Command Center BPBD
                </h3>
                <p class="small mb-0" style="color: #047857; max-width: 65ch;">
                    Pemantauan real-time kesehatan mental penyintas, alokasi relawan posko, dan penugasan psikolog
                    klinis.
                </p>
            </div>
            <div class="col-12 col-md-4 text-md-end">
                <div class="d-inline-block text-start rounded-2 p-2.5 px-3"
                    style="background-color: rgba(255, 255, 255, 0.65); border: 1px solid rgba(16, 185, 129, 0.35);">
                    <div class="fs-8 fw-semibold text-uppercase" style="color: #047857;">Waktu Terkini</div>
                    <div class="fw-bold small tabular-nums" style="color: #064e3b;"><i class="bi bi-clock me-1"
                            style="color: #059669;"></i>
                        <span class="live-device-clock"><?= date('d M Y — H:i') ?> WIB</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 2. Cascading Select Filter Bar -->
<div class="card frost-card frost-card-filter p-3.5 p-md-4 mb-4">
    <div class="d-flex align-items-center justify-content-between mb-3 border-bottom pb-3 flex-wrap gap-2">
        <h6 class="fw-bold text-dark mb-0 d-flex align-items-center">
            <i class="bi bi-funnel-fill text-success me-2 fs-5"></i> Filter Wilayah & Posko Kebencanaan
        </h6>
        <!-- Desktop Reset Button -->
        <div class="d-none d-md-flex align-items-center">
            <button type="button" id="btn-reset-filter" class="frost-btn-reset">
                <i class="bi bi-arrow-counterclockwise"></i> Reset Filter
            </button>
        </div>
    </div>

    <form id="filter-form" class="row g-3" onsubmit="return false;">
        <!-- Hidden Native Selects for Seamless Real-Time AJAX & Form Sync -->
        <select id="filter-provinsi" name="province_id" class="d-none">
            <option value="">Semua Provinsi</option>
            <?php foreach ($provinces as $prov): ?>
                <option value="<?= esc($prov['id']) ?>"><?= esc($prov['name']) ?></option>
            <?php endforeach; ?>
        </select>

        <select id="filter-kabupaten" name="regency_id" class="d-none" disabled>
            <option value="">Pilih Provinsi Dahulu</option>
        </select>

        <select id="filter-bencana" name="jenis_bencana" class="d-none">
            <option value="">Semua Bencana</option>
            <?php foreach ($jenisBencana as $jb): ?>
                <option value="<?= esc($jb) ?>"><?= esc($jb) ?></option>
            <?php endforeach; ?>
        </select>

        <select id="filter-status" name="status" class="d-none">
            <option value="">Semua Status</option>
            <option value="aktif">Aktif</option>
            <option value="recovery">Recovery</option>
            <option value="closed">Closed</option>
        </select>

        <!-- 1. Custom Floating Dropdown: Provinsi -->
        <div class="col-12 col-sm-6 col-lg-3">
            <label class="form-label small fw-bold text-secondary mb-1.5 d-flex align-items-center">
                <span class="step-num-badge">1</span> Provinsi
            </label>
            <div class="frost-custom-select-wrapper" id="custom-wrapper-provinsi">
                <div class="frost-custom-trigger" id="trigger-provinsi">
                    <span class="trigger-label text-truncate">Semua Provinsi</span>
                    <i class="bi bi-chevron-down chevron-icon"></i>
                </div>
                <div class="frost-custom-menu" id="menu-provinsi">
                    <div class="frost-custom-option selected" data-value="">Semua Provinsi</div>
                    <?php foreach ($provinces as $prov): ?>
                        <div class="frost-custom-option" data-value="<?= esc($prov['id']) ?>"><?= esc($prov['name']) ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <!-- 2. Custom Floating Dropdown: Kabupaten (Populated via AJAX) -->
        <div class="col-12 col-sm-6 col-lg-3">
            <label class="form-label small fw-bold text-secondary mb-1.5 d-flex align-items-center">
                <span class="step-num-badge">2</span> Kabupaten / Kota
            </label>
            <div class="frost-custom-select-wrapper" id="custom-wrapper-kabupaten">
                <div class="frost-custom-trigger disabled" id="trigger-kabupaten">
                    <span class="trigger-label text-truncate">Pilih Provinsi Dahulu</span>
                    <i class="bi bi-chevron-down chevron-icon"></i>
                </div>
                <div class="frost-custom-menu" id="menu-kabupaten">
                    <div class="frost-custom-option selected" data-value="">Pilih Provinsi Dahulu</div>
                </div>
            </div>
        </div>

        <!-- 3. Custom Floating Dropdown: Jenis Bencana -->
        <div class="col-12 col-sm-6 col-lg-3">
            <label class="form-label small fw-bold text-secondary mb-1.5 d-flex align-items-center">
                <span class="step-num-badge">3</span> Jenis Bencana
            </label>
            <div class="frost-custom-select-wrapper" id="custom-wrapper-bencana">
                <div class="frost-custom-trigger" id="trigger-bencana">
                    <span class="trigger-label text-truncate">Semua Bencana</span>
                    <i class="bi bi-chevron-down chevron-icon"></i>
                </div>
                <div class="frost-custom-menu" id="menu-bencana">
                    <div class="frost-custom-option selected" data-value="">Semua Bencana</div>
                    <?php foreach ($jenisBencana as $jb): ?>
                        <div class="frost-custom-option" data-value="<?= esc($jb) ?>"><?= esc($jb) ?></div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <!-- 4. Custom Floating Dropdown: Status Posko -->
        <div class="col-12 col-sm-6 col-lg-3">
            <label class="form-label small fw-bold text-secondary mb-1.5 d-flex align-items-center">
                <span class="step-num-badge">4</span> Status Posko
            </label>
            <div class="frost-custom-select-wrapper" id="custom-wrapper-status">
                <div class="frost-custom-trigger" id="trigger-status">
                    <span class="trigger-label text-truncate">Semua Status</span>
                    <i class="bi bi-chevron-down chevron-icon"></i>
                </div>
                <div class="frost-custom-menu" id="menu-status">
                    <div class="frost-custom-option selected" data-value="">Semua Status</div>
                    <div class="frost-custom-option" data-value="aktif">Aktif</div>
                    <div class="frost-custom-option" data-value="recovery">Recovery</div>
                    <div class="frost-custom-option" data-value="closed">Closed</div>
                </div>
            </div>
        </div>
    </form>

    <!-- Filter Aktif Chips -->
    <div id="active-filters-chips-container" class="d-none mt-3 pt-2.5 border-top">
        <div class="d-flex align-items-center flex-wrap gap-2">
            <span class="fs-8 fw-semibold text-muted me-1"><i class="bi bi-tags me-1"></i> Filter Aktif:</span>
            <div id="active-chips-list" class="d-flex flex-wrap gap-1.5"></div>
        </div>
    </div>

    <!-- Mobile Reset Button (Positioned Below Active Filter Chips) -->
    <div class="d-flex d-md-none align-items-center justify-content-end frost-mobile-reset-wrapper border-top">
        <button type="button" id="btn-reset-filter-mobile" class="frost-btn-reset-sm">
            <i class="bi bi-arrow-counterclockwise"></i> Reset Filter
        </button>
    </div>
</div>

<!-- 3. Summary Metric Cards Grid (Frosted Glass UI Style) -->
<div class="row g-3 mb-4">
    <!-- Card 1: Total Korban -->
    <div class="col-12 col-sm-6 col-lg-3">
        <div class="card frost-card p-3 h-100">
            <div class="text-muted fs-8 fw-bold text-uppercase">Total Korban Bencana</div>
            <div class="d-flex align-items-baseline justify-content-between mt-2">
                <div class="display-6 fw-bold text-dark tabular-nums" id="stat-total-korban">
                    <?= esc($stats['total_korban']) ?>
                </div>
                <div class="text-muted fs-3"><i class="bi bi-people-fill"></i></div>
            </div>
            <div class="small text-muted mt-2 pt-2 border-top">Terdata di posko terpilih</div>
        </div>
    </div>

    <!-- Card 2: Status Skrining -->
    <div class="col-12 col-sm-6 col-lg-3">
        <div class="card frost-card p-3 h-100">
            <div class="text-muted fs-8 fw-bold text-uppercase">Status Skrining Relawan</div>
            <div class="mt-2">
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <span class="small fw-semibold text-success"><i class="bi bi-check-circle-fill me-1"></i> Sudah
                        Skrining</span>
                    <span class="fw-bold text-dark tabular-nums"
                        id="stat-sudah-screening"><?= esc($stats['sudah_screening']) ?></span>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="small text-muted"><i class="bi bi-clock-history me-1"></i> Belum Skrining</span>
                    <span class="fw-bold text-secondary tabular-nums"
                        id="stat-belum-screening"><?= esc($stats['belum_screening']) ?></span>
                </div>
            </div>
            <div class="progress" style="height: 6px;">
                <div id="prog-screening" class="progress-bar bg-success" role="progressbar"
                    style="width: <?= $stats['total_korban'] > 0 ? round(($stats['sudah_screening'] / $stats['total_korban']) * 100) : 0 ?>%">
                </div>
            </div>
            <div class="d-flex justify-content-between align-items-center mt-1 fs-8 text-muted">
                <span>Cakupan</span>
                <span class="fw-semibold text-dark tabular-nums" id="prog-screening-pct">
                    <?= $stats['total_korban'] > 0 ? round(($stats['sudah_screening'] / $stats['total_korban']) * 100) : 0 ?>%
                </span>
            </div>
        </div>
    </div>

    <!-- Card 3: AI Risk Level Breakdown (Curated PsyAid Brand Risk Cards) -->
    <div class="col-12 col-sm-6 col-lg-3">
        <div class="card frost-card p-3 h-100">
            <div class="text-muted fs-8 fw-bold text-uppercase">Tingkat Risiko (AI Assessment)</div>
            <div class="d-flex justify-content-between align-items-center mt-2 gap-1.5 text-center">
                <div class="risk-card-high p-2 flex-fill">
                    <div class="risk-val fs-5 tabular-nums" id="stat-risk-high">
                        <?= esc($stats['risk_high']) ?>
                    </div>
                    <div class="risk-lbl">HIGH</div>
                </div>
                <div class="risk-card-medium p-2 flex-fill">
                    <div class="risk-val fs-5 tabular-nums" id="stat-risk-medium">
                        <?= esc($stats['risk_medium']) ?>
                    </div>
                    <div class="risk-lbl">MEDIUM</div>
                </div>
                <div class="risk-card-low p-2 flex-fill">
                    <div class="risk-val fs-5 tabular-nums" id="stat-risk-low">
                        <?= esc($stats['risk_low']) ?>
                    </div>
                    <div class="risk-lbl">LOW</div>
                </div>
            </div>
            <div class="small text-muted mt-2 pt-2 border-top">Dianalisis otomatis dari skrining</div>
        </div>
    </div>

    <!-- Card 4: Personel Aktif -->
    <div class="col-12 col-sm-6 col-lg-3">
        <div class="card frost-card p-3 h-100">
            <div class="text-muted fs-8 fw-bold text-uppercase">Personel Aktif Lapangan</div>
            <div class="mt-2">
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <span class="small fw-semibold text-primary"><i class="bi bi-heart-pulse-fill me-1"></i> Psikolog
                        Aktif</span>
                    <span class="fw-bold text-dark tabular-nums"
                        id="stat-jumlah-psikolog"><?= esc($stats['jumlah_psikolog']) ?> Orang</span>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <span class="small text-muted"><i class="bi bi-person-badge me-1"></i> Relawan Aktif</span>
                    <span class="fw-bold text-dark tabular-nums"
                        id="stat-jumlah-relawan"><?= esc($stats['jumlah_relawan']) ?> Orang</span>
                </div>
            </div>
            <div class="small text-muted mt-3 pt-2 border-top">Ditugaskan pada lokasi posko</div>
        </div>
    </div>
</div>

<!-- 4. Grid Kartu Posko Kebencanaan (Frosted Glass UI Cards) -->
<div class="mb-5">
    <div class="d-flex align-items-center justify-content-between mb-3 flex-wrap gap-2">
        <h5 class="fw-bold text-dark mb-0">
            <i class="bi bi-grid-3x3-gap-fill text-success me-2"></i> Grid Kartu Posko & Breakdown Risiko AI
        </h5>
        <div class="d-flex align-items-center gap-2 flex-wrap">
            <a href="<?= site_url('/bpbd/manage-posko') ?>" class="frost-btn-posko">
                <i class="bi bi-house-gear-fill me-1"></i> Kelola &amp; Tambah Posko
            </a>
            <span class="badge bg-light text-dark border px-3 py-2 fw-semibold rounded-2" id="posko-card-count-badge">
                <?= count($poskoList) ?> Posko Tampil
            </span>
        </div>
    </div>

    <div class="row g-3" id="posko-cards-container">
        <?php if (empty($poskoList)): ?>
            <div class="col-12">
                <div class="card frost-card p-5 text-center text-muted">
                    <i class="bi bi-inbox fs-2 d-block mb-2 text-secondary"></i>
                    <h6 class="fw-bold text-dark mb-1">Tidak Ada Data Posko</h6>
                    <p class="small text-muted mb-0">Tidak ada data posko yang sesuai dengan filter yang dipilih.</p>
                </div>
            </div>
        <?php else: ?>
            <?php foreach ($poskoList as $posko): ?>
                <div class="col-12 col-md-6 col-lg-4">
                    <div
                        class="card frost-card h-100 overflow-hidden <?= $posko['is_highest_priority'] ? 'border-danger border-2' : '' ?>">
                        <?php if ($posko['is_highest_priority']): ?>
                            <div class="frost-badge-priority d-flex align-items-center justify-content-between">
                                <span><i class="bi bi-exclamation-triangle-fill me-1 text-danger"></i> Prioritas Operasional</span>
                                <span class="badge bg-white text-danger fw-bold rounded-1">Kasus High Terbanyak</span>
                            </div>
                        <?php endif; ?>

                        <div class="card-body p-3 d-flex flex-column justify-content-between">
                            <div>
                                <div class="d-flex align-items-start justify-content-between mb-2">
                                    <h6 class="fw-bold text-dark mb-0 pe-2">
                                        <a href="<?= site_url('/posko/' . $posko['id']) ?>"
                                            class="text-decoration-none text-dark hover-danger">
                                            <?= esc($posko['posko_name']) ?>
                                        </a>
                                    </h6>
                                    <?php if ($posko['status'] === 'aktif'): ?>
                                        <span class="badge bg-success rounded-1">Aktif</span>
                                    <?php elseif ($posko['status'] === 'recovery'): ?>
                                        <span class="badge bg-warning text-dark rounded-1">Recovery</span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary rounded-1">Closed</span>
                                    <?php endif; ?>
                                </div>

                                <div class="small text-muted mb-3">
                                    <i class="bi bi-geo-alt me-1 text-danger"></i> <?= esc($posko['regency_name']) ?>,
                                    <?= esc($posko['province_name']) ?>
                                    <span
                                        class="ms-2 badge bg-light text-secondary border rounded-1"><?= esc($posko['jenis_bencana']) ?></span>
                                </div>

                                <!-- AI Risk Breakdown Grid -->
                                <div class="bg-light bg-opacity-75 p-2.5 rounded-2 mb-3 border">
                                    <div class="small text-muted fw-bold mb-2 fs-8 text-uppercase">Breakdown Kasus AI Risk
                                        Level:</div>
                                    <div class="d-flex justify-content-between text-center gap-1.5">
                                        <div class="risk-card-high p-1.5 flex-fill">
                                            <div class="risk-val fs-6 tabular-nums"><?= esc($posko['high_risk_count']) ?></div>
                                            <div class="risk-lbl">High</div>
                                        </div>
                                        <div class="risk-card-medium p-1.5 flex-fill">
                                            <div class="risk-val fs-6 tabular-nums"><?= esc($posko['medium_risk_count']) ?>
                                            </div>
                                            <div class="risk-lbl">Medium</div>
                                        </div>
                                        <div class="risk-card-low p-1.5 flex-fill">
                                            <div class="risk-val fs-6 tabular-nums"><?= esc($posko['low_risk_count']) ?></div>
                                            <div class="risk-lbl">Low</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div
                                class="d-flex align-items-center justify-content-between border-top pt-2.5 mt-2 flex-wrap gap-2">
                                <div class="small text-muted me-auto">
                                    Total: <strong class="text-dark tabular-nums"><?= $posko['total_korban'] ?></strong>
                                    Penyintas
                                </div>
                                <a href="<?= site_url('/posko/' . $posko['id']) ?>" class="frost-btn-posko">
                                    Buka Posko <i class="bi bi-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<!-- JavaScript for Custom Floating Dropdowns & Cascading Real-Time Filtering -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const provSelect = document.getElementById('filter-provinsi');
        const kabSelect = document.getElementById('filter-kabupaten');
        const bencSelect = document.getElementById('filter-bencana');
        const statSelect = document.getElementById('filter-status');

        const resetBtn = document.getElementById('btn-reset-filter');
        const resetBtnMob = document.getElementById('btn-reset-filter-mobile');

        // Setup Custom Floating Dropdown Interactivity
        function setupCustomDropdown(key, defaultText) {
            const wrapper = document.getElementById('custom-wrapper-' + key);
            const trigger = document.getElementById('trigger-' + key);
            const menu = document.getElementById('menu-' + key);
            const native = document.getElementById('filter-' + key);

            if (!wrapper || !trigger || !menu || !native) return;

            trigger.addEventListener('click', function (e) {
                e.stopPropagation();
                if (trigger.classList.contains('disabled')) return;

                const isAlreadyShow = menu.classList.contains('show');

                // Close all other open dropdowns
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
                    native.dispatchEvent(new Event('change'));
                }
            });
        }

        setupCustomDropdown('provinsi', 'Semua Provinsi');
        setupCustomDropdown('kabupaten', 'Pilih Provinsi Dahulu');
        setupCustomDropdown('bencana', 'Semua Bencana');
        setupCustomDropdown('status', 'Semua Status');

        // Close custom menus when clicking outside
        document.addEventListener('click', function () {
            document.querySelectorAll('.frost-custom-menu').forEach(m => m.classList.remove('show'));
            document.querySelectorAll('.frost-custom-trigger').forEach(t => t.classList.remove('active'));
            document.querySelectorAll('.frost-custom-select-wrapper').forEach(w => w.classList.remove('active-dropdown'));
        });

        // 1. Cascading Select: Fetch Regencies on Province Change
        provSelect.addEventListener('change', function () {
            const provinceId = this.value;
            const triggerKab = document.getElementById('trigger-kabupaten');
            const menuKab = document.getElementById('menu-kabupaten');

            kabSelect.innerHTML = '<option value="">Semua Kabupaten</option>';
            kabSelect.value = '';
            kabSelect.disabled = true;

            triggerKab.classList.add('disabled');
            triggerKab.querySelector('.trigger-label').textContent = provinceId ? 'Memuat Kabupaten...' : 'Pilih Provinsi Dahulu';
            menuKab.innerHTML = `<div class="frost-custom-option selected" data-value="">${provinceId ? 'Memuat Kabupaten...' : 'Pilih Provinsi Dahulu'}</div>`;

            if (!provinceId) {
                updateActiveChips();
                fetchStats();
                return;
            }

            const regencyApiUrl = window.location.origin + '/command-center/get-regencies/' + provinceId;

            fetch(regencyApiUrl)
                .then(res => res.json())
                .then(res => {
                    if (res.status === 'success') {
                        triggerKab.querySelector('.trigger-label').textContent = 'Semua Kabupaten';
                        triggerKab.classList.remove('disabled');

                        let menuHtml = '<div class="frost-custom-option selected" data-value="">Semua Kabupaten</div>';
                        res.data.forEach(reg => {
                            const opt = document.createElement('option');
                            opt.value = reg.id;
                            opt.textContent = reg.name;
                            kabSelect.appendChild(opt);

                            menuHtml += `<div class="frost-custom-option" data-value="${reg.id}">${escapeHtml(reg.name)}</div>`;
                        });
                        kabSelect.disabled = false;
                        menuKab.innerHTML = menuHtml;
                    } else {
                        triggerKab.querySelector('.trigger-label').textContent = 'Gagal Memuat';
                    }
                    updateActiveChips();
                    fetchStats();
                })
                .catch(err => {
                    console.error('Error fetching regencies:', err);
                    triggerKab.querySelector('.trigger-label').textContent = 'Error Memuat';
                });
        });

        // Instant Real-Time Fetching on Option Selection
        kabSelect.addEventListener('change', function () { updateActiveChips(); fetchStats(); });
        bencSelect.addEventListener('change', function () { updateActiveChips(); fetchStats(); });
        statSelect.addEventListener('change', function () { updateActiveChips(); fetchStats(); });

        // Reset Filter Handler
        const handleReset = function (e) {
            if (e) e.preventDefault();

            provSelect.value = '';
            kabSelect.value = '';
            bencSelect.value = '';
            statSelect.value = '';

            kabSelect.disabled = true;
            kabSelect.innerHTML = '<option value="">Pilih Provinsi Dahulu</option>';

            // Reset Custom Triggers & Menus
            document.querySelector('#trigger-provinsi .trigger-label').textContent = 'Semua Provinsi';
            document.querySelector('#trigger-kabupaten .trigger-label').textContent = 'Pilih Provinsi Dahulu';
            document.getElementById('trigger-kabupaten').classList.add('disabled');
            document.querySelector('#trigger-bencana .trigger-label').textContent = 'Semua Bencana';
            document.querySelector('#trigger-status .trigger-label').textContent = 'Semua Status';

            document.querySelectorAll('.frost-custom-menu').forEach(m => {
                m.querySelectorAll('.frost-custom-option').forEach((o, i) => {
                    if (i === 0) o.classList.add('selected');
                    else o.classList.remove('selected');
                });
            });

            updateActiveChips();
            fetchStats();
        };

        if (resetBtn) resetBtn.addEventListener('click', handleReset);
        if (resetBtnMob) resetBtnMob.addEventListener('click', handleReset);

        function updateActiveChips() {
            const container = document.getElementById('active-filters-chips-container');
            const list = document.getElementById('active-chips-list');
            list.innerHTML = '';

            let count = 0;
            if (provSelect.value) {
                const txt = document.querySelector('#trigger-provinsi .trigger-label').textContent;
                count++;
                list.innerHTML += `<span class="badge bg-light text-dark border px-2 py-1 fs-8 rounded-1 me-1">Prov: ${escapeHtml(txt)}</span>`;
            }
            if (!kabSelect.disabled && kabSelect.value) {
                const txt = document.querySelector('#trigger-kabupaten .trigger-label').textContent;
                count++;
                list.innerHTML += `<span class="badge bg-light text-dark border px-2 py-1 fs-8 rounded-1 me-1">Kab: ${escapeHtml(txt)}</span>`;
            }
            if (bencSelect.value) {
                count++;
                list.innerHTML += `<span class="badge bg-light text-dark border px-2 py-1 fs-8 rounded-1 me-1">Bencana: ${escapeHtml(bencSelect.value)}</span>`;
            }
            if (statSelect.value) {
                count++;
                list.innerHTML += `<span class="badge bg-light text-dark border px-2 py-1 fs-8 rounded-1 me-1">Status: ${escapeHtml(statSelect.value)}</span>`;
            }

            if (count > 0) {
                container.classList.remove('d-none');
            } else {
                container.classList.add('d-none');
            }
        }

        // Fetch Stats & Posko Grid via relative URL endpoint
        function fetchStats() {
            const params = new URLSearchParams({
                province_id: provSelect.value || '',
                regency_id: kabSelect.value || '',
                jenis_bencana: bencSelect.value || '',
                status: statSelect.value || ''
            });

            const container = document.getElementById('posko-cards-container');
            if (container) container.style.opacity = '0.5';

            const statsApiUrl = window.location.origin + '/command-center/get-stats?' + params.toString();

            fetch(statsApiUrl)
                .then(res => res.json())
                .then(res => {
                    if (container) container.style.opacity = '1';
                    if (res.status === 'success') {
                        updateCards(res.data);
                        updatePoskoCardsGrid(res.poskoList);
                    }
                })
                .catch(err => {
                    if (container) container.style.opacity = '1';
                    console.error('Error fetching stats:', err);
                });
        }

        function updateCards(d) {
            if (document.getElementById('stat-total-korban')) document.getElementById('stat-total-korban').textContent = d.total_korban;
            if (document.getElementById('stat-sudah-screening')) document.getElementById('stat-sudah-screening').textContent = d.sudah_screening;
            if (document.getElementById('stat-belum-screening')) document.getElementById('stat-belum-screening').textContent = d.belum_screening;
            if (document.getElementById('stat-risk-high')) document.getElementById('stat-risk-high').textContent = d.risk_high;
            if (document.getElementById('stat-risk-medium')) document.getElementById('stat-risk-medium').textContent = d.risk_medium;
            if (document.getElementById('stat-risk-low')) document.getElementById('stat-risk-low').textContent = d.risk_low;
            if (document.getElementById('stat-jumlah-psikolog')) document.getElementById('stat-jumlah-psikolog').textContent = d.jumlah_psikolog + ' Orang';
            if (document.getElementById('stat-jumlah-relawan')) document.getElementById('stat-jumlah-relawan').textContent = d.jumlah_relawan + ' Orang';

            const pct = d.total_korban > 0 ? Math.round((d.sudah_screening / d.total_korban) * 100) : 0;
            const progBar = document.getElementById('prog-screening');
            const progPct = document.getElementById('prog-screening-pct');

            if (progBar) progBar.style.width = pct + '%';
            if (progPct) progPct.textContent = pct + '%';
        }

        function updatePoskoCardsGrid(list) {
            const container = document.getElementById('posko-cards-container');
            const badge = document.getElementById('posko-card-count-badge');
            if (badge) badge.textContent = list.length + ' Posko Tampil';

            if (!container) return;

            if (list.length === 0) {
                container.innerHTML = `
                <div class="col-12">
                    <div class="card frost-card p-5 text-center text-muted">
                        <i class="bi bi-inbox fs-2 d-block mb-2 text-secondary"></i>
                        <h6 class="fw-bold text-dark mb-1">Tidak Ada Data Posko</h6>
                        <p class="small text-muted mb-0">Tidak ada data posko yang sesuai dengan filter yang dipilih.</p>
                    </div>
                </div>`;
                return;
            }

            const basePoskoUrl = window.location.origin + '/posko/';

            let html = '';
            list.forEach(p => {
                let statusBadge = '<span class="badge bg-secondary rounded-1">Closed</span>';
                if (p.status === 'aktif') {
                    statusBadge = '<span class="badge bg-success rounded-1">Aktif</span>';
                } else if (p.status === 'recovery') {
                    statusBadge = '<span class="badge bg-warning text-dark rounded-1">Recovery</span>';
                }

                const priorityHeader = p.is_highest_priority ? `
                <div class="frost-badge-priority d-flex align-items-center justify-content-between">
                    <span><i class="bi bi-exclamation-triangle-fill me-1 text-danger"></i> Prioritas Operasional</span>
                    <span class="badge bg-white text-danger fw-bold rounded-1">Kasus High Terbanyak</span>
                </div>` : '';

                const borderClass = p.is_highest_priority ? 'border-danger border-2' : '';

                html += `
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card frost-card h-100 overflow-hidden ${borderClass}">
                        ${priorityHeader}
                        <div class="card-body p-3 d-flex flex-column justify-content-between">
                            <div>
                                <div class="d-flex align-items-start justify-content-between mb-2">
                                    <h6 class="fw-bold text-dark mb-0 pe-2">
                                        <a href="${basePoskoUrl}${p.id}" class="text-decoration-none text-dark hover-danger">
                                            ${escapeHtml(p.posko_name)}
                                        </a>
                                    </h6>
                                    ${statusBadge}
                                </div>

                                <div class="small text-muted mb-3">
                                    <i class="bi bi-geo-alt me-1 text-danger"></i> ${escapeHtml(p.regency_name)}, ${escapeHtml(p.province_name)}
                                    <span class="ms-2 badge bg-light text-secondary border rounded-1">${escapeHtml(p.jenis_bencana)}</span>
                                </div>

                                <div class="bg-light bg-opacity-75 p-2.5 rounded-2 mb-3 border">
                                    <div class="small text-muted fw-bold mb-2 fs-8 text-uppercase">Breakdown Kasus AI Risk Level:</div>
                                    <div class="d-flex justify-content-between text-center gap-1.5">
                                        <div class="risk-card-high p-1.5 flex-fill">
                                            <div class="risk-val fs-6 tabular-nums">${p.high_risk_count}</div>
                                            <div class="risk-lbl">High</div>
                                        </div>
                                        <div class="risk-card-medium p-1.5 flex-fill">
                                            <div class="risk-val fs-6 tabular-nums">${p.medium_risk_count}</div>
                                            <div class="risk-lbl">Medium</div>
                                        </div>
                                        <div class="risk-card-low p-1.5 flex-fill">
                                            <div class="risk-val fs-6 tabular-nums">${p.low_risk_count}</div>
                                            <div class="risk-lbl">Low</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex align-items-center justify-content-between border-top pt-2.5 mt-2 flex-wrap gap-2">
                                <div class="small text-muted me-auto">
                                    Total: <strong class="text-dark tabular-nums">${p.total_korban}</strong> Penyintas
                                </div>
                                <a href="${basePoskoUrl}${p.id}" class="frost-btn-posko">
                                    Buka Posko <i class="bi bi-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>`;
            });
            container.innerHTML = html;
        }

        function escapeHtml(str) {
            if (!str) return '';
            return str.replace(/[&<>"']/g, function (m) {
                return { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#039;' }[m];
            });
        }
    });
</script>
<?= $this->endSection() ?>