@extends('adminlte::page')

@section('title', 'Nurse Dashboard')

@section('content')
<div class="container-fluid nurse-dashboard">

    {{-- HEADER --}}
    <div class="nurse-header mb-4">
        <div class="nurse-header-content">

            <div class="nurse-header-info">
                <div class="nurse-header-icon">
                    <i class="fas fa-user-nurse"></i>
                </div>

                <div>
                    <h2>ផ្ទាំងគ្រប់គ្រងគិលានុបដ្ឋាយិកា</h2>

                    <p>
                        <i class="fas fa-heartbeat mr-1"></i>
                        Nurse Dashboard
                        <span class="header-divider">•</span>
                        ការគ្រប់គ្រងអ្នកជំងឺ សម្រាកព្យាបាល បន្ទប់ និងការថែទាំអ្នកជំងឺ។
                    </p>
                </div>
            </div>

            <a href="{{ route('patients.create') }}" class="nurse-header-btn">
                <i class="fas fa-user-plus mr-2"></i>
                ចុះឈ្មោះអ្នកជំងឺ
            </a>

        </div>
    </div>


    {{-- STAT CARDS --}}
    <div class="row nurse-stats mb-4">

        {{-- OCCUPANCY --}}
        <div class="col-xl-3 col-md-6 mb-3">
            <div class="nurse-stat-card">

                <div class="nurse-stat-icon occupancy-icon">
                    <i class="fas fa-bed"></i>
                </div>

                <div class="nurse-stat-content">
                    <div class="nurse-stat-label">
                        អត្រាប្រើប្រាស់គ្រែ
                        <span>(Occupancy)</span>
                    </div>

                    <div class="nurse-stat-value occupancy-value">
                        {{ $occupancyRate }}%
                    </div>

                    <div class="nurse-stat-bottom occupancy-text">
                        <i class="fas fa-chart-pie mr-1"></i>
                        អត្រាការប្រើប្រាស់
                    </div>
                </div>

            </div>
        </div>


        {{-- OCCUPIED ROOMS --}}
        <div class="col-xl-3 col-md-6 mb-3">
            <div class="nurse-stat-card">

                <div class="nurse-stat-icon occupied-icon">
                    <i class="fas fa-procedures"></i>
                </div>

                <div class="nurse-stat-content">
                    <div class="nurse-stat-label">
                        បន្ទប់កំពុងប្រើ
                        <span>(Occupied)</span>
                    </div>

                    <div class="nurse-stat-value">
                        {{ $occupiedRooms }}
                        <span class="stat-total">/ {{ $totalRooms }}</span>
                    </div>

                    <div class="nurse-stat-bottom occupied-text">
                        <i class="fas fa-door-closed mr-1"></i>
                        បន្ទប់កំពុងប្រើប្រាស់
                    </div>
                </div>

            </div>
        </div>


        {{-- AVAILABLE ROOMS --}}
        <div class="col-xl-3 col-md-6 mb-3">
            <div class="nurse-stat-card">

                <div class="nurse-stat-icon available-icon">
                    <i class="fas fa-door-open"></i>
                </div>

                <div class="nurse-stat-content">
                    <div class="nurse-stat-label">
                        បន្ទប់ទំនេរ
                        <span>(Available)</span>
                    </div>

                    <div class="nurse-stat-value available-value">
                        {{ $availableRooms }}
                    </div>

                    <div class="nurse-stat-bottom available-text">
                        <i class="fas fa-check-circle mr-1"></i>
                        អាចទទួលអ្នកជំងឺបាន
                    </div>
                </div>

            </div>
        </div>


        {{-- INPATIENTS --}}
        <div class="col-xl-3 col-md-6 mb-3">
            <div class="nurse-stat-card">

                <div class="nurse-stat-icon inpatient-icon">
                    <i class="fas fa-user-injured"></i>
                </div>

                <div class="nurse-stat-content">
                    <div class="nurse-stat-label">
                        អ្នកជំងឺកំពុងសម្រាក
                        <span>(Inpatients)</span>
                    </div>

                    <div class="nurse-stat-value inpatient-value">
                        {{ $activeAdmissions->count() }}
                    </div>

                    <div class="nurse-stat-bottom inpatient-text">
                        <i class="fas fa-hospital-user mr-1"></i>
                        អ្នកជំងឺក្នុងមន្ទីរពេទ្យ
                    </div>
                </div>

            </div>
        </div>

    </div>


    {{-- MAIN CONTENT --}}
    <div class="row">

        {{-- ACTIVE INPATIENTS --}}
        <div class="col-xl-7 mb-4">

            <div class="nurse-panel h-100">

                <div class="nurse-panel-header">

                    <div class="nurse-panel-title">

                        <div class="panel-title-icon inpatient-panel-icon">
                            <i class="fas fa-procedures"></i>
                        </div>

                        <div>
                            <h5>អ្នកជំងឺកំពុងសម្រាកព្យាបាល</h5>
                            <span>Active Inpatients</span>
                        </div>

                    </div>

                    <div class="nurse-panel-count">
                        <i class="fas fa-user-injured mr-1"></i>
                        {{ $activeAdmissions->count() }}
                    </div>

                </div>


                <div class="nurse-table-wrapper">

                    <table class="table nurse-table mb-0">

                        <thead>
                            <tr>
                                <th class="pl-4">អ្នកជំងឺ</th>
                                <th>បន្ទប់</th>
                                <th>កាលបរិច្ឆេទចូល</th>
                                <th>ស្ថានភាព</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse($activeAdmissions as $adm)

                                <tr>

                                    {{-- PATIENT --}}
                                    <td class="pl-4">

                                        <div class="patient-info">

                                            <div class="patient-avatar">
                                                <i class="fas fa-user"></i>
                                            </div>

                                            <div>

                                                <div class="patient-name">
                                                    {{ $adm->patient->name ?? 'N/A' }}
                                                </div>

                                                <div class="patient-label">
                                                    Inpatient
                                                </div>

                                            </div>

                                        </div>

                                    </td>


                                    {{-- ROOM --}}
                                    <td>

                                        <span class="room-badge">
                                            <i class="fas fa-door-closed mr-1"></i>
                                            {{ $adm->room->room_number ?? 'Room' }}
                                        </span>

                                    </td>


                                    {{-- DATE --}}
                                    <td>

                                        <div class="admission-date">
                                            <i class="far fa-calendar-alt mr-1"></i>
                                            {{ optional($adm->admission_date)->format('Y-m-d H:i') }}
                                        </div>

                                    </td>


                                    {{-- STATUS --}}
                                    <td>

                                        <span class="nurse-status admitted-status">
                                            <span class="status-dot"></span>
                                            Admitted
                                        </span>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="4">

                                        <div class="nurse-empty">

                                            <div class="empty-icon">
                                                <i class="fas fa-bed"></i>
                                            </div>

                                            <div class="empty-title">
                                                គ្មានអ្នកជំងឺកំពុងសម្រាកព្យាបាលទេ
                                            </div>

                                            <div class="empty-text">
                                                បច្ចុប្បន្នមិនមានអ្នកជំងឺសម្រាកក្នុងបន្ទប់ទេ
                                            </div>

                                        </div>

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>


        {{-- RECENT PATIENTS --}}
        <div class="col-xl-5 mb-4">

            <div class="nurse-panel h-100">

                <div class="nurse-panel-header">

                    <div class="nurse-panel-title">

                        <div class="panel-title-icon patient-panel-icon">
                            <i class="fas fa-user-plus"></i>
                        </div>

                        <div>
                            <h5>អ្នកជំងឺចុះឈ្មោះថ្មីៗ</h5>
                            <span>Recent Patients</span>
                        </div>

                    </div>

                    <a href="{{ route('patients.index') }}"
                        class="nurse-view-all">
                        មើលទាំងអស់
                        <i class="fas fa-arrow-right ml-1"></i>
                    </a>

                </div>


                <div class="recent-patient-list">

                    @forelse($recentPatients as $pat)

                        <div class="recent-patient-item">

                            <div class="recent-patient-info">

                                <div class="recent-patient-avatar">
                                    <i class="fas fa-user"></i>
                                </div>

                                <div class="recent-patient-details">

                                    <div class="recent-patient-name">
                                        {{ $pat->name }}
                                    </div>

                                    <div class="recent-patient-meta">

                                        <span>
                                            <i class="fas fa-phone-alt mr-1"></i>
                                            {{ $pat->phone ?? 'No phone' }}
                                        </span>

                                        <span class="meta-divider">•</span>

                                        <span>
                                            <i class="fas fa-venus-mars mr-1"></i>
                                            {{ ucfirst($pat->gender ?? 'N/A') }}
                                        </span>

                                    </div>

                                </div>

                            </div>


                            <a href="{{ route('patients.show', $pat->patient_id) }}"
                                class="patient-view-btn"
                                title="មើលព័ត៌មានអ្នកជំងឺ">

                                <i class="fas fa-eye"></i>

                            </a>

                        </div>

                    @empty

                        <div class="nurse-empty recent-empty">

                            <div class="empty-icon">
                                <i class="fas fa-users"></i>
                            </div>

                            <div class="empty-title">
                                គ្មានទិន្នន័យអ្នកជំងឺថ្មីទេ
                            </div>

                            <div class="empty-text">
                                មិនមានអ្នកជំងឺចុះឈ្មោះថ្មីនៅពេលនេះទេ
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
    --nurse-green: #006D36;
    --nurse-green-dark: #00552B;
    --nurse-green-light: #E8F5EE;
    --nurse-bg: #F5F7F6;
    --nurse-border: #E7ECE9;
    --nurse-text: #1F2A24;
    --nurse-muted: #7A8780;
}


