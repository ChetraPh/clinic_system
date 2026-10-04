@extends('adminlte::page')

@section('title', 'គ្រប់គ្រងការទូទាត់ប្រាក់ & វិក្កយបត្រ')

@push('css')
<style>
    :root {
        --billing-green: #006D36;
        --billing-green-dark: #00552B;
        --billing-green-light: #E8F5EE;
        --billing-bg: #F5F7F6;
        --billing-border: #E8ECEA;
        --billing-text: #1F2A24;
        --billing-muted: #7A8780;
    }

    .billing-container {
        font-family: 'Inter', 'Kantumruuy Pro', sans-serif;
        color: var(--billing-text);
    }

    /* ================= PAGE HEADER ================= */

    .billing-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
        margin: 18px 0 22px;
    }

    .billing-header-left {
        display: flex;
        align-items: flex-start;
        gap: 13px;
    }

    .billing-header-icon {
        width: 46px;
        height: 46px;
        border-radius: 12px;
        background: var(--billing-green-light);
        color: var(--billing-green);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        font-size: 18px;
    }

    .billing-title {
        margin: 0;
        font-size: 20px;
        font-weight: 800;
        color: #202B25;
        line-height: 1.3;
    }

    .billing-subtitle {
        margin-top: 5px;
        color: var(--billing-muted);
        font-size: 11px;
        line-height: 1.6;
    }

    .btn-create-invoice {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        padding: 10px 15px;
        border: 0;
        border-radius: 9px;
        background: var(--billing-green);
        color: #fff !important;
        font-size: 11px;
        font-weight: 700;
        box-shadow: 0 4px 12px rgba(0, 109, 54, .14);
        transition: all .18s ease;
        white-space: nowrap;
    }

    .btn-create-invoice:hover {
        background: var(--billing-green-dark);
        transform: translateY(-1px);
        box-shadow: 0 7px 16px rgba(0, 109, 54, .18);
    }

    /* ================= TOAST ================= */

    #billingSuccessToast {
        border: 1px solid #D8EDE0;
        background: #F2FBF5;
        color: #22633C;
        border-radius: 9px !important;
        font-size: 11px;
        box-shadow: 0 4px 14px rgba(15, 23, 42, .04);
    }

    /* ================= STAT CARDS ================= */

    .billing-stat-card {
        height: 100%;
        display: flex;
        align-items: center;
        gap: 13px;
        padding: 15px;
        background: #fff;
        border: 1px solid var(--billing-border);
        border-radius: 12px;
        box-shadow: 0 3px 12px rgba(15, 23, 42, .04);
        transition: all .18s ease;
    }

    .billing-stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 7px 18px rgba(15, 23, 42, .07);
    }

    .billing-stat-icon {
        width: 42px;
        height: 42px;
        border-radius: 11px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        font-size: 16px;
    }

    .billing-icon-invoice {
        background: #EEF4FF;
        color: #4775C8;
    }

    .billing-icon-revenue {
        background: #EEF8F2;
        color: var(--billing-green);
    }

    .billing-icon-unpaid {
        background: #FFF1F2;
        color: #D1435B;
    }

    .billing-stat-label {
        display: block;
        margin-bottom: 3px;
        color: #7A8780;
        font-size: 10px;
        font-weight: 700;
    }

    .billing-stat-value {
        margin: 0;
        color: #26342D;
        font-size: 19px;
        font-weight: 800;
        line-height: 1.2;
    }

    .billing-stat-value.revenue {
        color: var(--billing-green);
    }

    .billing-stat-value.unpaid {
        color: #D1435B;
    }

    /* ================= MAIN CARD ================= */

    .billing-card {
        background: #fff;
        border: 1px solid var(--billing-border);
        border-radius: 13px;
        box-shadow: 0 4px 16px rgba(15, 23, 42, .045);
        overflow: hidden;
    }

    /* ================= TOOLBAR ================= */

    .billing-toolbar {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 9px;
        padding: 13px 15px;
        background: #fff;
        border-bottom: 1px solid #EEF1EF;
    }

    .billing-search {
        position: relative;
        flex: 1;
        min-width: 260px;
    }

    .billing-search > i {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: #9AA59F;
        font-size: 11px;
        z-index: 2;
    }

    .billing-search input {
        height: 36px;
        padding: 7px 12px 7px 33px;
        border: 1px solid #E2E9E5;
        border-radius: 8px;
        background: #FAFBFA;
        color: #34423A;
        font-size: 11px;
        transition: all .15s ease;
    }

    .billing-search input:focus {
        background: #fff;
        border-color: #A8CDB7;
        box-shadow: 0 0 0 3px rgba(0, 109, 54, .07);
    }

    .billing-filter-date {
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .billing-toolbar .form-control,
    .billing-toolbar .custom-select {
        height: 36px;
        border: 1px solid #E2E9E5;
        border-radius: 8px !important;
        background-color: #FAFBFA;
        color: #445149;
        font-size: 10px;
    }

    .billing-toolbar .form-control:focus,
    .billing-toolbar .custom-select:focus {
        background: #fff;
        border-color: #A8CDB7;
        box-shadow: 0 0 0 3px rgba(0, 109, 54, .07);
    }

    .billing-toolbar .custom-select {
        min-width: 150px;
    }

    .billing-filter-date .form-control {
        width: 135px;
    }

    .billing-filter-date .date-separator {
        color: #A0AAA4;
        font-size: 11px;
    }

    /* ================= TABLE ================= */

    #billingTableContainer {
        width: 100%;
    }

    /* ================= MODAL ================= */

    .modal-content {
        border-radius: 14px !important;
        overflow: hidden;
    }

    .modal-header-custom,
    .modal-header-pay {
        border: 0 !important;
        padding: 14px 18px;
        background: linear-gradient(135deg, #006D36 0%, #00552B 100%);
        color: #fff;
    }

    .modal-header-custom .modal-title,
    .modal-header-pay .modal-title {
        font-size: 14px;
    }

    .modal-header .close {
        opacity: 1;
        text-shadow: none;
    }

    .modal-body {
        font-size: 11px;
    }

    .modal-body label {
        color: #445149;
        font-size: 11px;
    }

    .modal-body .form-control,
    .modal-body .custom-select {
        border: 1px solid #DDE5E0;
        border-radius: 8px;
        font-size: 11px;
    }

    .modal-body .form-control:focus,
    .modal-body .custom-select:focus {
        border-color: #A8CDB7;
        box-shadow: 0 0 0 3px rgba(0, 109, 54, .07);
    }

    .modal-footer {
        border-top: 1px solid #EEF1EF !important;
        padding: 12px 18px;
    }

    /* ================= VISIT TYPE ================= */

    .btn-outline-indigo {
        border-color: #CBD5E1;
        color: #475569;
        font-size: 11px;
        font-weight: 650;
        transition: all .15s ease;
    }

    .btn-outline-indigo:hover {
        background: #F1F5F9;
        color: #334155;
    }

    .btn-outline-indigo.active {
        background: var(--billing-green);
        border-color: var(--billing-green);
        color: #fff;
    }

    /* ================= PAYMENT METHOD ================= */

    .btn-outline-success {
        font-size: 11px;
        font-weight: 650;
    }

    .btn-outline-success.active {
        background: var(--billing-green);
        border-color: var(--billing-green);
        color: #fff;
    }

    /* ================= INVOICE ITEM TABLE ================= */

    #invoiceItemsTable,
    #editInvoiceItemsTbody {
        font-size: 10px;
    }

    #invoiceItemsTable {
        border-color: #E7ECE9;
        border-radius: 8px;
        overflow: hidden;
    }

    #invoiceItemsTable thead th {
        background: #F7F9F8 !important;
        color: #718078;
        border-color: #E7ECE9 !important;
        font-size: 10px;
        font-weight: 750;
        padding: 9px 8px;
    }

    #invoiceItemsTable tbody td {
        border-color: #EEF1EF !important;
        padding: 8px;
        vertical-align: middle;
    }

    #invoiceItemsTable .form-control,
    #invoiceItemsTable .custom-select {
        height: 32px;
        font-size: 10px;
        border-radius: 7px;
    }

    /* ================= DETAIL TABLE ================= */

    #modalInvoiceDetail .table {
        font-size: 10px;
    }

    #modalInvoiceDetail .table thead th {
        background: #F7F9F8 !important;
        color: #718078;
        border-color: #E7ECE9 !important;
        font-weight: 750;
        padding: 9px;
    }

    #modalInvoiceDetail .table tbody td {
        border-color: #EEF1EF !important;
        padding: 8px 9px;
    }

    /* ================= BUTTONS ================= */

    .modal-footer .btn,
    .modal-body .btn {
        border-radius: 8px;
        font-size: 10px;
        font-weight: 650;
    }

    .btn-primary {
        background: var(--billing-green);
        border-color: var(--billing-green);
    }

    .btn-primary:hover,
    .btn-primary:focus {
        background: var(--billing-green-dark);
        border-color: var(--billing-green-dark);
    }

    /* ================= RESPONSIVE ================= */

    @media (max-width: 991.98px) {
        .billing-header {
            align-items: flex-start;
        }

        .billing-toolbar {
            align-items: stretch;
        }

        .billing-search {
            min-width: 100%;
            flex-basis: 100%;
        }

        .billing-filter-date {
            flex: 1;
        }

        .billing-filter-date .form-control {
            width: 100%;
        }

        .billing-toolbar > div:not(.billing-search):not(.billing-filter-date) {
            flex: 1;
        }

        .billing-toolbar .custom-select {
            width: 100%;
            min-width: 0;
        }
    }

    @media (max-width: 767.98px) {
        .billing-header {
            flex-direction: column;
        }

        .btn-create-invoice {
            width: 100%;
        }

        .billing-title {
            font-size: 17px;
        }

        .billing-subtitle {
            font-size: 10px;
        }

        .billing-filter-date {
            min-width: 100%;
        }

        .billing-toolbar > div:not(.billing-search):not(.billing-filter-date) {
            min-width: 100%;
        }
    }
