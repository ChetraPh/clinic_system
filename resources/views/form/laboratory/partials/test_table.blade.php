<div class="lab-test-table-wrapper">
    <div class="table-responsive">
        <table class="table align-middle mb-0 lab-test-table">

            <thead>
                <tr>
                    <th>កូដតេស្ត</th>
                    <th>ឈ្មោះតេស្តពិសោធន៍</th>
                    <th>កម្រិតធម្មតា</th>
                    <th>ខ្នាត</th>
                    <th>តម្លៃ</th>
                    <th class="text-right">សកម្មភាព</th>
                </tr>
            </thead>

            <tbody>

                @forelse ($labTestsPaginated as $test)

                    <tr>

                        {{-- Test Code --}}
                        <td>
                            <span class="test-code">
                                {{ $test->test_code ?? 'T-' . $test->test_id }}
                            </span>
                        </td>

                        {{-- Test Name --}}
                        <td>
                            <div class="test-name">
                                <div class="test-icon">
                                    <i class="fas fa-microscope"></i>
                                </div>

                                <div>
                                    <div class="font-weight-bold text-dark">
                                        {{ $test->test_name }}
                                    </div>

                                    <small class="text-muted">
                                        Laboratory Test
                                    </small>
                                </div>
                            </div>
                        </td>

                        {{-- Normal Range --}}
                        <td>
                            <span class="normal-range">
                                <i class="fas fa-chart-line mr-1"></i>
                                {{ $test->normal_range ?? '—' }}
                            </span>
                        </td>

                        {{-- Unit --}}
                        <td>
                            @if ($test->unit)
                                <span class="unit-badge">
                                    {{ $test->unit }}
                                </span>
                            @else
                                <span class="text-muted">—</span>
                            @endif
                        </td>

                        {{-- Price --}}
                        <td>
                            <span class="test-price">
                                ${{ number_format($test->price, 2) }}
                            </span>
                        </td>

                        {{-- Actions --}}
                        <td class="text-right">

                            <div class="dropup">

                                <button
                                    type="button"
                                    class="btn btn-sm action-menu-btn"
                                    data-toggle="dropdown"
                                    aria-haspopup="true"
                                    aria-expanded="false"
                                    title="សកម្មភាព"
                                >
                                    <i class="fas fa-ellipsis-h"></i>
                                </button>

                                <div class="dropdown-menu dropdown-menu-right shadow-sm lab-action-menu">

                                    {{-- Edit --}}
                                    <button
                                        type="button"
                                        class="dropdown-item btn-edit-test"
                                        data-id="{{ $test->test_id }}"
                                        data-name="{{ $test->test_name }}"
                                        data-code="{{ $test->test_code }}"
                                        data-range="{{ $test->normal_range }}"
                                        data-unit="{{ $test->unit }}"
                                        data-price="{{ $test->price }}"
                                    >
                                        <span class="action-icon edit">
                                            <i class="fas fa-edit"></i>
                                        </span>

                                        <span>កែប្រែ</span>
                                    </button>

                                    {{-- Delete --}}
                                    <form
                                        action="{{ route('lab.tests.destroy', $test->test_id) }}"
                                        method="POST"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="button"
                                            class="dropdown-item text-danger btn-delete-test"
                                            data-id="{{ $test->test_id }}"
                                            data-name="{{ $test->test_name }}"
                                            data-toggle="modal"
                                            data-target="#modalDeleteTest"
                                        >
                                            <span class="action-icon delete">
                                                <i class="fas fa-trash-alt"></i>
                                            </span>

                                            <span>លុប</span>
                                        </button>
                                    </form>

                                </div>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="6" class="empty-test-state">

                            <div class="empty-icon">
                                <i class="fas fa-microscope"></i>
                            </div>

                            <p class="font-weight-bold mb-1">
                                មិនទាន់មានបញ្ជីតេស្តពិសោធន៍ទេ
                            </p>

                            <small>
                                សូមបន្ថែមតេស្តពិសោធន៍ថ្មីក្នុងកាតាឡុក
                            </small>

                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>
    </div>
</div>


{{-- Pagination --}}
@if ($labTestsPaginated->hasPages())

    <div class="lab-pagination">
        {!! $labTestsPaginated->appends(request()->query())->links('pagination::bootstrap-4') !!}
    </div>

@endif


