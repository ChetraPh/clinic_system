@extends('adminlte::page')

@section('title', 'Department Management')

@section('content')

<div class="container-fluid department-page">

{{-- HEADER --}}
<div class="department-header mb-4">
    <div class="department-header-content">

        <div class="department-header-info">

            <div class="department-header-icon">
                <i class="fas fa-hospital-user"></i>
            </div>

            <div>
                <h2>ការគ្រប់គ្រងដេប៉ាតឺម៉ង់</h2>

                <p>
                    <i class="fas fa-hospital mr-1"></i>
                    Department Management
                    <span class="header-divider">•</span>
                    ការគ្រប់គ្រងព័ត៌មាន និងបញ្ជីដេប៉ាតឺម៉ង់ក្នុងមន្ទីរពេទ្យ។
                </p>
            </div>

        </div>

        <button class="department-header-btn"
            data-toggle="modal"
            data-target="#modalCreate">

            <i class="fas fa-plus-circle mr-2"></i>
            បន្ថែមដេប៉ាតឺម៉ង់

        </button>

    </div>
</div>


{{-- STAT + SEARCH --}}
<div class="row mb-4">

    {{-- TOTAL --}}
    <div class="col-xl-4 col-md-6 mb-3">

        <div class="department-stat-card">

            <div class="department-stat-icon">
                <i class="fas fa-hospital-user"></i>
            </div>

            <div class="department-stat-content">

                <div class="department-stat-label">
                    ដេប៉ាតឺម៉ង់សរុប
                    <span>(Total)</span>
                </div>

                <div id="totalDepartment" class="department-stat-value">
                    {{ $totalDepartment }}
                </div>

                <div class="department-stat-bottom">
                    <i class="fas fa-building mr-1"></i>
                    ចំនួនដេប៉ាតឺម៉ង់ក្នុងប្រព័ន្ធ
                </div>

            </div>

        </div>

    </div>


    {{-- SEARCH --}}
    <div class="col-xl-8 col-md-6 mb-3">

        <div class="department-search-card">

            <div class="department-search-icon">
                <i class="fas fa-search"></i>
            </div>

            <div class="department-search-content">

                <div class="department-search-label">
                    ស្វែងរកដេប៉ាតឺម៉ង់
                    <span>(Search Department)</span>
                </div>

                <div class="department-search-box">

                    <i class="fas fa-search"></i>

                    <input type="text"
                        id="search"
                        class="form-control"
                        placeholder="ស្វែងរកតាម ID, ឈ្មោះ ឬការពិពណ៌នា">

                </div>

            </div>

        </div>

    </div>

</div>


{{-- MAIN TABLE --}}
<div class="department-panel">

    <div class="department-panel-header">

        <div class="department-panel-title">

            <div class="panel-title-icon">
                <i class="fas fa-hospital"></i>
            </div>

            <div>
                <h5>បញ្ជីដេប៉ាតឺម៉ង់</h5>
                <span>Department List</span>
            </div>

        </div>

        <div class="department-panel-count">
            <i class="fas fa-layer-group mr-1"></i>
            {{ $totalDepartment }}
        </div>

    </div>


    <div class="department-panel-body">

        <div id="departmentTableContainer">
            @include('form.department.partials.table')
        </div>

    </div>

</div>

</div>

{{-- ================================
CREATE MODAL
================================ --}}

<div class="modal fade" id="modalCreate" tabindex="-1" aria-hidden="true">

<div class="modal-dialog modal-dialog-centered">

    <div class="modal-content department-modal">

        <div class="modal-header department-modal-header">

            <h5 class="modal-title">
                <i class="fas fa-hospital mr-2"></i>
                បន្ថែមដេប៉ាតឺម៉ង់
            </h5>

            <button type="button"
                class="close text-white"
                data-dismiss="modal"
                aria-label="Close">

                <span aria-hidden="true">&times;</span>

            </button>

        </div>


        <form method="POST" action="{{ route('department.store') }}">

            @csrf

            <input type="hidden" name="_modal" value="create">

            <div class="modal-body department-modal-body">

                <div class="form-group">

                    <label>
                        ឈ្មោះដេប៉ាតឺម៉ង់
                        <span class="text-danger">*</span>
                    </label>

                    <div class="input-wrapper">

                        <i class="fas fa-hospital-user"></i>

                        <input type="text"
                            name="department_name"
                            class="form-control"
                            placeholder="បញ្ចូលឈ្មោះដេប៉ាតឺម៉ង់..."
                            required>

                    </div>

                </div>


                <div class="form-group mb-0">

                    <label>
                        ការពិពណ៌នា
                        <span class="text-danger">*</span>
                    </label>

                    <textarea name="description"
                        class="form-control"
                        rows="4"
                        placeholder="បញ្ចូលការពិពណ៌នា..."
                        required></textarea>

                </div>

            </div>


            <div class="modal-footer department-modal-footer">

                <button type="button"
                    class="btn modal-cancel-btn"
                    data-dismiss="modal">

                    បោះបង់

                </button>

                <button type="submit"
                    class="btn modal-save-btn">

                    <i class="fas fa-save mr-1"></i>
                    រក្សាទុក

                </button>

            </div>

        </form>

    </div>

