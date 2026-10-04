@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content')

<div class="container-fluid dash-wrap">

    {{-- ================================
        STAT CARDS
    ================================= --}}
    <div class="row stat-row">

        {{-- Patients --}}
        <div class="col-6 col-md-4 col-xl mb-3">
            <div class="stat-card">

                <div class="stat-card-top">
                    <span class="stat-icon icon-violet">
                        <i class="fas fa-user-injured"></i>
                    </span>

                    <span class="stat-trend trend-success">
                        <i class="fas fa-check"></i>
                        សកម្ម
                    </span>
                </div>

                <div class="stat-label">
                    អ្នកជំងឺសរុប
                </div>

                <div class="stat-value">
                    {{ number_format($totalPatients ?? 0) }}
                </div>

                <a href="{{ route('patients.index') }}"
                   class="stat-action">
                    <span>គ្រប់គ្រងអ្នកជំងឺ</span>
                    <i class="fas fa-arrow-right"></i>
                </a>

            </div>
        </div>


        {{-- Users --}}
        <div class="col-6 col-md-4 col-xl mb-3">
            <div class="stat-card">

                <div class="stat-card-top">
                    <span class="stat-icon icon-blue">
                        <i class="fas fa-users-cog"></i>
                    </span>

                    <span class="stat-trend trend-info">
                        <i class="fas fa-user-shield"></i>
                        សរុប
                    </span>
                </div>

                <div class="stat-label">
                    អ្នកប្រើប្រាស់
                </div>

                <div class="stat-value">
                    {{ number_format($totalUsers ?? 0) }}
                </div>

                <a href="{{ route('user.index') }}"
                   class="stat-action">
                    <span>គ្រប់គ្រងអ្នកប្រើប្រាស់</span>
                    <i class="fas fa-arrow-right"></i>
                </a>

            </div>
        </div>


        {{-- Medicines --}}
        <div class="col-6 col-md-4 col-xl mb-3">
            <div class="stat-card">

                <div class="stat-card-top">
                    <span class="stat-icon icon-pink">
                        <i class="fas fa-pills"></i>
                    </span>

                    <span class="stat-trend trend-warning">
                        <i class="fas fa-boxes"></i>
                        ស្តុក
                    </span>
                </div>

                <div class="stat-label">
                    ថ្នាំសរុប
                </div>

                <div class="stat-value">
                    {{ number_format($totalMedicines ?? 0) }}
                </div>

                <a href="{{ route('pharmacy.index') }}"
                   class="stat-action">
                    <span>ចូលឱសថស្ថាន</span>
                    <i class="fas fa-arrow-right"></i>
                </a>

            </div>
        </div>


        {{-- Today Revenue --}}
        <div class="col-6 col-md-4 col-xl mb-3">
            <div class="stat-card">

                <div class="stat-card-top">
                    <span class="stat-icon icon-teal">
                        <i class="fas fa-wallet"></i>
                    </span>

                    <span class="stat-trend trend-success">
                        <i class="fas fa-calendar-day"></i>
                        ថ្ងៃនេះ
                    </span>
                </div>

                <div class="stat-label">
                    ចំណូលប្រចាំថ្ងៃ
                </div>

                <div class="stat-value">
                    ${{ number_format($todayRevenue ?? 0, 2) }}
                </div>

                <a href="{{ route('billing.index') }}"
                   class="stat-action">
                    <span>មើលការទូទាត់</span>
                    <i class="fas fa-arrow-right"></i>
                </a>

            </div>
        </div>


        {{-- Total Revenue --}}
        <div class="col-6 col-md-4 col-xl mb-3">
            <div class="stat-card">

                <div class="stat-card-top">
                    <span class="stat-icon icon-green">
                        <i class="fas fa-hand-holding-usd"></i>
                    </span>

                    <span class="stat-trend trend-success">
                        <i class="fas fa-chart-line"></i>
                        សរុប
                    </span>
                </div>

                <div class="stat-label">
                    ចំណូលសរុប
                </div>

                <div class="stat-value">
                    ${{ number_format($totalRevenue ?? 0, 2) }}
                </div>

                <a href="{{ route('billing.index') }}"
                   class="stat-action">
                    <span>មើលការទូទាត់</span>
                    <i class="fas fa-arrow-right"></i>
                </a>

            </div>
        </div>

    </div>


    {{-- ================================
        MIDDLE ROW
    ================================= --}}
    <div class="row mb-3">

        {{-- Income / Expense --}}
        <div class="col-lg-5 mb-3 mb-lg-0">

            <div class="dashboard-panel h-100">

                <div class="panel-header">

                    <div>
                        <h3 class="panel-title">
                            ចំណូល និង ចំណាយ
                        </h3>

                        <p class="panel-subtitle">
                            ស្ថិតិហិរញ្ញវត្ថុ
                        </p>
                    </div>

                    <div class="range-toggle">

                        <button type="button"
                            class="range-btn income-range-btn active"
                            data-range="yearly">
                            ប្រចាំឆ្នាំ
                        </button>

                        <button type="button"
                            class="range-btn income-range-btn"
                            data-range="monthly">
                            ប្រចាំខែ
                        </button>

                    </div>

                </div>

                <div class="chart-holder finance-chart">
                    <canvas id="incomeExpenseChart"></canvas>
                </div>

                <div class="chart-legend">

                    <span>
                        <i class="legend-dot dot-green"></i>
                        ចំណូល
                    </span>

                    <span>
                        <i class="legend-dot dot-pink"></i>
                        ចំណាយ
                    </span>

                </div>

            </div>

        </div>


        {{-- Today's Summary --}}
        <div class="col-lg-4 mb-3 mb-lg-0">

            <div class="dashboard-panel h-100">

                <div class="panel-header simple-header">

                    <div>
                        <h3 class="panel-title">
                            សកម្មភាពថ្ងៃនេះ
                        </h3>

                        <p class="panel-subtitle">
                            ស្ថានភាពប្រចាំថ្ងៃ
                        </p>
                    </div>

                    <span class="today-badge">
                        <i class="fas fa-calendar-day"></i>
                        ថ្ងៃនេះ
                    </span>

                </div>


                <div class="today-list">

                    <div class="today-row">

                        <span class="today-icon bg-soft-green">
                            <i class="fas fa-calendar-check"></i>
                        </span>

                        <div class="today-text">
                            <div class="today-label">
                                ការណាត់ជួប
                            </div>

                            <div class="today-value">
                                {{ $todayAppointments ?? 0 }}
                            </div>
                        </div>

                        <i class="fas fa-chevron-right today-arrow"></i>

                    </div>


                    <div class="today-row">

                        <span class="today-icon bg-soft-red">
                            <i class="fas fa-notes-medical"></i>
                        </span>

                        <div class="today-text">
                            <div class="today-label">
                                ករណីបន្ទាន់
                            </div>

                            <div class="today-value">
                                {{ $emergencyCases ?? 0 }}
                            </div>
                        </div>

                        <i class="fas fa-chevron-right today-arrow"></i>

                    </div>


                    <div class="today-row">

                        <span class="today-icon bg-soft-blue">
                            <i class="fas fa-bed"></i>
                        </span>

                        <div class="today-text">
                            <div class="today-label">
                                បន្ទប់ទំនេរ
                            </div>

                            <div class="today-value">
                                {{ $availableRooms ?? 0 }}
                            </div>
                        </div>

                        <i class="fas fa-chevron-right today-arrow"></i>

                    </div>

                </div>


                <a href="{{ route('appointment.index') }}"
                   class="btn-view-more text-center text-decoration-none">
                    <span>មើលបន្ថែម</span>
                    <i class="fas fa-arrow-right"></i>
                </a>

            </div>

        </div>


        {{-- Room Occupancy --}}
        <div class="col-lg-3">

            <div class="dashboard-panel h-100 occupancy-panel">

                <div class="panel-header simple-header">

                    <div>
                        <h3 class="panel-title">
                            ចំនួនគ្រែ
                        </h3>

                        <p class="panel-subtitle">
                            ស្ថានភាពបន្ទប់
                        </p>
                    </div>

                </div>


                <div class="donut-holder">

                    <canvas id="occupancyChart"
                        width="150"
                        height="150">
                    </canvas>

                    <div class="donut-center">

                        <strong>
                            {{ $occupancyPercent ?? 0 }}%
                        </strong>

                        <span>
                            កំពុងប្រើ
                        </span>

                    </div>

                </div>


                <div class="donut-stats">

                    <div class="donut-stat">

                        <span class="donut-stat-icon total-icon">
                            <i class="fas fa-bed"></i>
                        </span>

                        <div>
                            <div class="donut-stat-label">
                                សរុប
                            </div>

                            <div class="donut-stat-value">
                                {{ number_format($totalRooms ?? 0) }}
                            </div>
                        </div>

                    </div>


                    <div class="donut-stat">

                        <span class="donut-stat-icon available-icon">
                            <i class="fas fa-check"></i>
                        </span>

                        <div>
                            <div class="donut-stat-label">
                                នៅសល់
                            </div>

                            <div class="donut-stat-value available-value">
                                {{ $availableRooms ?? 0 }}
                            </div>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- ================================
        BOTTOM ROW
    ================================= --}}
    <div class="row">

        {{-- Patient Progress --}}
        <div class="col-lg-7 mb-3 mb-lg-0">

            <div class="dashboard-panel h-100">

                <div class="panel-header">

                    <div>
                        <h3 class="panel-title">
                            ការវិវត្តអ្នកជំងឺ
                        </h3>

                        <p class="panel-subtitle">
                            ចំនួនអ្នកជំងឺថ្មី
                        </p>
                    </div>

                    <div class="range-toggle">

                        <button type="button"
                            class="range-btn patient-range-btn active"
                            data-range="weekly">
                            ប្រចាំសប្តាហ៍
                        </button>

                        <button type="button"
                            class="range-btn patient-range-btn"
                            data-range="monthly">
                            ប្រចាំខែ
                        </button>

                    </div>

                </div>


                <div class="chart-holder patient-chart">
                    <canvas id="weeklyChart"></canvas>
                </div>

            </div>

        </div>


        {{-- Department --}}
        <div class="col-lg-5">

            <div class="dashboard-panel h-100">

                <div class="panel-header simple-header">

                    <div>
                        <h3 class="panel-title">
                            អ្នកជំងឺតាមផ្នែក
                        </h3>

                        <p class="panel-subtitle">
                            ស្ថានភាពអ្នកជំងឺសកម្ម
                        </p>
                    </div>

                    <span class="department-icon">
                        <i class="fas fa-hospital"></i>
                    </span>

                </div>


                <div class="department-list">

                    @forelse($departmentBreakdown ?? [] as $dept)

                        <div class="dept-row">

                            <span class="dept-icon bg-soft-rose">
                                <i class="fas fa-heartbeat"></i>
                            </span>


                            <div class="dept-text">

                                <div class="dept-name">
                                    {{ $dept['name'] }}
                                </div>

                                <div class="dept-sub">
                                    {{ $dept['total'] }} Patients Active
                                </div>

                            </div>


                            <div class="dept-percent">
                                {{ $dept['percent'] }}%
                            </div>

                        </div>

                    @empty

                        <div class="department-empty">

                            <div class="empty-dept-icon">
                                <i class="fas fa-hospital"></i>
                            </div>

                            <div>
                                <div class="empty-dept-title">
                                    មិនទាន់មានទិន្នន័យ
                                </div>

                                <div class="empty-dept-text">
                                    ត្រូវកំណត់ department ទៅបន្ទប់សិន
                                </div>
                            </div>

                        </div>

                    @endforelse

                </div>

            </div>

        </div>

    </div>