</style>
@endpush

@section('content')

<div class="billing-container">

    {{-- ================= PAGE HEADER ================= --}}
    <div class="billing-header">

        <div class="billing-header-left">
            <div class="billing-header-icon">
                <i class="fas fa-file-invoice-dollar"></i>
            </div>

            <div>
                <h2 class="billing-title">
                    គ្រប់គ្រងការទូទាត់ប្រាក់ & វិក្កយបត្រ
                </h2>

                <div class="billing-subtitle">
                    បង្កើតវិក្កយបត្រ គ្រប់គ្រងសេវាកម្ម/បន្ទប់/ថ្នាំ/មន្ទីរពិសោធន៍
                    និងទទួលការទូទាត់ប្រាក់
                </div>
            </div>
        </div>

        <button type="button"
                class="btn-create-invoice"
                data-toggle="modal"
                data-target="#modalCreateInvoice">
            <i class="fas fa-plus-circle"></i>
            <span>បង្កើតវិក្កយបត្រថ្មី</span>
        </button>

    </div>

    {{-- ================= SUCCESS TOAST ================= --}}
    <div id="billingSuccessToast"
         class="alert alert-success alert-dismissible fade show d-none mb-3"
         role="alert">

        <i class="fas fa-check-circle mr-2"></i>
        <span id="billingSuccessToastMessage"></span>

        <button type="button"
                class="close"
                data-dismiss="alert"
                aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    {{-- ================= STATS ================= --}}
    <div class="row mb-3">

        <div class="col-md-4 mb-3">
            <div class="billing-stat-card">

                <div class="billing-stat-icon billing-icon-invoice">
                    <i class="fas fa-file-invoice"></i>
                </div>

                <div>
                    <span class="billing-stat-label">
                        វិក្កយបត្រសរុប
                    </span>

                    <h3 id="statTotalInvoices"
                        class="billing-stat-value">
                        {{ $totalInvoices }}
                    </h3>
                </div>

            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="billing-stat-card">

                <div class="billing-stat-icon billing-icon-revenue">
                    <i class="fas fa-hand-holding-usd"></i>
                </div>

                <div>
                    <span class="billing-stat-label">
                        ចំណូលទទួលបានសរុប
                    </span>

                    <h3 id="statTotalRevenue"
                        class="billing-stat-value revenue">
                        ${{ number_format($totalRevenue, 2) }}
                    </h3>
                </div>

            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="billing-stat-card">

                <div class="billing-stat-icon billing-icon-unpaid">
                    <i class="fas fa-exclamation-circle"></i>
                </div>

                <div>
                    <span class="billing-stat-label">
                        ប្រាក់ជំពាក់សរុប
                    </span>

                    <h3 id="statTotalUnpaid"
                        class="billing-stat-value unpaid">
                        ${{ number_format($totalUnpaid, 2) }}
                    </h3>
                </div>

            </div>
        </div>

    </div>

    {{-- ================= MAIN TABLE ================= --}}
    <div class="billing-card">

        <div class="card-body p-0">

            {{-- ================= TOOLBAR ================= --}}
            <div class="billing-toolbar">

                {{-- Search --}}
                <div class="billing-search">
                    <i class="fas fa-search"></i>

                    <input type="text"
                           id="search"
                           class="form-control"
                           placeholder="ស្វែងរកវិក្កយបត្រ (លេខវិក្កយបត្រ, ឈ្មោះអ្នកជំងឺ, លេខទូរស័ព្ទ)...">
                </div>

                {{-- Date Filter --}}
                <div class="billing-filter-date">

                    <input type="date"
                           id="dateFrom"
                           class="form-control"
                           placeholder="ចាប់ពីថ្ងៃ">

                    <span class="date-separator">-</span>

                    <input type="date"
                           id="dateTo"
                           class="form-control"
                           placeholder="ដល់ថ្ងៃ">

                </div>

                {{-- Status Filter --}}
                <div>
                    <select id="statusFilter"
                            class="form-control custom-select">

                        <option value="">
                            -- ស្ថានភាពទាំងអស់ --
                        </option>

                        <option value="unpaid">
                            មិនទាន់បង់
                        </option>

                        <option value="partial">
                            បង់ខ្លះ
                        </option>

                        <option value="paid">
                            បានទូទាត់រួច
                        </option>

                        <option value="cancelled">
                            បានលុបចោល
                        </option>

                    </select>
                </div>

                {{-- Visit Type --}}
                <div>
                    <select id="visitTypeFilter"
                            class="form-control custom-select">

                        <option value="">
                            -- ប្រភេទចូលពិនិត្យទាំងអស់ --
                        </option>

                        <option value="opd">
                            អ្នកជំងឺក្រៅ (OPD)
                        </option>

                        <option value="ipd">
                            អ្នកជំងឺសម្រាក (IPD)
                        </option>

                    </select>
                </div>

            </div>

            {{-- ================= TABLE ================= --}}
            <div id="billingTableContainer">
                @include('form.billing.partials.table')
            </div>

        </div>
    </div>

