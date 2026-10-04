```blade
@extends('adminlte::page')

@section('title', 'បន្ទប់ពិនិត្យជំងឺ (Doctor Consultation)')

@section('content')

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

    .consult-container {
        font-family: 'Inter', 'Kantumruuy Pro', sans-serif;
        background: var(--doctor-bg);
        min-height: calc(100vh - 60px);
        padding: 4px 0 24px;
    }

    .page-header {
        background: linear-gradient(135deg, #006D36 0%, #008747 100%);
        border-radius: 16px;
        padding: 24px 28px;
        color: #fff;
        box-shadow: 0 5px 18px rgba(0, 109, 54, 0.12);
        margin-bottom: 22px;
    }

    .page-header h2 {
        color: #fff !important;
        font-size: 1.45rem;
        margin-bottom: 5px;
    }

    .page-header small {
        color: rgba(255,255,255,.82);
    }

    .page-header-icon {
        width: 46px;
        height: 46px;
        border-radius: 12px;
        background: rgba(255,255,255,.16);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-right: 12px;
        font-size: 20px;
    }

    .back-btn {
        background: #fff;
        color: var(--doctor-green);
        border: 0;
        border-radius: 10px;
        font-weight: 700;
        padding: 10px 16px;
        box-shadow: 0 3px 10px rgba(0,0,0,.08);
        transition: .2s ease;
    }

    .back-btn:hover {
        color: var(--doctor-green-dark);
        transform: translateY(-1px);
    }

    .card-modern {
        background: #fff;
        border-radius: 15px;
        border: 1px solid var(--doctor-border);
        box-shadow: 0 4px 16px rgba(31, 42, 36, 0.045);
        overflow: hidden;
    }

    .card-modern .card-header {
        min-height: 62px;
        display: flex;
        align-items: center;
        border-bottom: 1px solid var(--doctor-border);
    }

    .section-header {
        background: #fff;
        color: var(--doctor-text);
    }

    .section-header i {
        color: var(--doctor-green);
    }

    .consult-header {
        background: linear-gradient(135deg, #006D36 0%, #008747 100%);
        color: #fff;
        border-bottom: 0 !important;
    }

    .consult-header i {
        color: #fff;
    }

    .patient-code {
        background: var(--doctor-green-light);
        color: var(--doctor-green-dark);
        border: 1px solid #d4ebdd;
        border-radius: 7px;
        padding: 5px 9px;
    }

    .info-row {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 15px;
        padding: 9px 0;
        border-bottom: 1px solid #f0f3f1;
    }

    .info-row:last-child {
        border-bottom: 0;
    }

    .info-label {
        color: var(--doctor-muted);
        white-space: nowrap;
    }

    .info-value {
        color: var(--doctor-text);
        text-align: right;
        font-weight: 500;
    }

    .vital-box {
        padding: 15px 8px;
        min-height: 95px;
    }

    .vital-box.border-right {
        border-color: var(--doctor-border) !important;
    }

    .vital-label {
        color: var(--doctor-muted);
        font-size: .78rem;
        display: block;
        margin-bottom: 7px;
    }

    .vital-value {
        color: var(--doctor-text);
        font-size: 1rem;
        font-weight: 700;
    }

    .vital-temp {
        color: #dc3545;
    }

    .vital-heart {
        color: var(--doctor-green);
    }

    .vital-weight {
        color: #1683a8;
    }

    .history-list {
        max-height: 230px;
        overflow-y: auto;
    }

    .history-item {
        padding: 10px 0;
        border-bottom: 1px solid #eef2ef;
    }

    .history-item:last-child {
        border-bottom: 0;
    }

    .history-date {
        color: var(--doctor-muted);
        font-size: .78rem;
    }

    .history-diagnosis {
        color: var(--doctor-text);
        font-size: .84rem;
        margin-top: 4px;
    }

    .form-section-label {
        color: var(--doctor-text);
        font-weight: 700;
        margin-bottom: 8px;
    }

    .form-control {
        border: 1px solid var(--doctor-border);
        border-radius: 10px;
        min-height: 42px;
        color: var(--doctor-text);
        box-shadow: none;
        transition: .2s ease;
    }

    .form-control:focus {
        border-color: #79b99a;
        box-shadow: 0 0 0 3px rgba(0, 109, 54, .08);
    }

    textarea.form-control {
        resize: vertical;
    }

    .destination-box {
        background: var(--doctor-green-light);
        border: 1px solid #d7ebdf !important;
        border-radius: 12px;
        padding: 16px !important;
    }

    .destination-title {
        color: var(--doctor-green-dark);
        font-weight: 700;
    }

    .btn-doctor-outline {
        color: var(--doctor-green);
        border: 1px solid var(--doctor-green);
        background: #fff;
        border-radius: 10px;
        font-weight: 700;
        transition: .2s ease;
    }

    .btn-doctor-outline:hover {
        color: #fff;
        background: var(--doctor-green);
        border-color: var(--doctor-green);
        transform: translateY(-1px);
    }

    .btn-doctor-primary {
        color: #fff;
        background: var(--doctor-green);
        border: 1px solid var(--doctor-green);
        border-radius: 10px;
        font-weight: 700;
        transition: .2s ease;
    }

    .btn-doctor-primary:hover {
        color: #fff;
        background: var(--doctor-green-dark);
        border-color: var(--doctor-green-dark);
        transform: translateY(-1px);
    }

    .btn-admit:hover {
        background: #006D36;
        border-color: #006D36;
    }

    .btn-pharmacy:hover {
        background: #1683a8;
        border-color: #1683a8;
    }

    .alert-doctor {
        border: 0;
        border-radius: 12px;
        box-shadow: 0 3px 12px rgba(31, 42, 36, .04);
    }

    .required {
        color: #dc3545;
    }

    @media (max-width: 991.98px) {
        .page-header {
            padding: 20px;
        }

        .page-header h2 {
            font-size: 1.25rem;
        }

        .page-header .back-btn {
            margin-top: 15px;
        }
    }

    @media (max-width: 767.98px) {
        .consult-container {
            padding-top: 0;
        }

        .page-header {
            border-radius: 13px;
            padding: 18px;
        }

        .page-header .d-flex {
            align-items: flex-start !important;
        }

        .info-row {
            flex-direction: column;
            gap: 3px;
        }

        .info-value {
            text-align: left;
        }

        .destination-actions {
            flex-direction: column;
        }

        .destination-actions .btn {
            width: 100%;
        }
    }

    @media (max-width: 575.98px) {
        .page-header-icon {
            width: 40px;
            height: 40px;
            font-size: 17px;
        }

        .page-header h2 {
            font-size: 1.08rem;
        }

        .page-header small {
            font-size: .75rem;
        }

        .card-modern .card-body {
            padding: 16px !important;
        }

        .vital-box {
            min-height: 82px;
        }
    }
</style>

<div class="consult-container">

    {{-- Header --}}
    <div class="page-header">
        <div class="d-flex flex-wrap justify-content-between align-items-center">

            <div class="d-flex align-items-center">
                <div class="page-header-icon">
                    <i class="fas fa-stethoscope"></i>
                </div>

                <div>
                    <h2 class="font-weight-bold mb-1">
                        បន្ទប់ពិនិត្យ និងព្យាបាលអ្នកជំងឺ
                    </h2>

                    <small>
                        Doctor Consultation · កត់ត្រារោគវិនិច្ឆ័យ វេជ្ជបញ្ជា និងទិសដៅបន្ត
                    </small>
                </div>
            </div>

            <div>
                <a href="{{ route('doctor.index') }}" class="btn back-btn">
                    <i class="fas fa-arrow-left mr-1"></i>
                    ត្រឡប់ក្រោយ
                </a>
            </div>

        </div>
    </div>

    {{-- Error Alert --}}
    @if(session('error'))
        <div class="alert alert-danger alert-doctor mb-4">
            <i class="fas fa-exclamation-circle mr-2"></i>
            {{ session('error') }}

            <button type="button"
                    class="close"
                    data-dismiss="alert"
                    aria-label="Close">
                <span>&times;</span>
            </button>
        </div>
    @endif

    <div class="row">

        {{-- Patient Information --}}
        <div class="col-lg-4 mb-4">

            <div class="card-modern mb-4">

                <div class="card-header section-header px-3">
                    <h6 class="mb-0 font-weight-bold">
                        <i class="fas fa-user-circle mr-2"></i>
                        ព័ត៌មានអ្នកជំងឺ
                    </h6>
                </div>

                <div class="card-body p-3">

                    <div class="info-row">
                        <span class="info-label">
                            កូដអ្នកជំងឺ
                        </span>

                        <span class="patient-code font-weight-bold">
                            {{ $record->patient->patient_code ?? 'N/A' }}
                        </span>
                    </div>

                    <div class="info-row">
                        <span class="info-label">
                            ឈ្មោះពេញ
                        </span>

                        <strong class="info-value">
                            {{ $record->patient->full_name ?? 'N/A' }}
                        </strong>
                    </div>

                    <div class="info-row">
                        <span class="info-label">
                            ភេទ / អាយុ
                        </span>

                        <span class="info-value">
                            {{ ($record->patient->sex ?? '') == 'Male' ? 'ប្រុស' : 'ស្រី' }}
                            |
                            {{ $record->patient->date_of_birth ?? '-' }}
                        </span>
                    </div>

                    <div class="info-row">
                        <span class="info-label">
                            លេខទូរសព្ទ
                        </span>

                        <span class="info-value">
                            {{ $record->patient->phone ?? '-' }}
                        </span>
                    </div>

                    <div class="info-row">
                        <span class="info-label">
                            អាសយដ្ឋាន
                        </span>

                        <span class="info-value" style="max-width: 200px;">
                            {{ $record->patient->address ?? '-' }}
                        </span>
                    </div>

                </div>
            </div>


            {{-- Vital Signs --}}
            <div class="card-modern mb-4">

                <div class="card-header section-header px-3">
                    <h6 class="mb-0 font-weight-bold">
                        <i class="fas fa-heartbeat mr-2"></i>
                        សញ្ញាជីវិត (Vital Signs)
                    </h6>
                </div>

                <div class="card-body p-3">

                    <div class="row text-center">

                        <div class="col-6 vital-box border-right mb-2">
                            <small class="vital-label">
                                សម្ពាធឈាម (BP)
                            </small>

                            <span class="vital-value">
                                120/80 mmHg
                            </span>
                        </div>

                        <div class="col-6 vital-box mb-2">
                            <small class="vital-label">
                                កំដៅខ្លួន (Temp)
                            </small>

                            <span class="vital-value vital-temp">
                                37.2 °C
                            </span>
                        </div>

                        <div class="col-6 vital-box border-right">
                            <small class="vital-label">
                                ចង្វាក់បេះដូង
                            </small>

                            <span class="vital-value vital-heart">
                                75 bpm
                            </span>
                        </div>

                        <div class="col-6 vital-box">
                            <small class="vital-label">
                                ទម្ងន់ (Weight)
                            </small>

                            <span class="vital-value vital-weight">
                                65 Kg
                            </span>
                        </div>

                    </div>

                </div>
            </div>


            {{-- Treatment History --}}
            <div class="card-modern">

                <div class="card-header section-header px-3">
                    <h6 class="mb-0 font-weight-bold">
                        <i class="fas fa-history mr-2"></i>
                        ប្រវត្តិព្យាបាលចាស់ៗ
                    </h6>
                </div>

                <div class="card-body p-3 history-list">

                    @forelse($historyRecords as $hist)

                        <div class="history-item">

                            <div class="history-date">
                                <i class="far fa-clock mr-1"></i>
                                {{ $hist->visit_date }}
                            </div>

                            <div class="history-diagnosis">
                                <strong>រោគវិនិច្ឆ័យ:</strong>
                                {{ $hist->diagnosis }}
                            </div>

                        </div>

                    @empty

                        <p class="text-muted small text-center my-2">
                            <i class="fas fa-folder-open mr-1"></i>
                            គ្មានប្រវត្តិព្យាបាលចាស់ទេ។
                        </p>

                    @endforelse

                </div>
            </div>

        </div>


        {{-- Consultation Form --}}
        <div class="col-lg-8 mb-4">

            <div class="card-modern">

                <div class="card-header consult-header px-4">
                    <h6 class="mb-0 font-weight-bold">
                        <i class="fas fa-notes-medical mr-2"></i>
                        កត់ត្រាវេជ្ជសាស្ត្រ និងទិសដៅបន្ត
                    </h6>
                </div>

                <div class="card-body p-4">

                    <form action="{{ route('doctor.update', $record->record_id) }}"
                          method="POST">

                        @csrf
                        @method('PUT')


                        {{-- Diagnosis --}}
                        <div class="form-group mb-4">

                            <label class="form-section-label">
                                រោគវិនិច្ឆ័យ (Diagnosis)
                                <span class="required">*</span>
                            </label>

                            <textarea name="diagnosis"
                                      class="form-control"
                                      rows="3"
                                      placeholder="បញ្ចូលរោគវិនិច្ឆ័យរបស់អ្នកជំងឺ..."
                                      required>{{ old('diagnosis', $record->diagnosis) }}</textarea>

                        </div>


                        {{-- Notes --}}
                        <div class="row mb-4">

                            <div class="col-md-6 mb-3 mb-md-0">

                                <div class="form-group mb-0">

                                    <label class="form-section-label">
                                        ចំណាំទូទៅ (Notes)
                                    </label>

                                    <textarea name="notes"
                                              class="form-control"
                                              rows="4"
                                              placeholder="ចំណាំបន្ថែម...">{{ old('notes', $record->notes) }}</textarea>

                                </div>

                            </div>


                            <div class="col-md-6">

                                <div class="form-group mb-0">

                                    <label class="form-section-label">
                                        វេជ្ជបញ្ជា / ឱសថការី
                                    </label>

                                    <textarea name="prescription_notes"
                                              class="form-control"
                                              rows="4"
                                              placeholder="ឈ្មោះថ្នាំ និងកម្រិតប្រើប្រាស់...">{{ old('prescription_notes', $record->prescription_notes) }}</textarea>

                                </div>

                            </div>

                        </div>


                        {{-- Destination --}}
                        <div class="destination-box mb-4">

                            <div class="destination-title">
                                <i class="fas fa-share-square mr-1"></i>
                                ជ្រើសរើសទិសដៅបន្តរបស់អ្នកជំងឺ
                            </div>

                            <p class="text-muted small mb-0 mt-1">
                                សូមជ្រើសរើសប៊ូតុងណាមួយខាងក្រោម
                                ដើម្បីរក្សាទុក និងបញ្ជូនអ្នកជំងឺទៅកាន់គោលដៅបន្ទាប់។
                            </p>

                        </div>


                        {{-- Destination Buttons --}}
                        <div class="d-flex destination-actions"
                             style="gap: 12px;">

                            <button type="submit"
                                    name="status_destination"
                                    value="admit"
                                    class="btn btn-doctor-outline btn-admit flex-fill py-2">

                                <i class="fas fa-bed mr-1"></i>
                                សម្រាកព្យាបាល (Admit)

                            </button>


                            <button type="submit"
                                    name="status_destination"
                                    value="pharmacy"
                                    class="btn btn-doctor-outline btn-pharmacy flex-fill py-2">

                                <i class="fas fa-pills mr-1"></i>
                                ទៅកន្លែងចេញថ្នាំ (Pharmacy)

                            </button>


                            <button type="submit"
                                    name="status_destination"
                                    value="done"
                                    class="btn btn-doctor-primary flex-fill py-2">

                                <i class="fas fa-check-circle mr-1"></i>
                                បញ្ចប់ការពិនិត្យ (Finish)

                            </button>

                        </div>

                    </form>

                </div>
            </div>

        </div>

    </div>

</div>

@stop
```
