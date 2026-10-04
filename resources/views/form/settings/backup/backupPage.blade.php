@extends('adminlte::page')

@section('title', 'Backup & Restore')

@section('content')

<div class="container-fluid pt-3">

    {{-- Page Header --}}
    <div class="backup-header mb-4">
        <div class="backup-header-content">
            <div>
                <div class="backup-title-icon">
                    <i class="fas fa-database"></i>
                </div>

                <div class="backup-title-text">
                    <h2>Backup & Restore</h2>
                    <p>គ្រប់គ្រងការបម្រុងទុក និងស្ដារទិន្នន័យប្រព័ន្ធ</p>
                </div>
            </div>

            <div class="backup-status">
                <i class="fas fa-shield-alt"></i>
                Database Protected
            </div>
        </div>
    </div>


    {{-- Main Card --}}
    <div class="backup-card">

        {{-- Tabs --}}
        <div class="backup-tabs-wrapper">

            <ul class="nav nav-tabs backup-tabs" id="backupTab" role="tablist">

                <li class="nav-item">
                    <a
                        class="nav-link active"
                        id="backup-tab"
                        data-toggle="tab"
                        href="#backup"
                        role="tab"
                    >
                        <span class="tab-icon">
                            <i class="fas fa-download"></i>
                        </span>

                        <span>
                            <strong>Backup</strong>
                            <small>បម្រុងទុកទិន្នន័យ</small>
                        </span>
                    </a>
                </li>

                <li class="nav-item">
                    <a
                        class="nav-link"
                        id="restore-tab"
                        data-toggle="tab"
                        href="#restore"
                        role="tab"
                    >
                        <span class="tab-icon">
                            <i class="fas fa-upload"></i>
                        </span>

                        <span>
                            <strong>Restore</strong>
                            <small>ស្ដារទិន្នន័យ</small>
                        </span>
                    </a>
                </li>

            </ul>

        </div>


        <div class="card-body backup-card-body">

            <div class="tab-content">


                {{-- =========================
                    BACKUP TAB
                ========================== --}}
                <div
                    class="tab-pane fade show active"
                    id="backup"
                    role="tabpanel"
                >

                    {{-- Information --}}
                    <div class="backup-info-box">
                        <div class="info-icon">
                            <i class="fas fa-info-circle"></i>
                        </div>

                        <div>
                            <div class="info-title">
                                Backup Database
                            </div>

                            <div class="info-text">
                                បង្កើត Backup ដើម្បីរក្សាទុកទិន្នន័យប្រព័ន្ធ
                                និងអាចប្រើសម្រាប់ Restore នៅពេលចាំបាច់។
                            </div>
                        </div>
                    </div>


                    {{-- Section Header --}}
                    <div class="section-heading">
                        <div>
                            <h5>
                                <i class="fas fa-history mr-2"></i>
                                Backup History
                            </h5>

                            <p>
                                បញ្ជី File Backup ដែលបានបង្កើត
                            </p>
                        </div>

                        <button
                            type="button"
                            class="btn btn-create-backup"
                            id="createBackupBtn"
                        >
                            <i class="fas fa-database mr-2"></i>
                            Create Backup Now
                        </button>
                    </div>


                    {{-- Backup Table --}}
                    <div class="backup-table-wrapper">

                        <div class="table-responsive">

                            <table class="table backup-table mb-0">

                                <thead>
                                    <tr>
                                        <th width="40%">
                                            <i class="fas fa-file-archive mr-1"></i>
                                            ឈ្មោះ File Backup
                                        </th>

                                        <th width="30%">
                                            <i class="far fa-calendar-alt mr-1"></i>
                                            ថ្ងៃបង្កើត
                                        </th>

                                        <th width="180px" class="text-right">
                                            សកម្មភាព
                                        </th>
                                    </tr>
                                </thead>

                                <tbody id="backupTableBody">

                                    <tr>
                                        <td
                                            colspan="3"
                                            class="text-center backup-loading"
                                        >
                                            <div class="loading-icon">
                                                <i class="fas fa-spinner fa-spin"></i>
                                            </div>

                                            <span>
                                                កំពុងផ្ទុក...
                                            </span>
                                        </td>
                                    </tr>

                                </tbody>

                            </table>

                        </div>

                    </div>

                </div>


                {{-- =========================
                    RESTORE TAB
                ========================== --}}
                <div
                    class="tab-pane fade"
                    id="restore"
                    role="tabpanel"
                >

                    <div class="restore-content">

                        {{-- Warning --}}
                        <div class="restore-warning">

                            <div class="warning-icon">
                                <i class="fas fa-exclamation-triangle"></i>
                            </div>

                            <div>
                                <div class="warning-title">
                                    សូមប្រុងប្រយ័ត្ន
                                </div>

                                <div class="warning-text">
                                    Restore database នឹងជំនួសទិន្នន័យបច្ចុប្បន្ន
                                    ជាមួយទិន្នន័យនៅក្នុង Backup File។
                                    សូមពិនិត្យ File ឲ្យបានត្រឹមត្រូវមុនពេល Restore។
                                </div>
                            </div>

                        </div>


                        {{-- Restore Card --}}
                        <div class="restore-form-card">

                            <div class="restore-form-header">
                                <div class="restore-form-icon">
                                    <i class="fas fa-file-upload"></i>
                                </div>

                                <div>
                                    <h5>Upload Backup File</h5>
                                    <p>
                                        ជ្រើសរើស SQL Backup File ដើម្បី Restore
                                    </p>
                                </div>
                            </div>


                            <form
                                id="restoreForm"
                                enctype="multipart/form-data"
                            >

                                @csrf

                                <div class="form-group mb-4">

                                    <label
                                        for="backupFile"
                                        class="backup-form-label"
                                    >
                                        Backup File
                                    </label>

                                    <div class="custom-file backup-file-input">

                                        <input
                                            type="file"
                                            class="custom-file-input"
                                            id="backupFile"
                                            name="backup_file"
                                            accept=".sql"
                                        >

                                        <label
                                            class="custom-file-label"
                                            for="backupFile"
                                        >
                                            <i class="fas fa-file-code mr-2"></i>
                                            Choose SQL backup file
                                        </label>

                                    </div>

                                    <small
                                        class="text-danger d-none restore-file-error"
                                        id="restoreFileError"
                                    ></small>

                                    <small class="form-help">
                                        <i class="fas fa-info-circle mr-1"></i>
                                        អនុញ្ញាតតែ File ប្រភេទ <strong>.sql</strong>
                                    </small>

                                </div>


                                <button
                                    type="submit"
                                    class="btn btn-restore"
                                    id="restoreBtn"
                                >
                                    <i class="fas fa-upload mr-2"></i>
                                    Restore Database
                                </button>

                            </form>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@stop


