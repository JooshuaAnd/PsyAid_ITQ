<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<!-- Header Posko -->
<div class="card card-custom bg-white p-4 mb-4 shadow-sm">
    <div class="row align-items-center g-3">
        <div class="col-12 col-lg-8">
            <h3 class="fw-bold text-dark mb-1">
                <i class="bi bi-geo-alt-fill text-danger me-2"></i> <?= esc($posko['name']) ?>
            </h3>
            <p class="text-muted small mb-2">
                <i class="bi bi-building me-1"></i> <?= esc($posko['regency_name']) ?>,
                <?= esc($posko['province_name']) ?>
                <span class="mx-2">•</span>
                Jenis Bencana: <strong class="text-dark"><?= esc($posko['jenis_bencana']) ?></strong>
            </p>

            <!-- Tim Personel Bertugas -->
            <div class="d-flex align-items-center flex-wrap gap-2 mt-3 pt-2 border-top">
                <span class="small text-muted fw-semibold me-1"><i class="bi bi-people-fill me-1"></i> Personel
                    Bertugas:</span>
                <?php if (empty($personnel)): ?>
                    <span class="badge bg-light text-muted border fs-7">Belum ada personel terdaftar</span>
                <?php else: ?>
                    <?php foreach ($personnel as $p): ?>
                        <?php if ($p['role'] === 'psikolog'): ?>
                            <span class="badge bg-primary bg-opacity-10 text-primary border border-primary fs-7">
                                <i class="bi bi-heart-pulse-fill me-1"></i> <?= esc($p['name']) ?> (Psikolog)
                            </span>
                        <?php elseif ($p['role'] === 'relawan'): ?>
                            <span class="badge bg-success bg-opacity-10 text-success border border-success fs-7">
                                <i class="bi bi-person-badge-fill me-1"></i> <?= esc($p['name']) ?> (Relawan)
                            </span>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>

        <div class="col-12 col-lg-4 text-lg-end">
            <a href="<?= site_url('/victim/create/' . $posko['id']) ?>"
                class="btn btn-success fw-bold px-3 py-2 me-2 shadow-sm">
                <i class="bi bi-person-plus-fill me-1"></i> + Tambah Korban Baru
            </a>
            <?php if ($posko['status'] === 'aktif'): ?>
                <span class="badge bg-success fs-6 px-3 py-2"><i class="bi bi-check-circle me-1"></i> Posko Aktif</span>
            <?php elseif ($posko['status'] === 'recovery'): ?>
                <span class="badge bg-warning text-dark fs-6 px-3 py-2"><i class="bi bi-arrow-repeat me-1"></i> Masa
                    Recovery</span>
            <?php else: ?>
                <span class="badge bg-secondary fs-6 px-3 py-2"><i class="bi bi-x-circle me-1"></i> Posko Closed</span>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Stats Overview Posko -->
<div class="row g-3 mb-4">
    <div class="col-12 col-sm-6 col-lg-3">
        <div class="card card-custom bg-white p-3 border-start border-4 border-dark h-100">
            <div class="text-muted small fw-semibold text-uppercase">Total Penyintas Posko</div>
            <div class="fs-2 fw-bold text-dark mt-1"><?= esc($stats['total_korban']) ?> Orang</div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-lg-3">
        <div class="card card-custom bg-white p-3 border-start border-4 border-success h-100">
            <div class="text-muted small fw-semibold text-uppercase">Status Skrining Relawan</div>
            <div class="mt-2">
                <div class="d-flex justify-content-between small mb-1">
                    <span class="text-success fw-semibold"><i class="bi bi-check-circle me-1"></i> Sudah Skrining</span>
                    <strong class="text-dark"><?= esc($stats['sudah_screening']) ?></strong>
                </div>
                <div class="d-flex justify-content-between small">
                    <span class="text-muted"><i class="bi bi-clock me-1"></i> Belum Skrining</span>
                    <strong class="text-secondary"><?= esc($stats['belum_screening']) ?></strong>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-lg-3">
        <div class="card card-custom bg-white p-3 border-start border-4 border-danger h-100">
            <div class="text-muted small fw-semibold text-uppercase">AI Assessment: High Risk</div>
            <div class="d-flex align-items-baseline justify-content-between mt-1">
                <div class="fs-2 fw-bold text-danger"><?= esc($stats['risk_high']) ?></div>
                <span class="badge bg-danger bg-opacity-10 text-danger border border-danger">Prioritas Intervensi</span>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-lg-3">
        <div class="card card-custom bg-white p-3 border-start border-4 border-warning h-100">
            <div class="text-muted small fw-semibold text-uppercase">AI Risk: Medium / Low</div>
            <div class="mt-2">
                <div class="d-flex justify-content-between small mb-1">
                    <span class="text-dark fw-semibold"><i class="bi bi-dash-circle text-warning me-1"></i> Medium
                        Risk</span>
                    <strong><?= esc($stats['risk_medium']) ?></strong>
                </div>
                <div class="d-flex justify-content-between small">
                    <span class="text-info fw-semibold"><i class="bi bi-check-circle text-info me-1"></i> Low
                        Risk</span>
                    <strong><?= esc($stats['risk_low']) ?></strong>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Manajemen Tabel Penyintas (Victims Management) -->
