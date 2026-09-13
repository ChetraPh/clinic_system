@extends('adminlte::page')

@section('title', 'ការគ្រប់គ្រងបន្ទប់')

@section('content')

<div class="toast-container-custom" id="toastContainer"></div>

<div class="row mb-4 mt-3">
    <div class="col-md-3">
        <div class="stat-card">
            <div class="icon bg-light-primary"><i class="fas fa-door-open"></i></div>
            <div><small>បន្ទប់សរុប</small>
                <h3 id="statTotal">{{ $stats['total'] }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card">
            <div class="icon bg-light-success"><i class="fas fa-check-circle"></i></div>
            <div><small>ទំនេរ</small>
                <h3 id="statAvailable">{{ $stats['available'] }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card">
            <div class="icon bg-light-info"><i class="fas fa-user-injured"></i></div>
            <div><small>កំពុងប្រើប្រាស់</small>
                <h3 id="statOccupied">{{ $stats['occupied'] }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card">
            <div class="icon bg-light-warning"><i class="fas fa-tools"></i></div>
            <div><small>កំពុងថែទាំ</small>
                <h3 id="statMaintenance">{{ $stats['maintenance'] }}</h3>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="toolbar flex-wrap justify-content-between">
            <div class="d-flex flex-wrap" style="gap: 10px;">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" id="search" class="form-control border-0" placeholder="ស្វែងរកលេខបន្ទប់">
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
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCreateRoom">
                <i class="fas fa-plus mr-1"></i> បន្ថែមបន្ទប់ថ្មី
            </button>
        </div>
    </div>
    <div class="container-fluid">
        <div id="roomTableContainer">
            @include('form.room.partials.table')
        </div>
    </div>
</div>

{{-- ── CREATE ROOM MODAL ─────────────────────────────────────────────── --}}
<div class="modal fade" id="modalCreateRoom" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content form-card">
            <div class="modal-header modal-header-custom">
                <h6 class="modal-title font-weight-bold">
                  បន្ថែមបន្ទប់ថ្មី
                </h6>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <form id="createRoomForm" action="{{ route('room.store') }}" method="POST">
                @csrf
                <div class="modal-body p-4">
                    <p class="text-muted small mb-3">បញ្ចូលព័ត៌មានបន្ទប់ថ្មី</p>
                    <div id="createRoomAlert" class="alert alert-danger d-none mb-3"></div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="small font-weight-bold text-uppercase text-muted">បន្ទប់លេខ</label>
                            <input type="text" name="room_number" id="create_room_number" class="form-control"
                                placeholder="e.g., ICU-402-B" maxlength="20" required>
                            <div class="invalid-feedback" id="error_create_room_number"></div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="small font-weight-bold text-uppercase text-muted">ប្រភេទបន្ទប់</label>
                            <select name="room_type" id="create_room_type" class="form-control custom-select" required>
                                <option value="">ជ្រើសរើសប្រភេទ</option>
                                <option value="general">ទូទៅ</option>
                                <option value="private">ឯកជន</option>
                                <option value="icu">ICU</option>
                                <option value="isolation">គ្រែមួយ</option>
                            </select>
                            <div class="invalid-feedback" id="error_create_room_type"></div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="small font-weight-bold text-uppercase text-muted">ស្ថានភាព</label>
                            <select name="status" id="create_status" class="form-control custom-select" required>
                                <option value="available">ទំនេរ</option>
                                <option value="occupied">បានប្រើប្រាស់</option>
                                <option value="maintenance">ថែទាំ</option>
                            </select>
                            <div class="invalid-feedback" id="error_create_status"></div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="small font-weight-bold text-uppercase text-muted">តម្លៃ/ថ្ងៃ</label>
                            <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text">$</span></div>
                                <input type="number" step="0.01" min="0" name="price_per_day" id="create_price_per_day"
                                    class="form-control" placeholder="0.00" required>
                            </div>
                            <div class="invalid-feedback d-block" id="error_create_price_per_day"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between bg-light">
                    <button type="button" class="btn btn-link text-muted" data-dismiss="modal">បោះបង់</button>
                    <button type="submit" class="btn btn-primary px-4" id="btnSubmitCreateRoom">
                        <i class="fas fa-save mr-1"></i> រក្សាទុកបន្ទប់
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- ── EDIT ROOM MODAL ─────────────────────────────────────────────── --}}
<div class="modal fade" id="modalEditRoom" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content form-card">
            <div class="modal-header modal-header-custom">
                <h6 class="modal-title font-weight-bold">
                 ធ្វើបច្ចុប្បន្នភាពលក្ខណៈបន្ទប់
                </h6>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <form id="editRoomForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body p-4">
                    <p class="text-muted small mb-3">ធ្វើបច្ចុប្បន្នភាពព័ត៌មានបន្ទប់និងស្ថានភាពដែលមានការប្រើប្រាស់។</p>
                    <div id="editRoomAlert" class="alert alert-danger d-none mb-3"></div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="small font-weight-bold text-uppercase text-muted">បន្ទប់លេខ</label>
                            <input type="text" name="room_number" id="edit_room_number" class="form-control"
                                maxlength="20" required>
                            <div class="invalid-feedback" id="error_edit_room_number"></div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="small font-weight-bold text-uppercase text-muted">ប្រភេទបន្ទប់</label>
                            <select name="room_type" id="edit_room_type" class="form-control custom-select" required>
                                <option value="general">ទូទៅ</option>
                                <option value="private">ឯកជន</option>
                                <option value="icu">ICU</option>
                                <option value="isolation">គ្រែមួយ</option>
                            </select>
                            <div class="invalid-feedback" id="error_edit_room_type"></div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="small font-weight-bold text-uppercase text-muted">ស្ថានភាព</label>
                            <select name="status" id="edit_status" class="form-control custom-select" required>
                                <option value="available">ទំនេរ</option>
                                <option value="occupied">បានប្រើប្រាស់</option>
                                <option value="maintenance">ថែទាំ</option>
                            </select>

                            <div class="invalid-feedback" id="error_edit_status"></div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="small font-weight-bold text-uppercase text-muted">តម្លៃ/ថ្ងៃ</label>
                            <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text">$</span></div>
                                <input type="number" step="0.01" min="0" name="price_per_day" id="edit_price_per_day"
                                    class="form-control" required>
                            </div>
                            <div class="invalid-feedback d-block" id="error_edit_price_per_day"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between bg-light">
                    <button type="button" class="btn btn-link text-muted" data-dismiss="modal">បោះបង់</button>
                    <button type="submit" class="btn btn-primary px-4" id="btnSubmitEditRoom">
                        <i class="fas fa-save mr-1"></i> រក្សាទុកបន្ទប់
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- ── DELETE CONFIRM MODAL ─────────────────────────────────────────────── --}}
<div class="modal fade" id="modalDeleteRoom" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content ">
            <div class="modal-header bg-danger text-white">
                <h6 class="modal-title">លុបបន្ទប់</h6>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <form id="deleteRoomForm" method="POST">
                @csrf @method('DELETE')
                <div class="modal-body">
                    តើអ្នកពិតជាចង់លុបបន្ទប់ <strong id="deleteRoomNumber" class="text-danger"></strong> មែនទេ?
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-light btn-sm" data-dismiss="modal">បោះបង់</button>
                    <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash mr-1"></i>លុប</button>
                </div>
            </form>
        </div>
    </div>
