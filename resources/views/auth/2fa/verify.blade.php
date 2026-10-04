@extends('layouts.auth')

@section('page-title', 'Verify Code')

@section('auth-subtitle', 'សូមបញ្ចូលលេខកូដផ្ទៀងផ្ទាត់')

@section('auth-content')

    @if (session('error'))
        <div class="hms-alert hms-alert-danger">
            <i class="fas fa-circle-exclamation"></i>

            <div>
                {{ session('error') }}
            </div>
        </div>
    @endif

    @error('one_time_password')
        <div class="hms-alert hms-alert-danger">
            <i class="fas fa-circle-exclamation"></i>

            <div>
                {{ $message }}
            </div>
        </div>
    @enderror

    <form
        method="POST"
        action="{{ route('2fa.verify.submit') }}"
        id="hms-2fa-form"
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
                សូមបញ្ចូលលេខកូដ ៦ ខ្ទង់ពី Google Authenticator
            </div>

        </div>

        <button
            type="submit"
            class="hms-submit-btn"
            id="hms-2fa-submit-btn"
        >

            <span class="hms-btn-label">
                ផ្ទៀងផ្ទាត់
                <i class="fas fa-shield-halved ml-1"></i>
            </span>

            <span class="hms-spinner"></span>

        </button>

    </form>

    <div class="hms-secondary-action">

        <form
            method="POST"
            action="{{ route('logout') }}"
            id="hms-logout-form"
        >

            @csrf

            <button
                type="submit"
                class="hms-secondary-link"
            >
                <i class="fas fa-arrow-right-from-bracket mr-1"></i>
                មិនមែនអ្នកមែនទេ? ចាកចេញពីគណនី
            </button>

        </form>

    </div>

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
    const form = document.getElementById('hms-2fa-form');
    const submitBtn = document.getElementById('hms-2fa-submit-btn');

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