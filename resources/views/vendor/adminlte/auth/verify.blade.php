@extends('adminlte::auth.auth-page', ['authType' => 'login'])

@section('adminlte_css_pre')
    <style>
        .verify-logo-wrap {
            width: 92px;
            height: 92px;
            margin: 0 auto 18px;
            padding: 6px;
            border-radius: 20px;
            background: #eef8f2;
            border: 1px solid #d8eee1;
            box-shadow: 0 8px 22px rgba(0, 109, 54, 0.10);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .verify-logo-wrap img {
            width: 78px !important;
            height: 78px !important;
            display: block !important;
            object-fit: contain !important;
            border-radius: 14px;
            margin: 0 !important;
        }

        .verify-title {
            color: #006D36;
            font-size: 24px;
            font-weight: 700;
            text-align: center;
            margin-bottom: 8px;
        }

        .verify-subtitle {
            color: #7A8780;
            font-size: 13px;
            text-align: center;
            margin-bottom: 22px;
        }

        .verify-message {
            padding: 18px;
            border-radius: 13px;
            background: #f7faf8;
            border: 1px solid #e3ece7;
            color: #56645c;
            font-size: 13px;
            line-height: 1.9;
            margin-bottom: 18px;
            text-align: center;
        }

        .verify-button {
            width: 100%;
            border: 0;
            border-radius: 10px;
            padding: 11px 16px;
            background: #006D36 !important;
            color: #fff !important;
            font-weight: 700;
            font-size: 13px;
            box-shadow: 0 7px 18px rgba(0, 109, 54, 0.18);
            transition: all .2s ease;
        }

        .verify-button:hover {
            background: #00552B !important;
            transform: translateY(-1px);
        }

        .verify-alert {
            border: 0;
            border-radius: 10px;
            background: #eaf7ef;
            color: #176b3b;
            font-size: 12px;
            text-align: center;
            margin-bottom: 18px;
        }

        .verify-footer {
            text-align: center;
            margin-top: 18px;
            color: #9aa59f;
            font-size: 11px;
        }

        .verify-footer i {
            color: #006D36;
            margin-right: 4px;
        }
    </style>
@stop

@section('auth_header')
    <div class="verify-logo-wrap">
        <img
            src="{{ asset('images/logo.jpg') }}"
            alt="Prum Santepheap Logo"
        >
    </div>

    <div class="verify-title">
        បញ្ជាក់អ៊ីមែល
    </div>

    <div class="verify-subtitle">
        សូមបញ្ជាក់អ៊ីមែលរបស់អ្នក ដើម្បីបន្តប្រើប្រាស់ប្រព័ន្ធ
    </div>
@stop

@section('auth_body')

    @if(session('resent'))
        <div class="alert verify-alert" role="alert">
            <i class="fas fa-check-circle mr-1"></i>
            {{ __('adminlte::adminlte.verify_email_sent') }}
        </div>
    @endif

    <div class="verify-message">
        <i class="fas fa-envelope-open-text text-success mb-2"></i>
        <br>

        {{ __('adminlte::adminlte.verify_check_your_email') }}

        <br>

        {{ __('adminlte::adminlte.verify_if_not_recieved') }}
    </div>

    <form method="POST" action="{{ route('verification.resend') }}">
        @csrf

        <button type="submit" class="verify-button">
            <i class="fas fa-paper-plane mr-1"></i>
            {{ __('adminlte::adminlte.verify_request_another') }}
        </button>
    </form>

    <div class="verify-footer">
        <i class="fas fa-shield-alt"></i>
        សុវត្ថិភាពគណនីរបស់អ្នកសំខាន់សម្រាប់យើង
    </div>

@stop