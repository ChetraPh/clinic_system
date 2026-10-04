@extends('adminlte::page')

@section('title', 'Billing Settings')

@section('content')

<div class="container-fluid pt-3">

    {{-- ================= PAGE HEADER ================= --}}
    <div class="billing-header mb-4">

        <div class="billing-header-content">

            <div class="d-flex align-items-center">

                <div class="billing-header-icon">
                    <i class="fas fa-file-invoice-dollar"></i>
                </div>

                <div>
                    <h2>Billing Settings</h2>
                    <p>គ្រប់គ្រងការកំណត់វិក្កយបត្រ រូបិយវត្ថុ និងអត្រាប្តូរប្រាក់</p>
                </div>

            </div>

            <button
                type="button"
                class="btn btn-save-settings"
                id="btnSaveSettings"
            >
                <i class="fas fa-save mr-2"></i>
                រក្សាទុក
            </button>

        </div>

    </div>


    {{-- ================= ERROR ================= --}}
    <div
        class="alert settings-error d-none"
        id="settingsErrors"
    ></div>


    {{-- ================= SETTINGS CARD ================= --}}
    <div class="billing-card">

        <div class="billing-card-header">

            <div class="billing-card-title">

                <div class="billing-card-icon">
                    <i class="fas fa-cog"></i>
                </div>

                <div>
                    <h5>ការកំណត់ការទូទាត់</h5>
                    <p>កំណត់ព័ត៌មានដែលប្រើនៅក្នុងវិក្កយបត្រ</p>
                </div>

            </div>

        </div>


        <div class="billing-card-body">

            <form id="settingsForm">

                <div class="row">

                    {{-- ================= CURRENCY ================= --}}
                    <div class="col-lg-6">

                        <div class="form-group billing-form-group">

                            <label for="f_currency">
                                រូបិយវត្ថុចម្បង
                            </label>

                            <div class="input-with-icon">

                                <span class="input-icon">
                                    <i class="fas fa-dollar-sign"></i>
                                </span>

                                <input
                                    type="text"
                                    name="currency_symbol"
                                    id="f_currency"
                                    class="form-control"
                                    placeholder="$"
                                    value="{{ $settings->currency_symbol ?? '$' }}"
                                    required
                                >

                            </div>

                            <small class="form-help">
                                ឧទាហរណ៍: $, USD
                            </small>

                        </div>

                    </div>


                    {{-- ================= TAX ================= --}}
                    <div class="col-lg-6">

                        <div class="form-group billing-form-group">

                            <label for="f_tax">
                                ពន្ធ (%)
                            </label>

                            <div class="input-with-icon">

                                <span class="input-icon">
                                    <i class="fas fa-percent"></i>
                                </span>

                                <input
                                    type="number"
                                    step="0.01"
                                    min="0"
                                    max="100"
                                    name="tax_percent"
                                    id="f_tax"
                                    class="form-control"
                                    placeholder="0"
                                    value="{{ $settings->tax_percent ?? 0 }}"
                                    required
                                >

                            </div>

                            <small class="form-help">
                                កំណត់ពន្ធចាប់ពី 0% ដល់ 100%
                            </small>

                        </div>

                    </div>


                    {{-- ================= SECONDARY CURRENCY ================= --}}
                    <div class="col-lg-6">

                        <div class="form-group billing-form-group">

                            <label for="f_currency2">
                                រូបិយវត្ថុទីពីរ
                            </label>

                            <div class="input-with-icon">

                                <span class="input-icon">
                                    <i class="fas fa-money-bill-wave"></i>
                                </span>

                                <input
                                    type="text"
                                    name="secondary_currency_symbol"
                                    id="f_currency2"
                                    class="form-control"
                                    placeholder="៛"
                                    value="{{ $settings->secondary_currency_symbol ?? '៛' }}"
                                    required
                                >

                            </div>

                            <small class="form-help">
                                ឧទាហរណ៍: ៛, KHR
                            </small>

                        </div>

                    </div>


                    {{-- ================= EXCHANGE RATE ================= --}}
                    <div class="col-lg-6">

                        <div class="form-group billing-form-group">

                            <label for="f_rate">
                                អត្រាប្តូរប្រាក់
                                <span class="exchange-label">
                                    (1 <span id="f_cur1_label">$</span>
                                    = ? <span id="f_cur2_label">៛</span>)
                                </span>
                            </label>

                            <div class="input-with-icon">

                                <span class="input-icon">
                                    <i class="fas fa-exchange-alt"></i>
                                </span>

                                <input
                                    type="number"
                                    step="0.01"
                                    min="0.01"
                                    name="exchange_rate"
                                    id="f_rate"
                                    class="form-control"
                                    placeholder="4100.00"
                                    value="{{ $settings->exchange_rate ?? 4100 }}"
                                    required
                                >

                            </div>

                            <small class="form-help">
                                ឧទាហរណ៍: 1 USD = 4100 KHR
                            </small>

                        </div>

                    </div>


                    {{-- ================= INVOICE FOOTER ================= --}}
                    <div class="col-12">

                        <div class="form-group billing-form-group">

                            <label for="f_footer">
                                វិក្កយបត្រ Footer
                            </label>

                            <div class="input-with-icon">

                                <span class="input-icon input-icon-top">
                                    <i class="fas fa-comment-alt"></i>
                                </span>

                                <input
                                    type="text"
                                    name="invoice_footer"
                                    id="f_footer"
                                    class="form-control"
                                    placeholder="សូមអរគុណ!"
                                    value="{{ $settings->invoice_footer ?? '' }}"
                                >

                            </div>

                            <small class="form-help">
                                អត្ថបទដែលបង្ហាញនៅផ្នែកខាងក្រោមវិក្កយបត្រ
                            </small>

                        </div>

                    </div>

                </div>


                {{-- ================= EXCHANGE PREVIEW ================= --}}
                <div class="exchange-preview" id="rateHint">

                    <div class="preview-icon">
                        <i class="fas fa-sync-alt"></i>
                    </div>

                    <div class="preview-content">

                        <div class="preview-label">
                            Exchange Rate Preview
                        </div>

                        <div class="preview-value">

                            1
                            <span class="p-cur1">$</span>

                            <span class="preview-equals">=</span>

                            <strong id="p_converted">
                                4,100.00
                            </strong>

                            <span class="p-cur2">៛</span>

                        </div>

                    </div>

                </div>

            </form>

        </div>

    </div>


    {{-- ================= BOTTOM NOTE ================= --}}
    <div class="billing-note mt-3">

        <i class="fas fa-shield-alt mr-2"></i>

        ការកំណត់ទាំងនេះនឹងត្រូវបានប្រើសម្រាប់ការគណនា
        និងបង្ហាញព័ត៌មាននៅក្នុងវិក្កយបត្រ។

    </div>

