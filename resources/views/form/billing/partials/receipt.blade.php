@php
    $setting = $setting ?? null;

    $clinicName = data_get($setting, 'system_name') ?: config('app.name');

    $clinicPhone = data_get($setting, 'phone');
    $clinicEmail = data_get($setting, 'email');
    $clinicAddr  = data_get($setting, 'address');
    $clinicHours = data_get($setting, 'working_hours');
    $logo        = data_get($setting, 'logo');

    $logoUrl = $logo
        ? (str_starts_with($logo, 'http') ? $logo : asset('storage/' . $logo))
        : null;

    $typeLabels = [
        'service'  => 'សេវាកម្ម',
        'room'     => 'បន្ទប់សម្រាក',
        'medicine' => 'ថ្នាំពេទ្យ',
        'lab'      => 'មន្ទីរពិសោធន៍'
    ];

    $statusLabels = [
        'paid'      => 'បានទូទាត់រួច',
        'partial'   => 'បង់ខ្លះ',
        'unpaid'    => 'មិនទាន់បង់',
        'cancelled' => 'បានលុបចោល'
    ];

    $methodLabels = [
        'cash'   => 'សាច់ប្រាក់',
        'card'   => 'កាតធនាគារ',
        'online' => 'Online / KHQR'
    ];

    $isIpd = !empty($invoice->admission_id);

    $room = optional(optional($invoice->admission)->room)->room_number;

    $cashier = optional(optional($invoice->payments->last())->processor)->name
        ?? optional($invoice->creator)->name;

    $footerText = data_get($billing, 'invoice_footer')
        ?: 'សូមអរគុណ · សូមរក្សាសុខភាពឲ្យបានល្អ';

    $curSym  = data_get($billing, 'currency_symbol', '$');
    $curSym2 = data_get($billing, 'secondary_currency_symbol', '៛');
    $rate    = (float) data_get($billing, 'exchange_rate', 0);
@endphp

