@extends('adminlte::page')

@section('title', 'ការគ្រប់គ្រងបន្ទប់')

@section('content')

<div class="room-page">

    <div class="toast-container-custom" id="toastContainer"></div>

    {{-- Header --}}
    <div class="room-header mb-4">
        <div>
            <div class="room-header-icon">
                <i class="fas fa-door-open"></i>
            </div>
            <div>
                <h2>ការគ្រប់គ្រងបន្ទប់</h2>
                <p>គ្រប់គ្រងព័ត៌មាន ស្ថានភាព និងតម្លៃបន្ទប់</p>
            </div>
        </div>

        <button type="button"
                class="btn btn-light btn-add-room"
                data-toggle="modal"
                data-target="#modalCreateRoom">
            <i class="fas fa-plus mr-2"></i>
            បន្ថែមបន្ទប់ថ្មី
        </button>
    </div>

    {{-- Statistics --}}
    <div class="row stats-row mb-4">

        <div class="col-xl-3 col-md-6 mb-3 mb-xl-0">
            <div class="stat-card">
                <div class="stat-icon stat-icon-total">
                    <i class="fas fa-door-open"></i>
                </div>
                <div class="stat-content">
                    <span>បន្ទប់សរុប</span>
                    <h3 id="statTotal">{{ $stats['total'] }}</h3>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-3 mb-xl-0">
            <div class="stat-card">
                <div class="stat-icon stat-icon-available">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stat-content">
                    <span>ទំនេរ</span>
                    <h3 id="statAvailable">{{ $stats['available'] }}</h3>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-3 mb-xl-0">
            <div class="stat-card">
                <div class="stat-icon stat-icon-occupied">
                    <i class="fas fa-user-injured"></i>
                </div>
                <div class="stat-content">
                    <span>កំពុងប្រើប្រាស់</span>
                    <h3 id="statOccupied">{{ $stats['occupied'] }}</h3>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="stat-card">
                <div class="stat-icon stat-icon-maintenance">
                    <i class="fas fa-tools"></i>
                </div>
                <div class="stat-content">
                    <span>កំពុងថែទាំ</span>
                    <h3 id="statMaintenance">{{ $stats['maintenance'] }}</h3>
                </div>
            </div>
        </div>

    </div>

    {{-- Room Management --}}
    <div class="room-panel">

        {{-- Toolbar --}}
        <div class="room-toolbar">

            <div class="toolbar-left">

                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text"
                           id="search"
                           class="form-control"
                           placeholder="ស្វែងរកលេខបន្ទប់...">
                </div>

                <select id="filterType" class="form-control filter-select">
                    <option value="">ប្រភេទបន្ទប់ទាំងអស់</option>

                    @foreach(\App\Models\Room::typeLabels() as $val => $label)
                        <option value="{{ $val }}">{{ $label }}</option>
                    @endforeach
                </select>

                <select id="filterStatus" class="form-control filter-select">
                    <option value="">ស្ថានភាពទាំងអស់</option>

                    @foreach(\App\Models\Room::statusLabels() as $val => $label)
                        <option value="{{ $val }}">{{ $label }}</option>
                    @endforeach
                </select>

            </div>

            <button type="button"
                    class="btn btn-room-primary"
                    data-toggle="modal"
                    data-target="#modalCreateRoom">
                <i class="fas fa-plus mr-1"></i>
                បន្ថែមបន្ទប់
            </button>

        </div>

        {{-- Table --}}
        <div class="room-table-wrapper">
            <div id="roomTableContainer">
                @include('form.room.partials.table')
            </div>
        </div>

    </div>

</div>


{{-- ============================================================= --}}
{{-- CREATE ROOM MODAL --}}
{{-- ============================================================= --}}

