@extends('adminlte::page')

@section('title', 'Medical Records')

@section('content_header')
<div class="medical-header">
    <div class="medical-header-content">
        <div class="medical-header-icon">
            <i class="fas fa-file-medical-alt"></i>
        </div>

        <div>
            <h3 class="mb-1 font-weight-bold">
                បញ្ជី Medical Records
            </h3>

            <div class="medical-header-subtitle">
                <i class="fas fa-notes-medical mr-1"></i>
                គ្រប់គ្រង និងត្រួតពិនិត្យកំណត់ត្រាពេទ្យរបស់អ្នកជំងឺ
            </div>
        </div>
    </div>

    <button
        type="button"
        id="btnCreate"
        class="btn btn-create-record"
    >
        <i class="fas fa-plus mr-1"></i>
        បង្កើត Record ថ្មី
    </button>
</div>
@stop


@section('content')

<div class="container-fluid medical-record-page">

    {{-- FLASH MESSAGE --}}
    <div id="flash">
        @if(session('success'))
            <div class="alert medical-alert-success alert-dismissible fade show">
                <div class="d-flex align-items-center">
                    <div class="alert-icon">
                        <i class="fas fa-check"></i>
                    </div>

                    <div class="flex-grow-1">
                        {{ session('success') }}
                    </div>

                    <button
                        type="button"
                        class="close"
                        data-dismiss="alert"
                    >
                        <span>&times;</span>
                    </button>
                </div>
            </div>
        @endif
    </div>


    {{-- MAIN TABLE --}}
    <div class="medical-card">

        <div class="medical-card-header">

            <div class="medical-card-title">
                <div class="medical-title-icon">
                    <i class="fas fa-folder-open"></i>
                </div>

                <div>
                    <h6 class="mb-0">
                        Medical Records
                    </h6>

                    <small>
                        បញ្ជីកំណត់ត្រាពិនិត្យអ្នកជំងឺ
                    </small>
                </div>
            </div>

            <div class="medical-count">
                <i class="fas fa-file-medical mr-1"></i>
                {{ $records->total() ?? $records->count() }}
                Records
            </div>

        </div>


        <div class="medical-card-body">

            <div class="table-responsive">

                <table class="table medical-table mb-0">

                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>អ្នកជំងឺ</th>
                            <th>កាលបរិច្ឆេទពិនិត្យ</th>
                            <th>សញ្ញាជីវិត</th>
                            <th>ការវិនិច្ឆ័យ</th>
                            <th>គ្រូពេទ្យ</th>
                            <th class="text-center">សកម្មភាព</th>
                        </tr>
                    </thead>

                    <tbody id="records-body">

                        @forelse($records as $record)

                            @include(
                                'form.medical_records._row',
                                ['record' => $record]
                            )

                        @empty

                            <tr id="empty-row">
                                <td
                                    colspan="7"
                                    class="text-center py-5"
                                >
                                    <div class="empty-record-icon">
                                        <i class="fas fa-file-medical"></i>
                                    </div>

                                    <div class="font-weight-bold text-dark mt-2">
                                        មិនទាន់មាន Medical Record ទេ
                                    </div>

                                    <div class="text-muted small mt-1">
                                        ចុច "បង្កើត Record ថ្មី" ដើម្បីបន្ថែម Record
                                    </div>
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>


            {{-- PAGINATION --}}
            <div class="medical-pagination">
                {{ $records->links('pagination::bootstrap-4') }}
            </div>

        </div>

    </div>

</div>


{{-- =========================================================
     VIEW MODAL
========================================================= --}}

<div
    class="modal fade medical-modal"
    id="viewModal"
    tabindex="-1"
    role="dialog"
    aria-hidden="true"
