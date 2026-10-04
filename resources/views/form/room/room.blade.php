@extends('adminlte::page')

@section('title', 'គ្រប់គ្រងបន្ទប់ (Room Management)')

@section('content')

<div class="room-page">

    {{-- Toast --}}
    <div id="toastContainer" class="toast-container-custom"></div>

    {{-- =========================================================
         PAGE HEADER
    ========================================================== --}}
    <div class="page-header mb-4">

        <div class="page-header-left">

            <div class="page-header-icon">
                <i class="fas fa-procedures"></i>
            </div>

            <div>
                <h2>ការគ្រប់គ្រងបន្ទប់</h2>
                <p>គ្រប់គ្រងព័ត៌មាន ប្រភេទ ស្ថានភាព និងតម្លៃបន្ទប់</p>
            </div>

        </div>

        <button type="button"
                class="btn btn-light header-add-btn"
                data-toggle="modal"
                data-target="#modalCreate">

            <i class="fas fa-plus mr-2"></i>
            បន្ថែមបន្ទប់ថ្មី

        </button>

    </div>


    {{-- =========================================================
         STATISTICS
    ========================================================== --}}
    <div class="row stats-row mb-4">

        {{-- Total --}}
        <div class="col-xl-3 col-md-6 mb-3 mb-xl-0">

            <div class="stat-card">

                <div class="stat-icon stat-total">
                    <i class="fas fa-procedures"></i>
                </div>

                <div class="stat-content">

                    <span>បន្ទប់សរុប</span>

                    <h3 id="statTotal">
                        {{ $totalRooms }}
                    </h3>

                </div>

            </div>

        </div>


        {{-- Available --}}
        <div class="col-xl-3 col-md-6 mb-3 mb-xl-0">

            <div class="stat-card">

                <div class="stat-icon stat-available">
                    <i class="fas fa-check-circle"></i>
                </div>

                <div class="stat-content">

                    <span>បន្ទប់ទំនេរ</span>

                    <h3 id="statAvailable">
                        {{ $availableRooms }}
                    </h3>

                </div>

            </div>

        </div>


        {{-- Occupied --}}
        <div class="col-xl-3 col-md-6 mb-3 mb-md-0">

            <div class="stat-card">

                <div class="stat-icon stat-occupied">
                    <i class="fas fa-user-injured"></i>
                </div>

                <div class="stat-content">

                    <span>មានអ្នកជំងឺ</span>

                    <h3 id="statOccupied">
                        {{ $occupiedRooms }}
                    </h3>

                </div>

            </div>

        </div>


        {{-- Maintenance --}}
        <div class="col-xl-3 col-md-6">

            <div class="stat-card">

                <div class="stat-icon stat-maintenance">
                    <i class="fas fa-tools"></i>
                </div>

                <div class="stat-content">

                    <span>កំពុងជួសជុល</span>

                    <h3 id="statMaintenance">
                        {{ $maintenanceRooms }}
                    </h3>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
         MAIN ROOM PANEL
    ========================================================== --}}
    <div class="room-panel">

        {{-- Toolbar --}}
        <div class="room-toolbar">

            <div class="toolbar-left">

                {{-- Search --}}
                <div class="search-box">

                    <i class="fas fa-search"></i>

                    <input type="text"
                           id="search"
                           class="form-control"
                           placeholder="ស្វែងរកលេខបន្ទប់, ប្រភេទ, តម្លៃ...">

                </div>


                {{-- Room Type --}}
                <select id="filterType"
                        class="form-control filter-select">

                    <option value="">
                        គ្រប់ប្រភេទបន្ទប់
                    </option>

                    <option value="general">
                        បន្ទប់ទូទៅ
                    </option>

                    <option value="private">
                        បន្ទប់ផ្ទាល់ខ្លួន
                    </option>

                    <option value="icu">
                        បន្ទប់ ICU
                    </option>

                    <option value="isolation">
                        បន្ទប់ដាច់ដោយឡែក
                    </option>

                </select>


                {{-- Status --}}
                <select id="filterStatus"
                        class="form-control filter-select">

                    <option value="">
                        គ្រប់ស្ថានភាព
                    </option>

                    <option value="available">
                        ទំនេរ
                    </option>

                    <option value="occupied">
                        មានអ្នកជំងឺ
                    </option>

                    <option value="maintenance">
                        កំពុងជួសជុល
                    </option>

                </select>

            </div>


            {{-- Add --}}
            <button type="button"
                    class="btn btn-room-primary"
                    data-toggle="modal"
                    data-target="#modalCreate">

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


