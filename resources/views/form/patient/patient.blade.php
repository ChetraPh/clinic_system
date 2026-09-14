@extends('adminlte::page')
@section('title', 'ព័ត៌មានអ្នកជំងឺ')

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
</div>
@stop

@section('content')
<div class="container-fluid">
    {{-- Info Boxes --}}
    <div class="row mb-3">
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box shadow-sm border-0 rounded-lg">
                <span class="info-box-icon bg-light text-success"><i class="fas fa-users"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text text-muted small">អ្នកជំងឺសរុបថ្ងៃនេះ</span>
                    <span class="info-box-number text-dark h4 mb-0">{{ $todayCount ?? 0 }} នាក់</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box shadow-sm border-0 rounded-lg">
                <span class="info-box-icon bg-light text-info"><i class="fas fa-user-plus"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text text-muted small">អ្នកជំងឺថ្មី</span>
                    <span class="info-box-number text-dark h4 mb-0">{{ $newPatients ?? 0 }} នាក់</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box shadow-sm border-0 rounded-lg">
                <span class="info-box-icon bg-light text-danger"><i class="fas fa-history"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text text-muted small">អ្នកជំងឺចាស់</span>
                    <span class="info-box-number text-dark h4 mb-0">{{ $oldPatients ?? 0 }} នាក់</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box shadow-sm border-0 rounded-lg">
                <span class="info-box-icon bg-light text-warning"><i class="fas fa-hourglass-half"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text text-muted small">អ្នកជំងឺកំពុងរង់ចាំ</span>
                    <span class="info-box-number text-warning h4 mb-0">{{ $waitingCount ?? 0 }} នាក់</span>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-9">

            {{-- Navigation Tabs --}}
            <ul class="nav nav-tabs mb-3 border-bottom-0" id="patientTab" role="tablist">
                <li class="nav-item mr-2">
                    <a class="nav-link active font-weight-bold px-4 py-2 rounded-top border text-success bg-white shadow-sm"
                        id="list-tab" data-toggle="tab" href="#patient-list" role="tab" aria-controls="patient-list"
                        aria-selected="true">
                        <i class="fas fa-list mr-1"></i> បញ្ជីអ្នកជំងឺ
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link font-weight-bold px-4 py-2 rounded-top border text-secondary bg-light"
                        id="create-tab" data-toggle="tab" href="#patient-create" role="tab"
                        aria-controls="patient-create" aria-selected="false">
                        <i class="fas fa-user-plus mr-1"></i> ចុះឈ្មោះអ្នកជំងឺថ្មី
                    </a>
                </li>
            </ul>

            <div class="tab-content" id="patientTabContent">
                {{-- Tab ទី១: បញ្ជីអ្នកជំងឺ និង តារាង Filter --}}
                <div class="tab-pane fade show active" id="patient-list" role="tabpanel" aria-labelledby="list-tab">
                    <div class="card border-0 shadow-sm rounded-lg">
                        <div class="card-body p-3">
                            @if(session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            {{-- Filter Form --}}
                            <form id="searchForm" method="GET" action="{{ route('patients.index') }}"
                                class="row g-2 mb-3">
                                <div class="col-md-4">
                                    <label class="small text-muted mb-1">ស្វែងរកអ្នកជំងឺ</label>
                                    <input type="text" id="searchInput" name="search"
                                        class="form-control form-control-sm bg-light border-0"
                                        placeholder="ឈ្មោះ, ID, លេខទូរស័ព្ទ..." value="{{ request('search') }}"
                                        autocomplete="off">
                                </div>
                                <div class="col-md-3">
                                    <label class="small text-muted mb-1">កាលបរិច្ឆេទ</label>
                                    <input type="date" id="dateInput" name="date"
                                        class="form-control form-control-sm bg-light border-0"
                                        value="{{ request('date') }}">
                                </div>
                                <div class="col-md-3">
                                    <label class="small text-muted mb-1">ភេទ</label>
                                    <select id="genderInput" name="gender"
                                        class="form-control form-control-sm bg-light border-0">
                                        <option value="">ទាំងអស់</option>
                                        <option value="Male" {{ request('gender') == 'Male' || request('gender') == 'male' ? 'selected' : '' }}>ប្រុស</option>
                                        <option value="Female" {{ request('gender') == 'Female' || request('gender') == 'female' ? 'selected' : '' }}>ស្រី</option>
                                    </select>
                                </div>
                                <div class="col-md-2 d-flex align-items-end">
                                    <button type="submit" class="btn btn-sm btn-primary btn-block font-weight-bold">
                                        <i class="fas fa-filter mr-1"></i> Filter
                                    </button>
                                </div>
                            </form>

                            <div class="table-responsive">
                                <table class="table table-hover align-middle border-0">
                                    <thead class="bg-light">
                                        <tr class="text-secondary small">
                                            <th>លេខសម្គាល់</th>
                                            <th>ឈ្មោះពេញ</th>
                                            <th>ភេទ</th>
                                            <th>ថ្ងៃខែឆ្នាំកំណើត</th>
                                            <th>លេខទូរស័ព្ទ</th>
                                            <th>ថ្ងៃចុះឈ្មោះ</th>
                                            <th>សកម្មភាព</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($patients as $patient)
                                            <tr>
                                                <td class="font-weight-bold text-dark">{{ $patient->patient_code }}</td>
                                                <td class="font-weight-bold">{{ $patient->full_name }}</td>
                                                <td>{{ strtolower($patient->sex) == 'male' ? 'ប្រុស' : 'ស្រី' }}</td>
                                                <td>{{ $patient->date_of_birth ? \Carbon\Carbon::parse($patient->date_of_birth)->format('Y-m-d') : '-' }}
                                                </td>
                                                <td>{{ $patient->phone ?? '-' }}</td>
                                                <td>{{ $patient->created_at ? $patient->created_at->format('d/m/Y') : '-' }}
                                                </td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button type="button" class="btn btn-sm btn-light"
                                                            data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false" title="សកម្មភាព">
                                                            <i class="fas fa-ellipsis-h"></i>
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a href="{{ route('patients.show', $patient->patient_id) }}"
                                                                class="dropdown-item">
                                                                <i class="fas fa-eye mr-2 text-info"></i> មើលព័ត៌មាន
                                                            </a>
                                                            <a href="{{ route('patients.print', $patient->patient_id) }}"
                                                                target="_blank" class="dropdown-item">
                                                                <i class="fas fa-print mr-2 text-success"></i> បោះពុម្ព
                                                            </a>
                                                            <a href="{{ route('patients.edit', $patient->patient_id) }}"
                                                                class="dropdown-item">
                                                                <i class="fas fa-edit mr-2 text-primary"></i> កែប្រែ
                                                            </a>
                                                            <button type="button"
                                                                class="dropdown-item text-danger btn-delete-patient"
                                                                data-id="{{ $patient->patient_id }}"
                                                                data-name="{{ $patient->full_name }}" data-toggle="modal"
                                                                data-target="#modalDeletePatient">

                                                                <i class="fas fa-trash mr-2"></i> លុប
                                                            </button>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center text-muted py-4">
                                                    មិនទាន់មានទិន្នន័យអ្នកជំងឺឡើយ</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-end mt-2">
                                {{ $patients->appends(request()->query())->links() }}
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Tab ទី២: ទម្រង់ចុះឈ្មោះអ្នកជំងឺថ្មី --}}
                <div class="tab-pane fade" id="patient-create" role="tabpanel" aria-labelledby="create-tab">
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-3">
                            <ul class="mb-0 font-weight-bold">
                                @foreach ($errors->all() as $error)
                                    <li><i class="fas fa-exclamation-circle mr-1"></i> {{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-3">
                            <i class="fas fa-exclamation-triangle mr-2"></i> {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('patients.store') }}">
                        @csrf
                        <div class="card border-0 shadow-sm rounded-lg overflow-hidden">
                            <div
                                class="card-header bg-white border-bottom py-3 d-flex justify-content-between align-items-center">
                                <h5 class="card-title font-weight-bold m-0 text-success">ព័ត៌មានអ្នកជំងឺ
                                    (ត្រូវបំពេញគ្រប់ចន្លោះ)</h5>
                                <span class="badge badge-primary px-3 py-1">NEW RECORD</span>
                            </div>
                            <div class="card-body bg-light p-4">
                                <div class="row bg-white p-3 rounded shadow-sm mb-4">
                                    <div class="col-md-6 form-group">
                                        <label class="small font-weight-bold text-secondary">ឈ្មោះពេញ (Full Name) <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="full_name" class="form-control border-light-gray"
                                            placeholder="បញ្ចូលឈ្មោះពេញ..." required value="{{ old('full_name') }}">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label class="small font-weight-bold text-secondary">លេខអត្តសញ្ញាណប័ណ្ណ / ID
                                            Card <span class="text-danger">*</span></label>
                                        <input type="text" name="id_card" class="form-control border-light-gray"
                                            placeholder="បញ្ចូលលេខអត្តសញ្ញាណប័ណ្ណ..." required
                                            value="{{ old('id_card') }}">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label class="small font-weight-bold text-secondary">ថ្ងៃខែឆ្នាំកំណើត <span
                                                class="text-danger">*</span></label>
                                        <input type="date" name="date_of_birth" class="form-control border-light-gray"
                                            required value="{{ old('date_of_birth') }}">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label class="small font-weight-bold text-secondary">ភេទ <span
                                                class="text-danger">*</span></label>
                                        <select name="sex" class="form-control border-light-gray" required>
                                            <option value="" disabled selected>ជ្រើសរើសភេទ</option>
                                            <option value="male" {{ old('sex') == 'male' ? 'selected' : '' }}>ប្រុស
                                            </option>
                                            <option value="female" {{ old('sex') == 'female' ? 'selected' : '' }}>ស្រី
                                            </option>
                                            <option value="other" {{ old('sex') == 'other' ? 'selected' : '' }}>ផ្សេងៗ
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label class="small font-weight-bold text-secondary">លេខទំនាក់ទំនង <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="phone" class="form-control border-light-gray"
                                            placeholder="បញ្ចូលលេខទូរស័ព្ទ..." required value="{{ old('phone') }}">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label class="small font-weight-bold text-secondary">អាសយដ្ឋាន <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="address" class="form-control border-light-gray"
                                            placeholder="បញ្ចូលអាសយដ្ឋានបច្ចុប្បន្ន..." required
                                            value="{{ old('address') }}">
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button type="reset" class="btn btn-light border px-4 mr-2">Clear Form</button>
                                    <button type="submit" class="btn btn-success px-5 font-weight-bold shadow-sm"
                                        style="background-color: #00695c; border-color: #00695c;">
                                        <i class="fas fa-save mr-2"></i> ចុះឈ្មោះអ្នកជំងឺ
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Sidebar ជួររង់ចាំ --}}
        <div class="col-lg-3">
            <div class="card border-0 shadow-sm rounded-lg overflow-hidden">
                <div class="card-header bg-success py-3 d-flex justify-content-between align-items-center"
                    style="background-color: #00695c !important;">
                    <h6 class="font-weight-bold mb-0 text-white"><i class="fas fa-clock mr-2"></i> ជួររង់ចាំផ្ទាល់ (Live
                        Queue)</h6>
                    <span
                        class="badge badge-light text-success font-weight-bold">{{ isset($waitingPatients) ? $waitingPatients->count() : 0 }}
                        នាក់</span>
                </div>
                <div class="card-body p-3 bg-light" style="max-height: 520px; overflow-y: auto;">
                    @forelse($waitingPatients ?? [] as $record)
                        <div class="card border-0 shadow-sm mb-2 rounded-lg">
                            <div class="card-body p-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="font-weight-bold mb-1 text-dark">
                                            {{ $record->patient->full_name ?? 'N/A' }}
                                        </h6>
                                        <small class="text-muted"><i class="fas fa-id-badge mr-1"></i>
                                            {{ $record->patient->patient_code ?? 'N/A' }}</small>
                                    </div>
                                    <span
                                        class="badge badge-success px-2 py-1">{{ $record->created_at ? $record->created_at->diffForHumans() : '' }}</span>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-5">
                            <i class="fas fa-users-slash fa-3x text-secondary mb-3"></i>
                            <p class="text-muted small">មិនទាន់មានអ្នកជំងឺរង់ចាំឡើយ</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Delete Patient Modal --}}
