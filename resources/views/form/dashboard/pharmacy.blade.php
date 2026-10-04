@extends('adminlte::page')

@section('title', 'Pharmacy Dashboard')

@section('content')

<div class="container-fluid pharmacy-dashboard">

```
{{-- HEADER --}}
<div class="pharmacy-header mb-4">
    <div class="pharmacy-header-content">

        <div class="pharmacy-header-info">
            <div class="pharmacy-header-icon">
                <i class="fas fa-pills"></i>
            </div>

            <div>
                <h2>ផ្ទាំងគ្រប់គ្រងឱសថស្ថាន</h2>

                <p>
                    <i class="fas fa-capsules mr-1"></i>
                    Pharmacy Dashboard
                    <span class="header-divider">•</span>
                    ការគ្រប់គ្រងស្តុកថ្នាំ ថ្នាំជិតផុតកំណត់ និងវេជ្ជបញ្ជា។
                </p>
            </div>
        </div>

        <a href="{{ route('pharmacy.index') }}" class="pharmacy-header-btn">
            <i class="fas fa-boxes mr-2"></i>
            បញ្ជីស្តុក
        </a>

    </div>
</div>


{{-- STAT CARDS --}}
<div class="row pharmacy-stats mb-4">

    {{-- LOW STOCK --}}
    <div class="col-xl-4 col-md-6 mb-3">
        <div class="pharmacy-stat-card">

            <div class="pharmacy-stat-icon low-stock-icon">
                <i class="fas fa-exclamation-triangle"></i>
            </div>

            <div class="pharmacy-stat-content">

                <div class="pharmacy-stat-label">
                    ថ្នាំជិតអស់ស្តុក
                    <span>(Low Stock)</span>
                </div>

                <div class="pharmacy-stat-value low-stock-value">
                    {{ $lowStockMedicines->count() }}
                </div>

                <div class="pharmacy-stat-bottom low-stock-text">
                    <i class="fas fa-box-open mr-1"></i>
                    ថ្នាំដែលមានស្តុកទាប
                </div>

            </div>

        </div>
    </div>


    {{-- EXPIRING --}}
    <div class="col-xl-4 col-md-6 mb-3">
        <div class="pharmacy-stat-card">

            <div class="pharmacy-stat-icon expiring-icon">
                <i class="fas fa-calendar-times"></i>
            </div>

            <div class="pharmacy-stat-content">

                <div class="pharmacy-stat-label">
                    ថ្នាំជិតផុតកំណត់
                    <span>(Expiring)</span>
                </div>

                <div class="pharmacy-stat-value expiring-value">
                    {{ $expiringBatches->count() }}
                </div>

                <div class="pharmacy-stat-bottom expiring-text">
                    <i class="fas fa-clock mr-1"></i>
                    ផុតកំណត់ក្នុងរយៈពេល 30 ថ្ងៃ
                </div>

            </div>

        </div>
    </div>


    {{-- PRESCRIPTIONS --}}
    <div class="col-xl-4 col-md-6 mb-3">
        <div class="pharmacy-stat-card">

            <div class="pharmacy-stat-icon prescription-icon">
                <i class="fas fa-file-prescription"></i>
            </div>

            <div class="pharmacy-stat-content">

                <div class="pharmacy-stat-label">
                    វេជ្ជបញ្ជារង់ចាំ
                    <span>(Prescriptions)</span>
                </div>

                <div class="pharmacy-stat-value prescription-value">
                    {{ $pendingPrescriptions->count() }}
                </div>

                <div class="pharmacy-stat-bottom prescription-text">
                    <i class="fas fa-prescription-bottle-alt mr-1"></i>
                    វេជ្ជបញ្ជាត្រូវចែកថ្នាំ
                </div>

            </div>

        </div>
    </div>

</div>


{{-- MAIN CONTENT --}}
<div class="row">

    {{-- EXPIRING MEDICINES --}}
    <div class="col-xl-6 mb-4">

        <div class="pharmacy-panel h-100">

            <div class="pharmacy-panel-header">

                <div class="pharmacy-panel-title">

                    <div class="panel-title-icon expiring-panel-icon">
                        <i class="fas fa-calendar-times"></i>
                    </div>

                    <div>
                        <h5>ថ្នាំជិតផុតកំណត់</h5>
                        <span>Expiring Soon - 30 Days</span>
                    </div>

                </div>

                <a href="{{ route('pharmacy.expiring.detail') }}"
                    class="pharmacy-view-all">
                    មើលទាំងអស់
                    <i class="fas fa-arrow-right ml-1"></i>
                </a>

            </div>


            <div class="pharmacy-table-wrapper">

                <table class="table pharmacy-table mb-0">

                    <thead>
                        <tr>
                            <th class="pl-4">ឈ្មោះថ្នាំ</th>
                            <th>លេខបាច់</th>
                            <th>ថ្ងៃផុតកំណត់</th>
                            <th class="text-right pr-4">ចំនួនសល់</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($expiringBatches as $batch)

                            <tr>

                                <td class="pl-4">

                                    <div class="medicine-info">

                                        <div class="medicine-avatar expiring-avatar">
                                            <i class="fas fa-pills"></i>
                                        </div>

                                        <div>

                                            <div class="medicine-name">
                                                {{ $batch->medicine->medicine_name ?? 'N/A' }}
                                            </div>

                                            <div class="medicine-label">
                                                Medicine
                                            </div>

                                        </div>

                                    </div>

                                </td>


                                <td>

                                    <span class="batch-badge">
                                        <i class="fas fa-barcode mr-1"></i>
                                        {{ $batch->batch_number }}
                                    </span>

                                </td>


                                <td>

                                    <div class="expiry-date">
                                        <i class="far fa-calendar-alt mr-1"></i>
                                        {{ optional($batch->expiry_date)->format('Y-m-d') }}
                                    </div>

                                </td>


                                <td class="text-right pr-4">

                                    <span class="quantity-badge">
                                        {{ $batch->remaining_quantity }}
                                    </span>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="4">

                                    <div class="pharmacy-empty">

                                        <div class="empty-icon">
                                            <i class="fas fa-check-circle"></i>
                                        </div>

                                        <div class="empty-title">
                                            គ្មានថ្នាំជិតផុតកំណត់ទេ
                                        </div>

                                        <div class="empty-text">
                                            បច្ចុប្បន្នមិនមានថ្នាំជិតផុតកំណត់ក្នុងរយៈពេល 30 ថ្ងៃទេ
                                        </div>

                                    </div>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>


    {{-- PENDING PRESCRIPTIONS --}}
    <div class="col-xl-6 mb-4">

        <div class="pharmacy-panel h-100">

            <div class="pharmacy-panel-header">

                <div class="pharmacy-panel-title">

                    <div class="panel-title-icon prescription-panel-icon">
                        <i class="fas fa-prescription-bottle-alt"></i>
                    </div>

                    <div>
                        <h5>បញ្ជីវេជ្ជបញ្ជាចុងក្រោយ</h5>
                        <span>Pending Prescriptions</span>
                    </div>

                </div>

                <a href="{{ route('pharmacy.prescriptions.index') }}"
                    class="pharmacy-view-all">
                    មើលទាំងអស់
                    <i class="fas fa-arrow-right ml-1"></i>
                </a>

            </div>


            <div class="pharmacy-table-wrapper">

                <table class="table pharmacy-table mb-0">

                    <thead>
                        <tr>
                            <th class="pl-4">កូដ</th>
                            <th>អ្នកជំងឺ</th>
                            <th>កាលបរិច្ឆេទ</th>
                            <th class="text-right pr-4">សកម្មភាព</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($pendingPrescriptions as $pres)

                            <tr>

                                <td class="pl-4">

                                    <span class="prescription-id">
                                        #RX-{{ $pres->prescription_id }}
                                    </span>

                                </td>


                                <td>

                                    <div class="patient-info">

                                        <div class="patient-avatar">
                                            <i class="fas fa-user"></i>
                                        </div>

                                        <div class="patient-name">
                                            {{ $pres->medicalRecord->patient->full_name ?? 'N/A' }}
                                        </div>

                                    </div>

                                </td>


                                <td>

                                    <div class="prescription-date">
                                        <i class="far fa-calendar-alt mr-1"></i>
                                        {{ optional($pres->prescribed_date)->format('Y-m-d') }}
                                    </div>

                                </td>


                                <td class="text-right pr-4">

                                    <a href="{{ route('pharmacy.prescriptions.index') }}"
                                        class="dispense-btn"
                                        title="ចែកថ្នាំ">

                                        <i class="fas fa-check-circle mr-1"></i>
                                        ចែកថ្នាំ

                                    </a>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="4">

                                    <div class="pharmacy-empty">

                                        <div class="empty-icon">
                                            <i class="fas fa-prescription-bottle"></i>
                                        </div>

                                        <div class="empty-title">
                                            គ្មានវេជ្ជបញ្ជារង់ចាំទេ
                                        </div>

                                        <div class="empty-text">
                                            បច្ចុប្បន្នមិនមានវេជ្ជបញ្ជារង់ចាំចែកថ្នាំទេ
                                        </div>

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
```