<div class="modal fade"
     id="modalCreateRoom"
     tabindex="-1"
     aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content room-modal">

            <div class="modal-header room-modal-header">

                <div class="modal-title-wrapper">
                    <div class="modal-icon">
                        <i class="fas fa-door-open"></i>
                    </div>

                    <div>
                        <h5 class="modal-title">
                            បន្ថែមបន្ទប់ថ្មី
                        </h5>

                        <small>
                            បញ្ចូលព័ត៌មានបន្ទប់ថ្មី
                        </small>
                    </div>
                </div>

                <button type="button"
                        class="close modal-close"
                        data-dismiss="modal">
                    <span>&times;</span>
                </button>

            </div>

            <form id="createRoomForm"
                  action="{{ route('room.store') }}"
                  method="POST">

                @csrf

                <div class="modal-body room-modal-body">

                    <div id="createRoomAlert"
                         class="alert alert-danger d-none mb-3"></div>

                    <div class="form-row">

                        {{-- Room Number --}}
                        <div class="form-group col-md-6">

                            <label>
                                បន្ទប់លេខ
                                <span class="text-danger">*</span>
                            </label>

                            <div class="input-icon-wrapper">
                                <i class="fas fa-door-open"></i>

                                <input type="text"
                                       name="room_number"
                                       id="create_room_number"
                                       class="form-control"
                                       placeholder="ICU-402-B"
                                       maxlength="20"
                                       required>
                            </div>

                            <div class="invalid-feedback"
                                 id="error_create_room_number">
                            </div>

                        </div>

                        {{-- Room Type --}}
                        <div class="form-group col-md-6">

                            <label>
                                ប្រភេទបន្ទប់
                                <span class="text-danger">*</span>
                            </label>

                            <select name="room_type"
                                    id="create_room_type"
                                    class="form-control custom-select"
                                    required>

                                <option value="">
                                    ជ្រើសរើសប្រភេទ
                                </option>

                                <option value="general">
                                    ទូទៅ
                                </option>

                                <option value="private">
                                    ឯកជន
                                </option>

                                <option value="icu">
                                    ICU
                                </option>

                                <option value="isolation">
                                    គ្រែមួយ
                                </option>

                            </select>

                            <div class="invalid-feedback"
                                 id="error_create_room_type">
                            </div>

                        </div>

                    </div>


                    <div class="form-row">

                        {{-- Status --}}
                        <div class="form-group col-md-6">

                            <label>
                                ស្ថានភាព
                                <span class="text-danger">*</span>
                            </label>

                            <select name="status"
                                    id="create_status"
                                    class="form-control custom-select"
                                    required>

                                <option value="available">
                                    ទំនេរ
                                </option>

                                <option value="occupied">
                                    បានប្រើប្រាស់
                                </option>

                                <option value="maintenance">
                                    ថែទាំ
                                </option>

                            </select>

                            <div class="invalid-feedback"
                                 id="error_create_status">
                            </div>

                        </div>


                        {{-- Price --}}
                        <div class="form-group col-md-6">

                            <label>
                                តម្លៃ / ថ្ងៃ
                                <span class="text-danger">*</span>
                            </label>

                            <div class="input-group price-input">

                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        $
                                    </span>
                                </div>

                                <input type="number"
                                       step="0.01"
                                       min="0"
                                       name="price_per_day"
                                       id="create_price_per_day"
                                       class="form-control"
                                       placeholder="0.00"
                                       required>

                            </div>

                            <div class="invalid-feedback d-block"
                                 id="error_create_price_per_day">
                            </div>

                        </div>

                    </div>

                </div>


                <div class="modal-footer room-modal-footer">

                    <button type="button"
                            class="btn btn-light room-cancel-btn"
                            data-dismiss="modal">
                        បោះបង់
                    </button>

                    <button type="submit"
                            class="btn btn-room-primary px-4"
                            id="btnSubmitCreateRoom">

                        <i class="fas fa-save mr-1"></i>
                        រក្សាទុកបន្ទប់

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


{{-- ============================================================= --}}
{{-- EDIT ROOM MODAL --}}
{{-- ============================================================= --}}

