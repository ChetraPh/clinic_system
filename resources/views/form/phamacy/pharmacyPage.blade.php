@extends('adminlte::page')

@section('title', 'គ្រប់គ្រងឱសថស្ថាន & ការលក់ (Pharmacy & POS)')

@section('content')

<div class="pharmacy-page">

    {{-- ================= HEADER ================= --}}
    <div class="pharmacy-header">

        <div class="pharmacy-header-left">

            <div class="pharmacy-header-icon">
                <i class="fas fa-prescription-bottle-alt"></i>
            </div>

            <div>
                <h2 class="pharmacy-title">
                    គ្រប់គ្រងឱសថស្ថាន
                </h2>

                <p class="pharmacy-subtitle">
                    គ្រប់គ្រងថ្នាំ ស្តុក Supplier និងព័ត៌មានផុតកំណត់
                </p>
            </div>

        </div>


        <div id="stockActionBtns" class="pharmacy-header-actions">

            <button
                class="btn btn-supplier"
                data-toggle="modal"
                data-target="#modalSupplier">

                <i class="fas fa-truck mr-1"></i>

                បន្ថែម Supplier

            </button>


            <button
                class="btn btn-add-medicine"
                data-toggle="modal"
                data-target="#modalCreate">

                <i class="fas fa-plus-circle mr-1"></i>

                បន្ថែមថ្នាំ

            </button>

        </div>

    </div>


    {{-- ================= MAIN CONTENT ================= --}}
    <div class="pharmacy-card">

        <div class="tab-content">

            {{-- ================= STOCK TAB ================= --}}
            <div
                class="tab-pane fade show active"
                id="stockPane"
                role="tabpanel">


                {{-- ================= STAT CARDS ================= --}}
                <div class="row pharmacy-stats">

                    {{-- Total Medicine --}}
                    <div class="col-xl-3 col-lg-6 col-md-6 mb-3">

                        <div
                            class="pharmacy-stat-card stat-purple"
                            data-filter="">

                            <div class="stat-top">

                                <div class="stat-icon">
                                    <i class="fas fa-pills"></i>
                                </div>

                                <span class="stat-badge">
                                    <i class="fas fa-boxes mr-1"></i>
                                    សរុប
                                </span>

                            </div>


                            <div class="stat-content">

                                <span class="stat-label">
                                    ថ្នាំសរុប
                                </span>

                                <h3 id="statTotalMedicine">
                                    {{ number_format($stats['totalMedicine']) }}
                                </h3>

                                <a
                                    href="{{ route('pharmacy.export.names') }}"
                                    class="stat-link"
                                    onclick="event.stopPropagation()">

                                    <i class="fas fa-file-excel mr-1"></i>

                                    ទាញយកឈ្មោះថ្នាំ

                                </a>

                            </div>

                        </div>

                    </div>


                    {{-- Stock Value --}}
                    <div class="col-xl-3 col-lg-6 col-md-6 mb-3">

                        <div
                            class="pharmacy-stat-card stat-green"
                            data-filter="">

                            <div class="stat-top">

                                <div class="stat-icon">
                                    <i class="fas fa-coins"></i>
                                </div>

                                <span class="stat-badge">
                                    <i class="fas fa-chart-line mr-1"></i>
                                    Value
                                </span>

                            </div>


                            <div class="stat-content">

                                <span class="stat-label">
                                    តម្លៃស្តុកសរុប
                                </span>

                                <h3 id="statStockValue">
                                    ${{ number_format($stats['stockValue'], 2) }}
                                </h3>

                                <a
                                    href="{{ route('pharmacy.export.stockReport') }}"
                                    class="stat-link"
                                    onclick="event.stopPropagation()">

                                    <i class="fas fa-file-excel mr-1"></i>

                                    របាយការណ៍ស្តុក

                                </a>

                            </div>

                        </div>

                    </div>


                    {{-- Low Stock --}}
                    <div class="col-xl-3 col-lg-6 col-md-6 mb-3">

                        <div
                            class="pharmacy-stat-card stat-orange"
                            data-filter="low_stock">

                            <div class="stat-top">

                                <div class="stat-icon">
                                    <i class="fas fa-exclamation-triangle"></i>
                                </div>

                                <span class="stat-badge warning">
                                    <i class="fas fa-arrow-down mr-1"></i>
                                    Warning
                                </span>

                            </div>


                            <div class="stat-content">

                                <span class="stat-label">
                                    ស្តុកជិតអស់
                                </span>

                                <h3 id="statLowStock">
                                    {{ number_format($stats['lowStock']) }}
                                </h3>

                                <a
                                    href="{{ route('pharmacy.export') }}"
                                    class="stat-link"
                                    onclick="event.stopPropagation()">

                                    <i class="fas fa-file-excel mr-1"></i>

                                    ទាញយកបញ្ជីស្តុកជិតអស់

                                </a>

                            </div>

                        </div>

                    </div>


                    {{-- Expiring --}}
                    <div class="col-xl-3 col-lg-6 col-md-6 mb-3">

                        <div
                            class="pharmacy-stat-card stat-red"
                            data-filter="expiring">

                            <div class="stat-top">

                                <div class="stat-icon">
                                    <i class="fas fa-calendar-times"></i>
                                </div>

                                <span class="stat-badge danger">
                                    <i class="fas fa-clock mr-1"></i>
                                    30 ថ្ងៃ
                                </span>

                            </div>


                            <div class="stat-content">

                                <span class="stat-label">
                                    ជិតផុតកំណត់
                                </span>

                                <h3 id="statExpiringSoon">
                                    {{ number_format($stats['expiringSoon']) }}
                                </h3>

                                <a
                                    href="#"
                                    class="stat-link"
                                    id="btnExpiringDetail"
                                    onclick="event.stopPropagation()">

                                    <i class="fas fa-list mr-1"></i>

                                    មើលលម្អិត

                                </a>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- ================= STOCK TABLE ================= --}}
                <div class="stock-section">

                    {{-- Table Header --}}
                    <div class="stock-section-header">

                        <div>

                            <div class="section-title-row">

                                <div class="section-icon">
                                    <i class="fas fa-boxes"></i>
                                </div>

                                <div>

                                    <h4 class="section-title">
                                        បញ្ជីថ្នាំ និងស្តុក
                                    </h4>

                                    <p class="section-subtitle">
                                        ព័ត៌មានថ្នាំ ស្តុក និងថ្ងៃផុតកំណត់
                                    </p>

                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- Toolbar --}}
                    <div class="stock-toolbar">

                        {{-- Search --}}
                        <div class="pharmacy-search">

                            <i class="fas fa-search"></i>

                            <input
                                type="text"
                                id="stockSearch"
                                class="form-control"
                                placeholder="ស្វែងរកថ្នាំ ឈ្មោះ ប្រភេទ ឬកូដ NDC...">

                        </div>


                        {{-- Legend --}}
                        <div class="stock-legend">

                            <span class="legend-title">
                                សម្គាល់៖
                            </span>

                            <span class="legend-item legend-low">
                                <span class="legend-dot"></span>
                                ស្តុកជិតអស់
                            </span>

                            <span class="legend-item legend-expiring">
                                <span class="legend-dot"></span>
                                ជិតផុតកំណត់
                            </span>

                            <span class="legend-item legend-both">
                                <span class="legend-dot"></span>
                                ទាំងពីរ
                            </span>

                        </div>

                    </div>


                    {{-- Active Filter --}}
                    <div
                        id="activeFilterBar"
                        class="active-filter-bar d-none">

                        <div class="active-filter-content">

                            <span class="active-filter-title">
                                <i class="fas fa-filter mr-1"></i>
                                កំពុងត្រង៖
                            </span>

                            <div
                                id="activeFilterChips"
                                class="active-filter-chips">
                            </div>

                            <button
                                id="filterClearAll"
                                type="button"
                                class="btn btn-clear-filter">

                                <i class="fas fa-times mr-1"></i>

                                សម្អាតទាំងអស់

                            </button>

                        </div>

                    </div>


                    {{-- Table --}}
                    <div
                        id="departmentTableContainer"
                        class="pharmacy-table-container">

                        @include('form.phamacy.table')

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


