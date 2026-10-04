@extends('adminlte::page')

@section('title', 'QR Code Settings')

@section('content')

<style>
    :root {
        --qr-green: #006D36;
        --qr-green-dark: #00552B;
        --qr-green-light: #E8F5EE;
        --qr-bg: #F5F7F6;
        --qr-border: #E7ECE9;
        --qr-text: #1F2A24;
        --qr-muted: #7A8780;
    }

    .qr-settings-page {
        padding-top: 8px;
        padding-bottom: 25px;
    }

    /* Header */
    .settings-header {
        background: linear-gradient(135deg, #006D36 0%, #008747 100%);
        border-radius: 16px;
        padding: 24px 28px;
        margin-bottom: 22px;
        box-shadow: 0 8px 22px rgba(0, 109, 54, 0.16);
        color: #fff;
    }

    .settings-header-content {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
    }

    .settings-title-wrapper {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .settings-title-icon {
        width: 52px;
        height: 52px;
        border-radius: 13px;
        background: rgba(255, 255, 255, 0.16);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
    }

    .settings-title {
        margin: 0;
        font-size: 23px;
        font-weight: 700;
        color: #fff;
    }

    .settings-subtitle {
        margin: 4px 0 0;
        font-size: 13px;
        color: rgba(255, 255, 255, 0.82);
    }

    .btn-save-settings {
        border: 0;
        background: #fff;
        color: var(--qr-green);
        border-radius: 10px;
        padding: 11px 20px;
        font-weight: 700;
        transition: all .2s ease;
        box-shadow: 0 4px 12px rgba(0, 0, 0, .08);
    }

    .btn-save-settings:hover {
        background: #f3f8f5;
        color: var(--qr-green-dark);
        transform: translateY(-1px);
    }

    .btn-save-settings:disabled {
        opacity: .85;
        cursor: not-allowed;
    }

    /* Main Cards */
    .settings-card {
        border: 1px solid var(--qr-border) !important;
        border-radius: 16px !important;
        background: #fff;
        box-shadow: 0 5px 18px rgba(31, 42, 36, 0.05) !important;
        overflow: hidden;
    }

    .settings-card .card-body {
        padding: 25px;
    }

    /* Section */
    .section-title {
        display: flex;
        align-items: center;
        gap: 13px;
    }

    .section-icon {
        width: 42px;
        height: 42px;
        border-radius: 11px;
        background: var(--qr-green-light);
        color: var(--qr-green);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        font-size: 16px;
    }

    .section-title h5 {
        color: var(--qr-text);
        font-size: 16px;
        font-weight: 700;
    }

    .section-title small {
        color: var(--qr-muted) !important;
        font-size: 11px;
    }

    /* Mode Cards */
    .mode-card {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 18px;
        border: 1px solid var(--qr-border);
        border-radius: 14px;
        cursor: pointer;
        background: #fff;
        transition: all .2s ease;
        min-height: 82px;
    }

    .mode-card:hover {
        border-color: rgba(0, 109, 54, .35);
        background: #FAFCFB;
        transform: translateY(-1px);
    }

    .mode-card.active {
        border: 2px solid var(--qr-green);
        background: var(--qr-green-light);
        box-shadow: 0 4px 12px rgba(0, 109, 54, .08);
    }

    .mode-icon {
        width: 45px;
        height: 45px;
        border-radius: 12px;
        background: var(--qr-green-light);
        color: var(--qr-green);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        flex-shrink: 0;
    }

    .mode-card.active .mode-icon {
        background: #fff;
    }

    .mode-card .font-weight-bold {
        color: var(--qr-text);
        font-size: 13px;
    }

    .mode-card small {
        font-size: 11px;
        color: var(--qr-muted) !important;
    }

    .mode-check {
        color: var(--qr-green);
        display: none;
        font-size: 20px;
        margin-left: auto;
    }

    .mode-card.active .mode-check {
        display: block;
    }

    /* Info Alert */
    .info-alert {
        padding: 13px 15px;
        border-radius: 11px;
        background: var(--qr-green-light);
        border: 1px solid #D4EBDD;
        color: #496256;
        font-size: 12px;
        line-height: 1.6;
    }

    .info-alert i {
        color: var(--qr-green);
    }

    .info-alert strong {
        color: var(--qr-green-dark);
    }

    /* Form */
    .form-group {
        margin-bottom: 19px;
    }

    .form-group label {
        color: var(--qr-text);
        font-size: 13px;
        font-weight: 600;
        margin-bottom: 7px;
    }

    .form-control {
        min-height: 44px;
        border: 1px solid var(--qr-border);
        border-radius: 10px;
        color: var(--qr-text);
        font-size: 13px;
        box-shadow: none;
        transition: all .2s ease;
    }

    .form-control:focus {
        border-color: var(--qr-green);
        box-shadow: 0 0 0 3px rgba(0, 109, 54, .08);
    }

    .form-control::placeholder {
        color: #A7B0AB;
    }

    .form-group .text-danger {
        font-size: 12px;
    }

    .form-group small.text-muted {
        color: var(--qr-muted) !important;
        font-size: 11px;
    }

    /* QR Upload */
    .qr-upload-box {
        text-align: center;
        padding: 25px;
        border: 1px dashed #CBD8D1;
        border-radius: 15px;
        background: #FAFCFB;
    }

    .qr-preview {
        width: 220px;
        height: 220px;
        margin: auto;
        padding: 10px;
        background: #fff;
        border: 1px solid var(--qr-border);
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(31, 42, 36, .04);
    }

    .qr-preview img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
    }

    .btn-outline-success {
        color: var(--qr-green);
        border-color: var(--qr-green);
        border-radius: 9px;
        font-weight: 600;
        font-size: 12px;
    }

    .btn-outline-success:hover {
        background: var(--qr-green);
        border-color: var(--qr-green);
        color: #fff;
    }

    /* Bakong */
    .bakong-box {
        background: #FAFCFB;
        border: 1px solid var(--qr-border);
        border-radius: 12px;
        padding: 18px;
    }

    .merchant-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: var(--qr-green-light);
        color: var(--qr-green-dark);
        border-radius: 20px;
        padding: 5px 10px;
        font-size: 10px;
        font-weight: 700;
    }

    /* Footer Note */
    .settings-note {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        margin-top: 5px;
        padding: 12px 14px;
        background: #F8FAF9;
        border: 1px solid var(--qr-border);
        border-radius: 10px;
        color: var(--qr-muted);
        font-size: 11px;
        line-height: 1.6;
    }

    .settings-note i {
        color: var(--qr-green);
        margin-top: 2px;
    }

    /* Toastr */
    #toast-container > .toast-success {
        background-image: none !important;
        background: linear-gradient(135deg, #006D36, #008747) !important;
        opacity: 1;
    }

    #toast-container > .toast-error {
        background-image: none !important;
        background: linear-gradient(135deg, #B42318, #D92D20) !important;
        opacity: 1;
    }

    #toast-container > .toast {
        border-radius: 10px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, .12);
    }

    /* Responsive */
    @media (max-width: 991.98px) {
        .settings-header {
            padding: 20px;
        }

        .settings-card .card-body {
            padding: 22px;
        }
    }

    @media (max-width: 767.98px) {
        .settings-header-content {
            align-items: flex-start;
            flex-direction: column;
        }

        .btn-save-settings {
            width: 100%;
        }

        .settings-title {
            font-size: 20px;
        }

        .mode-card {
            padding: 15px;
        }

        .qr-preview {
            width: 195px;
            height: 195px;
        }
    }

    @media (max-width: 575.98px) {
        .settings-header {
            border-radius: 13px;
            padding: 17px;
        }

        .settings-title-icon {
            width: 45px;
            height: 45px;
        }

        .settings-card .card-body {
            padding: 16px;
        }

        .qr-upload-box {
            padding: 18px;
        }

        .qr-preview {
            width: 175px;
            height: 175px;
        }
    }
