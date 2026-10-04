```blade
@extends('adminlte::page')

@section('title', 'កែប្រែព័ត៌មានអ្នកជំងឺ')

@section('content_header')
@stop

@section('content')

@php
    $sex = strtolower(old('sex', $patient->sex));

    $dobText = old(
        'dob_display',
        $patient->date_of_birth
            ? \Carbon\Carbon::parse($patient->date_of_birth)->format('d/m/Y')
            : ''
    );
@endphp

<style>
    :root {
        --clinic-green: #006D36;
        --clinic-green-dark: #00552B;
        --clinic-green-light: #E8F5EE;
        --clinic-bg: #F5F7F6;
        --clinic-border: #E7ECE9;
        --clinic-text: #1F2A24;
        --clinic-muted: #7A8780;
    }

    .edit-patient-container {
        font-family: 'Inter', 'Kantumruuy Pro', sans-serif;
        color: var(--clinic-text);
    }

    .page-header {
        background: linear-gradient(135deg, #006D36 0%, #008747 100%);
        border-radius: 16px;
        padding: 24px 28px;
        margin-bottom: 24px;
        color: #ffffff;
        box-shadow: 0 5px 18px rgba(0, 109, 54, 0.14);
    }

    .page-header h2 {
        font-size: 24px;
        font-weight: 700;
        margin-bottom: 5px;
    }

    .page-header p {
        margin: 0;
        font-size: 13px;
        opacity: 0.88;
    }

    .back-btn {
        background: #ffffff;
        color: var(--clinic-green);
        border: none;
        border-radius: 10px;
        padding: 10px 17px;
        font-weight: 700;
        transition: 0.2s ease;
    }

    .back-btn:hover {
        background: #f3f8f5;
        color: var(--clinic-green-dark);
        transform: translateY(-1px);
    }

    .form-card {
        background: #ffffff;
        border: 1px solid var(--clinic-border);
        border-radius: 15px;
        box-shadow: 0 3px 14px rgba(31, 42, 36, 0.05);
        overflow: hidden;
    }

    .form-card-header {
        min-height: 76px;
        padding: 20px 24px;
        border-bottom: 1px solid var(--clinic-border);
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .form-card-header h6 {
        margin: 0;
        font-size: 15px;
        font-weight: 700;
        color: var(--clinic-text);
    }

    .form-card-header h6 i {
        color: var(--clinic-green);
        margin-right: 8px;
    }

    .header-badge {
        background: var(--clinic-green-light);
        color: var(--clinic-green);
        border: 1px solid #cde8d8;
        border-radius: 20px;
        padding: 5px 11px;
        font-size: 11px;
        font-weight: 700;
    }

    .form-card-body {
        padding: 28px;
    }

    .form-section-title {
        display: flex;
        align-items: center;
        margin-bottom: 22px;
        padding-bottom: 12px;
        border-bottom: 1px solid var(--clinic-border);
    }

    .section-icon {
        width: 36px;
        height: 36px;
        background: var(--clinic-green-light);
        color: var(--clinic-green);
        border-radius: 9px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 10px;
    }

    .form-section-title h6 {
        margin: 0;
        font-weight: 700;
        font-size: 14px;
        color: var(--clinic-text);
    }

    .form-group {
        margin-bottom: 21px;
    }

    .form-group label {
        font-size: 13px;
        font-weight: 700;
        color: var(--clinic-text);
        margin-bottom: 8px;
    }

    .form-control {
        min-height: 44px;
        border: 1px solid #DDE5E0;
        border-radius: 10px;
        font-size: 13px;
        color: var(--clinic-text);
        transition: all 0.2s ease;
        box-shadow: none;
    }

    .form-control:focus {
        border-color: var(--clinic-green);
        box-shadow: 0 0 0 3px rgba(0, 109, 54, 0.08);
    }

    textarea.form-control {
        min-height: 100px;
        resize: vertical;
    }

    select.form-control {
        cursor: pointer;
    }

    .required {
        color: #dc3545;
    }

    .input-icon-wrapper {
        position: relative;
    }

    .input-icon-wrapper .form-control {
        padding-left: 40px;
    }

    .input-icon {
        position: absolute;
        left: 14px;
        top: 14px;
        color: var(--clinic-muted);
        font-size: 13px;
        z-index: 2;
    }

    .dob-help {
        font-size: 11px;
        margin-top: 6px;
        color: var(--clinic-muted);
    }

    #dob_hint {
        font-size: 11px;
        margin-top: 6px;
        min-height: 17px;
    }

    .alert {
        border-radius: 11px;
        border: none;
        font-size: 13px;
    }

    .alert-danger {
        background: #FFF1F1;
        color: #B42318;
    }

    .error-list {
        margin: 0;
        padding-left: 20px;
    }

    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        padding-top: 8px;
        margin-top: 10px;
        border-top: 1px solid var(--clinic-border);
    }

    .btn-save {
        background: var(--clinic-green);
        border-color: var(--clinic-green);
        color: #ffffff;
        border-radius: 10px;
        padding: 10px 20px;
        font-size: 13px;
        font-weight: 700;
        transition: all 0.2s ease;
    }

    .btn-save:hover {
        background: var(--clinic-green-dark);
        border-color: var(--clinic-green-dark);
        color: #ffffff;
        transform: translateY(-1px);
    }

    .btn-cancel {
        background: #ffffff;
        border: 1px solid #D8E0DB;
        color: #5F6B65;
        border-radius: 10px;
        padding: 10px 20px;
        font-size: 13px;
        font-weight: 700;
        transition: all 0.2s ease;
    }

    .btn-cancel:hover {
        background: #F5F7F6;
        color: var(--clinic-text);
    }

    .patient-side-card {
        background: #ffffff;
        border: 1px solid var(--clinic-border);
        border-radius: 15px;
        box-shadow: 0 3px 14px rgba(31, 42, 36, 0.05);
        overflow: hidden;
        height: 100%;
    }

    .side-header {
        background: var(--clinic-green-light);
        padding: 18px 20px;
        border-bottom: 1px solid var(--clinic-border);
    }

    .side-header h6 {
        margin: 0;
        color: var(--clinic-green);
        font-size: 14px;
        font-weight: 700;
    }

    .side-body {
        padding: 22px 20px;
    }

    .side-profile-icon {
        width: 70px;
        height: 70px;
        margin: 0 auto 13px;
        border-radius: 50%;
        background: var(--clinic-green-light);
        color: var(--clinic-green);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 38px;
    }

    .side-name {
        text-align: center;
        font-weight: 700;
        font-size: 16px;
        color: var(--clinic-text);
        margin-bottom: 6px;
    }

    .side-code {
        display: block;
        text-align: center;
        color: var(--clinic-green);
        font-size: 11px;
        font-weight: 700;
        margin-bottom: 20px;
    }

    .side-info {
        border-top: 1px solid var(--clinic-border);
    }

    .side-info-item {
        display: flex;
        justify-content: space-between;
        gap: 10px;
        padding: 12px 0;
        border-bottom: 1px solid var(--clinic-border);
        font-size: 12px;
    }

    .side-info-item:last-child {
        border-bottom: none;
    }

    .side-label {
        color: var(--clinic-muted);
    }

    .side-value {
        color: var(--clinic-text);
        font-weight: 700;
        text-align: right;
        word-break: break-word;
    }

    @media (max-width: 991.98px) {
        .page-header {
            padding: 20px;
        }

        .page-header h2 {
            font-size: 21px;
        }

        .patient-side-card {
            margin-bottom: 20px;
        }
    }

    @media (max-width: 767.98px) {
        .page-header {
            padding: 18px;
        }

        .page-header .d-flex {
            display: block !important;
        }

        .page-header h2 {
            font-size: 19px;
        }

        .back-btn {
            margin-top: 15px;
        }

        .form-card-body {
            padding: 20px 16px;
        }

        .form-card-header {
            padding: 17px 16px;
        }

        .form-card-header .header-badge {
            display: none;
        }

        .form-actions {
            display: block;
        }

        .btn-save,
        .btn-cancel {
            width: 100%;
            margin-bottom: 8px;
        }
    }
</style>

<div class="edit-patient-container">

    {{-- Page Header --}}
    <div class="page-header">

        <div class="d-flex justify-content-between align-items-center">

            <div>
                <h2>
                    <i class="fas fa-user-edit mr-2"></i>
                    កែប្រែព័ត៌មានអ្នកជំងឺ
                </h2>

                <p>
                    កែប្រែ និងធ្វើបច្ចុប្បន្នភាពព័ត៌មានរបស់អ្នកជំងឺ
                </p>
            </div>

            <div>
                <a href="{{ route('patients.index') }}" class="btn back-btn">
                    <i class="fas fa-arrow-left mr-1"></i>
                    ត្រឡប់ក្រោយ
                </a>
            </div>

        </div>

    </div>

    <div class="row">

        {{-- Patient Summary --}}
        <div class="col-lg-4 col-md-5 mb-4">

            <div class="patient-side-card">

                <div class="side-header">
                    <h6>
                        <i class="fas fa-user-circle mr-2"></i>
                        ព័ត៌មានអ្នកជំងឺ
                    </h6>
                </div>

                <div class="side-body">

                    <div class="side-profile-icon">
                        <i class="fas fa-user"></i>
                    </div>

                    <div class="side-name">
                        {{ $patient->full_name }}
                    </div>

                    <div class="side-code">
                        <i class="fas fa-id-badge mr-1"></i>
                        {{ $patient->patient_code }}
                    </div>

                    <div class="side-info">

                        <div class="side-info-item">
                            <span class="side-label">
                                <i class="fas fa-venus-mars mr-1"></i>
                                ភេទ
                            </span>

                            <span class="side-value">
                                {{ $patient->sex == 'Male' ? 'ប្រុស' : ($patient->sex == 'Female' ? 'ស្រី' : 'ផ្សេងៗ') }}
                            </span>
                        </div>

                        <div class="side-info-item">
                            <span class="side-label">
                                <i class="fas fa-phone mr-1"></i>
                                ទូរសព្ទ
                            </span>

                            <span class="side-value">
                                {{ $patient->phone ?? '-' }}
                            </span>
                        </div>

                        <div class="side-info-item">
                            <span class="side-label">
                                <i class="fas fa-id-card mr-1"></i>
                                ID Card
                            </span>

                            <span class="side-value">
                                {{ $patient->id_card ?? '-' }}
                            </span>
                        </div>

                    </div>

                </div>

            </div>

        </div>

        {{-- Edit Form --}}
        <div class="col-lg-8 col-md-7 mb-4">

            <div class="form-card">

                <div class="form-card-header">

                    <h6>
                        <i class="fas fa-edit"></i>
                        ព័ត៌មានដែលត្រូវកែប្រែ
                    </h6>

                    <span class="header-badge">
                        <i class="fas fa-user-edit mr-1"></i>
                        Edit Patient
                    </span>

                </div>

                <div class="form-card-body">

                    {{-- Validation Errors --}}
                    @if ($errors->any())
                        <div class="alert alert-danger mb-4">
                            <div class="font-weight-bold mb-2">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                សូមពិនិត្យព័ត៌មានខាងក្រោម
                            </div>

                            <ul class="error-list">
                                @foreach ($errors->all() as $e)
                                    <li>{{ $e }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Session Error --}}
                    @if (session('error'))
                        <div class="alert alert-danger mb-4">
                            <i class="fas fa-exclamation-circle mr-1"></i>
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ route('patients.update', $patient->patient_id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        {{-- Personal Information --}}
                        <div class="form-section-title">

                            <div class="section-icon">
                                <i class="fas fa-user"></i>
                            </div>

                            <h6>ព័ត៌មានផ្ទាល់ខ្លួន</h6>

                        </div>

                        <div class="row">

                            {{-- Full Name --}}
                            <div class="col-md-6">

                                <div class="form-group">

                                    <label>
                                        ឈ្មោះអ្នកជំងឺ
                                        <span class="required">*</span>
                                    </label>

                                    <div class="input-icon-wrapper">
                                        <i class="fas fa-user input-icon"></i>

                                        <input
                                            type="text"
                                            name="full_name"
                                            class="form-control"
                                            value="{{ old('full_name', $patient->full_name) }}"
                                            placeholder="បញ្ចូលឈ្មោះអ្នកជំងឺ"
                                            required
                                        >
                                    </div>

                                </div>

                            </div>

                            {{-- ID Card --}}
                            <div class="col-md-6">

                                <div class="form-group">

                                    <label>
                                        អត្តសញ្ញាណប័ណ្ណ (ID Card)
                                        <span class="required">*</span>
                                    </label>

                                    <div class="input-icon-wrapper">
                                        <i class="fas fa-id-card input-icon"></i>

                                        <input
                                            type="text"
                                            name="id_card"
                                            class="form-control"
                                            value="{{ old('id_card', $patient->id_card) }}"
                                            placeholder="បញ្ចូលលេខអត្តសញ្ញាណប័ណ្ណ"
                                            required
                                        >
                                    </div>

                                </div>

                            </div>

                            {{-- Date of Birth --}}
                            <div class="col-md-6">

                                <div class="form-group">

                                    <label>
                                        ថ្ងៃខែឆ្នាំកំណើត
                                        <span class="required">*</span>
                                    </label>

                                    <div class="input-icon-wrapper">

                                        <i class="fas fa-calendar-alt input-icon"></i>

                                        <input
                                            type="text"
                                            id="dob_display"
                                            name="dob_display"
                                            class="form-control"
                                            placeholder="ថ្ងៃ/ខែ/ឆ្នាំ (ឧ. 15/03/1990)"
                                            inputmode="numeric"
                                            maxlength="10"
                                            autocomplete="off"
                                            required
                                            value="{{ $dobText }}"
                                        >

                                    </div>

                                    <input
                                        type="hidden"
                                        name="date_of_birth"
                                        id="dob_value"
                                    >

                                    <small class="dob-help">
                                        <i class="fas fa-info-circle mr-1"></i>
                                        សូមបញ្ចូលជា ថ្ងៃ/ខែ/ឆ្នាំ
                                    </small>

                                    <small id="dob_hint" class="form-text"></small>

                                </div>

                            </div>

                            {{-- Gender --}}
                            <div class="col-md-6">

                                <div class="form-group">

                                    <label>
                                        ភេទ
                                        <span class="required">*</span>
                                    </label>

                                    <div class="input-icon-wrapper">

                                        <i class="fas fa-venus-mars input-icon"></i>

                                        <select name="sex" class="form-control" required>

                                            <option value="male" {{ $sex === 'male' ? 'selected' : '' }}>
                                                ប្រុស
                                            </option>

                                            <option value="female" {{ $sex === 'female' ? 'selected' : '' }}>
                                                ស្រី
                                            </option>

                                            <option value="other" {{ $sex === 'other' ? 'selected' : '' }}>
                                                ផ្សេងៗ
                                            </option>

                                        </select>

                                    </div>

                                </div>

                            </div>

                            {{-- Phone --}}
                            <div class="col-md-6">

                                <div class="form-group">

                                    <label>
                                        លេខទូរសព្ទ
                                        <span class="required">*</span>
                                    </label>

                                    <div class="input-icon-wrapper">
                                        <i class="fas fa-phone input-icon"></i>

                                        <input
                                            type="text"
                                            name="phone"
                                            class="form-control"
                                            value="{{ old('phone', $patient->phone) }}"
                                            placeholder="បញ្ចូលលេខទូរសព្ទ"
                                            required
                                        >
                                    </div>

                                </div>

                            </div>

                        </div>

                        {{-- Address --}}
                        <div class="form-group">

                            <label>
                                អាសយដ្ឋាន
                                <span class="required">*</span>
                            </label>

                            <div class="input-icon-wrapper">

                                <i class="fas fa-map-marker-alt input-icon"></i>

                                <textarea
                                    name="address"
                                    class="form-control"
                                    placeholder="បញ្ចូលអាសយដ្ឋានអ្នកជំងឺ"
                                    required
                                >{{ old('address', $patient->address) }}</textarea>

                            </div>

                        </div>

                        {{-- Actions --}}
                        <div class="form-actions">

                            <a
                                href="{{ route('patients.index') }}"
                                class="btn btn-cancel"
                            >
                                <i class="fas fa-times mr-1"></i>
                                បោះបង់
                            </a>

                            <button
                                type="submit"
                                class="btn btn-save"
                            >
                                <i class="fas fa-save mr-1"></i>
                                រក្សាទុកការកែប្រែ
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@stop

@section('js')
<script>
    (function () {

        const display = document.getElementById('dob_display');
        const value = document.getElementById('dob_value');
        const hint = document.getElementById('dob_hint');

        const pad = n => String(n).padStart(2, '0');

        function check(text) {

            value.value = '';

            display.setCustomValidity('');

            hint.textContent = '';
            hint.className = 'form-text';

            if (text.length === 0) {
                return;
            }

            if (text.length < 10) {

                display.setCustomValidity(
                    'សូមបញ្ចូលជាទម្រង់ ថ្ងៃ/ខែ/ឆ្នាំ'
                );

                return;
            }

            const parts = text.split('/');

            if (parts.length !== 3) {

                display.setCustomValidity(
                    'ថ្ងៃខែឆ្នាំកំណើតមិនត្រឹមត្រូវ'
                );

                return;
            }

            const dd = Number(parts[0]);
            const mm = Number(parts[1]);
            const yyyy = Number(parts[2]);

            const d = new Date(yyyy, mm - 1, dd);
            const today = new Date();

            const valid =
                yyyy >= 1900 &&
                d.getFullYear() === yyyy &&
                d.getMonth() === mm - 1 &&
                d.getDate() === dd &&
                d <= today;

            if (!valid) {

                display.setCustomValidity(
                    'ថ្ងៃខែឆ្នាំកំណើតមិនត្រឹមត្រូវ'
                );

                hint.textContent =
                    'ថ្ងៃខែឆ្នាំមិនត្រឹមត្រូវ';

                hint.className =
                    'form-text text-danger';

                return;
            }

            value.value =
                yyyy + '-' +
                pad(mm) + '-' +
                pad(dd);

            let age =
                today.getFullYear() - yyyy;

            if (
                today <
                new Date(
                    today.getFullYear(),
                    mm - 1,
                    dd
                )
            ) {
                age--;
            }

            hint.textContent =
                'អាយុ ' + age + ' ឆ្នាំ';

            hint.className =
                'form-text text-success';
        }

        display.addEventListener('input', function () {

            const d = this.value
                .replace(/\D/g, '')
                .slice(0, 8);

            let out = d;

            if (d.length > 4) {

                out =
                    d.slice(0, 2) +
                    '/' +
                    d.slice(2, 4) +
                    '/' +
                    d.slice(4);

            } else if (d.length > 2) {

                out =
                    d.slice(0, 2) +
                    '/' +
                    d.slice(2);
            }

            this.value = out;

            check(out);
        });

        // Fill hidden date field using existing saved date
        check(display.value);

    })();
</script>
@stop
```
