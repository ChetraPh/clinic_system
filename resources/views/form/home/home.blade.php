@extends('adminlte::page')

@section('title', 'ផ្ទាំងព័ត៌មាន')

@section('content')
<div class="container-fluid py-3">

    {{-- Welcome Banner --}}
    <div class="dashboard-welcome">
        <div class="welcome-content">
            <div class="welcome-icon">
                <i class="fas fa-hospital-alt"></i>
            </div>

            <div class="welcome-text">
                <div class="welcome-label">
                    <i class="fas fa-hand-sparkles mr-1"></i>
                    សូមស្វាគមន៍មកកាន់
                </div>

                <h1>
                    {{ $setting->system_name ?? 'មន្ទីរសម្រាកព្យាបាលព្រំ សន្តិភាព' }}
                </h1>

                <p>
                    ប្រព័ន្ធគ្រប់គ្រងមន្ទីរព្យាបាល
                    ដែលជួយគ្រប់គ្រងអ្នកជំងឺ វេជ្ជបណ្ឌិត
                    ថ្នាំពេទ្យ ការណាត់ជួប ការទូទាត់
                    និងទិន្នន័យសុខាភិបាលប្រកបដោយប្រសិទ្ធភាព។
                </p>

                <a href="{{ url('department/department') }}" class="btn-dashboard">
                    <i class="fas fa-th-large mr-2"></i>
                    ប្រព័ន្ធគ្រប់គ្រង
                    <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>

        <div class="welcome-logo">
            <div class="logo-circle">
                <img
                    src="{{ $setting && $setting->logo
                        ? asset('storage/' . $setting->logo)
                        : asset('vendor/adminlte/dist/img/logo.jpg')
                    }}"
                    alt="Clinic Logo"
                >
            </div>

            <div class="logo-status">
                <span class="status-dot"></span>
                ប្រព័ន្ធកំពុងដំណើរការ
            </div>
        </div>
    </div>


    {{-- Feature Cards --}}
    <div class="section-heading">
        <div>
            <h3>មុខងារសំខាន់ៗ</h3>
            <p>គ្រប់គ្រងប្រព័ន្ធមន្ទីរព្យាបាលរបស់អ្នក</p>
        </div>
    </div>

    <div class="row">

        {{-- Doctor --}}
        <div class="col-xl-3 col-lg-6 col-md-6 mb-4">
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-user-md"></i>
                </div>

                <div class="feature-content">
                    <h4>វេជ្ជបណ្ឌិត</h4>
                    <p>គ្រប់គ្រងព័ត៌មាន និងការងាររបស់វេជ្ជបណ្ឌិត</p>
                </div>

                <div class="feature-arrow">
                    <i class="fas fa-arrow-right"></i>
                </div>
            </div>
        </div>

        {{-- Patient --}}
        <div class="col-xl-3 col-lg-6 col-md-6 mb-4">
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-user-injured"></i>
                </div>

                <div class="feature-content">
                    <h4>អ្នកជំងឺ</h4>
                    <p>គ្រប់គ្រងព័ត៌មាន និងប្រវត្តិអ្នកជំងឺ</p>
                </div>

                <div class="feature-arrow">
                    <i class="fas fa-arrow-right"></i>
                </div>
            </div>
        </div>

        {{-- Pharmacy --}}
        <div class="col-xl-3 col-lg-6 col-md-6 mb-4">
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-pills"></i>
                </div>

                <div class="feature-content">
                    <h4>ឱសថស្ថាន</h4>
                    <p>គ្រប់គ្រងថ្នាំ និងស្តុកឱសថ</p>
                </div>

                <div class="feature-arrow">
                    <i class="fas fa-arrow-right"></i>
                </div>
            </div>
        </div>

        {{-- Laboratory --}}
        <div class="col-xl-3 col-lg-6 col-md-6 mb-4">
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-flask"></i>
                </div>

                <div class="feature-content">
                    <h4>មន្ទីរពិសោធន៍</h4>
                    <p>គ្រប់គ្រងការធ្វើតេស្ត និងលទ្ធផលតេស្ត</p>
                </div>

                <div class="feature-arrow">
                    <i class="fas fa-arrow-right"></i>
                </div>
            </div>
        </div>

    </div>


    {{-- Clinic Information --}}
    <div class="info-section">

        <div class="info-header">
            <div class="info-header-icon">
                <i class="fas fa-info-circle"></i>
            </div>

            <div>
                <h3>ព័ត៌មានទំនាក់ទំនង</h3>
                <p>ព័ត៌មានទូទៅរបស់មន្ទីរព្យាបាល</p>
            </div>
        </div>

        <div class="row">

            {{-- Working Hours --}}
            <div class="col-lg-4 col-md-6 mb-3 mb-lg-0">
                <div class="info-item">
                    <div class="info-item-icon">
                        <i class="fas fa-clock"></i>
                    </div>

                    <div>
                        <span>ម៉ោងធ្វើការ</span>
                        <strong>
                            {{ $setting->working_hours ?? '07:00 AM - 08:00 PM' }}
                        </strong>
                    </div>
                </div>
            </div>

            {{-- Phone --}}
            <div class="col-lg-4 col-md-6 mb-3 mb-lg-0">
                <div class="info-item">
                    <div class="info-item-icon">
                        <i class="fas fa-phone-alt"></i>
                    </div>

                    <div>
                        <span>ទំនាក់ទំនង</span>
                        <strong>
                            {{ $setting->phone ?? '012 XXX XXX' }}
                        </strong>
                    </div>
                </div>
            </div>

            {{-- Address --}}
            <div class="col-lg-4 col-md-12">
                <div class="info-item">
                    <div class="info-item-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>

                    <div>
                        <span>ទីតាំង</span>
                        <strong>
                            {{ $setting->address ?? 'Cambodia' }}
                        </strong>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>