{{-- ========================================================= --}}
{{-- CREATE MEDICINE MODAL --}}
{{-- ========================================================= --}}

<div
    class="modal fade"
    id="modalCreate"
    tabindex="-1"
    aria-hidden="true">

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content modern-modal">

            <div class="modal-header pharmacy-modal-header">

                <div class="modal-heading">

                    <div class="modal-heading-icon">
                        <i class="fas fa-pills"></i>
                    </div>

                    <div>

                        <h5 class="modal-title">
                            បន្ថែមថ្នាំថ្មី
                        </h5>

                        <span>
                            Add New Medicine
                        </span>

                    </div>

                </div>

                <button
                    type="button"
                    class="close modal-close"
                    data-dismiss="modal">

                    <span>&times;</span>

                </button>

            </div>


            <form id="createForm">

                @csrf

                <div class="modal-body p-4">

                    <div
                        class="alert alert-danger d-none"
                        id="createErrors">
                    </div>


                    <div class="form-section-title">
                        <i class="fas fa-info-circle"></i>
                        ព័ត៌មានថ្នាំ
                    </div>


                    <div class="row">

                        <div class="form-group col-md-4">

                            <label>
                                ឈ្មោះថ្នាំ
                                <span class="required">*</span>
                            </label>

                            <input
                                type="text"
                                name="medicine_name"
                                class="form-control"
                                placeholder="e.g. Amoxicillin"
                                required>

                        </div>


                        <div class="form-group col-md-4">

                            <label>
                                លេខកូដជាតិនៃថ្នាំ
                            </label>

                            <input
                                type="text"
                                name="ndc_code"
                                class="form-control"
                                placeholder="NDC 0000-0000-00">

                        </div>


                        <div class="form-group col-md-4">

                            <label>
                                ប្រភេទ
                                <span class="required">*</span>
                            </label>

                            <select
                                name="category"
                                class="form-control"
                                required>

                                <option value="">
                                    ជ្រើសរើសប្រភេទ
                                </option>

                                <option value="ថ្នាំគ្រាប់">
                                    ថ្នាំគ្រាប់
                                </option>

                                <option value="ថ្នាំទឹក">
                                    ថ្នាំទឹក
                                </option>

                                <option value="ថ្នាំចាក់">
                                    ថ្នាំចាក់
                                </option>

                                <option value="ថ្នាំសម្រាប់លាប">
                                    ថ្នាំសម្រាប់លាប
                                </option>

                                <option value="ថ្នាំបំបាត់ការឈឺចាប់">
                                    ថ្នាំបំបាត់ការឈឺចាប់
                                </option>

                            </select>

                        </div>


                        <div class="form-group col-md-4">

                            <label>
                                ឯកតាទិញចូល
                                <span class="required">*</span>
                            </label>

                            <select
                                name="unit"
                                class="form-control"
                                required>

                                <option value="">
                                    ជ្រើសរើសឯកតា
                                </option>

                                <option value="box">box</option>
                                <option value="vial">vial</option>
                                <option value="bottle">bottle</option>
                                <option value="tube">tube</option>

                            </select>

                        </div>


                        <div class="form-group col-md-4">

                            <label>
                                ទម្រង់ដូស
                                <span class="required">*</span>
                            </label>

                            <select
                                name="dosage_unit"
                                class="form-control"
                                required>

                                <option value="">
                                    ជ្រើសរើសដូស
                                </option>

                                <option value="mg">mg</option>
                                <option value="ml">ml</option>

                            </select>

                        </div>


                        <div class="form-group col-md-4">

                            <label>
                                ចំនួន mg/ml
                                <span class="required">*</span>
                            </label>

                            <input
                                type="text"
                                name="strength"
                                class="form-control"
                                placeholder="500"
                                required>

                        </div>


                        <div class="form-group col-md-4">

                            <label>
                                គ្រាប់/ឯកតា
                            </label>

                            <input
                                type="number"
                                name="pieces_per_unit"
                                min="1"
                                class="form-control"
                                value="1"
                                required>

                        </div>


                        <div class="form-group col-md-4">

                            <label>
                                ចំនួនឯកតាទិញចូល
                            </label>

                            <input
                                type="number"
                                name="quantity_initial"
                                min="0"
                                class="form-control"
                                placeholder="0"
                                required>

                        </div>


                        <div class="form-group col-md-4">

                            <label>
                                តម្លៃទិញ/ឯកតា ($)
                            </label>

                            <input
                                type="number"
                                step="0.01"
                                name="purchase_price"
                                class="form-control"
                                required>

                        </div>


                        <div class="form-group col-md-4">

                            <label>
                                តម្លៃលក់/គ្រាប់ ($)
                            </label>

                            <input
                                type="number"
                                step="0.01"
                                name="selling_price"
                                class="form-control"
                                required>

                        </div>


                        <div class="form-group col-md-4">

                            <label>
                                លេខបាច់
                            </label>

                            <input
                                type="text"
                                name="batch_number"
                                class="form-control"
                                required>

                        </div>


                        <div class="form-group col-md-4">

                            <label>
                                ថ្ងៃផុតកំណត់
                            </label>

                            <input
                                type="date"
                                name="expiry_date"
                                class="form-control"
                                required>

                        </div>


                        <div class="form-group col-md-4">

                            <label>
                                កម្រិតស្តុកទាប
                            </label>

                            <input
                                type="number"
                                name="reorder_level"
                                class="form-control"
                                value="20">

                        </div>


                        <div class="form-group col-md-4">

                            <label>
                                អ្នកផ្គត់ផ្គង់
                            </label>

                            <select
                                name="supplier_id"
                                class="form-control">

                                <option value="">
                                    មិនកំណត់
                                </option>

                                @foreach($suppliers as $supplier)

                                    <option value="{{ $supplier->supplier_id }}">
                                        {{ $supplier->name }}
                                    </option>

                                @endforeach

                            </select>

                        </div>

                    </div>

                </div>


                <div class="modal-footer modern-modal-footer">

                    <button
                        class="btn btn-modal-cancel"
                        data-dismiss="modal"
                        type="button">

                        បោះបង់

                    </button>

                    <button
                        class="btn btn-modal-save"
                        type="submit">

                        <i class="fas fa-save mr-1"></i>

                        រក្សាទុក

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


