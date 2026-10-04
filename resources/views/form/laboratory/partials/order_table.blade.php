<style>
    .lab-order-table-wrapper {
        width: 100%;
        overflow-x: auto;
    }

    .lab-order-table {
        min-width: 1100px;
        margin-bottom: 0 !important;
    }

    .lab-order-table thead th {
        background: #F8FAF9 !important;
        color: #65736B;
        border-top: none !important;
        border-bottom: 1px solid #E7ECE9 !important;
        padding: 13px 16px;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .25px;
        white-space: nowrap;
        vertical-align: middle;
    }

    .lab-order-table tbody td {
        padding: 14px 16px;
        border-top: 1px solid #EEF2EF;
        vertical-align: middle;
        color: #1F2A24;
        font-size: 13px;
    }

    .lab-order-table tbody tr {
        transition: background-color .15s ease;
    }

    .lab-order-table tbody tr:hover {
        background: #FAFCFB;
    }

    /* Order Number */
    .lab-order-number {
        color: #006D36;
        font-weight: 700;
        white-space: nowrap;
    }

    .lab-order-number i {
        margin-right: 5px;
    }

    /* Date */
    .lab-order-date {
        white-space: nowrap;
    }

    .lab-order-date i {
        color: #006D36;
        margin-right: 5px;
    }

    /* Patient */
    .lab-patient-name {
        color: #1F2A24;
        font-weight: 700;
        margin-bottom: 2px;
    }

    .lab-patient-code {
        color: #7A8780;
        font-size: 11px;
    }

    .lab-patient-code i {
        color: #9AA59F;
        margin-right: 3px;
    }

    /* Doctor */
    .lab-doctor-name {
        color: #006D36;
        font-size: 12px;
        font-weight: 700;
        white-space: nowrap;
    }

    .lab-doctor-name i {
        margin-right: 4px;
    }

    /* Test list */
    .lab-test-list {
        list-style: none;
        padding: 0;
        margin: 0;
        min-width: 260px;
    }

    .lab-test-list li {
        margin-bottom: 5px;
        white-space: nowrap;
    }

    .lab-test-list li:last-child {
        margin-bottom: 0;
    }

    .lab-test-name {
        display: inline-block;
        background: #F8FAF9;
        color: #1F2A24;
        border: 1px solid #E1E8E4;
        border-radius: 7px;
        padding: 5px 8px;
        font-size: 11px;
        font-weight: 600;
        max-width: 210px;
        overflow: hidden;
        text-overflow: ellipsis;
        vertical-align: middle;
    }

    .lab-test-result {
        display: inline-block;
        border-radius: 7px;
        padding: 5px 8px;
        font-size: 11px;
        font-weight: 700;
        margin-left: 3px;
        vertical-align: middle;
    }

    .lab-test-result.completed {
        background: #E8F5EE;
        color: #006D36;
        border: 1px solid #D3EBDD;
    }

    .lab-test-result.pending {
        background: #FFF5D9;
        color: #9A6A00;
        border: 1px solid #F4E2A8;
    }

    /* Status */
    .lab-status {
        display: inline-flex;
        align-items: center;
        white-space: nowrap;
        border-radius: 8px;
        padding: 6px 9px;
        font-size: 11px;
        font-weight: 700;
    }

    .lab-status.completed {
        background: #E8F5EE;
        color: #006D36;
        border: 1px solid #D3EBDD;
    }

    .lab-status.pending {
        background: #FFF5D9;
        color: #9A6A00;
        border: 1px solid #F4E2A8;
    }

    /* Action */
    .lab-action-btn {
        border-radius: 8px !important;
        font-size: 12px;
        font-weight: 600;
        padding: 7px 11px;
        white-space: nowrap;
        background: #006D36 !important;
        border-color: #006D36 !important;
        transition: all .2s ease;
    }

    .lab-action-btn:hover {
        background: #00552B !important;
        border-color: #00552B !important;
        transform: translateY(-1px);
        box-shadow: 0 4px 10px rgba(0, 109, 54, .15);
    }

    /* Empty State */
    .lab-empty-state {
        padding: 55px 20px !important;
        color: #7A8780;
    }

    .lab-empty-icon {
        width: 64px;
        height: 64px;
        margin: 0 auto 15px;
        border-radius: 16px;
        background: #E8F5EE;
        color: #006D36;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
    }

    .lab-empty-state p {
        color: #1F2A24;
        font-size: 14px;
    }

    .lab-empty-state small {
        font-size: 12px;
        color: #7A8780;
    }

    /* Pagination */
    .pagination-wrapper {
        padding: 0 15px 10px;
    }

    .pagination-wrapper .pagination {
        margin-bottom: 0;
    }

    .pagination-wrapper .page-link {
        border: 1px solid #E7ECE9;
        color: #006D36;
        background: #fff;
        border-radius: 8px !important;
        margin: 0 2px;
        min-width: 34px;
        text-align: center;
        font-size: 12px;
        transition: all .15s ease;
    }

    .pagination-wrapper .page-link:hover {
        background: #E8F5EE;
        color: #00552B;
        border-color: #CFE3D7;
    }

    .pagination-wrapper .page-item.active .page-link {
        background: #006D36 !important;
        border-color: #006D36 !important;
        color: #fff !important;
    }

    .pagination-wrapper .page-item.disabled .page-link {
        color: #AAB4AE;
        background: #F8FAF9;
        border-color: #E7ECE9;
    }

    /* Responsive */
    @media (max-width: 767.98px) {
        .lab-order-table {
            min-width: 1050px;
        }

        .lab-order-table thead th,
        .lab-order-table tbody td {
            padding: 11px 12px;
        }
    }
