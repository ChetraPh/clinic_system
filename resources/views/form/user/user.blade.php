@extends('adminlte::page')

@section('title', 'User Management')

@section('content')

<div class="container-fluid user-management-page pt-3">

    {{-- SUCCESS TOAST --}}
    <div id="userSuccessToast"
         class="user-toast d-none"
         role="alert">

        <div class="toast-icon">
            <i class="fas fa-check"></i>
        </div>

        <div class="toast-content">
            <strong>ជោគជ័យ</strong>
            <span id="userSuccessToastMessage"></span>
        </div>

        <button type="button"
                class="toast-close"
                onclick="$('#userSuccessToast').addClass('d-none');">

            <i class="fas fa-times"></i>

        </button>

    </div>


    {{-- PAGE HEADER --}}
    <div class="page-header mb-4">

        <div class="header-left">

            <div class="header-icon">
                <i class="fas fa-users-cog"></i>
            </div>

            <div class="header-text">

                <h2>User Management</h2>

                <p>
                    គ្រប់គ្រងអ្នកប្រើប្រាស់ និងតួនាទីក្នុងប្រព័ន្ធ
                </p>

            </div>

        </div>

        <button type="button"
                class="header-create-btn"
                data-toggle="modal"
                data-target="#modalCreateUser">

            <i class="fas fa-user-plus mr-1"></i>
            បង្កើតអ្នកប្រើប្រាស់

        </button>

    </div>


    {{-- STATISTICS --}}
    <div class="row mb-4">

        <div class="col-xl-3 col-lg-4 col-md-6 mb-3">

            <div class="stat-card">

                <div class="stat-icon">
                    <i class="fas fa-users"></i>
                </div>

                <div class="stat-info">

                    <span class="stat-label">
                        អ្នកប្រើប្រាស់សរុប
                    </span>

                    <h3 id="totalUser">
                        {{ $totalUser }}
                    </h3>

                </div>

            </div>

        </div>

    </div>


    {{-- MAIN CARD --}}
    <div class="user-card">

        {{-- TOOLBAR --}}
        <div class="toolbar">

            <div class="toolbar-title">

                <div class="toolbar-icon">
                    <i class="fas fa-user-shield"></i>
                </div>

                <div>

                    <h5>បញ្ជីអ្នកប្រើប្រាស់</h5>

                    <span>គ្រប់គ្រង Account និង Role</span>

                </div>

            </div>


            <div class="toolbar-actions">

                <div class="search-box">

                    <i class="fas fa-search"></i>

                    <input
                        type="text"
                        id="search"
                        class="form-control border-0"
                        placeholder="ស្វែងរក ឈ្មោះ, អ៊ីមែល, Username"
                    >

                </div>


                <button type="button"
                        class="create-btn"
                        data-toggle="modal"
                        data-target="#modalCreateUser">

                    <i class="fas fa-user-plus mr-1"></i>
                    បង្កើតថ្មី

                </button>

            </div>

        </div>


        {{-- TABLE --}}
        <div id="userTableContainer">

            @include('form.user.partials.table')

        </div>

    </div>

</div>


{{-- ============================================================
     RESET 2FA MODAL
============================================================ --}}

<div class="modal fade"
     id="modalReset2FA"
     tabindex="-1"
     aria-hidden="true">

    <div class="modal-dialog modal-sm modal-mobile-fit">

        <div class="modal-content custom-modal modal-purple">

            <div class="modal-header modal-header-purple">

                <h6 class="modal-title">

                    <i class="fas fa-shield-alt mr-1"></i>

                    កំណត់ 2FA ឡើងវិញ

                </h6>

                <button type="button"
                        class="close text-white"
                        data-dismiss="modal">

                    <span>&times;</span>

                </button>

            </div>


            <form method="POST" id="reset2faForm">

                @csrf

                <div class="modal-body text-center p-4">

                    <div class="modal-big-icon purple-icon">

                        <i class="fas fa-shield-alt"></i>

                    </div>

                    <p class="mb-1">

                        តើអ្នកពិតជាចង់កំណត់
                        Two-Factor Authentication របស់

                    </p>

                    <strong id="reset2faUserName"
                            class="text-warning d-block mb-1">
                    </strong>

                    <p class="mb-2">

                        ឡើងវិញមែនទេ?

                    </p>

                    <p class="mb-0 text-muted small">

                        អ្នកប្រើប្រាស់នេះនឹងត្រូវបានស្នើឱ្យបង្កើត
                        Google Authenticator ថ្មីនៅពេលចូលប្រើលើកក្រោយ។

                    </p>

                </div>


                <div class="modal-footer justify-content-between">

                    <button type="button"
                            class="btn btn-light btn-sm"
                            data-dismiss="modal">

                        បោះបង់

                    </button>

                    <button type="submit"
                            class="btn btn-warning btn-sm">

                        <i class="fas fa-shield-alt mr-1"></i>

                        កំណត់ឡើងវិញ

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


