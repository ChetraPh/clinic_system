@extends('adminlte::page')

@section('title', 'Cashier Dashboard')

@section('content')

<div class="container-fluid cashier-wrap">

    {{-- =========================================
        HEADER
    ========================================= --}}
    <div class="cashier-header">

        <div class="cashier-header-content">

            <div class="cashier-title-wrap">

                <div class="cashier-header-icon">
                    <i class="fas fa-file-invoice-dollar"></i>
                </div>

                <div>
                    <h2 class="cashier-title">
                        ផ្ទាំងគ្រប់គ្រងបេឡា
                    </h2>

                    <p class="cashier-subtitle">
                        ការគ្រប់គ្រងវិក្កយបត្រ ការប្រមូលប្រាក់ទូទាត់ និងទូទាត់ KHQR
                    </p>
                </div>

            </div>


            <a href="{{ route('billing.index') }}"
               class="cashier-new-invoice">

                <i class="fas fa-plus-circle"></i>

                <span>
                    វិក្កយបត្រថ្មី
                </span>

            </a>

        </div>

    </div>


    {{-- =========================================
        STAT CARDS
    ========================================= --}}
    <div class="row cashier-stat-row">

        {{-- Unpaid --}}
        <div class="col-6 col-md-6 col-xl-3 mb-3">

            <div class="cashier-stat-card">

                <div class="cashier-stat-top">

                    <span class="cashier-stat-icon icon-warning">
                        <i class="fas fa-clock"></i>
                    </span>

                    <span class="cashier-stat-badge badge-warning-soft">
                        <i class="fas fa-exclamation-circle"></i>
                        មិនទាន់បង់
                    </span>

                </div>

                <div class="cashier-stat-label">
                    វិក្កយបត្រមិនទាន់បង់
                </div>

                <div class="cashier-stat-value">
                    {{ $unpaidInvoicesCount }}
                </div>

                <div class="cashier-stat-bottom">
                    <span>
                        ប្រាក់ជំពាក់
                    </span>

                    <strong class="text-danger">
                        ${{ number_format($unpaidInvoicesTotal, 2) }}
                    </strong>
                </div>

            </div>

        </div>


        {{-- Cash Today --}}
        <div class="col-6 col-md-6 col-xl-3 mb-3">

            <div class="cashier-stat-card">

                <div class="cashier-stat-top">

                    <span class="cashier-stat-icon icon-success">
                        <i class="fas fa-money-bill-wave"></i>
                    </span>

                    <span class="cashier-stat-badge badge-success-soft">
                        <i class="fas fa-check"></i>
                        ថ្ងៃនេះ
                    </span>

                </div>

                <div class="cashier-stat-label">
                    ប្រាក់ស្រស់ថ្ងៃនេះ
                </div>

                <div class="cashier-stat-value text-success">
                    ${{ number_format($todayCashRevenue, 2) }}
                </div>

                <div class="cashier-stat-bottom">
                    <span>
                        Cash Revenue
                    </span>

                    <i class="fas fa-arrow-up text-success"></i>
                </div>

            </div>

        </div>


        {{-- KHQR --}}
        <div class="col-6 col-md-6 col-xl-3 mb-3">

            <div class="cashier-stat-card">

                <div class="cashier-stat-top">

                    <span class="cashier-stat-icon icon-primary">
                        <i class="fas fa-qrcode"></i>
                    </span>

                    <span class="cashier-stat-badge badge-primary-soft">
                        <i class="fas fa-qrcode"></i>
                        KHQR
                    </span>

                </div>

                <div class="cashier-stat-label">
                    KHQR ថ្ងៃនេះ
                </div>

                <div class="cashier-stat-value text-primary">
                    ${{ number_format($todayKhqrRevenue, 2) }}
                </div>

                <div class="cashier-stat-bottom">
                    <span>
                        KHQR Revenue
                    </span>

                    <i class="fas fa-qrcode text-primary"></i>
                </div>

            </div>

        </div>


        {{-- Total Today --}}
        <div class="col-6 col-md-6 col-xl-3 mb-3">

            <div class="cashier-stat-card">

                <div class="cashier-stat-top">

                    <span class="cashier-stat-icon icon-info">
                        <i class="fas fa-chart-bar"></i>
                    </span>

                    <span class="cashier-stat-badge badge-info-soft">
                        <i class="fas fa-calendar-day"></i>
                        ថ្ងៃនេះ
                    </span>

                </div>

                <div class="cashier-stat-label">
                    ចំណូលសរុបថ្ងៃនេះ
                </div>

                <div class="cashier-stat-value text-info">
                    ${{ number_format($todayTotalRevenue, 2) }}
                </div>

                <div class="cashier-stat-bottom">
                    <span>
                        Total Revenue
                    </span>

                    <i class="fas fa-chart-line text-info"></i>
                </div>

            </div>

        </div>

    </div>


    {{-- =========================================
        MAIN TABLES
    ========================================= --}}
    <div class="row">

        {{-- =====================================
            UNPAID INVOICES
        ====================================== --}}
        <div class="col-lg-6 mb-3">

            <div class="cashier-panel h-100">

                <div class="cashier-panel-header">

                    <div class="panel-heading">

                        <span class="panel-heading-icon warning-heading">
                            <i class="fas fa-exclamation-triangle"></i>
                        </span>

                        <div>
                            <h5 class="panel-title">
                                វិក្កយបត្រមិនទាន់បង់
                            </h5>

                            <p class="panel-subtitle">
                                Unpaid Invoices
                            </p>
                        </div>

                    </div>


                    <a href="{{ route('billing.index') }}"
                       class="panel-view-all">

                        មើលទាំងអស់

                        <i class="fas fa-arrow-right"></i>

                    </a>

                </div>


                <div class="cashier-table-wrap">

                    <div class="table-responsive">

                        <table class="table cashier-table mb-0">

                            <thead>
                                <tr>
                                    <th>
                                        លេខវិក្កយបត្រ
                                    </th>

                                    <th>
                                        អ្នកជំងឺ
                                    </th>

                                    <th>
                                        ចំនួនប្រាក់
                                    </th>

                                    <th class="text-right">
                                        សកម្មភាព
                                    </th>
                                </tr>
                            </thead>


                            <tbody>

                                @forelse($unpaidInvoicesList as $inv)

                                    <tr>

                                        <td>

                                            <div class="cashier-invoice-number">

                                                <span class="invoice-small-icon">
                                                    <i class="fas fa-file-invoice"></i>
                                                </span>

                                                <span>
                                                    {{ $inv->invoice_number }}
                                                </span>

                                            </div>

                                        </td>


                                        <td>

                                            <div class="cashier-patient">

                                                <span class="patient-small-icon">
                                                    <i class="fas fa-user"></i>
                                                </span>

                                                <span class="patient-name">
                                                    {{ $inv->patient_name ?? (optional($inv->patient)->name ?? 'N/A') }}
                                                </span>

                                            </div>

                                        </td>


                                        <td>

                                            <span class="invoice-amount-due">
                                                ${{ number_format($inv->total_amount, 2) }}
                                            </span>

                                        </td>


                                        <td class="text-right">

                                            <a href="{{ route('billing.show', $inv->id) }}"
                                               class="btn cashier-pay-btn">

                                                <i class="fas fa-hand-holding-usd"></i>

                                                <span>
                                                    ទូទាត់
                                                </span>

                                            </a>

                                        </td>

                                    </tr>

                                @empty

                                    <tr>

                                        <td colspan="4"
                                            class="cashier-empty">

                                            <div class="empty-table-icon">
                                                <i class="fas fa-file-invoice"></i>
                                            </div>

                                            <div class="empty-table-title">
                                                គ្មានវិក្កយបត្រមិនទាន់បង់ទេ
                                            </div>

                                            <div class="empty-table-text">
                                                មិនមាន Unpaid Invoice នៅពេលនេះ
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


        {{-- =====================================
            RECENT PAYMENTS
        ====================================== --}}
        <div class="col-lg-6 mb-3">

            <div class="cashier-panel h-100">

                <div class="cashier-panel-header">

                    <div class="panel-heading">

                        <span class="panel-heading-icon success-heading">
                            <i class="fas fa-receipt"></i>
                        </span>

                        <div>
                            <h5 class="panel-title">
                                ប្រតិបត្តិការទូទាត់ចុងក្រោយ
                            </h5>

                            <p class="panel-subtitle">
                                Recent Payments
                            </p>
                        </div>

                    </div>

                </div>


                <div class="cashier-table-wrap">

                    <div class="table-responsive">

                        <table class="table cashier-table mb-0">

                            <thead>

                                <tr>

                                    <th>
                                        វិក្កយបត្រ
                                    </th>

                                    <th>
                                        វិធីសាស្ត្រ
                                    </th>

                                    <th>
                                        ប្រាក់បង់
                                    </th>

                                    <th class="text-right">
                                        កាលបរិច្ឆេទ
                                    </th>

                                </tr>

                            </thead>


                            <tbody>

                                @forelse($recentPayments as $pay)

                                    <tr>

                                        <td>

                                            <div class="cashier-invoice-number">

                                                <span class="invoice-small-icon">
                                                    <i class="fas fa-receipt"></i>
                                                </span>

                                                <span>
                                                    {{ $pay->invoice->invoice_number ?? '#' . $pay->invoice_id }}
                                                </span>

                                            </div>

                                        </td>


                                        <td>

                                            @if (strtolower($pay->payment_method) === 'khqr')

                                                <span class="payment-method payment-khqr">

                                                    <i class="fas fa-qrcode"></i>

                                                    KHQR

                                                </span>

                                            @else

                                                <span class="payment-method payment-cash">

                                                    <i class="fas fa-money-bill-wave"></i>

                                                    Cash

                                                </span>

                                            @endif

                                        </td>


                                        <td>

                                            <span class="payment-amount">
                                                ${{ number_format($pay->amount, 2) }}
                                            </span>

                                        </td>


                                        <td class="text-right">

                                            <div class="payment-date">

                                                <i class="far fa-clock"></i>

                                                {{ optional($pay->paid_at)->format('H:i, d M') }}

                                            </div>

                                        </td>

                                    </tr>

                                @empty

                                    <tr>

                                        <td colspan="4"
                                            class="cashier-empty">

                                            <div class="empty-table-icon">
                                                <i class="fas fa-receipt"></i>
                                            </div>

                                            <div class="empty-table-title">
                                                គ្មានប្រតិបត្តិការថ្មីៗទេ
                                            </div>

                                            <div class="empty-table-text">
                                                មិនមានការទូទាត់ថ្មីនៅពេលនេះ
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

    </div>