>

    <div
        class="modal-dialog modal-lg modal-dialog-centered"
        role="document"
    >

        <div class="modal-content">

            <div class="modal-header medical-modal-header">

                <div class="d-flex align-items-center">

                    <div class="modal-header-icon">
                        <i class="fas fa-file-medical-alt"></i>
                    </div>

                    <div>
                        <h5 class="modal-title font-weight-bold mb-0">
                            ព័ត៌មានលម្អិត
                            <span class="ml-1">
                                #MR-<span data-f="id"></span>
                            </span>
                        </h5>

                        <small>
                            Medical Record Details
                        </small>
                    </div>

                </div>

                <button
                    type="button"
                    class="close text-white"
                    data-dismiss="modal"
                >
                    <span>&times;</span>
                </button>

            </div>


            <div class="modal-body p-4">

                {{-- PATIENT INFORMATION --}}
                <div class="patient-info-box mb-4">

                    <div class="row">

                        <div class="col-md-7">

                            <div class="patient-main-name">
                                <div class="patient-avatar">
                                    <i class="fas fa-user"></i>
                                </div>

                                <div>
                                    <h5
                                        class="font-weight-bold mb-1"
                                        data-f="patient_name"
                                    ></h5>

                                    <div class="text-muted small">
                                        លេខកូដអ្នកជំងឺ:
                                        <strong data-f="patient_code"></strong>
                                    </div>
                                </div>
                            </div>

                            <div class="patient-meta mt-3">

                                <span>
                                    <i class="fas fa-venus-mars mr-1"></i>
                                    ភេទ:
                                    <strong data-f="sex"></strong>
                                </span>

                                <span>
                                    <i class="fas fa-birthday-cake mr-1"></i>
                                    អាយុ:
                                    <strong data-f="age"></strong>
                                    ឆ្នាំ
                                </span>

                            </div>

                        </div>


                        <div class="col-md-5 mt-3 mt-md-0">

                            <div class="record-meta-item">
                                <span>
                                    <i class="far fa-calendar-alt mr-1"></i>
                                    កាលបរិច្ឆេទពិនិត្យ
                                </span>

                                <strong data-f="visit_date"></strong>
                            </div>


                            <div class="record-meta-item mt-3">
                                <span>
                                    <i class="fas fa-user-md mr-1"></i>
                                    គ្រូពេទ្យ
                                </span>

                                <strong data-f="doctor"></strong>
                            </div>

                        </div>

                    </div>

                </div>


                {{-- VITAL SIGNS --}}
                <div class="section-title">

                    <div class="section-title-icon vital">
                        <i class="fas fa-heartbeat"></i>
                    </div>

                    <div>
                        <h6 class="mb-0 font-weight-bold">
                            សញ្ញាជីវិត
                        </h6>

                        <small>
                            Vital Signs
                        </small>
                    </div>

                </div>


                <div class="row vital-grid mb-4">

                    @foreach([
                        ['BP', 'bp', 'mmHg', 'fas fa-tint'],
                        ['Heart Rate', 'heart_rate', 'bpm', 'fas fa-heart'],
                        ['Resp. Rate', 'respiratory_rate', '', 'fas fa-lungs'],
                        ['Temperature', 'temperature', '°C', 'fas fa-thermometer-half'],
                        ['SpO2', 'spo2', '%', 'fas fa-lungs'],
                        ['Weight', 'weight', 'kg', 'fas fa-weight']
                    ] as [$label, $key, $unit, $icon])

                        <div class="col-lg-2 col-md-4 col-6 mb-3">

                            <div class="vital-card">

                                <div class="vital-icon">
                                    <i class="{{ $icon }}"></i>
                                </div>

                                <small>
                                    {{ $label }}
                                </small>

                                <div class="vital-value">
                                    <strong data-f="{{ $key }}"></strong>

                                    @if($unit)
                                        <span>{{ $unit }}</span>
                                    @endif
                                </div>

                            </div>

                        </div>

                    @endforeach

                </div>


                {{-- DIAGNOSIS --}}
                <div class="detail-section mb-4">

                    <div class="section-title">

                        <div class="section-title-icon diagnosis">
                            <i class="fas fa-stethoscope"></i>
                        </div>

                        <div>
                            <h6 class="mb-0 font-weight-bold">
                                ការវិនិច្ឆ័យរោគ
                            </h6>

                            <small>
                                Diagnosis
                            </small>
                        </div>

                    </div>


                    <div
                        class="detail-content"
                        data-f="diagnosis"
                        data-empty="គ្មានការវិនិច្ឆ័យ"
                    ></div>

                </div>


                {{-- NOTES --}}
                <div class="detail-section">

                    <div class="section-title">

                        <div class="section-title-icon notes">
                            <i class="fas fa-clipboard"></i>
                        </div>

                        <div>
                            <h6 class="mb-0 font-weight-bold">
                                ចំណាំបន្ថែម
                            </h6>

                            <small>
                                Notes / Symptoms
                            </small>
                        </div>

                    </div>


                    <div
                        class="detail-content"
                        data-f="notes"
                        data-empty="គ្មានចំណាំ"
                    ></div>

                </div>

            </div>


            <div class="modal-footer medical-modal-footer">

                <button
                    type="button"
                    class="btn btn-modal-close"
                    data-dismiss="modal"
                >
                    <i class="fas fa-times mr-1"></i>
                    បិទ
                </button>

            </div>

        </div>

    </div>

</div>



{{-- =========================================================
     CREATE MODAL
========================================================= --}}

<div
    class="modal fade medical-modal"
    id="createModal"
    tabindex="-1"
    role="dialog"
    aria-hidden="true"