</div>

@stop


@section('css')
@parent

<style>

    :root {
        --billing-green: #006D36;
        --billing-green-dark: #00552B;
        --billing-green-light: #E8F5EE;
        --billing-bg: #F5F7F6;
        --billing-border: #E7ECE9;
        --billing-text: #1F2A24;
        --billing-muted: #7A8780;
    }


    /* ========================================
       PAGE HEADER
    ======================================== */

    .billing-header {
        background: linear-gradient(
            135deg,
            #006D36 0%,
            #008747 100%
        );

        border-radius: 16px;
        padding: 22px 25px;

        color: #fff;

        box-shadow:
            0 8px 22px rgba(0, 109, 54, .12);
    }

    .billing-header-content {
        display: flex;
        align-items: center;
        justify-content: space-between;

        gap: 20px;
    }

    .billing-header-icon {
        width: 55px;
        height: 55px;

        display: flex;
        align-items: center;
        justify-content: center;

        margin-right: 15px;

        border-radius: 14px;

        background: rgba(255, 255, 255, .16);
        border: 1px solid rgba(255, 255, 255, .22);

        font-size: 22px;
    }

    .billing-header h2 {
        margin: 0 0 4px;

        font-size: 23px;
        font-weight: 800;
    }

    .billing-header p {
        margin: 0;

        font-size: 13px;
        opacity: .88;
    }


    /* ========================================
       SAVE BUTTON
    ======================================== */

    .btn-save-settings {
        display: inline-flex;
        align-items: center;

        padding: 10px 17px;

        background: #fff;
        border: 1px solid #fff;

        color: var(--billing-green);

        border-radius: 9px;

        font-size: 12px;
        font-weight: 800;

        box-shadow:
            0 4px 12px rgba(0, 0, 0, .08);

        transition: all .18s ease;
    }

    .btn-save-settings:hover,
    .btn-save-settings:focus {
        background: var(--billing-green-light);
        border-color: var(--billing-green-light);

        color: var(--billing-green-dark);

        transform: translateY(-1px);
        box-shadow:
            0 6px 15px rgba(0, 0, 0, .12);
    }


    /* ========================================
       ERROR
    ======================================== */

    .settings-error {
        margin-bottom: 20px;

        padding: 13px 16px;

        background: #FFF1F1;
        border: 1px solid #F3C7CB;
        border-left: 4px solid #DC3545;

        border-radius: 10px;

        color: #A51D2A;

        font-size: 12px;
        line-height: 1.6;
    }


    /* ========================================
       MAIN CARD
    ======================================== */

    .billing-card {
        background: #fff;

        border: 1px solid var(--billing-border);
        border-radius: 15px;

        box-shadow:
            0 5px 18px rgba(31, 42, 36, .05);

        overflow: hidden;
    }

    .billing-card-header {
        padding: 18px 22px;

        background: #fff;

        border-bottom: 1px solid var(--billing-border);
    }

    .billing-card-title {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .billing-card-icon {
        width: 42px;
        height: 42px;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 10px;

        background: var(--billing-green-light);
        color: var(--billing-green);

        font-size: 17px;
    }

    .billing-card-title h5 {
        margin: 0 0 3px;

        color: var(--billing-text);

        font-size: 15px;
        font-weight: 800;
    }

    .billing-card-title p {
        margin: 0;

        color: var(--billing-muted);

        font-size: 11px;
    }

    .billing-card-body {
        padding: 25px 22px;
    }


    /* ========================================
       FORM
    ======================================== */

    .billing-form-group {
        margin-bottom: 24px;
    }

    .billing-form-group label {
        display: block;

        margin-bottom: 8px;

        color: var(--billing-text);

        font-size: 12px;
        font-weight: 800;
    }

    .exchange-label {
        color: var(--billing-muted);
        font-weight: 600;
    }

    .input-with-icon {
        position: relative;
    }

    .input-icon {
        position: absolute;

        left: 0;
        top: 0;

        width: 44px;
        height: 45px;

        display: flex;
        align-items: center;
        justify-content: center;

        color: var(--billing-green);

        font-size: 13px;

        z-index: 2;
    }

    .input-icon-top {
        align-items: center;
    }

    .billing-form-group .form-control {
        height: 45px;

        padding-left: 44px;

        border: 1px solid var(--billing-border);
        border-radius: 9px;

        background: #fff;

        color: var(--billing-text);

        font-size: 13px;

        box-shadow: none;

        transition: all .18s ease;
    }

    .billing-form-group .form-control::placeholder {
        color: #A5ADA8;
    }

    .billing-form-group .form-control:hover {
        border-color: #CFD9D3;
    }

    .billing-form-group .form-control:focus {
        border-color: var(--billing-green);

        box-shadow:
            0 0 0 .15rem rgba(0, 109, 54, .08);
    }

    .form-help {
        display: block;

        margin-top: 7px;

        color: var(--billing-muted);

        font-size: 10px;
    }


    /* ========================================
       EXCHANGE PREVIEW
    ======================================== */

    .exchange-preview {
        display: flex;
        align-items: center;

        gap: 13px;

        margin-top: 3px;
        padding: 16px 18px;

        background: var(--billing-green-light);

        border: 1px solid #D5EBDD;
        border-left: 4px solid var(--billing-green);

        border-radius: 11px;
    }

    .preview-icon {
        width: 40px;
        height: 40px;

        min-width: 40px;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 10px;

        background: #fff;
        color: var(--billing-green);

        font-size: 15px;
    }

    .preview-label {
        margin-bottom: 3px;

        color: #648072;

        font-size: 10px;
        font-weight: 700;

        text-transform: uppercase;
        letter-spacing: .35px;
    }

    .preview-value {
        color: var(--billing-text);

        font-size: 15px;
        font-weight: 700;
    }

    .preview-value strong {
        color: var(--billing-green);

        font-size: 17px;
    }

    .preview-equals {
        margin: 0 8px;

        color: var(--billing-muted);

        font-weight: 500;
    }

    .p-cur1,
    .p-cur2 {
        color: var(--billing-green-dark);
        font-weight: 800;
    }


    /* ========================================
       BOTTOM NOTE
    ======================================== */

    .billing-note {
        padding: 12px 15px;

        background: #F8FAF9;

        border: 1px solid var(--billing-border);
        border-radius: 9px;

        color: var(--billing-muted);

        font-size: 11px;
    }

    .billing-note i {
        color: var(--billing-green);
    }


    /* ========================================
       TOAST
    ======================================== */

    .toast-container-custom {
        position: fixed;

        top: 20px;
        right: 20px;

        z-index: 99999;

        display: flex;
        flex-direction: column;

        gap: 10px;
    }

    .toast-custom {
        min-width: 290px;

        display: flex;
        align-items: center;

        gap: 10px;

        padding: 13px 16px;

        border-radius: 10px;

        color: #fff;

        font-size: 13px;
        font-weight: 600;

        box-shadow:
            0 8px 25px rgba(0, 0, 0, .15);
    }

    .toast-custom.success {
        background: linear-gradient(
            135deg,
            #006D36,
            #008747
        );
    }

    .toast-custom.error {
        background: linear-gradient(
            135deg,
            #B42318,
            #DC3545
        );
    }

    .toast-custom i {
        font-size: 17px;
    }


    /* ========================================
       RESPONSIVE
    ======================================== */

    @media (max-width: 767.98px) {

        .billing-header {
            padding: 18px;
        }

        .billing-header-content {
            align-items: flex-start;

            flex-direction: column;
        }

        .billing-header h2 {
            font-size: 20px;
        }

        .btn-save-settings {
            width: 100%;
            justify-content: center;
        }

        .billing-card-body {
            padding: 20px 16px;
        }

        .billing-card-header {
            padding: 16px;
        }

        .billing-form-group {
            margin-bottom: 20px;
        }

        .toast-container-custom {
            left: 15px;
            right: 15px;
            top: 15px;
        }

        .toast-custom {
            min-width: 0;
            width: 100%;
        }
    }

</style>
@stop


@section('js')
@parent

<script>

    $(function () {

        const csrf = "{{ csrf_token() }}";

        const routeUpdate =
            "{{ route('settingsbillings.update') }}";


        // ========================================
        // TOAST
        // ========================================

        function showToast(message, type = "success") {

            if (!$("#toastContainer").length) {

                $("body").append(
                    '<div id="toastContainer" class="toast-container-custom"></div>'
                );
            }


            const icon =
                type === "success"
                    ? "fa-check-circle"
                    : "fa-times-circle";


            const $toast = $(`
                <div class="toast-custom ${type}">
                    <i class="fas ${icon}"></i>
                    <span></span>
                </div>
            `);


            $toast
                .find("span")
                .text(message);


            $("#toastContainer")
                .append($toast);


            setTimeout(() => {

                $toast.fadeOut(
                    200,
                    function () {
                        $(this).remove();
                    }
                );

            }, 3000);
        }


        // ========================================
        // EXCHANGE RATE PREVIEW
        // ========================================

        function renderPreview() {

            const cur1 =
                $('#f_currency').val() || '$';

            const cur2 =
                $('#f_currency2').val() || '៛';

            const rate =
                parseFloat($('#f_rate').val()) || 0;


            $('#f_cur1_label')
                .text(cur1);

            $('#f_cur2_label')
                .text(cur2);


            $('.p-cur1')
                .text(cur1);

            $('.p-cur2')
                .text(cur2);


            $('#p_converted').text(
                rate.toLocaleString(
                    'en-US',
                    {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    }
                )
            );
        }


        // ========================================
        // LIVE PREVIEW
        // ========================================

        $('#settingsForm input')
            .on(
                'input change',
                renderPreview
            );


        renderPreview();


        // ========================================
        // SAVE SETTINGS
        // ========================================

        $('#btnSaveSettings').on(
            'click',
            function () {

                const $btn =
                    $(this);


                const data = {

                    _token: csrf,

                    currency_symbol:
                        $('#f_currency').val(),

                    secondary_currency_symbol:
                        $('#f_currency2').val(),

                    exchange_rate:
                        $('#f_rate').val(),

                    tax_percent:
                        $('#f_tax').val(),

                    invoice_footer:
                        $('#f_footer').val(),
                };


                $('#settingsErrors')
                    .addClass('d-none')
                    .empty();


                $btn
                    .prop('disabled', true)
                    .html(
                        '<i class="fas fa-spinner fa-spin mr-2"></i> កំពុងរក្សាទុក...'
                    );


                $.ajax({

                    url: routeUpdate,

                    method: 'POST',

                    data: data

                })

                .done(function () {

                    showToast(
                        'រក្សាទុកជោគជ័យ',
                        'success'
                    );

                })

                .fail(function (xhr) {

                    let msg =
                        'មានបញ្ហា សូមព្យាយាមម្តងទៀត';


                    if (
                        xhr.responseJSON?.errors
                    ) {

                        msg =
                            Object.values(
                                xhr.responseJSON.errors
                            )
                            .flat()
                            .join('<br>');
                    }


                    $('#settingsErrors')
                        .html(msg)
                        .removeClass('d-none');


                    showToast(
                        'រក្សាទុកមិនបានសម្រេច',
                        'error'
                    );

                })

                .always(function () {

                    $btn
                        .prop('disabled', false)
                        .html(
                            '<i class="fas fa-save mr-2"></i> រក្សាទុក'
                        );
                });

            }
        );

    });

</script>

@stop