/* ================================
   PAGE
================================ */

.nurse-dashboard {
    padding-top: 8px;
    padding-bottom: 25px;
    background: var(--nurse-bg);
}


/* ================================
   HEADER
================================ */

.nurse-header {
    background: linear-gradient(135deg, #006D36 0%, #008747 100%);
    border-radius: 16px;
    color: #fff;
    overflow: hidden;
    box-shadow: 0 8px 24px rgba(0, 109, 54, .14);
}

.nurse-header-content {
    padding: 24px 28px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
}

.nurse-header-info {
    display: flex;
    align-items: center;
    min-width: 0;
}

.nurse-header-icon {
    width: 56px;
    height: 56px;
    min-width: 56px;
    border-radius: 15px;
    background: rgba(255,255,255,.15);
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 16px;
    font-size: 24px;
}

.nurse-header h2 {
    font-size: 23px;
    font-weight: 700;
    margin: 0 0 5px;
    line-height: 1.3;
}

.nurse-header p {
    margin: 0;
    font-size: 13px;
    color: rgba(255,255,255,.78);
}

.header-divider {
    margin: 0 7px;
    color: rgba(255,255,255,.45);
}

.nurse-header-btn {
    flex-shrink: 0;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background: #fff;
    color: var(--nurse-green);
    padding: 10px 18px;
    border-radius: 11px;
    font-size: 13px;
    font-weight: 700;
    text-decoration: none !important;
    transition: all .2s ease;
    box-shadow: 0 4px 12px rgba(0,0,0,.08);
}

.nurse-header-btn:hover {
    color: var(--nurse-green-dark);
    transform: translateY(-1px);
    box-shadow: 0 6px 16px rgba(0,0,0,.13);
}


/* ================================
   STAT CARDS
================================ */

.nurse-stat-card {
    height: 100%;
    min-height: 112px;
    background: #fff;
    border: 1px solid var(--nurse-border);
    border-radius: 14px;
    padding: 20px;
    display: flex;
    align-items: center;
    transition: all .2s ease;
    box-shadow: 0 3px 14px rgba(31,42,36,.04);
}

.nurse-stat-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 22px rgba(31,42,36,.08);
    border-color: #dce5e0;
}

