@extends('adminlte::page')

@section('title', 'Support Center')

@section('content')

<style>
    :root {
        --support-green: #006D36;
        --support-green-dark: #00552B;
        --support-green-light: #E8F5EE;
        --support-bg: #F5F7F6;
        --support-border: #E7ECE9;
        --support-text: #1F2A24;
        --support-muted: #7A8780;
    }

    .support-page {
        padding-top: 8px;
        padding-bottom: 25px;
    }

    /* Header */
    .support-header {
        background: linear-gradient(135deg, #006D36 0%, #008747 100%);
        border-radius: 16px;
        padding: 24px 28px;
        margin-bottom: 22px;
        box-shadow: 0 8px 22px rgba(0, 109, 54, 0.16);
        color: #fff;
    }

    .support-header-content {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
    }

    .support-title-wrapper {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .support-title-icon {
        width: 52px;
        height: 52px;
        border-radius: 13px;
        background: rgba(255, 255, 255, 0.16);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
    }

    .support-title {
        margin: 0;
        font-size: 23px;
        font-weight: 700;
        color: #fff;
    }

    .support-subtitle {
        margin: 4px 0 0;
        font-size: 13px;
        color: rgba(255, 255, 255, 0.82);
    }

    .btn-emergency {
        border: 0;
        background: #fff;
        color: var(--support-green);
        border-radius: 10px;
        padding: 11px 20px;
        font-weight: 700;
        box-shadow: 0 4px 12px rgba(0, 0, 0, .08);
        transition: all .2s ease;
    }

    .btn-emergency:hover {
        background: #f3f8f5;
        color: var(--support-green-dark);
        transform: translateY(-1px);
    }

    /* Cards */
    .support-card {
        border: 1px solid var(--support-border) !important;
        border-radius: 16px !important;
        background: #fff;
        box-shadow: 0 5px 18px rgba(31, 42, 36, 0.05) !important;
        overflow: hidden;
    }

    .support-card-header {
        padding: 18px 22px;
        background: #fff;
        border-bottom: 1px solid var(--support-border);
        display: flex;
        align-items: center;
        gap: 11px;
    }

    .support-card-header-icon {
        width: 39px;
        height: 39px;
        border-radius: 10px;
        background: var(--support-green-light);
        color: var(--support-green);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 15px;
    }

    .support-card-header h5 {
        margin: 0;
        color: var(--support-text);
        font-size: 15px;
        font-weight: 700;
    }

    .support-card-header small {
        display: block;
        margin-top: 2px;
        color: var(--support-muted);
        font-size: 11px;
    }

    .support-card-body {
        padding: 22px;
    }

    /* Developer */
    .developer-card {
        height: 100%;
        background: #fff;
        text-align: center;
        border-radius: 15px;
        padding: 24px 20px;
        border: 1px solid var(--support-border);
        transition: all .25s ease;
    }

    .developer-card:hover {
        transform: translateY(-4px);
        border-color: rgba(0, 109, 54, .25);
        box-shadow: 0 12px 28px rgba(31, 42, 36, .08);
    }

    .developer-avatar {
        width: 92px;
        height: 92px;
        border-radius: 50%;
        margin: 0 auto 14px;
        border: 4px solid var(--support-green);
        padding: 2px;
        background: var(--support-green-light);
        overflow: hidden;
    }

    .developer-card img {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        object-fit: cover;
        object-position: center;
    }

    .developer-card h5 {
        color: var(--support-text);
        font-size: 16px;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .developer-role {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        background: var(--support-green-light);
        color: var(--support-green-dark);
        border-radius: 20px;
        padding: 5px 10px;
        font-size: 10px;
        font-weight: 700;
    }

    .developer-divider {
        margin: 15px 0;
        border-top: 1px solid var(--support-border);
    }

    .developer-contact {
        margin-bottom: 8px !important;
        color: var(--support-muted);
        font-size: 12px;
        text-align: left;
        display: flex;
        align-items: center;
        gap: 9px;
        word-break: break-word;
    }

    .developer-contact i {
        width: 25px;
        height: 25px;
        border-radius: 7px;
        background: var(--support-green-light);
        color: var(--support-green);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 11px;
        flex-shrink: 0;
    }

    .developer-contact span {
        color: var(--support-text);
    }

    .copy-phone {
        border-color: var(--support-green);
        color: var(--support-green);
        border-radius: 8px;
        font-size: 11px;
        font-weight: 600;
        margin-top: 7px;
        transition: all .2s ease;
    }

    .copy-phone:hover {
        background: var(--support-green);
        color: #fff;
    }

    /* System Information */
    .system-card-header {
        background: linear-gradient(135deg, #006D36 0%, #008747 100%);
        color: #fff;
        border: 0;
        padding: 17px 20px;
        font-size: 14px;
        font-weight: 700;
    }

    .system-card-header i {
        margin-right: 8px;
    }

    .system-table {
        margin: 0;
    }

    .system-table tr {
        border-bottom: 1px solid #F0F3F1;
    }

    .system-table tr:last-child {
        border-bottom: 0;
    }

    .system-table td {
        padding: 11px 0;
        font-size: 12px;
        vertical-align: middle;
    }

    .system-table td:first-child {
        color: var(--support-muted);
    }

    .system-table td:last-child {
        color: var(--support-text);
        font-weight: 600;
        text-align: right;
    }

    .version-badge {
        background: var(--support-green-light);
        color: var(--support-green-dark);
        border-radius: 20px;
        padding: 4px 9px;
        font-size: 10px;
        font-weight: 700;
    }

    /* Emergency */
    .emergency-card-header {
        background: linear-gradient(135deg, #B42318 0%, #D92D20 100%);
        color: #fff;
        border: 0;
        padding: 17px 20px;
        font-size: 14px;
        font-weight: 700;
    }

    .emergency-card-body {
        padding: 20px;
    }

    .emergency-phone {
        color: var(--support-text);
        font-size: 21px;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .emergency-phone i {
        color: #D92D20;
        font-size: 18px;
    }

    .emergency-email {
        color: var(--support-muted);
        font-size: 12px;
        margin-bottom: 6px;
        word-break: break-word;
    }

    .emergency-hours {
        color: var(--support-muted);
        font-size: 11px;
    }

    .emergency-status {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #FEF3F2;
        color: #B42318;
        border-radius: 20px;
        padding: 5px 9px;
        font-size: 10px;
        font-weight: 700;
        margin-top: 12px;
    }

    .emergency-status i {
        font-size: 7px;
    }

    /* FAQ */
    .faq-card {
        border: 1px solid var(--support-border) !important;
        border-radius: 16px !important;
        overflow: hidden;
    }

    .faq-header {
        background: #fff;
        border-bottom: 1px solid var(--support-border);
        padding: 18px 22px;
        display: flex;
        align-items: center;
        gap: 11px;
    }

    .faq-header-icon {
        width: 39px;
        height: 39px;
        border-radius: 10px;
        background: var(--support-green-light);
        color: var(--support-green);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 15px;
    }

    .faq-header h5 {
        margin: 0;
        color: var(--support-text);
        font-size: 15px;
        font-weight: 700;
    }

    .faq-body {
        padding: 20px 22px;
    }

    .faq-item {
        border: 1px solid var(--support-border);
        border-radius: 11px;
        overflow: hidden;
        margin-bottom: 10px;
    }

    .faq-item:last-child {
        margin-bottom: 0;
    }

    .faq-question {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 14px 16px;
        background: #FAFCFB;
        color: var(--support-text);
        font-size: 13px;
        font-weight: 600;
        text-decoration: none !important;
        transition: all .2s ease;
    }

    .faq-question:hover {
        color: var(--support-green);
        background: var(--support-green-light);
    }

    .faq-question i {
        color: var(--support-green);
        font-size: 11px;
        transition: transform .2s ease;
    }

    .faq-answer {
        padding: 14px 16px;
        border-top: 1px solid var(--support-border);
        color: var(--support-muted);
        font-size: 12px;
        line-height: 1.7;
        background: #fff;
    }

    /* Responsive */
    @media (max-width: 991.98px) {
        .support-header {
            padding: 20px;
        }

        .support-card-body {
            padding: 20px;
        }

        .developer-card {
            padding: 22px 17px;
        }
    }

    @media (max-width: 767.98px) {
        .support-header-content {
            align-items: flex-start;
            flex-direction: column;
        }

        .btn-emergency {
            width: 100%;
        }

        .support-title {
            font-size: 20px;
        }

        .support-card-body,
        .faq-body {
            padding: 16px;
        }
    }

    @media (max-width: 575.98px) {
        .support-header {
            border-radius: 13px;
            padding: 17px;
        }

        .support-title-icon {
            width: 45px;
            height: 45px;
        }

        .developer-card {
            padding: 20px 15px;
        }
    }
</style>

<div class="support-page">

    {{-- Header --}}
    <div class="support-header">

        <div class="support-header-content">

            <div class="support-title-wrapper">

                <div class="support-title-icon">
                    <i class="fas fa-headset"></i>
                </div>

                <div>
                    <h2 class="support-title">
                        Support Center
                    </h2>

                    <p class="support-subtitle">
                        ត្រូវការជំនួយមែនទេ? អាចទាក់ទងក្រុមអភិវឌ្ឍន៍បានគ្រប់ពេលវេលា
                    </p>
                </div>

            </div>

            <button class="btn-emergency">
                <i class="fas fa-phone mr-2"></i>
                ជំនួយការបន្ទាន់
            </button>

        </div>

    </div>


    <div class="row">

        {{-- Developers --}}
        <div class="col-lg-8 mb-4 mb-lg-0">

            <div class="card support-card">

                <div class="support-card-header">

                    <div class="support-card-header-icon">
                        <i class="fas fa-users"></i>
                    </div>

                    <div>
                        <h5>ក្រុមអភិវឌ្ឍន៍</h5>
                        <small>
                            Development & Support Team
                        </small>
                    </div>

                </div>

                <div class="support-card-body">

                    <div class="row">

                        {{-- Developer 1 --}}
                        <div class="col-md-6 mb-4">

                            <div class="developer-card">

                                <div class="developer-avatar">
                                    <img src="{{ asset('images/supportteam/ChhivSereyMeyling.png') }}"
                                         alt="Developer 1">
                                </div>

                                <h5>
                                    ឈីវ សិរីម៉ីលិញ
                                </h5>

                                <span class="developer-role">
                                    <i class="fas fa-crown"></i>
                                    មេក្រុម
                                </span>

                                <hr class="developer-divider">

                                <p class="developer-contact">
                                    <i class="fas fa-phone"></i>
                                    <span>012 345 678</span>
                                </p>

                                <p class="developer-contact">
                                    <i class="fas fa-envelope"></i>
                                    <span>meyling@gmail.com</span>
                                </p>

                                <button class="btn btn-outline-success btn-sm copy-phone"
                                        data-copy="012345678">
                                    <i class="far fa-copy mr-1"></i>
                                    Copy Phone
                                </button>

                            </div>

                        </div>


                        {{-- Developer 2 --}}
                        <div class="col-md-6 mb-4">

                            <div class="developer-card">

                                <div class="developer-avatar">
                                    <img src="{{ asset('images/supportteam/chandany.png') }}"
                                         alt="Developer 2">
                                </div>

                                <h5>
                                    ចាន់ ដានី
                                </h5>

                                <span class="developer-role">
                                    <i class="fas fa-user"></i>
                                    សមាជិកក្រុម
                                </span>

                                <hr class="developer-divider">

                                <p class="developer-contact">
                                    <i class="fas fa-phone"></i>
                                    <span>012 345 678</span>
                                </p>

                                <p class="developer-contact">
                                    <i class="fas fa-envelope"></i>
                                    <span>dany@gmail.com</span>
                                </p>

                                <button class="btn btn-outline-success btn-sm copy-phone"
                                        data-copy="012345678">
                                    <i class="far fa-copy mr-1"></i>
                                    Copy Phone
                                </button>

                            </div>

                        </div>


                        {{-- Developer 3 --}}
                        <div class="col-md-6 mb-4">

                            <div class="developer-card">

                                <div class="developer-avatar">
                                    <img src="{{ asset('images/supportteam/deounthavy.png') }}"
                                         alt="Developer 3">
                                </div>

                                <h5>
                                    ឌឿន ថាវី
                                </h5>

                                <span class="developer-role">
                                    <i class="fas fa-user"></i>
                                    សមាជិកក្រុម
                                </span>

                                <hr class="developer-divider">

                                <p class="developer-contact">
                                    <i class="fas fa-phone"></i>
                                    <span>012 345 678</span>
                                </p>

                                <p class="developer-contact">
                                    <i class="fas fa-envelope"></i>
                                    <span>thavy@gmail.com</span>
                                </p>

                                <button class="btn btn-outline-success btn-sm copy-phone"
                                        data-copy="012345678">
                                    <i class="far fa-copy mr-1"></i>
                                    Copy Phone
                                </button>

                            </div>

                        </div>


                        {{-- Developer 4 --}}
                        <div class="col-md-6 mb-4">

                            <div class="developer-card">

                                <div class="developer-avatar">
                                    <img src="{{ asset('images/supportteam/namvanna.png') }}"
                                         alt="Developer 4">
                                </div>

                                <h5>
                                    ណាំ វណ្ណា
                                </h5>

                                <span class="developer-role">
                                    <i class="fas fa-user"></i>
                                    សមាជិកក្រុម
                                </span>

                                <hr class="developer-divider">

                                <p class="developer-contact">
                                    <i class="fas fa-phone"></i>
                                    <span>012 345 678</span>
                                </p>

                                <p class="developer-contact">
                                    <i class="fas fa-envelope"></i>
                                    <span>vanna@gmail.com</span>
                                </p>

                                <button class="btn btn-outline-success btn-sm copy-phone"
                                        data-copy="012345678">
                                    <i class="far fa-copy mr-1"></i>
                                    Copy Phone
                                </button>

                            </div>

                        </div>


                        {{-- Developer 5 --}}
                        <div class="col-md-6 mb-4 mb-md-0">

                            <div class="developer-card">

                                <div class="developer-avatar">
                                    <img src="{{ asset('images/supportteam/phenchentra.png') }}"
                                         alt="Developer 5">
                                </div>

                                <h5>
                                    ផេន ចិត្រ្តា
                                </h5>

                                <span class="developer-role">
                                    <i class="fas fa-user"></i>
                                    សមាជិកក្រុម
                                </span>

                                <hr class="developer-divider">

                                <p class="developer-contact">
                                    <i class="fas fa-phone"></i>
                                    <span>012 345 678</span>
                                </p>

                                <p class="developer-contact">
                                    <i class="fas fa-envelope"></i>
                                    <span>chentra@gmail.com</span>
                                </p>

                                <button class="btn btn-outline-success btn-sm copy-phone"
                                        data-copy="012345678">
                                    <i class="far fa-copy mr-1"></i>
                                    Copy Phone
                                </button>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- Right --}}
        <div class="col-lg-4">

            {{-- System Information --}}
            <div class="card support-card mb-4">

                <div class="card-header system-card-header">

                    <i class="fas fa-server"></i>
                    ព័ត៌មានប្រព័ន្ធ

                </div>

                <div class="card-body">

                    <table class="table table-borderless table-sm system-table">

                        <tr>
                            <td>ជំនាន់</td>
                            <td>
                                <span class="version-badge">
                                    1.0.0
                                </span>
                            </td>
                        </tr>

                        <tr>
                            <td>Laravel</td>
                            <td>8</td>
                        </tr>

                        <tr>
                            <td>PHP</td>
                            <td>8.2</td>
                        </tr>

                        <tr>
                            <td>Database</td>
                            <td>MySQL</td>
                        </tr>

                        <tr>
                            <td>Server</td>
                            <td>Ubuntu</td>
                        </tr>

                    </table>

                </div>

            </div>


            {{-- Emergency --}}
            <div class="card support-card">

                <div class="card-header emergency-card-header">
                    <i class="fas fa-exclamation-triangle mr-2"></i>
                    Emergency Contact
                </div>

                <div class="emergency-card-body">

                    <h4 class="emergency-phone">
                        <i class="fas fa-phone-alt mr-2"></i>
                        012 888 999
                    </h4>

                    <p class="emergency-email">
                        <i class="fas fa-envelope mr-2"></i>
                        {{ $setting->email ?? 'contact@gmail.com' }}
                    </p>

                    <small class="emergency-hours">
                        <i class="far fa-clock mr-1"></i>
                        {{ $setting->working_hours ?? '07:00 AM - 08:00 PM' }}
                    </small>

                    <div class="emergency-status">
                        <i class="fas fa-circle"></i>
                        Support Available
                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- FAQ --}}
    <div class="card faq-card mt-4">

        <div class="faq-header">

            <div class="faq-header-icon">
                <i class="fas fa-question-circle"></i>
            </div>

            <div>
                <h5>
                    សំណួរញឹកញាប់ (FAQ)
                </h5>
            </div>

        </div>

        <div class="faq-body">

            <div id="faq">

                {{-- Question 1 --}}
                <div class="faq-item">

                    <a class="faq-question"
                       data-toggle="collapse"
                       href="#q1">

                        <span>
                            ខ្ញុំភ្លេចលេខសម្ងាត់សម្រាប់ចូល
                        </span>

                        <i class="fas fa-chevron-down"></i>

                    </a>

                    <div id="q1"
                         class="collapse"
                         data-parent="#faq">

                        <div class="faq-answer">
                            សូមទាក់ទងអ្នកគ្រប់គ្រងប្រព័ន្ធរបស់អ្នក
                            ដើម្បីកំណត់លេខសម្ងាត់របស់អ្នកឡើងវិញ។
                        </div>

                    </div>

                </div>


                {{-- Question 2 --}}
                <div class="faq-item">

                    <a class="faq-question collapsed"
                       data-toggle="collapse"
                       href="#q2">

                        <span>
                            មិនអាចប្រើប្រាស់ព្រីនបាន
                        </span>

                        <i class="fas fa-chevron-down"></i>

                    </a>

                    <div id="q2"
                         class="collapse"
                         data-parent="#faq">

                        <div class="faq-answer">
                            សូមចាប់ផ្តើមព្រីនឡើងវិញ
                            ហើយព្យាយាមម្តងទៀត។
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@stop


@section('js')
@parent

<script>
    $(function () {

        $('.copy-phone').on('click', function () {

            const btn = $(this);
            const phone = btn.data('copy');
            const originalText =
                '<i class="far fa-copy mr-1"></i> Copy Phone';

            if (navigator.clipboard) {

                navigator.clipboard.writeText(phone).then(function () {

                    btn.html(
                        '<i class="fas fa-check mr-1"></i> Copied'
                    );

                    setTimeout(function () {
                        btn.html(originalText);
                    }, 2000);

                });

            } else {

                const tempInput = $('<input>');
                $('body').append(tempInput);

                tempInput.val(phone).select();
                document.execCommand('copy');

                tempInput.remove();

                btn.html(
                    '<i class="fas fa-check mr-1"></i> Copied'
                );

                setTimeout(function () {
                    btn.html(originalText);
                }, 2000);
            }

        });

    });
</script>

@stop