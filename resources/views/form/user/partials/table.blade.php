<div class="user-table-wrapper">

    <div class="table-responsive">

        <table class="table user-table align-middle mb-0">

            <thead>
                <tr>

                    <th class="text-center" style="width: 70px;">
                        ID
                    </th>

                    <th>
                        អ្នកប្រើប្រាស់
                    </th>

                    <th>
                        អ៊ីមែល
                    </th>

                    <th>
                        ឈ្មោះអ្នកប្រើប្រាស់
                    </th>

                    <th>
                        តួនាទី
                    </th>

                    <th>
                        2FA
                    </th>

                    <th class="text-center" style="width: 90px;">
                        សកម្មភាព
                    </th>

                </tr>
            </thead>


            <tbody>

                @forelse ($users as $u)

                    <tr>

                        {{-- ID --}}
                        <td class="text-center">

                            <span class="user-id">
                                #{{ $u->id }}
                            </span>

                        </td>


                        {{-- NAME --}}
                        <td>

                            <div class="user-info">

                                <div class="user-avatar">

                                    {{ strtoupper(substr($u->name, 0, 1)) }}

                                </div>

                                <div class="user-name-wrap">

                                    <div class="user-name">

                                        {{ $u->name }}

                                    </div>

                                    <div class="user-label">

                                        User Account

                                    </div>

                                </div>

                            </div>

                        </td>


                        {{-- EMAIL --}}
                        <td>

                            <div class="info-item">

                                <span class="info-icon">
                                    <i class="fas fa-envelope"></i>
                                </span>

                                <span class="info-text">

                                    {{ $u->email }}

                                </span>

                            </div>

                        </td>


                        {{-- USERNAME --}}
                        <td>

                            @if ($u->username)

                                <div class="info-item">

                                    <span class="info-icon">
                                        <i class="fas fa-at"></i>
                                    </span>

                                    <span class="info-text">

                                        {{ $u->username }}

                                    </span>

                                </div>

                            @else

                                <span class="text-muted">
                                    —
                                </span>

                            @endif

                        </td>


                        {{-- ROLE --}}
                        <td>

                            @forelse ($u->roles as $role)

                                @php

                                    $roleClass = match (strtolower($role->name)) {

                                        'admin' => 'role-admin',

                                        'doctor' => 'role-doctor',

                                        'nurse' => 'role-nurse',

                                        'cashier' => 'role-cashier',

                                        'pharmacist' => 'role-pharmacist',

                                        default => 'role-default',

                                    };

                                @endphp


                                <span class="role-badge {{ $roleClass }}">

                                    <i class="fas fa-user-tag mr-1"></i>

                                    {{ $role->name }}

                                </span>

                            @empty

                                <span class="role-badge role-none">

                                    <i class="fas fa-minus-circle mr-1"></i>

                                    គ្មានតួនាទី

                                </span>

                            @endforelse

                        </td>


                        {{-- 2FA --}}
                        <td>

                            @if ($u->google2fa_secret)

                                <span class="security-badge security-enabled">

                                    <i class="fas fa-shield-alt mr-1"></i>

                                    បានបើក

                                </span>

                            @else

                                <span class="security-badge security-disabled">

                                    <i class="fas fa-shield-alt mr-1"></i>

                                    មិនទាន់កំណត់

                                </span>

                            @endif

                        </td>


                        {{-- ACTION --}}
                        <td class="text-center">

                            <div class="dropdown">

                                <button
                                    type="button"
                                    class="btn-action"
                                    data-toggle="dropdown"
                                    aria-haspopup="true"
                                    aria-expanded="false"
                                    title="សកម្មភាព"
                                >

                                    <i class="fas fa-ellipsis-h"></i>

                                </button>


                                <div class="dropdown-menu dropdown-menu-right user-action-menu">


                                    {{-- Edit Role --}}
                                    <button
                                        type="button"
                                        class="dropdown-item btn-edit-role"
                                        data-toggle="modal"
                                        data-target="#modalUpdateRole"
                                        data-id="{{ $u->id }}"
                                        data-name="{{ $u->name }}"
                                        data-role="{{ $u->roles->first()->name ?? '' }}"
                                    >

                                        <span class="action-icon action-role">

                                            <i class="fas fa-user-tag"></i>

                                        </span>

                                        <span>
                                            កំណត់តួនាទី
                                        </span>

                                    </button>


                                    {{-- Reset 2FA --}}
                                    @if ($u->google2fa_secret)

                                        <button
                                            type="button"
                                            class="dropdown-item btn-reset-2fa"
                                            data-toggle="modal"
                                            data-target="#modalReset2FA"
                                            data-id="{{ $u->id }}"
                                            data-name="{{ $u->name }}"
                                        >

                                            <span class="action-icon action-security">

                                                <i class="fas fa-shield-alt"></i>

                                            </span>

                                            <span>
                                                Reset 2FA
                                            </span>

                                        </button>

                                    @else

                                        <button
                                            type="button"
                                            class="dropdown-item text-muted"
                                            disabled
                                        >

                                            <span class="action-icon action-disabled">

                                                <i class="fas fa-shield-alt"></i>

                                            </span>

                                            <span>
                                                Reset 2FA
                                            </span>

                                        </button>

                                    @endif


                                    {{-- Divider --}}
                                    <div class="dropdown-divider"></div>


                                    {{-- Delete User --}}
                                    <button
                                        type="button"
                                        class="dropdown-item btn-delete-user text-danger"
                                        data-toggle="modal"
                                        data-target="#modalDeleteUser"
                                        data-id="{{ $u->id }}"
                                        data-name="{{ $u->name }}"
                                    >

                                        <span class="action-icon action-delete">

                                            <i class="fas fa-trash-alt"></i>

                                        </span>

                                        <span>
                                            លុបអ្នកប្រើប្រាស់
                                        </span>

                                    </button>


                                </div>

                            </div>

                        </td>

                    </tr>


                @empty

                    <tr>

                        <td colspan="7" class="text-center">

                            <div class="empty-state">

                                <div class="empty-icon">

                                    <i class="fas fa-users"></i>

                                </div>

                                <h6>
                                    មិនមានទិន្នន័យ
                                </h6>

                                <p>
                                    មិនទាន់មានអ្នកប្រើប្រាស់នៅក្នុងប្រព័ន្ធទេ
                                </p>

                            </div>

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>


    {{-- Pagination --}}
    @if ($users->hasPages())

        <div class="pagination-container">

            {!! $users->appends(request()->query())->links('pagination::bootstrap-4') !!}

        </div>

    @endif

