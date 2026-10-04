@extends('adminlte::page')

@section('title', 'ព័ត៌មានអ្នកជំងឺ')

@section('content_header')
@stop

@section('content')

@php
    $editPatient = isset($editPatient) ? $editPatient : null;

    $editSex = $editPatient
        ? strtolower(old('sex', $editPatient->sex))
        : '';

    $editDobText = $editPatient
        ? old(
            'dob_display',
            $editPatient->date_of_birth
                ? \Carbon\Carbon::parse($editPatient->date_of_birth)->format('d/m/Y')
                : ''
        )
        : '';
@endphp

<style>
    :root {
        --patient-green: #006D36;
        --patient-green-dark: #00552B;
        --patient-green-light: #E8F5EE;
        --patient-bg: #F5F7F6;
        --patient-border: #E7ECE9;
        --patient-text: #1F2A24;
        --patient-muted: #7A8780;
    }

    .patient-container {
        font-family: 'Inter', 'Kantumruuy Pro', sans-serif;
        background: var(--patient-bg);
        min-height: calc(100vh - 60px);
        padding: 4px 0 24px;
    }

    /* =========================
       Header
    ========================= */

    .page-header {
        background: linear-gradient(135deg, #006D36 0%, #008747 100%);
        border-radius: 16px;
        padding: 24px 28px;
        color: #fff;
        box-shadow: 0 5px 18px rgba(0, 109, 54, 0.12);
        margin-bottom: 22px;
    }

    .page-header h2 {
        color: #fff;
        font-size: 1.45rem;
        font-weight: 700;
        margin-bottom: 5px;
    }

    .page-header small {
        color: rgba(255,255,255,.82);
    }

    .page-header-icon {
        width: 48px;
        height: 48px;
        border-radius: 13px;
        background: rgba(255,255,255,.16);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-right: 13px;
        font-size: 20px;
    }

    /* =========================
       Stat Cards
    ========================= */

    .stat-card {
        background: #fff;
        border: 1px solid var(--patient-border);
        border-radius: 14px;
        box-shadow: 0 4px 14px rgba(31, 42, 36, 0.045);
        min-height: 92px;
        transition: all .2s ease;
        overflow: hidden;
    }

    .stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 7px 18px rgba(31, 42, 36, 0.07);
    }

    .stat-icon {
        width: 52px;
        height: 52px;
        min-width: 52px;
        border-radius: 13px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 19px;
        margin-right: 13px;
    }

    .stat-icon.green {
        background: var(--patient-green-light);
        color: var(--patient-green);
    }

    .stat-icon.blue {
        background: #EAF5F8;
        color: #1683A8;
    }

    .stat-icon.red {
        background: #FDECEC;
        color: #D9534F;
    }

    .stat-icon.orange {
        background: #FFF5E6;
        color: #E59B24;
    }

    .stat-label {
        color: var(--patient-muted);
        font-size: .78rem;
        font-weight: 600;
        margin-bottom: 3px;
    }

    .stat-number {
        color: var(--patient-text);
        font-size: 1.25rem;
        font-weight: 700;
        line-height: 1.2;
    }

    .stat-number.orange {
        color: #D98B12;
    }

    /* =========================
       Tabs
    ========================= */

    .patient-tabs {
        border-bottom: 1px solid var(--patient-border) !important;
        margin-bottom: 18px !important;
        gap: 8px;
    }

    .patient-tabs .nav-item {
        margin-right: 0 !important;
    }

    .patient-tabs .nav-link {
        border: 1px solid var(--patient-border) !important;
        border-radius: 10px !important;
        background: #fff;
        color: var(--patient-muted);
        font-weight: 700;
        padding: 11px 18px;
        transition: all .2s ease;
    }

    .patient-tabs .nav-link:hover {
        color: var(--patient-green);
        background: var(--patient-green-light);
        border-color: #cfe5d8 !important;
    }

    .patient-tabs .nav-link.active {
        color: #fff !important;
        background: var(--patient-green) !important;
        border-color: var(--patient-green) !important;
        box-shadow: 0 3px 10px rgba(0,109,54,.14);
    }

    /* =========================
       Panels
    ========================= */

    .panel-card,
    .create-card,
    .edit-card,
    .queue-card {
        background: #fff;
        border: 1px solid var(--patient-border);
        border-radius: 15px;
        box-shadow: 0 4px 16px rgba(31, 42, 36, .045);
        overflow: hidden;
    }

    .panel-header,
    .create-header,
    .edit-header {
        min-height: 70px;
        padding: 16px 20px;
        background: #fff;
        border-bottom: 1px solid var(--patient-border);
    }

    .panel-title,
    .create-title,
    .edit-title {
        color: var(--patient-green);
        font-size: 1rem;
        font-weight: 700;
        margin: 0;
    }

    .panel-title i,
    .create-title i,
    .edit-title i {
        margin-right: 7px;
    }

    /* =========================
       Filter
    ========================= */

    .filter-box {
        background: #F8FAF9;
        border: 1px solid var(--patient-border);
        border-radius: 12px;
        padding: 15px;
        margin-bottom: 18px;
    }

    .filter-label,
    .form-label-custom {
        color: var(--patient-text);
        font-size: .76rem;
        font-weight: 700;
        margin-bottom: 6px;
    }

    .filter-control,
    .form-control-custom {
        border: 1px solid var(--patient-border) !important;
        border-radius: 9px !important;
        background: #fff !important;
        color: var(--patient-text);
        box-shadow: none !important;
    }

    .filter-control:focus,
    .form-control-custom:focus {
        border-color: #7bb99a !important;
        box-shadow: 0 0 0 3px rgba(0,109,54,.07) !important;
    }

    .reset-btn,
    .btn-clear {
        border-radius: 9px;
        font-weight: 700;
        border-color: var(--patient-border);
        color: var(--patient-muted);
        background: #fff;
    }

    .reset-btn:hover,
    .btn-clear:hover {
        color: var(--patient-green);
        border-color: var(--patient-green);
        background: var(--patient-green-light);
    }

    /* =========================
       Table
    ========================= */

    .patient-table {
        margin-bottom: 0;
    }

    .patient-table thead th {
        background: #F8FAF9;
        color: var(--patient-muted);
        border-top: 0 !important;
        border-bottom: 1px solid var(--patient-border) !important;
        padding: 13px 12px;
        font-size: .72rem;
        font-weight: 700;
        text-transform: uppercase;
        white-space: nowrap;
    }

    .patient-table tbody td {
        padding: 14px 12px;
        border-top: 1px solid #F0F3F1;
        color: var(--patient-text);
        vertical-align: middle;
        font-size: .86rem;
    }

    .patient-table tbody tr:hover {
        background: #FAFCFB;
    }

    .patient-code {
        display: inline-block;
        background: var(--patient-green-light);
        color: var(--patient-green-dark);
        border: 1px solid #D5EBDD;
        border-radius: 7px;
        padding: 5px 9px;
        font-size: .78rem;
        font-weight: 700;
    }

    .patient-name {
        font-weight: 700;
        color: var(--patient-text);
    }

    .gender-badge {
        display: inline-block;
        background: #F5F7F6;
        border: 1px solid var(--patient-border);
        color: var(--patient-text);
        border-radius: 7px;
        padding: 4px 8px;
        font-size: .76rem;
    }

    .action-btn {
        width: 34px;
        height: 34px;
        border-radius: 9px;
        border: 1px solid var(--patient-border);
        background: #fff;
        color: var(--patient-muted);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all .2s ease;
    }

    .action-btn:hover {
        color: var(--patient-green);
        border-color: #c9e1d2;
        background: var(--patient-green-light);
    }

    .dropdown-menu {
        border: 1px solid var(--patient-border);
        border-radius: 10px;
        box-shadow: 0 8px 22px rgba(31,42,36,.10);
        padding: 6px;
    }

    .dropdown-item {
        border-radius: 7px;
        padding: 9px 11px;
        font-size: .84rem;
    }

    .dropdown-item:hover {
        background: var(--patient-green-light);
    }

    .dropdown-divider {
        border-top-color: var(--patient-border);
    }

    /* =========================
       Form
    ========================= */

    .form-area {
        background: var(--patient-bg);
        padding: 20px;
    }

    .form-inner {
        background: #fff;
        border: 1px solid var(--patient-border);
        border-radius: 12px;
        padding: 20px;
    }

    .form-control-custom {
        min-height: 42px;
    }

    .form-control-custom::placeholder {
        color: #ADB5BD;
        font-size: .82rem;
    }

    .btn-register,
    .btn-update {
        background: var(--patient-green);
        border: 1px solid var(--patient-green);
        color: #fff;
        border-radius: 9px;
        font-weight: 700;
        padding-left: 22px;
        padding-right: 22px;
        transition: all .2s ease;
    }

    .btn-register:hover,
    .btn-update:hover {
        background: var(--patient-green-dark);
        border-color: var(--patient-green-dark);
        color: #fff;
        transform: translateY(-1px);
    }

    .edit-info {
        background: var(--patient-green-light);
        border: 1px solid #D5EBDD;
        border-radius: 10px;
        padding: 12px 14px;
        margin-bottom: 18px;
        color: var(--patient-green-dark);
        font-size: .82rem;
    }

    /* =========================
       Queue
    ========================= */

    .queue-header {
        background: linear-gradient(135deg, #006D36 0%, #008747 100%);
        min-height: 65px;
        padding: 15px;
        color: #fff;
    }

    .queue-header h6 {
        font-weight: 700;
        margin: 0;
    }

    .queue-count {
        background: #fff;
        color: var(--patient-green);
        border-radius: 7px;
        padding: 5px 8px;
        font-size: .72rem;
        font-weight: 700;
    }

    .queue-body {
        background: var(--patient-bg);
        max-height: 520px;
        overflow-y: auto;
        padding: 12px;
    }

    .queue-item {
        background: #fff;
        border: 1px solid var(--patient-border);
        border-radius: 11px;
        margin-bottom: 9px;
    }

    .queue-item:last-child {
        margin-bottom: 0;
    }

    .queue-name {
        color: var(--patient-text);
        font-size: .86rem;
        font-weight: 700;
        margin-bottom: 4px;
    }

    .queue-code {
        color: var(--patient-muted);
        font-size: .73rem;
    }

    .queue-time {
        background: var(--patient-green-light);
        color: var(--patient-green-dark);
        border: 1px solid #d5ebdd;
        border-radius: 7px;
        font-size: .68rem;
        font-weight: 700;
        padding: 5px 7px;
        white-space: nowrap;
    }

    .queue-empty {
        padding: 55px 15px;
        text-align: center;
    }

    /* =========================
       Alerts
    ========================= */

    .alert-custom {
        border: 0;
        border-radius: 11px;
        box-shadow: 0 3px 12px rgba(31,42,36,.04);
    }

    /* =========================
       Pagination
    ========================= */

    .pagination {
        font-size: .82rem;
        margin-bottom: 0;
    }

    .pagination .page-item .page-link {
        color: var(--patient-green);
        border-color: var(--patient-border);
        border-radius: 7px;
        margin: 0 2px;
    }

    .pagination .page-item.active .page-link {
        background: var(--patient-green) !important;
        border-color: var(--patient-green) !important;
        color: #fff !important;
    }

    /* =========================
       Modal
    ========================= */

    .modal-content {
        border-radius: 15px !important;
        overflow: hidden;
    }

    .modal-delete-header {
        background: linear-gradient(135deg, #DC3545 0%, #C82333 100%);
        color: #fff;
        border: 0;
    }

    .modal-delete-header .close {
        color: #fff;
        opacity: .85;
        text-shadow: none;
    }

    .delete-icon {
        width: 68px;
        height: 68px;
        border-radius: 50%;
        background: #FDECEC;
        color: #DC3545;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 26px;
        margin-bottom: 15px;
    }

    /* =========================
       Responsive
    ========================= */

    @media (max-width: 991.98px) {
        .page-header {
            padding: 20px;
        }

        .page-header h2 {
            font-size: 1.25rem;
        }

        .queue-card {
            margin-top: 4px;
        }
    }

    @media (max-width: 767.98px) {
        .page-header {
            border-radius: 13px;
            padding: 18px;
        }

        .page-header h2 {
            font-size: 1.08rem;
        }

        .patient-tabs .nav-link {
            padding: 9px 12px;
            font-size: .8rem;
        }

        .form-area {
            padding: 12px;
        }

        .form-inner {
            padding: 15px;
        }
    }

    @media (max-width: 575.98px) {
        .patient-tabs {
            display: flex;
            flex-wrap: wrap;
        }

        .patient-tabs .nav-item {
            flex: 1 1 100%;
        }

        .patient-tabs .nav-link {
            width: 100%;
            text-align: center;
        }

        .stat-card {
            min-height: 82px;
        }

        .stat-icon {
            width: 45px;
            height: 45px;
            min-width: 45px;
        }

        .form-area {
            padding: 10px;
        }
    }
</style>


<div class="patient-container">

    {{-- Page Header --}}
    <div class="page-header">

        <div class="d-flex align-items-center">

            <div class="page-header-icon">
                <i class="fas fa-user-injured"></i>
            </div>

            <div>
                <h2>
                    ព័ត៌មាន និងគ្រប់គ្រងអ្នកជំងឺ
                </h2>

                <small>
                    Patient Management · ចុះឈ្មោះ ស្វែងរក កែប្រែ និងគ្រប់គ្រងព័ត៌មានអ្នកជំងឺ
                </small>
            </div>

        </div>

    </div>


    {{-- Statistics --}}
    <div class="row mb-4">

        <div class="col-xl-3 col-md-6 col-sm-6 mb-3">
            <div class="stat-card">
                <div class="card-body d-flex align-items-center p-3">

                    <div class="stat-icon green">
                        <i class="fas fa-users"></i>
                    </div>

                    <div>
                        <div class="stat-label">
                            អ្នកជំងឺសរុបថ្ងៃនេះ
                        </div>

                        <div class="stat-number">
                            {{ $todayCount ?? 0 }} នាក់
                        </div>
                    </div>

                </div>
            </div>
        </div>


        <div class="col-xl-3 col-md-6 col-sm-6 mb-3">
            <div class="stat-card">
                <div class="card-body d-flex align-items-center p-3">

                    <div class="stat-icon blue">
                        <i class="fas fa-user-plus"></i>
                    </div>

                    <div>
                        <div class="stat-label">
                            អ្នកជំងឺថ្មី
                        </div>

                        <div class="stat-number">
                            {{ $newPatients ?? 0 }} នាក់
                        </div>
                    </div>

                </div>
            </div>
        </div>


        <div class="col-xl-3 col-md-6 col-sm-6 mb-3">
            <div class="stat-card">
                <div class="card-body d-flex align-items-center p-3">

                    <div class="stat-icon red">
                        <i class="fas fa-history"></i>
                    </div>

                    <div>
                        <div class="stat-label">
                            អ្នកជំងឺចាស់
                        </div>

                        <div class="stat-number">
                            {{ $oldPatients ?? 0 }} នាក់
                        </div>
                    </div>

                </div>
            </div>
        </div>


        <div class="col-xl-3 col-md-6 col-sm-6 mb-3">
            <div class="stat-card">
                <div class="card-body d-flex align-items-center p-3">

                    <div class="stat-icon orange">
                        <i class="fas fa-hourglass-half"></i>
                    </div>

                    <div>
                        <div class="stat-label">
                            អ្នកជំងឺកំពុងរង់ចាំ
                        </div>

                        <div class="stat-number orange">
                            {{ $waitingCount ?? 0 }} នាក់
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>


    <div class="row">

        {{-- Main Content --}}
        <div class="col-lg-9">

            {{-- Tabs --}}
            <ul class="nav nav-tabs patient-tabs" id="patientTab" role="tablist">

                <li class="nav-item">

                    <a class="nav-link active"
                       id="list-tab"
                       data-toggle="tab"
                       href="#patient-list"
                       role="tab">

                        <i class="fas fa-list mr-1"></i>
                        បញ្ជីអ្នកជំងឺ

                    </a>

                </li>


                <li class="nav-item">

                    <a class="nav-link"
                       id="create-tab"
                       data-toggle="tab"
                       href="#patient-create"
                       role="tab">

                        <i class="fas fa-user-plus mr-1"></i>
                        ចុះឈ្មោះថ្មី

                    </a>

                </li>


                {{-- Edit Tab --}}
                <li class="nav-item" id="edit-tab-item"
                    style="{{ $editPatient ? '' : 'display:none;' }}">

                    <a class="nav-link {{ $editPatient ? 'active' : '' }}"
                       id="edit-tab"
                       data-toggle="tab"
                       href="#patient-edit"
                       role="tab">

                        <i class="fas fa-user-edit mr-1"></i>
                        កែប្រែព័ត៌មាន

                    </a>

                </li>

            </ul>


            <div class="tab-content" id="patientTabContent">


                {{-- =========================
                     Patient List
                ========================= --}}
                <div class="tab-pane fade {{ !$editPatient ? 'show active' : '' }}"
                     id="patient-list"
                     role="tabpanel">

                    <div class="panel-card">

                        <div class="panel-header">

                            <h6 class="panel-title">
                                <i class="fas fa-users"></i>
                                បញ្ជីអ្នកជំងឺ
                            </h6>

                            <small class="text-muted">
                                ស្វែងរក និងគ្រប់គ្រងព័ត៌មានអ្នកជំងឺ
                            </small>

                        </div>


                        <div class="card-body p-3">

                            @if(session('success'))

                                <div class="alert alert-success alert-custom alert-dismissible fade show mb-3">

                                    <i class="fas fa-check-circle mr-2"></i>
                                    {{ session('success') }}

                                    <button type="button"
                                            class="close"
                                            data-dismiss="alert">

                                        <span>&times;</span>

                                    </button>

                                </div>

                            @endif


                            @if ($errors->any() && !$editPatient)

                                <div class="alert alert-danger alert-custom alert-dismissible fade show mb-3">

                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>

                                    <button type="button"
                                            class="close"
                                            data-dismiss="alert">

                                        <span>&times;</span>

                                    </button>

                                </div>

                            @endif


                            {{-- Filter --}}
                            <div class="filter-box">

                                <form id="searchForm"
                                      method="GET"
                                      action="{{ route('patients.index') }}"
                                      class="row align-items-end">

                                    <div class="col-md-4 mb-2 mb-md-0">

                                        <label class="filter-label">
                                            ស្វែងរកអ្នកជំងឺ
                                        </label>

                                        <input type="text"
                                               id="searchInput"
                                               name="search"
                                               class="form-control form-control-sm filter-control"
                                               placeholder="ឈ្មោះ, ID, លេខទូរស័ព្ទ..."
                                               value="{{ request('search') }}"
                                               autocomplete="off">

                                    </div>


                                    <div class="col-md-3 mb-2 mb-md-0">

                                        <label class="filter-label">
                                            កាលបរិច្ឆេទ
                                        </label>

                                        <input type="date"
                                               id="dateInput"
                                               name="date"
                                               class="form-control form-control-sm filter-control"
                                               value="{{ request('date') }}">

                                    </div>


                                    <div class="col-md-3 mb-2 mb-md-0">

                                        <label class="filter-label">
                                            ភេទ
                                        </label>

                                        <select id="genderInput"
                                                name="gender"
                                                class="form-control form-control-sm filter-control">

                                            <option value="">
                                                ទាំងអស់
                                            </option>

                                            <option value="Male"
                                                {{ request('gender') == 'Male' || request('gender') == 'male' ? 'selected' : '' }}>
                                                ប្រុស
                                            </option>

                                            <option value="Female"
                                                {{ request('gender') == 'Female' || request('gender') == 'female' ? 'selected' : '' }}>
                                                ស្រី
                                            </option>

                                        </select>

                                    </div>


                                    <div class="col-md-2">

                                        @if(request()->anyFilled(['search', 'date', 'gender']))

                                            <a href="{{ route('patients.index') }}"
                                               class="btn btn-sm reset-btn btn-block">

                                                <i class="fas fa-undo mr-1"></i>
                                                មើលទាំងអស់

                                            </a>

                                        @endif

                                    </div>

                                </form>

                            </div>


                            {{-- Patient Table --}}
                            <div class="table-responsive">

                                <table class="table patient-table table-hover">

                                    <thead>

                                        <tr>

                                            <th>លេខសម្គាល់</th>
                                            <th>ឈ្មោះពេញ</th>
                                            <th>ភេទ</th>
                                            <th>ថ្ងៃខែឆ្នាំកំណើត</th>
                                            <th>លេខទូរស័ព្ទ</th>
                                            <th>ថ្ងៃចុះឈ្មោះ</th>
                                            <th class="text-center">សកម្មភាព</th>

                                        </tr>

                                    </thead>


                                    <tbody>

                                        @forelse($patients as $patient)

                                            <tr>

                                                <td>
                                                    <span class="patient-code">
                                                        {{ $patient->patient_code }}
                                                    </span>
                                                </td>


                                                <td>
                                                    <span class="patient-name">
                                                        {{ $patient->full_name }}
                                                    </span>
                                                </td>


                                                <td>

                                                    <span class="gender-badge">

                                                        {{ strtolower($patient->sex) == 'male'
                                                            ? 'ប្រុស'
                                                            : 'ស្រី' }}

                                                    </span>

                                                </td>


                                                <td>

                                                    <span class="text-muted small">

                                                        {{ $patient->date_of_birth
                                                            ? \Carbon\Carbon::parse($patient->date_of_birth)->format('Y-m-d')
                                                            : '-' }}

                                                    </span>

                                                </td>


                                                <td>
                                                    {{ $patient->phone ?? '-' }}
                                                </td>


                                                <td>

                                                    <span class="text-muted small">

                                                        {{ $patient->created_at
                                                            ? $patient->created_at->format('d/m/Y')
                                                            : '-' }}

                                                    </span>

                                                </td>


                                                <td class="text-center">

                                                    <div class="dropdown">

                                                        <button type="button"
                                                                class="action-btn"
                                                                data-toggle="dropdown"
                                                                title="សកម្មភាព">

                                                            <i class="fas fa-ellipsis-h"></i>

                                                        </button>


                                                        <div class="dropdown-menu dropdown-menu-right">

                                                            <a href="{{ route('patients.show', $patient->patient_id) }}"
                                                               class="dropdown-item">

                                                                <i class="fas fa-eye mr-2 text-info"></i>
                                                                មើលព័ត៌មាន

                                                            </a>


                                                            <a href="{{ route('patients.print', $patient->patient_id) }}"
                                                               target="_blank"
                                                               class="dropdown-item">

                                                                <i class="fas fa-print mr-2 text-success"></i>
                                                                បោះពុម្ព

                                                            </a>


                                                            {{-- Edit --}}
                                                            <a href="{{ route('patients.edit', $patient->patient_id) }}"
                                                               class="dropdown-item">

                                                                <i class="fas fa-edit mr-2 text-primary"></i>
                                                                កែប្រែ

                                                            </a>


                                                            <div class="dropdown-divider"></div>


                                                            <button type="button"
                                                                    class="dropdown-item text-danger btn-delete-patient"
                                                                    data-id="{{ $patient->patient_id }}"
                                                                    data-name="{{ $patient->full_name }}"
                                                                    data-toggle="modal"
                                                                    data-target="#modalDeletePatient">

                                                                <i class="fas fa-trash mr-2"></i>
                                                                លុប

                                                            </button>

                                                        </div>

                                                    </div>

                                                </td>

                                            </tr>

                                        @empty

                                            <tr>

                                                <td colspan="7"
                                                    class="text-center"
                                                    style="padding:50px;color:#7A8780;">

                                                    <i class="fas fa-user-slash d-block mb-2"
                                                       style="font-size:2.4rem;color:#006D36;opacity:.45;"></i>

                                                    មិនទាន់មានទិន្នន័យអ្នកជំងឺឡើយ

                                                </td>

                                            </tr>

                                        @endforelse

                                    </tbody>

                                </table>

                            </div>


                            <div class="d-flex justify-content-end mt-3">

                                {{ $patients->appends(request()->query())->links() }}

                            </div>

                        </div>

                    </div>

                </div>


                {{-- =========================
                     Create Patient
                ========================= --}}
                <div class="tab-pane fade"
                     id="patient-create"
                     role="tabpanel">

                    @if ($errors->any() && !$editPatient)

                        <div class="alert alert-danger alert-custom">

                            <ul class="mb-0">

                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach

                            </ul>

                        </div>

                    @endif


                    @if (session('error'))

                        <div class="alert alert-danger alert-custom mb-3">

                            <i class="fas fa-exclamation-triangle mr-2"></i>
                            {{ session('error') }}

                        </div>

                    @endif


                    <form method="POST"
                          action="{{ route('patients.store') }}">

                        @csrf

                        <div class="create-card">

                            <div class="create-header d-flex justify-content-between align-items-center">

                                <h5 class="create-title">

                                    <i class="fas fa-user-plus"></i>
                                    ចុះឈ្មោះអ្នកជំងឺថ្មី

                                </h5>

                                <span class="badge"
                                      style="background:#E8F5EE;color:#00552B;">

                                    កំណត់ត្រាថ្មី

                                </span>

                            </div>


                            <div class="form-area">

                                <div class="form-inner">

                                    <div class="row">

                                        <div class="col-md-6 form-group">

                                            <label class="form-label-custom">
                                                ឈ្មោះពេញ
                                                <span class="text-danger">*</span>
                                            </label>

                                            <input type="text"
                                                   name="full_name"
                                                   class="form-control form-control-custom"
                                                   placeholder="បញ្ចូលឈ្មោះពេញ..."
                                                   required
                                                   value="{{ old('full_name') }}">

                                        </div>


                                        <div class="col-md-6 form-group">

                                            <label class="form-label-custom">
                                                លេខអត្តសញ្ញាណប័ណ្ណ / ID Card
                                                <span class="text-danger">*</span>
                                            </label>

                                            <input type="text"
                                                   name="id_card"
                                                   class="form-control form-control-custom"
                                                   placeholder="បញ្ចូលលេខអត្តសញ្ញាណប័ណ្ណ..."
                                                   required
                                                   value="{{ old('id_card') }}">

                                        </div>


                                        <div class="col-md-6 form-group">

                                            <label class="form-label-custom">
                                                ថ្ងៃខែឆ្នាំកំណើត
                                                <span class="text-danger">*</span>
                                            </label>

                                            <input type="date"
                                                   name="date_of_birth"
                                                   class="form-control form-control-custom"
                                                   required
                                                   value="{{ old('date_of_birth') }}"
                                                   max="{{ date('Y-m-d') }}">

                                        </div>


                                        <div class="col-md-6 form-group">

                                            <label class="form-label-custom">
                                                ភេទ
                                                <span class="text-danger">*</span>
                                            </label>

                                            <select name="sex"
                                                    class="form-control form-control-custom"
                                                    required>

                                                <option value=""
                                                        disabled
                                                        {{ old('sex') ? '' : 'selected' }}>
                                                    ជ្រើសរើសភេទ
                                                </option>

                                                <option value="male"
                                                    {{ old('sex') == 'male' ? 'selected' : '' }}>
                                                    ប្រុស
                                                </option>

                                                <option value="female"
                                                    {{ old('sex') == 'female' ? 'selected' : '' }}>
                                                    ស្រី
                                                </option>

                                                <option value="other"
                                                    {{ old('sex') == 'other' ? 'selected' : '' }}>
                                                    ផ្សេងៗ
                                                </option>

                                            </select>

                                        </div>


                                        <div class="col-md-6 form-group">

                                            <label class="form-label-custom">
                                                លេខទំនាក់ទំនង
                                                <span class="text-danger">*</span>
                                            </label>

                                            <input type="text"
                                                   name="phone"
                                                   class="form-control form-control-custom"
                                                   placeholder="បញ្ចូលលេខទូរស័ព្ទ..."
                                                   required
                                                   value="{{ old('phone') }}">

                                        </div>


                                        <div class="col-md-6 form-group">

                                            <label class="form-label-custom">
                                                អាសយដ្ឋាន
                                                <span class="text-danger">*</span>
                                            </label>

                                            <input type="text"
                                                   name="address"
                                                   class="form-control form-control-custom"
                                                   placeholder="បញ្ចូលអាសយដ្ឋានបច្ចុប្បន្ន..."
                                                   required
                                                   value="{{ old('address') }}">

                                        </div>

                                    </div>

                                </div>


                                <div class="d-flex justify-content-end mt-3">

                                    <button type="reset"
                                            class="btn btn-clear px-4 mr-2">

                                        <i class="fas fa-undo mr-1"></i>
                                        សម្អាត

                                    </button>


                                    <button type="submit"
                                            class="btn btn-register px-4">

                                        <i class="fas fa-save mr-2"></i>
                                        ចុះឈ្មោះអ្នកជំងឺ

                                    </button>

                                </div>

                            </div>

                        </div>

                    </form>

                </div>


                {{-- =========================
                     Edit Patient
                ========================= --}}
                <div class="tab-pane fade {{ $editPatient ? 'show active' : '' }}"
                     id="patient-edit"
                     role="tabpanel">

                    @if ($editPatient)

                        <div class="edit-card">

                            <div class="edit-header d-flex justify-content-between align-items-center">

                                <h5 class="edit-title">

                                    <i class="fas fa-user-edit"></i>
                                    កែប្រែព័ត៌មានអ្នកជំងឺ

                                </h5>

                                <span class="badge"
                                      style="background:#E8F5EE;color:#00552B;">

                                    Edit Patient

                                </span>

                            </div>


                            <div class="form-area">

                                @if ($errors->any())

                                    <div class="alert alert-danger alert-custom mb-3">

                                        <strong>
                                            <i class="fas fa-exclamation-circle mr-1"></i>
                                            សូមពិនិត្យព័ត៌មានខាងក្រោម
                                        </strong>

                                        <ul class="mb-0 mt-2">

                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach

                                        </ul>

                                    </div>

                                @endif


                                @if (session('error'))

                                    <div class="alert alert-danger alert-custom mb-3">

                                        <i class="fas fa-exclamation-triangle mr-2"></i>
                                        {{ session('error') }}

                                    </div>

                                @endif


                                <form action="{{ route('patients.update', $editPatient->patient_id) }}"
                                      method="POST">

                                    @csrf
                                    @method('PUT')


                                    <div class="form-inner">

                                        <div class="edit-info">

                                            <i class="fas fa-info-circle mr-1"></i>

                                            កំពុងកែប្រែព័ត៌មានរបស់៖

                                            <strong>
                                                {{ $editPatient->full_name }}
                                            </strong>

                                            ·

                                            <strong>
                                                {{ $editPatient->patient_code }}
                                            </strong>

                                        </div>


                                        <div class="row">

                                            {{-- Full Name --}}
                                            <div class="col-md-6 form-group">

                                                <label class="form-label-custom">

                                                    ឈ្មោះអ្នកជំងឺ
                                                    <span class="text-danger">*</span>

                                                </label>

                                                <input type="text"
                                                       name="full_name"
                                                       class="form-control form-control-custom"
                                                       value="{{ old('full_name', $editPatient->full_name) }}"
                                                       required>

                                            </div>


                                            {{-- ID Card --}}
                                            <div class="col-md-6 form-group">

                                                <label class="form-label-custom">

                                                    អត្តសញ្ញាណប័ណ្ណ (ID Card)
                                                    <span class="text-danger">*</span>

                                                </label>

                                                <input type="text"
                                                       name="id_card"
                                                       class="form-control form-control-custom"
                                                       value="{{ old('id_card', $editPatient->id_card) }}"
                                                       required>

                                            </div>


                                            {{-- Date --}}
                                            <div class="col-md-6 form-group">

                                                <label class="form-label-custom">

                                                    ថ្ងៃខែឆ្នាំកំណើត
                                                    <span class="text-danger">*</span>

                                                </label>

                                                <input type="text"
                                                       id="edit_dob_display"
                                                       name="dob_display"
                                                       class="form-control form-control-custom"
                                                       placeholder="ថ្ងៃ/ខែ/ឆ្នាំ (ឧ. 15/03/1990)"
                                                       inputmode="numeric"
                                                       maxlength="10"
                                                       autocomplete="off"
                                                       required
                                                       value="{{ $editDobText }}">

                                                <input type="hidden"
                                                       name="date_of_birth"
                                                       id="edit_dob_value">

                                                <small id="edit_dob_hint"
                                                       class="form-text"></small>

                                            </div>


                                            {{-- Gender --}}
                                            <div class="col-md-6 form-group">

                                                <label class="form-label-custom">

                                                    ភេទ
                                                    <span class="text-danger">*</span>

                                                </label>

                                                <select name="sex"
                                                        class="form-control form-control-custom"
                                                        required>

                                                    <option value="male"
                                                        {{ $editSex === 'male' ? 'selected' : '' }}>
                                                        ប្រុស
                                                    </option>

                                                    <option value="female"
                                                        {{ $editSex === 'female' ? 'selected' : '' }}>
                                                        ស្រី
                                                    </option>

                                                    <option value="other"
                                                        {{ $editSex === 'other' ? 'selected' : '' }}>
                                                        ផ្សេងៗ
                                                    </option>

                                                </select>

                                            </div>


                                            {{-- Phone --}}
                                            <div class="col-md-6 form-group">

                                                <label class="form-label-custom">

                                                    លេខទូរសព្ទ
                                                    <span class="text-danger">*</span>

                                                </label>

                                                <input type="text"
                                                       name="phone"
                                                       class="form-control form-control-custom"
                                                       value="{{ old('phone', $editPatient->phone) }}"
                                                       required>

                                            </div>


                                            {{-- Address --}}
                                            <div class="col-md-6 form-group">

                                                <label class="form-label-custom">

                                                    អាសយដ្ឋាន
                                                    <span class="text-danger">*</span>

                                                </label>

                                                <input type="text"
                                                       name="address"
                                                       class="form-control form-control-custom"
                                                       value="{{ old('address', $editPatient->address) }}"
                                                       required>

                                            </div>

                                        </div>

                                    </div>


                                    <div class="d-flex justify-content-end mt-3">

                                        <a href="{{ route('patients.index') }}"
                                           class="btn btn-clear px-4 mr-2">

                                            <i class="fas fa-times mr-1"></i>
                                            បោះបង់

                                        </a>


                                        <button type="submit"
                                                class="btn btn-update px-4">

                                            <i class="fas fa-save mr-2"></i>
                                            រក្សាទុកការកែប្រែ

                                        </button>

                                    </div>

                                </form>

                            </div>

                        </div>

                    @else

                        <div class="panel-card">

                            <div class="card-body text-center py-5">

                                <i class="fas fa-user-edit mb-3"
                                   style="font-size:2.5rem;color:#006D36;opacity:.45;"></i>

                                <p class="text-muted mb-0">
                                    សូមជ្រើសរើសអ្នកជំងឺពីបញ្ជី ដើម្បីកែប្រែព័ត៌មាន។
                                </p>

                            </div>

                        </div>

                    @endif

                </div>

            </div>

        </div>


        {{-- =========================
             Live Queue
        ========================= --}}
        <div class="col-lg-3">

            <div class="queue-card">

                <div class="queue-header d-flex justify-content-between align-items-center">

                    <h6>
                        <i class="fas fa-clock mr-2"></i>
                        ជួររង់ចាំផ្ទាល់
                    </h6>

                    <span class="queue-count">

                        {{ isset($waitingPatients)
                            ? $waitingPatients->count()
                            : 0 }}

                        នាក់

                    </span>

                </div>


                <div class="queue-body">

                    @forelse($waitingPatients ?? [] as $record)

                        <div class="queue-item">

                            <div class="card-body p-3">

                                <div class="d-flex justify-content-between align-items-start">

                                    <div>

                                        <div class="queue-name">
                                            {{ $record->patient->full_name ?? 'N/A' }}
                                        </div>

                                        <div class="queue-code">

                                            <i class="fas fa-id-badge mr-1"></i>

                                            {{ $record->patient->patient_code ?? 'N/A' }}

                                        </div>

                                    </div>


                                    <span class="queue-time">

                                        {{ $record->created_at
                                            ? $record->created_at->diffForHumans()
                                            : '' }}

                                    </span>

                                </div>

                            </div>

                        </div>

                    @empty

                        <div class="queue-empty">

                            <i class="fas fa-users-slash fa-3x mb-3"
                               style="opacity:.45;"></i>

                            <p class="text-muted small mb-0">

                                មិនទាន់មានអ្នកជំងឺរង់ចាំឡើយ

                            </p>

                        </div>

                    @endforelse

                </div>

            </div>

        </div>

    </div>

</div>


{{-- =========================
     Delete Modal
========================= --}}

<div class="modal fade"
     id="modalDeletePatient"
     tabindex="-1"
     aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content border-0 shadow-lg">

            <div class="modal-header modal-delete-header">

                <h5 class="modal-title font-weight-bold">

                    <i class="fas fa-exclamation-triangle mr-2"></i>
                    បញ្ជាក់ការលុប

                </h5>

                <button type="button"
                        class="close"
                        data-dismiss="modal">

                    <span>&times;</span>

                </button>

            </div>


            <div class="modal-body text-center"
                 style="padding:28px 20px;">

                <div class="delete-icon">

                    <i class="fas fa-trash-alt"></i>

                </div>


                <h5 class="font-weight-bold text-dark">

                    តើអ្នកពិតជាចង់លុបទិន្នន័យនេះមែនទេ?

                </h5>


                <p class="text-muted mb-1">

                    អ្នកជំងឺ:

                    <strong id="deletePatientName"
                            class="text-dark"></strong>

                </p>


                <small class="text-danger">

                    សកម្មភាពនេះមិនអាចត្រឡប់វិញបានទេ។

                </small>

            </div>


            <div class="modal-footer border-0 justify-content-center">

                <button type="button"
                        class="btn btn-secondary px-4"
                        data-dismiss="modal">

                    <i class="fas fa-times mr-1"></i>
                    បោះបង់

                </button>


                <form id="formDeletePatient"
                      method="POST"
                      class="d-inline">

                    @csrf
                    @method('DELETE')

                    <button type="submit"
                            class="btn btn-danger px-4">

                        <i class="fas fa-trash mr-1"></i>
                        លុប

                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

@stop


@section('js')

<script>

document.addEventListener('DOMContentLoaded', function () {

    /* =========================
       Search
    ========================= */

    const form = document.getElementById('searchForm');
    const searchInput = document.getElementById('searchInput');
    const dateInput = document.getElementById('dateInput');
    const genderInput = document.getElementById('genderInput');

    let timer;

    if (searchInput) {

        searchInput.addEventListener('input', function () {

            clearTimeout(timer);

            timer = setTimeout(function () {

                form.submit();

            }, 500);

        });

    }

    if (dateInput) {

        dateInput.addEventListener('change', function () {

            form.submit();

        });

    }

    if (genderInput) {

        genderInput.addEventListener('change', function () {

            form.submit();

        });

    }


    /* =========================
       Delete Patient
    ========================= */

    document.querySelectorAll('.btn-delete-patient')
        .forEach(function (button) {

            button.addEventListener('click', function () {

                const id =
                    this.getAttribute('data-id');

                const name =
                    this.getAttribute('data-name');

                document.getElementById(
                    'deletePatientName'
                ).textContent = name;

                document.getElementById(
                    'formDeletePatient'
                ).action = '/patients/' + id;

            });

        });


    /* =========================
       Edit Date of Birth
    ========================= */

    const display =
        document.getElementById('edit_dob_display');

    const value =
        document.getElementById('edit_dob_value');

    const hint =
        document.getElementById('edit_dob_hint');

    if (display && value && hint) {

        const pad = n =>
            String(n).padStart(2, '0');


        function check(text) {

            value.value = '';

            display.setCustomValidity('');

            hint.textContent = '';
            hint.className = 'form-text';

            if (text.length === 0) {
                return;
            }

            if (text.length < 10) {

                display.setCustomValidity(
                    'សូមបញ្ចូលជាទម្រង់ ថ្ងៃ/ខែ/ឆ្នាំ'
                );

                return;
            }


            const parts = text.split('/');

            if (parts.length !== 3) {

                display.setCustomValidity(
                    'ថ្ងៃខែឆ្នាំកំណើតមិនត្រឹមត្រូវ'
                );

                return;
            }


            const dd = Number(parts[0]);
            const mm = Number(parts[1]);
            const yyyy = Number(parts[2]);

            const d =
                new Date(
                    yyyy,
                    mm - 1,
                    dd
                );

            const today =
                new Date();

            const valid =
                yyyy >= 1900 &&
                d.getFullYear() === yyyy &&
                d.getMonth() === mm - 1 &&
                d.getDate() === dd &&
                d <= today;


            if (!valid) {

                display.setCustomValidity(
                    'ថ្ងៃខែឆ្នាំកំណើតមិនត្រឹមត្រូវ'
                );

                hint.textContent =
                    'ថ្ងៃខែឆ្នាំមិនត្រឹមត្រូវ';

                hint.className =
                    'form-text text-danger';

                return;
            }


            value.value =
                yyyy + '-' +
                pad(mm) + '-' +
                pad(dd);


            let age =
                today.getFullYear() - yyyy;


            if (
                today <
                new Date(
                    today.getFullYear(),
                    mm - 1,
                    dd
                )
            ) {

                age--;

            }


            hint.textContent =
                'អាយុ ' + age + ' ឆ្នាំ';

            hint.className =
                'form-text text-success';

        }


        display.addEventListener('input', function () {

            const d =
                this.value
                    .replace(/\D/g, '')
                    .slice(0, 8);

            let out = d;


            if (d.length > 4) {

                out =
                    d.slice(0, 2) +
                    '/' +
                    d.slice(2, 4) +
                    '/' +
                    d.slice(4);

            } else if (d.length > 2) {

                out =
                    d.slice(0, 2) +
                    '/' +
                    d.slice(2);

            }


            this.value = out;

            check(out);

        });


        check(display.value);

    }

});

</script>

@stop
