@extends('adminlte::page')

@section('title', 'វេជ្ជបណ្ឌិត (Doctor Consultation & Directory)')

@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Kantumruuy+Pro:wght@400;500;600;700&display=swap');

    :root {
        --doctor-green: #006D36;
        --doctor-green-dark: #00552B;
        --doctor-green-light: #E8F5EE;
        --doctor-bg: #F5F7F6;
        --doctor-border: #E7ECE9;
        --doctor-text: #1F2A24;
        --doctor-muted: #7A8780;
        --doctor-blue: #2563EB;
        --doctor-red: #DC3545;
        --doctor-orange: #F59E0B;
    }

    body,
    .content-wrapper {
        background-color: var(--doctor-bg) !important;
        font-family: 'Inter', 'Kantumruuy Pro', sans-serif !important;
    }

    .doctor-page {
        padding-top: 12px;
        padding-bottom: 30px;
    }

    /* =========================================================
       ALERT
    ========================================================= */

    .doctor-alert {
        border: 0;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(31, 42, 36, .05);
        font-size: 13px;
    }

    /* =========================================================
       TOP HEADER
    ========================================================= */

    .doctor-header {
        background: linear-gradient(135deg, #006D36 0%, #008747 100%);
        border-radius: 16px;
        padding: 20px 24px;
        color: #fff;
        box-shadow: 0 10px 25px rgba(0, 109, 54, .18);
    }

    .doctor-header-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
    }

    .doctor-header-info {
        display: flex;
        align-items: center;
    }

    .doctor-header-icon {
        width: 52px;
        height: 52px;
        min-width: 52px;
        border-radius: 12px;
        background: #fff;
        color: var(--doctor-green);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        margin-right: 14px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, .10);
    }

    .doctor-header h2,
    .doctor-header h5 {
        margin: 0;
        font-weight: 700;
    }

    .doctor-header h2 {
        font-size: 21px;
    }

    .doctor-header p {
        margin: 4px 0 0;
        font-size: 12px;
        color: rgba(255,255,255,.78);
    }

    .doctor-header-badge {
        background: rgba(255,255,255,.16);
        border: 1px solid rgba(255,255,255,.18);
        color: #fff;
        border-radius: 9px;
        padding: 8px 12px;
        font-size: 12px;
        font-weight: 600;
        white-space: nowrap;
    }

    /* =========================================================
       EMPTY WORKSPACE
    ========================================================= */

    .doctor-empty-workspace {
        background: #fff;
        border: 1px solid var(--doctor-border);
        border-radius: 15px;
        min-height: 350px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 18px rgba(31, 42, 36, .04);
    }

    .doctor-empty-icon {
        width: 70px;
        height: 70px;
        border-radius: 18px;
        background: var(--doctor-green-light);
        color: var(--doctor-green);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        margin-bottom: 16px;
    }

    .doctor-empty-workspace h5 {
        color: var(--doctor-text);
        font-weight: 700;
        margin-bottom: 5px;
    }

    .doctor-empty-workspace p {
        color: var(--doctor-muted);
        font-size: 12px;
        margin: 0;
    }

    /* =========================================================
       DOCTOR PROFILE BAR
    ========================================================= */

    .doc-top-bar {
        background: linear-gradient(135deg, #006D36 0%, #008747 100%);
        color: #fff;
        border-radius: 16px;
        padding: 18px 22px;
        box-shadow: 0 10px 25px rgba(0, 109, 54, .18);
    }

    .doc-avatar-icon {
        width: 50px;
        height: 50px;
        min-width: 50px;
        border-radius: 12px;
        background: #fff;
        color: var(--doctor-green);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 21px;
        margin-right: 13px;
        box-shadow: 0 4px 12px rgba(0,0,0,.10);
    }

    .doc-top-bar h5 {
        font-size: 16px;
    }

    .doc-top-bar small {
        font-size: 11px;
    }

    .doctor-duty-badge {
        background: #fff;
        color: var(--doctor-green);
        border-radius: 9px;
        padding: 8px 12px;
        font-size: 11px;
        font-weight: 700;
    }

    /* =========================================================
       MODERN CARD
    ========================================================= */

    .card-modern {
        background: #fff;
        border: 1px solid var(--doctor-border);
        border-radius: 15px;
        box-shadow: 0 4px 18px rgba(31, 42, 36, .04);
    }

    /* =========================================================
       PATIENT PROFILE
    ========================================================= */

    .avatar-circle {
        width: 64px;
        height: 64px;
        min-width: 64px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid var(--doctor-green-light);
        box-shadow: 0 4px 12px rgba(0,0,0,.08);
    }

    .patient-code {
        display: inline-block;
        background: var(--doctor-green-light);
        color: var(--doctor-green);
        padding: 4px 8px;
        border-radius: 6px;
        font-size: 10px;
        font-weight: 700;
    }

    .patient-info-label {
        display: block;
        color: var(--doctor-muted);
        font-size: 10px;
        font-weight: 700;
        margin-bottom: 2px;
    }

    .patient-info-value {
        color: var(--doctor-text);
        font-size: 12px;
        font-weight: 600;
    }

    /* =========================================================
       VITALS
    ========================================================= */

    .vitals-box {
        background: #F8FAF9;
        border: 1px solid var(--doctor-border);
        border-radius: 11px;
        padding: 12px 8px;
        text-align: center;
        transition: all .2s ease;
    }

    .vitals-box:hover {
        background: #fff;
        border-color: #CDE5D7;
        box-shadow: 0 4px 12px rgba(31,42,36,.05);
    }

    .vitals-val {
        font-size: 16px;
        font-weight: 700;
        color: var(--doctor-text);
    }

    .vitals-label {
        display: block;
        color: var(--doctor-muted);
        font-size: 10px;
        font-weight: 700;
        margin-bottom: 4px;
    }

    /* =========================================================
       SECTION TITLE
    ========================================================= */

    .section-title {
        display: flex;
        align-items: center;
        color: var(--doctor-text);
        font-size: 14px;
        font-weight: 700;
        margin-bottom: 14px;
    }

    .section-title-icon {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        background: var(--doctor-green-light);
        color: var(--doctor-green);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-right: 9px;
        font-size: 13px;
    }

    /* =========================================================
       TABS
    ========================================================= */

    .nav-tabs-custom {
        border-bottom: 1px solid var(--doctor-border);
        padding-bottom: 4px;
    }

    .nav-tabs-custom .nav-link {
        border: 0;
        color: var(--doctor-muted);
        font-size: 12px;
        font-weight: 600;
        padding: 9px 13px;
        border-radius: 8px;
        margin-right: 5px;
    }

    .nav-tabs-custom .nav-link:hover {
        background: #F5F8F6;
        color: var(--doctor-green);
    }

    .nav-tabs-custom .nav-link.active {
        background: var(--doctor-green);
        color: #fff !important;
    }

    /* =========================================================
       FORM
    ========================================================= */

    .doctor-page .form-control {
        border: 1px solid #DDE5E0;
        border-radius: 9px;
        font-size: 12px;
        color: var(--doctor-text);
        box-shadow: none;
    }

    .doctor-page .form-control:focus {
        border-color: #7BB996;
        box-shadow: 0 0 0 3px rgba(0,109,54,.08);
    }

    .doctor-page label {
        font-size: 12px;
    }

    /* =========================================================
       DIAGNOSIS TAGS
    ========================================================= */

    .diag-tag {
        display: inline-flex;
        align-items: center;
        background: var(--doctor-green-light);
        color: var(--doctor-green);
        border: 1px solid #CDE5D7;
        font-size: 11px;
        font-weight: 700;
        padding: 6px 10px;
        border-radius: 20px;
        cursor: pointer;
        transition: all .2s ease;
        user-select: none;
    }

    .diag-tag:hover,
    .diag-tag.selected {
        background: var(--doctor-green);
        color: #fff;
        border-color: var(--doctor-green);
    }

    /* =========================================================
       PRESCRIPTION TABLE
    ========================================================= */

    #rxTable {
        border: 1px solid var(--doctor-border);
        border-radius: 10px;
        overflow: hidden;
    }

    #rxTable thead {
        background: #F8FAF9;
    }

    #rxTable thead th {
        border: 0;
        border-bottom: 1px solid var(--doctor-border);
        color: #68756E;
        font-size: 10px;
        font-weight: 700;
        padding: 11px 9px;
        white-space: nowrap;
    }

    #rxTable tbody td {
        border-top: 1px solid #EEF2EF;
        padding: 8px;
        vertical-align: middle;
    }

    #rxTable .form-control {
        font-size: 11px;
        min-height: 34px;
    }

    .rx-remove {
        width: 30px;
        height: 30px;
        border-radius: 7px;
    }

    /* =========================================================
       ACTION BUTTONS
    ========================================================= */

    .btn-action-lab {
        background: #EFF6FF;
        color: #2563EB;
        border: 1px solid #BFDBFE;
        border-radius: 9px;
        font-size: 12px;
        font-weight: 700;
        padding: 9px 13px;
        transition: all .2s ease;
    }

    .btn-action-lab:hover {
        background: #2563EB;
        color: #fff;
        border-color: #2563EB;
    }

    .btn-action-admit {
        background: #fff;
        color: #68756E;
        border: 1px solid var(--doctor-border);
        border-radius: 9px;
        font-size: 12px;
        font-weight: 700;
        padding: 9px 13px;
        transition: all .2s ease;
    }

    .btn-action-admit:hover {
        background: var(--doctor-green-light);
        color: var(--doctor-green);
        border-color: #CDE5D7;
    }

    .btn-action-confirm {
        background: var(--doctor-green);
        color: #fff;
        border: 0;
        border-radius: 9px;
        font-size: 12px;
        font-weight: 700;
        padding: 10px 18px;
        box-shadow: 0 5px 14px rgba(0,109,54,.20);
        transition: all .2s ease;
    }

    .btn-action-confirm:hover {
        background: var(--doctor-green-dark);
        color: #fff;
    }

    /* =========================================================
       ADMIN HEADER
    ========================================================= */

    .directory-header {
        background: linear-gradient(135deg, #006D36 0%, #008747 100%);
        color: #fff;
        border-radius: 16px;
        padding: 20px 24px;
        box-shadow: 0 10px 25px rgba(0,109,54,.18);
    }

    .directory-header-icon {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        background: #fff;
        color: var(--doctor-green);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 21px;
        margin-right: 13px;
    }

    .directory-header h3 {
        font-size: 18px;
        margin-bottom: 2px;
    }

    .directory-header small {
        color: rgba(255,255,255,.76);
        font-size: 11px;
    }

    /* =========================================================
       STAT CARDS
    ========================================================= */

    .doctor-stat-card {
        height: 100%;
        background: #fff;
        border: 1px solid var(--doctor-border);
        border-radius: 14px;
        padding: 17px;
        display: flex;
        align-items: center;
        box-shadow: 0 4px 18px rgba(31,42,36,.04);
        transition: all .2s ease;
    }

    .doctor-stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 7px 22px rgba(31,42,36,.07);
    }

    .doctor-stat-icon {
        width: 48px;
        height: 48px;
        min-width: 48px;
        border-radius: 11px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 13px;
        font-size: 19px;
    }

    .doctor-stat-icon.green {
        background: var(--doctor-green-light);
        color: var(--doctor-green);
    }

    .doctor-stat-icon.blue {
        background: #EFF6FF;
        color: #2563EB;
    }

    .doctor-stat-icon.info {
        background: #ECFEFF;
        color: #0891B2;
    }

    .doctor-stat-label {
        color: var(--doctor-muted);
        font-size: 10px;
        font-weight: 700;
        margin-bottom: 2px;
    }

    .doctor-stat-value {
        color: var(--doctor-text);
        font-size: 23px;
        line-height: 1.1;
        font-weight: 700;
    }

    /* =========================================================
       DIRECTORY PANEL
    ========================================================= */

    .doctor-panel {
        background: #fff;
        border: 1px solid var(--doctor-border);
        border-radius: 15px;
        box-shadow: 0 4px 18px rgba(31,42,36,.04);
        overflow: hidden;
    }

    .doctor-panel-header {
        min-height: 70px;
        padding: 14px 18px;
        border-bottom: 1px solid var(--doctor-border);
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
    }

    .doctor-panel-title {
        display: flex;
        align-items: center;
    }

    .doctor-panel-title-icon {
        width: 38px;
        height: 38px;
        border-radius: 9px;
        background: var(--doctor-green-light);
        color: var(--doctor-green);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 10px;
    }

    .doctor-panel-title h6 {
        color: var(--doctor-text);
        font-size: 13px;
        font-weight: 700;
        margin: 0;
    }

    .doctor-panel-title span {
        display: block;
        color: var(--doctor-muted);
        font-size: 10px;
        margin-top: 2px;
    }

    .doctor-search {
        max-width: 280px;
        width: 100%;
    }

    .doctor-search .form-control {
        border-radius: 9px 0 0 9px;
        height: 36px;
    }

    .doctor-search .btn {
        height: 36px;
        border-radius: 0 9px 9px 0;
        background: var(--doctor-green);
        border-color: var(--doctor-green);
    }

    .doctor-panel-body {
        padding: 0;
    }

    /* =========================================================
       TABLE
    ========================================================= */

    .doctor-table {
        width: 100%;
        margin: 0;
    }

    .doctor-table thead {
        background: #F8FAF9;
    }

    .doctor-table thead th {
        border: 0;
        border-bottom: 1px solid var(--doctor-border);
        color: #68756E;
        font-size: 10px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .25px;
        padding: 13px 14px;
        white-space: nowrap;
    }

    .doctor-table tbody td {
        border-top: 1px solid #EEF2EF;
        padding: 13px 14px;
        vertical-align: middle;
        color: #5F6C65;
        font-size: 12px;
    }

    .doctor-table tbody tr {
        transition: background-color .2s ease;
    }

    .doctor-table tbody tr:hover {
        background: #FAFCFB;
    }

    .doctor-id {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 38px;
        padding: 5px 8px;
        background: var(--doctor-green-light);
        color: var(--doctor-green);
        border-radius: 6px;
        font-size: 10px;
        font-weight: 700;
    }

    .doctor-name-wrapper {
        display: flex;
        align-items: center;
        gap: 9px;
    }

    .doctor-row-icon {
        width: 34px;
        height: 34px;
        min-width: 34px;
        border-radius: 9px;
        background: var(--doctor-green-light);
        color: var(--doctor-green);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 13px;
    }

    .doctor-name {
        color: var(--doctor-text);
        font-size: 12px;
        font-weight: 700;
    }

    .doctor-department {
        color: #68756E;
        font-size: 11px;
    }

    .specialization-badge {
        display: inline-block;
        background: #EFF6FF;
        color: #2563EB;
        border: 1px solid #BFDBFE;
        border-radius: 6px;
        padding: 4px 7px;
        font-size: 10px;
        font-weight: 700;
    }

    .active-badge {
        display: inline-flex;
        align-items: center;
        background: var(--doctor-green-light);
        color: var(--doctor-green);
        border-radius: 20px;
        padding: 5px 9px;
        font-size: 10px;
        font-weight: 700;
    }

    .active-badge i {
        font-size: 6px;
        margin-right: 5px;
    }

    .audit-btn {
        background: #F8FAF9;
        color: #8A958F;
        border: 1px solid var(--doctor-border);
        border-radius: 7px;
        font-size: 10px;
        font-weight: 700;
        padding: 6px 9px;
    }

    /* =========================================================
       NURSE QUEUE
    ========================================================= */

    .pending-badge {
        background: #FFF4E5;
        color: #B86B00;
        border: 1px solid #F7D9A5;
        border-radius: 20px;
        padding: 6px 10px;
        font-size: 10px;
        font-weight: 700;
    }

    .vitals-action-btn {
        background: #FFF1F2;
        color: #DC3545;
        border: 1px solid #F8C8CD;
        border-radius: 8px;
        font-size: 10px;
        font-weight: 700;
        padding: 7px 10px;
    }

    .vitals-action-btn:hover {
        background: #DC3545;
        color: #fff;
        border-color: #DC3545;
    }

    /* =========================================================
       MODALS
    ========================================================= */

    .doctor-modal .modal-content {
        border: 0;
        border-radius: 14px;
        overflow: hidden;
        box-shadow: 0 15px 45px rgba(31,42,36,.15);
    }

    .doctor-modal-header {
        background: linear-gradient(135deg, #006D36 0%, #008747 100%);
        color: #fff;
        border: 0;
        padding: 15px 18px;
    }

    .doctor-modal-header.danger {
        background: linear-gradient(135deg, #DC3545 0%, #B91C2C 100%);
    }

    .doctor-modal-header h5 {
        font-size: 14px;
        margin: 0;
        font-weight: 700;
    }

    .doctor-modal-body {
        padding: 20px;
    }

    .doctor-modal-footer {
        background: #F8FAF9;
        border-top: 1px solid var(--doctor-border);
        padding: 12px 18px;
    }

    .modal-cancel {
        border: 1px solid var(--doctor-border);
        background: #fff;
        color: #68756E;
        border-radius: 8px;
        font-size: 11px;
        font-weight: 700;
    }

    .modal-save {
        background: var(--doctor-green);
        color: #fff;
        border: 0;
        border-radius: 8px;
        font-size: 11px;
        font-weight: 700;
    }

    .modal-save:hover {
        background: var(--doctor-green-dark);
        color: #fff;
    }

    .modal-save.danger {
        background: var(--doctor-red);
    }

    /* =========================================================
       HISTORY
    ========================================================= */

    .history-item {
        border-left: 2px solid var(--doctor-green);
        padding-left: 12px;
        padding-bottom: 12px;
        margin-bottom: 10px;
    }

    .history-date {
        color: var(--doctor-text);
        font-size: 11px;
        font-weight: 700;
    }

    .history-diagnosis {
        color: var(--doctor-blue);
        font-size: 11px;
        font-weight: 700;
    }

    .history-note {
        color: var(--doctor-muted);
        font-size: 11px;
    }

    /* =========================================================
       RESPONSIVE
    ========================================================= */

    @media (max-width: 991.98px) {
        .doctor-header-content {
            align-items: flex-start;
            flex-direction: column;
        }

        .doctor-header-badge {
            align-self: flex-start;
        }

        .doctor-panel-header {
            align-items: flex-start;
            flex-direction: column;
        }

        .doctor-search {
            max-width: none;
        }
    }

    @media (max-width: 767.98px) {
        .doctor-page {
            padding-top: 8px;
        }

        .doctor-header {
            padding: 16px;
        }

        .doctor-header h2 {
            font-size: 17px;
        }

        .doc-top-bar {
            padding: 15px;
        }

        .doctor-stat-card {
            margin-bottom: 12px;
        }

        .doctor-panel-header {
            padding: 13px;
        }

        .doctor-table thead th,
        .doctor-table tbody td {
            padding: 10px 9px;
        }
    }

    @media (max-width: 575.98px) {
        .doctor-header-info {
            align-items: flex-start;
        }

        .doctor-header-icon {
            width: 44px;
            height: 44px;
            min-width: 44px;
            font-size: 18px;
        }

        .doctor-header h2 {
            font-size: 15px;
        }

        .doctor-header p {
            font-size: 10px;
        }

        .doc-top-bar {
            border-radius: 12px;
        }

        .doctor-duty-badge {
            margin-top: 10px;
        }

        .doctor-table {
            min-width: 850px;
        }

        .doctor-search {
            width: 100%;
        }
    }
</style>


<div class="container-fluid doctor-page">

    {{-- =========================================================
         ALERTS
    ========================================================= --}}

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show doctor-alert mb-4" role="alert">
            <i class="fas fa-check-circle mr-2"></i>
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show doctor-alert mb-4" role="alert">
            <i class="fas fa-exclamation-triangle mr-2"></i>
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger doctor-alert mb-4">
            <ul class="mb-0 pl-3">
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    {{-- =========================================================
         ROLE 1: DOCTOR
    ========================================================= --}}

    @if($userRole === 'doctor' && !$activeRecord)

        <div class="doctor-header mb-4">
            <div class="doctor-header-content">
                <div class="doctor-header-info">
                    <div class="doctor-header-icon">
                        <i class="fas fa-user-md"></i>
                    </div>

                    <div>
                        <h2>វេជ្ជបណ្ឌិត</h2>
                        <p>
                            <i class="fas fa-stethoscope mr-1"></i>
                            Doctor Consultation Workspace
                        </p>
                    </div>
                </div>

                <div class="doctor-header-badge">
                    <i class="fas fa-circle mr-1"></i>
                    Waiting for Patient
                </div>
            </div>
        </div>

        <div class="doctor-empty-workspace">
            <div class="doctor-empty-icon">
                <i class="fas fa-user-check"></i>
            </div>

            <h5>គ្មានអ្នកជំងឺរង់ចាំទេ</h5>

            <p>
                Currently there are no patients waiting for consultation.
            </p>
        </div>


    @elseif($userRole === 'doctor')

        {{-- =====================================================
             DOCTOR TOP PROFILE
        ===================================================== --}}

        <div class="doc-top-bar d-flex flex-wrap justify-content-between align-items-center mb-4">

            <div class="d-flex align-items-center">

                <div class="doc-avatar-icon">
                    <i class="fas fa-user-md"></i>
                </div>

                <div>
                    <h5 class="font-weight-bold mb-0">
                        {{ $doctorInfo['name'] }}
                    </h5>

                    <small class="text-white-50">
                        <i class="fas fa-hospital-alt mr-1"></i>
                        {{ $doctorInfo['department'] }}
                        <span class="mx-1">•</span>
                        ID: {{ $doctorInfo['code'] }}
                    </small>
                </div>

            </div>

            <div class="d-flex align-items-center mt-2 mt-md-0">

                <span class="doctor-duty-badge mr-3">
                    <i class="fas fa-circle text-success mr-1"></i>
                    On Duty (សកម្ម)
                </span>

                <span class="text-white-50 small">
                    <i class="far fa-calendar-alt mr-1"></i>
                    {{ date('d M Y') }}
                </span>

            </div>
        </div>


        <div class="row">

            {{-- =================================================
                 LEFT COLUMN
            ================================================= --}}

            <div class="col-lg-4 mb-4">

                {{-- PATIENT --}}
                <div class="card-modern p-4 mb-4">

                    <div class="d-flex align-items-center mb-3">

                        <img
                            src="https://ui-avatars.com/api/?name={{ urlencode($activeRecord->patient->full_name ?? 'Patient') }}&background=006D36&color=fff&bold=true"
                            class="avatar-circle mr-3"
                            alt="Patient Avatar"
                        >

                        <div>
                            <h5 class="font-weight-bold text-dark mb-1">
                                {{ $activeRecord->patient->full_name ?? 'លោក ពាក់ មី' }}
                            </h5>

                            <span class="patient-code">
                                {{ $activeRecord->patient->patient_code ?? 'ID-2001-0023' }}
                            </span>
                        </div>

                    </div>

                    <hr class="my-3">

                    <div class="row">

                        <div class="col-6 mb-3">
                            <span class="patient-info-label">
                                អាយុ / Age
                            </span>

                            <span class="patient-info-value">
                                18 ឆ្នាំ (Years)
                            </span>
                        </div>

                        <div class="col-6 mb-3">
                            <span class="patient-info-label">
                                ភេទ / Gender
                            </span>

                            <span class="patient-info-value">
                                {{ ($activeRecord->patient->sex ?? '') == 'Female'
                                    ? 'ស្រី (Female)'
                                    : 'ប្រុស (Male)' }}
                            </span>
                        </div>

                        <div class="col-6 mb-2">
                            <span class="patient-info-label">
                                ទូរស័ព្ទ / Phone
                            </span>

                            <span class="patient-info-value">
                                {{ $activeRecord->patient->phone ?? '012 345 678' }}
                            </span>
                        </div>

                        <div class="col-6 mb-2">
                            <span class="patient-info-label">
                                កាលបរិច្ឆេទ / Date
                            </span>

                            <span class="patient-info-value">
                                {{ $activeRecord->visit_date
                                    ? $activeRecord->visit_date->format('d/m/Y H:i')
                                    : date('d/m/Y H:i') }}
                            </span>
                        </div>

                    </div>

                </div>


                {{-- VITALS --}}
                <div class="card-modern p-4 mb-4">

                    <div class="d-flex justify-content-between align-items-center mb-3">

                        <div class="section-title mb-0">
                            <div class="section-title-icon">
                                <i class="fas fa-heartbeat"></i>
                            </div>

                            សញ្ញាជីវិត (Vital Signs)
                        </div>

                        <button
                            type="button"
                            class="btn btn-xs btn-outline-danger font-weight-bold px-2 py-1"
                            data-toggle="modal"
                            data-target="#vitalsModal"
                            style="border-radius: 7px;"
                        >
                            <i class="fas fa-edit mr-1"></i>
                            កែប្រែ
                        </button>

                    </div>


                    <div class="row">

                        <div class="col-6 mb-3">
                            <div class="vitals-box">

                                <span class="vitals-label">
                                    សម្ពាធឈាម (BP)
                                </span>

                                <div class="vitals-val text-primary">
                                    {{ $activeRecord->blood_pressure ?? '120/80' }}
                                    <small class="text-muted">mmHg</small>
                                </div>

                            </div>
                        </div>


                        <div class="col-6 mb-3">
                            <div class="vitals-box">

                                <span class="vitals-label">
                                    ចង្វាក់បេះដូង (HR)
                                </span>

                                <div class="vitals-val text-success">
                                    {{ $activeRecord->heart_rate ?? '75' }}
                                    <small class="text-muted">bpm</small>
                                </div>

                            </div>
                        </div>


                        <div class="col-6 mb-3">
                            <div class="vitals-box">

                                <span class="vitals-label">
                                    កំដៅ (Temp)
                                </span>

                                <div class="vitals-val text-danger">
                                    {{ $activeRecord->temperature ?? '38.6' }}
                                    <small class="text-muted">°C</small>
                                </div>

                            </div>
                        </div>


                        <div class="col-6 mb-3">
                            <div class="vitals-box">

                                <span class="vitals-label">
                                    អុកស៊ីសែន (SPO2)
                                </span>

                                <div class="vitals-val text-info">
                                    {{ $activeRecord->spo2 ?? $activeRecord->oxygen_saturation ?? '98' }}
                                    <small class="text-muted">%</small>
                                </div>

                            </div>
                        </div>

                    </div>

                </div>


                {{-- CHIEF COMPLAINT --}}
                <div class="card-modern p-4">

                    <div class="section-title">
                        <div class="section-title-icon">
                            <i class="fas fa-notes-medical"></i>
                        </div>

                        មូលហេតុមកពិនិត្យ
                    </div>

                    <div class="bg-light p-3 rounded-lg border">
                        <p class="text-secondary small mb-0">
                            {{ $activeRecord->chief_complaint ?? 'មិនមាន' }}
                        </p>
                    </div>

                </div>

            </div>


            {{-- =================================================
                 RIGHT COLUMN
            ================================================= --}}

            <div class="col-lg-8 mb-4">

                <form action="{{ route('doctor.update', $activeRecord->record_id) }}" method="POST">

                    @csrf
                    @method('PUT')

                    <div class="card-modern p-4 mb-4">

                        {{-- TABS --}}
                        <ul
                            class="nav nav-tabs nav-tabs-custom mb-3"
                            id="consultTab"
                            role="tablist"
                        >

                            <li class="nav-item">
                                <a
                                    class="nav-link active"
                                    id="note-tab"
                                    data-toggle="tab"
                                    href="#note"
                                    role="tab"
                                >
                                    <i class="fas fa-edit mr-1"></i>
                                    កត់ត្រាការព្យាបាល
                                </a>
                            </li>

                            <li class="nav-item">
                                <a
                                    class="nav-link"
                                    id="history-tab"
                                    data-toggle="tab"
                                    href="#history"
                                    role="tab"
                                >
                                    <i class="fas fa-history mr-1"></i>
                                    ប្រវត្តិព្យាបាលចាស់
                                </a>
                            </li>

                        </ul>


                        <div class="tab-content" id="consultTabContent">

                            {{-- CURRENT NOTE --}}
                            <div
                                class="tab-pane fade show active"
                                id="note"
                                role="tabpanel"
                            >

                                <div class="form-group mb-0">

                                    <label class="font-weight-bold text-dark">
                                        ចំណាំការព្យាបាលរបស់គ្រូពេទ្យ
                                        (Clinical Examination & Notes)
                                    </label>

                                    <textarea
                                        name="notes"
                                        class="form-control p-3"
                                        rows="4"
                                        placeholder="បញ្ចូលចំណាំពិនិត្យ និងការព្យាបាលរបស់អ្នកជំងឺ..."
                                    >{{ old('notes', $activeRecord->notes) }}</textarea>

                                </div>

                            </div>


                            {{-- HISTORY --}}
                            <div
                                class="tab-pane fade"
                                id="history"
                                role="tabpanel"
                            >

                                <div
                                    class="p-2"
                                    style="max-height: 240px; overflow-y: auto;"
                                >

                                    @forelse($historyRecords as $hist)

                                        <div class="history-item">

                                            <div class="d-flex justify-content-between">

                                                <strong class="history-date">
                                                    <i class="far fa-calendar-alt mr-1"></i>
                                                    {{ $hist->visit_date
                                                        ? $hist->visit_date->format('d-m-Y H:i')
                                                        : 'N/A' }}
                                                </strong>

                                                <span class="badge badge-light border">
                                                    {{ $hist->status_destination ?? 'done' }}
                                                </span>

                                            </div>

                                            <p class="history-diagnosis mb-1">
                                                រោគវិនិច្ឆ័យ:
                                                {{ $hist->diagnosis ?? 'N/A' }}
                                            </p>

                                            <p class="history-note mb-0">
                                                {{ $hist->notes }}
                                            </p>

                                        </div>

                                    @empty

                                        <p class="text-muted text-center py-4 small mb-0">
                                            គ្មានប្រវត្តិព្យាបាលចាស់នៅក្នុងប្រព័ន្ធទេ។
                                        </p>

                                    @endforelse

                                </div>

                            </div>

                        </div>


                        <hr class="my-4">


                        {{-- DIAGNOSIS --}}
                        <div class="form-group mb-4">

                            <label class="font-weight-bold text-dark">
                                រោគវិនិច្ឆ័យ (Diagnosis)
                                <span class="text-danger">*</span>
                            </label>

                            <div
                                class="d-flex flex-wrap mb-2"
                                style="gap: 7px;"
                            >

                                <span
                                    class="diag-tag"
                                    onclick="addDiagTag('Acute Pharyngitis')"
                                >
                                    + Acute Pharyngitis
                                </span>

                                <span
                                    class="diag-tag"
                                    onclick="addDiagTag('Hypertension')"
                                >
                                    + Hypertension
                                </span>

                                <span
                                    class="diag-tag"
                                    onclick="addDiagTag('Common Cold')"
                                >
                                    + Common Cold
                                </span>

                                <span
                                    class="diag-tag"
                                    onclick="addDiagTag('Dengue Fever')"
                                >
                                    + Dengue Fever
                                </span>

                                <span
                                    class="diag-tag"
                                    onclick="addDiagTag('Acute Gastritis')"
                                >
                                    + Acute Gastritis
                                </span>

                            </div>

                            <input
                                type="text"
                                id="diagnosisInput"
                                name="diagnosis"
                                class="form-control p-3 font-weight-bold"
                                value="{{ old('diagnosis', $activeRecord->diagnosis) }}"
                                placeholder="បញ្ចូលរោគវិនិច្ឆ័យ ឬជ្រើសរើស Tag ខាងលើ..."
                                required
                            >

                        </div>


                        {{-- PRESCRIPTION DATA --}}
                        @php

                            $rxRows = old('items');

                            if ($rxRows === null) {

                                $rxRows = [];

                                if ($activeRecord->prescription) {

                                    foreach ($activeRecord->prescription->items as $it) {

                                        $rxRows[] = [
                                            'medicine_id' => $it->medicine_id,
                                            'medicine_label' => trim(
                                                ($it->medicine->medicine_name ?? '') .
                                                ' ' .
                                                ($it->medicine->strength ?? '')
                                            ),
                                            'quantity' => $it->quantity,
                                            'dosage' => $it->dosage,
                                            'frequency' => $it->frequency,
                                            'duration_days' => $it->duration_days,
                                        ];

                                    }

                                }

                            }

                        @endphp


                        {{-- PRESCRIPTION --}}
                        <div
                            class="form-group mb-4"
                            id="rxApp"
                            data-search-url="{{ route('doctor.medicines.search') }}"
                            data-rows="{{ json_encode($rxRows) }}"
                        >

                            <label class="font-weight-bold text-dark mb-2">
                                <i class="fas fa-pills text-success mr-1"></i>
                                វេជ្ជបញ្ជាថ្នាំ (Prescription)
                            </label>


                            <div class="table-responsive">

                                <table
                                    class="table table-sm mb-1"
                                    id="rxTable"
                                    style="min-width: 760px;"
                                >

                                    <thead>
                                        <tr>
                                            <th>ឈ្មោះថ្នាំ</th>
                                            <th style="width:90px">ចំនួន</th>
                                            <th style="width:200px">កម្រិតប្រើ</th>
                                            <th style="width:190px">ចំនួនដង/ថ្ងៃ</th>
                                            <th style="width:90px">រយៈពេល (ថ្ងៃ)</th>
                                            <th style="width:40px"></th>
                                        </tr>
                                    </thead>

                                    <tbody id="rxBody"></tbody>

                                </table>

                            </div>


                            <p
                                id="rxEmpty"
                                class="text-muted small text-center py-3 mb-2"
                            >
                                មិនទាន់មានថ្នាំក្នុងវេជ្ជបញ្ជា
                            </p>


                            <button
                                type="button"
                                class="btn btn-sm btn-outline-success font-weight-bold"
                                id="btnAddRx"
                                style="border-radius: 8px;"
                            >
                                <i class="fas fa-plus mr-1"></i>
                                បន្ថែមថ្នាំ
                            </button>


                            <datalist id="rxFreqList">

                                <option value="1 ដង/ថ្ងៃ (ព្រឹក)">
                                <option value="2 ដង/ថ្ងៃ (ព្រឹក, ល្ងាច)">
                                <option value="3 ដង/ថ្ងៃ (ព្រឹក, ថ្ងៃត្រង់, ល្ងាច)">
                                <option value="4 ដង/ថ្ងៃ">
                                <option value="ពេលចាំបាច់">

                            </datalist>

                        </div>


                        {{-- PHARMACIST NOTE --}}
                        <div class="form-group mb-4">

                            <label class="font-weight-bold text-dark">
                                ចំណាំបន្ថែមសម្រាប់ឱសថការី
                            </label>

                            <textarea
                                name="prescription_notes"
                                class="form-control p-3"
                                rows="2"
                                placeholder="ការណែនាំបន្ថែម..."
                            >{{ old('prescription_notes', $activeRecord->prescription_notes) }}</textarea>

                        </div>


                        {{-- ACTIONS --}}
                        <div
                            class="d-flex flex-wrap justify-content-between align-items-center mt-4 pt-2"
                            style="gap: 12px;"
                        >

                            <div class="d-flex flex-wrap" style="gap: 8px;">

                                <button
                                    type="button"
                                    class="btn btn-action-lab"
                                    data-toggle="modal"
                                    data-target="#labModal"
                                >
                                    <i class="fas fa-vials mr-1"></i>
                                    បញ្ចូនទៅមន្ទីរពិសោធន៏
                                </button>


                                <button
                                    type="button"
                                    class="btn btn-action-admit"
                                    data-toggle="modal"
                                    data-target="#admitModal"
                                >
                                    <i class="fas fa-bed mr-1"></i>
                                    បញ្ជូនទៅបន្ទប់សម្រាក
                                </button>

                            </div>


                            <button
                                type="submit"
                                name="status_destination"
                                value="pharmacy"
                                class="btn btn-action-confirm"
                            >
                                <i class="fas fa-check-circle mr-1"></i>
                                បញ្ជាក់
                            </button>

                        </div>

                    </div>

                </form>

            </div>

        </div>


        {{-- =====================================================
             LAB MODAL
        ===================================================== --}}

        <div
            class="modal fade doctor-modal"
            id="labModal"
            tabindex="-1"
            role="dialog"
        >

            <div
                class="modal-dialog modal-dialog-centered"
                role="document"
            >

                <div class="modal-content">

                    <form
                        action="{{ route('doctor.lab-order.store') }}"
                        method="POST"
                    >

                        @csrf

                        <input
                            type="hidden"
                            name="record_id"
                            value="{{ $activeRecord->record_id }}"
                        >


                        <div class="doctor-modal-header modal-header">

                            <h5 class="modal-title">
                                <i class="fas fa-flask mr-2"></i>
                                បញ្ជូនទៅពិនិត្យមន្ទីរពិសោធន៍
                            </h5>

                            <button
                                type="button"
                                class="close text-white"
                                data-dismiss="modal"
                            >
                                <span>&times;</span>
                            </button>

                        </div>


                        <div class="doctor-modal-body modal-body">

                            <p class="text-muted small mb-3">
                                សូមជ្រើសរើសតេស្តមន្ទីរពិសោធន៍ដែលត្រូវពិនិត្យសម្រាប់អ្នកជំងឺ
                                <strong>
                                    {{ $activeRecord->patient->full_name ?? '' }}
                                </strong>
                            </p>


                            <div
                                class="list-group"
                                style="max-height: 260px; overflow-y: auto;"
                            >

                                @forelse($labTests as $test)

                                    <label class="list-group-item d-flex justify-content-between align-items-center">

                                        <div>
                                            <input
                                                type="checkbox"
                                                name="test_ids[]"
                                                value="{{ $test->test_id }}"
                                                class="mr-2"
                                            >

                                            <strong>
                                                {{ $test->test_name }}
                                            </strong>
                                        </div>

                                        <span class="badge badge-light border">
                                            ${{ number_format($test->price, 2) }}
                                        </span>

                                    </label>

                                @empty

                                    <label class="list-group-item">
                                        <input
                                            type="checkbox"
                                            name="test_ids[]"
                                            value="1"
                                            class="mr-2"
                                        >
                                        CBC (Complete Blood Count)
                                    </label>

                                    <label class="list-group-item">
                                        <input
                                            type="checkbox"
                                            name="test_ids[]"
                                            value="2"
                                            class="mr-2"
                                        >
                                        Blood Sugar Test (Fasting)
                                    </label>

                                    <label class="list-group-item">
                                        <input
                                            type="checkbox"
                                            name="test_ids[]"
                                            value="3"
                                            class="mr-2"
                                        >
                                        Urine Routine & Microscopy
                                    </label>

                                    <label class="list-group-item">
                                        <input
                                            type="checkbox"
                                            name="test_ids[]"
                                            value="4"
                                            class="mr-2"
                                        >
                                        COVID-19 Rapid Antigen Test
                                    </label>

                                @endforelse

                            </div>

                        </div>


                        <div class="doctor-modal-footer modal-footer">

                            <button
                                type="button"
                                class="btn modal-cancel"
                                data-dismiss="modal"
                            >
                                បោះបង់
                            </button>

                            <button
                                type="submit"
                                class="btn modal-save"
                            >
                                <i class="fas fa-paper-plane mr-1"></i>
                                បញ្ជូនទៅ Lab
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>


        {{-- =====================================================
             ADMIT MODAL
        ===================================================== --}}

        <div
            class="modal fade doctor-modal"
            id="admitModal"
            tabindex="-1"
            role="dialog"
        >

            <div
                class="modal-dialog modal-dialog-centered"
                role="document"
            >

                <div class="modal-content">

                    <form
                        action="{{ route('doctor.admit.store') }}"
                        method="POST"
                    >

                        @csrf

                        <input
                            type="hidden"
                            name="patient_id"
                            value="{{ $activeRecord->patient_id }}"
                        >


                        <div class="doctor-modal-header modal-header">

                            <h5 class="modal-title">
                                <i class="fas fa-procedures mr-2"></i>
                                បញ្ចូលការសម្រាកព្យាបាល
                            </h5>

                            <button
                                type="button"
                                class="close text-white"
                                data-dismiss="modal"
                            >
                                <span>&times;</span>
                            </button>

                        </div>


                        <div class="doctor-modal-body modal-body">

                            <div class="form-group mb-3">

                                <label class="font-weight-bold text-dark">
                                    អ្នកជំងឺ (Patient):
                                </label>

                                <input
                                    type="text"
                                    class="form-control bg-light"
                                    value="{{ $activeRecord->patient->full_name ?? '' }} ({{ $activeRecord->patient->patient_code ?? '' }})"
                                    readonly
                                >

                            </div>


                            <div class="form-group mb-3">

                                <label class="font-weight-bold text-dark">
                                    ជ្រើសរើសបន្ទប់ទំនេរ
                                    (Available Room)
                                    <span class="text-danger">*</span>
                                </label>

                                <select
                                    name="room_id"
                                    class="form-control font-weight-bold"
                                    required
                                >

                                    <option value="">
                                        -- ជ្រើសរើសបន្ទប់ --
                                    </option>

                                    @foreach($availableRooms as $rm)

                                        <option value="{{ $rm->room_id }}">
                                            បន្ទប់ {{ $rm->room_number }}
                                            (ប្រភេទ: {{ $rm->room_type }}
                                            - ${{ number_format($rm->price_per_day, 2) }}/ថ្ងៃ)
                                        </option>

                                    @endforeach

                                </select>

                                @if($availableRooms->isEmpty())

                                    <small class="text-danger">
                                        មិនមានបន្ទប់ទំនេរទេ
                                    </small>

                                @endif

                            </div>

                        </div>


                        <div class="doctor-modal-footer modal-footer">

                            <button
                                type="button"
                                class="btn modal-cancel"
                                data-dismiss="modal"
                            >
                                បោះបង់
                            </button>

                            <button
                                type="submit"
                                class="btn modal-save"
                            >
                                <i class="fas fa-check-circle mr-1"></i>
                                បញ្ចូលសម្រាក
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>


        {{-- =====================================================
             VITALS MODAL
        ===================================================== --}}

        <div
            class="modal fade doctor-modal"
            id="vitalsModal"
            tabindex="-1"
            role="dialog"
        >

            <div
                class="modal-dialog modal-dialog-centered"
                role="document"
            >

                <div class="modal-content">

                    <form
                        action="{{ route('doctor.vitals.update') }}"
                        method="POST"
                    >

                        @csrf

                        <input
                            type="hidden"
                            name="record_id"
                            value="{{ $activeRecord->record_id }}"
                        >


                        <div class="doctor-modal-header danger modal-header">

                            <h5 class="modal-title">
                                <i class="fas fa-heartbeat mr-2"></i>
                                ធ្វើបច្ចុប្បន្នភាពសញ្ញាជីវិត
                            </h5>

                            <button
                                type="button"
                                class="close text-white"
                                data-dismiss="modal"
                            >
                                <span>&times;</span>
                            </button>

                        </div>


                        <div class="doctor-modal-body modal-body">

                            <div class="row">

                                <div class="col-6 form-group">

                                    <label class="font-weight-bold text-dark small">
                                        សម្ពាធឈាម (BP):
                                    </label>

                                    <input
                                        type="text"
                                        name="blood_pressure"
                                        class="form-control"
                                        value="{{ $activeRecord->blood_pressure ?? '120/80' }}"
                                        placeholder="120/80"
                                    >

                                </div>


                                <div class="col-6 form-group">

                                    <label class="font-weight-bold text-dark small">
                                        ចង្វាក់បេះដូង (bpm):
                                    </label>

                                    <input
                                        type="number"
                                        name="heart_rate"
                                        class="form-control"
                                        value="{{ $activeRecord->heart_rate ?? '75' }}"
                                    >

                                </div>


                                <div class="col-6 form-group">

                                    <label class="font-weight-bold text-dark small">
                                        កំដៅ (°C):
                                    </label>

                                    <input
                                        type="number"
                                        step="0.1"
                                        name="temperature"
                                        class="form-control"
                                        value="{{ $activeRecord->temperature ?? '38.6' }}"
                                    >

                                </div>


                                <div class="col-6 form-group">

                                    <label class="font-weight-bold text-dark small">
                                        អុកស៊ីសែន (%):
                                    </label>

                                    <input
                                        type="number"
                                        name="spo2"
                                        class="form-control"
                                        value="{{ $activeRecord->spo2 ?? $activeRecord->oxygen_saturation ?? '98' }}"
                                    >

                                </div>

                            </div>

                        </div>


                        <div class="doctor-modal-footer modal-footer">

                            <button
                                type="button"
                                class="btn modal-cancel"
                                data-dismiss="modal"
                            >
                                បោះបង់
                            </button>

                            <button
                                type="submit"
                                class="btn modal-save danger"
                            >
                                <i class="fas fa-save mr-1"></i>
                                រក្សាទុក Vitals
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>


    {{-- =========================================================
         ROLE 2: ADMIN
    ========================================================= --}}

    @elseif($userRole === 'admin')

        {{-- ADMIN HEADER --}}
        <div class="directory-header mb-4">

            <div class="d-flex align-items-center">

                <div class="directory-header-icon">
                    <i class="fas fa-user-md"></i>
                </div>

                <div>
                    <h3 class="font-weight-bold">
                        គ្រប់គ្រង និងត្រួតពិនិត្យវេជ្ជបណ្ឌិត
                    </h3>

                    <small>
                        Doctor Directory & Consultation Audit
                        <span class="mx-1">•</span>
                        បញ្ជីវេជ្ជបណ្ឌិត និងការពិនិត្យតាមដានបន្ទុកការងារ
                    </small>
                </div>

            </div>

        </div>


        {{-- STAT CARDS --}}
        <div class="row mb-4">

            <div class="col-lg-4 col-md-6 mb-3">

                <div class="doctor-stat-card">

                    <div class="doctor-stat-icon green">
                        <i class="fas fa-user-md"></i>
                    </div>

                    <div>

                        <div class="doctor-stat-label">
                            វេជ្ជបណ្ឌិតសរុប
                        </div>

                        <div class="doctor-stat-value">
                            {{ $totalDoctors ?? 0 }}
                        </div>

                    </div>

                </div>

            </div>


            <div class="col-lg-4 col-md-6 mb-3">

                <div class="doctor-stat-card">

                    <div class="doctor-stat-icon green">
                        <i class="fas fa-check-circle"></i>
                    </div>

                    <div>

                        <div class="doctor-stat-label">
                            វេជ្ជបណ្ឌិតកំពុងសកម្ម
                        </div>

                        <div class="doctor-stat-value text-success">
                            {{ $activeDoctors ?? 0 }}
                        </div>

                    </div>

                </div>

            </div>


            <div class="col-lg-4 col-md-6 mb-3">

                <div class="doctor-stat-card">

                    <div class="doctor-stat-icon info">
                        <i class="fas fa-stethoscope"></i>
                    </div>

                    <div>

                        <div class="doctor-stat-label">
                            ការពិនិត្យសរុបថ្ងៃនេះ
                        </div>

                        <div class="doctor-stat-value text-info">
                            {{ $todayConsultations ?? 0 }}
                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- DOCTOR DIRECTORY --}}
        <div class="doctor-panel">

            <div class="doctor-panel-header">

                <div class="doctor-panel-title">

                    <div class="doctor-panel-title-icon">
                        <i class="fas fa-list"></i>
                    </div>

                    <div>

                        <h6>
                            បញ្ជីឈ្មោះវេជ្ជបណ្ឌិតក្នុងប្រព័ន្ធ
                        </h6>

                        <span>
                            Doctor Directory
                        </span>

                    </div>

                </div>


                <form
                    method="GET"
                    action="{{ route('doctor.index') }}"
                    class="doctor-search"
                >

                    <div class="input-group">

                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            class="form-control"
                            placeholder="ស្វែងរកឈ្មោះ ឬកូដ..."
                        >

                        <div class="input-group-append">

                            <button
                                type="submit"
                                class="btn btn-success"
                            >
                                <i class="fas fa-search"></i>
                            </button>

                        </div>

                    </div>

                </form>

            </div>


            <div class="doctor-panel-body">

                <div class="table-responsive">

                    <table class="table doctor-table align-middle mb-0">

                        <thead>

                            <tr>
                                <th>លេខ ID</th>
                                <th>ឈ្មោះវេជ្ជបណ្ឌិត</th>
                                <th>ដេប៉ាតឺម៉ង់</th>
                                <th>ជំនាញ</th>
                                <th>លេខទូរស័ព្ទ</th>
                                <th>ស្ថានភាព</th>
                                <th class="text-center">សកម្មភាព</th>
                            </tr>

                        </thead>


                        <tbody>

                            @forelse($doctors as $doc)

                                <tr>

                                    <td>
                                        <span class="doctor-id">
                                            #{{ $doc->id }}
                                        </span>
                                    </td>


                                    <td>

                                        <div class="doctor-name-wrapper">

                                            <div class="doctor-row-icon">
                                                <i class="fas fa-user-md"></i>
                                            </div>

                                            <div class="doctor-name">
                                                {{ $doc->name ?? 'N/A' }}
                                            </div>

                                        </div>

                                    </td>


                                    <td>

                                        <span class="doctor-department">
                                            {{ $doc->department->department_name ?? 'General Clinic' }}
                                        </span>

                                    </td>


                                    <td>

                                        <span class="specialization-badge">
                                            {{ $doc->specialization ?? 'General Physician' }}
                                        </span>

                                    </td>


                                    <td>
                                        {{ $doc->phone ?? '-' }}
                                    </td>


                                    <td>

                                        <span class="active-badge">
                                            <i class="fas fa-circle"></i>
                                            Active
                                        </span>

                                    </td>


                                    <td class="text-center">

                                        <button
                                            class="audit-btn"
                                            disabled
                                        >
                                            <i class="fas fa-lock mr-1"></i>
                                            Read-only Audit
                                        </button>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td
                                        colspan="7"
                                        class="text-center text-muted py-5"
                                    >

                                        <div class="doctor-empty-icon mx-auto mb-2">
                                            <i class="fas fa-user-md"></i>
                                        </div>

                                        មិនមានទិន្នន័យវេជ្ជបណ្ឌិតទេ។

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>


                <div class="px-4 py-3 border-top">
                    {!! $doctors->links('pagination::bootstrap-4') !!}
                </div>

            </div>

        </div>


    {{-- =========================================================
         ROLE 3: NURSE
    ========================================================= --}}

    @elseif($userRole === 'nurse')

        {{-- NURSE HEADER --}}
        <div class="doc-top-bar d-flex flex-wrap justify-content-between align-items-center mb-4">

            <div>

                <h5 class="font-weight-bold mb-1">
                    <i class="fas fa-user-nurse mr-2"></i>
                    {{ $nurseShift['name'] ?? 'Nurse Workspace' }}
                </h5>

                <small class="text-white-50">
                    <i class="fas fa-clock mr-1"></i>
                    {{ $nurseShift['shift'] }}
                    <span class="mx-1">•</span>
                    {{ $nurseShift['department'] }}
                </small>

            </div>


            <span class="doctor-duty-badge mt-2 mt-md-0">
                <i class="fas fa-user-md mr-1"></i>
                Doctor Assigned:
                {{ $nurseShift['assigned_doctor'] }}
            </span>

        </div>


        {{-- NURSE QUEUE --}}
        <div class="doctor-panel">

            <div class="doctor-panel-header">

                <div class="doctor-panel-title">

                    <div class="doctor-panel-title-icon">
                        <i class="fas fa-heartbeat"></i>
                    </div>

                    <div>

                        <h6>
                            បញ្ជីអ្នកជំងឺត្រៀមវាស់សញ្ញាជីវិត
                        </h6>

                        <span>
                            Nurse Triage Queue
                        </span>

                    </div>

                </div>


                <span class="pending-badge">
                    <i class="fas fa-clock mr-1"></i>
                    {{ $pendingVitalsCount ?? 0 }}
                    Pending Vitals
                </span>

            </div>


            <div class="doctor-panel-body">

                <div class="table-responsive">

                    <table class="table doctor-table align-middle mb-0">

                        <thead>

                            <tr>
                                <th>កូដ</th>
                                <th>ឈ្មោះអ្នកជំងឺ</th>
                                <th>សម្ពាធឈាម</th>
                                <th>ចង្វាក់បេះដូង</th>
                                <th>កំដៅ</th>
                                <th>SPO2</th>
                                <th class="text-center">សកម្មភាព</th>
                            </tr>

                        </thead>


                        <tbody>

                            @forelse($triageQueue as $rec)

                                <tr>

                                    <td>

                                        <span class="doctor-id">
                                            {{ $rec->patient->patient_code ?? 'N/A' }}
                                        </span>

                                    </td>


                                    <td>

                                        <div class="doctor-name-wrapper">

                                            <div class="doctor-row-icon">
                                                <i class="fas fa-user"></i>
                                            </div>

                                            <div class="doctor-name">
                                                {{ $rec->patient->full_name ?? 'N/A' }}
                                            </div>

                                        </div>

                                    </td>


                                    <td>
                                        {{ $rec->blood_pressure ?? 'N/A' }}
                                    </td>


                                    <td>
                                        {{ $rec->heart_rate
                                            ? $rec->heart_rate . ' bpm'
                                            : 'N/A' }}
                                    </td>


                                    <td>
                                        {{ $rec->temperature
                                            ? $rec->temperature . ' °C'
                                            : 'N/A' }}
                                    </td>


                                    <td>
                                        {{ $rec->spo2
                                            ? $rec->spo2 . ' %'
                                            : 'N/A' }}
                                    </td>


                                    <td class="text-center">

                                        <button
                                            type="button"
                                            class="btn vitals-action-btn"
                                            data-toggle="modal"
                                            data-target="#nurseVitalsModal{{ $rec->record_id }}"
                                        >
                                            <i class="fas fa-edit mr-1"></i>
                                            បញ្ចូល Vitals
                                        </button>

                                    </td>

                                </tr>


                                {{-- NURSE VITALS MODAL --}}
                                <div
                                    class="modal fade doctor-modal"
                                    id="nurseVitalsModal{{ $rec->record_id }}"
                                    tabindex="-1"
                                >

                                    <div class="modal-dialog modal-dialog-centered">

                                        <div class="modal-content">

                                            <form
                                                action="{{ route('doctor.vitals.update') }}"
                                                method="POST"
                                            >

                                                @csrf

                                                <input
                                                    type="hidden"
                                                    name="record_id"
                                                    value="{{ $rec->record_id }}"
                                                >


                                                <div class="doctor-modal-header danger modal-header">

                                                    <h5 class="modal-title">

                                                        <i class="fas fa-heartbeat mr-2"></i>

                                                        បញ្ចូលសញ្ញាជីវិតសម្រាប់:
                                                        {{ $rec->patient->full_name ?? '' }}

                                                    </h5>

                                                    <button
                                                        type="button"
                                                        class="close text-white"
                                                        data-dismiss="modal"
                                                    >
                                                        <span>&times;</span>
                                                    </button>

                                                </div>


                                                <div class="doctor-modal-body modal-body">

                                                    <div class="row">

                                                        <div class="col-6 form-group">

                                                            <label class="small font-weight-bold">
                                                                សម្ពាធឈាម (BP):
                                                            </label>

                                                            <input
                                                                type="text"
                                                                name="blood_pressure"
                                                                class="form-control"
                                                                value="{{ $rec->blood_pressure }}"
                                                                placeholder="120/80"
                                                            >

                                                        </div>


                                                        <div class="col-6 form-group">

                                                            <label class="small font-weight-bold">
                                                                ចង្វាក់បេះដូង (bpm):
                                                            </label>

                                                            <input
                                                                type="number"
                                                                name="heart_rate"
                                                                class="form-control"
                                                                value="{{ $rec->heart_rate }}"
                                                            >

                                                        </div>


                                                        <div class="col-6 form-group">

                                                            <label class="small font-weight-bold">
                                                                កំដៅ (°C):
                                                            </label>

                                                            <input
                                                                type="number"
                                                                step="0.1"
                                                                name="temperature"
                                                                class="form-control"
                                                                value="{{ $rec->temperature }}"
                                                            >

                                                        </div>


                                                        <div class="col-6 form-group">

                                                            <label class="small font-weight-bold">
                                                                អុកស៊ីសែន (%):
                                                            </label>

                                                            <input
                                                                type="number"
                                                                name="spo2"
                                                                class="form-control"
                                                                value="{{ $rec->spo2 }}"
                                                            >

                                                        </div>

                                                    </div>

                                                </div>


                                                <div class="doctor-modal-footer modal-footer">

                                                    <button
                                                        type="button"
                                                        class="btn modal-cancel"
                                                        data-dismiss="modal"
                                                    >
                                                        បោះបង់
                                                    </button>

                                                    <button
                                                        type="submit"
                                                        class="btn modal-save danger"
                                                    >
                                                        <i class="fas fa-save mr-1"></i>
                                                        រក្សាទុក Vitals
                                                    </button>

                                                </div>

                                            </form>

                                        </div>

                                    </div>

                                </div>

                            @empty

                                <tr>

                                    <td
                                        colspan="7"
                                        class="text-center text-muted py-5"
                                    >

                                        <div class="doctor-empty-icon mx-auto mb-2">
                                            <i class="fas fa-user-check"></i>
                                        </div>

                                        គ្មានអ្នកជំងឺរង់ចាំត្រួតពិនិត្យទេ។

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>


                <div class="px-4 py-3 border-top">
                    {!! $triageQueue->links('pagination::bootstrap-4') !!}
                </div>

            </div>

        </div>

    @endif