</div>
@stop

@section('css')
@parent

<style>

:root {
    --pharmacy-green: #006D36;
    --pharmacy-green-dark: #00552B;
    --pharmacy-green-light: #E8F5EE;
    --pharmacy-bg: #F5F7F6;
    --pharmacy-border: #E7ECE9;
    --pharmacy-text: #1F2A24;
    --pharmacy-muted: #7A8780;
}


/* ================================
   PAGE
================================ */

.pharmacy-dashboard {
    padding-top: 8px;
    padding-bottom: 25px;
    background: var(--pharmacy-bg);
}


/* ================================
   HEADER
================================ */

.pharmacy-header {
    background: linear-gradient(135deg, #006D36 0%, #008747 100%);
    border-radius: 16px;
    color: #fff;
    overflow: hidden;
    box-shadow: 0 8px 24px rgba(0, 109, 54, .14);
}

.pharmacy-header-content {
    padding: 24px 28px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
}

.pharmacy-header-info {
    display: flex;
    align-items: center;
    min-width: 0;
}

.pharmacy-header-icon {
    width: 56px;
    height: 56px;
    min-width: 56px;
    border-radius: 15px;
    background: rgba(255,255,255,.15);
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 16px;
    font-size: 24px;
}

.pharmacy-header h2 {
    font-size: 23px;
    font-weight: 700;
    margin: 0 0 5px;
    line-height: 1.3;
}

.pharmacy-header p {
    margin: 0;
    font-size: 13px;
    color: rgba(255,255,255,.78);
}

.header-divider {
    margin: 0 7px;
    color: rgba(255,255,255,.45);
}

.pharmacy-header-btn {
    flex-shrink: 0;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background: #fff;
    color: var(--pharmacy-green);
    padding: 10px 18px;
    border-radius: 11px;
    font-size: 13px;
    font-weight: 700;
    text-decoration: none !important;
    transition: all .2s ease;
    box-shadow: 0 4px 12px rgba(0,0,0,.08);
}

.pharmacy-header-btn:hover {
    color: var(--pharmacy-green-dark);
    transform: translateY(-1px);
    box-shadow: 0 6px 16px rgba(0,0,0,.13);
}


/* ================================
   STAT CARDS
================================ */

.pharmacy-stat-card {
    height: 100%;
    min-height: 112px;
    background: #fff;
    border: 1px solid var(--pharmacy-border);
    border-radius: 14px;
    padding: 20px;
    display: flex;
    align-items: center;
    transition: all .2s ease;
    box-shadow: 0 3px 14px rgba(31,42,36,.04);
}

.pharmacy-stat-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 22px rgba(31,42,36,.08);
    border-color: #dce5e0;
}

