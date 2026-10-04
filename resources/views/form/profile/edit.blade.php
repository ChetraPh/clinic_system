@extends('adminlte::page')

@section('title', 'ព័ត៌មានផ្ទាល់ខ្លួន')

@section('content_header')
@stop

@section('content')

<div class="profile-page">

    {{-- Toast --}}
    <div class="toast-container-custom" id="toastContainer"></div>

    {{-- Page Header --}}
    <div class="page-header mb-4">
        <div class="page-header-left">
            <div class="page-header-icon">
                <i class="fas fa-user-circle"></i>
            </div>

            <div>
                <h2>ព័ត៌មានផ្ទាល់ខ្លួន</h2>
                <p>គ្រប់គ្រងព័ត៌មានគណនី និងសុវត្ថិភាពរបស់អ្នក</p>
            </div>
        </div>
    </div>

    <div class="row">

        {{-- ==========================================
             LEFT: PROFILE SUMMARY
        =========================================== --}}
        <div class="col-lg-4">

            {{-- Profile Card --}}
            <div class="profile-card text-center">

                <div class="profile-card-body">

                    <div class="avatar-wrap">

                        <img id="avatarPreview"
                            src="{{ $user->avatar ? route('profile.avatar', $user->id) . '?v=' . $user->updated_at->timestamp : asset('vendor/adminlte/dist/img/user2-160x160.jpg') }}"
                            class="avatar-img"
                            alt="Profile Avatar">

                        <label for="avatarInput"
                            class="avatar-edit-btn"
                            title="ប្តូររូបភាព">

                            <i class="fas fa-camera"></i>

                        </label>

                    </div>

                    <h4 class="profile-name">
                        {{ $user->name }}
                    </h4>

                    <span class="badge-success-soft">
                        <i class="fas fa-user-tag mr-1"></i>
                        {{ ucfirst($user->getRoleNames()->first() ?? '—') }}
                    </span>

                    <div class="profile-email">
                        <i class="far fa-envelope mr-1"></i>
                        {{ $user->email }}
                    </div>

                </div>

            </div>

            {{-- Account Security --}}
            <div class="profile-card mt-3">

                <div class="section-header">
                    <div class="section-header-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>

                    <div>
                        <h5>សុវត្ថិភាពគណនី</h5>
                        <span>Account Security</span>
                    </div>
                </div>

                <div class="profile-card-body">

                    <div class="security-status">

                        <div>
                            <div class="security-title">
                                <i class="fas fa-lock mr-2"></i>
                                Two-Factor Authentication
                            </div>

                            <div class="security-description">
                                ការការពារគណនីដោយប្រើការផ្ទៀងផ្ទាត់ពីរជំហាន
                            </div>
                        </div>

                        @if($user->google2fa_enabled)

                            <span class="status-badge status-enabled">
                                <i class="fas fa-check-circle mr-1"></i>
                                បើក
                            </span>

                        @else

                            <span class="status-badge status-disabled">
                                <i class="fas fa-times-circle mr-1"></i>
                                បិទ
                            </span>

                        @endif

                    </div>

                    <div class="security-note">
                        <i class="fas fa-info-circle mr-2"></i>
                        2FA ជាការចាំបាច់សម្រាប់គណនីទាំងអស់ក្នុងប្រព័ន្ធនេះ។
                    </div>

                </div>

            </div>

        </div>


        {{-- ==========================================
             RIGHT: PROFILE INFORMATION
        =========================================== --}}
        <div class="col-lg-8">

            {{-- General Information --}}
            <div class="profile-card">

                <div class="section-header">

                    <div class="section-header-icon">
                        <i class="fas fa-user-edit"></i>
                    </div>

                    <div>
                        <h5>ព័ត៌មានទូទៅ</h5>
                        <span>General Information</span>
                    </div>

                </div>

                <div class="profile-card-body">

                    <form id="profileInfoForm"
                        action="{{ route('profile.update') }}"
                        method="POST"
                        enctype="multipart/form-data">

                        @csrf
                        @method('PUT')

                        <input type="file"
                            name="avatar"
                            id="avatarInput"
                            accept="image/*"
                            class="d-none">

                        {{-- Basic Information --}}
                        <div class="form-section-title">
                            <i class="fas fa-id-card mr-2"></i>
                            ព័ត៌មានគណនី
                        </div>

                        <div class="form-row">

                            <div class="form-group col-md-6">

                                <label>
                                    ឈ្មោះ (Full Name)
                                </label>

                                <div class="input-wrap">
                                    <i class="fas fa-user"></i>

                                    <input type="text"
                                        name="name"
                                        id="name"
                                        class="form-control"
                                        value="{{ old('name', $user->name) }}"
                                        required>
                                </div>

                                <div class="invalid-feedback"
                                    id="error_name"></div>

                            </div>


                            <div class="form-group col-md-6">

                                <label>
                                    អ៊ីមែល (Email)
                                </label>

                                <div class="input-wrap">
                                    <i class="fas fa-envelope"></i>

                                    <input type="email"
                                        name="email"
                                        id="email"
                                        class="form-control"
                                        value="{{ old('email', $user->email) }}"
                                        required>
                                </div>

                                <div class="invalid-feedback"
                                    id="error_email"></div>

                            </div>

                        </div>


                        <div class="form-row">

                            <div class="form-group col-md-6">

                                <label>
                                    ឈ្មោះអ្នកប្រើប្រាស់ (Username)
                                </label>

                                <div class="input-wrap">
                                    <i class="fas fa-at"></i>

                                    <input type="text"
                                        name="username"
                                        id="username"
                                        class="form-control"
                                        value="{{ old('username', $user->username) }}"
                                        required>
                                </div>

                                <div class="invalid-feedback"
                                    id="error_username"></div>

                            </div>


                            <div class="form-group col-md-6">

                                <label>
                                    លេខទូរស័ព្ទ (Phone)
                                </label>

                                <div class="input-wrap">
                                    <i class="fas fa-phone"></i>

                                    <input type="text"
                                        name="phone"
                                        id="phone"
                                        class="form-control"
                                        value="{{ old('phone', $user->phone) }}"
                                        placeholder="0XX XXX XXXX">
                                </div>

                                <div class="invalid-feedback"
                                    id="error_phone"></div>

                            </div>

                        </div>


                        {{-- Professional Credentials --}}
                        <div class="professional-box mt-2">

                            <div class="professional-header">

                                <div class="professional-icon">
                                    <i class="fas fa-user-md"></i>
                                </div>

                                <div>
                                    <h6>
                                        លក្ខណសម្បត្តិវិជ្ជាជីវៈ
                                    </h6>

                                    <span>
                                        Professional Credentials
                                    </span>
                                </div>

                            </div>

                            <div class="professional-body">

                                <div class="form-row">

                                    <div class="form-group col-md-6">

                                        <label>
                                            ដេប៉ាតឺម៉ង់ (Department)
                                        </label>

                                        <div class="input-wrap">

                                            <i class="fas fa-building"></i>

                                            <select name="department_id"
                                                id="department_id"
                                                class="form-control">

                                                <option value="">
                                                    -- ជ្រើសរើសដេប៉ាតឺម៉ង់ --
                                                </option>

                                                @foreach($departments as $dept)

                                                    <option value="{{ $dept->department_id }}"
                                                        {{ old('department_id', $user->department_id) == $dept->department_id ? 'selected' : '' }}>

                                                        {{ $dept->department_name }}

                                                    </option>

                                                @endforeach

                                            </select>

                                        </div>

                                        <div class="invalid-feedback"
                                            id="error_department_id"></div>

                                    </div>


                                    <div class="form-group col-md-6">

                                        <label>
                                            ជំនាញ (Specialization)
                                        </label>

                                        <div class="input-wrap">

                                            <i class="fas fa-stethoscope"></i>

                                            <input type="text"
                                                name="specialization"
                                                id="specialization"
                                                class="form-control"
                                                value="{{ old('specialization', $user->specialization) }}"
                                                placeholder="ឧ. ជំងឺទូទៅ, ជំងឺផ្លូវដង្ហើម, ជំងឺស្បែក, ជំងឺផ្លូវចិត្ត">

                                        </div>

                                        <div class="invalid-feedback"
                                            id="error_specialization"></div>

                                    </div>

                                </div>

                            </div>

                        </div>


                        <div class="form-actions mt-3">

                            <button type="submit"
                                class="btn-save"
                                id="btnSaveProfile">

                                <i class="fas fa-save mr-2"></i>
                                រក្សាទុកព័ត៌មាន

                            </button>

                        </div>

                    </form>

                </div>

            </div>


            {{-- ==========================================
                 CHANGE PASSWORD
            =========================================== --}}
            <div class="profile-card mt-3">

                <div class="section-header">

                    <div class="section-header-icon password-icon">
                        <i class="fas fa-key"></i>
                    </div>

                    <div>
                        <h5>ផ្លាស់ប្តូរពាក្យសម្ងាត់</h5>
                        <span>Change Password</span>
                    </div>

                </div>

                <div class="profile-card-body">

                    <form id="profilePasswordForm"
                        action="{{ route('profile.password.update') }}"
                        method="POST">

                        @csrf
                        @method('PUT')

                        <div class="form-row">

                            <div class="form-group col-md-4">

                                <label>
                                    ពាក្យសម្ងាត់បច្ចុប្បន្ន
                                </label>

                                <div class="input-wrap">

                                    <i class="fas fa-lock"></i>

                                    <input type="password"
                                        name="current_password"
                                        id="current_password"
                                        class="form-control"
                                        required>

                                </div>

                                <div class="invalid-feedback"
                                    id="error_current_password"></div>

                            </div>


                            <div class="form-group col-md-4">

                                <label>
                                    ពាក្យសម្ងាត់ថ្មី
                                </label>

                                <div class="input-wrap">

                                    <i class="fas fa-key"></i>

                                    <input type="password"
                                        name="password"
                                        id="password"
                                        class="form-control"
                                        minlength="8"
                                        required>

                                </div>

                                <div class="invalid-feedback"
                                    id="error_password"></div>

                            </div>


                            <div class="form-group col-md-4">

                                <label>
                                    បញ្ជាក់ពាក្យសម្ងាត់ថ្មី
                                </label>

                                <div class="input-wrap">

                                    <i class="fas fa-check-double"></i>

                                    <input type="password"
                                        name="password_confirmation"
                                        id="password_confirmation"
                                        class="form-control"
                                        minlength="8"
                                        required>

                                </div>

                            </div>

                        </div>


                        <div class="password-hint">
                            <i class="fas fa-info-circle mr-2"></i>
                            ពាក្យសម្ងាត់ថ្មីត្រូវមានយ៉ាងតិច 8 តួអក្សរ។
                        </div>


                        <div class="form-actions mt-3">

                            <button type="submit"
                                class="btn-password"
                                id="btnSavePassword">

                                <i class="fas fa-key mr-2"></i>
                                ផ្លាស់ប្តូរពាក្យសម្ងាត់

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@stop


