@extends('adminlte::page')

@section('title', 'Appointment Details')

@section('content')
<div class="container-fluid appointment-details-page pt-3">

    {{-- PAGE HEADER --}}
    <div class="page-header mb-4">
        <div class="header-left">
            <div class="header-icon">
                <i class="fas fa-calendar-check"></i>
            </div>

            <div class="header-text">
                <h2>ព័ត៌មានការណាត់ជួប</h2>
                <p>
                    ព័ត៌មានលម្អិតអំពីការណាត់ជួបរបស់អ្នកជំងឺ
                </p>
            </div>
        </div>

        <a href="{{ route('notifications.index') }}" class="back-btn">
            <i class="fas fa-arrow-left mr-1"></i>
            ត្រឡប់
        </a>
    </div>


    <div class="row">

        {{-- MAIN INFORMATION --}}
        <div class="col-lg-8 mb-4">

            <div class="detail-card">

                {{-- CARD HEADER --}}
                <div class="detail-card-header">

                    <div>
                        <span class="small-label">
                            APPOINTMENT
                        </span>

                        <h3 class="appointment-number">
                            #{{ $appointment->appointment_id }}
                        </h3>
                    </div>

                    <div>
                        @if($appointment->status === 'scheduled')

                            <span class="status-badge status-scheduled">
                                <i class="fas fa-clock mr-1"></i>
                                Scheduled
                            </span>

                        @elseif($appointment->status === 'completed')

                            <span class="status-badge status-completed">
                                <i class="fas fa-check-circle mr-1"></i>
                                Completed
                            </span>

                        @elseif($appointment->status === 'cancelled')

                            <span class="status-badge status-cancelled">
                                <i class="fas fa-times-circle mr-1"></i>
                                Cancelled
                            </span>

                        @else

                            <span class="status-badge status-default">
                                {{ ucfirst($appointment->status) }}
                            </span>

                        @endif
                    </div>

                </div>


                {{-- CARD BODY --}}
                <div class="detail-card-body">

                    {{-- PATIENT INFORMATION --}}
                    <div class="info-section">

                        <div class="section-heading">
                            <div class="section-icon patient-icon">
                                <i class="fas fa-user-injured"></i>
                            </div>

                            <div>
                                <h5>អ្នកជំងឺ</h5>
                                <small>Patient Information</small>
                            </div>
                        </div>


                        <div class="row">

                            <div class="col-md-6 mb-3">

                                <div class="info-item">

                                    <span class="info-label">
                                        ឈ្មោះអ្នកជំងឺ
                                    </span>

                                    <span class="info-value">
                                        {{ optional($appointment->patient)->full_name ?? 'N/A' }}
                                    </span>

                                </div>

                            </div>


                            <div class="col-md-6 mb-3">

                                <div class="info-item">

                                    <span class="info-label">
                                        Patient Code
                                    </span>

                                    <span class="info-value patient-code">
                                        {{ optional($appointment->patient)->patient_code ?? 'N/A' }}
                                    </span>

                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- DOCTOR INFORMATION --}}
                    <div class="info-section">

                        <div class="section-heading">

                            <div class="section-icon doctor-icon">
                                <i class="fas fa-user-md"></i>
                            </div>

                            <div>
                                <h5>វេជ្ជបណ្ឌិត</h5>
                                <small>Doctor Information</small>
                            </div>

                        </div>


                        <div class="row">

                            <div class="col-12">

                                <div class="info-item">

                                    <span class="info-label">
                                        វេជ្ជបណ្ឌិត
                                    </span>

                                    <span class="info-value">

                                        {{ optional($appointment->doctor)->first_name ?? '' }}
                                        {{ optional($appointment->doctor)->last_name ?? '' }}

                                        @if(!$appointment->doctor)
                                            N/A
                                        @endif

                                    </span>

                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- APPOINTMENT INFORMATION --}}
                    <div class="info-section">

                        <div class="section-heading">

                            <div class="section-icon appointment-icon">
                                <i class="fas fa-calendar-alt"></i>
                            </div>

                            <div>
                                <h5>ព័ត៌មានការណាត់ជួប</h5>
                                <small>Appointment Information</small>
                            </div>

                        </div>


                        <div class="row">

                            {{-- DATE --}}
                            <div class="col-md-6 mb-3">

                                <div class="info-item">

                                    <span class="info-label">
                                        <i class="far fa-calendar mr-1"></i>
                                        កាលបរិច្ឆេទ
                                    </span>

                                    <span class="info-value">

                                        {{ $appointment->appointment_date
                                            ? $appointment->appointment_date->format('d/m/Y')
                                            : 'N/A'
                                        }}

                                    </span>

                                </div>

                            </div>


                            {{-- TIME --}}
                            <div class="col-md-6 mb-3">

                                <div class="info-item">

                                    <span class="info-label">
                                        <i class="far fa-clock mr-1"></i>
                                        ម៉ោង
                                    </span>

                                    <span class="info-value">

                                        {{ $appointment->appointment_date
                                            ? $appointment->appointment_date->format('H:i')
                                            : 'N/A'
                                        }}

                                    </span>

                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- REASON --}}
                    <div class="reason-box">

                        <div class="reason-title">
                            <i class="fas fa-notes-medical mr-2"></i>
                            មូលហេតុនៃការណាត់ជួប
                        </div>

                        <div class="reason-content">
                            {{ $appointment->reason ?? 'មិនមានព័ត៌មាន' }}
                        </div>

                    </div>

                </div>


                {{-- FOOTER --}}
                <div class="detail-card-footer">

                    <a
                        href="{{ route('appointments.index') }}"
                        class="action-btn"
                    >
                        <i class="fas fa-list mr-1"></i>
                        បញ្ជី Appointment
                    </a>

                </div>

            </div>

        </div>


        {{-- SIDE SUMMARY --}}
        <div class="col-lg-4 mb-4">

            {{-- STATUS --}}
            <div class="summary-card status-summary mb-4">

                <div class="summary-icon">
                    <i class="fas fa-calendar-check"></i>
                </div>

                <div class="summary-content">

                    <span class="summary-label">
                        ស្ថានភាពការណាត់ជួប
                    </span>

                    <h4>

                        @if($appointment->status === 'scheduled')
                            Scheduled

                        @elseif($appointment->status === 'completed')
                            Completed

                        @elseif($appointment->status === 'cancelled')
                            Cancelled

                        @else
                            {{ ucfirst($appointment->status) }}
                        @endif

                    </h4>

                    <small>
                        Appointment #{{ $appointment->appointment_id }}
                    </small>

                </div>

            </div>


            {{-- DATE --}}
            <div class="summary-card mb-4">

                <div class="summary-icon date-icon">
                    <i class="fas fa-calendar-day"></i>
                </div>

                <div class="summary-content">

                    <span class="summary-label">
                        កាលបរិច្ឆេទ
                    </span>

                    <h4>

                        {{ $appointment->appointment_date
                            ? $appointment->appointment_date->format('d/m/Y')
                            : 'N/A'
                        }}

                    </h4>

                    <small>
                        <i class="far fa-clock mr-1"></i>

                        {{ $appointment->appointment_date
                            ? $appointment->appointment_date->format('H:i')
                            : 'N/A'
                        }}

                    </small>

                </div>

            </div>


            {{-- PATIENT --}}
            <div class="patient-mini-card">

                <div class="patient-avatar">
                    <i class="fas fa-user"></i>
                </div>

                <div class="patient-mini-content">

                    <span class="summary-label">
                        អ្នកជំងឺ
                    </span>

                    <h5>
                        {{ optional($appointment->patient)->full_name ?? 'N/A' }}
                    </h5>

                    <small>
                        {{ optional($appointment->patient)->patient_code ?? 'N/A' }}
                    </small>

                </div>

            </div>

        </div>

    </div>

