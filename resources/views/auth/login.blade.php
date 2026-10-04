<!DOCTYPE html>
<html lang="km">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('adminlte.title', 'Hospital Management System') }} | Login</title>

    {{-- Favicon --}}
    <link rel="icon"
        href="{{ optional($setting)->favicon ? asset('storage/' . $setting->favicon) : asset('favicon.ico') }}"
        type="image/x-icon">

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Kantumruy+Pro:wght@400;500;600;700&family=Noto+Sans+Khmer:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">

    {{-- AdminLTE --}}
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/adminlte.min.css') }}">

    <style>
        :root {
            --hospital-green: #006D36;
            --hospital-green-dark: #00552B;
            --hospital-green-light: #E8F5EE;
            --hospital-green-soft: #F1F8F4;
            --hospital-border: #E2E9E5;
            --hospital-text: #1F2A24;
            --hospital-muted: #7A8780;
            --hospital-danger: #DC3545;
        }

        * {
            box-sizing: border-box;
        }

        html,
        body {
            min-height: 100%;
        }

        body.hms-login-body {
            margin: 0;
            min-height: 100vh;
            font-family: 'Kantumruy Pro', 'Noto Sans Khmer', sans-serif;
            color: var(--hospital-text);
            background:
                radial-gradient(circle at 10% 15%, rgba(0, 109, 54, 0.10), transparent 28%),
                radial-gradient(circle at 90% 85%, rgba(0, 135, 71, 0.09), transparent 30%),
                linear-gradient(135deg, #F4F8F6 0%, #EEF5F1 100%);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 35px 20px 20px;
            position: relative;
            overflow-x: hidden;
        }

        body.hms-login-body::before,
        body.hms-login-body::after {
            content: "";
            position: fixed;
            border-radius: 50%;
            pointer-events: none;
            z-index: 0;
        }

        body.hms-login-body::before {
            width: 280px;
            height: 280px;
            top: -130px;
            right: -100px;
            border: 45px solid rgba(0, 109, 54, 0.04);
        }

        body.hms-login-body::after {
            width: 240px;
            height: 240px;
            bottom: -130px;
            left: -100px;
            border: 40px solid rgba(0, 109, 54, 0.035);
        }

        /* =========================
           LOGIN CARD
        ========================= */

        .hms-card {
            width: 100%;
            max-width: 455px;
            background: #FFFFFF;
            border: 1px solid var(--hospital-border);
            border-radius: 20px;
            box-shadow:
                0 20px 50px rgba(31, 42, 36, 0.10),
                0 5px 15px rgba(31, 42, 36, 0.04);
            padding: 38px 38px 36px;
            position: relative;
            z-index: 2;
            overflow: hidden;
        }

        .hms-card-accent {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 6px;
            background: linear-gradient(135deg,
                    var(--hospital-green) 0%,
                    #008747 100%);
        }

        /* =========================
           LOGO
        ========================= */

        .hms-logo-wrap {
            width: 88px;
            height: 88px;
            margin: 3px auto 20px;
            padding: 7px;
            border-radius: 22px;
            background: var(--hospital-green-light);
            border: 1px solid rgba(0, 109, 54, 0.10);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .hms-logo-wrap img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            border-radius: 16px;
            background: #FFFFFF;
        }

        .hms-title {
            margin: 0 auto 8px;
            text-align: center;
            font-size: 23px;
            line-height: 1.5;
            font-weight: 700;
            color: var(--hospital-green);
        }

        .hms-subtitle {
            margin: 0 auto 28px;
            text-align: center;
            color: var(--hospital-muted);
            font-size: 13px;
            font-weight: 400;
        }

        /* =========================
           FORM
        ========================= */

        .hms-form-group {
            margin-bottom: 20px;
        }

        .hms-form-group label {
            display: flex;
            align-items: center;
            gap: 7px;
            margin-bottom: 8px;
            font-size: 14px;
            font-weight: 600;
            color: var(--hospital-text);
        }

        .hms-form-group label i {
            width: 17px;
            color: var(--hospital-green);
            font-size: 13px;
            text-align: center;
        }

        .hms-input-group {
            width: 100%;
            min-height: 48px;
            display: flex;
            align-items: center;
            background: #FFFFFF;
            border: 1px solid #DDE5E0;
            border-radius: 11px;
            transition: all .2s ease;
            overflow: hidden;
        }

        .hms-input-group:focus-within {
            border-color: var(--hospital-green);
            box-shadow: 0 0 0 3px rgba(0, 109, 54, 0.10);
        }

        .hms-input-group.is-invalid {
            border-color: var(--hospital-danger);
        }

        .hms-input-group input {
            width: 100%;
            height: 46px;
            padding: 0 14px;
            border: 0;
            outline: 0;
            background: transparent;
            color: var(--hospital-text);
            font-family: inherit;
            font-size: 14px;
        }

        .hms-input-group input::placeholder {
            color: #A3ADA7;
        }

        .hms-input-group input:focus {
            outline: none;
            box-shadow: none;
        }

        .hms-toggle-password {
            width: 48px;
            height: 46px;
            flex-shrink: 0;
            border: 0;
            background: transparent;
            color: #89958F;
            cursor: pointer;
            transition: all .2s ease;
        }

        .hms-toggle-password:hover {
            color: var(--hospital-green);
            background: var(--hospital-green-soft);
        }

        .hms-field-error {
            display: flex;
            align-items: flex-start;
            gap: 6px;
            margin-top: 7px;
            color: var(--hospital-danger);
            font-size: 12px;
            line-height: 1.5;
        }

        .hms-field-error i {
            margin-top: 3px;
        }

        /* =========================
           ALERT
        ========================= */

        .hms-alert {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin-bottom: 20px;
            padding: 12px 14px;
            border-radius: 11px;
            font-size: 13px;
            line-height: 1.6;
        }

        .hms-alert-danger {
            color: #842029;
            background: #FFF1F2;
            border: 1px solid #F5C2C7;
        }

        .hms-alert>i {
            margin-top: 3px;
            color: var(--hospital-danger);
        }

        .hms-alert ul {
            margin: 0;
            padding-left: 18px;
        }

        /* =========================
           REMEMBER / FORGOT
        ========================= */

        .hms-form-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin: 4px 0 22px;
        }

        .hms-remember {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin: 0;
            color: var(--hospital-muted);
            font-size: 13px;
            cursor: pointer;
        }

        .hms-remember input {
            width: 16px;
            height: 16px;
            margin: 0;
            accent-color: var(--hospital-green);
            cursor: pointer;
        }

        .hms-forgot-link {
            color: var(--hospital-green);
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
        }

        .hms-forgot-link:hover {
            color: var(--hospital-green-dark);
            text-decoration: underline;
        }

        /* =========================
           SUBMIT BUTTON
        ========================= */

        .hms-submit-btn {
            width: 100%;
            height: 50px;
            border: 0;
            border-radius: 11px;
            background: linear-gradient(135deg,
                    var(--hospital-green) 0%,
                    #008747 100%);
            color: #FFFFFF;
            font-family: inherit;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            transition: all .2s ease;
            box-shadow: 0 7px 18px rgba(0, 109, 54, 0.18);
        }

        .hms-submit-btn:hover {
            background: linear-gradient(135deg,
                    var(--hospital-green-dark) 0%,
                    var(--hospital-green) 100%);
            transform: translateY(-1px);
            box-shadow: 0 10px 22px rgba(0, 109, 54, 0.22);
        }

        .hms-submit-btn:active {
            transform: translateY(0);
        }

        .hms-submit-btn:disabled {
            cursor: not-allowed;
            opacity: .85;
            transform: none;
        }

        .hms-btn-label {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 4px;
        }

        .hms-spinner {
            display: none;
            width: 19px;
            height: 19px;
            border: 2px solid rgba(255, 255, 255, .35);
            border-top-color: #FFFFFF;
            border-radius: 50%;
            animation: hms-spin .7s linear infinite;
        }

        .hms-submit-btn.is-loading .hms-btn-label {
            display: none;
        }

        .hms-submit-btn.is-loading .hms-spinner {
            display: block;
        }

        @keyframes hms-spin {
            to {
                transform: rotate(360deg);
            }
        }

        /* =========================
           FOOTER
        ========================= */

        .hms-page-footer {
            width: 100%;
            max-width: 455px;
            margin-top: 22px;
            position: relative;
            z-index: 2;
            text-align: center;
            color: #8A9690;
            font-size: 11px;
            line-height: 1.8;
        }

        .hms-footer-links {
            margin-top: 3px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .hms-footer-links a {
            color: #7A8780;
            text-decoration: none;
            transition: color .2s ease;
        }

        .hms-footer-links a:hover {
            color: var(--hospital-green);
        }

        .hms-dot {
            color: #B5BDB9;
        }

        /* =========================
           RESPONSIVE
        ========================= */

        @media (max-width: 575.98px) {
            body.hms-login-body {
                padding: 20px 14px 16px;
            }

            .hms-card {
                max-width: 100%;
                padding: 34px 22px 28px;
                border-radius: 17px;
            }

            .hms-logo-wrap {
                width: 78px;
                height: 78px;
                border-radius: 19px;
            }

            .hms-title {
                font-size: 20px;
            }

            .hms-form-group {
                margin-bottom: 18px;
            }

            .hms-form-row {
                margin-bottom: 20px;
            }

            .hms-page-footer {
                font-size: 10px;
            }
        }
    </style>
</head>

<body class="hms-login-body">

    <div class="hms-card">
        <div class="hms-card-accent"></div>

        {{-- Logo --}}
        <div class="hms-logo-wrap">
            <img src="{{ asset('images/logo.jpg') }}" alt="Prum Santepheap Logo">
        </div>

        <h1 class="hms-title">
            {{ $setting->system_name ?? 'មន្ទីរសម្រាកព្យាបាលព្រំ សន្តិភាព' }}
        </h1>

        <div class="hms-subtitle">
            ប្រព័ន្ធគ្រប់គ្រងមន្ទីរសម្រាកព្យាបាល
        </div>

        {{-- General / session errors --}}
        @if (session('error'))
            <div class="hms-alert hms-alert-danger">
                <i class="fas fa-circle-exclamation"></i>
                <div>{{ session('error') }}</div>
            </div>
        @endif

        @if ($errors->any() && !$errors->has('login') && !$errors->has('password'))
            <div class="hms-alert hms-alert-danger">
                <i class="fas fa-circle-exclamation"></i>

                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" id="hms-login-form" novalidate>

            @csrf

            {{-- Email or Username --}}
            <div class="hms-form-group">
                <label for="login">
                    <i class="fas fa-user"></i>
                    អ៊ីម៉ែល ឬឈ្មោះអ្នកប្រើប្រាស់
                </label>

                <div class="hms-input-group @error('login') is-invalid @enderror">
                    <input type="text" id="login" name="login" value="{{ old('login') }}"
                        placeholder="Enter your email or username" autocomplete="username" autofocus required>
                </div>

                @error('login')
                    <div class="hms-field-error">
                        <i class="fas fa-circle-exclamation"></i>
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- Password --}}
            <div class="hms-form-group">
                <label for="password">
                    <i class="fas fa-lock"></i>
                    លេខសម្ងាត់
                </label>

                <div class="hms-input-group @error('password') is-invalid @enderror">
                    <input type="password" id="password" name="password" placeholder="••••••••"
                        autocomplete="current-password" required>

                    <button type="button" class="hms-toggle-password" id="hms-toggle-password"
                        aria-label="Show password" tabindex="-1">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>

                @error('password')
                    <div class="hms-field-error">
                        <i class="fas fa-circle-exclamation"></i>
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- Remember me + Forgot password --}}
            <div class="hms-form-row">

                <label class="hms-remember" for="remember">
                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                    <span>ចងចាំ</span>
                </label>

                <a href="#" class="hms-forgot-link" style="display: none;">
                    ភ្លេចលេខសម្ងាត់?
                </a>

            </div>

            {{-- Submit --}}
            <button type="submit" class="hms-submit-btn" id="hms-submit-btn">

                <span class="hms-btn-label">
                    ចូលប្រើប្រាស់
                    <i class="fas fa-arrow-right-to-bracket"></i>
                </span>

                <span class="hms-spinner"></span>
            </button>

        </form>
    </div>

    {{-- Footer --}}
    <div class="hms-page-footer">
        <div>
            &copy; {{ date('Y') }}
            {{ $setting->system_name ?? 'មន្ទីរសម្រាកព្យាបាលព្រំ សន្តិភាព' }}
            | All rights reserved.
        </div>

        <div class="hms-footer-links">
            <a href="#">Privacy Policy</a>
            <span class="hms-dot">&middot;</span>
            <a href="#">Terms of Service</a>
        </div>
    </div>

    {{-- jQuery --}}
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>

    <script>
        (function() {

            // Show / hide password
            var toggleBtn = document.getElementById('hms-toggle-password');
            var passwordInput = document.getElementById('password');

            if (toggleBtn && passwordInput) {

                toggleBtn.addEventListener('click', function() {

                    var isPassword =
                        passwordInput.getAttribute('type') === 'password';

                    passwordInput.setAttribute(
                        'type',
                        isPassword ? 'text' : 'password'
                    );

                    var icon = toggleBtn.querySelector('i');

                    icon.classList.toggle('fa-eye');
                    icon.classList.toggle('fa-eye-slash');

                    toggleBtn.setAttribute(
                        'aria-label',
                        isPassword ? 'Hide password' : 'Show password'
                    );
                });
            }

            // Loading animation on submit
            var form = document.getElementById('hms-login-form');
            var submitBtn = document.getElementById('hms-submit-btn');

            var isSubmitting = false;

            function resetLoginButtonState() {

                if (!submitBtn) {
                    return;
                }

                isSubmitting = false;

                submitBtn.classList.remove('is-loading');
                submitBtn.disabled = false;
            }

            if (form && submitBtn) {

                form.addEventListener('submit', function(e) {

                    if (form.checkValidity && !form.checkValidity()) {
                        return;
                    }

                    if (isSubmitting) {
                        e.preventDefault();
                        return;
                    }

                    isSubmitting = true;

                    submitBtn.classList.add('is-loading');
                    submitBtn.disabled = true;
                });
            }

            // Reset button when browser restores page
            window.addEventListener('pageshow', function() {
                resetLoginButtonState();
            });

        })();
    </script>

</body>

</html>