<div class="modal fade"
     id="modalEditRoom"
     tabindex="-1"
     aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content room-modal">

            <div class="modal-header room-modal-header">

                <div class="modal-title-wrapper">

                    <div class="modal-icon edit-modal-icon">
                        <i class="fas fa-edit"></i>
                    </div>

                    <div>
                        <h5 class="modal-title">
                            កែប្រែព័ត៌មានបន្ទប់
                        </h5>

                        <small>
                            ធ្វើបច្ចុប្បន្នភាពព័ត៌មានបន្ទប់
                        </small>
                    </div>

                </div>

                <button type="button"
                        class="close modal-close"
                        data-dismiss="modal">
                    <span>&times;</span>
                </button>

            </div>


            <form id="editRoomForm"
                  method="POST">

                @csrf
                @method('PUT')

                <div class="modal-body room-modal-body">

                    <div id="editRoomAlert"
                         class="alert alert-danger d-none mb-3">
                    </div>


                    <div class="form-row">

                        {{-- Room Number --}}
                        <div class="form-group col-md-6">

                            <label>
                                បន្ទប់លេខ
                                <span class="text-danger">*</span>
                            </label>

                            <div class="input-icon-wrapper">

                                <i class="fas fa-door-open"></i>

                                <input type="text"
                                       name="room_number"
                                       id="edit_room_number"
                                       class="form-control"
                                       maxlength="20"
                                       required>

                            </div>

                            <div class="invalid-feedback"
                                 id="error_edit_room_number">
                            </div>

                        </div>


                        {{-- Room Type --}}
                        <div class="form-group col-md-6">

                            <label>
                                ប្រភេទបន្ទប់
                                <span class="text-danger">*</span>
                            </label>

                            <select name="room_type"
                                    id="edit_room_type"
                                    class="form-control custom-select"
                                    required>

                                <option value="general">
                                    ទូទៅ
                                </option>

                                <option value="private">
                                    ឯកជន
                                </option>

                                <option value="icu">
                                    ICU
                                </option>

                                <option value="isolation">
                                    គ្រែមួយ
                                </option>

                            </select>

                            <div class="invalid-feedback"
                                 id="error_edit_room_type">
                            </div>

                        </div>

                    </div>


                    <div class="form-row">

                        {{-- Status --}}
                        <div class="form-group col-md-6">

                            <label>
                                ស្ថានភាព
                                <span class="text-danger">*</span>
                            </label>

                            <select name="status"
                                    id="edit_status"
                                    class="form-control custom-select"
                                    required>

                                <option value="available">
                                    ទំនេរ
                                </option>

                                <option value="occupied">
                                    បានប្រើប្រាស់
                                </option>

                                <option value="maintenance">
                                    ថែទាំ
                                </option>

                            </select>

                            <div class="invalid-feedback"
                                 id="error_edit_status">
                            </div>

                        </div>


                        {{-- Price --}}
                        <div class="form-group col-md-6">

                            <label>
                                តម្លៃ / ថ្ងៃ
                                <span class="text-danger">*</span>
                            </label>

                            <div class="input-group price-input">

                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        $
                                    </span>
                                </div>

                                <input type="number"
                                       step="0.01"
                                       min="0"
                                       name="price_per_day"
                                       id="edit_price_per_day"
                                       class="form-control"
                                       required>

                            </div>

                            <div class="invalid-feedback d-block"
                                 id="error_edit_price_per_day">
                            </div>

                        </div>

                    </div>

                </div>


                <div class="modal-footer room-modal-footer">

                    <button type="button"
                            class="btn btn-light room-cancel-btn"
                            data-dismiss="modal">
                        បោះបង់
                    </button>

                    <button type="submit"
                            class="btn btn-room-primary px-4"
                            id="btnSubmitEditRoom">

                        <i class="fas fa-save mr-1"></i>
                        រក្សាទុកការកែប្រែ

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


{{-- ============================================================= --}}
{{-- DELETE MODAL --}}
{{-- ============================================================= --}}

<div class="modal fade"
     id="modalDeleteRoom"
     tabindex="-1"
     aria-hidden="true">

    <div class="modal-dialog modal-sm modal-dialog-centered">

        <div class="modal-content delete-modal">

            <div class="delete-icon">
                <i class="fas fa-trash-alt"></i>
            </div>

            <h5>
                លុបបន្ទប់
            </h5>

            <p>
                តើអ្នកពិតជាចង់លុបបន្ទប់
                <strong id="deleteRoomNumber"></strong>
                មែនទេ?
            </p>

            <form id="deleteRoomForm"
                  method="POST">

                @csrf
                @method('DELETE')

                <div class="delete-actions">

                    <button type="button"
                            class="btn btn-light"
                            data-dismiss="modal">
                        បោះបង់
                    </button>

                    <button type="submit"
                            class="btn btn-danger">

                        <i class="fas fa-trash mr-1"></i>
                        លុប

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@stop


@section('css')

<style>

:root {
    --room-green: #006D36;
    --room-green-dark: #00552B;
    --room-green-light: #E8F5EE;
    --room-bg: #F5F7F6;
    --room-border: #E7ECE9;
    --room-text: #1F2A24;
    --room-muted: #7A8780;
}