{{-- ============================================================
     UPDATE ROLE MODAL
============================================================ --}}

<div class="modal fade"
     id="modalUpdateRole"
     tabindex="-1"
     aria-hidden="true">

    <div class="modal-dialog modal-sm modal-mobile-fit">

        <div class="modal-content custom-modal">

            <div class="modal-header modal-header-green">

                <h6 class="modal-title">

                    <i class="fas fa-user-tag mr-1"></i>

                    កំណត់តួនាទីអ្នកប្រើប្រាស់

                </h6>

                <button type="button"
                        class="close text-white"
                        data-dismiss="modal">

                    <span>&times;</span>

                </button>

            </div>


            <form method="POST" id="updateRoleForm">

                @csrf

                @method('PUT')

                <div class="modal-body p-4">

                    <div class="modal-big-icon green-icon">

                        <i class="fas fa-user-tag"></i>

                    </div>

                    <p class="mb-3">

                        កំណត់តួនាទីសម្រាប់

                        <strong id="updateRoleUserName"
                                class="text-success">
                        </strong>

                    </p>


                    <div class="form-group mb-0">

                        <label for="selectUserRole"
                               class="form-label-custom">

                            ជ្រើសរើសតួនាទី (Role)

                        </label>

                        <select
                            name="role"
                            id="selectUserRole"
                            class="form-control custom-select"
                            required
                        >

                            <option value="">
                                -- ជ្រើសរើសតួនាទី --
                            </option>

                            @foreach ($roles as $role)

                                <option value="{{ $role->name }}">
                                    {{ $role->name }}
                                </option>

                            @endforeach

                        </select>

                    </div>

                </div>


                <div class="modal-footer justify-content-between">

                    <button type="button"
                            class="btn btn-light btn-sm"
                            data-dismiss="modal">

                        បោះបង់

                    </button>

                    <button type="submit"
                            class="btn btn-success btn-sm custom-green-btn">

                        <i class="fas fa-save mr-1"></i>

                        រក្សាទុក

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


{{-- ============================================================
     CREATE USER MODAL
============================================================ --}}