<div class="card card-custom bg-white p-4 shadow-sm mb-4">
    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3">
        <h5 class="fw-bold text-dark mb-0">
            <i class="bi bi-person-lines-fill text-danger me-2"></i> Daftar Manajemen Penyintas (Victims)
        </h5>
        <span class="badge bg-light text-dark border px-3 py-2">
            <?= count($victims) ?> Penyintas Tampil
        </span>
    </div>

    <!-- Form Filter & Pencarian Penyintas -->
    <form method="GET" action="<?= site_url('/posko/' . $posko['id']) ?>"
        class="row g-2 mb-3 bg-light p-3 rounded border">
        <div class="col-12 col-md-5">
            <input type="text" name="q" class="form-control form-control-sm"
                placeholder="Cari Nama Penyintas atau NIK..." value="<?= esc($searchFilters['keyword'] ?? '') ?>">
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <select name="screening_status" class="form-select form-select-sm">
                <option value="">-- Semua Status Skrining --</option>
                <option value="sudah" <?= ($searchFilters['screening_status'] ?? '') === 'sudah' ? 'selected' : '' ?>>Sudah
                    Skrining</option>
                <option value="belum" <?= ($searchFilters['screening_status'] ?? '') === 'belum' ? 'selected' : '' ?>>Belum
                    Skrining</option>
            </select>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <select name="risk_level" class="form-select form-select-sm">
                <option value="">-- Semua Risk Level --</option>
                <option value="high" <?= ($searchFilters['risk_level'] ?? '') === 'high' ? 'selected' : '' ?>>High Risk
                </option>
                <option value="medium" <?= ($searchFilters['risk_level'] ?? '') === 'medium' ? 'selected' : '' ?>>Medium
                    Risk</option>
                <option value="low" <?= ($searchFilters['risk_level'] ?? '') === 'low' ? 'selected' : '' ?>>Low Risk
                </option>
            </select>
        </div>
        <div class="col-12 col-md-1 d-flex gap-1">
            <button type="submit" class="btn btn-sm btn-primary w-100"><i class="bi bi-search"></i></button>
            <a href="<?= site_url('/posko/' . $posko['id']) ?>" class="btn btn-sm btn-outline-secondary"
                title="Reset"><i class="bi bi-x-circle"></i></a>
        </div>
    </form>

    <!-- Table Victim List -->
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light text-muted small text-uppercase">
                <tr>
                    <th style="width: 5%;">No</th>
                    <th style="width: 25%;">Nama & NIK</th>
                    <th style="width: 12%;">GENDER & UMUR</th>
                    <th style="width: 15%;">Waktu Datang</th>
                    <th style="width: 15%;">Status Skrining</th>
                    <th style="width: 13%;">AI Risk Level</th>
                    <th style="width: 15%;">Psikolog Assigned</th>
                    <th style="width: 10%;" class="text-end">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($victims)): ?>
                    <tr>
                        <td colspan="8" class="text-center py-4 text-muted">
                            <i class="bi bi-inbox fs-3 d-block mb-1"></i>
                            Tidak ada data penyintas yang sesuai dengan kriteria pencarian.
                        </td>
                    </tr>
                <?php else: ?>
                    <?php $no = 1;
                    foreach ($victims as $v): ?>
                        <tr class="<?= $v['risk_level'] === 'high' ? 'table-danger bg-opacity-10' : '' ?>">
                            <td class="fw-bold text-muted"><?= $no++ ?></td>
                            <td>
                                <a href="<?= site_url('/victim/detail/' . $v['id']) ?>"
                                    class="fw-bold text-dark text-decoration-none hover-danger">
                                    <?= esc($v['nama']) ?>
                                </a>
                                <div class="fs-8 text-muted">NIK: <?= esc($v['nik'] ?? '-') ?></div>
                            </td>
                            <td>
                                <span class="badge bg-light text-dark border me-1"><?= esc($v['jenis_kelamin']) ?></span>
                                <span class="small text-muted"><?= esc($v['umur']) ?> Thn</span>
                            </td>
                            <td class="small text-muted">
                                <div><i class="bi bi-calendar3 me-1"></i> <?= esc($v['tanggal_datang']) ?></div>
                                <div class="fs-8"><i class="bi bi-clock me-1"></i> <?= esc($v['jam_datang']) ?></div>
                            </td>
                            <td>
                                <?php if ($v['screening_id']): ?>
                                    <span class="badge bg-success mb-1">
                                        <i class="bi bi-check-circle-fill me-1"></i> Sudah Skrining
                                    </span>
                                    <div class="fs-8 text-muted">Distress: <strong><?= esc($v['skala_distress']) ?>/10</strong>
                                    </div>
                                <?php else: ?>
                                    <span class="badge bg-secondary">
                                        <i class="bi bi-clock-history me-1"></i> Belum Skrining
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if ($v['risk_level'] === 'high'): ?>
                                    <span class="badge bg-danger fs-7 px-2 py-1">
                                        <i class="bi bi-exclamation-triangle-fill me-1"></i> HIGH RISK
                                    </span>
                                <?php elseif ($v['risk_level'] === 'medium'): ?>
                                    <span class="badge bg-warning text-dark fs-7 px-2 py-1">
                                        <i class="bi bi-dash-circle-fill me-1"></i> MEDIUM RISK
                                    </span>
                                <?php elseif ($v['risk_level'] === 'low'): ?>
                                    <span class="badge bg-info text-dark fs-7 px-2 py-1">
                                        <i class="bi bi-check-circle-fill me-1"></i> LOW RISK
                                    </span>
                                <?php else: ?>
                                    <span class="badge bg-light text-muted border">Belum AI</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if ($v['psikolog_name']): ?>
                                    <span class="badge bg-primary bg-opacity-10 text-primary border border-primary">
                                        <i class="bi bi-person-check-fill me-1"></i> <?= esc($v['psikolog_name']) ?>
                                    </span>
                                <?php else: ?>
                                    <span class="badge bg-light text-muted border">Belum Ditugaskan</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-end">
                                <a href="<?= site_url('/victim/detail/' . $v['id']) ?>"
                                    class="btn btn-sm btn-outline-danger px-2 py-1" title="Buka Detail Penyintas">
                                    Detail <i class="bi bi-arrow-right"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>