/* =========================
   PAGE
========================= */

.room-page {
    padding-top: 8px;
    padding-bottom: 30px;
}


/* =========================
   HEADER
========================= */

.room-header {
    min-height: 145px;
    padding: 28px 30px;
    border-radius: 16px;
    background: linear-gradient(
        135deg,
        #006D36 0%,
        #008747 100%
    );
    box-shadow: 0 8px 28px rgba(0, 109, 54, .16);

    display: flex;
    align-items: center;
    justify-content: space-between;
    color: #fff;
}

.room-header > div:first-child {
    display: flex;
    align-items: center;
    gap: 18px;
}

.room-header-icon {
    width: 64px;
    height: 64px;
    border-radius: 16px;
    background: rgba(255,255,255,.16);

    display: flex;
    align-items: center;
    justify-content: center;

    font-size: 28px;
}

.room-header h2 {
    margin: 0 0 5px;
    font-size: 25px;
    font-weight: 700;
}

.room-header p {
    margin: 0;
    color: rgba(255,255,255,.82);
    font-size: 14px;
}

.btn-add-room {
    border: none;
    border-radius: 11px;
    padding: 11px 18px;
    color: var(--room-green);
    font-weight: 700;
    box-shadow: 0 4px 12px rgba(0,0,0,.08);
}

.btn-add-room:hover {
    color: var(--room-green-dark);
    transform: translateY(-1px);
}


/* =========================
   STAT CARDS
========================= */

.stat-card {
    min-height: 105px;
    background: #fff;
    border: 1px solid var(--room-border);
    border-radius: 14px;
    padding: 20px;

    display: flex;
    align-items: center;
    gap: 16px;

    box-shadow: 0 5px 18px rgba(0,0,0,.04);

    transition: all .2s ease;
}

.stat-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(0,0,0,.07);
}

.stat-icon {
    width: 52px;
    height: 52px;
    flex: 0 0 52px;

    border-radius: 14px;

    display: flex;
    align-items: center;
    justify-content: center;

    font-size: 21px;
}

.stat-icon-total {
    background: #E8F5EE;
    color: var(--room-green);
}

.stat-icon-available {
    background: #DFF6E8;
    color: #18864B;
}

.stat-icon-occupied {
    background: #E8F0FA;
    color: #286090;
}

.stat-icon-maintenance {
    background: #FFF4E0;
    color: #B8720A;
}

.stat-content span {
    display: block;
    color: var(--room-muted);
    font-size: 13px;
    margin-bottom: 3px;
}

.stat-content h3 {
    margin: 0;
    color: var(--room-text);
    font-size: 25px;
    font-weight: 700;
}


/* =========================
   MAIN PANEL
========================= */

.room-panel {
    background: #fff;
    border: 1px solid var(--room-border);
    border-radius: 15px;
    overflow: hidden;

    box-shadow: 0 7px 25px rgba(0,0,0,.045);
}


/* =========================
   TOOLBAR
========================= */

.room-toolbar {
    min-height: 78px;
    padding: 16px 20px;

    display: flex;
    align-items: center;
    justify-content: space-between;

    gap: 15px;
    border-bottom: 1px solid var(--room-border);
}

.toolbar-left {
    display: flex;
    align-items: center;
    gap: 10px;
    flex-wrap: wrap;
}

.search-box {
    width: 245px;
    height: 42px;

    display: flex;
    align-items: center;

    background: #F5F8F6;
    border: 1px solid transparent;
    border-radius: 10px;

    padding: 0 13px;

    transition: .2s;
}

.search-box:focus-within {
    background: #fff;
    border-color: #A9D8BD;
    box-shadow: 0 0 0 3px rgba(0,109,54,.07);
}

.search-box i {
    color: #8B9891;
    font-size: 14px;
    margin-right: 8px;
}

.search-box input {
    height: 40px;
    padding: 0;
    border: none;
    background: transparent;
    box-shadow: none !important;
    font-size: 13px;
}

.search-box input:focus {
    outline: none;
}

.filter-select {
    width: 175px;
    height: 42px;
    border-radius: 10px;
    border: 1px solid #E1E8E4;
    color: var(--room-text);
    font-size: 13px;
}