<div class="modal fade"
     id="modalCreateUser"
     tabindex="-1"
     aria-labelledby="modalCreateUserLabel"
     aria-hidden="true">

    <div class="modal-dialog">

        <div class="modal-content custom-modal">

            <div class="modal-header modal-header-green">

                <h5 class="modal-title font-weight-bold"
                    id="modalCreateUserLabel">

                    <i class="fas fa-user-plus mr-2"></i>

                    បង្កើតអ្នកប្រើប្រាស់ថ្មី

                </h5>

                <button type="button"
                        class="close text-white"
                        data-dismiss="modal">

                    <span>&times;</span>

                </button>

            </div>


            <form id="createUserForm"
                  action="{{ route('user.store') }}"
                  method="POST">

                @csrf

                <div class="modal-body p-4">

                    <div id="createUserGeneralAlert"
                         class="alert alert-danger d-none mb-3">
                    </div>


                    {{-- NAME --}}
                    <div class="form-group">

                        <label for="create_name"
                               class="form-label-custom">

                            ឈ្មោះ (Full Name)

                            <span class="text-danger">*</span>

                        </label>

                        <div class="input-group-custom">

                            <i class="fas fa-user"></i>

                            <input
                                type="text"
                                name="name"
                                id="create_name"
                                class="form-control"
                                placeholder="បញ្ចូលឈ្មោះពេញ"
                                required
                            >

                        </div>

                        <div class="invalid-feedback"
                             id="error_create_name">
                        </div>

                    </div>


                    {{-- EMAIL --}}
                    <div class="form-group">

                        <label for="create_email"
                               class="form-label-custom">

                            អ៊ីមែល (Email Address)

                            <span class="text-danger">*</span>

                        </label>

                        <div class="input-group-custom">

                            <i class="fas fa-envelope"></i>

                            <input
                                type="email"
                                name="email"
                                id="create_email"
                                class="form-control"
                                placeholder="example@hospital.com"
                                required
                            >

                        </div>

                        <div class="invalid-feedback"
                             id="error_create_email">
                        </div>

                    </div>


                    {{-- USERNAME --}}
                    <div class="form-group">

                        <label for="create_username"
                               class="form-label-custom">

                            ឈ្មោះអ្នកប្រើប្រាស់ (Username)

                            <span class="text-danger">*</span>

                        </label>

                        <div class="input-group-custom">

                            <i class="fas fa-at"></i>

                            <input
                                type="text"
                                name="username"
                                id="create_username"
                                class="form-control"
                                placeholder="បញ្ចូល Username"
                                required
                            >

                        </div>

                        <div class="invalid-feedback"
                             id="error_create_username">
                        </div>

                    </div>


                    {{-- PASSWORD --}}
                    <div class="form-group">

                        <label for="create_password"
                               class="form-label-custom">

                            ពាក្យសម្ងាត់ (Password)

                            <span class="text-danger">*</span>

                        </label>

                        <div class="input-group-custom">

                            <i class="fas fa-lock"></i>

                            <input
                                type="password"
                                name="password"
                                id="create_password"
                                class="form-control"
                                placeholder="យ៉ាងហោចណាស់ ៨ តួអក្សរ"
                                required
                                minlength="8"
                            >

                        </div>

                        <div class="invalid-feedback"
                             id="error_create_password">
                        </div>

                    </div>


                    {{-- ROLE --}}
                    <div class="form-group mb-0">

                        <label for="create_role"
                               class="form-label-custom">

                            តួនាទី (Role)

                            <span class="text-danger">*</span>

                        </label>

                        <div class="input-group-custom">

                            <i class="fas fa-user-tag"></i>

                            <select
                                name="role"
                                id="create_role"
                                class="form-control custom-select"
                                required
                            >

                                <option value="">
                                    -- ជ្រើសរើសតួនាទី --
                                </option>

                                <option value="admin">
                                    Admin
                                </option>

                                <option value="doctor">
                                    Doctor
                                </option>

                                <option value="cashier">
                                    Cashier
                                </option>

                                <option value="nurse">
                                    Nurse
                                </option>

                                <option value="pharmacist">
                                    Pharmacist
                                </option>

                            </select>

                        </div>

                        <div class="invalid-feedback"
                             id="error_create_role">
                        </div>

                    </div>

                </div>


                <div class="modal-footer justify-content-between">

                    <button type="button"
                            class="btn btn-light border"
                            data-dismiss="modal">

                        បោះបង់

                    </button>

                    <button type="submit"
                            class="create-submit-btn"
                            id="btnSubmitCreateUser">

                        <i class="fas fa-save mr-1"></i>

                        រក្សាទុក

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


{{-- ============================================================
     DELETE USER MODAL
============================================================ --}}

