@extends('adminlte::page')

@section('title', 'គ្រប់គ្រងបន្ទប់ (Room Management)')

@section('content')
<style>
    .stat-card {
        background: #fff;
        border-radius: 12px;
        padding: 20px;
        display: flex;
        align-items: center;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.08);
    }

    .stat-card .icon {
        width: 50px;
        height: 50px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        margin-right: 15px;
    }

    .bg-light-primary {
        background: #e8f0fe;
        color: #1a73e8;
    }

    .bg-light-success {
        background: #e8f5e9;
        color: #2e7d32;
    }

    .bg-light-danger {
        background: #ffebee;
        color: #c62828;
    }

    .bg-light-warning {
        background: #fff8e1;
        color: #f57f17;
    }

    .toolbar {
        display: flex;
        gap: 12px;
        align-items: center;
        padding: 16px 20px;
        background: #fff;
        border-bottom: 1px solid #edf2f7;
    }

    .search-box {
        position: relative;
        flex: 1;
        min-width: 240px;
    }

    .search-box i {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: #a0aec0;
    }

    .search-box input {
        padding-left: 38px;
        border-radius: 8px;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
    }

    .search-box input:focus {
        background: #fff;
        border-color: #3182ce;
        box-shadow: 0 0 0 3px rgba(49, 130, 206, 0.1);
    }

    .toast-custom {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 9999;
        padding: 12px 20px;
        border-radius: 8px;
        color: #fff;
        font-weight: 500;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .toast-custom.success {
        background: #38a169;
    }

    .toast-custom.error {
        background: #e53e3e;
    }

    .modal-header-custom {
        background: linear-gradient(135deg, #0d9488 0%, #0f766e 100%);
        color: white;
    }

    .modal-header-edit {
        background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%);
        color: white;
    }
</style>

<div id="toastContainer"></div>

{{-- Top Stats Section --}}
<div class="row mb-4 align-items-center mt-2">
    <div class="col-md-3 col-sm-6 mb-2">
        <div class="stat-card">
            <div class="icon bg-light-primary">
                <i class="fas fa-procedures"></i>
            </div>
            <div>
                <small class="text-muted d-block">បន្ទប់សរុប (Total Rooms)</small>
                <h3 id="statTotal" class="m-0 font-weight-bold">{{ $totalRooms }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 mb-2">
        <div class="stat-card">
            <div class="icon bg-light-success">
                <i class="fas fa-check-circle"></i>
            </div>
            <div>
                <small class="text-muted d-block">បន្ទប់ទំនេរ (Available)</small>
                <h3 id="statAvailable" class="m-0 font-weight-bold">{{ $availableRooms }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 mb-2">
        <div class="stat-card">
            <div class="icon bg-light-danger">
                <i class="fas fa-user-check"></i>
            </div>
            <div>
                <small class="text-muted d-block">មានអ្នកជំងឺ (Occupied)</small>
                <h3 id="statOccupied" class="m-0 font-weight-bold">{{ $occupiedRooms }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 mb-2">
        <div class="stat-card">
            <div class="icon bg-light-warning">
                <i class="fas fa-tools"></i>
            </div>
            <div>
                <small class="text-muted d-block">កំពុងជួសជុល (Maintenance)</small>
                <h3 id="statMaintenance" class="m-0 font-weight-bold">{{ $maintenanceRooms }}</h3>
            </div>
        </div>
    </div>
</div>

{{-- Main Card Container --}}
<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <div class="toolbar flex-wrap">
            <div class="search-box">
                <i class="fas fa-search"></i>
                <input type="text" id="search" class="form-control"
                    placeholder="ស្វែងរកតាមលេខបន្ទប់, ប្រភេទបន្ទប់, តម្លៃ...">
            </div>

            <div class="filter-box d-flex gap-2">
                <select id="filterType" class="form-control" style="width: 180px; border-radius: 8px;">
                    <option value="">-- គ្រប់ប្រភេទបន្ទប់ --</option>
                    <option value="general">បន្ទប់ទូទៅ (General)</option>
                    <option value="private">បន្ទប់ផ្ទាល់ខ្លួន (Private)</option>
                    <option value="icu">បន្ទប់សង្គ្រោះបន្ទាន់ (ICU)</option>
                    <option value="isolation">បន្ទប់ដាច់ដោយឡែក (Isolation)</option>
                </select>

                <select id="filterStatus" class="form-control" style="width: 170px; border-radius: 8px;">
                    <option value="">-- គ្រប់ស្ថានភាព --</option>
                    <option value="available">ទំនេរ (Available)</option>
                    <option value="occupied">មានអ្នកជំងឺ (Occupied)</option>
                    <option value="maintenance">កំពុងជួសជុល (Maintenance)</option>
                </select>
            </div>

            <button class="btn btn-primary ml-auto" data-toggle="modal" data-target="#modalCreate"
                style="border-radius: 8px;">
                <i class="fas fa-plus-circle mr-1"></i> បន្ថែមបន្ទប់ថ្មី
            </button>
        </div>

        <div class="px-3 py-2">
            <div id="roomTableContainer">
                @include('form.room.partials.table')
            </div>
        </div>
    </div>
</div>

{{-- ====== Modal Create Room ====== --}}
<div class="modal fade" id="modalCreate" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header modal-header-custom">
                <h5 class="modal-title font-weight-bold"><i class="fas fa-plus-circle mr-2"></i> បន្ថែមបន្ទប់ថ្មី (Add
                    New Room)</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('room.store') }}" method="POST">
                @csrf
                <div class="modal-body p-4">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="font-weight-bold">លេខបន្ទប់ (Room Number) <span
                                    class="text-danger">*</span></label>
                            <input type="text" name="room_number" class="form-control" placeholder="ឧ. R-101, ICU-01"
                                required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="font-weight-bold">ប្រភេទបន្ទប់ (Room Type) <span
                                    class="text-danger">*</span></label>
                            <select name="room_type" class="form-control" required>
                                <option value="general">បន្ទប់ទូទៅ (General)</option>
                                <option value="private">បន្ទប់ផ្ទាល់ខ្លួន (Private)</option>
                                <option value="icu">បន្ទប់សង្គ្រោះបន្ទាន់ (ICU)</option>
                                <option value="isolation">បន្ទប់ដាច់ដោយឡែក (Isolation)</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="font-weight-bold">ស្ថានភាព (Status) <span class="text-danger">*</span></label>
                            <select name="status" class="form-control" required>
                                <option value="available">ទំនេរ (Available)</option>
                                <option value="occupied">មានអ្នកជំងឺ (Occupied)</option>
                                <option value="maintenance">កំពុងជួសជុល (Maintenance)</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="font-weight-bold">តម្លៃ/ថ្ងៃ (Price per Day - $) <span
                                    class="text-danger">*</span></label>
                            <input type="number" step="0.01" min="0" name="price_per_day" class="form-control"
                                placeholder="ឧ. 25.00" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">បោះបង់</button>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-1"></i> រក្សាទុក</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- ====== Modal Edit Room ====== --}}
