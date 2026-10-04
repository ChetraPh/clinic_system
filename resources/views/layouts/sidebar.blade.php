{{-- =========================
     HOSPITAL SIDEBAR
========================= --}}

<aside class="main-sidebar sidebar-light-primary elevation-4 hms-sidebar">

    {{-- =========================
         BRAND
    ========================= --}}

    <a href="{{ route('dashboard') }}"
   class="brand-link hms-brand"
   style="display:flex !important; align-items:center !important;">

    <img
        src="{{ asset('images/logo.jpg') }}"
        alt="Prum Santepheap Logo"
        style="
            width:40px !important;
            height:40px !important;
            min-width:40px !important;
            max-width:40px !important;
            object-fit:contain !important;
            display:block !important;
            opacity:1 !important;
            visibility:visible !important;
            margin-right:10px !important;
        "
    >

    <span
        class="brand-text hms-brand-text"
        style="
            display:block !important;
            opacity:1 !important;
            visibility:visible !important;
        "
    >
        PrumSantepheap
    </span>

</a>


    {{-- =========================
         SIDEBAR
    ========================= --}}

    <div class="sidebar">

        {{-- =========================
             USER PANEL
        ========================= --}}

        <div class="user-panel hms-user-panel">

            <div class="image">

                <div class="hms-user-avatar">
                    {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}
                </div>

            </div>

            <div class="info">

                <a href="#" class="hms-user-name">
                    {{ Auth::user()->name ?? 'User' }}
                </a>

                <span class="hms-user-role">

                    <i class="fas fa-circle"></i>

                    {{ Auth::user()->roles->pluck('name')->first() ?? 'Member' }}

                </span>

            </div>

        </div>


        {{-- =========================
             NAVIGATION
        ========================= --}}

        <nav class="mt-2">

            <ul
                class="nav nav-pills nav-sidebar flex-column hms-nav"
                data-widget="treeview"
                role="menu"
                data-accordion="false"
            >

                {{-- =========================
                     DASHBOARD
                ========================= --}}

                <li class="nav-item">

                    <a
                        href="{{ route('dashboard') }}"
                        class="nav-link {{ request()->is('dashboard*') ? 'active' : '' }}"
                    >

                        <i class="nav-icon fas fa-tachometer-alt"></i>

                        <p>
                            ផ្ទាំងព័ត៌មាន
                            <span>Dashboard</span>
                        </p>

                    </a>

                </li>


                {{-- =========================
                     DEPARTMENT
                ========================= --}}

                <li class="nav-item">

                    <a
                        href="{{ route('department.index') }}"
                        class="nav-link {{ request()->is('department*') ? 'active' : '' }}"
                    >

                        <i class="nav-icon fas fa-sitemap"></i>

                        <p>
                            ដេប៉ាតឺម៉ង់
                            <span>Department</span>
                        </p>

                    </a>

                </li>


                {{-- =========================
                     CLINICAL
                ========================= --}}

                @hasanyrole('admin|doctor|nurse')

                    <li class="nav-header hms-nav-header">
                        <i class="fas fa-stethoscope mr-1"></i>
                        ការងារព្យាបាល
                    </li>

                    {{-- Doctor --}}
                    <li class="nav-item">

                        <a
                            href="{{ url('doctor') }}"
                            class="nav-link {{ request()->is('doctor*') ? 'active' : '' }}"
                        >

                            <i class="nav-icon fas fa-user-md"></i>

                            <p>
                                វេជ្ជបណ្ឌិត
                                <span>Doctors</span>
                            </p>

                        </a>

                    </li>


                    {{-- Patients --}}
                    <li class="nav-item">

                        <a
                            href="{{ url('patients') }}"
                            class="nav-link {{ request()->is('patients*') || request()->is('patient*') ? 'active' : '' }}"
                        >

                            <i class="nav-icon fas fa-user-injured"></i>

                            <p>
                                អ្នកជំងឺ
                                <span>Patients</span>
                            </p>

                        </a>

                    </li>


                    {{-- Appointments --}}
                    <li class="nav-item">

                        <a
                            href="{{ url('appointments') }}"
                            class="nav-link {{ request()->is('appointments*') || request()->is('appointment*') ? 'active' : '' }}"
                        >

                            <i class="nav-icon fas fa-calendar-check"></i>

                            <p>
                                ការណាត់ជួប
                                <span>Appointments</span>
                            </p>

                        </a>

                    </li>


                    {{-- Laboratory --}}
                    <li class="nav-item">

                        <a
                            href="{{ url('lab') }}"
                            class="nav-link {{ request()->is('lab*') ? 'active' : '' }}"
                        >

                            <i class="nav-icon fas fa-flask"></i>

                            <p>
                                មន្ទីរពិសោធន៍
                                <span>Laboratory</span>
                            </p>

                        </a>

                    </li>

                @endhasanyrole


                {{-- =========================
                     PHARMACY
                ========================= --}}

                @hasanyrole('admin|pharmacist')

                    <li class="nav-header hms-nav-header">
                        <i class="fas fa-pills mr-1"></i>
                        ឱសថស្ថាន
                    </li>

                    <li class="nav-item">

                        <a
                            href="{{ route('pharmacy.index') }}"
                            class="nav-link {{ request()->is('pharmacy*') ? 'active' : '' }}"
                        >

                            <i class="nav-icon fas fa-pills"></i>

                            <p>
                                ឱសថស្ថាន
                                <span>Pharmacy</span>
                            </p>

                        </a>

                    </li>

                @endhasanyrole


                {{-- =========================
                     FINANCE
                ========================= --}}

                @hasanyrole('admin|cashier')

                    <li class="nav-header hms-nav-header">
                        <i class="fas fa-wallet mr-1"></i>
                        ហិរញ្ញវត្ថុ
                    </li>

                    <li class="nav-item">

                        <a
                            href="{{ route('billing.index') }}"
                            class="nav-link {{ request()->is('billing*') ? 'active' : '' }}"
                        >

                            <i class="nav-icon fas fa-file-invoice-dollar"></i>

                            <p>
                                ការទូទាត់ប្រាក់
                                <span>Billing</span>
                            </p>

                        </a>

                    </li>

                @endhasanyrole


                {{-- =========================
                     ADMIN
                ========================= --}}

                @hasrole('admin')

                    <li class="nav-header hms-nav-header">
                        <i class="fas fa-user-shield mr-1"></i>
                        ការគ្រប់គ្រងប្រព័ន្ធ
                    </li>


                    {{-- User Management --}}
                    <li class="nav-item">

                        <a
                            href="{{ route('user.index') }}"
                            class="nav-link {{ request()->is('user*') ? 'active' : '' }}"
                        >

                            <i class="nav-icon fas fa-users"></i>

                            <p>
                                គ្រប់គ្រងអ្នកប្រើប្រាស់
                                <span>Users</span>
                            </p>

                        </a>

                    </li>


                    {{-- Settings --}}
                    <li class="nav-item {{ request()->is('settings*') ? 'menu-open' : '' }}">

                        <a
                            href="#"
                            class="nav-link {{ request()->is('settings*') ? 'active' : '' }}"
                        >

                            <i class="nav-icon fas fa-cogs"></i>

                            <p>
                                ការកំណត់ប្រព័ន្ធ
                                <span>Settings</span>
                                <i class="right fas fa-angle-left"></i>
                            </p>

                        </a>


                        <ul class="nav nav-treeview hms-submenu">

                            {{-- General --}}
                            <li class="nav-item">

                                <a
                                    href="{{ route('settingsgeneral.index') }}"
                                    class="nav-link {{ request()->is('settings/general*') ? 'active' : '' }}"
                                >

                                    <i class="far fa-circle nav-icon"></i>

                                    <p>
                                        ការកំណត់ទូទៅ
                                        <span>General</span>
                                    </p>

                                </a>

                            </li>


                            {{-- Billing --}}
                            <li class="nav-item">

                                <a
                                    href="{{ route('settingsbillings.index') }}"
                                    class="nav-link {{ request()->is('settings/billing*') ? 'active' : '' }}"
                                >

                                    <i class="far fa-circle nav-icon"></i>

                                    <p>
                                        ការកំណត់វិក្កយបត្រ
                                        <span>Billing</span>
                                    </p>

                                </a>

                            </li>


                            {{-- QR Code --}}
                            <li class="nav-item">

                                <a
                                    href="{{ route('settingsqrcode.index') }}"
                                    class="nav-link {{ request()->is('settings/qrcode*') ? 'active' : '' }}"
                                >

                                    <i class="far fa-circle nav-icon"></i>

                                    <p>
                                        ការកំណត់ QR Code
                                        <span>QR Code</span>
                                    </p>

                                </a>

                            </li>


                            {{-- Backup --}}
                            <li class="nav-item">

                                <a
                                    href="{{ route('settingsbackup.index') }}"
                                    class="nav-link {{ request()->is('settings/backup*') ? 'active' : '' }}"
                                >

                                    <i class="far fa-circle nav-icon"></i>

                                    <p>
                                        ការបម្រុងទុកទិន្នន័យ
                                        <span>Backup</span>
                                    </p>

                                </a>

                            </li>

                        </ul>

                    </li>

                @endhasrole


                {{-- =========================
                     SUPPORT
                ========================= --}}

                <li class="nav-item hms-support-item">

                    <a
                        href="{{ route('support.index') }}"
                        class="nav-link {{ request()->is('support*') ? 'active' : '' }}"
                    >

                        <i class="nav-icon fas fa-life-ring"></i>

                        <p>
                            ជំនួយ
                            <span>Support</span>
                        </p>

                    </a>

                </li>

            </ul>

        </nav>

    </div>