</div>

</div>

{{-- ================================
EDIT MODAL
================================ --}}

<div class="modal fade" id="modalEdit" tabindex="-1" aria-hidden="true">

<div class="modal-dialog modal-dialog-centered">

    <div class="modal-content department-modal">

        <div class="modal-header department-modal-header">

            <h5 class="modal-title">
                <i class="fas fa-edit mr-2"></i>
                កែទិន្នន័យដេប៉ាតឺម៉ង់
            </h5>

            <button type="button"
                class="close text-white"
                data-dismiss="modal">

                <span>&times;</span>

            </button>

        </div>


        <form method="POST" id="editForm">

            @csrf
            @method('PUT')

            <input type="hidden" name="_modal" value="edit">

            <div class="modal-body department-modal-body">

                <div class="form-group">

                    <label>
                        ឈ្មោះដេប៉ាតឺម៉ង់
                        <span class="text-danger">*</span>
                    </label>

                    <div class="input-wrapper">

                        <i class="fas fa-hospital-user"></i>

                        <input type="text"
                            id="department_name"
                            name="department_name"
                            class="form-control"
                            required>

                    </div>

                </div>


                <div class="form-group mb-0">

                    <label>
                        ការពិពណ៌នា
                        <span class="text-danger">*</span>
                    </label>

                    <textarea id="description"
                        name="description"
                        class="form-control"
                        rows="4"
                        required></textarea>

                </div>

            </div>


            <div class="modal-footer department-modal-footer">

                <button type="button"
                    class="btn modal-cancel-btn"
                    data-dismiss="modal">

                    បោះបង់

                </button>

                <button type="submit"
                    class="btn modal-save-btn">

                    <i class="fas fa-edit mr-1"></i>
                    កែប្រែ

                </button>

            </div>

        </form>

    </div>

</div>

</div>

{{-- ================================
DELETE MODAL
================================ --}}

<div class="modal fade" id="modalDelete" tabindex="-1" aria-hidden="true">

<div class="modal-dialog modal-dialog-centered modal-sm">

    <div class="modal-content department-modal">

        <div class="modal-header delete-modal-header">

            <h6 class="modal-title">

                <i class="fas fa-exclamation-triangle mr-1"></i>
                លុបទិន្នន័យ

            </h6>

            <button type="button"
                class="close text-white"
                data-dismiss="modal">

                <span>&times;</span>

            </button>

        </div>


        <form method="POST" id="deleteForm">

            @csrf
            @method('DELETE')

            <div class="modal-body delete-modal-body">

                <div class="delete-icon">

                    <i class="fas fa-trash-alt"></i>

                </div>

                <p class="delete-question">
                    តើអ្នកពិតជាចង់លុប
                </p>

                <strong id="deleteDepartmentName"
                    class="delete-name">
                </strong>

                <p class="delete-question mb-0">
                    មែនទេ?
                </p>

            </div>


            <div class="modal-footer delete-modal-footer">

                <button type="button"
                    class="btn modal-cancel-btn"
                    data-dismiss="modal">

                    បោះបង់

                </button>

                <button type="submit"
                    class="btn btn-danger delete-btn">

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
@parent

<style>

:root {
    --department-green: #006D36;
    --department-green-dark: #00552B;
    --department-green-light: #E8F5EE;
    --department-bg: #F5F7F6;
    --department-border: #E7ECE9;
    --department-text: #1F2A24;
    --department-muted: #7A8780;
}