>

    <div
        class="modal-dialog modal-xl modal-dialog-centered"
        role="document"
    >

        <div class="modal-content">

            <form
                id="createForm"
                method="POST"
                action="{{ route('medical-records.store') }}"
            >

                @csrf

                <div class="modal-header medical-modal-header">

                    <div class="d-flex align-items-center">

                        <div class="modal-header-icon">
                            <i class="fas fa-plus"></i>
                        </div>

                        <div>
                            <h5 class="modal-title font-weight-bold mb-0">
                                បង្កើត Medical Record ថ្មី
                            </h5>

                            <small>
                                Create New Medical Record
                            </small>
                        </div>

                    </div>

                    <button
                        type="button"
                        class="close text-white"
                        data-dismiss="modal"
                    >
                        <span>&times;</span>
                    </button>

                </div>


                <div class="modal-body p-4">

                    <div
                        id="createErrors"
                        class="alert alert-danger d-none medical-error"
                    ></div>


                    {{-- BASIC INFORMATION --}}
                    <div class="form-section-title">
                        <i class="fas fa-user-injured"></i>
                        ព័ត៌មានអ្នកជំងឺ
                    </div>


                    <div class="row">

                        <div class="col-md-5 form-group">

                            <label class="medical-label">
                                ជ្រើសរើសអ្នកជំងឺ
                                <span class="text-danger">*</span>
                            </label>

                            <select
                                name="patient_id"
                                class="form-control medical-input"
                                required
                            >

                                <option value="" disabled selected>
                                    -- ជ្រើសរើសអ្នកជំងឺ --
                                </option>

                                @foreach($patients as $patient)

                                    <option value="{{ $patient->patient_id }}">
                                        {{ $patient->patient_code ?? 'ID: ' . $patient->patient_id }}
                                        -
                                        {{ $patient->full_name }}
                                    </option>

                                @endforeach

                            </select>

                        </div>


                        <div class="col-md-3 form-group">

                            <label class="medical-label">
                                គ្រូពេទ្យពិនិត្យ
                            </label>

                            <div class="input-icon-wrapper">

                                <i class="fas fa-user-md"></i>

                                <input
                                    type="text"
                                    class="form-control medical-input bg-light"
                                    value="{{ auth()->user()->name }}"
                                    readonly
                                >

                            </div>

                        </div>


                        <div class="col-md-4 form-group">

                            <label class="medical-label">
                                កាលបរិច្ឆេទពិនិត្យ
                                <span class="text-danger">*</span>
                            </label>

                            <div class="input-icon-wrapper">

                                <i class="far fa-calendar-alt"></i>

                                <input
                                    type="datetime-local"
                                    name="visit_date"
                                    class="form-control medical-input"
                                    required
                                >

                            </div>

                        </div>

                    </div>


                    {{-- VITAL SIGNS --}}
                    <div class="form-section-title mt-3">
                        <i class="fas fa-heartbeat"></i>
                        សញ្ញាជីវិត (Vital Signs)
                    </div>


                    <div class="row">

                        @foreach([
                            ['bp_systolic', 'BP Systolic (mmHg)', '', '120'],
                            ['bp_diastolic', 'BP Diastolic (mmHg)', '', '80'],
                            ['heart_rate', 'Heart Rate (bpm)', '', '72'],
                            ['respiratory_rate', 'Respiratory Rate', '', '18'],
                            ['temperature', 'Temperature (°C)', '0.1', '36.5'],
                            ['spo2', 'SpO2 (%)', '0.1', '98'],
                            ['weight', 'Weight (kg)', '0.1', '65']
                        ] as [$name, $label, $step, $ph])

                            <div class="col-xl-3 col-lg-4 col-md-6 form-group">

                                <label class="medical-label">
                                    {{ $label }}
                                </label>

                                <input
                                    type="number"
                                    name="{{ $name }}"
                                    class="form-control medical-input"
                                    placeholder="{{ $ph }}"
                                    @if($step)
                                        step="{{ $step }}"
                                    @endif
                                >

                            </div>

                        @endforeach

                    </div>


                    {{-- DIAGNOSIS --}}
                    <div class="form-section-title mt-3">
                        <i class="fas fa-stethoscope"></i>
                        ការវិនិច្ឆ័យរោគ
                    </div>


                    <div class="form-group">

                        <label class="medical-label">
                            Diagnosis
                        </label>

                        <textarea
                            name="diagnosis"
                            class="form-control medical-input"
                            rows="3"
                            placeholder="បញ្ចូលលទ្ធផលនៃការវិនិច្ឆ័យ..."
                        ></textarea>

                    </div>


                    {{-- NOTES --}}
                    <div class="form-group mb-0">

                        <label class="medical-label">
                            ចំណាំបន្ថែម
                        </label>

                        <textarea
                            name="notes"
                            class="form-control medical-input"
                            rows="3"
                            placeholder="បញ្ចូលរោគសញ្ញា ឬការកត់សម្គាល់បន្ថែម..."
                        ></textarea>

                    </div>

                </div>


                <div class="modal-footer medical-modal-footer">

                    <button
                        type="button"
                        class="btn btn-modal-close"
                        data-dismiss="modal"
                    >
                        បោះបង់
                    </button>

                    <button
                        type="submit"
                        id="createSave"
                        class="btn btn-modal-save"
                    >
                        <i class="fas fa-save mr-1"></i>
                        រក្សាទុក Medical Record
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>



