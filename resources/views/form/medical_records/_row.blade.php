<tr id="row-{{ $record->record_id }}"
    data-record="{{ json_encode($record->toModalData(), JSON_UNESCAPED_UNICODE) }}">

    <td class="align-middle">
        <span class="font-weight-bold" style="color: #006D36;">
            #MR-{{ $record->record_id }}
        </span>
    </td>

    <td class="align-middle">
        <div class="d-flex align-items-center">
            <div class="d-flex align-items-center justify-content-center mr-3"
                 style="width: 38px; height: 38px; min-width: 38px; border-radius: 11px; background: #E8F5EE; color: #006D36;">
                <i class="fas fa-user-injured"></i>
            </div>

            <div>
                <span class="d-block font-weight-bold" style="color: #1F2A24;">
                    {{ $record->patient->full_name ?? 'N/A' }}
                </span>
                <small style="color: #7A8780;">
                    {{ $record->patient->patient_code ?? '-' }}
                </small>
            </div>
        </div>
    </td>

    <td class="align-middle">
        <div class="d-flex align-items-center" style="color: #49564E;">
            <i class="far fa-calendar-alt mr-2" style="color: #006D36;"></i>
            <span>
                {{ $record->visit_date ? $record->visit_date->format('d/m/Y H:i') : '-' }}
            </span>
        </div>
    </td>

    <td class="align-middle">
        <div style="line-height: 1.8;">
            <small class="d-block" style="color: #49564E;">
                <i class="fas fa-heartbeat mr-1" style="color: #006D36;"></i>
                <strong>BP:</strong>
                {{ $record->bp_systolic ?? '-' }}/{{ $record->bp_diastolic ?? '-' }} mmHg
            </small>

            <small class="d-block" style="color: #7A8780;">
                <i class="fas fa-thermometer-half mr-1" style="color: #006D36;"></i>
                <strong>HR:</strong> {{ $record->heart_rate ?? '-' }} bpm
                <span class="mx-1">|</span>
                <strong>Temp:</strong> {{ $record->temperature ?? '-' }}°C
            </small>
        </div>
    </td>

    <td class="align-middle">
        <span class="d-inline-block px-3 py-2"
              style="background: #E8F5EE; color: #006D36; border-radius: 9px; font-size: 12px; font-weight: 600;">
            {{ Str::limit($record->diagnosis ?? 'មិនទាន់មាន', 30) }}
        </span>
    </td>

    <td class="align-middle">
        <div class="d-flex align-items-center">
            <i class="fas fa-user-md mr-2" style="color: #006D36;"></i>
            <span style="color: #49564E;">
                {{ $record->doctor->name ?? 'N/A' }}
            </span>
        </div>
    </td>

    <td class="align-middle">
        <div class="d-flex align-items-center" style="gap: 7px;">

            <button type="button"
                    class="btn btn-sm btn-view"
                    title="មើលព័ត៌មាន"
                    style="width: 34px; height: 34px; border-radius: 9px; background: #E8F5EE; color: #006D36;">
                <i class="fas fa-eye"></i>
            </button>

            <button type="button"
                    class="btn btn-sm btn-edit"
                    title="កែប្រែ"
                    style="width: 34px; height: 34px; border-radius: 9px; background: #FFF4E5; color: #C77D12;">
                <i class="fas fa-edit"></i>
            </button>

        </div>
    </td>

</tr>
