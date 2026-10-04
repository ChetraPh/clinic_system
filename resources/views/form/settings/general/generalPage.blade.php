@extends('adminlte::page')

@section('title', 'General Settings')

@section('content')

<style>
    :root {
        --setting-green: #006D36;
        --setting-green-dark: #00552B;
        --setting-green-light: #E8F5EE;
        --setting-bg: #F5F7F6;
        --setting-border: #E7ECE9;
        --setting-text: #1F2A24;
        --setting-muted: #7A8780;
    }

    .general-settings-page {
        padding-top: 8px;
        padding-bottom: 25px;
    }

    /* Header */
    .settings-header {
        background: linear-gradient(135deg, #006D36 0%, #008747 100%);
        border-radius: 16px;
        padding: 24px 28px;
        margin-bottom: 22px;
        box-shadow: 0 8px 22px rgba(0, 109, 54, 0.16);
        color: #fff;
    }

    .settings-header-content {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
    }

    .settings-title-wrapper {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .settings-title-icon {
        width: 52px;
        height: 52px;
        border-radius: 13px;
        background: rgba(255, 255, 255, 0.16);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
    }

    .settings-title {
        margin: 0;
        font-size: 23px;
        font-weight: 700;
        color: #fff;
    }

    .settings-subtitle {
        margin: 4px 0 0;
        font-size: 13px;
        color: rgba(255, 255, 255, 0.82);
    }

    .btn-save-settings {
        border: 0;
        background: #fff;
        color: var(--setting-green);
        border-radius: 10px;
        padding: 11px 20px;
        font-weight: 700;
        transition: all .2s ease;
        box-shadow: 0 4px 12px rgba(0, 0, 0, .08);
    }

    .btn-save-settings:hover {
        background: #f3f8f5;
        color: var(--setting-green-dark);
        transform: translateY(-1px);
    }

    /* Main Card */
    .settings-card {
        border: 1px solid var(--setting-border);
        border-radius: 16px;
        background: #fff;
        box-shadow: 0 5px 18px rgba(31, 42, 36, 0.05);
        overflow: hidden;
    }

    .settings-card-header {
        padding: 20px 25px;
        border-bottom: 1px solid var(--setting-border);
        display: flex;
        align-items: center;
        gap: 13px;
    }

    .settings-card-icon {
        width: 42px;
        height: 42px;
        border-radius: 11px;
        background: var(--setting-green-light);
        color: var(--setting-green);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 17px;
    }

    .settings-card-header h5 {
        margin: 0;
        color: var(--setting-text);
        font-size: 17px;
        font-weight: 700;
    }

    .settings-card-header p {
        margin: 3px 0 0;
        color: var(--setting-muted);
        font-size: 12px;
    }

    .settings-card-body {
        padding: 28px;
    }

    /* Section */
    .settings-section {
        margin-bottom: 25px;
    }

    .settings-section:last-child {
        margin-bottom: 0;
    }

    .section-title {
        display: flex;
        align-items: center;
        gap: 9px;
        color: var(--setting-green);
        font-size: 14px;
        font-weight: 700;
        margin-bottom: 18px;
        padding-bottom: 10px;
        border-bottom: 1px solid var(--setting-border);
    }

    .section-title i {
        font-size: 14px;
    }

    /* Form */
    .form-group {
        margin-bottom: 19px;
    }

    .form-group label {
        display: block;
        color: var(--setting-text);
        font-size: 13px;
        font-weight: 600;
        margin-bottom: 7px;
    }

    .form-control {
        height: 44px;
        border: 1px solid var(--setting-border);
        border-radius: 10px;
        color: var(--setting-text);
        font-size: 13px;
        padding: 10px 13px;
        box-shadow: none;
        transition: all .2s ease;
    }

    .form-control:focus {
        border-color: var(--setting-green);
        box-shadow: 0 0 0 3px rgba(0, 109, 54, 0.08);
    }

    textarea.form-control {
        height: auto;
        min-height: 95px;
        resize: vertical;
    }

    .form-control::placeholder {
        color: #A7B0AB;
    }

    .field-icon {
        position: relative;
    }

    .field-icon > i {
        position: absolute;
        left: 13px;
        top: 14px;
        color: var(--setting-muted);
        font-size: 13px;
        z-index: 2;
    }

    .field-icon .form-control {
        padding-left: 37px;
    }

    .field-help {
        color: var(--setting-muted);
        font-size: 11px;
        margin-top: 5px;
    }

    /* Image Upload */
    .image-box {
        border: 1px solid var(--setting-border);
        border-radius: 15px;
        padding: 20px;
        margin-bottom: 18px;
        background: #FAFCFB;
        transition: all .2s ease;
    }

    .image-box:hover {
        border-color: rgba(0, 109, 54, .25);
        box-shadow: 0 4px 15px rgba(0, 109, 54, .05);
    }

    .image-box:last-child {
        margin-bottom: 0;
    }

    .image-box-header {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 15px;
    }

    .image-box-icon {
        width: 35px;
        height: 35px;
        border-radius: 9px;
        background: var(--setting-green-light);
        color: var(--setting-green);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
    }

    .image-box-header label {
        margin: 0;
        color: var(--setting-text);
        font-size: 13px;
        font-weight: 700;
    }

    .image-box-description {
        color: var(--setting-muted);
        font-size: 11px;
        margin: 2px 0 0;
    }

    .preview {
        width: 150px;
        height: 150px;
        margin: 0 auto;
        border-radius: 13px;
        border: 2px dashed #D5DED9;
        display: flex;
        justify-content: center;
        align-items: center;
        overflow: hidden;
        background: #fff;
    }

    .preview img {
        max-width: 100%;
        max-height: 100%;
        width: auto;
        height: auto;
        object-fit: contain;
    }

    .image-box .form-control {
        height: auto;
        padding: 8px 10px;
        background: #fff;
        font-size: 12px;
    }

    .image-box .form-control:focus {
        border-color: var(--setting-green);
    }

    /* Divider */
    .settings-divider {
        height: 1px;
        background: var(--setting-border);
        margin: 5px 0 25px;
    }

    /* Info Box */
    .settings-info {
        display: flex;
        align-items: flex-start;
        gap: 11px;
        background: var(--setting-green-light);
        border: 1px solid #D4EBDD;
        border-radius: 11px;
        padding: 13px 15px;
        margin-top: 5px;
    }

    .settings-info i {
        color: var(--setting-green);
        margin-top: 2px;
        font-size: 14px;
    }

    .settings-info span {
        color: #496256;
        font-size: 12px;
        line-height: 1.6;
    }

    /* Responsive */
    @media (max-width: 991.98px) {
        .settings-header {
            padding: 20px;
        }

        .settings-card-body {
            padding: 22px;
        }

        .image-box {
            margin-top: 5px;
        }
    }

    @media (max-width: 767.98px) {
        .settings-header-content {
            align-items: flex-start;
            flex-direction: column;
        }

        .btn-save-settings {
            width: 100%;
        }

        .settings-title {
            font-size: 20px;
        }

        .settings-card-body {
            padding: 18px;
        }
    }

    @media (max-width: 575.98px) {
        .settings-header {
            border-radius: 13px;
            padding: 17px;
        }

        .settings-title-icon {
            width: 45px;
            height: 45px;
        }

        .settings-card-header {
            padding: 16px;
        }

        .settings-card-body {
            padding: 15px;
        }

        .preview {
            width: 130px;
            height: 130px;
        }
    }
</style>

<div class="general-settings-page">

    {{-- Header --}}
    <div class="settings-header">
        <div class="settings-header-content">

            <div class="settings-title-wrapper">
                <div class="settings-title-icon">
                    <i class="fas fa-cogs"></i>
                </div>

                <div>
                    <h2 class="settings-title">
                        ការកំណត់ទូទៅ
                    </h2>
                    <p class="settings-subtitle">
                        General Settings · កំណត់ព័ត៌មានទូទៅរបស់ប្រព័ន្ធ
                    </p>
                </div>
            </div>

            <button type="submit"
                    form="generalSettingsForm"
                    class="btn-save-settings">
                <i class="fas fa-save mr-2"></i>
                រក្សាទុក
            </button>

        </div>
    </div>

    {{-- Main Card --}}
    <div class="settings-card">

        <div class="settings-card-header">
            <div class="settings-card-icon">
                <i class="fas fa-sliders-h"></i>
            </div>

            <div>
                <h5>ព័ត៌មានប្រព័ន្ធ</h5>
                <p>កំណត់ព័ត៌មានសំខាន់ៗរបស់ប្រព័ន្ធ និង Logo</p>
            </div>
        </div>

        <div class="settings-card-body">

            <form id="generalSettingsForm"
                  action="{{ route('settingsgeneral.update') }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf

                <div class="row">

                    {{-- Left Side --}}
                    <div class="col-lg-8">

                        {{-- System Information --}}
                        <div class="settings-section">

                            <div class="section-title">
                                <i class="fas fa-hospital"></i>
                                <span>ព័ត៌មានស្ថាប័ន</span>
                            </div>

                            <div class="form-group">
                                <label>ឈ្មោះប្រព័ន្ធ</label>

                                <div class="field-icon">
                                    <i class="fas fa-hospital-alt"></i>

                                    <input type="text"
                                           name="system_name"
                                           value="{{ old('system_name', $setting->system_name) }}"
                                           class="form-control"
                                           placeholder="បញ្ចូលឈ្មោះប្រព័ន្ធ">
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">

                                        <label>លេខទូរសព្ទ</label>

                                        <div class="field-icon">
                                            <i class="fas fa-phone"></i>

                                            <input type="text"
                                                   name="phone"
                                                   value="{{ old('phone', $setting->phone) }}"
                                                   class="form-control"
                                                   placeholder="+855">
                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">

                                        <label>អ៊ីមែល</label>

                                        <div class="field-icon">
                                            <i class="fas fa-envelope"></i>

                                            <input type="email"
                                                   name="email"
                                                   value="{{ old('email', $setting->email) }}"
                                                   class="form-control"
                                                   placeholder="@gmail.com">
                                        </div>

                                    </div>
                                </div>

                            </div>

                            <div class="form-group">

                                <label>អាសយដ្ឋាន</label>

                                <div class="field-icon">
                                    <i class="fas fa-map-marker-alt"></i>

                                    <textarea name="address"
                                              class="form-control"
                                              rows="3"
                                              placeholder="បញ្ចូលអាសយដ្ឋាន">{{ old('address', $setting->address) }}</textarea>
                                </div>

                            </div>

                        </div>

                        <div class="settings-divider"></div>

                        {{-- Social Information --}}
                        <div class="settings-section">

                            <div class="section-title">
                                <i class="fas fa-share-alt"></i>
                                <span>បណ្ដាញសង្គម</span>
                            </div>

                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">

                                        <label>Facebook</label>

                                        <div class="field-icon">
                                            <i class="fab fa-facebook-f"></i>

                                            <input type="text"
                                                   name="facebook"
                                                   value="{{ old('facebook', $setting->facebook) }}"
                                                   class="form-control"
                                                   placeholder="Facebook URL">
                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">

                                        <label>Telegram</label>

                                        <div class="field-icon">
                                            <i class="fab fa-telegram-plane"></i>

                                            <input type="text"
                                                   name="telegram"
                                                   value="{{ old('telegram', $setting->telegram) }}"
                                                   class="form-control"
                                                   placeholder="Telegram URL">
                                        </div>

                                    </div>
                                </div>

                            </div>

                        </div>

                        <div class="settings-divider"></div>

                        {{-- Working Hours --}}
                        <div class="settings-section">

                            <div class="section-title">
                                <i class="fas fa-clock"></i>
                                <span>ម៉ោងធ្វើការ</span>
                            </div>

                            <div class="form-group">

                                <label>ម៉ោងធ្វើការ</label>

                                <div class="field-icon">
                                    <i class="far fa-clock"></i>

                                    <input type="text"
                                           name="working_hours"
                                           value="{{ old('working_hours', $setting->working_hours) }}"
                                           class="form-control"
                                           placeholder="ចន្ទ-សុក្រ 8:00AM - 5:00PM">
                                </div>

                                <div class="field-help">
                                    ឧទាហរណ៍៖ ចន្ទ-សុក្រ 8:00AM - 5:00PM
                                </div>

                            </div>

                        </div>

                    </div>

                    {{-- Right Side --}}
                    <div class="col-lg-4">

                        <div class="section-title">
                            <i class="fas fa-images"></i>
                            <span>រូបភាពប្រព័ន្ធ</span>
                        </div>

                        {{-- Logo --}}
                        <div class="image-box">

                            <div class="image-box-header">

                                <div class="image-box-icon">
                                    <i class="fas fa-image"></i>
                                </div>

                                <div>
                                    <label>Logo</label>
                                    <p class="image-box-description">
                                        Logo របស់ប្រព័ន្ធ
                                    </p>
                                </div>

                            </div>

                            <div class="preview">
                                <img id="logoPreview"
                                     src="{{ $setting->logo ? (str_starts_with($setting->logo, 'http') ? $setting->logo : asset('storage/' . $setting->logo)) : 'https://via.placeholder.com/150?text=Logo' }}"
                                     alt="Logo">
                            </div>

                            <input type="file"
                                   name="logo"
                                   accept="image/*"
                                   class="form-control mt-3"
                                   id="logoInput">

                            <div class="field-help text-center">
                                Recommended: PNG / JPG
                            </div>

                        </div>

                        {{-- Favicon --}}
                        <div class="image-box">

                            <div class="image-box-header">

                                <div class="image-box-icon">
                                    <i class="fas fa-star"></i>
                                </div>

                                <div>
                                    <label>Favicon</label>
                                    <p class="image-box-description">
                                        Icon របស់ Browser
                                    </p>
                                </div>

                            </div>

                            <div class="preview">
                                <img id="faviconPreview"
                                     src="{{ $setting->favicon ? (str_starts_with($setting->favicon, 'http') ? $setting->favicon : asset('storage/' . $setting->favicon)) : 'https://via.placeholder.com/150?text=Favicon' }}"
                                     alt="Favicon">
                            </div>

                            <input type="file"
                                   name="favicon"
                                   accept="image/*"
                                   class="form-control mt-3"
                                   id="faviconInput">

                            <div class="field-help text-center">
                                Recommended: PNG / ICO / JPG
                            </div>

                        </div>

                        {{-- Info --}}
                        <div class="settings-info">
                            <i class="fas fa-info-circle"></i>

                            <span>
                                រូបភាពថ្មីនឹងត្រូវបាន Preview ភ្លាមៗ មុនពេលចុច
                                <strong>រក្សាទុក</strong>។
                            </span>
                        </div>

                    </div>

                </div>

            </form>

        </div>
    </div>

</div>

@stop

@section('js')
@parent

<script>
    function previewImage(input, previewId) {
        input.addEventListener("change", function () {

            if (this.files && this.files[0]) {

                const reader = new FileReader();

                reader.onload = function (e) {
                    document.getElementById(previewId).src = e.target.result;
                };

                reader.readAsDataURL(this.files[0]);
            }
        });
    }

    previewImage(
        document.getElementById("logoInput"),
        "logoPreview"
    );

    previewImage(
        document.getElementById("faviconInput"),
        "faviconPreview"
    );
</script>

@stop