<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<style>
    .tabular-nums {
        font-variant-numeric: tabular-nums;
        font-feature-settings: "tnum";
    }

    /* Strict Max Rounded 8px (lg) Policy */
    .frost-card,
    .frost-hero,
    .frost-btn-primary,
    .frost-btn-danger,
    .frost-btn-reset,
    .posko-item-card,
    .btn,
    .modal-content,
    .badge,
    .form-control,
    .form-select,
    .progress,
    .alert,
    .card,
    .card-header,
    .table-responsive {
        border-radius: 8px !important;
    }

    /* Frosted Glass UI Card System */
    .frost-card {
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.98) 0%, rgba(244, 251, 247, 0.9) 100%);
        backdrop-filter: blur(12px) saturate(160%);
        -webkit-backdrop-filter: blur(12px) saturate(160%);
        border: 1.5px solid #a7f3d0;
        box-shadow: 0 8px 24px -4px rgba(15, 23, 42, 0.06), 0 2px 6px -1px rgba(15, 23, 42, 0.02);
    }

    /* LIGHT GREEN PSYAID HERO CARD SYSTEM MATCHING POSKODETAIL */
    .frost-hero {
        background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 60%, #a7f3d0 100%);
        border: 1.5px solid #a7f3d0;
        color: #064e3b;
        position: relative;
        overflow: hidden;
        box-shadow: 0 10px 30px -4px rgba(16, 185, 129, 0.12), inset 0 1.5px 2px rgba(255, 255, 255, 0.85);
    }

    /* LIGHT GREEN BUTTON: PRIMARY ACTION */
    .frost-btn-primary {
        background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
        color: #065f46 !important;
        border: 1.5px solid #34d399;
        border-radius: 8px !important;
        font-weight: 700;
        font-size: 0.8125rem;
        padding: 0.45rem 0.95rem;
        transition: all 0.2s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        box-shadow: 0 2px 6px rgba(16, 185, 129, 0.15);
        cursor: pointer;
    }

    .frost-btn-primary:hover {
        background: linear-gradient(135deg, #a7f3d0 0%, #6ee7b7 100%);
        color: #064e3b !important;
        border-color: #10b981;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.25);
        transform: translateY(-1px);
    }

    .frost-btn-reset {
        background: #ffffff !important;
        color: #475569 !important;
        border: 1.5px solid #cbd5e1 !important;
        border-radius: 8px !important;
        font-weight: 600 !important;
        font-size: 0.8125rem !important;
        padding: 0.45rem 0.85rem !important;
        transition: all 0.2s ease;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        text-decoration: none;
    }

    .frost-btn-reset:hover {
        background-color: #f8fafc !important;
        color: #0f172a !important;
        border-color: #94a3b8 !important;
    }

    /* INNER POSKO ITEM CARD: SOFT MINT & PURE WHITE DISTINCT SURFACE */
    .posko-item-card {
        background: #ffffff !important;
        border: 1.5px solid #d1fae5 !important;
        border-radius: 8px !important;
        box-shadow: 0 4px 12px -2px rgba(16, 185, 129, 0.08), 0 2px 5px -1px rgba(15, 23, 42, 0.04) !important;
        transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1) !important;
    }

    .posko-item-card:hover {
        background: #ffffff !important;
        border-color: #34d399 !important;
        box-shadow: 0 12px 28px -4px rgba(16, 185, 129, 0.18), 0 4px 10px -2px rgba(15, 23, 42, 0.04) !important;
        transform: translateY(-2px) !important;
    }

    /* CUSTOM INPUT & SELECT FIELD */
    .form-control,
    .form-select {
        background: #ffffff !important;
        border: 1.5px solid #cbd5e1 !important;
        border-radius: 8px !important;
        padding: 0.5rem 0.75rem !important;
        font-size: 0.875rem !important;
        font-weight: 600 !important;
        color: #0f172a !important;
        transition: all 0.2s ease;
        box-shadow: 0 1px 3px rgba(15, 23, 42, 0.04);
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #059669 !important;
        box-shadow: 0 0 0 3.5px rgba(5, 150, 105, 0.18) !important;
        outline: none;
    }

    /* LIGHT PLACEHOLDER STYLING FOR BETTER CONTRAST */
    .form-control::placeholder,
    textarea.form-control::placeholder {
        color: #94a3b8 !important;
        opacity: 0.75 !important;
        font-weight: 400 !important;
    }

    /* LIGHT FILE INPUT "NO FILE CHOSEN" TEXT STYLING */
    input[type=file] {
        color: #94a3b8 !important;
        font-weight: 400 !important;
    }

    input[type=file]::file-selector-button,
    input[type=file]::-webkit-file-upload-button {
        background-color: #f1f5f9 !important;
        color: #0f172a !important;
        border: 1px solid #cbd5e1 !important;
        border-radius: 6px !important;
        padding: 0.25rem 0.65rem !important;
        font-weight: 600 !important;
        margin-right: 0.75rem !important;
        transition: all 0.2s ease !important;
        cursor: pointer !important;
    }

    input[type=file]::file-selector-button:hover,
    input[type=file]::-webkit-file-upload-button:hover {
        background-color: #e2e8f0 !important;
        color: #059669 !important;
        border-color: #a7f3d0 !important;
    }

    /* SELECTED FILE TEXT COLOR (MATCHING SECTION 4 HEADER EMERALD GREEN COLOR #064e3b) */
    input[type=file].has-file {
        color: #064e3b !important;
        font-weight: 700 !important;
    }

    /* DISABLED & READONLY AUTO-FILLED FIELD CURSOR STYLING */
    .form-control:disabled,
    .form-control[readonly],
    input:disabled,
    input[readonly],
    textarea:disabled,
    textarea[readonly],
    select:disabled {
        cursor: not-allowed !important;
        background-color: #f1f5f9 !important;
        color: #64748b !important;
        opacity: 0.85 !important;
    }

    .form-check-input:checked {
        background-color: #059669 !important;
        border-color: #059669 !important;
    }

    /* HIDE NUMBER INPUT SPINNERS FOR CLEAN NUMERIC FIELDS */
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    input[type=number] {
        -moz-appearance: textfield;
    }

    /* PSYAID NAV TABS STYLING */
    .victim-tabs-header {
        background: rgba(236, 253, 245, 0.85) !important;
        border-bottom: 1.5px solid #a7f3d0 !important;
        padding: 0.35rem 0.5rem 0 0.5rem !important;
        border-top-left-radius: 8px !important;
        border-top-right-radius: 8px !important;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }

    .victim-tabs-header .nav-tabs {
        flex-wrap: nowrap;
    }

    .victim-tabs-header .nav-link {
        color: #047857 !important;
        font-weight: 700 !important;
        font-size: 0.8125rem !important;
        border: none !important;
        border-bottom: 3.5px solid transparent !important;
        border-radius: 6px 6px 0 0 !important;
        padding: 0.65rem 1rem !important;
        white-space: nowrap;
        transition: all 0.2s ease;
    }

    .victim-tabs-header .nav-link:hover {
        color: #064e3b !important;
        background: rgba(255, 255, 255, 0.6) !important;
    }

    .victim-tabs-header .nav-link.active {
        color: #064e3b !important;
        background: #ffffff !important;
        border-bottom: 3.5px solid #059669 !important;
        box-shadow: 0 -2px 6px rgba(16, 185, 129, 0.1) !important;
    }

    /* CUSTOM FLOATING DROPDOWN SYSTEM MATCHING POSKOMANAGEMENT */
    .frost-custom-select-wrapper {
        position: relative;
        z-index: 50;
    }

    .frost-custom-select-wrapper.active-dropdown {
        z-index: 99999 !important;
    }

    .frost-custom-trigger {
        background: #ffffff;
        border: 1.5px solid #cbd5e1;
        border-radius: 8px !important;
        padding: 0.5rem 0.75rem;
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

    .frost-custom-trigger:hover {
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
        z-index: 999999 !important;
        background: #ffffff;
        backdrop-filter: blur(20px) saturate(180%);
        -webkit-backdrop-filter: blur(20px) saturate(180%);
        border: 1.5px solid #059669;
        border-radius: 8px !important;
        box-shadow: 0 16px 40px -4px rgba(15, 23, 42, 0.22), 0 4px 16px rgba(0, 0, 0, 0.08);
        max-height: 260px;
        overflow-y: auto;
        padding: 0.35rem;
        display: none;
    }

    .frost-custom-menu.show {
        display: block;
    }

    .frost-custom-option {
        padding: 0.55rem 0.75rem;
        font-size: 0.85rem;
        font-weight: 600;
        color: #334155;
        border-radius: 6px !important;
        cursor: pointer;
        transition: all 0.15s ease;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .frost-custom-option:hover {
        background-color: #ecfdf5;
        color: #047857;
    }

    .frost-custom-option.selected {
        background-color: #059669;
        color: #ffffff !important;
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

    @media (max-width: 767.98px) {
        .victim-tabs-header .nav-link {
            padding: 0.55rem 0.75rem !important;
            font-size: 0.75rem !important;
        }

        .tab-btn-footer {
            flex-direction: column !important;
            gap: 0.65rem !important;
        }

        .tab-btn-footer .btn,
        .tab-btn-footer .frost-btn-primary,
        .tab-btn-footer .frost-btn-reset {
            width: 100% !important;
            justify-content: center !important;
        }
    }
</style>

<!-- Hero Header Card (Matching PoskoDetail style) -->
<div class="card frost-hero mb-4">
    <div class="card-body p-4 position-relative">
        <div class="d-flex align-items-center gap-2 mb-2 flex-wrap">
            <span class="badge px-3 py-1.5 fs-8 fw-bold"
                style="background-color: rgba(6, 95, 70, 0.12); color: #065f46; border: 1px solid rgba(6, 95, 70, 0.25);">
                <i class="bi bi-person-vcard-fill me-1"></i> REKAM MEDIS WORKSPACE
            </span>
            <span class="badge px-3 py-1.5 fs-8"
                style="background-color: rgba(6, 95, 70, 0.08); color: #047857; border: 1px solid rgba(6, 95, 70, 0.18);">
                <i class="bi bi-house-heart-fill me-1"></i> <?= esc($victim['posko_name']) ?>
            </span>
        </div>
        <h3 class="fw-bold mb-1" style="color: #064e3b;">
            <i class="bi bi-person-badge-fill me-2" style="color: #059669;"></i> Rekam Medis & Asesmen Penyintas
        </h3>
        <p class="small mb-0" style="color: #047857; max-width: 75ch;">
            Kelola data identitas, dampak bencana, riwayat medis psikologis, serta skrining awal penyintas.
        </p>
    </div>
</div>

<!-- Display Flash Messages -->
<?php if (session()->getFlashdata('errors')): ?>
    <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
        <h6 class="fw-bold mb-2"><i class="bi bi-exclamation-triangle-fill me-1"></i> Terdapat Kesalahan Pengisian Form:
        </h6>
        <ul class="mb-0 ps-3">
            <?php foreach (session()->getFlashdata('errors') as $error): ?>
                <li><?= esc($error) ?></li>
            <?php endforeach; ?>
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<!-- Single Page Nav Tabs Container -->
<div class="card frost-card mb-4">
    <div class="card-header victim-tabs-header">
        <ul class="nav nav-tabs card-header-tabs m-0 border-0" id="victimDetailTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="identitas-tab" data-bs-toggle="tab" data-bs-target="#tab-identitas"
                    type="button" role="tab">
                    <i class="bi bi-card-heading me-1"></i> 1. Identitas
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="bencana-tab" data-bs-toggle="tab" data-bs-target="#tab-bencana"
                    type="button" role="tab">
                    <i class="bi bi-exclamation-octagon me-1"></i> 2. Info Bencana
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="psikologis-tab" data-bs-toggle="tab" data-bs-target="#tab-psikologis"
                    type="button" role="tab">
                    <i class="bi bi-journal-medical me-1"></i> 3. Riwayat Psikologis
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="screening-tab" data-bs-toggle="tab" data-bs-target="#tab-screening"
                    type="button" role="tab">
                    <i class="bi bi-clipboard-pulse me-1"></i> 4. Skrining Relawan
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="summary-tab" data-bs-toggle="tab" data-bs-target="#tab-summary"
                    type="button" role="tab">
                    <i class="bi bi-file-earmark-text me-1"></i> 5. Summary
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="ai-tab" data-bs-toggle="tab" data-bs-target="#tab-ai" type="button"
                    role="tab">
                    <i class="bi bi-cpu me-1"></i> 6. AI Assessment
                </button>
            </li>
        </ul>
    </div>

    <div class="card-body p-4">
        <div class="tab-content" id="victimDetailTabContent">

            <!-- TAB 1: IDENTITAS PENYINTAS -->
            <div class="tab-pane fade show active" id="tab-identitas" role="tabpanel">
                <form
                    action="<?= empty($victim['id']) ? site_url('/victim/store/' . $victim['posko_id']) : site_url('/victim/update/' . $victim['id']) ?>"
                    method="POST">
                    <?= csrf_field() ?>
                    <div class="border-bottom pb-3 mb-4">
                        <h5 class="fw-bold mb-1" style="color: #064e3b;"><i
                                class="bi bi-person-vcard text-success me-2"></i> Section 1 - Identitas Penyintas</h5>
                        <p class="text-muted small mb-0">Isi dan perbarui data identitas diri serta kontak keluarga
                            penyintas bencana.</p>
                    </div>

                    <div class="row g-3">
                        <div class="col-12 col-md-6">
                            <label for="nama" class="form-label fw-semibold">Nama Lengkap Penyintas <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="nama" name="nama"
                                placeholder="Contoh: Budi Santoso" value="<?= old('nama', $victim['nama']) ?>" required>
                        </div>

                        <div class="col-12 col-sm-6 col-md-3">
                            <label for="jenis_kelamin" class="form-label fw-semibold">Jenis Kelamin <span
                                    class="text-danger">*</span></label>
                            <select id="jenis_kelamin" name="jenis_kelamin" class="d-none" required>
                                <option value="L" <?= old('jenis_kelamin', $victim['jenis_kelamin']) === 'L' ? 'selected' : '' ?>>Laki-Laki (L)</option>
                                <option value="P" <?= old('jenis_kelamin', $victim['jenis_kelamin']) === 'P' ? 'selected' : '' ?>>Perempuan (P)</option>
                            </select>

                            <?php
                            $jkVal = old('jenis_kelamin', $victim['jenis_kelamin']);
                            $jkLabel = ($jkVal === 'P') ? 'Perempuan (P)' : 'Laki-Laki (L)';
                            ?>
                            <div class="frost-custom-select-wrapper" id="custom-wrapper-jk">
                                <div class="frost-custom-trigger" id="trigger-jk" tabindex="0">
                                    <span class="trigger-label text-truncate" id="label-jk"><?= esc($jkLabel) ?></span>
                                    <i class="bi bi-chevron-down chevron-icon ms-2"></i>
                                </div>
                                <div class="frost-custom-menu" id="menu-jk">
                                    <div class="frost-custom-option <?= ($jkVal === 'L' || empty($jkVal)) ? 'selected' : '' ?>"
                                        data-value="L">
                                        <span>Laki-Laki (L)</span>
                                        <?php if ($jkVal === 'L' || empty($jkVal)): ?><i
                                                class="bi bi-check-lg text-emerald-600"></i><?php endif; ?>
                                    </div>
                                    <div class="frost-custom-option <?= ($jkVal === 'P') ? 'selected' : '' ?>"
                                        data-value="P">
                                        <span>Perempuan (P)</span>
                                        <?php if ($jkVal === 'P'): ?><i
                                                class="bi bi-check-lg text-emerald-600"></i><?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-md-3">
                            <label for="umur" class="form-label fw-semibold">Umur (Tahun) <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="umur" name="umur" maxlength="2"
                                inputmode="numeric" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 2)"
                                placeholder="Contoh: 35" value="<?= old('umur', $victim['umur']) ?>" required>
                        </div>

                        <div class="col-12 col-md-6">
                            <label for="nik" class="form-label fw-semibold">Nomor Induk Kependudukan (NIK)</label>
                            <input type="text" class="form-control" id="nik" name="nik" maxlength="16"
                                inputmode="numeric" oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                placeholder="Masukkan 16 digit NIK (Opsional)..."
                                value="<?= old('nik', $victim['nik']) ?>">
                        </div>

                        <div class="col-12 col-md-6">
                            <label for="no_hp_keluarga" class="form-label fw-semibold">No HP / Kontak Keluarga <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="no_hp_keluarga" name="no_hp_keluarga"
                                inputmode="numeric" oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                placeholder="Contoh: 081234567890..."
                                value="<?= old('no_hp_keluarga', $victim['no_hp_keluarga']) ?>" required>
                        </div>

                        <div class="col-12">
                            <label for="alamat" class="form-label fw-semibold">Alamat Asal Penyintas</label>
                            <textarea class="form-control" id="alamat" name="alamat" rows="2"
                                placeholder="Contoh: Dusun Cibeureum RT 02/RW 05, Desa Cugenang..."><?= old('alamat', $victim['alamat']) ?></textarea>
                        </div>

                        <div class="col-12 col-sm-6 col-md-4">
                            <label for="tanggal_datang" class="form-label fw-semibold">Tanggal Tiba di Posko <span
                                    class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="tanggal_datang" name="tanggal_datang"
                                value="<?= old('tanggal_datang', $victim['tanggal_datang']) ?>" required>
                        </div>

                        <div class="col-12 col-sm-6 col-md-4">
                            <label for="jam_datang" class="form-label fw-semibold">Jam Tiba di Posko <span
                                    class="text-danger">*</span></label>
                            <input type="time" class="form-control" id="jam_datang" name="jam_datang"
                                value="<?= old('jam_datang', $victim['jam_datang']) ?>" required>
                        </div>

                        <div class="col-12 col-md-4">
                            <label for="ditemukan_oleh_relawan_id" class="form-label fw-semibold">
                                Ditemukan Oleh Relawan
                            </label>
                            <?php
                            $relawanId = old('ditemukan_oleh_relawan_id', $victim['ditemukan_oleh_relawan_id']) ?: session()->get('user_id');
                            $relawanNama = !empty($victim['relawan_nama']) ? $victim['relawan_nama'] : session()->get('name');
                            ?>
                            <input type="text" class="form-control bg-light" value="<?= esc($relawanNama) ?>" readonly
                                disabled>
                            <input type="hidden" name="ditemukan_oleh_relawan_id" value="<?= esc($relawanId) ?>">
                            <div class="form-text text-muted fs-8"><i class="bi bi-info-circle me-1"></i> Otomatis
                                terisi dari akun relawan bertugas.</div>
                        </div>
                    </div>

                    <input type="hidden" name="next_tab" value="bencana">
                    <div
                        class="border-top pt-3 mt-4 d-flex justify-content-between align-items-center flex-wrap gap-2 tab-btn-footer">
                        <button type="reset" class="frost-btn-reset px-4 py-2">
                            <i class="bi bi-arrow-counterclockwise me-1"></i> Reset Form Identitas
                        </button>
                        <button type="submit" class="frost-btn-primary px-4 py-2">
                            <i class="bi bi-floppy-fill me-1"></i> Simpan & Lanjut ke Info Bencana <i
                                class="bi bi-arrow-right ms-1"></i>
                        </button>
                    </div>
                </form>
            </div>

            <!-- TAB 2: INFORMASI BENCANA -->
            <div class="tab-pane fade" id="tab-bencana" role="tabpanel">
                <?php if (empty($victim['id'])): ?>
                    <div class="alert alert-warning border-start border-4 border-warning p-4 shadow-sm my-3">
                        <h6 class="fw-bold mb-1" style="color: #064e3b;"><i class="bi bi-info-circle-fill me-2"></i> Belum
                            Dapat Mengisi Informasi Bencana</h6>
                        <p class="mb-0 small text-dark">Silakan isi dan simpan data <strong>Identitas (Section 1)</strong>
                            terlebih dahulu untuk mendaftarkan penyintas ini.</p>
                    </div>
                <?php else: ?>
                    <form action="<?= site_url('/victim/update/' . $victim['id']) ?>" method="POST">
                        <?= csrf_field() ?>
                        <!-- Hidden Identitas values for safety -->
                        <input type="hidden" name="nama" value="<?= esc($victim['nama']) ?>">
                        <input type="hidden" name="jenis_kelamin" value="<?= esc($victim['jenis_kelamin']) ?>">
                        <input type="hidden" name="umur" value="<?= esc($victim['umur']) ?>">
                        <input type="hidden" name="nik" value="<?= esc($victim['nik'] ?? '') ?>">
                        <input type="hidden" name="no_hp_keluarga" value="<?= esc($victim['no_hp_keluarga'] ?? '') ?>">
                        <input type="hidden" name="alamat" value="<?= esc($victim['alamat'] ?? '') ?>">
                        <input type="hidden" name="tanggal_datang" value="<?= esc($victim['tanggal_datang']) ?>">
                        <input type="hidden" name="jam_datang" value="<?= esc($victim['jam_datang']) ?>">
                        <input type="hidden" name="ditemukan_oleh_relawan_id"
                            value="<?= esc($victim['ditemukan_oleh_relawan_id'] ?? '') ?>">

                        <div class="border-bottom pb-3 mb-4">
                            <h5 class="fw-bold mb-1" style="color: #064e3b;"><i class="bi bi-tsunami text-danger me-2"></i>
                                Section 2 - Informasi & Dampak Bencana</h5>
                            <p class="text-muted small mb-0">Catat kondisi kedaruratan, durasi terjebak, dan dampak riil
                                bencana pada penyintas.</p>
                        </div>

                        <div class="row g-3">
                            <div class="col-12 col-md-4">
                                <label for="jenis_bencana" class="form-label fw-semibold">Jenis Bencana</label>
                                <input type="text" class="form-control" id="jenis_bencana" name="jenis_bencana"
                                    placeholder="Contoh: Gempa Bumi, Tanah Longsor..."
                                    value="<?= old('jenis_bencana', $disasterInfo['jenis_bencana'] ?? $victim['posko_bencana'] ?? 'Gempa Bumi') ?>">
                            </div>

                            <div class="col-12 col-md-4">
                                <label for="lokasi_bencana" class="form-label fw-semibold">Lokasi Bencana <span
                                        class="badge bg-secondary ms-1">Auto Posko</span></label>
                                <input type="text" class="form-control bg-light" id="lokasi_bencana"
                                    value="<?= esc(($victim['regency_name'] ?? '') . ', ' . ($victim['province_name'] ?? '')) ?>"
                                    readonly disabled>
                                <div class="form-text text-muted fs-8"><i class="bi bi-info-circle me-1"></i> Otomatis
                                    terisi dari wilayah Posko terdaftar milik relawan.</div>
                            </div>

                            <div class="col-12 col-md-4">
                                <label for="tanggal_bencana" class="form-label fw-semibold">Tanggal Kejadian Bencana</label>
                                <input type="date" class="form-control" id="tanggal_bencana" name="tanggal_bencana"
                                    value="<?= old('tanggal_bencana', $disasterInfo['tanggal'] ?? date('Y-m-d')) ?>">
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-semibold d-block">Durasi Terjebak Reruntuhan / Bencana</label>
                                <div class="d-flex flex-wrap gap-4 bg-light p-3 rounded border">
                                    <?php $durasi = old('durasi_terjebak', $disasterInfo['durasi_terjebak'] ?? '<1 jam'); ?>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="durasi_terjebak" id="durasi1"
                                            value="<1 jam" <?= $durasi === '<1 jam' ? 'checked' : '' ?>>
                                        <label class="form-check-label fw-medium" for="durasi1">Kurang dari 1 Jam (&lt;1
                                            jam)</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="durasi_terjebak" id="durasi2"
                                            value="1-6 jam" <?= $durasi === '1-6 jam' ? 'checked' : '' ?>>
                                        <label class="form-check-label fw-medium text-warning" for="durasi2">1 sampai 6 Jam
                                            (1-6 jam)</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="durasi_terjebak" id="durasi3"
                                            value=">6 jam" <?= $durasi === '>6 jam' ? 'checked' : '' ?>>
                                        <label class="form-check-label fw-medium text-danger" for="durasi3">Lebih dari 6 Jam
                                            (&gt;6 jam)</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 mt-4">
                                <label class="form-label fw-semibold d-block mb-3">Indikator Dampak Bencana (Centang Jika
                                    "Ya")</label>
                                <div class="row g-3">
                                    <div class="col-12 col-sm-6 col-md-4">
                                        <div class="card card-custom p-3 bg-light border">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="mengungsi"
                                                    name="mengungsi" value="1" <?= old('mengungsi', $disasterInfo['mengungsi'] ?? 0) ? 'checked' : '' ?>>
                                                <label class="form-check-label fw-semibold text-dark" for="mengungsi">Status
                                                    Mengungsi</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-4">
                                        <div class="card card-custom p-3 bg-light border">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="kehilangan_rumah"
                                                    name="kehilangan_rumah" value="1" <?= old('kehilangan_rumah', $disasterInfo['kehilangan_rumah'] ?? 0) ? 'checked' : '' ?>>
                                                <label class="form-check-label fw-semibold text-dark"
                                                    for="kehilangan_rumah">Kehilangan Rumah / Hancur</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-4">
                                        <div class="card card-custom p-3 bg-light border">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="kehilangan_keluarga"
                                                    name="kehilangan_keluarga" value="1" <?= old('kehilangan_keluarga', $disasterInfo['kehilangan_keluarga'] ?? 0) ? 'checked' : '' ?>>
                                                <label class="form-check-label fw-semibold text-dark"
                                                    for="kehilangan_keluarga">Kehilangan Anggota Keluarga</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-4">
                                        <div class="card card-custom p-3 bg-light border">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="cedera" name="cedera"
                                                    value="1" <?= old('cedera', $disasterInfo['cedera'] ?? 0) ? 'checked' : '' ?>>
                                                <label class="form-check-label fw-semibold text-dark" for="cedera">Menderita
                                                    Cedera Fisik</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-4">
                                        <div class="card card-custom p-3 bg-light border">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="rawat_inap"
                                                    name="rawat_inap" value="1" <?= old('rawat_inap', $disasterInfo['rawat_inap'] ?? 0) ? 'checked' : '' ?>>
                                                <label class="form-check-label fw-semibold text-dark"
                                                    for="rawat_inap">Sedang / Sempat Rawat Inap</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-4">
                                        <div class="card card-custom p-3 bg-light border">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="saksi_kematian"
                                                    name="saksi_kematian" value="1" <?= old('saksi_kematian', $disasterInfo['saksi_kematian'] ?? 0) ? 'checked' : '' ?>>
                                                <label class="form-check-label fw-semibold text-danger"
                                                    for="saksi_kematian">Saksi Kematian Korban Lain</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="next_tab" value="psikologis">
                        <div
                            class="border-top pt-3 mt-4 d-flex justify-content-between align-items-center flex-wrap gap-2 tab-btn-footer">
                            <button type="reset" class="frost-btn-reset px-4 py-2">
                                <i class="bi bi-arrow-counterclockwise me-1"></i> Reset Form Info Bencana
                            </button>
                            <button type="submit" class="frost-btn-primary px-4 py-2">
                                <i class="bi bi-floppy-fill me-1"></i> Simpan & Lanjut ke Riwayat Psikologis <i
                                    class="bi bi-arrow-right ms-1"></i>
                            </button>
                        </div>
                    </form>
                <?php endif; ?>
            </div>

            <!-- TAB 3: RIWAYAT PSIKOLOGIS (SEGMEN 6) -->
            <div class="tab-pane fade" id="tab-psikologis" role="tabpanel">
                <?php if (empty($victim['id'])): ?>
                    <div class="alert alert-warning border-start border-4 border-warning p-4 shadow-sm my-3">
                        <h6 class="fw-bold mb-1" style="color: #064e3b;"><i class="bi bi-info-circle-fill me-2"></i> Belum
                            Dapat
                            Mengisi Riwayat Psikologis</h6>
                        <p class="mb-0 small text-dark">Silakan isi dan simpan data <strong>Identitas (Section 1)</strong>
                            terlebih dahulu untuk mendaftarkan penyintas ini.</p>
                    </div>
                <?php elseif ($userRole === 'bpbd_admin'): ?>
                    <div class="alert alert-warning border-start border-4 border-warning p-4 shadow-sm my-3">
                        <h5 class="fw-bold text-dark mb-2"><i class="bi bi-shield-lock-fill text-warning me-2"></i> Hak
                            Akses
                            Dibatasi</h5>
                        <p class="mb-0">
                            Data riwayat psikologis individual adalah informasi medis sensitif dan <strong>HANYA</strong>
                            dapat
                            diakses oleh <strong>Relawan Lapangan</strong> (saat input) dan <strong>Psikolog Klinis</strong>
                            (saat review). Role BPBD Admin di Command Center hanya mengakses data statistik agregat.
                        </p>
                    </div>
                <?php else: ?>
                    <form action="<?= site_url('/victim/update-psychological/' . $victim['id']) ?>" method="POST">
                        <?= csrf_field() ?>
                        <div class="border-bottom pb-3 mb-4">
                            <h5 class="fw-bold mb-1" style="color: #064e3b;"><i
                                    class="bi bi-journal-medical text-success me-2"></i> Section 3 - Riwayat Medis &
                                Psikologis
                                Sensitif</h5>
                            <p class="text-muted small mb-0">Kerahasiaan data terjamin. Hanya dapat diakses oleh Relawan dan
                                Psikolog bertugas.</p>
                        </div>

                        <div class="row g-4">
                            <!-- Konsultasi & Psikiater -->
                            <div class="col-12 col-md-6">
                                <div class="card card-custom bg-light p-3 border">
                                    <div class="form-check form-switch mb-3">
                                        <input class="form-check-input" type="checkbox" id="pernah_konsultasi"
                                            name="pernah_konsultasi" value="1" <?= old('pernah_konsultasi', $psychHist['pernah_konsultasi'] ?? 0) ? 'checked' : '' ?>>
                                        <label class="form-check-label fw-semibold text-dark" for="pernah_konsultasi">Pernah
                                            Konsultasi ke Psikolog?</label>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="pernah_dirawat_psikiater"
                                            name="pernah_dirawat_psikiater" value="1" <?= old('pernah_dirawat_psikiater', $psychHist['pernah_dirawat_psikiater'] ?? 0) ? 'checked' : '' ?>>
                                        <label class="form-check-label fw-semibold text-dark"
                                            for="pernah_dirawat_psikiater">Pernah Dirawat oleh Psikiater?</label>
                                    </div>
                                </div>
                            </div>

                            <!-- Suicide / Self-Harm / NAPZA -->
                            <div class="col-12 col-md-6">
                                <div class="card card-custom bg-light p-3 border border-danger border-opacity-25">
                                    <div class="form-check form-switch mb-2">
                                        <input class="form-check-input" type="checkbox" id="riwayat_percobaan_bunuh_diri"
                                            name="riwayat_percobaan_bunuh_diri" value="1"
                                            <?= old('riwayat_percobaan_bunuh_diri', $psychHist['riwayat_percobaan_bunuh_diri'] ?? 0) ? 'checked' : '' ?>>
                                        <label class="form-check-label fw-semibold text-danger"
                                            for="riwayat_percobaan_bunuh_diri">Riwayat Percobaan Bunuh Diri</label>
                                    </div>
                                    <div class="form-check form-switch mb-2">
                                        <input class="form-check-input" type="checkbox" id="riwayat_melukai_diri"
                                            name="riwayat_melukai_diri" value="1" <?= old('riwayat_melukai_diri', $psychHist['riwayat_melukai_diri'] ?? 0) ? 'checked' : '' ?>>
                                        <label class="form-check-label fw-semibold text-danger"
                                            for="riwayat_melukai_diri">Riwayat Melukai Diri (Self-Harm)</label>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="riwayat_napza"
                                            name="riwayat_napza" value="1" <?= old('riwayat_napza', $psychHist['riwayat_napza'] ?? 0) ? 'checked' : '' ?>>
                                        <label class="form-check-label fw-semibold text-dark" for="riwayat_napza">Riwayat
                                            Penggunaan NAPZA</label>
                                    </div>
                                </div>
                            </div>

                            <!-- Diagnosis Sebelumnya Multiple Checkbox -->
                            <div class="col-12">
                                <label class="form-label fw-semibold d-block">Diagnosis Sebelumnya (Boleh Pilih Lebih dari
                                    Satu)</label>
                                <div class="row g-2 bg-light p-3 rounded border">
                                    <?php
                                    $diagOptions = ['Depresi', 'PTSD', 'Bipolar', 'Panic Disorder', 'Skizofrenia', 'ADHD'];
                                    foreach ($diagOptions as $dOpt):
                                        $isChecked = in_array($dOpt, $savedDiagnoses, true);
                                        ?>
                                        <div class="col-6 col-sm-4 col-md-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="diagnosis[]"
                                                    value="<?= $dOpt ?>" id="diag_<?= $dOpt ?>" <?= $isChecked ? 'checked' : '' ?>>
                                                <label class="form-check-label fw-medium"
                                                    for="diag_<?= $dOpt ?>"><?= $dOpt ?></label>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>

                                    <?php
                                    $lainnyaVal = '';
                                    foreach ($savedDiagnoses as $sD) {
                                        if (strpos($sD, 'Lainnya: ') === 0) {
                                            $lainnyaVal = substr($sD, 9);
                                        }
                                    }
                                    ?>
                                    <div class="col-12 mt-3 pt-3 border-top">
                                        <label for="diagnosis_lainnya"
                                            class="form-label small fw-semibold text-dark mb-2 d-flex align-items-center flex-wrap gap-2">
                                            <span class="badge px-2.5 py-1.5 fw-semibold fs-8"
                                                style="background-color: #d1fae5; color: #065f46; border: 1px solid #a7f3d0; border-radius: 6px;">
                                                <i class="bi bi-pencil-square me-1"></i> Diagnosis Lainnya
                                            </span>
                                            <span class="text-muted fs-8">(Opsional, jika ada diagnosis lain di luar pilihan
                                                di atas)</span>
                                        </label>
                                        <input type="text" class="form-control form-control-sm" id="diagnosis_lainnya"
                                            name="diagnosis_lainnya"
                                            placeholder="Contoh: Skizofrenia Paranoik, Gangguan Kecemasan Terpisah..."
                                            value="<?= esc($lainnyaVal) ?>">
                                    </div>
                                </div>
                            </div>

                            <!-- Dynamic Toggle: Sedang Konsumsi Obat -->
                            <div class="col-12 col-md-6">
                                <div class="card card-custom p-3 border">
                                    <div class="form-check form-switch mb-3">
                                        <input class="form-check-input" type="checkbox" id="sedang_konsumsi_obat"
                                            name="sedang_konsumsi_obat" value="1" <?= old('sedang_konsumsi_obat', $psychHist['sedang_konsumsi_obat'] ?? 0) ? 'checked' : '' ?>
                                            onchange="toggleMedicineFields(this.checked)">
                                        <label class="form-check-label fw-semibold text-dark"
                                            for="sedang_konsumsi_obat">Sedang
                                            Konsumsi Obat-obatan?</label>
                                    </div>

                                    <div id="medicine-fields"
                                        class="<?= old('sedang_konsumsi_obat', $psychHist['sedang_konsumsi_obat'] ?? 0) ? '' : 'd-none' ?>">
                                        <div class="mb-2">
                                            <label class="form-label small fw-semibold">Nama Obat</label>
                                            <input type="text" class="form-control form-control-sm" name="nama_obat"
                                                value="<?= old('nama_obat', $psychHist['nama_obat'] ?? '') ?>"
                                                placeholder="Contoh: Sertraline, Alprazolam, Risperidone...">
                                        </div>
                                        <div class="mb-2">
                                            <label class="form-label small fw-semibold">Dosis</label>
                                            <input type="text" class="form-control form-control-sm" name="dosis"
                                                value="<?= old('dosis', $psychHist['dosis'] ?? '') ?>"
                                                placeholder="Contoh: 50mg (1x1 tablet per hari)...">
                                        </div>
                                        <div>
                                            <label class="form-label small fw-semibold">Dokter Penanggung Jawab</label>
                                            <input type="text" class="form-control form-control-sm" name="dokter"
                                                value="<?= old('dokter', $psychHist['dokter'] ?? '') ?>"
                                                placeholder="Contoh: dr. Ahmad, Sp.KJ / RSUD Cianjur...">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Dynamic Toggle: Riwayat Penyakit Kronis -->
                            <div class="col-12 col-md-6">
                                <div class="card card-custom p-3 border">
                                    <div class="form-check form-switch mb-3">
                                        <input class="form-check-input" type="checkbox" id="riwayat_penyakit_kronis"
                                            name="riwayat_penyakit_kronis" value="1" <?= old('riwayat_penyakit_kronis', $psychHist['riwayat_penyakit_kronis'] ?? 0) ? 'checked' : '' ?>
                                            onchange="toggleChronicFields(this.checked)">
                                        <label class="form-check-label fw-semibold text-dark"
                                            for="riwayat_penyakit_kronis">Riwayat Penyakit Kronis Fisik?</label>
                                    </div>

                                    <div id="chronic-fields"
                                        class="<?= old('riwayat_penyakit_kronis', $psychHist['riwayat_penyakit_kronis'] ?? 0) ? '' : 'd-none' ?>">
                                        <label class="form-label small fw-semibold">Keterangan Penyakit Kronis</label>
                                        <textarea class="form-control form-control-sm" name="keterangan_penyakit_kronis"
                                            rows="3"
                                            placeholder="Contoh: Hipertensi stadium 1, Diabetes Melitus tipe 2, Asma bronkial..."><?= old('keterangan_penyakit_kronis', $psychHist['keterangan_penyakit_kronis'] ?? '') ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="next_tab" value="screening">
                        <div
                            class="border-top pt-3 mt-4 d-flex justify-content-between align-items-center flex-wrap gap-2 tab-btn-footer">
                            <button type="reset" class="frost-btn-reset px-4 py-2">
                                <i class="bi bi-arrow-counterclockwise me-1"></i> Reset Form Riwayat Psikologis
                            </button>
                            <button type="submit" class="frost-btn-primary px-4 py-2">
                                <i class="bi bi-floppy-fill me-1"></i> Simpan & Lanjut ke Skrining Relawan <i
                                    class="bi bi-arrow-right ms-1"></i>
                            </button>
                        </div>
                    </form>
                <?php endif; ?>
            </div>

            <!-- TAB 4: FORM SCREENING AWAL RELAWAN (SEGMEN 7) -->
            <div class="tab-pane fade" id="tab-screening" role="tabpanel">
                <?php if (empty($victim['id'])): ?>
                    <div class="alert alert-warning border-start border-4 border-warning p-4 shadow-sm my-3">
                        <h6 class="fw-bold mb-1" style="color: #064e3b;"><i class="bi bi-info-circle-fill me-2"></i> Belum
                            Dapat
                            Mengisi Skrining Relawan</h6>
                        <p class="mb-0 small text-dark">Silakan isi dan simpan data <strong>Identitas (Section 1)</strong>
                            terlebih dahulu untuk mendaftarkan penyintas ini.</p>
                    </div>
                <?php elseif ($userRole === 'bpbd_admin'): ?>
                    <div class="alert alert-warning border-start border-4 border-warning p-4 shadow-sm my-3">
                        <h5 class="fw-bold text-dark mb-2"><i class="bi bi-shield-lock-fill text-warning me-2"></i> Hak
                            Akses
                            Dibatasi</h5>
                        <p class="mb-0">Form Skrining Awal Relawan merupakan instrumen observasi lapangan yang diisi oleh
                            <strong>Relawan Posko</strong> dan ditinjau oleh <strong>Psikolog</strong>.
                        </p>
                    </div>
                <?php else: ?>
                    <!-- EMERGENCY SUICIDE RISK ALERT BANNER (Non-Dismissable) -->
                    <div id="emergency-suicide-alert"
                        class="alert alert-danger border-3 border-danger shadow p-3 mb-4 d-none" role="alert">
                        <div class="d-flex align-items-center gap-3">
                            <div class="display-5 text-danger"><i class="bi bi-exclamation-triangle-fill"></i></div>
                            <div>
                                <h5 class="fw-bold text-danger mb-1">⚠️ PERINGATAN DARURAT KRISIS: RISIKO BUNUH DIRI
                                    TERDETEKSI!
                                </h5>
                                <p class="mb-1 text-dark small">
                                    Penyintas menunjukkan indikasi serius (menyebut ingin mati / mengancam bunuh diri /
                                    melukai
                                    diri).
                                    Relawan diinstruksikan untuk <strong>SEGERA MENGHUBUNGI PSIKOLOG JAGA / HOTLINE
                                        POSKO</strong> secara langsung tanpa menunda!
                                </p>
                                <div class="fw-bold text-danger fs-6">
                                    <i class="bi bi-telephone-fill me-1"></i> Hotline Psikolog Jaga: <strong>0800-1-PSY-AID
                                        (Ext. 99)</strong> / Posko Utama
                                </div>
                            </div>
                        </div>
                    </div>

                    <form action="<?= site_url('/screening/store/' . $victim['id']) ?>" method="POST"
                        enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        <div class="border-bottom pb-3 mb-4 d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="fw-bold mb-1" style="color: #064e3b;"><i
                                        class="bi bi-clipboard-pulse text-success me-2"></i> Section 4 - Form Screening Awal
                                    Relawan</h5>
                                <p class="text-muted small mb-0">Observasi gejala fisik, perilaku, dan tingkat distres
                                    psikologis penyintas di lapangan.</p>
                            </div>
                            <?php if ($screening): ?>
                                <span class="badge bg-success px-3 py-2 fs-7"><i class="bi bi-check-circle-fill me-1"></i>
                                    Terakhir
                                    Diisi: <?= esc($screening['created_at']) ?></span>
                            <?php endif; ?>
                        </div>

                        <!-- 1. Orientasi & Kontak -->
                        <div class="card card-custom p-3 bg-light border mb-4">
                            <h6 class="fw-bold text-dark mb-3"><i class="bi bi-compass me-1 text-primary"></i> 1. Observasi
                                Orientasi & Respon Bicara</h6>
                            <div class="row g-3">
                                <div class="col-12 col-md-4">
                                    <label class="form-label small fw-semibold">Kemampuan Orientasi</label>
                                    <div class="form-check form-switch mb-1">
                                        <input class="form-check-input" type="checkbox" id="mampu_sebut_nama"
                                            name="mampu_sebut_nama" value="1" <?= old('mampu_sebut_nama', $screening['mampu_sebut_nama'] ?? 1) ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="mampu_sebut_nama">Mampu sebut
                                            Nama</label>
                                    </div>
                                    <div class="form-check form-switch mb-1">
                                        <input class="form-check-input" type="checkbox" id="mampu_sebut_lokasi"
                                            name="mampu_sebut_lokasi" value="1" <?= old('mampu_sebut_lokasi', $screening['mampu_sebut_lokasi'] ?? 1) ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="mampu_sebut_lokasi">Mampu sebut
                                            Lokasi</label>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="mampu_sebut_tanggal"
                                            name="mampu_sebut_tanggal" value="1" <?= old('mampu_sebut_tanggal', $screening['mampu_sebut_tanggal'] ?? 1) ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="mampu_sebut_tanggal">Mampu sebut
                                            Tanggal/Hari</label>
                                    </div>
                                </div>

                                <div class="col-12 col-md-4">
                                    <label class="form-label small fw-semibold d-block">Kontak Mata</label>
                                    <?php $km = old('kontak_mata', $screening['kontak_mata'] ?? 'baik'); ?>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="kontak_mata" id="km1"
                                            value="baik" <?= $km === 'baik' ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="km1">Baik</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="kontak_mata" id="km2"
                                            value="kurang" <?= $km === 'kurang' ? 'checked' : '' ?>>
                                        <label class="form-check-label small text-warning" for="km2">Kurang</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="kontak_mata" id="km3"
                                            value="tidak ada" <?= $km === 'tidak ada' ? 'checked' : '' ?>>
                                        <label class="form-check-label small text-danger" for="km3">Tidak ada</label>
                                    </div>
                                </div>

                                <div class="col-12 col-md-4">
                                    <label class="form-label small fw-semibold d-block">Cara Berbicara</label>
                                    <?php $bc = old('bicara', $screening['bicara'] ?? 'normal'); ?>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="bicara" id="bc1" value="normal"
                                            <?= $bc === 'normal' ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="bc1">Normal</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="bicara" id="bc2" value="pelan"
                                            <?= $bc === 'pelan' ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="bc2">Pelan / Bisik</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="bicara" id="bc3"
                                            value="tidak menjawab" <?= $bc === 'tidak menjawab' ? 'checked' : '' ?>>
                                        <label class="form-check-label small text-warning" for="bc3">Tidak Menjawab</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="bicara" id="bc4"
                                            value="berteriak" <?= $bc === 'berteriak' ? 'checked' : '' ?>>
                                        <label class="form-check-label small text-danger" for="bc4">Berteriak</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 2. Observasi Perilaku (15 Item) -->
                        <div class="card card-custom p-3 bg-light border mb-4">
                            <h6 class="fw-bold text-dark mb-3"><i class="bi bi-person-exclamation me-1 text-danger"></i> 2.
                                Indikator Perilaku & Gejala Distres</h6>
                            <div class="row g-2">
                                <?php
                                $perilakuItems = [
                                    'menangis_terus' => 'Menangis terus menerus',
                                    'tampak_panik' => 'Tampak sangat panik',
                                    'sulit_ditenangkan' => 'Sulit ditenangkan',
                                    'gemetar' => 'Tubuh gemetar hebat',
                                    'berteriak_histeris' => 'Berteriak histeris',
                                    'diam_total' => 'Diam total (Stupor/Catatonic)',
                                    'menghindari_orang' => 'Menghindari orang lain',
                                    'menyebut_ingin_mati' => '⚠️ Menyebut ingin mati',
                                    'mengancam_bunuh_diri' => '⚠️ Mengancam bunuh diri',
                                    'melukai_diri' => '⚠️ Melukai diri (Self-Harm)',
                                    'agresif' => 'Perilaku agresif / Ngamuk',
                                    'mencari_keluarga' => 'Panik mencari keluarga',
                                    'sulit_tidur' => 'Keluhan sulit tidur / Insomnia',
                                    'mimpi_buruk' => 'Mimpi buruk berulang',
                                    'tidak_mau_makan' => 'Menolak makan / minum',
                                ];

                                foreach ($perilakuItems as $key => $label):
                                    $isEmergency = in_array($key, ['menyebut_ingin_mati', 'mengancam_bunuh_diri', 'melukai_diri'], true);
                                    $isChecked = old($key, $screening[$key] ?? 0);
                                    ?>
                                    <div class="col-12 col-sm-6 col-md-4">
                                        <div
                                            class="p-2 bg-white rounded border <?= $isEmergency ? 'border-danger border-opacity-50' : '' ?>">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input emergency-check" type="checkbox" id="<?= $key ?>"
                                                    name="<?= $key ?>" value="1" <?= $isChecked ? 'checked' : '' ?>
                                                    onchange="checkEmergencyAlert()">
                                                <label
                                                    class="form-check-label small <?= $isEmergency ? 'fw-bold text-danger' : 'text-dark' ?>"
                                                    for="<?= $key ?>">
                                                    <?= $label ?>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <!-- 3. Upload File Dokumen/Media Lapangan -->
                        <div class="card card-custom p-3 bg-light border mb-4">
                            <h6 class="fw-bold text-dark mb-3"><i class="bi bi-paperclip text-info me-1"></i> 3. Upload
                                Dokumentasi Media Lapangan (Opsional)</h6>
                            <div class="row g-3">
                                <div class="col-12 col-sm-6 col-md-3">
                                    <label class="form-label small fw-semibold">Foto Kejadian / Kondisi</label>
                                    <input type="file" class="form-control form-control-sm" name="foto" accept="image/*">
                                    <?php if (!empty($screening['foto_path'])): ?>
                                        <div class="fs-8 text-success mt-1"><i class="bi bi-file-earmark-check"></i> Berkas Foto
                                            Tersimpan</div>
                                    <?php endif; ?>
                                </div>
                                <div class="col-12 col-sm-6 col-md-3">
                                    <label class="form-label small fw-semibold">Voice Note Rekaman Suara</label>
                                    <input type="file" class="form-control form-control-sm" name="voice_note"
                                        accept="audio/*">
                                    <?php if (!empty($screening['voice_note_path'])): ?>
                                        <div class="fs-8 text-success mt-1"><i class="bi bi-file-earmark-check"></i> Voice Note
                                            Tersimpan</div>
                                    <?php endif; ?>
                                </div>
                                <div class="col-12 col-sm-6 col-md-3">
                                    <label class="form-label small fw-semibold">Video Dokumentasi</label>
                                    <input type="file" class="form-control form-control-sm" name="video" accept="video/*">
                                    <?php if (!empty($screening['video_path'])): ?>
                                        <div class="fs-8 text-success mt-1"><i class="bi bi-file-earmark-check"></i> Video
                                            Tersimpan
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="col-12 col-sm-6 col-md-3">
                                    <label class="form-label small fw-semibold">Dokumen / PDF Lapangan</label>
                                    <input type="file" class="form-control form-control-sm" name="dokumen"
                                        accept=".pdf,.doc,.docx">
                                    <?php if (!empty($screening['dokumen_path'])): ?>
                                        <div class="fs-8 text-success mt-1"><i class="bi bi-file-earmark-check"></i> Dokumen
                                            Tersimpan</div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <div
                            class="border-top pt-3 mt-4 d-flex justify-content-between align-items-center flex-wrap gap-2 tab-btn-footer">
                            <button type="reset" class="frost-btn-reset px-4 py-2">
                                <i class="bi bi-arrow-counterclockwise me-1"></i> Reset Form Skrining
                            </button>
                            <button type="submit" class="frost-btn-primary px-4 py-2">
                                <i class="bi bi-cpu-fill me-1"></i> Simpan & Proses AI Assessment <i
                                    class="bi bi-arrow-right ms-1"></i>
                            </button>
                        </div>
                    </form>
                <?php endif; ?>
            </div>

            <!-- TAB 5: SUMMARY & REVIEW DATA PENYINTAS -->
            <div class="tab-pane fade" id="tab-summary" role="tabpanel">
                <?php if (empty($victim['id'])): ?>
                    <div class="alert alert-warning border-start border-4 border-warning p-4 shadow-sm my-3">
                        <h6 class="fw-bold mb-1" style="color: #064e3b;"><i class="bi bi-info-circle-fill me-2"></i> Belum
                            Ada
                            Summary Data</h6>
                        <p class="mb-0 small text-dark">Silakan isi dan simpan data <strong>Identitas (Section 1)</strong>
                            terlebih dahulu untuk mendaftarkan penyintas ini.</p>
                    </div>
                <?php else: ?>
                    <div class="border-bottom pb-3 mb-4 d-flex align-items-center justify-content-between flex-wrap gap-2">
                        <div>
                            <h5 class="fw-bold mb-1" style="color: #064e3b;"><i
                                    class="bi bi-file-earmark-text text-success me-2"></i> Section 5 - Summary & Review Data
                                Penyintas</h5>
                            <p class="text-muted small mb-0">Tinjau kembali seluruh data korban yang telah diinput
                                sebelumnya.
                                Anda dapat mengedit kembali data yang sudah diinput melalui tombol edit di masing-masing
                                seksi.
                            </p>
                        </div>

                    </div>

                    <!-- 1. IDENTITAS PENYINTAS -->
                    <div class="card posko-item-card p-3 p-md-4 mb-3 mb-md-4">
                        <div class="d-flex justify-content-between align-items-center mb-3 mb-md-4">
                            <h6 class="fw-bold text-dark mb-0 fs-6"><i class="bi bi-person-vcard text-primary me-2"></i> 1.
                                Identitas Penyintas</h6>
                            <button type="button" onclick="switchToTab('identitas')"
                                class="frost-btn-primary px-3 py-1.5 fs-7 d-none d-md-inline-flex">
                                <i class="bi bi-pencil-square me-1"></i> Edit Data Identitas
                            </button>
                        </div>
                        <div class="bg-white p-3 p-md-4 rounded border">
                            <div class="row g-3 g-md-4">
                                <div class="col-12 col-md-6">
                                    <span class="text-muted small d-block">Nama Lengkap</span>
                                    <strong class="text-dark fs-6"><?= esc($victim['nama']) ?></strong>
                                </div>
                                <div class="col-6 col-md-3">
                                    <span class="text-muted small d-block">Jenis Kelamin</span>
                                    <strong
                                        class="text-dark"><?= esc($victim['jenis_kelamin'] === 'L' ? 'Laki-Laki (L)' : 'Perempuan (P)') ?></strong>
                                </div>
                                <div class="col-6 col-md-3">
                                    <span class="text-muted small d-block">Umur</span>
                                    <strong class="text-dark"><?= esc($victim['umur']) ?> Tahun</strong>
                                </div>
                                <div class="col-12 col-md-6">
                                    <span class="text-muted small d-block">NIK</span>
                                    <strong class="text-dark"><?= esc($victim['nik'] ?? '-') ?></strong>
                                </div>
                                <div class="col-12 col-md-6">
                                    <span class="text-muted small d-block">Kontak Keluarga / No HP</span>
                                    <strong class="text-dark"><?= esc($victim['no_hp_keluarga'] ?? '-') ?></strong>
                                </div>
                                <div class="col-12">
                                    <span class="text-muted small d-block">Alamat Asal</span>
                                    <span class="text-dark"><?= esc($victim['alamat'] ?? '-') ?></span>
                                </div>
                                <div class="col-6 col-md-4">
                                    <span class="text-muted small d-block">Tanggal Tiba di Posko</span>
                                    <strong class="text-dark" data-device-time="<?= esc($victim['tanggal_datang']) ?>" data-format-type="date-only"><?= esc($victim['tanggal_datang']) ?></strong>
                                </div>
                                <div class="col-6 col-md-4">
                                    <span class="text-muted small d-block">Jam Tiba di Posko</span>
                                    <strong class="text-dark" data-device-time="<?= esc($victim['jam_datang']) ?>" data-format-type="time-only" data-show-tz="true"><?= esc($victim['jam_datang']) ?></strong>
                                </div>
                                <div class="col-12 col-md-4">
                                    <span class="text-muted small d-block">Ditemukan Oleh Relawan</span>
                                    <strong class="text-dark"><?= esc($victim['relawan_nama'] ?? 'Relawan Posko') ?></strong>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end mt-3 pt-2.5 border-top d-md-none">
                                <button type="button" onclick="switchToTab('identitas')" class="frost-btn-primary px-3 py-1.5 fs-7">
                                    <i class="bi bi-pencil-square me-1"></i> Edit
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- 2. INFORMASI & DAMPAK BENCANA -->
                    <div class="card posko-item-card p-3 p-md-4 mb-3 mb-md-4">
                        <div class="d-flex justify-content-between align-items-center mb-3 mb-md-4">
                            <h6 class="fw-bold text-dark mb-0 fs-6"><i class="bi bi-tsunami text-danger me-2"></i> 2. Informasi &
                                Dampak Bencana</h6>
                            <button type="button" onclick="switchToTab('bencana')"
                                class="frost-btn-primary px-3 py-1.5 fs-7 d-none d-md-inline-flex">
                                <i class="bi bi-pencil-square me-1"></i> Edit Info Bencana
                            </button>
                        </div>
                        <div class="bg-white p-3 p-md-4 rounded border">
                            <div class="row g-3 g-md-4">
                                <div class="col-12 col-md-4">
                                    <span class="text-muted small d-block">Jenis Bencana</span>
                                    <strong
                                        class="text-dark"><?= esc($disasterInfo['jenis_bencana'] ?? $victim['posko_bencana'] ?? 'Gempa Bumi') ?></strong>
                                </div>
                                <div class="col-12 col-md-4">
                                    <span class="text-muted small d-block">Lokasi Bencana (Wilayah Posko)</span>
                                    <span class="badge bg-secondary px-2 py-1 me-1">Auto</span>
                                    <strong
                                        class="text-dark"><?= esc(($victim['regency_name'] ?? '') . ', ' . ($victim['province_name'] ?? '')) ?></strong>
                                </div>
                                <div class="col-12 col-md-4">
                                    <span class="text-muted small d-block">Tanggal Kejadian Bencana</span>
                                    <strong class="text-dark" data-device-time="<?= esc($disasterInfo['tanggal'] ?? '') ?>" data-format-type="date-only"><?= esc($disasterInfo['tanggal'] ?? '-') ?></strong>
                                </div>
                                <div class="col-12">
                                    <span class="text-muted small d-block mb-1">Durasi Terjebak Reruntuhan / Bencana</span>
                                    <span
                                        class="badge bg-warning text-dark px-3 py-2 fs-7"><?= esc($disasterInfo['durasi_terjebak'] ?? '<1 jam') ?></span>
                                </div>
                                <div class="col-12">
                                    <span class="text-muted small d-block mb-2">Indikator Dampak Trauma Bencana</span>
                                    <div class="d-flex flex-wrap gap-2">
                                        <span
                                            class="badge <?= !empty($disasterInfo['mengungsi']) ? 'bg-primary' : 'bg-light text-muted border' ?> px-3 py-2">
                                            <?= !empty($disasterInfo['mengungsi']) ? '✓ Mengungsi' : '✗ Tidak Mengungsi' ?>
                                        </span>
                                        <span
                                            class="badge <?= !empty($disasterInfo['kehilangan_rumah']) ? 'bg-danger' : 'bg-light text-muted border' ?> px-3 py-2">
                                            <?= !empty($disasterInfo['kehilangan_rumah']) ? '✓ Rumah Hancur/Kehilangan' : '✗ Rumah Utuh' ?>
                                        </span>
                                        <span
                                            class="badge <?= !empty($disasterInfo['kehilangan_keluarga']) ? 'bg-danger' : 'bg-light text-muted border' ?> px-3 py-2">
                                            <?= !empty($disasterInfo['kehilangan_keluarga']) ? '✓ Kehilangan Anggota Keluarga' : '✗ Keluarga Utuh' ?>
                                        </span>
                                        <span
                                            class="badge <?= !empty($disasterInfo['cedera']) ? 'bg-warning text-dark' : 'bg-light text-muted border' ?> px-3 py-2">
                                            <?= !empty($disasterInfo['cedera']) ? '✓ Cedera Fisik' : '✗ Tidak Cedera' ?>
                                        </span>
                                        <span
                                            class="badge <?= !empty($disasterInfo['rawat_inap']) ? 'bg-warning text-dark' : 'bg-light text-muted border' ?> px-3 py-2">
                                            <?= !empty($disasterInfo['rawat_inap']) ? '✓ Rawat Inap' : '✗ Tidak Rawat Inap' ?>
                                        </span>
                                        <span
                                            class="badge <?= !empty($disasterInfo['saksi_kematian']) ? 'bg-danger' : 'bg-light text-muted border' ?> px-3 py-2">
                                            <?= !empty($disasterInfo['saksi_kematian']) ? '✓ Saksi Kematian Korban' : '✗ Bukan Saksi Kematian' ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end mt-3 pt-2.5 border-top d-md-none">
                                <button type="button" onclick="switchToTab('bencana')" class="frost-btn-primary px-3 py-1.5 fs-7">
                                    <i class="bi bi-pencil-square me-1"></i> Edit
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- 3. RIWAYAT PSIKOLOGIS -->
                    <div class="card posko-item-card p-3 p-md-4 mb-3 mb-md-4">
                        <div class="d-flex justify-content-between align-items-center mb-3 mb-md-4">
                            <h6 class="fw-bold text-dark mb-0 fs-6"><i class="bi bi-journal-medical text-primary me-2"></i> 3.
                                Riwayat Medis & Psikologis</h6>
                            <?php if ($userRole !== 'bpbd_admin'): ?>
                                <button type="button" onclick="switchToTab('psikologis')"
                                    class="frost-btn-primary px-3 py-1.5 fs-7 d-none d-md-inline-flex">
                                    <i class="bi bi-pencil-square me-1"></i> Edit Riwayat Psikologis
                                </button>
                            <?php endif; ?>
                        </div>
                        <?php if ($userRole === 'bpbd_admin'): ?>
                            <div class="alert alert-warning mb-0 fs-7">
                                <i class="bi bi-shield-lock-fill me-1"></i> Hak Akses Dibatasi: Data medis sensitif
                                disembunyikan
                                untuk role BPBD Admin.
                            </div>
                        <?php else: ?>
                            <div class="bg-white p-3 p-md-4 rounded border">
                                <div class="row g-3 g-md-4">
                                    <div class="col-12 col-md-6">
                                        <span class="text-muted small d-block">Pernah Konsultasi / Dirawat Psikiater</span>
                                        <strong class="text-dark">
                                            <?= !empty($psychHist['pernah_konsultasi']) ? 'Pernah Konsultasi' : 'Belum Pernah' ?> •
                                            <?= !empty($psychHist['pernah_dirawat_psikiater']) ? 'Pernah Dirawat Psikiater' : 'Tidak Pernah Dirawat' ?>
                                        </strong>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <span class="text-muted small d-block">Riwayat Risiko Melukai Diri / Suicide / NAPZA</span>
                                        <div>
                                            <?php if (!empty($psychHist['riwayat_percobaan_bunuh_diri'])): ?>
                                                <span class="badge bg-danger me-1">Percobaan Bunuh Diri</span>
                                            <?php endif; ?>
                                            <?php if (!empty($psychHist['riwayat_melukai_diri'])): ?>
                                                <span class="badge bg-danger me-1">Melukai Diri (Self-Harm)</span>
                                            <?php endif; ?>
                                            <?php if (!empty($psychHist['riwayat_napza'])): ?>
                                                <span class="badge bg-warning text-dark me-1">Riwayat NAPZA</span>
                                            <?php endif; ?>
                                            <?php if (empty($psychHist['riwayat_percobaan_bunuh_diri']) && empty($psychHist['riwayat_melukai_diri']) && empty($psychHist['riwayat_napza'])): ?>
                                                <span class="text-muted fs-7">Tidak Ada Riwayat Krisis</span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <span class="text-muted small d-block">Diagnosis Sebelumnya</span>
                                        <strong class="text-dark">
                                            <?= !empty($savedDiagnoses) ? esc(implode(', ', $savedDiagnoses)) : 'Tidak Ada Diagnosis Sebelumnya' ?>
                                        </strong>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <span class="text-muted small d-block">Obat-obatan yang Sedang Dikonsumsi</span>
                                        <strong class="text-dark">
                                            <?= !empty($psychHist['sedang_konsumsi_obat']) ? esc(($psychHist['nama_obat'] ?? '-') . ' (Dosis: ' . ($psychHist['dosis'] ?? '-') . ', Dokter: ' . ($psychHist['dokter'] ?? '-') . ')') : 'Tidak Ada Obat' ?>
                                        </strong>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <span class="text-muted small d-block">Riwayat Penyakit Kronis Fisik</span>
                                        <strong class="text-dark">
                                            <?= !empty($psychHist['riwayat_penyakit_kronis']) ? esc($psychHist['keterangan_penyakit_kronis'] ?? 'Ada Penyakit Kronis') : 'Tidak Ada' ?>
                                        </strong>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end mt-3 pt-2.5 border-top d-md-none">
                                    <button type="button" onclick="switchToTab('psikologis')" class="frost-btn-primary px-3 py-1.5 fs-7">
                                        <i class="bi bi-pencil-square me-1"></i> Edit
                                    </button>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- 4. SKRINING AWAL RELAWAN -->
                    <div class="card posko-item-card p-3 p-md-4 mb-3 mb-md-4">
                        <div class="d-flex justify-content-between align-items-center mb-3 mb-md-4">
                            <h6 class="fw-bold text-dark mb-0 fs-6"><i class="bi bi-clipboard-pulse text-success me-2"></i> 4.
                                Skrining Awal Relawan</h6>
                            <?php if ($userRole !== 'bpbd_admin'): ?>
                                <button type="button" onclick="switchToTab('screening')"
                                    class="frost-btn-primary px-3 py-1.5 fs-7 d-none d-md-inline-flex">
                                    <i class="bi bi-pencil-square me-1"></i> Edit Skrining Relawan
                                </button>
                            <?php endif; ?>
                        </div>
                        <?php if (empty($screening)): ?>
                            <div class="alert alert-warning mb-0 fs-7">
                                <i class="bi bi-exclamation-triangle me-1"></i> Belum ada data Skrining Relawan. Silakan isi
                                skrining terlebih dahulu.
                            </div>
                        <?php else: ?>
                            <div class="bg-white p-3 p-md-4 rounded border">
                                <div class="row g-3 g-md-4">
                                    <div class="col-12 col-md-4">
                                        <span class="text-muted small d-block">Kemampuan Orientasi</span>
                                        <strong class="text-dark">
                                            <?= !empty($screening['mampu_sebut_nama']) ? '✓ Nama' : '✗ Nama' ?> •
                                            <?= !empty($screening['mampu_sebut_lokasi']) ? '✓ Lokasi' : '✗ Lokasi' ?> •
                                            <?= !empty($screening['mampu_sebut_tanggal']) ? '✓ Tanggal' : '✗ Tanggal' ?>
                                        </strong>
                                    </div>
                                    <div class="col-6 col-md-4">
                                        <span class="text-muted small d-block">Kontak Mata</span>
                                        <strong
                                            class="text-dark capitalize"><?= esc($screening['kontak_mata'] ?? 'baik') ?></strong>
                                    </div>
                                    <div class="col-6 col-md-4">
                                        <span class="text-muted small d-block">Cara Berbicara</span>
                                        <strong class="text-dark capitalize"><?= esc($screening['bicara'] ?? 'normal') ?></strong>
                                    </div>
                                    <div class="col-12">
                                        <span class="text-muted small d-block mb-1">Gejala Perilaku Lapangan Teramati</span>
                                        <div class="d-flex flex-wrap gap-1">
                                            <?php
                                            $obs = [];
                                            if (!empty($screening['menangis_terus']))
                                                $obs[] = 'Menangis Terus';
                                            if (!empty($screening['tampak_panik']))
                                                $obs[] = 'Tampak Panik';
                                            if (!empty($screening['sulit_ditenangkan']))
                                                $obs[] = 'Sulit Ditenangkan';
                                            if (!empty($screening['gemetar']))
                                                $obs[] = 'Gemetar';
                                            if (!empty($screening['berteriak_histeris']))
                                                $obs[] = 'Berteriak Histeris';
                                            if (!empty($screening['diam_total']))
                                                $obs[] = 'Diam Total';
                                            if (!empty($screening['menghindari_orang']))
                                                $obs[] = 'Menghindari Orang';
                                            if (!empty($screening['agresif']))
                                                $obs[] = 'Agresif';
                                            if (!empty($screening['mencari_keluarga']))
                                                $obs[] = 'Panik Mencari Keluarga';
                                            if (!empty($screening['sulit_tidur']))
                                                $obs[] = 'Sulit Tidur';
                                            if (!empty($screening['mimpi_buruk']))
                                                $obs[] = 'Mimpi Buruk';
                                            if (!empty($screening['tidak_mau_makan']))
                                                $obs[] = 'Menolak Makan';

                                            if (!empty($obs)) {
                                                foreach ($obs as $o) {
                                                    echo '<span class="badge bg-secondary me-1 mb-1">' . esc($o) . '</span>';
                                                }
                                            } else {
                                                echo '<span class="text-muted fs-7">Tidak ada gejala khusus teramati.</span>';
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <span class="text-muted small d-block mb-1">Indikator Darurat Krisis</span>
                                        <div>
                                            <?php if (!empty($screening['menyebut_ingin_mati']) || !empty($screening['mengancam_bunuh_diri']) || !empty($screening['melukai_diri'])): ?>
                                                <span class="badge bg-danger px-3 py-2 fs-7"><i
                                                        class="bi bi-exclamation-triangle-fill me-1"></i> RISIKO BUNUH DIRI / MELUKAI
                                                    DIRI
                                                    TERDETEKSI</span>
                                            <?php else: ?>
                                                <span class="badge bg-success px-3 py-2 fs-7"><i class="bi bi-shield-check me-1"></i>
                                                    Tidak
                                                    Ada Indikasi Krisis Darurat</span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <span class="text-muted small d-block mb-1">Dokumentasi Media Terlampir</span>
                                        <div class="d-flex flex-wrap gap-2 fs-7">
                                            <span
                                                class="badge <?= !empty($screening['foto_path']) ? 'bg-success' : 'bg-light text-muted border' ?>">
                                                <i class="bi bi-image me-1"></i> Foto:
                                                <?= !empty($screening['foto_path']) ? 'Tersedia' : 'Tidak Ada' ?>
                                            </span>
                                            <span
                                                class="badge <?= !empty($screening['voice_note_path']) ? 'bg-success' : 'bg-light text-muted border' ?>">
                                                <i class="bi bi-mic me-1"></i> Audio:
                                                <?= !empty($screening['voice_note_path']) ? 'Tersedia' : 'Tidak Ada' ?>
                                            </span>
                                            <span
                                                class="badge <?= !empty($screening['video_path']) ? 'bg-success' : 'bg-light text-muted border' ?>">
                                                <i class="bi bi-camera-video me-1"></i> Video:
                                                <?= !empty($screening['video_path']) ? 'Tersedia' : 'Tidak Ada' ?>
                                            </span>
                                            <span
                                                class="badge <?= !empty($screening['dokumen_path']) ? 'bg-success' : 'bg-light text-muted border' ?>">
                                                <i class="bi bi-file-earmark-pdf me-1"></i> Dokumen:
                                                <?= !empty($screening['dokumen_path']) ? 'Tersedia' : 'Tidak Ada' ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end mt-3 pt-2.5 border-top d-md-none">
                                    <button type="button" onclick="switchToTab('screening')" class="frost-btn-primary px-3 py-1.5 fs-7">
                                        <i class="bi bi-pencil-square me-1"></i> Edit
                                    </button>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- KONFIRMASI & TINDAK LANJUT -->
                    <div class="card posko-item-card p-4">
                        <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                            <div>
                                <h6 class="fw-bold mb-1" style="color: #064e3b;"><i
                                        class="bi bi-check-circle-fill text-success me-2"></i> Review Selesai - Langkah
                                    Selanjutnya</h6>
                                <p class="text-muted small mb-0">Pastikan seluruh data di atas sudah valid. Anda dapat
                                    melanjutkan ke analisis AI Clinical Decision Support atau kembali ke posko.</p>
                            </div>
                            <div class="d-flex align-items-center flex-wrap gap-2 tab-btn-footer">
                                <a href="<?= site_url('/posko/' . $victim['posko_id']) ?>"
                                    class="frost-btn-reset px-4 py-2">
                                    <i class="bi bi-arrow-left me-1"></i> Kembali ke Posko
                                </a>
                                <button type="button" onclick="switchToTab('ai')" class="frost-btn-primary px-4 py-2">
                                    <i class="bi bi-cpu-fill me-1"></i> Lanjut ke AI Assessment <i
                                        class="bi bi-arrow-right ms-1"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <!-- TAB 6: AI CLINICAL DECISION SUPPORT (SEGMEN 8) -->
            <div class="tab-pane fade" id="tab-ai" role="tabpanel">
                <?php if (empty($victim['id'])): ?>
                    <div class="alert alert-warning border-start border-4 border-warning p-4 shadow-sm my-3">
                        <h6 class="fw-bold mb-1" style="color: #064e3b;"><i class="bi bi-info-circle-fill me-2"></i> Belum
                            Ada AI Assessment</h6>
                        <p class="mb-0 small text-dark">Silakan isi dan simpan data <strong>Identitas (Section 1)</strong>
                            terlebih dahulu untuk mendaftarkan penyintas ini.</p>
                    </div>
                <?php else: ?>
                    <div class="border-bottom pb-3 mb-4 d-flex align-items-center justify-content-between flex-wrap gap-3">
                        <div>
                            <h5 class="fw-bold mb-1" style="color: #064e3b;"><i
                                    class="bi bi-cpu-fill text-emerald-600 me-2"></i>
                                Section 6 - AI Clinical Decision Support</h5>
                            <p class="text-muted small mb-0">Engine triase & analisis psikologis klinis berbasis AI Gemini & Indikator Objektif.</p>
                        </div>
                        <div class="d-flex align-items-center flex-wrap gap-2">
                            <?php if (!empty($aiAssessment)): ?>
                                <?php $isGemini = strpos($aiAssessment['ai_summary'] ?? '', '[Gemini AI') !== false; ?>
                                <?php if ($isGemini): ?>
                                    <span class="badge px-3 py-2 fs-7 fw-semibold" style="background: #e0f2fe; color: #0369a1; border: 1px solid #bae6fd;">
                                        <i class="bi bi-stars me-1 text-info"></i> Engine: Gemini API + RAG + Web Search
                                    </span>
                                <?php else: ?>
                                    <span class="badge px-3 py-2 fs-7 fw-semibold" style="background: #f1f5f9; color: #334155; border: 1px solid #cbd5e1;">
                                        <i class="bi bi-journal-bookmark-fill me-1"></i> Engine: RAG + Rule Engine
                                    </span>
                                <?php endif; ?>
                                <span class="badge px-3 py-2 fs-7 fw-semibold" style="background: #d1fae5; color: #065f46; border: 1px solid #a7f3d0;">
                                    <i class="bi bi-database-check me-1"></i> RAG Base Active
                                </span>
                                <span class="badge px-3 py-2 fs-7 fw-semibold" style="background: #f8fafc; color: #64748b; border: 1px solid #e2e8f0;">
                                    <i class="bi bi-clock me-1"></i> Generated: <span data-device-time="<?= esc($aiAssessment['generated_at']) ?>" data-show-tz="true"><?= esc($aiAssessment['generated_at']) ?></span>
                                </span>
                            <?php endif; ?>

                            <?php if (in_array($userRole, ['relawan', 'psikolog'], true)): ?>
                                <a href="<?= site_url('/screening/reassess/' . $victim['id']) ?>"
                                    class="frost-btn-primary px-3 py-2 fs-7 fw-semibold">
                                    <i class="bi bi-arrow-clockwise me-1"></i> Analisis Ulang AI
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- BIODATA PENYINTAS CARD -->
                    <div class="card posko-item-card p-3 p-md-4 mb-4">
                        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                            <div>
                                <span class="text-muted small fw-semibold text-uppercase">Penyintas Teranalisis:</span>
                                <h5 class="fw-bold mb-0 mt-1" style="color: #064e3b;">
                                    <i class="bi bi-person-circle text-emerald-600 me-2"></i> <?= esc($victim['nama']) ?>
                                    <span class="fs-6 text-muted fw-normal me-2">(NIK: <?= esc($victim['nik'] ?? '-') ?>)</span>
                                </h5>
                                <div class="small text-muted mt-1">
                                    <?= esc($victim['jenis_kelamin'] === 'L' ? 'Laki-Laki' : 'Perempuan') ?> •
                                    <?= esc($victim['umur']) ?> Tahun • Posko: <strong><?= esc($victim['posko_name']) ?></strong>
                                </div>
                            </div>
                            <div class="text-end">
                                <span class="badge px-3 py-2 fw-semibold fs-7"
                                    style="background: #d1fae5; color: #065f46; border: 1px solid #a7f3d0;">
                                    <i class="bi bi-calendar-event me-1"></i> Tiba: <span data-device-time="<?= esc($victim['tanggal_datang'] . ' ' . ($victim['jam_datang'] ?? '')) ?>" data-show-tz="true"><?= esc($victim['tanggal_datang']) ?> <?= esc($victim['jam_datang']) ?></span>
                                </span>
                            </div>
                        </div>
                    </div>

                    <?php if (empty($aiAssessment)): ?>
                        <div class="alert alert-secondary text-center p-4 rounded-3 border">
                            <i class="bi bi-cpu fs-2 d-block mb-2 text-muted"></i>
                            AI Clinical Decision Support belum di-generate. Lakukan pengisian <strong>Skrining Awal Relawan</strong> untuk memicu analisis otomatis.
                        </div>
                    <?php else: ?>
                        <div class="row g-3 mb-4">
                            <!-- CARD 1: RISK LEVEL -->
                            <div class="col-6 col-md-3">
                                <div class="card posko-item-card p-3 p-md-3.5 h-100">
                                    <div class="text-secondary fs-8 fw-bold text-uppercase" style="letter-spacing: 0.03em;">Tingkat Risiko</div>
                                    <hr class="my-2 opacity-25" style="color: #059669;" />
                                    <div class="my-1">
                                        <?php if ($aiAssessment['risk_level'] === 'high'): ?>
                                            <span class="badge fs-7 px-2.5 py-1.5 fw-bold" style="background: #fee2e2; color: #991b1b; border: 1px solid #fca5a5;">
                                                <i class="bi bi-exclamation-triangle-fill me-1"></i> HIGH RISK
                                            </span>
                                        <?php elseif ($aiAssessment['risk_level'] === 'medium'): ?>
                                            <span class="badge fs-7 px-2.5 py-1.5 fw-bold" style="background: #fef3c7; color: #92400e; border: 1px solid #fcd34d;">
                                                <i class="bi bi-dash-circle-fill me-1"></i> MEDIUM RISK
                                            </span>
                                        <?php else: ?>
                                            <span class="badge fs-7 px-2.5 py-1.5 fw-bold" style="background: #d1fae5; color: #065f46; border: 1px solid #a7f3d0;">
                                                <i class="bi bi-check-circle-fill me-1"></i> LOW RISK
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="fs-9 text-muted fw-semibold">Risk Level Assessment</div>
                                </div>
                            </div>

                            <!-- CARD 2: CONFIDENCE RATIO -->
                            <div class="col-6 col-md-3">
                                <div class="card posko-item-card p-3 p-md-3.5 h-100">
                                    <div class="text-secondary fs-8 fw-bold text-uppercase" style="letter-spacing: 0.03em;">Confidence Ratio</div>
                                    <hr class="my-2 opacity-25" style="color: #059669;" />
                                    <div class="fs-3 fw-bold mb-1 text-truncate tabular-nums" style="color: #064e3b;"><?= esc($aiAssessment['confidence']) ?>%</div>
                                    <div class="fs-9 text-muted fw-semibold">Rasio Pembobotan Indikator</div>
                                </div>
                            </div>

                            <!-- CARD 3: CLINICAL PRIORITY -->
                            <div class="col-6 col-md-3">
                                <div class="card posko-item-card p-3 p-md-3.5 h-100">
                                    <div class="text-secondary fs-8 fw-bold text-uppercase" style="letter-spacing: 0.03em;">Clinical Priority</div>
                                    <hr class="my-2 opacity-25" style="color: #059669;" />
                                    <div class="fs-3 fw-bold mb-1 text-truncate" style="color: #064e3b;"><?= esc($aiAssessment['clinical_priority']) ?></div>
                                    <div class="fs-9 text-muted fw-semibold">Status: <span class="badge px-2 py-0.5 fw-bold" style="background: #e2e8f0; color: #334155; border: 1px solid #cbd5e1;"><?= esc($aiAssessment['status']) ?></span></div>
                                </div>
                            </div>

                            <!-- CARD 4: INSTRUMEN ITQ -->
                            <div class="col-6 col-md-3">
                                <div class="card posko-item-card p-3 p-md-3.5 h-100">
                                    <div class="text-secondary fs-8 fw-bold text-uppercase" style="letter-spacing: 0.03em;">Instrumen ITQ (Trauma)</div>
                                    <hr class="my-2 opacity-25" style="color: #059669;" />
                                    <?php if (!empty($itqResult)): ?>
                                        <div class="mb-1">
                                            <span class="badge <?= ($itqResult['overall_risk'] ?? '') === 'HIGH' ? 'bg-danger' : 'bg-warning text-dark' ?> fs-7 px-2.5 py-1 fw-bold">
                                                ITQ Risk: <?= esc($itqResult['overall_risk'] ?? 'MEDIUM') ?>
                                            </span>
                                        </div>
                                        <div class="fs-9 text-muted fw-semibold">
                                            PTSD: <strong><?= esc($itqResult['ptsd_score'] ?? 0) ?>/24</strong> • DSO: <strong><?= esc($itqResult['dso_score'] ?? 0) ?>/24</strong>
                                        </div>
                                    <?php else: ?>
                                        <div class="mb-1">
                                            <span class="badge px-2.5 py-1 fw-semibold" style="background: #f1f5f9; color: #475569; border: 1px solid #cbd5e1;">Belum Diisi ITQ</span>
                                        </div>
                                        <div class="fs-9 text-muted fw-semibold">Menunggu Review Psikolog</div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <!-- 1. RAG & WEB SEARCH GROUNDING INFO BANNER -->
                        <div class="card posko-item-card p-3 p-md-4 mb-3 mb-md-4" style="background: linear-gradient(135deg, #f0fdf4 0%, #ffffff 100%); border-color: #a7f3d0 !important;">
                            <div class="d-flex align-items-start justify-content-between flex-column flex-md-row gap-2.5 gap-md-3">
                                <div class="d-flex align-items-start gap-2 me-md-2">
                                    <i class="bi bi-search-heart text-emerald-600 fs-5 mt-0.5 flex-shrink-0"></i>
                                    <div>
                                        <h6 class="fw-bold mb-1 fs-6" style="color: #064e3b;">RAG Clinical Knowledge Base & Web Search Grounding</h6>
                                        <div class="small text-muted lh-sm" style="font-size: 0.8125rem;">Diperkuat pedoman klinis WHO PFA, IASC MHPSS, HIMPSI Crisis Protocol & Penelusuran Web Gemini.</div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center flex-wrap flex-md-nowrap gap-1.5 gap-md-2 mt-2 mt-md-0 flex-shrink-0 text-nowrap">
                                    <span class="badge px-2.5 px-md-3 py-1.5 fs-8 fw-semibold text-nowrap" style="background: #d1fae5; color: #065f46; border: 1px solid #6ee7b7;">
                                        <i class="bi bi-database-check me-1"></i> WHO / IASC / HIMPSI RAG
                                    </span>
                                    <span class="badge px-2.5 px-md-3 py-1.5 fs-8 fw-semibold text-nowrap" style="background: #e0f2fe; color: #0369a1; border: 1px solid #7dd3fc;">
                                        <i class="bi bi-globe me-1"></i> Google Search Grounded
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- 2. KEMUNGKINAN DIAGNOSIS KLINIS CARD -->
                        <div class="card posko-item-card p-3 p-md-4 mb-3 mb-md-4">
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <i class="bi bi-journal-check text-danger fs-5"></i>
                                <h6 class="fw-bold mb-0 fs-6" style="color: #064e3b;">Kemungkinan Diagnosis Klinis</h6>
                            </div>
                            <hr class="my-2 opacity-25" style="color: #059669;" />
                            <div class="mt-2 text-dark">
                                <span class="d-block text-muted fs-8 fw-semibold text-uppercase mb-1" style="letter-spacing: 0.03em;">Indikasi Diagnosis Terdeteksi:</span>
                                <div class="fs-6 text-danger fw-bold lh-base">
                                    <i class="bi bi-exclamation-circle-fill me-2"></i><?= esc($aiAssessment['kemungkinan_diagnosis']) ?>
                                </div>
                            </div>
                        </div>

                        <!-- 3. ITQ QUESTIONNAIRE DETAIL SUMMARY (IF AVAILABLE) -->
                        <?php if (!empty($itqResult)): ?>
                            <div class="card posko-item-card p-3 p-md-4 mb-3 mb-md-4">
                                <div class="d-flex align-items-center gap-2 mb-1">
                                    <i class="bi bi-clipboard-data text-emerald-600 fs-5"></i>
                                    <h6 class="fw-bold mb-0" style="color: #064e3b;">Hasil Instrumen ITQ (International Trauma Questionnaire)</h6>
                                </div>
                                <hr class="my-2 opacity-25" style="color: #059669;" />
                                <div class="row g-2.5 g-md-3 mt-1 small text-dark">
                                    <div class="col-12 col-md-6">
                                        <div class="p-3 p-md-3.5 bg-white rounded-3 border">
                                            <span class="text-muted d-block mb-1 fs-8 fw-semibold text-uppercase">Skor PTSD (ICD-11)</span>
                                            <strong class="fs-5 text-dark d-block mb-2"><?= esc($itqResult['ptsd_score']) ?> / 24 <span class="text-muted fs-7 fw-normal">(Keparahan: <?= esc($itqResult['ptsd_severity']) ?>)</span></strong>
                                            <span class="badge <?= !empty($itqResult['ptsd_criteria_met']) ? 'bg-danger' : 'bg-secondary' ?> px-2.5 py-1.5 fw-bold">
                                                <?= !empty($itqResult['ptsd_criteria_met']) ? '✓ KRITERIA TERPENUHI' : '✗ Belum Terpenuhi' ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="p-3 p-md-3.5 bg-white rounded-3 border">
                                            <span class="text-muted d-block mb-1 fs-8 fw-semibold text-uppercase">Skor DSO / CPTSD</span>
                                            <strong class="fs-5 text-dark d-block mb-2"><?= esc($itqResult['dso_score']) ?> / 24 <span class="text-muted fs-7 fw-normal">(Keparahan: <?= esc($itqResult['dso_severity']) ?>)</span></strong>
                                            <span class="badge <?= !empty($itqResult['dso_criteria_met']) ? 'bg-danger' : 'bg-secondary' ?> px-2.5 py-1.5 fw-bold">
                                                <?= !empty($itqResult['dso_criteria_met']) ? '✓ KRITERIA TERPENUHI' : '✗ Belum Terpenuhi' ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>

                        <!-- 4. AI SUMMARY & REKOMENDASI NARATIF CARD -->
                        <div class="card posko-item-card p-3 p-md-4 mb-3 mb-md-4">
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <i class="bi bi-chat-left-quote-fill text-emerald-600 fs-5"></i>
                                <h6 class="fw-bold mb-0" style="color: #064e3b;">AI Summary & Rekomendasi Naratif</h6>
                            </div>
                            <hr class="my-2 opacity-25" style="color: #059669;" />
                            <div class="bg-white p-3 p-md-4 mt-2 rounded-3 border text-dark" style="line-height: 1.75; font-size: 0.9375rem; color: #1e293b; border-color: #e2e8f0 !important; box-shadow: 0 2px 6px rgba(15, 23, 42, 0.02);"><?= nl2br(esc(trim($aiAssessment['ai_summary'] ?? ''))) ?></div>
                        </div>

                        <!-- 5. SUMBER BUKTI & INDIKATOR (EVIDENCE SOURCES) CARD -->
                        <div class="card posko-item-card p-3 p-md-4 mb-3 mb-md-4">
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <i class="bi bi-list-check text-emerald-600 fs-5"></i>
                                <h6 class="fw-bold mb-0" style="color: #064e3b;">Sumber Bukti & Indikator (Evidence Sources)</h6>
                            </div>
                            <hr class="my-2 opacity-25" style="color: #059669;" />
                            <div class="bg-white p-3 p-md-4 mt-2 rounded-3 border text-secondary" style="white-space: pre-wrap; font-family: inherit; font-size: 0.875rem; line-height: 1.65; color: #334155; border-color: #e2e8f0 !important; word-break: break-word;"><?= esc(trim($aiAssessment['evidence_sources'] ?? '')) ?></div>
                        </div>

                        <?php if ($userRole === 'psikolog'): ?>
                            <div class="text-end">
                                <a href="<?= site_url('/psychologist-review/' . $victim['id']) ?>"
                                    class="frost-btn-primary px-3 px-md-4 py-2.5 fw-semibold shadow-sm fs-7 d-block d-md-inline-block text-center">
                                    <i class="bi bi-stethoscope me-1"></i> Buka Form Review MSE & ITQ <i
                                        class="bi bi-arrow-right ms-1"></i>
                                </a>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                <?php endif; ?>
            </div>


        </div>
    </div>
</div>

<!-- JavaScript for Dynamic Form Toggles & Emergency Suicide Risk Alert -->
<script>
    function switchToTab(tabName) {
        const tabBtn = document.getElementById(tabName + '-tab');
        if (tabBtn) {
            const bsTab = new bootstrap.Tab(tabBtn);
            bsTab.show();
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
    }

    function toggleMedicineFields(checked) {
        const el = document.getElementById('medicine-fields');
        if (el) {
            if (checked) el.classList.remove('d-none');
            else el.classList.add('d-none');
        }
    }

    function toggleChronicFields(checked) {
        const el = document.getElementById('chronic-fields');
        if (el) {
            if (checked) el.classList.remove('d-none');
            else el.classList.add('d-none');
        }
    }

    function updateDistressVal(val) {
        document.getElementById('distress-val').textContent = val + ' / 10';
    }

    function checkEmergencyAlert() {
        const m1 = document.getElementById('menyebut_ingin_mati')?.checked;
        const m2 = document.getElementById('mengancam_bunuh_diri')?.checked;
        const m3 = document.getElementById('melukai_diri')?.checked;

        const alertBox = document.getElementById('emergency-suicide-alert');
        if (alertBox) {
            if (m1 || m2 || m3) {
                alertBox.classList.remove('d-none');
            } else {
                alertBox.classList.add('d-none');
            }
        }
    }

    // Trigger initial check on page load
    document.addEventListener('DOMContentLoaded', function () {
        checkEmergencyAlert();

        // Dynamic file input color toggle when user uploads a file
        document.querySelectorAll('input[type="file"]').forEach(function (input) {
            input.addEventListener('change', function () {
                if (this.files && this.files.length > 0) {
                    this.classList.add('has-file');
                } else {
                    this.classList.remove('has-file');
                }
            });
            if (input.files && input.files.length > 0) {
                input.classList.add('has-file');
            }
        });

        function setupCustomSelect(triggerId, menuId, nativeSelectId, labelId, wrapperId) {
            const trigger = document.getElementById(triggerId);
            const menu = document.getElementById(menuId);
            const nativeSelect = document.getElementById(nativeSelectId);
            const label = document.getElementById(labelId);
            const wrapper = document.getElementById(wrapperId);

            if (!trigger || !menu || !nativeSelect || !label || !wrapper) return;

            trigger.addEventListener('click', function (e) {
                e.stopPropagation();
                const isShowing = menu.classList.contains('show');

                document.querySelectorAll('.frost-custom-menu').forEach(m => m.classList.remove('show'));
                document.querySelectorAll('.frost-custom-trigger').forEach(t => t.classList.remove('active'));
                document.querySelectorAll('.frost-custom-select-wrapper').forEach(w => w.classList.remove('active-dropdown'));

                if (!isShowing) {
                    menu.classList.add('show');
                    trigger.classList.add('active');
                    wrapper.classList.add('active-dropdown');
                }
            });

            menu.querySelectorAll('.frost-custom-option').forEach(option => {
                option.addEventListener('click', function (e) {
                    e.stopPropagation();
                    const val = this.getAttribute('data-value');
                    const textSpan = this.querySelector('span') ? this.querySelector('span').innerText : this.innerText;

                    label.innerText = textSpan;
                    nativeSelect.value = val;

                    menu.querySelectorAll('.frost-custom-option').forEach(opt => {
                        opt.classList.remove('selected');
                        const icon = opt.querySelector('.bi-check-lg');
                        if (icon) icon.remove();
                    });

                    this.classList.add('selected');
                    if (!this.querySelector('.bi-check-lg')) {
                        const checkIcon = document.createElement('i');
                        checkIcon.className = 'bi bi-check-lg text-emerald-600';
                        this.appendChild(checkIcon);
                    }

                    menu.classList.remove('show');
                    trigger.classList.remove('active');
                    wrapper.classList.remove('active-dropdown');
                });
            });
        }

        document.addEventListener('click', function () {
            document.querySelectorAll('.frost-custom-menu').forEach(m => m.classList.remove('show'));
            document.querySelectorAll('.frost-custom-trigger').forEach(t => t.classList.remove('active'));
            document.querySelectorAll('.frost-custom-select-wrapper').forEach(w => w.classList.remove('active-dropdown'));
        });

        setupCustomSelect('trigger-jk', 'menu-jk', 'jenis_kelamin', 'label-jk', 'custom-wrapper-jk');

        // Auto populate empty or create-mode tanggal & jam datang with user device date/time
        const isCreateMode = <?= !empty($isCreate) ? 'true' : 'false' ?>;
        const tglInput = document.getElementById('tanggal_datang');
        const jamInput = document.getElementById('jam_datang');
        const nowDevice = new Date();
        if (tglInput && (!tglInput.value || isCreateMode)) {
            const year = nowDevice.getFullYear();
            const month = String(nowDevice.getMonth() + 1).padStart(2, '0');
            const day = String(nowDevice.getDate()).padStart(2, '0');
            tglInput.value = `${year}-${month}-${day}`;
        }
        if (jamInput && (!jamInput.value || isCreateMode)) {
            const hours = String(nowDevice.getHours()).padStart(2, '0');
            const minutes = String(nowDevice.getMinutes()).padStart(2, '0');
            jamInput.value = `${hours}:${minutes}`;
        }

        // Auto switch active tab if specified (e.g., after saving screening)
        const activeTabName = '<?= esc($activeTab ?? '') ?>';
        if (activeTabName) {
            const tabBtn = document.getElementById(activeTabName + '-tab');
            if (tabBtn) {
                const bsTab = new bootstrap.Tab(tabBtn);
                bsTab.show();
            }
        }
    });
</script><?= $this->endSection() ?>