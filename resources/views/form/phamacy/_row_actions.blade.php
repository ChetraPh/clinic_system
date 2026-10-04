<div class="action-icons d-flex justify-content-center">
    <div class="dropdown">

        {{-- Action Button --}}
        <button type="button"
                class="btn action-menu-btn"
                data-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false"
                title="សកម្មភាព">
            <i class="fas fa-ellipsis-v"></i>
        </button>

        {{-- Action Menu --}}
        <div class="dropdown-menu dropdown-menu-right pharmacy-action-menu">

            {{-- Edit --}}
            <button type="button"
                    class="dropdown-item btn-edit"
                    data-id="{{ $medicine->medicine_id }}">
                <span class="action-icon edit-icon">
                    <i class="fas fa-edit"></i>
                </span>
                <span>កែប្រែ</span>
            </button>

            {{-- Restock --}}
            <button type="button"
                    class="dropdown-item btn-restock"
                    data-id="{{ $medicine->medicine_id }}"
                    data-name="{{ $medicine->medicine_name }}">
                <span class="action-icon restock-icon">
                    <i class="fas fa-box"></i>
                </span>
                <span>បន្ថែមស្តុក</span>
            </button>

            {{-- Details --}}
            <button type="button"
                    class="dropdown-item btn-detail"
                    data-id="{{ $medicine->medicine_id }}">
                <span class="action-icon detail-icon">
                    <i class="fas fa-eye"></i>
                </span>
                <span>មើលលម្អិត</span>
            </button>

        </div>
    </div>
</div>