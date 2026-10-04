@extends('adminlte::page')

@section('title', 'គ្រប់គ្រងវេជ្ជបញ្ជា (Prescription Management)')

@section('content')

<style>
    /* ================================
       Page
    ================================= */
    .prescription-page {
        padding-top: 5px;
    }

    /* ================================
       Statistics Card
    ================================= */
    .stat-card {
        background: #ffffff;
        border: 1px solid #eef2f7;
        border-radius: 14px;
        padding: 18px 20px;
        display: flex;
        align-items: center;
        min-height: 88px;
        box-shadow: 0 4px 16px rgba(15, 23, 42, 0.05);
        transition: all 0.2s ease;
    }

    .stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 22px rgba(15, 23, 42, 0.08);
    }

    .stat-card .icon {
        width: 50px;
        height: 50px;
        min-width: 50px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 21px;
        margin-right: 14px;
    }

    .bg-light-primary {
        background: #eef4ff;
        color: #2563eb;
    }

    .stat-card small {
        color: #64748b !important;
        font-size: 12px;
        font-weight: 500;
        margin-bottom: 3px;
    }

    .stat-card h3 {
        color: #1e293b;
        font-size: 24px;
        line-height: 1;
    }

    /* ================================
       Header Button
    ================================= */
    .btn-pharmacy {
        height: 40px;
        padding: 0 16px;
        border-radius: 9px;
        font-size: 13px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        transition: all 0.2s ease;
    }

    .btn-pharmacy:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(15, 23, 42, 0.08);
    }

    /* ================================
       Main Card
    ================================= */
    .prescription-card {
        background: #ffffff;
        border: 1px solid #eef2f7;
        border-radius: 14px;
        overflow: hidden;
        box-shadow: 0 4px 18px rgba(15, 23, 42, 0.05);
    }

    /* ================================
       Toolbar
    ================================= */
    .toolbar {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 16px 20px;
        background: #ffffff;
        border-bottom: 1px solid #eef2f7;
    }

    .search-box {
        position: relative;
        width: 100%;
        max-width: 520px;
    }

    .search-box i {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: #94a3b8;
        font-size: 14px;
        z-index: 2;
    }

    .search-box input {
        height: 40px;
        padding-left: 40px;
        padding-right: 14px;
        border-radius: 9px;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        color: #334155;
        font-size: 13px;
        transition: all 0.2s ease;
    }

    .search-box input::placeholder {
        color: #94a3b8;
    }

    .search-box input:focus {
        background: #ffffff;
        border-color: #93c5fd;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.08);
    }

    /* ================================
       Table Area
    ================================= */
    .prescription-table-wrapper {
        padding: 18px 20px 20px;
    }

    #prescriptionTableContainer {
        transition: opacity 0.2s ease;
    }

    /* ================================
       Prescription Item
    ================================= */
    .prescription-item-row {
        background: #f8fafc;
        padding: 14px;
        border-radius: 10px;
        margin-bottom: 10px;
        border: 1px solid #e2e8f0;
        transition: all 0.2s ease;
    }

    .prescription-item-row:hover {
        border-color: #cbd5e1;
        background: #ffffff;
    }

    .prescription-item-row label {
        color: #475569;
        margin-bottom: 5px;
        font-size: 12px;
    }

    .prescription-item-row .form-control {
        border-radius: 7px;
        border-color: #dbe3ec;
        font-size: 13px;
    }

    .prescription-item-row .form-control:focus {
        border-color: #93c5fd;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.08);
    }

    /* ================================
       Toast
    ================================= */
    #toastContainer {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 9999;
    }

    .toast-custom {
        min-width: 280px;
        max-width: 400px;
        padding: 12px 18px;
        margin-bottom: 10px;
        border-radius: 10px;
        color: #ffffff;
        font-size: 13px;
        font-weight: 500;
        box-shadow: 0 8px 24px rgba(15, 23, 42, 0.15);
        animation: toastSlide 0.25s ease;
    }

    .toast-custom.success {
        background: #16a34a;
    }

    .toast-custom.error {
        background: #dc2626;
    }

    @keyframes toastSlide {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* ================================
       Responsive
    ================================= */
    @media (max-width: 768px) {
        .toolbar {
            padding: 14px;
        }

        .search-box {
            max-width: 100%;
        }

        .prescription-table-wrapper {
            padding: 14px;
        }

        .stat-card {
            margin-bottom: 10px;
        }

        .header-actions {
            text-align: left !important;
            margin-top: 5px;
        }
    }
</style>

<div class="prescription-page">

    {{-- Toast --}}
    <div id="toastContainer"></div>

    {{-- ================================
         Header / Statistics
    ================================= --}}
    <div class="row mb-4 align-items-center">

        {{-- Total Prescriptions --}}
        <div class="col-md-4 col-sm-6 mb-2 mb-md-0">
            <div class="stat-card">
                <div class="icon bg-light-primary">
                    <i class="fas fa-file-prescription"></i>
                </div>

                <div>
                    <small class="d-block">
                        វេជ្ជបញ្ជាសរុប
                    </small>

                    <h3 id="statTotal" class="m-0 font-weight-bold">
                        {{ $totalPrescriptions }}
                    </h3>
                </div>
            </div>
        </div>

        {{-- Pharmacy Button --}}
        <div class="col-md-8 header-actions text-right">
            <a href="{{ route('pharmacy.index') }}"
               class="btn btn-outline-secondary btn-pharmacy">

                <i class="fas fa-pills mr-2"></i>
                ឱសថស្ថាន
            </a>
        </div>

    </div>


    {{-- ================================
         Main Prescription Card
    ================================= --}}
    <div class="prescription-card">

        {{-- Toolbar --}}
        <div class="toolbar flex-wrap">

            <div class="search-box">
                <i class="fas fa-search"></i>

                <input type="text"
                       id="search"
                       class="form-control"
                       placeholder="ស្វែងរកតាមឈ្មោះអ្នកជំងឺ, កូដ, ឈ្មោះថ្នាំ...">
            </div>

        </div>


        {{-- Table --}}
        <div class="prescription-table-wrapper">

            <div id="prescriptionTableContainer">
                @include('form.phamacy.partials.prescription_table')
            </div>

        </div>

    </div>

</div>

@stop


@section('js')

<script>
$(document).ready(function () {

    let itemIndex = 1;
    let debounceTimer;


    /* ==========================================
       Add Prescription Item
    ========================================== */
    $('#btnAddRow').on('click', function () {

        let medicineOptions = `
            @foreach ($medicines as $med)
                <option value="{{ $med->medicine_id }}">
                    {{ $med->medicine_name }} ({{ $med->unit }})
                </option>
            @endforeach
        `;

        let newRow = `
            <div class="prescription-item-row">

                <div class="row">

                    <div class="col-md-4 mb-2">
                        <label class="small font-weight-bold">
                            ឈ្មោះថ្នាំ (Medicine)
                        </label>

                        <select name="items[${itemIndex}][medicine_id]"
                                class="form-control form-control-sm"
                                required>

                            <option value="">
                                -- ជ្រើសរើសថ្នាំ --
                            </option>

                            ${medicineOptions}

                        </select>
                    </div>


                    <div class="col-md-3 mb-2">
                        <label class="small font-weight-bold">
                            កម្រិតប្រើ (Dosage)
                        </label>

                        <input type="text"
                               name="items[${itemIndex}][dosage]"
                               class="form-control form-control-sm"
                               placeholder="ឧ. 1 គ្រាប់"
                               required>
                    </div>


                    <div class="col-md-3 mb-2">
                        <label class="small font-weight-bold">
                            ពិសារ (Frequency)
                        </label>

                        <input type="text"
                               name="items[${itemIndex}][frequency]"
                               class="form-control form-control-sm"
                               placeholder="ឧ. 3 ដង/ថ្ងៃ ក្រោយបាយ"
                               required>
                    </div>


                    <div class="col-md-2 mb-2">
                        <label class="small font-weight-bold">
                            ចំនួនថ្ងៃ (Days)
                        </label>

                        <input type="number"
                               min="1"
                               name="items[${itemIndex}][duration_days]"
                               class="form-control form-control-sm"
                               value="5"
                               required>
                    </div>


                    <div class="col-md-3 mb-2">
                        <label class="small font-weight-bold">
                            ចំនួនសរុប (Total Qty)
                        </label>

                        <input type="number"
                               min="1"
                               name="items[${itemIndex}][quantity]"
                               class="form-control form-control-sm"
                               value="15"
                               required>
                    </div>


                    <div class="col-md-1 mb-2 d-flex align-items-end">

                        <button type="button"
                                class="btn btn-sm btn-outline-danger btn-remove-row">

                            <i class="fas fa-trash"></i>

                        </button>

                    </div>

                </div>

            </div>
        `;

        $('#itemsContainer').append(newRow);

        itemIndex++;
    });


    /* ==========================================
       Remove Prescription Item
    ========================================== */
    $(document).on('click', '.btn-remove-row', function () {

        $(this)
            .closest('.prescription-item-row')
            .remove();

    });


    /* ==========================================
       Load Prescriptions
    ========================================== */
    function loadPrescriptions(page = 1) {

        const search = $('#search').val();

        $('#prescriptionTableContainer')
            .css('opacity', '0.5');

        $.ajax({

            url: "{{ route('pharmacy.prescriptions.index') }}",

            method: 'GET',

            data: {
                page: page,
                search: search
            },

            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            },

            success: function (res) {

                $('#prescriptionTableContainer')
                    .html(res.html)
                    .css('opacity', '1');

                if (res.total !== undefined) {
                    $('#statTotal').text(res.total);
                }
            },

            error: function () {

                $('#prescriptionTableContainer')
                    .css('opacity', '1');

            }

        });
    }


    /* ==========================================
       Search
    ========================================== */
    $('#search').on('keyup', function () {

        clearTimeout(debounceTimer);

        debounceTimer = setTimeout(function () {

            loadPrescriptions(1);

        }, 400);

    });


    /* ==========================================
       Pagination
    ========================================== */
    $(document).on(
        'click',
        '#prescriptionTableContainer .pagination a',
        function (e) {

            e.preventDefault();

            const href = $(this).attr('href');

            if (!href) {
                return;
            }

            const page =
                new URL(
                    href,
                    window.location.origin
                ).searchParams.get('page') || 1;

            loadPrescriptions(page);

        }
    );


    /* ==========================================
       Toast
    ========================================== */
    function showToast(message, type = 'success') {

        let toast = `
            <div class="toast-custom ${type}">
                ${message}
            </div>
        `;

        $('#toastContainer').append(toast);

        setTimeout(function () {

            $('.toast-custom:first')
                .fadeOut(300, function () {
                    $(this).remove();
                });

        }, 3000);
    }


    /* ==========================================
       Session Messages
    ========================================== */
    @if(session('success'))

        showToast(
            @json(session('success')),
            'success'
        );

    @endif


    @if(session('error'))

        showToast(
            @json(session('error')),
            'error'
        );

    @endif

});
</script>

@stop