/* ================================
   PAGE
================================ */

.department-page {
    padding-top: 8px;
    padding-bottom: 25px;
    background: var(--department-bg);
}


/* ================================
   HEADER
================================ */

.department-header {
    background: linear-gradient(135deg, #006D36 0%, #008747 100%);
    border-radius: 16px;
    color: #fff;
    overflow: hidden;
    box-shadow: 0 8px 24px rgba(0, 109, 54, .14);
}

.department-header-content {
    padding: 24px 28px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
}

.department-header-info {
    display: flex;
    align-items: center;
    min-width: 0;
}

.department-header-icon {
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

.department-header h2 {
    font-size: 23px;
    font-weight: 700;
    margin: 0 0 5px;
    line-height: 1.3;
}

.department-header p {
    margin: 0;
    font-size: 13px;
    color: rgba(255,255,255,.78);
}

.header-divider {
    margin: 0 7px;
    color: rgba(255,255,255,.45);
}

.department-header-btn {
    flex-shrink: 0;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background: #fff;
    color: var(--department-green);
    border: 0;
    padding: 10px 18px;
    border-radius: 11px;
    font-size: 13px;
    font-weight: 700;
    text-decoration: none !important;
    transition: all .2s ease;
    box-shadow: 0 4px 12px rgba(0,0,0,.08);
    cursor: pointer;
}

.department-header-btn:hover {
    color: var(--department-green-dark);
    transform: translateY(-1px);
    box-shadow: 0 6px 16px rgba(0,0,0,.13);
}


/* ================================
   STAT CARD
================================ */

.department-stat-card {
    height: 100%;
    min-height: 112px;
    background: #fff;
    border: 1px solid var(--department-border);
    border-radius: 14px;
    padding: 20px;
    display: flex;
    align-items: center;
    transition: all .2s ease;
    box-shadow: 0 3px 14px rgba(31,42,36,.04);
}

.department-stat-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 22px rgba(31,42,36,.08);
    border-color: #dce5e0;
}

.department-stat-icon {
    width: 52px;
    height: 52px;
    min-width: 52px;
    border-radius: 13px;
    background: #E8F5EE;
    color: var(--department-green);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 21px;
    margin-right: 15px;
}

.department-stat-content {
    min-width: 0;
}

.department-stat-label {
    color: var(--department-muted);
    font-size: 12px;
    font-weight: 600;
    margin-bottom: 3px;
}

.department-stat-label span {
    font-weight: 500;
    color: #9AA49F;
}

.department-stat-value {
    color: var(--department-green);
    font-size: 25px;
    line-height: 1.2;
    font-weight: 700;
}

.department-stat-bottom {
    margin-top: 4px;
    color: var(--department-green);
    font-size: 11px;
    font-weight: 600;
}


/* ================================
   SEARCH CARD
================================ */

.department-search-card {
    height: 100%;
    min-height: 112px;
    background: #fff;
    border: 1px solid var(--department-border);
    border-radius: 14px;
    padding: 20px;
    display: flex;
    align-items: center;
    transition: all .2s ease;
    box-shadow: 0 3px 14px rgba(31,42,36,.04);
}

.department-search-card:hover {
    box-shadow: 0 8px 22px rgba(31,42,36,.08);
}

.department-search-icon {
    width: 52px;
    height: 52px;
    min-width: 52px;
    border-radius: 13px;
    background: #EAF2FF;
    color: #2563EB;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    margin-right: 15px;
}

.department-search-content {
    flex: 1;
    min-width: 0;
}

.department-search-label {
    color: var(--department-muted);
    font-size: 12px;
    font-weight: 600;
    margin-bottom: 7px;
}

.department-search-label span {
    color: #9AA49F;
    font-weight: 500;
}

.department-search-box {
    display: flex;
    align-items: center;
    background: #F8FAF9;
    border: 1px solid #E1E8E4;
    border-radius: 9px;
    padding: 2px 11px;
    max-width: 100%;
}

.department-search-box > i {
    color: #8A9690;
    font-size: 12px;
    margin-right: 8px;
}

.department-search-box input {
    border: 0;
    background: transparent;
    box-shadow: none !important;
    height: 32px;
    padding: 4px 0;
    font-size: 12px;
    color: var(--department-text);
}

.department-search-box input:focus {
    outline: none;
}


/* ================================
   PANEL
================================ */

.department-panel {
    background: #fff;
    border: 1px solid var(--department-border);
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 3px 14px rgba(31,42,36,.04);
}

.department-panel-header {
    min-height: 76px;
    padding: 16px 20px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    border-bottom: 1px solid #EEF1EF;
}

.department-panel-title {
    display: flex;
    align-items: center;
    min-width: 0;
}

.panel-title-icon {
    width: 38px;
    height: 38px;
    min-width: 38px;
    border-radius: 10px;
    background: #E8F5EE;
    color: var(--department-green);
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 11px;
    font-size: 15px;
}

.department-panel-title h5 {
    margin: 0;
    color: var(--department-text);
    font-size: 15px;
    font-weight: 700;
}

.department-panel-title span {
    display: block;
    margin-top: 2px;
    color: var(--department-muted);
    font-size: 11px;
}

.department-panel-count {
    background: #E8F5EE;
    color: var(--department-green);
    border-radius: 8px;
    padding: 5px 9px;
    font-size: 12px;
    font-weight: 700;
    white-space: nowrap;
}

.department-panel-body {
    padding: 0;
}


/* ================================
   AJAX TABLE
================================ */

#departmentTableContainer {
    position: relative;
    min-height: 150px;
    transition: opacity .15s ease;
}