</div>


{{-- ========================================================= --}}
{{-- CREATE INVOICE MODAL --}}
{{-- ========================================================= --}}

<div class="modal fade"
     id="modalCreateInvoice"
     tabindex="-1"
     aria-hidden="true">

    <div class="modal-dialog modal-xl">

        <div class="modal-content border-0 shadow-lg">

            <div class="modal-header modal-header-custom">

                <h5 class="modal-title font-weight-bold">
                    <i class="fas fa-file-invoice-dollar mr-2"></i>
                    បង្កើតវិក្កយបត្រថ្មី
                </h5>

                <button type="button"
                        class="close text-white"
                        data-dismiss="modal"
                        aria-label="Close">
                    <span>&times;</span>
                </button>

            </div>

            <form id="formCreateInvoice"
                  action="{{ route('billing.store') }}"
                  method="POST">

                @csrf

                <div class="modal-body p-4">

                    <div class="alert alert-danger d-none"
                         id="formCreateErrors"
                         style="border-radius:8px;">
                    </div>

                    {{-- Visit Type --}}
                    <div class="form-group mb-3">

                        <label class="font-weight-bold">
                            ប្រភេទការចូលពិនិត្យ
                            <span class="text-danger">*</span>
                        </label>

                        <div class="btn-group btn-group-toggle w-100"
                             data-toggle="buttons">

                            <label class="btn btn-outline-indigo active"
                                   id="labelVisitOpd"
                                   style="border-radius:8px 0 0 8px;">

                                <input type="radio"
                                       name="visit_type"
                                       value="opd"
                                       checked
                                       autocomplete="off">

                                <i class="fas fa-walking mr-1"></i>
                                អ្នកជំងឺក្រៅ (OPD)

                            </label>

                            <label class="btn btn-outline-indigo"
                                   id="labelVisitIpd"
                                   style="border-radius:0 8px 8px 0;">

                                <input type="radio"
                                       name="visit_type"
                                       value="ipd"
                                       autocomplete="off">

                                <i class="fas fa-bed mr-1"></i>
                                អ្នកជំងឺសម្រាកព្យាបាល (IPD)

                            </label>

                        </div>

                    </div>

                    {{-- Admission --}}
                    <div class="form-group mb-3 d-none"
                         id="admissionPickerWrap">

                        <label class="font-weight-bold">
                            ជ្រើសរើសការចូលសម្រាកព្យាបាល
                            <span class="text-danger">*</span>
                        </label>

                        <select id="create_admission_id"
                                name="admission_id"
                                class="form-control custom-select">

                            <option value="">
                                -- ជ្រើសរើសការចូលសម្រាកព្យាបាល --
                            </option>

                            @foreach($admissions as $adm)

                                <option value="{{ $adm->admission_id }}"
                                        data-patient-id="{{ $adm->patient_id }}"
                                        data-name="{{ optional($adm->patient)->full_name }}"
                                        data-phone="{{ optional($adm->patient)->phone }}">

                                    {{ optional($adm->patient)->full_name }}
                                    — បន្ទប់
                                    {{ optional($adm->room)->room_number ?? '—' }}

                                    (ចូលសម្រាក
                                    {{ $adm->admission_date
                                        ? $adm->admission_date->format('d/m/Y')
                                        : '' }})
                                </option>

                            @endforeach

                        </select>

                    </div>

                    {{-- Patient Details --}}
                    <div class="row mb-3">

                        <div class="col-md-6 mb-2">

                            <label class="font-weight-bold">
                                ជ្រើសរើសអ្នកជំងឺដែលមានស្រាប់
                            </label>

                            <select id="select_patient_id"
                                    name="patient_id"
                                    class="form-control custom-select">

                                <option value="">
                                    -- ជ្រើសរើសអ្នកជំងឺ ឬបញ្ចូលឈ្មោះខាងស្តាំ --
                                </option>

                                @foreach($patients as $pt)

                                    <option value="{{ $pt->patient_id }}"
                                            data-name="{{ $pt->full_name }}"
                                            data-phone="{{ $pt->phone }}">

                                        {{ $pt->full_name }}
                                        ({{ $pt->patient_code }})
                                        - {{ $pt->phone }}

                                    </option>

                                @endforeach

                            </select>

                        </div>

                        <div class="col-md-6 mb-2">

                            <label class="font-weight-bold">
                                ឈ្មោះអ្នកជំងឺ
                                <span class="text-danger">*</span>
                            </label>

                            <input type="text"
                                   name="patient_name"
                                   id="create_patient_name"
                                   class="form-control"
                                   placeholder="បញ្ចូលឈ្មោះអ្នកជំងឺ"
                                   required>

                        </div>

                        <div class="col-md-6 mb-2">

                            <label class="font-weight-bold">
                                លេខទូរស័ព្ទ
                            </label>

                            <input type="tel"
                                   maxlength="10"
                                   name="patient_phone"
                                   id="create_patient_phone"
                                   class="form-control"
                                   placeholder="012 345 678">

                        </div>

                        <div class="col-md-6 mb-2">

                            <label class="font-weight-bold">
                                ចំណាំ
                            </label>

                            <input type="text"
                                   name="notes"
                                   id="create_notes"
                                   class="form-control"
                                   placeholder="កំណត់ចំណាំផ្សេងៗ">

                        </div>

                    </div>

                    <hr>

                    {{-- Invoice Items --}}
                    <div class="d-flex justify-content-between align-items-center mb-3">

                        <h6 class="font-weight-bold text-primary mb-0">
                            <i class="fas fa-list mr-1"></i>
                            បញ្ជីសេវាកម្ម/បន្ទប់/ថ្នាំ/មន្ទីរពិសោធន៍
                        </h6>

                        <button type="button"
                                class="btn btn-sm btn-outline-primary"
                                id="btnAddInvoiceItem"
                                style="border-radius:8px;">

                            <i class="fas fa-plus mr-1"></i>
                            បន្ថែមមុខសេវា

                        </button>

                    </div>

                    <table class="table table-bordered align-middle mb-3"
                           id="invoiceItemsTable">

                        <thead class="bg-light">

                            <tr>

                                <th style="width:24%;">
                                    ប្រភេទសេវា
                                    <span class="text-danger">*</span>
                                </th>

                                <th>
                                    បរិយាយ
                                    <span class="text-danger">*</span>
                                </th>

                                <th style="width:100px;">
                                    ចំនួន
                                </th>

                                <th style="width:130px;">
                                    តម្លៃ ($)
                                </th>

                                <th style="width:130px;">
                                    សរុប ($)
                                </th>

                                <th style="width:45px;"
                                    class="text-center">
                                    <i class="fas fa-trash-alt"></i>
                                </th>

                            </tr>

                        </thead>

                        <tbody id="invoiceItemsTbody">

                            <tr class="item-row">

                                <td>

                                    <select name="items[0][item_type]"
                                            class="form-control form-control-sm item-type"
                                            required>

                                        <option value=""
                                                disabled
                                                selected>
                                            -- ជ្រើសរើសប្រភេទសេវា --
                                        </option>

                                        <option value="service">
                                            សេវាកម្ម
                                        </option>

                                        <option value="room">
                                            បន្ទប់សម្រាក
                                        </option>

                                        <option value="medicine">
                                            ថ្នាំពេទ្យ
                                        </option>

                                        <option value="lab">
                                            មន្ទីរពិសោធន៍
                                        </option>

                                    </select>

                                </td>

                                <td>

                                    <input type="text"
                                           name="items[0][description]"
                                           class="form-control form-control-sm item-desc"
                                           placeholder="បរិយាយសេវា"
                                           value="ថ្លៃពិគ្រោះជំងឺទូទៅ"
                                           required>

                                </td>

                                <td>

                                    <input type="number"
                                           name="items[0][qty]"
                                           class="form-control form-control-sm item-qty text-center"
                                           value="1"
                                           min="1"
                                           required>

                                </td>

                                <td>

                                    <input type="number"
                                           step="0.01"
                                           name="items[0][unit_price]"
                                           class="form-control form-control-sm item-price text-right"
                                           value="15.00"
                                           min="0"
                                           required>

                                </td>

                                <td>

                                    <input type="text"
                                           class="form-control form-control-sm item-subtotal text-right bg-light"
                                           value="15.00"
                                           readonly>

                                </td>

                                <td class="text-center">

                                    <button type="button"
                                            class="btn btn-sm btn-outline-danger btn-remove-item"
                                            style="border-radius:6px;">

                                        <i class="fas fa-trash-alt"></i>

                                    </button>

                                </td>

                            </tr>

                        </tbody>

                    </table>

                    <div class="d-flex justify-content-end align-items-center">

                        <div class="text-right">

                            <span class="text-muted font-weight-bold">
                                តម្លៃសរុប៖
                            </span>

                            <h4 class="d-inline font-weight-bold text-primary ml-2 mb-0">
                                $
                                <span id="createGrandTotal">
                                    15.00
                                </span>
                            </h4>

                        </div>

                    </div>

                </div>

                <div class="modal-footer bg-light">

                    <button type="button"
                            class="btn btn-secondary"
                            data-dismiss="modal">
                        បោះបង់
                    </button>

                    <button type="submit"
                            class="btn btn-primary"
                            id="btnSubmitCreateInvoice">

                        <i class="fas fa-save mr-1"></i>
                        រក្សាទុកវិក្កយបត្រ

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


