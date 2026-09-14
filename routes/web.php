<?php

use App\Http\Controllers\Auth\TwoFactorController;
use App\Http\Controllers\Billing\BillingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Department\DepartmentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\Pharmacy\PharmacyController;
use App\Http\Controllers\Pharmacy\PharmacySaleController;
use App\Http\Controllers\Pharmacy\PrescriptionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\Room\RoomController;
use App\Http\Controllers\Settings\BackupController;
use App\Http\Controllers\Settings\GeneralSettingsController;
use App\Http\Controllers\Settings\SettingsController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\Support\SupportController;
use App\Http\Controllers\User\UserController;
// use App\Http\Controllers\user\userController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Patient\PatientController;
use App\Http\Controllers\MedicalRecord\MedicalRecordController;
use App\Http\Controllers\Doctor\DoctorController;
use App\Http\Controllers\Appointment\AppointmentController;
use App\Http\Controllers\Laboratory\LabController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes([
    'register' => false,
    'reset' => false,
    'verify' => false,
]);

Route::get('/home', [HomeController::class, 'index'])->name('home');

// ------------------ 2FA (mandatory for logged in users) --------------------
Route::middleware(['auth'])->group(function () {
    Route::get('/2fa/setup', [TwoFactorController::class, 'showSetupForm'])->name('2fa.setup');
    Route::post('/2fa/setup', [TwoFactorController::class, 'confirmSetup'])->name('2fa.setup.confirm')->middleware('throttle:5,1');

    Route::get('/2fa/verify', [TwoFactorController::class, 'showVerifyForm'])->name('2fa.verify');
    Route::post('/2fa/verify', [TwoFactorController::class, 'verify'])->name('2fa.verify.submit')->middleware('throttle:5,1');
});

// ------------------ All Authenticated Roles --------------------
Route::middleware(['auth', '2fa'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::group(['prefix' => 'support'], function () {
        Route::get('/', [SupportController::class, 'index'])->name('support.index');
    });

    // Profile (any authenticated user) — restored from the older route file,
    // was still imported but no longer wired up
    Route::group(['prefix' => 'profile'], function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/', [ProfileController::class, 'update'])->name('profile.update');
        Route::put('/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
        Route::get('/avatar/{user}', [ProfileController::class, 'avatar'])->name('profile.avatar');
    });
});

