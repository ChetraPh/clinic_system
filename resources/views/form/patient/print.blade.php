<!DOCTYPE html>
<html lang="km">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        ប័ណ្ណព័ត៌មានអ្នកជំងឺ - {{ $patient->full_name }}
    </title>

    <style>

        :root {
            --clinic-green: #006D36;
            --clinic-green-dark: #00552B;
            --clinic-green-light: #E8F5EE;
            --clinic-border: #E1E8E4;
            --clinic-text: #1F2A24;
            --clinic-muted: #6F7D75;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Khmer OS Battambang', Arial, sans-serif;
            font-size: 14px;
            color: var(--clinic-text);
            margin: 0;
            padding: 25px;
            background: #F5F7F6;
        }

        /* =========================
           Print Controls
        ========================= */

        .print-controls {
            max-width: 800px;
            margin: 0 auto 18px;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
        }

        .btn-print,
        .btn-back {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 10px 18px;
            border-radius: 9px;
            text-decoration: none;
            font-family: Arial, sans-serif;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            border: 0;
            transition: all .2s ease;
        }

        .btn-print {
            background: var(--clinic-green);
            color: #fff;
        }

        .btn-print:hover {
            background: var(--clinic-green-dark);
        }

        .btn-back {
            background: #fff;
            color: var(--clinic-muted);
            border: 1px solid var(--clinic-border);
        }

        .btn-back:hover {
            color: var(--clinic-green);
            border-color: var(--clinic-green);
        }

        /* =========================
           Main Paper
        ========================= */

        .patient-card {
            width: 100%;
            max-width: 800px;
            min-height: 950px;
            margin: auto;
            padding: 35px;
            background: #fff;
            border: 1px solid var(--clinic-border);
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(31, 42, 36, .07);
        }

        /* =========================
           Clinic Header
        ========================= */

        .clinic-header {
            text-align: center;
            padding: 20px 15px 18px;
            border-radius: 12px;
            background: linear-gradient(
                135deg,
                #006D36 0%,
                #008747 100%
            );
            color: #fff;
            margin-bottom: 25px;
        }

        .clinic-header h2 {
            margin: 0 0 4px;
            font-size: 21px;
            font-weight: 700;
            color: #fff;
        }

        .clinic-header .clinic-name-en {
            margin: 0 0 9px;
            font-family: Arial, sans-serif;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: .5px;
            color: rgba(255,255,255,.9);
        }

        .clinic-header p {
            margin: 3px 0;
            font-size: 11px;
            line-height: 1.6;
            color: rgba(255,255,255,.88);
        }

        .clinic-icon {
            width: 42px;
            height: 42px;
            margin: 0 auto 9px;
            border-radius: 50%;
            background: rgba(255,255,255,.15);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: Arial, sans-serif;
            font-size: 19px;
        }

        /* =========================
           Document Title
        ========================= */

        .document-title {
            text-align: center;
            margin: 22px 0 20px;
        }

        .document-title h3 {
            display: inline-block;
            margin: 0;
            padding: 9px 22px;
            border-radius: 9px;
            background: var(--clinic-green-light);
            border: 1px solid #D4EADD;
            color: var(--clinic-green-dark);
            font-size: 17px;
            font-weight: 700;
        }

        .document-title .subtitle {
            margin-top: 5px;
            font-family: Arial, sans-serif;
            font-size: 10px;
            color: var(--clinic-muted);
            letter-spacing: .5px;
        }

        /* =========================
           Patient Information
        ========================= */

        .section-title {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 10px;
            padding-bottom: 8px;
            border-bottom: 2px solid var(--clinic-green);
            color: var(--clinic-green-dark);
            font-weight: 700;
            font-size: 14px;
        }

        .section-title-icon {
            width: 27px;
            height: 27px;
            border-radius: 7px;
            background: var(--clinic-green-light);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        .info-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            margin-bottom: 28px;
            border: 1px solid var(--clinic-border);
            border-radius: 10px;
            overflow: hidden;
        }

        .info-table td {
            width: 50%;
            padding: 12px 13px;
            vertical-align: top;
            border-bottom: 1px solid var(--clinic-border);
            font-size: 12.5px;
            line-height: 1.6;
        }

        .info-table td:first-child {
            border-right: 1px solid var(--clinic-border);
        }

        .info-table tr:last-child td {
            border-bottom: 0;
        }

        .info-table strong {
            color: var(--clinic-green-dark);
            font-weight: 700;
        }

        .patient-code {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 6px;
            background: var(--clinic-green-light);
            border: 1px solid #D4EADD;
            color: var(--clinic-green-dark);
            font-family: Arial, sans-serif;
            font-weight: 700;
            font-size: 11px;
        }

        /* =========================
           Notice
        ========================= */

        .notice-box {
            background: #F8FAF9;
            border: 1px solid var(--clinic-border);
            border-left: 4px solid var(--clinic-green);
            border-radius: 9px;
            padding: 14px 15px;
            margin-top: 20px;
        }

        .notice-box p {
            margin: 0;
            color: var(--clinic-muted);
            font-size: 12px;
            line-height: 1.9;
            text-align: justify;
        }

        /* =========================
           Footer / Signature
        ========================= */

        .footer {
            margin-top: 65px;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            width: 100%;
        }

        .staff-signature {
            width: 45%;
            text-align: center;
            padding-top: 25px;
        }

        .patient-signature {
            width: 45%;
            text-align: center;
        }

        .signature-title {
            font-size: 12px;
            font-weight: 700;
            line-height: 1.6;
        }

        .signature-date {
            font-size: 11px;
            margin-bottom: 8px;
        }

        .signature-line {
            margin-top: 55px;
            font-family: Arial, sans-serif;
            color: #555;
            letter-spacing: 1px;
        }

        .footer-note {
            margin-top: 35px;
            text-align: center;
            font-family: Arial, sans-serif;
            font-size: 9px;
            color: #9AA49F;
        }

        /* =========================
           Print
        ========================= */

        @media print {

            @page {
                size: A4;
                margin: 12mm;
            }

            body {
                background: #fff;
                padding: 0;
            }

            .no-print {
                display: none !important;
            }

            .patient-card {
                max-width: none;
                min-height: auto;
                padding: 15px;
                border: 0;
                border-radius: 0;
                box-shadow: none;
            }

            .clinic-header {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .document-title h3 {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .patient-code,
            .section-title-icon,
            .notice-box {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .info-table {
                page-break-inside: avoid;
            }

            .footer {
                page-break-inside: avoid;
            }

        }

        /* =========================
           Mobile
        ========================= */

        @media screen and (max-width: 650px) {

            body {
                padding: 12px;
            }

            .patient-card {
                padding: 20px;
                border-radius: 12px;
            }

            .print-controls {
                flex-direction: column;
            }

            .btn-print,
            .btn-back {
                width: 100%;
            }

            .clinic-header h2 {
                font-size: 18px;
            }

            .clinic-header p {
                font-size: 10px;
            }

            .info-table td {
                display: block;
                width: 100%;
                border-right: 0 !important;
            }

            .info-table td:last-child {
                border-bottom: 0;
            }

            .footer {
                flex-direction: column;
                gap: 35px;
            }

            .staff-signature,
            .patient-signature {
                width: 100%;
            }

        }

    </style>

</head>


<body onload="window.print()">


    {{-- =========================
         Print Controls
    ========================= --}}
    <div class="print-controls no-print">

        <button onclick="window.print()"
                class="btn-print">

            🖨️
            បោះពុម្ព
            (Print Patient Card)

        </button>


        <a href="{{ route('patients.index') }}"
           class="btn-back">

            ←
            ត្រឡប់ក្រោយ

        </a>

    </div>


    {{-- =========================
         Patient Card
    ========================= --}}
    <div class="patient-card">


        {{-- Clinic Header --}}
        <div class="clinic-header">

            <div class="clinic-icon">
                ✚
            </div>

            <h2>
                មន្ទីរសម្រាកព្យាបាល ព្រំ សន្តិភាព
            </h2>

            <p class="clinic-name-en">
                PRUM SANTEPHEAP CLINIC
            </p>

            <p>
                ផ្ទះលេខ ១០២ ផ្លូវបេតុង ភូមិ ០៤
                សង្កាត់ ទួលសង្កែ ខណ្ឌ ប្ញស្សីកែវ
                រាជធានីភ្នំពេញ
            </p>

            <p>
                Tel: 088 28 07 495 / 096 50 68 839 / 095 45 22 96
            </p>

        </div>


        {{-- Document Title --}}
        <div class="document-title">

            <h3>
                ព័ត៌មានអ្នកជំងឺ
            </h3>

            <div class="subtitle">
                PATIENT INFORMATION
            </div>

        </div>


        {{-- Patient Information --}}
        <div class="section-title">

            <span class="section-title-icon">
                👤
            </span>

            ព័ត៌មានផ្ទាល់ខ្លួនរបស់អ្នកជំងឺ

        </div>


        <table class="info-table">

            <tr>

                <td>

                    <strong>
                        លេខកូដ (Code):
                    </strong>

                    <span class="patient-code">
                        {{ $patient->patient_code }}
                    </span>

                </td>


                <td>

                    <strong>
                        ថ្ងៃខែឆ្នាំចុះឈ្មោះ:
                    </strong>

                    {{ $patient->created_at
                        ? $patient->created_at->format('d/m/Y')
                        : '-' }}

                </td>

            </tr>


            <tr>

                <td>

                    <strong>
                        ឈ្មោះពេញ (Name):
                    </strong>

                    {{ $patient->full_name }}

                </td>


                <td>

                    <strong>
                        ភេទ / ថ្ងៃខែឆ្នាំកំណើត:
                    </strong>

                    {{ $patient->sex == 'Male'
                        ? 'ប្រុស'
                        : 'ស្រី' }}

                    |

                    {{ $patient->date_of_birth }}

                </td>

            </tr>


            <tr>

                <td>

                    <strong>
                        លេខទូរសព្ទ (Tel):
                    </strong>

                    {{ $patient->phone ?? '-' }}

                </td>


                <td>

                    <strong>
                        អាសយដ្ឋាន (Address):
                    </strong>

                    {{ $patient->address ?? '-' }}

                </td>

            </tr>

        </table>


        {{-- Notice --}}
        <div class="section-title">

            <span class="section-title-icon">
                ✓
            </span>

            លក្ខខណ្ឌ និងការយល់ព្រម

        </div>


        <div class="notice-box">

            <p>
                យើងខ្ញុំសុំអនុញ្ញាតដោយមន្ទីរសម្រាកព្យាបាល ព្រំ សន្តិភាព
                ព្យាបាលទៅតាមលក្ខខណ្ឌ និងសម្បទាភាវារបស់គ្រូពេទ្យ។
                យើងខ្ញុំដឹងដែថា មន្ទីរសម្រាកព្យាបាល ព្រំ សន្តិភាព
                ជួយសង្គ្រោះអ្នកជំងឺមានគំនិតស្ម័គ្រចិត្តទទួលយក
                ទាំងក្នុងពេលនេះ និងពេលអនាគតៀរយេៗ។
            </p>

        </div>


        {{-- Footer Signatures --}}
        <div class="footer">

            <div class="staff-signature">

                <p class="signature-title">
                    បោះត្រា និងហត្ថលេខា
                    <br>
                    បុគ្គលិកទទួលបន្ទុក
                </p>

                <div class="signature-line">
                    ........................................
                </div>

            </div>


            <div class="patient-signature">

                <p class="signature-date">

                    ភ្នំពេញ, ថ្ងៃទី
                    {{ date('d') }}
                    ខែ
                    {{ date('m') }}
                    ឆ្នាំ
                    {{ date('Y') }}

                </p>

                <p class="signature-title">

                    ហត្ថលេខាអ្នកជំងឺ
                    <br>
                    ឬសាច់ញាតិ

                </p>

                <div class="signature-line">
                    ........................................
                </div>

            </div>

        </div>


        <div class="footer-note">
            PRUM SANTEPHEAP CLINIC · PATIENT INFORMATION CARD
        </div>

    </div>


</body>

</html>