</style>

<div class="qr-settings-page">

    {{-- Header --}}
    <div class="settings-header">
        <div class="settings-header-content">

            <div class="settings-title-wrapper">
                <div class="settings-title-icon">
                    <i class="fas fa-qrcode"></i>
                </div>

                <div>
                    <h2 class="settings-title">
                        ការកំណត់ QR Code
                    </h2>

                    <p class="settings-subtitle">
                        QR Code Settings · កំណត់វិធីទូទាត់តាម QR Code
                    </p>
                </div>
            </div>

            <button type="submit"
                    form="qrSettingForm"
                    class="btn-save-settings">
                <i class="fas fa-save mr-2"></i>
                រក្សាទុក
            </button>

        </div>
    </div>

    <form id="qrSettingForm"
          action="{{ route('settingsqrcode.update') }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf

        {{-- QR SETUP MODE --}}
        <div class="card settings-card mb-4">
            <div class="card-body">

                <div class="section-title mb-4">

                    <div class="section-icon">
                        <i class="fas fa-sliders-h"></i>
                    </div>

                    <div>
                        <h5 class="mb-0">
                            វិធីកំណត់ QR
                        </h5>

                        <small>
                            ជ្រើសរើសរបៀបដែលប្រព័ន្ធនឹងប្រើ QR
                        </small>
                    </div>

                </div>

                <div class="row">

                    {{-- MANUAL --}}
                    <div class="col-md-6 mb-3 mb-md-0">

                        <label class="mode-card w-100 mb-0
                            {{ optional($qrSetting)->mode !== 'bakong' ? 'active' : '' }}"
                            id="labelModeManual">

                            <input type="radio"
                                   name="mode"
                                   value="manual"
                                   class="d-none"
                                   autocomplete="off"
                                   {{ optional($qrSetting)->mode !== 'bakong' ? 'checked' : '' }}>

                            <div class="mode-icon">
                                <i class="fas fa-image"></i>
                            </div>

                            <div class="flex-grow-1">

                                <div class="font-weight-bold">
                                    QR ដោយផ្ទាល់
                                </div>

                                <small>
                                    Upload QR ដែលមានស្រាប់ពីធនាគារ
                                </small>

                            </div>

                            <i class="fas fa-check-circle mode-check"></i>

                        </label>

                    </div>

                    {{-- BAKONG --}}
                    <div class="col-md-6">

                        <label class="mode-card w-100 mb-0
                            {{ optional($qrSetting)->mode === 'bakong' ? 'active' : '' }}"
                            id="labelModeBakong">

                            <input type="radio"
                                   name="mode"
                                   value="bakong"
                                   class="d-none"
                                   autocomplete="off"
                                   {{ optional($qrSetting)->mode === 'bakong' ? 'checked' : '' }}>

                            <div class="mode-icon">
                                <i class="fas fa-bolt"></i>
                            </div>

                            <div class="flex-grow-1">

                                <div class="font-weight-bold">
                                    Bakong API
                                </div>

                                <small>
                                    បង្កើត Dynamic KHQR តាម Invoice
                                </small>

                            </div>

                            <i class="fas fa-check-circle mode-check"></i>

                        </label>

                    </div>

                </div>

                <div class="info-alert mt-3">

                    <i class="fas fa-info-circle mr-2"></i>

                    <span id="manualInfo">
                        <strong>Manual:</strong>
                        ប្រើ QR ថេរដែលបានពីធនាគារ។
                        មិនអាចផ្ទៀងផ្ទាត់ការទូទាត់ដោយស្វ័យប្រវត្តិបានទេ។
                    </span>

                    <span id="bakongInfo" class="d-none">
                        <strong>Bakong API:</strong>
                        ត្រូវការគណនី Bakong និង API Token
                        ដើម្បីបង្កើត Dynamic KHQR។
                    </span>

                </div>

            </div>
        </div>


        {{-- MANUAL QR --}}
        <div id="manualModeSection"
             class="{{ optional($qrSetting)->mode === 'bakong' ? 'd-none' : '' }}">

            <div class="card settings-card mb-4">

                <div class="card-body">

                    <div class="section-title mb-4">

                        <div class="section-icon">
                            <i class="fas fa-qrcode"></i>
                        </div>

                        <div>
                            <h5 class="mb-0">
                                QR Code ដោយផ្ទាល់
                            </h5>

                            <small>
                                បញ្ចូល QR Code ដែលបានពីធនាគារ
                            </small>
                        </div>

                    </div>

                    <div class="row align-items-center">

                        <div class="col-lg-5 mb-4 mb-lg-0">

                            <div class="qr-upload-box">

                                <div class="qr-preview">

                                    <img src="{{ optional($qrSetting)->manual_qr_image
                                        ? Storage::url($qrSetting->manual_qr_image)
                                        : 'https://placehold.co/220x220?text=QR+Code' }}"
                                        id="manualQrPreview"
                                        alt="QR Code">

                                </div>

                                <label for="manualQrInput"
                                       class="btn btn-outline-success mt-3 mb-2">

                                    <i class="fas fa-upload mr-2"></i>
                                    ជ្រើសរើស QR

                                </label>

                                <input type="file"
                                       name="manual_qr_image"
                                       id="manualQrInput"
                                       class="d-none"
                                       accept="image/png,image/jpeg">

                                <small class="d-block text-muted">
                                    PNG / JPG · អតិបរមា 2MB
                                </small>

                            </div>

                        </div>

                        <div class="col-lg-7">

                            <div class="form-group">

                                <label>
                                    ឈ្មោះគណនី
                                    <span class="text-danger">*</span>
                                </label>

                                <input type="text"
                                       name="account_name"
                                       class="form-control"
                                       value="{{ optional($qrSetting)->account_name }}"
                                       placeholder="ឧ. ABC Hospital">

                            </div>

                            <div class="form-group">

                                <label for="bank_name">
                                    ធនាគារ
                                    <span class="text-danger">*</span>
                                </label>

                                <select name="bank_name"
                                        id="bank_name"
                                        class="form-control"
                                        required>

                                    <option value="">
                                        -- ជ្រើសរើសធនាគារ --
                                    </option>

                                    @foreach (['ABA BANK', 'ACLEDA', 'WING', 'TRUE MONEY', 'BAKONG'] as $bank)

                                        <option value="{{ $bank }}"
                                            {{ optional($qrSetting)->bank_name == $bank ? 'selected' : '' }}>
                                            {{ $bank }}
                                        </option>

                                    @endforeach

                                </select>

                            </div>

                            <div class="form-group mb-0">

                                <label>
                                    លេខគណនី
                                    <span class="text-danger">*</span>
                                </label>

                                <input type="text"
                                       name="account_number"
                                       class="form-control"
                                       required
                                       value="{{ optional($qrSetting)->account_number }}"
                                       placeholder="សម្រាប់បង្ហាញតែប៉ុណ្ណោះ">

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- BAKONG --}}
        <div id="bakongModeSection"
             class="{{ optional($qrSetting)->mode === 'bakong' ? '' : 'd-none' }}">

            <div class="card settings-card mb-4">

                <div class="card-body">

                    <div class="section-title mb-4">

                        <div class="section-icon">
                            <i class="fas fa-bolt"></i>
                        </div>

                        <div>
                            <h5 class="mb-0">
                                Bakong API
                            </h5>

                            <small>
                                ព័ត៌មានសម្រាប់ Dynamic KHQR
                            </small>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-lg-6">

                            <div class="form-group">

                                <label>
                                    ប្រភេទគណនី
                                    <span class="text-danger">*</span>
                                </label>

                                <select name="account_type"
                                        class="form-control">

                                    <option value="individual"
                                        {{ optional($qrSetting)->account_type == 'individual' ? 'selected' : '' }}>
                                        បុគ្គល (Individual)
                                    </option>

                                    <option value="merchant"
                                        {{ optional($qrSetting)->account_type == 'merchant' ? 'selected' : '' }}>
                                        ហាង / ក្រុមហ៊ុន (Merchant)
                                    </option>

                                </select>

                            </div>

                            <div class="form-group">

                                <label>
                                    ធនាគារ
                                    <span class="text-danger">*</span>
                                </label>

                                <select name="bank_name"
                                        class="form-control"
                                        required>

                                    @foreach (['ABA BANK', 'ACLEDA', 'WING', 'TRUE MONEY', 'BAKONG'] as $bank)

                                        <option value="{{ $bank }}"
                                            {{ optional($qrSetting)->bank_name == $bank ? 'selected' : '' }}>
                                            {{ $bank }}
                                        </option>

                                    @endforeach

                                </select>

                            </div>

                            <div class="form-group">

                                <label>
                                    Bakong Account ID
                                    <span class="text-danger">*</span>
                                </label>

                                <input type="text"
                                       name="bakong_account_id"
                                       class="form-control"
                                       value="{{ optional($qrSetting)->bakong_account_id }}"
                                       placeholder="ឧ. yourclinic@aclb">

                                <small class="text-muted">
                                    ឧ. yourclinic@aclb
                                </small>

                            </div>

                            <div class="form-group"
                                 id="merchantIdGroup">

                                <label>
                                    Merchant ID
                                </label>

                                <input type="text"
                                       name="merchant_id"
                                       class="form-control"
                                       value="{{ optional($qrSetting)->merchant_id }}"
                                       placeholder="Merchant ID">

                            </div>

                        </div>

                        <div class="col-lg-6">

                            <div class="form-group">

                                <label>
                                    ឈ្មោះគណនី
                                    <span class="text-danger">*</span>
                                </label>

                                <input type="text"
                                       name="account_name"
                                       class="form-control"
                                       required
                                       value="{{ optional($qrSetting)->account_name }}"
                                       placeholder="ឈ្មោះមន្ទីរពេទ្យ">

                            </div>

                            <div class="form-group">

                                <label>
                                    លេខគណនី
                                    <span class="text-danger">*</span>
                                </label>

                                <input type="text"
                                       name="account_number"
                                       class="form-control"
                                       required
                                       value="{{ optional($qrSetting)->account_number }}">

                            </div>

                            <div class="form-group">

                                <label>
                                    ទីក្រុង
                                </label>

                                <input type="text"
                                       name="merchant_city"
                                       class="form-control"
                                       value="{{ optional($qrSetting)->merchant_city ?? 'Phnom Penh' }}">

                            </div>

                            <div class="form-group">

                                <label>
                                    លេខទូរស័ព្ទ
                                </label>

                                <input type="text"
                                       name="mobile_number"
                                       class="form-control"
                                       value="{{ optional($qrSetting)->mobile_number }}"
                                       placeholder="012345678">

                            </div>

                        </div>

                    </div>

                    <div class="settings-note">

                        <i class="fas fa-info-circle"></i>

                        <span>
                            Bakong API អាចប្រើសម្រាប់បង្កើត Dynamic KHQR
                            ដែលអាចភ្ជាប់ជាមួយ Invoice និងប្រព័ន្ធទូទាត់របស់អ្នក។
                        </span>

                    </div>

                </div>

            </div>

        </div>

    </form>