{{-- ========================================================= --}}
{{-- PAY INVOICE MODAL --}}
{{-- ========================================================= --}}

<div class="modal fade"
     id="modalPayInvoice"
     tabindex="-1"
     aria-hidden="true">

    <div class="modal-dialog">

        <div class="modal-content border-0 shadow-lg">

            <div class="modal-header modal-header-pay">

                <h5 class="modal-title font-weight-bold">
                    <i class="fas fa-dollar-sign mr-2"></i>
                    ទូទាត់ប្រាក់វិក្កយបត្រ
                </h5>

                <button type="button"
                        class="close text-white"
                        data-dismiss="modal"
                        aria-label="Close">
                    <span>&times;</span>
                </button>

            </div>

            <form id="formPayInvoice">

                @csrf

                <input type="hidden"
                       id="pay_invoice_id"
                       name="invoice_id">

                <div class="modal-body p-4">

                    <div class="alert alert-info border-0 shadow-sm mb-3"
                         style="border-radius:10px;">

                        <div class="d-flex justify-content-between mb-1">
                            <span>លេខវិក្កយបត្រ:</span>
                            <strong id="payInvoiceNumber"
                                    class="text-dark"></strong>
                        </div>

                        <div class="d-flex justify-content-between mb-1">
                            <span>អ្នកជំងឺ:</span>
                            <strong id="payPatientName"
                                    class="text-dark"></strong>
                        </div>

                        <div class="d-flex justify-content-between mb-1">
                            <span>ប្រាក់សរុប:</span>
                            <strong id="payTotalAmount"
                                    class="text-dark"></strong>
                        </div>

                        <div class="d-flex justify-content-between border-top pt-2 mt-2">
                            <span class="font-weight-bold text-danger">
                                ប្រាក់ជំពាក់នៅសល់:
                            </span>

                            <strong id="payBalanceAmount"
                                    class="text-danger h5 mb-0">
                            </strong>
                        </div>

                    </div>

                    {{-- Payment Method --}}
                    <div class="form-group mb-3">

                        <label class="font-weight-bold">
                            វិធីសាស្ត្រទូទាត់
                            <span class="text-danger">*</span>
                        </label>

                        <div class="btn-group btn-group-toggle w-100"
                             data-toggle="buttons">

                            <label class="btn btn-outline-success active"
                                   id="labelMethodCash">

                                <input type="radio"
                                       name="payment_method"
                                       value="cash"
                                       checked
                                       autocomplete="off">

                                <i class="fas fa-money-bill-wave mr-1"></i>
                                សាច់ប្រាក់

                            </label>

                            <label class="btn btn-outline-success"
                                   id="labelMethodCard">

                                <input type="radio"
                                       name="payment_method"
                                       value="card"
                                       autocomplete="off">

                                <i class="fas fa-credit-card mr-1"></i>
                                កាតធនាគារ

                            </label>

                            <label class="btn btn-outline-success"
                                   id="labelMethodOnline">

                                <input type="radio"
                                       name="payment_method"
                                       value="online"
                                       autocomplete="off">

                                <i class="fas fa-qrcode mr-1"></i>
                                Online / KHQR

                            </label>

                        </div>

                    </div>

                    {{-- Amount --}}
                    <div class="form-group mb-3">

                        <label for="pay_amount"
                               class="font-weight-bold">

                            ចំនួនប្រាក់ត្រូវបង់ ($)
                            <span class="text-danger">*</span>

                        </label>

                        <div class="input-group">

                            <div class="input-group-prepend">
                                <span class="input-group-text bg-light">
                                    $
                                </span>
                            </div>

                            <input type="number"
                                   step="0.01"
                                   name="amount"
                                   id="pay_amount"
                                   class="form-control form-control-lg font-weight-bold text-success"
                                   required>

                        </div>

                    </div>

                </div>

                <div class="modal-footer bg-light">

                    <button type="button"
                            class="btn btn-secondary"
                            data-dismiss="modal">
                        បោះបង់
                    </button>

                    <button type="submit"
                            class="btn btn-success px-4"
                            id="btnSubmitPayInvoice">

                        <i class="fas fa-check-circle mr-1"></i>
                        បញ្ជាក់ការទូទាត់

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