.pharmacy-stat-icon {
    width: 52px;
    height: 52px;
    min-width: 52px;
    border-radius: 13px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 21px;
    margin-right: 15px;
}

.low-stock-icon {
    background: #FDECEF;
    color: #DC3545;
}

.expiring-icon {
    background: #FFF7E6;
    color: #D97706;
}

.prescription-icon {
    background: #E8F7FA;
    color: #0891B2;
}

.pharmacy-stat-content {
    min-width: 0;
}

.pharmacy-stat-label {
    color: var(--pharmacy-muted);
    font-size: 12px;
    font-weight: 600;
    margin-bottom: 3px;
}

.pharmacy-stat-label span {
    font-weight: 500;
    color: #9AA49F;
}

.pharmacy-stat-value {
    color: var(--pharmacy-text);
    font-size: 25px;
    line-height: 1.2;
    font-weight: 700;
}

.low-stock-value {
    color: #DC3545;
}

.expiring-value {
    color: #D97706;
}

.prescription-value {
    color: #0891B2;
}

.pharmacy-stat-bottom {
    margin-top: 4px;
    font-size: 11px;
    font-weight: 600;
}

.low-stock-text {
    color: #DC3545;
}

.expiring-text {
    color: #D97706;
}

.prescription-text {
    color: #0891B2;
}