</div>

@stop


@section('css')
    @parent

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@stop


@section('js')
    @parent

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        $(function() {

            toastr.options = {
                closeButton: true,
                progressBar: true,
                positionClass: 'toast-top-right',
                timeOut: 3000
            };


            function toggleMode() {

                const mode = $('input[name="mode"]:checked').val();
                const isBakong = mode === 'bakong';

                $('#bakongModeSection')
                    .toggleClass('d-none', !isBakong);

                $('#manualModeSection')
                    .toggleClass('d-none', isBakong);

                $('#manualInfo')
                    .toggleClass('d-none', isBakong);

                $('#bakongInfo')
                    .toggleClass('d-none', !isBakong);

                $('#labelModeManual')
                    .toggleClass('active', !isBakong);

                $('#labelModeBakong')
                    .toggleClass('active', isBakong);

                $('#manualModeSection')
                    .find('input, select')
                    .prop('disabled', isBakong);

                $('#bakongModeSection')
                    .find('input, select')
                    .prop('disabled', !isBakong);
            }


            toggleMode();

            $('input[name="mode"]').on('change', toggleMode);


            function toggleMerchantId() {

                const type = $('select[name="account_type"]').val();

                $('#merchantIdGroup')
                    .toggle(type === 'merchant');
            }


            toggleMerchantId();

            $('select[name="account_type"]').on(
                'change',
                toggleMerchantId
            );


            // Manual QR preview
            $('#manualQrInput').on('change', function(e) {

                const file = e.target.files[0];

                if (file) {

                    $('#manualQrPreview').attr(
                        'src',
                        URL.createObjectURL(file)
                    );
                }
            });


            // Submit
            $('#qrSettingForm').on('submit', function(e) {

                e.preventDefault();

                const formData = new FormData(this);

                $.ajax({

                    url: "{{ route('settingsqrcode.update') }}",

                    method: 'POST',

                    data: formData,

                    processData: false,

                    contentType: false,

                    beforeSend: function() {

                        $('button[type="submit"][form="qrSettingForm"]')
                            .prop('disabled', true)
                            .html(
                                '<i class="fas fa-spinner fa-spin mr-2"></i> កំពុងរក្សាទុក...'
                            );
                    },

                    success: function(res) {

                        toastr.success(
                            res.message ||
                            'ការកំណត់ QR Code ត្រូវបានរក្សាទុកដោយជោគជ័យ'
                        );

                        if (res.manual_qr_url) {

                            $('#manualQrPreview').attr(
                                'src',
                                res.manual_qr_url + '?t=' + Date.now()
                            );
                        }
                    },

                    error: function(xhr) {

                        if (
                            xhr.status === 422 &&
                            xhr.responseJSON?.errors
                        ) {

                            Object.values(xhr.responseJSON.errors)
                                .forEach(messages => {

                                    toastr.error(messages[0]);

                                });

                        } else {

                            toastr.error(
                                xhr.responseJSON?.message ||
                                'មានបញ្ហាក្នុងការរក្សាទុក'
                            );
                        }
                    },

                    complete: function() {

                        $('button[type="submit"][form="qrSettingForm"]')
                            .prop('disabled', false)
                            .html(
                                '<i class="fas fa-save mr-2"></i> រក្សាទុក'
                            );
                    }
                });

            });

        });
    </script>

@stop