{{-- =============================================================
     CREATE ROOM MODAL
============================================================= --}}

<div class="modal fade"
     id="modalCreate"
     tabindex="-1"
     aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content room-modal">

            <div class="modal-header room-modal-header">

                <div class="modal-title-wrapper">

                    <div class="modal-icon">
                        <i class="fas fa-plus"></i>
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


            <form action="{{ route('room.store') }}"
                  method="POST">

                @csrf

                <div class="modal-body room-modal-body">

                    <div class="form-row">

                        {{-- Room Number --}}
                        <div class="form-group col-md-6">

                            <label>
                                លេខបន្ទប់
                                <span class="text-danger">*</span>
                            </label>

                            <div class="input-icon">

                                <i class="fas fa-door-open"></i>

                                <input type="text"
                                       name="room_number"
                                       class="form-control"
                                       placeholder="R-101, ICU-01"
                                       maxlength="20"
                                       required>

                            </div>

                        </div>


                        {{-- Room Type --}}
                        <div class="form-group col-md-6">

                            <label>
                                ប្រភេទបន្ទប់
                                <span class="text-danger">*</span>
                            </label>

                            <select name="room_type"
                                    class="form-control custom-select"
                                    required>

                                <option value="general">
                                    បន្ទប់ទូទៅ
                                </option>

                                <option value="private">
                                    បន្ទប់ផ្ទាល់ខ្លួន
                                </option>

                                <option value="icu">
                                    បន្ទប់ ICU
                                </option>

                                <option value="isolation">
                                    បន្ទប់ដាច់ដោយឡែក
                                </option>

                            </select>

                        </div>


                        {{-- Status --}}
                        <div class="form-group col-md-6">

                            <label>
                                ស្ថានភាព
                                <span class="text-danger">*</span>
                            </label>

                            <select name="status"
                                    class="form-control custom-select"
                                    required>

                                <option value="available">
                                    ទំនេរ
                                </option>

                                <option value="occupied">
                                    មានអ្នកជំងឺ
                                </option>

                                <option value="maintenance">
                                    កំពុងជួសជុល
                                </option>

                            </select>

                        </div>


                        {{-- Price --}}
                        <div class="form-group col-md-6">

                            <label>
                                តម្លៃ / ថ្ងៃ
                                <span class="text-danger">*</span>
                            </label>

                            <div class="input-group">

                                <div class="input-group-prepend">

                                    <span class="input-group-text">
                                        $
                                    </span>

                                </div>

                                <input type="number"
                                       step="0.01"
                                       min="0"
                                       name="price_per_day"
                                       class="form-control"
                                       placeholder="25.00"
                                       required>

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
                            class="btn btn-room-primary px-4">

                        <i class="fas fa-save mr-1"></i>
                        រក្សាទុក

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


{{-- =============================================================
     EDIT ROOM MODAL
============================================================= --}}

<div class="modal fade"
     id="modalEdit"
     tabindex="-1"
     aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content room-modal">

            <div class="modal-header room-modal-header edit-header">

                <div class="modal-title-wrapper">

                    <div class="modal-icon edit-icon">
                        <i class="fas fa-edit"></i>
                    </div>

                    <div>

                        <h5 class="modal-title">
                            កែប្រែបន្ទប់
                        </h5>

                        <small>
                            កែប្រែព័ត៌មានបន្ទប់
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

                    <div class="form-row">

                        {{-- Room Number --}}
                        <div class="form-group col-md-6">

                            <label>
                                លេខបន្ទប់
                                <span class="text-danger">*</span>
                            </label>

                            <div class="input-icon">

                                <i class="fas fa-door-open"></i>

                                <input type="text"
                                       id="edit_room_number"
                                       name="room_number"
                                       class="form-control"
                                       maxlength="20"
                                       required>

                            </div>

                        </div>


                        {{-- Room Type --}}
                        <div class="form-group col-md-6">

                            <label>
                                ប្រភេទបន្ទប់
                                <span class="text-danger">*</span>
                            </label>

                            <select id="edit_room_type"
                                    name="room_type"
                                    class="form-control custom-select"
                                    required>

                                <option value="general">
                                    បន្ទប់ទូទៅ
                                </option>

                                <option value="private">
                                    បន្ទប់ផ្ទាល់ខ្លួន
                                </option>

                                <option value="icu">
                                    បន្ទប់ ICU
                                </option>

                                <option value="isolation">
                                    បន្ទប់ដាច់ដោយឡែក
                                </option>

                            </select>

                        </div>


                        {{-- Status --}}
                        <div class="form-group col-md-6">

                            <label>
                                ស្ថានភាព
                                <span class="text-danger">*</span>
                            </label>

                            <select id="edit_status"
                                    name="status"
                                    class="form-control custom-select"
                                    required>

                                <option value="available">
                                    ទំនេរ
                                </option>

                                <option value="occupied">
                                    មានអ្នកជំងឺ
                                </option>

                                <option value="maintenance">
                                    កំពុងជួសជុល
                                </option>

                            </select>

                        </div>


                        {{-- Price --}}
                        <div class="form-group col-md-6">

                            <label>
                                តម្លៃ / ថ្ងៃ
                                <span class="text-danger">*</span>
                            </label>

                            <div class="input-group">

                                <div class="input-group-prepend">

                                    <span class="input-group-text">
                                        $
                                    </span>

                                </div>

                                <input type="number"
                                       step="0.01"
                                       min="0"
                                       id="edit_price_per_day"
                                       name="price_per_day"
                                       class="form-control"
                                       required>

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
                            class="btn btn-room-primary px-4">

                        <i class="fas fa-save mr-1"></i>
                        កែប្រែទិន្នន័យ

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