.filter-select:focus {
    border-color: #9BCFB1;
    box-shadow: 0 0 0 3px rgba(0,109,54,.07);
}

.btn-room-primary {
    background: var(--room-green);
    border-color: var(--room-green);
    color: #fff;
    border-radius: 10px;
    font-weight: 600;
    padding: 10px 17px;
    transition: all .2s ease;
}

.btn-room-primary:hover {
    background: var(--room-green-dark);
    border-color: var(--room-green-dark);
    color: #fff;
    transform: translateY(-1px);
}


/* =========================
   TABLE
========================= */

.room-table-wrapper {
    padding: 0;
}

#roomTableContainer {
    position: relative;
    min-height: 120px;
}

#roomTableContainer.loading {
    opacity: .45;
    pointer-events: none;
}

#roomTableContainer .table {
    margin-bottom: 0;
}

#roomTableContainer .table thead th {
    background: #F8FAF9;
    border-top: none;
    border-bottom: 1px solid var(--room-border);

    color: #6D7973;
    font-size: 11px;
    font-weight: 700;

    text-transform: uppercase;
    letter-spacing: .35px;

    padding: 14px 16px;
    white-space: nowrap;
}

#roomTableContainer .table tbody td {
    vertical-align: middle;
    border-top: 1px solid #EEF2F0;

    color: var(--room-text);
    font-size: 13px;

    padding: 15px 16px;
}

#roomTableContainer .table tbody tr {
    transition: background .15s ease;
}

#roomTableContainer .table tbody tr:hover {
    background: #FAFCFB;
}


/* =========================
   ROOM TYPE
========================= */

.room-type-bar {
    width: 4px;
    height: 32px;

    border-radius: 4px;

    display: inline-block;
    margin-right: 10px;
    vertical-align: middle;
}

.type-general {
    background: #9E9E9E;
}

.type-private {
    background: #2196F3;
}

.type-icu {
    background: #E53935;
}

.type-isolation {
    background: #8E24AA;
}


/* =========================
   STATUS
========================= */

.badge-available,
.badge-occupied,
.badge-maintenance {
    border-radius: 20px;
    padding: 6px 10px;
    font-size: 11px;
    font-weight: 600;
}

.badge-available {
    background: #DFF6E8;
    color: #18864B;
}

.badge-occupied {
    background: #FDEAEA;
    color: #C0392B;
}

.badge-maintenance {
    background: #FFF4E0;
    color: #B8720A;
}


/* =========================
   PAGINATION
========================= */

#roomTableContainer .pagination {
    margin: 18px 0;
}

#roomTableContainer .page-link {
    border: 1px solid var(--room-border);
    color: var(--room-green);
    border-radius: 7px;
    margin: 0 2px;
}

#roomTableContainer .page-item.active .page-link {
    background: var(--room-green);
    border-color: var(--room-green);
    color: #fff;
}


/* =========================
   MODAL
========================= */

.room-modal {
    border: none;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 18px 50px rgba(0,0,0,.15);
}

.room-modal-header {
    padding: 18px 22px;
    background: #fff;
    border-bottom: 1px solid var(--room-border);

    display: flex;
    align-items: center;
    justify-content: space-between;
}

.modal-title-wrapper {
    display: flex;
    align-items: center;
    gap: 13px;
}

.modal-icon {
    width: 43px;
    height: 43px;

    border-radius: 12px;

    background: var(--room-green-light);
    color: var(--room-green);

    display: flex;
    align-items: center;
    justify-content: center;

    font-size: 17px;
}

.edit-modal-icon {
    background: #E8F0FA;
    color: #286090;
}

.modal-title {
    color: var(--room-text);
    font-size: 17px;
    margin: 0;
}

.modal-title-wrapper small {
    display: block;
    color: var(--room-muted);
    font-size: 11px;
    margin-top: 2px;
}

.modal-close {
    font-size: 24px;
    font-weight: 400;
    color: #89938E;
    opacity: 1;
}

.room-modal-body {
    padding: 22px;
}

.room-modal-body label {
    display: block;
    color: #66736C;
    font-size: 11px;
    font-weight: 700;
    margin-bottom: 7px;
}

.room-modal-body .form-control,
.room-modal-body .custom-select {
    height: 42px;
    border: 1px solid #DDE5E0;
    border-radius: 9px;
    font-size: 13px;
}

