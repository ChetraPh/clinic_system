@extends('adminlte::page')

@section('title', 'គ្រប់គ្រងការណាត់ជួប (Appointment Management)')

@section('content')
<style>
    :root {
        --hospital-green: #006D36;
        --hospital-green-dark: #00552B;
        --hospital-green-light: #E8F5EE;
        --hospital-green-soft: #F4FAF6;
        --hospital-bg: #F5F7F6;
        --hospital-border: #E7ECE9;
        --hospital-text: #1F2A24;
        --hospital-muted: #7A8780;
    }

    body {
        background: var(--hospital-bg);
    }

    /* =========================
       Page Header
    ========================= */

    .page-header {
        background: linear-gradient(135deg, #006D36 0%, #008747 100%);
        border-radius: 16px;
        padding: 24px 28px;
        margin-bottom: 22px;
        color: #fff;
        box-shadow: 0 8px 24px rgba(0, 109, 54, .16);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
    }

    .page-header-content {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .page-header-icon {
        width: 54px;
        height: 54px;
        background: rgba(255, 255, 255, .15);
        border: 1px solid rgba(255, 255, 255, .22);
        border-radius: 13px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        flex-shrink: 0;
    }

    .page-header h2 {
        margin: 0;
        font-size: 22px;
        font-weight: 700;
    }

    .page-header p {
        margin: 5px 0 0;
        font-size: 13px;
        color: rgba(255, 255, 255, .82);
    }

    .btn-header-create {
        background: #fff;
        color: var(--hospital-green);
        border: 0;
        border-radius: 10px;
        padding: 10px 17px;
        font-size: 13px;
        font-weight: 700;
        box-shadow: 0 4px 12px rgba(0, 0, 0, .08);
        white-space: nowrap;
        transition: all .18s ease;
    }

    .btn-header-create:hover {
        background: #F4FAF6;
        color: var(--hospital-green-dark);
        transform: translateY(-1px);
    }

    /* =========================
       Statistics
    ========================= */

    .stat-card {
        background: #fff;
        border: 1px solid var(--hospital-border);
        border-radius: 14px;
        padding: 17px;
        display: flex;
        align-items: center;
        min-height: 88px;
        box-shadow: 0 3px 12px rgba(31, 42, 36, .045);
        transition: all .18s ease;
    }

    .stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 7px 18px rgba(31, 42, 36, .08);
    }

    .stat-card .icon {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        margin-right: 13px;
        flex-shrink: 0;
    }

    .stat-card small {
        color: var(--hospital-muted) !important;
        font-size: 11px;
        font-weight: 600;
    }

    .stat-card h3 {
        color: var(--hospital-text);
        font-size: 22px;
        margin-top: 4px !important;
    }

    .bg-light-primary {
        background: var(--hospital-green-light);
        color: var(--hospital-green);
    }

    .bg-light-info {
        background: #EAF5F1;
        color: #087F5B;
    }

    .bg-light-success {
        background: #E8F5EE;
        color: #198754;
    }

    .bg-light-danger {
        background: #FDECEC;
        color: #C62828;
    }

    /* =========================
       Main Card
    ========================= */

    .appointment-card {
        background: #fff;
        border: 1px solid var(--hospital-border);
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(31, 42, 36, .05);
    }

    /* =========================
       Toolbar
    ========================= */

    .toolbar {
        display: flex;
        gap: 11px;
        align-items: center;
        padding: 16px 20px;
        background: #fff;
        border-bottom: 1px solid var(--hospital-border);
    }

    .search-box {
        position: relative;
        flex: 1;
        min-width: 240px;
    }

    .search-box i {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: #9AA59F;
        z-index: 2;
        font-size: 13px;
    }

    .search-box input {
        height: 40px;
        padding-left: 38px;
        border-radius: 9px;
        background: #F8FAF9;
        border: 1px solid var(--hospital-border);
        color: var(--hospital-text);
        font-size: 13px;
        transition: all .18s ease;
    }

    .search-box input::placeholder {
        color: #9AA59F;
    }

    .search-box input:focus {
        background: #fff;
        border-color: #8CC8A6;
        box-shadow: 0 0 0 3px rgba(0, 109, 54, .08);
    }

    .filter-box {
        display: flex;
        gap: 9px;
    }

    .filter-box .form-control {
        height: 40px;
        border-radius: 9px !important;
        background: #F8FAF9;
        border: 1px solid var(--hospital-border);
        color: #46534C;
        font-size: 13px;
    }

    .filter-box .form-control:focus {
        background: #fff;
        border-color: #8CC8A6;
        box-shadow: 0 0 0 3px rgba(0, 109, 54, .08);
    }

    .btn-create {
        height: 40px;
        border: 0;
        border-radius: 9px;
        background: linear-gradient(135deg, #006D36 0%, #008747 100%);
        color: #fff;
        padding: 0 17px;
        font-size: 13px;
        font-weight: 700;
        white-space: nowrap;
        box-shadow: 0 4px 10px rgba(0, 109, 54, .14);
        transition: all .18s ease;
    }

    .btn-create:hover {
        color: #fff;
        background: linear-gradient(135deg, #00552B 0%, #006D36 100%);
        transform: translateY(-1px);
        box-shadow: 0 6px 14px rgba(0, 109, 54, .2);
    }

    /* =========================
       Table Container
    ========================= */

    #appointmentTableContainer {
        transition: opacity .2s ease;
    }

    .table-wrapper {
        overflow-x: auto;
    }

    /* =========================
       Modal
    ========================= */

    .modal-content {
        border-radius: 15px !important;
        overflow: hidden;
    }

    .modal-header-custom {
        background: linear-gradient(135deg, #006D36 0%, #008747 100%);
        color: #fff;
        border: 0;
        padding: 17px 20px;
    }

    .modal-header-custom .modal-title {
        font-size: 16px;
    }

    .modal-header-custom .close {
        opacity: 1;
        text-shadow: none;
        font-size: 24px;
    }

    .modal-body {
        background: #fff;
    }

    .modal-body label {
        color: var(--hospital-text);
        font-size: 13px;
        margin-bottom: 7px;
    }

    .modal-body .form-control {
        border: 1px solid var(--hospital-border);
        border-radius: 9px;
        min-height: 40px;
        font-size: 13px;
        color: var(--hospital-text);
        background: #fff;
        transition: all .18s ease;
    }

    .modal-body textarea.form-control {
        min-height: auto;
    }

    .modal-body .form-control:focus {
        border-color: #8CC8A6;
        box-shadow: 0 0 0 3px rgba(0, 109, 54, .08);
    }

    .modal-body .form-control.bg-light {
        background: #F8FAF9 !important;
    }

    .modal-footer {
        border-top: 1px solid var(--hospital-border);
        padding: 13px 20px;
    }

    .modal-footer.bg-light {
        background: #F8FAF9 !important;
    }

    .btn-modal-cancel {
        border-radius: 9px;
        font-size: 13px;
        font-weight: 600;
        padding: 8px 17px;
    }

    .btn-modal-save {
        border: 0;
        border-radius: 9px;
        background: var(--hospital-green);
        color: #fff;
        font-size: 13px;
        font-weight: 700;
        padding: 8px 17px;
    }

    .btn-modal-save:hover {
        background: var(--hospital-green-dark);
        color: #fff;
    }

    /* =========================
       Delete Modal
    ========================= */

    .delete-header {
        background: linear-gradient(135deg, #C62828 0%, #E53935 100%);
        color: #fff;
        border: 0;
        padding: 17px 20px;
    }

    .delete-warning-icon {
        width: 58px;
        height: 58px;
        border-radius: 50%;
        background: #FDECEC;
        color: #DC3545;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 23px;
        margin-bottom: 13px;
    }

    .delete-header .modal-title {
        font-size: 16px;
    }

    .btn-delete-confirm {
        border: 0;
        border-radius: 9px;
        padding: 8px 18px;
        font-size: 13px;
        font-weight: 700;
    }

    /* =========================
       Toast
    ========================= */

    .toast-custom {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 9999;
        min-width: 280px;
        max-width: 420px;
        padding: 12px 17px;
        border-radius: 10px;
        color: #fff;
        font-size: 13px;
        font-weight: 600;
        box-shadow: 0 8px 25px rgba(0, 0, 0, .15);
        animation: toastIn .25s ease;
    }

    .toast-custom.success {
        background: linear-gradient(135deg, #006D36 0%, #198754 100%);
    }

    .toast-custom.error {
        background: linear-gradient(135deg, #C62828 0%, #E53935 100%);
    }

    @keyframes toastIn {
        from {
            opacity: 0;
            transform: translateY(-8px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* =========================
       Responsive
    ========================= */

    @media (max-width: 1199.98px) {
        .toolbar {
            flex-wrap: wrap;
        }

        .search-box {
            min-width: 100%;
            flex-basis: 100%;
        }

        .btn-create {
            margin-left: auto;
        }
    }

    @media (max-width: 767.98px) {
        .page-header {
            padding: 20px;
            align-items: flex-start;
        }

        .page-header-content {
            align-items: flex-start;
        }

        .page-header h2 {
            font-size: 18px;
        }

        .page-header p {
            font-size: 12px;
        }

        .page-header-icon {
            width: 46px;
            height: 46px;
            font-size: 18px;
        }

        .btn-header-create {
            display: none;
        }

        .filter-box {
            width: 100%;
            flex-direction: column;
        }

        .filter-box .form-control {
            width: 100% !important;
        }

        .btn-create {
            width: 100%;
            margin-left: 0;
        }
    }

    @media (max-width: 575.98px) {
        .stat-card {
            padding: 14px;
        }

        .stat-card .icon {
            width: 44px;
            height: 44px;
            font-size: 18px;
        }

        .stat-card h3 {
            font-size: 20px;
        }

        .toolbar {
            padding: 14px;
        }

        .modal-dialog {
            margin: 10px;
        }
    }
</style>

<div id="toastContainer"></div>

{{-- =========================
     Page Header
========================= --}}
<div class="page-header">
    <div class="page-header-content">
        <div class="page-header-icon">
            <i class="fas fa-calendar-check"></i>
        </div>

        <div>
            <h2>គ្រប់គ្រងការណាត់ជួប</h2>
            <p>គ្រប់គ្រង និងតាមដានការណាត់ជួបរបស់អ្នកជំងឺ</p>
        </div>
    </div>

    <button class="btn-header-create" data-toggle="modal" data-target="#modalCreate">
        <i class="fas fa-calendar-plus mr-1"></i>
        បង្កើតការណាត់ជួប
    </button>
</div>

{{-- =========================
     Statistics
========================= --}}
<div class="row mb-4">
    <div class="col-xl col-lg-4 col-md-6 col-sm-6 mb-3">
        <div class="stat-card">
            <div class="icon bg-light-primary">
                <i class="fas fa-calendar-alt"></i>
            </div>

            <div>
                <small class="d-block">ការណាត់ជួបសរុប</small>
                <h3 id="statTotal" class="m-0 font-weight-bold">
                    {{ $totalAppointments }}
                </h3>
            </div>
        </div>
    </div>

    <div class="col-xl col-lg-4 col-md-6 col-sm-6 mb-3">
        <div class="stat-card">
            <div class="icon bg-light-info">
                <i class="fas fa-clock"></i>
            </div>

            <div>
                <small class="d-block">បានណាត់ទុក</small>
                <h3 id="statScheduled" class="m-0 font-weight-bold">
                    {{ $scheduledCount }}
                </h3>
            </div>
        </div>
    </div>

    <div class="col-xl col-lg-4 col-md-6 col-sm-6 mb-3">
        <div class="stat-card">
            <div class="icon bg-light-success">
                <i class="fas fa-check-circle"></i>
            </div>

            <div>
                <small class="d-block">បានរួចរាល់</small>
                <h3 id="statCompleted" class="m-0 font-weight-bold">
                    {{ $completedCount }}
                </h3>
            </div>
        </div>
    </div>

    <div class="col-xl col-lg-4 col-md-6 col-sm-6 mb-3">
        <div class="stat-card">
            <div class="icon bg-light-danger">
                <i class="fas fa-times-circle"></i>
            </div>

            <div>
                <small class="d-block">បានបោះបង់</small>
                <h3 id="statCancelled" class="m-0 font-weight-bold">
                    {{ $cancelledCount }}
                </h3>
            </div>
        </div>
    </div>

    <div class="col-xl col-lg-4 col-md-6 col-sm-6 mb-3">
        <div class="stat-card">
            <div class="icon bg-light-danger">
                <i class="fas fa-exclamation-triangle"></i>
            </div>

            <div>
                <small class="d-block">ហួសកំណត់</small>
                <h3 id="statOverdue" class="m-0 font-weight-bold text-danger">
                    {{ $overdueCount }}
                </h3>
            </div>
        </div>
    </div>
</div>

{{-- =========================
     Main Appointment Card
========================= --}}
<div class="appointment-card mb-4">

    {{-- Toolbar --}}
    <div class="toolbar flex-wrap">

        <div class="search-box">
            <i class="fas fa-search"></i>

            <input type="text"
                id="search"
                class="form-control"
                placeholder="ស្វែងរកតាមឈ្មោះអ្នកជំងឺ, លេខទូរស័ព្ទ, ឈ្មោះគ្រូពេទ្យ...">
        </div>

        <div class="filter-box">

            <select id="filterStatus" class="form-control" style="width: 170px;">
                <option value="">-- គ្រប់ស្ថានភាព --</option>
                <option value="scheduled">បានណាត់ទុក (Scheduled)</option>
                <option value="completed">បានរួចរាល់ (Completed)</option>
                <option value="cancelled">បានបោះបង់ (Cancelled)</option>
                <option value="overdue">ហួសកំណត់ (Overdue)</option>
            </select>

            <input type="date"
                id="filterDate"
                class="form-control"
                style="width: 160px;">
        </div>

        <button class="btn-create ml-auto"
            data-toggle="modal"
            data-target="#modalCreate">

            <i class="fas fa-calendar-plus mr-1"></i>
            បង្កើតការណាត់ជួប
        </button>
    </div>

    {{-- Table --}}
    <div class="px-3 py-2">
        <div id="appointmentTableContainer">
            @include('form.appointment.partials.table')
        </div>
    </div>
</div>


{{-- =========================
     Create Appointment Modal
========================= --}}
<div class="modal fade" id="modalCreate" tabindex="-1" aria-hidden="true">

    <div class="modal-dialog modal-lg">

        <div class="modal-content border-0 shadow-lg">

            <div class="modal-header modal-header-custom">

                <h5 class="modal-title font-weight-bold">
                    <i class="fas fa-calendar-plus mr-2"></i>
                    បង្កើតការណាត់ជួបថ្មី
                    (New Appointment)
                </h5>

                <button type="button"
                    class="close text-white"
                    data-dismiss="modal"
                    aria-label="Close">

                    <span aria-hidden="true">&times;</span>
                </button>

            </div>

            <form action="{{ route('appointment.store') }}" method="POST">

                @csrf

                <div class="modal-body p-4">

                    <div class="row">

                        {{-- Patient --}}
                        <div class="col-md-6 mb-3">

                            <label class="font-weight-bold">
                                អ្នកជំងឺ (Patient)
                                <span class="text-danger">*</span>
                            </label>

                            <select name="patient_id"
                                class="form-control"
                                required>

                                <option value="">
                                    -- ជ្រើសរើសអ្នកជំងឺ --
                                </option>

                                @foreach ($patients as $pat)

                                    <option value="{{ $pat->patient_id }}">
                                        {{ $pat->full_name }}
                                        ({{ $pat->phone ?? 'គ្មានលេខទូរស័ព្ទ' }})
                                    </option>

                                @endforeach

                            </select>

                        </div>

                        {{-- Doctor --}}
                        <div class="col-md-6 mb-3">

                            <label class="font-weight-bold">
                                វេជ្ជបណ្ឌិត (Doctor)
                                <span class="text-danger">*</span>
                            </label>

                            @if($isDoctorOnly)

                                <input type="text"
                                    class="form-control bg-light"
                                    value="Dr. {{ auth()->user()->name }}"
                                    readonly>

                            @else

                                <select name="user_id"
                                    class="form-control"
                                    required>

                                    <option value="">
                                        -- ជ្រើសរើសវេជ្ជបណ្ឌិត --
                                    </option>

                                    @foreach ($doctors as $doc)

                                        <option value="{{ $doc->id }}">
                                            Dr. {{ $doc->name }}
                                            ({{ $doc->specialization ?? 'ទូទៅ' }})
                                        </option>

                                    @endforeach

                                </select>

                            @endif

                        </div>

                        {{-- Date --}}
                        <div class="col-md-6 mb-3">

                            <label class="font-weight-bold">
                                កាលបរិច្ឆេទ & ម៉ោងណាត់
                                (Date & Time)
                                <span class="text-danger">*</span>
                            </label>

                            <input type="datetime-local"
                                name="appointment_date"
                                class="form-control"
                                required>

                        </div>

                        {{-- Status --}}
                        <div class="col-md-6 mb-3">

                            <label class="font-weight-bold">
                                ស្ថានភាព (Status)
                                <span class="text-danger">*</span>
                            </label>

                            <select name="status"
                                class="form-control"
                                required>

                                <option value="scheduled">
                                    បានណាត់ទុក (Scheduled)
                                </option>

                                <option value="completed">
                                    បានរួចរាល់ (Completed)
                                </option>

                                <option value="cancelled">
                                    បានបោះបង់ (Cancelled)
                                </option>

                            </select>

                        </div>

                        {{-- Reason --}}
                        <div class="col-md-12 mb-3">

                            <label class="font-weight-bold">
                                មូលហេតុនៃការណាត់ / រោគសញ្ញា
                                (Reason)
                            </label>

                            <textarea name="reason"
                                class="form-control"
                                rows="3"
                                placeholder="បញ្ជាក់ពីមូលហេតុនៃការណាត់ជួប..."></textarea>

                        </div>

                    </div>

                </div>

                <div class="modal-footer bg-light">

                    <button type="button"
                        class="btn btn-secondary btn-modal-cancel"
                        data-dismiss="modal">

                        បោះបង់

                    </button>

                    <button type="submit"
                        class="btn btn-modal-save">

                        <i class="fas fa-save mr-1"></i>
                        រក្សាទុក

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


{{-- =========================
     Edit Appointment Modal
========================= --}}
<div class="modal fade" id="modalEdit" tabindex="-1" aria-hidden="true">

    <div class="modal-dialog modal-lg">

        <div class="modal-content border-0 shadow-lg">

            <div class="modal-header modal-header-custom">

                <h5 class="modal-title font-weight-bold">

                    <i class="fas fa-edit mr-2"></i>
                    កែប្រែការណាត់ជួប
                    (Edit Appointment)

                </h5>

                <button type="button"
                    class="close text-white"
                    data-dismiss="modal"
                    aria-label="Close">

                    <span aria-hidden="true">&times;</span>

                </button>

            </div>

            <form id="editAppointmentForm"
                method="POST">

                @csrf
                @method('PUT')

                <div class="modal-body p-4">

                    <div class="row">

                        {{-- Patient --}}
                        <div class="col-md-6 mb-3">

                            <label class="font-weight-bold">
                                អ្នកជំងឺ (Patient)
                                <span class="text-danger">*</span>
                            </label>

                            <select id="edit_patient_id"
                                name="patient_id"
                                class="form-control"
                                required>

                                <option value="">
                                    -- ជ្រើសរើសអ្នកជំងឺ --
                                </option>

                                @foreach ($patients as $pat)

                                    <option value="{{ $pat->patient_id }}">
                                        {{ $pat->full_name }}
                                        ({{ $pat->phone ?? 'គ្មានលេខទូរស័ព្ទ' }})
                                    </option>

                                @endforeach

                            </select>

                        </div>

                        {{-- Doctor --}}
                        <div class="col-md-6 mb-3">

                            <label class="font-weight-bold">
                                វេជ្ជបណ្ឌិត (Doctor)
                                <span class="text-danger">*</span>
                            </label>

                            @if($isDoctorOnly)

                                <input type="text"
                                    id="edit_doctor_name"
                                    class="form-control bg-light"
                                    readonly>

                            @else

                                <select id="edit_user_id"
                                    name="user_id"
                                    class="form-control"
                                    required>

                                    <option value="">
                                        -- ជ្រើសរើសវេជ្ជបណ្ឌិត --
                                    </option>

                                    @foreach ($doctors as $doc)

                                        <option value="{{ $doc->id }}">
                                            Dr. {{ $doc->name }}
                                            ({{ $doc->specialization ?? 'ទូទៅ' }})
                                        </option>

                                    @endforeach

                                </select>

                            @endif

                        </div>

                        {{-- Date --}}
                        <div class="col-md-6 mb-3">

                            <label class="font-weight-bold">
                                កាលបរិច្ឆេទ & ម៉ោងណាត់
                                (Date & Time)
                                <span class="text-danger">*</span>
                            </label>

                            <input type="datetime-local"
                                id="edit_appointment_date"
                                name="appointment_date"
                                class="form-control"
                                required>

                        </div>

                        {{-- Status --}}
                        <div class="col-md-6 mb-3">

                            <label class="font-weight-bold">
                                ស្ថានភាព (Status)
                                <span class="text-danger">*</span>
                            </label>

                            <select id="edit_status"
                                name="status"
                                class="form-control"
                                required>

                                <option value="scheduled">
                                    បានណាត់ទុក (Scheduled)
                                </option>

                                <option value="completed">
                                    បានរួចរាល់ (Completed)
                                </option>

                                <option value="cancelled">
                                    បានបោះបង់ (Cancelled)
                                </option>

                            </select>

                        </div>

                        {{-- Reason --}}
                        <div class="col-md-12 mb-3">

                            <label class="font-weight-bold">
                                មូលហេតុនៃការណាត់ / រោគសញ្ញា
                                (Reason)
                            </label>

                            <textarea id="edit_reason"
                                name="reason"
                                class="form-control"
                                rows="3"></textarea>

                        </div>

                    </div>

                </div>

                <div class="modal-footer bg-light">

                    <button type="button"
                        class="btn btn-secondary btn-modal-cancel"
                        data-dismiss="modal">

                        បោះបង់

                    </button>

                    <button type="submit"
                        class="btn btn-modal-save">

                        <i class="fas fa-sync-alt mr-1"></i>
                        កែប្រែទិន្នន័យ

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


{{-- =========================
     Delete Appointment Modal
========================= --}}
<div class="modal fade"
    id="modalDelete"
    tabindex="-1"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content border-0 shadow-lg">

            <div class="modal-header delete-header">

                <h5 class="modal-title font-weight-bold">

                    <i class="fas fa-exclamation-triangle mr-2"></i>
                    បញ្ជាក់ការលុបការណាត់ជួប

                </h5>

                <button type="button"
                    class="close text-white"
                    data-dismiss="modal"
                    aria-label="Close">

                    <span aria-hidden="true">&times;</span>

                </button>

            </div>

            <form id="deleteAppointmentForm"
                method="POST">

                @csrf
                @method('DELETE')

                <div class="modal-body text-center p-4">

                    <div class="delete-warning-icon">
                        <i class="fas fa-trash-alt"></i>
                    </div>

                    <p class="mb-2" style="font-size: 15px;">

                        តើអ្នកពិតជាចង់លុបការណាត់ជួបរបស់អ្នកជំងឺ

                        <strong id="deletePatientName"
                            class="text-danger"></strong>

                        នេះមែនទេ?

                    </p>

                    <small class="text-muted">
                        សកម្មភាពនេះមិនអាចត្រឡប់ក្រោយវិញបានឡើយ។
                    </small>

                </div>

                <div class="modal-footer justify-content-center bg-light">

                    <button type="button"
                        class="btn btn-secondary btn-modal-cancel px-4"
                        data-dismiss="modal">

                        បោះបង់

                    </button>

                    <button type="submit"
                        class="btn btn-danger btn-delete-confirm px-4">

                        <i class="fas fa-trash mr-1"></i>
                        លុបចេញ

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@stop


@section('js')
@parent

<script>
    $(document).ready(function () {

        let debounceTimer;

        function currentParams(page = 1) {
            return {
                page: page,
                search: $('#search').val(),
                status: $('#filterStatus').val(),
                date: $('#filterDate').val()
            };
        }

        function nowLocalString() {
            const d = new Date();

            d.setSeconds(0, 0);

            const tzOffset = d.getTimezoneOffset() * 60000;

            return new Date(d - tzOffset)
                .toISOString()
                .slice(0, 16);
        }

        $('#modalCreate').on('show.bs.modal', function () {

            $(this)
                .find('input[name="appointment_date"]')
                .attr('min', nowLocalString());

        });


        /* =========================
           Load Appointments
        ========================= */

        function loadAppointments(page = 1) {

            const params = currentParams(page);

            $('#appointmentTableContainer')
                .css('opacity', '0.5');

            $.ajax({

                url: "{{ route('appointment.index') }}",

                method: 'GET',

                data: params,

                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },

                success: function (res) {

                    $('#appointmentTableContainer')
                        .html(res.html)
                        .css('opacity', '1');

                    if (res.total !== undefined) {
                        $('#statTotal').text(res.total);
                    }

                    if (res.scheduled !== undefined) {
                        $('#statScheduled').text(res.scheduled);
                    }

                    if (res.completed !== undefined) {
                        $('#statCompleted').text(res.completed);
                    }

                    if (res.cancelled !== undefined) {
                        $('#statCancelled').text(res.cancelled);
                    }

                    if (res.overdue !== undefined) {
                        $('#statOverdue').text(res.overdue);
                    }

                    const qs = $.param(params);

                    history.replaceState(
                        null,
                        '',
                        "{{ route('appointment.index') }}?" + qs
                    );
                },

                error: function () {

                    $('#appointmentTableContainer')
                        .css('opacity', '1');

                    showToast(
                        'មិនអាចទាញយកទិន្នន័យការណាត់ជួបបានទេ',
                        'error'
                    );

                }

            });
        }


        /* =========================
           Search
        ========================= */

        $('#search').on('keyup', function () {

            clearTimeout(debounceTimer);

            debounceTimer = setTimeout(function () {

                loadAppointments(1);

            }, 400);

        });


        /* =========================
           Filters
        ========================= */

        $('#filterStatus, #filterDate').on('change', function () {

            loadAppointments(1);

        });


        /* =========================
           AJAX Pagination
        ========================= */

        $(document).on(
            'click',
            '#appointmentTableContainer .pagination a',
            function (e) {

                e.preventDefault();

                const href = $(this).attr('href');

                if (!href) {
                    return;
                }

                const page =
                    new URL(
                        href,
                        window.location.origin
                    )
                    .searchParams
                    .get('page') || 1;

                loadAppointments(page);

            }
        );


        /* =========================
           Edit Appointment
        ========================= */

        $(document).on('click', '.btn-edit', function () {

            let id = $(this).data('id');

            $.get(
                "{{ url('appointment/edit') }}/" + id,
                function (data) {

                    $('#edit_patient_id')
                        .val(data.patient_id);

                    $('#edit_user_id')
                        .val(data.user_id);

                    $('#edit_doctor_name')
                        .val(
                            data.doctor_name
                                ? 'Dr. ' + data.doctor_name
                                : ''
                        );

                    $('#edit_appointment_date')
                        .val(data.appointment_date);

                    $('#edit_status')
                        .val(data.status);

                    $('#edit_reason')
                        .val(data.reason);

                    $('#editAppointmentForm')
                        .attr(
                            'action',
                            "{{ url('appointment/update') }}/" + id
                        );

                    $('#modalEdit').modal('show');

                }
            ).fail(function () {

                showToast(
                    'មិនអាចទាញយកទិន្នន័យការណាត់ជួបបានទេ',
                    'error'
                );

            });

        });


        /* =========================
           Delete Appointment
        ========================= */

        $(document).on('click', '.btn-delete', function () {

            let id = $(this).data('id');

            let name = $(this).data('name');

            $('#deletePatientName')
                .text(name);

            $('#deleteAppointmentForm')
                .attr(
                    'action',
                    "{{ url('appointment/delete') }}/" + id
                );

        });


        /* =========================
           Toast
        ========================= */

        function showToast(
            message,
            type = 'success'
        ) {

            let toast = `
                <div class="toast-custom ${type}">
                    ${message}
                </div>
            `;

            $('#toastContainer')
                .append(toast);

            setTimeout(function () {

                $('.toast-custom:first')
                    .fadeOut(300, function () {

                        $(this).remove();

                    });

            }, 3000);
        }


        /* =========================
           Session Messages
        ========================= */

        @if(session('success'))

            showToast(
                @json(session('success')),
                'success'
            );

        @endif

        @if(session('error'))

            showToast(
                @json(session('error')),
                'error'
            );

        @endif

    });
</script>
@stop