{{-- ========================================================= --}}
{{-- EDIT MODAL --}}
{{-- ========================================================= --}}

<div
    class="modal fade"
    id="modalEdit"
    tabindex="-1"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-scrollable modal-lg modal-mobile-fit">

        <div class="modal-content modern-modal">

            <div class="modal-header pharmacy-modal-header">

                <div class="modal-heading">

                    <div class="modal-heading-icon">
                        <i class="fas fa-edit"></i>
                    </div>

                    <div>

                        <h5 class="modal-title">
                            កែទិន្នន័យថ្នាំ
                        </h5>

                        <span>
                            Edit Medicine
                        </span>

                    </div>

                </div>

                <button
                    type="button"
                    class="close modal-close"
                    data-dismiss="modal">

                    <span>&times;</span>

                </button>

            </div>


            <form id="editForm">

                @csrf
                @method('PUT')

                <input
                    type="hidden"
                    name="medicine_id"
                    id="edit_medicine_id">


                <div class="modal-body">

                    <div
                        class="alert alert-danger d-none"
                        id="editErrors">
                    </div>


                    <div class="row">

                        <div class="form-group col-md-4">

                            <label>ឈ្មោះថ្នាំ</label>

                            <input
                                type="text"
                                name="medicine_name"
                                id="edit_medicine_name"
                                class="form-control"
                                required>

                        </div>


                        <div class="form-group col-md-4">

                            <label>លេខកូដជាតិនៃថ្នាំ</label>

                            <input
                                type="text"
                                name="ndc_code"
                                id="edit_ndc_code"
                                class="form-control">

                        </div>


                        <div class="form-group col-md-4">

                            <label>ប្រភេទ</label>

                            <select
                                name="category"
                                id="edit_category"
                                class="form-control"
                                required>

                                <option value="ថ្នាំគ្រាប់">
                                    ថ្នាំគ្រាប់
                                </option>

                                <option value="ថ្នាំទឹក">
                                    ថ្នាំទឹក
                                </option>

                                <option value="ថ្នាំចាក់">
                                    ថ្នាំចាក់
                                </option>

                                <option value="ថ្នាំសម្រាប់លាប">
                                    ថ្នាំសម្រាប់លាប
                                </option>

                                <option value="ថ្នាំបំបាត់ការឈឺចាប់">
                                    ថ្នាំបំបាត់ការឈឺចាប់
                                </option>

                            </select>

                        </div>


                        <div class="form-group col-md-4">

                            <label>ឯកតាទិញចូល</label>

                            <input
                                type="text"
                                name="unit"
                                id="edit_unit"
                                class="form-control"
                                required>

                        </div>


                        <div class="form-group col-md-4">

                            <label>ទម្រង់ដូស</label>

                            <select
                                name="dosage_unit"
                                id="edit_dosage_unit"
                                class="form-control"
                                required>

                                <option value="mg">mg</option>
                                <option value="ml">ml</option>

                            </select>

                        </div>


                        <div class="form-group col-md-4">

                            <label>ចំនួន mg/ml</label>

                            <input
                                type="text"
                                name="strength"
                                id="edit_strength"
                                class="form-control"
                                required>

                        </div>


                        <div class="form-group col-md-4">

                            <label>គ្រាប់/ឯកតា</label>

                            <input
                                type="number"
                                name="pieces_per_unit"
                                id="edit_pieces_per_unit"
                                min="1"
                                class="form-control"
                                required>

                        </div>


                        <div class="form-group col-md-4">

                            <label>តម្លៃទិញ/ឯកតា ($)</label>

                            <input
                                type="number"
                                step="0.01"
                                name="unit_price"
                                id="edit_unit_price"
                                class="form-control"
                                required>

                        </div>


                        <div class="form-group col-md-4">

                            <label>តម្លៃលក់/គ្រាប់ ($)</label>

                            <input
                                type="number"
                                step="0.01"
                                name="selling_price"
                                id="edit_selling_price"
                                class="form-control"
                                required>

                        </div>


                        <div class="form-group col-md-4">

                            <label>កម្រិតស្តុកទាប</label>

                            <input
                                type="number"
                                name="reorder_level"
                                id="edit_reorder_level"
                                class="form-control">

                        </div>

                    </div>


                    <div class="batch-section">

                        <div class="batch-section-title">
                            <i class="fas fa-box-open"></i>
                            បាច់ស្តុកបច្ចុប្បន្ន
                        </div>

                        <p class="text-muted small mb-2">
                            មិនអាចកែពីទីនេះបាន
                            — ប្រើប៊ូតុង "បន្ថែមស្តុក"
                        </p>

                        <div
                            id="edit_batches_list"
                            class="small">
                        </div>

                    </div>

                </div>


                <div class="modal-footer modern-modal-footer">

                    <button
                        type="button"
                        class="btn btn-modal-cancel"
                        data-dismiss="modal">

                        បោះបង់

                    </button>

                    <button
                        type="submit"
                        class="btn btn-modal-save">

                        <i class="fas fa-save mr-1"></i>

                        រក្សាទុក

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