{{-- ========================================================= --}}
{{-- RECEIPT MODAL --}}
{{-- ========================================================= --}}

<div class="modal fade"
     id="modalReceiptInvoice"
     tabindex="-1"
     aria-hidden="true">

    <div class="modal-dialog modal-lg">

        <div class="modal-content border-0 shadow-lg">

            <div class="modal-header modal-header-custom text-white">

                <h5 class="modal-title font-weight-bold">
                    <i class="fas fa-print mr-2"></i>
                    ប័ណ្ណទូទាត់ប្រាក់
                </h5>

                <button type="button"
                        class="close text-white"
                        data-dismiss="modal"
                        aria-label="Close">

                    <span>&times;</span>

                </button>

            </div>

            <div class="modal-body p-4"
                 id="modalReceiptBody">

                <div class="text-center py-4">
                    <i class="fas fa-spinner fa-spin fa-2x text-muted"></i>
                </div>

            </div>

            <div class="modal-footer bg-light">

                <button type="button"
                        class="btn btn-secondary"
                        data-dismiss="modal">
                    បិទ
                </button>

                <button type="button"
                        class="btn btn-primary px-4"
                        id="btnPrintReceipt">

                    <i class="fas fa-print mr-1"></i>
                    បោះពុម្ពវិក្កយបត្រ

                </button>

            </div>

        </div>

    </div>

