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

    {{-- Google Fonts: Khmer + Latin support --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Kantumruy+Pro:wght@400;500;600;700&family=Noto+Sans+Khmer:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">

    {{-- AdminLTE / Bootstrap base (kept for shared classes & consistency with the rest of the app) --}}
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/adminlte.min.css') }}">

    {{-- Custom hospital login theme (overrides / extends the above) --}}
    <link rel="stylesheet" href="{{ asset('css/auth/hospital-login.css') }}">

    {{-- Login page background --}}
    <style>
        html {
            min-height: 100%;
            background: url('{{ asset('images/doctor.jpg') }}') center center / cover no-repeat fixed !important;
        }

        /* Blank ពណ៌ស គ្របលើរូបភាព */
        html::before {
            content: '';
            position: fixed;
            inset: 0;
            background: rgba(255, 255, 255, 0.65);
            -webkit-backdrop-filter: blur(3px);
            backdrop-filter: blur(3px);
            z-index: 0;
            pointer-events: none;
        }

        /* បិទ background និង effect ចាស់ពី hospital-login.css */
        body.hms-login-body {
            background: transparent !important;
            position: relative;
            min-height: 100vh;
        }

        body.hms-login-body::before,
        body.hms-login-body::after {
            display: none !important;
        }

        /* ឱ្យ card និង footer នៅលើ overlay */
        .hms-card,
        .hms-page-footer {
            position: relative;
            z-index: 2;
        }

        .hms-card {
            background: rgba(255, 255, 255, 0.97) !important;
            box-shadow: 0 10px 35px rgba(0, 0, 0, 0.15);
        }

        /* Footer ពណ៌ងងឹត ព្រោះ background ឥឡូវភ្លឺ */
        .hms-page-footer,
        .hms-page-footer a {
            color: #333 !important;
        }
    </style>
</head>

<body class="hms-login-body">

    <div class="hms-card">
        <div class="hms-card-accent"></div>

        {{-- Logo --}}
        <div class="hms-logo-wrap">
            <img src="{{ $setting && $setting->logo ? asset('storage/' . $setting->logo) : asset('vendor/adminlte/dist/img/logo.jpg') }}"
                alt="Hospital Logo">

        </div>

        <h1 class="hms-title"> {{ $setting->system_name ?? 'មន្ទីរសម្រាកព្យាបាលព្រំ សន្តិភាព' }}</h1>

        {{-- General / session errors (e.g. throttle lockout, custom flashed errors) --}}
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
                <label for="login"><i class="fas fa-user"></i> អ៊ីម៉ែលឬឈ្មោះអ្នកប្រើប្រាស់​ </label>
                <div class="hms-input-group @error('login') is-invalid @enderror">
                    <input type="text" id="login" name="login" value="{{ old('login') }}"
                        placeholder="Enter your email or username" autocomplete="username" autofocus required>
                </div>
                @error('login')
                    <div class="hms-field-error"><i class="fas fa-circle-exclamation"></i> {{ $message }}</div>
                @enderror
            </div>

            {{-- Password --}}
            <div class="hms-form-group">
                <label for="password"><i class="fas fa-lock"></i> លេខសម្ងាត់</label>
                <div class="hms-input-group @error('password') is-invalid @enderror">
                    <input type="password" id="password" name="password" placeholder="••••••••"
                        autocomplete="current-password" required>
                    <button type="button" class="hms-toggle-password" id="hms-toggle-password"
                        aria-label="Show password" tabindex="-1">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
                @error('password')
                    <div class="hms-field-error"><i class="fas fa-circle-exclamation"></i> {{ $message }}</div>
                @enderror
            </div>

            {{-- Remember me + Forgot password --}}
            <div class="hms-form-row">
                <label class="hms-remember" for="remember">
                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <span>ចងចាំ</span>
                </label>

                {{-- Password reset routes are disabled in routes/web.php (Auth::routes(['reset' => false])).
                This link is a placeholder to match the approved design — enable reset routes
                or remove this link before shipping. --}}
                <a href="#" class="hms-forgot-link" style="display: none;">ភ្លេចលេខសម្ងាត់?</a>
            </div>

            {{-- Submit --}}
            <button type="submit" class="hms-submit-btn" id="hms-submit-btn">
                <span class="hms-btn-label">ចូលប្រើប្រាស់ &nbsp;<i class="fas fa-arrow-right-to-bracket"></i></span>
                <span class="hms-spinner"></span>
            </button>
        </form>
    </div>

    <div class="hms-page-footer">
        <div>&copy; {{ date('Y') }} {{ $setting->system_name ?? 'មន្ទីរសម្រាកព្យាបាលព្រំ សន្តិភាព' }}|| All rights
            reserved.</div>
        <div class="hms-footer-links">
            <a href="#">Privacy Policy</a>
            <span class="hms-dot">&middot;</span>
            <a href="#">Terms of Service</a>
        </div>
    </div>

    {{-- jQuery (bundled with AdminLTE assets) --}}
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>

    <script>
        (function() {
            // Show / hide password toggle
            var toggleBtn = document.getElementById('hms-toggle-password');
            var passwordInput = document.getElementById('password');

            if (toggleBtn && passwordInput) {
                toggleBtn.addEventListener('click', function() {
                    var isPassword = passwordInput.getAttribute('type') === 'password';
                    passwordInput.setAttribute('type', isPassword ? 'text' : 'password');

                    var icon = toggleBtn.querySelector('i');
                    icon.classList.toggle('fa-eye');
                    icon.classList.toggle('fa-eye-slash');
                    toggleBtn.setAttribute('aria-label', isPassword ? 'Hide password' : 'Show password');
                });
            }

            // Loading animation on submit
            var form = document.getElementById('hms-login-form');
            var submitBtn = document.getElementById('hms-submit-btn');
            var isSubmitting = false;

            // Clears the spinner/disabled state. Called on normal load AND
            // whenever the page is restored from the browser's back-forward
            // cache (bfcache), which is what leaves the button stuck after
            // the user presses Back mid-login.
            function resetLoginButtonState() {
                if (!submitBtn) return;
                isSubmitting = false;
                submitBtn.classList.remove('is-loading');
                submitBtn.disabled = false;
            }

            if (form && submitBtn) {
                form.addEventListener('submit', function(e) {
                    if (form.checkValidity && !form.checkValidity()) {
                        return;
                    }
                    // Guard against duplicate submits (double-click, double Enter)
                    // before the disabled attribute has taken visual effect.
                    if (isSubmitting) {
                        e.preventDefault();
                        return;
                    }
                    isSubmitting = true;
                    submitBtn.classList.add('is-loading');
                    submitBtn.disabled = true;
                });
            }

            // `pageshow` fires on every page view, including bfcache restores
            // (Back/Forward). `event.persisted` is true only for the latter,
            // but resetting unconditionally here is harmless and covers
            // browsers/edge-cases that don't set it reliably.
            window.addEventListener('pageshow', function(event) {
                resetLoginButtonState();
            });
        })();
    </script>
</body>

</html>