<div class="modal fade"
     id="modalDeleteUser"
     tabindex="-1"
     aria-labelledby="modalDeleteUserLabel"
     aria-hidden="true">

    <div class="modal-dialog modal-sm modal-mobile-fit">

        <div class="modal-content custom-modal">

            <div class="modal-header modal-header-danger">

                <h6 class="modal-title"
                    id="modalDeleteUserLabel">

                    <i class="fas fa-trash-alt mr-1"></i>

                    លុបអ្នកប្រើប្រាស់

                </h6>

                <button type="button"
                        class="close text-white"
                        data-dismiss="modal">

                    <span>&times;</span>

                </button>

            </div>


            <form method="POST"
                  id="deleteUserForm">

                @csrf

                @method('DELETE')

                <div class="modal-body text-center p-4">

                    <div class="modal-big-icon red-icon">

                        <i class="fas fa-user-times"></i>

                    </div>

                    <p class="mb-1">

                        តើអ្នកពិតជាចង់លុប

                    </p>

                    <strong id="deleteUserName"
                            class="text-danger d-block mb-2">
                    </strong>

                    <p class="mb-0 text-muted small">

                        សកម្មភាពនេះមិនអាចត្រឡប់វិញបានទេ។

                    </p>

                </div>


                <div class="modal-footer justify-content-between">

                    <button type="button"
                            class="btn btn-light btn-sm"
                            data-dismiss="modal">

                        បោះបង់

                    </button>

                    <button type="submit"
                            class="btn btn-danger btn-sm">

                        <i class="fas fa-trash-alt mr-1"></i>

                        លុប

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

    --user-green: #006D36;
    --user-green-dark: #00552B;
    --user-green-light: #E8F5EE;
    --user-bg: #F5F7F6;
    --user-border: #E7ECE9;
    --user-text: #1F2A24;
    --user-muted: #7A8780;

}


body,
.content-wrapper {

    background: var(--user-bg);

}


/* ============================================================
   PAGE HEADER
============================================================ */

.page-header {

    background: linear-gradient(
        135deg,
        #006D36 0%,
        #008747 100%
    );

    border-radius: 16px;

    padding: 23px 27px;

    display: flex;

    align-items: center;

    justify-content: space-between;

    color: #fff;

    box-shadow:
        0 5px 18px rgba(0,109,54,.15);

}


.header-left {

    display: flex;

    align-items: center;

}


.header-icon {

    width: 56px;
    height: 56px;

    border-radius: 14px;

    background: rgba(255,255,255,.17);

    border: 1px solid rgba(255,255,255,.24);

    display: flex;

    align-items: center;

    justify-content: center;

    font-size: 23px;

    margin-right: 16px;

}


.header-text h2 {

    font-size: 23px;

    font-weight: 700;

    margin: 0 0 4px;

}


.header-text p {

    font-size: 13px;

    opacity: .9;

    margin: 0;

}


.header-create-btn {

    background: #fff;

    color: var(--user-green);

    border: 0;

    border-radius: 9px;

    padding: 10px 16px;

    font-size: 12px;

    font-weight: 700;

    transition: all .2s ease;

}


.header-create-btn:hover {

    background: #F3F7F5;

    color: var(--user-green-dark);

    transform: translateY(-1px);

    box-shadow:
        0 4px 10px rgba(0,0,0,.12);

}


/* ============================================================
   STAT CARD
============================================================ */

.stat-card {

    background: #fff;

    border: 1px solid var(--user-border);

    border-radius: 14px;

    padding: 18px;

    min-height: 94px;

    display: flex;

    align-items: center;

    box-shadow:
        0 3px 12px rgba(31,42,36,.04);

    transition: all .2s ease;

}


.stat-card:hover {

    transform: translateY(-2px);

    box-shadow:
        0 6px 18px rgba(31,42,36,.08);

}


.stat-icon {

    width: 52px;
    height: 52px;

    border-radius: 12px;

    background: var(--user-green-light);

    color: var(--user-green);

    display: flex;

    align-items: center;

    justify-content: center;

    font-size: 21px;

    margin-right: 15px;

}


.stat-label {

    display: block;

    color: var(--user-muted);

    font-size: 12px;

    margin-bottom: 3px;

}


.stat-info h3 {

    margin: 0;

    color: var(--user-text);

    font-size: 25px;

    font-weight: 700;

}


/* ============================================================
   MAIN CARD
============================================================ */

.user-card {

    background: #fff;

    border: 1px solid var(--user-border);

    border-radius: 15px;

    overflow: hidden;

    box-shadow:
        0 4px 15px rgba(31,42,36,.05);

}


