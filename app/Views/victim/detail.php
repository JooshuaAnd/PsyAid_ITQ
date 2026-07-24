<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="row mb-4 align-items-center">
    <div class="col">
        <a href="<?= site_url('/posko/' . $victim['posko_id']) ?>" class="btn btn-outline-secondary btn-sm mb-2">
            <i class="bi bi-arrow-left me-1"></i> Kembali ke Dashboard Posko (<?= esc($victim['posko_name']) ?>)
        </a>
        <h3 class="fw-bold text-dark mb-1">
            <i class="bi bi-person-badge-fill text-danger me-2"></i> Rekam Medis & Asesmen Penyintas
        </h3>
        <p class="text-muted small mb-0">
            Penyintas: <strong><?= esc($victim['nama']) ?></strong> (NIK: <?= esc($victim['nik'] ?? '-') ?>) • <?= esc($victim['posko_name']) ?>
        </p>
    </div>
</div>

<!-- Display Flash Messages -->
<?php if (session()->getFlashdata('errors')): ?>
    <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
        <h6 class="fw-bold mb-2"><i class="bi bi-exclamation-triangle-fill me-1"></i> Terdapat Kesalahan Pengisian Form:</h6>
        <ul class="mb-0 ps-3">
            <?php foreach (session()->getFlashdata('errors') as $error): ?>
                <li><?= esc($error) ?></li>
            <?php endforeach; ?>
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<!-- Single Page Nav Tabs Container -->
<div class="card card-custom bg-white shadow-sm mb-4">
    <div class="card-header bg-light border-bottom p-0">
        <ul class="nav nav-tabs card-header-tabs m-0 border-0" id="victimDetailTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active fw-semibold py-3 px-3" id="identitas-tab" data-bs-toggle="tab" data-bs-target="#tab-identitas" type="button" role="tab">
                    <i class="bi bi-card-heading me-1"></i> 1. Identitas
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link fw-semibold py-3 px-3" id="bencana-tab" data-bs-toggle="tab" data-bs-target="#tab-bencana" type="button" role="tab">
                    <i class="bi bi-exclamation-octagon me-1"></i> 2. Info Bencana
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link fw-semibold py-3 px-3" id="psikologis-tab" data-bs-toggle="tab" data-bs-target="#tab-psikologis" type="button" role="tab">
                    <i class="bi bi-journal-medical me-1"></i> 3. Riwayat Psikologis
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link fw-semibold py-3 px-3" id="screening-tab" data-bs-toggle="tab" data-bs-target="#tab-screening" type="button" role="tab">
                    <i class="bi bi-clipboard-pulse me-1"></i> 4. Skrining Relawan
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link fw-semibold py-3 px-3" id="ai-tab" data-bs-toggle="tab" data-bs-target="#tab-ai" type="button" role="tab">
                    <i class="bi bi-cpu me-1"></i> 5. AI Assessment
                </button>
            </li>
        </ul>
    </div>

    <div class="card-body p-4">
        <div class="tab-content" id="victimDetailTabContent">
            
            <!-- TAB 1: IDENTITAS PENYINTAS -->
            <div class="tab-pane fade show active" id="tab-identitas" role="tabpanel">
                <form action="<?= site_url('/victim/update/' . $victim['id']) ?>" method="POST">
                    <?= csrf_field() ?>
                    <div class="border-bottom pb-3 mb-4">
                        <h5 class="fw-bold text-dark mb-1"><i class="bi bi-person-vcard text-primary me-2"></i> Section 1 — Identitas Penyintas</h5>
                        <p class="text-muted small mb-0">Isi dan perbarui data identitas diri serta kontak keluarga penyintas bencana.</p>
                    </div>

                    <div class="row g-3">
                        <div class="col-12 col-md-6">
                            <label for="nama" class="form-label fw-semibold">Nama Lengkap Penyintas <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="nama" name="nama" value="<?= old('nama', $victim['nama']) ?>" required>
                        </div>

                        <div class="col-12 col-sm-6 col-md-3">
                            <label for="jenis_kelamin" class="form-label fw-semibold">Jenis Kelamin <span class="text-danger">*</span></label>
                            <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                                <option value="L" <?= old('jenis_kelamin', $victim['jenis_kelamin']) === 'L' ? 'selected' : '' ?>>Laki-Laki (L)</option>
                                <option value="P" <?= old('jenis_kelamin', $victim['jenis_kelamin']) === 'P' ? 'selected' : '' ?>>Perempuan (P)</option>
                            </select>
                        </div>

                        <div class="col-12 col-sm-6 col-md-3">
                            <label for="umur" class="form-label fw-semibold">Umur (Tahun) <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="umur" name="umur" min="0" max="120" value="<?= old('umur', $victim['umur']) ?>" required>
                        </div>

                        <div class="col-12 col-md-6">
                            <label for="nik" class="form-label fw-semibold">Nomor Induk Kependudukan (NIK)</label>
                            <input type="text" class="form-control" id="nik" name="nik" maxlength="16" placeholder="16 digit NIK (Opsional)" value="<?= old('nik', $victim['nik']) ?>">
                        </div>

                        <div class="col-12 col-md-6">
                            <label for="no_hp_keluarga" class="form-label fw-semibold">No HP / Kontak Keluarga</label>
                            <input type="text" class="form-control" id="no_hp_keluarga" name="no_hp_keluarga" placeholder="08xxxxxxxxxx" value="<?= old('no_hp_keluarga', $victim['no_hp_keluarga']) ?>">
                        </div>

                        <div class="col-12">
                            <label for="alamat" class="form-label fw-semibold">Alamat Asal Penyintas</label>
                            <textarea class="form-control" id="alamat" name="alamat" rows="2" placeholder="Dusun, Desa, RT/RW asal..."><?= old('alamat', $victim['alamat']) ?></textarea>
                        </div>

                        <div class="col-12 col-sm-6 col-md-4">
                            <label for="tanggal_datang" class="form-label fw-semibold">Tanggal Tiba di Posko <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="tanggal_datang" name="tanggal_datang" value="<?= old('tanggal_datang', $victim['tanggal_datang']) ?>" required>
                        </div>

                        <div class="col-12 col-sm-6 col-md-4">
                            <label for="jam_datang" class="form-label fw-semibold">Jam Tiba di Posko <span class="text-danger">*</span></label>
                            <input type="time" class="form-control" id="jam_datang" name="jam_datang" value="<?= old('jam_datang', $victim['jam_datang']) ?>" required>
                        </div>

                        <div class="col-12 col-md-4">
                            <label for="ditemukan_oleh_relawan_id" class="form-label fw-semibold">Ditemukan Oleh Relawan</label>
                            <select class="form-select" id="ditemukan_oleh_relawan_id" name="ditemukan_oleh_relawan_id">
                                <option value="">-- Pilih Relawan Penemu --</option>
                                <?php foreach ($relawanList as $r): ?>
                                    <option value="<?= esc($r['id']) ?>" <?= old('ditemukan_oleh_relawan_id', $victim['ditemukan_oleh_relawan_id']) == $r['id'] ? 'selected' : '' ?>>
                                        <?= esc($r['name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <input type="hidden" name="next_tab" value="bencana">
                    <div class="border-top pt-3 mt-4 d-flex justify-content-between align-items-center flex-wrap gap-2">
                        <button type="reset" class="btn btn-outline-secondary px-4 py-2 fw-semibold">
                            <i class="bi bi-arrow-counterclockwise me-1"></i> Reset Form Identitas
                        </button>
                        <button type="submit" class="btn btn-primary px-4 py-2 fw-semibold shadow-sm">
                            <i class="bi bi-floppy-fill me-1"></i> Simpan & Lanjut ke Info Bencana <i class="bi bi-arrow-right ms-1"></i>
                        </button>
                    </div>
                </form>
            </div>

            <!-- TAB 2: INFORMASI BENCANA -->
            <div class="tab-pane fade" id="tab-bencana" role="tabpanel">
                <form action="<?= site_url('/victim/update/' . $victim['id']) ?>" method="POST">
                    <?= csrf_field() ?>
                    <!-- Hidden Identitas values for safety -->
                    <input type="hidden" name="nama" value="<?= esc($victim['nama']) ?>">
                    <input type="hidden" name="jenis_kelamin" value="<?= esc($victim['jenis_kelamin']) ?>">
                    <input type="hidden" name="umur" value="<?= esc($victim['umur']) ?>">
                    <input type="hidden" name="tanggal_datang" value="<?= esc($victim['tanggal_datang']) ?>">
                    <input type="hidden" name="jam_datang" value="<?= esc($victim['jam_datang']) ?>">

                    <div class="border-bottom pb-3 mb-4">
                        <h5 class="fw-bold text-dark mb-1"><i class="bi bi-tsunami text-danger me-2"></i> Section 2 — Informasi & Dampak Bencana</h5>
                        <p class="text-muted small mb-0">Catat kondisi kedaruratan, durasi terjebak, dan dampak riil bencana pada penyintas.</p>
                    </div>

                    <div class="row g-3">
                        <div class="col-12 col-md-6">
                            <label for="jenis_bencana" class="form-label fw-semibold">Jenis Bencana</label>
                            <input type="text" class="form-control" id="jenis_bencana" name="jenis_bencana" 
                                   value="<?= old('jenis_bencana', $disasterInfo['jenis_bencana'] ?? $victim['posko_bencana'] ?? 'Gempa Bumi') ?>">
                        </div>

                        <div class="col-12 col-md-6">
                            <label for="tanggal_bencana" class="form-label fw-semibold">Tanggal Kejadian Bencana</label>
                            <input type="date" class="form-control" id="tanggal_bencana" name="tanggal_bencana" 
                                   value="<?= old('tanggal_bencana', $disasterInfo['tanggal'] ?? date('Y-m-d')) ?>">
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-semibold d-block">Durasi Terjebak Reruntuhan / Bencana</label>
                            <div class="d-flex flex-wrap gap-4 bg-light p-3 rounded border">
                                <?php $durasi = old('durasi_terjebak', $disasterInfo['durasi_terjebak'] ?? '<1 jam'); ?>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="durasi_terjebak" id="durasi1" value="<1 jam" <?= $durasi === '<1 jam' ? 'checked' : '' ?>>
                                    <label class="form-check-label fw-medium" for="durasi1">Kurang dari 1 Jam (&lt;1 jam)</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="durasi_terjebak" id="durasi2" value="1-6 jam" <?= $durasi === '1-6 jam' ? 'checked' : '' ?>>
                                    <label class="form-check-label fw-medium text-warning" for="durasi2">1 sampai 6 Jam (1-6 jam)</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="durasi_terjebak" id="durasi3" value=">6 jam" <?= $durasi === '>6 jam' ? 'checked' : '' ?>>
                                    <label class="form-check-label fw-medium text-danger" for="durasi3">Lebih dari 6 Jam (&gt;6 jam)</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 mt-4">
                            <label class="form-label fw-semibold d-block mb-3">Indikator Dampak Bencana (Centang Jika "Ya")</label>
                            <div class="row g-3">
                                <div class="col-12 col-sm-6 col-md-4">
                                    <div class="card card-custom p-3 bg-light border">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="mengungsi" name="mengungsi" value="1" 
                                                   <?= old('mengungsi', $disasterInfo['mengungsi'] ?? 0) ? 'checked' : '' ?>>
                                            <label class="form-check-label fw-semibold text-dark" for="mengungsi">Status Mengungsi</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-4">
                                    <div class="card card-custom p-3 bg-light border">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="kehilangan_rumah" name="kehilangan_rumah" value="1" 
                                                   <?= old('kehilangan_rumah', $disasterInfo['kehilangan_rumah'] ?? 0) ? 'checked' : '' ?>>
                                            <label class="form-check-label fw-semibold text-dark" for="kehilangan_rumah">Kehilangan Rumah / Hancur</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-4">
                                    <div class="card card-custom p-3 bg-light border">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="kehilangan_keluarga" name="kehilangan_keluarga" value="1" 
                                                   <?= old('kehilangan_keluarga', $disasterInfo['kehilangan_keluarga'] ?? 0) ? 'checked' : '' ?>>
                                            <label class="form-check-label fw-semibold text-dark" for="kehilangan_keluarga">Kehilangan Anggota Keluarga</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-4">
                                    <div class="card card-custom p-3 bg-light border">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="cedera" name="cedera" value="1" 
                                                   <?= old('cedera', $disasterInfo['cedera'] ?? 0) ? 'checked' : '' ?>>
                                            <label class="form-check-label fw-semibold text-dark" for="cedera">Menderita Cedera Fisik</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-4">
                                    <div class="card card-custom p-3 bg-light border">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="rawat_inap" name="rawat_inap" value="1" 
                                                   <?= old('rawat_inap', $disasterInfo['rawat_inap'] ?? 0) ? 'checked' : '' ?>>
                                            <label class="form-check-label fw-semibold text-dark" for="rawat_inap">Sedang / Sempat Rawat Inap</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-4">
                                    <div class="card card-custom p-3 bg-light border">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="saksi_kematian" name="saksi_kematian" value="1" 
                                                   <?= old('saksi_kematian', $disasterInfo['saksi_kematian'] ?? 0) ? 'checked' : '' ?>>
                                            <label class="form-check-label fw-semibold text-danger" for="saksi_kematian">Saksi Kematian Korban Lain</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="next_tab" value="psikologis">
                    <div class="border-top pt-3 mt-4 d-flex justify-content-between align-items-center flex-wrap gap-2">
                        <button type="reset" class="btn btn-outline-secondary px-4 py-2 fw-semibold">
                            <i class="bi bi-arrow-counterclockwise me-1"></i> Reset Form Info Bencana
                        </button>
                        <button type="submit" class="btn btn-primary px-4 py-2 fw-semibold shadow-sm">
                            <i class="bi bi-floppy-fill me-1"></i> Simpan & Lanjut ke Riwayat Psikologis <i class="bi bi-arrow-right ms-1"></i>
                        </button>
                    </div>
                </form>
            </div>

            <!-- TAB 3: RIWAYAT PSIKOLOGIS (SEGMEN 6) -->
            <div class="tab-pane fade" id="tab-psikologis" role="tabpanel">
                <?php if ($userRole === 'bpbd_admin'): ?>
                    <div class="alert alert-warning border-start border-4 border-warning p-4 shadow-sm my-3">
                        <h5 class="fw-bold text-dark mb-2"><i class="bi bi-shield-lock-fill text-warning me-2"></i> Hak Akses Dibatasi</h5>
                        <p class="mb-0">
                            Data riwayat psikologis individual adalah informasi medis sensitif dan <strong>HANYA</strong> dapat diakses oleh <strong>Relawan Lapangan</strong> (saat input) dan <strong>Psikolog Klinis</strong> (saat review). Role BPBD Admin di Command Center hanya mengakses data statistik agregat.
                        </p>
                    </div>
                <?php else: ?>
                    <form action="<?= site_url('/victim/update-psychological/' . $victim['id']) ?>" method="POST">
                        <?= csrf_field() ?>
                        <div class="border-bottom pb-3 mb-4">
                            <h5 class="fw-bold text-dark mb-1"><i class="bi bi-journal-medical text-primary me-2"></i> Section 3 — Riwayat Medis & Psikologis Sensitif</h5>
                            <p class="text-muted small mb-0">Kerahasiaan data terjamin. Hanya dapat diakses oleh Relawan dan Psikolog bertugas.</p>
                        </div>

                        <div class="row g-4">
                            <!-- Konsultasi & Psikiater -->
                            <div class="col-12 col-md-6">
                                <div class="card card-custom bg-light p-3 border">
                                    <div class="form-check form-switch mb-3">
                                        <input class="form-check-input" type="checkbox" id="pernah_konsultasi" name="pernah_konsultasi" value="1"
                                               <?= old('pernah_konsultasi', $psychHist['pernah_konsultasi'] ?? 0) ? 'checked' : '' ?>>
                                        <label class="form-check-label fw-semibold text-dark" for="pernah_konsultasi">Pernah Konsultasi ke Psikolog?</label>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="pernah_dirawat_psikiater" name="pernah_dirawat_psikiater" value="1"
                                               <?= old('pernah_dirawat_psikiater', $psychHist['pernah_dirawat_psikiater'] ?? 0) ? 'checked' : '' ?>>
                                        <label class="form-check-label fw-semibold text-dark" for="pernah_dirawat_psikiater">Pernah Dirawat oleh Psikiater?</label>
                                    </div>
                                </div>
                            </div>

                            <!-- Suicide / Self-Harm / NAPZA -->
                            <div class="col-12 col-md-6">
                                <div class="card card-custom bg-light p-3 border border-danger border-opacity-25">
                                    <div class="form-check form-switch mb-2">
                                        <input class="form-check-input" type="checkbox" id="riwayat_percobaan_bunuh_diri" name="riwayat_percobaan_bunuh_diri" value="1"
                                               <?= old('riwayat_percobaan_bunuh_diri', $psychHist['riwayat_percobaan_bunuh_diri'] ?? 0) ? 'checked' : '' ?>>
                                        <label class="form-check-label fw-semibold text-danger" for="riwayat_percobaan_bunuh_diri">Riwayat Percobaan Bunuh Diri</label>
                                    </div>
                                    <div class="form-check form-switch mb-2">
                                        <input class="form-check-input" type="checkbox" id="riwayat_melukai_diri" name="riwayat_melukai_diri" value="1"
                                               <?= old('riwayat_melukai_diri', $psychHist['riwayat_melukai_diri'] ?? 0) ? 'checked' : '' ?>>
                                        <label class="form-check-label fw-semibold text-danger" for="riwayat_melukai_diri">Riwayat Melukai Diri (Self-Harm)</label>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="riwayat_napza" name="riwayat_napza" value="1"
                                               <?= old('riwayat_napza', $psychHist['riwayat_napza'] ?? 0) ? 'checked' : '' ?>>
                                        <label class="form-check-label fw-semibold text-dark" for="riwayat_napza">Riwayat Penggunaan NAPZA</label>
                                    </div>
                                </div>
                            </div>

                            <!-- Diagnosis Sebelumnya Multiple Checkbox -->
                            <div class="col-12">
                                <label class="form-label fw-semibold d-block">Diagnosis Sebelumnya (Boleh Pilih Lebih dari Satu)</label>
                                <div class="row g-2 bg-light p-3 rounded border">
                                    <?php 
                                    $diagOptions = ['Depresi', 'PTSD', 'Bipolar', 'Panic Disorder', 'Skizofrenia', 'ADHD'];
                                    foreach ($diagOptions as $dOpt):
                                        $isChecked = in_array($dOpt, $savedDiagnoses, true);
                                    ?>
                                        <div class="col-6 col-sm-4 col-md-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="diagnosis[]" value="<?= $dOpt ?>" id="diag_<?= $dOpt ?>" <?= $isChecked ? 'checked' : '' ?>>
                                                <label class="form-check-label fw-medium" for="diag_<?= $dOpt ?>"><?= $dOpt ?></label>
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
                                    <div class="col-12 mt-2">
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-text bg-white">Diagnosis Lainnya</span>
                                            <input type="text" class="form-control" name="diagnosis_lainnya" placeholder="Tuliskan diagnosis lain jika ada..." value="<?= esc($lainnyaVal) ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Dynamic Toggle: Sedang Konsumsi Obat -->
                            <div class="col-12 col-md-6">
                                <div class="card card-custom p-3 border">
                                    <div class="form-check form-switch mb-3">
                                        <input class="form-check-input" type="checkbox" id="sedang_konsumsi_obat" name="sedang_konsumsi_obat" value="1"
                                               <?= old('sedang_konsumsi_obat', $psychHist['sedang_konsumsi_obat'] ?? 0) ? 'checked' : '' ?>
                                               onchange="toggleMedicineFields(this.checked)">
                                        <label class="form-check-label fw-semibold text-dark" for="sedang_konsumsi_obat">Sedang Konsumsi Obat-obatan?</label>
                                    </div>

                                    <div id="medicine-fields" class="<?= old('sedang_konsumsi_obat', $psychHist['sedang_konsumsi_obat'] ?? 0) ? '' : 'd-none' ?>">
                                        <div class="mb-2">
                                            <label class="form-label small fw-semibold">Nama Obat</label>
                                            <input type="text" class="form-control form-control-sm" name="nama_obat" value="<?= old('nama_obat', $psychHist['nama_obat'] ?? '') ?>" placeholder="Misal: Sertraline, Alprazolam">
                                        </div>
                                        <div class="mb-2">
                                            <label class="form-label small fw-semibold">Dosis</label>
                                            <input type="text" class="form-control form-control-sm" name="dosis" value="<?= old('dosis', $psychHist['dosis'] ?? '') ?>" placeholder="Misal: 50mg 1x1 hari">
                                        </div>
                                        <div>
                                            <label class="form-label small fw-semibold">Dokter Penanggung Jawab</label>
                                            <input type="text" class="form-control form-control-sm" name="dokter" value="<?= old('dokter', $psychHist['dokter'] ?? '') ?>" placeholder="Nama Dokter / Rumah Sakit">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Dynamic Toggle: Riwayat Penyakit Kronis -->
                            <div class="col-12 col-md-6">
                                <div class="card card-custom p-3 border">
                                    <div class="form-check form-switch mb-3">
                                        <input class="form-check-input" type="checkbox" id="riwayat_penyakit_kronis" name="riwayat_penyakit_kronis" value="1"
                                               <?= old('riwayat_penyakit_kronis', $psychHist['riwayat_penyakit_kronis'] ?? 0) ? 'checked' : '' ?>
                                               onchange="toggleChronicFields(this.checked)">
                                        <label class="form-check-label fw-semibold text-dark" for="riwayat_penyakit_kronis">Riwayat Penyakit Kronis Fisik?</label>
                                    </div>

                                    <div id="chronic-fields" class="<?= old('riwayat_penyakit_kronis', $psychHist['riwayat_penyakit_kronis'] ?? 0) ? '' : 'd-none' ?>">
                                        <label class="form-label small fw-semibold">Keterangan Penyakit Kronis</label>
                                        <textarea class="form-control form-control-sm" name="keterangan_penyakit_kronis" rows="3" placeholder="Misal: Hipertensi, Diabetes Melitus, Asma..."><?= old('keterangan_penyakit_kronis', $psychHist['keterangan_penyakit_kronis'] ?? '') ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="next_tab" value="screening">
                        <div class="border-top pt-3 mt-4 d-flex justify-content-between align-items-center flex-wrap gap-2">
                            <button type="reset" class="btn btn-outline-secondary px-4 py-2 fw-semibold">
                                <i class="bi bi-arrow-counterclockwise me-1"></i> Reset Form Riwayat Psikologis
                            </button>
                            <button type="submit" class="btn btn-primary px-4 py-2 fw-semibold shadow-sm">
                                <i class="bi bi-floppy-fill me-1"></i> Simpan & Lanjut ke Skrining Relawan <i class="bi bi-arrow-right ms-1"></i>
                            </button>
                        </div>
                    </form>
                <?php endif; ?>
            </div>

            <!-- TAB 4: FORM SCREENING AWAL RELAWAN (SEGMEN 7) -->
            <div class="tab-pane fade" id="tab-screening" role="tabpanel">
                <?php if ($userRole === 'bpbd_admin'): ?>
                    <div class="alert alert-warning border-start border-4 border-warning p-4 shadow-sm my-3">
                        <h5 class="fw-bold text-dark mb-2"><i class="bi bi-shield-lock-fill text-warning me-2"></i> Hak Akses Dibatasi</h5>
                        <p class="mb-0">Form Skrining Awal Relawan merupakan instrumen observasi lapangan yang diisi oleh <strong>Relawan Posko</strong> dan ditinjau oleh <strong>Psikolog</strong>.</p>
                    </div>
                <?php else: ?>
                    <!-- EMERGENCY SUICIDE RISK ALERT BANNER (Non-Dismissable) -->
                    <div id="emergency-suicide-alert" class="alert alert-danger border-3 border-danger shadow p-3 mb-4 d-none" role="alert">
                        <div class="d-flex align-items-center gap-3">
                            <div class="display-5 text-danger"><i class="bi bi-exclamation-triangle-fill"></i></div>
                            <div>
                                <h5 class="fw-bold text-danger mb-1">⚠️ PERINGATAN DARURAT KRISIS: RISIKO BUNUH DIRI TERDETEKSI!</h5>
                                <p class="mb-1 text-dark small">
                                    Penyintas menunjukkan indikasi serius (menyebut ingin mati / mengancam bunuh diri / melukai diri). 
                                    Relawan diinstruksikan untuk <strong>SEGERA MENGHUBUNGI PSIKOLOG JAGA / HOTLINE POSKO</strong> secara langsung tanpa menunda!
                                </p>
                                <div class="fw-bold text-danger fs-6">
                                    <i class="bi bi-telephone-fill me-1"></i> Hotline Psikolog Jaga: <strong>0800-1-PSY-AID (Ext. 99)</strong> / Posko Utama
                                </div>
                            </div>
                        </div>
                    </div>

                    <form action="<?= site_url('/screening/store/' . $victim['id']) ?>" method="POST" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        <div class="border-bottom pb-3 mb-4 d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="fw-bold text-dark mb-1"><i class="bi bi-clipboard-pulse text-success me-2"></i> Section 4 — Form Screening Awal Relawan</h5>
                                <p class="text-muted small mb-0">Observasi gejala fisik, perilaku, dan tingkat distres psikologis penyintas di lapangan.</p>
                            </div>
                            <?php if ($screening): ?>
                                <span class="badge bg-success px-3 py-2 fs-7"><i class="bi bi-check-circle-fill me-1"></i> Terakhir Diisi: <?= esc($screening['created_at']) ?></span>
                            <?php endif; ?>
                        </div>

                        <!-- 1. Orientasi & Kontak -->
                        <div class="card card-custom p-3 bg-light border mb-4">
                            <h6 class="fw-bold text-dark mb-3"><i class="bi bi-compass me-1 text-primary"></i> 1. Observasi Orientasi & Respon Bicara</h6>
                            <div class="row g-3">
                                <div class="col-12 col-md-4">
                                    <label class="form-label small fw-semibold">Kemampuan Orientasi</label>
                                    <div class="form-check form-switch mb-1">
                                        <input class="form-check-input" type="checkbox" id="mampu_sebut_nama" name="mampu_sebut_nama" value="1" <?= old('mampu_sebut_nama', $screening['mampu_sebut_nama'] ?? 1) ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="mampu_sebut_nama">Mampu sebut Nama</label>
                                    </div>
                                    <div class="form-check form-switch mb-1">
                                        <input class="form-check-input" type="checkbox" id="mampu_sebut_lokasi" name="mampu_sebut_lokasi" value="1" <?= old('mampu_sebut_lokasi', $screening['mampu_sebut_lokasi'] ?? 1) ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="mampu_sebut_lokasi">Mampu sebut Lokasi</label>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="mampu_sebut_tanggal" name="mampu_sebut_tanggal" value="1" <?= old('mampu_sebut_tanggal', $screening['mampu_sebut_tanggal'] ?? 1) ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="mampu_sebut_tanggal">Mampu sebut Tanggal/Hari</label>
                                    </div>
                                </div>

                                <div class="col-12 col-md-4">
                                    <label class="form-label small fw-semibold d-block">Kontak Mata</label>
                                    <?php $km = old('kontak_mata', $screening['kontak_mata'] ?? 'baik'); ?>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="kontak_mata" id="km1" value="baik" <?= $km === 'baik' ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="km1">Baik</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="kontak_mata" id="km2" value="kurang" <?= $km === 'kurang' ? 'checked' : '' ?>>
                                        <label class="form-check-label small text-warning" for="km2">Kurang</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="kontak_mata" id="km3" value="tidak ada" <?= $km === 'tidak ada' ? 'checked' : '' ?>>
                                        <label class="form-check-label small text-danger" for="km3">Tidak ada</label>
                                    </div>
                                </div>

                                <div class="col-12 col-md-4">
                                    <label class="form-label small fw-semibold d-block">Cara Berbicara</label>
                                    <?php $bc = old('bicara', $screening['bicara'] ?? 'normal'); ?>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="bicara" id="bc1" value="normal" <?= $bc === 'normal' ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="bc1">Normal</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="bicara" id="bc2" value="pelan" <?= $bc === 'pelan' ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="bc2">Pelan / Bisik</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="bicara" id="bc3" value="tidak menjawab" <?= $bc === 'tidak menjawab' ? 'checked' : '' ?>>
                                        <label class="form-check-label small text-warning" for="bc3">Tidak Menjawab</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="bicara" id="bc4" value="berteriak" <?= $bc === 'berteriak' ? 'checked' : '' ?>>
                                        <label class="form-check-label small text-danger" for="bc4">Berteriak</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 2. Observasi Perilaku (15 Item) -->
                        <div class="card card-custom p-3 bg-light border mb-4">
                            <h6 class="fw-bold text-dark mb-3"><i class="bi bi-person-exclamation me-1 text-danger"></i> 2. Indikator Perilaku & Gejala Distres</h6>
                            <div class="row g-2">
                                <?php 
                                $perilakuItems = [
                                    'menangis_terus'       => 'Menangis terus menerus',
                                    'tampak_panik'         => 'Tampak sangat panik',
                                    'sulit_ditenangkan'    => 'Sulit ditenangkan',
                                    'gemetar'              => 'Tubuh gemetar hebat',
                                    'berteriak_histeris'   => 'Berteriak histeris',
                                    'diam_total'           => 'Diam total (Stupor/Catatonic)',
                                    'menghindari_orang'    => 'Menghindari orang lain',
                                    'menyebut_ingin_mati'  => '⚠️ Menyebut ingin mati',
                                    'mengancam_bunuh_diri' => '⚠️ Mengancam bunuh diri',
                                    'melukai_diri'         => '⚠️ Melukai diri (Self-Harm)',
                                    'agresif'              => 'Perilaku agresif / Ngamuk',
                                    'mencari_keluarga'     => 'Panik mencari keluarga',
                                    'sulit_tidur'          => 'Keluhan sulit tidur / Insomnia',
                                    'mimpi_buruk'          => 'Mimpi buruk berulang',
                                    'tidak_mau_makan'      => 'Menolak makan / minum',
                                ];

                                foreach ($perilakuItems as $key => $label):
                                    $isEmergency = in_array($key, ['menyebut_ingin_mati', 'mengancam_bunuh_diri', 'melukai_diri'], true);
                                    $isChecked   = old($key, $screening[$key] ?? 0);
                                ?>
                                    <div class="col-12 col-sm-6 col-md-4">
                                        <div class="p-2 bg-white rounded border <?= $isEmergency ? 'border-danger border-opacity-50' : '' ?>">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input emergency-check" type="checkbox" id="<?= $key ?>" name="<?= $key ?>" value="1" 
                                                       <?= $isChecked ? 'checked' : '' ?> onchange="checkEmergencyAlert()">
                                                <label class="form-check-label small <?= $isEmergency ? 'fw-bold text-danger' : 'text-dark' ?>" for="<?= $key ?>">
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
                            <h6 class="fw-bold text-dark mb-3"><i class="bi bi-paperclip text-info me-1"></i> 3. Upload Dokumentasi Media Lapangan (Opsional)</h6>
                            <div class="row g-3">
                                <div class="col-12 col-sm-6 col-md-3">
                                    <label class="form-label small fw-semibold">Foto Kejadian / Kondisi</label>
                                    <input type="file" class="form-control form-control-sm" name="foto" accept="image/*">
                                    <?php if (! empty($screening['foto_path'])): ?>
                                        <div class="fs-8 text-success mt-1"><i class="bi bi-file-earmark-check"></i> Berkas Foto Tersimpan</div>
                                    <?php endif; ?>
                                </div>
                                <div class="col-12 col-sm-6 col-md-3">
                                    <label class="form-label small fw-semibold">Voice Note Rekaman Suara</label>
                                    <input type="file" class="form-control form-control-sm" name="voice_note" accept="audio/*">
                                    <?php if (! empty($screening['voice_note_path'])): ?>
                                        <div class="fs-8 text-success mt-1"><i class="bi bi-file-earmark-check"></i> Voice Note Tersimpan</div>
                                    <?php endif; ?>
                                </div>
                                <div class="col-12 col-sm-6 col-md-3">
                                    <label class="form-label small fw-semibold">Video Dokumentasi</label>
                                    <input type="file" class="form-control form-control-sm" name="video" accept="video/*">
                                    <?php if (! empty($screening['video_path'])): ?>
                                        <div class="fs-8 text-success mt-1"><i class="bi bi-file-earmark-check"></i> Video Tersimpan</div>
                                    <?php endif; ?>
                                </div>
                                <div class="col-12 col-sm-6 col-md-3">
                                    <label class="form-label small fw-semibold">Dokumen / PDF Lapangan</label>
                                    <input type="file" class="form-control form-control-sm" name="dokumen" accept=".pdf,.doc,.docx">
                                    <?php if (! empty($screening['dokumen_path'])): ?>
                                        <div class="fs-8 text-success mt-1"><i class="bi bi-file-earmark-check"></i> Dokumen Tersimpan</div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <div class="border-top pt-3 mt-4 d-flex justify-content-between align-items-center flex-wrap gap-2">
                            <button type="reset" class="btn btn-outline-secondary px-4 py-2 fw-semibold">
                                <i class="bi bi-arrow-counterclockwise me-1"></i> Reset Form Skrining
                            </button>
                            <button type="submit" class="btn btn-success px-4 py-2 fw-semibold shadow-sm">
                                <i class="bi bi-cpu-fill me-1"></i> Simpan & Proses AI Assessment <i class="bi bi-arrow-right ms-1"></i>
                            </button>
                        </div>
                    </form>
                <?php endif; ?>
            </div>

            <!-- TAB 5: AI CLINICAL DECISION SUPPORT (SEGMEN 8) -->
            <div class="tab-pane fade" id="tab-ai" role="tabpanel">
                <div class="border-bottom pb-3 mb-4 d-flex align-items-center justify-content-between flex-wrap gap-2">
                    <div>
                        <h5 class="fw-bold text-dark mb-1"><i class="bi bi-cpu-fill text-danger me-2"></i> Section 5 — AI Clinical Decision Support</h5>
                        <p class="text-muted small mb-0">Engine triase & analisis psikologis klinis berbasis AI Gemini & Indikator Objektif.</p>
                    </div>
                    <div class="d-flex align-items-center flex-wrap gap-2">
                        <?php if (! empty($aiAssessment)): ?>
                            <?php $isGemini = strpos($aiAssessment['ai_summary'] ?? '', '[Gemini AI') !== false; ?>
                            <?php if ($isGemini): ?>
                                <span class="badge bg-primary px-3 py-2 fs-7"><i class="bi bi-stars me-1"></i> Engine: Gemini API + RAG + Web Search</span>
                            <?php else: ?>
                                <span class="badge bg-dark px-3 py-2 fs-7"><i class="bi bi-journal-bookmark-fill me-1"></i> Engine: RAG + Rule-Based Engine</span>
                            <?php endif; ?>
                            <span class="badge bg-success px-3 py-2 fs-7"><i class="bi bi-database-check me-1"></i> RAG Base Active</span>
                            <span class="badge bg-secondary px-3 py-2 fs-7"><i class="bi bi-clock me-1"></i> Generated: <?= esc($aiAssessment['generated_at']) ?></span>
                        <?php endif; ?>

                        <?php if (in_array($userRole, ['relawan', 'psikolog'], true)): ?>
                            <a href="<?= site_url('/screening/reassess/' . $victim['id']) ?>" class="btn btn-outline-primary btn-sm px-3 py-2 fw-semibold rounded-3 shadow-sm">
                                <i class="bi bi-arrow-clockwise me-1"></i> Analisis Ulang AI (RAG + Web Search)
                            </a>
                        <?php endif; ?>
                    </div>
                </div>


                <!-- BIODATA PENYINTAS CARD -->
                <div class="card card-custom p-3 bg-white border border-primary border-opacity-25 mb-4 shadow-sm">
                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                        <div>
                            <span class="text-muted small fw-semibold text-uppercase">Penyintas Teranalisis:</span>
                            <h5 class="fw-bold text-primary mb-0">
                                <i class="bi bi-person-circle me-1"></i> <?= esc($victim['nama']) ?> 
                                <span class="fs-6 text-dark fw-normal">(NIK: <?= esc($victim['nik'] ?? '-') ?>)</span>
                            </h5>
                            <div class="small text-muted mt-1">
                                <?= esc($victim['jenis_kelamin'] === 'L' ? 'Laki-Laki' : 'Perempuan') ?> • <?= esc($victim['umur']) ?> Tahun • Posko: <?= esc($victim['posko_name']) ?>
                            </div>
                        </div>
                        <div class="text-end">
                            <span class="badge bg-light text-dark border px-3 py-2">
                                <i class="bi bi-calendar-event me-1"></i> Tiba: <?= esc($victim['tanggal_datang']) ?> <?= esc($victim['jam_datang']) ?>
                            </span>
                        </div>
                    </div>
                </div>

                <?php if (empty($aiAssessment)): ?>
                    <div class="alert alert-secondary text-center p-4">
                        <i class="bi bi-cpu fs-2 d-block mb-2 text-muted"></i>
                        AI Clinical Decision Support belum di-generate. Lakukan pengisian <strong>Skrining Awal Relawan</strong> untuk memicu analisis otomatis.
                    </div>
                <?php else: ?>
                    <div class="row g-3 mb-4">
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="card card-custom p-3 bg-light border-start border-4 border-danger h-100">
                                <div class="text-muted small fw-semibold text-uppercase">Tingkat Risiko (Risk Level)</div>
                                <div class="d-flex align-items-center justify-content-between mt-2">
                                    <?php if ($aiAssessment['risk_level'] === 'high'): ?>
                                        <span class="badge bg-danger fs-6 px-3 py-2"><i class="bi bi-exclamation-triangle-fill me-1"></i> HIGH RISK</span>
                                    <?php elseif ($aiAssessment['risk_level'] === 'medium'): ?>
                                        <span class="badge bg-warning text-dark fs-6 px-3 py-2"><i class="bi bi-dash-circle-fill me-1"></i> MEDIUM RISK</span>
                                    <?php else: ?>
                                        <span class="badge bg-info text-dark fs-6 px-3 py-2"><i class="bi bi-check-circle-fill me-1"></i> LOW RISK</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="card card-custom p-3 bg-light border-start border-4 border-primary h-100">
                                <div class="text-muted small fw-semibold text-uppercase">Confidence Ratio</div>
                                <div class="fs-2 fw-bold text-primary mt-1"><?= esc($aiAssessment['confidence']) ?>%</div>
                                <div class="small text-muted">Rasio pembobotan indikator</div>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="card card-custom p-3 bg-light border-start border-4 border-warning h-100">
                                <div class="text-muted small fw-semibold text-uppercase">Clinical Priority</div>
                                <div class="fs-4 fw-bold text-dark mt-2"><?= esc($aiAssessment['clinical_priority']) ?></div>
                                <div class="small text-muted">Status: <span class="badge bg-secondary"><?= esc($aiAssessment['status']) ?></span></div>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="card card-custom p-3 bg-light border-start border-4 border-success h-100">
                                <div class="text-muted small fw-semibold text-uppercase">Instrumen ITQ (Trauma)</div>
                                <?php if (! empty($itqResult)): ?>
                                    <div class="mt-2">
                                        <span class="badge <?= ($itqResult['overall_risk'] ?? '') === 'HIGH' ? 'bg-danger' : 'bg-warning text-dark' ?> fs-6 px-2 py-1">
                                            ITQ Risk: <?= esc($itqResult['overall_risk'] ?? 'MEDIUM') ?>
                                        </span>
                                        <div class="fs-8 text-muted mt-1">PTSD: <strong><?= esc($itqResult['ptsd_score'] ?? 0) ?>/24</strong> • DSO: <strong><?= esc($itqResult['dso_score'] ?? 0) ?>/24</strong></div>
                                    </div>
                                <?php else: ?>
                                    <div class="mt-2">
                                        <span class="badge bg-secondary px-2 py-1">Belum Diisi ITQ</span>
                                        <div class="fs-8 text-muted mt-1">Menunggu Review Psikolog</div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <div class="card card-custom p-4 bg-light border mb-4">
                        <!-- RAG & WEB SEARCH GROUNDING INFO BANNER -->
                        <div class="p-3 bg-white rounded border border-info border-opacity-50 mb-3 shadow-sm d-flex align-items-center justify-content-between flex-wrap gap-2">
                            <div class="d-flex align-items-center gap-2">
                                <i class="bi bi-search-heart fs-3 text-info"></i>
                                <div>
                                    <h6 class="fw-bold text-dark mb-0">RAG Clinical Knowledge Base & Web Search Grounding</h6>
                                    <div class="small text-muted">Diperkuat pedoman klinis WHO PFA, IASC MHPSS, HIMPSI Crisis Protocol & Penelusuran Web Gemini.</div>
                                </div>
                            </div>
                            <div>
                                <span class="badge bg-success px-2 py-1 fs-8"><i class="bi bi-database-check me-1"></i> WHO / IASC / HIMPSI RAG</span>
                                <span class="badge bg-primary px-2 py-1 fs-8"><i class="bi bi-globe me-1"></i> Google Search Grounded</span>
                            </div>
                        </div>

                        <h6 class="fw-bold text-dark mb-2"><i class="bi bi-journal-check text-primary me-2"></i> Kemungkinan Diagnosis Klinis</h6>
                        <p class="fw-semibold text-danger fs-6 mb-3"><?= esc($aiAssessment['kemungkinan_diagnosis']) ?></p>


                        <!-- ITQ Questionnaire Detail Summary (If Available) -->
                        <?php if (! empty($itqResult)): ?>
                            <div class="p-3 bg-white rounded border border-success border-opacity-50 mb-3">
                                <h6 class="fw-bold text-dark mb-2"><i class="bi bi-clipboard-data text-success me-2"></i> Hasil Instrumen ITQ (International Trauma Questionnaire)</h6>
                                <div class="row g-2 small text-dark">
                                    <div class="col-12 col-md-6">
                                        • <strong>Skor PTSD (ICD-11)</strong>: <?= esc($itqResult['ptsd_score']) ?> / 24 (Keparahan: <strong><?= esc($itqResult['ptsd_severity']) ?></strong>) — Kriteria: <span class="badge <?= ! empty($itqResult['ptsd_criteria_met']) ? 'bg-danger' : 'bg-secondary' ?>"><?= ! empty($itqResult['ptsd_criteria_met']) ? 'TERPENUHI' : 'Belum Terpenuhi' ?></span>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        • <strong>Skor DSO / CPTSD</strong>: <?= esc($itqResult['dso_score']) ?> / 24 (Keparahan: <strong><?= esc($itqResult['dso_severity']) ?></strong>) — Kriteria: <span class="badge <?= ! empty($itqResult['dso_criteria_met']) ? 'bg-danger' : 'bg-secondary' ?>"><?= ! empty($itqResult['dso_criteria_met']) ? 'TERPENUHI' : 'Belum Terpenuhi' ?></span>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>

                        <h6 class="fw-bold text-dark mb-2"><i class="bi bi-chat-left-quote text-success me-2"></i> AI Summary & Rekomendasi Naratif</h6>
                        <p class="text-dark bg-white p-3 rounded border mb-3"><?= esc($aiAssessment['ai_summary']) ?></p>

                        <h6 class="fw-bold text-dark mb-2"><i class="bi bi-list-check me-2"></i> Sumber Bukti & Indikator (Evidence Sources)</h6>
                        <pre class="bg-white p-3 rounded border text-muted small mb-0" style="white-space: pre-wrap; font-family: inherit;"><?= esc($aiAssessment['evidence_sources']) ?></pre>
                    </div>

                    <?php if ($userRole === 'psikolog'): ?>
                        <div class="text-end">
                            <a href="<?= site_url('/psychologist-review/' . $victim['id']) ?>" class="btn btn-primary px-4 py-2 fw-semibold shadow-sm">
                                <i class="bi bi-stethoscope me-1"></i> Buka Form Review MSE & ITQ <i class="bi bi-arrow-right ms-1"></i>
                            </a>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>


        </div>
    </div>
</div>

<!-- JavaScript for Dynamic Form Toggles & Emergency Suicide Risk Alert -->
<script>
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
document.addEventListener('DOMContentLoaded', function() {
    checkEmergencyAlert();

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
</script>
<?= $this->endSection() ?>
