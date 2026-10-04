@extends('adminlte::page')

@section('title', 'Doctor Dashboard')

@section('content')
<div class="container-fluid doctor-dashboard">

    {{-- HEADER --}}
    <div class="doctor-header mb-4">
        <div class="doctor-header-content">
            <div class="doctor-header-info">
                <div class="doctor-header-icon">
                    <i class="fas fa-user-md"></i>
                </div>

                <div>
                    <h2>ផ្ទាំងគ្រប់គ្រងវេជ្ជបណ្ឌិត</h2>
                    <p>
                        <i class="fas fa-stethoscope mr-1"></i>
                        Doctor Dashboard
                        <span class="header-divider">•</span>
                        សូមស្វាគមន៍! ខាងក្រោមនេះជាព័ត៌មានការណាត់ជួប និងពិនិត្យជំងឺប្រចាំថ្ងៃរបស់អ្នក។
                    </p>
                </div>
            </div>

            <a href="{{ route('patients.index') }}" class="doctor-header-btn">
                <i class="fas fa-user-plus mr-2"></i>
                អ្នកជំងឺថ្មី
            </a>
        </div>
    </div>


    {{-- STAT CARDS --}}
    <div class="row doctor-stats mb-4">

        {{-- TODAY APPOINTMENTS --}}
        <div class="col-xl-4 col-md-6 mb-3">
            <div class="doctor-stat-card">
                <div class="doctor-stat-icon appointment-icon">
                    <i class="fas fa-calendar-check"></i>
                </div>

                <div class="doctor-stat-content">
                    <div class="doctor-stat-label">
                        ការណាត់ជួបថ្ងៃនេះ
                        <span>(Today)</span>
                    </div>

                    <div class="doctor-stat-value">
                        {{ $todayAppointmentsCount }}
                    </div>

                    <div class="doctor-stat-bottom appointment-text">
                        <i class="fas fa-calendar-day mr-1"></i>
                        ការណាត់ជួបសម្រាប់ថ្ងៃនេះ
                    </div>
                </div>
            </div>
        </div>


        {{-- PENDING --}}
        <div class="col-xl-4 col-md-6 mb-3">
            <div class="doctor-stat-card">
                <div class="doctor-stat-icon pending-icon">
                    <i class="fas fa-clock"></i>
                </div>

                <div class="doctor-stat-content">
                    <div class="doctor-stat-label">
                        រង់ចាំការពិនិត្យ
                        <span>(Pending)</span>
                    </div>

                    <div class="doctor-stat-value">
                        {{ $pendingAppointments->count() }}
                    </div>

                    <div class="doctor-stat-bottom pending-text">
                        <i class="fas fa-hourglass-half mr-1"></i>
                        អ្នកជំងឺកំពុងរង់ចាំ
                    </div>
                </div>
            </div>
        </div>


        {{-- LAB ORDERS --}}
        <div class="col-xl-4 col-md-6 mb-3">
            <div class="doctor-stat-card">
                <div class="doctor-stat-icon lab-icon">
                    <i class="fas fa-vials"></i>
                </div>

                <div class="doctor-stat-content">
                    <div class="doctor-stat-label">
                        សំណើពិសោធន៍រង់ចាំ
                        <span>(Lab Orders)</span>
                    </div>

                    <div class="doctor-stat-value">
                        {{ $pendingLabOrders->count() }}
                    </div>

                    <div class="doctor-stat-bottom lab-text">
                        <i class="fas fa-flask mr-1"></i>
                        សំណើត្រូវពិនិត្យ
                    </div>
                </div>
            </div>
        </div>

    </div>


    {{-- MAIN CONTENT --}}
    <div class="row">

        {{-- TODAY APPOINTMENTS --}}
        <div class="col-xl-7 mb-4">
            <div class="doctor-panel h-100">

                <div class="doctor-panel-header">
                    <div class="doctor-panel-title">
                        <div class="panel-title-icon appointment-panel-icon">
                            <i class="fas fa-calendar-alt"></i>
                        </div>

                        <div>
                            <h5>ការណាត់ជួបថ្ងៃនេះ</h5>
                            <span>Today's Queue</span>
                        </div>
                    </div>

                    <div class="doctor-panel-count">
                        <i class="fas fa-users mr-1"></i>
                        {{ $todayAppointmentsCount }}
                    </div>
                </div>


                <div class="doctor-table-wrapper">
                    <table class="table doctor-table mb-0">
                        <thead>
                            <tr>
                                <th class="pl-4">អ្នកជំងឺ</th>
                                <th>ម៉ោង</th>
                                <th>មូលហេតុ</th>
                                <th>ស្ថានភាព</th>
                                <th class="text-right pr-4">សកម្មភាព</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($todayAppointments as $app)
                                <tr>

                                    <td class="pl-4">
                                        <div class="patient-info">
                                            <div class="patient-avatar">
                                                <i class="fas fa-user"></i>
                                            </div>

                                            <div>
                                                <div class="patient-name">
                                                    {{ $app->patient->name ?? 'N/A' }}
                                                </div>

                                                <div class="patient-label">
                                                    Patient
                                                </div>
                                            </div>
                                        </div>
                                    </td>


                                    <td>
                                        <div class="appointment-time">
                                            <i class="far fa-clock mr-1"></i>
                                            {{ optional($app->appointment_date)->format('H:i A') ?? '-' }}
                                        </div>
                                    </td>


                                    <td>
                                        <div class="reason-text">
                                            {{ Str::limit($app->reason ?? '-', 25) }}
                                        </div>
                                    </td>


                                    <td>
                                        <span class="doctor-status pending-status">
                                            <span class="status-dot"></span>
                                            រង់ចាំពិនិត្យ
                                        </span>
                                    </td>


                                    <td class="text-right pr-4">
                                        @if(isset($app->patient_id))
                                            <a href="{{ route('patients.show', $app->patient_id) }}"
                                                class="doctor-action-btn">
                                                <i class="fas fa-stethoscope mr-1"></i>
                                                ពិនិត្យ
                                            </a>
                                        @endif
                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td colspan="5">
                                        <div class="doctor-empty">
                                            <div class="empty-icon">
                                                <i class="fas fa-calendar-check"></i>
                                            </div>

                                            <div class="empty-title">
                                                គ្មានការណាត់ជួបសម្រាប់ថ្ងៃនេះទេ
                                            </div>

                                            <div class="empty-text">
                                                មិនមានអ្នកជំងឺរង់ចាំពិនិត្យនៅពេលនេះទេ
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


        {{-- RIGHT SIDE --}}
        <div class="col-xl-5 mb-4">

            {{-- PENDING LAB ORDERS --}}
            <div class="doctor-panel mb-4">

                <div class="doctor-panel-header">
                    <div class="doctor-panel-title">
                        <div class="panel-title-icon lab-panel-icon">
                            <i class="fas fa-flask"></i>
                        </div>

                        <div>
                            <h5>សំណើពិសោធន៍រង់ចាំ</h5>
                            <span>Pending Lab Orders</span>
                        </div>
                    </div>

                    <div class="doctor-panel-count lab-count">
                        {{ $pendingLabOrders->count() }}
                    </div>
                </div>


                <div class="doctor-table-wrapper">
                    <table class="table doctor-table lab-table mb-0">
                        <thead>
                            <tr>
                                <th class="pl-4">កូដសំណើ</th>
                                <th>អ្នកជំងឺ</th>
                                <th>កាលបរិច្ឆេទ</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($pendingLabOrders as $lab)
                                <tr>

                                    <td class="pl-4">
                                        <span class="lab-order-id">
                                            #LAB-{{ $lab->lab_order_id }}
                                        </span>
                                    </td>

                                    <td>
                                        <div class="lab-patient">
                                            <div class="mini-avatar">
                                                <i class="fas fa-user"></i>
                                            </div>

                                            <span>
                                                {{ $lab->medicalRecord->patient->name ?? 'N/A' }}
                                            </span>
                                        </div>
                                    </td>

                                    <td>
                                        <span class="lab-date">
                                            <i class="far fa-calendar-alt mr-1"></i>
                                            {{ optional($lab->order_date)->format('Y-m-d') }}
                                        </span>
                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td colspan="3">
                                        <div class="small-empty">
                                            <i class="fas fa-flask"></i>
                                            <span>គ្មានសំណើពិសោធន៍រង់ចាំទេ</span>
                                        </div>
                                    </td>
                                </tr>

                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>


            {{-- RECENT MEDICAL RECORDS --}}
            <div class="doctor-panel">

                <div class="doctor-panel-header">
                    <div class="doctor-panel-title">
                        <div class="panel-title-icon record-panel-icon">
                            <i class="fas fa-file-medical"></i>
                        </div>

                        <div>
                            <h5>កំណត់ត្រាវេជ្ជសាស្ត្រចុងក្រោយ</h5>
                            <span>Recent Medical Records</span>
                        </div>
                    </div>
                </div>


                <div class="medical-record-list">

                    @forelse($recentMedicalRecords as $rec)

                        <div class="medical-record-item">

                            <div class="record-patient">
                                <div class="record-avatar">
                                    <i class="fas fa-user"></i>
                                </div>

                                <div class="record-info">
                                    <div class="record-name">
                                        {{ $rec->patient->name ?? 'Patient' }}
                                    </div>

                                    <div class="record-diagnosis">
                                        <i class="fas fa-notes-medical mr-1"></i>
                                        {{ Str::limit($rec->diagnosis ?? 'No diagnosis recorded', 35) }}
                                    </div>
                                </div>
                            </div>


                            <a href="{{ route('medical-records.show', $rec->record_id) }}"
                                class="record-view-btn"
                                title="មើលព័ត៌មានលម្អិត">
                                <i class="fas fa-eye"></i>
                            </a>

                        </div>

                    @empty

                        <div class="medical-empty">
                            <div class="empty-icon">
                                <i class="fas fa-file-medical"></i>
                            </div>

                            <div class="empty-title">
                                គ្មានកំណត់ត្រាថ្មីៗទេ
                            </div>

                            <div class="empty-text">
                                មិនមានកំណត់ត្រាវេជ្ជសាស្ត្រថ្មីទេ
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
    --doctor-green: #006D36;
    --doctor-green-dark: #00552B;
    --doctor-green-light: #E8F5EE;
    --doctor-bg: #F5F7F6;
    --doctor-border: #E7ECE9;
    --doctor-text: #1F2A24;
    --doctor-muted: #7A8780;
}


