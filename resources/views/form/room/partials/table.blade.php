<table class="table room-table mb-0">
    <thead>
        <tr>
            <th>លេខបន្ទប់</th>
            <th>ប្រភេទ</th>
            <th>ស្ថានភាព</th>
            <th>តម្លៃ/ថ្ងៃ</th>
            <th class="text-center">សកម្មភាព</th>
        </tr>
    </thead>

    <tbody>
        @forelse($rooms as $room)
            <tr>
                {{-- Room Number --}}
                <td>
                    <div class="room-number-cell">
                        <span class="room-type-bar type-{{ $room->room_type }}"></span>

                        <div>
                            <strong>{{ $room->room_number }}</strong>
                            <small>Room</small>
                        </div>
                    </div>
                </td>

                {{-- Room Type --}}
                <td>
                    <span class="room-type-label">
                        <i class="fas fa-bed mr-2"></i>
                        {{ $room->type_label }}
                    </span>
                </td>

                {{-- Status --}}
                <td>
                    <span class="badge room-status badge-{{ $room->status }}">
                        <span class="status-dot"></span>
                        {{ $room->status_label }}
                    </span>
                </td>

                {{-- Price --}}
                <td>
                    <span class="room-price">
                        ${{ number_format($room->price_per_day, 2) }}
                    </span>
                    <small class="price-label">/ ថ្ងៃ</small>
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

                            <div class="dropdown-menu dropdown-menu-right room-action-menu">

                                {{-- Edit --}}
                                <a href="#"
                                    class="dropdown-item btn-edit-room"
                                    data-id="{{ $room->room_id }}"
                                    data-room-number="{{ $room->room_number }}"
                                    data-room-type="{{ $room->room_type }}"
                                    data-status="{{ $room->status }}"
                                    data-price="{{ $room->price_per_day }}">

                                    <span class="action-icon edit-icon">
                                        <i class="fas fa-edit"></i>
                                    </span>

                                    <span>កែប្រែ</span>
                                </a>

                                {{-- Delete --}}
                                <a href="#"
                                    class="dropdown-item btn-delete-room"
                                    data-id="{{ $room->room_id }}"
                                    data-number="{{ $room->room_number }}">

                                    <span class="action-icon delete-icon">
                                        <i class="fas fa-trash"></i>
                                    </span>

                                    <span>លុប</span>
                                </a>

                            </div>
                        </div>
                    </div>
                </td>
            </tr>

        @empty
            <tr>
                <td colspan="5">
                    <div class="empty-room-state">
                        <div class="empty-room-icon">
                            <i class="fas fa-bed"></i>
                        </div>

                        <strong>មិនមានទិន្នន័យបន្ទប់ទេ</strong>
                        <span>មិនមានបន្ទប់ដែលត្រូវបង្ហាញ</span>
                    </div>
                </td>
            </tr>
        @endforelse
    </tbody>
</table>

{{-- Pagination --}}
@if ($rooms->hasPages())
    <div class="room-pagination px-3 py-3">
        {{ $rooms->links() }}
    </div>
@endif