{{-- ========================================================= --}}
{{-- RESTOCK MODAL --}}
{{-- ========================================================= --}}

<div
    class="modal fade"
    id="modalRestock"
    tabindex="-1"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-scrollable modal-lg modal-mobile-fit">

        <div class="modal-content modern-modal">

            <div class="modal-header pharmacy-modal-header">

                <div class="modal-heading">

                    <div class="modal-heading-icon">
                        <i class="fas fa-boxes"></i>
                    </div>

                    <div>

                        <h5 class="modal-title">
                            បន្ថែមស្តុក
                        </h5>

                        <span id="restock_name"></span>

                    </div>

                </div>

                <button
                    type="button"
                    class="close modal-close"
                    data-dismiss="modal">

                    <span>&times;</span>

                </button>

            </div>


            <form id="restockForm">

                @csrf

                <input
                    type="hidden"
                    name="medicine_id"
                    id="restock_medicine_id">


                <div class="modal-body">

                    <div
                        class="alert alert-danger d-none"
                        id="restockErrors">
                    </div>

                    <div
                        class="alert alert-success d-none py-2 small"
                        id="restockLastBatchHint">
                    </div>


                    <div class="row">

                        <div class="form-group col-md-6">

                            <label>
                                លេខបាច់
                            </label>

                            <input
                                type="text"
                                name="batch_number"
                                class="form-control"
                                required>

                        </div>


                        <div class="form-group col-md-6">

                            <label>
                                ចំនួនឯកតាទិញចូល
                            </label>

                            <input
                                type="number"
                                name="quantity_initial"
                                min="1"
                                class="form-control"
                                required>

                        </div>


                        <div class="form-group col-md-6">

                            <label>
                                តម្លៃទិញ/ឯកតា ($)
                            </label>

                            <input
                                type="number"
                                step="0.01"
                                name="purchase_price"
                                class="form-control"
                                required>

                        </div>


                        <div class="form-group col-md-6">

                            <label>
                                ថ្ងៃផុតកំណត់
                            </label>

                            <input
                                type="date"
                                name="expiry_date"
                                class="form-control"
                                required>

                        </div>


                        <div class="form-group col-md-6">

                            <label>
                                អ្នកផ្គត់ផ្គង់
                            </label>

                            <select
                                name="supplier_id"
                                class="form-control">

                                <option value="">
                                    មិនកំណត់
                                </option>

                                @foreach($suppliers as $supplier)

                                    <option value="{{ $supplier->supplier_id }}">
                                        {{ $supplier->name }}
                                    </option>

                                @endforeach

                            </select>

                        </div>

                    </div>

                </div>


                <div class="modal-footer modern-modal-footer">

                    <button
                        type="button"
                        class="btn btn-modal-cancel"
                        data-dismiss="modal">

                        បោះបង់

                    </button>

                    <button
                        class="btn btn-modal-save"
                        type="submit">

                        <i class="fas fa-save mr-1"></i>

                        រក្សាទុក

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


{{-- ========================================================= --}}
{{-- EXPIRING DETAIL MODAL --}}
{{-- ========================================================= --}}

<div
    class="modal fade"
    id="modalExpiringDetail"
    tabindex="-1"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-scrollable modal-lg modal-mobile-fit">

        <div class="modal-content modern-modal">

            <div class="modal-header pharmacy-modal-header">

                <div class="modal-heading">

                    <div class="modal-heading-icon danger">
                        <i class="fas fa-calendar-times"></i>
                    </div>

                    <div>

                        <h5 class="modal-title">
                            ថ្នាំជិតផុតកំណត់
                        </h5>

                        <span>
                            ក្នុងរយៈពេល ៣០ ថ្ងៃ
                        </span>

                    </div>

                </div>


                <button
                    type="button"
                    class="close modal-close"
                    data-dismiss="modal">

                    <span>&times;</span>

                </button>

            </div>


            <div class="modal-body p-0">

                <div class="table-responsive">

                    <table class="table table-sm mb-0 pharmacy-modal-table">

                        <thead>

                            <tr>

                                <th>ល.ខ</th>

                                <th>ឈ្មោះថ្នាំ</th>

                                <th>លេខបាច់</th>

                                <th class="text-right">
                                    នៅសល់
                                </th>

                                <th>
                                    ថ្ងៃផុតកំណត់
                                </th>

                                <th class="text-right">
                                    នៅសល់ប៉ុន្មានថ្ងៃ
                                </th>

                            </tr>

                        </thead>

                        <tbody id="expiringDetailBody"></tbody>

                    </table>

                </div>

            </div>


            <div class="modal-footer modern-modal-footer">

                <button
                    type="button"
                    class="btn btn-modal-cancel"
                    data-dismiss="modal">

                    បិទ

                </button>

            </div>

        </div>

    </div>