</div>


{{-- ========================================================= --}}
{{-- INVOICE DETAIL MODAL --}}
{{-- ========================================================= --}}

<div class="modal fade"
     id="modalInvoiceDetail"
     tabindex="-1"
     aria-hidden="true">

    <div class="modal-dialog modal-lg">

        <div class="modal-content border-0 shadow-lg">

            <div class="modal-header modal-header-custom text-white">

                <h5 class="modal-title font-weight-bold">
                    <i class="fas fa-file-invoice mr-2"></i>
                    ព័ត៌មានលម្អិតវិក្កយបត្រ
                </h5>

                <button type="button"
                        class="close"
                        data-dismiss="modal">
                    <span>&times;</span>
                </button>

            </div>

            <div class="modal-body p-4">

                <div id="viewCancelledBanner"
                     class="alert alert-danger d-none">

                    <strong>បានលុបចោល</strong>
                    <br>

                    មូលហេតុ:
                    <span id="viewCancelReason"></span>

                    <br>

                    ដោយ:
                    <span id="viewCancelledBy"></span>
                    —
                    <span id="viewCancelledAt"></span>

                </div>

                <div class="row mb-3">

                    <div class="col-md-6">

                        <p class="mb-1">
                            <b>លេខវិក្កយបត្រ:</b>
                            <span id="viewInvoiceNumber"></span>
                        </p>

                        <p class="mb-1">
                            <b>ស្ថានភាព:</b>
                            <span id="viewInvoiceStatus"></span>
                        </p>

                        <p class="mb-1">
                            <b>កាលបរិច្ឆេទ:</b>
                            <span id="viewInvoiceDate"></span>
                        </p>

                        <p class="mb-1">
                            <b>បង្កើតដោយ:</b>
                            <span id="viewCreatedBy"></span>
                        </p>

                    </div>

                    <div class="col-md-6">

                        <p class="mb-1">
                            <b>លេខកូដអ្នកជំងឺ:</b>
                            <span id="viewPatientCode"></span>
                        </p>

                        <p class="mb-1">
                            <b>ឈ្មោះ:</b>
                            <span id="viewPatientName"></span>
                        </p>

                        <p class="mb-1">
                            <b>ភេទ:</b>
                            <span id="viewPatientGender"></span>
                        </p>

                        <p class="mb-1">
                            <b>ទូរស័ព្ទ:</b>
                            <span id="viewPatientPhone"></span>
                        </p>

                        <p class="mb-1">
                            <b>ប្រភេទ:</b>
                            <span id="viewVisitType"></span>
                        </p>

                        <p class="mb-1 d-none"
                           id="viewAdmissionWrap">

                            <b>លេខចូលសម្រាក:</b>
                            <span id="viewAdmissionNumber"></span>

                        </p>

                        <p class="mb-1 d-none"
                           id="viewRoomWrap">

                            <b>បន្ទប់:</b>
                            <span id="viewRoomNumber"></span>

                        </p>

                    </div>

                </div>

                <table class="table table-bordered table-sm">

                    <thead class="bg-light">

                        <tr>

                            <th>បរិយាយ</th>
                            <th>ប្រភេទ</th>
                            <th class="text-center">ចំនួន</th>
                            <th class="text-right">តម្លៃរាយ</th>
                            <th class="text-right">សរុប</th>

                        </tr>

                    </thead>

                    <tbody id="viewInvoiceItems"></tbody>

                </table>

                <div class="row">

                    <div class="col-md-6">

                        <h6 class="font-weight-bold">
                            ប្រវត្តិទូទាត់
                        </h6>

                        <div id="viewPaymentsList"></div>

                        <p class="mt-3 mb-1">
                            <b>ចំណាំ:</b>
                            <span id="viewNotes"></span>
                        </p>

                    </div>

                    <div class="col-md-6">

                        <table class="table table-sm table-borderless text-right mb-0">

                            <tr>
                                <td>សរុប:</td>
                                <td class="font-weight-bold"
                                    id="viewInvoiceTotal"></td>
                            </tr>

                            <tr>
                                <td>បានបង់:</td>
                                <td class="font-weight-bold text-success"
                                    id="viewInvoicePaid"></td>
                            </tr>

                            <tr>
                                <td>ជំពាក់:</td>
                                <td class="font-weight-bold text-danger"
                                    id="viewInvoiceBalance"></td>
                            </tr>

                        </table>

                    </div>

                </div>

            </div>

            <div class="modal-footer bg-light">

                <button type="button"
                        class="btn btn-secondary"
                        data-dismiss="modal">
                    បិទ
                </button>

            </div>

        </div>

    </div>