@endsection


@section('css')

<style>
    :root {
        --dashboard-green: #006D36;
        --dashboard-green-dark: #00552B;
        --dashboard-green-light: #E8F5EE;
        --dashboard-border: #E7ECE9;
        --dashboard-text: #1F2A24;
        --dashboard-muted: #7A8780;
        --dashboard-bg: #F5F7F6;
    }

    body {
        background: var(--dashboard-bg);
    }

    .content-wrapper {
        background: var(--dashboard-bg);
    }

    /* ==========================================
       Welcome Banner
    ========================================== */

    .dashboard-welcome {
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: space-between;
        min-height: 280px;
        padding: 38px 42px;
        border-radius: 16px;
        background: linear-gradient(
            135deg,
            #006D36 0%,
            #008747 100%
        );
        box-shadow: 0 8px 25px rgba(0, 109, 54, .16);
    }

    .dashboard-welcome::before {
        content: "";
        position: absolute;
        width: 320px;
        height: 320px;
        right: -110px;
        top: -150px;
        border-radius: 50%;
        background: rgba(255, 255, 255, .07);
    }

    .dashboard-welcome::after {
        content: "";
        position: absolute;
        width: 220px;
        height: 220px;
        right: 180px;
        bottom: -150px;
        border-radius: 50%;
        background: rgba(255, 255, 255, .05);
    }

    .welcome-content {
        position: relative;
        z-index: 2;
        display: flex;
        align-items: flex-start;
        max-width: 75%;
    }

    .welcome-icon {
        width: 58px;
        height: 58px;
        min-width: 58px;
        margin-right: 20px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(255, 255, 255, .16);
        border: 1px solid rgba(255, 255, 255, .18);
        color: #fff;
        font-size: 25px;
    }

    .welcome-label {
        margin-bottom: 8px;
        color: rgba(255, 255, 255, .82);
        font-size: 15px;
        font-weight: 600;
    }

    .welcome-text h1 {
        margin: 0 0 10px;
        color: #fff;
        font-size: 30px;
        line-height: 1.3;
        font-weight: 800;
    }

    .welcome-text p {
        max-width: 720px;
        margin: 0 0 22px;
        color: rgba(255, 255, 255, .84);
        font-size: 15px;
        line-height: 1.9;
    }

    .btn-dashboard {
        display: inline-flex;
        align-items: center;
        padding: 11px 20px;
        border-radius: 10px;
        background: #fff;
        color: var(--dashboard-green);
        font-size: 14px;
        font-weight: 700;
        text-decoration: none !important;
        transition: all .2s ease;
        box-shadow: 0 5px 15px rgba(0, 0, 0, .10);
    }

    .btn-dashboard:hover {
        color: var(--dashboard-green-dark);
        transform: translateY(-2px);
        box-shadow: 0 8px 18px rgba(0, 0, 0, .15);
    }

    .welcome-logo {
        position: relative;
        z-index: 2;
        width: 210px;
        text-align: center;
    }

    .logo-circle {
        width: 145px;
        height: 145px;
        margin: 0 auto 12px;
        padding: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: rgba(255, 255, 255, .95);
        border: 5px solid rgba(255, 255, 255, .18);
        box-shadow: 0 10px 30px rgba(0, 0, 0, .12);
    }

    .logo-circle img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        border-radius: 50%;
    }

    .logo-status {
        display: inline-flex;
        align-items: center;
        padding: 6px 11px;
        border-radius: 20px;
        background: rgba(255, 255, 255, .12);
        color: rgba(255, 255, 255, .9);
        font-size: 11px;
        font-weight: 600;
        white-space: nowrap;
    }

    .status-dot {
        width: 7px;
        height: 7px;
        margin-right: 6px;
        border-radius: 50%;
        background: #9FF0BD;
        box-shadow: 0 0 0 3px rgba(159, 240, 189, .12);
    }

    /* ==========================================
       Section Heading
    ========================================== */

    .section-heading {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin: 28px 0 18px;
    }

    .section-heading h3 {
        margin: 0 0 4px;
        color: var(--dashboard-text);
        font-size: 19px;
        font-weight: 800;
    }

    .section-heading p {
        margin: 0;
        color: var(--dashboard-muted);
        font-size: 13px;
    }

    /* ==========================================
       Feature Cards
    ========================================== */

    .feature-card {
        position: relative;
        height: 100%;
        min-height: 170px;
        padding: 24px;
        overflow: hidden;
        border: 1px solid var(--dashboard-border);
        border-radius: 15px;
        background: #fff;
        box-shadow: 0 4px 15px rgba(31, 42, 36, .04);
        transition: all .25s ease;
    }

    .feature-card::after {
        content: "";
        position: absolute;
        width: 90px;
        height: 90px;
        right: -35px;
        bottom: -40px;
        border-radius: 50%;
        background: var(--dashboard-green-light);
        transition: all .25s ease;
    }

    .feature-card:hover {
        transform: translateY(-4px);
        border-color: rgba(0, 109, 54, .18);
        box-shadow: 0 12px 28px rgba(31, 42, 36, .08);
    }

    .feature-card:hover::after {
        transform: scale(1.25);
    }

    .feature-icon {
        width: 52px;
        height: 52px;
        margin-bottom: 17px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 13px;
        background: var(--dashboard-green-light);
        color: var(--dashboard-green);
        font-size: 22px;
    }

    .feature-content {
        position: relative;
        z-index: 2;
    }

    .feature-content h4 {
        margin: 0 0 7px;
        color: var(--dashboard-text);
        font-size: 16px;
        font-weight: 800;
    }

    .feature-content p {
        max-width: 230px;
        margin: 0;
        color: var(--dashboard-muted);
        font-size: 13px;
        line-height: 1.7;
    }

    .feature-arrow {
        position: absolute;
        z-index: 3;
        right: 20px;
        bottom: 18px;
        color: var(--dashboard-green);
        font-size: 13px;
        opacity: .65;
        transition: all .2s ease;
    }

    .feature-card:hover .feature-arrow {
        right: 17px;
        opacity: 1;
    }

    /* ==========================================
       Clinic Information
    ========================================== */

    .info-section {
        margin-top: 8px;
        padding: 25px;
        border: 1px solid var(--dashboard-border);
        border-radius: 15px;
        background: #fff;
        box-shadow: 0 4px 15px rgba(31, 42, 36, .04);
    }

    .info-header {
        display: flex;
        align-items: center;
        margin-bottom: 22px;
    }

    .info-header-icon {
        width: 44px;
        height: 44px;
        margin-right: 13px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 11px;
        background: var(--dashboard-green-light);
        color: var(--dashboard-green);
        font-size: 18px;
    }

    .info-header h3 {
        margin: 0 0 3px;
        color: var(--dashboard-text);
        font-size: 17px;
        font-weight: 800;
    }

    .info-header p {
        margin: 0;
        color: var(--dashboard-muted);
        font-size: 12px;
    }

    .info-item {
        display: flex;
        align-items: center;
        min-height: 72px;
        padding: 13px 15px;
        border: 1px solid var(--dashboard-border);
        border-radius: 12px;
        background: #FAFCFB;
    }

    .info-item-icon {
        width: 42px;
        height: 42px;
        min-width: 42px;
        margin-right: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        background: var(--dashboard-green-light);
        color: var(--dashboard-green);
        font-size: 16px;
    }

    .info-item span {
        display: block;
        margin-bottom: 3px;
        color: var(--dashboard-muted);
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
    }

    .info-item strong {
        display: block;
        color: var(--dashboard-text);
        font-size: 13px;
        font-weight: 700;
        line-height: 1.5;
    }

    /* ==========================================
       Responsive
    ========================================== */

    @media (max-width: 1199.98px) {
        .welcome-content {
            max-width: 70%;
        }

        .welcome-logo {
            width: 180px;
        }

        .logo-circle {
            width: 125px;
            height: 125px;
        }
    }

    @media (max-width: 991.98px) {
        .dashboard-welcome {
            padding: 30px;
        }

        .welcome-content {
            max-width: 100%;
        }

        .welcome-logo {
            display: none;
        }

        .welcome-text h1 {
            font-size: 27px;
        }
    }

    @media (max-width: 767.98px) {
        .dashboard-welcome {
            min-height: auto;
            padding: 25px;
        }

        .welcome-content {
            display: block;
        }

        .welcome-icon {
            margin-bottom: 15px;
        }

        .welcome-text h1 {
            font-size: 23px;
        }

        .welcome-text p {
            font-size: 13px;
            line-height: 1.8;
        }

        .section-heading {
            margin-top: 22px;
        }

        .info-section {
            padding: 18px;
        }
    }

    @media (max-width: 575.98px) {
        .dashboard-welcome {
            padding: 20px;
            border-radius: 13px;
        }

        .welcome-text h1 {
            font-size: 20px;
        }

        .welcome-text p {
            font-size: 12px;
        }

        .btn-dashboard {
            width: 100%;
            justify-content: center;
        }

        .feature-card {
            min-height: 150px;
            padding: 20px;
        }

        .info-item {
            margin-bottom: 10px;
        }
    }
</style>

@stop