</div>


@stop


@section('js')

@parent

<script>

    /* =========================================================
       DIAGNOSIS TAG
    ========================================================= */

    function addDiagTag(text) {

        var input = document.getElementById('diagnosisInput');

        if (!input) {
            return;
        }

        var current = input.value.trim();

        if (current.length > 0) {

            if (!current.includes(text)) {
                input.value = current + ', ' + text;
            }

        } else {

            input.value = text;

        }
    }


    /* =========================================================
       PRESCRIPTION
    ========================================================= */

    (function () {

        const app = document.getElementById('rxApp');

        if (!app) {
            return;
        }


        const body = document.getElementById('rxBody');
        const emptyMsg = document.getElementById('rxEmpty');

        let medicines = [];
        let nextIndex = 0;


        const esc = s =>
            String(s ?? '').replace(
                /[&<>"']/g,
                c => ({
                    '&': '&amp;',
                    '<': '&lt;',
                    '>': '&gt;',
                    '"': '&quot;',
                    "'": '&#39;'
                }[c])
            );


        const medicineLabel = m =>
            `${m.medicine_name} ${m.strength ?? ''} (ស្តុក ${m.stock_total})`
                .replace(/\s+/g, ' ')
                .trim();


        function rowHtml(i, r) {

            r = r || {};

            const chosen = r.medicine_id
                ? `<option value="${esc(r.medicine_id)}" selected>${esc(r.medicine_label || '#' + r.medicine_id)}</option>`
                : '';


            return `
                <tr>

                    <td>
                        <select
                            name="items[${i}][medicine_id]"
                            class="form-control form-control-sm rx-medicine"
                            required
                        >
                            <option value="">
                                -- ជ្រើសរើសថ្នាំ --
                            </option>
                            ${chosen}
                        </select>
                    </td>

                    <td>
                        <input
                            type="number"
                            name="items[${i}][quantity]"
                            class="form-control form-control-sm"
                            min="1"
                            value="${esc(r.quantity)}"
                            required
                        >
                    </td>

                    <td>
                        <input
                            type="text"
                            name="items[${i}][dosage]"
                            class="form-control form-control-sm"
                            maxlength="255"
                            value="${esc(r.dosage)}"
                            placeholder="1 គ្រាប់ ក្រោយអាហារ"
                            required
                        >
                    </td>

                    <td>
                        <input
                            type="text"
                            name="items[${i}][frequency]"
                            list="rxFreqList"
                            class="form-control form-control-sm"
                            maxlength="255"
                            value="${esc(r.frequency)}"
                            placeholder="3 ដង/ថ្ងៃ"
                            required
                        >
                    </td>

                    <td>
                        <input
                            type="number"
                            name="items[${i}][duration_days]"
                            class="form-control form-control-sm"
                            min="1"
                            value="${esc(r.duration_days)}"
                            required
                        >
                    </td>

                    <td>
                        <button
                            type="button"
                            class="btn btn-sm btn-outline-danger rx-remove"
                        >
                            &times;
                        </button>
                    </td>

                </tr>
            `;
        }


        function fillSelect(select) {

            const chosen = select.value;

            const fallbackText =
                select.selectedOptions[0]
                    ? select.selectedOptions[0].text
                    : '#' + chosen;


            let html =
                '<option value="">-- ជ្រើសរើសថ្នាំ --</option>';

            let found = false;


            medicines.forEach(m => {

                const isSel =
                    String(m.medicine_id) === String(chosen);

                if (isSel) {
                    found = true;
                }

                html += `
                    <option
                        value="${m.medicine_id}"
                        ${isSel ? 'selected' : ''}
                    >
                        ${esc(medicineLabel(m))}
                    </option>
                `;
            });


            if (chosen && !found) {

                html += `
                    <option
                        value="${esc(chosen)}"
                        selected
                    >
                        ${esc(fallbackText)}
                    </option>
                `;

            }


            select.innerHTML = html;
        }


        function toggleEmpty() {

            emptyMsg.classList.toggle(
                'd-none',
                body.children.length > 0
            );

        }


        function addRow(data) {

            body.insertAdjacentHTML(
                'beforeend',
                rowHtml(nextIndex++, data)
            );


            if (medicines.length) {

                fillSelect(
                    body.lastElementChild.querySelector('.rx-medicine')
                );

            }


            toggleEmpty();
        }


        document
            .getElementById('btnAddRx')
            .addEventListener('click', () => addRow());


        body.addEventListener('click', e => {

            const btn =
                e.target.closest('.rx-remove');

            if (!btn) {
                return;
            }

            btn.closest('tr').remove();

            toggleEmpty();

        });


        /* Existing / old rows */

        let initial = [];

        try {

            initial =
                Object.values(
                    JSON.parse(
                        app.dataset.rows || '[]'
                    )
                );

        } catch (e) {}


        initial.forEach(r => addRow(r));

        toggleEmpty();


        /* Load medicines */

        fetch(
            app.dataset.searchUrl,
            {
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                credentials: 'same-origin'
            }
        )

        .then(r =>
            r.ok
                ? r.json()
                : Promise.reject(r.status)
        )

        .then(list => {

            medicines =
                Array.isArray(list)
                    ? list
                    : [];


            body
                .querySelectorAll('.rx-medicine')
                .forEach(fillSelect);

        })

        .catch(() => {});

    })();

</script>

@stop
