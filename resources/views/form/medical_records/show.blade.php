@extends('adminlte::page')

@section('title', 'Medical Record Details')

@section('content')

<div class="container-fluid medical-record-show pt-3">

    {{-- PAGE HEADER --}}
    <div class="page-header mb-4">

        <div class="header-left">

            <div class="header-icon">
                <i class="fas fa-file-medical"></i>
            </div>

            <div class="header-text">

                <h2>Medical Record</h2>

                <p>
                    ព័ត៌មានលម្អិតរបស់ Medical Record
                </p>

            </div>

        </div>


        <a href="{{ route('medical-records.index') }}"
           class="back-btn">

            <i class="fas fa-arrow-left mr-1"></i>

            ត្រឡប់ក្រោយ

        </a>

    </div>


    {{-- PATIENT INFORMATION --}}
    <div class="row">

        <div class="col-lg-8 mb-4">

            <div class="record-card">

                <div class="card-header-custom">

                    <div class="card-title-custom">

                        <div class="title-icon">
                            <i class="fas fa-user"></i>
                        </div>

                        <div>

                            <h5>ព័ត៌មានអ្នកជំងឺ</h5>

                            <span>
                                Patient Information
                            </span>

                        </div>

                    </div>

                </div>


                <div class="card-body-custom">

                    <div class="info-grid">

                        <div class="info-item">

                            <span class="info-label">
                                Patient ID
                            </span>

                            <strong>
                                {{ $record->patient->patient_id ?? '-' }}
                            </strong>

                        </div>


                        <div class="info-item">

                            <span class="info-label">
                                ឈ្មោះអ្នកជំងឺ
                            </span>

                            <strong>
                                {{ $record->patient->name ?? '-' }}
                            </strong>

                        </div>


                        <div class="info-item">

                            <span class="info-label">
                                ភេទ
                            </span>

                            <strong>
                                {{ $record->patient->gender ?? '-' }}
                            </strong>

                        </div>


                        <div class="info-item">

                            <span class="info-label">
                                អាយុ
                            </span>

                            <strong>
                                {{ $record->patient->age ?? '-' }}
                            </strong>

                        </div>

                    </div>

                </div>

            </div>


            {{-- MEDICAL INFORMATION --}}
            <div class="record-card mt-4">

                <div class="card-header-custom">

                    <div class="card-title-custom">

                        <div class="title-icon medical-icon">
                            <i class="fas fa-stethoscope"></i>
                        </div>

                        <div>

                            <h5>ព័ត៌មានពិនិត្យជំងឺ</h5>

                            <span>
                                Medical Information
                            </span>

                        </div>

                    </div>

                </div>


                <div class="card-body-custom">

                    <div class="info-grid">

                        <div class="info-item">

                            <span class="info-label">
                                ថ្ងៃចូលពិនិត្យ
                            </span>

                            <strong>
                                {{ $record->visit_date ?? '-' }}
                            </strong>

                        </div>


                        <div class="info-item">

                            <span class="info-label">
                                វេជ្ជបណ្ឌិត
                            </span>

                            <strong>
                                {{ $record->doctor->name ?? '-' }}
                            </strong>

                        </div>

                    </div>


                    <div class="detail-box mt-3">

                        <span class="info-label">
                            Diagnosis
                        </span>

                        <p>
                            {{ $record->diagnosis ?? 'មិនមានទិន្នន័យ' }}
                        </p>

                    </div>


                    <div class="detail-box mt-3">

                        <span class="info-label">
                            Notes
                        </span>

                        <p>
                            {{ $record->notes ?? 'មិនមានទិន្នន័យ' }}
                        </p>

                    </div>

                </div>

            </div>

        </div>


        {{-- VITAL SIGNS --}}
        <div class="col-lg-4 mb-4">

            <div class="record-card">

                <div class="card-header-custom">

                    <div class="card-title-custom">

                        <div class="title-icon vital-icon">
                            <i class="fas fa-heartbeat"></i>
                        </div>

                        <div>

                            <h5>សញ្ញាជីវិត</h5>

                            <span>
                                Vital Signs
                            </span>

                        </div>

                    </div>

                </div>


                <div class="card-body-custom">

                    <div class="vital-item">

                        <div class="vital-icon-small">
                            <i class="fas fa-heartbeat"></i>
                        </div>

                        <div class="vital-info">

                            <span>
                                Blood Pressure
                            </span>

                            <strong>
                                {{ $record->bp_systolic ?? '-' }}
                                /
                                {{ $record->bp_diastolic ?? '-' }}
                                <small>mmHg</small>
                            </strong>

                        </div>

                    </div>


                    <div class="vital-item">

                        <div class="vital-icon-small">
                            <i class="fas fa-heart"></i>
                        </div>

                        <div class="vital-info">

                            <span>
                                Heart Rate
                            </span>

                            <strong>
                                {{ $record->heart_rate ?? '-' }}
                                <small>bpm</small>
                            </strong>

                        </div>

                    </div>


                    <div class="vital-item">

                        <div class="vital-icon-small">
                            <i class="fas fa-lungs"></i>
                        </div>

                        <div class="vital-info">

                            <span>
                                Respiratory Rate
                            </span>

                            <strong>
                                {{ $record->respiratory_rate ?? '-' }}
                                <small>/min</small>
                            </strong>

                        </div>

                    </div>


                    <div class="vital-item">

                        <div class="vital-icon-small">
                            <i class="fas fa-thermometer-half"></i>
                        </div>

                        <div class="vital-info">

                            <span>
                                Temperature
                            </span>

                            <strong>
                                {{ $record->temperature ?? '-' }}
                                <small>°C</small>
                            </strong>

                        </div>

                    </div>


                    <div class="vital-item">

                        <div class="vital-icon-small">
                            <i class="fas fa-lungs-virus"></i>
                        </div>

                        <div class="vital-info">

                            <span>
                                SpO2
                            </span>

                            <strong>
                                {{ $record->spo2 ?? '-' }}
                                <small>%</small>
                            </strong>

                        </div>

                    </div>


                    <div class="vital-item">

                        <div class="vital-icon-small">
                            <i class="fas fa-weight"></i>
                        </div>

                        <div class="vital-info">

                            <span>
                                Weight
                            </span>

                            <strong>
                                {{ $record->weight ?? '-' }}
                                <small>kg</small>
                            </strong>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- FOOTER ACTIONS --}}
    <div class="record-actions">

        <a href="{{ route('medical-records.index') }}"
           class="btn btn-light border">

            <i class="fas fa-arrow-left mr-1"></i>

            ត្រឡប់ទៅបញ្ជី

        </a>


        <a href="{{ route('medical-records.edit', $record->id) }}"
           class="btn btn-success">

            <i class="fas fa-edit mr-1"></i>

            កែប្រែ

        </a>

    </div>