/* ================================
   PAGE
================================ */

.doctor-dashboard {
    padding-top: 8px;
    padding-bottom: 25px;
    background: var(--doctor-bg);
}


/* ================================
   HEADER
================================ */

.doctor-header {
    background: linear-gradient(135deg, #006D36 0%, #008747 100%);
    border-radius: 16px;
    color: #fff;
    overflow: hidden;
    box-shadow: 0 8px 24px rgba(0, 109, 54, .14);
}

.doctor-header-content {
    padding: 24px 28px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
}

.doctor-header-info {
    display: flex;
    align-items: center;
    min-width: 0;
}

.doctor-header-icon {
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

.doctor-header h2 {
    font-size: 23px;
    font-weight: 700;
    margin: 0 0 5px;
    line-height: 1.3;
}

.doctor-header p {
    margin: 0;
    font-size: 13px;
    color: rgba(255,255,255,.78);
}

.header-divider {
    margin: 0 7px;
    color: rgba(255,255,255,.45);
}

.doctor-header-btn {
    flex-shrink: 0;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background: #fff;
    color: var(--doctor-green);
    padding: 10px 18px;
    border-radius: 11px;
    font-size: 13px;
    font-weight: 700;
    text-decoration: none !important;
    transition: all .2s ease;
    box-shadow: 0 4px 12px rgba(0,0,0,.08);
}

.doctor-header-btn:hover {
    color: var(--doctor-green-dark);
    transform: translateY(-1px);
    box-shadow: 0 6px 16px rgba(0,0,0,.13);
}


/* ================================
   STAT CARDS
================================ */

.doctor-stat-card {
    height: 100%;
    min-height: 112px;
    background: #fff;
    border: 1px solid var(--doctor-border);
    border-radius: 14px;
    padding: 20px;
    display: flex;
    align-items: center;
    transition: all .2s ease;
    box-shadow: 0 3px 14px rgba(31,42,36,.04);
}

.doctor-stat-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 22px rgba(31,42,36,.08);
    border-color: #dce5e0;
}

.doctor-stat-icon {
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

.appointment-icon {
    background: #EAF2FF;
    color: #2563EB;
}

.pending-icon {
    background: #FFF7E6;
    color: #D97706;
}

.lab-icon {
    background: #E8F7FA;
    color: #0891B2;
}

.doctor-stat-content {
    min-width: 0;
}

.doctor-stat-label {
    color: var(--doctor-muted);
    font-size: 12px;
    font-weight: 600;
    margin-bottom: 3px;
}

.doctor-stat-label span {
    font-weight: 500;
    color: #9AA49F;
}

.doctor-stat-value {
    color: var(--doctor-text);
    font-size: 25px;
    line-height: 1.2;
    font-weight: 700;
}

.doctor-stat-bottom {
    margin-top: 4px;
    font-size: 11px;
    font-weight: 600;
}

.appointment-text {
    color: #2563EB;
}

.pending-text {
    color: #D97706;
}

.lab-text {
    color: #0891B2;
}


/* ================================
   PANELS
================================ */

.doctor-panel {
    background: #fff;
    border: 1px solid var(--doctor-border);
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 3px 14px rgba(31,42,36,.04);
}

.doctor-panel-header {
    min-height: 76px;
    padding: 16px 20px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    border-bottom: 1px solid #EEF1EF;
}

.doctor-panel-title {
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

.appointment-panel-icon {
    background: #EAF2FF;
    color: #2563EB;
}

.lab-panel-icon {
    background: #E8F7FA;
    color: #0891B2;
}

.record-panel-icon {
    background: #E8F5EE;
    color: var(--doctor-green);
}

.doctor-panel-title h5 {
    margin: 0;
    color: var(--doctor-text);
    font-size: 15px;
    font-weight: 700;
}

.doctor-panel-title span {
    display: block;
    margin-top: 2px;
    color: var(--doctor-muted);
    font-size: 11px;
}

.doctor-panel-count {
    background: #EEF5F1;
    color: var(--doctor-green);
    border-radius: 8px;
    padding: 5px 9px;
    font-size: 12px;
    font-weight: 700;
    white-space: nowrap;
}

.doctor-panel-count.lab-count {
    background: #E8F7FA;
    color: #0891B2;
}


/* ================================
   TABLE
================================ */

.doctor-table-wrapper {
    overflow-x: auto;
}

.doctor-table {
    width: 100%;
    min-width: 650px;
    color: var(--doctor-text);
}

.doctor-table thead th {
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

.doctor-table tbody td {
    padding: 13px 12px;
    border-top: 1px solid #F0F2F1;
    vertical-align: middle;
    font-size: 12px;
}

.doctor-table tbody tr {
    transition: background .15s ease;
}

.doctor-table tbody tr:hover {
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
    width: 34px;
    height: 34px;
    min-width: 34px;
    border-radius: 9px;
    background: #E8F5EE;
    color: var(--doctor-green);
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

.appointment-time {
    color: #4B5A52;
    font-size: 11px;
    font-weight: 600;
    white-space: nowrap;
}

.reason-text {
    color: #66736C;
    max-width: 150px;
    font-size: 11px;
}

.doctor-status {
    display: inline-flex;
    align-items: center;
    padding: 5px 8px;
    border-radius: 7px;
    font-size: 10px;
    font-weight: 700;
    white-space: nowrap;
}

.pending-status {
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

.doctor-action-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background: #E8F5EE;
    color: var(--doctor-green);
    border: 1px solid #D4EADF;
    border-radius: 8px;
    padding: 7px 11px;
    font-size: 11px;
    font-weight: 700;
    text-decoration: none !important;
    transition: all .2s ease;
    white-space: nowrap;
}

.doctor-action-btn:hover {
    background: var(--doctor-green);
    border-color: var(--doctor-green);
    color: #fff;
}


/* ================================
   LAB TABLE
================================ */

.lab-table {
    min-width: 520px;
}

.lab-order-id {
    color: var(--doctor-green);
    font-size: 11px;
    font-weight: 700;
}

.lab-patient {
    display: flex;
    align-items: center;
    font-size: 11px;
    font-weight: 600;
    white-space: nowrap;
}

.mini-avatar {
    width: 28px;
    height: 28px;
    border-radius: 8px;
    background: #EEF7F2;
    color: var(--doctor-green);
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 7px;
    font-size: 10px;
}

.lab-date {
    color: #7A8780;
    font-size: 10px;
    white-space: nowrap;
}


/* ================================
   MEDICAL RECORDS
================================ */

.medical-record-list {
    background: #fff;
}

.medical-record-item {
    padding: 13px 20px;
    border-bottom: 1px solid #F0F2F1;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    transition: background .15s ease;
}

.medical-record-item:last-child {
    border-bottom: 0;
}

.medical-record-item:hover {
    background: #FAFCFB;
}

.record-patient {
    display: flex;
    align-items: center;
    min-width: 0;
}

.record-avatar {
    width: 35px;
    height: 35px;
    min-width: 35px;
    border-radius: 9px;
    background: #E8F5EE;
    color: var(--doctor-green);
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 10px;
    font-size: 12px;
}

.record-info {
    min-width: 0;
}

.record-name {
    color: var(--doctor-text);
    font-size: 12px;
    font-weight: 700;
}

.record-diagnosis {
    color: #89948E;
    font-size: 10px;
    margin-top: 3px;
    max-width: 260px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.record-view-btn {
    width: 32px;
    height: 32px;
    min-width: 32px;
    border-radius: 8px;
    background: #F0F7F3;
    color: var(--doctor-green);
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none !important;
    font-size: 12px;
    transition: all .2s ease;
}

.record-view-btn:hover {
    background: var(--doctor-green);
    color: #fff;
}


/* ================================
   EMPTY STATES
================================ */

.doctor-empty {
    text-align: center;
    padding: 42px 20px;
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

.small-empty {
    text-align: center;
    padding: 24px 15px;
    color: #9AA49F;
    font-size: 11px;
}

.small-empty i {
    display: block;
    margin-bottom: 7px;
    font-size: 18px;
    color: #B5C0BA;
}

.medical-empty {
    text-align: center;
    padding: 28px 20px;
}


/* ================================
   RESPONSIVE
================================ */

@media (max-width: 991.98px) {

    .doctor-header-content {
        align-items: flex-start;
    }

    .doctor-header h2 {
        font-size: 20px;
    }

    .doctor-header p {
        max-width: 600px;
    }

    .doctor-stat-card {
        min-height: 105px;
    }

}


@media (max-width: 767.98px) {

    .doctor-dashboard {
        padding-top: 3px;
    }

    .doctor-header-content {
        padding: 20px;
        flex-direction: column;
        align-items: stretch;
    }

    .doctor-header-info {
        align-items: flex-start;
    }

    .doctor-header-icon {
        width: 48px;
        height: 48px;
        min-width: 48px;
        font-size: 20px;
    }

    .doctor-header h2 {
        font-size: 18px;
    }

    .doctor-header p {
        font-size: 11px;
        line-height: 1.6;
    }

    .header-divider {
        display: none;
    }

    .doctor-header-btn {
        width: 100%;
    }

    .doctor-panel-header {
        padding: 14px 16px;
    }

    .doctor-panel-title h5 {
        font-size: 13px;
    }

    .doctor-panel-title span {
        font-size: 10px;
    }

    .doctor-table {
        min-width: 650px;
    }

    .lab-table {
        min-width: 520px;
    }

    .doctor-stat-card {
        padding: 16px;
    }

    .doctor-stat-value {
        font-size: 22px;
    }

}


@media (max-width: 575.98px) {

    .doctor-header-icon {
        display: none;
    }

    .doctor-header h2 {
        font-size: 17px;
    }

    .doctor-header p {
        font-size: 10px;
    }

    .doctor-stat-icon {
        width: 46px;
        height: 46px;
        min-width: 46px;
        font-size: 18px;
        margin-right: 12px;
    }

    .doctor-stat-label {
        font-size: 11px;
    }

    .doctor-stat-value {
        font-size: 21px;
    }

    .doctor-stat-bottom {
        font-size: 10px;
    }

}

</style>
@stop