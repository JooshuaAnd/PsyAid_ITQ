<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<style>
    .frost-hero,
    .frost-btn-reset,
    .btn,
    .badge,
    .form-control,
    .form-select,
    .card-followup {
        border-radius: 8px !important;
    }

    .frost-hero {
        background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 60%, #a7f3d0 100%);
        border: 1.5px solid #a7f3d0;
        color: #064e3b;
        box-shadow: 0 10px 30px -4px rgba(16, 185, 129, 0.12), inset 0 1.5px 2px rgba(255, 255, 255, 0.85);
        overflow: hidden;
    }

    .frost-hero .hero-action-row {
        gap: 0.75rem;
        margin-top: 1.15rem;
        padding-top: 1rem;
        border-top: 1px solid rgba(6, 95, 70, 0.14);
    }

    .frost-hero .hero-action-btn {
        min-height: 38px;
        padding: 0.48rem 0.95rem !important;
        font-size: 0.8125rem !important;
        line-height: 1.2;
        justify-content: center;
    }

    .frost-hero .hero-badge {
        display: inline-flex;
        align-items: center;
        max-width: 100%;
        white-space: normal;
        text-align: left;
        line-height: 1.35;
    }

    .frost-btn-reset {
        background: #ffffff !important;
        color: #475569 !important;
        border: 1.5px solid #cbd5e1 !important;
        font-weight: 600 !important;
        font-size: 0.8125rem !important;
        padding: 0.45rem 0.85rem !important;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        transition: all 0.2s ease;
    }

    .frost-btn-reset:hover {
        background-color: #f8fafc !important;
        color: #0f172a !important;
        border-color: #94a3b8 !important;
    }

    .btn-frost,
    .card-followup .btn-success,
    .card-followup .btn-outline-primary,
    .card-followup .btn-link {
        background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%) !important;
        color: #065f46 !important;
        border: 1.5px solid #34d399 !important;
        font-weight: 700 !important;
        font-size: 0.75rem !important;
        padding: 0.4rem 0.75rem !important;
        text-decoration: none !important;
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        box-shadow: 0 2px 6px rgba(16, 185, 129, 0.15);
        transition: all 0.2s ease;
    }

    .btn-frost:hover,
    .card-followup .btn-success:hover,
    .card-followup .btn-outline-primary:hover,
    .card-followup .btn-link:hover {
        background: linear-gradient(135deg, #a7f3d0 0%, #6ee7b7 100%) !important;
        color: #064e3b !important;
        border-color: #10b981 !important;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.25);
        transform: translateY(-1px);
    }

    .card-followup {
        position: relative;
        border: 1.5px solid #d1fae5;
        background: #ffffff;
        margin-bottom: 1.35rem;
        padding: 1.5rem;
        box-shadow: 0 4px 12px -2px rgba(16, 185, 129, 0.08), 0 2px 5px -1px rgba(15, 23, 42, 0.04);
        overflow: visible;
        transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .card-followup:hover {
        background: #ffffff;
        border-color: #34d399;
        box-shadow: 0 12px 28px -4px rgba(16, 185, 129, 0.18), 0 4px 10px -2px rgba(15, 23, 42, 0.04);
        transform: translateY(-2px);
    }

    .card-followup:hover .timeline-dot {
        transform: translateY(2px);
    }

    .card-followup-header {
        background: transparent !important;
        border-bottom: 1.5px solid #e2e8f0;
        padding: 0 0 1rem 0;
        margin-bottom: 1rem;
        color: #065f46 !important;
        font-weight: 800;
        letter-spacing: 0.01em;
        border-radius: 0 !important;
        gap: 0.75rem;
        flex-wrap: wrap;
    }

    .card-followup-header > span:first-child {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        line-height: 1.35;
        font-size: 1rem;
    }

    .card-followup-header i {
        color: #059669;
    }

    .timeline-container {
        position: relative;
        padding-left: 38px;
        margin-left: 0;
    }

    .timeline-container::before {
        content: "";
        position: absolute;
        left: 10px;
        top: 8px;
        bottom: 8px;
        width: 2px;
        background: #a7f3d0;
        border-radius: 999px;
    }

    .timeline-dot {
        position: absolute;
        left: -38px;
        top: 18px;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        background-color: #059669 !important;
        border: 4px solid #ffffff;
        box-shadow: 0 0 0 2px #a7f3d0 !important;
        z-index: 2;
    }

    .card-followup .badge {
        border: 1px solid transparent !important;
        font-weight: 700 !important;
        font-size: 0.75rem !important;
        padding: 0.4rem 0.65rem !important;
        box-shadow: 0 1px 2px rgba(15, 23, 42, 0.04);
        white-space: normal;
    }

    .card-followup .badge.bg-light,
    .card-followup .badge.bg-success,
    .card-followup .badge.text-success {
        background-color: #ecfdf5 !important;
        color: #047857 !important;
        border-color: #a7f3d0 !important;
    }

    .card-followup .badge.bg-danger {
        background-color: #fef2f2 !important;
        color: #dc2626 !important;
        border-color: #fecdd3 !important;
    }

    .card-followup .badge.bg-warning {
        background-color: #fffbeb !important;
        color: #b45309 !important;
        border-color: #fde68a !important;
    }

    .card-followup .badge.text-secondary {
        background-color: #f8fafc !important;
        color: #64748b !important;
        border-color: #e2e8f0 !important;
    }

    .card-followup h6,
    .card-followup .text-primary {
        color: #065f46 !important;
    }

    .card-followup h6 {
        padding-bottom: 0.55rem;
        margin-bottom: 0.8rem !important;
        border-bottom: 1px solid #e2e8f0;
        line-height: 1.35;
    }

    .card-followup .border-end {
        border-color: #e2e8f0 !important;
    }

    .card-followup > .p-3 {
        padding: 0 !important;
        background: transparent;
        border-radius: 0;
    }

    .card-followup ul {
        line-height: 1.65;
    }

    .card-followup strong {
        color: #334155;
    }

    .mse-list {
        background: rgba(255, 255, 255, 0.78);
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 0.75rem;
    }

    .mse-list dt {
        font-weight: 700;
        color: #64748b;
        padding-top: 0.45rem;
        border-top: 1px solid #e2e8f0;
    }

    .mse-list dd {
        margin-bottom: 0.5rem;
        color: #0f172a;
        padding-top: 0.45rem;
        border-top: 1px solid #e2e8f0;
    }

    .mse-list dt:first-of-type,
    .mse-list dd:first-of-type {
        border-top: 0;
        padding-top: 0;
    }

    .card-followup textarea,
    .card-followup .form-control,
    .card-followup .form-select {
        background: #ffffff;
        border: 1.5px solid #cbd5e1;
        color: #0f172a;
        font-size: 0.875rem;
        font-weight: 600;
        box-shadow: 0 1px 3px rgba(15, 23, 42, 0.04);
        transition: all 0.2s ease;
    }

    .card-followup textarea:hover,
    .card-followup .form-control:hover,
    .card-followup .form-select:hover {
        border-color: #059669;
        background-color: #f4fbf7;
    }

    .card-followup textarea:focus,
    .card-followup .form-control:focus,
    .card-followup .form-select:focus {
        border-color: #059669;
        box-shadow: 0 0 0 3.5px rgba(5, 150, 105, 0.18);
        background-color: #ffffff;
        outline: none;
    }

    .card-followup .row > [class*="col-"] {
        min-width: 0;
    }

    .card-followup .small,
    .card-followup small {
        line-height: 1.55;
    }

    .ai-edit-card {
        margin-top: 0.75rem;
        padding: 0.85rem;
        background: linear-gradient(135deg, #ffffff 0%, rgba(236, 253, 245, 0.55) 100%);
        border: 1.5px solid #d1fae5;
        border-radius: 8px;
        box-shadow: 0 2px 6px rgba(16, 185, 129, 0.06);
    }

    .ai-edit-card textarea {
        min-height: clamp(280px, 44vh, 520px);
        max-height: 68vh;
        margin-bottom: 0.85rem !important;
        resize: vertical;
        overflow-y: auto;
    }

    .ai-edit-card .btn-success {
        justify-content: center;
        padding-block: 0.55rem !important;
    }

    .journey-dashboard {
        margin-bottom: 1.35rem;
    }

    .journey-card {
        background: #ffffff;
        border: 1.5px solid #d1fae5;
        border-radius: 8px;
        box-shadow: 0 4px 12px -2px rgba(16, 185, 129, 0.08), 0 2px 5px -1px rgba(15, 23, 42, 0.04);
        padding: 1.25rem;
        height: 100%;
    }

    .journey-card-title {
        color: #064e3b;
        font-weight: 800;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding-bottom: 0.85rem;
        margin-bottom: 1rem;
        border-bottom: 1.5px solid #e2e8f0;
    }

    .journey-stepper {
        display: grid;
        grid-template-columns: repeat(6, minmax(0, 1fr));
        gap: 0.75rem;
    }

    .journey-step {
        position: relative;
        background: #f8fafc;
        border: 1.5px solid #e2e8f0;
        border-radius: 8px;
        padding: 0.95rem;
        min-height: 146px;
        display: flex;
        flex-direction: column;
    }

    .journey-step.is-complete {
        background: #ecfdf5;
        border-color: #a7f3d0;
    }

    .journey-step.is-active {
        background: #fffbeb;
        border-color: #fde68a;
    }

    .journey-step.is-final {
        background: #f0fdf4;
        border-color: #34d399;
    }

    .journey-step__icon {
        width: 34px;
        height: 34px;
        border-radius: 8px;
        background: #ffffff;
        color: #059669;
        border: 1.5px solid #a7f3d0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 0.65rem;
        box-shadow: 0 2px 6px rgba(16, 185, 129, 0.1);
    }

    .journey-step__body {
        border-top: 1.5px solid #e2e8f0;
        padding-top: 0.7rem;
        margin-top: 0.05rem;
        flex: 1;
    }

    .journey-step.is-active .journey-step__icon {
        color: #b45309;
        border-color: #fde68a;
    }

    .journey-step__label {
        color: #064e3b;
        font-size: 0.8125rem;
        font-weight: 800;
        line-height: 1.3;
        margin-bottom: 0.35rem;
    }

    .journey-step__meta {
        color: #64748b;
        font-size: 0.72rem;
        line-height: 1.45;
    }

    .journey-step__badge {
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
        margin-top: 0.75rem;
        border-radius: 8px;
        padding: 0.32rem 0.55rem;
        font-size: 0.68rem;
        font-weight: 800;
        border: 1px solid transparent;
        align-self: flex-start;
    }

    .journey-step__status {
        border-top: 1.5px solid #e2e8f0;
        margin-top: 0.75rem;
        padding-top: 0.75rem;
    }

    .journey-step__badge--complete {
        background: #ecfdf5;
        color: #047857;
        border-color: #a7f3d0;
    }

    .journey-step__badge--pending {
        background: #f8fafc;
        color: #64748b;
        border-color: #e2e8f0;
    }

    .journey-step__badge--active {
        background: #fffbeb;
        color: #b45309;
        border-color: #fde68a;
    }

    .trend-summary-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 0.75rem;
        margin-bottom: 1rem;
    }

    .trend-stat {
        background: #f8fafc;
        border: 1.5px solid #e2e8f0;
        border-radius: 8px;
        padding: 0.85rem;
    }

    .trend-stat__label {
        display: block;
        color: #64748b;
        font-size: 0.7rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.035em;
        margin-bottom: 0.6rem;
        padding-bottom: 0.55rem;
        border-bottom: 1.5px solid #e2e8f0;
    }

    .trend-stat__value {
        color: #064e3b;
        font-size: 1.25rem;
        font-weight: 800;
    }

    .trend-stat__value.is-danger {
        color: #dc2626;
    }

    .trend-stat__value.is-warning {
        color: #b45309;
    }

    .trend-stat__value.is-success {
        color: #047857;
    }

    .trend-chart-shell {
        background: linear-gradient(135deg, #ffffff 0%, rgba(236, 253, 245, 0.55) 100%);
        border: 1.5px solid #d1fae5;
        border-radius: 8px;
        padding: 1rem;
        overflow-x: auto;
        scrollbar-color: #a7f3d0 #ecfdf5;
        scrollbar-width: thin;
    }

    .trend-chart-shell::-webkit-scrollbar {
        height: 8px;
    }

    .trend-chart-shell::-webkit-scrollbar-track {
        background: #ecfdf5;
        border-radius: 999px;
    }

    .trend-chart-shell::-webkit-scrollbar-thumb {
        background: #a7f3d0;
        border-radius: 999px;
    }

    .trend-chart {
        min-width: 560px;
        width: 100%;
        height: auto;
        display: block;
    }

    .trend-legend {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 0.75rem;
        margin-top: 0.85rem;
        color: #64748b;
        font-size: 0.75rem;
        font-weight: 700;
    }

    .trend-legend__item {
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
    }

    .trend-legend__swatch {
        width: 18px;
        height: 3px;
        border-radius: 999px;
        display: inline-block;
    }

    .trend-scroll-hint {
        display: none;
        color: #64748b;
        font-size: 0.72rem;
        font-weight: 700;
        margin-bottom: 0.65rem;
    }

    .trend-empty {
        background: #f8fafc;
        border: 1.5px solid #e2e8f0;
        border-radius: 8px;
        color: #64748b;
        padding: 1.25rem;
        text-align: center;
    }

    @media (max-width: 767.98px) {
        .timeline-container {
            padding-left: 34px;
            margin-left: 0;
        }

        .timeline-dot {
            left: -34px;
        }

        .card-followup .border-end {
            border-right: 0 !important;
            border-bottom: 1px solid #e2e8f0 !important;
            padding-bottom: 0.9rem;
            margin-bottom: 0.9rem !important;
        }

        .card-followup {
            padding: 1rem;
        }

        .frost-hero .card-body {
            padding: 1.15rem !important;
        }

        .frost-hero .hero-action-row {
            width: 100%;
            align-items: stretch !important;
            flex-direction: column;
        }

        .frost-hero .hero-badge,
        .frost-hero .frost-btn-reset {
            width: 100%;
            justify-content: center;
        }

        .frost-hero h3 {
            font-size: 1.2rem;
            line-height: 1.35;
            overflow-wrap: anywhere;
        }

        .journey-card {
            padding: 1rem;
        }

        .journey-stepper,
        .trend-summary-grid {
            grid-template-columns: 1fr;
        }

        .journey-step {
            min-height: 0;
        }

        .trend-chart-shell {
            padding: 0.75rem;
            margin-inline: -0.15rem;
            border-color: #a7f3d0;
        }

        .trend-chart {
            min-width: 430px;
        }

        .trend-scroll-hint {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.35rem;
            background: #f8fafc;
            border: 1.5px solid #e2e8f0;
            border-radius: 8px;
            padding: 0.55rem 0.7rem;
        }

        .trend-legend {
            align-items: stretch;
            flex-direction: column;
            gap: 0.55rem;
            font-size: 0.72rem;
        }

        .trend-legend__item {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 0.5rem 0.6rem;
        }

        .trend-stat {
            padding: 0.75rem;
        }

        .trend-stat__value {
            font-size: 1.1rem;
        }
    }
</style>

<?php
$phaseDefinitions = [
    [
        'key' => 'relawan',
        'label' => 'Triase Relawan',
        'meta' => 'Skrining awal & observasi lapangan',
        'icon' => 'bi-person-badge',
        'done' => !empty($volunteerScreening),
    ],
    [
        'key' => 'baseline',
        'label' => 'Baseline',
        'meta' => 'ITQ awal + review MSE hari 0',
        'icon' => 'bi-journal-medical',
        'done' => isset($itqByFase[0]) && isset($reviewByFase[0]),
    ],
    [
        'key' => 'fu1',
        'label' => 'Follow-Up 1',
        'meta' => 'Evaluasi hari ke-7',
        'icon' => 'bi-calendar2-check',
        'done' => isset($itqByFase[1]) && isset($reviewByFase[1]),
    ],
    [
        'key' => 'fu2',
        'label' => 'Follow-Up 2',
        'meta' => 'Evaluasi hari ke-14',
        'icon' => 'bi-calendar2-check',
        'done' => isset($itqByFase[2]) && isset($reviewByFase[2]),
    ],
    [
        'key' => 'fu3',
        'label' => 'Follow-Up 3',
        'meta' => 'Evaluasi hari ke-30',
        'icon' => 'bi-calendar2-check',
        'done' => isset($itqByFase[3]) && isset($reviewByFase[3]),
    ],
    [
        'key' => 'final',
        'label' => 'Keputusan Akhir',
        'meta' => 'Status akhir / rujukan klinis',
        'icon' => 'bi-flag-fill',
        'done' => !empty($finalDecision),
    ],
];

$activePhaseIndex = null;
foreach ($phaseDefinitions as $idx => $phase) {
    if (!$phase['done']) {
        $activePhaseIndex = $idx;
        break;
    }
}

$phaseLabels = [
    0 => 'Baseline',
    1 => 'FU 1',
    2 => 'FU 2',
    3 => 'FU 3',
];

$itqTrend = [];
foreach ($phaseLabels as $fase => $label) {
    if (isset($itqByFase[$fase])) {
        $itqTrend[] = [
            'fase' => $fase,
            'label' => $label,
            'ptsd' => (int) ($itqByFase[$fase]['ptsd_score'] ?? 0),
            'dso' => (int) ($itqByFase[$fase]['dso_score'] ?? 0),
            'diagnosis' => $itqByFase[$fase]['final_diagnosis'] ?? '-',
        ];
    }
}

$trendCount = count($itqTrend);
$latestTrend = $trendCount > 0 ? $itqTrend[$trendCount - 1] : null;
$firstTrend = $trendCount > 0 ? $itqTrend[0] : null;
$latestTotal = $latestTrend ? $latestTrend['ptsd'] + $latestTrend['dso'] : 0;
$firstTotal = $firstTrend ? $firstTrend['ptsd'] + $firstTrend['dso'] : 0;
$deltaTotal = $trendCount > 1 ? $latestTotal - $firstTotal : 0;
$trendLabel = 'Belum Cukup Data';
$trendValueClass = 'is-warning';
$latestTotalClass = 'is-warning';

if ($trendCount > 1) {
    if ($deltaTotal <= -3) {
        $trendLabel = 'Membaik';
        $trendValueClass = 'is-success';
        $latestTotalClass = 'is-success';
    } elseif ($deltaTotal >= 3) {
        $trendLabel = 'Memburuk';
        $trendValueClass = 'is-danger';
        $latestTotalClass = 'is-danger';
    } else {
        $trendLabel = 'Stabil';
        $trendValueClass = 'is-warning';
        $latestTotalClass = 'is-warning';
    }
} elseif ($trendCount === 1) {
    $trendLabel = 'Baseline';
    $trendValueClass = 'is-success';
    $latestTotalClass = 'is-success';
}

$svgWidth = 900;
$svgHeight = 280;
$chartLeft = 54;
$chartRight = 28;
$chartTop = 24;
$chartBottom = 48;
$plotWidth = $svgWidth - $chartLeft - $chartRight;
$plotHeight = $svgHeight - $chartTop - $chartBottom;
$allScores = [];
foreach ($itqTrend as $point) {
    $allScores[] = $point['ptsd'];
    $allScores[] = $point['dso'];
}
$maxScore = max(24, !empty($allScores) ? max($allScores) : 24);
$maxScore = (int) (ceil($maxScore / 4) * 4);
$scoreToY = static fn($score) => $chartTop + (($maxScore - (int) $score) / max(1, $maxScore)) * $plotHeight;
$indexToX = static fn($idx, $count) => $count <= 1
    ? $chartLeft + ($plotWidth / 2)
    : $chartLeft + ($idx * ($plotWidth / ($count - 1)));

$ptsdPoints = [];
$dsoPoints = [];
foreach ($itqTrend as $idx => $point) {
    $x = $indexToX($idx, $trendCount);
    $ptsdPoints[] = round($x, 2) . ',' . round($scoreToY($point['ptsd']), 2);
    $dsoPoints[] = round($x, 2) . ',' . round($scoreToY($point['dso']), 2);
}
$yTicks = array_values(array_unique([0, (int) round($maxScore / 2), $maxScore]));
sort($yTicks);
?>

<div class="container-fluid px-0">
    <div class="card frost-hero mb-4">
        <div class="card-body p-4 position-relative">
            <div class="d-flex align-items-center gap-2 flex-wrap mb-2">
                <span class="badge hero-badge px-3 py-1.5 fs-8 fw-bold" style="background-color: rgba(6, 95, 70, 0.12); color: #065f46; border: 1px solid rgba(6, 95, 70, 0.25);">
                    <i class="bi bi-heart-pulse-fill me-1"></i> REKAM MEDIS & MONITORING (PATIENT JOURNEY)
                </span>
            </div>
            <h3 class="fw-bold mb-1" style="color: #064e3b;"><?= esc($victim['nama']) ?> (<?= esc($victim['nik']) ?>)</h3>
            <p class="small mb-0" style="color: #047857;">
                Gender: <?= esc($victim['jenis_kelamin'] === 'L' ? 'Laki-Laki' : 'Perempuan') ?> | Umur: <?= esc($victim['umur']) ?> Thn
            </p>
            <div class="hero-action-row d-flex justify-content-end align-items-center gap-2 flex-wrap">
                <a href="<?= site_url('/psikolog/monitoring') ?>" class="frost-btn-reset hero-action-btn">
                    <i class="bi bi-arrow-left me-1"></i> Kembali
                </a>
            </div>
        </div>
    </div>

    <div class="row g-3 journey-dashboard">
        <div class="col-12">
            <div class="journey-card">
                <div class="journey-card-title">
                    <i class="bi bi-signpost-split-fill text-success"></i>
                    Patient Journey Timeline
                </div>
                <div class="journey-stepper">
                    <?php foreach ($phaseDefinitions as $idx => $phase): ?>
                        <?php
                        $isActivePhase = $activePhaseIndex === $idx;
                        $stepClass = $phase['done'] ? 'is-complete' : ($isActivePhase ? 'is-active' : '');
                        if ($phase['key'] === 'final' && $phase['done']) {
                            $stepClass .= ' is-final';
                        }
                        $badgeClass = $phase['done'] ? 'journey-step__badge--complete' : ($isActivePhase ? 'journey-step__badge--active' : 'journey-step__badge--pending');
                        $badgeIcon = $phase['done'] ? 'bi-check-circle-fill' : ($isActivePhase ? 'bi-hourglass-split' : 'bi-clock-history');
                        $badgeText = $phase['done'] ? 'Selesai' : ($isActivePhase ? 'Dalam Proses' : 'Pending');
                        ?>
                        <div class="journey-step <?= esc(trim($stepClass)) ?>">
                            <div class="journey-step__icon">
                                <i class="bi <?= esc($phase['icon']) ?>"></i>
                            </div>
                            <div class="journey-step__body">
                                <div class="journey-step__label"><?= esc($phase['label']) ?></div>
                                <div class="journey-step__meta"><?= esc($phase['meta']) ?></div>
                            </div>
                            <div class="journey-step__status">
                                <span class="journey-step__badge <?= esc($badgeClass) ?>">
                                    <i class="bi <?= esc($badgeIcon) ?>"></i> <?= esc($badgeText) ?>
                                </span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="journey-card">
                <div class="journey-card-title">
                    <i class="bi bi-graph-up-arrow text-success"></i>
                    Trend Skor ITQ Longitudinal
                </div>

                <div class="trend-summary-grid">
                    <div class="trend-stat">
                        <span class="trend-stat__label">Data ITQ Tersedia</span>
                        <div class="trend-stat__value"><?= esc($trendCount) ?>/4 Fase</div>
                    </div>
                    <div class="trend-stat">
                        <span class="trend-stat__label">Total Skor Terakhir</span>
                        <div class="trend-stat__value <?= esc($latestTrend ? $latestTotalClass : 'is-warning') ?>">
                            <?= esc($latestTrend ? $latestTotal : '-') ?>
                        </div>
                    </div>
                    <div class="trend-stat">
                        <span class="trend-stat__label">Arah Perubahan</span>
                        <div class="trend-stat__value <?= esc($trendValueClass) ?>">
                            <?= esc($trendLabel) ?>
                            <?php if ($trendCount > 1): ?>
                                <span class="fs-8">(<?= $deltaTotal > 0 ? '+' : '' ?><?= esc($deltaTotal) ?>)</span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <?php if ($trendCount === 0): ?>
                    <div class="trend-empty">
                        <i class="bi bi-clipboard2-x fs-3 d-block mb-2 text-success"></i>
                        Belum ada skor ITQ yang dapat ditampilkan sebagai trend longitudinal.
                    </div>
                <?php else: ?>
                    <div class="trend-chart-shell">
                        <div class="trend-scroll-hint">
                            <i class="bi bi-arrows"></i> Geser grafik untuk melihat seluruh fase ITQ
                        </div>
                        <svg class="trend-chart" viewBox="0 0 <?= esc($svgWidth) ?> <?= esc($svgHeight) ?>" role="img" aria-label="Trend skor ITQ PTSD dan DSO">
                            <rect x="0" y="0" width="<?= esc($svgWidth) ?>" height="<?= esc($svgHeight) ?>" rx="8" fill="transparent"></rect>

                            <?php foreach ($yTicks as $tick): ?>
                                <?php $y = round($scoreToY($tick), 2); ?>
                                <line x1="<?= esc($chartLeft) ?>" y1="<?= esc($y) ?>" x2="<?= esc($svgWidth - $chartRight) ?>" y2="<?= esc($y) ?>" stroke="#e2e8f0" stroke-width="1"></line>
                                <text x="<?= esc($chartLeft - 12) ?>" y="<?= esc($y + 4) ?>" text-anchor="end" fill="#64748b" font-size="12" font-weight="700"><?= esc($tick) ?></text>
                            <?php endforeach; ?>

                            <line x1="<?= esc($chartLeft) ?>" y1="<?= esc($chartTop) ?>" x2="<?= esc($chartLeft) ?>" y2="<?= esc($svgHeight - $chartBottom) ?>" stroke="#cbd5e1" stroke-width="1.5"></line>
                            <line x1="<?= esc($chartLeft) ?>" y1="<?= esc($svgHeight - $chartBottom) ?>" x2="<?= esc($svgWidth - $chartRight) ?>" y2="<?= esc($svgHeight - $chartBottom) ?>" stroke="#cbd5e1" stroke-width="1.5"></line>

                            <?php if ($trendCount > 1): ?>
                                <polyline points="<?= esc(implode(' ', $ptsdPoints)) ?>" fill="none" stroke="#dc2626" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"></polyline>
                                <polyline points="<?= esc(implode(' ', $dsoPoints)) ?>" fill="none" stroke="#059669" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"></polyline>
                            <?php endif; ?>

                            <?php foreach ($itqTrend as $idx => $point): ?>
                                <?php
                                $x = round($indexToX($idx, $trendCount), 2);
                                $ptsdY = round($scoreToY($point['ptsd']), 2);
                                $dsoY = round($scoreToY($point['dso']), 2);
                                ?>
                                <line x1="<?= esc($x) ?>" y1="<?= esc($chartTop) ?>" x2="<?= esc($x) ?>" y2="<?= esc($svgHeight - $chartBottom) ?>" stroke="#f1f5f9" stroke-width="1"></line>
                                <circle cx="<?= esc($x) ?>" cy="<?= esc($ptsdY) ?>" r="7" fill="#dc2626" stroke="#ffffff" stroke-width="3"></circle>
                                <circle cx="<?= esc($x) ?>" cy="<?= esc($dsoY) ?>" r="7" fill="#059669" stroke="#ffffff" stroke-width="3"></circle>
                                <text x="<?= esc($x) ?>" y="<?= esc($svgHeight - 22) ?>" text-anchor="middle" fill="#064e3b" font-size="13" font-weight="800"><?= esc($point['label']) ?></text>
                                <text x="<?= esc($x) ?>" y="<?= esc(max(16, $ptsdY - 12)) ?>" text-anchor="middle" fill="#dc2626" font-size="12" font-weight="800"><?= esc($point['ptsd']) ?></text>
                                <text x="<?= esc($x) ?>" y="<?= esc(min($svgHeight - $chartBottom - 10, $dsoY + 22)) ?>" text-anchor="middle" fill="#047857" font-size="12" font-weight="800"><?= esc($point['dso']) ?></text>
                            <?php endforeach; ?>
                        </svg>

                        <div class="trend-legend">
                            <span class="trend-legend__item"><span class="trend-legend__swatch" style="background: #dc2626;"></span> PTSD Score</span>
                            <span class="trend-legend__item"><span class="trend-legend__swatch" style="background: #059669;"></span> DSO Score</span>
                            <?php if ($latestTrend): ?>
                                <span class="trend-legend__item"><i class="bi bi-clipboard2-pulse text-success"></i> Diagnosis terakhir: <?= esc($latestTrend['diagnosis']) ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="timeline-container">
        
        <!-- FASE: RELAWAN -->
        <div class="card-followup position-relative">
            <div class="timeline-dot" style="background-color: #f59e0b; box-shadow: 0 0 0 2px #f59e0b;"></div>
            <div class="card-followup-header text-dark d-flex justify-content-between align-items-center" style="background-color: #fde68a;">
                <span><i class="bi bi-person-badge"></i> Data Triase Relawan</span>
                <?php if($volunteerScreening): ?>
                    <span class="badge bg-light text-dark"><i class="bi bi-check-all"></i> Selesai</span>
                <?php else: ?>
                    <span class="badge bg-light text-secondary">Belum ada</span>
                <?php endif; ?>
            </div>
            <div class="p-3">
                <?php if($volunteerScreening): ?>
                    <div class="row">
                        <div class="col-md-4 mb-2 border-end">
                            <h6 class="fw-bold">Profil & Identitas</h6>
                            <ul class="list-unstyled small mb-2">
                                <li><strong>Gender:</strong> <?= esc($victim['jenis_kelamin'] === 'L' ? 'Laki-Laki' : 'Perempuan') ?></li>
                                <li><strong>Umur:</strong> <?= esc($victim['umur']) ?> Thn</li>
                                <li><strong>Datang:</strong> <?= esc($victim['tanggal_datang'] ?? '-') ?></li>
                            </ul>
                            <h6 class="fw-bold mt-2">Observasi Interaksi</h6>
                            <ul class="list-unstyled small">
                                <li><strong>Kontak Mata:</strong> <?= esc($volunteerScreening['kontak_mata'] ?? '-') ?></li>
                                <li><strong>Bicara:</strong> <?= esc($volunteerScreening['bicara'] ?? '-') ?></li>
                            </ul>
                        </div>
                        <div class="col-md-4 mb-2 border-end">
                            <h6 class="fw-bold">Kondisi Observasi Skrining</h6>
                            <ul class="mb-0 small ps-3">
                                <?php if($volunteerScreening['mampu_sebut_nama']) echo "<li>Mampu Sebut Nama</li>"; ?>
                                <?php if($volunteerScreening['mampu_sebut_lokasi']) echo "<li>Mampu Sebut Lokasi</li>"; ?>
                                <?php if($volunteerScreening['mampu_sebut_tanggal']) echo "<li>Mampu Sebut Tanggal</li>"; ?>
                                <?php if($volunteerScreening['menangis_terus']) echo "<li>Menangis Terus</li>"; ?>
                                <?php if($volunteerScreening['tampak_panik']) echo "<li>Tampak Panik</li>"; ?>
                                <?php if($volunteerScreening['gemetar']) echo "<li>Gemetar</li>"; ?>
                                <?php if($volunteerScreening['berteriak_histeris']) echo "<li>Berteriak Histeris</li>"; ?>
                                <?php if($volunteerScreening['diam_total']) echo "<li>Cenderung Diam/Stupor</li>"; ?>
                                <?php if($volunteerScreening['sulit_tidur']) echo "<li>Sulit Tidur</li>"; ?>
                                <?php if($volunteerScreening['tidak_mau_makan']) echo "<li>Sulit Makan</li>"; ?>
                                <?php if($volunteerScreening['mencari_keluarga']) echo "<li>Mencari/Terpisah Keluarga</li>"; ?>
                                <?php if($volunteerScreening['menyebut_ingin_mati']) echo "<li class='text-danger fw-bold'>Menyebut Ingin Mati</li>"; ?>
                                <?php if($volunteerScreening['melukai_diri']) echo "<li class='text-danger fw-bold'>Melukai Diri</li>"; ?>
                                <?php if($volunteerScreening['mengancam_bunuh_diri']) echo "<li class='text-danger fw-bold'>Mengancam Bunuh Diri</li>"; ?>
                                <?php if($volunteerScreening['agresif']) echo "<li class='text-danger fw-bold'>Agresif</li>"; ?>
                            </ul>
                            <div class="mt-2">
                                <strong>Catatan Relawan:</strong><br>
                                <small class="fst-italic text-muted">"<?= esc($volunteerScreening['catatan_tambahan'] ?? 'Tidak ada catatan') ?>"</small>
                            </div>
                        </div>
                        <div class="col-md-4 mb-2">
                            <h6 class="fw-bold d-flex justify-content-between align-items-center">
                                <span>Analisis AI (Relawan)</span>
                                <?php if(isset($aiByFase[-1])): ?>
                                    <button type="button" class="btn btn-sm btn-link text-nowrap ai-edit-toggle" data-fase="-1" onclick="toggleEditAi(-1, this)"><i class="bi bi-pencil"></i> Edit</button>
                                <?php endif; ?>
                            </h6>
                            <?php if(isset($aiByFase[-1])): ?>
                                <div class="mb-2">
                                    <span class="badge bg-<?= $aiByFase[-1]['risk_level'] === 'high' ? 'danger' : ($aiByFase[-1]['risk_level'] === 'medium' ? 'warning' : 'success') ?>">
                                        <?= strtoupper($aiByFase[-1]['risk_level']) ?> RISK
                                    </span>
                                </div>
                                <div><strong>Rekomendasi Diagnosis:</strong><br><small><?= esc($aiByFase[-1]['kemungkinan_diagnosis'] ?? '-') ?></small></div>
                                <div class="mt-2">
                                    <strong>Summary AI:</strong><br>
                                    <div id="ai-summary-display--1" class="small fst-italic text-muted" style="white-space: pre-wrap;"><?= esc($aiByFase[-1]['ai_summary']) ?></div>
                                    <div id="ai-summary-edit--1" class="ai-edit-card d-none">
                                        <textarea class="form-control form-control-sm mb-2" id="ai-textarea--1" rows="6"><?= esc($aiByFase[-1]['ai_summary']) ?></textarea>
                                        <button type="button" class="btn btn-sm btn-success w-100" onclick="saveAiSummary(<?= $victim['id'] ?>, -1)">Simpan Perubahan AI</button>
                                    </div>
                                </div>
                            <?php else: ?>
                                <span class="text-muted small">Belum ada analisis AI Relawan.</span>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="text-muted small">Belum ada data relawan.</div>
                <?php endif; ?>
            </div>
        </div>

        <!-- HELPER FUNCTION FOR MSE -->
        <?php
        function renderMseDetail($review, $ca, $victim, $ke) {
            if (!$review) {
                return '
                <a href="' . site_url('/psychologist-review/' . $victim['id'] . '?fase_ke=' . $ke) . '" class="btn btn-sm btn-outline-primary mb-2">
                    <i class="bi bi-file-earmark-medical"></i> Isi Form MSE (Psikolog)
                </a>';
            }
            $mseHtml = '<dl class="row mse-list small mb-0">';
            $fields = [
                'Chief Complaint' => ['val' => $review['chief_complaint'], 'note' => null],
                'Appearance'      => ['val' => $review['mse_appearance'], 'note' => $review['mse_appearance_note']],
                'Behavior'        => ['val' => $review['mse_behavior'], 'note' => $review['mse_behavior_note']],
                'Speech'          => ['val' => $review['mse_speech'], 'note' => $review['mse_speech_note']],
                'Mood'            => ['val' => $review['mse_mood'], 'note' => $review['mse_mood_note']],
                'Affect'          => ['val' => $review['mse_affect'], 'note' => $review['mse_affect_note']],
                'Thought'         => ['val' => $review['mse_thought'], 'note' => $review['mse_thought_note']],
                'Orientation'     => ['val' => $review['mse_orientation'], 'note' => $review['mse_orientation_note']],
                'Insight'         => ['val' => $review['mse_insight'], 'note' => $review['mse_insight_note']],
                'Perception'      => ['val' => $review['mse_perception'], 'note' => $review['mse_perception_note']],
                'Risk Assessment' => ['val' => $review['risk_assessment'], 'note' => $review['risk_assessment_note']],
            ];

            foreach ($fields as $label => $data) {
                $val = esc($data['val'] ?? '-');
                $note = $data['note'] ? '<br><span class="text-muted fst-italic">"'.esc($data['note']).'"</span>' : '';
                $mseHtml .= "<dt class='col-sm-4'>{$label}</dt><dd class='col-sm-8'>{$val}{$note}</dd>";
            }
            
            $diag = esc($ca['diagnosis_sementara'] ?? '-');
            $interv = esc($ca['intervensi'] ?? '-');
            $catatan = esc($ca['catatan_klinis'] ?? '-');
            
            $mseHtml .= "<hr class='my-2'><dt class='col-sm-4'>Diagnosis</dt><dd class='col-sm-8'>{$diag}</dd>";
            $mseHtml .= "<dt class='col-sm-4'>Intervensi</dt><dd class='col-sm-8'>{$interv}</dd>";
            $mseHtml .= "<dt class='col-sm-4'>Catatan</dt><dd class='col-sm-8'>{$catatan}</dd>";
            $mseHtml .= '</dl>';
            return $mseHtml;
        }
        ?>

        <!-- FASE 0: BASELINE -->
        <div class="card-followup position-relative">
            <div class="timeline-dot"></div>
            <div class="card-followup-header text-white d-flex justify-content-between align-items-center" style="background-color: #3b82f6;">
                <span><i class="bi bi-journal-medical"></i> Konsultasi Awal (Baseline - Hari 0)</span>
                <?php if(isset($itqByFase[0]) && isset($reviewByFase[0])): ?>
                    <span class="badge bg-light text-primary"><i class="bi bi-check-all"></i> Selesai</span>
                <?php else: ?>
                    <span class="badge bg-light text-secondary">Pending</span>
                <?php endif; ?>
            </div>
            <div class="p-3">
                <div class="row">
                    <div class="col-md-3 mb-2 border-end">
                        <h6 class="fw-bold text-primary">Hasil ITQ</h6>
                        <?php if(isset($itqByFase[0])): ?>
                            <div><strong>Skor PTSD:</strong> <?= esc($itqByFase[0]['ptsd_score']) ?></div>
                            <div><strong>Skor DSO:</strong> <?= esc($itqByFase[0]['dso_score']) ?></div>
                            <div class="mt-2"><strong>Diagnosis ITQ:</strong><br>
                                <span class="badge bg-<?= strpos($itqByFase[0]['final_diagnosis'] ?? '', 'PTSD') !== false ? 'danger' : 'success' ?>">
                                    <?= esc($itqByFase[0]['final_diagnosis']) ?>
                                </span>
                            </div>
                            <a href="<?= site_url('/itq/result/' . $victim['id'] . '?fase_ke=0') ?>" class="btn btn-sm btn-outline-primary mt-3">
                                <i class="bi bi-graph-up"></i> Detail Grafik & Skor
                            </a>
                        <?php else: ?>
                            <a href="<?= site_url('/itq/form/' . $victim['id'] . '?fase_ke=0') ?>" class="btn btn-sm btn-outline-primary mb-2">
                                <i class="bi bi-pencil-square"></i> Isi ITQ Awal
                            </a>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-5 mb-2 border-end">
                        <h6 class="fw-bold text-primary">Evaluasi Mental Status (MSE) Psikolog</h6>
                        <?= renderMseDetail($reviewByFase[0] ?? null, $caByFase[0] ?? null, $victim, 0) ?>
                    </div>
                    <div class="col-md-4 mb-2">
                        <h6 class="fw-bold text-primary d-flex justify-content-between align-items-center">
                            <span>Analisis AI (Konsultasi Awal)</span>
                            <?php if(isset($aiByFase[0])): ?>
                                <button type="button" class="btn btn-sm btn-link text-nowrap ai-edit-toggle" data-fase="0" onclick="toggleEditAi(0, this)"><i class="bi bi-pencil"></i> Edit</button>
                            <?php endif; ?>
                        </h6>
                        <?php if(isset($aiByFase[0])): ?>
                            <div id="ai-summary-display-0" class="small fst-italic text-muted" style="white-space: pre-wrap;"><?= esc($aiByFase[0]['ai_summary']) ?></div>
                            <div id="ai-summary-edit-0" class="ai-edit-card d-none">
                                <textarea class="form-control form-control-sm mb-2" id="ai-textarea-0" rows="6"><?= esc($aiByFase[0]['ai_summary']) ?></textarea>
                                <button type="button" class="btn btn-sm btn-success w-100" onclick="saveAiSummary(<?= $victim['id'] ?>, 0)">Simpan Perubahan AI</button>
                            </div>
                        <?php else: ?>
                            <span class="text-muted small">Otomatis terisi setelah form ITQ & MSE disimpan.</span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- FASE 1, 2, 3: FOLLOW-UPS -->
        <?php foreach ([1 => 7, 2 => 14, 3 => 30] as $ke => $hari): ?>
        <div class="card-followup position-relative">
            <div class="timeline-dot" style="background-color: #8b5cf6; box-shadow: 0 0 0 2px #8b5cf6;"></div>
            <div class="card-followup-header text-white d-flex justify-content-between align-items-center" style="background-color: #8b5cf6;">
                <span><i class="bi bi-calendar2-check"></i> Follow-Up #<?= $ke ?> (Hari ke-<?= $hari ?>)</span>
                <?php if(isset($itqByFase[$ke]) && isset($reviewByFase[$ke])): ?>
                    <span class="badge bg-light text-success"><i class="bi bi-check-all"></i> Selesai</span>
                <?php else: ?>
                    <span class="badge bg-light text-secondary">Pending</span>
                <?php endif; ?>
            </div>
            <div class="p-3">
                <div class="row">
                    <div class="col-md-3 mb-2 border-end">
                        <h6 class="fw-bold" style="color: #6d28d9;">Hasil ITQ</h6>
                        <?php if(isset($itqByFase[$ke])): ?>
                            <div><strong>Skor PTSD:</strong> <?= esc($itqByFase[$ke]['ptsd_score']) ?></div>
                            <div><strong>Skor DSO:</strong> <?= esc($itqByFase[$ke]['dso_score']) ?></div>
                            <div class="mt-2"><strong>Diagnosis ITQ:</strong><br>
                                <span class="badge bg-<?= strpos($itqByFase[$ke]['final_diagnosis'] ?? '', 'PTSD') !== false ? 'danger' : 'success' ?>">
                                    <?= esc($itqByFase[$ke]['final_diagnosis']) ?>
                                </span>
                            </div>
                            <a href="<?= site_url('/itq/result/' . $victim['id'] . '?fase_ke=' . $ke) ?>" class="btn btn-sm btn-outline-primary mt-3" style="color: #6d28d9; border-color: #6d28d9;">
                                <i class="bi bi-graph-up"></i> Detail Grafik & Skor
                            </a>
                        <?php else: ?>
                            <a href="<?= site_url('/itq/form/' . $victim['id'] . '?fase_ke=' . $ke) ?>" class="btn btn-sm btn-outline-primary mb-2">
                                <i class="bi bi-pencil-square"></i> Isi Follow-Up ITQ
                            </a>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-5 mb-2 border-end">
                        <h6 class="fw-bold" style="color: #6d28d9;">Evaluasi Mental Status (MSE) Psikolog</h6>
                        <?= renderMseDetail($reviewByFase[$ke] ?? null, $caByFase[$ke] ?? null, $victim, $ke) ?>
                    </div>
                    <div class="col-md-4 mb-2">
                        <h6 class="fw-bold d-flex justify-content-between align-items-center" style="color: #6d28d9;">
                            <span>Analisis AI (Follow-up)</span>
                            <?php if(isset($aiByFase[$ke])): ?>
                                <button type="button" class="btn btn-sm btn-link text-nowrap ai-edit-toggle" data-fase="<?= $ke ?>" onclick="toggleEditAi(<?= $ke ?>, this)"><i class="bi bi-pencil"></i> Edit</button>
                            <?php endif; ?>
                        </h6>
                        <?php if(isset($aiByFase[$ke])): ?>
                            <div id="ai-summary-display-<?= $ke ?>" class="small fst-italic text-muted" style="white-space: pre-wrap;"><?= esc($aiByFase[$ke]['ai_summary']) ?></div>
                            <div id="ai-summary-edit-<?= $ke ?>" class="ai-edit-card d-none">
                                <textarea class="form-control form-control-sm mb-2" id="ai-textarea-<?= $ke ?>" rows="6"><?= esc($aiByFase[$ke]['ai_summary']) ?></textarea>
                                <button type="button" class="btn btn-sm btn-success w-100" onclick="saveAiSummary(<?= $victim['id'] ?>, <?= $ke ?>)">Simpan Perubahan AI</button>
                            </div>
                        <?php else: ?>
                            <span class="text-muted small">Otomatis terisi setelah form ITQ & MSE selesai dihitung.</span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>

        <!-- KEPUTUSAN AKHIR -->
        <?php if(isset($itqByFase[3]) && isset($reviewByFase[3])): ?>
        <div class="card-followup position-relative">
            <div class="timeline-dot" style="background-color: #10b981; box-shadow: 0 0 0 2px #10b981;"></div>
            <div class="card-followup-header text-white d-flex justify-content-between align-items-center" style="background-color: #10b981;">
                <span><i class="bi bi-flag-fill"></i> Keputusan Akhir</span>
                <?php if($finalDecision): ?>
                    <span class="badge bg-light text-success"><i class="bi bi-check-all"></i> Tersimpan</span>
                <?php endif; ?>
            </div>
            <div class="p-3">
                <?php if($finalDecision): ?>
                    <div class="mb-2"><strong>Status Akhir:</strong> <span class="badge bg-success"><?= esc($finalDecision['status_akhir']) ?></span></div>
                    <div><strong>Catatan Akhir:</strong><br><?= esc($finalDecision['catatan_akhir']) ?></div>
                <?php else: ?>
                    <form action="<?= site_url('/psikolog/monitoring/store-final-decision/' . $victim['id']) ?>" method="POST">
                        <?= csrf_field() ?>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Status/Tindak Lanjut Akhir</label>
                            <select name="status_akhir" class="form-select" required>
                                <option value="">-- Pilih --</option>
                                <option value="Selesai (Pulih)">Selesai (Pulih)</option>
                                <option value="Rujuk ke Psikiater">Rujuk ke Psikiater</option>
                                <option value="Perlu Perawatan Lanjutan">Perlu Perawatan Lanjutan</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Catatan Klinis Akhir</label>
                            <textarea name="catatan_akhir" class="form-control" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-success"><i class="bi bi-save"></i> Simpan Keputusan Akhir</button>
                    </form>
                <?php endif; ?>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>

<script>
    function toggleEditAi(faseKe, toggleButton = null) {
        const displayPanel = document.getElementById('ai-summary-display-' + faseKe);
        const editPanel = document.getElementById('ai-summary-edit-' + faseKe);

        displayPanel.classList.toggle('d-none');
        editPanel.classList.toggle('d-none');

        const button = toggleButton || document.querySelector('.ai-edit-toggle[data-fase="' + faseKe + '"]');
        if (button) {
            const isEditing = !editPanel.classList.contains('d-none');
            button.innerHTML = isEditing ? '<i class="bi bi-x-circle"></i> Batal Edit' : '<i class="bi bi-pencil"></i> Edit';
        }
    }

    function saveAiSummary(victimId, faseKe) {
        const text = document.getElementById('ai-textarea-' + faseKe).value;
        const btn = document.querySelector('#ai-summary-edit-' + faseKe + ' button');
        btn.disabled = true;
        btn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Menyimpan...';
        
        fetch('<?= site_url('/psikolog/monitoring/update-ai-summary/') ?>' + victimId + '/' + faseKe, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: 'ai_summary=' + encodeURIComponent(text) + '&<?= csrf_token() ?>=' + '<?= csrf_hash() ?>'
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                document.getElementById('ai-summary-display-' + faseKe).innerText = text;
                toggleEditAi(faseKe);
                // Optionally show a toast notification here
            } else {
                alert('Gagal menyimpan: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan jaringan.');
        })
        .finally(() => {
            btn.disabled = false;
            btn.innerText = 'Simpan Perubahan AI';
        });
    }
</script>
<?= $this->endSection() ?>