</div>
@endsection


@section('css')
<style>

    :root {
        --appointment-green: #006D36;
        --appointment-green-dark: #00552B;
        --appointment-green-light: #E8F5EE;
        --appointment-bg: #F5F7F6;
        --appointment-border: #E7ECE9;
        --appointment-text: #1F2A24;
        --appointment-muted: #7A8780;
    }


    body {
        background: var(--appointment-bg);
    }

    .content-wrapper {
        background: var(--appointment-bg);
    }


    /* =========================================
       PAGE
    ========================================= */

    .appointment-details-page {
        padding-bottom: 30px;
    }


    /* =========================================
       PAGE HEADER
    ========================================= */

    .page-header {
        background: linear-gradient(
            135deg,
            #006D36 0%,
            #008747 100%
        );

        border-radius: 16px;
        padding: 22px 26px;

        display: flex;
        align-items: center;
        justify-content: space-between;

        color: #fff;

        box-shadow:
            0 5px 18px rgba(0, 109, 54, .15);
    }


    .header-left {
        display: flex;
        align-items: center;
    }


    .header-icon {
        width: 56px;
        height: 56px;

        border-radius: 14px;

        background: rgba(255,255,255,.17);
        border: 1px solid rgba(255,255,255,.23);

        display: flex;
        align-items: center;
        justify-content: center;

        font-size: 23px;

        margin-right: 16px;
    }


    .header-text h2 {
        font-size: 23px;
        font-weight: 700;
        margin: 0 0 4px;
    }


    .header-text p {
        margin: 0;
        font-size: 13px;
        opacity: .9;
    }


    .back-btn {
        background: #fff;
        color: var(--appointment-green);

        border: 0;
        border-radius: 9px;

        padding: 9px 16px;

        font-size: 13px;
        font-weight: 600;

        text-decoration: none;

        transition: all .2s ease;
    }


    .back-btn:hover {
        background: #f3f7f5;
        color: var(--appointment-green-dark);
        text-decoration: none;
        transform: translateY(-1px);
    }


    /* =========================================
       MAIN CARD
    ========================================= */

    .detail-card {
        background: #fff;

        border: 1px solid var(--appointment-border);
        border-radius: 15px;

        overflow: hidden;

        box-shadow:
            0 4px 15px rgba(31,42,36,.05);
    }


    .detail-card-header {
        background: #fff;

        border-bottom: 1px solid var(--appointment-border);

        padding: 20px 23px;

        display: flex;
        align-items: center;
        justify-content: space-between;
    }


    .small-label {
        display: block;

        color: var(--appointment-muted);

        font-size: 10px;
        font-weight: 700;

        letter-spacing: 1px;

        margin-bottom: 2px;
    }


    .appointment-number {
        color: var(--appointment-text);

        font-size: 21px;
        font-weight: 700;

        margin: 0;
    }


    .detail-card-body {
        padding: 23px;
    }


    /* =========================================
       STATUS
    ========================================= */

    .status-badge {
        display: inline-flex;
        align-items: center;

        padding: 7px 12px;

        border-radius: 20px;

        font-size: 11px;
        font-weight: 700;
    }


    .status-scheduled {
        background: #E8F1FF;
        color: #2563EB;
    }


    .status-completed {
        background: #E8F5EE;
        color: #16834D;
    }


    .status-cancelled {
        background: #FDECEC;
        color: #DC3545;
    }


    .status-default {
        background: #F0F1F2;
        color: #6C757D;
    }


    /* =========================================
       INFO SECTIONS
    ========================================= */

    .info-section {
        padding-bottom: 20px;
        margin-bottom: 20px;

        border-bottom: 1px solid var(--appointment-border);
    }


    .section-heading {
        display: flex;
        align-items: center;

        margin-bottom: 15px;
    }


    .section-icon {
        width: 40px;
        height: 40px;

        border-radius: 11px;

        display: flex;
        align-items: center;
        justify-content: center;

        margin-right: 11px;

        flex-shrink: 0;
    }


    .patient-icon {
        background: var(--appointment-green-light);
        color: var(--appointment-green);
    }


    .doctor-icon {
        background: #EDF3FF;
        color: #3972D9;
    }


    .appointment-icon {
        background: #FFF4E5;
        color: #E49A22;
    }


    .section-heading h5 {
        color: var(--appointment-text);

        font-size: 15px;
        font-weight: 700;

        margin: 0 0 2px;
    }


    .section-heading small {
        color: var(--appointment-muted);

        font-size: 10px;
    }


    /* =========================================
       INFO ITEM
    ========================================= */

    .info-item {
        background: #FAFCFB;

        border: 1px solid var(--appointment-border);

        border-radius: 9px;

        padding: 12px 14px;

        min-height: 66px;

        display: flex;
        flex-direction: column;
        justify-content: center;

        transition: all .2s ease;
    }


    .info-item:hover {
        border-color: #D7E4DD;
        background: #fff;
    }


    .info-label {
        color: var(--appointment-muted);

        font-size: 10px;

        margin-bottom: 5px;
    }


    .info-value {
        color: var(--appointment-text);

        font-size: 14px;
        font-weight: 600;
    }


    .patient-code {
        color: var(--appointment-green);

        font-family: monospace;

        font-size: 13px;
    }


    /* =========================================
       REASON
    ========================================= */

    .reason-box {
        background: #F8FAF9;

        border-left: 4px solid var(--appointment-green);

        border-radius: 9px;

        padding: 15px 18px;
    }


    .reason-title {
        color: var(--appointment-green);

        font-size: 13px;
        font-weight: 700;

        margin-bottom: 7px;
    }


    .reason-content {
        color: #4D565C;

        font-size: 13px;

        line-height: 1.7;
    }


    /* =========================================
       FOOTER
    ========================================= */

    .detail-card-footer {
        background: #fff;

        border-top: 1px solid var(--appointment-border);

        padding: 16px 23px;
    }


    .action-btn {
        display: inline-flex;
        align-items: center;

        background: var(--appointment-green);

        color: #fff;

        border-radius: 8px;

        padding: 9px 15px;

        font-size: 12px;
        font-weight: 600;

        text-decoration: none;

        transition: all .2s ease;
    }


    .action-btn:hover {
        background: var(--appointment-green-dark);
        color: #fff;

        text-decoration: none;

        transform: translateY(-1px);

        box-shadow:
            0 4px 10px rgba(0,109,54,.18);
    }


    /* =========================================
       SUMMARY CARDS
    ========================================= */

    .summary-card {
        background: #fff;

        border: 1px solid var(--appointment-border);

        border-radius: 15px;

        padding: 20px;

        display: flex;
        align-items: center;

        box-shadow:
            0 4px 15px rgba(31,42,36,.05);
    }


    .status-summary {
        border-left: 4px solid var(--appointment-green);
    }


    .summary-icon {
        width: 50px;
        height: 50px;

        border-radius: 12px;

        background: var(--appointment-green-light);
        color: var(--appointment-green);

        display: flex;
        align-items: center;
        justify-content: center;

        font-size: 19px;

        margin-right: 14px;

        flex-shrink: 0;
    }


    .date-icon {
        background: #FFF4E5;
        color: #E49A22;
    }


    .summary-label {
        display: block;

        color: var(--appointment-muted);

        font-size: 10px;

        margin-bottom: 4px;
    }


    .summary-content h4 {
        color: var(--appointment-text);

        font-size: 17px;
        font-weight: 700;

        margin: 0 0 3px;
    }


    .summary-content small {
        color: var(--appointment-muted);

        font-size: 10px;
    }


    /* =========================================
       PATIENT MINI CARD
    ========================================= */

    .patient-mini-card {
        background: #fff;

        border: 1px solid var(--appointment-border);

        border-radius: 15px;

        padding: 20px;

        display: flex;
        align-items: center;

        box-shadow:
            0 4px 15px rgba(31,42,36,.05);
    }


    .patient-avatar {
        width: 50px;
        height: 50px;

        border-radius: 50%;

        background: var(--appointment-green-light);
        color: var(--appointment-green);

        display: flex;
        align-items: center;
        justify-content: center;

        font-size: 18px;

        margin-right: 14px;

        flex-shrink: 0;
    }


    .patient-mini-content h5 {
        color: var(--appointment-text);

        font-size: 14px;
        font-weight: 700;

        margin: 0 0 3px;
    }


    .patient-mini-content small {
        color: var(--appointment-green);

        font-size: 10px;
    }


    /* =========================================
       RESPONSIVE
    ========================================= */

    @media (max-width: 991.98px) {

        .summary-card,
        .patient-mini-card {
            margin-bottom: 15px;
        }

    }


    @media (max-width: 767.98px) {

        .page-header {
            padding: 18px;
        }


        .header-icon {
            width: 48px;
            height: 48px;

            font-size: 20px;

            margin-right: 12px;
        }


        .header-text h2 {
            font-size: 19px;
        }


        .header-text p {
            font-size: 11px;
        }


        .back-btn {
            padding: 8px 11px;
            font-size: 11px;
        }


        .detail-card-header {
            padding: 17px;
        }


        .detail-card-body {
            padding: 18px;
        }


        .detail-card-footer {
            padding: 14px 17px;
        }


        .appointment-number {
            font-size: 18px;
        }


        .status-badge {
            padding: 6px 9px;
            font-size: 10px;
        }

    }


    @media (max-width: 575.98px) {

        .appointment-details-page {
            padding-left: 5px;
            padding-right: 5px;
        }


        .page-header {
            border-radius: 12px;

            align-items: flex-start;
        }


        .header-left {
            align-items: flex-start;
        }


        .header-text h2 {
            font-size: 17px;
        }


        .header-text p {
            display: none;
        }


        .back-btn {
            padding: 7px 9px;
        }


        .detail-card {
            border-radius: 12px;
        }


        .summary-card,
        .patient-mini-card {
            border-radius: 12px;
        }

    }

</style>
@endsection