<div class="modal fade" id="modalEdit" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header modal-header-custom">
                <h5 class="modal-title font-weight-bold"><i class="fas fa-edit mr-2"></i> កែប្រែបន្ទប់ (Edit Room)</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editRoomForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body p-4">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="font-weight-bold">លេខបន្ទប់ (Room Number) <span
                                    class="text-danger">*</span></label>
                            <input type="text" id="edit_room_number" name="room_number" class="form-control" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="font-weight-bold">ប្រភេទបន្ទប់ (Room Type) <span
                                    class="text-danger">*</span></label>
                            <select id="edit_room_type" name="room_type" class="form-control" required>
                                <option value="general">បន្ទប់ទូទៅ (General)</option>
                                <option value="private">បន្ទប់ផ្ទាល់ខ្លួន (Private)</option>
                                <option value="icu">បន្ទប់សង្គ្រោះបន្ទាន់ (ICU)</option>
                                <option value="isolation">បន្ទប់ដាច់ដោយឡែក (Isolation)</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="font-weight-bold">ស្ថានភាព (Status) <span class="text-danger">*</span></label>
                            <select id="edit_status" name="status" class="form-control" required>
                                <option value="available">ទំនេរ (Available)</option>
                                <option value="occupied">មានអ្នកជំងឺ (Occupied)</option>
                                <option value="maintenance">កំពុងជួសជុល (Maintenance)</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="font-weight-bold">តម្លៃ/ថ្ងៃ (Price per Day - $) <span
                                    class="text-danger">*</span></label>
                            <input type="number" step="0.01" min="0" id="edit_price_per_day" name="price_per_day"
                                class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">បោះបង់</button>
                    <button type="submit" class="btn btn-info"><i class="fas fa-sync-alt mr-1"></i>
                        កែប្រែទិន្នន័យ</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- ====== Modal Delete Room ====== --}}
<div class="modal fade" id="modalDelete" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title font-weight-bold"><i class="fas fa-exclamation-triangle mr-2"></i>
                    បញ្ជាក់ការលុបបន្ទប់</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="deleteRoomForm" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body text-center p-4">
                    <p class="mb-2 fs-5">តើអ្នកពិតជាចង់លុបបន្ទប់លេខ <strong id="deleteRoomNumber"
                            class="text-danger"></strong> នេះមែនទេ?</p>
                    <small class="text-muted">សកម្មភាពនេះមិនអាចត្រឡប់ក្រោយវិញបានឡើយ។</small>
                </div>
                <div class="modal-footer justify-content-center bg-light">
                    <button type="button" class="btn btn-secondary px-4" data-dismiss="modal">បោះបង់</button>
                    <button type="submit" class="btn btn-danger px-4"><i class="fas fa-trash mr-1"></i> លុបចេញ</button>
                </div>
            </form>
        </div>
    </div>