// =========================================================================
// 1. ADMIN ONLY ROUTES (Role: admin)
// System settings, backups, user & user management, department setup
// =========================================================================
Route::group(['middleware' => ['auth', '2fa', 'role:admin']], function () {

    // Department Setup
    Route::group(['prefix' => 'department'], function () {
        Route::get('/', [DepartmentController::class, 'index'])->name('department.index');
        Route::post('/store', [DepartmentController::class, 'store'])->name('department.store');
        Route::get('/edit/{id}', [DepartmentController::class, 'edit'])->name('department.edit');
        Route::put('/update/{id}', [DepartmentController::class, 'update'])->name('department.update');
        Route::delete('/delete/{id}', [DepartmentController::class, 'destroy'])->name('department.destroy');
    });

    // User Management
    Route::group(['prefix' => 'user'], function () {
        Route::get('/', [UserController::class, 'index'])->name('user.index');
        Route::post('/store', [UserController::class, 'store'])->name('user.store');
        Route::put('/{user}/role', [UserController::class, 'updateRole'])->name('user.update-role');
        Route::delete('/{user}', [UserController::class, 'destroy'])->name('user.destroy');
        Route::post('/{id}/reset-2fa', [UserController::class, 'resetTwoFactor'])->name('user.reset2fa');
    });

    // // user Management
    // Route::group(['prefix' => 'user'], function () {
    //     Route::get('/', [userController::class, 'index'])->name('user.index');
    //     Route::post('/store', [userController::class, 'store'])->name('user.store');
    //     Route::get('/edit/{id}', [userController::class, 'edit'])->name('user.edit');
    //     Route::put('/update/{id}', [userController::class, 'update'])->name('user.update');
    //     Route::delete('/delete/{id}', [userController::class, 'destroy'])->name('user.destroy');
    // });

    // Role & Permission Management
    Route::group(['prefix' => 'roles'], function () {
        Route::get('/', [RolePermissionController::class, 'index'])->name('roles.index');
        Route::post('/store', [RolePermissionController::class, 'storeRole'])->name('roles.store-role');
        Route::post('/permission/store', [RolePermissionController::class, 'storePermission'])->name('permissions.store-permission');
        Route::post('/{role}/permissions', [RolePermissionController::class, 'assignPermissionsToRole'])->name('roles.assign-permissions');
    });

    // System Settings & Backup
    Route::group(['prefix' => 'settings'], function () {
        Route::get('/general', [GeneralSettingsController::class, 'index'])->name('settingsgeneral.index');
        Route::post('/general', [GeneralSettingsController::class, 'update'])->name('settingsgeneral.update');

        Route::get('/billing', [SettingsController::class, 'bilingindex'])->name('settingsbillings.index');
        Route::post('/billing', [SettingsController::class, 'billingUpdate'])->name('settingsbillings.update');

        Route::get('/qrcode', [SettingsController::class, 'qrcodeindex'])->name('settingsqrcode.index');
        Route::post('/qrcode', [SettingsController::class, 'qrcodeUpdate'])->name('settingsqrcode.update');

        Route::get('/backup', [SettingsController::class, 'backupindex'])->name('settingsbackup.index');
    });

    Route::group(['prefix' => 'settings/backup'], function () {
        Route::get('/', [BackupController::class, 'index'])->name('settingsbackup.index');
        Route::get('/list', [BackupController::class, 'list'])->name('settingsbackup.list');
        Route::post('/create', [BackupController::class, 'store'])->name('settingsbackup.store');
        Route::get('/download/{filename}', [BackupController::class, 'download'])->name('settingsbackup.download');
        Route::delete('/{filename}', [BackupController::class, 'destroy'])->name('settingsbackup.destroy');
        Route::post('/restore', [BackupController::class, 'restore'])->name('settingsbackup.restore');
    });
});

// =========================================================================
// 2. DOCTOR CONSULTATION ROUTES (Role: doctor)
// Medical diagnoses and treatments reserved strictly for doctors
// =========================================================================
Route::group(['middleware' => ['auth', '2fa', 'role:doctor']], function () {
    Route::prefix('doctor')->name('doctor.')->group(function () {
        Route::get('/consultation/{id}', [DoctorController::class, 'edit'])->name('consultation');
        Route::put('/consultation/{id}', [DoctorController::class, 'update'])->name('update');
    });
});