</div>

@stop


@section('css')

@parent

<style>

    :root {
        --dash-primary: #006D36;
        --dash-primary-dark: #00552B;
        --dash-primary-soft: #EAF6EF;

        --dash-ink: #1F2A24;
        --dash-muted: #7A8780;

        --dash-border: #E8ECEA;
        --dash-bg: #F7F9F8;

        --dash-blue: #2F80ED;
        --dash-pink: #E0559C;
        --dash-danger: #E0455A;
    }


    body {
        background: #F5F7F6;
        color: var(--dash-ink);
    }


    .content-wrapper {
        background: #F5F7F6;
    }


    .dash-wrap {
        padding-top: 4px;
        padding-bottom: 20px;
    }


    /* =========================================
       STAT CARDS
    ========================================= */

    .stat-card {
        position: relative;
        height: 100%;
        background: #fff;
        border: 1px solid var(--dash-border);
        border-radius: 15px;
        padding: 16px;
        box-shadow: 0 3px 14px rgba(31, 42, 36, .035);
        overflow: hidden;
        transition: all .2s ease;
    }


    .stat-card::after {
        content: "";
        position: absolute;
        width: 70px;
        height: 70px;
        right: -25px;
        bottom: -30px;
        border-radius: 50%;
        background: var(--dash-primary-soft);
        opacity: .45;
        pointer-events: none;
    }


    .stat-card:hover {
        transform: translateY(-2px);
        border-color: #DDE7E1;
        box-shadow: 0 8px 22px rgba(31, 42, 36, .07);
    }


    .stat-card-top {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
    }


    .stat-icon {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
    }


    .icon-violet {
        background: #EEE9FE;
        color: #7C4DFF;
    }


    .icon-blue {
        background: #E4F0FF;
        color: #2F80ED;
    }


    .icon-pink {
        background: #FDE9F3;
        color: #E0559C;
    }


    .icon-teal {
        background: #E1F6EF;
        color: #14A97F;
    }


    .icon-green {
        background: var(--dash-primary-soft);
        color: var(--dash-primary);
    }


    .stat-trend {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 4px 8px;
        border-radius: 20px;
        font-size: 9px;
        font-weight: 750;
        white-space: nowrap;
    }


    .trend-success {
        background: #EAF7EF;
        color: #21844B;
    }


    .trend-info {
        background: #EDF5FF;
        color: #3478C8;
    }


    .trend-warning {
        background: #FFF7E7;
        color: #B7791F;
    }


    .stat-label {
        margin-top: 12px;
        color: var(--dash-muted);
        font-size: 11px;
        font-weight: 600;
    }


    .stat-value {
        margin-top: 3px;
        margin-bottom: 12px;
        color: var(--dash-ink);
        font-size: 21px;
        line-height: 1.2;
        font-weight: 750;
    }


    .stat-action {
        position: relative;
        z-index: 2;
        display: flex;
        align-items: center;
        justify-content: space-between;
        width: 100%;
        padding: 7px 10px;
        border-radius: 8px;
        background: #F6F8F7;
        color: #4D5B54;
        font-size: 9px;
        font-weight: 700;
        text-decoration: none !important;
        transition: all .18s ease;
    }


    .stat-action i {
        font-size: 9px;
        transition: transform .18s ease;
    }


    .stat-action:hover {
        background: var(--dash-primary-soft);
        color: var(--dash-primary);
    }


    .stat-action:hover i {
        transform: translateX(3px);
    }


    /* =========================================
       DASHBOARD PANELS
    ========================================= */

    .dashboard-panel {
        background: #fff;
        border: 1px solid var(--dash-border);
        border-radius: 15px;
        padding: 18px;
        box-shadow: 0 3px 14px rgba(31, 42, 36, .035);
    }


    .panel-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 12px;
        margin-bottom: 8px;
    }


    .simple-header {
        align-items: center;
    }


    .panel-title {
        margin: 0;
        color: var(--dash-ink);
        font-size: 14px;
        font-weight: 750;
    }


    .panel-subtitle {
        margin: 3px 0 0;
        color: #9AA59F;
        font-size: 9px;
        font-weight: 500;
    }


    /* =========================================
       RANGE TOGGLE
    ========================================= */

    .range-toggle {
        display: inline-flex;
        align-items: center;
        gap: 2px;
        padding: 3px;
        background: #F4F7F5;
        border: 1px solid #EEF1EF;
        border-radius: 9px;
        flex-shrink: 0;
    }


    .range-btn {
        border: none;
        outline: none !important;
        background: transparent;
        color: #8A9690;
        padding: 5px 9px;
        border-radius: 7px;
        font-size: 9px;
        font-weight: 650;
        cursor: pointer;
        transition: all .18s ease;
    }


    .range-btn:hover {
        color: var(--dash-ink);
    }


    .range-btn.active {
        background: #fff;
        color: var(--dash-primary);
        box-shadow: 0 2px 6px rgba(31, 42, 36, .08);
    }


    /* =========================================
       CHART
    ========================================= */

    .chart-holder {
        position: relative;
        width: 100%;
    }


    .finance-chart {
        height: 205px;
        margin-top: 5px;
    }


    .patient-chart {
        height: 215px;
        margin-top: 8px;
    }


    .chart-holder canvas {
        width: 100% !important;
        height: 100% !important;
    }


    .chart-legend {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 22px;
        margin-top: 3px;
        color: var(--dash-muted);
        font-size: 10px;
    }


    .chart-legend span {
        display: inline-flex;
        align-items: center;
    }


    .legend-dot {
        width: 8px;
        height: 8px;
        margin-right: 5px;
        border-radius: 50%;
        display: inline-block;
    }


    .dot-green {
        background: var(--dash-primary);
    }


    .dot-pink {
        background: var(--dash-pink);
    }


    /* =========================================
       TODAY
    ========================================= */

    .today-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 5px 8px;
        border-radius: 8px;
        background: var(--dash-primary-soft);
        color: var(--dash-primary);
        font-size: 9px;
        font-weight: 700;
    }


    .today-list {
        margin-top: 5px;
    }


    .today-row {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 12px 0;
        border-bottom: 1px solid var(--dash-border);
    }


    .today-row:last-child {
        border-bottom: none;
    }


    .today-icon {
        width: 38px;
        height: 38px;
        border-radius: 10px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        font-size: 14px;
    }


    .bg-soft-green {
        background: #EAF7EF;
        color: var(--dash-primary);
    }


    .bg-soft-red {
        background: #FDEBEC;
        color: var(--dash-danger);
    }


    .bg-soft-blue {
        background: #EAF2FF;
        color: var(--dash-blue);
    }


    .today-text {
        flex: 1;
        min-width: 0;
    }


    .today-label {
        color: var(--dash-muted);
        font-size: 10px;
        font-weight: 550;
    }


    .today-value {
        margin-top: 2px;
        color: var(--dash-ink);
        font-size: 15px;
        line-height: 1.1;
        font-weight: 750;
    }


    .today-arrow {
        color: #C2CAC5;
        font-size: 9px;
    }


    .btn-view-more {
        display: flex !important;
        align-items: center;
        justify-content: center;
        gap: 7px;
        width: 100%;
        margin-top: 12px;
        padding: 9px 10px;
        border: 1px solid #E6EBE8;
        border-radius: 9px;
        background: #F7F9F8;
        color: #526058;
        font-size: 10px;
        font-weight: 700;
        transition: all .18s ease;
    }


    .btn-view-more i {
        font-size: 9px;
        transition: transform .18s ease;
    }


    .btn-view-more:hover {
        background: var(--dash-primary-soft);
        border-color: #D7E9DE;
        color: var(--dash-primary);
    }


    .btn-view-more:hover i {
        transform: translateX(3px);
    }


    /* =========================================
       OCCUPANCY
    ========================================= */

    .occupancy-panel {
        text-align: center;
    }


    .occupancy-panel .panel-header {
        text-align: left;
    }


    .donut-holder {
        position: relative;
        width: 150px;
        height: 150px;
        margin: 8px auto 15px;
    }


    .donut-holder canvas {
        width: 150px !important;
        height: 150px !important;
    }


    .donut-center {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 90px;
        text-align: center;
    }


    .donut-center strong {
        display: block;
        color: var(--dash-ink);
        font-size: 21px;
        line-height: 1.2;
        font-weight: 800;
    }


    .donut-center span {
        display: block;
        margin-top: 2px;
        color: var(--dash-muted);
        font-size: 9px;
        font-weight: 550;
    }


    .donut-stats {
        display: flex;
        gap: 8px;
        margin-top: auto;
    }


    .donut-stat {
        display: flex;
        align-items: center;
        gap: 7px;
        flex: 1;
        padding: 8px;
        border: 1px solid #EDF1EE;
        border-radius: 9px;
        background: #FAFBFA;
        text-align: left;
    }


    .donut-stat-icon {
        width: 27px;
        height: 27px;
        border-radius: 7px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        font-size: 9px;
    }


    .total-icon {
        background: #EEF4FF;
        color: #4775C8;
    }


    .available-icon {
        background: #EAF7EF;
        color: #21844B;
    }


    .donut-stat-label {
        color: var(--dash-muted);
        font-size: 8px;
    }


    .donut-stat-value {
        margin-top: 1px;
        color: var(--dash-ink);
        font-size: 12px;
        font-weight: 750;
    }


    .available-value {
        color: #21844B;
    }


    /* =========================================
       DEPARTMENT
    ========================================= */

    .department-icon {
        width: 31px;
        height: 31px;
        border-radius: 8px;
        background: var(--dash-primary-soft);
        color: var(--dash-primary);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 11px;
    }


    .department-list {
        margin-top: 2px;
    }


    .dept-row {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px 0;
        border-bottom: 1px solid var(--dash-border);
    }


    .dept-row:last-child {
        border-bottom: none;
    }


    .dept-icon {
        width: 36px;
        height: 36px;
        border-radius: 9px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        font-size: 12px;
    }


    .bg-soft-rose {
        background: #FCE9EC;
        color: #E0556B;
    }


    .dept-text {
        flex: 1;
        min-width: 0;
    }


    .dept-name {
        color: var(--dash-ink);
        font-size: 11px;
        font-weight: 700;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }


    .dept-sub {
        margin-top: 2px;
        color: #9AA59F;
        font-size: 8px;
    }


    .dept-percent {
        padding: 4px 7px;
        border-radius: 6px;
        background: var(--dash-primary-soft);
        color: var(--dash-primary);
        font-size: 9px;
        font-weight: 750;
    }


    /* =========================================
       EMPTY DEPARTMENT
    ========================================= */

    .department-empty {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 20px 5px;
    }


    .empty-dept-icon {
        width: 38px;
        height: 38px;
        border-radius: 10px;
        background: #F3F5F4;
        color: #9AA59F;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }


    .empty-dept-icon i {
        font-size: 13px;
    }


    .empty-dept-title {
        color: #59665F;
        font-size: 10px;
        font-weight: 700;
    }


    .empty-dept-text {
        margin-top: 2px;
        color: #9AA59F;
        font-size: 8px;
    }


    /* =========================================
       RESPONSIVE
    ========================================= */

    @media (max-width: 1199.98px) {

        .stat-card {
            padding: 14px;
        }

        .stat-value {
            font-size: 19px;
        }

    }


    @media (max-width: 991.98px) {

        .dashboard-panel {
            padding: 16px;
        }

        .finance-chart {
            height: 210px;
        }

        .patient-chart {
            height: 210px;
        }

    }


    @media (max-width: 767.98px) {

        .panel-header {
            flex-wrap: wrap;
        }

        .range-toggle {
            margin-left: auto;
        }

        .stat-value {
            font-size: 18px;
        }

        .stat-action {
            font-size: 8px;
        }

        .panel-title {
            font-size: 13px;
        }

    }


    @media (max-width: 575.98px) {

        .dash-wrap {
            padding-left: 5px;
            padding-right: 5px;
        }

        .dashboard-panel {
            padding: 14px;
            border-radius: 12px;
        }

        .stat-card {
            border-radius: 12px;
            padding: 13px;
        }

        .stat-icon {
            width: 32px;
            height: 32px;
            font-size: 12px;
        }

        .stat-trend {
            font-size: 8px;
            padding: 3px 6px;
        }

        .stat-label {
            font-size: 10px;
        }

        .stat-value {
            font-size: 17px;
        }

        .range-btn {
            padding: 5px 7px;
            font-size: 8px;
        }

        .panel-header {
            gap: 8px;
        }

        .today-badge {
            font-size: 8px;
        }

        .donut-holder {
            margin-top: 12px;
        }

    }

</style>

@stop


@section('js')

@parent

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.4/chart.umd.min.js"></script>

<script>

    const finance = @json($finance ?? []);
    const patientSeries = @json($patientSeries ?? []);
    const occupancyVal = {{ $occupancyPercent ?? 0 }};


    $(document).ready(function () {


        /* =========================================
           INCOME / EXPENSE CHART
        ========================================= */

        const incomeCanvas = document.getElementById('incomeExpenseChart');


        if (incomeCanvas) {

            const yearlyFinance = finance.yearly || {
                labels: [],
                income: [],
                expense: []
            };


            const ieChart = new Chart(incomeCanvas, {

                type: 'line',

                data: {

                    labels: yearlyFinance.labels,

                    datasets: [

                        {
                            label: 'ចំណូល',
                            data: yearlyFinance.income,
                            borderColor: '#006D36',
                            backgroundColor: 'rgba(0,109,54,0.07)',
                            tension: .4,
                            fill: true,
                            pointRadius: 3,
                            pointHoverRadius: 5,
                            borderWidth: 2
                        },

                        {
                            label: 'ចំណាយ',
                            data: yearlyFinance.expense,
                            borderColor: '#E0559C',
                            backgroundColor: 'rgba(224,85,156,0.05)',
                            tension: .4,
                            fill: true,
                            pointRadius: 3,
                            pointHoverRadius: 5,
                            borderWidth: 2
                        }

                    ]

                },

                options: {

                    responsive: true,

                    maintainAspectRatio: false,

                    interaction: {
                        intersect: false,
                        mode: 'index'
                    },

                    plugins: {

                        legend: {
                            display: false
                        },

                        tooltip: {

                            backgroundColor: '#1F2A24',
                            padding: 10,
                            cornerRadius: 8,

                            titleFont: {
                                size: 10
                            },

                            bodyFont: {
                                size: 10
                            },

                            callbacks: {

                                label: function (context) {

                                    return context.dataset.label +
                                        ': $' +
                                        Number(context.parsed.y)
                                            .toLocaleString(undefined, {
                                                minimumFractionDigits: 2
                                            });

                                }

                            }

                        }

                    },

                    scales: {

                        x: {

                            grid: {
                                display: false
                            },

                            border: {
                                display: false
                            },

                            ticks: {
                                color: '#8A9690',
                                font: {
                                    size: 9
                                }
                            }

                        },

                        y: {

                            display: false,

                            beginAtZero: true,

                            grid: {
                                display: false
                            }

                        }

                    }

                }

            });


            $('.income-range-btn').on('click', function () {

                $('.income-range-btn').removeClass('active');

                $(this).addClass('active');


                const range = $(this).data('range');

                const set = finance[range] || {
                    labels: [],
                    income: [],
                    expense: []
                };


                ieChart.data.labels = set.labels;

                ieChart.data.datasets[0].data = set.income;

                ieChart.data.datasets[1].data = set.expense;

                ieChart.update();

            });

        }


        /* =========================================
           OCCUPANCY DONUT
        ========================================= */

        const occupancyCanvas = document.getElementById('occupancyChart');


        if (occupancyCanvas) {

            const safeOccupancy = Math.min(
                100,
                Math.max(0, Number(occupancyVal) || 0)
            );


            new Chart(occupancyCanvas, {

                type: 'doughnut',

                data: {

                    datasets: [{

                        data: [
                            safeOccupancy,
                            Math.max(0, 100 - safeOccupancy)
                        ],

                        backgroundColor: [
                            '#006D36',
                            '#E7F4EC'
                        ],

                        borderWidth: 0

                    }]

                },

                options: {

                    responsive: false,

                    cutout: '78%',

                    plugins: {

                        legend: {
                            display: false
                        },

                        tooltip: {

                            backgroundColor: '#1F2A24',

                            callbacks: {

                                label: function (context) {

                                    return context.parsed + '%';

                                }

                            }

                        }

                    }

                }

            });

        }


        /* =========================================
           PATIENT CHART
        ========================================= */

        const patientCanvas = document.getElementById('weeklyChart');


        if (patientCanvas) {

            const weeklyPatients = patientSeries.weekly || {
                labels: [],
                data: []
            };


            const pChart = new Chart(patientCanvas, {

                type: 'bar',

                data: {

                    labels: weeklyPatients.labels,

                    datasets: [{

                        label: 'អ្នកជំងឺថ្មី',

                        data: weeklyPatients.data,

                        backgroundColor: 'rgba(0,109,54,0.12)',

                        borderColor: '#006D36',

                        borderWidth: 1.5,

                        borderRadius: 6,

                        hoverBackgroundColor: 'rgba(0,109,54,0.22)',

                        maxBarThickness: 38

                    }]

                },

                options: {

                    responsive: true,

                    maintainAspectRatio: false,

                    plugins: {

                        legend: {
                            display: false
                        },

                        tooltip: {

                            backgroundColor: '#1F2A24',

                            padding: 9,

                            cornerRadius: 8,

                            titleFont: {
                                size: 10
                            },

                            bodyFont: {
                                size: 10
                            }

                        }

                    },

                    scales: {

                        x: {

                            grid: {
                                display: false
                            },

                            border: {
                                display: false
                            },

                            ticks: {
                                color: '#8A9690',

                                font: {
                                    size: 9
                                }
                            }

                        },

                        y: {

                            display: false,

                            beginAtZero: true,

                            grid: {
                                display: false
                            }

                        }

                    }

                }

            });


            $('.patient-range-btn').on('click', function () {

                $('.patient-range-btn').removeClass('active');

                $(this).addClass('active');


                const range = $(this).data('range');

                const set = patientSeries[range] || {
                    labels: [],
                    data: []
                };


                pChart.data.labels = set.labels;

                pChart.data.datasets[0].data = set.data;

                pChart.update();

            });

        }

    });

</script>

@stop