{{-- =========================================================
     EDIT MODAL
========================================================= --}}

<div
    class="modal fade medical-modal"
    id="editModal"
    tabindex="-1"
    role="dialog"
    aria-hidden="true"
>

    <div
        class="modal-dialog modal-xl modal-dialog-centered"
        role="document"
    >

        <div class="modal-content">

            <form
                id="editForm"
                method="POST"
                action=""
            >

                @csrf
                @method('PUT')


                <div class="modal-header medical-modal-header">

                    <div class="d-flex align-items-center">

                        <div class="modal-header-icon">
                            <i class="fas fa-edit"></i>
                        </div>

                        <div>

                            <h5 class="modal-title font-weight-bold mb-0">
                                កែប្រែ Medical Record
                                <span id="editTitle"></span>
                            </h5>

                            <small>
                                Edit Medical Record
                            </small>

                        </div>

                    </div>


                    <button
                        type="button"
                        class="close text-white"
                        data-dismiss="modal"
                    >
                        <span>&times;</span>
                    </button>

                </div>


                <div class="modal-body p-4">

                    <div
                        id="editErrors"
                        class="alert alert-danger d-none medical-error"
                    ></div>


                    {{-- BASIC INFORMATION --}}
                    <div class="form-section-title">
                        <i class="fas fa-user-injured"></i>
                        ព័ត៌មានអ្នកជំងឺ
                    </div>


                    <div class="row">

                        <div class="col-md-8 form-group">

                            <label class="medical-label">
                                ជ្រើសរើសអ្នកជំងឺ
                            </label>

                            <select
                                name="patient_id"
                                class="form-control medical-input"
                                required
                            >

                                @foreach($patients as $patient)

                                    <option value="{{ $patient->patient_id }}">
                                        {{ $patient->full_name }}
                                        ({{ $patient->patient_code }})
                                    </option>

                                @endforeach

                            </select>

                        </div>


                        <div class="col-md-4 form-group">

                            <label class="medical-label">
                                គ្រូពេទ្យពិនិត្យ
                            </label>

                            <div class="input-icon-wrapper">

                                <i class="fas fa-user-md"></i>

                                <input
                                    type="text"
                                    id="editDoctor"
                                    class="form-control medical-input bg-light"
                                    readonly
                                >

                            </div>

                        </div>

                    </div>


                    {{-- VITAL SIGNS --}}
                    <div class="form-section-title mt-3">
                        <i class="fas fa-heartbeat"></i>
                        សញ្ញាជីវិត (Vital Signs)
                    </div>


                    <div class="row">

                        @foreach([
                            ['bp_systolic', 'BP Systolic (mmHg)', ''],
                            ['bp_diastolic', 'BP Diastolic (mmHg)', ''],
                            ['heart_rate', 'Heart Rate (bpm)', ''],
                            ['respiratory_rate', 'Respiratory Rate', ''],
                            ['temperature', 'Temperature (°C)', '0.1'],
                            ['spo2', 'SpO2 (%)', '0.1'],
                            ['weight', 'Weight (kg)', '0.1']
                        ] as [$name, $label, $step])

                            <div class="col-xl-3 col-lg-4 col-md-6 form-group">

                                <label class="medical-label">
                                    {{ $label }}
                                </label>

                                <input
                                    type="number"
                                    name="{{ $name }}"
                                    class="form-control medical-input"
                                    @if($step)
                                        step="{{ $step }}"
                                    @endif
                                >

                            </div>

                        @endforeach

                    </div>


                    {{-- DIAGNOSIS --}}
                    <div class="form-section-title mt-3">
                        <i class="fas fa-stethoscope"></i>
                        ការវិនិច្ឆ័យរោគ
                    </div>


                    <div class="form-group">

                        <label class="medical-label">
                            Diagnosis
                        </label>

                        <textarea
                            name="diagnosis"
                            class="form-control medical-input"
                            rows="3"
                        ></textarea>

                    </div>


                    {{-- NOTES --}}
                    <div class="form-group mb-0">

                        <label class="medical-label">
                            ចំណាំបន្ថែម
                        </label>

                        <textarea
                            name="notes"
                            class="form-control medical-input"
                            rows="3"
                        ></textarea>

                    </div>

                </div>


                <div class="modal-footer medical-modal-footer">

                    <button
                        type="button"
                        class="btn btn-modal-close"
                        data-dismiss="modal"
                    >
                        បោះបង់
                    </button>

                    <button
                        type="submit"
                        id="editSave"
                        class="btn btn-modal-save"
                    >
                        <i class="fas fa-save mr-1"></i>
                        រក្សាទុកការកែប្រែ
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@stop



