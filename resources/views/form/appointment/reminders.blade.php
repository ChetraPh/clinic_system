@extends('adminlte::page')

@section('title', 'ការរំលឹកការណាត់ជួប')

@section('content')
<div class="container-fluid pt-3">

    {{-- Page Header --}}
    <div class="page-header mb-4">
        <div class="header-content">
            <div>
                <div class="header-icon">
                    <i class="fas fa-phone-volume"></i>
                </div>
                <div class="header-text">
                    <h2>ការរំលឹកការណាត់ជួប</h2>
                    <p>
                        ទូរស័ព្ទរំលឹកអ្នកជំងឺ សម្រាប់ថ្ងៃស្អែក
                        <span class="date-badge">
                            <i class="far fa-calendar-alt mr-1"></i>
                            {{ \Carbon\Carbon::tomorrow()->format('d/m/Y') }}
                        </span>
                    </p>
                </div>
            </div>

            <div class="header-date">
                <i class="fas fa-phone-alt mr-2"></i>
                Reminder
            </div>
        </div>
    </div>

    {{-- Statistics --}}
    @php
        $totalReminders = $appointments->count();
        $calledReminders = $appointments->whereNotNull('reminder_called_at')->count();
        $pendingReminders = $appointments->whereNull('reminder_called_at')->count();
    @endphp

    <div class="row mb-4">

        <div class="col-xl-4 col-md-4 col-sm-6 mb-3">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-calendar-check"></i>
                </div>
                <div class="stat-info">
                    <span class="stat-label">ការណាត់ជួបសរុប</span>
                    <h3>{{ $totalReminders }}</h3>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-4 col-sm-6 mb-3">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-phone"></i>
                </div>
                <div class="stat-info">
                    <span class="stat-label">បានទូរស័ព្ទ</span>
                    <h3>{{ $calledReminders }}</h3>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-4 col-sm-6 mb-3">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-phone-slash"></i>
                </div>
                <div class="stat-info">
                    <span class="stat-label">មិនទាន់ទូរស័ព្ទ</span>
                    <h3>{{ $pendingReminders }}</h3>
                </div>
            </div>
        </div>

    </div>

    {{-- Main Table Card --}}
    <div class="reminder-card">

        <div class="card-top">
            <div>
                <h5>
                    <i class="fas fa-phone-volume mr-2"></i>
                    បញ្ជីអ្នកជំងឺត្រូវរំលឹក
                </h5>
                <p>សូមទាក់ទងអ្នកជំងឺដែលមានការណាត់ជួបនៅថ្ងៃស្អែក</p>
            </div>

            <div class="total-badge">
                <i class="fas fa-users mr-1"></i>
                {{ $totalReminders }} នាក់
            </div>
        </div>

        <div class="table-wrapper">
            <div class="table-responsive">
                <table class="table reminder-table mb-0">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>ថ្ងៃ</th>
                            <th>ម៉ោង</th>
                            <th>អ្នកជំងឺ</th>
                            <th>លេខទូរស័ព្ទ</th>
                            <th>វេជ្ជបណ្ឌិត</th>
                            <th>ស្ថានភាព</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($appointments as $a)
                            <tr>

                                {{-- Number --}}
                                <td class="text-center">
                                    <span class="row-number">
                                        {{ $loop->iteration }}
                                    </span>
                                </td>

                                {{-- Date --}}
                                <td>
                                    <div class="date-info">
                                        <i class="far fa-calendar-alt"></i>
                                        <span>
                                            {{ $a->appointment_date->format('d/m/Y') }}
                                        </span>
                                    </div>
                                </td>

                                {{-- Time --}}
                                <td>
                                    <div class="time-info">
                                        <i class="far fa-clock"></i>
                                        <strong>
                                            {{ $a->appointment_date->format('h:i A') }}
                                        </strong>
                                    </div>
                                </td>

                                {{-- Patient --}}
                                <td>
                                    <div class="person-info">
                                        <div class="person-avatar">
                                            <i class="fas fa-user"></i>
                                        </div>
                                        <div>
                                            <div class="person-name">
                                                {{ $a->patient->full_name ?? 'N/A' }}
                                            </div>
                                            <small>អ្នកជំងឺ</small>
                                        </div>
                                    </div>
                                </td>

                                {{-- Phone --}}
                                <td>
                                    @if($a->patient && $a->patient->phone)
                                        <a
                                            href="tel:{{ preg_replace('/\s+/', '', $a->patient->phone) }}"
                                            class="phone-link"
                                        >
                                            <span class="phone-icon">
                                                <i class="fas fa-phone-alt"></i>
                                            </span>
                                            <span>{{ $a->patient->phone }}</span>
                                        </a>
                                    @else
                                        <span class="no-phone">
                                            <i class="fas fa-minus mr-1"></i>
                                            មិនមានលេខ
                                        </span>
                                    @endif
                                </td>

                                {{-- Doctor --}}
                                <td>
                                    <div class="person-info doctor-info">
                                        <div class="doctor-avatar">
                                            <i class="fas fa-user-md"></i>
                                        </div>
                                        <div>
                                            <div class="person-name">
                                                {{ $a->doctor->name ?? 'N/A' }}
                                            </div>
                                            <small>វេជ្ជបណ្ឌិត</small>
                                        </div>
                                    </div>
                                </td>

                                {{-- Status --}}
                                <td class="call-status">

                                    @if($a->reminder_called_at)

                                        <div class="called-status">
                                            <div class="status-check">
                                                <i class="fas fa-check"></i>
                                            </div>

                                            <div>
                                                <div class="called-title">
                                                    បានទូរស័ព្ទ
                                                </div>

                                                <div class="called-detail">
                                                    <i class="far fa-clock mr-1"></i>
                                                    {{ $a->reminder_called_at->format('h:i A') }}
                                                </div>

                                                <div class="caller-name">
                                                    <i class="fas fa-user mr-1"></i>
                                                    {{ $a->caller->name ?? '-' }}
                                                </div>
                                            </div>
                                        </div>

                                    @else

                                        <div class="pending-status">
                                            <span class="pending-badge">
                                                <i class="fas fa-exclamation-circle mr-1"></i>
                                                មិនទាន់ទូរស័ព្ទ
                                            </span>

                                            <button
                                                type="button"
                                                class="btn btn-called"
                                                data-url="{{ route('appointment.reminders.called', $a->appointment_id) }}"
                                            >
                                                <i class="fas fa-phone-alt mr-1"></i>
                                                បានទូរស័ព្ទហើយ
                                            </button>
                                        </div>

                                    @endif

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="7">
                                    <div class="empty-state">
                                        <div class="empty-icon">
                                            <i class="fas fa-phone-slash"></i>
                                        </div>

                                        <h5>គ្មានការណាត់ជួបត្រូវរំលឹក</h5>

                                        <p>
                                            គ្មានការណាត់ជួបត្រូវរំលឹកសម្រាប់ថ្ងៃស្អែកទេ
                                        </p>
                                    </div>
                                </td>
                            </tr>

                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</div>
