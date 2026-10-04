<div class="billing-table-wrapper">
    <div class="table-responsive">
        <table class="table billing-invoice-table align-middle mb-0">
            <thead>
                <tr>
                    <th>លេខវិក្កយបត្រ</th>
                    <th>អ្នកជំងឺ</th>
                    <th>ប្រភេទ</th>
                    <th>ប្រាក់សរុប</th>
                    <th>បានបង់</th>
                    <th>ជំពាក់</th>
                    <th>ស្ថានភាព</th>
                    <th>កាលបរិច្ឆេទ</th>
                    <th class="text-center">សកម្មភាព</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($invoices as $inv)
                    <tr>
                        {{-- Invoice Number --}}
                        <td>
                            <div class="invoice-number">
                                <span class="invoice-icon">
                                    <i class="fas fa-file-invoice"></i>
                                </span>

                                <span>{{ $inv->invoice_number }}</span>
                            </div>
                        </td>

                        {{-- Patient --}}
                        <td>
                            <div class="billing-patient">
                                <div class="patient-avatar">
                                    <i class="fas fa-user"></i>
                                </div>

                                <div class="patient-details">
                                    <div class="patient-name">
                                        {{ $inv->patient_name }}
                                    </div>

                                    <div class="patient-phone">
                                        <i class="fas fa-phone-alt"></i>
                                        {{ $inv->patient_phone ?? '—' }}
                                    </div>
                                </div>
                            </div>
                        </td>

                        {{-- Visit Type --}}
                        <td>
                            @if ($inv->admission_id)
                                <span class="visit-badge visit-ipd"
                                    title="{{ optional($inv->admission->room)->room_number ? 'Room ' . $inv->admission->room->room_number : '' }}">
                                    <i class="fas fa-bed"></i>
                                    <span>IPD</span>
                                </span>
                            @else
                                <span class="visit-badge visit-opd">
                                    <i class="fas fa-walking"></i>
                                    <span>OPD</span>
                                </span>
                            @endif
                        </td>

                        {{-- Total --}}
                        <td>
                            <span class="amount amount-total">
                                ${{ number_format($inv->total_amount, 2) }}
                            </span>
                        </td>

                        {{-- Paid --}}
                        <td>
                            <span class="amount amount-paid">
                                ${{ number_format($inv->paid_amount, 2) }}
                            </span>
                        </td>

                        {{-- Balance --}}
                        <td>
                            <span class="amount {{ $inv->balance > 0 ? 'amount-due' : 'amount-zero' }}">
                                ${{ number_format($inv->balance, 2) }}
                            </span>
                        </td>

                        {{-- Status --}}
                        <td>
                            @if ($inv->status === 'paid')
                                <span class="invoice-status status-paid">
                                    <i class="fas fa-check-circle"></i>
                                    <span>បានទូទាត់រួច</span>
                                </span>

                            @elseif ($inv->status === 'partial')
                                <span class="invoice-status status-partial">
                                    <i class="fas fa-clock"></i>
                                    <span>បង់ខ្លះ</span>
                                </span>

                            @elseif ($inv->status === 'cancelled')
                                <span class="invoice-status status-cancelled">
                                    <i class="fas fa-ban"></i>
                                    <span>បានលុបចោល</span>
                                </span>

                            @else
                                <span class="invoice-status status-unpaid">
                                    <i class="fas fa-exclamation-circle"></i>
                                    <span>មិនទាន់បង់</span>
                                </span>
                            @endif
                        </td>

                        {{-- Date --}}
                        <td>
                            <div class="invoice-date">
                                <div class="date-main">
                                    <i class="far fa-calendar-alt"></i>
                                    {{ $inv->created_at ? $inv->created_at->format('d/m/Y') : '—' }}
                                </div>

                                @if ($inv->created_at)
                                    <small>
                                        {{ $inv->created_at->format('H:i') }}
                                    </small>
                                @endif
                            </div>
                        </td>

                        {{-- Actions --}}
                        <td>
                            <div class="billing-actions">

                                {{-- Pay Now --}}
                                @if ($inv->status !== 'paid' && $inv->status !== 'cancelled')
                                    <button type="button"
                                        class="btn billing-action-btn pay-btn btn-pay-now"
                                        data-id="{{ $inv->id }}"
                                        data-number="{{ $inv->invoice_number }}"
                                        data-patient="{{ $inv->patient_name }}"
                                        data-total="{{ $inv->total_amount }}"
                                        data-paid="{{ $inv->paid_amount }}"
                                        data-balance="{{ $inv->balance }}"
                                        data-toggle="tooltip"
                                        title="ទូទាត់ប្រាក់ (Pay Now)">
                                        <i class="fas fa-dollar-sign"></i>
                                    </button>
                                @endif

                                {{-- More Actions --}}
                                <div class="dropdown">
                                    <button type="button"
                                        class="btn billing-action-btn more-btn"
                                        data-toggle="dropdown"
                                        aria-haspopup="true"
                                        aria-expanded="false"
                                        title="សកម្មភាពបន្ថែម">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>

                                    <div class="dropdown-menu dropdown-menu-right billing-action-menu">

                                        {{-- View Detail --}}
                                        <button type="button"
                                            class="dropdown-item btn-view-detail"
                                            data-id="{{ $inv->id }}">
                                            <span class="menu-icon detail-menu-icon">
                                                <i class="fas fa-list-alt"></i>
                                            </span>
                                            <span>មើលព័ត៌មានលម្អិត</span>
                                        </button>

                                        {{-- View / Print Receipt --}}
                                        <button type="button"
                                            class="dropdown-item btn-view-receipt"
                                            data-id="{{ $inv->id }}">
                                            <span class="menu-icon receipt-menu-icon">
                                                <i class="fas fa-print"></i>
                                            </span>
                                            <span>មើល / បោះពុម្ពវិក្កយបត្រ</span>
                                        </button>

                                        {{-- Edit --}}
                                        @if (
                                            $inv->status === 'unpaid' &&
                                            (auth()->user()->hasRole('admin') || auth()->user()->can('edit-invoices'))
                                        )
                                            <button type="button"
                                                class="dropdown-item btn-edit-invoice"
                                                data-id="{{ $inv->id }}">
                                                <span class="menu-icon edit-menu-icon">
                                                    <i class="fas fa-pen"></i>
                                                </span>
                                                <span>កែប្រែវិក្កយបត្រ</span>
                                            </button>
                                        @endif

                                        {{-- Cancel --}}
                                        @if (
                                            $inv->status === 'unpaid' &&
                                            (auth()->user()->hasRole('admin') || auth()->user()->can('cancel-invoices'))
                                        )
                                            <button type="button"
                                                class="dropdown-item btn-cancel-invoice"
                                                data-id="{{ $inv->id }}"
                                                data-number="{{ $inv->invoice_number }}">
                                                <span class="menu-icon cancel-menu-icon">
                                                    <i class="fas fa-ban"></i>
                                                </span>
                                                <span>លុបចោលវិក្កយបត្រ</span>
                                            </button>
                                        @endif

                                    </div>
                                </div>

                            </div>
                        </td>
                    </tr>

                @empty
                    <tr>
                        <td colspan="9" class="billing-empty">
                            <div class="empty-invoice-icon">
                                <i class="fas fa-file-invoice-dollar"></i>
                            </div>

                            <div class="empty-invoice-title">
                                មិនមានទិន្នន័យវិក្កយបត្រទេ
                            </div>

                            <div class="empty-invoice-text">
                                សូមជ្រើសរើសពាក្យស្វែងរកផ្សេង ឬបង្កើតវិក្កយបត្រថ្មី
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="billing-pagination">
        {!! $invoices->appends(request()->query())->links('pagination::bootstrap-4') !!}
    </div>
</div>