.nurse-stat-icon {
    width: 52px;
    height: 52px;
    min-width: 52px;
    border-radius: 13px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 21px;
    margin-right: 15px;
}

.occupancy-icon {
    background: #FDECEF;
    color: #DC3545;
}

.occupied-icon {
    background: #FFF7E6;
    color: #D97706;
}

.available-icon {
    background: #E8F5EE;
    color: #198754;
}

.inpatient-icon {
    background: #E8F7FA;
    color: #0891B2;
}

.nurse-stat-content {
    min-width: 0;
}

.nurse-stat-label {
    color: var(--nurse-muted);
    font-size: 12px;
    font-weight: 600;
    margin-bottom: 3px;
}

.nurse-stat-label span {
    font-weight: 500;
    color: #9AA49F;
}

.nurse-stat-value {
    color: var(--nurse-text);
    font-size: 25px;
    line-height: 1.2;
    font-weight: 700;
}

.stat-total {
    color: #9AA49F;
    font-size: 17px;
    font-weight: 600;
}

.occupancy-value {
    color: #DC3545;
}

.available-value {
    color: #198754;
}

.inpatient-value {
    color: #0891B2;
}

.nurse-stat-bottom {
    margin-top: 4px;
    font-size: 11px;
    font-weight: 600;
}