// =========================================================================
// 3. CLINICAL STAFF ROUTES (Role: admin|doctor|nurse)
// Patients, Medical Records, Appointments, Inpatient Rooms, Laboratory
// =========================================================================
Route::group(['middleware' => ['auth', '2fa', 'role:admin|doctor|nurse']], function () {

    // Doctor workspace and clinical routes
    Route::prefix('doctor')->name('doctor.')->group(function () {
        Route::get('/', [DoctorController::class, 'index'])->name('index');
        Route::post('/lab-order', [DoctorController::class, 'storeLabOrder'])->name('lab-order.store');
        Route::post('/admit', [DoctorController::class, 'storeAdmission'])->name('admit.store');
        Route::post('/vitals', [DoctorController::class, 'updateVitals'])->name('vitals.update');
    });

    // Patient Routes
    Route::get('/patients', [PatientController::class, 'index'])->name('patients.index');
    Route::get('/patients/create', [PatientController::class, 'create'])->name('patients.create');
    Route::post('/patients', [PatientController::class, 'store'])->name('patients.store');
    Route::get('/patients/{id}', [PatientController::class, 'show'])->name('patients.show');
    Route::get('/patients/{id}/edit', [PatientController::class, 'edit'])->name('patients.edit');
    Route::put('/patients/{id}', [PatientController::class, 'update'])->name('patients.update');
    Route::delete('/patients/{id}', [PatientController::class, 'destroy'])->name('patients.destroy');
    Route::get('/patients/{id}/print', [PatientController::class, 'print'])->name('patients.print');

    // Medical Records & Vitals
    Route::get('/medical-records', [MedicalRecordController::class, 'index'])->name('medical-records.index');
    Route::get('/medical-records/create', [MedicalRecordController::class, 'create'])->name('medical-records.create');
    Route::post('/medical-records', [MedicalRecordController::class, 'store'])->name('medical-records.store');
    Route::get('/medical-records/{id}', [MedicalRecordController::class, 'show'])->name('medical-records.show');
    Route::get('/medical-records/{id}/edit', [MedicalRecordController::class, 'edit'])->name('medical-records.edit');
    Route::put('/medical-records/{id}', [MedicalRecordController::class, 'update'])->name('medical-records.update');
    Route::delete('/medical-records/{id}', [MedicalRecordController::class, 'destroy'])->name('medical-records.destroy');

    // Room & Inpatient Admissions
    Route::get('/room', [RoomController::class, 'index'])->name('room.index');
    Route::post('/room/store', [RoomController::class, 'store'])->name('room.store');
    Route::get('/room/edit/{id}', [RoomController::class, 'edit'])->name('room.edit');
    Route::put('/room/update/{id}', [RoomController::class, 'update'])->name('room.update');
    Route::delete('/room/delete/{id}', [RoomController::class, 'destroy'])->name('room.destroy');

    // Appointments
    Route::get('/appointment', [AppointmentController::class, 'index'])->name('appointment.index');
    Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments.index');
    Route::post('/appointment/store', [AppointmentController::class, 'store'])->name('appointment.store');
    Route::get('/appointment/edit/{id}', [AppointmentController::class, 'edit'])->name('appointment.edit');
    Route::put('/appointment/update/{id}', [AppointmentController::class, 'update'])->name('appointment.update');
    Route::delete('/appointment/delete/{id}', [AppointmentController::class, 'destroy'])->name('appointment.destroy');
    Route::get('/appointment/{id}', [AppointmentController::class, 'show'])->name('appointment.show');

    // Laboratory & Test Orders
    Route::get('/lab', [LabController::class, 'index'])->name('lab.index');
    Route::post('/lab/orders/store', [LabController::class, 'storeOrder'])->name('lab.orders.store');
    Route::post('/lab/orders/{id}/results', [LabController::class, 'storeResults'])->name('lab.results.store');
    Route::post('/lab/tests/store', [LabController::class, 'storeTest'])->name('lab.tests.store');
    Route::put('/lab/tests/update/{id}', [LabController::class, 'updateTest'])->name('lab.tests.update');
    Route::delete('/lab/tests/delete/{id}', [LabController::class, 'destroyTest'])->name('lab.tests.destroy');
    Route::get('/lab/results/{id}', [LabController::class, 'showResult'])->name('lab-results.show');
});

