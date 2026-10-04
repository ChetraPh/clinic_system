@extends('layouts.auth')

@section('page-title', 'Setup Two-Factor Authentication')

@section('auth-subtitle', 'សូមស្កេន QR Code ហើយបញ្ចូលលេខកូដ ៦ ខ្ទង់')

@section('auth-content')

    @if (session('error'))
        <div class="hms-alert hms-alert-danger">
            <i class="fas fa-circle-exclamation"></i>
            <div>
                {{ session('error') }}
            </div>
        </div>
    @endif

    @if ($errors->any())
        <div class="hms-alert hms-alert-danger">
            <i class="fas fa-circle-exclamation"></i>
            <div>
                {{ $errors->first() }}
            </div>
        </div>
    @endif

    <div class="text-center">

        <div
            style="
                color:#006D36;
                font-size:14px;
                font-weight:700;
                margin-bottom:12px;
            "
        >
            <i class="fas fa-qrcode mr-1"></i>
            ស្កេន QR Code
        </div>

        <div
            style="
                display:flex;
                justify-content:center;
                align-items:center;
                background:#ffffff;
                border:1px solid #E7ECE9;
                border-radius:14px;
                padding:15px;
                margin:0 auto 15px auto;
                width:250px;
                height:250px;
                box-shadow:0 4px 15px rgba(0,0,0,0.05);
            "
        >
            {!! $qrCodeSvg !!}
        </div>

        <div
            style="
                color:#7A8780;
                font-size:11px;
                line-height:1.6;
                margin-bottom:15px;
            "
        >
            សូមបើក Google Authenticator
            <br>
            រួចស្កេន QR Code ខាងលើ
        </div>

    </div>

    <div
        style="
            background:#F5F7F6;
            border:1px solid #E7ECE9;
            border-radius:10px;
            padding:10px 12px;
            margin-bottom:18px;
            text-align:center;
        "
    >

        <div
            style="
                color:#7A8780;
                font-size:10px;
                margin-bottom:4px;
            "
        >
            Manual setup key
        </div>

        <div
            style="
                color:#006D36;
                font-size:14px;
                font-weight:700;
                letter-spacing:2px;
                word-break:break-all;
            "
        >
            {{ $secret }}
        </div>

    </div>

    <form
        method="POST"
        action="{{ route('2fa.setup.confirm') }}"
        id="hms-2fa-setup-form"
        novalidate
    >

        @csrf

        <div class="hms-form-group">

            <label
                for="one_time_password"
                class="d-block text-center mb-2"
                style="
                    color:#4F5D55;
                    font-size:13px;
                    font-weight:600;
                "
            >
                <i
                    class="fas fa-shield-halved mr-1"
                    style="color:#006D36;"
                ></i>

                លេខកូដផ្ទៀងផ្ទាត់
            </label>

            <div
                class="hms-input-group"
                style="position:relative;"
            >

                <input
                    id="one_time_password"
                    type="text"
                    name="one_time_password"
                    class="hms-otp-input"
                    maxlength="6"
                    inputmode="numeric"
                    pattern="[0-9]*"
                    autocomplete="one-time-code"
                    placeholder="000000"
                    required
                    autofocus
                    aria-label="លេខកូដផ្ទៀងផ្ទាត់"
                >

            </div>

            <div
                class="text-center mt-2"
                style="
                    color:#9AA59F;
                    font-size:11px;
                "
            >
                បញ្ចូលលេខកូដ ៦ ខ្ទង់ពី Google Authenticator
            </div>

        </div>

        <button
            type="submit"
            class="hms-submit-btn"
            id="hms-2fa-setup-submit-btn"
        >

            <span class="hms-btn-label">
                បញ្ជាក់ការកំណត់ 2FA
                <i class="fas fa-shield-halved ml-1"></i>
            </span>

            <span class="hms-spinner"></span>

        </button>

    </form>

    <div
        class="text-center mt-3"
        style="
            color:#9AA59F;
            font-size:10px;
        "
    >
        <i
            class="fas fa-lock mr-1"
            style="color:#006D36;"
        ></i>

        កូដនេះត្រូវបានការពារដោយប្រព័ន្ធសុវត្ថិភាព
    </div>

@endsection

@push('scripts')

<script>
(function () {

    const otpInput = document.getElementById('one_time_password');
    const form = document.getElementById('hms-2fa-setup-form');
    const submitBtn = document.getElementById('hms-2fa-setup-submit-btn');

    if (otpInput) {

        otpInput.addEventListener('input', function () {

            this.value = this.value
                .replace(/\D/g, '')
                .slice(0, 6);

        });

    }

    if (form && submitBtn) {

        form.addEventListener('submit', function () {

            if (form.checkValidity && !form.checkValidity()) {
                return;
            }

            submitBtn.classList.add('is-loading');
            submitBtn.disabled = true;

        });

    }

    if (otpInput && form) {

        otpInput.addEventListener('input', function () {

            if (this.value.length === 6) {

                setTimeout(function () {

                    if (form.checkValidity()) {
                        form.requestSubmit();
                    }

                }, 150);

            }

        });

    }

})();
</script>

@endpush