<style>
    :root {
        --lab-green: #006D36;
        --lab-green-dark: #00552B;
        --lab-green-light: #E8F5EE;
        --lab-bg: #F5F7F6;
        --lab-border: #E7ECE9;
        --lab-text: #1F2A24;
        --lab-muted: #7A8780;
    }

    .lab-test-table-wrapper {
        width: 100%;
        background: #fff;
        border-radius: 12px;
        overflow: hidden;
    }

    .lab-test-table {
        min-width: 950px;
        border-collapse: separate;
        border-spacing: 0;
    }

    .lab-test-table thead th {
        background: #F8FAF9;
        color: #65736B;
        border-top: none;
        border-bottom: 1px solid var(--lab-border);
        padding: 14px 16px;
        font-size: 11px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: .35px;
        white-space: nowrap;
    }

    .lab-test-table tbody td {
        padding: 15px 16px;
        border-top: 1px solid #EEF2F0;
        vertical-align: middle;
        color: var(--lab-text);
    }

    .lab-test-table tbody tr {
        transition: all .18s ease;
    }

    .lab-test-table tbody tr:hover {
        background: #FAFCFB;
    }

    /* Test Code */
    .test-code {
        display: inline-flex;
        align-items: center;
        padding: 6px 10px;
        background: var(--lab-green-light);
        color: var(--lab-green);
        border: 1px solid #D4EBDD;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 800;
        white-space: nowrap;
    }

    /* Test Name */
    .test-name {
        display: flex;
        align-items: center;
        gap: 11px;
        min-width: 210px;
    }

    .test-icon {
        width: 38px;
        height: 38px;
        min-width: 38px;
        border-radius: 10px;
        background: var(--lab-green-light);
        color: var(--lab-green);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 15px;
    }

    .test-name .text-dark {
        font-size: 13px;
    }

    .test-name small {
        display: block;
        margin-top: 2px;
        font-size: 10px;
        color: var(--lab-muted);
    }

    /* Normal Range */
    .normal-range {
        display: inline-flex;
        align-items: center;
        padding: 6px 10px;
        background: #F8FAF9;
        border: 1px solid var(--lab-border);
        border-radius: 8px;
        color: #4F5D56;
        font-size: 12px;
        font-weight: 600;
        white-space: nowrap;
    }

    .normal-range i {
        color: var(--lab-green);
        font-size: 11px;
    }

    /* Unit */
    .unit-badge {
        display: inline-block;
        padding: 5px 9px;
        background: #F5F7F6;
        color: #5E6B64;
        border: 1px solid var(--lab-border);
        border-radius: 7px;
        font-size: 12px;
        font-weight: 700;
    }

    /* Price */
    .test-price {
        display: inline-block;
        color: var(--lab-green);
        font-size: 14px;
        font-weight: 800;
        white-space: nowrap;
    }

    /* Action Button */
    .action-menu-btn {
        width: 34px;
        height: 34px;
        padding: 0;
        border: 1px solid var(--lab-border);
        border-radius: 8px;
        background: #fff;
        color: #66736C;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all .18s ease;
    }

    .action-menu-btn:hover,
    .action-menu-btn:focus {
        background: var(--lab-green-light);
        border-color: #CBE3D5;
        color: var(--lab-green);
        box-shadow: none;
    }

    /* Dropdown */
    .lab-action-menu {
        min-width: 155px;
        padding: 6px;
        border: 1px solid var(--lab-border);
        border-radius: 10px;
        margin-bottom: 5px;
    }

    .lab-action-menu .dropdown-item {
        display: flex;
        align-items: center;
        gap: 9px;
        padding: 9px 10px;
        border-radius: 7px;
        font-size: 13px;
        font-weight: 600;
        color: var(--lab-text);
        transition: all .15s ease;
    }

    .lab-action-menu .dropdown-item:hover {
        background: #F5F8F6;
    }

    .action-icon {
        width: 27px;
        height: 27px;
        border-radius: 7px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 11px;
    }

    .action-icon.edit {
        background: #EAF2FF;
        color: #2F6FED;
    }

    .action-icon.delete {
        background: #FDECEC;
        color: #DC3545;
    }

    .lab-action-menu .dropdown-item.text-danger:hover {
        background: #FFF5F5;
        color: #DC3545 !important;
    }

    /* Empty State */
    .empty-test-state {
        padding: 55px 20px !important;
        text-align: center;
        color: var(--lab-muted);
        border-top: none !important;
    }

    .empty-icon {
        width: 68px;
        height: 68px;
        margin: 0 auto 15px;
        border-radius: 18px;
        background: var(--lab-green-light);
        color: var(--lab-green);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 27px;
    }

    .empty-test-state p {
        color: var(--lab-text);
        font-size: 14px;
    }

    .empty-test-state small {
        color: var(--lab-muted);
        font-size: 12px;
    }

    /* Pagination */
    .lab-pagination {
        display: flex;
        justify-content: flex-end;
        padding: 15px 18px;
        border-top: 1px solid var(--lab-border);
        background: #fff;
    }

    .lab-pagination .pagination {
        margin: 0;
    }

    .lab-pagination .page-link {
        color: var(--lab-green);
        border-color: var(--lab-border);
        border-radius: 7px;
        margin-left: 4px;
        font-size: 12px;
        font-weight: 700;
        min-width: 34px;
        height: 34px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .lab-pagination .page-item.active .page-link {
        background-color: var(--lab-green);
        border-color: var(--lab-green);
        color: #fff;
    }

    .lab-pagination .page-link:hover {
        background-color: var(--lab-green-light);
        border-color: #CBE3D5;
        color: var(--lab-green-dark);
    }

    .lab-pagination .page-item.disabled .page-link {
        color: #B7C0BB;
        background: #F8FAF9;
    }

    /* Responsive */
    @media (max-width: 767.98px) {

        .lab-test-table {
            min-width: 900px;
        }

        .lab-test-table thead th,
        .lab-test-table tbody td {
            padding: 12px;
        }

        .lab-pagination {
            justify-content: center;
            overflow-x: auto;
        }
    }
</style>