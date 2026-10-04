<table class="table appointment-table mb-0">
    <thead>
        <tr>
            <th>ល.រ (ID)</th>
            <th>អ្នកជំងឺ (Patient)</th>
            <th>វេជ្ជបណ្ឌិត (Doctor)</th>
            <th>កាលបរិច្ឆេទ & ម៉ោង</th>
            <th>មូលហេតុ (Reason)</th>
            <th>ស្ថានភាព (Status)</th>
            <th class="text-center">សកម្មភាព (Actions)</th>
        </tr>
    </thead>

    <tbody>
        @forelse ($appointments as $app)

            <tr class="{{ $app->is_overdue ? 'appointment-overdue' : '' }}">

                {{-- ID --}}
                <td>
                    <span class="appointment-id">
                        #{{ $app->appointment_id }}
                    </span>
                </td>


                {{-- Patient --}}
                <td>
                    <div class="person-info">

                        <div class="person-avatar patient-avatar">
                            <i class="fas fa-user"></i>
                        </div>

                        <div class="person-details">

                            <strong>
                                {{ $app->patient ? $app->patient->full_name : 'N/A' }}
                            </strong>

                            <small>
                                <i class="fas fa-phone mr-1"></i>
                                {{ $app->patient ? ($app->patient->phone ?? '-') : '-' }}
                            </small>

                        </div>

                    </div>
                </td>


                {{-- Doctor --}}
                <td>
                    <div class="person-info">

                        <div class="person-avatar doctor-avatar">
                            <i class="fas fa-user-md"></i>
                        </div>

                        <div class="person-details">

                            <strong class="doctor-name">
                                {{ $app->doctor ? $app->doctor->name : 'N/A' }}
                            </strong>

                            <small>
                                {{ $app->doctor
                                    ? ($app->doctor->specialization ?? 'វេជ្ជបណ្ឌិត')
                                    : '' }}
                            </small>

                        </div>

                    </div>
                </td>


                {{-- Appointment Date --}}
                <td class="{{ $app->is_overdue ? 'overdue-date' : '' }}">

                    <div class="appointment-date">

                        <i class="far fa-calendar-alt mr-2"></i>

                        <strong>
                            {{ $app->appointment_date
                                ? $app->appointment_date->format('d M, Y')
                                : '-' }}
                        </strong>

                    </div>

                    <div class="appointment-time">

                        <i class="far fa-clock mr-2"></i>

                        <span>
                            {{ $app->appointment_date
                                ? $app->appointment_date->format('h:i A')
                                : '-' }}
                        </span>

                    </div>

                    @if($app->is_overdue)

                        <div class="overdue-message">

                            <i class="fas fa-exclamation-circle mr-1"></i>

                            ហួសកំណត់ សូមធ្វើបច្ចុប្បន្នភាពស្ថានភាព

                        </div>

                    @endif

                </td>


                {{-- Reason --}}
                <td>

                    <div class="reason-text"
                        title="{{ $app->reason ?? '-' }}">

                        {{ $app->reason ?? '-' }}

                    </div>

                </td>


                {{-- Status --}}
                <td>

                    @if($app->is_overdue)

                        <span class="status-badge status-overdue">

                            <span class="status-dot"></span>

                            <i class="fas fa-exclamation-triangle"></i>

                            ហួសកំណត់

                        </span>

                    @else

                        @switch($app->status)

                            @case('scheduled')

                                <span class="status-badge status-scheduled">

                                    <span class="status-dot"></span>

                                    <i class="fas fa-clock"></i>

                                    បានណាត់

                                </span>

                                @break


                            @case('completed')

                                <span class="status-badge status-completed">

                                    <span class="status-dot"></span>

                                    <i class="fas fa-check-circle"></i>

                                    បានរួចរាល់

                                </span>

                                @break


                            @case('cancelled')

                                <span class="status-badge status-cancelled">

                                    <span class="status-dot"></span>

                                    <i class="fas fa-times-circle"></i>

                                    បានបោះបង់

                                </span>

                                @break


                            @default

                                <span class="status-badge status-default">

                                    <span class="status-dot"></span>

                                    {{ ucfirst($app->status) }}

                                </span>

                        @endswitch

                    @endif

                </td>


                {{-- Actions --}}
                <td>

                    <div class="action-icons justify-content-center">

                        <div class="dropdown">

                            <button type="button"
                                class="btn btn-sm action-menu-btn"
                                data-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                                title="សកម្មភាព">

                                <i class="fas fa-ellipsis-h"></i>

                            </button>


                            <div class="dropdown-menu dropdown-menu-right appointment-action-menu">

                                {{-- Edit --}}
                                <button type="button"
                                    class="dropdown-item btn-edit"
                                    data-toggle="modal"
                                    data-target="#modalEdit"
                                    data-id="{{ $app->appointment_id }}">

                                    <span class="action-icon edit-icon">
                                        <i class="fas fa-edit"></i>
                                    </span>

                                    <span>កែប្រែ</span>

                                </button>


                                {{-- Delete --}}
                                <button type="button"
                                    class="dropdown-item btn-delete"
                                    data-id="{{ $app->appointment_id }}"
                                    data-name="{{ $app->patient
                                        ? $app->patient->full_name
                                        : 'ID: ' . $app->appointment_id }}"
                                    data-toggle="modal"
                                    data-target="#modalDelete">

                                    <span class="action-icon delete-icon">
                                        <i class="fas fa-trash"></i>
                                    </span>

                                    <span>លុប</span>

                                </button>

                            </div>

                        </div>

                    </div>

                </td>

            </tr>

        @empty

            <tr>

                <td colspan="7">

                    <div class="empty-appointment-state">

                        <div class="empty-appointment-icon">
                            <i class="fas fa-calendar-times"></i>
                        </div>

                        <strong>
                            មិនមានទិន្នន័យការណាត់ជួបទេ
                        </strong>

                        <span>
                            មិនមានការណាត់ជួបដែលត្រូវបង្ហាញ
                        </span>

                    </div>

                </td>

            </tr>

        @endforelse

    </tbody>