<style>
    /* =========================================================
       MODERN INVOICE
    ========================================================= */

    .invoice-sheet {
        --invoice-green: #006D36;
        --invoice-green-dark: #00552B;
        --invoice-green-light: #E8F5EE;
        --invoice-green-soft: #F4FAF6;
        --invoice-border: #E6ECE8;
        --invoice-text: #26342D;
        --invoice-muted: #7A8780;
        --invoice-danger: #C2415A;

        width: 100%;
        background: #fff;
        color: var(--invoice-text);
        font-family: 'Inter',
                     'Kantumruy Pro',
                     'Khmer OS Battambang',
                     'Noto Sans Khmer',
                     sans-serif;

        font-size: 12px;
        line-height: 1.6;

        padding: 20px 22px;

        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
    }

    .invoice-sheet * {
        box-sizing: border-box;
    }

    /* =========================================================
       HEADER
    ========================================================= */

    .invoice-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 25px;
        padding-bottom: 18px;
        border-bottom: 2px solid var(--invoice-green);
    }

    .invoice-brand {
        display: flex;
        align-items: flex-start;
        gap: 13px;
        flex: 1;
        min-width: 0;
    }

    .invoice-logo {
        width: 58px;
        height: 58px;
        object-fit: contain;
        border-radius: 10px;
        flex-shrink: 0;
    }

    .invoice-clinic-name {
        margin: 0 0 4px;
        color: var(--invoice-green);
        font-size: 19px;
        font-weight: 800;
        line-height: 1.35;
    }

    .invoice-clinic-info {
        color: var(--invoice-muted);
        font-size: 10px;
        line-height: 1.65;
    }

    .invoice-dot {
        margin: 0 5px;
        color: #A3AEA8;
    }

    .invoice-heading {
        margin: 0 0 5px;
        color: var(--invoice-green);
        font-size: 25px;
        font-weight: 850;
        text-align: right;
        line-height: 1.2;
    }

    .invoice-heading-sub {
        color: var(--invoice-muted);
        font-size: 9px;
        text-align: right;
        text-transform: uppercase;
        letter-spacing: .6px;
    }

    /* =========================================================
       INVOICE META
    ========================================================= */

    .invoice-meta {
        width: 270px;
        margin-top: 12px;
        border: 1px solid var(--invoice-border);
        border-radius: 9px;
        border-collapse: separate;
        border-spacing: 0;
        overflow: hidden;
    }

    .invoice-meta td {
        padding: 6px 9px;
        border-bottom: 1px solid var(--invoice-border);
        font-size: 10px;
    }

    .invoice-meta tr:last-child td {
        border-bottom: 0;
    }

    .invoice-meta td:first-child {
        width: 42%;
        background: var(--invoice-green-soft);
        color: var(--invoice-muted);
        font-weight: 600;
    }

    .invoice-meta td:last-child {
        background: #fff;
        color: var(--invoice-text);
        font-weight: 750;
        text-align: right;
    }

    /* =========================================================
       CANCELLED
    ========================================================= */

    .invoice-cancelled {
        display: flex;
        align-items: center;
        gap: 8px;
        margin: 14px 0;
        padding: 9px 12px;
        border: 1px solid #F4C6CE;
        border-radius: 8px;
        background: #FFF4F5;
        color: var(--invoice-danger);
        font-size: 10px;
    }

    .invoice-cancelled i {
        font-size: 12px;
    }

    /* =========================================================
       PATIENT CARD
    ========================================================= */

    .invoice-patient {
        margin-top: 16px;
        margin-bottom: 18px;
        padding: 13px 15px;
        background: var(--invoice-green-soft);
        border: 1px solid #E1EEE6;
        border-radius: 10px;
    }

    .patient-section-title {
        display: flex;
        align-items: center;
        gap: 7px;
        margin-bottom: 9px;
        color: var(--invoice-green);
        font-size: 11px;
        font-weight: 800;
    }

    .patient-section-title i {
        width: 23px;
        height: 23px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 7px;
        background: #DDEFE5;
        font-size: 10px;
    }

    .invoice-patient-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        column-gap: 30px;
        row-gap: 5px;
    }

    .patient-info-item {
        color: #526059;
        font-size: 10px;
    }

    .patient-info-item b {
        color: #34423A;
        font-weight: 750;
    }

    /* =========================================================
       ITEMS TABLE
    ========================================================= */

    .invoice-items {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        overflow: hidden;
        border: 1px solid var(--invoice-border);
        border-radius: 9px;
    }

    .invoice-items thead th {
        padding: 9px 10px;
        background: var(--invoice-green);
        color: #fff;
        border: 0;
        font-size: 10px;
        font-weight: 750;
        white-space: nowrap;
    }

    .invoice-items tbody td {
        padding: 8px 10px;
        border-bottom: 1px solid #EEF1EF;
        color: #45534B;
        font-size: 10px;
        vertical-align: middle;
    }

    .invoice-items tbody tr:last-child td {
        border-bottom: 0;
    }

    .invoice-items tbody tr:hover td {
        background: #FAFCFB;
    }

    .invoice-items .item-number {
        width: 42px;
        color: var(--invoice-green);
        font-weight: 750;
        text-align: center;
    }

    .invoice-items .item-description {
        color: #34423A;
        font-weight: 650;
    }

    .invoice-items .item-type {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 3px 7px;
        border-radius: 6px;
        background: var(--invoice-green-light);
        color: var(--invoice-green);
        font-size: 8px;
        font-weight: 750;
        white-space: nowrap;
    }

    .invoice-items .item-amount {
        color: #34423A;
        font-weight: 700;
    }

    .invoice-items .item-total {
        color: var(--invoice-green);
        font-weight: 800;
    }

    .invoice-items .empty-row td {
        height: 32px;
        background: #FCFDFC;
    }

    /* =========================================================
       BOTTOM SECTION
    ========================================================= */

    .invoice-bottom {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 25px;
        margin-top: 18px;
        padding-top: 15px;
        border-top: 1px solid var(--invoice-border);
    }

    .invoice-extra {
        flex: 1;
        min-width: 0;
    }

    .invoice-section-title {
        margin-bottom: 7px;
        color: var(--invoice-green);
        font-size: 11px;
        font-weight: 800;
    }

    .payment-line {
        display: flex;
        align-items: center;
        gap: 6px;
        margin-bottom: 4px;
        color: #5D6962;
        font-size: 9px;
    }

    .payment-check {
        color: var(--invoice-green);
        font-size: 9px;
    }

    .invoice-note {
        margin-top: 9px;
        padding: 8px 10px;
        border-left: 3px solid #B9D9C5;
        background: #F7FAF8;
        color: #66736C;
        font-size: 9px;
        font-style: italic;
    }

    /* =========================================================
       TOTALS
    ========================================================= */

    .invoice-totals {
        width: 280px;
        flex-shrink: 0;
        border: 1px solid var(--invoice-border);
        border-radius: 9px;
        border-collapse: separate;
        border-spacing: 0;
        overflow: hidden;
    }

    .invoice-totals td {
        padding: 7px 11px;
        border-bottom: 1px solid var(--invoice-border);
        font-size: 10px;
    }

    .invoice-totals tr:last-child td {
        border-bottom: 0;
    }

    .invoice-totals td:first-child {
        color: #68746D;
    }

    .invoice-totals td:last-child {
        color: #34423A;
        font-weight: 750;
        text-align: right;
    }

    .invoice-totals .grand td {
        background: var(--invoice-green);
        color: #fff !important;
        font-size: 12px;
        font-weight: 800;
    }

    .invoice-totals .paid td:last-child {
        color: #21844B;
    }

    .invoice-totals .due td:last-child {
        color: var(--invoice-danger);
    }

    /* =========================================================
       SIGNATURES
    ========================================================= */

    .invoice-signatures {
        display: flex;
        justify-content: space-around;
        gap: 40px;
        margin-top: 48px;
        text-align: center;
    }

    .signature-box {
        width: 220px;
    }

    .signature-line {
        padding-top: 7px;
        border-top: 1px dashed #AAB4AE;
    }

    .signature-role {
        color: var(--invoice-green);
        font-size: 10px;
        font-weight: 800;
    }

    .signature-name {
        margin-top: 2px;
        color: var(--invoice-muted);
        font-size: 9px;
    }

    /* =========================================================
       FOOTER
    ========================================================= */

    .invoice-footer {
        margin-top: 25px;
        padding-top: 9px;
        border-top: 1px solid var(--invoice-border);
        color: var(--invoice-green);
        font-size: 10px;
        font-weight: 700;
        text-align: center;
    }

    /* =========================================================
       PRINT
    ========================================================= */

    @media print {

        .invoice-sheet {
            padding: 0;
            font-size: 11px;
        }

        .invoice-header {
            border-bottom-width: 2px;
        }

        .invoice-items tbody tr:hover td {
            background: transparent;
        }

        .invoice-items {
            page-break-inside: auto;
        }

        .invoice-items tr {
            page-break-inside: avoid;
        }

        .invoice-patient,
        .invoice-bottom,
        .invoice-signatures {
            page-break-inside: avoid;
        }

        .invoice-footer {
            page-break-inside: avoid;
        }
    }

    /* =========================================================
       RESPONSIVE
    ========================================================= */

    @media (max-width: 767.98px) {

        .invoice-sheet {
            padding: 12px;
        }

        .invoice-header {
            flex-direction: column;
        }

        .invoice-heading {
            text-align: left;
        }

        .invoice-heading-sub {
            text-align: left;
        }

        .invoice-meta {
            width: 100%;
        }

        .invoice-patient-grid {
            grid-template-columns: 1fr;
            row-gap: 6px;
        }

        .invoice-bottom {
            flex-direction: column;
        }

        .invoice-totals {
            width: 100%;
        }

        .invoice-signatures {
            gap: 20px;
        }

        .signature-box {
            width: 45%;
        }

        .invoice-items {
            font-size: 9px;
        }

        .invoice-items th,
        .invoice-items td {
            padding: 7px 6px;
        }
    }
