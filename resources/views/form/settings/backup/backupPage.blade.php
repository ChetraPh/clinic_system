@extends('adminlte::page')

@section('title', 'Backup & Restore')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4 mt-3">
        <h2 class="page-title">

        </h2>
    </div>

    <div class="card shadow-sm">

        <div class="card-header p-0">
            <ul class="nav nav-tabs" id="backupTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="backup-tab" data-toggle="tab" href="#backup" role="tab">
                        <i class="fas fa-download"></i>
                        Backup
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="restore-tab" data-toggle="tab" href="#restore" role="tab">
                        <i class="fas fa-upload"></i>
                        Restore
                    </a>
                </li>
            </ul>
        </div>

        <div class="card-body">
            <div class="tab-content">

                {{-- BACKUP TAB --}}
                <div class="tab-pane fade show active" id="backup" role="tabpanel">
                    <div class="alert alert-success">
                        <i class="fas fa-info-circle"></i>
                        Backup database ដើម្បីរក្សាទុកទិន្នន័យសុវត្ថិភាព។
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="thead-light">
                                <tr>
                                    <th width="30%">ឈ្មោះ File Backup</th>
                                    <th>ថ្ងៃបង្កើត</th>
                                    <th width="180px">សកម្មភាព</th>
                                </tr>
                            </thead>
                            <tbody id="backupTableBody">
                                <tr>
                                    <td colspan="3" class="text-center py-4">
                                        <i class="fas fa-spinner fa-spin"></i> កំពុងផ្ទុក...
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <button type="button" class="btn btn-primary" id="createBackupBtn">
                        <i class="fas fa-database"></i>
                        Create Backup Now
                    </button>
                </div>

                {{-- RESTORE TAB --}}
                <div class="tab-pane fade" id="restore" role="tabpanel">

                    <div class="alert alert-success">
                        <i class="fas fa-exclamation-triangle"></i>
                        Restore database នឹងជំនួសទិន្នន័យបច្ចុប្បន្ន។
                    </div>

                    <form id="restoreForm" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Upload Backup File</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="backupFile" name="backup_file"
                                    accept=".sql">
                                <label class="custom-file-label" for="backupFile">Choose file</label>
                            </div>
                            <small class="text-danger d-none" id="restoreFileError"></small>
                        </div>

                        <button type="submit" class="btn btn-primary" id="restoreBtn">
                            <i class="fas fa-upload"></i>
                            Restore Database
                        </button>
                    </form>

                </div>

            </div>
        </div>
    </div>

</div>

@stop

@section('css')
@parent
<style>
    :root {
        --primary-color: #006D36;
    }

    .page-title {
        font-weight: 700;
    }

    .alert-success {
        background-color: var(--primary-color) !important;
        color: #fff;
    }

    .card {
        border-radius: 15px;
    }

    .nav-tabs .nav-link {
        font-weight: 600;
        padding: 15px 25px;
    }

    .nav-tabs .nav-link.active {
        color: #006D36;
        border-top: 3px solid #006D36;
    }

    .table th {
        background: #f8f9fa;
    }

    .btn {
        border-radius: 8px;
    }

    .custom-file-label {
        border-radius: 10px;
    }
</style>
@stop