</div>


{{-- ========================================================= --}}
{{-- SUPPLIER MODAL --}}
{{-- ========================================================= --}}

<div
    class="modal fade"
    id="modalSupplier"
    tabindex="-1"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content modern-modal">

            <div class="modal-header pharmacy-modal-header">

                <div class="modal-heading">

                    <div class="modal-heading-icon">
                        <i class="fas fa-truck"></i>
                    </div>

                    <div>

                        <h5 class="modal-title">
                            បន្ថែម Supplier ថ្មី
                        </h5>

                        <span>
                            Supplier Information
                        </span>

                    </div>

                </div>


                <button
                    type="button"
                    class="close modal-close"
                    data-dismiss="modal">

                    <span>&times;</span>

                </button>

            </div>


            <form id="supplierForm">

                @csrf

                <div class="modal-body p-4">

                    <div class="form-group">

                        <label class="font-weight-bold">
                            ឈ្មោះក្រុមហ៊ុន/អ្នកផ្គត់ផ្គង់
                            <span class="required">*</span>
                        </label>

                        <input
                            type="text"
                            name="name"
                            class="form-control"
                            placeholder="ឧ. Pharma Corp Co., Ltd"
                            required>

                    </div>


                    <div class="form-group">

                        <label class="font-weight-bold">
                            លេខទូរស័ព្ទ
                        </label>

                        <input
                            type="text"
                            name="phone"
                            class="form-control"
                            placeholder="ឧ. 012 345 678">

                    </div>


                    <div class="form-group mb-0">

                        <label class="font-weight-bold">
                            អ៊ីមែល
                        </label>

                        <input
                            type="email"
                            name="email"
                            class="form-control"
                            placeholder="supplier@example.com">

                    </div>

                </div>


                <div class="modal-footer modern-modal-footer">

                    <button
                        type="button"
                        class="btn btn-modal-cancel"
                        data-dismiss="modal">

                        បោះបង់

                    </button>

                    <button
                        type="submit"
                        class="btn btn-modal-save">

                        <i class="fas fa-save mr-1"></i>

                        រក្សាទុក Supplier

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


{{-- ========================================================= --}}
{{-- DETAIL MODAL --}}
{{-- ========================================================= --}}

<div
    class="modal fade"
    id="modalDetail"
    tabindex="-1"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-scrollable modal-xl modal-mobile-fit">

        <div class="modal-content modern-modal">

            <div class="modal-header pharmacy-modal-header">

                <div class="modal-heading">

                    <div class="modal-heading-icon">
                        <i class="fas fa-box-open"></i>
                    </div>

                    <div>

                        <h5 class="modal-title">
                            លម្អិតស្តុក
                        </h5>

                        <span id="detail_medicine_name"></span>

                    </div>

                </div>


                <button
                    type="button"
                    class="close modal-close"
                    data-dismiss="modal">

                    <span>&times;</span>

                </button>

            </div>


            <div class="modal-body p-0">

                <div class="table-responsive">

                    <table class="table table-sm table-bordered mb-0 pharmacy-modal-table">

                        <thead>

                            <tr>

                                <th>លេខបាច់</th>

                                <th>ថ្ងៃចូល</th>

                                <th class="text-right">
                                    ចំនួនចូល
                                </th>

                                <th>
                                    ថ្ងៃផុតកំណត់
                                </th>

                                <th class="text-right">
                                    តម្លៃទិញ
                                </th>

                                <th>
                                    ថ្ងៃចេញ
                                </th>

                                <th class="text-right">
                                    នៅសល់
                                </th>

                            </tr>

                        </thead>

                        <tbody id="detailBatchesBody"></tbody>

                    </table>

                </div>

            </div>


            <div class="modal-footer modern-modal-footer">

                <button
                    type="button"
                    class="btn btn-modal-cancel"
                    data-dismiss="modal">

                    បិទ

                </button>

            </div>

        </div>

    </div>

</div>


<div
    class="toast-container-custom"
    id="toastContainer">
</div>

@stop


{{-- ========================================================= --}}
{{-- CSS --}}
{{-- ========================================================= --}}

@push('css')

