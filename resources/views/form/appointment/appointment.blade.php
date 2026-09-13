@extends('adminlte::page')

@section('title', 'គ្រប់គ្រងការណាត់ជួប (Appointment Management)')

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

    .bg-light-info {
        background: #e0f7fa;
        color: #00838f;
    }

    .bg-light-success {
        background: #e8f5e9;
        color: #2e7d32;
    }

    .bg-light-danger {
        background: #ffebee;
        color: #c62828;
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
        background-color: #e53e3e;
    }
</style>

<div id="toastContainer"></div>

{{-- Top Stats Section --}}
<div class="row mb-4 align-items-center mt-2">
    <div class="col-md-3 col-sm-6 mb-2">
        <div class="stat-card">
            <div class="icon bg-light-primary">
                <i class="fas fa-calendar-alt"></i>
            </div>
            <div>
                <small class="text-muted d-block">ការណាត់ជួបសរុប</small>
                <h3 id="statTotal" class="m-0 font-weight-bold">{{ $totalAppointments }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 mb-2">
        <div class="stat-card">
            <div class="icon bg-light-info">
                <i class="fas fa-clock"></i>
            </div>
            <div>
                <small class="text-muted d-block">បានណាត់ទុក (Scheduled)</small>
                <h3 id="statScheduled" class="m-0 font-weight-bold">{{ $scheduledCount }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 mb-2">
        <div class="stat-card">
            <div class="icon bg-light-success">
                <i class="fas fa-check-circle"></i>
            </div>
            <div>
                <small class="text-muted d-block">បានរួចរាល់ (Completed)</small>
                <h3 id="statCompleted" class="m-0 font-weight-bold">{{ $completedCount }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 mb-2">
        <div class="stat-card">
            <div class="icon bg-light-danger">
                <i class="fas fa-times-circle"></i>
            </div>
            <div>
                <small class="text-muted d-block">បានបោះបង់ (Cancelled)</small>
                <h3 id="statCancelled" class="m-0 font-weight-bold">{{ $cancelledCount }}</h3>
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
                    placeholder="ស្វែងរកតាមឈ្មោះអ្នកជំងឺ, លេខទូរស័ព្ទ, ឈ្មោះគ្រូពេទ្យ...">
            </div>

            <div class="filter-box d-flex gap-2">
                <select id="filterStatus" class="form-control" style="width: 170px; border-radius: 8px;">
                    <option value="">-- គ្រប់ស្ថានភាព --</option>
                    <option value="scheduled">បានណាត់ទុក (Scheduled)</option>
                    <option value="completed">បានរួចរាល់ (Completed)</option>
                    <option value="cancelled">បានបោះបង់ (Cancelled)</option>
                </select>

                <input type="date" id="filterDate" class="form-control" style="width: 160px; border-radius: 8px;">
            </div>

            <button class="btn btn-primary ml-auto" data-toggle="modal" data-target="#modalCreate"
                style="border-radius: 8px;">
                <i class="fas fa-calendar-plus mr-1"></i> បង្កើតការណាត់ជួប
            </button>
        </div>

        <div class="px-3 py-2">
            <div id="appointmentTableContainer">
                @include('form.appointment.partials.table')
            </div>
        </div>
    </div>
</div>

{{-- ====== Modal Create Appointment ====== --}}
<div class="modal fade" id="modalCreate" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header modal-header-custom">
                <h5 class="modal-title font-weight-bold"><i class="fas fa-calendar-plus mr-2"></i> បង្កើតការណាត់ជួបថ្មី
                    (New Appointment)</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('appointment.store') }}" method="POST">
                @csrf
                <div class="modal-body p-4">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="font-weight-bold">អ្នកជំងឺ (Patient) <span
                                    class="text-danger">*</span></label>
                            <select name="patient_id" class="form-control" required>
                                <option value="">-- ជ្រើសរើសអ្នកជំងឺ --</option>
                                @foreach ($patients as $pat)
                                    <option value="{{ $pat->patient_id }}">{{ $pat->full_name }}
                                        ({{ $pat->phone ?? 'គ្មានលេខទូរស័ព្ទ' }})</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="font-weight-bold">វេជ្ជបណ្ឌិត (Doctor) <span
                                    class="text-danger">*</span></label>
                            <select name="user_id" class="form-control" required>
                                <option value="">-- ជ្រើសរើសវេជ្ជបណ្ឌិត --</option>
                                @foreach ($doctors as $doc)
                                    <option value="{{ $doc->id }}">
                                        Dr. {{ $doc->name }}
                                        ({{ $doc->specialization ?? 'ទូទៅ' }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="font-weight-bold">កាលបរិច្ឆេទ & ម៉ោងណាត់ (Date & Time) <span
                                    class="text-danger">*</span></label>
                            <input type="datetime-local" name="appointment_date" class="form-control" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="font-weight-bold">ស្ថានភាព (Status) <span class="text-danger">*</span></label>
                            <select name="status" class="form-control" required>
                                <option value="scheduled">បានណាត់ទុក (Scheduled)</option>
                                <option value="completed">បានរួចរាល់ (Completed)</option>
                                <option value="cancelled">បានបោះបង់ (Cancelled)</option>
                            </select>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label class="font-weight-bold">មូលហេតុនៃការណាត់ / រោគសញ្ញា (Reason)</label>
                            <textarea name="reason" class="form-control" rows="3"
                                placeholder="បញ្ជាក់ពីមូលហេតុនៃការណាត់ជួប..."></textarea>
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

{{-- ====== Modal Edit Appointment ====== --}}
<div class="modal fade" id="modalEdit" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header modal-header-custom">
                <h5 class="modal-title font-weight-bold"><i class="fas fa-edit mr-2"></i> កែប្រែការណាត់ជួប (Edit
                    Appointment)</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editAppointmentForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body p-4">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="font-weight-bold">អ្នកជំងឺ (Patient) <span
                                    class="text-danger">*</span></label>
                            <select id="edit_patient_id" name="patient_id" class="form-control" required>
                                <option value="">-- ជ្រើសរើសអ្នកជំងឺ --</option>
                                @foreach ($patients as $pat)
                                    <option value="{{ $pat->patient_id }}">{{ $pat->full_name }}
                                        ({{ $pat->phone ?? 'គ្មានលេខទូរស័ព្ទ' }})</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="font-weight-bold">វេជ្ជបណ្ឌិត (Doctor) <span
                                    class="text-danger">*</span></label>
                            <select id="edit_user_id" name="user_id" class="form-control" required>
                                <option value="">-- ជ្រើសរើសវេជ្ជបណ្ឌិត --</option>
                                @foreach ($doctors as $doc)
                                    <option value="{{ $doc->id }}">
                                        Dr. {{ $doc->name }}
                                        ({{ $doc->specialization ?? 'ទូទៅ' }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="font-weight-bold">កាលបរិច្ឆេទ & ម៉ោងណាត់ (Date & Time) <span
                                    class="text-danger">*</span></label>
                            <input type="datetime-local" id="edit_appointment_date" name="appointment_date"
                                class="form-control" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="font-weight-bold">ស្ថានភាព (Status) <span class="text-danger">*</span></label>
                            <select id="edit_status" name="status" class="form-control" required>
                                <option value="scheduled">បានណាត់ទុក (Scheduled)</option>
                                <option value="completed">បានរួចរាល់ (Completed)</option>
                                <option value="cancelled">បានបោះបង់ (Cancelled)</option>
                            </select>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label class="font-weight-bold">មូលហេតុនៃការណាត់ / រោគសញ្ញា (Reason)</label>
                            <textarea id="edit_reason" name="reason" class="form-control" rows="3"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">បោះបង់</button>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-sync-alt mr-1"></i>
                        កែប្រែទិន្នន័យ</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- ====== Modal Delete Appointment ====== --}}
<div class="modal fade" id="modalDelete" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title font-weight-bold"><i class="fas fa-exclamation-triangle mr-2"></i>
                    បញ្ជាក់ការលុបការណាត់ជួប</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="deleteAppointmentForm" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body text-center p-4">
                    <p class="mb-2 fs-5">តើអ្នកពិតជាចង់លុបការណាត់ជួបរបស់អ្នកជំងឺ <strong id="deletePatientName"
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
                status: $('#filterStatus').val(),
                date: $('#filterDate').val()
            };
        }
        function nowLocalString() {
            const d = new Date();
            d.setSeconds(0, 0);
            const tzOffset = d.getTimezoneOffset() * 60000;
            return new Date(d - tzOffset).toISOString().slice(0, 16);
        }

        $('#modalCreate').on('show.bs.modal', function () {
            $(this).find('input[name="appointment_date"]').attr('min', nowLocalString());
        });

        $('#modalEdit').on('show.bs.modal', function () {
            $('#edit_appointment_date').attr('min', nowLocalString());
        });

        function loadAppointments(page = 1) {
            const params = currentParams(page);
            $('#appointmentTableContainer').css('opacity', '0.5');

            $.ajax({
                url: "{{ route('appointment.index') }}",
                method: 'GET',
                data: params,
                headers: { 'X-Requested-With': 'XMLHttpRequest' },
                success: function (res) {
                    $('#appointmentTableContainer').html(res.html).css('opacity', '1');
                    if (res.total !== undefined) $('#statTotal').text(res.total);
                    if (res.scheduled !== undefined) $('#statScheduled').text(res.scheduled);
                    if (res.completed !== undefined) $('#statCompleted').text(res.completed);
                    if (res.cancelled !== undefined) $('#statCancelled').text(res.cancelled);

                    const qs = $.param(params);
                    history.replaceState(null, '', "{{ route('appointment.index') }}?" + qs);
                },
                error: function () {
                    $('#appointmentTableContainer').css('opacity', '1');
                    console.error('Failed to load appointments.');
                }
            });
        }

        // Debounced search
        $('#search').on('keyup', function () {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(function () {
                loadAppointments(1);
            }, 400);
        });

        // Dropdown & date filters
        $('#filterStatus, #filterDate').on('change', function () {
            loadAppointments(1);
        });

        // AJAX Pagination
        $(document).on('click', '#appointmentTableContainer .pagination a', function (e) {
            e.preventDefault();
            const href = $(this).attr('href');
            if (!href) return;
            const page = new URL(href, window.location.origin).searchParams.get('page') || 1;
            loadAppointments(page);
        });

        // Edit modal fetch & populate
        $(document).on('click', '.btn-edit', function () {
            let id = $(this).data('id');
            $.get("{{ url('appointment/edit') }}/" + id, function (data) {
                $('#edit_patient_id').val(data.patient_id);
                $('#edit_user_id').val(data.user_id);
                $('#edit_appointment_date').val(data.appointment_date);
                $('#edit_status').val(data.status);
                $('#edit_reason').val(data.reason);

                $('#editAppointmentForm').attr('action', "{{ url('appointment/update') }}/" + id);
            }).fail(function () {
                showToast('មិនអាចទាញយកទិន្នន័យការណាត់ជួបបានទេ', 'error');
            });
        });

        // Delete modal assign
        $(document).on('click', '.btn-delete', function () {
            let id = $(this).data('id');
            let name = $(this).data('name');
            $('#deletePatientName').text(name);
            $('#deleteAppointmentForm').attr('action', "{{ url('appointment/delete') }}/" + id);
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