@section('js')
@parent
<script>
    $(document).ready(function () {

        loadBackups();

        // File input label
        $('.custom-file-input').on('change', function () {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').html(fileName || 'Choose file');
        });

        function showToast(type, message) {
            let container = document.querySelector('.toast-container-custom');
            if (!container) {
                container = document.createElement('div');
                container.className = 'toast-container-custom';
                document.body.appendChild(container);
            }

            const icons = {
                success: 'fa-check-circle',
                error: 'fa-times-circle',
                info: 'fa-info-circle'
            };

            const toast = document.createElement('div');
            toast.className = `toast-custom ${type}`;
            toast.innerHTML = `<i class="fas ${icons[type] || icons.info}"></i><span></span>`;
            toast.querySelector('span').textContent = message; // textContent, not innerHTML — avoids XSS from server messages

            container.appendChild(toast);

            setTimeout(() => {
                toast.style.transition = 'opacity .3s ease';
                toast.style.opacity = '0';
                setTimeout(() => toast.remove(), 300);
            }, 4000);
        }

        // Load backup list
        function loadBackups() {
            $.ajax({
                url: "{{ route('settingsbackup.list') }}",
                method: 'GET',
                success: function (res) {
                    renderTable(res.data);
                },
                error: function () {
                    $('#backupTableBody').html(
                        '<tr><td colspan="3" class="text-center text-danger py-4">មិនអាចផ្ទុកទិន្នន័យបាន</td></tr>'
                    );
                }
            });
        }

        function renderTable(backups) {
            if (!backups.length) {
                $('#backupTableBody').html(
                    '<tr><td colspan="3" class="text-center py-4">មិនទាន់មាន Backup</td></tr>'
                );
                return;
            }

            let rows = '';
            backups.forEach(function (b) {
                rows += `
                    <tr>
                        <td>${escapeHtml(b.filename)}</td>
                        <td>${escapeHtml(b.created_at)}</td>
                        <td>
                            <a href="/settings/backup/download/${encodeURIComponent(b.filename)}" class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-download"></i>
                            </a>
                            <button type="button" class="btn btn-outline-danger btn-sm delete-backup-btn" data-filename="${escapeHtml(b.filename)}">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                `;
            });
            $('#backupTableBody').html(rows);
        }

        function escapeHtml(str) {
            return $('<div>').text(str).html();
        }

        $('#createBackupBtn').on('click', function () {
            let $btn = $(this);
            $btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> កំពុងបង្កើត...');

            $.ajax({
                url: "{{ route('settingsbackup.store') }}",
                method: 'POST',
                data: { _token: '{{ csrf_token() }}' },
                success: function (res) {
                    showToast('success', res.message);
                    loadBackups();
                },
                error: function (xhr) {
                    let msg = xhr.responseJSON?.message ?? 'Backup failed.';
                    let debug = xhr.responseJSON?.debug;
                    showToast('error', debug ? `${msg} (${debug})` : msg);
                },
                complete: function () {
                    $btn.prop('disabled', false).html('<i class="fas fa-database"></i> Create Backup Now');
                }
            });
        });
        $('#backupTableBody').on('click', '.delete-backup-btn', function () {
            if (!confirm('តើអ្នកចង់លុប Backup នេះមែនទេ?')) return;

            let filename = $(this).data('filename');

            $.ajax({
                url: `/settings/backup/${encodeURIComponent(filename)}`,
                method: 'DELETE',
                data: { _token: '{{ csrf_token() }}' },
                success: function (res) {
                    showToast('success', res.message);
                    loadBackups();
                },
                error: function (xhr) {
                    showToast('error', xhr.responseJSON?.message ?? 'លុប Backup មិនជោគជ័យ');
                }
            });
        });

        // Restore
        $('#restoreForm').on('submit', function (e) {
            e.preventDefault();

            let fileInput = $('#backupFile')[0];
            $('#restoreFileError').addClass('d-none').text('');

            if (!fileInput.files.length) {
                $('#restoreFileError').removeClass('d-none').text('សូមជ្រើសរើស File មុនសិន');
                return;
            }

            if (!confirm('ការ Restore នឹងជំនួសទិន្នន័យបច្ចុប្បន្នទាំងអស់។ តើអ្នកប្រាកដទេ?')) return;

            let formData = new FormData();
            formData.append('backup_file', fileInput.files[0]);
            formData.append('_token', '{{ csrf_token() }}');

            let $btn = $('#restoreBtn');
            $btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> កំពុង Restore...');

            $.ajax({
                url: "{{ route('settingsbackup.restore') }}",
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (res) {
                    showToast('success', res.message);
                    $('#restoreForm')[0].reset();
                    $('.custom-file-label').html('Choose file');
                },
                error: function (xhr) {
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        let msg = Object.values(errors).flat().join(' ');
                        $('#restoreFileError').removeClass('d-none').text(msg);
                    } else {
                        showToast('error', xhr.responseJSON?.message ?? 'Restore មិនជោគជ័យ');
                    }
                },
                complete: function () {
                    $btn.prop('disabled', false).html('<i class="fas fa-upload"></i> Restore Database');
                }
            });
        });
    });
</script>
@stop
