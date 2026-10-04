@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content')

<div class="dashboard-page">

    {{-- =========================
        DASHBOARD HEADER
    ========================== --}}
    <div class="dashboard-hero">
        <div class="hero-content">
            <div class="hero-icon">
                <i class="fas fa-hospital-alt"></i>
            </div>

            <div>
                <div class="hero-label">
                    <i class="fas fa-chart-line"></i>
                    ADMIN DASHBOARD
                </div>

                <h1>ផ្ទាំងគ្រប់គ្រងប្រព័ន្ធ</h1>

                <p>
                    ស្វាគមន៍មកកាន់ប្រព័ន្ធគ្រប់គ្រងមន្ទីរពេទ្យ
                    និងត្រួតពិនិត្យស្ថានភាពប្រព័ន្ធរបស់អ្នក។
                </p>
            </div>
        </div>

        <div class="hero-status">
            <span class="status-dot"></span>
            ប្រព័ន្ធដំណើរការ
        </div>
    </div>


    {{-- =========================
        STAT CARDS
    ========================== --}}
    <div class="row dashboard-stats">

        {{-- Patients --}}
        <div class="col-xl col-lg-4 col-md-6 mb-3">
            <div class="stat-card patients-card">

                <div class="stat-top">
                    <div class="stat-icon">
                        <i class="fas fa-user-injured"></i>
                    </div>

                    <span class="stat-badge">
                        <i class="fas fa-check"></i>
                        សកម្ម
                    </span>
                </div>

                <div class="stat-title">
                    អ្នកជំងឺសរុប
                </div>

                <div class="stat-number">
                    {{ number_format($totalPatients ?? 0) }}
                </div>

                <a href="{{ route('patients.index') }}" class="stat-link">
                    គ្រប់គ្រងអ្នកជំងឺ
                    <i class="fas fa-arrow-right"></i>
                </a>

            </div>
        </div>


        {{-- Users --}}
        <div class="col-xl col-lg-4 col-md-6 mb-3">
            <div class="stat-card users-card">

                <div class="stat-top">
                    <div class="stat-icon">
                        <i class="fas fa-users-cog"></i>
                    </div>

                    <span class="stat-badge blue">
                        <i class="fas fa-user-shield"></i>
                        សរុប
                    </span>
                </div>

                <div class="stat-title">
                    អ្នកប្រើប្រាស់
                </div>

                <div class="stat-number">
                    {{ number_format($totalUsers ?? 0) }}
                </div>

                <a href="{{ route('user.index') }}" class="stat-link">
                    គ្រប់គ្រងអ្នកប្រើប្រាស់
                    <i class="fas fa-arrow-right"></i>
                </a>

            </div>
        </div>


        {{-- Medicines --}}
        <div class="col-xl col-lg-4 col-md-6 mb-3">
            <div class="stat-card medicine-card">

                <div class="stat-top">
                    <div class="stat-icon">
                        <i class="fas fa-pills"></i>
                    </div>

                    <span class="stat-badge orange">
                        <i class="fas fa-boxes"></i>
                        ស្តុក
                    </span>
                </div>

                <div class="stat-title">
                    ថ្នាំសរុប
                </div>

                <div class="stat-number">
                    {{ number_format($totalMedicines ?? 0) }}
                </div>

                <a href="{{ route('pharmacy.index') }}" class="stat-link">
                    ចូលឱសថស្ថាន
                    <i class="fas fa-arrow-right"></i>
                </a>

            </div>
        </div>


        {{-- Today Revenue --}}
        <div class="col-xl col-lg-4 col-md-6 mb-3">
            <div class="stat-card revenue-card">

                <div class="stat-top">
                    <div class="stat-icon">
                        <i class="fas fa-wallet"></i>
                    </div>

                    <span class="stat-badge">
                        <i class="fas fa-calendar-day"></i>
                        ថ្ងៃនេះ
                    </span>
                </div>

                <div class="stat-title">
                    ចំណូលប្រចាំថ្ងៃ
                </div>

                <div class="stat-number money">
                    ${{ number_format($todayRevenue ?? 0, 2) }}
                </div>

                <a href="{{ route('billing.index') }}" class="stat-link">
                    មើលការទូទាត់
                    <i class="fas fa-arrow-right"></i>
                </a>

            </div>
        </div>


        {{-- Total Revenue --}}
        <div class="col-xl col-lg-4 col-md-6 mb-3">
            <div class="stat-card total-card">

                <div class="stat-top">
                    <div class="stat-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>

                    <span class="stat-badge">
                        <i class="fas fa-chart-line"></i>
                        សរុប
                    </span>
                </div>

                <div class="stat-title">
                    ចំណូលសរុប
                </div>

                <div class="stat-number money">
                    ${{ number_format($totalRevenue ?? 0, 2) }}
                </div>

                <a href="{{ route('billing.index') }}" class="stat-link">
                    មើលការទូទាត់
                    <i class="fas fa-arrow-right"></i>
                </a>

            </div>
        </div>

    </div>


    {{-- =========================
        MIDDLE SECTION
    ========================== --}}
    <div class="row">

        {{-- Finance --}}
        <div class="col-lg-7 mb-3">

            <div class="dashboard-card finance-card">

                <div class="card-header-custom">

                    <div>
                        <div class="section-label">
                            <i class="fas fa-chart-area"></i>
                            FINANCIAL OVERVIEW
                        </div>

                        <h3>
                            ចំណូល និង ចំណាយ
                        </h3>

                        <p>
                            ស្ថិតិហិរញ្ញវត្ថុរបស់ប្រព័ន្ធ
                        </p>
                    </div>

                    <div class="range-toggle">
                        <button
                            type="button"
                            class="range-btn income-range-btn active"
                            data-range="yearly">
                            ប្រចាំឆ្នាំ
                        </button>

                        <button
                            type="button"
                            class="range-btn income-range-btn"
                            data-range="monthly">
                            ប្រចាំខែ
                        </button>
                    </div>

                </div>

                <div class="chart-area finance-chart">
                    <canvas id="incomeExpenseChart"></canvas>
                </div>

                <div class="chart-footer">
                    <span>
                        <i class="legend green"></i>
                        ចំណូល
                    </span>

                    <span>
                        <i class="legend pink"></i>
                        ចំណាយ
                    </span>
                </div>

            </div>

        </div>


        {{-- Today's Activity --}}
        <div class="col-lg-5 mb-3">

            <div class="dashboard-card today-card">

                <div class="card-header-custom">

                    <div>
                        <div class="section-label">
                            <i class="fas fa-bolt"></i>
                            DAILY ACTIVITY
                        </div>

                        <h3>
                            សកម្មភាពថ្ងៃនេះ
                        </h3>

                        <p>
                            ស្ថានភាពប្រចាំថ្ងៃ
                        </p>
                    </div>

                    <span class="today-badge">
                        <i class="fas fa-calendar-day"></i>
                        ថ្ងៃនេះ
                    </span>

                </div>


                <div class="activity-list">

                    <div class="activity-item">
                        <div class="activity-icon green-soft">
                            <i class="fas fa-calendar-check"></i>
                        </div>

                        <div class="activity-info">
                            <span>ការណាត់ជួប</span>
                            <strong>{{ $todayAppointments ?? 0 }}</strong>
                        </div>

                        <i class="fas fa-chevron-right activity-arrow"></i>
                    </div>


                    <div class="activity-item">
                        <div class="activity-icon red-soft">
                            <i class="fas fa-notes-medical"></i>
                        </div>

                        <div class="activity-info">
                            <span>ករណីបន្ទាន់</span>
                            <strong>{{ $emergencyCases ?? 0 }}</strong>
                        </div>

                        <i class="fas fa-chevron-right activity-arrow"></i>
                    </div>


                    <div class="activity-item">
                        <div class="activity-icon blue-soft">
                            <i class="fas fa-bed"></i>
                        </div>

                        <div class="activity-info">
                            <span>បន្ទប់ទំនេរ</span>
                            <strong>{{ $availableRooms ?? 0 }}</strong>
                        </div>

                        <i class="fas fa-chevron-right activity-arrow"></i>
                    </div>

                </div>


                <a href="{{ route('appointment.index') }}" class="view-more">
                    មើលការណាត់ជួបទាំងអស់
                    <i class="fas fa-arrow-right"></i>
                </a>

            </div>

        </div>

    </div>


    {{-- =========================
        ROOM + PATIENT
    ========================== --}}
    <div class="row">

        {{-- Occupancy --}}
        <div class="col-lg-4 mb-3">

            <div class="dashboard-card occupancy-card">

                <div class="card-header-custom">

                    <div>
                        <div class="section-label">
                            <i class="fas fa-bed"></i>
                            ROOM STATUS
                        </div>

                        <h3>
                            ចំនួនគ្រែ
                        </h3>

                        <p>
                            ស្ថានភាពបន្ទប់
                        </p>
                    </div>

                </div>


                <div class="occupancy-chart">

                    <canvas
                        id="occupancyChart"
                        width="180"
                        height="180">
                    </canvas>

                    <div class="occupancy-center">
                        <strong>
                            {{ $occupancyPercent ?? 0 }}%
                        </strong>

                        <span>
                            កំពុងប្រើ
                        </span>
                    </div>

                </div>


                <div class="occupancy-stats">

                    <div class="occupancy-stat">
                        <div class="small-icon blue-soft">
                            <i class="fas fa-bed"></i>
                        </div>

                        <div>
                            <span>បន្ទប់សរុប</span>
                            <strong>
                                {{ number_format($totalRooms ?? 0) }}
                            </strong>
                        </div>
                    </div>


                    <div class="occupancy-stat">
                        <div class="small-icon green-soft">
                            <i class="fas fa-check"></i>
                        </div>

                        <div>
                            <span>នៅសល់</span>
                            <strong class="available">
                                {{ $availableRooms ?? 0 }}
                            </strong>
                        </div>
                    </div>

                </div>

            </div>

        </div>


        {{-- Patient Progress --}}
        <div class="col-lg-8 mb-3">

            <div class="dashboard-card">

                <div class="card-header-custom">

                    <div>
                        <div class="section-label">
                            <i class="fas fa-users"></i>
                            PATIENT ANALYTICS
                        </div>

                        <h3>
                            ការវិវត្តអ្នកជំងឺ
                        </h3>

                        <p>
                            ចំនួនអ្នកជំងឺថ្មី
                        </p>
                    </div>


                    <div class="range-toggle">
                        <button
                            type="button"
                            class="range-btn patient-range-btn active"
                            data-range="weekly">
                            ប្រចាំសប្តាហ៍
                        </button>

                        <button
                            type="button"
                            class="range-btn patient-range-btn"
                            data-range="monthly">
                            ប្រចាំខែ
                        </button>
                    </div>

                </div>


                <div class="chart-area patient-chart">
                    <canvas id="weeklyChart"></canvas>
                </div>

            </div>

        </div>

    </div>


    {{-- =========================
        DEPARTMENTS
    ========================== --}}
    <div class="row">

        <div class="col-12 mb-3">

            <div class="dashboard-card">

                <div class="card-header-custom">

                    <div>
                        <div class="section-label">
                            <i class="fas fa-hospital"></i>
                            DEPARTMENT OVERVIEW
                        </div>

                        <h3>
                            អ្នកជំងឺតាមផ្នែក
                        </h3>

                        <p>
                            ស្ថានភាពអ្នកជំងឺសកម្មតាមផ្នែក
                        </p>
                    </div>

                    <div class="department-header-icon">
                        <i class="fas fa-hospital-alt"></i>
                    </div>

                </div>


                <div class="department-grid">

                    @forelse($departmentBreakdown ?? [] as $dept)

                        <div class="department-item">

                            <div class="department-icon">
                                <i class="fas fa-heartbeat"></i>
                            </div>

                            <div class="department-info">

                                <div class="department-name">
                                    {{ $dept['name'] }}
                                </div>

                                <div class="department-sub">
                                    {{ $dept['total'] }} Patients Active
                                </div>

                                <div class="progress">
                                    <div
                                        class="progress-bar"
                                        style="width: {{ min(100, max(0, $dept['percent'])) }}%">
                                    </div>
                                </div>

                            </div>

                            <div class="department-percent">
                                {{ $dept['percent'] }}%
                            </div>

                        </div>

                    @empty

                        <div class="empty-department">

                            <div class="empty-icon">
                                <i class="fas fa-hospital"></i>
                            </div>

                            <div>
                                <strong>
                                    មិនទាន់មានទិន្នន័យ
                                </strong>

                                <span>
                                    ត្រូវកំណត់ department ទៅបន្ទប់សិន
                                </span>
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
    --green: #006D36;
    --green-dark: #00552B;
    --green-light: #EAF6EF;
    --text: #1F2A24;
    --muted: #7A8780;
    --border: #E5ECE8;
    --bg: #F4F7F5;
}

body {
    background: var(--bg) !important;
    color: var(--text);
}

.content-wrapper {
    background: var(--bg) !important;
}

.dashboard-page {
    padding: 18px 8px 25px;
}


/* =========================
   HERO
========================= */

.dashboard-hero {
    position: relative;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
    min-height: 150px;
    margin-bottom: 18px;
    padding: 25px 30px;
    border-radius: 20px;
    color: #fff;
    background:
        radial-gradient(circle at 90% 20%, rgba(255,255,255,.12) 0 90px, transparent 91px),
        radial-gradient(circle at 78% 120%, rgba(255,255,255,.08) 0 100px, transparent 101px),
        linear-gradient(135deg, #00552B 0%, #008747 100%);
    box-shadow: 0 12px 30px rgba(0,109,54,.16);
}

.dashboard-hero::after {
    content: "";
    position: absolute;
    width: 220px;
    height: 220px;
    right: -80px;
    top: -100px;
    border: 35px solid rgba(255,255,255,.05);
    border-radius: 50%;
}

.hero-content {
    position: relative;
    z-index: 2;
    display: flex;
    align-items: center;
    gap: 17px;
}

.hero-icon {
    width: 58px;
    height: 58px;
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(255,255,255,.15);
    border: 1px solid rgba(255,255,255,.18);
    font-size: 23px;
}

.hero-label {
    font-size: 10px;
    font-weight: 800;
    letter-spacing: .8px;
    opacity: .85;
}

.hero-label i {
    margin-right: 4px;
}

.dashboard-hero h1 {
    margin: 4px 0 2px;
    color: #fff;
    font-size: 25px;
    font-weight: 800;
}

.dashboard-hero p {
    margin: 0;
    max-width: 650px;
    color: rgba(255,255,255,.82);
    font-size: 11px;
}

.hero-status {
    position: relative;
    z-index: 2;
    display: inline-flex;
    align-items: center;
    gap: 7px;
    padding: 8px 13px;
    border-radius: 30px;
    background: rgba(255,255,255,.12);
    border: 1px solid rgba(255,255,255,.15);
    color: #fff;
    font-size: 10px;
    font-weight: 700;
    white-space: nowrap;
}

.status-dot {
    width: 7px;
    height: 7px;
    border-radius: 50%;
    background: #8CFFBD;
    box-shadow: 0 0 0 4px rgba(140,255,189,.12);
}


/* =========================
   STAT CARDS
========================= */

.dashboard-stats {
    margin-bottom: 2px;
}

.stat-card {
    position: relative;
    height: 100%;
    min-height: 168px;
    overflow: hidden;
    padding: 17px;
    border: 1px solid var(--border);
    border-radius: 16px;
    background: #fff;
    box-shadow: 0 4px 18px rgba(31,42,36,.045);
    transition: .22s ease;
}

.stat-card::before {
    content: "";
    position: absolute;
    left: 0;
    top: 0;
    width: 100%;
    height: 3px;
    background: var(--green);
}

.stat-card::after {
    content: "";
    position: absolute;
    right: -30px;
    bottom: -35px;
    width: 100px;
    height: 100px;
    border-radius: 50%;
    background: var(--green-light);
    opacity: .6;
}

.stat-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 28px rgba(31,42,36,.09);
}

.stat-top {
    position: relative;
    z-index: 2;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.stat-icon {
    width: 42px;
    height: 42px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: var(--green-light);
    color: var(--green);
    font-size: 16px;
}

.users-card .stat-icon {
    background: #EAF2FF;
    color: #367BD5;
}

.medicine-card .stat-icon {
    background: #FFF4E3;
    color: #D88918;
}

.revenue-card .stat-icon {
    background: #E5F8F1;
    color: #15946D;
}

.total-card .stat-icon {
    background: #EAF6EF;
    color: var(--green);
}

.stat-badge {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 5px 8px;
    border-radius: 20px;
    background: #EAF7EF;
    color: #21844B;
    font-size: 8px;
    font-weight: 750;
}

.stat-badge.blue {
    background: #EDF5FF;
    color: #3478C8;
}

.stat-badge.orange {
    background: #FFF6E6;
    color: #B7791F;
}

.stat-title {
    position: relative;
    z-index: 2;
    margin-top: 17px;
    color: var(--muted);
    font-size: 11px;
    font-weight: 600;
}

.stat-number {
    position: relative;
    z-index: 2;
    margin-top: 3px;
    color: var(--text);
    font-size: 24px;
    line-height: 1.2;
    font-weight: 800;
}

.stat-number.money {
    font-size: 21px;
}

.stat-link {
    position: relative;
    z-index: 3;
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-top: 13px;
    padding: 7px 9px;
    border-radius: 8px;
    background: #F6F8F7;
    color: #526058;
    font-size: 9px;
    font-weight: 700;
    text-decoration: none !important;
    transition: .2s ease;
}

.stat-link:hover {
    background: var(--green-light);
    color: var(--green);
}

.stat-link i {
    font-size: 8px;
    transition: .2s ease;
}

.stat-link:hover i {
    transform: translateX(3px);
}


/* =========================
   DASHBOARD CARD
========================= */

.dashboard-card {
    height: 100%;
    padding: 19px;
    border: 1px solid var(--border);
    border-radius: 17px;
    background: #fff;
    box-shadow: 0 4px 18px rgba(31,42,36,.045);
}

.card-header-custom {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 15px;
    margin-bottom: 12px;
}

.section-label {
    color: var(--green);
    font-size: 8px;
    font-weight: 800;
    letter-spacing: .7px;
}

.section-label i {
    margin-right: 3px;
}

.card-header-custom h3 {
    margin: 4px 0 0;
    color: var(--text);
    font-size: 15px;
    font-weight: 800;
}

.card-header-custom p {
    margin: 2px 0 0;
    color: #9AA59F;
    font-size: 9px;
}

.range-toggle {
    display: flex;
    gap: 3px;
    padding: 3px;
    border: 1px solid #EDF1EE;
    border-radius: 9px;
    background: #F5F8F6;
}

.range-btn {
    border: 0;
    outline: none !important;
    padding: 6px 10px;
    border-radius: 7px;
    background: transparent;
    color: #8A9690;
    font-size: 9px;
    font-weight: 700;
    cursor: pointer;
    transition: .2s ease;
}

.range-btn:hover {
    color: var(--green);
}

.range-btn.active {
    background: #fff;
    color: var(--green);
    box-shadow: 0 2px 7px rgba(31,42,36,.08);
}


/* =========================
   CHARTS
========================= */

.chart-area {
    position: relative;
    width: 100%;
}

.finance-chart {
    height: 245px;
}

.patient-chart {
    height: 255px;
}

.chart-area canvas {
    width: 100% !important;
    height: 100% !important;
}

.chart-footer {
    display: flex;
    justify-content: center;
    gap: 25px;
    margin-top: 2px;
    color: var(--muted);
    font-size: 9px;
}

.chart-footer span {
    display: flex;
    align-items: center;
}

.legend {
    width: 8px;
    height: 8px;
    margin-right: 5px;
    border-radius: 50%;
    display: inline-block;
}

.legend.green {
    background: var(--green);
}

.legend.pink {
    background: #E0559C;
}


/* =========================
   TODAY ACTIVITY
========================= */

.today-badge {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 6px 9px;
    border-radius: 9px;
    background: var(--green-light);
    color: var(--green);
    font-size: 9px;
    font-weight: 750;
}

.activity-list {
    margin-top: 5px;
}

.activity-item {
    display: flex;
    align-items: center;
    gap: 11px;
    padding: 14px 0;
    border-bottom: 1px solid var(--border);
}

.activity-item:last-child {
    border-bottom: 0;
}

.activity-icon {
    width: 40px;
    height: 40px;
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 11px;
    font-size: 14px;
}

.green-soft {
    background: #EAF7EF;
    color: var(--green);
}

.red-soft {
    background: #FDEBEC;
    color: #DC4558;
}

.blue-soft {
    background: #EAF2FF;
    color: #3478C8;
}

.activity-info {
    flex: 1;
}

.activity-info span {
    display: block;
    color: var(--muted);
    font-size: 10px;
}

.activity-info strong {
    display: block;
    margin-top: 2px;
    color: var(--text);
    font-size: 16px;
    font-weight: 800;
}

.activity-arrow {
    color: #C4CDC8;
    font-size: 9px;
}

.view-more {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 7px;
    margin-top: 9px;
    padding: 9px;
    border: 1px solid #E6EBE8;
    border-radius: 9px;
    background: #F7F9F8;
    color: #526058;
    font-size: 9px;
    font-weight: 700;
    text-decoration: none !important;
    transition: .2s ease;
}

.view-more:hover {
    background: var(--green-light);
    color: var(--green);
}


/* =========================
   OCCUPANCY
========================= */

.occupancy-card {
    text-align: center;
}

.occupancy-card .card-header-custom {
    text-align: left;
}

.occupancy-chart {
    position: relative;
    width: 180px;
    height: 180px;
    margin: 8px auto 17px;
}

.occupancy-chart canvas {
    width: 180px !important;
    height: 180px !important;
}

.occupancy-center {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    text-align: center;
}

.occupancy-center strong {
    display: block;
    color: var(--text);
    font-size: 25px;
    font-weight: 850;
}

.occupancy-center span {
    color: var(--muted);
    font-size: 9px;
}

.occupancy-stats {
    display: flex;
    gap: 8px;
}

.occupancy-stat {
    flex: 1;
    display: flex;
    align-items: center;
    gap: 7px;
    padding: 9px;
    border: 1px solid #EDF1EE;
    border-radius: 10px;
    background: #FAFBFA;
    text-align: left;
}

.small-icon {
    width: 30px;
    height: 30px;
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 8px;
    font-size: 10px;
}

.occupancy-stat span {
    display: block;
    color: var(--muted);
    font-size: 8px;
}

.occupancy-stat strong {
    display: block;
    margin-top: 1px;
    color: var(--text);
    font-size: 13px;
    font-weight: 800;
}

.occupancy-stat strong.available {
    color: #21844B;
}


/* =========================
   DEPARTMENT
========================= */

.department-header-icon {
    width: 34px;
    height: 34px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 9px;
    background: var(--green-light);
    color: var(--green);
    font-size: 12px;
}

.department-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 8px 20px;
}

.department-item {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 11px 0;
    border-bottom: 1px solid var(--border);
}

.department-icon {
    width: 38px;
    height: 38px;
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 10px;
    background: #FCE9EC;
    color: #E0556B;
    font-size: 12px;
}

.department-info {
    flex: 1;
    min-width: 0;
}

.department-name {
    color: var(--text);
    font-size: 10px;
    font-weight: 750;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.department-sub {
    margin-top: 2px;
    color: #9AA59F;
    font-size: 8px;
}

.department-info .progress {
    height: 4px;
    margin-top: 6px;
    overflow: hidden;
    border-radius: 10px;
    background: #EDF2EF;
}

.department-info .progress-bar {
    border-radius: 10px;
    background: linear-gradient(90deg, #006D36, #26A269);
}

.department-percent {
    padding: 5px 8px;
    border-radius: 7px;
    background: var(--green-light);
    color: var(--green);
    font-size: 9px;
    font-weight: 800;
}

.empty-department {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 25px 5px;
}

.empty-icon {
    width: 42px;
    height: 42px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 11px;
    background: #F3F5F4;
    color: #9AA59F;
}

.empty-department strong {
    display: block;
    color: #59665F;
    font-size: 10px;
}

.empty-department span {
    display: block;
    margin-top: 3px;
    color: #9AA59F;
    font-size: 8px;
}


/* =========================
   RESPONSIVE
========================= */

@media (max-width: 1199.98px) {

    .dashboard-hero {
        padding: 22px;
    }

    .stat-card {
        min-height: 160px;
    }

    .stat-number {
        font-size: 21px;
    }

}

@media (max-width: 991.98px) {

    .dashboard-page {
        padding: 12px 5px 20px;
    }

    .dashboard-hero {
        min-height: 135px;
    }

    .hero-status {
        display: none;
    }

    .finance-chart,
    .patient-chart {
        height: 230px;
    }

}

@media (max-width: 767.98px) {

    .dashboard-hero {
        padding: 20px;
        border-radius: 15px;
    }

    .hero-icon {
        width: 48px;
        height: 48px;
        border-radius: 13px;
        font-size: 18px;
    }

    .dashboard-hero h1 {
        font-size: 20px;
    }

    .dashboard-hero p {
        font-size: 9px;
    }

    .card-header-custom {
        flex-wrap: wrap;
    }

    .range-toggle {
        margin-left: auto;
    }

    .department-grid {
        grid-template-columns: 1fr;
    }

}

@media (max-width: 575.98px) {

    .dashboard-hero {
        padding: 17px;
    }

    .hero-content {
        gap: 10px;
    }

    .hero-icon {
        width: 42px;
        height: 42px;
        font-size: 16px;
    }

    .dashboard-hero h1 {
        font-size: 17px;
    }

    .dashboard-hero p {
        display: none;
    }

    .dashboard-card {
        padding: 14px;
        border-radius: 13px;
    }

    .stat-card {
        min-height: 150px;
        padding: 14px;
        border-radius: 13px;
    }

    .stat-number {
        font-size: 19px;
    }

    .stat-number.money {
        font-size: 17px;
    }

    .finance-chart,
    .patient-chart {
        height: 205px;
    }

    .occupancy-chart {
        width: 155px;
        height: 155px;
    }

    .occupancy-chart canvas {
        width: 155px !important;
        height: 155px !important;
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

    /* =========================
       INCOME / EXPENSE
    ========================== */

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
                        backgroundColor: 'rgba(0,109,54,.08)',
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
                        backgroundColor: 'rgba(224,85,156,.05)',
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


    /* =========================
       OCCUPANCY
    ========================== */

    const occupancyCanvas =
        document.getElementById('occupancyChart');

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
                        '#E5F1E9'
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


    /* =========================
       PATIENT CHART
    ========================== */

    const patientCanvas =
        document.getElementById('weeklyChart');

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

                    backgroundColor: 'rgba(0,109,54,.14)',
                    borderColor: '#006D36',
                    borderWidth: 1.5,
                    borderRadius: 7,
                    hoverBackgroundColor: 'rgba(0,109,54,.25)',
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
                        cornerRadius: 8

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