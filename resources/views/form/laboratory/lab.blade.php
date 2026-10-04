@extends('adminlte::page')

@section('title', 'គ្រប់គ្រងមន្ទីរពិសោធន៍ (Laboratory Management)')

@section('content')

<style>
    :root {
        --lab-green: #006D36;
        --lab-green-dark: #00552B;
        --lab-green-light: #E8F5EE;
        --lab-bg: #F5F7F6;
        --lab-border: #E7ECE9;
        --lab-text: #1F2A24;
        --lab-muted: #7A8780;
    }

    .lab-container {
        font-family: 'Inter', 'Kantumruy Pro', 'Noto Sans Khmer', sans-serif;
        color: var(--lab-text);
    }

    /* =========================
       HEADER
    ========================= */

    .lab-page-header {
        background: linear-gradient(135deg, #006D36 0%, #008747 100%);
        border-radius: 16px;
        padding: 24px 26px;
        margin-top: 16px;
        margin-bottom: 24px;
        color: #fff;
        box-shadow: 0 6px 20px rgba(0, 109, 54, 0.16);
    }

    .lab-page-header h2 {
        color: #fff !important;
        font-size: 24px;
        margin-bottom: 5px;
    }

    .lab-page-header small {
        color: rgba(255, 255, 255, 0.82) !important;
        font-size: 13px;
    }

    .lab-header-icon {
        width: 50px;
        height: 50px;
        border-radius: 13px;
        background: rgba(255, 255, 255, 0.16);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        margin-right: 14px;
        flex-shrink: 0;
    }

    .lab-header-actions {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .lab-header-actions .btn {
        border-radius: 10px;
        font-weight: 600;
        padding: 9px 15px;
        transition: all 0.2s ease;
    }

    .lab-header-actions .btn-outline-light:hover {
        color: var(--lab-green);
    }

    /* =========================
       STAT CARDS
    ========================= */

    .stat-card-lab {
        background: #fff;
        border: 1px solid var(--lab-border);
        border-radius: 14px;
        padding: 18px;
        display: flex;
        align-items: center;
        gap: 15px;
        height: 100%;
        box-shadow: 0 3px 14px rgba(31, 42, 36, 0.04);
        transition: all 0.2s ease;
    }

    .stat-card-lab:hover {
        transform: translateY(-2px);
        box-shadow: 0 7px 20px rgba(31, 42, 36, 0.08);
    }

    .stat-icon {
        width: 52px;
        height: 52px;
        border-radius: 13px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 21px;
        flex-shrink: 0;
    }

    .stat-card-lab small {
        color: var(--lab-muted) !important;
        font-size: 12px;
    }

    .stat-card-lab h3 {
        font-size: 25px;
        color: var(--lab-text) !important;
    }

    .bg-purple-gradient {
        background: #E8F5EE;
        color: var(--lab-green);
    }

    .bg-amber-gradient {
        background: #FFF5D9;
        color: #D99A00;
    }

    .bg-emerald-gradient {
        background: #E8F5EE;
        color: #008747;
    }

    .bg-blue-gradient {
        background: #EAF3FF;
        color: #2878C8;
    }

    /* =========================
       BUTTONS
    ========================= */

    .btn-primary,
    .bg-primary {
        background-color: var(--lab-green) !important;
        border-color: var(--lab-green) !important;
    }

    .btn-primary:hover,
    .btn-primary:focus {
        background-color: var(--lab-green-dark) !important;
        border-color: var(--lab-green-dark) !important;
    }

    .btn-outline-primary {
        color: var(--lab-green) !important;
        border-color: var(--lab-green) !important;
    }

    .btn-outline-primary:hover {
        background-color: var(--lab-green) !important;
        color: #fff !important;
    }

    .text-primary {
        color: var(--lab-green) !important;
    }

    /* =========================
       TABS
    ========================= */

    .lab-nav-tabs {
        background: #fff;
        padding: 5px;
        border-radius: 12px;
        border: 1px solid var(--lab-border);
        display: inline-flex;
        gap: 4px;
        box-shadow: 0 3px 12px rgba(31, 42, 36, 0.03);
    }

    .lab-nav-tabs .nav-link {
        border: none !important;
        border-radius: 9px !important;
        padding: 10px 18px;
        font-size: 13px;
        font-weight: 600;
        color: var(--lab-muted);
        transition: all 0.2s ease;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .lab-nav-tabs .nav-link:hover {
        color: var(--lab-green);
        background: var(--lab-green-light);
    }

    .lab-nav-tabs .nav-link.active {
        background: var(--lab-green) !important;
        color: #fff !important;
        box-shadow: 0 3px 10px rgba(0, 109, 54, 0.18);
    }

    /* =========================
       MODERN CARD
    ========================= */

    .card-modern {
        background: #fff;
        border: 1px solid var(--lab-border);
        border-radius: 15px;
        box-shadow: 0 4px 16px rgba(31, 42, 36, 0.04);
        overflow: hidden;
    }

    .card-modern-header {
        padding: 17px 20px;
        border-bottom: 1px solid var(--lab-border);
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .card-modern-header h6 {
        margin: 0;
        font-weight: 700;
        color: var(--lab-text);
    }

    /* =========================
       TOOLBAR
    ========================= */

    .toolbar-filters {
        padding: 16px 20px;
        background: #fff;
        border-bottom: 1px solid var(--lab-border);
        gap: 12px;
    }

    .search-box {
        position: relative;
        flex: 1;
        min-width: 250px;
    }

    .search-box i {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: #9AA59F;
        z-index: 2;
    }

    .search-box input {
        height: 40px;
        padding-left: 39px;
        border-radius: 9px;
        background: #F8FAF9;
        border: 1px solid var(--lab-border);
        font-size: 13px;
    }

    .search-box input:focus {
        border-color: var(--lab-green);
        box-shadow: 0 0 0 3px rgba(0, 109, 54, 0.08);
        background: #fff;
    }

    .toolbar-filters select {
        height: 40px;
        min-width: 190px;
        border-radius: 9px !important;
        border: 1px solid var(--lab-border);
        background-color: #F8FAF9;
        font-size: 13px;
    }

    .toolbar-filters select:focus {
        border-color: var(--lab-green);
        box-shadow: 0 0 0 3px rgba(0, 109, 54, 0.08);
    }

    /* =========================
       ACTION MENU
    ========================= */

    .action-menu-btn {
        width: 36px;
        height: 36px;
        padding: 0;
        border: 1px solid var(--lab-border);
        border-radius: 8px;
        background: #F8FAF9;
        color: #5D6962;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
    }

    .action-menu-btn:hover,
    .action-menu-btn:focus {
        background: var(--lab-green-light);
        color: var(--lab-green);
        border-color: #CFE3D7;
        box-shadow: none;
    }

    .action-menu-btn i {
        font-size: 15px;
    }

    .dropdown-menu {
        min-width: 170px;
        border: 1px solid var(--lab-border);
        border-radius: 10px;
        padding: 5px 0;
        box-shadow: 0 8px 24px rgba(31, 42, 36, 0.12);
        z-index: 1050;
    }

    .dropdown-item {
        padding: 9px 14px;
        font-size: 13px;
        color: var(--lab-text);
    }

    .dropdown-item:hover {
        background: var(--lab-green-light);
        color: var(--lab-green);
    }

    .dropdown-item i {
        width: 18px;
        text-align: center;
        margin-right: 5px;
    }

    /* =========================
       MODALS
    ========================= */

    .modal-content {
        border-radius: 15px !important;
        overflow: hidden;
    }

    .modal-header-custom {
        background: linear-gradient(135deg, #006D36 0%, #008747 100%);
        color: #fff;
        border: none;
        padding: 17px 20px;
    }

    .modal-header-custom .close {
        color: #fff;
        opacity: .9;
    }

    .modal-header-custom .close:hover {
        color: #fff;
        opacity: 1;
    }

    .modal-header.bg-success {
        background: linear-gradient(135deg, #006D36 0%, #008747 100%) !important;
        border: none;
    }

    .modal-header.bg-danger {
        background: linear-gradient(135deg, #dc3545 0%, #c82333 100%) !important;
    }

    .modal-header.bg-primary {
        background: linear-gradient(135deg, #006D36 0%, #008747 100%) !important;
        color: #fff !important;
    }

    .modal-header.bg-primary .close {
        color: #fff !important;
    }

    .modal-header h5 {
        font-size: 16px;
    }

    .modal-body label {
        font-size: 13px;
        color: var(--lab-text);
    }

    .modal-body .form-control,
    .modal-body .custom-select {
        border-radius: 9px;
        border: 1px solid var(--lab-border);
        font-size: 13px;
    }

    .modal-body .form-control:focus,
    .modal-body .custom-select:focus {
        border-color: var(--lab-green);
        box-shadow: 0 0 0 3px rgba(0, 109, 54, 0.08);
    }

    .modal-footer {
        border-top: 1px solid var(--lab-border);
    }

    .custom-checkbox {
        border-color: var(--lab-border) !important;
        border-radius: 9px !important;
        transition: all .2s ease;
    }

    .custom-checkbox:hover {
        background: var(--lab-green-light) !important;
        border-color: #CFE3D7 !important;
    }

    .custom-control-input:checked ~ .custom-control-label::before {
        background-color: var(--lab-green);
        border-color: var(--lab-green);
    }

    /* =========================
       RESULT CARD
    ========================= */

    #resultsInputsContainer .card {
        border: 1px solid var(--lab-border) !important;
        border-radius: 11px;
        overflow: hidden;
    }

    #resultsInputsContainer .card-header {
        background: #F8FAF9 !important;
        color: var(--lab-text);
        border-bottom: 1px solid var(--lab-border);
    }

    /* =========================
       TOAST
    ========================= */

    .toast-container-custom {
        position: fixed;
        top: 75px;
        right: 20px;
        z-index: 9999;
    }

    .toast-custom {
        min-width: 280px;
        max-width: 380px;
        padding: 13px 17px;
        margin-bottom: 10px;
        border-radius: 10px;
        color: #fff;
        font-size: 13px;
        font-weight: 600;
        box-shadow: 0 8px 25px rgba(0, 0, 0, .15);
    }

    .toast-custom.success {
        background: linear-gradient(135deg, #006D36, #008747);
    }

    .toast-custom.error {
        background: linear-gradient(135deg, #dc3545, #c82333);
    }

    /* =========================
       PAGINATION
    ========================= */

    .pagination {
        margin-bottom: 0;
    }

    .pagination .page-link {
        border: 1px solid var(--lab-border);
        border-radius: 8px !important;
        margin: 0 2px;
        color: var(--lab-green);
        font-size: 13px;
        min-width: 34px;
        text-align: center;
    }

    .pagination .page-link:hover {
        background: var(--lab-green-light);
        border-color: #CFE3D7;
        color: var(--lab-green-dark);
    }

    .pagination .active .page-link {
        background: var(--lab-green) !important;
        border-color: var(--lab-green) !important;
        color: #fff !important;
    }

    /* =========================
       RESPONSIVE
    ========================= */

    @media (max-width: 991.98px) {
        .lab-page-header {
            padding: 20px;
        }

        .lab-page-header h2 {
            font-size: 21px;
        }

        .lab-header-actions {
            width: 100%;
            margin-top: 15px;
        }

        .lab-header-actions .btn {
            flex: 1;
        }

        .lab-nav-tabs {
            width: 100%;
            display: flex;
        }

        .lab-nav-tabs .nav-item {
            flex: 1;
        }

        .lab-nav-tabs .nav-link {
            justify-content: center;
            padding: 10px 8px;
        }
    }

    @media (max-width: 767.98px) {
        .lab-page-header {
            margin-top: 10px;
        }

        .lab-page-header .d-flex {
            align-items: flex-start !important;
        }

        .lab-header-icon {
            width: 44px;
            height: 44px;
        }

        .toolbar-filters {
            flex-direction: column;
            align-items: stretch !important;
        }

        .search-box {
            width: 100%;
            min-width: 0;
        }

        .toolbar-filters > div:not(.search-box) {
            width: 100%;
        }

        .toolbar-filters select {
            width: 100%;
        }

        .lab-nav-tabs .nav-link {
            font-size: 12px;
        }

        .lab-nav-tabs .nav-link i {
            display: none;
        }
    }

    @media (max-width: 575.98px) {
        .lab-page-header {
            padding: 17px;
        }

        .lab-page-header h2 {
            font-size: 18px;
        }

        .lab-page-header small {
            font-size: 11px;
        }

        .lab-header-actions {
            flex-direction: column;
        }

        .lab-header-actions .btn {
            width: 100%;
        }

        .lab-nav-tabs {
            flex-direction: column;
            gap: 3px;
        }

        .lab-nav-tabs .nav-item {
            width: 100%;
        }

        .lab-nav-tabs .nav-link {
            width: 100%;
        }

        .stat-card-lab {
            padding: 15px;
        }

        .stat-icon {
            width: 46px;
            height: 46px;
            font-size: 19px;
        }

        .stat-card-lab h3 {
            font-size: 22px;
        }

        .toast-container-custom {
            left: 15px;
            right: 15px;
        }

        .toast-custom {
            min-width: auto;
            width: 100%;
        }
    }
</style>

<div class="toast-container-custom" id="toastContainer"></div>

<div class="lab-container">

    {{-- ================= HEADER ================= --}}
    <div class="lab-page-header">
        <div class="d-flex justify-content-between align-items-center flex-wrap">

            <div class="d-flex align-items-center">
                <div class="lab-header-icon">
                    <i class="fas fa-vials"></i>
                </div>

                <div>
                    <h2 class="font-weight-bold mb-1">
                        គ្រប់គ្រងមន្ទីរពិសោធន៍
                    </h2>

                    <small>
                        Laboratory Management · គ្រប់គ្រងការកម្មង់តេស្ត វាយបញ្ចូលលទ្ធផល និងកាតាឡុកតេស្ត
                    </small>
                </div>
            </div>

            <div class="lab-header-actions">
                <button class="btn btn-outline-light"
                    data-toggle="modal"
                    data-target="#modalCreateTest">
                    <i class="fas fa-microscope mr-1"></i>
                    បន្ថែមតេស្តថ្មី
                </button>

                <button class="btn btn-light text-primary"
                    data-toggle="modal"
                    data-target="#modalCreateOrder">
                    <i class="fas fa-plus-circle mr-1"></i>
                    បង្កើតការកម្មង់ថ្មី
                </button>
            </div>

        </div>
    </div>

    {{-- ================= STATS ================= --}}
    <div class="row mb-4">

        <div class="col-lg-3 col-md-6 mb-3">
            <div class="stat-card-lab">
                <div class="stat-icon bg-purple-gradient">
                    <i class="fas fa-file-medical-alt"></i>
                </div>

                <div>
                    <small class="font-weight-bold d-block">
                        ការកម្មង់សរុប
                    </small>

                    <h3 id="statTotalOrders" class="m-0 font-weight-bold">
                        {{ $totalOrders }}
                    </h3>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-3">
            <div class="stat-card-lab">
                <div class="stat-icon bg-amber-gradient">
                    <i class="fas fa-clock"></i>
                </div>

                <div>
                    <small class="font-weight-bold d-block">
                        កំពុងរង់ចាំ (Pending)
                    </small>

                    <h3 id="statPendingOrders"
                        class="m-0 font-weight-bold text-warning">
                        {{ $pendingOrders }}
                    </h3>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-3">
            <div class="stat-card-lab">
                <div class="stat-icon bg-emerald-gradient">
                    <i class="fas fa-check-circle"></i>
                </div>

                <div>
                    <small class="font-weight-bold d-block">
                        បានបញ្ចប់ (Completed)
                    </small>

                    <h3 id="statCompletedOrders"
                        class="m-0 font-weight-bold text-success">
                        {{ $completedOrders }}
                    </h3>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-3">
            <div class="stat-card-lab">
                <div class="stat-icon bg-blue-gradient">
                    <i class="fas fa-vial"></i>
                </div>

                <div>
                    <small class="font-weight-bold d-block">
                        តេស្តកាតាឡុកសរុប
                    </small>

                    <h3 id="statTotalTests"
                        class="m-0 font-weight-bold">
                        {{ $totalTests }}
                    </h3>
                </div>
            </div>
        </div>

    </div>

    {{-- ================= TABS ================= --}}
    <div class="mb-4">

        <ul class="nav lab-nav-tabs"
            id="labTab"
            role="tablist">

            <li class="nav-item">
                <a class="nav-link active"
                    id="orders-tab"
                    data-toggle="tab"
                    href="#ordersPane"
                    role="tab">

                    <i class="fas fa-list-alt"></i>
                    ការកម្មង់ពិនិត្យ
                    <span class="d-none d-md-inline">(Lab Orders)</span>

                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link"
                    id="tests-tab"
                    data-toggle="tab"
                    href="#testsPane"
                    role="tab">

                    <i class="fas fa-microscope"></i>
                    បញ្ជីតេស្ត
                    <span class="d-none d-md-inline">(Lab Test Catalog)</span>

                </a>
            </li>

        </ul>

    </div>

    <div class="tab-content">

        {{-- ================= LAB ORDERS ================= --}}
        <div class="tab-pane fade show active"
            id="ordersPane"
            role="tabpanel">

            <div class="card-modern">

                <div class="card-body p-0">

                    <div class="d-flex align-items-center flex-wrap toolbar-filters">

                        <div class="search-box">
                            <i class="fas fa-search"></i>

                            <input type="text"
                                id="orderSearch"
                                class="form-control"
                                placeholder="ស្វែងរកតាមលេខការកម្មង់, ឈ្មោះអ្នកជំងឺ, កូដអ្នកជំងឺ...">
                        </div>

                        <div>
                            <select id="statusFilter"
                                class="form-control custom-select">

                                <option value="">
                                    -- ស្ថានភាពទាំងអស់ --
                                </option>

                                <option value="pending">
                                    កំពុងរង់ចាំ (Pending)
                                </option>

                                <option value="completed">
                                    បានបញ្ចប់ (Completed)
                                </option>

                            </select>
                        </div>

                    </div>

                    <div id="orderTableContainer">
                        @include('form.laboratory.partials.order_table')
                    </div>

                </div>

            </div>

        </div>

        {{-- ================= LAB TEST CATALOG ================= --}}
        <div class="tab-pane fade"
            id="testsPane"
            role="tabpanel">

            <div class="card-modern">

                <div class="card-modern-header">
                    <h6>
                        <i class="fas fa-vials text-primary mr-2"></i>
                        កាតាឡុកតេស្តពិសោធន៍
                    </h6>
                </div>

                <div class="card-body p-4">

                    @include('form.laboratory.partials.test_table')

                </div>

            </div>

        </div>

    </div>

</div>

{{-- =========================================================
     MODAL CREATE ORDER
========================================================= --}}
<div class="modal fade"
    id="modalCreateOrder"
    tabindex="-1"
    aria-hidden="true">

    <div class="modal-dialog modal-lg">

        <div class="modal-content border-0 shadow-lg">

            <div class="modal-header modal-header-custom">

                <h5 class="modal-title font-weight-bold">
                    <i class="fas fa-plus-circle mr-2"></i>
                    បង្កើតការកម្មង់ពិនិត្យថ្មី
                </h5>

                <button type="button"
                    class="close text-white"
                    data-dismiss="modal"
                    aria-label="Close">

                    <span>&times;</span>

                </button>

            </div>

            <form id="formCreateOrder"
                class="ajax-form"
                data-reload="orders"
                action="{{ route('lab.orders.store') }}"
                method="POST">

                @csrf

                <div class="modal-body p-4">

                    <div class="row mb-3">

                        <div class="col-md-7 mb-2">

                            <label class="font-weight-bold">
                                ជ្រើសរើសកំណត់ត្រាវេជ្ជសាស្ត្រ/អ្នកជំងឺ
                                <span class="text-danger">*</span>
                            </label>

                            <select name="record_id"
                                class="form-control custom-select"
                                required>

                                <option value="">
                                    -- ជ្រើសរើសកំណត់ត្រាវេជ្ជសាស្ត្រ --
                                </option>

                                @foreach ($medicalRecords as $rec)

                                    <option value="{{ $rec->record_id }}">

                                        Record #{{ $rec->record_id }} -

                                        {{ $rec->patient
                                            ? $rec->patient->full_name
                                            : 'Patient #' . $rec->patient_id
                                        }}

                                        (
                                        {{ $rec->visit_date
                                            ? \Carbon\Carbon::parse($rec->visit_date)->format('d/m/Y')
                                            : ''
                                        }}
                                        )

                                    </option>

                                @endforeach

                            </select>

                        </div>

                        <div class="col-md-5 mb-2">

                            <label class="font-weight-bold">
                                កាលបរិច្ឆេទកម្មង់
                                <span class="text-danger">*</span>
                            </label>

                            <input type="datetime-local"
                                name="order_date"
                                class="form-control"
                                value="{{ date('Y-m-d\TH:i') }}"
                                required>

                        </div>

                    </div>

                    <h6 class="font-weight-bold text-primary mb-3">

                        <i class="fas fa-microscope mr-1"></i>
                        ជ្រើសរើសតេស្តត្រូវពិនិត្យ

                    </h6>

                    <div class="row">

                        @foreach($labTests as $test)

                            <div class="col-md-6 mb-2">

                                <div class="custom-control custom-checkbox p-2 border rounded bg-light">

                                    <input type="checkbox"
                                        class="custom-control-input"
                                        id="test_cb_{{ $test->test_id }}"
                                        name="test_ids[]"
                                        value="{{ $test->test_id }}">

                                    <label class="custom-control-label font-weight-bold text-dark"
                                        for="test_cb_{{ $test->test_id }}">

                                        {{ $test->test_name }}

                                        <small class="text-muted d-block">

                                            ({{ $test->test_code ?? 'T-' . $test->test_id }})
                                            -
                                            ${{ number_format($test->price, 2) }}

                                        </small>

                                    </label>

                                </div>

                            </div>

                        @endforeach

                    </div>

                </div>

                <div class="modal-footer bg-light">

                    <button type="button"
                        class="btn btn-secondary"
                        data-dismiss="modal">

                        បោះបង់

                    </button>

                    <button type="submit"
                        class="btn btn-primary">

                        <i class="fas fa-save mr-1"></i>
                        រក្សាទុកការកម្មង់

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

{{-- =========================================================
     MODAL ENTER RESULTS
========================================================= --}}
<div class="modal fade"
    id="modalEnterResults"
    tabindex="-1"
    aria-hidden="true">

    <div class="modal-dialog modal-lg">

        <div class="modal-content border-0 shadow-lg">

            <div class="modal-header bg-success text-white">

                <h5 class="modal-title font-weight-bold">

                    <i class="fas fa-vial mr-2"></i>
                    បញ្ចូលលទ្ធផលពិនិត្យមន្ទីរពិសោធន៍

                </h5>

                <button type="button"
                    class="close text-white"
                    data-dismiss="modal">

                    <span>&times;</span>

                </button>

            </div>

            <form id="formEnterResults"
                class="ajax-form"
                data-reload="orders"
                method="POST">

                @csrf

                <div class="modal-body p-4">

                    <div class="alert alert-info mb-3">

                        <strong>អ្នកជំងឺ៖ </strong>

                        <span id="resPatientName"
                            class="font-weight-bold"></span>

                    </div>

                    <div id="resultsInputsContainer"></div>

                </div>

                <div class="modal-footer bg-light">

                    <button type="button"
                        class="btn btn-secondary"
                        data-dismiss="modal">

                        បោះបង់

                    </button>

                    <button type="submit"
                        class="btn btn-success">

                        <i class="fas fa-check-circle mr-1"></i>
                        រក្សាទុកលទ្ធផល

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

{{-- =========================================================
     MODAL CREATE TEST
========================================================= --}}
<div class="modal fade"
    id="modalCreateTest"
    tabindex="-1"
    aria-hidden="true">

    <div class="modal-dialog">

        <div class="modal-content border-0 shadow-lg">

            <div class="modal-header modal-header-custom">

                <h5 class="modal-title font-weight-bold">

                    <i class="fas fa-microscope mr-2"></i>
                    បន្ថែមតេស្តពិសោធន៍ថ្មី

                </h5>

                <button type="button"
                    class="close text-white"
                    data-dismiss="modal">

                    <span>&times;</span>

                </button>

            </div>

            <form id="formCreateTest"
                class="ajax-form"
                data-reload="tests"
                action="{{ route('lab.tests.store') }}"
                method="POST">

                @csrf

                <div class="modal-body p-4">

                    <div class="form-group mb-3">

                        <label class="font-weight-bold">
                            ឈ្មោះតេស្តពិសោធន៍
                            <span class="text-danger">*</span>
                        </label>

                        <input type="text"
                            name="test_name"
                            class="form-control"
                            placeholder="ឧ. Complete Blood Count (CBC)"
                            required>

                    </div>

                    <div class="form-group mb-3">

                        <label class="font-weight-bold">
                            កូដតេស្ត (Test Code)
                        </label>

                        <input type="text"
                            name="test_code"
                            class="form-control"
                            placeholder="ឧ. CBC-001">

                    </div>

                    <div class="form-group mb-3">

                        <label class="font-weight-bold">
                            កម្រិតធម្មតា (Normal Range)
                        </label>

                        <input type="text"
                            name="normal_range"
                            class="form-control"
                            placeholder="ឧ. 4.5 - 11.0 x10^3/uL">

                    </div>

                    <div class="form-group mb-3">

                        <label class="font-weight-bold">
                            ខ្នាត (Unit)
                        </label>

                        <input type="text"
                            name="unit"
                            class="form-control"
                            placeholder="ឧ. mg/dL, g/dL">

                    </div>

                    <div class="form-group mb-3">

                        <label class="font-weight-bold">
                            តម្លៃ ($ Price)
                            <span class="text-danger">*</span>
                        </label>

                        <input type="number"
                            step="0.01"
                            min="0"
                            name="price"
                            class="form-control"
                            placeholder="10.00"
                            required>

                    </div>

                </div>

                <div class="modal-footer bg-light">

                    <button type="button"
                        class="btn btn-secondary"
                        data-dismiss="modal">

                        បោះបង់

                    </button>

                    <button type="submit"
                        class="btn btn-primary">

                        <i class="fas fa-save mr-1"></i>
                        រក្សាទុកតេស្ត

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

{{-- =========================================================
     MODAL EDIT TEST
========================================================= --}}
<div class="modal fade"
    id="modalEditTest"
    tabindex="-1"
    aria-hidden="true">

    <div class="modal-dialog">

        <div class="modal-content border-0 shadow-lg">

            <div class="modal-header modal-header-custom">

                <h5 class="modal-title font-weight-bold">

                    <i class="fas fa-edit mr-2"></i>
                    កែប្រែតេស្តពិសោធន៍

                </h5>

                <button type="button"
                    class="close text-white"
                    data-dismiss="modal">

                    <span>&times;</span>

                </button>

            </div>

            <form id="formEditTest"
                class="ajax-form"
                data-reload="tests"
                method="POST">

                @csrf
                @method('PUT')

                <div class="modal-body p-4">

                    <div class="form-group mb-3">

                        <label class="font-weight-bold">
                            ឈ្មោះតេស្តពិសោធន៍
                            <span class="text-danger">*</span>
                        </label>

                        <input type="text"
                            name="test_name"
                            id="edit_test_name"
                            class="form-control"
                            required>

                    </div>

                    <div class="form-group mb-3">

                        <label class="font-weight-bold">
                            កូដតេស្ត
                        </label>

                        <input type="text"
                            name="test_code"
                            id="edit_test_code"
                            class="form-control">

                    </div>

                    <div class="form-group mb-3">

                        <label class="font-weight-bold">
                            កម្រិតធម្មតា
                        </label>

                        <input type="text"
                            name="normal_range"
                            id="edit_normal_range"
                            class="form-control">

                    </div>

                    <div class="form-group mb-3">

                        <label class="font-weight-bold">
                            ខ្នាត
                        </label>

                        <input type="text"
                            name="unit"
                            id="edit_unit"
                            class="form-control">

                    </div>

                    <div class="form-group mb-3">

                        <label class="font-weight-bold">
                            តម្លៃ ($)
                            <span class="text-danger">*</span>
                        </label>

                        <input type="number"
                            step="0.01"
                            min="0"
                            name="price"
                            id="edit_price"
                            class="form-control"
                            required>

                    </div>

                </div>

                <div class="modal-footer bg-light">

                    <button type="button"
                        class="btn btn-secondary"
                        data-dismiss="modal">

                        បោះបង់

                    </button>

                    <button type="submit"
                        class="btn btn-primary font-weight-bold">

                        <i class="fas fa-save mr-1"></i>
                        កែប្រែតេស្ត

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

{{-- =========================================================
     MODAL DELETE TEST
========================================================= --}}
<div class="modal fade"
    id="modalDeleteTest"
    tabindex="-1"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content border-0 shadow-lg">

            <div class="modal-header border-0 bg-danger">

                <h5 class="modal-title font-weight-bold text-white">

                    <i class="fas fa-exclamation-triangle mr-2"></i>
                    បញ្ជាក់ការលុប

                </h5>

                <button type="button"
                    class="close text-white"
                    data-dismiss="modal">

                    <span>&times;</span>

                </button>

            </div>

            <div class="modal-body text-center px-4">

                <div class="mb-3">

                    <i class="fas fa-trash-alt text-danger"
                        style="font-size:45px;"></i>

                </div>

                <h5 class="font-weight-bold mb-2">
                    តើអ្នកពិតជាចង់លុបតេស្តនេះមែនទេ?
                </h5>

                <p class="text-muted mb-0">

                    តេស្ត
                    <strong id="deleteTestName"></strong>
                    នឹងត្រូវបានលុបចេញ។

                </p>

                <small class="text-danger">

                    <i class="fas fa-info-circle mr-1"></i>
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

                <form id="formDeleteTest"
                    class="ajax-form d-inline"
                    data-reload="tests"
                    method="POST">

                    @csrf
                    @method('DELETE')

                    <button type="submit"
                        class="btn btn-danger px-4">

                        <i class="fas fa-trash-alt mr-1"></i>
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
    $(document).ready(function () {

        let debounceTimer;
        let testDebounce;

        /* =====================================================
           ACTIVE TAB
        ===================================================== */

        const savedTab = localStorage.getItem('labActiveTab');

        if (savedTab) {
            $('#labTab a[href="' + savedTab + '"]').tab('show');
        }

        $('#labTab a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            localStorage.setItem(
                'labActiveTab',
                $(e.target).attr('href')
            );
        });

        /* =====================================================
           TOAST
        ===================================================== */

        function showToast(message, type = 'success') {

            const $toast = $(
                '<div class="toast-custom ' +
                type +
                '">' +
                message +
                '</div>'
            );

            $('#toastContainer').append($toast);

            setTimeout(function () {

                $toast.fadeOut(300, function () {
                    $(this).remove();
                });

            }, 3000);
        }

        /* =====================================================
           LOAD LAB ORDERS
        ===================================================== */

        function loadLabOrders(page = 1) {

            $('#orderTableContainer').css('opacity', '0.5');

            $.ajax({

                url: "{{ route('lab.index') }}",

                data: {
                    tab: 'orders',
                    page: page,
                    search: $('#orderSearch').val(),
                    status: $('#statusFilter').val()
                },

                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },

                success: function (res) {

                    $('#orderTableContainer')
                        .html(res.html)
                        .css('opacity', '1');

                    if (res.totalOrders !== undefined) {
                        $('#statTotalOrders').text(res.totalOrders);
                    }

                    if (res.pendingOrders !== undefined) {
                        $('#statPendingOrders').text(res.pendingOrders);
                    }

                    if (res.completedOrders !== undefined) {
                        $('#statCompletedOrders').text(res.completedOrders);
                    }

                },

                error: function () {

                    $('#orderTableContainer')
                        .css('opacity', '1');

                }

            });
        }

        /* =====================================================
           LOAD LAB TESTS
        ===================================================== */

        function loadLabTests(page = 1) {

            $('#testTableContainer').css('opacity', '0.5');

            $.ajax({

                url: "{{ route('lab.index') }}",

                data: {
                    tab: 'tests',
                    test_page: page,
                    test_search: $('#testSearch').val()
                },

                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },

                success: function (res) {

                    $('#testTableContainer')
                        .html(res.html)
                        .css('opacity', '1');

                    if (res.totalTests !== undefined) {
                        $('#statTotalTests').text(res.totalTests);
                    }

                },

                error: function () {

                    $('#testTableContainer')
                        .css('opacity', '1');

                }

            });
        }

        /* =====================================================
           AJAX FORM
        ===================================================== */

        $(document).on(
            'submit',
            'form.ajax-form',
            function (e) {

                e.preventDefault();

                const $form = $(this);
                const $btn = $form.find('[type=submit]');
                const target = $form.data('reload');

                $btn.prop('disabled', true);

                $form.find('.is-invalid')
                    .removeClass('is-invalid');

                $form.find('.invalid-feedback')
                    .remove();

                $.ajax({

                    url: $form.attr('action'),

                    method: 'POST',

                    data: $form.serialize(),

                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    },

                    success: function (res) {

                        $form.closest('.modal').modal('hide');

                        if (
                            $form.attr('id') ===
                            'formCreateTest'
                        ) {
                            $form[0].reset();
                        }

                        if (target === 'tests') {
                            loadLabTests(1);
                        } else {
                            loadLabOrders(1);
                        }

                        showToast(
                            res.message ||
                            'បានរក្សាទុកដោយជោគជ័យ',
                            'success'
                        );

                    },

                    error: function (xhr) {

                        if (xhr.status === 422) {

                            const errors =
                                xhr.responseJSON?.errors || {};

                            $.each(
                                errors,
                                function (field, msgs) {

                                    const $input =
                                        $form.find(
                                            '[name="' +
                                            field +
                                            '"]'
                                        );

                                    $input.addClass(
                                        'is-invalid'
                                    );

                                    $input.after(
                                        '<div class="invalid-feedback d-block">' +
                                        msgs[0] +
                                        '</div>'
                                    );

                                }
                            );

                        } else {

                            const message =
                                xhr.responseJSON?.message ||
                                'មានបញ្ហា! សូមព្យាយាមម្តងទៀត';

                            showToast(
                                message,
                                'error'
                            );
                        }

                    },

                    complete: function () {

                        $btn.prop('disabled', false);

                    }

                });

            }
        );

        /* =====================================================
           ORDER SEARCH
        ===================================================== */

        $('#orderSearch').on('keyup', function () {

            clearTimeout(debounceTimer);

            debounceTimer = setTimeout(
                function () {
                    loadLabOrders(1);
                },
                400
            );

        });

        $('#statusFilter').on(
            'change',
            function () {
                loadLabOrders(1);
            }
        );

        /* =====================================================
           TEST SEARCH
        ===================================================== */

        $('#testSearch').on('keyup', function () {

            clearTimeout(testDebounce);

            testDebounce = setTimeout(
                function () {
                    loadLabTests(1);
                },
                400
            );

        });

        /* =====================================================
           ORDER PAGINATION
        ===================================================== */

        $(document).on(
            'click',
            '#orderTableContainer .pagination a',
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
                    ).searchParams.get('page') || 1;

                loadLabOrders(page);

            }
        );

        /* =====================================================
           TEST PAGINATION
        ===================================================== */

        $(document).on(
            'click',
            '#testTableContainer .pagination a',
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
                    ).searchParams.get('test_page') || 1;

                loadLabTests(page);

            }
        );

        /* =====================================================
           ENTER RESULTS
        ===================================================== */

        $(document).on(
            'click',
            '.btn-enter-results',
            function () {

                const orderId =
                    $(this).data('id');

                const results =
                    $(this).data('results') || [];

                $('#resPatientName')
                    .text($(this).data('patient'));

                $('#formEnterResults').attr(
                    'action',
                    "{{ url('lab/orders') }}/" +
                    orderId +
                    "/results"
                );

                let html = '';

                results.forEach(function (r, idx) {

                    html += `
                        <div class="card mb-3 border shadow-sm">

                            <div class="card-header bg-light font-weight-bold">
                                ${
                                    r.lab_test
                                        ? r.lab_test.test_name
                                        : 'Test #' + r.test_id
                                }
                            </div>

                            <div class="card-body p-3">

                                <input
                                    type="hidden"
                                    name="results[${idx}][result_id]"
                                    value="${r.result_id}"
                                >

                                <div class="row">

                                    <div class="col-md-6 mb-2">

                                        <label class="small font-weight-bold">
                                            លទ្ធផល
                                            <span class="text-danger">*</span>
                                        </label>

                                        <input
                                            type="text"
                                            name="results[${idx}][result_value]"
                                            class="form-control form-control-sm"
                                            value="${
                                                r.result_value &&
                                                r.result_value !== 'Pending'
                                                    ? r.result_value
                                                    : ''
                                            }"
                                            required
                                        >

                                    </div>

                                    <div class="col-md-6 mb-2">

                                        <label class="small font-weight-bold">
                                            កម្រិតធម្មតា
                                        </label>

                                        <input
                                            type="text"
                                            name="results[${idx}][normal_range]"
                                            class="form-control form-control-sm"
                                            value="${
                                                r.normal_range ||
                                                (
                                                    r.lab_test
                                                        ? r.lab_test.normal_range
                                                        : ''
                                                ) ||
                                                ''
                                            }"
                                        >

                                    </div>

                                    <div class="col-md-12">

                                        <label class="small font-weight-bold">
                                            ចំណាំ
                                        </label>

                                        <input
                                            type="text"
                                            name="results[${idx}][remark]"
                                            class="form-control form-control-sm"
                                            value="${r.remark || ''}"
                                        >

                                    </div>

                                </div>

                            </div>

                        </div>
                    `;

                });

                $('#resultsInputsContainer')
                    .html(html);

                $('#modalEnterResults')
                    .modal('show');

            }
        );

        /* =====================================================
           EDIT LAB TEST
        ===================================================== */

        $(document).on(
            'click',
            '.btn-edit-test',
            function () {

                $('#edit_test_name')
                    .val($(this).data('name'));

                $('#edit_test_code')
                    .val($(this).data('code'));

                $('#edit_normal_range')
                    .val($(this).data('range'));

                $('#edit_unit')
                    .val($(this).data('unit'));

                $('#edit_price')
                    .val($(this).data('price'));

                $('#formEditTest').attr(
                    'action',
                    "{{ url('lab/tests') }}/" +
                    $(this).data('id')
                );

                $('#modalEditTest')
                    .modal('show');

            }
        );

        /* =====================================================
           DELETE LAB TEST
        ===================================================== */

        $(document).on(
            'click',
            '.btn-delete-test',
            function () {

                $('#deleteTestName')
                    .text($(this).data('name'));

                $('#formDeleteTest').attr(
                    'action',
                    "{{ url('lab/tests') }}/" +
                    $(this).data('id')
                );

                $('#modalDeleteTest')
                    .modal('show');

            }
        );

    });
</script>

@stop