</div>

@stop

@section('css')
<style>
    .stat-card {
        background: #fff;
        border-radius: 15px;
        padding: 20px;
        display: flex;
        align-items: center;
        gap: 18px;
        box-shadow: 0 5px 18px rgba(0, 0, 0, .05);
    }

    .stat-card h3 {
        margin: 0;
        font-weight: 700;
    }

    .icon {
        width: 52px;
        height: 52px;
        border-radius: 14px;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 22px;
    }

    .bg-light-primary {
        background: #e6f4ec;
        color: var(--primary-color);
    }

    .bg-light-success {
        background: #dff6e8;
        color: #18864b;
    }

    .bg-light-info {
        background: #e3f2fd;
        color: #1565c0;
    }

    .bg-light-warning {
        background: #fff4e0;
        color: #b8720a;
    }

    .card {
        border: none;
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 8px 30px rgba(0, 0, 0, .05);
    }

    .form-card {
        border: none;
        border-radius: 16px;
    }

    .toolbar {
        display: flex;
        align-items: center;
        padding: 20px;
        gap: 12px;
    }

    .search-box {
        display: flex;
        align-items: center;
        background: #f3f5f7;
        border-radius: 12px;
        padding: 0 15px;
        width: 240px;
    }

    .search-box input {
        background: none;
        box-shadow: none;
    }

    .search-box i {
        color: #888;
    }

    .filter-select {
        max-width: 170px;
        border-radius: 10px;
    }

    .table thead th {
        background: #f5f6f7;
        border: none;
        color: #666;
        font-size: 14px;
    }

    .table td {
        vertical-align: middle;
        border-top: 1px solid #eee;
    }

    .room-type-bar {
        width: 4px;
        height: 30px;
        border-radius: 4px;
        display: inline-block;
        margin-right: 10px;
    }

    .type-general {
        background: #9e9e9e;
    }

    .type-private {
        background: #2196f3;
    }

    .type-icu {
        background: #e53935;
    }

    .type-isolation {
        background: #8e24aa;
    }

    .badge-available {
        background: #dff6e8;
        color: #18864b;
    }

    .badge-occupied {
        background: #fdeaea;
        color: #c0392b;
    }

    .badge-maintenance {
        background: #fff4e0;
        color: #b8720a;
    }

    #roomTableContainer {
        position: relative;
        min-height: 120px;
    }

    #roomTableContainer.loading {
        opacity: .45;
        pointer-events: none;
    }
