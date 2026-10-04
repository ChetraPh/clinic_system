<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    {{-- Scripts --}}
    <script src="{{ asset('js/app.js') }}" defer></script>

    {{-- Fonts --}}
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
    >

    {{-- Bootstrap / App CSS --}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        :root {
            --hospital-green: #006D36;
            --hospital-green-dark: #00552B;
            --hospital-green-light: #E8F5EE;
            --hospital-border: #E7ECE9;
            --hospital-text: #1F2A24;
            --hospital-muted: #7A8780;
            --hospital-bg: #F5F7F6;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Nunito', sans-serif;
            background: var(--hospital-bg);
            color: var(--hospital-text);
        }

        #app {
            min-height: 100vh;
        }

        /* =========================
           NAVBAR
        ========================= */

        .hospital-navbar {
            background: #ffffff;
            border-bottom: 1px solid var(--hospital-border);
            box-shadow: 0 3px 15px rgba(31, 42, 36, .05);
            min-height: 68px;
            padding: 0;
        }

        .hospital-navbar .container {
            min-height: 68px;
        }

        /* Brand */

        .hospital-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--hospital-green) !important;
            font-size: 20px;
            font-weight: 800;
            text-decoration: none !important;
        }

        .hospital-brand-icon {
            width: 40px;
            height: 40px;
            border-radius: 11px;
            background: var(--hospital-green-light);
            color: var(--hospital-green);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
        }

        .hospital-brand-text {
            line-height: 1;
        }

        .hospital-brand-subtitle {
            display: block;
            margin-top: 4px;
            color: var(--hospital-muted);
            font-size: 9px;
            font-weight: 600;
            letter-spacing: .5px;
            text-transform: uppercase;
        }

        /* Navbar links */

        .hospital-navbar .nav-link {
            color: #59655F !important;
            font-size: 13px;
            font-weight: 600;
            padding: 10px 14px !important;
            border-radius: 9px;
            transition: all .15s ease;
        }

        .hospital-navbar .nav-link:hover {
            background: var(--hospital-green-light);
            color: var(--hospital-green) !important;
        }

        /* User */

        .hospital-user-link {
            display: flex !important;
            align-items: center;
            gap: 9px;
        }

        .hospital-user-avatar {
            width: 35px;
            height: 35px;
            border-radius: 10px;
            background: var(--hospital-green-light);
            color: var(--hospital-green);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            font-weight: 800;
        }

        .hospital-user-name {
            max-width: 150px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        /* Dropdown */

        .hospital-dropdown {
            margin-top: 8px;
            padding: 6px;
            border: 1px solid var(--hospital-border);
            border-radius: 11px;
            box-shadow: 0 10px 30px rgba(31, 42, 36, .12);
        }

        .hospital-dropdown .dropdown-item {
            border-radius: 8px;
            padding: 9px 11px;
            color: var(--hospital-text);
            font-size: 13px;
            font-weight: 600;
            transition: all .15s ease;
        }

        .hospital-dropdown .dropdown-item:hover {
            background: var(--hospital-green-light);
            color: var(--hospital-green);
        }

        .hospital-dropdown .dropdown-item i {
            width: 18px;
            text-align: center;
            margin-right: 7px;
        }

        /* Mobile toggle */

        .hospital-navbar .navbar-toggler {
            border: 1px solid var(--hospital-border);
            border-radius: 9px;
            padding: 7px 9px;
        }

        .hospital-navbar .navbar-toggler:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(0, 109, 54, .10);
        }

        /* =========================
           MAIN CONTENT
        ========================= */

        .hospital-main {
            min-height: calc(100vh - 68px);
            padding-top: 28px !important;
            padding-bottom: 40px !important;
        }

        /* =========================
           COMMON BOOTSTRAP OVERRIDE
        ========================= */

        .btn-success {
            background-color: var(--hospital-green) !important;
            border-color: var(--hospital-green) !important;
        }

        .btn-success:hover {
            background-color: var(--hospital-green-dark) !important;
            border-color: var(--hospital-green-dark) !important;
        }

        .text-success {
            color: var(--hospital-green) !important;
        }

        .bg-success {
            background-color: var(--hospital-green) !important;
        }

        /* =========================
           RESPONSIVE
        ========================= */

        @media (max-width: 767.98px) {

            .hospital-navbar {
                min-height: 62px;
            }

            .hospital-navbar .container {
                min-height: 62px;
            }

            .hospital-brand {
                font-size: 17px;
            }

            .hospital-brand-icon {
                width: 36px;
                height: 36px;
                font-size: 16px;
            }

            .hospital-brand-subtitle {
                font-size: 8px;
            }

            .hospital-main {
                padding-top: 20px !important;
            }

            .hospital-user-name {
                max-width: 110px;
            }
        }

        @media (max-width: 575.98px) {

            .hospital-brand-subtitle {
                display: none;
            }

            .hospital-brand {
                font-size: 16px;
            }

            .hospital-user-name {
                display: none;
            }
        }
    </style>

    @yield('css')
