@extends('adminlte::page')

@section('title', 'គ្រប់គ្រងការទូទាត់ប្រាក់ & វិក្កយបត្រ')

@section('content')

<style>
    .billing-container {
        font-family: 'Inter', 'Kantumruuy Pro', sans-serif;
    }
    .stat-card-billing {
        background: #ffffff;
        border-radius: 16px;
        padding: 20px;
        display: flex;
        align-items: center;
        gap: 16px;
        box-shadow: 0 4px 16px rgba(15, 23, 42, 0.05);
        border: 1px solid #f1f5f9;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        height: 100%;
    }
    .stat-card-billing:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(15, 23, 42, 0.08);
    }
    .stat-icon {
        width: 52px;
        height: 52px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        flex-shrink: 0;
    }
    .bg-icon-primary { background: #e0e7ff; color: #4338ca; }
    .bg-icon-success { background: #dcfce7; color: #15803d; }
    .bg-icon-danger  { background: #ffe4e6; color: #be123c; }

    .card-modern {
        background: #ffffff;
        border-radius: 16px;
        border: 1px solid #f1f5f9;
        box-shadow: 0 4px 16px rgba(15, 23, 42, 0.05);
        overflow: hidden;
    }
    .toolbar-filters {
        padding: 16px 20px;
        background: #ffffff;
        border-bottom: 1px solid #f1f5f9;
        gap: 12px;
    }
    .search-box {
        position: relative;
        flex: 1;
        min-width: 250px;
    }
    .search-box i {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: #94a3b8;
    }
    .search-box input {
        padding-left: 38px;
        border-radius: 10px;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
    }

    .modal-header-pay {
        background: linear-gradient(135deg, #10b981 0%, #047857 100%);
        color: #ffffff;
    }
</style>

<div class="billing-container">

    {{-- Top Page Header --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 mt-3">
        <div>
            <h2 class="font-weight-bold text-dark mb-1">
                <i class="fas fa-file-invoice-dollar text-primary mr-2"></i> គ្រប់គ្រងការទូទាត់ប្រាក់ & វិក្កយបត្រ
            </h2>
            <small class="text-muted">បង្កើតវិក្កយបត្រ គ្រប់គ្រងសេវាកម្ម/បន្ទប់/ថ្នាំ/មន្ទីរពិសោធន៍ និងទទួលការទូទាត់ប្រាក់</small>
        </div>
        <button type="button" class="btn btn-primary shadow-sm" data-toggle="modal" data-target="#modalCreateInvoice" style="border-radius: 10px; font-weight: 600; padding: 10px 20px;">
            <i class="fas fa-plus-circle mr-2"></i> បង្កើតវិក្កយបត្រថ្មី
        </button>
    </div>

    {{-- Success Toast Notification --}}
    <div id="billingSuccessToast" class="alert alert-success alert-dismissible fade show d-none mb-3" role="alert" style="border-radius: 10px;">
        <i class="fas fa-check-circle mr-2"></i><span id="billingSuccessToastMessage"></span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <!-- Stats Overview Cards -->
    <div class="row mb-4">
        <div class="col-md-4 mb-3">
            <div class="stat-card-billing">
                <div class="stat-icon bg-icon-primary">
                    <i class="fas fa-file-invoice"></i>
                </div>
                <div>
                    <small class="text-muted font-weight-bold d-block">វិក្កយបត្រសរុប</small>
                    <h3 id="statTotalInvoices" class="m-0 font-weight-bold text-dark">{{ $totalInvoices }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="stat-card-billing">
                <div class="stat-icon bg-icon-success">
                    <i class="fas fa-hand-holding-usd"></i>
                </div>
                <div>
                    <small class="text-muted font-weight-bold d-block">ចំណូលទទួលបានសរុប</small>
                    <h3 id="statTotalRevenue" class="m-0 font-weight-bold text-success">${{ number_format($totalRevenue, 2) }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="stat-card-billing">
                <div class="stat-icon bg-icon-danger">
                    <i class="fas fa-exclamation-circle"></i>
                </div>
                <div>
                    <small class="text-muted font-weight-bold d-block">ប្រាក់ជំពាក់សរុប</small>
                    <h3 id="statTotalUnpaid" class="m-0 font-weight-bold text-danger">${{ number_format($totalUnpaid, 2) }}</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Table Card -->
    <div class="card-modern">
        <div class="card-body p-0">
            <div class="d-flex align-items-center flex-wrap toolbar-filters">
                <!-- Search Box -->
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" id="search" class="form-control" placeholder="ស្វែងរកវិក្កយបត្រ (លេខវិក្កយបត្រ, ឈ្មោះអ្នកជំងឺ, លេខទូរស័ព្ទ)...">
                </div>

                {{-- Date Filter --}}
                <div class="d-flex align-items-center" style="gap: 6px;">
                    <input type="date" id="dateFrom" class="form-control" placeholder="ចាប់ពីថ្ងៃ" style="border-radius: 8px;">
                    <span class="text-muted">-</span>
                    <input type="date" id="dateTo" class="form-control" placeholder="ដល់ថ្ងៃ" style="border-radius: 8px;">
                </div>

                <!-- Status Filter -->
                <div>
                    <select id="statusFilter" class="form-control custom-select" style="border-radius: 8px;">
                        <option value="">-- ស្ថានភាពទាំងអស់ --</option>
                        <option value="unpaid">មិនទាន់បង់</option>
                        <option value="partial">បង់ខ្លះ</option>
                        <option value="paid">បានទូទាត់រួច</option>
                        <option value="cancelled">បានលុបចោល</option>
                    </select>
                </div>

                <!-- Visit Type Filter -->
                <div>
                    <select id="visitTypeFilter" class="form-control custom-select" style="border-radius: 8px;">
                        <option value="">-- ប្រភេទចូលពិនិត្យទាំងអស់ --</option>
                        <option value="opd">អ្នកជំងឺក្រៅ (OPD)</option>
                        <option value="ipd">អ្នកជំងឺសម្រាក (IPD)</option>
                    </select>
                </div>
            </div>

            {{-- Table Container --}}
            <div id="billingTableContainer">
                @include('billing.partials.table')
            </div>
        </div>
    </div>
</div>

{{-- ====== Modal Create Invoice ====== --}}
<div class="modal fade" id="modalCreateInvoice" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header modal-header-custom">
                <h5 class="modal-title font-weight-bold"><i class="fas fa-file-invoice-dollar mr-2"></i> បង្កើតវិក្កយបត្រថ្មី</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"><span>&times;</span></button>
            </div>
            <form id="formCreateInvoice" action="{{ route('billing.store') }}" method="POST">
                @csrf
                <div class="modal-body p-4">
                    <div class="alert alert-danger d-none" id="formCreateErrors" style="border-radius: 8px;"></div>

                    <!-- Visit Type selector -->
                    <div class="form-group mb-3">
                        <label class="font-weight-bold">ប្រភេទការចូលពិនិត្យ <span class="text-danger">*</span></label>
                        <div class="btn-group btn-group-toggle w-100" data-toggle="buttons">
                            <label class="btn btn-outline-indigo active" id="labelVisitOpd" style="border-radius: 8px 0 0 8px;">
                                <input type="radio" name="visit_type" value="opd" checked autocomplete="off">
                                <i class="fas fa-walking mr-1"></i> អ្នកជំងឺក្រៅ (OPD)
                            </label>
                            <label class="btn btn-outline-indigo" id="labelVisitIpd" style="border-radius: 0 8px 8px 0;">
                                <input type="radio" name="visit_type" value="ipd" autocomplete="off">
                                <i class="fas fa-bed mr-1"></i> អ្នកជំងឺសម្រាកព្យាបាល (IPD)
                            </label>
                        </div>
                    </div>

                    <!-- Admission picker for IPD -->
                    <div class="form-group mb-3 d-none" id="admissionPickerWrap">
                        <label class="font-weight-bold">ជ្រើសរើសការចូលសម្រាកព្យាបាល <span class="text-danger">*</span></label>
                        <select id="create_admission_id" name="admission_id" class="form-control custom-select">
                            <option value="">-- ជ្រើសរើសការចូលសម្រាកព្យាបាល --</option>
                            @foreach($admissions as $adm)
                                <option value="{{ $adm->admission_id }}" data-patient-id="{{ $adm->patient_id }}" data-name="{{ optional($adm->patient)->full_name }}" data-phone="{{ optional($adm->patient)->phone }}">
                                    {{ optional($adm->patient)->full_name }} — បន្ទប់ {{ optional($adm->room)->room_number ?? '—' }} (ចូលសម្រាក {{ $adm->admission_date ? $adm->admission_date->format('d/m/Y') : '' }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Patient Details -->
                    <div class="row mb-3">
                        <div class="col-md-6 mb-2">
                            <label class="font-weight-bold">ជ្រើសរើសអ្នកជំងឺដែលមានស្រាប់</label>
                            <select id="select_patient_id" name="patient_id" class="form-control custom-select">
                                <option value="">-- ជ្រើសរើសអ្នកជំងឺ ឬបញ្ចូលឈ្មោះខាងស្តាំ --</option>
                                @foreach($patients as $pt)
                                    <option value="{{ $pt->patient_id }}" data-name="{{ $pt->full_name }}" data-phone="{{ $pt->phone }}">
                                        {{ $pt->full_name }} ({{ $pt->patient_code }}) - {{ $pt->phone }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="font-weight-bold">ឈ្មោះអ្នកជំងឺ <span class="text-danger">*</span></label>
                            <input type="text" name="patient_name" id="create_patient_name" class="form-control" placeholder="បញ្ចូលឈ្មោះអ្នកជំងឺ" required>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="font-weight-bold">លេខទូរស័ព្ទ</label>
                            <input type="tel" maxlength="10" name="patient_phone" id="create_patient_phone" class="form-control" placeholder="012 345 678">
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="font-weight-bold">ចំណាំ</label>
                            <input type="text" name="notes" id="create_notes" class="form-control" placeholder="កំណត់ចំណាំផ្សេងៗ">
                        </div>
                    </div>

                    <!-- Itemized Fee Builder -->
                    <hr>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="font-weight-bold text-primary mb-0"><i class="fas fa-list mr-1"></i> បញ្ជីសេវាកម្ម/បន្ទប់/ថ្នាំ/មន្ទីរពិសោធន៍</h6>
                        <button type="button" class="btn btn-sm btn-outline-primary" id="btnAddInvoiceItem" style="border-radius: 8px;">
                            <i class="fas fa-plus mr-1"></i> បន្ថែមមុខសេវា
                        </button>
                    </div>

                    <table class="table table-bordered align-middle mb-3" id="invoiceItemsTable">
                        <thead class="bg-light">
                            <tr>
                                <th style="width: 24%;">ប្រភេទសេវា <span class="text-danger">*</span></th>
                                <th>បរិយាយ <span class="text-danger">*</span></th>
                                <th style="width: 100px;">ចំនួន</th>
                                <th style="width: 130px;">តម្លៃ ($)</th>
                                <th style="width: 130px;">សរុប ($)</th>
                                <th style="width: 45px;" class="text-center"><i class="fas fa-trash-alt"></i></th>
                            </tr>
                        </thead>
                        <tbody id="invoiceItemsTbody">
                            <tr class="item-row">
                                <td>
                                    <select name="items[0][item_type]" class="form-control form-control-sm item-type" required>
                                        <option value="" disabled selected>-- ជ្រើសរើសប្រភេទសេវា --</option>
                                        <option value="service">សេវាកម្ម</option>
                                        <option value="room">បន្ទប់សម្រាក</option>
                                        <option value="medicine">ថ្នាំពេទ្យ</option>
                                        <option value="lab">មន្ទីរពិសោធន៍</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="text" name="items[0][description]" class="form-control form-control-sm item-desc" placeholder="បរិយាយសេវា" value="ថ្លៃពិគ្រោះជំងឺទូទៅ" required>
                                </td>
                                <td>
                                    <input type="number" name="items[0][qty]" class="form-control form-control-sm item-qty text-center" value="1" min="1" required>
                                </td>
                                <td>
                                    <input type="number" step="0.01" name="items[0][unit_price]" class="form-control form-control-sm item-price text-right" value="15.00" min="0" required>
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm item-subtotal text-right bg-light" value="15.00" readonly>
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-sm btn-outline-danger btn-remove-item" style="border-radius: 6px;"><i class="fas fa-trash-alt"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="d-flex justify-content-end align-items-center">
                        <div class="text-right">
                            <span class="text-muted font-weight-bold">តម្លៃសរុប៖ </span>
                            <h4 class="d-inline font-weight-bold text-primary ml-2 mb-0">$<span id="createGrandTotal">15.00</span></h4>
                        </div>
                    </div>
                </div>

                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">បោះបង់</button>
                    <button type="submit" class="btn btn-primary" id="btnSubmitCreateInvoice"><i class="fas fa-save mr-1"></i> រក្សាទុកវិក្កយបត្រ</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- ====== Modal Pay Invoice ====== --}}
<div class="modal fade" id="modalPayInvoice" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header modal-header-pay">
                <h5 class="modal-title font-weight-bold"><i class="fas fa-dollar-sign mr-2"></i> ទូទាត់ប្រាក់វិក្កយបត្រ</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"><span>&times;</span></button>
            </div>
            <form id="formPayInvoice">
                @csrf
                <input type="hidden" id="pay_invoice_id" name="invoice_id">
                <div class="modal-body p-4">
                    <div class="alert alert-info border-0 shadow-sm mb-3" style="border-radius: 10px;">
                        <div class="d-flex justify-content-between mb-1">
                            <span>លេខវិក្កយបត្រ:</span> <strong id="payInvoiceNumber" class="text-dark"></strong>
                        </div>
                        <div class="d-flex justify-content-between mb-1">
                            <span>អ្នកជំងឺ:</span> <strong id="payPatientName" class="text-dark"></strong>
                        </div>
                        <div class="d-flex justify-content-between mb-1">
                            <span>ប្រាក់សរុប:</span> <strong id="payTotalAmount" class="text-dark"></strong>
                        </div>
                        <div class="d-flex justify-content-between border-top pt-2 mt-2">
                            <span class="font-weight-bold text-danger">ប្រាក់ជំពាក់នៅសល់:</span> <strong id="payBalanceAmount" class="text-danger h5 mb-0"></strong>
                        </div>
                    </div>

                    <!-- Payment Method Toggle -->
                    <div class="form-group mb-3">
                        <label class="font-weight-bold">វិធីសាស្ត្រទូទាត់ <span class="text-danger">*</span></label>
                        <div class="btn-group btn-group-toggle w-100" data-toggle="buttons">
                            <label class="btn btn-outline-success active" id="labelMethodCash">
                                <input type="radio" name="payment_method" value="cash" checked autocomplete="off">
                                <i class="fas fa-money-bill-wave mr-1"></i> សាច់ប្រាក់
                            </label>
                            <label class="btn btn-outline-success" id="labelMethodCard">
                                <input type="radio" name="payment_method" value="card" autocomplete="off">
                                <i class="fas fa-credit-card mr-1"></i> កាតធនាគារ
                            </label>
                            <label class="btn btn-outline-success" id="labelMethodOnline">
                                <input type="radio" name="payment_method" value="online" autocomplete="off">
                                <i class="fas fa-qrcode mr-1"></i> Online / KHQR
                            </label>
                        </div>
                    </div>

                    <!-- Amount Paid -->
                    <div class="form-group mb-3">
                        <label for="pay_amount" class="font-weight-bold">ចំនួនប្រាក់ត្រូវបង់ ($) <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text bg-light">$</span></div>
                            <input type="number" step="0.01" name="amount" id="pay_amount" class="form-control form-control-lg font-weight-bold text-success" required>
                        </div>
                    </div>
                </div>

                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">បោះបង់</button>
                    <button type="submit" class="btn btn-success px-4" id="btnSubmitPayInvoice"><i class="fas fa-check-circle mr-1"></i> បញ្ជាក់ការទូទាត់</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- ====== Modal Print Receipt ====== --}}
<div class="modal fade" id="modalReceiptInvoice" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header modal-header-custom text-white">
                <h5 class="modal-title font-weight-bold"><i class="fas fa-print mr-2"></i> ប័ណ្ណទូទាត់ប្រាក់</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"><span>&times;</span></button>
            </div>
            <div class="modal-body p-4" id="modalReceiptBody">
                <div class="text-center py-4"><i class="fas fa-spinner fa-spin fa-2x text-muted"></i></div>
            </div>
            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">បិទ</button>
                <button type="button" class="btn btn-primary px-4" id="btnPrintReceipt"><i class="fas fa-print mr-1"></i> បោះពុម្ពវិក្កយបត្រ</button>
            </div>
        </div>
    </div>
</div>

@stop

@section('js')
<script>
    window.billingConfig = {
        indexUrl: "{{ route('billing.index') }}",
        storeUrl: "{{ route('billing.store') }}",
        baseUrl: "{{ url('billing') }}",
        showUrl: "{{ url('billing') }}",
        generateKhqrUrl: "{{ Route::has('qr.generateInvoice') ? route('qr.generateInvoice') : url('billing/khqr/generate') }}",
        checkKhqrStatusUrlBase: "{{ url('qr/status') }}",
        csrfToken: "{{ csrf_token() }}",
    };
</script>
<script src="{{ asset('js/billing.js') }}"></script>
@stop