<div class="modal fade" id="modalDeletePatient" tabindex="-1" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content border-0 shadow-lg">

            <div class="modal-header border-0 bg-danger text-white">
                <h5 class="modal-title font-weight-bold">
                    <i class="fas fa-exclamation-triangle mr-2"></i>
                    បញ្ជាក់ការលុប
                </h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body text-center">

                <i class="fas fa-trash-alt text-danger mb-3" style="font-size: 45px;"></i>

                <h5 class="font-weight-bold">
                    តើអ្នកពិតជាចង់លុបទិន្នន័យនេះមែនទេ?
                </h5>

                <p class="text-muted mb-0">
                    អ្នកជំងឺ:
                    <strong id="deletePatientName"></strong>
                </p>

                <small class="text-danger">
                    សកម្មភាពនេះមិនអាចត្រឡប់វិញបានទេ។
                </small>

            </div>

            <div class="modal-footer border-0 justify-content-center">

                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fas fa-times mr-1"></i>
                    បោះបង់
                </button>

                <form id="formDeletePatient" method="POST" class="d-inline">

                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash mr-1"></i>
                        លុប
                    </button>

                </form>

            </div>

        </div>
    </div>
</div>
@stop

@section('css')
<style>
    .border-light-gray {
        border: 1px solid #e9ecef !important;
    }

    .card-title {
        font-size: 1rem;
    }

    input::placeholder {
        font-size: 0.85rem;
        color: #adb5bd;
    }

    .nav-tabs .nav-link {
        border: 1px solid #dee2e6;
        border-top-left-radius: 0.25rem;
        border-top-right-radius: 0.25rem;
        background-color: #f8f9fa;
        color: #6c757d;
    }

    .nav-tabs .nav-link.active {
        color: #28a745 !important;
        background-color: #fff !important;
        border-bottom-color: #fff !important;
    }

    .pagination {
        font-size: 0.875rem;
    }

    .pagination .page-item .page-link {
        padding: 0.4rem 0.75rem;
        color: #28a745;
    }

    .pagination .page-item.active .page-link {
        background-color: #28a745 !important;
        border-color: #28a745 !important;
        color: #fff !important;
    }

    .pagination .page-item .page-link:hover {
        color: #1e7e34;
    }
</style>
@stop

@section('js')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('searchForm');
        const searchInput = document.getElementById('searchInput');
        const dateInput = document.getElementById('dateInput');
        const genderInput = document.getElementById('genderInput');

        let timer;

        if (searchInput) {
            searchInput.addEventListener('input', function () {
                clearTimeout(timer);
                timer = setTimeout(function () {
                    form.submit();
                }, 500);
            });

            if (searchInput.value) {
                const val = searchInput.value;
                searchInput.focus();
                searchInput.value = '';
                searchInput.value = val;
            }
        }

        if (dateInput) {
            dateInput.addEventListener('change', function () {
                form.submit();
            });
        }

        if (genderInput) {
            genderInput.addEventListener('change', function () {
                form.submit();
            });
        }
    });
</script>
@stop