<style>

    :root {
        --pharmacy-green: #006D36;
        --pharmacy-green-dark: #00552B;
        --pharmacy-green-light: #E8F5EE;
        --pharmacy-bg: #F5F7F6;
        --pharmacy-border: #E8ECEA;
        --pharmacy-text: #1F2A24;
        --pharmacy-muted: #7A8780;
    }


    body {
        background: #F5F7F6 !important;
    }


    .pharmacy-page {
        padding: 8px 4px 30px;
    }


    /* ================= HEADER ================= */

    .pharmacy-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 20px;
    }


    .pharmacy-header-left {
        display: flex;
        align-items: center;
        gap: 14px;
    }


    .pharmacy-header-icon {
        width: 52px;
        height: 52px;
        border-radius: 15px;
        background: linear-gradient(
            135deg,
            #006D36,
            #00A65A
        );
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        box-shadow: 0 8px 20px rgba(0, 109, 54, .18);
    }


    .pharmacy-title {
        margin: 0;
        font-size: 24px;
        font-weight: 800;
        color: var(--pharmacy-text);
    }


    .pharmacy-subtitle {
        margin: 4px 0 0;
        color: var(--pharmacy-muted);
        font-size: 13px;
    }


    .pharmacy-header-actions {
        display: flex;
        gap: 10px;
    }


    .btn-supplier {
        border: 1px solid #DCE8E1;
        background: #fff;
        color: var(--pharmacy-green);
        border-radius: 10px;
        padding: 10px 16px;
        font-weight: 600;
        transition: .2s;
    }


    .btn-supplier:hover {
        background: var(--pharmacy-green-light);
        color: var(--pharmacy-green);
        border-color: #BBD8C7;
    }


    .btn-add-medicine {
        border: none;
        background: var(--pharmacy-green);
        color: #fff;
        border-radius: 10px;
        padding: 10px 17px;
        font-weight: 600;
        box-shadow: 0 5px 14px rgba(0, 109, 54, .18);
        transition: .2s;
    }


    .btn-add-medicine:hover {
        background: var(--pharmacy-green-dark);
        color: #fff;
        transform: translateY(-1px);
    }


    /* ================= MAIN CARD ================= */

    .pharmacy-card {
        background: transparent;
        border: none;
    }


    /* ================= STATS ================= */

    .pharmacy-stats {
        margin-left: -7px;
        margin-right: -7px;
    }


    .pharmacy-stats > [class*="col-"] {
        padding-left: 7px;
        padding-right: 7px;
    }


    .pharmacy-stat-card {
        position: relative;
        background: #fff;
        border: 1px solid var(--pharmacy-border);
        border-radius: 16px;
        padding: 18px;
        min-height: 160px;
        overflow: hidden;
        cursor: pointer;
        box-shadow: 0 3px 15px rgba(31, 42, 36, .045);
        transition: all .22s ease;
    }


    .pharmacy-stat-card::after {
        content: "";
        position: absolute;
        width: 100px;
        height: 100px;
        border-radius: 50%;
        right: -35px;
        bottom: -45px;
        background: rgba(0, 0, 0, .025);
    }


    .pharmacy-stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 28px rgba(31, 42, 36, .09);
    }


    .stat-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }


    .stat-icon {
        width: 42px;
        height: 42px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 17px;
    }


    .stat-badge {
        font-size: 10px;
        font-weight: 700;
        padding: 5px 9px;
        border-radius: 20px;
        background: #EEF8F2;
        color: var(--pharmacy-green);
    }


    .stat-badge.warning {
        background: #FFF5DE;
        color: #D99200;
    }


    .stat-badge.danger {
        background: #FDECEF;
        color: #D94A61;
    }


    .stat-content {
        margin-top: 13px;
    }


    .stat-label {
        display: block;
        color: var(--pharmacy-muted);
        font-size: 12px;
        margin-bottom: 2px;
    }


    .pharmacy-stat-card h3 {
        margin: 0 0 7px;
        font-size: 25px;
        font-weight: 800;
        color: var(--pharmacy-text);
    }


    .stat-link {
        position: relative;
        z-index: 2;
        color: var(--pharmacy-green);
        font-size: 11px;
        font-weight: 600;
        text-decoration: none !important;
    }


    .stat-link:hover {
        color: var(--pharmacy-green-dark);
    }


    .stat-purple .stat-icon {
        background: #EEE9FE;
        color: #7756D9;
    }


    .stat-green .stat-icon {
        background: #E3F6EB;
        color: #008A49;
    }


    .stat-orange .stat-icon {
        background: #FFF1D8;
        color: #E09A00;
    }


    .stat-red .stat-icon {
        background: #FDE9ED;
        color: #D94A61;
    }


    /* ================= STOCK SECTION ================= */

    .stock-section {
        background: #fff;
        border: 1px solid var(--pharmacy-border);
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 3px 15px rgba(31, 42, 36, .045);
    }


    .stock-section-header {
        padding: 20px 22px 16px;
        border-bottom: 1px solid #EEF1EF;
    }


    .section-title-row {
        display: flex;
        align-items: center;
        gap: 12px;
    }


    .section-icon {
        width: 42px;
        height: 42px;
        border-radius: 12px;
        background: var(--pharmacy-green-light);
        color: var(--pharmacy-green);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
    }


    .section-title {
        margin: 0;
        font-size: 16px;
        font-weight: 750;
        color: var(--pharmacy-text);
    }


    .section-subtitle {
        margin: 3px 0 0;
        color: var(--pharmacy-muted);
        font-size: 11px;
    }


    /* ================= TOOLBAR ================= */

    .stock-toolbar {
        padding: 15px 22px;
        background: #FBFCFB;
        border-bottom: 1px solid #EEF1EF;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        flex-wrap: wrap;
    }


    .pharmacy-search {
        width: 360px;
        max-width: 100%;
        height: 42px;
        display: flex;
        align-items: center;
        gap: 10px;
        background: #fff;
        border: 1px solid #E0E7E3;
        border-radius: 11px;
        padding: 0 13px;
        transition: .2s;
    }


    .pharmacy-search:focus-within {
        border-color: var(--pharmacy-green);
        box-shadow: 0 0 0 3px rgba(0, 109, 54, .07);
    }


    .pharmacy-search i {
        color: #96A29B;
        font-size: 13px;
    }


    .pharmacy-search input {
        border: none !important;
        outline: none !important;
        box-shadow: none !important;
        background: transparent !important;
        height: 40px;
        font-size: 12px;
        padding: 0;
    }


    .stock-legend {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 9px;
    }


    .legend-title {
        color: var(--pharmacy-muted);
        font-size: 11px;
        font-weight: 700;
    }


    .legend-item {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 5px 9px;
        border-radius: 20px;
        font-size: 10px;
        font-weight: 600;
    }


    .legend-dot {
        width: 7px;
        height: 7px;
        border-radius: 50%;
    }


    .legend-low {
        background: #FFF5DE;
        color: #B97900;
    }


    .legend-low .legend-dot {
        background: #E5A900;
    }


    .legend-expiring {
        background: #FDECEF;
        color: #D94A61;
    }


    .legend-expiring .legend-dot {
        background: #D94A61;
    }


    .legend-both {
        background: #F1EAFE;
        color: #7955C7;
    }


    .legend-both .legend-dot {
        background: #7955C7;
    }


    /* ================= FILTER ================= */

    .active-filter-bar {
        margin: 14px 22px 0;
        padding: 9px 12px;
        background: #F5FAF7;
        border: 1px solid #DCEBE2;
        border-radius: 10px;
    }


    .active-filter-content {
        display: flex;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
    }


    .active-filter-title {
        font-size: 11px;
        font-weight: 700;
        color: var(--pharmacy-green);
    }


    .active-filter-chips {
        display: flex;
        flex-wrap: wrap;
        gap: 5px;
    }


    .btn-clear-filter {
        margin-left: auto;
        border-radius: 8px;
        font-size: 10px;
        padding: 4px 9px;
        color: #D94A61;
        border-color: #F1C9D0;
        background: #fff;
    }


    .btn-clear-filter:hover {
        background: #FDECEF;
        color: #C43851;
    }


    /* ================= TABLE ================= */

    .pharmacy-table-container {
        position: relative;
        min-height: 120px;
        padding: 4px 14px 16px;
        transition: opacity .15s ease;
    }


    .pharmacy-table-container.loading {
        opacity: .45;
        pointer-events: none;
    }


    #medicineTable {
        border-collapse: separate !important;
        border-spacing: 0 6px !important;
        margin-top: 4px !important;
    }


    #medicineTable thead th {
        background: #F7F9F8 !important;
        border: none !important;
        color: #718078;
        font-size: 10px;
        font-weight: 750;
        text-transform: none;
        padding: 11px 10px;
        white-space: nowrap;
    }


    #medicineTable tbody tr {
        background: #fff;
        transition: .18s;
    }


    #medicineTable tbody tr:hover {
        background: #F8FCF9;
    }


    #medicineTable tbody td {
        border-top: 1px solid #F0F2F1 !important;
        border-bottom: 1px solid #F0F2F1 !important;
        padding: 11px 10px;
        font-size: 11px;
        vertical-align: middle;
    }


    #medicineTable tbody td:first-child {
        border-left: 1px solid #F0F2F1 !important;
        border-radius: 9px 0 0 9px;
    }


    #medicineTable tbody td:last-child {
        border-right: 1px solid #F0F2F1 !important;
        border-radius: 0 9px 9px 0;
    }


    /* ================= PAGINATION ================= */

    .dataTables_wrapper .dataTables_info {
        display: none;
    }


    .dataTables_wrapper .dataTables_paginate {
        float: none !important;
        text-align: center !important;
        margin-top: 15px;
    }


    .dataTables_wrapper .pagination {
        justify-content: center;
    }


    .dataTables_wrapper .pagination .page-link {
        border-radius: 8px !important;
        margin: 0 3px !important;
        color: var(--pharmacy-green) !important;
        border: 1px solid transparent !important;
        font-size: 11px;
    }


    .dataTables_wrapper .pagination .page-item.active .page-link {
        background: var(--pharmacy-green) !important;
        border-color: var(--pharmacy-green) !important;
        color: #fff !important;
    }


    /* ================= MODAL ================= */

    .modern-modal {
        border: none;
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 20px 60px rgba(0, 0, 0, .18);
    }


    .pharmacy-modal-header {
        background: linear-gradient(
            135deg,
            #006D36,
            #008B4A
        );
        color: #fff;
        border: none;
        padding: 16px 20px;
    }


    .modal-heading {
        display: flex;
        align-items: center;
        gap: 11px;
    }


    .modal-heading-icon {
        width: 38px;
        height: 38px;
        border-radius: 10px;
        background: rgba(255,255,255,.16);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 15px;
    }


    .modal-heading-icon.danger {
        background: rgba(255,255,255,.16);
    }


    .modal-title {
        margin: 0;
        font-size: 15px;
        font-weight: 700;
    }


    .modal-heading span {
        display: block;
        margin-top: 2px;
        font-size: 10px;
        opacity: .8;
    }


    .modal-close {
        color: #fff !important;
        opacity: .9;
        font-size: 25px;
        outline: none !important;
    }


    .modal-close:hover {
        opacity: 1;
    }


    .modern-modal .modal-body {
        background: #fff;
    }


    .modern-modal label {
        color: #46534C;
        font-size: 11px;
        font-weight: 700;
        margin-bottom: 6px;
    }


    .modern-modal .form-control {
        height: 40px;
        border: 1px solid #DFE6E2;
        border-radius: 9px;
        font-size: 12px;
        transition: .2s;
    }


    .modern-modal .form-control:focus {
        border-color: var(--pharmacy-green);
        box-shadow: 0 0 0 3px rgba(0, 109, 54, .07);
    }


    .required {
        color: #E34D61;
    }


    .form-section-title {
        display: flex;
        align-items: center;
        gap: 7px;
        color: var(--pharmacy-green);
        font-size: 12px;
        font-weight: 750;
        padding-bottom: 10px;
        margin-bottom: 12px;
        border-bottom: 1px solid #EDF1EE;
    }


    .batch-section {
        background: #F7F9F8;
        border-radius: 11px;
        padding: 13px;
        margin-top: 8px;
    }


    .batch-section-title {
        color: var(--pharmacy-text);
        font-size: 12px;
        font-weight: 700;
        margin-bottom: 4px;
    }


    .batch-section-title i {
        color: var(--pharmacy-green);
        margin-right: 5px;
    }


    .modern-modal-footer {
        background: #FAFBFA;
        border-top: 1px solid #EDF1EE;
        padding: 12px 18px;
    }


    .btn-modal-cancel {
        background: #fff;
        border: 1px solid #DDE4E0;
        color: #66736C;
        border-radius: 9px;
        padding: 8px 15px;
        font-size: 12px;
        font-weight: 600;
    }


    .btn-modal-save {
        background: var(--pharmacy-green);
        border: none;
        color: #fff;
        border-radius: 9px;
        padding: 8px 17px;
        font-size: 12px;
        font-weight: 600;
    }


    .btn-modal-save:hover {
        background: var(--pharmacy-green-dark);
        color: #fff;
    }


    /* ================= MODAL TABLE ================= */

    .pharmacy-modal-table thead th {
        background: #F5F7F6;
        border: none;
        color: #69766F;
        font-size: 10px;
        font-weight: 700;
        padding: 11px;
        white-space: nowrap;
    }


    .pharmacy-modal-table tbody td {
        font-size: 11px;
        padding: 10px;
        vertical-align: middle;
    }


    /* ================= MOBILE ================= */

    @media (max-width: 991.98px) {

        .pharmacy-header {
            align-items: flex-start;
            flex-direction: column;
        }


        .pharmacy-header-actions {
            width: 100%;
        }


        .pharmacy-header-actions .btn {
            flex: 1;
        }


        .pharmacy-search {
            width: 100%;
        }


        .stock-toolbar {
            align-items: stretch;
            flex-direction: column;
        }

    }


    @media (max-width: 767.98px) {

        .pharmacy-page {
            padding: 5px 0 20px;
        }


        .pharmacy-title {
            font-size: 19px;
        }


        .pharmacy-subtitle {
            font-size: 11px;
        }


        .pharmacy-header-icon {
            width: 45px;
            height: 45px;
            font-size: 18px;
        }


        .stock-section-header {
            padding: 16px;
        }


        .stock-toolbar {
            padding: 13px 16px;
        }


        .pharmacy-table-container {
            padding-left: 8px;
            padding-right: 8px;
            overflow-x: auto;
        }


        .modal-mobile-fit {
            margin: 0;
            max-width: 100%;
            height: 100%;
        }


        .modal-mobile-fit .modal-content {
            height: 100%;
            border-radius: 0;
        }


        .modal-mobile-fit .modal-body {
            overflow-y: auto;
            -webkit-overflow-scrolling: touch;
            max-height: calc(100vh - 120px);
        }


        .modal-mobile-fit .modal-header,
        .modal-mobile-fit .modal-footer {
            flex-shrink: 0;
        }

    }


    @media (max-width: 575.98px) {

        .pharmacy-header-actions {
            flex-direction: column;
        }


        .pharmacy-header-actions .btn {
            width: 100%;
        }


        .pharmacy-stat-card {
            min-height: 145px;
        }


        .stock-legend {
            align-items: flex-start;
            flex-direction: column;
        }


        .legend-title {
            margin-bottom: 2px;
        }

    }

