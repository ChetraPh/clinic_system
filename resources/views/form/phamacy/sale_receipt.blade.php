{{-- resources/views/form/phamacy/sale_receipt.blade.php --}}

<!DOCTYPE html>
<html lang="km">

<head>
    <meta charset="UTF-8">

    <title>
        វិក្កយបត្រ -
        {{ $billing->invoice_prefix }}{{ str_pad($sale->sale_id, 6, '0', STR_PAD_LEFT) }}
    </title>

    <style>
        @php
            $isReceipt = $billing->print_size === '80mm';
            $subtotal = (float) $sale->total_amount;
            $taxPct = (float) ($billing->tax_percent ?? 0);
            $taxAmount = $subtotal * ($taxPct / 100);
            $grandTotal = $subtotal + $taxAmount;
            $cur = $billing->currency_symbol ?: '$';
        @endphp

        * {
            box-sizing: border-box;
        }

        html,
        body {
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Khmer OS Battambang', Arial, sans-serif;
            font-size: {{ $isReceipt ? '12px' : '14px' }};
            color: #1e293b;
            background: #f1f5f9;
            padding: {{ $isReceipt ? '10px' : '30px' }};
        }

        /* ==========================================
           Receipt / Invoice Container
        ========================================== */

        .box {
            width: 100%;
            max-width: {{ $isReceipt ? '320px' : '780px' }};
            margin: 0 auto;
            background: #ffffff;

            padding: {{ $isReceipt ? '18px' : '38px' }};

            @if(!$isReceipt)
                border-radius: 14px;
                box-shadow: 0 8px 30px rgba(15, 23, 42, 0.08);
                border: 1px solid #e5e7eb;
            @endif
        }

        /* ==========================================
           Header
        ========================================== */

        .header {
            text-align: center;

            padding-bottom: {{ $isReceipt ? '12px' : '20px' }};

            border-bottom:
                {{ $isReceipt
                    ? '1px dashed #94a3b8'
                    : '2px solid #198754'
                }};

            margin-bottom: {{ $isReceipt ? '12px' : '20px' }};
        }

        .header h4 {
            margin: 0 0 6px;

            font-size: {{ $isReceipt ? '15px' : '24px' }};

            font-weight: 700;

            color: #198754;

            letter-spacing: 0.2px;
        }

        .header p {
            margin: 2px 0;

            font-size: {{ $isReceipt ? '10px' : '12.5px' }};

            color: #64748b;

            line-height: 1.5;
        }

        .invoice-label {
            display: inline-block;

            margin-top: 8px;

            padding: {{ $isReceipt ? '3px 8px' : '5px 12px' }};

            border-radius: 6px;

            background: #ecfdf5;

            color: #15803d;

            font-size: {{ $isReceipt ? '10px' : '12px' }};

            font-weight: 700;

            letter-spacing: 0.8px;

            text-transform: uppercase;
        }

        /* ==========================================
           Invoice Information
        ========================================== */

        .meta-block {
            margin-bottom: {{ $isReceipt ? '12px' : '18px' }};
        }

        .meta-grid {
            display: flex;

            justify-content: space-between;

            align-items: flex-start;

            gap: 10px;

            font-size: {{ $isReceipt ? '10px' : '12.5px' }};

            margin-bottom: 5px;

            color: #334155;
        }

        .meta-grid:last-child {
            margin-bottom: 0;
        }

        .meta-grid .label {
            color: #94a3b8;

            margin-right: 4px;
        }

        /* ==========================================
           Table
        ========================================== */

        table {
            width: 100%;

            border-collapse: collapse;

            margin: {{ $isReceipt ? '10px 0' : '18px 0' }};
        }

        thead th {
            font-size: {{ $isReceipt ? '9.5px' : '12px' }};

            font-weight: 700;

            color: {{ $isReceipt ? '#334155' : '#ffffff' }};

            background: {{ $isReceipt ? 'transparent' : '#198754' }};

            text-align: left;

            padding: {{ $isReceipt ? '5px 2px' : '10px 12px' }};

            border-bottom:
                {{ $isReceipt
                    ? '1px dashed #64748b'
                    : 'none'
                }};
        }

        thead th:first-child {
            border-radius:
                {{ $isReceipt
                    ? '0'
                    : '7px 0 0 7px'
                }};
        }

        thead th:last-child {
            border-radius:
                {{ $isReceipt
                    ? '0'
                    : '0 7px 7px 0'
                }};
        }

        tbody td {
            padding: {{ $isReceipt ? '6px 2px' : '11px 12px' }};

            font-size: {{ $isReceipt ? '10.5px' : '13px' }};

            color: #334155;

            border-bottom:
                {{ $isReceipt
                    ? '1px solid #f1f5f9'
                    : '1px solid #f1f5f9'
                }};

            vertical-align: middle;
        }

        tbody tr:last-child td {
            border-bottom:
                {{ $isReceipt
                    ? '1px dashed #64748b'
                    : 'none'
                }};
        }

        .num {
            text-align: right;

            font-variant-numeric: tabular-nums;

            white-space: nowrap;
        }

        /* ==========================================
           Totals
        ========================================== */

        .totals {
            margin-top: {{ $isReceipt ? '9px' : '16px' }};

            font-size: {{ $isReceipt ? '11px' : '13.5px' }};
        }

        .totals-inner {
            @if(!$isReceipt)
                width: 280px;
                margin-left: auto;
            @endif
        }

        .totals-row {
            display: flex;

            justify-content: space-between;

            align-items: center;

            padding: {{ $isReceipt ? '3px 0' : '5px 0' }};

            color: #475569;
        }

        .totals-row span:last-child {
            font-variant-numeric: tabular-nums;

            font-weight: 500;
        }

        .totals-row.grand {
            font-weight: 700;

            font-size: {{ $isReceipt ? '13px' : '17px' }};

            color: #198754;

            border-top:
                {{ $isReceipt
                    ? '1px solid #334155'
                    : '2px solid #198754'
                }};

            margin-top: 7px;

            padding-top: {{ $isReceipt ? '7px' : '10px' }};
        }

        .totals-row.grand span:last-child {
            font-weight: 700;
        }

        /* ==========================================
           Footer
        ========================================== */

        .footer {
            text-align: center;

            margin-top: {{ $isReceipt ? '16px' : '28px' }};

            padding-top: {{ $isReceipt ? '11px' : '17px' }};

            border-top:
                {{ $isReceipt
                    ? '1px dashed #94a3b8'
                    : '1px solid #e5e7eb'
                }};

            font-size: {{ $isReceipt ? '9.5px' : '12px' }};

            color: #94a3b8;

            line-height: 1.7;
        }

        .thanks {
            display: block;

            margin-bottom: 4px;

            color: #198754;

            font-size: {{ $isReceipt ? '11px' : '13px' }};

            font-weight: 700;
        }

        /* ==========================================
           Print Button
        ========================================== */

        .no-print {
            text-align: center;

            margin-bottom: 16px;
        }

        .print-btn {
            display: inline-flex;

            align-items: center;

            justify-content: center;

            gap: 7px;

            padding: 9px 20px;

            background: #198754;

            color: #ffffff;

            border: none;

            border-radius: 8px;

            font-family: inherit;

            font-size: 13px;

            font-weight: 600;

            cursor: pointer;

            box-shadow: 0 4px 12px rgba(25, 135, 84, 0.25);

            transition: all 0.2s ease;
        }

        .print-btn:hover {
            background: #157347;

            transform: translateY(-1px);

            box-shadow: 0 6px 16px rgba(25, 135, 84, 0.30);
        }

        .print-btn:active {
            transform: translateY(0);
        }

        /* ==========================================
           Print
        ========================================== */

        @media print {

            html,
            body {
                background: #ffffff;
            }

            body {
                padding: 0;
            }

            .no-print {
                display: none !important;
            }

            .box {
                width: 100%;

                max-width: 100%;

                margin: 0;

                box-shadow: none;

                border: none;

                border-radius: 0;
            }

            @page {
                size: {{ $isReceipt ? '80mm auto' : 'A4' }};

                margin: {{ $isReceipt ? '0' : '12mm' }};
            }
        }

        /* ==========================================
           Small Screen
        ========================================== */

        @media screen and (max-width: 600px) {

            body {
                padding: 10px;
            }

            .box {
                padding: 18px;
            }

            .meta-grid {
                flex-direction: column;

                gap: 2px;
            }
        }
    </style>