/* ============================================================
   TOOLBAR
============================================================ */

.toolbar {

    padding: 19px 21px;

    border-bottom: 1px solid var(--user-border);

    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 15px;

}


.toolbar-title {

    display: flex;

    align-items: center;

}


.toolbar-icon {

    width: 40px;
    height: 40px;

    border-radius: 10px;

    background: var(--user-green-light);

    color: var(--user-green);

    display: flex;

    align-items: center;

    justify-content: center;

    margin-right: 11px;

}


.toolbar-title h5 {

    color: var(--user-text);

    font-size: 15px;

    font-weight: 700;

    margin: 0 0 2px;

}


.toolbar-title span {

    color: var(--user-muted);

    font-size: 10px;

}


.toolbar-actions {

    display: flex;

    align-items: center;

    gap: 10px;

}


.search-box {

    width: 330px;

    height: 40px;

    display: flex;

    align-items: center;

    background: #F5F8F6;

    border: 1px solid var(--user-border);

    border-radius: 9px;

    padding: 0 12px;

    transition: all .2s ease;

}


.search-box:focus-within {

    background: #fff;

    border-color: #B8D8C6;

    box-shadow:
        0 0 0 3px rgba(0,109,54,.07);

}


.search-box i {

    color: var(--user-muted);

    font-size: 12px;

    margin-right: 8px;

}


.search-box input {

    height: 38px;

    background: transparent;

    box-shadow: none !important;

    color: var(--user-text);

    font-size: 12px;

}


.search-box input::placeholder {

    color: #9AA59F;

}


.create-btn {

    height: 40px;

    background: var(--user-green);

    color: #fff;

    border: 0;

    border-radius: 8px;

    padding: 0 14px;

    font-size: 11px;

    font-weight: 600;

    white-space: nowrap;

    transition: all .2s ease;

}


.create-btn:hover {

    background: var(--user-green-dark);

    color: #fff;

    transform: translateY(-1px);

    box-shadow:
        0 4px 10px rgba(0,109,54,.18);

}


/* ============================================================
   TABLE CONTAINER
============================================================ */

#userTableContainer {

    position: relative;

    min-height: 120px;

    transition: opacity .15s ease;

}


#userTableContainer.loading {

    opacity: .45;

    pointer-events: none;

}


#userTableContainer.loading::after {

    content: '';

    position: absolute;

    top: 50%;

    left: 50%;

    width: 34px;

    height: 34px;

    margin: -17px 0 0 -17px;

    border: 3px solid #DDE5E0;

    border-top-color: var(--user-green);

    border-radius: 50%;

    animation: user-spin .6s linear infinite;

}


@keyframes user-spin {

    to {

        transform: rotate(360deg);

    }

}


/* ============================================================
   TOAST
============================================================ */

.user-toast {

    position: fixed;

    top: 20px;

    right: 25px;

    z-index: 9999;

    min-width: 310px;

    background: linear-gradient(
        135deg,
        #006D36,
        #008747
    );

    color: #fff;

    border-radius: 11px;

    padding: 13px 15px;

    display: flex;

    align-items: center;

    box-shadow:
        0 8px 25px rgba(0,0,0,.18);

}


.toast-icon {

    width: 34px;
    height: 34px;

    border-radius: 50%;

    background: rgba(255,255,255,.18);

    display: flex;

    align-items: center;

    justify-content: center;

    margin-right: 10px;

}


.toast-content {

    display: flex;

    flex-direction: column;

    gap: 2px;

    flex: 1;

}


.toast-content strong {

    font-size: 12px;

}


.toast-content span {

    font-size: 11px;

    opacity: .9;

}


.toast-close {

    border: 0;

    background: transparent;

    color: #fff;

    opacity: .8;

    cursor: pointer;

}


/* ============================================================
   MODAL
============================================================ */

.custom-modal {

    border: 0;

    border-radius: 15px;

    overflow: hidden;

    box-shadow:
        0 15px 45px rgba(0,0,0,.18);

}


.modal-header-green {

    background: linear-gradient(
        135deg,
        #006D36,
        #008747
    );

    color: #fff;

    border: 0;

    padding: 15px 19px;

}