#departmentTableContainer.loading {
    opacity: .45;
    pointer-events: none;
}

#departmentTableContainer.loading::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 34px;
    height: 34px;
    margin: -17px 0 0 -17px;
    border: 3px solid #ddd;
    border-top-color: var(--department-green);
    border-radius: 50%;
    animation: department-spin .6s linear infinite;
}

@keyframes department-spin {
    to {
        transform: rotate(360deg);
    }
}


/* ================================
   MODALS
================================ */

.department-modal {
    border: 0;
    border-radius: 15px;
    overflow: hidden;
}

.department-modal-header {
    background: linear-gradient(135deg, #006D36 0%, #008747 100%);
    color: #fff;
    border-bottom: 0;
    padding: 15px 20px;
}

.department-modal-header .modal-title {
    font-size: 15px;
    font-weight: 700;
}

.department-modal-body {
    padding: 22px;
}

.department-modal-body label {
    color: #5F6B65;
    font-size: 12px;
    font-weight: 700;
    margin-bottom: 7px;
}

.department-modal-body .form-control {
    border: 1px solid #E1E8E4;
    border-radius: 9px;
    font-size: 12px;
    box-shadow: none;
    transition: all .2s ease;
}

.department-modal-body .form-control:focus {
    border-color: #8BC9A5;
    box-shadow: 0 0 0 3px rgba(0,109,54,.08);
}

.input-wrapper {
    display: flex;
    align-items: center;
    border: 1px solid #E1E8E4;
    border-radius: 9px;
    padding-left: 11px;
    background: #fff;
}

.input-wrapper > i {
    color: #8A9690;
    font-size: 12px;
    margin-right: 8px;
}

.input-wrapper .form-control {
    border: 0;
    padding-left: 0;
}

.input-wrapper:focus-within {
    border-color: #8BC9A5;
    box-shadow: 0 0 0 3px rgba(0,109,54,.08);
}

.department-modal-footer {
    background: #F8FAF9;
    border-top: 1px solid #EEF1EF;
    padding: 12px 20px;
}

.modal-cancel-btn {
    background: #fff;
    border: 1px solid #E0E5E2;
    color: #68736E;
    border-radius: 8px;
    font-size: 11px;
    font-weight: 700;
    padding: 7px 15px;
}

.modal-save-btn {
    background: var(--department-green);
    border: 1px solid var(--department-green);
    color: #fff;
    border-radius: 8px;
    font-size: 11px;
    font-weight: 700;
    padding: 7px 15px;
}

.modal-save-btn:hover {
    background: var(--department-green-dark);
    border-color: var(--department-green-dark);
    color: #fff;
}


/* ================================
   DELETE MODAL
================================ */

.delete-modal-header {
    background: #DC3545;
    color: #fff;
    border-bottom: 0;
    padding: 14px 18px;
}

.delete-modal-header .modal-title {
    font-size: 13px;
    font-weight: 700;
}

.delete-modal-body {
    text-align: center;
    padding: 25px 20px;
}

.delete-icon {
    width: 52px;
    height: 52px;
    border-radius: 13px;
    background: #FDECEF;
    color: #DC3545;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 12px;
    font-size: 20px;
}

.delete-question {
    color: #7A8780;
    font-size: 11px;
    margin-bottom: 3px;
}

.delete-name {
    color: var(--department-text);
    font-size: 13px;
    display: block;
    margin-bottom: 3px;
}

.delete-modal-footer {
    background: #F8FAF9;
    border-top: 1px solid #EEF1EF;
    padding: 10px 15px;
    justify-content: space-between;
}

.delete-btn {
    border-radius: 8px;
    font-size: 11px;
    font-weight: 700;
    padding: 7px 14px;
}


/* ================================
   RESPONSIVE
================================ */

@media (max-width: 991.98px) {

    .department-header-content {
        align-items: flex-start;
    }

    .department-header h2 {
        font-size: 20px;
    }

    .department-header p {
        max-width: 600px;
    }

}


@media (max-width: 767.98px) {

    .department-page {
        padding-top: 3px;
    }

    .department-header-content {
        padding: 20px;
        flex-direction: column;
        align-items: stretch;
    }

    .department-header-info {
        align-items: flex-start;
    }

    .department-header-icon {
        width: 48px;
        height: 48px;
        min-width: 48px;
        font-size: 20px;
    }

    .department-header h2 {
        font-size: 18px;
    }

    .department-header p {
        font-size: 11px;
        line-height: 1.6;
    }

    .header-divider {
        display: none;
    }

    .department-header-btn {
        width: 100%;
    }

    .department-stat-card,
    .department-search-card {
        min-height: 105px;
        padding: 16px;
    }

    .department-stat-value {
        font-size: 22px;
    }

    .department-panel-header {
        padding: 14px 16px;
    }

    .department-panel-title h5 {
        font-size: 13px;
    }

    .department-panel-title span {
        font-size: 10px;
    }

}


@media (max-width: 575.98px) {

    .department-header-icon {
        display: none;
    }

    .department-header h2 {
        font-size: 17px;
    }

    .department-header p {
        font-size: 10px;
    }

    .department-stat-icon,
    .department-search-icon {
        width: 46px;
        height: 46px;
        min-width: 46px;
        font-size: 18px;
        margin-right: 12px;
    }

    .department-stat-label,
    .department-search-label {
        font-size: 11px;
    }

    .department-stat-value {
        font-size: 21px;
    }

    .department-stat-bottom {
        font-size: 10px;
    }

}

</style>

@stop

@section('js')

<script>

$(document).ready(function () {

    const $container = $('#departmentTableContainer');
    const $search = $('#search');

    let debounceTimer;


    function currentParams(page) {

        return {
            search: $search.val(),
            page: page || 1,
        };

    }


    function loadDepartments(page) {

        const params = currentParams(page);

        $container.addClass('loading');


        $.ajax({

            url: "{{ route('department.index') }}",

            method: 'GET',

            data: params,

            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            },

            success: function (res) {

                $container.html(res.html);

                $('#totalDepartment').text(res.total);

                const qs = $.param(params);

                history.replaceState(
                    null,
                    '',
                    "{{ route('department.index') }}?" + qs
                );

            },

            error: function () {

                console.error(
                    'Failed to load department list.'
                );

            },

            complete: function () {

                $container.removeClass('loading');

            }

        });

    }


    $search.on('keyup', function () {

        clearTimeout(debounceTimer);

        debounceTimer = setTimeout(function () {

            loadDepartments(1);

        }, 400);

    });


    $(document).on(
        'click',
        '#departmentTableContainer .pagination a',
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

            loadDepartments(page);

        }
    );


    $(document).on('click', '.btn-edit', function () {

        let id = $(this).data('id');

        $.get(
            "{{ url('department/edit') }}/" + id,
            function (data) {

                $('#department_name')
                    .val(data.department_name);

                $('#description')
                    .val(data.description);

                $('#editForm').attr(
                    'action',
                    "{{ url('department/update') }}/" + id
                );

            }
        );

    });


    $(document).on('click', '.btn-delete', function () {

        let id = $(this).data('id');

        let name = $(this).data('name');

        $('#deleteDepartmentName').text(name);

        $('#deleteForm').attr(
            'action',
            "{{ url('department/delete') }}/" + id
        );

    });

});

</script>

@stop
