@extends('adminlte::page')

@section('title', 'Cashier Dashboard')

@section('content')
<div class="container-fluid pt-3">
    {{-- Header Banner --}}
    <div class="card text-white mb-4 shadow-sm" style="background-color: #006D36; border-radius: 16px;">
        <div class="card-body p-4 d-flex align-items-center justify-content-between">
            <div>
                <h2 class="font-weight-bold mb-1"><i class="fas fa-file-invoice-dollar mr-2"></i>ផ្ទាំងគ្រប់គ្រងបេឡា
                    (Cashier Dashboard)</h2>
                <p class="mb-0 text-white-50">ការគ្រប់គ្រងវិក្កយបត្រ ការប្រមូលប្រាក់ទូទាត់ និងទូទាត់ KHQR ។</p>
            </div>
            <a href="{{ route('billing.index') }}" class="btn btn-light font-weight-bold px-4 py-2 text-primary"
                style="border-radius: 20px;">
                <i class="fas fa-plus-circle mr-1"></i> វិក្កយបត្រថ្មី
            </a>
        </div>
    </div>

    {{-- STAT CARDS --}}
    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="card h-100 shadow-sm border-0" style="border-radius: 16px;">
                <div class="card-body d-flex align-items-center">
                    <div class="icon-circle mr-3 text-warning"
                        style="width: 50px; height: 50px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 22px; background: #fff8e1;">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div>
                        <div class="text-muted small">វិក្កយបត្រមិនទាន់បង់ (Unpaid)</div>
                        <div class="h3 font-weight-bold mb-0 text-dark">{{ $unpaidInvoicesCount }}</div>
                        <div class="small text-danger font-weight-bold">${{ number_format($unpaidInvoicesTotal, 2) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card h-100 shadow-sm border-0" style="border-radius: 16px;">
                <div class="card-body d-flex align-items-center">
                    <div class="icon-circle mr-3 text-success"
                        style="width: 50px; height: 50px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 22px; background: #e8f5e9;">
                        <i class="fas fa-money-bill-wave"></i>
                    </div>
                    <div>
                        <div class="text-muted small">ប្រាក់ស្រស់ថ្ងៃនេះ (Cash Today)</div>
                        <div class="h3 font-weight-bold mb-0 text-success">${{ number_format($todayCashRevenue, 2) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card h-100 shadow-sm border-0" style="border-radius: 16px;">
                <div class="card-body d-flex align-items-center">
                    <div class="icon-circle mr-3 text-primary"
                        style="width: 50px; height: 50px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 22px; background: #e3f2fd;">
                        <i class="fas fa-qrcode"></i>
                    </div>
                    <div>
                        <div class="text-muted small">KHQR ថ្ងៃនេះ (KHQR Today)</div>
                        <div class="h3 font-weight-bold mb-0 text-primary">${{ number_format($todayKhqrRevenue, 2) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card h-100 shadow-sm border-0" style="border-radius: 16px;">
                <div class="card-body d-flex align-items-center">
                    <div class="icon-circle mr-3 text-info"
                        style="width: 50px; height: 50px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 22px; background: #e0f7fa;">
                        <i class="fas fa-chart-bar"></i>
                    </div>
                    <div>
                        <div class="text-muted small">ចំណូលសរុបថ្ងៃនេះ (Total Today)</div>
                        <div class="h3 font-weight-bold mb-0 text-info">${{ number_format($todayTotalRevenue, 2) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- MAIN TABLES --}}
    <div class="row">
        {{-- Unpaid Invoices List --}}
        <div class="col-lg-6 mb-4">
            <div class="card shadow-sm border-0 h-100" style="border-radius: 16px;">
                <div class="card-header bg-white border-0 pt-4 px-4 d-flex align-items-center justify-content-between">
                    <h5 class="font-weight-bold mb-0 text-dark"><i
                            class="fas fa-exclamation-triangle text-warning mr-2"></i>វិក្កយបត្រមិនទាន់បង់ (Unpaid
                        Invoices)</h5>
                    <a href="{{ route('billing.index') }}" class="small font-weight-bold">មើលទាំងអស់</a>
                </div>
                <div class="card-body p-0 table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="bg-light text-muted small">
                            <tr>
                                <th class="pl-4">លេខវិក្កយបត្រ (Invoice #)</th>
                                <th>អ្នកជំងឺ (Patient)</th>
                                <th>ចំនួនប្រាក់ ($)</th>
                                <th class="text-right pr-4">សកម្មភាព</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($unpaidInvoicesList as $inv)
                                <tr>
                                    <td class="pl-4 font-weight-bold text-primary">{{ $inv->invoice_number }}</td>
                                    <td>{{ $inv->patient_name ?? (optional($inv->patient)->name ?? 'N/A') }}</td>
                                    <td class="font-weight-bold text-danger">${{ number_format($inv->total_amount, 2) }}
                                    </td>
                                    <td class="text-right pr-4">
                                        <a href="{{ route('billing.show', $inv->id) }}" class="btn btn-sm btn-primary"
                                            style="border-radius: 12px;">
                                            <i class="fas fa-hand-holding-usd"></i> ទូទាត់
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-4">គ្មានវិក្កយបត្រមិនទាន់បង់ទេ
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Recent Payments --}}
        <div class="col-lg-6 mb-4">
            <div class="card shadow-sm border-0 h-100" style="border-radius: 16px;">
                <div class="card-header bg-white border-0 pt-4 px-4 d-flex align-items-center justify-content-between">
                    <h5 class="font-weight-bold mb-0 text-dark"><i
                            class="fas fa-receipt text-success mr-2"></i>ប្រតិបត្តិការទូទាត់ចុងក្រោយ (Recent Payments)
                    </h5>
                </div>
                <div class="card-body p-0 table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="bg-light text-muted small">
                            <tr>
                                <th class="pl-4">វិក្កយបត្រ</th>
                                <th>វិធីសាស្ត្រ</th>
                                <th>ប្រាក់បង់ ($)</th>
                                <th class="text-right pr-4">កាលបរិច្ឆេទ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentPayments as $pay)
                                <tr>
                                    <td class="pl-4 font-weight-bold">
                                        {{ $pay->invoice->invoice_number ?? '#' . $pay->invoice_id }}
                                    </td>
                                    <td>
                                        @if (strtolower($pay->payment_method) === 'khqr')
                                            <span class="badge badge-primary px-2 py-1"><i class="fas fa-qrcode"></i>
                                                KHQR</span>
                                        @else
                                            <span class="badge badge-success px-2 py-1"><i class="fas fa-money-bill"></i>
                                                Cash</span>
                                        @endif
                                    </td>
                                    <td class="font-weight-bold text-success">${{ number_format($pay->amount, 2) }}
                                    </td>
                                    <td class="text-right pr-4 small text-muted">
                                        {{ optional($pay->paid_at)->format('H:i, d M') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-4">គ្មានប្រតិបត្តិការថ្មីៗទេ
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
@stop