@stop

@section('css')
<style>
    :root {
        --reminder-green: #006D36;
        --reminder-green-dark: #00552B;
        --reminder-green-light: #E8F5EE;
        --reminder-bg: #F5F7F6;
        --reminder-border: #E7ECE9;
        --reminder-text: #1F2A24;
        --reminder-muted: #7A8780;
    }

    body {
        background: var(--reminder-bg);
    }

    .content-wrapper {
        background: var(--reminder-bg);
    }

    /* Header */
    .page-header {
        background: linear-gradient(
            135deg,
            #006D36 0%,
            #008747 100%
        );
        border-radius: 16px;
        padding: 24px 28px;
        color: #fff;
        box-shadow: 0 5px 18px rgba(0, 109, 54, 0.15);
    }

    .header-content {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
    }

    .header-content > div:first-child {
        display: flex;
        align-items: center;
    }

    .header-icon {
        width: 58px;
        height: 58px;
        background: rgba(255, 255, 255, 0.18);
        border: 1px solid rgba(255, 255, 255, 0.25);
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 25px;
        margin-right: 17px;
    }

    .header-text h2 {
        font-size: 24px;
        font-weight: 700;
        margin: 0 0 5px;
    }

    .header-text p {
        margin: 0;
        font-size: 14px;
        opacity: .92;
    }

    .date-badge {
        display: inline-flex;
        align-items: center;
        margin-left: 8px;
        padding: 5px 10px;
        border-radius: 7px;
        background: rgba(255, 255, 255, .16);
        font-weight: 600;
    }

    .header-date {
        background: #fff;
        color: var(--reminder-green);
        padding: 10px 16px;
        border-radius: 9px;
        font-size: 13px;
        font-weight: 700;
        white-space: nowrap;
    }

    /* Statistics */
    .stat-card {
        background: #fff;
        border: 1px solid var(--reminder-border);
        border-radius: 14px;
        padding: 18px;
        display: flex;
        align-items: center;
        min-height: 94px;
        box-shadow: 0 3px 12px rgba(31, 42, 36, .04);
        transition: all .2s ease;
    }

    .stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 18px rgba(31, 42, 36, .08);
    }

    .stat-icon {
        width: 52px;
        height: 52px;
        border-radius: 12px;
        background: var(--reminder-green-light);
        color: var(--reminder-green);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 21px;
        margin-right: 15px;
        flex-shrink: 0;
    }

    .stat-label {
        display: block;
        color: var(--reminder-muted);
        font-size: 12px;
        margin-bottom: 3px;
    }

    .stat-info h3 {
        margin: 0;
        color: var(--reminder-text);
        font-size: 25px;
        font-weight: 700;
    }

    /* Main Card */
    .reminder-card {
        background: #fff;
        border: 1px solid var(--reminder-border);
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(31, 42, 36, .05);
    }

    .card-top {
        padding: 20px 22px;
        border-bottom: 1px solid var(--reminder-border);
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
    }

    .card-top h5 {
        color: var(--reminder-text);
        font-size: 16px;
        font-weight: 700;
        margin: 0 0 4px;
    }

    .card-top h5 i {
        color: var(--reminder-green);
    }

    .card-top p {
        color: var(--reminder-muted);
        font-size: 12px;
        margin: 0;
    }

    .total-badge {
        background: var(--reminder-green-light);
        color: var(--reminder-green);
        padding: 8px 13px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 700;
        white-space: nowrap;
    }

    /* Table */
    .table-wrapper {
        width: 100%;
    }

    .reminder-table {
        min-width: 1180px;
        color: var(--reminder-text);
    }

    .reminder-table thead th {
        background: #F8FAF9;
        color: #66736C;
        border-top: 0;
        border-bottom: 1px solid var(--reminder-border);
        padding: 13px 14px;
        font-size: 10px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .4px;
        white-space: nowrap;
    }

    .reminder-table tbody td {
        border-top: 1px solid #EEF2F0;
        padding: 14px;
        vertical-align: middle;
        font-size: 13px;
    }

    .reminder-table tbody tr {
        transition: background .15s ease;
    }

    .reminder-table tbody tr:hover {
        background: #FAFCFB;
    }

    /* Row Number */
    .row-number {
        width: 30px;
        height: 30px;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: var(--reminder-green-light);
        color: var(--reminder-green);
        font-size: 11px;
        font-weight: 700;
    }

    /* Date */
    .date-info,
    .time-info {
        display: flex;
        align-items: center;
        white-space: nowrap;
    }

    .date-info i {
        color: var(--reminder-green);
        margin-right: 8px;
    }

    .time-info i {
        color: var(--reminder-green);
        margin-right: 8px;
    }

    .time-info strong {
        color: var(--reminder-text);
    }

    /* Person */
    .person-info {
        display: flex;
        align-items: center;
        min-width: 175px;
    }

    .person-avatar,
    .doctor-avatar {
        width: 38px;
        height: 38px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--reminder-green-light);
        color: var(--reminder-green);
        margin-right: 10px;
        flex-shrink: 0;
    }

    .doctor-avatar {
        background: #F1F5F3;
    }

    .person-name {
        font-size: 13px;
        font-weight: 600;
        color: var(--reminder-text);
        white-space: nowrap;
    }

    .person-info small {
        color: var(--reminder-muted);
        font-size: 10px;
    }

    /* Phone */
    .phone-link {
        display: inline-flex;
        align-items: center;
        color: var(--reminder-green);
        font-weight: 600;
        text-decoration: none;
        white-space: nowrap;
    }

    .phone-link:hover {
        color: var(--reminder-green-dark);
        text-decoration: none;
    }

    .phone-icon {
        width: 29px;
        height: 29px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 7px;
        background: var(--reminder-green-light);
        margin-right: 7px;
        font-size: 11px;
    }

    .no-phone {
        color: var(--reminder-muted);
        font-size: 12px;
    }

    /* Called Status */
    .called-status {
        display: flex;
        align-items: center;
        min-width: 170px;
    }

    .status-check {
        width: 34px;
        height: 34px;
        border-radius: 50%;
        background: #E8F5EE;
        color: #008747;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 9px;
        flex-shrink: 0;
        font-size: 13px;
    }

    .called-title {
        color: #008747;
        font-weight: 700;
        font-size: 12px;
    }

    .called-detail,
    .caller-name {
        color: var(--reminder-muted);
        font-size: 10px;
        margin-top: 2px;
    }

    .caller-name {
        color: #6F7C75;
    }

    /* Pending Status */
    .pending-status {
        min-width: 190px;
    }

    .pending-badge {
        display: inline-block;
        background: #FFF4D6;
        color: #9A7000;
        border-radius: 7px;
        padding: 6px 9px;
        font-size: 10px;
        font-weight: 700;
        margin-bottom: 7px;
    }

    .btn-called {
        display: block;
        border: 1px solid var(--reminder-green);
        color: var(--reminder-green);
        background: #fff;
        border-radius: 7px;
        padding: 6px 10px;
        font-size: 11px;
        font-weight: 600;
        transition: all .2s ease;
    }

    .btn-called:hover {
        background: var(--reminder-green);
        color: #fff;
        box-shadow: 0 3px 8px rgba(0, 109, 54, .18);
    }

    .btn-called:disabled {
        opacity: .65;
        cursor: not-allowed;
    }

    /* Empty */
    .empty-state {
        padding: 55px 20px;
        text-align: center;
    }

    .empty-icon {
        width: 65px;
        height: 65px;
        border-radius: 50%;
        background: var(--reminder-green-light);
        color: var(--reminder-green);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 15px;
        font-size: 25px;
    }

    .empty-state h5 {
        color: var(--reminder-text);
        font-size: 15px;
        font-weight: 700;
        margin-bottom: 5px;
    }

    .empty-state p {
        color: var(--reminder-muted);
        font-size: 12px;
        margin: 0;
    }

    /* Responsive */
    @media (max-width: 767.98px) {
        .page-header {
            padding: 20px;
        }

        .header-content {
            align-items: flex-start;
        }

        .header-date {
            display: none;
        }

        .header-icon {
            width: 48px;
            height: 48px;
            font-size: 20px;
            margin-right: 12px;
        }

        .header-text h2 {
            font-size: 19px;
        }

        .header-text p {
            font-size: 12px;
        }

        .date-badge {
            margin-left: 0;
            margin-top: 5px;
        }

        .card-top {
            align-items: flex-start;
            flex-direction: column;
        }

        .stat-card {
            min-height: 85px;
        }
    }

    @media (max-width: 575.98px) {
        .container-fluid {
            padding-left: 10px;
            padding-right: 10px;
        }

        .page-header {
            border-radius: 12px;
        }

        .header-text h2 {
            font-size: 17px;
        }

        .header-text p {
            font-size: 11px;
        }
    }
