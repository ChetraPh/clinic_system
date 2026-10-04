<div class="prescription-table-wrapper">

    <div class="table-responsive">

        <table class="table prescription-table align-middle mb-0">

            <thead>
                <tr>
                    <th class="prescription-id-col">
                        ល.រ
                    </th>

                    <th>
                        កាលបរិច្ឆេទ
                    </th>

                    <th>
                        អ្នកជំងឺ
                    </th>

                    <th>
                        វេជ្ជបណ្ឌិត
                    </th>

                    <th>
                        បញ្ជីថ្នាំដែលត្រូវប្រើ
                    </th>

                    <th class="text-center">
                        សកម្មភាព
                    </th>
                </tr>
            </thead>


            <tbody>

                @forelse ($prescriptions as $pres)

                    <tr>

                        {{-- ID --}}
                        <td>

                            <span class="prescription-id">
                                #{{ $pres->prescription_id }}
                            </span>

                        </td>


                        {{-- DATE --}}
                        <td>

                            <div class="prescription-date">

                                <div class="date-main">

                                    <i class="far fa-calendar-alt"></i>

                                    {{ $pres->prescribed_date
                                        ? $pres->prescribed_date->format('d M, Y')
                                        : '-' }}

                                </div>

                                @if($pres->prescribed_date)

                                    <small>
                                        {{ $pres->prescribed_date->format('h:i A') }}
                                    </small>

                                @endif

                            </div>

                        </td>


                        {{-- PATIENT --}}
                        <td>

                            <div class="patient-info">

                                <div class="patient-name">

                                    <div class="patient-avatar">
                                        <i class="fas fa-user"></i>
                                    </div>

                                    <span>
                                        {{ $pres->medicalRecord && $pres->medicalRecord->patient
                                            ? $pres->medicalRecord->patient->full_name
                                            : 'N/A' }}
                                    </span>

                                </div>


                                @if($pres->medicalRecord && $pres->medicalRecord->patient)

                                    <div class="patient-phone">

                                        <i class="fas fa-phone-alt"></i>

                                        {{ $pres->medicalRecord->patient->phone ?: '-' }}

                                    </div>

                                @else

                                    <div class="patient-phone">
                                        -
                                    </div>

                                @endif

                            </div>

                        </td>


                        {{-- DOCTOR --}}
                        <td>

                            <div class="doctor-info">

                                <div class="doctor-name">

                                    <div class="doctor-avatar">
                                        <i class="fas fa-user-md"></i>
                                    </div>

                                    <span>
                                        {{ $pres->medicalRecord && $pres->medicalRecord->doctor
                                            ? $pres->medicalRecord->doctor->name
                                            : 'N/A' }}
                                    </span>

                                </div>

                            </div>

                        </td>


                        {{-- PRESCRIPTION ITEMS --}}
                        <td>

                            <div class="prescription-items">

                                @forelse ($pres->items as $item)

                                    <div class="medicine-item">

                                        <div class="medicine-item-top">

                                            <span class="medicine-name">

                                                <i class="fas fa-pills"></i>

                                                {{ $item->medicine
                                                    ? $item->medicine->medicine_name
                                                    : 'Medicine #' . $item->medicine_id }}

                                            </span>

                                            <span class="medicine-quantity">

                                                {{ $item->quantity }}

                                                {{ $item->medicine
                                                    ? $item->medicine->unit
                                                    : 'unit' }}

                                            </span>

                                        </div>


                                        <div class="medicine-details">

                                            <span>
                                                <i class="fas fa-prescription-bottle-alt"></i>
                                                {{ $item->dosage }}
                                            </span>

                                            <span>
                                                <i class="fas fa-clock"></i>
                                                {{ $item->frequency }}
                                            </span>

                                            <span>
                                                <i class="fas fa-calendar-day"></i>
                                                {{ $item->duration_days }} ថ្ងៃ
                                            </span>

                                        </div>

                                    </div>

                                @empty

                                    <span class="text-muted small">
                                        មិនមានថ្នាំ
                                    </span>

                                @endforelse

                            </div>

                        </td>


                        {{-- ACTION --}}
                        <td class="text-center">

                            @if ($pres->status === 'dispensed')

                                <span class="dispensed-badge">

                                    <i class="fas fa-check-circle"></i>

                                    បានចេញថ្នាំរួច

                                </span>

                            @else

                                <form
                                    action="{{ route('pharmacy.prescriptions.dispense', $pres->prescription_id) }}"
                                    method="POST"
                                    class="d-inline">

                                    @csrf

                                    <button
                                        type="submit"
                                        class="btn btn-dispense"
                                        onclick="return confirm('តើអ្នកពិតជាចង់ចេញថ្នាំតាមវេជ្ជបញ្ជានេះមែនទេ? (Confirm Dispense)');">

                                        <i class="fas fa-pills"></i>

                                        <span>
                                            ចេញថ្នាំ
                                        </span>

                                    </button>

                                </form>

                            @endif

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td
                            colspan="6"
                            class="prescription-empty">

                            <div class="empty-icon">
                                <i class="fas fa-prescription"></i>
                            </div>

                            <div class="empty-title">
                                មិនមានទិន្នន័យវេជ្ជបញ្ជាទេ
                            </div>

                            <div class="empty-text">
                                No Prescriptions Found
                            </div>

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>


    {{-- PAGINATION --}}

    @if($prescriptions->hasPages())

        <div class="prescription-pagination">

            {!! $prescriptions
                ->appends(request()->query())
                ->links('pagination::bootstrap-4') !!}

        </div>

    @endif

</div>