</div>

@stop


@section('css')

<style>

:root {

    --medical-green: #006D36;
    --medical-green-dark: #00552B;
    --medical-green-light: #E8F5EE;
    --medical-bg: #F5F7F6;
    --medical-border: #E7ECE9;
    --medical-text: #1F2A24;
    --medical-muted: #7A8780;

}


body,
.content-wrapper {

    background: var(--medical-bg);

}


/* ============================================================
   PAGE HEADER
============================================================ */

.page-header {

    background: linear-gradient(
        135deg,
        #006D36,
        #008747
    );

    border-radius: 16px;

    padding: 23px 27px;

    display: flex;

    align-items: center;

    justify-content: space-between;

    color: #fff;

    box-shadow:
        0 5px 18px rgba(0,109,54,.15);

}


.header-left {

    display: flex;

    align-items: center;

}


.header-icon {

    width: 56px;
    height: 56px;

    border-radius: 14px;

    background: rgba(255,255,255,.17);

    border: 1px solid rgba(255,255,255,.24);

    display: flex;

    align-items: center;

    justify-content: center;

    font-size: 23px;

    margin-right: 16px;

}


.header-text h2 {

    font-size: 23px;

    font-weight: 700;

    margin: 0 0 4px;

}


.header-text p {

    font-size: 13px;

    opacity: .9;

    margin: 0;

}


.back-btn {

    background: #fff;

    color: var(--medical-green);

    border: 0;

    border-radius: 9px;

    padding: 10px 16px;

    font-size: 12px;

    font-weight: 700;

    text-decoration: none !important;

    transition: all .2s ease;

}


.back-btn:hover {

    background: #F3F7F5;

    color: var(--medical-green-dark);

    transform: translateY(-1px);

}


/* ============================================================
   RECORD CARD
============================================================ */

.record-card {

    background: #fff;

    border: 1px solid var(--medical-border);

    border-radius: 15px;

    overflow: hidden;

    box-shadow:
        0 4px 15px rgba(31,42,36,.05);

}