</div>


{{-- ========================================================= --}}
{{-- EDIT INVOICE MODAL --}}
{{-- ========================================================= --}}

<div class="modal fade"
     id="modalEditInvoice"
     tabindex="-1"
     aria-hidden="true">

    <div class="modal-dialog modal-xl">

        <div class="modal-content border-0 shadow-lg">

            <div class="modal-header modal-header-custom">

                <h5 class="modal-title font-weight-bold">
                    <i class="fas fa-pen mr-2"></i>
                    កែប្រែវិក្កយបត្រ
                </h5>

                <button type="button"
                        class="close"
                        data-dismiss="modal">
                    <span>&times;</span>
                </button>

            </div>

            <form id="editInvoiceForm"
                  method="POST">

                @csrf

                <div class="modal-body p-4">

                    <div class="alert alert-danger d-none"
                         id="editInvoiceAlert">
                    </div>

                    <div class="row mb-3">

                        <div class="col-md-4">

                            <label class="font-weight-bold">
                                ឈ្មោះអ្នកជំងឺ
                                <span class="text-danger">*</span>
                            </label>

                            <input type="text"
                                   name="patient_name"
                                   id="edit_patient_name"
                                   class="form-control"
                                   required>

                        </div>

                        <div class="col-md-4">

                            <label class="font-weight-bold">
                                លេខទូរស័ព្ទ
                            </label>

                            <input type="tel"
                                   maxlength="10"
                                   name="patient_phone"
                                   id="edit_patient_phone"
                                   class="form-control">

                        </div>

                        <div class="col-md-4">

                            <label class="font-weight-bold">
                                ចំណាំ
                            </label>

                            <input type="text"
                                   name="notes"
                                   id="edit_notes"
                                   class="form-control">

                        </div>

                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-2">

                        <h6 class="font-weight-bold text-primary mb-0">
                            បញ្ជីសេវាកម្ម
                        </h6>

                        <button type="button"
                                class="btn btn-sm btn-outline-primary"
                                id="btnAddEditInvoiceItem">

                            <i class="fas fa-plus mr-1"></i>
                            បន្ថែមមុខសេវា

                        </button>

                    </div>

                    <table class="table table-bordered mb-3">

                        <thead class="bg-light">

                            <tr>

                                <th style="width:24%">
                                    ប្រភេទ
                                </th>

                                <th>
                                    បរិយាយ
                                </th>

                                <th style="width:100px">
                                    ចំនួន
                                </th>

                                <th style="width:130px">
                                    តម្លៃ ($)
                                </th>

                                <th style="width:130px">
                                    សរុប ($)
                                </th>

                                <th style="width:45px"></th>

                            </tr>

                        </thead>

                        <tbody id="editInvoiceItemsTbody"></tbody>

                    </table>

                    <div class="text-right">

                        <span class="text-muted font-weight-bold">
                            តម្លៃសរុប៖
                        </span>

                        <h4 class="d-inline font-weight-bold text-primary ml-2"
                            id="editInvoiceGrandTotal">
                            $0.00
                        </h4>

                    </div>

                </div>

                <div class="modal-footer bg-light">

                    <button type="button"
                            class="btn btn-secondary"
                            data-dismiss="modal">
                        បោះបង់
                    </button>

                    <button type="submit"
                            class="btn btn-primary"
                            id="btnSubmitEditInvoice">

                        <i class="fas fa-save mr-1"></i>
                        រក្សាទុកការកែប្រែ (Save Changes)

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