.occupancy-text {
    color: #DC3545;
}

.occupied-text {
    color: #D97706;
}

.available-text {
    color: #198754;
}

.inpatient-text {
    color: #0891B2;
}


/* ================================
   PANEL
================================ */

.nurse-panel {
    background: #fff;
    border: 1px solid var(--nurse-border);
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 3px 14px rgba(31,42,36,.04);
}

.nurse-panel-header {
    min-height: 76px;
    padding: 16px 20px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    border-bottom: 1px solid #EEF1EF;
}

.nurse-panel-title {
    display: flex;
    align-items: center;
    min-width: 0;
}

.panel-title-icon {
    width: 38px;
    height: 38px;
    min-width: 38px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 11px;
    font-size: 15px;
}

.inpatient-panel-icon {
    background: #FDECEF;
    color: #DC3545;
}

.patient-panel-icon {
    background: #EAF2FF;
    color: #2563EB;
}

.nurse-panel-title h5 {
    margin: 0;
    color: var(--nurse-text);
    font-size: 15px;
    font-weight: 700;
}

.nurse-panel-title span {
    display: block;
    margin-top: 2px;
    color: var(--nurse-muted);
    font-size: 11px;
}

.nurse-panel-count {
    background: #FDECEF;
    color: #DC3545;
    border-radius: 8px;
    padding: 5px 9px;
    font-size: 12px;
    font-weight: 700;
    white-space: nowrap;
}

.nurse-view-all {
    color: var(--nurse-green);
    font-size: 11px;
    font-weight: 700;
    text-decoration: none !important;
    white-space: nowrap;
}

.nurse-view-all:hover {
    color: var(--nurse-green-dark);
}


/* ================================
   INPATIENT TABLE
================================ */

.nurse-table-wrapper {
    overflow-x: auto;
}

.nurse-table {
    width: 100%;
    min-width: 650px;
}

.nurse-table thead th {
    background: #F8FAF9;
    border-top: 0;
    border-bottom: 1px solid #E9EEEB;
    color: #7A8780;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .15px;
    padding: 11px 12px;
    white-space: nowrap;
}

.nurse-table tbody td {
    padding: 13px 12px;
    border-top: 1px solid #F0F2F1;
    vertical-align: middle;
    font-size: 12px;
}

.nurse-table tbody tr {
    transition: background .15s ease;
}

.nurse-table tbody tr:hover {
    background: #FAFCFB;
}


/* ================================
   PATIENT
================================ */

.patient-info {
    display: flex;
    align-items: center;
    min-width: 150px;
}

.patient-avatar {
    width: 35px;
    height: 35px;
    min-width: 35px;
    border-radius: 9px;
    background: #E8F5EE;
    color: var(--nurse-green);
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 9px;
    font-size: 13px;
}

.patient-name {
    color: #25312B;
    font-weight: 700;
    font-size: 12px;
}

.patient-label {
    color: #98A29D;
    font-size: 10px;
    margin-top: 1px;
}


/* ================================
   ROOM
================================ */

.room-badge {
    display: inline-flex;
    align-items: center;
    background: #FDECEF;
    color: #C82333;
    border-radius: 8px;
    padding: 6px 9px;
    font-size: 10px;
    font-weight: 700;
    white-space: nowrap;
}

.admission-date {
    color: #7A8780;
    font-size: 10px;
    white-space: nowrap;
}

.nurse-status {
    display: inline-flex;
    align-items: center;
    padding: 5px 8px;
    border-radius: 7px;
    font-size: 10px;
    font-weight: 700;
    white-space: nowrap;
}

.admitted-status {
    background: #FFF7E6;
    color: #B7791F;
}

.status-dot {
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background: #D97706;
    margin-right: 5px;
}