</style>

<div class="lab-order-table-wrapper">

    <table class="table lab-order-table align-middle">

        <thead>
            <tr>
                <th>លេខការកម្មង់</th>
                <th>កាលបរិច្ឆេទ</th>
                <th>អ្នកជំងឺ</th>
                <th>វេជ្ជបណ្ឌិត</th>
                <th>បញ្ជីតេស្តត្រូវពិនិត្យ</th>
                <th>ស្ថានភាព</th>
                <th class="text-right">សកម្មភាព</th>
            </tr>
        </thead>

        <tbody>

            @forelse ($labOrders as $ord)

                <tr>

                    {{-- ================= ORDER NUMBER ================= --}}
                    <td>

                        <div class="lab-order-number">
                            <i class="fas fa-file-medical-alt"></i>
                            #LAB-{{ $ord->lab_order_id }}
                        </div>

                    </td>

                    {{-- ================= DATE ================= --}}
                    <td>

                        <div class="lab-order-date font-weight-bold">

                            <i class="far fa-calendar-alt"></i>

                            {{ $ord->order_date
                                ? $ord->order_date->format('d/m/Y H:i')
                                : '—'
                            }}

                        </div>

                    </td>

                    {{-- ================= PATIENT ================= --}}
                    <td>

                        @if ($ord->medicalRecord && $ord->medicalRecord->patient)

                            <div class="lab-patient-name">
                                {{ $ord->medicalRecord->patient->full_name }}
                            </div>

                            <div class="lab-patient-code">

                                <i class="fas fa-id-badge"></i>

                                {{ $ord->medicalRecord->patient->patient_code }}

                            </div>

                        @else

                            <div class="lab-patient-name">
                                —
                            </div>

                        @endif

                    </td>

                    {{-- ================= DOCTOR ================= --}}
                    <td>

                        @if ($ord->medicalRecord && $ord->medicalRecord->doctor)

                            <div class="lab-doctor-name">

                                <i class="fas fa-user-md"></i>

                                {{ $ord->medicalRecord->doctor->first_name }}
                                {{ $ord->medicalRecord->doctor->last_name }}

                            </div>

                        @else

                            <span class="text-muted">—</span>

                        @endif

                    </td>

                    {{-- ================= TESTS ================= --}}
                    <td>

                        <ul class="lab-test-list">

                            @foreach ($ord->results as $res)

                                <li>

                                    <span class="lab-test-name">

                                        <i class="fas fa-vial mr-1"
                                            style="color:#006D36;"></i>

                                        {{ $res->labTest
                                            ? $res->labTest->test_name
                                            : 'Test #' . $res->test_id
                                        }}

                                    </span>

                                    @if (
                                        $res->result_value &&
                                        $res->result_value !== 'Pending'
                                    )

                                        <span class="lab-test-result completed">

                                            <i class="fas fa-check mr-1"></i>

                                            {{ $res->result_value }}

                                        </span>

                                    @else

                                        <span class="lab-test-result pending">

                                            <i class="fas fa-clock mr-1"></i>

                                            កំពុងរង់ចាំ

                                        </span>

                                    @endif

                                </li>

                            @endforeach

                        </ul>

                    </td>

                    {{-- ================= STATUS ================= --}}
                    <td>

                        @if ($ord->status === 'completed')

                            <span class="lab-status completed">

                                <i class="fas fa-check-circle mr-1"></i>

                                បានបញ្ចប់

                            </span>

                        @else

                            <span class="lab-status pending">

                                <i class="fas fa-clock mr-1"></i>

                                កំពុងរង់ចាំ

                            </span>

                        @endif

                    </td>

                    {{-- ================= ACTION ================= --}}
                    <td>

                        <div class="d-flex justify-content-end align-items-center">

                            <button
                                type="button"
                                class="btn btn-primary btn-sm lab-action-btn btn-enter-results"
                                data-id="{{ $ord->lab_order_id }}"
                                data-results='@json($ord->results)'
                                data-patient="{{ $ord->medicalRecord && $ord->medicalRecord->patient ? $ord->medicalRecord->patient->full_name : '' }}"
                            >

                                <i class="fas fa-vial mr-1"></i>

                                បញ្ចូលលទ្ធផល

                            </button>

                        </div>

                    </td>

                </tr>

            @empty

                {{-- ================= EMPTY STATE ================= --}}

                <tr>

                    <td colspan="7"
                        class="text-center lab-empty-state">

                        <div class="lab-empty-icon">

                            <i class="fas fa-vials"></i>

                        </div>

                        <p class="font-weight-bold mb-1">
                            មិនមានទិន្នន័យការកម្មង់ពិនិត្យទេ
                        </p>

                        <small>
                            សូមបង្កើតការកម្មង់ពិនិត្យមន្ទីរពិសោធន៍ថ្មី
                        </small>

                    </td>

                </tr>

            @endforelse

        </tbody>

    </table>

</div>

{{-- ================= PAGINATION ================= --}}

<div class="d-flex justify-content-center pagination-wrapper mt-3">

    {!! $labOrders
        ->appends(request()->query())
        ->links('pagination::bootstrap-4')
    !!}

</div>