@section('css')

<style>

:root {
    --hospital-green: #006D36;
    --hospital-green-dark: #00552B;
    --hospital-green-light: #E8F5EE;
    --hospital-green-soft: #F3FAF6;
    --hospital-border: #E7ECE9;
    --hospital-bg: #F5F7F6;
    --hospital-text: #1F2A24;
    --hospital-muted: #7A8780;
    --hospital-danger: #DC3545;
}


/* =========================================================
   PAGE
========================================================= */

.medical-record-page {
    background: var(--hospital-bg);
    padding-top: 4px;
    padding-bottom: 25px;
}


/* =========================================================
   HEADER
========================================================= */

.medical-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 18px;
    padding: 20px 24px;
    margin-bottom: 20px;
    color: #fff;
    border-radius: 16px;
    background: linear-gradient(
        135deg,
        #006D36 0%,
        #008747 100%
    );
    box-shadow: 0 8px 24px rgba(0, 109, 54, 0.16);
}


.medical-header-content {
    display: flex;
    align-items: center;
}


.medical-header-icon {
    width: 52px;
    height: 52px;
    border-radius: 14px;
    background: rgba(255, 255, 255, 0.15);
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 14px;
    font-size: 23px;
}


.medical-header h3 {
    color: #fff;
    font-size: 1.25rem;
}


.medical-header-subtitle {
    color: rgba(255, 255, 255, 0.78);
    font-size: 13px;
}


.btn-create-record {
    background: #fff;
    color: var(--hospital-green);
    border: 0;
    border-radius: 10px;
    padding: 10px 17px;
    font-weight: 700;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.10);
    transition: all .2s ease;
}


.btn-create-record:hover {
    color: var(--hospital-green-dark);
    transform: translateY(-1px);
    box-shadow: 0 7px 16px rgba(0, 0, 0, 0.14);
}


/* =========================================================
   FLASH
========================================================= */

.medical-alert-success {
    background: #EAF8F0;
    color: #12663B;
    border: 1px solid #CFEBDD;
    border-radius: 12px;
    padding: 12px 15px;
}


.alert-icon {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    background: #D5F1E1;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 10px;
}


/* =========================================================
   CARD
========================================================= */

.medical-card {
    background: #fff;
    border: 1px solid var(--hospital-border);
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 5px 18px rgba(31, 42, 36, 0.055);
}


.medical-card-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 15px;
    padding: 16px 20px;
    border-bottom: 1px solid var(--hospital-border);
}


.medical-card-title {
    display: flex;
    align-items: center;
}


.medical-title-icon {
    width: 40px;
    height: 40px;
    border-radius: 11px;
    background: var(--hospital-green-light);
    color: var(--hospital-green);
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 11px;
}


.medical-card-title h6 {
    color: var(--hospital-text);
    font-size: 14px;
}


.medical-card-title small {
    color: var(--hospital-muted);
}


.medical-count {
    background: var(--hospital-green-light);
    color: var(--hospital-green);
    border-radius: 20px;
    padding: 7px 12px;
    font-size: 12px;
    font-weight: 700;
}


.medical-card-body {
    padding: 0;
}


/* =========================================================
   TABLE
========================================================= */

.medical-table {
    min-width: 1050px;
}


.medical-table thead th {
    background: #F8FAF9;
    color: #68756E;
    border-top: 0;
    border-bottom: 1px solid var(--hospital-border);
    padding: 13px 14px;
    font-size: 11px;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: .25px;
    white-space: nowrap;
}


.medical-table tbody td {
    color: var(--hospital-text);
    border-top: 1px solid #EEF2EF;
    padding: 13px 14px;
    vertical-align: middle;
    font-size: 13px;
}


.medical-table tbody tr {
    transition: background .15s ease;
}


.medical-table tbody tr:hover {
    background: #FAFCFB;
}


/* =========================================================
   PAGINATION
========================================================= */

.medical-pagination {
    padding: 15px 20px;
    border-top: 1px solid var(--hospital-border);
}