</aside>


{{-- =========================
     SIDEBAR STYLE
========================= --}}

<style>

    :root {
        --sidebar-green: #006D36;
        --sidebar-green-dark: #00552B;
        --sidebar-green-light: #E8F5EE;
        --sidebar-border: #E5EAE7;
        --sidebar-text: #2F3934;
        --sidebar-muted: #7A8580;
    }

    .hms-sidebar {
        background: #ffffff !important;
        border-right: 1px solid var(--sidebar-border);
        box-shadow: 4px 0 18px rgba(31, 42, 36, .04) !important;
    }

    /* =========================
       BRAND
    ========================= */

    .hms-brand {
        height: 68px !important;
        min-height: 68px !important;
        width: 100% !important;

        display: flex !important;
        align-items: center !important;

        padding: 10px 17px !important;

        border-bottom: 1px solid var(--sidebar-border);
        background: #ffffff !important;

        text-decoration: none !important;

        overflow: hidden !important;
        white-space: nowrap !important;
    }

    .hms-brand-logo {
        width: 40px !important;
        height: 40px !important;
        min-width: 40px !important;
        max-width: 40px !important;

        border-radius: 11px;

        padding: 3px;

        background: var(--sidebar-green-light);

        display: flex !important;
        align-items: center !important;
        justify-content: center !important;

        margin-right: 10px;

        flex-shrink: 0 !important;

        overflow: hidden;
    }

    .hms-brand-logo img {
        display: block !important;

        width: 34px !important;
        height: 34px !important;

        min-width: 34px !important;
        min-height: 34px !important;

        object-fit: contain !important;
        object-position: center !important;

        border-radius: 9px;

        opacity: 1 !important;
        visibility: visible !important;

        flex-shrink: 0 !important;
    }

    .hms-brand-text {
        display: block !important;

        color: var(--sidebar-green) !important;

        font-size: 17px;
        font-weight: 800 !important;

        letter-spacing: -.2px;

        white-space: nowrap !important;

        opacity: 1 !important;
        visibility: visible !important;
    }


    /* =========================
       COLLAPSED SIDEBAR
    ========================= */

    body.sidebar-mini.sidebar-collapse .main-sidebar {
        width: 4.6rem !important;
    }

    body.sidebar-mini.sidebar-collapse .hms-brand {
        width: 4.6rem !important;

        justify-content: center !important;

        padding: 10px 0 !important;
    }

    body.sidebar-mini.sidebar-collapse .hms-brand-logo {
        width: 38px !important;
        height: 38px !important;

        min-width: 38px !important;
        max-width: 38px !important;

        margin: 0 !important;

        padding: 3px !important;
    }

    body.sidebar-mini.sidebar-collapse .hms-brand-logo img {
        width: 32px !important;
        height: 32px !important;

        min-width: 32px !important;
        min-height: 32px !important;
    }

    body.sidebar-mini.sidebar-collapse .hms-brand-text {
        display: none !important;
        visibility: hidden !important;
        opacity: 0 !important;
    }


    /* =========================
       KEEP COLLAPSED ON HOVER
    ========================= */

    body.sidebar-mini.sidebar-collapse .main-sidebar:hover {
        width: 4.6rem !important;
    }

    body.sidebar-mini.sidebar-collapse .main-sidebar:hover .hms-brand {
        width: 4.6rem !important;

        justify-content: center !important;

        padding: 10px 0 !important;
    }

    body.sidebar-mini.sidebar-collapse .main-sidebar:hover .hms-brand-logo {
        width: 38px !important;
        height: 38px !important;

        min-width: 38px !important;
        max-width: 38px !important;

        margin: 0 !important;
    }

    body.sidebar-mini.sidebar-collapse .main-sidebar:hover .hms-brand-logo img {
        width: 32px !important;
        height: 32px !important;
    }

    body.sidebar-mini.sidebar-collapse .main-sidebar:hover .hms-brand-text {
        display: none !important;
        visibility: hidden !important;
        opacity: 0 !important;
    }


    /* =========================
       USER PANEL
    ========================= */

    .hms-user-panel {
        margin: 14px 12px 10px !important;
        padding: 12px 10px !important;

        border: 1px solid var(--sidebar-border);
        border-radius: 12px;

        background: #FAFCFB;

        display: flex;
        align-items: center;
    }

    .hms-user-panel .image {
        padding-left: 0 !important;
    }

    .hms-user-avatar {
        width: 40px;
        height: 40px;

        border-radius: 11px;

        background: var(--sidebar-green-light);
        color: var(--sidebar-green);

        display: flex;
        align-items: center;
        justify-content: center;

        font-size: 15px;
        font-weight: 800;
    }

    .hms-user-panel .info {
        padding-left: 9px !important;
        min-width: 0;
    }

    .hms-user-name {
        display: block;

        color: var(--sidebar-text) !important;

        font-size: 12px;
        font-weight: 700;

        max-width: 145px;

        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;

        text-decoration: none !important;
    }

    .hms-user-role {
        display: inline-flex;
        align-items: center;

        color: var(--sidebar-green);

        font-size: 10px;
        font-weight: 600;

        text-transform: capitalize;

        margin-top: 3px;
    }

    .hms-user-role i {
        font-size: 5px;
        margin-right: 5px;
        color: #24A05A;
    }


    /* =========================
       NAVIGATION
    ========================= */

    .hms-nav {
        padding: 0 9px 15px;
    }

    .hms-nav .nav-item {
        margin-bottom: 2px;
    }

    .hms-nav .nav-link {
        min-height: 43px;

        display: flex;
        align-items: center;

        border-radius: 10px;

        padding: 7px 11px;

        color: #5D6862;

        font-size: 12px;
        font-weight: 600;

        transition:
            background-color .15s ease,
            color .15s ease,
            transform .15s ease;
    }

    .hms-nav .nav-link:hover {
        background: #F3F8F5;
        color: var(--sidebar-green);
        transform: translateX(1px);
    }

    .hms-nav .nav-link.active {
        background: linear-gradient(
            135deg,
            var(--sidebar-green) 0%,
            #008747 100%
        );

        color: #ffffff !important;

        box-shadow: 0 5px 12px rgba(0, 109, 54, .14);
    }

    .hms-nav .nav-icon {
        width: 27px;

        margin-right: 5px;

        font-size: 14px;

        color: #7B8781;

        transition: color .15s ease;
    }

    .hms-nav .nav-link:hover .nav-icon {
        color: var(--sidebar-green);
    }

    .hms-nav .nav-link.active .nav-icon {
        color: #ffffff;
    }

    .hms-nav .nav-link p {
        display: flex;

        flex: 1;

        align-items: center;
        justify-content: space-between;

        margin: 0;

        line-height: 1.2;
    }

    .hms-nav .nav-link p span {
        color: #9AA39E;

        font-size: 9px;
        font-weight: 500;

        margin-left: auto;
        padding-left: 5px;
    }

    .hms-nav .nav-link.active p span {
        color: rgba(255, 255, 255, .72);
    }


    /* =========================
       SECTION HEADER
    ========================= */

    .hms-nav-header {
        padding: 15px 11px 7px !important;
        margin: 0 !important;

        color: #9AA39E !important;

        font-size: 9px !important;
        letter-spacing: .7px;

        font-weight: 800 !important;
    }

    .hms-nav-header i {
        color: var(--sidebar-green);
        font-size: 9px;
    }


    /* =========================
       SETTINGS
    ========================= */

    .hms-nav .menu-open > .nav-link {
        color: var(--sidebar-green);
    }

    .hms-nav .menu-open > .nav-link .nav-icon {
        color: var(--sidebar-green);
    }

    .hms-nav .menu-open > .nav-link .right {
        transform: rotate(-90deg);
    }

    .hms-nav .right {
        color: #9AA39E;

        font-size: 10px;

        transition: transform .2s ease;
    }

    .hms-submenu {
        padding: 3px 0 4px 12px !important;
    }

    .hms-submenu .nav-link {
        min-height: 38px;

        border-radius: 8px;

        padding: 6px 10px;

        font-size: 11px;
    }

    .hms-submenu .nav-icon {
        width: 20px;

        font-size: 7px;

        margin-right: 5px;
    }

    .hms-submenu .nav-link p span {
        font-size: 8px;
    }


    /* =========================
       SUPPORT
    ========================= */

    .hms-support-item {
        margin-top: 14px !important;

        padding-top: 10px;

        border-top: 1px solid var(--sidebar-border);
    }


    /* =========================
       SIDEBAR SCROLLBAR
    ========================= */

    .hms-sidebar .sidebar::-webkit-scrollbar {
        width: 5px;
    }

    .hms-sidebar .sidebar::-webkit-scrollbar-track {
        background: transparent;
    }

    .hms-sidebar .sidebar::-webkit-scrollbar-thumb {
        background: #D8E1DC;
        border-radius: 10px;
    }

    .hms-sidebar .sidebar::-webkit-scrollbar-thumb:hover {
        background: #BFCBC4;
    }


    /* =========================
       RESPONSIVE
    ========================= */

    @media (max-width: 991.98px) {

        .hms-brand {
            height: 60px !important;
            min-height: 60px !important;
        }

        .hms-brand-text {
            font-size: 15px;
        }

    }

</style>