.room-modal-body .form-control:focus,
.room-modal-body .custom-select:focus {
    border-color: #9BCFB1;
    box-shadow: 0 0 0 3px rgba(0,109,54,.07);
}

.input-icon-wrapper {
    position: relative;
}

.input-icon-wrapper > i {
    position: absolute;
    left: 13px;
    top: 14px;
    color: #89968F;
    font-size: 13px;
    z-index: 2;
}

.input-icon-wrapper .form-control {
    padding-left: 36px;
}

.price-input .input-group-text {
    height: 42px;
    border-color: #DDE5E0;
    background: #F5F8F6;
    color: var(--room-green);
    font-weight: 700;
    border-radius: 9px 0 0 9px;
}

.price-input .form-control {
    border-radius: 0 9px 9px 0 !important;
}

.room-modal-footer {
    background: #F8FAF9;
    border-top: 1px solid var(--room-border);
    padding: 14px 22px;
}

.room-cancel-btn {
    border-radius: 9px;
    padding: 9px 16px;
    color: #68736E;
}


/* =========================
   DELETE MODAL
========================= */

.delete-modal {
    border: none;
    border-radius: 16px;
    padding: 28px 22px 22px;
    text-align: center;
}

.delete-icon {
    width: 58px;
    height: 58px;

    margin: 0 auto 15px;

    border-radius: 50%;

    background: #FDEAEA;
    color: #D64545;

    display: flex;
    align-items: center;
    justify-content: center;

    font-size: 21px;
}

.delete-modal h5 {
    margin-bottom: 8px;
    font-weight: 700;
    color: var(--room-text);
}

.delete-modal p {
    color: var(--room-muted);
    font-size: 13px;
    line-height: 1.6;
    margin-bottom: 20px;
}

.delete-modal strong {
    color: #D64545;
}

.delete-actions {
    display: flex;
    justify-content: center;
    gap: 8px;
}

.delete-actions .btn {
    min-width: 90px;
    border-radius: 9px;
}


/* =========================
   TOAST
========================= */

.toast-container-custom {
    position: fixed;
    top: 75px;
    right: 25px;
    z-index: 99999;
}

.toast-custom {
    min-width: 280px;
    max-width: 380px;

    padding: 13px 16px;
    margin-bottom: 10px;

    border-radius: 10px;

    background: #fff;

    box-shadow: 0 8px 28px rgba(0,0,0,.14);

    display: flex;
    align-items: center;
    gap: 10px;

    font-size: 13px;
    font-weight: 500;
}

.toast-custom.success {
    border-left: 4px solid #18864B;
}

.toast-custom.success i {
    color: #18864B;
}

.toast-custom.error {
    border-left: 4px solid #D64545;
}

.toast-custom.error i {
    color: #D64545;
}


/* =========================
   RESPONSIVE
========================= */

@media (max-width: 1199.98px) {

    .search-box {
        width: 220px;
    }

    .filter-select {
        width: 160px;
    }

}


@media (max-width: 991.98px) {

    .room-header {
        min-height: auto;
        padding: 22px;
    }

    .room-header h2 {
        font-size: 21px;
    }

    .room-header-icon {
        width: 54px;
        height: 54px;
        font-size: 23px;
    }

    .room-toolbar {
        align-items: stretch;
        flex-direction: column;
    }

    .toolbar-left {
        width: 100%;
    }

    .search-box {
        flex: 1;
        width: auto;
    }

    .filter-select {
        flex: 1;
        width: auto;
        max-width: none;
    }

    .btn-room-primary {
        width: 100%;
    }

}


@media (max-width: 767.98px) {

    .room-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 18px;
    }

    .btn-add-room {
        width: 100%;
    }

    .toolbar-left {
        flex-direction: column;
    }

    .search-box,
    .filter-select {
        width: 100%;
        flex: none;
    }

    .room-table-wrapper {
        overflow-x: auto;
    }

    #roomTableContainer .table {
        min-width: 750px;
    }

}


@media (max-width: 575.98px) {

    .room-page {
        padding-top: 0;
    }

    .room-header {
        padding: 20px;
        border-radius: 13px;
    }

    .room-header > div:first-child {
        gap: 12px;
    }

    .room-header h2 {
        font-size: 19px;
    }

    .room-header p {
        font-size: 12px;
    }

    .stat-card {
        padding: 16px;
    }

    .room-toolbar {
        padding: 14px;
    }

    .room-modal-body {
        padding: 18px;
    }

    .room-modal-footer {
        padding: 12px 18px;
    }

}