{{-- ========================================================= --}}
{{-- CANCEL INVOICE MODAL --}}
{{-- ========================================================= --}}

<div class="modal fade"
     id="modalCancelInvoice"
     tabindex="-1"
     aria-hidden="true">

    <div class="modal-dialog">

        <div class="modal-content border-0 shadow-lg">

            <div class="modal-header">

                <h5 class="modal-title font-weight-bold text-danger">
                    <i class="fas fa-ban mr-2"></i>
                    លុបចោលវិក្កយបត្រ
                </h5>

                <button type="button"
                        class="close"
                        data-dismiss="modal">
                    <span>&times;</span>
                </button>

            </div>

            <form id="cancelInvoiceForm"
                  method="POST">

                @csrf

                <div class="modal-body p-4">

                    <div class="alert alert-danger d-none"
                         id="cancelInvoiceAlert">
                    </div>

                    <p>
                        តើអ្នកចង់លុបចោលវិក្កយបត្រ
                        <strong id="cancelInvoiceNumber"></strong>
                        មែនទេ?
                    </p>

                    <div class="form-group mb-0">

                        <label class="font-weight-bold">
                            មូលហេតុ
                            <span class="text-danger">*</span>
                        </label>

                        <textarea name="cancel_reason"
                                  id="cancel_reason"
                                  class="form-control"
                                  rows="3"
                                  required></textarea>

                    </div>

                </div>

                <div class="modal-footer bg-light">

                    <button type="button"
                            class="btn btn-secondary"
                            data-dismiss="modal">
                        បិទ
                    </button>

                    <button type="submit"
                            class="btn btn-danger"
                            id="btnSubmitCancelInvoice">

                        <i class="fas fa-ban mr-1"></i>
                        បញ្ជាក់ការលុបចោល (Confirm Cancel)

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@stop


@section('js')

<script>
    window.billingConfig = {
        indexUrl: "{{ route('billing.index') }}",
        storeUrl: "{{ route('billing.store') }}",
        baseUrl: "{{ url('billing') }}",
        showUrl: "{{ url('billing') }}",
        generateKhqrUrl: "{{ Route::has('qr.generateInvoice') ? route('qr.generateInvoice') : url('billing/khqr/generate') }}",
        checkKhqrStatusUrlBase: "{{ url('qr/status') }}",
        csrfToken: "{{ csrf_token() }}",
        currency: "{{ $billing->currency_symbol ?? '$' }}",
        currency2: "{{ $billing->secondary_currency_symbol ?? '៛' }}",
        exchangeRate: {{ $billing->exchange_rate ?? 4100 }},
        taxPercent: {{ $billing->tax_percent ?? 0 }},
    };
</script>

<script src="{{ asset('js/billing.js') }}"></script>

@stop