{{-- =============================================================
     DELETE ROOM MODAL
============================================================= --}}

<div class="modal fade"
     id="modalDelete"
     tabindex="-1"
     aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content delete-modal">

            <div class="delete-icon">

                <i class="fas fa-trash-alt"></i>

            </div>

            <h5>
                បញ្ជាក់ការលុបបន្ទប់
            </h5>

            <p>

                តើអ្នកពិតជាចង់លុបបន្ទប់លេខ

                <strong id="deleteRoomNumber"></strong>

                មែនទេ?

            </p>

            <small>
                សកម្មភាពនេះមិនអាចត្រឡប់ក្រោយវិញបានឡើយ។
            </small>


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
                        លុបចេញ

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


/* =========================================================
   PAGE
========================================================= */

.room-page {
    padding-top: 8px;
    padding-bottom: 30px;
}


/* =========================================================
   HEADER
========================================================= */

.page-header {
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

.page-header-left {
    display: flex;
    align-items: center;
    gap: 18px;
}

.page-header-icon {
    width: 62px;
    height: 62px;

    border-radius: 16px;

    background: rgba(255,255,255,.16);

    display: flex;
    align-items: center;
    justify-content: center;

    font-size: 27px;
}

.page-header h2 {
    margin: 0 0 5px;

    font-size: 25px;
    font-weight: 700;
}

.page-header p {
    margin: 0;

    color: rgba(255,255,255,.82);

    font-size: 14px;
}

.header-add-btn {
    border: none;
    border-radius: 10px;

    padding: 11px 18px;

    color: var(--room-green);

    font-weight: 700;

    box-shadow: 0 4px 12px rgba(0,0,0,.08);
}

.header-add-btn:hover {
    color: var(--room-green-dark);
}


/* =========================================================
   STAT CARD
========================================================= */

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

.stat-total {
    background: #E8F5EE;
    color: var(--room-green);
}

.stat-available {
    background: #DFF6E8;
    color: #18864B;
}

.stat-occupied {
    background: #E8F0FA;
    color: #286090;
}

.stat-maintenance {
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


/* =========================================================
   MAIN PANEL
========================================================= */

.room-panel {
    background: #fff;

    border: 1px solid var(--room-border);

    border-radius: 15px;

    overflow: hidden;

    box-shadow: 0 7px 25px rgba(0,0,0,.045);
}


/* =========================================================
   TOOLBAR
========================================================= */

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

    flex: 1;
}


/* Search */

.search-box {
    width: 270px;
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

    box-shadow:
        0 0 0 3px rgba(0,109,54,.07);
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


/* Filters */

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

    box-shadow:
        0 0 0 3px rgba(0,109,54,.07);
}


/* Primary button */

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


/* =========================================================
   TABLE
========================================================= */

.room-table-wrapper {
    padding: 0;
}

#roomTableContainer {
    position: relative;

    min-height: 120px;

    transition: opacity .2s ease;
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


/* =========================================================
   PAGINATION
========================================================= */

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


/* =========================================================
   MODAL
========================================================= */

.room-modal {
    border: none;

    border-radius: 16px;

    overflow: hidden;

    box-shadow:
        0 18px 50px rgba(0,0,0,.15);
}

.room-modal-header {
    padding: 18px 22px;

    background: linear-gradient(
        135deg,
        #006D36 0%,
        #008747 100%
    );

    color: #fff;

    border-bottom: none;

    display: flex;
    align-items: center;
    justify-content: space-between;
}

.edit-header {
    background: linear-gradient(
        135deg,
        #006D36 0%,
        #008747 100%
    );
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

    background: rgba(255,255,255,.16);

    color: #fff;

    display: flex;
    align-items: center;
    justify-content: center;

    font-size: 17px;
}

.edit-icon {
    background: rgba(255,255,255,.16);
}

.modal-title {
    color: #fff;

    font-size: 17px;

    margin: 0;
}

.modal-title-wrapper small {
    display: block;

    color: rgba(255,255,255,.78);

    font-size: 11px;

    margin-top: 2px;
}

.modal-close {
    font-size: 24px;

    font-weight: 400;

    color: #fff;

    opacity: .9;
}

.modal-close:hover {
    color: #fff;

    opacity: 1;
}

.room-modal-body {
    padding: 24px;
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

    box-shadow:
        0 0 0 3px rgba(0,109,54,.07);
}


/* Input icon */

.input-icon {
    position: relative;
}

.input-icon i {
    position: absolute;

    left: 13px;
    top: 14px;

    color: #89968F;

    font-size: 13px;

    z-index: 2;
}

.input-icon .form-control {
    padding-left: 36px;
}


/* Price */

.input-group-text {
    height: 42px;

    border-color: #DDE5E0;

    background: #F5F8F6;

    color: var(--room-green);

    font-weight: 700;
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


/* =========================================================
   DELETE MODAL
========================================================= */

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

    margin: 0 0 5px;
}

.delete-modal strong {
    color: #D64545;
}

.delete-modal small {
    color: var(--room-muted);

    font-size: 11px;
}

.delete-actions {
    margin-top: 20px;

    display: flex;

    justify-content: center;

    gap: 8px;
}

.delete-actions .btn {
    min-width: 90px;

    border-radius: 9px;
}


/* =========================================================
   TOAST
========================================================= */

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

    color: #fff;

    box-shadow: 0 8px 28px rgba(0,0,0,.14);

    font-size: 13px;

    font-weight: 500;
}