.card-header-custom {

    padding: 17px 20px;

    border-bottom: 1px solid var(--medical-border);

    background: #fff;

}


.card-title-custom {

    display: flex;

    align-items: center;

}


.title-icon {

    width: 40px;
    height: 40px;

    border-radius: 10px;

    background: var(--medical-green-light);

    color: var(--medical-green);

    display: flex;

    align-items: center;

    justify-content: center;

    margin-right: 11px;

}


.medical-icon {

    background: #E8F5EE;

    color: #006D36;

}


.vital-icon {

    background: #FDECEC;

    color: #C0392B;

}


.card-title-custom h5 {

    color: var(--medical-text);

    font-size: 15px;

    font-weight: 700;

    margin: 0 0 2px;

}


.card-title-custom span {

    color: var(--medical-muted);

    font-size: 10px;

}


.card-body-custom {

    padding: 20px;

}


/* ============================================================
   INFO GRID
============================================================ */

.info-grid {

    display: grid;

    grid-template-columns:
        repeat(2, minmax(0, 1fr));

    gap: 15px;

}


.info-item {

    background: #F8FAF9;

    border: 1px solid var(--medical-border);

    border-radius: 9px;

    padding: 13px;

}


.info-label {

    display: block;

    color: var(--medical-muted);

    font-size: 10px;

    margin-bottom: 5px;

}


.info-item strong {

    display: block;

    color: var(--medical-text);

    font-size: 13px;

    font-weight: 700;

}


.detail-box {

    background: #F8FAF9;

    border: 1px solid var(--medical-border);

    border-radius: 9px;

    padding: 13px;

}


.detail-box p {

    color: var(--medical-text);

    font-size: 12px;

    line-height: 1.7;

    margin: 0;

    white-space: pre-line;

}


/* ============================================================
   VITAL SIGNS
============================================================ */

.vital-item {

    display: flex;

    align-items: center;

    padding: 13px 0;

    border-bottom: 1px solid var(--medical-border);

}


.vital-item:first-child {

    padding-top: 0;

}


.vital-item:last-child {

    border-bottom: 0;

    padding-bottom: 0;

}


.vital-icon-small {

    width: 38px;
    height: 38px;

    border-radius: 9px;

    background: var(--medical-green-light);

    color: var(--medical-green);

    display: flex;

    align-items: center;

    justify-content: center;

    font-size: 14px;

    margin-right: 11px;

}


.vital-info {

    flex: 1;

}


.vital-info span {

    display: block;

    color: var(--medical-muted);

    font-size: 10px;

    margin-bottom: 3px;

}


.vital-info strong {

    display: block;

    color: var(--medical-text);

    font-size: 14px;

    font-weight: 700;

}


.vital-info small {

    color: var(--medical-muted);

    font-size: 9px;

    font-weight: 400;

}


/* ============================================================
   ACTIONS
============================================================ */

.record-actions {

    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 10px;

    margin-bottom: 20px;

}


.record-actions .btn {

    border-radius: 8px;

    font-size: 11px;

    font-weight: 600;

    padding: 8px 14px;

}


.record-actions .btn-success {

    background: var(--medical-green);

    border-color: var(--medical-green);

}


.record-actions .btn-success:hover {

    background: var(--medical-green-dark);

    border-color: var(--medical-green-dark);

}


/* ============================================================
   RESPONSIVE
============================================================ */

@media (max-width: 767.98px) {

    .page-header {

        padding: 18px;

    }


    .header-icon {

        width: 48px;
        height: 48px;

        font-size: 20px;

        margin-right: 12px;

    }


    .header-text h2 {

        font-size: 19px;

    }


    .header-text p {

        font-size: 11px;

    }


    .back-btn {

        padding: 8px 10px;

        font-size: 10px;

    }


    .info-grid {

        grid-template-columns: 1fr;

    }


}


@media (max-width: 575.98px) {

    .medical-record-show {

        padding-left: 5px;

        padding-right: 5px;

    }


    .page-header {

        border-radius: 12px;

    }


    .header-text h2 {

        font-size: 17px;

    }


    .header-text p {

        display: none;

    }


    .back-btn {

        font-size: 0;

    }


    .back-btn i {

        font-size: 13px;

        margin: 0 !important;

    }


    .record-card {

        border-radius: 12px;

    }


    .record-actions {

        flex-direction: column;

        align-items: stretch;

    }


    .record-actions .btn {

        width: 100%;

    }

}

</style>

@stop