.medical-pagination .pagination {
    margin-bottom: 0;
}


.medical-pagination .page-link {
    color: var(--hospital-green);
    border-color: var(--hospital-border);
    border-radius: 7px;
    margin: 0 2px;
}


.medical-pagination .page-item.active .page-link {
    background: var(--hospital-green);
    border-color: var(--hospital-green);
}


/* =========================================================
   EMPTY
========================================================= */

.empty-record-icon {
    width: 58px;
    height: 58px;
    border-radius: 16px;
    background: var(--hospital-green-light);
    color: var(--hospital-green);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
}


/* =========================================================
   MODAL
========================================================= */

.medical-modal .modal-content {
    border: 0;
    border-radius: 17px;
    overflow: hidden;
    box-shadow: 0 20px 55px rgba(0, 0, 0, .16);
}


.medical-modal-header {
    border: 0;
    padding: 17px 20px;
    color: #fff;
    background: linear-gradient(
        135deg,
        #006D36 0%,
        #008747 100%
    );
}


.medical-modal-header .modal-title {
    color: #fff;
    font-size: 15px;
}


.medical-modal-header small {
    color: rgba(255, 255, 255, .72);
}


.modal-header-icon {
    width: 42px;
    height: 42px;
    border-radius: 12px;
    background: rgba(255, 255, 255, .15);
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 11px;
}


.medical-modal .modal-body {
    background: #fff;
}


.medical-modal-footer {
    background: #FAFCFB;
    border-top: 1px solid var(--hospital-border);
    padding: 13px 18px;
}


/* =========================================================
   PATIENT INFO
========================================================= */

.patient-info-box {
    background: var(--hospital-green-soft);
    border: 1px solid #DCEDE4;
    border-radius: 14px;
    padding: 17px;
}


.patient-main-name {
    display: flex;
    align-items: center;
}


.patient-avatar {
    width: 46px;
    height: 46px;
    border-radius: 13px;
    background: var(--hospital-green-light);
    color: var(--hospital-green);
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 11px;
    font-size: 19px;
}


.patient-main-name h5 {
    color: var(--hospital-green-dark);
    font-size: 16px;
}


.patient-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 14px;
    color: var(--hospital-muted);
    font-size: 12px;
}


.record-meta-item {
    display: flex;
    flex-direction: column;
    gap: 3px;
}


.record-meta-item span {
    color: var(--hospital-muted);
    font-size: 11px;
}


.record-meta-item strong {
    color: var(--hospital-text);
    font-size: 13px;
}


/* =========================================================
   SECTION TITLE
========================================================= */

.section-title {
    display: flex;
    align-items: center;
    margin-bottom: 13px;
}


.section-title-icon {
    width: 35px;
    height: 35px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 9px;
}


.section-title-icon.vital {
    color: #D93025;
    background: #FDEDEC;
}


.section-title-icon.diagnosis {
    color: var(--hospital-green);
    background: var(--hospital-green-light);
}


.section-title-icon.notes {
    color: #8A6418;
    background: #FFF7E1;
}


.section-title h6 {
    color: var(--hospital-text);
    font-size: 13px;
}


.section-title small {
    color: var(--hospital-muted);
    font-size: 11px;
}


/* =========================================================
   VITAL CARDS
========================================================= */

.vital-card {
    background: #fff;
    border: 1px solid var(--hospital-border);
    border-radius: 12px;
    padding: 12px 8px;
    text-align: center;
    min-height: 108px;
}


.vital-icon {
    width: 30px;
    height: 30px;
    margin: 0 auto 6px;
    border-radius: 9px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: var(--hospital-green-light);
    color: var(--hospital-green);
    font-size: 12px;
}


.vital-card > small {
    display: block;
    color: var(--hospital-muted);
    font-size: 10px;
}


.vital-value {
    margin-top: 4px;
    color: var(--hospital-text);
    font-size: 15px;
}


.vital-value span {
    color: var(--hospital-muted);
    font-size: 10px;
}


/* =========================================================
   DETAIL
========================================================= */

.detail-content {
    background: #F8FAF9;
    border: 1px solid var(--hospital-border);
    border-radius: 11px;
    padding: 14px;
    color: var(--hospital-text);
    line-height: 1.7;
    min-height: 50px;
    white-space: pre-line;
}


/* =========================================================
   FORM
========================================================= */

.form-section-title {
    display: flex;
    align-items: center;
    gap: 8px;
    color: var(--hospital-green-dark);
    font-size: 14px;
    font-weight: 800;
    padding-bottom: 9px;
    margin-bottom: 16px;
    border-bottom: 1px solid var(--hospital-border);
}


