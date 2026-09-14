@extends('adminlte::page')

@section('title', 'Appointment Details')

@section('content')
    <div class="container-fluid appointment-details-page">


        {{-- PAGE HEADER --}}
        <div class="page-header mb-4 mt-2">
            <div>
                <div class="d-flex align-items-center mb-1">
                    <div class="page-icon mr-3">
                        <i class="fas fa-calendar-check"></i>
                    </div>

                    <div>
                        <h2 class="page-title mb-0">ព័ត៌មានការណាត់ជួប</h2>
                        <p class="page-subtitle mb-0">
                            ព័ត៌មានលម្អិតអំពីការណាត់ជួបរបស់អ្នកជំងឺ
                        </p>
                    </div>
                </div>
            </div>

            <a href="{{ route('notifications.index') }}" class="btn btn-light back-btn">
                <i class="fas fa-arrow-left mr-1"></i>
                ត្រឡប់
            </a>
        </div>


        {{-- APPOINTMENT SUMMARY --}}
        <div class="row">

            {{-- Main Information --}}
            <div class="col-lg-8 mb-4">

                <div class="card detail-card border-0 shadow-sm">

                    {{-- Card Header --}}
                    <div class="card-header detail-card-header">
                        <div>
                            <span class="small-label">APPOINTMENT</span>

                            <h3 class="appointment-number mb-0">
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


                    <div class="card-body p-4">

                        {{-- PATIENT --}}
                        <div class="info-section patient-section mb-4">

                            <div class="section-heading mb-3">
                                <div class="section-icon patient-icon">
                                    <i class="fas fa-user-injured"></i>
                                </div>

                                <div>
                                    <h5 class="mb-0">អ្នកជំងឺ</h5>
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


                        {{-- DOCTOR --}}
                        <div class="info-section doctor-section mb-4">

                            <div class="section-heading mb-3">
                                <div class="section-icon doctor-icon">
                                    <i class="fas fa-user-md"></i>
                                </div>

                                <div>
                                    <h5 class="mb-0">វេជ្ជបណ្ឌិត</h5>
                                    <small>Doctor Information</small>
                                </div>
                            </div>

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


                        {{-- APPOINTMENT INFORMATION --}}
                        <div class="info-section">

                            <div class="section-heading mb-3">
                                <div class="section-icon appointment-icon">
                                    <i class="fas fa-calendar-alt"></i>
                                </div>

                                <div>
                                    <h5 class="mb-0">ព័ត៌មានការណាត់ជួប</h5>
                                    <small>Appointment Information</small>
                                </div>
                            </div>

                            <div class="row">

                                {{-- Date --}}
                                <div class="col-md-6 mb-3">
                                    <div class="info-item">
                                        <span class="info-label">
                                            <i class="far fa-calendar mr-1"></i>
                                            កាលបរិច្ឆេទ
                                        </span>

                                        <span class="info-value">
                                            {{ $appointment->appointment_date
        ? $appointment->appointment_date->format('d/m/Y')
        : 'N/A' }}
                                        </span>
                                    </div>
                                </div>

                                {{-- Time --}}
                                <div class="col-md-6 mb-3">
                                    <div class="info-item">
                                        <span class="info-label">
                                            <i class="far fa-clock mr-1"></i>
                                            ម៉ោង
                                        </span>

                                        <span class="info-value">
                                            {{ $appointment->appointment_date
        ? $appointment->appointment_date->format('H:i')
        : 'N/A' }}
                                        </span>
                                    </div>
                                </div>

                            </div>

                        </div>


                        {{-- REASON --}}
                        <div class="reason-box mt-3">

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
                    <div class="card-footer detail-card-footer">


                        <a href="{{ route('appointments.index') }}" class="btn btn-outline-secondary action-btn">
                            <i class="fas fa-list mr-1"></i>
                            បញ្ជី Appointment
                        </a>

                    </div>

                </div>

            </div>


            {{-- SIDE SUMMARY --}}
            <div class="col-lg-4 mb-4">

                {{-- Status Card --}}
                <div class="summary-card status-summary shadow-sm mb-4">

                    <div class="summary-icon">
                        <i class="fas fa-calendar-check"></i>
                    </div>

                    <div class="summary-content">
                        <span class="summary-label">
                            ស្ថានភាពការណាត់ជួប
                        </span>

                        <h4 class="mb-1">
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


                {{-- Date Card --}}
                <div class="summary-card shadow-sm mb-4">

                    <div class="summary-icon date-summary-icon">
                        <i class="fas fa-calendar-day"></i>
                    </div>

                    <div class="summary-content">

                        <span class="summary-label">
                            កាលបរិច្ឆេទ
                        </span>

                        <h4 class="mb-1">
                            {{ $appointment->appointment_date
        ? $appointment->appointment_date->format('d/m/Y')
        : 'N/A' }}
                        </h4>

                        <small>
                            <i class="far fa-clock mr-1"></i>

                            {{ $appointment->appointment_date
        ? $appointment->appointment_date->format('H:i')
        : 'N/A' }}
                        </small>

                    </div>

                </div>


                {{-- Patient Card --}}
                <div class="patient-mini-card shadow-sm">

                    <div class="patient-avatar">
                        <i class="fas fa-user"></i>
                    </div>

                    <div class="patient-mini-content">

                        <span class="summary-label">
                            អ្នកជំងឺ
                        </span>

                        <h5 class="mb-1">
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
        /* =========================================
               PAGE
            ========================================= */

        .appointment-details-page {
            padding-bottom: 30px;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .page-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            background: #e8f5ef;
            color: #006D36;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .page-title {
            font-size: 25px;
            font-weight: 700;
            color: #263238;
        }

        .page-subtitle {
            color: #89939a;
            font-size: 13px;
            margin-top: 3px;
        }

        .back-btn {
            border: 1px solid #e2e6e9;
            border-radius: 8px;
            padding: 9px 16px;
            color: #5f6368;
            font-weight: 500;
        }

        .back-btn:hover {
            background: #f5f7f8;
        }


        /* =========================================
               MAIN CARD
            ========================================= */

        .detail-card {
            border-radius: 14px;
            overflow: hidden;
        }

        .detail-card-header {
            background: #ffffff;
            border-bottom: 1px solid #edf0f2;
            padding: 20px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .small-label {
            display: block;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1px;
            color: #9aa2a8;
            margin-bottom: 2px;
        }

        .appointment-number {
            color: #263238;
            font-size: 21px;
            font-weight: 700;
        }


        /* =========================================
               STATUS
            ========================================= */

        .status-badge {
            display: inline-flex;
            align-items: center;
            padding: 7px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .status-scheduled {
            background: #e8f1ff;
            color: #2563eb;
        }

        .status-completed {
            background: #e7f7ee;
            color: #16834d;
        }

        .status-cancelled {
            background: #fdecec;
            color: #dc3545;
        }

        .status-default {
            background: #f0f1f2;
            color: #6c757d;
        }


        /* =========================================
               SECTIONS
            ========================================= */

        .info-section {
            border-bottom: 1px solid #edf0f2;
            padding-bottom: 20px;
        }

        .section-heading {
            display: flex;
            align-items: center;
        }

        .section-heading h5 {
            color: #263238;
            font-size: 15px;
            font-weight: 700;
        }

        .section-heading small {
            color: #9aa2a8;
            font-size: 11px;
        }

        .section-icon {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 11px;
        }

        .patient-icon {
            background: #e8f5ef;
            color: #006D36;
        }

        .doctor-icon {
            background: #edf3ff;
            color: #3972d9;
        }

        .appointment-icon {
            background: #fff4e5;
            color: #e49a22;
        }


        /* =========================================
               INFO ITEMS
            ========================================= */

        .info-item {
            background: #fafbfb;
            border: 1px solid #edf0f2;
            border-radius: 9px;
            padding: 12px 14px;
            min-height: 65px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .info-label {
            color: #8b949b;
            font-size: 11px;
            margin-bottom: 5px;
        }

        .info-value {
            color: #263238;
            font-size: 14px;
            font-weight: 600;
        }

        .patient-code {
            color: #006D36;
            font-family: monospace;
            font-size: 13px;
        }


        /* =========================================
               REASON
            ========================================= */

        .reason-box {
            background: #f8faf9;
            border-left: 4px solid #006D36;
            border-radius: 8px;
            padding: 15px 18px;
        }

        .reason-title {
            color: #006D36;
            font-size: 13px;
            font-weight: 700;
            margin-bottom: 7px;
        }

        .reason-content {
            color: #4d565c;
            font-size: 14px;
            line-height: 1.7;
        }


        /* =========================================
               FOOTER
            ========================================= */

        .detail-card-footer {
            background: #ffffff;
            border-top: 1px solid #edf0f2;
            padding: 16px 24px;
        }

        .action-btn {
            border-radius: 8px;
            padding: 8px 15px;
            font-size: 13px;
            font-weight: 600;
            margin-right: 6px;
        }


        /* =========================================
               SIDE CARDS
            ========================================= */

        .summary-card {
            background: #ffffff;
            border-radius: 14px;
            border: 1px solid #edf0f2;
            padding: 20px;
            display: flex;
            align-items: center;
        }

        .status-summary {
            border-left: 4px solid #006D36;
        }

        .summary-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            background: #e8f5ef;
            color: #006D36;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            margin-right: 14px;
            flex-shrink: 0;
        }

        .date-summary-icon {
            background: #fff4e5;
            color: #e49a22;
        }

        .summary-label {
            display: block;
            color: #9aa2a8;
            font-size: 11px;
            margin-bottom: 3px;
        }

        .summary-content h4 {
            color: #263238;
            font-size: 17px;
            font-weight: 700;
        }

        .summary-content small {
            color: #8a9399;
            font-size: 11px;
        }


        /* =========================================
               PATIENT MINI CARD
            ========================================= */

        .patient-mini-card {
            background: #ffffff;
            border: 1px solid #edf0f2;
            border-radius: 14px;
            padding: 20px;
            display: flex;
            align-items: center;
        }

        .patient-avatar {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: #e8f5ef;
            color: #006D36;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            margin-right: 14px;
        }

        .patient-mini-content h5 {
            color: #263238;
            font-size: 14px;
            font-weight: 700;
        }

        .patient-mini-content small {
            color: #006D36;
            font-size: 11px;
        }


        /* =========================================
               RESPONSIVE
            ========================================= */

        @media (max-width: 767px) {

            .page-header {
                align-items: flex-start;
            }

            .page-title {
                font-size: 20px;
            }

            .page-subtitle {
                display: none;
            }

            .back-btn {
                padding: 7px 10px;
            }

            .detail-card-header {
                padding: 16px;
            }

            .detail-card .card-body {
                padding: 18px !important;
            }

            .detail-card-footer {
                padding: 14px 16px;
            }

            .action-btn {
                margin-bottom: 5px;
            }
        }
    </style>

@endsection
