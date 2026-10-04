<div class="department-table-wrapper">
    <div class="table-responsive">
        <table class="table department-table align-middle mb-0">
            <thead>
                <tr>
                    <th style="width: 80px;">លរ</th>
                    <th>ឈ្មោះដេប៉ាតឺម៉ង់</th>
                    <th>ការពិពណ៌នា</th>
                    <th style="width: 160px;">ថ្ងៃបង្កើត</th>
                    <th class="text-center" style="width: 100px;">សកម្មភាព</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($department as $depart)
                    <tr>
                        {{-- ID --}}
                        <td>
                            <span class="department-id">
                                #{{ $depart->department_id }}
                            </span>
                        </td>

                        {{-- Department Name --}}
                        <td>
                            <div class="department-name-wrapper">
                                <div class="department-row-icon">
                                    <i class="fas fa-hospital"></i>
                                </div>

                                <div>
                                    <div class="department-name">
                                        {{ $depart->department_name }}
                                    </div>

                                    <div class="department-name-sub">
                                        Department
                                    </div>
                                </div>
                            </div>
                        </td>

                        {{-- Description --}}
                        <td>
                            @if ($depart->description)
                                <span class="department-description">
                                    {{ $depart->description }}
                                </span>
                            @else
                                <span class="department-no-description">
                                    មិនមានការពិពណ៌នា
                                </span>
                            @endif
                        </td>

                        {{-- Created Date --}}
                        <td>
                            <div class="department-date">
                                <i class="far fa-calendar-alt mr-1"></i>
                                {{ $depart->created_at->format('d M, Y') }}
                            </div>
                        </td>

                        {{-- Actions --}}
                        <td class="text-center">
                            <div class="dropdown">
                                <button
                                    class="department-action-btn"
                                    type="button"
                                    data-toggle="dropdown"
                                    aria-haspopup="true"
                                    aria-expanded="false"
                                >
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>

                                <div class="dropdown-menu dropdown-menu-right department-dropdown-menu">

                                    {{-- Edit --}}
                                    <button
                                        type="button"
                                        class="dropdown-item btn-edit"
                                        data-toggle="modal"
                                        data-target="#modalEdit"
                                        data-id="{{ $depart->department_id }}"
                                    >
                                        <span class="department-dropdown-icon edit">
                                            <i class="fas fa-edit"></i>
                                        </span>
                                        <span>កែប្រែ</span>
                                    </button>

                                    <div class="dropdown-divider"></div>

                                    {{-- Delete --}}
                                    <button
                                        type="button"
                                        class="dropdown-item btn-delete"
                                        data-toggle="modal"
                                        data-target="#modalDelete"
                                        data-id="{{ $depart->department_id }}"
                                        data-name="{{ $depart->department_name }}"
                                    >
                                        <span class="department-dropdown-icon delete">
                                            <i class="fas fa-trash-alt"></i>
                                        </span>
                                        <span>លុប</span>
                                    </button>

                                </div>
                            </div>
                        </td>
                    </tr>

                @empty
                    <tr>
                        <td colspan="5">
                            <div class="department-empty">
                                <div class="department-empty-icon">
                                    <i class="fas fa-folder-open"></i>
                                </div>

                                <div class="department-empty-title">
                                    មិនមានទិន្នន័យដេប៉ាតឺម៉ង់ទេ
                                </div>

                                <div class="department-empty-text">
                                    មិនទាន់មានដេប៉ាតឺម៉ង់នៅក្នុងប្រព័ន្ធ។
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>


{{-- Pagination --}}
<div class="department-pagination">
    <div class="department-pagination-info">
        <i class="fas fa-list-ul mr-1"></i>
        បង្ហាញទិន្នន័យសរុប:
        <strong>{{ $department->total() ?? 0 }}</strong>
    </div>

    <div class="department-pagination-links">
        {!! $department->appends(request()->query())->links('pagination::bootstrap-4') !!}
    </div>
</div>