</style>

@stop


@section('js')

@parent

<script>

$(document).ready(function () {

    const $container = $('#roomTableContainer');

    let debounceTimer;


    /* =========================================================
       TOAST
    ========================================================= */

    function showToast(msg, type = 'success') {

        const icon =
            type === 'success'
                ? 'fa-check-circle'
                : 'fa-times-circle';

        const $toast = $(
            '<div class="toast-custom ' + type + '">' +
                '<i class="fas ' + icon + '"></i>' +
                '<span>' + msg + '</span>' +
            '</div>'
        );

        $('#toastContainer').append($toast);

        setTimeout(function () {

            $toast.fadeOut(300, function () {
                $toast.remove();
            });

        }, 4000);
    }


    /* =========================================================
       CLEAR ERRORS
    ========================================================= */

    function clearErrors($form) {

        $form.find('.form-control, .custom-select')
            .removeClass('is-invalid');

        $form.find('.invalid-feedback')
            .text('');
    }


    /* =========================================================
       SHOW FIELD ERRORS
    ========================================================= */

    function showFieldErrors($form, prefix, errors) {

        $.each(errors, function (field, messages) {

            $('#' + prefix + field)
                .addClass('is-invalid');

            $('#error_' + prefix + field)
                .text(messages[0]);

        });
    }


    /* =========================================================
       PARAMETERS
    ========================================================= */

    function params(page) {

        return {

            search: $('#search').val(),

            room_type: $('#filterType').val(),

            status: $('#filterStatus').val(),

            page: page || 1

        };
    }


    /* =========================================================
       LOAD ROOMS
    ========================================================= */

    function loadRooms(page) {

        $container.addClass('loading');

        $.ajax({

            url: "{{ route('room.index') }}",

            method: 'GET',

            data: params(page),

            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            },

            success: function (res) {

                $container.html(res.html);

                $('#statTotal')
                    .text(res.stats.total);

                $('#statAvailable')
                    .text(res.stats.available);

                $('#statOccupied')
                    .text(res.stats.occupied);

                $('#statMaintenance')
                    .text(res.stats.maintenance);

            },

            error: function () {

                showToast(
                    'មិនអាចទាញយកព័ត៌មានបន្ទប់បានទេ។',
                    'error'
                );

            },

            complete: function () {

                $container.removeClass('loading');

            }

        });
    }


    /* =========================================================
       SEARCH
    ========================================================= */

    $('#search').on('keyup', function () {

        clearTimeout(debounceTimer);

        debounceTimer = setTimeout(function () {

            loadRooms(1);

        }, 400);

    });


    /* =========================================================
       FILTER
    ========================================================= */

    $('#filterType, #filterStatus').on(
        'change',
        function () {
            loadRooms(1);
        }
    );


    /* =========================================================
       PAGINATION
    ========================================================= */

    $(document).on(
        'click',
        '#roomTableContainer .pagination a',
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
                )
                .searchParams
                .get('page') || 1;

            loadRooms(page);

        }
    );


    /* =========================================================
       CREATE MODAL RESET
    ========================================================= */

    $('#modalCreateRoom').on(
        'show.bs.modal',
        function () {

            $('#createRoomForm')[0].reset();

            clearErrors(
                $('#createRoomForm')
            );

            $('#createRoomAlert')
                .addClass('d-none')
                .text('');

        }
    );


    /* =========================================================
       CREATE ROOM
    ========================================================= */

    $('#createRoomForm').on(
        'submit',
        function (e) {

            e.preventDefault();

            const $form = $(this);

            const $btn =
                $('#btnSubmitCreateRoom');

            clearErrors($form);

            $('#createRoomAlert')
                .addClass('d-none')
                .text('');

            $btn
                .prop('disabled', true)
                .html(
                    '<i class="fas fa-spinner fa-spin mr-1"></i>' +
                    ' កំពុងរក្សាទុក...'
                );


            $.ajax({

                url: $form.attr('action'),

                method: 'POST',

                data: $form.serialize(),

                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                },

                success: function (res) {

                    $('#modalCreateRoom')
                        .modal('hide');

                    showToast(
                        res.message ||
                        'បានបន្ថែមបន្ទប់ដោយជោគជ័យ'
                    );

                    loadRooms(1);

                },

                error: function (xhr) {

                    if (
                        xhr.status === 422 &&
                        xhr.responseJSON &&
                        xhr.responseJSON.errors
                    ) {

                        showFieldErrors(
                            $form,
                            'create_',
                            xhr.responseJSON.errors
                        );

                    } else {

                        showToast(
                            'មានបញ្ហាក្នុងការបន្ថែមបន្ទប់។',
                            'error'
                        );

                    }

                },

                complete: function () {

                    $btn
                        .prop('disabled', false)
                        .html(
                            '<i class="fas fa-save mr-1"></i>' +
                            ' រក្សាទុកបន្ទប់'
                        );

                }

            });

        }
    );


    /* =========================================================
       OPEN EDIT MODAL
    ========================================================= */

    $(document).on(
        'click',
        '.btn-edit-room',
        function () {

            const $btn = $(this);

            $('#edit_room_number')
                .val($btn.data('room-number'));

            $('#edit_room_type')
                .val($btn.data('room-type'));

            $('#edit_status')
                .val($btn.data('status'));

            $('#edit_price_per_day')
                .val($btn.data('price'));

            $('#editRoomForm').attr(
                'action',
                "{{ url('room/update') }}/" +
                $btn.data('id')
            );

            clearErrors(
                $('#editRoomForm')
            );

            $('#editRoomAlert')
                .addClass('d-none')
                .text('');

            $('#modalEditRoom')
                .modal('show');

        }
    );


    /* =========================================================
       UPDATE ROOM
    ========================================================= */

    $('#editRoomForm').on(
        'submit',
        function (e) {

            e.preventDefault();

            const $form = $(this);

            const $btn =
                $('#btnSubmitEditRoom');

            clearErrors($form);

            $('#editRoomAlert')
                .addClass('d-none')
                .text('');

            $btn
                .prop('disabled', true)
                .html(
                    '<i class="fas fa-spinner fa-spin mr-1"></i>' +
                    ' កំពុងរក្សាទុក...'
                );


            $.ajax({

                url: $form.attr('action'),

                method: 'POST',

                data: $form.serialize(),

                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                },

                success: function (res) {

                    $('#modalEditRoom')
                        .modal('hide');

                    showToast(
                        res.message ||
                        'បានកែប្រែបន្ទប់ដោយជោគជ័យ'
                    );

                    loadRooms(1);

                },

                error: function (xhr) {

                    if (
                        xhr.status === 422 &&
                        xhr.responseJSON &&
                        xhr.responseJSON.errors
                    ) {

                        showFieldErrors(
                            $form,
                            'edit_',
                            xhr.responseJSON.errors
                        );

                    } else {

                        showToast(
                            'មានបញ្ហាក្នុងការកែប្រែបន្ទប់។',
                            'error'
                        );

                    }

                },

                complete: function () {

                    $btn
                        .prop('disabled', false)
                        .html(
                            '<i class="fas fa-save mr-1"></i>' +
                            ' រក្សាទុកការកែប្រែ'
                        );

                }

            });

        }
    );


    /* =========================================================
       DELETE MODAL
    ========================================================= */

    $(document).on(
        'click',
        '.btn-delete-room',
        function () {

            const id =
                $(this).data('id');

            const number =
                $(this).data('number');

            $('#deleteRoomNumber')
                .text(number);

            $('#deleteRoomForm').attr(
                'action',
                "{{ url('room/delete') }}/" + id
            );

            $('#modalDeleteRoom')
                .modal('show');

        }
    );


    /* =========================================================
       DELETE ROOM
    ========================================================= */

    $('#deleteRoomForm').on(
        'submit',
        function (e) {

            e.preventDefault();

            const $form = $(this);

            $.ajax({

                url: $form.attr('action'),

                method: 'POST',

                data: $form.serialize(),

                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                },

                success: function (res) {

                    $('#modalDeleteRoom')
                        .modal('hide');

                    showToast(
                        res.message ||
                        'បានលុបបន្ទប់ដោយជោគជ័យ'
                    );

                    loadRooms(1);

                },

                error: function () {

                    showToast(
                        'មានបញ្ហាក្នុងការលុបបន្ទប់។',
                        'error'
                    );

                }

            });

        }
    );

});

</script>

@stop