</head>


<body onload="window.print()">

    {{-- Print Button --}}
    <div class="no-print">

        <button onclick="window.print()" class="print-btn">
            <span>🖨️</span>
            <span>បោះពុម្ព</span>
        </button>

    </div>


    {{-- Receipt / Invoice --}}
    <div class="box">

        {{-- ================================
             Header
        ================================= --}}
        <div class="header">

            <h4>
                {{ $general->system_name ?? config('app.name', 'Clinic') }}
            </h4>

            @if(!empty($general->address))
                <p>
                    {{ $general->address }}
                </p>
            @endif

            @if(!empty($general->phone))
                <p>
                    Tel: {{ $general->phone }}
                </p>
            @endif

            <span class="invoice-label">
                វិក្កយបត្រ
            </span>

        </div>


        {{-- ================================
             Invoice Information
        ================================= --}}
        <div class="meta-block">

            <div class="meta-grid">

                <span>
                    <span class="label">លេខ:</span>
                    {{ $billing->invoice_prefix }}{{ str_pad($sale->sale_id, 6, '0', STR_PAD_LEFT) }}
                </span>

                <span>
                    {{ $sale->sale_date->format('d-M-Y h:i A') }}
                </span>

            </div>


            <div class="meta-grid">

                <span>
                    <span class="label">អតិថិជន:</span>
                    {{ $sale->patient->full_name ?? 'អតិថិជនចរណ៍' }}
                </span>

            </div>

        </div>


        {{-- ================================
             Medicine Table
        ================================= --}}
        <table>

            <thead>
                <tr>

                    <th>
                        ថ្នាំ
                    </th>

                    <th class="num">
                        ចំនួន
                    </th>

                    <th class="num">
                        តម្លៃ
                    </th>

                    <th class="num">
                        សរុប
                    </th>

                </tr>
            </thead>


            <tbody>

                @foreach($sale->items as $item)

                    <tr>

                        <td>
                            {{ $item->medicine->medicine_name ?? '-' }}
                        </td>

                        <td class="num">
                            {{ $item->quantity }}
                        </td>

                        <td class="num">
                            {{ $cur }}{{ number_format($item->unit_price, 2) }}
                        </td>

                        <td class="num">
                            {{ $cur }}{{ number_format($item->subtotal, 2) }}
                        </td>

                    </tr>

                @endforeach

            </tbody>

        </table>


        {{-- ================================
             Totals
        ================================= --}}
        <div class="totals">

            <div class="totals-inner">

                <div class="totals-row">

                    <span>
                        សរុបរង
                    </span>

                    <span>
                        {{ $cur }}{{ number_format($subtotal, 2) }}
                    </span>

                </div>


                @if($taxPct > 0)

                    <div class="totals-row">

                        <span>
                            ពន្ធ ({{ $taxPct }}%)
                        </span>

                        <span>
                            {{ $cur }}{{ number_format($taxAmount, 2) }}
                        </span>

                    </div>

                @endif


                <div class="totals-row grand">

                    <span>
                        សរុបចុងក្រោយ
                    </span>

                    <span>
                        {{ $cur }}{{ number_format($grandTotal, 2) }}
                    </span>

                </div>

            </div>

        </div>


        {{-- ================================
             Footer
        ================================= --}}
        <div class="footer">

            @if(!empty($billing->invoice_footer))

                <span class="thanks">
                    សូមអរគុណ!
                </span>

                {{ $billing->invoice_footer }}

            @endif

        </div>

    </div>

</body>

</html>