</style>
@stop

@section('js')
@parent
<script>
    $(document).ready(function () {
        const $container = $('#roomTableContainer');
        let debounceTimer;

        function showToast(msg, type = 'success') {
            const icon = type === 'success' ? 'fa-check-circle' : 'fa-times-circle';
            const $toast = $('<div class="toast-custom ' + type + '"><i class="fas ' + icon + '"></i><span>' + msg + '</span></div>');
            $('#toastContainer').append($toast);
            setTimeout(() => $toast.fadeOut(300, () => $toast.remove()), 4000);
        }

        function clearErrors($form) {
            $form.find('.form-control, .custom-select').removeClass('is-invalid');
            $form.find('.invalid-feedback').text('');
        }

        function showFieldErrors($form, prefix, errors) {
            $.each(errors, function (field, messages) {
                $('#' + prefix + field).addClass('is-invalid');
                $('#error_' + prefix + field).text(messages[0]);
            });
        }

        function params(page) {
            return {
                search: $('#search').val(),
                room_type: $('#filterType').val(),
                status: $('#filterStatus').val(),
                page: page || 1,
            };
        }

        function loadRooms(page) {
            $container.addClass('loading');
            $.ajax({
                url: "{{ route('room.index') }}",
                method: 'GET',
                data: params(page),
                headers: { 'X-Requested-With': 'XMLHttpRequest' },
                success: function (res) {
                    $container.html(res.html);
                    $('#statTotal').text(res.stats.total);
                    $('#statAvailable').text(res.stats.available);
                    $('#statOccupied').text(res.stats.occupied);
                    $('#statMaintenance').text(res.stats.maintenance);
                },
                complete: function () { $container.removeClass('loading'); }
            });
        }

        $('#search').on('keyup', function () {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(() => loadRooms(1), 400);
        });
        $('#filterType, #filterStatus').on('change', () => loadRooms(1));

        $(document).on('click', '#roomTableContainer .pagination a', function (e) {
            e.preventDefault();
            const href = $(this).attr('href');
            if (!href) return;
            const page = new URL(href, window.location.origin).searchParams.get('page') || 1;
            loadRooms(page);
        });

        // ---- Reset create modal fields when opened ----
        $('#modalCreateRoom').on('show.bs.modal', function () {
            $('#createRoomForm')[0].reset();
            clearErrors($('#createRoomForm'));
            $('#createRoomAlert').addClass('d-none').text('');
        });

        // ---- Create Room (AJAX) ----
        $('#createRoomForm').on('submit', function (e) {
            e.preventDefault();
            const $form = $(this);
            const $btn = $('#btnSubmitCreateRoom');
            clearErrors($form);
            $('#createRoomAlert').addClass('d-none').text('');
            $btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-1"></i> Saving...');

            $.ajax({
                url: $form.attr('action'),
                method: 'POST',
                data: $form.serialize(),
                headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' },
                success: function (res) {
                    $('#modalCreateRoom').modal('hide');
                    showToast(res.message || 'Room created successfully');
                    loadRooms(1);
                },
                error: function (xhr) {
                    if (xhr.status === 422 && xhr.responseJSON.errors) {
                        showFieldErrors($form, 'create_', xhr.responseJSON.errors);
                    } else {
                        showToast('An error occurred while creating the room.', 'error');
                    }
                },
                complete: function () {
                    $btn.prop('disabled', false).html('<i class="fas fa-save mr-1"></i> Save Room');
                }
            });
        });

        // ---- Open Edit modal: fill fields from row data ----
        $(document).on('click', '.btn-edit-room', function () {
            const $btn = $(this);
            $('#edit_room_number').val($btn.data('room-number'));
            $('#edit_room_type').val($btn.data('room-type'));
            $('#edit_status').val($btn.data('status'));
            $('#edit_price_per_day').val($btn.data('price'));
            $('#editRoomForm').attr('action', "{{ url('room/update') }}/" + $btn.data('id'));
            clearErrors($('#editRoomForm'));
            $('#editRoomAlert').addClass('d-none').text('');
            $('#modalEditRoom').modal('show');
        });

        // ---- Update Room (AJAX) ----
        $('#editRoomForm').on('submit', function (e) {
            e.preventDefault();
            const $form = $(this);
            const $btn = $('#btnSubmitEditRoom');
            clearErrors($form);
            $('#editRoomAlert').addClass('d-none').text('');
            $btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-1"></i> Saving...');

            $.ajax({
                url: $form.attr('action'),
                method: 'POST', // Laravel reads @method('PUT') from serialized data
                data: $form.serialize(),
                headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' },
                success: function (res) {
                    $('#modalEditRoom').modal('hide');
                    showToast(res.message || 'Room updated successfully');
                    loadRooms(1);
                },
                error: function (xhr) {
                    if (xhr.status === 422 && xhr.responseJSON.errors) {
                        showFieldErrors($form, 'edit_', xhr.responseJSON.errors);
                    } else {
                        showToast('An error occurred while updating the room.', 'error');
                    }
                },
                complete: function () {
                    $btn.prop('disabled', false).html('<i class="fas fa-save mr-1"></i> Save Room');
                }
            });
        });
        $(document).on('click', '.btn-delete-room', function () {
            const id = $(this).data('id');
            const number = $(this).data('number');
            $('#deleteRoomNumber').text(number);
            $('#deleteRoomForm').attr(
                'action',
                "{{ url('room/delete') }}/" + id
            );
            $('#modalDeleteRoom').modal('show');
        });
        $('#deleteRoomForm').on('submit', function (e) {
            e.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: $(this).serialize(),
                headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' },
                success: function (res) {
                    $('#modalDeleteRoom').modal('hide');
                    showToast(res.message || 'Room deleted successfully');
                    loadRooms(1);
                },
                error: function () {
                    showToast('An error occurred while deleting the room.', 'error');
                }
            });
        });
    });
</script>
@stop