</div>


<style>

    :root {

        --user-green: #006D36;
        --user-green-dark: #00552B;
        --user-green-light: #E8F5EE;
        --user-border: #E7ECE9;
        --user-text: #1F2A24;
        --user-muted: #7A8780;

    }


    /* =========================
       TABLE WRAPPER
    ========================= */

    .user-table-wrapper {

        background: #fff;

        border: 1px solid var(--user-border);

        border-radius: 15px;

        overflow: hidden;

    }


    .user-table {

        min-width: 1050px;

        margin-bottom: 0;

    }


    .user-table thead th {

        background: #F8FAF9;

        border: none;

        border-bottom: 1px solid var(--user-border);

        color: #65716B;

        font-size: 11px;

        font-weight: 700;

        text-transform: uppercase;

        letter-spacing: .4px;

        padding: 15px 16px;

        white-space: nowrap;

    }


    .user-table tbody td {

        border-top: 1px solid #EEF2EF;

        color: var(--user-text);

        font-size: 13px;

        padding: 14px 16px;

        vertical-align: middle;

    }


    .user-table tbody tr {

        transition: background-color .15s ease;

    }


    .user-table tbody tr:hover {

        background: #FAFCFB;

    }


    /* =========================
       USER INFO
    ========================= */

    .user-info {

        display: flex;

        align-items: center;

        min-width: 190px;

    }


    .user-avatar {

        width: 42px;

        height: 42px;

        min-width: 42px;

        border-radius: 12px;

        background: var(--user-green-light);

        color: var(--user-green);

        display: flex;

        align-items: center;

        justify-content: center;

        font-size: 16px;

        font-weight: 700;

        margin-right: 11px;

    }


    .user-name-wrap {

        min-width: 0;

    }


    .user-name {

        color: var(--user-text);

        font-weight: 700;

        font-size: 13px;

        white-space: nowrap;

        overflow: hidden;

        text-overflow: ellipsis;

        max-width: 180px;

    }


    .user-label {

        color: var(--user-muted);

        font-size: 11px;

        margin-top: 2px;

    }


    /* =========================
       ID
    ========================= */

    .user-id {

        color: var(--user-green);

        background: var(--user-green-light);

        border-radius: 7px;

        padding: 5px 8px;

        font-size: 11px;

        font-weight: 700;

        white-space: nowrap;

    }


    /* =========================
       EMAIL / USERNAME
    ========================= */

    .info-item {

        display: flex;

        align-items: center;

        min-width: 160px;

    }


    .info-icon {

        width: 28px;

        height: 28px;

        min-width: 28px;

        border-radius: 8px;

        background: #F3F6F4;

        color: var(--user-green);

        display: flex;

        align-items: center;

        justify-content: center;

        font-size: 11px;

        margin-right: 8px;

    }


    .info-text {

        color: #46524C;

        font-size: 12px;

        white-space: nowrap;

    }


    /* =========================
       ROLE
    ========================= */

    .role-badge {

        display: inline-flex;

        align-items: center;

        padding: 6px 9px;

        border-radius: 7px;

        font-size: 11px;

        font-weight: 700;

        white-space: nowrap;

    }


    .role-admin {

        background: #FDECEC;

        color: #C0392B;

    }


    .role-doctor {

        background: #E8F1FF;

        color: #2868C7;

    }


    .role-nurse {

        background: var(--user-green-light);

        color: var(--user-green);

    }


    .role-cashier {

        background: #FFF5DD;

        color: #A86B00;

    }


    .role-pharmacist {

        background: #F0EAFE;

        color: #7652C5;

    }


    .role-default {

        background: #EEF2F0;

        color: #59655F;

    }


    .role-none {

        background: #F2F4F3;

        color: #8A948F;

    }


    /* =========================
       2FA
    ========================= */

    .security-badge {

        display: inline-flex;

        align-items: center;

        padding: 6px 9px;

        border-radius: 7px;

        font-size: 11px;

        font-weight: 700;

        white-space: nowrap;

    }


    .security-enabled {

        background: var(--user-green-light);

        color: var(--user-green);

    }


    .security-disabled {

        background: #F1F3F4;

        color: #7A8280;

    }


    /* =========================
       ACTION BUTTON
    ========================= */

    .btn-action {

        width: 34px;

        height: 34px;

        border: 1px solid var(--user-border);

        border-radius: 9px;

        background: #fff;

        color: #69756F;

        display: inline-flex;

        align-items: center;

        justify-content: center;

        cursor: pointer;

        transition: all .15s ease;

    }


    .btn-action:hover,

    .btn-action:focus {

        background: var(--user-green-light);

        border-color: #CDE5D7;

        color: var(--user-green);

        outline: none;

        box-shadow: none;

    }


    /* =========================
       ACTION DROPDOWN
    ========================= */

    .user-action-menu {

        min-width: 210px;

        padding: 6px;

        border: 1px solid var(--user-border);

        border-radius: 11px;

        box-shadow: 0 10px 30px rgba(31, 42, 36, .12);

    }


    .user-action-menu .dropdown-item {

        display: flex;

        align-items: center;

        border-radius: 8px;

        padding: 9px 10px;

        color: var(--user-text);

        font-size: 12px;

        font-weight: 600;

        transition: background-color .15s ease;

    }


    .user-action-menu .dropdown-item:hover {

        background: #F4F8F5;

        color: var(--user-green);

    }


    .user-action-menu .dropdown-item:disabled {

        opacity: .55;

        cursor: not-allowed;

        background: transparent;

    }


    .user-action-menu .dropdown-item.text-danger {

        color: #C0392B;

    }


    .user-action-menu .dropdown-item.text-danger:hover {

        background: #FDECEC;

        color: #A93226;

    }


    .action-icon {

        width: 28px;

        height: 28px;

        border-radius: 7px;

        display: inline-flex;

        align-items: center;

        justify-content: center;

        margin-right: 9px;

        font-size: 11px;

    }


    .action-role {

        background: #E8F1FF;

        color: #2868C7;

    }


    .action-security {

        background: #FFF5DD;

        color: #A86B00;

    }


    .action-disabled {

        background: #F1F3F4;

        color: #8A918D;

    }


    .action-delete {

        background: #FDECEC;

        color: #C0392B;

    }


    /* =========================
       EMPTY STATE
    ========================= */

    .empty-state {

        text-align: center;

        padding: 55px 20px;

    }


    .empty-icon {

        width: 64px;

        height: 64px;

        margin: 0 auto 14px;

        border-radius: 16px;

        background: var(--user-green-light);

        color: var(--user-green);

        display: flex;

        align-items: center;

        justify-content: center;

        font-size: 24px;

    }


    .empty-state h6 {

        margin-bottom: 5px;

        color: var(--user-text);

        font-weight: 700;

    }


    .empty-state p {

        margin-bottom: 0;

        color: var(--user-muted);

        font-size: 12px;

    }


    /* =========================
       PAGINATION
    ========================= */

    .pagination-container {

        padding: 16px 18px;

        border-top: 1px solid var(--user-border);

        background: #fff;

        display: flex;

        justify-content: center;

    }


    .pagination-container .pagination {

        margin: 0;

    }


    .pagination-container .page-item {

        margin: 0 2px;

    }


    .pagination-container .page-link {

        border: 1px solid var(--user-border);

        border-radius: 8px !important;

        color: var(--user-green);

        font-size: 12px;

        font-weight: 600;

        min-width: 34px;

        height: 34px;

        display: flex;

        align-items: center;

        justify-content: center;

        background: #fff;

        transition: all .15s ease;

    }


    .pagination-container .page-link:hover {

        background: var(--user-green-light);

        border-color: #CDE5D7;

        color: var(--user-green-dark);

    }


    .pagination-container .page-item.active .page-link {

        background: var(--user-green);

        border-color: var(--user-green);

        color: #fff;

    }


    .pagination-container .page-item.disabled .page-link {

        color: #A8B0AC;

        background: #F8FAF9;

    }


    /* =========================
       RESPONSIVE
    ========================= */

    @media (max-width: 991.98px) {

        .user-table {

            min-width: 1000px;

        }

    }


    @media (max-width: 767.98px) {

        .user-table thead th,

        .user-table tbody td {

            padding: 12px;

        }


        .pagination-container {

            padding: 13px 10px;

            overflow-x: auto;

        }

    }


    @media (max-width: 575.98px) {

        .user-table {

            min-width: 950px;

        }


        .user-avatar {

            width: 38px;

            height: 38px;

            min-width: 38px;

        }


        .user-name {

            max-width: 150px;

        }

    }

</style>