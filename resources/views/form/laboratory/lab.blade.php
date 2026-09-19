@extends('adminlte::page')

@section('title', 'គ្រប់គ្រងមន្ទីរពិសោធន៍ (Laboratory Management)')

@section('content')

    <style>
        .lab-container {
            font-family: 'Inter', 'Kantumruuy Pro', sans-serif;
        }

        .stat-card-lab {
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

        .stat-card-lab:hover {
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

        .bg-primary {
            background-color: #006D36 !important;
            ;
        }

        .pharmacy-nav-tabs {
            background: #f8fafc;
            padding: 6px;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            display: inline-flex;
            gap: 4px;
        }

        .pharmacy-nav-tabs .nav-link {
            border: none !important;
            border-radius: 8px !important;
            padding: 10px 24px;
            font-weight: 600;
            color: #64748b;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .pharmacy-nav-tabs .nav-link.active {
            background: #ffffff !important;
            color: #4f46e5 !important;
            box-shadow: 0 2px 8px rgba(15, 23, 42, 0.08);
        }

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

        /* Action menu button */
        .action-menu-btn {
            width: 38px;
            height: 36px;
            padding: 0;
            border: 1px solid #dee2e6;
            border-radius: 6px;
            background: #f8f9fa;
            color: #495057;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
        }

        .action-menu-btn:hover,
        .action-menu-btn:focus {
            background: #e9ecef;
            color: #212529;
            border-color: #ced4da;
            box-shadow: none;
        }

        .action-menu-btn i {
            font-size: 16px;
        }

        /* Dropdown */
        .dropdown-menu {
            min-width: 160px;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 5px 0;
            z-index: 1050;
        }

        .dropdown-item {
            padding: 9px 14px;
            font-size: 14px;
        }

        .dropdown-item:hover {
            background-color: #f8f9fa;
        }

        .dropdown-item i {
            width: 18px;
            text-align: center;
        }
    </style>

    <div class="toast-container-custom" id="toastContainer"></div>

    <div class="lab-container">
        {{-- Header --}}
        <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 mt-3">
            <div>
                <h2 class="font-weight-bold text-dark mb-1">
                    <i class="fas fa-vials text-primary mr-2"></i> គ្រប់គ្រងមន្ទីរពិសោធន៍ (Laboratory Management)
                </h2>
                <small class="text-muted">គ្រប់គ្រងការកម្មង់តេស្តពិសោធន៍ វាយបញ្ចូលលទ្ធផល និងកាតាឡុកតេស្ត</small>
            </div>

            <div>
                <button class="btn btn-outline-primary mr-2" data-toggle="modal" data-target="#modalCreateTest"
                    style="border-radius: 10px; font-weight: 600;">
                    <i class="fas fa-microscope mr-1"></i> បន្ថែមតេស្តថ្មី
                </button>
                <button class="btn btn-primary" data-toggle="modal" data-target="#modalCreateOrder"
                    style="border-radius: 10px; font-weight: 600;">
                    <i class="fas fa-plus-circle mr-1"></i> បង្កើតការកម្មង់ថ្មី
                </button>
            </div>
        </div>

        {{-- Stats Cards Grid --}}
        <div class="row mb-4">
            <div class="col-lg-3 col-md-6 mb-3">
                <div class="stat-card-lab">
                    <div class="stat-icon bg-purple-gradient">
                        <i class="fas fa-file-medical-alt"></i>
                    </div>
                    <div>
                        <small class="text-muted font-weight-bold d-block">ការកម្មង់សរុប</small>
                        <h3 id="statTotalOrders" class="m-0 font-weight-bold text-dark">{{ $totalOrders }}</h3>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-3">
                <div class="stat-card-lab">
                    <div class="stat-icon bg-amber-gradient">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div>
                        <small class="text-muted font-weight-bold d-block">កំពុងរង់ចាំ (Pending)</small>
                        <h3 id="statPendingOrders" class="m-0 font-weight-bold text-warning">{{ $pendingOrders }}</h3>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-3">
                <div class="stat-card-lab">
                    <div class="stat-icon bg-emerald-gradient">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div>
                        <small class="text-muted font-weight-bold d-block">បានបញ្ចប់ (Completed)</small>
                        <h3 id="statCompletedOrders" class="m-0 font-weight-bold text-success">{{ $completedOrders }}</h3>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-3">
                <div class="stat-card-lab">
                    <div class="stat-icon bg-blue-gradient">
                        <i class="fas fa-vial"></i>
                    </div>
                    <div>
                        <small class="text-muted font-weight-bold d-block">តេស្តកាតាឡុកសរុប</small>
                        <h3 id="statTotalTests" class="m-0 font-weight-bold text-primary">{{ $totalTests }}</h3>
                    </div>
                </div>
            </div>
        </div>

        {{-- Custom Segmented Navigation Tabs --}}
        <div class="mb-4">
            <ul class="nav pharmacy-nav-tabs" id="labTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="orders-tab" data-toggle="tab" href="#ordersPane" role="tab">
                        <i class="fas fa-list-alt"></i> ការកម្មង់ពិនិត្យ (Lab Orders)
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="tests-tab" data-toggle="tab" href="#testsPane" role="tab">
                        <i class="fas fa-microscope"></i> បញ្ជីតេស្តពិសោធន៍ (Lab Test Catalog)
                    </a>
                </li>
            </ul>
        </div>

        <div class="tab-content">
            {{-- ================= LAB ORDERS TAB ================= --}}
            <div class="tab-pane fade show active" id="ordersPane" role="tabpanel">
                <div class="card-modern">
                    <div class="card-body p-0">
                        <div class="d-flex align-items-center flex-wrap toolbar-filters">
                            <div class="search-box">
                                <i class="fas fa-search"></i>
                                <input type="text" id="orderSearch" class="form-control"
                                    placeholder="ស្វែងរកតាមលេខការកម្មង់, ឈ្មោះអ្នកជំងឺ, កូដអ្នកជំងឺ...">
                            </div>
                            <div>
                                <select id="statusFilter" class="form-control custom-select" style="border-radius: 8px;">
                                    <option value="">-- ស្ថានភាពទាំងអស់ --</option>
                                    <option value="pending">កំពុងរង់ចាំ (Pending)</option>
                                    <option value="completed">បានបញ្ចប់ (Completed)</option>
                                </select>
                            </div>
                        </div>

                        <div id="orderTableContainer">
                            @include('form.laboratory.partials.order_table')
                        </div>
                    </div>
                </div>
            </div>

            {{-- ================= LAB TESTS CATALOG TAB ================= --}}
            <div class="tab-pane fade" id="testsPane" role="tabpanel">
                <div class="card-modern">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h6 class="font-weight-bold text-dark mb-0"><i class="fas fa-vials text-primary mr-2"></i>
                                កាតាឡុកតេស្តពិសោធន៍ (Lab Tests Catalog)</h6>
                            <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalCreateTest"
                                style="border-radius: 8px;">
                                <i class="fas fa-plus mr-1"></i> បន្ថែមតេស្តថ្មី
                            </button>
                        </div>

                        @include('form.laboratory.partials.test_table')
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ====== Modal Create Order ====== --}}
    <div class="modal fade" id="modalCreateOrder" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header modal-header-custom">
                    <h5 class="modal-title font-weight-bold"><i class="fas fa-plus-circle mr-2"></i>
                        បង្កើតការកម្មង់ពិនិត្យថ្មី</h5>
                    <button type="button" class="close text-white" data-dismiss="modal"
                        aria-label="Close"><span>&times;</span></button>
                </div>
                <form action="{{ route('lab.orders.store') }}" method="POST">
                    @csrf
                    <div class="modal-body p-4">
                        <div class="row mb-3">
                            <div class="col-md-7 mb-2">
                                <label class="font-weight-bold">ជ្រើសរើសកំណត់ត្រាវេជ្ជសាស្ត្រ/អ្នកជំងឺ <span
                                        class="text-danger">*</span></label>
                                <select name="record_id" class="form-control custom-select" required>
                                    <option value="">-- ជ្រើសរើសកំណត់ត្រាវេជ្ជសាស្ត្រ --</option>
                                    @foreach ($medicalRecords as $rec)
                                        <option value="{{ $rec->record_id }}">
                                            Record #{{ $rec->record_id }} -
                                            {{ $rec->patient ? $rec->patient->full_name : 'Patient #' . $rec->patient_id }}
                                            ({{ $rec->visit_date ? \Carbon\Carbon::parse($rec->visit_date)->format('d/m/Y') : '' }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-5 mb-2">
                                <label class="font-weight-bold">កាលបរិច្ឆេទកម្មង់ <span
                                        class="text-danger">*</span></label>
                                <input type="datetime-local" name="order_date" class="form-control"
                                    value="{{ date('Y-m-d\TH:i') }}" required>
                            </div>
                        </div>

                        <h6 class="font-weight-bold text-primary mb-3"><i class="fas fa-microscope mr-1"></i>
                            ជ្រើសរើសតេស្តត្រូវពិនិត្យ (Select Tests)</h6>
                        <div class="row">
                            @foreach ($labTests as $test)
                                <div class="col-md-6 mb-2">
                                    <div class="custom-control custom-checkbox p-2 border rounded bg-light">
                                        <input type="checkbox" class="custom-control-input"
                                            id="test_cb_{{ $test->test_id }}" name="test_ids[]"
                                            value="{{ $test->test_id }}">
                                        <label class="custom-control-label font-weight-bold text-dark"
                                            for="test_cb_{{ $test->test_id }}">
                                            {{ $test->test_name }}
                                            <small
                                                class="text-muted d-block">({{ $test->test_code ?? 'T-' . $test->test_id }})
                                                - ${{ number_format($test->price, 2) }}</small>
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">បោះបង់</button>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-1"></i>
                            រក្សាទុកការកម្មង់</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- ====== Modal Enter Results ====== --}}
    <div class="modal fade" id="modalEnterResults" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title font-weight-bold"><i class="fas fa-vial mr-2"></i>
                        បញ្ចូលលទ្ធផលពិនិត្យមន្ទីរពិសោធន៍</h5>
                    <button type="button" class="close text-white" data-dismiss="modal"
                        aria-label="Close"><span>&times;</span></button>
                </div>
                <form id="formEnterResults" method="POST">
                    @csrf
                    <div class="modal-body p-4">
                        <div class="alert alert-info mb-3">
                            <strong>អ្នកជំងឺ៖ </strong><span id="resPatientName" class="font-weight-bold"></span>
                        </div>

                        <div id="resultsInputsContainer"></div>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">បោះបង់</button>
                        <button type="submit" class="btn btn-success"><i class="fas fa-check-circle mr-1"></i>
                            រក្សាទុកលទ្ធផល</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- ====== Modal Create Lab Test ====== --}}
    <div class="modal fade" id="modalCreateTest" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header modal-header-custom">
                    <h5 class="modal-title font-weight-bold"><i class="fas fa-microscope mr-2"></i> បន្ថែមតេស្តពិសោធន៍ថ្មី
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal"
                        aria-label="Close"><span>&times;</span></button>
                </div>
                <form action="{{ route('lab.tests.store') }}" method="POST">
                    @csrf
                    <div class="modal-body p-4">
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">ឈ្មោះតេស្តពិសោធន៍ <span class="text-danger">*</span></label>
                            <input type="text" name="test_name" class="form-control"
                                placeholder="ឧ. Complete Blood Count (CBC)" required>
                        </div>
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">កូដតេស្ត (Test Code)</label>
                            <input type="text" name="test_code" class="form-control" placeholder="ឧ. CBC-001">
                        </div>
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">កម្រិតធម្មតា (Normal Range)</label>
                            <input type="text" name="normal_range" class="form-control"
                                placeholder="ឧ. 4.5 - 11.0 x10^3/uL">
                        </div>
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">ខ្នាត (Unit)</label>
                            <input type="text" name="unit" class="form-control" placeholder="ឧ. mg/dL, g/dL">
                        </div>
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">តម្លៃ ($ Price) <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" min="0" name="price" class="form-control"
                                placeholder="10.00" required>
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">បោះបង់</button>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-1"></i>
                            រក្សាទុកតេស្ត</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- ====== Modal Edit Lab Test ====== --}}
    <div class="modal fade" id="modalEditTest" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-primary text-dark">
                    <h5 class="modal-title font-weight-bold"><i class="fas fa-edit mr-2"></i> កែប្រែតេស្តពិសោធន៍</h5>
                    <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close"><span>&times;</span></button>
                </div>
                <form id="formEditTest" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body p-4">
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">ឈ្មោះតេស្តពិសោធន៍ <span class="text-danger">*</span></label>
                            <input type="text" name="test_name" id="edit_test_name" class="form-control" required>
                        </div>
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">កូដតេស្ត</label>
                            <input type="text" name="test_code" id="edit_test_code" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">កម្រិតធម្មតា</label>
                            <input type="text" name="normal_range" id="edit_normal_range" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">ខ្នាត</label>
                            <input type="text" name="unit" id="edit_unit" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">តម្លៃ ($) <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" min="0" name="price" id="edit_price"
                                class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">បោះបង់</button>
                        <button type="submit" class="btn btn-primary font-weight-bold"><i class="fas fa-save mr-1"></i>
                            កែប្រែតេស្ត</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- ====== Modal Delete Test ====== --}}
    <div class="modal fade" id="modalDeleteTest" tabindex="-1" aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content border-0 shadow-lg">

                {{-- Header --}}
                <div class="modal-header border-0 bg-danger">
                    <h5 class="modal-title font-weight-bold text-white">
                        <i class="fas fa-exclamation-triangle mr-2"></i>
                        បញ្ជាក់ការលុប
                    </h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                {{-- Body --}}
                <div class="modal-body text-center px-4">

                    <div class="mb-3">
                        <i class="fas fa-trash-alt text-danger" style="font-size: 45px;"></i>
                    </div>

                    <h5 class="font-weight-bold mb-2">
                        តើអ្នកពិតជាចង់លុបតេស្តនេះមែនទេ?
                    </h5>

                    <p class="text-muted mb-0">
                        តេស្ត
                        <strong id="deleteTestName"></strong>
                        នឹងត្រូវបានលុបចេញ។
                    </p>

                    <small class="text-danger">
                        <i class="fas fa-info-circle mr-1"></i>
                        សកម្មភាពនេះមិនអាចត្រឡប់វិញបានទេ។
                    </small>

                </div>

                {{-- Footer --}}
                <div class="modal-footer border-0 justify-content-center">

                    <button type="button" class="btn btn-secondary px-4" data-dismiss="modal">
                        <i class="fas fa-times mr-1"></i>
                        បោះបង់
                    </button>

                    <form id="formDeleteTest" method="POST" class="d-inline">

                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger px-4">
                            <i class="fas fa-trash-alt mr-1"></i>
                            លុប
                        </button>

                    </form>

                </div>

            </div>

        </div>
    </div>