</style>


<div class="invoice-sheet">

    {{-- =====================================================
         HEADER
    ====================================================== --}}

    <div class="invoice-header">

        <div class="invoice-brand">

            @if($logoUrl)
                <img src="{{ $logoUrl }}"
                     class="invoice-logo"
                     alt="Logo">
            @endif

            <div>

                <div class="invoice-clinic-name">
                    {{ $clinicName }}
                </div>

                <div class="invoice-clinic-info">

                    @if($clinicHours)
                        <div>
                            <i class="far fa-clock mr-1"></i>
                            {{ $clinicHours }}
                        </div>
                    @endif

                    @if($clinicAddr)
                        <div>
                            <i class="fas fa-map-marker-alt mr-1"></i>
                            {{ $clinicAddr }}
                        </div>
                    @endif

                    @if($clinicPhone || $clinicEmail)

                        <div>

                            @if($clinicPhone)
                                <i class="fas fa-phone-alt mr-1"></i>
                                {{ $clinicPhone }}
                            @endif

                            @if($clinicPhone && $clinicEmail)
                                <span class="invoice-dot">•</span>
                            @endif

                            @if($clinicEmail)
                                <i class="far fa-envelope mr-1"></i>
                                {{ $clinicEmail }}
                            @endif

                        </div>

                    @endif

                </div>

            </div>

        </div>


        <div>

            <div class="invoice-heading">
                វិក្កយបត្រ
            </div>

            <div class="invoice-heading-sub">
                Invoice / Receipt
            </div>

            <table class="invoice-meta">

                <tr>
                    <td>លេខវិក្កយបត្រ</td>
                    <td>{{ $invoice->invoice_number }}</td>
                </tr>

                <tr>
                    <td>កាលបរិច្ឆេទ</td>
                    <td>
                        {{ $invoice->created_at->format('d/m/Y h:i A') }}
                    </td>
                </tr>

                <tr>
                    <td>ស្ថានភាព</td>
                    <td>
                        {{ $statusLabels[$invoice->status] ?? $invoice->status }}
                    </td>
                </tr>

            </table>

        </div>

    </div>


    {{-- =====================================================
         CANCELLED
    ====================================================== --}}

    @if($invoice->status === 'cancelled')

        <div class="invoice-cancelled">

            <i class="fas fa-ban"></i>

            <div>
                <b>បានលុបចោល</b>
                <span class="ml-1">— មូលហេតុ:</span>
                {{ $invoice->cancel_reason }}
            </div>

        </div>

    @endif


    {{-- =====================================================
         PATIENT
    ====================================================== --}}

    <div class="invoice-patient">

        <div class="patient-section-title">

            <i class="fas fa-user"></i>

            <span>
                ព័ត៌មានអ្នកជំងឺ
            </span>

        </div>

        <div class="invoice-patient-grid">

            <div class="patient-info-item">
                <b>ឈ្មោះ ៖</b>
                {{ $invoice->patient_name }}
            </div>

            <div class="patient-info-item">
                <b>លេខកូដអ្នកជំងឺ ៖</b>
                {{ optional($invoice->patient)->patient_code ?? '—' }}
            </div>

            <div class="patient-info-item">
                <b>ទូរស័ព្ទ ៖</b>
                {{ $invoice->patient_phone ?: '—' }}
            </div>

            <div class="patient-info-item">

                <b>ប្រភេទ ៖</b>

                {{ $isIpd
                    ? 'អ្នកជំងឺសម្រាក (IPD)'
                    : 'អ្នកជំងឺក្រៅ (OPD)' }}

                @if($isIpd && $room)
                    <span class="ml-1">
                        — បន្ទប់ {{ $room }}
                    </span>
                @endif

            </div>

        </div>

    </div>


    {{-- =====================================================
         ITEMS
    ====================================================== --}}

    <table class="invoice-items">

        <thead>

            <tr>

                <th style="width:50px"
                    class="text-c">
                    ល.រ
                </th>

                <th>
                    សេវាពិនិត្យ / ថ្នាំព្យាបាល
                </th>

                <th style="width:120px"
                    class="text-c">
                    ប្រភេទ
                </th>

                <th style="width:70px"
                    class="text-c">
                    ចំនួន
                </th>

                <th style="width:110px"
                    class="text-r">
                    តម្លៃឯកតា
                </th>

                <th style="width:110px"
                    class="text-r">
                    ជាប្រាក់
                </th>

            </tr>

        </thead>

        <tbody>

            @foreach($invoice->items as $i => $item)

                <tr>

                    <td class="item-number">
                        {{ $i + 1 }}
                    </td>

                    <td class="item-description">
                        {{ $item->description }}
                    </td>

                    <td class="text-c">

                        <span class="item-type">
                            {{ $typeLabels[$item->item_type] ?? $item->item_type }}
                        </span>

                    </td>

                    <td class="text-c">
                        {{ $item->qty }}
                    </td>

                    <td class="text-r item-amount">
                        {{ $curSym }}{{ number_format($item->unit_price, 2) }}
                    </td>

                    <td class="text-r item-total">
                        {{ $curSym }}{{ number_format($item->subtotal, 2) }}
                    </td>

                </tr>

            @endforeach


            @for($k = $invoice->items->count(); $k < 5; $k++)

                <tr class="empty-row">

                    <td>&nbsp;</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>

                </tr>

            @endfor

        </tbody>

    </table>


    {{-- =====================================================
         PAYMENT + TOTAL
    ====================================================== --}}

    <div class="invoice-bottom">

        <div class="invoice-extra">

            <div class="invoice-section-title">
                <i class="fas fa-receipt mr-1"></i>
                ព័ត៌មានបន្ថែម
            </div>


            @forelse($invoice->payments as $p)

                <div class="payment-line">

                    <span class="payment-check">
                        <i class="fas fa-check-circle"></i>
                    </span>

                    <span>
                        {{ $methodLabels[$p->payment_method] ?? $p->payment_method }}

                        {{ $curSym }}{{ number_format($p->amount, 2) }}

                        ({{ \Carbon\Carbon::parse($p->paid_at)->format('d/m/Y H:i') }})

                        @if($p->transaction_ref)
                            — {{ $p->transaction_ref }}
                        @endif
                    </span>

                </div>

            @empty

                <div class="payment-line">
                    <i class="far fa-clock mr-1"></i>
                    មិនទាន់មានការទូទាត់
                </div>

            @endforelse


            @if($invoice->notes)

                <div class="invoice-note">

                    <i class="far fa-sticky-note mr-1"></i>

                    កំណត់សម្គាល់ ៖
                    {{ $invoice->notes }}

                </div>

            @endif

        </div>


        {{-- TOTALS --}}

        <table class="invoice-totals">

            <tr class="grand">

                <td>
                    សរុបរួម
                </td>

                <td>
                    {{ $curSym }}{{ number_format($invoice->total_amount, 2) }}
                </td>

            </tr>


            @if($rate > 0)

                <tr>

                    <td>
                        ស្មើនឹង
                    </td>

                    <td>
                        {{ number_format($invoice->total_amount * $rate, 0) }}
                        {{ $curSym2 }}
                    </td>

                </tr>

            @endif


            <tr class="paid">

                <td>
                    បានបង់
                </td>

                <td>
                    {{ $curSym }}{{ number_format($invoice->paid_amount, 2) }}
                </td>

            </tr>


            <tr class="due">

                <td>
                    ប្រាក់ជំពាក់
                </td>

                <td>
                    {{ $curSym }}{{ number_format($invoice->balance, 2) }}
                </td>

            </tr>

        </table>

    </div>


    {{-- =====================================================
         SIGNATURES
    ====================================================== --}}

    <div class="invoice-signatures">

        <div class="signature-box">

            <div class="signature-line">

                <div class="signature-role">
                    អ្នកជំងឺ / អាណាព្យាបាល
                </div>

                <div class="signature-name">
                    (ឈ្មោះ និង ហត្ថលេខា)
                </div>

            </div>

        </div>


        <div class="signature-box">

            <div class="signature-line">

                <div class="signature-role">
                    អ្នកទទួលប្រាក់
                </div>

                <div class="signature-name">

                    {{ $cashier ?: '(ឈ្មោះ និង ហត្ថលេខា)' }}

                </div>

            </div>

        </div>

    </div>


    {{-- =====================================================
         FOOTER
    ====================================================== --}}

    <div class="invoice-footer">

        <i class="fas fa-heart mr-1"></i>

        {{ $footerText }}

    </div>

</div>