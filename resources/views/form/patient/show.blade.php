@extends('adminlte::page')

@section('title', 'ព័ត៌មានលម្អិតអ្នកជំងឺ')

@section('content_header')
@stop

@section('content')

<style>
    :root {
        --clinic-green: #006D36;
        --clinic-green-dark: #00552B;
        --clinic-green-light: #E8F5EE;
        --clinic-bg: #F5F7F6;
        --clinic-border: #E7ECE9;
        --clinic-text: #1F2A24;
        --clinic-muted: #7A8780;
    }

    .patient-details-container {
        font-family: 'Inter', 'Kantumruuy Pro', sans-serif;
        color: var(--clinic-text);
    }

    .page-header {
        background: linear-gradient(135deg, #006D36 0%, #008747 100%);
        border-radius: 16px;
        padding: 24px 28px;
        margin-bottom: 24px;
        color: #ffffff;
        box-shadow: 0 5px 18px rgba(0, 109, 54, 0.14);
    }

    .page-header h2 {
        font-size: 24px;
        font-weight: 700;
        margin-bottom: 5px;
    }

    .page-header p {
        margin: 0;
        font-size: 13px;
        opacity: 0.88;
    }

    .back-btn {
        background: #ffffff;
        color: var(--clinic-green);
        border: none;
        border-radius: 10px;
        padding: 10px 17px;
        font-weight: 700;
        transition: 0.2s ease;
    }

    .back-btn:hover {
        background: #f3f8f5;
        color: var(--clinic-green-dark);
        transform: translateY(-1px);
    }

    .modern-card {
        background: #ffffff;
        border: 1px solid var(--clinic-border);
        border-radius: 15px;
        box-shadow: 0 3px 14px rgba(31, 42, 36, 0.05);
        overflow: hidden;
        height: 100%;
    }

    .patient-profile {
        text-align: center;
        padding: 28px 22px 22px;
    }

    .profile-icon {
        width: 82px;
        height: 82px;
        margin: 0 auto 15px;
        border-radius: 50%;
        background: var(--clinic-green-light);
        color: var(--clinic-green);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 48px;
    }

    .patient-name {
        font-size: 20px;
        font-weight: 700;
        margin-bottom: 8px;
        color: var(--clinic-text);
    }

    .patient-code {
        display: inline-block;
        background: var(--clinic-green-light);
        color: var(--clinic-green);
        border: 1px solid #cde8d8;
        border-radius: 20px;
        padding: 5px 13px;
        font-size: 12px;
        font-weight: 700;
    }

    .info-list {
        margin-top: 20px;
        border-top: 1px solid var(--clinic-border);
    }

    .info-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
        padding: 14px 2px;
        border-bottom: 1px solid var(--clinic-border);
        font-size: 13px;
    }

    .info-item:last-child {
        border-bottom: none;
    }

    .info-label {
        color: var(--clinic-muted);
        white-space: nowrap;
    }

    .info-value {
        color: var(--clinic-text);
        font-weight: 700;
        text-align: right;
        word-break: break-word;
    }

    .gender-badge {
        background: #E8F5EE;
        color: var(--clinic-green);
        border-radius: 20px;
        padding: 4px 10px;
        font-size: 11px;
    }

    .card-title-header {
        min-height: 76px;
        padding: 20px 22px;
        border-bottom: 1px solid var(--clinic-border);
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .card-title-header h6 {
        margin: 0;
        font-size: 15px;
        font-weight: 700;
        color: var(--clinic-text);
    }

    .card-title-header h6 i {
        color: var(--clinic-green);
        margin-right: 8px;
    }

    .history-count {
        background: var(--clinic-green-light);
        color: var(--clinic-green);
        border-radius: 20px;
        padding: 5px 10px;
        font-size: 11px;
        font-weight: 700;
    }

    .history-body {
        padding: 22px;
    }

    .history-item {
        position: relative;
        background: #ffffff;
        border: 1px solid var(--clinic-border);
        border-left: 4px solid var(--clinic-green);
        border-radius: 12px;
        padding: 17px 18px;
        margin-bottom: 14px;
        transition: all 0.2s ease;
    }

    .history-item:last-child {
        margin-bottom: 0;
    }

    .history-item:hover {
        border-color: #cfe4d8;
        box-shadow: 0 4px 12px rgba(0, 109, 54, 0.07);
        transform: translateY(-1px);
    }

    .history-date {
        display: inline-flex;
        align-items: center;
        background: var(--clinic-green-light);
        color: var(--clinic-green);
        border-radius: 20px;
        padding: 5px 10px;
        font-size: 11px;
        font-weight: 700;
        float: right;
    }

    .history-diagnosis {
        font-size: 14px;
        font-weight: 700;
        color: var(--clinic-text);
        margin: 0 110px 8px 0;
        line-height: 1.6;
    }

    .history-notes {
        color: var(--clinic-muted);
        font-size: 12px;
        margin: 0;
        line-height: 1.7;
    }

    .empty-history {
        text-align: center;
        padding: 55px 20px;
        color: var(--clinic-muted);
    }

    .empty-history-icon {
        width: 62px;
        height: 62px;
        margin: 0 auto 14px;
        border-radius: 50%;
        background: #F3F6F4;
        color: #A0AAA5;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 25px;
    }

    .empty-history p {
        margin: 0;
        font-size: 13px;
    }

    @media (max-width: 991.98px) {
        .page-header {
            padding: 20px;
        }

        .page-header h2 {
            font-size: 21px;
        }

        .back-btn {
            margin-top: 15px;
        }
    }

    @media (max-width: 767.98px) {
        .page-header {
            padding: 18px;
        }

        .page-header .d-flex {
            display: block !important;
        }

        .page-header h2 {
            font-size: 19px;
        }

        .modern-card {
            margin-bottom: 20px;
        }

        .history-date {
            float: none;
            margin-bottom: 9px;
        }

        .history-diagnosis {
            margin-right: 0;
        }

        .info-item {
            align-items: flex-start;
        }
    }

    @media (max-width: 575.98px) {
        .patient-profile {
            padding: 22px 16px;
        }

        .history-body {
            padding: 15px;
        }

        .card-title-header {
            padding: 17px 16px;
        }

        .card-title-header h6 {
            font-size: 13px;
        }

        .history-item {
            padding: 14px;
        }
    }
</style>

<div class="patient-details-container">

    {{-- Page Header --}}
    <div class="page-header">
        <div class="d-flex justify-content-between align-items-center">

            <div>
                <h2>
                    <i class="fas fa-user-injured mr-2"></i>
                    ព័ត៌មានលម្អិតអ្នកជំងឺ
                </h2>

                <p>
                    ព័ត៌មានផ្ទាល់ខ្លួន និងប្រវត្តិវេជ្ជសាស្ត្ររបស់អ្នកជំងឺ
                </p>
            </div>

            <div>
                <a href="{{ route('patients.index') }}" class="btn back-btn">
                    <i class="fas fa-arrow-left mr-1"></i>
                    ត្រឡប់ក្រោយ
                </a>
            </div>

        </div>
    </div>

    <div class="row">

        {{-- Patient Profile --}}
        <div class="col-lg-4 col-md-5 mb-4">

            <div class="modern-card">

                <div class="patient-profile">

                    <div class="profile-icon">
                        <i class="fas fa-user"></i>
                    </div>

                    <h4 class="patient-name">
                        {{ $patient->full_name }}
                    </h4>

                    <span class="patient-code">
                        <i class="fas fa-id-badge mr-1"></i>
                        {{ $patient->patient_code }}
                    </span>

                    <div class="info-list">

                        {{-- Gender --}}
                        <div class="info-item">
                            <span class="info-label">
                                <i class="fas fa-venus-mars mr-1"></i>
                                ភេទ
                            </span>

                            <span class="info-value">
                                <span class="gender-badge">
                                    {{ $patient->sex == 'Male' ? 'ប្រុស' : 'ស្រី' }}
                                </span>
                            </span>
                        </div>

                        {{-- Date of Birth --}}
                        <div class="info-item">
                            <span class="info-label">
                                <i class="fas fa-birthday-cake mr-1"></i>
                                ថ្ងៃកំណើត
                            </span>

                            <span class="info-value">
                                {{ $patient->date_of_birth ? \Carbon\Carbon::parse($patient->date_of_birth)->format('d/m/Y') : '-' }}
                            </span>
                        </div>

                        {{-- Phone --}}
                        <div class="info-item">
                            <span class="info-label">
                                <i class="fas fa-phone mr-1"></i>
                                លេខទូរសព្ទ
                            </span>

                            <span class="info-value">
                                {{ $patient->phone ?? '-' }}
                            </span>
                        </div>

                        {{-- ID Card --}}
                        <div class="info-item">
                            <span class="info-label">
                                <i class="fas fa-id-card mr-1"></i>
                                អត្តសញ្ញាណប័ណ្ណ
                            </span>

                            <span class="info-value">
                                {{ $patient->id_card ?? '-' }}
                            </span>
                        </div>

                    </div>

                </div>

            </div>

        </div>

        {{-- Medical History --}}
        <div class="col-lg-8 col-md-7 mb-4">

            <div class="modern-card">

                <div class="card-title-header">

                    <h6>
                        <i class="fas fa-notes-medical"></i>
                        ប្រវត្តិវេជ្ជសាស្ត្ររបស់អ្នកជំងឺ
                    </h6>

                    @if(isset($medicalRecords))
                        <span class="history-count">
                            <i class="fas fa-file-medical mr-1"></i>
                            {{ $medicalRecords->count() }} កំណត់ត្រា
                        </span>
                    @endif

                </div>

                <div class="history-body">

                    @if(isset($medicalRecords) && $medicalRecords->count() > 0)

                        @foreach($medicalRecords as $record)

                            <div class="history-item">

                                <span class="history-date">
                                    <i class="far fa-calendar-alt mr-1"></i>

                                    {{ $record->visit_date ? \Carbon\Carbon::parse($record->visit_date)->format('d/m/Y') : '-' }}
                                </span>

                                <h6 class="history-diagnosis">
                                    <i class="fas fa-stethoscope mr-1" style="color: #006D36;"></i>
                                    រោគវិនិច្ឆ័យ:
                                    {{ $record->diagnosis ?? 'គ្មាន' }}
                                </h6>

                                <p class="history-notes">
                                    <i class="fas fa-comment-medical mr-1"></i>
                                    ចំណាំ:
                                    {{ $record->notes ?? 'គ្មាន' }}
                                </p>

                            </div>

                        @endforeach

                    @else

                        <div class="empty-history">

                            <div class="empty-history-icon">
                                <i class="fas fa-file-medical-alt"></i>
                            </div>

                            <p>
                                មិនទាន់មានប្រវត្តិវេជ្ជសាស្ត្រសម្រាប់អ្នកជំងឺរូបនេះឡើយ។
                            </p>

                        </div>

                    @endif

                </div>

            </div>

        </div>

    </div>

</div>

@stop