@stop

@section('js')
    <script>
        $(document).ready(function() {
            let debounceTimer;

            $(document).on('click', '.btn-enter-results', function() {
                const orderId = $(this).data('id');
                const results = $(this).data('results') || [];
                const patient = $(this).data('patient');

                $('#resPatientName').text(patient);
                $('#formEnterResults').attr('action', "{{ url('lab/orders') }}/" + orderId + "/results");

                let html = '';
                results.forEach((r, idx) => {
                    html += `
                <div class="card mb-3 border shadow-sm">
                    <div class="card-header bg-light font-weight-bold">
                        ${r.lab_test ? r.lab_test.test_name : 'Test #' + r.test_id}
                    </div>
                    <div class="card-body p-3">
                        <input type="hidden" name="results[${idx}][result_id]" value="${r.result_id}">
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label class="small font-weight-bold">លទ្ធផល (Result Value) <span class="text-danger">*</span></label>
                                <input type="text" name="results[${idx}][result_value]" class="form-control form-control-sm" value="${r.result_value && r.result_value !== 'Pending' ? r.result_value : ''}" placeholder="ឧ. 5.2" required>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="small font-weight-bold">កម្រិតធម្មតា (Normal Range)</label>
                                <input type="text" name="results[${idx}][normal_range]" class="form-control form-control-sm" value="${r.normal_range || (r.lab_test ? r.lab_test.normal_range : '') || ''}">
                            </div>
                            <div class="col-md-12">
                                <label class="small font-weight-bold">ចំណាំ (Remark)</label>
                                <input type="text" name="results[${idx}][remark]" class="form-control form-control-sm" value="${r.remark || ''}" placeholder="ចំណាំលទ្ធផល">
                            </div>
                        </div>
                    </div>
                </div>
            `;
                });

                $('#resultsInputsContainer').html(html);
                $('#modalEnterResults').modal('show');
            });

            $(document).on('click', '.btn-edit-test', function() {
                const id = $(this).data('id');
                $('#edit_test_name').val($(this).data('name'));
                $('#edit_test_code').val($(this).data('code'));
                $('#edit_normal_range').val($(this).data('range'));
                $('#edit_unit').val($(this).data('unit'));
                $('#edit_price').val($(this).data('price'));

                $('#formEditTest').attr('action', "{{ url('lab/tests') }}/" + id);
                $('#modalEditTest').modal('show');
            });


            $(document).on('click', '.btn-delete-test', function() {

                const id = $(this).data('id');
                const name = $(this).data('name');

                // Show test name
                $('#deleteTestName').text(name);

                // Set delete form action
                $('#formDeleteTest').attr(
                    'action',
                    "{{ url('lab/tests') }}/" + id
                );

            });

            function loadLabOrders(page = 1) {
                const search = $('#orderSearch').val();
                const status = $('#statusFilter').val();
                $('#orderTableContainer').css('opacity', '0.5');

                $.ajax({
                    url: "{{ route('lab.index') }}",
                    method: 'GET',
                    data: {
                        page: page,
                        search: search,
                        status: status
                    },
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    success: function(res) {
                        $('#orderTableContainer').html(res.html).css('opacity', '1');
                        if (res.totalOrders !== undefined) $('#statTotalOrders').text(res.totalOrders);
                        if (res.pendingOrders !== undefined) $('#statPendingOrders').text(res
                            .pendingOrders);
                        if (res.completedOrders !== undefined) $('#statCompletedOrders').text(res
                            .completedOrders);
                    },
                    error: function() {
                        $('#orderTableContainer').css('opacity', '1');
                    }
                });
            }

            $('#orderSearch').on('keyup', function() {
                clearTimeout(debounceTimer);
                debounceTimer = setTimeout(function() {
                    loadLabOrders(1);
                }, 400);
            });

            $('#statusFilter').on('change', function() {
                loadLabOrders(1);
            });

            $(document).on('click', '#orderTableContainer .pagination a', function(e) {
                e.preventDefault();
                const href = $(this).attr('href');
                if (!href) return;
                const page = new URL(href, window.location.origin).searchParams.get('page') || 1;
                loadLabOrders(page);
            });
        });
    </script>
@stop