.modal-header-purple {

    background: linear-gradient(
        135deg,
        #5B21B6,
        #7C3AED
    );

    color: #fff;

    border: 0;

    padding: 15px 19px;

}


.modal-header-danger {

    background: linear-gradient(
        135deg,
        #C0392B,
        #E74C3C
    );

    color: #fff;

    border: 0;

    padding: 15px 19px;

}


.modal-header .modal-title {

    font-size: 14px;

}


.modal-body {

    color: var(--user-text);

}


.modal-footer {

    background: #F8FAF9;

    border-top: 1px solid var(--user-border);

    padding: 13px 17px;

}


.modal-big-icon {

    width: 52px;
    height: 52px;

    border-radius: 13px;

    display: flex;

    align-items: center;

    justify-content: center;

    margin: 0 auto 15px;

    font-size: 20px;

}


.green-icon {

    background: var(--user-green-light);

    color: var(--user-green);

}


.purple-icon {

    background: #F0EAFE;

    color: #6D28D9;

}


.red-icon {

    background: #FDECEC;

    color: #C0392B;

}


.form-label-custom {

    display: block;

    color: var(--user-text);

    font-size: 11px;

    font-weight: 700;

    margin-bottom: 6px;

}


.input-group-custom {

    display: flex;

    align-items: center;

    background: #F8FAF9;

    border: 1px solid var(--user-border);

    border-radius: 8px;

    padding-left: 11px;

    transition: all .2s ease;

}


.input-group-custom:focus-within {

    background: #fff;

    border-color: #B8D8C6;

    box-shadow:
        0 0 0 3px rgba(0,109,54,.06);

}


.input-group-custom > i {

    width: 18px;

    color: var(--user-muted);

    font-size: 11px;

}


.input-group-custom .form-control,
.input-group-custom .custom-select {

    border: 0;

    background: transparent;

    box-shadow: none;

    font-size: 12px;

    height: 39px;

}


.custom-green-btn,
.create-submit-btn {

    background: var(--user-green);

    color: #fff;

    border: 0;

    border-radius: 7px;

    padding: 7px 14px;

    font-size: 11px;

    font-weight: 600;

}


.custom-green-btn:hover,
.create-submit-btn:hover {

    background: var(--user-green-dark);

    color: #fff;

}


.form-group {

    margin-bottom: 16px;

}


.invalid-feedback {

    font-size: 10px;

}


.user-action-menu .dropdown-item.text-danger {

    color: #C0392B;

}


.user-action-menu .dropdown-item.text-danger:hover {

    background: #FDECEC;

    color: #A93226;

}


/* ============================================================
   RESPONSIVE
============================================================ */

@media (max-width: 991.98px) {

    .toolbar {

        align-items: flex-start;

        flex-direction: column;

    }


    .toolbar-actions {

        width: 100%;

    }


    .search-box {

        flex: 1;

        width: auto;

    }

}


@media (max-width: 767.98px) {

    .page-header {

        padding: 18px;

    }


    .header-icon {

        width: 48px;
        height: 48px;

        font-size: 20px;

        margin-right: 12px;

    }


    .header-text h2 {

        font-size: 19px;

    }


    .header-text p {

        font-size: 11px;

    }


    .header-create-btn {

        padding: 8px 10px;

        font-size: 10px;

    }


    .toolbar-actions {

        flex-direction: column;

        align-items: stretch;

    }


    .search-box {

        width: 100%;

    }


    .create-btn {

        width: 100%;

    }


    .user-toast {

        left: 15px;

        right: 15px;

        min-width: auto;

    }

}


@media (max-width: 575.98px) {

    .user-management-page {

        padding-left: 5px;

        padding-right: 5px;

    }


    .page-header {

        border-radius: 12px;

        align-items: flex-start;

    }


    .header-text h2 {

        font-size: 17px;

    }


    .header-text p {

        display: none;

    }


    .header-create-btn {

        font-size: 0;

    }


    .header-create-btn i {

        font-size: 13px;

        margin: 0 !important;

    }


    .user-card {

        border-radius: 12px;

    }

}