// =========================================================================
// 4. PHARMACY STAFF ROUTES (Role: admin|pharmacist)
// Medicines, stock batches, supplier management, prescription dispensing
// =========================================================================
Route::group(['prefix' => 'pharmacy', 'middleware' => ['auth', '2fa', 'role:admin|pharmacist']], function () {
    Route::get('/', [PharmacyController::class, 'index'])->name('pharmacy.index');
    Route::get('/export', [PharmacyController::class, 'export'])->name('pharmacy.export');
    Route::get('/export/names', [PharmacyController::class, 'exportNames'])->name('pharmacy.export.names');
    Route::get('/export/stock-report', [PharmacyController::class, 'exportStockReport'])->name('pharmacy.export.stockReport');
    Route::get('/expiring-detail', [PharmacyController::class, 'expiringDetail'])->name('pharmacy.expiring.detail');
    Route::get('/data', [PharmacyController::class, 'data'])->name('pharmacy.data');

    Route::post('/', [PharmacyController::class, 'store'])->name('pharmacy.store');
    Route::get('/{medicine}/edit', [PharmacyController::class, 'edit'])->name('pharmacy.edit');
    Route::put('/{medicine}', [PharmacyController::class, 'update'])->name('pharmacy.update');
    Route::delete('/{medicine}', [PharmacyController::class, 'destroy'])->name('pharmacy.destroy');
    Route::post('/{medicine}/restock', [PharmacyController::class, 'addBatch'])->name('pharmacy.restock');
    Route::get('/{medicine}/details', [PharmacyController::class, 'details'])->name('pharmacy.details');

    Route::post('/suppliers', [SupplierController::class, 'store'])->name('pharmacy.suppliers.store');

    // Pharmacy Point-of-Sale / Direct Sales
    Route::get('/sell', [PharmacySaleController::class, 'index'])->name('pharmacy.sell.index');
    Route::get('/sell/search', [PharmacySaleController::class, 'search'])->name('pharmacy.sell.search');
    Route::get('/sell/history', [PharmacySaleController::class, 'history'])->name('pharmacy.sell.history');
    Route::post('/sell', [PharmacySaleController::class, 'store'])->name('pharmacy.sell.store');
    Route::get('/sell/{sale}/receipt', [PharmacySaleController::class, 'receipt'])
    ->name('pharmacy.sell.receipt');

    // Patient search for POS
    Route::get('/sell/patients/search', [PharmacySaleController::class, 'patientSearch'])
    ->name('pharmacy.patients.search');

    Route::get('/stats', [PharmacyController::class, 'stats'])->name('pharmacy.stats');

    // Prescription Dispensing
    Route::get('/prescriptions', [PrescriptionController::class, 'index'])->name('pharmacy.prescriptions.index');
    Route::post('/prescriptions/store', [PrescriptionController::class, 'store'])->name('pharmacy.prescriptions.store');
    Route::post('/prescriptions/{id}/dispense', [PrescriptionController::class, 'dispense'])->name('pharmacy.prescriptions.dispense');

});

// =========================================================================
// 5. BILLING & CASHIER ROUTES (Role: admin|cashier)
// Billing management, payment collection, KHQR, receipts
// =========================================================================
Route::group(['prefix' => 'billing', 'middleware' => ['auth', '2fa', 'role:admin|cashier']], function () {
    Route::get('/', [BillingController::class, 'index'])->name('billing.index');
    Route::post('/store', [BillingController::class, 'store'])->name('billing.store');
    Route::get('/{id}', [BillingController::class, 'show'])->name('billing.show');
    Route::get('/{id}/edit', [BillingController::class, 'edit'])->name('billing.edit');
    Route::put('/{id}', [BillingController::class, 'update'])->name('billing.update');
    Route::post('/{id}/cancel', [BillingController::class, 'cancel'])->name('billing.cancel');
    Route::post('/{id}/pay', [BillingController::class, 'processPayment'])->name('billing.pay');

    // KHQR & Payment status
    Route::post('/payment/generate-khqr', [SettingsController::class, 'generateKhqr'])->name('payment.generateKhqr');
    Route::get('/payment/check-status/{md5}', [SettingsController::class, 'checkPaymentStatus'])->name('payment.checkStatus');
});



Route::middleware('auth')->group(function () {
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::post('/notifications/read-all', [NotificationController::class, 'markAllAsRead'])->name('notifications.readAll');
    Route::get('/notifications/unread-count', [NotificationController::class, 'unreadCount'])->name('notifications.unreadCount');
});
