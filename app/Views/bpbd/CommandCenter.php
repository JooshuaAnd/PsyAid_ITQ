<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<!-- Header -->
<div class="row mb-4 align-items-center">
    <div class="col">
        <h3 class="fw-bold text-dark mb-1">
            <i class="bi bi-shield-shaded text-danger me-2"></i> Command Center BPBD
        </h3>
        <p class="text-muted small mb-0">Pemantauan Real-Time Kesehatan Mental & Respon Kebencanaan</p>
    </div>
    <div class="col-auto">
        <span class="badge bg-dark px-3 py-2 text-uppercase fs-7 fw-semibold">
            <i class="bi bi-clock-history me-1"></i> Data Terintegrasi Real-Time
        </span>
    </div>
</div>

<!-- Langkah 1: Cascading Select Filter Bar -->
<div class="card card-custom bg-white p-3 mb-4 shadow-sm">
    <div class="d-flex align-items-center justify-content-between mb-3 border-bottom pb-2">
        <h6 class="fw-bold text-secondary mb-0">
            <i class="bi bi-funnel-fill text-primary me-1"></i> Filter Wilayah & Posko Kebencanaan
        </h6>
        <button type="button" id="btn-reset-filter" class="btn btn-sm btn-outline-secondary">
            <i class="bi bi-arrow-counterclockwise me-1"></i> Reset Filter
        </button>
    </div>

    <form id="filter-form" class="row g-3">
        <!-- 1. Dropdown Provinsi -->
        <div class="col-12 col-sm-6 col-md-3">
            <label for="filter-provinsi" class="form-label small fw-semibold text-muted">1. Provinsi</label>
            <select class="form-select form-select-sm" id="filter-provinsi" name="province_id">
                <option value="">-- Semua Provinsi --</option>
                <?php foreach ($provinces as $prov): ?>
                    <option value="<?= esc($prov['id']) ?>"><?= esc($prov['name']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- 2. Dropdown Kabupaten (Populated via AJAX) -->
        <div class="col-12 col-sm-6 col-md-3">
            <label for="filter-kabupaten" class="form-label small fw-semibold text-muted">2. Kabupaten / Kota</label>
            <select class="form-select form-select-sm" id="filter-kabupaten" name="regency_id" disabled>
                <option value="">-- Pilih Provinsi Dahulu --</option>
            </select>
        </div>

        <!-- 3. Dropdown Jenis Bencana -->
        <div class="col-12 col-sm-6 col-md-3">
            <label for="filter-bencana" class="form-label small fw-semibold text-muted">3. Jenis Bencana</label>
            <select class="form-select form-select-sm" id="filter-bencana" name="jenis_bencana">
                <option value="">-- Semua Bencana --</option>
                <?php foreach ($jenisBencana as $jb): ?>
                    <option value="<?= esc($jb) ?>"><?= esc($jb) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- 4. Dropdown Status Posko -->
        <div class="col-12 col-sm-6 col-md-3">
            <label for="filter-status" class="form-label small fw-semibold text-muted">4. Status Posko</label>
            <select class="form-select form-select-sm" id="filter-status" name="status">
                <option value="">-- Semua Status --</option>
                <option value="aktif">Aktif</option>
                <option value="recovery">Recovery</option>
                <option value="closed">Closed</option>
            </select>
        </div>
    </form>
</div>

<!-- Langkah 2: Ringkasan Kartu (Summary Cards Grid) -->
<div class="row g-3 mb-4">
    <!-- Card 1: Total Korban -->
    <div class="col-12 col-sm-6 col-lg-3">
        <div class="card card-custom bg-white p-3 border-start border-4 border-dark h-100">
            <div class="text-muted small fw-semibold text-uppercase">Total Korban Bencana</div>
            <div class="d-flex align-items-baseline justify-content-between mt-2">
                <div class="display-6 fw-bold text-dark" id="stat-total-korban"><?= esc($stats['total_korban']) ?></div>
                <div class="text-muted fs-4"><i class="bi bi-people-fill"></i></div>
            </div>
            <div class="small text-muted mt-2">Terdata di lokasi posko terpilih</div>
        </div>
    </div>

    <!-- Card 2: Status Skrining -->
    <div class="col-12 col-sm-6 col-lg-3">
        <div class="card card-custom bg-white p-3 border-start border-4 border-success h-100">
            <div class="text-muted small fw-semibold text-uppercase">Status Skrining Relawan</div>
            <div class="mt-2">
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <span class="small fw-semibold text-success"><i class="bi bi-check-circle-fill me-1"></i> Sudah Skrining</span>
                    <span class="fw-bold" id="stat-sudah-screening"><?= esc($stats['sudah_screening']) ?></span>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <span class="small text-muted"><i class="bi bi-clock-history me-1"></i> Belum Skrining</span>
                    <span class="fw-bold text-secondary" id="stat-belum-screening"><?= esc($stats['belum_screening']) ?></span>
                </div>
            </div>
            <div class="progress mt-3" style="height: 6px;">
                <div id="prog-screening" class="progress-bar bg-success" role="progressbar" 
                     style="width: <?= $stats['total_korban'] > 0 ? round(($stats['sudah_screening'] / $stats['total_korban']) * 100) : 0 ?>%">
                </div>
            </div>
        </div>
    </div>

    <!-- Card 3: AI Risk Level Breakdown -->
    <div class="col-12 col-sm-6 col-lg-3">
        <div class="card card-custom bg-white p-3 border-start border-4 border-warning h-100">
            <div class="text-muted small fw-semibold text-uppercase">Tingkat Risiko (AI Assessment)</div>
            <div class="d-flex justify-content-between align-items-center mt-2 gap-1 text-center">
                <div class="bg-danger bg-opacity-10 rounded p-2 flex-fill">
                    <div class="fw-bold text-danger fs-5" id="stat-risk-high"><?= esc($stats['risk_high']) ?></div>
                    <div class="fs-8 text-danger fw-semibold">HIGH</div>
                </div>
                <div class="bg-warning bg-opacity-10 rounded p-2 flex-fill">
                    <div class="fw-bold text-dark fs-5" id="stat-risk-medium"><?= esc($stats['risk_medium']) ?></div>
                    <div class="fs-8 text-dark fw-semibold">MEDIUM</div>
                </div>
                <div class="bg-info bg-opacity-10 rounded p-2 flex-fill">
                    <div class="fw-bold text-info fs-5" id="stat-risk-low"><?= esc($stats['risk_low']) ?></div>
                    <div class="fs-8 text-info fw-semibold">LOW</div>
                </div>
            </div>
            <div class="small text-muted mt-2">Dianalisis secara otomatis dari skrining</div>
        </div>
    </div>

    <!-- Card 4: Personel Aktif (Psikolog & Relawan) -->
    <div class="col-12 col-sm-6 col-lg-3">
        <div class="card card-custom bg-white p-3 border-start border-4 border-primary h-100">
            <div class="text-muted small fw-semibold text-uppercase">Personel Aktif Lapangan</div>
            <div class="mt-2">
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <span class="small fw-semibold text-primary"><i class="bi bi-heart-pulse-fill me-1"></i> Psikolog Aktif</span>
                    <span class="fw-bold text-dark" id="stat-jumlah-psikolog"><?= esc($stats['jumlah_psikolog']) ?> Orang</span>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <span class="small text-muted"><i class="bi bi-person-badge me-1"></i> Relawan Aktif</span>
                    <span class="fw-bold text-dark" id="stat-jumlah-relawan"><?= esc($stats['jumlah_relawan']) ?> Orang</span>
                </div>
            </div>
            <div class="small text-muted mt-3">Ditugaskan pada posko lokasi ini</div>
        </div>
    </div>
</div>

<!-- SEGMEN 3: Grid Kartu Posko (per Kabupaten & Risk Breakdown) -->
<div class="mb-4">
    <div class="d-flex align-items-center justify-content-between mb-3">
        <h5 class="fw-bold text-dark mb-0">
            <i class="bi bi-grid-3x3-gap-fill text-danger me-2"></i> Grid Kartu Posko & Breakdown Risiko AI
        </h5>
        <span class="badge bg-light text-dark border px-3 py-2" id="posko-card-count-badge">
            <?= count($poskoList) ?> Posko Tampil
        </span>
    </div>

    <div class="row g-3" id="posko-cards-container">
        <?php if (empty($poskoList)): ?>
            <div class="col-12">
                <div class="card card-custom p-4 text-center text-muted bg-white">
                    <i class="bi bi-inbox fs-2 d-block mb-2 text-secondary"></i>
                    Tidak ada data posko yang sesuai dengan filter yang dipilih.
                </div>
            </div>
        <?php else: ?>
            <?php foreach ($poskoList as $posko): ?>
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card card-custom bg-white h-100 shadow-sm position-relative <?= $posko['is_highest_priority'] ? 'border-danger border-2' : '' ?>">
                        <?php if ($posko['is_highest_priority']): ?>
                            <div class="card-header bg-danger text-white py-1 px-3 fs-7 fw-bold d-flex align-items-center justify-content-between">
                                <span><i class="bi bi-exclamation-triangle-fill me-1"></i> Prioritas Operasional</span>
                                <span class="badge bg-white text-danger">Kasus High Terbanyak</span>
                            </div>
                        <?php endif; ?>

                        <div class="card-body p-3 d-flex flex-column justify-content-between">
                            <div>
                                <div class="d-flex align-items-start justify-content-between mb-2">
                                    <h6 class="fw-bold text-dark mb-0 pe-2">
                                        <a href="<?= site_url('/posko/' . $posko['id']) ?>" class="text-decoration-none text-dark hover-danger">
                                            <?= esc($posko['posko_name']) ?>
                                        </a>
                                    </h6>
                                    <?php if ($posko['status'] === 'aktif'): ?>
                                        <span class="badge bg-success">Aktif</span>
                                    <?php elseif ($posko['status'] === 'recovery'): ?>
                                        <span class="badge bg-warning text-dark">Recovery</span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary">Closed</span>
                                    <?php endif; ?>
                                </div>

                                <div class="small text-muted mb-3">
                                    <i class="bi bi-geo-alt me-1"></i> <?= esc($posko['regency_name']) ?>, <?= esc($posko['province_name']) ?>
                                    <span class="ms-2 badge bg-light text-secondary border"><?= esc($posko['jenis_bencana']) ?></span>
                                </div>

                                <!-- AI Risk Breakdown Grid -->
                                <div class="bg-light p-2 rounded mb-3 border">
                                    <div class="small text-muted fw-semibold mb-2">Breakdown Kasus AI Risk Level:</div>
                                    <div class="d-flex justify-content-between text-center gap-1">
                                        <div class="bg-white border rounded p-1 flex-fill">
                                            <div class="fw-bold text-danger fs-6"><?= $posko['high_risk_count'] ?></div>
                                            <div class="fs-8 text-muted">High</div>
                                        </div>
                                        <div class="bg-white border rounded p-1 flex-fill">
                                            <div class="fw-bold text-warning fs-6"><?= $posko['medium_risk_count'] ?></div>
                                            <div class="fs-8 text-muted">Medium</div>
                                        </div>
                                        <div class="bg-white border rounded p-1 flex-fill">
                                            <div class="fw-bold text-info fs-6"><?= $posko['low_risk_count'] ?></div>
                                            <div class="fs-8 text-muted">Low</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex align-items-center justify-content-between border-top pt-2 mt-2">
                                <div class="small text-muted">
                                    Total: <strong><?= $posko['total_korban'] ?></strong> Penyintas
                                </div>
                                <a href="<?= site_url('/posko/' . $posko['id']) ?>" class="btn btn-sm btn-outline-danger px-3 py-1">
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

<!-- JavaScript for Cascading Filter & Real-Time Data Fetching -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const provSelect = document.getElementById('filter-provinsi');
    const kabSelect  = document.getElementById('filter-kabupaten');
    const bencSelect = document.getElementById('filter-bencana');
    const statSelect = document.getElementById('filter-status');
    const resetBtn   = document.getElementById('btn-reset-filter');

    // 1. Cascading Select: Fetch Regencies on Province Change
    provSelect.addEventListener('change', function() {
        const provinceId = this.value;
        kabSelect.innerHTML = '<option value="">-- Memuat Kabupaten... --</option>';
        kabSelect.disabled = true;

        if (!provinceId) {
            kabSelect.innerHTML = '<option value="">-- Pilih Provinsi Dahulu --</option>';
            fetchStats();
            return;
        }

        fetch('<?= site_url('/command-center/get-regencies/') ?>' + provinceId)
            .then(res => res.json())
            .then(res => {
                if (res.status === 'success') {
                    kabSelect.innerHTML = '<option value="">-- Semua Kabupaten --</option>';
                    res.data.forEach(reg => {
                        const opt = document.createElement('option');
                        opt.value = reg.id;
                        opt.textContent = reg.name;
                        kabSelect.appendChild(opt);
                    });
                    kabSelect.disabled = false;
                } else {
                    kabSelect.innerHTML = '<option value="">-- Gagal Memuat --</option>';
                }
                fetchStats();
            })
            .catch(err => {
                console.error('Error fetching regencies:', err);
                kabSelect.innerHTML = '<option value="">-- Error Memuat --</option>';
            });
    });

    // 2. Trigger fetchStats on any filter change
    kabSelect.addEventListener('change', fetchStats);
    bencSelect.addEventListener('change', fetchStats);
    statSelect.addEventListener('change', fetchStats);

    // 3. Reset Filter
    resetBtn.addEventListener('click', function() {
        provSelect.value = '';
        kabSelect.innerHTML = '<option value="">-- Pilih Provinsi Dahulu --</option>';
        kabSelect.disabled = true;
        bencSelect.value = '';
        statSelect.value = '';
        fetchStats();
    });

    // 4. Fetch Real-time Dashboard Statistics & Posko Cards Grid
    function fetchStats() {
        const params = new URLSearchParams({
            province_id:   provSelect.value,
            regency_id:    kabSelect.value,
            jenis_bencana: bencSelect.value,
            status:        statSelect.value
        });

        fetch('<?= site_url('/command-center/get-stats?') ?>' + params.toString())
            .then(res => res.json())
            .then(res => {
                if (res.status === 'success') {
                    updateCards(res.data);
                    updatePoskoCardsGrid(res.poskoList);
                }
            })
            .catch(err => console.error('Error fetching stats:', err));
    }

    function updateCards(d) {
        document.getElementById('stat-total-korban').textContent   = d.total_korban;
        document.getElementById('stat-sudah-screening').textContent = d.sudah_screening;
        document.getElementById('stat-belum-screening').textContent = d.belum_screening;
        document.getElementById('stat-risk-high').textContent       = d.risk_high;
        document.getElementById('stat-risk-medium').textContent     = d.risk_medium;
        document.getElementById('stat-risk-low').textContent        = d.risk_low;
        document.getElementById('stat-jumlah-psikolog').textContent = d.jumlah_psikolog + ' Orang';
        document.getElementById('stat-jumlah-relawan').textContent  = d.jumlah_relawan + ' Orang';

        // Update progress bar
        const pct = d.total_korban > 0 ? Math.round((d.sudah_screening / d.total_korban) * 100) : 0;
        document.getElementById('prog-screening').style.width = pct + '%';
    }

    function updatePoskoCardsGrid(list) {
        const container = document.getElementById('posko-cards-container');
        const badge     = document.getElementById('posko-card-count-badge');
        badge.textContent = list.length + ' Posko Tampil';

        if (list.length === 0) {
            container.innerHTML = `
                <div class="col-12">
                    <div class="card card-custom p-4 text-center text-muted bg-white">
                        <i class="bi bi-inbox fs-2 d-block mb-2 text-secondary"></i>
                        Tidak ada data posko yang sesuai dengan filter yang dipilih.
                    </div>
                </div>`;
            return;
        }

        let html = '';
        list.forEach(p => {
            let statusBadge = '<span class="badge bg-secondary">Closed</span>';
            if (p.status === 'aktif') {
                statusBadge = '<span class="badge bg-success">Aktif</span>';
            } else if (p.status === 'recovery') {
                statusBadge = '<span class="badge bg-warning text-dark">Recovery</span>';
            }

            const priorityHeader = p.is_highest_priority ? `
                <div class="card-header bg-danger text-white py-1 px-3 fs-7 fw-bold d-flex align-items-center justify-content-between">
                    <span><i class="bi bi-exclamation-triangle-fill me-1"></i> Prioritas Operasional</span>
                    <span class="badge bg-white text-danger">Kasus High Terbanyak</span>
                </div>` : '';

            const borderClass = p.is_highest_priority ? 'border-danger border-2' : '';

            html += `
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card card-custom bg-white h-100 shadow-sm position-relative ${borderClass}">
                        ${priorityHeader}
                        <div class="card-body p-3 d-flex flex-column justify-content-between">
                            <div>
                                <div class="d-flex align-items-start justify-content-between mb-2">
                                    <h6 class="fw-bold text-dark mb-0 pe-2">
                                        <a href="<?= site_url('/posko/') ?>${p.id}" class="text-decoration-none text-dark">
                                            ${escapeHtml(p.posko_name)}
                                        </a>
                                    </h6>
                                    ${statusBadge}
                                </div>

                                <div class="small text-muted mb-3">
                                    <i class="bi bi-geo-alt me-1"></i> ${escapeHtml(p.regency_name)}, ${escapeHtml(p.province_name)}
                                    <span class="ms-2 badge bg-light text-secondary border">${escapeHtml(p.jenis_bencana)}</span>
                                </div>

                                <div class="bg-light p-2 rounded mb-3 border">
                                    <div class="small text-muted fw-semibold mb-2">Breakdown Kasus AI Risk Level:</div>
                                    <div class="d-flex justify-content-between text-center gap-1">
                                        <div class="bg-white border rounded p-1 flex-fill">
                                            <div class="fw-bold text-danger fs-6">${p.high_risk_count}</div>
                                            <div class="fs-8 text-muted">High</div>
                                        </div>
                                        <div class="bg-white border rounded p-1 flex-fill">
                                            <div class="fw-bold text-warning fs-6">${p.medium_risk_count}</div>
                                            <div class="fs-8 text-muted">Medium</div>
                                        </div>
                                        <div class="bg-white border rounded p-1 flex-fill">
                                            <div class="fw-bold text-info fs-6">${p.low_risk_count}</div>
                                            <div class="fs-8 text-muted">Low</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex align-items-center justify-content-between border-top pt-2 mt-2">
                                <div class="small text-muted">
                                    Total: <strong>${p.total_korban}</strong> Penyintas
                                </div>
                                <a href="<?= site_url('/posko/') ?>${p.id}" class="btn btn-sm btn-outline-danger px-3 py-1">
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
        return str.replace(/[&<>"']/g, function(m) {
            return { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#039;' }[m];
        });
    }
});
</script>
<?= $this->endSection() ?>