</style>

@stop


@section('js')

@parent

<script>

$(document).ready(function () {

    const $container = $('#userTableContainer');

    const $search = $('#search');

    let debounceTimer;


    /* ============================================================
       CURRENT PARAMS
    ============================================================ */

    function currentParams(page) {

        return {

            search: $search.val(),

            page: page || 1

        };

    }


    /* ============================================================
       LOAD USERS
    ============================================================ */

    function loadUsers(page) {

        const params = currentParams(page);

        $container.addClass('loading');


        $.ajax({

            url: "{{ route('user.index') }}",

            method: 'GET',

            data: params,

            headers: {

                'X-Requested-With': 'XMLHttpRequest'

            },

            success: function (res) {

                $container.html(res.html);

                $('#totalUser').text(res.total);


                const qs = $.param(params);

                history.replaceState(
                    null,
                    '',
                    "{{ route('user.index') }}?" + qs
                );

            },

            error: function () {

                console.error(
                    'Failed to load user list.'
                );

            },

            complete: function () {

                $container.removeClass('loading');

            }

        });

    }


    /* ============================================================
       SEARCH
    ============================================================ */

    $search.on('keyup', function () {

        clearTimeout(debounceTimer);

        debounceTimer = setTimeout(function () {

            loadUsers(1);

        }, 400);

    });


    /* ============================================================
       PAGINATION
    ============================================================ */

    $(document).on(
        'click',
        '#userTableContainer .pagination a',
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


            loadUsers(page);

        }
    );


    /* ============================================================
       EDIT ROLE
    ============================================================ */

    $(document).on(
        'click',
        '.btn-edit-role',
        function () {

            let id = $(this).data('id');

            let name = $(this).data('name');

            let role = $(this).data('role');


            $('#updateRoleUserName').text(name);

            $('#selectUserRole').val(role);


            $('#updateRoleForm').attr(
                'action',
                "{{ url('user') }}/" + id + "/role"
            );

        }
    );


    /* ============================================================
       RESET 2FA
    ============================================================ */

    $(document).on(
        'click',
        '.btn-reset-2fa',
        function () {

            let id = $(this).data('id');

            let name = $(this).data('name');


            $('#reset2faUserName').text(name);


            $('#reset2faForm').attr(
                'action',
                "{{ url('user') }}/" + id + "/reset-2fa"
            );

        }
    );


    /* ============================================================
       DELETE USER
    ============================================================ */

    $(document).on(
        'click',
        '.btn-delete-user',
        function () {

            let id = $(this).data('id');

            let name = $(this).data('name');


            if (String(id) === String({{ auth()->id() }})) {

                $('#modalDeleteUser').modal('hide');

                $('#userSuccessToastMessage').text(
                    'អ្នកមិនអាចលុប Account ដែលកំពុង Login បានទេ។'
                );

                $('#userSuccessToast')
                    .removeClass('d-none')
                    .css(
                        'background',
                        'linear-gradient(135deg, #C0392B, #E74C3C)'
                    );


                setTimeout(function () {

                    $('#userSuccessToast')
                        .addClass('d-none')
                        .css('background', '');

                }, 4000);


                return;

            }


            $('#deleteUserName').text(name);


            $('#deleteUserForm').attr(
                'action',
                "{{ url('user') }}/" + id
            );

        }
    );


    /* ============================================================
       CREATE USER
    ============================================================ */

    $('#createUserForm').on(
        'submit',
        function (e) {

            e.preventDefault();


            const $form = $(this);

            const $btn = $('#btnSubmitCreateUser');

            const $alert = $('#createUserGeneralAlert');


            /* Reset validation */

            $form
                .find('.form-control, .custom-select')
                .removeClass('is-invalid');


            $form
                .find('.invalid-feedback')
                .text('');


            $alert
                .addClass('d-none')
                .text('');


            /* Loading */

            $btn
                .prop('disabled', true)
                .html(
                    '<i class="fas fa-spinner fa-spin mr-1"></i> កំពុងរក្សាទុក...'
                );


            $.ajax({

                url: $form.attr('action'),

                method: 'POST',

                data: $form.serialize(),

                headers: {

                    'X-Requested-With': 'XMLHttpRequest',

                    'Accept': 'application/json'

                },


                /* SUCCESS */

                success: function (res) {

                    $btn
                        .prop('disabled', false)
                        .html(
                            '<i class="fas fa-save mr-1"></i> រក្សាទុក'
                        );


                    $('#modalCreateUser')
                        .modal('hide');


                    $form[0].reset();


                    /* Refresh */

                    loadUsers(1);


                    /* Toast */

                    $('#userSuccessToastMessage')
                        .text(
                            res.message ||
                            'User created successfully'
                        );


                    $('#userSuccessToast')
                        .removeClass('d-none');


                    setTimeout(function () {

                        $('#userSuccessToast')
                            .addClass('d-none');

                    }, 5000);

                },


                /* ERROR */

                error: function (xhr) {

                    $btn
                        .prop('disabled', false)
                        .html(
                            '<i class="fas fa-save mr-1"></i> រក្សាទុក'
                        );


                    if (
                        xhr.status === 422 &&
                        xhr.responseJSON &&
                        xhr.responseJSON.errors
                    ) {

                        const errors =
                            xhr.responseJSON.errors;


                        $.each(
                            errors,
                            function (field, messages) {

                                const $input =
                                    $('#create_' + field);


                                $input
                                    .addClass('is-invalid');


                                $('#error_create_' + field)
                                    .text(messages[0]);

                            }
                        );

                    } else {

                        const msg =
                            (
                                xhr.responseJSON &&
                                xhr.responseJSON.message
                            )
                            ?
                                xhr.responseJSON.message
                            :
                                'An error occurred while creating the user.';


                        $alert
                            .removeClass('d-none')
                            .text(msg);

                    }

                }

            });

        }
    );


    /* ============================================================
       DELETE USER SUBMIT
    ============================================================ */

    $('#deleteUserForm').on(
        'submit',
        function (e) {

            e.preventDefault();


            const $form = $(this);

            const $btn = $form.find('button[type="submit"]');


            $btn
                .prop('disabled', true)
                .html(
                    '<i class="fas fa-spinner fa-spin mr-1"></i> កំពុងលុប...'
                );


            $.ajax({

                url: $form.attr('action'),

                method: 'POST',

                data: $form.serialize(),

                headers: {

                    'X-Requested-With': 'XMLHttpRequest',

                    'Accept': 'application/json'

                },


                success: function (res) {

                    $('#modalDeleteUser')
                        .modal('hide');


                    $btn
                        .prop('disabled', false)
                        .html(
                            '<i class="fas fa-trash-alt mr-1"></i> លុប'
                        );


                    loadUsers(1);


                    $('#userSuccessToastMessage')
                        .text(
                            res.message ||
                            'User deleted successfully'
                        );


                    $('#userSuccessToast')
                        .removeClass('d-none')
                        .css(
                            'background',
                            'linear-gradient(135deg, #006D36, #008747)'
                        );


                    setTimeout(function () {

                        $('#userSuccessToast')
                            .addClass('d-none');

                    }, 5000);

                },


                error: function (xhr) {

                    $btn
                        .prop('disabled', false)
                        .html(
                            '<i class="fas fa-trash-alt mr-1"></i> លុប'
                        );


                    $('#modalDeleteUser')
                        .modal('hide');


                    let msg =
                        (
                            xhr.responseJSON &&
                            xhr.responseJSON.message
                        )
                        ?
                            xhr.responseJSON.message
                        :
                            'មិនអាចលុបអ្នកប្រើប្រាស់បានទេ។';


                    $('#userSuccessToastMessage')
                        .text(msg);


                    $('#userSuccessToast')
                        .removeClass('d-none')
                        .css(
                            'background',
                            'linear-gradient(135deg, #C0392B, #E74C3C)'
                        );


                    setTimeout(function () {

                        $('#userSuccessToast')
                            .addClass('d-none')
                            .css('background', '');

                    }, 5000);

                }

            });

        }
    );

});

</script>

@stop