@section('css')
@parent

<style>

    :root {
        --backup-green: #006D36;
        --backup-green-dark: #00552B;
        --backup-green-light: #E8F5EE;
        --backup-bg: #F5F7F6;
        --backup-border: #E7ECE9;
        --backup-text: #1F2A24;
        --backup-muted: #7A8780;
    }


    /* ========================================
       PAGE HEADER
    ======================================== */

    .backup-header {
        background: linear-gradient(
            135deg,
            #006D36 0%,
            #008747 100%
        );

        border-radius: 16px;
        padding: 22px 25px;
        color: #fff;
        box-shadow: 0 8px 22px rgba(0, 109, 54, .12);
    }

    .backup-header-content {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
    }

    .backup-header-content > div:first-child {
        display: flex;
        align-items: center;
    }

    .backup-title-icon {
        width: 55px;
        height: 55px;
        border-radius: 14px;
        background: rgba(255, 255, 255, .16);
        border: 1px solid rgba(255, 255, 255, .22);

        display: flex;
        align-items: center;
        justify-content: center;

        font-size: 22px;
        margin-right: 15px;
    }

    .backup-title-text h2 {
        margin: 0 0 4px;
        font-size: 23px;
        font-weight: 800;
    }

    .backup-title-text p {
        margin: 0;
        font-size: 13px;
        opacity: .88;
    }

    .backup-status {
        display: inline-flex;
        align-items: center;
        gap: 7px;

        padding: 8px 13px;

        background: rgba(255, 255, 255, .13);
        border: 1px solid rgba(255, 255, 255, .2);
        border-radius: 9px;

        font-size: 12px;
        font-weight: 700;
        white-space: nowrap;
    }


    /* ========================================
       MAIN CARD
    ======================================== */

    .backup-card {
        background: #fff;
        border: 1px solid var(--backup-border);
        border-radius: 15px;
        box-shadow: 0 5px 18px rgba(31, 42, 36, .05);
        overflow: hidden;
    }

    .backup-card-body {
        padding: 24px;
    }


    /* ========================================
       TABS
    ======================================== */

    .backup-tabs-wrapper {
        border-bottom: 1px solid var(--backup-border);
        background: #fff;
    }

    .backup-tabs {
        border-bottom: none;
        padding: 0 20px;
    }

    .backup-tabs .nav-item {
        margin-bottom: -1px;
    }

    .backup-tabs .nav-link {
        position: relative;

        display: flex;
        align-items: center;
        gap: 10px;

        padding: 16px 20px;

        border: none;
        border-bottom: 3px solid transparent;

        color: var(--backup-muted);

        font-size: 13px;
        font-weight: 700;

        transition: all .18s ease;
    }

    .backup-tabs .nav-link:hover {
        color: var(--backup-green);
        background: #FAFCFB;
    }

    .backup-tabs .nav-link.active {
        color: var(--backup-green);
        background: #fff;
        border-bottom-color: var(--backup-green);
    }

    .backup-tabs .nav-link strong {
        display: block;
        font-size: 13px;
    }

    .backup-tabs .nav-link small {
        display: block;
        margin-top: 2px;

        color: var(--backup-muted);
        font-size: 10px;
        font-weight: 500;
    }

    .backup-tabs .nav-link.active small {
        color: #668074;
    }

    .tab-icon {
        width: 36px;
        height: 36px;

        display: inline-flex;
        align-items: center;
        justify-content: center;

        border-radius: 9px;

        background: #F5F7F6;
        color: var(--backup-muted);

        transition: all .18s ease;
    }

    .backup-tabs .nav-link.active .tab-icon {
        background: var(--backup-green-light);
        color: var(--backup-green);
    }


    /* ========================================
       INFORMATION BOX
    ======================================== */

    .backup-info-box {
        display: flex;
        align-items: flex-start;
        gap: 13px;

        padding: 15px 17px;

        margin-bottom: 25px;

        background: var(--backup-green-light);
        border: 1px solid #D5EBDD;
        border-left: 4px solid var(--backup-green);

        border-radius: 10px;
    }

    .info-icon {
        width: 35px;
        height: 35px;

        min-width: 35px;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 9px;

        background: #fff;
        color: var(--backup-green);

        font-size: 15px;
    }

    .info-title {
        margin-bottom: 3px;

        color: var(--backup-green-dark);
        font-size: 13px;
        font-weight: 800;
    }

    .info-text {
        color: #597066;
        font-size: 12px;
        line-height: 1.6;
    }


    /* ========================================
       SECTION HEADING
    ======================================== */

    .section-heading {
        display: flex;
        align-items: center;
        justify-content: space-between;

        gap: 15px;

        margin-bottom: 15px;
    }

    .section-heading h5 {
        margin: 0 0 3px;

        color: var(--backup-text);

        font-size: 15px;
        font-weight: 800;
    }

    .section-heading h5 i {
        color: var(--backup-green);
    }

    .section-heading p {
        margin: 0;

        color: var(--backup-muted);
        font-size: 11px;
    }


    /* ========================================
       CREATE BACKUP BUTTON
    ======================================== */

    .btn-create-backup {
        display: inline-flex;
        align-items: center;

        padding: 10px 15px;

        background: var(--backup-green);
        border: 1px solid var(--backup-green);
        color: #fff;

        border-radius: 9px;

        font-size: 12px;
        font-weight: 700;

        box-shadow: 0 4px 10px rgba(0, 109, 54, .12);

        transition: all .18s ease;
    }

    .btn-create-backup:hover,
    .btn-create-backup:focus {
        background: var(--backup-green-dark);
        border-color: var(--backup-green-dark);
        color: #fff;

        transform: translateY(-1px);
        box-shadow: 0 6px 14px rgba(0, 109, 54, .18);
    }


    /* ========================================
       BACKUP TABLE
    ======================================== */

    .backup-table-wrapper {
        border: 1px solid var(--backup-border);
        border-radius: 11px;
        overflow: hidden;
        background: #fff;
    }

    .backup-table {
        min-width: 700px;
    }

    .backup-table thead th {
        background: #F8FAF9;

        color: #65736B;

        border-top: none;
        border-bottom: 1px solid var(--backup-border);

        padding: 13px 15px;

        font-size: 11px;
        font-weight: 800;

        text-transform: uppercase;
        letter-spacing: .3px;

        white-space: nowrap;
    }

    .backup-table tbody td {
        padding: 14px 15px;

        border-top: 1px solid #EEF2F0;

        vertical-align: middle;

        color: var(--backup-text);

        font-size: 13px;
    }

    .backup-table tbody tr {
        transition: background .18s ease;
    }

    .backup-table tbody tr:hover {
        background: #FAFCFB;
    }


    /* ========================================
       LOADING
    ======================================== */

    .backup-loading {
        padding: 45px 20px !important;
        color: var(--backup-muted);
    }

    .loading-icon {
        width: 45px;
        height: 45px;

        margin: 0 auto 10px;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 12px;

        background: var(--backup-green-light);
        color: var(--backup-green);

        font-size: 17px;
    }


    /* ========================================
       RESTORE
    ======================================== */

    .restore-content {
        max-width: 850px;
    }

    .restore-warning {
        display: flex;
        align-items: flex-start;
        gap: 13px;

        padding: 16px 17px;

        margin-bottom: 22px;

        background: #FFF8E6;
        border: 1px solid #F4E2AD;
        border-left: 4px solid #E0A800;

        border-radius: 10px;
    }

    .warning-icon {
        width: 36px;
        height: 36px;

        min-width: 36px;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 9px;

        background: #FFF1C7;
        color: #B58105;
    }

    .warning-title {
        margin-bottom: 3px;

        color: #8A6708;

        font-size: 13px;
        font-weight: 800;
    }

    .warning-text {
        color: #776631;

        font-size: 12px;
        line-height: 1.65;
    }


    /* ========================================
       RESTORE FORM CARD
    ======================================== */

    .restore-form-card {
        border: 1px solid var(--backup-border);
        border-radius: 12px;
        background: #fff;
        overflow: hidden;
    }

    .restore-form-header {
        display: flex;
        align-items: center;
        gap: 12px;

        padding: 17px 18px;

        background: #F8FAF9;
        border-bottom: 1px solid var(--backup-border);
    }

    .restore-form-icon {
        width: 42px;
        height: 42px;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 10px;

        background: var(--backup-green-light);
        color: var(--backup-green);

        font-size: 17px;
    }

    .restore-form-header h5 {
        margin: 0 0 3px;

        color: var(--backup-text);

        font-size: 14px;
        font-weight: 800;
    }

    .restore-form-header p {
        margin: 0;

        color: var(--backup-muted);

        font-size: 11px;
    }

    .restore-form-card form {
        padding: 22px 20px;
    }

    .backup-form-label {
        display: block;

        margin-bottom: 8px;

        color: var(--backup-text);

        font-size: 12px;
        font-weight: 800;
    }

    .backup-file-input {
        height: 46px;
    }

    .backup-file-input .custom-file-input,
    .backup-file-input .custom-file-label {
        height: 46px;
    }

    .backup-file-input .custom-file-label {
        display: flex;
        align-items: center;

        padding: 0 14px;

        border: 1px solid var(--backup-border);
        border-radius: 9px;

        color: var(--backup-muted);

        font-size: 12px;

        box-shadow: none;
    }

    .backup-file-input .custom-file-label::after {
        height: 44px;

        display: flex;
        align-items: center;

        background: var(--backup-green-light);
        border-left: 1px solid #D5EBDD;

        color: var(--backup-green);

        border-radius: 0 8px 8px 0;

        content: "Browse";
    }

    .backup-file-input .custom-file-input:focus ~ .custom-file-label {
        border-color: var(--backup-green);
        box-shadow: 0 0 0 .15rem rgba(0, 109, 54, .08);
    }

    .form-help {
        display: block;

        margin-top: 8px;

        color: var(--backup-muted);

        font-size: 11px;
    }

    .form-help i {
        color: var(--backup-green);
    }

    .restore-file-error {
        display: block;
        margin-top: 7px;
        font-size: 11px;
    }


    /* ========================================
       RESTORE BUTTON
    ======================================== */

    .btn-restore {
        display: inline-flex;
        align-items: center;

        padding: 10px 17px;

        background: var(--backup-green);
        border: 1px solid var(--backup-green);

        color: #fff;

        border-radius: 9px;

        font-size: 12px;
        font-weight: 700;

        transition: all .18s ease;
    }

    .btn-restore:hover,
    .btn-restore:focus {
        background: var(--backup-green-dark);
        border-color: var(--backup-green-dark);
        color: #fff;

        transform: translateY(-1px);
    }


    /* ========================================
       DYNAMIC TABLE BUTTONS
    ======================================== */

    #backupTableBody .btn {
        width: 34px;
        height: 34px;

        padding: 0;

        display: inline-flex;
        align-items: center;
        justify-content: center;

        border-radius: 8px;

        margin-left: 4px;

        transition: all .18s ease;
    }

    #backupTableBody .btn-outline-primary {
        color: var(--backup-green);
        border-color: #CBE3D5;
    }

    #backupTableBody .btn-outline-primary:hover {
        background: var(--backup-green);
        border-color: var(--backup-green);
        color: #fff;
    }

    #backupTableBody .btn-outline-danger {
        color: #DC3545;
        border-color: #F0C9CE;
    }

    #backupTableBody .btn-outline-danger:hover {
        background: #DC3545;
        border-color: #DC3545;
        color: #fff;
    }


    /* ========================================
       TOAST
    ======================================== */

    .toast-container-custom {
        position: fixed;

        top: 20px;
        right: 20px;

        z-index: 99999;

        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .toast-custom {
        min-width: 300px;

        display: flex;
        align-items: center;
        gap: 11px;

        padding: 13px 16px;

        border-radius: 10px;

        color: #fff;

        font-size: 13px;
        font-weight: 600;

        box-shadow: 0 8px 25px rgba(0, 0, 0, .15);

        animation: toastSlideIn .25s ease;
    }

    .toast-custom.success {
        background: linear-gradient(
            135deg,
            #006D36,
            #008747
        );
    }

    .toast-custom.error {
        background: linear-gradient(
            135deg,
            #B42318,
            #DC3545
        );
    }

    .toast-custom.info {
        background: linear-gradient(
            135deg,
            #006D36,
            #008747
        );
    }

    .toast-custom i {
        font-size: 17px;
    }

    @keyframes toastSlideIn {
        from {
            opacity: 0;
            transform: translateX(20px);
        }

        to {
            opacity: 1;
            transform: translateX(0);
        }
    }


    /* ========================================
       RESPONSIVE
    ======================================== */

    @media (max-width: 767.98px) {

        .backup-header {
            padding: 18px;
        }

        .backup-header-content {
            align-items: flex-start;
            flex-direction: column;
        }

        .backup-title-text h2 {
            font-size: 20px;
        }

        .backup-status {
            align-self: flex-start;
        }

        .backup-card-body {
            padding: 16px;
        }

        .backup-tabs {
            padding: 0 8px;
        }

        .backup-tabs .nav-link {
            padding: 13px 12px;
        }

        .backup-tabs .nav-link small {
            display: none;
        }

        .section-heading {
            align-items: flex-start;
            flex-direction: column;
        }

        .btn-create-backup {
            width: 100%;
            justify-content: center;
        }

        .restore-content {
            max-width: 100%;
        }

        .toast-container-custom {
            left: 15px;
            right: 15px;
            top: 15px;
        }

        .toast-custom {
            min-width: 0;
            width: 100%;
        }
    }

</style>
@stop


@section('js')
@parent

<script>

    $(document).ready(function () {

        loadBackups();


        // ========================================
        // FILE INPUT
        // ========================================

        $('.custom-file-input').on('change', function () {

            let fileName = $(this).val().split('\\').pop();

            $(this)
                .next('.custom-file-label')
                .html(
                    fileName
                        ? '<i class="fas fa-file-code mr-2"></i>' + escapeHtml(fileName)
                        : '<i class="fas fa-file-code mr-2"></i>Choose SQL backup file'
                );
        });


        // ========================================
        // TOAST
        // ========================================

        function showToast(type, message) {

            let container = document.querySelector('.toast-container-custom');

            if (!container) {

                container = document.createElement('div');

                container.className = 'toast-container-custom';

                document.body.appendChild(container);
            }


            const icons = {

                success: 'fa-check-circle',

                error: 'fa-times-circle',

                info: 'fa-info-circle'
            };


            const toast = document.createElement('div');

            toast.className = `toast-custom ${type}`;

            toast.innerHTML = `
                <i class="fas ${icons[type] || icons.info}"></i>
                <span></span>
            `;

            toast.querySelector('span').textContent = message;

            container.appendChild(toast);


            setTimeout(() => {

                toast.style.transition = 'opacity .3s ease';

                toast.style.opacity = '0';

                setTimeout(() => toast.remove(), 300);

            }, 4000);
        }


        // ========================================
        // LOAD BACKUPS
        // ========================================

        function loadBackups() {

            $.ajax({

                url: "{{ route('settingsbackup.list') }}",

                method: 'GET',

                success: function (res) {

                    renderTable(res.data);
                },

                error: function () {

                    $('#backupTableBody').html(`
                        <tr>
                            <td
                                colspan="3"
                                class="text-center text-danger py-5"
                            >
                                <i class="fas fa-exclamation-circle fa-2x mb-2"></i>
                                <div>
                                    មិនអាចផ្ទុកទិន្នន័យបាន
                                </div>
                            </td>
                        </tr>
                    `);
                }
            });
        }


        // ========================================
        // RENDER BACKUP TABLE
        // ========================================

        function renderTable(backups) {

            if (!backups.length) {

                $('#backupTableBody').html(`
                    <tr>
                        <td
                            colspan="3"
                            class="text-center py-5 text-muted"
                        >
                            <div class="loading-icon">
                                <i class="fas fa-database"></i>
                            </div>

                            <div class="font-weight-bold mb-1">
                                មិនទាន់មាន Backup
                            </div>

                            <small>
                                សូមបង្កើត Backup ថ្មី ដើម្បីរក្សាទុកទិន្នន័យ
                            </small>
                        </td>
                    </tr>
                `);

                return;
            }


            let rows = '';


            backups.forEach(function (b) {

                rows += `
                    <tr>

                        <td>
                            <div class="d-flex align-items-center">

                                <div
                                    style="
                                        width:38px;
                                        height:38px;
                                        border-radius:9px;
                                        background:#E8F5EE;
                                        color:#006D36;
                                        display:flex;
                                        align-items:center;
                                        justify-content:center;
                                        margin-right:11px;
                                    "
                                >
                                    <i class="fas fa-file-archive"></i>
                                </div>

                                <div>
                                    <div
                                        class="font-weight-bold"
                                        style="color:#1F2A24;font-size:13px;"
                                    >
                                        ${escapeHtml(b.filename)}
                                    </div>

                                    <small style="color:#7A8780;">
                                        Database Backup
                                    </small>
                                </div>

                            </div>
                        </td>


                        <td>
                            <span
                                style="
                                    color:#596760;
                                    font-size:12px;
                                    font-weight:600;
                                "
                            >
                                <i
                                    class="far fa-calendar-alt mr-1"
                                    style="color:#006D36;"
                                ></i>

                                ${escapeHtml(b.created_at)}
                            </span>
                        </td>


                        <td class="text-right">

                            <a
                                href="/settings/backup/download/${encodeURIComponent(b.filename)}"
                                class="btn btn-outline-primary btn-sm"
                                title="Download Backup"
                            >
                                <i class="fas fa-download"></i>
                            </a>

                            <button
                                type="button"
                                class="btn btn-outline-danger btn-sm delete-backup-btn"
                                data-filename="${escapeHtml(b.filename)}"
                                title="Delete Backup"
                            >
                                <i class="fas fa-trash"></i>
                            </button>

                        </td>

                    </tr>
                `;
            });


            $('#backupTableBody').html(rows);
        }


        // ========================================
        // ESCAPE HTML
        // ========================================

        function escapeHtml(str) {

            return $('<div>')
                .text(str)
                .html();
        }


        // ========================================
        // CREATE BACKUP
        // ========================================

        $('#createBackupBtn').on('click', function () {

            let $btn = $(this);


            $btn
                .prop('disabled', true)
                .html(
                    '<i class="fas fa-spinner fa-spin mr-2"></i> កំពុងបង្កើត...'
                );


            $.ajax({

                url: "{{ route('settingsbackup.store') }}",

                method: 'POST',

                data: {
                    _token: '{{ csrf_token() }}'
                },

                success: function (res) {

                    showToast(
                        'success',
                        res.message
                    );

                    loadBackups();
                },

                error: function (xhr) {

                    let msg =
                        xhr.responseJSON?.message ??
                        'Backup failed.';

                    let debug =
                        xhr.responseJSON?.debug;


                    showToast(
                        'error',
                        debug
                            ? `${msg} (${debug})`
                            : msg
                    );
                },

                complete: function () {

                    $btn
                        .prop('disabled', false)
                        .html(
                            '<i class="fas fa-database mr-2"></i> Create Backup Now'
                        );
                }
            });

        });


        // ========================================
        // DELETE BACKUP
        // ========================================

        $('#backupTableBody').on(
            'click',
            '.delete-backup-btn',
            function () {

                if (
                    !confirm(
                        'តើអ្នកចង់លុប Backup នេះមែនទេ?'
                    )
                ) {
                    return;
                }


                let filename =
                    $(this).data('filename');


                $.ajax({

                    url:
                        `/settings/backup/${encodeURIComponent(filename)}`,

                    method: 'DELETE',

                    data: {
                        _token: '{{ csrf_token() }}'
                    },

                    success: function (res) {

                        showToast(
                            'success',
                            res.message
                        );

                        loadBackups();
                    },

                    error: function (xhr) {

                        showToast(
                            'error',
                            xhr.responseJSON?.message ??
                            'លុប Backup មិនជោគជ័យ'
                        );
                    }
                });

            }
        );


        // ========================================
        // RESTORE
        // ========================================

        $('#restoreForm').on('submit', function (e) {

            e.preventDefault();


            let fileInput =
                $('#backupFile')[0];


            $('#restoreFileError')
                .addClass('d-none')
                .text('');


            if (!fileInput.files.length) {

                $('#restoreFileError')
                    .removeClass('d-none')
                    .text(
                        'សូមជ្រើសរើស File មុនសិន'
                    );

                return;
            }


            if (
                !confirm(
                    'ការ Restore នឹងជំនួសទិន្នន័យបច្ចុប្បន្នទាំងអស់។ តើអ្នកប្រាកដទេ?'
                )
            ) {
                return;
            }


            let formData = new FormData();


            formData.append(
                'backup_file',
                fileInput.files[0]
            );

            formData.append(
                '_token',
                '{{ csrf_token() }}'
            );


            let $btn =
                $('#restoreBtn');


            $btn
                .prop('disabled', true)
                .html(
                    '<i class="fas fa-spinner fa-spin mr-2"></i> កំពុង Restore...'
                );


            $.ajax({

                url:
                    "{{ route('settingsbackup.restore') }}",

                method: 'POST',

                data: formData,

                processData: false,

                contentType: false,

                success: function (res) {

                    showToast(
                        'success',
                        res.message
                    );


                    $('#restoreForm')[0].reset();

                    $('.custom-file-label').html(
                        '<i class="fas fa-file-code mr-2"></i>Choose SQL backup file'
                    );
                },

                error: function (xhr) {

                    if (xhr.status === 422) {

                        let errors =
                            xhr.responseJSON.errors;

                        let msg =
                            Object.values(errors)
                                .flat()
                                .join(' ');


                        $('#restoreFileError')
                            .removeClass('d-none')
                            .text(msg);

                    } else {

                        showToast(
                            'error',
                            xhr.responseJSON?.message ??
                            'Restore មិនជោគជ័យ'
                        );
                    }
                },

                complete: function () {

                    $btn
                        .prop('disabled', false)
                        .html(
                            '<i class="fas fa-upload mr-2"></i> Restore Database'
                        );
                }
            });

        });

    });

</script>
@stop