/* ================================
   RECENT PATIENTS
================================ */

.recent-patient-list {
    background: #fff;
}

.recent-patient-item {
    padding: 14px 20px;
    border-bottom: 1px solid #F0F2F1;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    transition: background .15s ease;
}

.recent-patient-item:last-child {
    border-bottom: 0;
}

.recent-patient-item:hover {
    background: #FAFCFB;
}

.recent-patient-info {
    display: flex;
    align-items: center;
    min-width: 0;
}

.recent-patient-avatar {
    width: 38px;
    height: 38px;
    min-width: 38px;
    border-radius: 10px;
    background: #EAF2FF;
    color: #2563EB;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 11px;
    font-size: 13px;
}

.recent-patient-details {
    min-width: 0;
}

.recent-patient-name {
    color: var(--nurse-text);
    font-size: 12px;
    font-weight: 700;
}

.recent-patient-meta {
    display: flex;
    align-items: center;
    gap: 4px;
    color: #89948E;
    font-size: 10px;
    margin-top: 4px;
    white-space: nowrap;
}

.meta-divider {
    color: #C4CCC8;
    margin: 0 2px;
}

.patient-view-btn {
    width: 32px;
    height: 32px;
    min-width: 32px;
    border-radius: 8px;
    background: #F0F7F3;
    color: var(--nurse-green);
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none !important;
    font-size: 12px;
    transition: all .2s ease;
}

.patient-view-btn:hover {
    background: var(--nurse-green);
    color: #fff;
}


/* ================================
   EMPTY STATES
================================ */

.nurse-empty {
    text-align: center;
    padding: 42px 20px;
}

.recent-empty {
    padding: 45px 20px;
}

.empty-icon {
    width: 50px;
    height: 50px;
    border-radius: 13px;
    background: #F1F5F3;
    color: #A0ABA5;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 10px;
    font-size: 19px;
}

.empty-title {
    color: #66736C;
    font-size: 12px;
    font-weight: 700;
}

.empty-text {
    color: #9AA49F;
    font-size: 10px;
    margin-top: 3px;
}


/* ================================
   RESPONSIVE
================================ */

@media (max-width: 1199.98px) {

    .nurse-stat-card {
        min-height: 105px;
    }

}


@media (max-width: 991.98px) {

    .nurse-header-content {
        align-items: flex-start;
    }

    .nurse-header h2 {
        font-size: 20px;
    }

    .nurse-header p {
        max-width: 600px;
    }

    .nurse-table {
        min-width: 650px;
    }

}


@media (max-width: 767.98px) {

    .nurse-dashboard {
        padding-top: 3px;
    }

    .nurse-header-content {
        padding: 20px;
        flex-direction: column;
        align-items: stretch;
    }

    .nurse-header-info {
        align-items: flex-start;
    }

    .nurse-header-icon {
        width: 48px;
        height: 48px;
        min-width: 48px;
        font-size: 20px;
    }

    .nurse-header h2 {
        font-size: 18px;
    }

    .nurse-header p {
        font-size: 11px;
        line-height: 1.6;
    }

    .header-divider {
        display: none;
    }

    .nurse-header-btn {
        width: 100%;
    }

    .nurse-panel-header {
        padding: 14px 16px;
    }

    .nurse-panel-title h5 {
        font-size: 13px;
    }

    .nurse-panel-title span {
        font-size: 10px;
    }

    .nurse-stat-card {
        padding: 16px;
    }

    .nurse-stat-value {
        font-size: 22px;
    }

}


@media (max-width: 575.98px) {

    .nurse-header-icon {
        display: none;
    }

    .nurse-header h2 {
        font-size: 17px;
    }

    .nurse-header p {
        font-size: 10px;
    }

    .nurse-stat-icon {
        width: 46px;
        height: 46px;
        min-width: 46px;
        font-size: 18px;
        margin-right: 12px;
    }

    .nurse-stat-label {
        font-size: 11px;
    }

    .nurse-stat-value {
        font-size: 21px;
    }

    .nurse-stat-bottom {
        font-size: 10px;
    }

    .recent-patient-meta {
        display: block;
        line-height: 1.6;
        white-space: normal;
    }

    .meta-divider {
        display: none;
    }

}
</style>
@stop