</div>

@stop

@section('js')
<script>
    $(document).ready(function () {
        let debounceTimer;

        function currentParams(page = 1) {
            return {
                page: page,
                search: $('#search').val(),
                room_type: $('#filterType').val(),
                status: $('#filterStatus').val()
            };
        }

        function loadRooms(page = 1) {
            const params = currentParams(page);
            $('#roomTableContainer').css('opacity', '0.5');

            $.ajax({
                url: "{{ route('room.index') }}",
                method: 'GET',
                data: params,
                headers: { 'X-Requested-With': 'XMLHttpRequest' },
                success: function (res) {
                    $('#roomTableContainer').html(res.html).css('opacity', '1');
                    if (res.stats) {
                        $('#statTotal').text(res.stats.total);
                        $('#statAvailable').text(res.stats.available);
                        $('#statOccupied').text(res.stats.occupied);
                        $('#statMaintenance').text(res.stats.maintenance);
                    }
                    const qs = $.param(params);
                    history.replaceState(null, '', "{{ route('room.index') }}?" + qs);
                },
                error: function () {
                    $('#roomTableContainer').css('opacity', '1');
                    console.error('Failed to load room list.');
                }
            });
        }

        // Debounced search
        $('#search').on('keyup', function () {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(function () {
                loadRooms(1);
            }, 400);
        });

        // Dropdown filters
        $('#filterType, #filterStatus').on('change', function () {
            loadRooms(1);
        });

        // AJAX Pagination
        $(document).on('click', '#roomTableContainer .pagination a', function (e) {
            e.preventDefault();
            const href = $(this).attr('href');
            if (!href) return;
            const page = new URL(href, window.location.origin).searchParams.get('page') || 1;
            loadRooms(page);
        });

        // Edit modal fetch & populate
        $(document).on('click', '.btn-edit', function () {
            let id = $(this).data('id');
            $.get("{{ url('room/edit') }}/" + id, function (data) {
                $('#edit_room_number').val(data.room_number);
                $('#edit_room_type').val(data.room_type);
                $('#edit_status').val(data.status);
                $('#edit_price_per_day').val(data.price_per_day);

                $('#editRoomForm').attr('action', "{{ url('room/update') }}/" + id);
            }).fail(function () {
                showToast('មិនអាចទាញយកទិន្នន័យបន្ទប់បានទេ', 'error');
            });
        });
        // Submit Edit Room
        $(document).on('submit', '#editRoomForm', function (e) {
            e.preventDefault();

            let form = $(this);

            console.log('EDIT FORM ACTION:', form.attr('action'));
            console.log('EDIT FORM DATA:', form.serialize());

            $.ajax({
                url: form.attr('action'),
                method: 'POST',
                data: form.serialize(),

                success: function (res) {
                    console.log('UPDATE SUCCESS:', res);

                    $('#modalEdit').modal('hide');

                    showToast(
                        res.message || 'ព័ត៌មានបន្ទប់ត្រូវបានកែប្រែដោយជោគជ័យ',
                        'success'
                    );

                    loadRooms(1);
                },

                error: function (xhr) {
                    console.log('UPDATE STATUS:', xhr.status);
                    console.log('UPDATE URL:', xhr.responseURL);
                    console.log('UPDATE RESPONSE:', xhr.responseText);

                    let message = 'មានបញ្ហាក្នុងការកែប្រែបន្ទប់។';

                    if (xhr.responseJSON) {
                        if (xhr.responseJSON.message) {
                            message = xhr.responseJSON.message;
                        }

                        if (xhr.responseJSON.errors) {
                            message = Object.values(xhr.responseJSON.errors)
                                .flat()
                                .join('<br>');
                        }
                    }

                    showToast(message, 'error');
                }
            });
        });

        // Delete modal assign
        $(document).on('click', '.btn-delete', function () {
            let id = $(this).data('id');
            let name = $(this).data('name');
            $('#deleteRoomNumber').text(name);
            $('#deleteRoomForm').attr('action', "{{ url('room/delete') }}/" + id);
        });

        // Toast helper
        function showToast(message, type = 'success') {
            let toast = `<div class="toast-custom ${type}">${message}</div>`;
            $('#toastContainer').append(toast);

            setTimeout(function () {
                $('.toast-custom:first').fadeOut(300, function () {
                    $(this).remove();
                });
            }, 3000);
        }

        @if(session('success'))
            showToast(@json(session('success')), 'success');
        @endif

        @if(session('error'))
            showToast(@json(session('error')), 'error');
        @endif
});
</script>
@stop