</style>
@stop

@section('js')
<script>
$(function () {

    $(document).on('click', '.btn-called', function () {

        var $btn = $(this);

        if ($btn.prop('disabled')) {
            return;
        }

        $btn.prop('disabled', true);

        $btn.find('i')
            .removeClass('fa-phone-alt')
            .addClass('fa-spinner fa-spin');

        fetch($btn.data('url'), {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(function (response) {

            return response.json().then(function (json) {
                return {
                    ok: response.ok,
                    json: json
                };
            });

        })
        .then(function (result) {

            if (!result.ok) {
                throw new Error(result.json.message || 'error');
            }

            var $cell = $btn.closest('.call-status').empty();

            var $status = $('<div class="called-status">');

            var $icon = $('<div class="status-check">')
                .append('<i class="fas fa-check"></i>');

            var $content = $('<div>');

            $('<div class="called-title">')
                .text('បានទូរស័ព្ទ')
                .appendTo($content);

            $('<div class="called-detail">')
                .append('<i class="far fa-clock mr-1"></i>')
                .append(document.createTextNode(result.json.at))
                .appendTo($content);

            $('<div class="caller-name">')
                .append('<i class="fas fa-user mr-1"></i>')
                .append(document.createTextNode(result.json.by))
                .appendTo($content);

            $status
                .append($icon)
                .append($content);

            $cell.append($status);

        })
        .catch(function () {

            $btn.prop('disabled', false);

            $btn.find('i')
                .removeClass('fa-spinner fa-spin')
                .addClass('fa-phone-alt');

            alert('មានបញ្ហា សូមព្យាយាមម្តងទៀត');
        });
    });

});
</script>
@stop