/* ================================
   PANEL
================================ */

.pharmacy-panel {
    background: #fff;
    border: 1px solid var(--pharmacy-border);
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 3px 14px rgba(31,42,36,.04);
}

.pharmacy-panel-header {
    min-height: 76px;
    padding: 16px 20px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    border-bottom: 1px solid #EEF1EF;
}

.pharmacy-panel-title {
    display: flex;
    align-items: center;
    min-width: 0;
}

.panel-title-icon {
    width: 38px;
    height: 38px;
    min-width: 38px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 11px;
    font-size: 15px;
}

.expiring-panel-icon {
    background: #FFF7E6;
    color: #D97706;
}

.prescription-panel-icon {
    background: #E8F7FA;
    color: #0891B2;
}

.pharmacy-panel-title h5 {
    margin: 0;
    color: var(--pharmacy-text);
    font-size: 15px;
    font-weight: 700;
}

.pharmacy-panel-title span {
    display: block;
    margin-top: 2px;
    color: var(--pharmacy-muted);
    font-size: 11px;
}

.pharmacy-view-all {
    color: var(--pharmacy-green);
    font-size: 11px;
    font-weight: 700;
    text-decoration: none !important;
    white-space: nowrap;
}

.pharmacy-view-all:hover {
    color: var(--pharmacy-green-dark);
}


/* ================================
   TABLE
================================ */

.pharmacy-table-wrapper {
    overflow-x: auto;
}

.pharmacy-table {
    width: 100%;
    min-width: 620px;
}

.pharmacy-table thead th {
    background: #F8FAF9;
    border-top: 0;
    border-bottom: 1px solid #E9EEEB;
    color: #7A8780;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .15px;
    padding: 11px 12px;
    white-space: nowrap;
}

.pharmacy-table tbody td {
    padding: 13px 12px;
    border-top: 1px solid #F0F2F1;
    vertical-align: middle;
    font-size: 12px;
}

.pharmacy-table tbody tr {
    transition: background .15s ease;
}

.pharmacy-table tbody tr:hover {
    background: #FAFCFB;
}


/* ================================
   MEDICINE
================================ */

.medicine-info {
    display: flex;
    align-items: center;
    min-width: 150px;
}

.medicine-avatar {
    width: 35px;
    height: 35px;
    min-width: 35px;
    border-radius: 9px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 9px;
    font-size: 13px;
}

.expiring-avatar {
    background: #FFF7E6;
    color: #D97706;
}

.medicine-name {
    color: #25312B;
    font-weight: 700;
    font-size: 12px;
}

.medicine-label {
    color: #98A29D;
    font-size: 10px;
    margin-top: 1px;
}


/* ================================
   BATCH
================================ */

.batch-badge {
    display: inline-flex;
    align-items: center;
    background: #F0F7F3;
    color: var(--pharmacy-green);
    border-radius: 8px;
    padding: 6px 9px;
    font-size: 10px;
    font-weight: 700;
    white-space: nowrap;
}

.expiry-date {
    color: #DC3545;
    font-size: 10px;
    font-weight: 700;
    white-space: nowrap;
}