<style>
    :root {
        --room-green: #006D36;
        --room-green-dark: #00552B;
        --room-green-light: #E8F5EE;
        --room-border: #E7ECE9;
        --room-text: #1F2A24;
        --room-muted: #7A8780;
    }

    .room-table {
        color: var(--room-text);
        border-collapse: separate;
        border-spacing: 0;
    }

    .room-table thead th {
        background: #F8FAF9;
        color: #65736B;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .4px;
        border-top: 0;
        border-bottom: 1px solid var(--room-border);
        padding: 14px 16px;
        white-space: nowrap;
    }

    .room-table tbody td {
        padding: 15px 16px;
        vertical-align: middle;
        border-top: 1px solid #F0F3F1;
        font-size: 14px;
    }

    .room-table tbody tr {
        transition: all .18s ease;
    }

    .room-table tbody tr:hover {
        background: #FAFCFB;
    }

    /* Room Number */

    .room-number-cell {
        display: flex;
        align-items: center;
        gap: 11px;
    }

    .room-number-cell strong {
        display: block;
        color: var(--room-text);
        font-size: 14px;
        font-weight: 700;
        line-height: 1.2;
    }

    .room-number-cell small {
        display: block;
        margin-top: 3px;
        color: var(--room-muted);
        font-size: 11px;
    }

    .room-type-bar {
        display: inline-block;
        width: 4px;
        height: 34px;
        border-radius: 10px;
        flex-shrink: 0;
    }

    .room-type-bar.type-general {
        background: #6C757D;
    }

    .room-type-bar.type-private {
        background: #007BFF;
    }

    .room-type-bar.type-icu {
        background: #DC3545;
    }

    .room-type-bar.type-isolation {
        background: #6F42C1;
    }

    /* Room Type */

    .room-type-label {
        display: inline-flex;
        align-items: center;
        color: #46534C;
        font-weight: 600;
        font-size: 13px;
    }

    .room-type-label i {
        color: var(--room-green);
        font-size: 13px;
    }

    /* Status */

    .room-status {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 10px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 700;
        line-height: 1;
        border: 1px solid transparent;
    }

    .status-dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        display: inline-block;
    }

    .badge-available {
        background: #E8F5EE;
        color: #006D36;
        border-color: #CDE8D9;
    }

    .badge-available .status-dot {
        background: #198754;
    }

    .badge-occupied {
        background: #FFF3E8;
        color: #B45309;
        border-color: #F6D7B5;
    }

    .badge-occupied .status-dot {
        background: #F59E0B;
    }

    .badge-maintenance {
        background: #FDECEC;
        color: #B42318;
        border-color: #F5C8C5;
    }

    .badge-maintenance .status-dot {
        background: #DC3545;
    }

    /* Price */

    .room-price {
        color: var(--room-green);
        font-size: 14px;
        font-weight: 700;
    }

    .price-label {
        color: var(--room-muted);
        font-size: 11px;
        margin-left: 2px;
    }

    /* Action */

    .action-icons {
        display: flex;
        align-items: center;
    }

    .action-menu-btn {
        width: 34px;
        height: 34px;
        padding: 0;
        border: 1px solid var(--room-border);
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
        background: var(--room-green-light);
        border-color: #BBDCC9;
        color: var(--room-green);
        box-shadow: none;
    }

    .room-action-menu {
        min-width: 160px;
        padding: 7px;
        border: 1px solid var(--room-border);
        border-radius: 11px;
        box-shadow: 0 8px 25px rgba(31, 42, 36, .12);
    }

    .room-action-menu .dropdown-item {
        display: flex;
        align-items: center;
        gap: 9px;
        padding: 9px 10px;
        border-radius: 8px;
        color: var(--room-text);
        font-size: 13px;
        font-weight: 600;
        transition: all .15s ease;
    }

    .room-action-menu .dropdown-item:hover {
        background: var(--room-green-light);
        color: var(--room-green);
    }

    .room-action-menu .dropdown-item:active {
        background: var(--room-green-light);
        color: var(--room-green);
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
        background: #E8F5EE;
        color: var(--room-green);
    }

    .delete-icon {
        background: #FDECEC;
        color: #DC3545;
    }

    /* Empty State */

    .empty-room-state {
        min-height: 190px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        color: var(--room-muted);
    }

    .empty-room-icon {
        width: 55px;
        height: 55px;
        border-radius: 50%;
        background: var(--room-green-light);
        color: var(--room-green);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 21px;
        margin-bottom: 12px;
    }

    .empty-room-state strong {
        color: var(--room-text);
        font-size: 14px;
        margin-bottom: 4px;
    }

    .empty-room-state span {
        font-size: 12px;
    }

    /* Pagination */

    .room-pagination {
        border-top: 1px solid var(--room-border);
        background: #fff;
    }

    .room-pagination .pagination {
        margin-bottom: 0;
        justify-content: flex-end;
    }

    .room-pagination .page-link {
        color: var(--room-green);
        border-color: var(--room-border);
        border-radius: 8px;
        margin-left: 4px;
        min-width: 34px;
        height: 34px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        font-weight: 600;
        transition: all .15s ease;
    }

    .room-pagination .page-link:hover {
        background: var(--room-green-light);
        border-color: #BBDCC9;
        color: var(--room-green-dark);
    }

    .room-pagination .page-item.active .page-link {
        background: var(--room-green);
        border-color: var(--room-green);
        color: #fff;
    }

    .room-pagination .page-item.disabled .page-link {
        color: #AAB3AE;
        background: #F8FAF9;
    }

    @media (max-width: 767.98px) {
        .room-table {
            min-width: 720px;
        }

        .room-table thead th,
        .room-table tbody td {
            padding: 12px 13px;
        }

        .room-pagination .pagination {
            justify-content: center;
        }
    }
</style>
