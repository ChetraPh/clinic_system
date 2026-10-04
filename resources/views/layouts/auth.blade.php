<!DOCTYPE html>
<html lang="km">

<head>
    <meta charset="utf-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no"
    >

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @yield('page-title', config('adminlte.title', 'Hospital Management System'))
    </title>

    {{-- Favicon --}}
    <link
        rel="icon"
        href="{{ asset('favicon.ico') }}"
        type="image/x-icon"
    >

    {{-- Google Fonts: Khmer + Latin --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Kantumruy+Pro:wght@400;500;600;700&family=Noto+Sans+Khmer:wght@400;500;600;700&display=swap"
        rel="stylesheet"
    >

    {{-- Font Awesome --}}
    <link
        rel="stylesheet"
        href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}"
    >

    {{-- AdminLTE / Bootstrap --}}
    <link
        rel="stylesheet"
        href="{{ asset('vendor/adminlte/dist/css/adminlte.min.css') }}"
    >

    {{-- Hospital Authentication Theme --}}
    <link
        rel="stylesheet"
        href="{{ asset('css/auth/hospital-login.css') }}"
    >

    @stack('styles')

    <style>
        :root {
            --hospital-green: #006D36;
            --hospital-green-dark: #00552B;
            --hospital-green-light: #E8F5EE;
            --hospital-green-soft: #F2F9F5;
            --hospital-border: #E2EAE5;
            --hospital-text: #1F2A24;
            --hospital-muted: #7A8780;
            --hospital-bg: #F5F8F6;
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
            background:
                radial-gradient(
                    circle at 10% 10%,
                    rgba(0, 109, 54, .08),
                    transparent 28%
                ),
                radial-gradient(
                    circle at 90% 90%,
                    rgba(0, 135, 71, .07),
                    transparent 30%
                ),
                var(--hospital-bg);

            color: var(--hospital-text);

            font-family:
                'Kantumruy Pro',
                'Noto Sans Khmer',
                sans-serif;

            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;

            padding: 35px 20px 25px;

            position: relative;
            overflow-x: hidden;
        }

        /* =========================
           BACKGROUND DECORATION
        ========================= */

        .hms-bg-circle {
            position: fixed;
            border-radius: 50%;
            pointer-events: none;
            z-index: 0;
        }

        .hms-bg-circle-one {
            width: 280px;
            height: 280px;
            top: -130px;
            left: -100px;
            background: rgba(0, 109, 54, .06);
        }

        .hms-bg-circle-two {
            width: 340px;
            height: 340px;
            right: -150px;
            bottom: -160px;
            background: rgba(0, 135, 71, .05);
        }

        /* =========================
           MAIN CARD
        ========================= */

        .hms-card {
            width: 100%;
            max-width: 455px;

            background: #ffffff;

            border: 1px solid var(--hospital-border);

            border-radius: 20px;

            padding: 38px 38px 34px;

            box-shadow:
                0 20px 55px rgba(31, 42, 36, .09),
                0 4px 12px rgba(31, 42, 36, .04);

            position: relative;
            z-index: 2;

            overflow: hidden;
        }

        /* =========================
           TOP ACCENT
        ========================= */

        .hms-card-accent {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;

            height: 5px;

            background:
                linear-gradient(
                    135deg,
                    var(--hospital-green) 0%,
                    #008747 100%
                );
        }

        /* =========================
           LOGO
        ========================= */

        .hms-logo-wrap {
            width: 82px;
            height: 82px;

            margin: 2px auto 18px;

            padding: 5px;

            border-radius: 20px;

            background: var(--hospital-green-light);

            border: 1px solid #D5EBDD;

            display: flex;
            align-items: center;
            justify-content: center;

            box-shadow:
                0 8px 20px rgba(0, 109, 54, .08);
        }

        .hms-logo-wrap img {
            width: 100%;
            height: 100%;

            object-fit: contain;

            border-radius: 15px;

            background: #ffffff;
        }

        /* =========================
           TITLE
        ========================= */

        .hms-title {
            margin: 0;

            text-align: center;

            color: var(--hospital-green);

            font-size: 22px;
            line-height: 1.5;

            font-weight: 700;
        }

        .hms-auth-subtitle {
            margin: 8px 0 25px;

            text-align: center;

            color: var(--hospital-muted);

            font-size: 13px;
            line-height: 1.7;
        }

        /* =========================
           FORM
        ========================= */

        .hms-card .form-group {
            margin-bottom: 17px;
        }

        .hms-card label {
            color: var(--hospital-text);

            font-size: 13px;

            font-weight: 600;

            margin-bottom: 7px;
        }

        .hms-card .form-control {
            min-height: 44px;

            border: 1px solid var(--hospital-border);

            border-radius: 10px;

            background: #ffffff;

            color: var(--hospital-text);

            font-family:
                'Kantumruy Pro',
                'Noto Sans Khmer',
                sans-serif;

            font-size: 13px;

            padding: 9px 13px;

            transition:
                border-color .15s ease,
                box-shadow .15s ease,
                background-color .15s ease;
        }

        .hms-card .form-control:hover {
            border-color: #C9DAD0;
        }

        .hms-card .form-control:focus {
            border-color: var(--hospital-green);

            background: #ffffff;

            box-shadow:
                0 0 0 3px rgba(0, 109, 54, .10);

            outline: none;
        }

        .hms-card .form-control::placeholder {
            color: #A3ACA7;
        }

        /* =========================
           BUTTONS
        ========================= */

        .hms-card .btn-success,
        .hms-card .btn-primary {
            min-height: 44px;

            border: none;

            border-radius: 10px;

            background:
                linear-gradient(
                    135deg,
                    var(--hospital-green) 0%,
                    #008747 100%
                ) !important;

            border-color: transparent !important;

            color: #ffffff !important;

            font-family:
                'Kantumruy Pro',
                'Noto Sans Khmer',
                sans-serif;

            font-size: 13px;

            font-weight: 700;

            box-shadow:
                0 5px 14px rgba(0, 109, 54, .16);

            transition:
                transform .15s ease,
                box-shadow .15s ease;
        }

        .hms-card .btn-success:hover,
        .hms-card .btn-primary:hover {
            transform: translateY(-1px);

            box-shadow:
                0 8px 18px rgba(0, 109, 54, .22);
        }

        .hms-card .btn-success:focus,
        .hms-card .btn-primary:focus {
            box-shadow:
                0 0 0 3px rgba(0, 109, 54, .12),
                0 5px 14px rgba(0, 109, 54, .16);
        }

        /* =========================
           LINKS
        ========================= */

        .hms-card a {
            color: var(--hospital-green);

            font-weight: 600;

            text-decoration: none;

            transition: color .15s ease;
        }

        .hms-card a:hover {
            color: var(--hospital-green-dark);

            text-decoration: none;
        }

        /* =========================
           CHECKBOX
        ========================= */

        .hms-card .custom-control-label {
            color: var(--hospital-muted);

            font-size: 12px;

            font-weight: 500;
        }

        .hms-card .custom-control-input:checked ~ .custom-control-label::before {
            border-color: var(--hospital-green);

            background-color: var(--hospital-green);
        }

        /* =========================
           ALERT
        ========================= */

        .hms-card .alert {
            border-radius: 10px;

            border: 1px solid transparent;

            font-size: 12px;

            line-height: 1.6;
        }

        .hms-card .alert-success {
            background: var(--hospital-green-light);

            border-color: #CDE5D7;

            color: var(--hospital-green-dark);
        }

        /* =========================
           DIVIDER
        ========================= */

        .hms-divider {
            display: flex;
            align-items: center;

            gap: 12px;

            margin: 22px 0;

            color: #A1AAA5;

            font-size: 11px;
        }

        .hms-divider::before,
        .hms-divider::after {
            content: '';

            height: 1px;

            flex: 1;

            background: var(--hospital-border);
        }

        /* =========================
           FOOTER
        ========================= */

        .hms-page-footer {
            position: relative;
            z-index: 2;

            width: 100%;
            max-width: 700px;

            margin-top: 22px;

            text-align: center;

            color: var(--hospital-muted);

            font-size: 11px;

            line-height: 1.8;
        }

        .hms-footer-links {
            display: flex;

            justify-content: center;
            align-items: center;

            gap: 9px;

            margin-top: 3px;
        }

        .hms-footer-links a {
            color: var(--hospital-muted);

            text-decoration: none;

            transition: color .15s ease;
        }

        .hms-footer-links a:hover {
            color: var(--hospital-green);
        }

        .hms-dot {
            color: #B3BCB7;
        }

        /* =========================
           MOBILE
        ========================= */

        @media (max-width: 575.98px) {

            body.hms-login-body {
                padding: 20px 14px 20px;
            }

            .hms-card {
                max-width: 100%;

                padding: 32px 22px 28px;

                border-radius: 17px;
            }

            .hms-logo-wrap {
                width: 72px;
                height: 72px;

                border-radius: 17px;
            }

            .hms-title {
                font-size: 19px;
            }

            .hms-auth-subtitle {
                font-size: 12px;

                margin-bottom: 21px;
            }

            .hms-page-footer {
                font-size: 10px;
            }
        }

        @media (max-width: 360px) {

            .hms-card {
                padding: 28px 17px 25px;
            }

            .hms-title {
                font-size: 17px;
            }
        }
    </style>
</head>


<body class="hms-login-body">

    {{-- Background Decoration --}}
    <div class="hms-bg-circle hms-bg-circle-one"></div>
    <div class="hms-bg-circle hms-bg-circle-two"></div>


    {{-- =========================
         AUTH CARD
    ========================= --}}
    <div class="hms-card">

        <div class="hms-card-accent"></div>


        {{-- Logo --}}
        <div class="hms-logo-wrap">

            <img
                src="{{ $setting && $setting->logo
                    ? asset('storage/' . $setting->logo)
                    : asset('vendor/adminlte/dist/img/logo.jpg') }}"
                alt="Hospital Logo"
            >

        </div>


        {{-- System Name --}}
        <h1 class="hms-title">
            {{ $setting->system_name ?? 'មន្ទីរសម្រាកព្យាបាលព្រំ សន្តិភាព' }}
        </h1>


        {{-- Auth Subtitle --}}
        @hasSection('auth-subtitle')

            <p class="hms-auth-subtitle">
                @yield('auth-subtitle')
            </p>

        @endif


        {{-- Page-specific content --}}
        @yield('auth-content')

    </div>


    {{-- =========================
         FOOTER
    ========================= --}}
    <div class="hms-page-footer">

        <div>
            &copy; {{ date('Y') }}
            {{ $setting->system_name ?? 'មន្ទីរសម្រាកព្យាបាលព្រំ សន្តិភាព' }}
            || All rights reserved.
        </div>

        <div class="hms-footer-links">

            <a href="#">
                Privacy Policy
            </a>

            <span class="hms-dot">
                &middot;
            </span>

            <a href="#">
                Terms of Service
            </a>

        </div>

    </div>


    {{-- jQuery --}}
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>

    @stack('scripts')

</body>

</html>