.toast-custom.success {
    background: #18864B;
}

.toast-custom.error {
    background: #D64545;
}


/* =========================================================
   RESPONSIVE
========================================================= */

@media (max-width: 1199.98px) {

    .search-box {
        width: 230px;
    }

    .filter-select {
        width: 160px;
    }

}


@media (max-width: 991.98px) {

    .page-header {
        min-height: auto;

        padding: 22px;
    }

    .page-header h2 {
        font-size: 21px;
    }

    .page-header-icon {
        width: 54px;
        height: 54px;

        font-size: 23px;
    }

    .room-toolbar {
        flex-direction: column;

        align-items: stretch;
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
    }

    .btn-room-primary {
        width: 100%;
    }

}


@media (max-width: 767.98px) {

    .page-header {
        flex-direction: column;

        align-items: flex-start;

        gap: 18px;
    }

    .header-add-btn {
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
        min-width: 760px;
    }

}


@media (max-width: 575.98px) {

    .page-header {
        padding: 20px;

        border-radius: 13px;
    }

    .page-header-left {
        gap: 12px;
    }

    .page-header h2 {
        font-size: 19px;
    }

    .page-header p {
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

<script>

$(document).ready(function () {

    let debounceTimer;


    /* =========================================================
       CURRENT PARAMETERS
    ========================================================== */

    function currentParams(page = 1) {

        return {
            page: page,
            search: $('#search').val(),
            room_type: $('#filterType').val(),
            status: $('#filterStatus').val()
        };

    }


    /* =========================================================
       LOAD ROOMS
    ========================================================== */

    function loadRooms(page = 1) {

        const params = currentParams(page);

        $('#roomTableContainer')
            .css('opacity', '0.45');

        $.ajax({

            url: "{{ route('room.index') }}",

            method: 'GET',

            data: params,

            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            },

            success: function (res) {

                $('#roomTableContainer')
                    .html(res.html)
                    .css('opacity', '1');


                if (res.stats) {

                    $('#statTotal')
                        .text(res.stats.total);

                    $('#statAvailable')
                        .text(res.stats.available);

                    $('#statOccupied')
                        .text(res.stats.occupied);

                    $('#statMaintenance')
                        .text(res.stats.maintenance);

                }


                const qs = $.param(params);

                history.replaceState(
                    null,
                    '',
                    "{{ route('room.index') }}?" + qs
                );

            },

            error: function () {

                $('#roomTableContainer')
                    .css('opacity', '1');

                showToast(
                    'មិនអាចទាញយកព័ត៌មានបន្ទប់បានទេ។',
                    'error'
                );

            }

        });

    }


    /* =========================================================
       SEARCH
    ========================================================== */

    $('#search').on('keyup', function () {

        clearTimeout(debounceTimer);

        debounceTimer = setTimeout(function () {

            loadRooms(1);

        }, 400);

    });


    /* =========================================================
       FILTER
    ========================================================== */

    $('#filterType, #filterStatus').on(
        'change',
        function () {

            loadRooms(1);

        }
    );


    /* =========================================================
       PAGINATION
    ========================================================== */

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
       EDIT ROOM
    ========================================================== */

    $(document).on(
        'click',
        '.btn-edit',
        function () {

            const id =
                $(this).data('id');

            $.get(
                "{{ url('room/edit') }}/" + id,
                function (data) {

                    $('#edit_room_number')
                        .val(data.room_number);

                    $('#edit_room_type')
                        .val(data.room_type);

                    $('#edit_status')
                        .val(data.status);

                    $('#edit_price_per_day')
                        .val(data.price_per_day);

                    $('#editRoomForm').attr(
                        'action',
                        "{{ url('room/update') }}/" + id
                    );

                    $('#modalEdit')
                        .modal('show');

                }
            )
            .fail(function () {

                showToast(
                    'មិនអាចទាញយកទិន្នន័យបន្ទប់បានទេ',
                    'error'
                );

            });

        }
    );


    /* =========================================================
       UPDATE ROOM
    ========================================================== */

    $(document).on(
        'submit',
        '#editRoomForm',
        function (e) {

            e.preventDefault();

            const form = $(this);

            $.ajax({

                url: form.attr('action'),

                method: 'POST',

                data: form.serialize(),

                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                },

                success: function (res) {

                    $('#modalEdit')
                        .modal('hide');

                    showToast(
                        res.message ||
                        'ព័ត៌មានបន្ទប់ត្រូវបានកែប្រែដោយជោគជ័យ',
                        'success'
                    );

                    loadRooms(1);

                },

                error: function (xhr) {

                    let message =
                        'មានបញ្ហាក្នុងការកែប្រែបន្ទប់។';

                    if (xhr.responseJSON) {

                        if (xhr.responseJSON.message) {

                            message =
                                xhr.responseJSON.message;

                        }

                        if (xhr.responseJSON.errors) {

                            message =
                                Object.values(
                                    xhr.responseJSON.errors
                                )
                                .flat()
                                .join('<br>');

                        }

                    }

                    showToast(
                        message,
                        'error'
                    );

                }

            });

        }
    );


    /* =========================================================
       DELETE MODAL
    ========================================================== */

    $(document).on(
        'click',
        '.btn-delete',
        function () {

            const id =
                $(this).data('id');

            const name =
                $(this).data('name');

            $('#deleteRoomNumber')
                .text(name);

            $('#deleteRoomForm').attr(
                'action',
                "{{ url('room/delete') }}/" + id
            );

            $('#modalDelete')
                .modal('show');

        }
    );


    /* =========================================================
       DELETE ROOM
    ========================================================== */

    $('#deleteRoomForm').on(
        'submit',
        function (e) {

            e.preventDefault();

            const form = $(this);

            $.ajax({

                url: form.attr('action'),

                method: 'POST',

                data: form.serialize(),

                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                },

                success: function (res) {

                    $('#modalDelete')
                        .modal('hide');

                    showToast(
                        res.message ||
                        'បន្ទប់ត្រូវបានលុបដោយជោគជ័យ',
                        'success'
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


    /* =========================================================
       TOAST
    ========================================================== */

    function showToast(
        message,
        type = 'success'
    ) {

        const toast =
            `<div class="toast-custom ${type}">
                ${message}
            </div>`;

        $('#toastContainer')
            .append(toast);

        setTimeout(function () {

            $('#toastContainer .toast-custom:first')
                .fadeOut(
                    300,
                    function () {
                        $(this).remove();
                    }
                );

        }, 3000);

    }


    /* =========================================================
       SESSION MESSAGE
    ========================================================== */

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