</table>


{{-- Pagination --}}
@if ($appointments->hasPages())

    <div class="appointment-pagination">

        {!! $appointments
            ->appends(request()->query())
            ->links('pagination::bootstrap-4') !!}

    </div>

@endif


<style>
    :root {
        --appointment-green: #006D36;
        --appointment-green-dark: #00552B;
        --appointment-green-light: #E8F5EE;
        --appointment-border: #E7ECE9;
        --appointment-text: #1F2A24;
        --appointment-muted: #7A8780;
    }

    /* =========================
       Table
    ========================= */

    .appointment-table {
        color: var(--appointment-text);
        border-collapse: separate;
        border-spacing: 0;
        min-width: 1050px;
    }

    .appointment-table thead th {
        background: #F8FAF9;
        color: #65736B;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .35px;
        border-top: 0;
        border-bottom: 1px solid var(--appointment-border);
        padding: 14px 14px;
        white-space: nowrap;
    }

    .appointment-table tbody td {
        padding: 14px;
        vertical-align: middle;
        border-top: 1px solid #F0F3F1;
        font-size: 13px;
    }

    .appointment-table tbody tr {
        background: #fff;
        transition: all .18s ease;
    }

    .appointment-table tbody tr:hover {
        background: #FAFCFB;
    }

    .appointment-table tbody tr.appointment-overdue {
        background: #FFF9F9;
    }

    .appointment-table tbody tr.appointment-overdue:hover {
        background: #FFF5F5;
    }


    /* =========================
       Appointment ID
    ========================= */

    .appointment-id {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 46px;
        padding: 6px 8px;
        border-radius: 7px;
        background: var(--appointment-green-light);
        color: var(--appointment-green);
        font-size: 12px;
        font-weight: 700;
    }


    /* =========================
       Person Info
    ========================= */

    .person-info {
        display: flex;
        align-items: center;
        gap: 10px;
        min-width: 190px;
    }

    .person-avatar {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        font-size: 14px;
    }

    .patient-avatar {
        background: var(--appointment-green-light);
        color: var(--appointment-green);
    }

    .doctor-avatar {
        background: #EAF5F1;
        color: #087F5B;
    }

    .person-details {
        min-width: 0;
    }

    .person-details strong {
        display: block;
        color: var(--appointment-text);
        font-size: 13px;
        font-weight: 700;
        line-height: 1.3;
        max-width: 190px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .person-details strong.doctor-name {
        color: var(--appointment-green);
    }

    .person-details small {
        display: block;
        color: var(--appointment-muted);
        font-size: 11px;
        margin-top: 3px;
        max-width: 190px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }


    /* =========================
       Date & Time
    ========================= */

    .appointment-date {
        display: flex;
        align-items: center;
        color: var(--appointment-text);
        font-size: 12px;
    }

    .appointment-date i {
        color: var(--appointment-green);
    }

    .appointment-time {
        display: flex;
        align-items: center;
        color: var(--appointment-muted);
        font-size: 11px;
        margin-top: 5px;
        padding-left: 1px;
    }

    .appointment-time i {
        color: #9AA59F;
    }

    .overdue-date .appointment-date,
    .overdue-date .appointment-date i {
        color: #C62828;
    }

    .overdue-date .appointment-time,
    .overdue-date .appointment-time i {
        color: #D9534F;
    }

    .overdue-message {
        margin-top: 6px;
        color: #C62828;
        font-size: 10px;
        font-weight: 700;
        line-height: 1.4;
        max-width: 190px;
    }


    /* =========================
       Reason
    ========================= */

    .reason-text {
        max-width: 180px;
        color: #53615A;
        font-size: 12px;
        line-height: 1.5;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }


    /* =========================
       Status
    ========================= */

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 6px 9px;
        border-radius: 20px;
        font-size: 10px;
        font-weight: 700;
        line-height: 1;
        white-space: nowrap;
        border: 1px solid transparent;
    }

    .status-badge i {
        font-size: 9px;
    }

    .status-dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        display: inline-block;
    }

    .status-scheduled {
        background: #EAF5F1;
        color: #087F5B;
        border-color: #CBE5D9;
    }

    .status-scheduled .status-dot {
        background: #087F5B;
    }

    .status-completed {
        background: var(--appointment-green-light);
        color: var(--appointment-green);
        border-color: #CDE8D9;
    }

    .status-completed .status-dot {
        background: #198754;
    }

    .status-cancelled {
        background: #FDECEC;
        color: #C62828;
        border-color: #F5C8C5;
    }

    .status-cancelled .status-dot {
        background: #DC3545;
    }

    .status-overdue {
        background: #FFF0F0;
        color: #C62828;
        border-color: #F5C8C5;
    }

    .status-overdue .status-dot {
        background: #DC3545;
    }

    .status-default {
        background: #F1F3F2;
        color: #66736C;
        border-color: #E1E6E3;
    }

    .status-default .status-dot {
        background: #7A8780;
    }


    /* =========================
       Actions
    ========================= */

    .action-icons {
        display: flex;
        align-items: center;
    }

    .action-menu-btn {
        width: 34px;
        height: 34px;
        padding: 0;
        border: 1px solid var(--appointment-border);
        border-radius: 9px;
        background: #fff;
        color: #6F7B75;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all .18s ease;
        box-shadow: 0 1px 2px rgba(0, 0, 0, .03);
    }

    .action-menu-btn:hover,
    .action-menu-btn:focus {
        background: var(--appointment-green-light);
        border-color: #BBDCC9;
        color: var(--appointment-green);
        box-shadow: none;
    }

    .appointment-action-menu {
        min-width: 155px;
        padding: 7px;
        border: 1px solid var(--appointment-border);
        border-radius: 11px;
        box-shadow: 0 8px 25px rgba(31, 42, 36, .12);
    }

    .appointment-action-menu .dropdown-item {
        display: flex;
        align-items: center;
        gap: 9px;
        padding: 9px 10px;
        border-radius: 8px;
        color: var(--appointment-text);
        font-size: 13px;
        font-weight: 600;
        background: transparent;
        transition: all .15s ease;
    }

    .appointment-action-menu .dropdown-item:hover,
    .appointment-action-menu .dropdown-item:focus {
        background: var(--appointment-green-light);
        color: var(--appointment-green);
    }

    .action-icon {
        width: 28px;
        height: 28px;
        border-radius: 7px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .edit-icon {
        background: var(--appointment-green-light);
        color: var(--appointment-green);
    }

    .delete-icon {
        background: #FDECEC;
        color: #DC3545;
    }


    /* =========================
       Empty State
    ========================= */

    .empty-appointment-state {
        min-height: 210px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        color: var(--appointment-muted);
    }

    .empty-appointment-icon {
        width: 56px;
        height: 56px;
        border-radius: 50%;
        background: var(--appointment-green-light);
        color: var(--appointment-green);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 21px;
        margin-bottom: 12px;
    }

    .empty-appointment-state strong {
        color: var(--appointment-text);
        font-size: 14px;
        margin-bottom: 4px;
    }

    .empty-appointment-state span {
        color: var(--appointment-muted);
        font-size: 12px;
    }


    /* =========================
       Pagination
    ========================= */

    .appointment-pagination {
        padding: 14px 16px;
        border-top: 1px solid var(--appointment-border);
        background: #fff;
    }

    .appointment-pagination .pagination {
        margin: 0;
        justify-content: flex-end;
    }

    .appointment-pagination .page-link {
        min-width: 34px;
        height: 34px;
        margin-left: 4px;
        padding: 0 9px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: var(--appointment-green);
        background: #fff;
        border: 1px solid var(--appointment-border);
        border-radius: 8px;
        font-size: 12px;
        font-weight: 600;
        transition: all .15s ease;
    }

    .appointment-pagination .page-link:hover {
        background: var(--appointment-green-light);
        border-color: #BBDCC9;
        color: var(--appointment-green-dark);
    }

    .appointment-pagination .page-item.active .page-link {
        background: var(--appointment-green);
        border-color: var(--appointment-green);
        color: #fff;
    }

    .appointment-pagination .page-item.disabled .page-link {
        color: #AAB3AE;
        background: #F8FAF9;
    }


    /* =========================
       Responsive
    ========================= */

    @media (max-width: 991.98px) {
        .appointment-table {
            min-width: 1000px;
        }
    }

    @media (max-width: 767.98px) {
        .appointment-table {
            min-width: 950px;
        }

        .appointment-table thead th,
        .appointment-table tbody td {
            padding: 12px;
        }

        .appointment-pagination .pagination {
            justify-content: center;
        }
    }
</style>