</style>


<link
    rel="stylesheet"
    href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">

<link
    rel="stylesheet"
    href="{{ asset('css/pharmacy.css') }}">

@endpush


{{-- ========================================================= --}}
{{-- JAVASCRIPT --}}
{{-- ========================================================= --}}

@section('js')

<script>

    const csrf = "{{ csrf_token() }}";

    const routes = {

        data: "{{ route('pharmacy.data') }}",

        store: "{{ route('pharmacy.store') }}",

        editBase: "{{ url('pharmacy') }}",

        updateBase: "{{ url('pharmacy') }}",

        destroyBase: "{{ url('pharmacy') }}",

        restockBase: "{{ url('pharmacy') }}",

        expiringDetail: "{{ route('pharmacy.expiring.detail') }}",

        supplierStore: "{{ route('pharmacy.suppliers.store') }}",

        stats: "{{ route('pharmacy.stats') }}",

        detailsBase: "{{ url('pharmacy') }}"

    };


    $(function () {

        const $stockActionBtns =
            $('#stockActionBtns');


        $.extend(true, $.fn.dataTable.defaults, {

            language: {

                paginate: {
                    previous: '‹',
                    next: '›'
                }

            }

        });


        $(document).on(
            'shown.bs.tab',
            '#stock-tab',
            function () {

                $stockActionBtns.show();

            }
        );


        let stockSearchTimer;


        $('#stockSearch').on('keyup', function () {

            clearTimeout(stockSearchTimer);

            const val = $(this).val();


            stockSearchTimer = setTimeout(function () {

                if ($.fn.DataTable.isDataTable('#medicineTable')) {

                    $('#medicineTable')
                        .DataTable()
                        .search(val)
                        .draw();

                }

            }, 400);

        });


        const detailId =
            new URLSearchParams(window.location.search)
                .get('detail');


        if (detailId) {

            $('#stock-tab').tab('show');


            $.get(
                routes.detailsBase + '/' + detailId + '/details',
                function (data) {

                    $('#detail_medicine_name')
                        .text(data.medicine_name);


                    const rows =
                        data.batches.map(function (b) {

                            const outsHtml =
                                b.outs.length

                                    ? b.outs
                                        .map(
                                            o =>
                                                `${o.date} (-${o.quantity})`
                                        )
                                        .join('<br>')

                                    : '-';


                            return `

                                <tr>

                                    <td>
                                        ${b.batch_number}
                                    </td>

                                    <td>
                                        ${b.date_in}
                                    </td>

                                    <td class="text-right">
                                        ${b.quantity_initial}
                                    </td>

                                    <td>
                                        ${b.expiry_date}
                                    </td>

                                    <td class="text-right">
                                        $${parseFloat(
                                            b.purchase_price
                                        ).toFixed(2)}
                                    </td>

                                    <td>
                                        ${outsHtml}
                                    </td>

                                    <td class="text-right">
                                        ${b.remaining_quantity}
                                    </td>

                                </tr>

                            `;

                        })
                        .join('');


                    $('#detailBatchesBody')
                        .html(
                            rows ||
                            '<tr><td colspan="7" class="text-center text-muted py-4">គ្មានទិន្នន័យ</td></tr>'
                        );


                    $('#modalDetail').modal('show');

                }
            );

        }

    });

</script>


<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>

<script src="{{ asset('js/pharmacy.js') }}"></script>

@stop