<style>
    :root {
        --department-green: #006D36;
        --department-green-dark: #00552B;
        --department-green-light: #E8F5EE;
        --department-bg: #F5F7F6;
        --department-border: #E7ECE9;
        --department-text: #1F2A24;
        --department-muted: #7A8780;
    }

    /* =========================
       TABLE
    ========================= */

    .department-table-wrapper {
        width: 100%;
        background: #fff;
    }

    .department-table {
        width: 100%;
        margin: 0;
        color: var(--department-text);
    }

    .department-table thead {
        background: #F8FAF9;
    }

    .department-table thead th {
        border: 0;
        border-bottom: 1px solid var(--department-border);
        color: #68756E;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .35px;
        padding: 15px 16px;
        white-space: nowrap;
        vertical-align: middle;
    }

    .department-table tbody td {
        border-top: 1px solid #EEF2EF;
        padding: 15px 16px;
        vertical-align: middle;
        font-size: 13px;
    }

    .department-table tbody tr {
        transition: background-color .2s ease;
    }

    .department-table tbody tr:hover {
        background-color: #FAFCFB;
    }

    /* =========================
       ID
    ========================= */

    .department-id {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 42px;
        padding: 5px 9px;
        border-radius: 7px;
        background: var(--department-green-light);
        color: var(--department-green);
        font-size: 12px;
        font-weight: 700;
    }

    /* =========================
       DEPARTMENT NAME
    ========================= */

    .department-name-wrapper {
        display: flex;
        align-items: center;
        gap: 11px;
    }

    .department-row-icon {
        width: 40px;
        height: 40px;
        min-width: 40px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--department-green-light);
        color: var(--department-green);
        font-size: 16px;
    }

    .department-name {
        color: var(--department-text);
        font-size: 13px;
        font-weight: 700;
        line-height: 1.4;
    }

    .department-name-sub {
        color: var(--department-muted);
        font-size: 10px;
        margin-top: 2px;
    }

    /* =========================
       DESCRIPTION
    ========================= */

    .department-description {
        color: #68756E;
        font-size: 12px;
        line-height: 1.5;
    }

    .department-no-description {
        color: #A1AAA5;
        font-size: 12px;
        font-style: italic;
    }

    /* =========================
       DATE
    ========================= */

    .department-date {
        display: inline-flex;
        align-items: center;
        color: var(--department-muted);
        font-size: 12px;
        white-space: nowrap;
    }

    .department-date i {
        color: var(--department-green);
        font-size: 12px;
    }

    /* =========================
       ACTION BUTTON
    ========================= */

    .department-action-btn {
        width: 34px;
        height: 34px;
        border: 1px solid var(--department-border);
        border-radius: 50%;
        background: #fff;
        color: #7A8780;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all .2s ease;
        box-shadow: none;
    }

    .department-action-btn:hover,
    .department-action-btn:focus {
        background: var(--department-green-light);
        border-color: #CDE5D7;
        color: var(--department-green);
        outline: none;
    }

    /* =========================
       DROPDOWN
    ========================= */

    .department-dropdown-menu {
        min-width: 150px;
        padding: 7px;
        border: 1px solid var(--department-border);
        border-radius: 10px;
        background: #fff;
        box-shadow: 0 8px 25px rgba(31, 42, 36, .10);
    }

    .department-dropdown-menu .dropdown-item {
        display: flex;
        align-items: center;
        gap: 9px;
        border-radius: 7px;
        padding: 9px 10px;
        color: var(--department-text);
        font-size: 12px;
        font-weight: 600;
        transition: all .15s ease;
    }

    .department-dropdown-menu .dropdown-item:hover {
        background: #F5F8F6;
        color: var(--department-text);
    }

    .department-dropdown-menu .dropdown-divider {
        margin: 5px 4px;
        border-top-color: #EEF2EF;
    }

    .department-dropdown-icon {
        width: 28px;
        height: 28px;
        border-radius: 7px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 11px;
    }

    .department-dropdown-icon.edit {
        background: var(--department-green-light);
        color: var(--department-green);
    }

    .department-dropdown-icon.delete {
        background: #FDECEC;
        color: #DC3545;
    }

    /* =========================
       EMPTY STATE
    ========================= */

    .department-empty {
        padding: 55px 20px;
        text-align: center;
    }

    .department-empty-icon {
        width: 64px;
        height: 64px;
        margin: 0 auto 14px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--department-green-light);
        color: var(--department-green);
        font-size: 25px;
    }

    .department-empty-title {
        color: var(--department-text);
        font-size: 14px;
        font-weight: 700;
        margin-bottom: 4px;
    }

    .department-empty-text {
        color: var(--department-muted);
        font-size: 12px;
    }

    /* =========================
       PAGINATION
    ========================= */

    .department-pagination {
        min-height: 68px;
        padding: 13px 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        background: #fff;
        border-top: 1px solid var(--department-border);
    }

    .department-pagination-info {
        color: var(--department-muted);
        font-size: 12px;
        white-space: nowrap;
    }

    .department-pagination-info i {
        color: var(--department-green);
    }

    .department-pagination-info strong {
        color: var(--department-text);
    }

    .department-pagination-links {
        display: flex;
        align-items: center;
    }

    .department-pagination-links .pagination {
        margin: 0;
    }

    .department-pagination-links .page-link {
        min-width: 32px;
        height: 32px;
        padding: 5px 9px;
        margin-left: 4px;
        border: 1px solid var(--department-border);
        border-radius: 7px !important;
        color: #68756E;
        background: #fff;
        font-size: 12px;
        text-align: center;
        transition: all .2s ease;
    }

    .department-pagination-links .page-link:hover {
        background: var(--department-green-light);
        border-color: #CDE5D7;
        color: var(--department-green);
    }

    .department-pagination-links .page-item.active .page-link {
        background: var(--department-green);
        border-color: var(--department-green);
        color: #fff;
    }

    .department-pagination-links .page-item.disabled .page-link {
        color: #B7C0BB;
        background: #FAFBFA;
    }

    /* =========================
       RESPONSIVE
    ========================= */

    @media (max-width: 991.98px) {
        .department-table thead th,
        .department-table tbody td {
            padding-left: 12px;
            padding-right: 12px;
        }

        .department-description {
            max-width: 220px;
            display: block;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
    }

    @media (max-width: 767.98px) {
        .department-pagination {
            flex-direction: column;
            align-items: flex-start;
        }

        .department-pagination-links {
            width: 100%;
            overflow-x: auto;
        }

        .department-name-wrapper {
            min-width: 180px;
        }
    }

    @media (max-width: 575.98px) {
        .department-table thead th,
        .department-table tbody td {
            padding: 11px 9px;
        }

        .department-row-icon {
            width: 34px;
            height: 34px;
            min-width: 34px;
            font-size: 14px;
        }

        .department-name {
            font-size: 12px;
        }

        .department-name-sub {
            font-size: 9px;
        }

        .department-description {
            max-width: 150px;
        }

        .department-pagination {
            padding: 12px;
        }
    }
</style>