.form-section-title i {
    color: var(--hospital-green);
}


.medical-label {
    display: block;
    color: #53615A;
    font-size: 12px;
    font-weight: 700;
    margin-bottom: 7px;
}


.medical-input {
    border: 1px solid #DCE4DF;
    border-radius: 9px;
    min-height: 40px;
    color: var(--hospital-text);
    transition: all .18s ease;
}


.medical-input:focus {
    border-color: var(--hospital-green);
    box-shadow: 0 0 0 3px rgba(0, 109, 54, .09);
}


textarea.medical-input {
    min-height: auto;
}


.input-icon-wrapper {
    position: relative;
}


.input-icon-wrapper > i {
    position: absolute;
    left: 13px;
    top: 13px;
    z-index: 2;
    color: var(--hospital-green);
    font-size: 13px;
}


.input-icon-wrapper .medical-input {
    padding-left: 35px;
}


/* =========================================================
   BUTTONS
========================================================= */

.btn-modal-close {
    background: #F0F3F1;
    color: #59645F;
    border: 1px solid #DCE3DE;
    border-radius: 9px;
    font-weight: 700;
    padding: 8px 15px;
}


.btn-modal-save {
    background: var(--hospital-green);
    color: #fff;
    border: 0;
    border-radius: 9px;
    font-weight: 700;
    padding: 8px 17px;
}


.btn-modal-save:hover {
    background: var(--hospital-green-dark);
    color: #fff;
}


.medical-error {
    border-radius: 10px;
}


/* =========================================================
   RESPONSIVE
========================================================= */

@media (max-width: 991.98px) {

    .medical-header {
        align-items: flex-start;
        flex-direction: column;
    }

    .btn-create-record {
        width: 100%;
    }

}


@media (max-width: 767.98px) {

    .medical-header {
        padding: 17px;
        border-radius: 13px;
    }

    .medical-header-icon {
        width: 44px;
        height: 44px;
        font-size: 19px;
    }

    .medical-header h3 {
        font-size: 1.05rem;
    }

    .medical-card-header {
        align-items: flex-start;
        flex-direction: column;
    }

    .medical-count {
        align-self: flex-start;
    }

    .medical-modal .modal-dialog {
        margin: 10px;
    }

    .patient-meta {
        flex-direction: column;
        gap: 6px;
    }

}


@media (max-width: 575.98px) {

    .medical-record-page {
        padding-left: 8px;
        padding-right: 8px;
    }

    .medical-header {
        padding: 15px;
    }

    .medical-header-content {
        align-items: flex-start;
    }

    .medical-header-subtitle {
        font-size: 11px;
    }

    .medical-card {
        border-radius: 12px;
    }

    .medical-card-header {
        padding: 13px;
    }

    .medical-pagination {
        padding: 12px;
        overflow-x: auto;
    }

    .medical-modal .modal-body {
        padding: 16px !important;
    }

}

</style>

@stop



@section('js')

@parent

<script>