</div>

@stop


@section('css')

@parent

<style>

    :root {
        --cashier-green: #006D36;
        --cashier-green-dark: #00552B;
        --cashier-green-soft: #EAF6EF;

        --cashier-ink: #1F2A24;
        --cashier-muted: #7A8780;

        --cashier-border: #E8ECEA;
        --cashier-bg: #F5F7F6;

        --cashier-warning: #D99000;
        --cashier-danger: #DC3545;
        --cashier-blue: #2F80ED;
        --cashier-info: #1597A8;
    }


    body,
    .content-wrapper {
        background: var(--cashier-bg);
        color: var(--cashier-ink);
    }


    .cashier-wrap {
        padding-top: 4px;
        padding-bottom: 20px;
    }


    /* =========================================
       HEADER
    ========================================= */

    .cashier-header {
        position: relative;
        overflow: hidden;
        margin-bottom: 16px;
        border-radius: 15px;
        background: var(--cashier-green);
        box-shadow: 0 5px 18px rgba(0, 109, 54, .13);
    }


    .cashier-header::after {
        content: "";
        position: absolute;
        width: 170px;
        height: 170px;
        right: -55px;
        top: -85px;
        border-radius: 50%;
        background: rgba(255, 255, 255, .06);
    }


    .cashier-header::before {
        content: "";
        position: absolute;
        width: 100px;
        height: 100px;
        right: 80px;
        bottom: -65px;
        border-radius: 50%;
        background: rgba(255, 255, 255, .04);
    }


    .cashier-header-content {
        position: relative;
        z-index: 2;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        padding: 18px 20px;
    }


    .cashier-title-wrap {
        display: flex;
        align-items: center;
        gap: 13px;
        min-width: 0;
    }


    .cashier-header-icon {
        width: 45px;
        height: 45px;
        border-radius: 12px;
        background: rgba(255, 255, 255, .14);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        font-size: 18px;
    }


    .cashier-title {
        margin: 0;
        color: #fff;
        font-size: 20px;
        font-weight: 800;
    }


    .cashier-subtitle {
        margin: 4px 0 0;
        color: rgba(255, 255, 255, .72);
        font-size: 10px;
        font-weight: 500;
    }


    .cashier-new-invoice {
        position: relative;
        z-index: 3;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        padding: 9px 14px;
        border-radius: 9px;
        background: #fff;
        color: var(--cashier-green) !important;
        font-size: 10px;
        font-weight: 750;
        text-decoration: none !important;
        white-space: nowrap;
        transition: all .18s ease;
    }


    .cashier-new-invoice:hover {
        background: #F3F8F5;
        transform: translateY(-1px);
        box-shadow: 0 5px 14px rgba(0, 0, 0, .10);
    }


    /* =========================================
       STAT CARDS
    ========================================= */

    .cashier-stat-card {
        height: 100%;
        padding: 15px;
        background: #fff;
        border: 1px solid var(--cashier-border);
        border-radius: 14px;
        box-shadow: 0 3px 13px rgba(31, 42, 36, .035);
        transition: all .18s ease;
    }


    .cashier-stat-card:hover {
        transform: translateY(-2px);
        border-color: #DCE6E0;
        box-shadow: 0 7px 20px rgba(31, 42, 36, .065);
    }


    .cashier-stat-top {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 8px;
    }


    .cashier-stat-icon {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
    }


    .icon-warning {
        background: #FFF7E7;
        color: var(--cashier-warning);
    }


    .icon-success {
        background: #EAF7EF;
        color: #198754;
    }


    .icon-primary {
        background: #EAF2FF;
        color: var(--cashier-blue);
    }


    .icon-info {
        background: #E8F7FA;
        color: var(--cashier-info);
    }


    .cashier-stat-badge {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 4px 7px;
        border-radius: 20px;
        font-size: 8px;
        font-weight: 750;
        white-space: nowrap;
    }


    .badge-warning-soft {
        background: #FFF7E7;
        color: #B7791F;
    }


    .badge-success-soft {
        background: #EAF7EF;
        color: #21844B;
    }


    .badge-primary-soft {
        background: #EDF4FF;
        color: #3478C8;
    }


    .badge-info-soft {
        background: #EAF7FA;
        color: #168397;
    }


    .cashier-stat-label {
        margin-top: 11px;
        color: var(--cashier-muted);
        font-size: 10px;
        font-weight: 600;
    }


    .cashier-stat-value {
        margin-top: 3px;
        color: var(--cashier-ink);
        font-size: 20px;
        line-height: 1.2;
        font-weight: 800;
    }


    .cashier-stat-bottom {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 8px;
        margin-top: 8px;
        padding-top: 8px;
        border-top: 1px solid #F0F2F1;
        color: #9AA59F;
        font-size: 8px;
        font-weight: 550;
    }


    .cashier-stat-bottom strong {
        font-size: 10px;
    }


    /* =========================================
       PANELS
    ========================================= */

    .cashier-panel {
        overflow: hidden;
        background: #fff;
        border: 1px solid var(--cashier-border);
        border-radius: 15px;
        box-shadow: 0 3px 14px rgba(31, 42, 36, .035);
    }


    .cashier-panel-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        padding: 16px 17px 12px;
    }


    .panel-heading {
        display: flex;
        align-items: center;
        gap: 9px;
        min-width: 0;
    }


    .panel-heading-icon {
        width: 33px;
        height: 33px;
        border-radius: 9px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        font-size: 11px;
    }


    .warning-heading {
        background: #FFF7E7;
        color: var(--cashier-warning);
    }


    .success-heading {
        background: #EAF7EF;
        color: #21844B;
    }


    .panel-title {
        margin: 0;
        color: var(--cashier-ink);
        font-size: 12px;
        font-weight: 750;
    }


    .panel-subtitle {
        margin: 2px 0 0;
        color: #9AA59F;
        font-size: 8px;
        font-weight: 500;
    }


    .panel-view-all {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        color: var(--cashier-green);
        font-size: 9px;
        font-weight: 700;
        text-decoration: none !important;
        white-space: nowrap;
    }


    .panel-view-all i {
        font-size: 8px;
        transition: transform .18s ease;
    }


    .panel-view-all:hover {
        color: var(--cashier-green-dark);
    }


    .panel-view-all:hover i {
        transform: translateX(3px);
    }


    /* =========================================
       TABLE
    ========================================= */

    .cashier-table-wrap {
        border-top: 1px solid #F0F2F1;
    }


    .cashier-table {
        width: 100%;
        border-collapse: separate !important;
        border-spacing: 0;
    }


    .cashier-table thead th {
        padding: 10px 10px;
        background: #F7F9F8;
        border: none !important;
        color: #7A8780;
        font-size: 8px;
        font-weight: 750;
        white-space: nowrap;
        vertical-align: middle;
    }


    .cashier-table thead th:first-child {
        padding-left: 17px;
    }


    .cashier-table thead th:last-child {
        padding-right: 17px;
    }


    .cashier-table tbody tr {
        transition: background .15s ease;
    }


    .cashier-table tbody tr:hover {
        background: #F9FCFA;
    }


    .cashier-table tbody td {
        padding: 10px;
        border-top: 1px solid #F0F2F1 !important;
        border-bottom: none !important;
        color: #4A5851;
        font-size: 9px;
        vertical-align: middle;
        white-space: nowrap;
    }


    .cashier-table tbody td:first-child {
        padding-left: 17px;
    }


    .cashier-table tbody td:last-child {
        padding-right: 17px;
    }


    /* Invoice */
    .cashier-invoice-number {
        display: flex;
        align-items: center;
        gap: 7px;
        color: #34423A;
        font-size: 9px;
        font-weight: 750;
    }


    .invoice-small-icon {
        width: 27px;
        height: 27px;
        border-radius: 7px;
        background: var(--cashier-green-soft);
        color: var(--cashier-green);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }


    .invoice-small-icon i {
        font-size: 9px;
    }


    /* Patient */
    .cashier-patient {
        display: flex;
        align-items: center;
        gap: 7px;
        min-width: 115px;
    }


    .patient-small-icon {
        width: 27px;
        height: 27px;
        border-radius: 7px;
        background: #EEF4FF;
        color: #4775C8;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }


    .patient-small-icon i {
        font-size: 9px;
    }


    .patient-name {
        max-width: 125px;
        overflow: hidden;
        text-overflow: ellipsis;
        color: #34423A;
        font-size: 9px;
        font-weight: 650;
    }


    /* Amount */
    .invoice-amount-due {
        color: #DC3545;
        font-size: 9px;
        font-weight: 750;
        white-space: nowrap;
    }


    .payment-amount {
        color: #21844B;
        font-size: 9px;
        font-weight: 750;
        white-space: nowrap;
    }


    /* Payment Method */
    .payment-method {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
        padding: 5px 7px;
        border-radius: 7px;
        font-size: 8px;
        font-weight: 750;
    }


    .payment-khqr {
        background: #EDF4FF;
        border: 1px solid #DCEAFF;
        color: #3478C8;
    }


    .payment-cash {
        background: #EAF7EF;
        border: 1px solid #D9EDE1;
        color: #21844B;
    }


    /* Date */
    .payment-date {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        color: #8A9690;
        font-size: 8px;
        white-space: nowrap;
    }


    .payment-date i {
        color: #A1AAA5;
        font-size: 8px;
    }


    /* Pay Button */
    .cashier-pay-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
        padding: 6px 9px;
        border: none;
        border-radius: 7px;
        background: var(--cashier-green);
        color: #fff !important;
        font-size: 8px;
        font-weight: 700;
        text-decoration: none !important;
        transition: all .18s ease;
    }


    .cashier-pay-btn:hover {
        background: var(--cashier-green-dark);
        color: #fff !important;
        transform: translateY(-1px);
        box-shadow: 0 4px 10px rgba(0, 109, 54, .16);
    }


    .cashier-pay-btn i {
        font-size: 8px;
    }


    /* =========================================
       EMPTY TABLE
    ========================================= */

    .cashier-empty {
        padding: 38px 20px !important;
        text-align: center;
        white-space: normal !important;
    }


    .empty-table-icon {
        width: 45px;
        height: 45px;
        margin: 0 auto 9px;
        border-radius: 12px;
        background: var(--cashier-green-soft);
        color: var(--cashier-green);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 17px;
    }


    .empty-table-title {
        color: #59665F;
        font-size: 10px;
        font-weight: 700;
    }


    .empty-table-text {
        margin-top: 3px;
        color: #9AA59F;
        font-size: 8px;
    }


    /* =========================================
       RESPONSIVE
    ========================================= */

    @media (max-width: 991.98px) {

        .cashier-header-content {
            padding: 16px;
        }


        .cashier-title {
            font-size: 17px;
        }


        .cashier-subtitle {
            font-size: 9px;
        }


        .cashier-table {
            min-width: 620px;
        }


        .cashier-table-wrap {
            overflow-x: auto;
        }

    }


    @media (max-width: 767.98px) {

        .cashier-header-content {
            align-items: flex-start;
            flex-direction: column;
        }


        .cashier-new-invoice {
            width: 100%;
        }


        .cashier-title {
            font-size: 16px;
        }


        .cashier-stat-card {
            padding: 13px;
        }


        .cashier-stat-value {
            font-size: 18px;
        }

    }


    @media (max-width: 575.98px) {

        .cashier-wrap {
            padding-left: 5px;
            padding-right: 5px;
        }


        .cashier-header {
            border-radius: 12px;
        }


        .cashier-header-content {
            padding: 14px;
        }


        .cashier-header-icon {
            width: 39px;
            height: 39px;
            font-size: 15px;
        }


        .cashier-title {
            font-size: 14px;
        }


        .cashier-subtitle {
            font-size: 8px;
        }


        .cashier-panel {
            border-radius: 12px;
        }


        .cashier-panel-header {
            padding: 14px 13px 10px;
        }


        .panel-title {
            font-size: 10px;
        }


        .panel-view-all {
            font-size: 8px;
        }

    }

</style>

@stop