@section('css')

<style>

    :root {
        --hospital-green: #006D36;
        --hospital-dark-green: #00552B;
        --hospital-green-2: #008747;
        --hospital-light-green: #E8F5EE;
        --hospital-bg: #F5F7F6;
        --hospital-border: #E7ECE9;
        --hospital-text: #1F2A24;
        --hospital-muted: #7A8780;
    }

    body {
        background: var(--hospital-bg);
    }

    .profile-page {
        padding: 10px 0 30px;
    }


    /* =========================
       PAGE HEADER
    ========================= */

    .page-header {
        background: linear-gradient(
            135deg,
            #006D36 0%,
            #008747 100%
        );

        border-radius: 16px;
        padding: 24px 28px;
        color: #fff;
        box-shadow: 0 6px 18px rgba(0, 109, 54, 0.12);
    }

    .page-header-left {
        display: flex;
        align-items: center;
    }

    .page-header-icon {
        width: 54px;
        height: 54px;
        border-radius: 14px;
        background: rgba(255, 255, 255, 0.18);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 16px;
        font-size: 23px;
    }

    .page-header h2 {
        margin: 0 0 5px;
        font-size: 24px;
        font-weight: 700;
    }

    .page-header p {
        margin: 0;
        font-size: 13px;
        color: rgba(255, 255, 255, 0.82);
    }


    /* =========================
       PROFILE CARD
    ========================= */

    .profile-card {
        background: #fff;
        border: 1px solid var(--hospital-border);
        border-radius: 16px;
        box-shadow: 0 4px 15px rgba(31, 42, 36, 0.05);
        overflow: hidden;
    }

    .profile-card-body {
        padding: 24px;
    }


    /* =========================
       AVATAR
    ========================= */

    .avatar-wrap {
        position: relative;
        width: 120px;
        height: 120px;
        margin: 0 auto;
    }

    .avatar-img {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid #E8F5EE;
        box-shadow: 0 5px 15px rgba(0, 109, 54, 0.12);
    }

    .avatar-edit-btn {
        position: absolute;
        bottom: 2px;
        right: 0;
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: var(--hospital-green);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        margin: 0;
        border: 3px solid #fff;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.18);
        transition: all 0.2s ease;
    }

    .avatar-edit-btn:hover {
        background: var(--hospital-dark-green);
        transform: scale(1.05);
    }

    .profile-name {
        color: var(--hospital-text);
        font-size: 19px;
        margin: 17px 0 8px;
        font-weight: 700;
    }

    .badge-success-soft {
        display: inline-flex;
        align-items: center;
        background: var(--hospital-light-green);
        color: var(--hospital-green);
        border-radius: 20px;
        padding: 5px 11px;
        font-size: 11px;
        font-weight: 600;
    }

    .profile-email {
        margin-top: 11px;
        color: var(--hospital-muted);
        font-size: 12px;
        word-break: break-word;
    }


    /* =========================
       SECTION HEADER
    ========================= */

    .section-header {
        display: flex;
        align-items: center;
        padding: 17px 22px;
        border-bottom: 1px solid var(--hospital-border);
        background: #fff;
    }

    .section-header-icon {
        width: 38px;
        height: 38px;
        border-radius: 10px;
        background: var(--hospital-light-green);
        color: var(--hospital-green);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 12px;
        font-size: 15px;
        flex-shrink: 0;
    }

    .section-header-icon.password-icon {
        background: #F1F7F4;
    }

    .section-header h5 {
        margin: 0 0 2px;
        font-size: 15px;
        font-weight: 700;
        color: var(--hospital-text);
    }

    .section-header span {
        display: block;
        color: var(--hospital-muted);
        font-size: 10px;
    }


    /* =========================
       SECURITY
    ========================= */

    .security-status {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 15px;
    }

    .security-title {
        color: var(--hospital-text);
        font-size: 12px;
        font-weight: 700;
    }

    .security-title i {
        color: var(--hospital-green);
    }

    .security-description {
        color: var(--hospital-muted);
        font-size: 10px;
        margin-top: 5px;
        line-height: 1.5;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 10px;
        font-weight: 700;
        white-space: nowrap;
    }

    .status-enabled {
        background: var(--hospital-light-green);
        color: var(--hospital-green);
    }

    .status-disabled {
        background: #F1F2F3;
        color: #6C757D;
    }

    .security-note {
        margin-top: 17px;
        padding: 10px 12px;
        background: #F8FAF9;
        border: 1px solid var(--hospital-border);
        border-radius: 9px;
        color: var(--hospital-muted);
        font-size: 10px;
        line-height: 1.5;
    }

    .security-note i {
        color: var(--hospital-green);
    }


    /* =========================
       FORM
    ========================= */

    .form-section-title {
        color: var(--hospital-text);
        font-size: 12px;
        font-weight: 700;
        margin-bottom: 15px;
    }

    .form-section-title i {
        color: var(--hospital-green);
    }

    .form-group {
        margin-bottom: 17px;
    }

    .form-group label {
        display: block;
        color: #3D4943;
        font-size: 11px;
        font-weight: 700;
        margin-bottom: 7px;
    }

    .input-wrap {
        position: relative;
    }

    .input-wrap > i {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: #9AA59F;
        font-size: 12px;
        z-index: 2;
        pointer-events: none;
    }

    .input-wrap .form-control {
        padding-left: 34px;
    }

    .form-control {
        height: 40px;
        border: 1px solid var(--hospital-border);
        border-radius: 9px;
        color: var(--hospital-text);
        font-size: 12px;
        background: #fff;
        box-shadow: none;
        transition: all 0.2s ease;
    }

    .form-control:focus {
        border-color: #82B79A;
        box-shadow: 0 0 0 3px rgba(0, 109, 54, 0.08);
    }

    select.form-control {
        cursor: pointer;
    }

    .form-control::placeholder {
        color: #AAB3AE;
        font-size: 11px;
    }

    .invalid-feedback {
        font-size: 10px;
        margin-top: 5px;
    }


    /* =========================
       PROFESSIONAL CREDENTIALS
    ========================= */

    .professional-box {
        border: 1px solid #DDEBE3;
        border-radius: 13px;
        background: #FBFDFC;
        overflow: hidden;
    }

    .professional-header {
        display: flex;
        align-items: center;
        padding: 13px 15px;
        background: var(--hospital-light-green);
        border-bottom: 1px solid #DDEBE3;
    }

    .professional-icon {
        width: 35px;
        height: 35px;
        border-radius: 9px;
        background: #fff;
        color: var(--hospital-green);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 10px;
        font-size: 14px;
    }

    .professional-header h6 {
        margin: 0 0 2px;
        color: var(--hospital-text);
        font-size: 12px;
        font-weight: 700;
    }

    .professional-header span {
        color: var(--hospital-muted);
        font-size: 9px;
    }

    .professional-body {
        padding: 16px 15px 3px;
    }


    /* =========================
       BUTTONS
    ========================= */

    .form-actions {
        display: flex;
        align-items: center;
    }

    .btn-save,
    .btn-password {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 9px;
        padding: 9px 17px;
        font-size: 12px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .btn-save {
        background: var(--hospital-green);
        border: 1px solid var(--hospital-green);
        color: #fff;
    }

    .btn-save:hover {
        background: var(--hospital-dark-green);
        border-color: var(--hospital-dark-green);
        color: #fff;
        transform: translateY(-1px);
        box-shadow: 0 4px 10px rgba(0, 109, 54, 0.15);
    }

    .btn-password {
        background: #fff;
        border: 1px solid #AFCFBC;
        color: var(--hospital-green);
    }

    .btn-password:hover {
        background: var(--hospital-light-green);
        border-color: var(--hospital-green);
        color: var(--hospital-dark-green);
    }

    .btn-save:disabled,
    .btn-password:disabled {
        opacity: 0.7;
        cursor: not-allowed;
        transform: none;
    }


    /* =========================
       PASSWORD HINT
    ========================= */

    .password-hint {
        background: #F8FAF9;
        border: 1px solid var(--hospital-border);
        border-radius: 9px;
        padding: 9px 12px;
        color: var(--hospital-muted);
        font-size: 10px;
    }

    .password-hint i {
        color: var(--hospital-green);
    }


    /* =========================
       TOAST
    ========================= */

    .toast-container-custom {
        position: fixed;
        top: 75px;
        right: 25px;
        z-index: 9999;
        width: 340px;
        max-width: calc(100% - 30px);
    }

    .toast-custom {
        display: flex;
        align-items: center;
        gap: 10px;
        background: #fff;
        border-radius: 10px;
        padding: 13px 15px;
        margin-bottom: 10px;
        box-shadow: 0 8px 25px rgba(31, 42, 36, 0.14);
        border-left: 4px solid var(--hospital-green);
        color: var(--hospital-text);
        font-size: 12px;
        animation: toastSlide 0.3s ease;
    }

    .toast-custom.success {
        border-left-color: var(--hospital-green);
    }

    .toast-custom.success i {
        color: var(--hospital-green);
    }

    .toast-custom.error {
        border-left-color: #D93025;
    }

    .toast-custom.error i {
        color: #D93025;
    }

    @keyframes toastSlide {
        from {
            opacity: 0;
            transform: translateX(20px);
        }

        to {
            opacity: 1;
            transform: translateX(0);
        }
    }


    /* =========================
       RESPONSIVE
    ========================= */

    @media (max-width: 991.98px) {

        .col-lg-4 {
            margin-bottom: 18px;
        }

        .profile-card-body {
            padding: 20px;
        }

    }


    @media (max-width: 767.98px) {

        .profile-page {
            padding-top: 5px;
        }

        .page-header {
            padding: 20px;
            border-radius: 14px;
        }

        .page-header h2 {
            font-size: 20px;
        }

        .page-header p {
            font-size: 11px;
        }

        .page-header-icon {
            width: 46px;
            height: 46px;
            font-size: 20px;
            margin-right: 12px;
        }

        .section-header {
            padding: 15px 17px;
        }

        .profile-card-body {
            padding: 17px;
        }

        .form-row {
            margin-left: 0;
            margin-right: 0;
        }

        .form-row > .form-group {
            padding-left: 0;
            padding-right: 0;
        }

    }


    @media (max-width: 575.98px) {

        .profile-page {
            padding-bottom: 20px;
        }

        .avatar-wrap,
        .avatar-img {
            width: 105px;
            height: 105px;
        }

        .avatar-edit-btn {
            width: 32px;
            height: 32px;
        }

        .profile-name {
            font-size: 17px;
        }

        .security-status {
            flex-direction: column;
        }

        .status-badge {
            align-self: flex-start;
        }

        .btn-save,
        .btn-password {
            width: 100%;
        }

        .form-actions {
            width: 100%;
        }

        .professional-header {
            align-items: flex-start;
        }

    }

</style>

@stop


@section('js')

@parent

<script>

    $(document).ready(function () {

        /* =========================
           TOAST
        ========================= */

        function showToast(msg, type = 'success') {

            const icon = type === 'success'
                ? 'fa-check-circle'
                : 'fa-times-circle';

            const $toast = $(
                '<div class="toast-custom ' + type + '">' +
                    '<i class="fas ' + icon + '"></i>' +
                    '<span>' + msg + '</span>' +
                '</div>'
            );

            $('#toastContainer').append($toast);

            setTimeout(function () {

                $toast.fadeOut(300, function () {
                    $toast.remove();
                });

            }, 4000);
        }


        /* =========================
           CLEAR ERRORS
        ========================= */

        function clearErrors($form) {

            $form.find('.form-control')
                .removeClass('is-invalid');

            $form.find('.invalid-feedback')
                .text('');
        }


        /* =========================
           SHOW ERRORS
        ========================= */

        function showErrors($form, errors) {

            $.each(errors, function (field, messages) {

                $('#' + field)
                    .addClass('is-invalid');

                $('#error_' + field)
                    .text(messages[0]);

            });
        }


        /* =========================
           AVATAR PREVIEW
        ========================= */

        $('#avatarInput').on('change', function () {

            const file = this.files[0];

            if (!file) {
                return;
            }

            const reader = new FileReader();

            reader.onload = function (e) {

                $('#avatarPreview')
                    .attr('src', e.target.result);

            };

            reader.readAsDataURL(file);
        });


        /* =========================
           UPDATE PROFILE INFO
        ========================= */

        $('#profileInfoForm').on('submit', function (e) {

            e.preventDefault();

            const $form = $(this);
            const $btn = $('#btnSaveProfile');

            clearErrors($form);

            $btn
                .prop('disabled', true)
                .html(
                    '<i class="fas fa-spinner fa-spin mr-2"></i>' +
                    'កំពុងរក្សាទុក...'
                );


            $.ajax({

                url: $form.attr('action'),

                method: 'POST',

                data: new FormData(this),

                processData: false,

                contentType: false,

                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                },


                success: function (res) {

                    showToast(
                        res.message || 'បានរក្សាទុកព័ត៌មាន'
                    );


                    /* Update navbar name */

                    $('#navbarUserName, #dropdownUserName')
                        .text(res.name);


                    /* Update navbar department */

                    if (res.department_name !== undefined) {

                        $('#navbarDepartment, #dropdownUserDepartment')
                            .text(
                                res.department_name ||
                                'No Department'
                            );

                    }


                    /* Update navbar avatar */

                    if (res.avatar_url) {

                        $('#navbarUserAvatar, #dropdownUserAvatar')
                            .attr(
                                'src',
                                res.avatar_url
                            );

                    }

                },


                error: function (xhr) {

                    if (
                        xhr.status === 422 &&
                        xhr.responseJSON &&
                        xhr.responseJSON.errors
                    ) {

                        showErrors(
                            $form,
                            xhr.responseJSON.errors
                        );

                    } else {

                        showToast(
                            'មានបញ្ហាកើតឡើង សូមព្យាយាមម្តងទៀត',
                            'error'
                        );

                    }

                },


                complete: function () {

                    $btn
                        .prop('disabled', false)
                        .html(
                            '<i class="fas fa-save mr-2"></i>' +
                            'រក្សាទុកព័ត៌មាន'
                        );

                }

            });

        });


        /* =========================
           UPDATE PASSWORD
        ========================= */

        $('#profilePasswordForm').on('submit', function (e) {

            e.preventDefault();

            const $form = $(this);
            const $btn = $('#btnSavePassword');

            clearErrors($form);

            $btn
                .prop('disabled', true)
                .html(
                    '<i class="fas fa-spinner fa-spin mr-2"></i>' +
                    'កំពុងផ្លាស់ប្តូរ...'
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

                    showToast(
                        res.message ||
                        'បានផ្លាស់ប្តូរពាក្យសម្ងាត់'
                    );

                    $form[0].reset();

                },


                error: function (xhr) {

                    if (
                        xhr.status === 422 &&
                        xhr.responseJSON &&
                        xhr.responseJSON.errors
                    ) {

                        showErrors(
                            $form,
                            xhr.responseJSON.errors
                        );

                    } else {

                        showToast(
                            'មានបញ្ហាកើតឡើង សូមព្យាយាមម្តងទៀត',
                            'error'
                        );

                    }

                },


                complete: function () {

                    $btn
                        .prop('disabled', false)
                        .html(
                            '<i class="fas fa-key mr-2"></i>' +
                            'ផ្លាស់ប្តូរពាក្យសម្ងាត់'
                        );

                }

            });

        });

    });

</script>

@stop