$(function () {

    var PER_PAGE = 10;

    var $view = $('#viewModal');

    var $edit = $('#editModal');
    var $editForm = $('#editForm');
    var $editErrors = $('#editErrors');
    var $editSave = $('#editSave');

    var $create = $('#createModal');
    var $createForm = $('#createForm');
    var $createErrors = $('#createErrors');
    var $createSave = $('#createSave');


    /* =========================================================
       FLASH
    ========================================================= */

    function flash(message, type) {

        var $a = $(
            '<div class="alert medical-alert-success alert-dismissible fade show mb-3">' +
                '<div class="d-flex align-items-center">' +
                    '<div class="alert-icon">' +
                        '<i class="fas fa-check"></i>' +
                    '</div>' +
                    '<div class="flex-grow-1"></div>' +
                    '<button type="button" class="close" data-dismiss="alert">' +
                        '<span>&times;</span>' +
                    '</button>' +
                '</div>' +
            '</div>'
        );

        $a.removeClass('medical-alert-success');

        if (type === 'danger') {
            $a.addClass('alert-danger');
        } else {
            $a.addClass('medical-alert-success');
        }

        $a.find('.flex-grow-1').text(message);

        $('#flash')
            .empty()
            .append($a);

        setTimeout(function () {
            $a.alert('close');
        }, 3500);
    }


    /* =========================================================
       CURRENT LOCAL DATE TIME
    ========================================================= */

    function nowLocal() {

        var d = new Date();

        d.setMinutes(
            d.getMinutes() - d.getTimezoneOffset()
        );

        return d
            .toISOString()
            .slice(0, 16);
    }


    /* =========================================================
       AJAX SUBMIT
    ========================================================= */

    function ajaxSubmit(
        $form,
        $errors,
        $btn,
        icon,
        onSuccess
    ) {

        $errors
            .addClass('d-none')
            .empty();

        $btn
            .prop('disabled', true)
            .find('i')
            .removeClass(icon)
            .addClass('fa-spinner fa-spin');


        fetch(
            $form.attr('action'),
            {
                method: 'POST',

                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': $form
                        .find('input[name="_token"]')
                        .val()
                },

                body: new FormData($form[0])
            }
        )

        .then(function (res) {

            return res
                .json()
                .then(function (json) {

                    return {
                        ok: res.ok,
                        json: json
                    };

                });

        })

        .then(function (r) {

            if (!r.ok) {

                var msgs = r.json.errors
                    ? Object
                        .values(r.json.errors)
                        .map(function (e) {
                            return e[0];
                        })
                    : [
                        r.json.message ||
                        'មានបញ្ហា'
                    ];

                $errors
                    .html(msgs.join('<br>'))
                    .removeClass('d-none');

                return;
            }

            onSuccess(r.json);

        })

        .catch(function () {

            $errors
                .text(
                    'មានបញ្ហាការតភ្ជាប់ សូមព្យាយាមម្តងទៀត'
                )
                .removeClass('d-none');

        })

        .finally(function () {

            $btn
                .prop('disabled', false)
                .find('i')
                .removeClass('fa-spinner fa-spin')
                .addClass(icon);

        });

    }


    /* =========================================================
       CREATE
    ========================================================= */

    function openCreate(patientId) {

        $createErrors
            .addClass('d-none')
            .empty();

        $createForm[0].reset();

        $createForm
            .find('[name=visit_date]')
            .val(nowLocal());

        if (patientId) {

            $createForm
                .find('[name=patient_id]')
                .val(String(patientId));

        }

        $create.modal('show');
    }


    $('#btnCreate').on(
        'click',
        function () {
            openCreate();
        }
    );


    /* Open from old create route */

    var params = new URLSearchParams(
        window.location.search
    );


    if (params.get('create')) {

        openCreate(
            params.get('patient_id')
        );

        history.replaceState(
            null,
            '',
            window.location.pathname
        );
    }


    /* CREATE SAVE */

    $createForm.on(
        'submit',
        function (e) {

            e.preventDefault();

            ajaxSubmit(
                $createForm,
                $createErrors,
                $createSave,
                'fa-save',
                function (json) {

                    $('#empty-row').remove();

                    $('#records-body')
                        .prepend(json.row);

                    var $rows =
                        $('#records-body tr[id^=row-]');

                    if ($rows.length > PER_PAGE) {
                        $rows.last().remove();
                    }

                    $create.modal('hide');

                    flash(
                        json.message,
                        'success'
                    );

                }
            );

        }
    );


    /* =========================================================
       VIEW
    ========================================================= */

    $('#records-body').on(
        'click',
        '.btn-view',
        function () {

            var d = $(this)
                .closest('tr')
                .data('record');


            $view
                .find('[data-f]')
                .each(function () {

                    var $field = $(this);

                    var key = $field.data('f');

                    var value = d[key];

                    var empty =
                        $field.data('empty') ||
                        '-';


                    $field.text(
                        value === null ||
                        value === undefined ||
                        value === ''
                            ? empty
                            : value
                    );

                });


            $view.modal('show');

        }
    );


    /* =========================================================
       EDIT
    ========================================================= */

    $('#records-body').on(
        'click',
        '.btn-edit',
        function () {

            var d = $(this)
                .closest('tr')
                .data('record');


            $editErrors
                .addClass('d-none')
                .empty();


            $editForm.attr(
                'action',
                d.update_url
            );


            $('#editTitle')
                .text('#MR-' + d.id);


            $('#editDoctor')
                .val(d.doctor);


            $editForm
                .find('[name]')
                .each(function () {

                    if (
                        this.name === '_token' ||
                        this.name === '_method'
                    ) {
                        return;
                    }


                    var value =
                        d[this.name];


                    $(this).val(
                        value === null ||
                        value === undefined
                            ? ''
                            : value
                    );

                });


            $edit.modal('show');

        }
    );


    /* EDIT SAVE */

    $editForm.on(
        'submit',
        function (e) {

            e.preventDefault();

            ajaxSubmit(
                $editForm,
                $editErrors,
                $editSave,
                'fa-save',
                function (json) {

                    var id =
                        $editForm
                            .attr('action')
                            .split('/')
                            .pop();


                    $('#row-' + id)
                        .replaceWith(json.row);


                    $edit.modal('hide');


                    flash(
                        json.message,
                        'success'
                    );

                }
            );

        }
    );


});

</script>

@stop