.quantity-badge {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background: #FDECEF;
    color: #C82333;
    border-radius: 8px;
    min-width: 34px;
    padding: 6px 9px;
    font-size: 10px;
    font-weight: 700;
}


/* ================================
   PATIENT
================================ */

.patient-info {
    display: flex;
    align-items: center;
    min-width: 140px;
}

.patient-avatar {
    width: 35px;
    height: 35px;
    min-width: 35px;
    border-radius: 9px;
    background: #EAF2FF;
    color: #2563EB;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 9px;
    font-size: 13px;
}

.patient-name {
    color: #25312B;
    font-weight: 700;
    font-size: 12px;
}


/* ================================
   PRESCRIPTION
================================ */

.prescription-id {
    color: var(--pharmacy-text);
    font-size: 11px;
    font-weight: 700;
    white-space: nowrap;
}

.prescription-date {
    color: #7A8780;
    font-size: 10px;
    white-space: nowrap;
}

.dispense-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background: #F0F7F3;
    color: var(--pharmacy-green);
    border: 1px solid #DCEBE2;
    border-radius: 8px;
    padding: 7px 10px;
    font-size: 10px;
    font-weight: 700;
    text-decoration: none !important;
    white-space: nowrap;
    transition: all .2s ease;
}

.dispense-btn:hover {
    background: var(--pharmacy-green);
    color: #fff;
    border-color: var(--pharmacy-green);
}


/* ================================
   EMPTY STATES
================================ */

.pharmacy-empty {
    text-align: center;
    padding: 42px 20px;
}

.empty-icon {
    width: 50px;
    height: 50px;
    border-radius: 13px;
    background: #F1F5F3;
    color: #A0ABA5;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 10px;
    font-size: 19px;
}

.empty-title {
    color: #66736C;
    font-size: 12px;
    font-weight: 700;
}

.empty-text {
    color: #9AA49F;
    font-size: 10px;
    margin-top: 3px;
}


/* ================================
   RESPONSIVE
================================ */

@media (max-width: 1199.98px) {

    .pharmacy-stat-card {
        min-height: 105px;
    }

}


@media (max-width: 991.98px) {

    .pharmacy-header-content {
        align-items: flex-start;
    }

    .pharmacy-header h2 {
        font-size: 20px;
    }

    .pharmacy-header p {
        max-width: 600px;
    }

    .pharmacy-table {
        min-width: 620px;
    }

}


@media (max-width: 767.98px) {

    .pharmacy-dashboard {
        padding-top: 3px;
    }

    .pharmacy-header-content {
        padding: 20px;
        flex-direction: column;
        align-items: stretch;
    }

    .pharmacy-header-info {
        align-items: flex-start;
    }

    .pharmacy-header-icon {
        width: 48px;
        height: 48px;
        min-width: 48px;
        font-size: 20px;
    }

    .pharmacy-header h2 {
        font-size: 18px;
    }

    .pharmacy-header p {
        font-size: 11px;
        line-height: 1.6;
    }

    .header-divider {
        display: none;
    }

    .pharmacy-header-btn {
        width: 100%;
    }

    .pharmacy-panel-header {
        padding: 14px 16px;
    }

    .pharmacy-panel-title h5 {
        font-size: 13px;
    }

    .pharmacy-panel-title span {
        font-size: 10px;
    }

    .pharmacy-stat-card {
        padding: 16px;
    }

    .pharmacy-stat-value {
        font-size: 22px;
    }

}


@media (max-width: 575.98px) {

    .pharmacy-header-icon {
        display: none;
    }

    .pharmacy-header h2 {
        font-size: 17px;
    }

    .pharmacy-header p {
        font-size: 10px;
    }

    .pharmacy-stat-icon {
        width: 46px;
        height: 46px;
        min-width: 46px;
        font-size: 18px;
        margin-right: 12px;
    }

    .pharmacy-stat-label {
        font-size: 11px;
    }

    .pharmacy-stat-value {
        font-size: 21px;
    }

    .pharmacy-stat-bottom {
        font-size: 10px;
    }

    .pharmacy-table {
        min-width: 600px;
    }

}

</style>

@stop