</head>

<body>

    <div id="app">

        {{-- =========================
             NAVBAR
        ========================= --}}
        <nav class="navbar navbar-expand-md hospital-navbar">

            <div class="container">

                {{-- Brand --}}
                <a class="navbar-brand hospital-brand" href="{{ url('/') }}">

                    <span class="hospital-brand-icon">
                        <i class="fas fa-hospital"></i>
                    </span>

                    <span class="hospital-brand-text">
                        {{ config('app.name', 'Laravel') }}

                        <small class="hospital-brand-subtitle">
                            Hospital Management System
                        </small>
                    </span>

                </a>


                {{-- Mobile Toggle --}}
                <button
                    class="navbar-toggler"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent"
                    aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}"
                >
                    <span class="navbar-toggler-icon"></span>
                </button>


                <div
                    class="collapse navbar-collapse"
                    id="navbarSupportedContent"
                >

                    {{-- Left Side --}}
                    <ul class="navbar-nav me-auto">
                    </ul>


                    {{-- Right Side --}}
                    <ul class="navbar-nav ms-auto">

                        @guest

                            {{-- Login --}}
                            @if (Route::has('login'))
                                <li class="nav-item">

                                    <a
                                        class="nav-link"
                                        href="{{ route('login') }}"
                                    >
                                        <i class="fas fa-sign-in-alt mr-1"></i>
                                        {{ __('Login') }}
                                    </a>

                                </li>
                            @endif


                            {{-- Register --}}
                            @if (Route::has('register'))
                                <li class="nav-item">

                                    <a
                                        class="nav-link"
                                        href="{{ route('register') }}"
                                    >
                                        <i class="fas fa-user-plus mr-1"></i>
                                        {{ __('Register') }}
                                    </a>

                                </li>
                            @endif

                        @else

                            {{-- User Dropdown --}}
                            <li class="nav-item dropdown">

                                <a
                                    id="navbarDropdown"
                                    class="nav-link dropdown-toggle hospital-user-link"
                                    href="#"
                                    role="button"
                                    data-bs-toggle="dropdown"
                                    aria-haspopup="true"
                                    aria-expanded="false"
                                    v-pre
                                >

                                    <span class="hospital-user-avatar">
                                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                    </span>

                                    <span class="hospital-user-name">
                                        {{ Auth::user()->name }}
                                    </span>

                                </a>


                                <div
                                    class="dropdown-menu dropdown-menu-end hospital-dropdown"
                                    aria-labelledby="navbarDropdown"
                                >

                                    {{-- Logout --}}
                                    <a
                                        class="dropdown-item"
                                        href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();"
                                    >
                                        <i class="fas fa-sign-out-alt text-danger"></i>
                                        {{ __('Logout') }}
                                    </a>


                                    <form
                                        id="logout-form"
                                        action="{{ route('logout') }}"
                                        method="POST"
                                        class="d-none"
                                    >
                                        @csrf
                                    </form>

                                </div>

                            </li>

                        @endguest

                    </ul>

                </div>

            </div>

        </nav>


        {{-- =========================
             MAIN CONTENT
        ========================= --}}
        <main class="hospital-main">

            @yield('content')

        </main>

    </div>


    @yield('js')

</body>
</html>