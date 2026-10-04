<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\SupplierController;

// Auth
use App\Http\Controllers\Auth\TwoFactorController;

// Appointment
use App\Http\Controllers\Appointment\AppointmentController;
use App\Http\Controllers\Appointment\AppointmentReminderController;

// Billing
use App\Http\Controllers\Billing\BillingController;

// Department
use App\Http\Controllers\Department\DepartmentController;

// Doctor
use App\Http\Controllers\Doctor\DoctorController;

// Laboratory
use App\Http\Controllers\Laboratory\LabController;

// Medical Record
use App\Http\Controllers\MedicalRecord\MedicalRecordController;

// Patient
use App\Http\Controllers\Patient\PatientController;

// Pharmacy
use App\Http\Controllers\Pharmacy\PharmacyController;
use App\Http\Controllers\Pharmacy\PharmacySaleController;
use App\Http\Controllers\Pharmacy\PrescriptionController;

// Room
use App\Http\Controllers\Room\RoomController;

// Settings
use App\Http\Controllers\Settings\BackupController;
use App\Http\Controllers\Settings\GeneralSettingsController;
use App\Http\Controllers\Settings\SettingsController;

// Support
use App\Http\Controllers\Support\SupportController;

// User
use App\Http\Controllers\User\UserController;


/*
|--------------------------------------------------------------------------
| Public / Authentication Routes
|--------------------------------------------------------------------------
*/

// Login Page
Route::get('/', function () {
    return view('auth.login');
});

// Laravel Authentication
// Public Register / Password Reset / Email Verification are disabled.
Auth::routes([
    'register' => false,
    'reset'    => false,
    'verify'   => false,
]);

// Home
Route::get('/home', [HomeController::class, 'index'])
    ->name('home');


/*
|--------------------------------------------------------------------------
| 2FA Routes
|--------------------------------------------------------------------------
| All authenticated users must complete 2FA.
*/

Route::middleware('auth')->group(function () {

    Route::get('/2fa/setup', [TwoFactorController::class, 'showSetupForm'])
        ->name('2fa.setup');

    Route::post('/2fa/setup', [TwoFactorController::class, 'confirmSetup'])
        ->name('2fa.setup.confirm')
        ->middleware('throttle:5,1');

    Route::get('/2fa/verify', [TwoFactorController::class, 'showVerifyForm'])
        ->name('2fa.verify');

    Route::post('/2fa/verify', [TwoFactorController::class, 'verify'])
        ->name('2fa.verify.submit')
        ->middleware('throttle:5,1');
});


/*
|--------------------------------------------------------------------------
| Common Authenticated Routes
|--------------------------------------------------------------------------
| Available to all authenticated users after 2FA.
*/

Route::middleware(['auth', '2fa'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');


    /*
    |--------------------------------------------------------------------------
    | Support
    |--------------------------------------------------------------------------
    */

    Route::get('/support', [SupportController::class, 'index'])
        ->name('support.index');


    /*
    |--------------------------------------------------------------------------
    | Profile
    |--------------------------------------------------------------------------
    */

    Route::prefix('profile')->group(function () {

        Route::get('/', [ProfileController::class, 'edit'])
            ->name('profile.edit');

        Route::put('/', [ProfileController::class, 'update'])
            ->name('profile.update');

        Route::put('/password', [ProfileController::class, 'updatePassword'])
            ->name('profile.password.update');

        Route::get('/avatar/{user}', [ProfileController::class, 'avatar'])
            ->name('profile.avatar');
    });
});


/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
| Role: admin
|
| User Management
| Role & Permission
| Department
| System Settings
| Backup
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', '2fa', 'role:admin'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Department Management
    |--------------------------------------------------------------------------
    */

    Route::prefix('department')->group(function () {

        Route::get('/', [DepartmentController::class, 'index'])
            ->name('department.index');

        Route::post('/store', [DepartmentController::class, 'store'])
            ->name('department.store');

        Route::get('/edit/{id}', [DepartmentController::class, 'edit'])
            ->name('department.edit');

        Route::put('/update/{id}', [DepartmentController::class, 'update'])
            ->name('department.update');

        Route::delete('/delete/{id}', [DepartmentController::class, 'destroy'])
            ->name('department.destroy');
    });


    /*
    |--------------------------------------------------------------------------
    | User Management
    |--------------------------------------------------------------------------
    | Admin creates all users.
    */

    Route::prefix('user')->group(function () {

        Route::get('/', [UserController::class, 'index'])
            ->name('user.index');

        Route::post('/store', [UserController::class, 'store'])
            ->name('user.store');

        Route::put('/{user}/role', [UserController::class, 'updateRole'])
            ->name('user.update-role');

        Route::delete('/{user}', [UserController::class, 'destroy'])
            ->name('user.destroy');

        Route::post('/{id}/reset-2fa', [UserController::class, 'resetTwoFactor'])
            ->name('user.reset2fa');
    });


    /*
    |--------------------------------------------------------------------------
    | Role & Permission Management
    |--------------------------------------------------------------------------
    */

    Route::prefix('roles')->group(function () {

        Route::get('/', [RolePermissionController::class, 'index'])
            ->name('roles.index');

        Route::post('/store', [RolePermissionController::class, 'storeRole'])
            ->name('roles.store-role');

        Route::post('/permission/store', [RolePermissionController::class, 'storePermission'])
            ->name('permissions.store-permission');

        Route::post('/{role}/permissions', [RolePermissionController::class, 'assignPermissionsToRole'])
            ->name('roles.assign-permissions');
    });


    /*
    |--------------------------------------------------------------------------
    | General Settings
    |--------------------------------------------------------------------------
    */

    Route::prefix('settings')->group(function () {

        Route::get('/general', [GeneralSettingsController::class, 'index'])
            ->name('settingsgeneral.index');

        Route::post('/general', [GeneralSettingsController::class, 'update'])
            ->name('settingsgeneral.update');


        /*
        |--------------------------------------------------------------------------
        | QR Code Settings
        |--------------------------------------------------------------------------
        */

        Route::get('/qrcode', [SettingsController::class, 'qrcodeindex'])
            ->name('settingsqrcode.index');

        Route::post('/qrcode', [SettingsController::class, 'qrcodeUpdate'])
            ->name('settingsqrcode.update');
    });


    /*
    |--------------------------------------------------------------------------
    | Backup
    |--------------------------------------------------------------------------
    */

    Route::prefix('settings/backup')->group(function () {

        Route::get('/', [BackupController::class, 'index'])
            ->name('settingsbackup.index');

        Route::get('/list', [BackupController::class, 'list'])
            ->name('settingsbackup.list');

        Route::post('/create', [BackupController::class, 'store'])
            ->name('settingsbackup.store');

        Route::get('/download/{filename}', [BackupController::class, 'download'])
            ->name('settingsbackup.download');

        Route::delete('/{filename}', [BackupController::class, 'destroy'])
            ->name('settingsbackup.destroy');

        Route::post('/restore', [BackupController::class, 'restore'])
            ->name('settingsbackup.restore');
    });
});


/*
|--------------------------------------------------------------------------
| BILLING SETTINGS
|--------------------------------------------------------------------------
| Role: admin | cashier
| Permission: manage-billing-settings
|--------------------------------------------------------------------------
*/

Route::middleware([
    'auth',
    '2fa',
    'role:admin|cashier',
    'permission:manage-billing-settings'
])->prefix('settings')->group(function () {

    Route::get('/billing', [SettingsController::class, 'bilingindex'])
        ->name('settingsbillings.index');

    Route::post('/billing', [SettingsController::class, 'billingUpdate'])
        ->name('settingsbillings.update');
});


/*
|--------------------------------------------------------------------------
| DOCTOR ROUTES
|--------------------------------------------------------------------------
| Role: doctor
|
| Consultation
| Medicine Search
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', '2fa', 'role:doctor'])
    ->prefix('doctor')
    ->name('doctor.')
    ->group(function () {

        Route::get('/consultation/{id}', [DoctorController::class, 'edit'])
            ->name('consultation');

        Route::put('/consultation/{id}', [DoctorController::class, 'update'])
            ->name('update');

        Route::get('/medicines/search', [DoctorController::class, 'searchMedicines'])
            ->name('medicines.search');
    });


/*
|--------------------------------------------------------------------------
| CLINICAL STAFF ROUTES
|--------------------------------------------------------------------------
| Role: admin | doctor | nurse
|
| Doctor Workspace
| Rooms
| Appointments
| Laboratory
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', '2fa', 'role:admin|doctor|nurse'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Doctor Workspace
    |--------------------------------------------------------------------------
    */

    Route::prefix('doctor')->name('doctor.')->group(function () {

        Route::get('/', [DoctorController::class, 'index'])
            ->name('index');

        Route::post('/lab-order', [DoctorController::class, 'storeLabOrder'])
            ->name('lab-order.store');

        Route::post('/admit', [DoctorController::class, 'storeAdmission'])
            ->name('admit.store');

        Route::post('/vitals', [DoctorController::class, 'updateVitals'])
            ->name('vitals.update');
    });


    /*
    |--------------------------------------------------------------------------
    | Room Management
    |--------------------------------------------------------------------------
    */

    Route::prefix('room')->group(function () {

        Route::get('/', [RoomController::class, 'index'])
            ->name('room.index');

        Route::post('/store', [RoomController::class, 'store'])
            ->name('room.store');

        Route::get('/edit/{id}', [RoomController::class, 'edit'])
            ->name('room.edit');

        Route::put('/update/{id}', [RoomController::class, 'update'])
            ->name('room.update');

        Route::delete('/delete/{id}', [RoomController::class, 'destroy'])
            ->name('room.destroy');
    });


    /*
    |--------------------------------------------------------------------------
    | Appointment Management
    |--------------------------------------------------------------------------
    */

    Route::prefix('appointment')->group(function () {

        Route::get('/', [AppointmentController::class, 'index'])
            ->name('appointment.index');

        Route::post('/store', [AppointmentController::class, 'store'])
            ->name('appointment.store');

        Route::get('/edit/{id}', [AppointmentController::class, 'edit'])
            ->name('appointment.edit');

        Route::put('/update/{id}', [AppointmentController::class, 'update'])
            ->name('appointment.update');

        Route::delete('/delete/{id}', [AppointmentController::class, 'destroy'])
            ->name('appointment.destroy');

        Route::get('/{id}', [AppointmentController::class, 'show'])
            ->name('appointment.show');
    });

    // Keep old /appointments URL
    Route::get('/appointments', [AppointmentController::class, 'index'])
        ->name('appointments.index');


    /*
    |--------------------------------------------------------------------------
    | Laboratory
    |--------------------------------------------------------------------------
    */

    Route::prefix('lab')->group(function () {

        Route::get('/', [LabController::class, 'index'])
            ->name('lab.index');

        Route::post('/orders/store', [LabController::class, 'storeOrder'])
            ->name('lab.orders.store');

        Route::post('/orders/{id}/results', [LabController::class, 'storeResults'])
            ->name('lab.results.store');

        Route::post('/tests/store', [LabController::class, 'storeTest'])
            ->name('lab.tests.store');

        Route::put('/tests/update/{id}', [LabController::class, 'updateTest'])
            ->name('lab.tests.update');

        Route::delete('/tests/delete/{id}', [LabController::class, 'destroyTest'])
            ->name('lab.tests.destroy');

        Route::get('/results/{id}', [LabController::class, 'showResult'])
            ->name('lab-results.show');
    });
});


/*
|--------------------------------------------------------------------------
| PATIENT ROUTES
|--------------------------------------------------------------------------
| Role: admin | doctor | nurse | cashier
|--------------------------------------------------------------------------
*/

Route::middleware([
    'auth',
    '2fa',
    'role:admin|doctor|nurse|cashier'
])->prefix('patients')->group(function () {

    Route::get('/', [PatientController::class, 'index'])
        ->name('patients.index');

    Route::get('/create', [PatientController::class, 'create'])
        ->name('patients.create');

    Route::post('/', [PatientController::class, 'store'])
        ->name('patients.store');

    Route::get('/{id}', [PatientController::class, 'show'])
        ->name('patients.show');

    Route::get('/{id}/edit', [PatientController::class, 'edit'])
        ->name('patients.edit');

    Route::put('/{id}', [PatientController::class, 'update'])
        ->name('patients.update');

    Route::delete('/{id}', [PatientController::class, 'destroy'])
        ->name('patients.destroy');

    Route::get('/{id}/print', [PatientController::class, 'print'])
        ->name('patients.print');
});


/*
|--------------------------------------------------------------------------
| MEDICAL RECORDS
|--------------------------------------------------------------------------
| Role: doctor
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', '2fa', 'role:doctor'])
    ->prefix('medical-records')
    ->group(function () {

        Route::get('/', [MedicalRecordController::class, 'index'])
            ->name('medical-records.index');

        Route::get('/create', [MedicalRecordController::class, 'create'])
            ->name('medical-records.create');

        Route::post('/', [MedicalRecordController::class, 'store'])
            ->name('medical-records.store');

        Route::get('/{id}', [MedicalRecordController::class, 'show'])
            ->name('medical-records.show');

        Route::get('/{id}/edit', [MedicalRecordController::class, 'edit'])
            ->name('medical-records.edit');

        Route::put('/{id}', [MedicalRecordController::class, 'update'])
            ->name('medical-records.update');

        Route::delete('/{id}', [MedicalRecordController::class, 'destroy'])
            ->name('medical-records.destroy');
    });


/*
|--------------------------------------------------------------------------
| PHARMACY ROUTES
|--------------------------------------------------------------------------
| Role: admin | pharmacist
|
| Medicines
| Stock
| Suppliers
| POS
| Prescriptions
|--------------------------------------------------------------------------
*/

Route::middleware([
    'auth',
    '2fa',
    'role:admin|pharmacist'
])->prefix('pharmacy')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Pharmacy Dashboard
    |--------------------------------------------------------------------------
    */

    Route::get('/', [PharmacyController::class, 'index'])
        ->name('pharmacy.index');

    Route::get('/data', [PharmacyController::class, 'data'])
        ->name('pharmacy.data');

    Route::get('/stats', [PharmacyController::class, 'stats'])
        ->name('pharmacy.stats');


    /*
    |--------------------------------------------------------------------------
    | Pharmacy Export
    |--------------------------------------------------------------------------
    */

    Route::get('/export', [PharmacyController::class, 'export'])
        ->name('pharmacy.export');

    Route::get('/export/names', [PharmacyController::class, 'exportNames'])
        ->name('pharmacy.export.names');

    Route::get('/export/stock-report', [PharmacyController::class, 'exportStockReport'])
        ->name('pharmacy.export.stockReport');

    Route::get('/expiring-detail', [PharmacyController::class, 'expiringDetail'])
        ->name('pharmacy.expiring.detail');


    /*
    |--------------------------------------------------------------------------
    | Medicine Management
    |--------------------------------------------------------------------------
    */

    Route::post('/', [PharmacyController::class, 'store'])
        ->name('pharmacy.store');

    Route::get('/{medicine}/edit', [PharmacyController::class, 'edit'])
        ->name('pharmacy.edit');

    Route::put('/{medicine}', [PharmacyController::class, 'update'])
        ->name('pharmacy.update');

    Route::delete('/{medicine}', [PharmacyController::class, 'destroy'])
        ->name('pharmacy.destroy');

    Route::post('/{medicine}/restock', [PharmacyController::class, 'addBatch'])
        ->name('pharmacy.restock');

    Route::get('/{medicine}/details', [PharmacyController::class, 'details'])
        ->name('pharmacy.details');


    /*
    |--------------------------------------------------------------------------
    | Suppliers
    |--------------------------------------------------------------------------
    */

    Route::post('/suppliers', [SupplierController::class, 'store'])
        ->name('pharmacy.suppliers.store');


    /*
    |--------------------------------------------------------------------------
    | Pharmacy POS / Direct Sales
    |--------------------------------------------------------------------------
    */

    Route::prefix('sell')->group(function () {

        Route::get('/', [PharmacySaleController::class, 'index'])
            ->name('pharmacy.sell.index');

        Route::get('/search', [PharmacySaleController::class, 'search'])
            ->name('pharmacy.sell.search');

        Route::get('/history', [PharmacySaleController::class, 'history'])
            ->name('pharmacy.sell.history');

        Route::post('/', [PharmacySaleController::class, 'store'])
            ->name('pharmacy.sell.store');

        Route::get('/{sale}/receipt', [PharmacySaleController::class, 'receipt'])
            ->name('pharmacy.sell.receipt');

        Route::get('/patients/search', [PharmacySaleController::class, 'patientSearch'])
            ->name('pharmacy.patients.search');
    });


    /*
    |--------------------------------------------------------------------------
    | Prescription Dispensing
    |--------------------------------------------------------------------------
    */

    Route::prefix('prescriptions')->group(function () {

        Route::get('/', [PrescriptionController::class, 'index'])
            ->name('pharmacy.prescriptions.index');

        Route::post('/store', [PrescriptionController::class, 'store'])
            ->name('pharmacy.prescriptions.store');

        Route::post('/{id}/dispense', [PrescriptionController::class, 'dispense'])
            ->name('pharmacy.prescriptions.dispense');
    });
});


/*
|--------------------------------------------------------------------------
| BILLING & CASHIER ROUTES
|--------------------------------------------------------------------------
| Role: admin | cashier
|
| Billing
| Payment
| KHQR
|--------------------------------------------------------------------------
*/

Route::middleware([
    'auth',
    '2fa',
    'role:admin|cashier'
])->prefix('billing')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Billing Management
    |--------------------------------------------------------------------------
    */

    Route::get('/', [BillingController::class, 'index'])
        ->name('billing.index');

    Route::post('/store', [BillingController::class, 'store'])
        ->name('billing.store');

    Route::get('/{id}', [BillingController::class, 'show'])
        ->name('billing.show');

    Route::get('/{id}/edit', [BillingController::class, 'edit'])
        ->name('billing.edit');

    Route::put('/{id}', [BillingController::class, 'update'])
        ->name('billing.update');

    Route::post('/{id}/cancel', [BillingController::class, 'cancel'])
        ->name('billing.cancel');

    Route::post('/{id}/pay', [BillingController::class, 'processPayment'])
        ->name('billing.pay');


    /*
    |--------------------------------------------------------------------------
    | KHQR / Payment Status
    |--------------------------------------------------------------------------
    */

    Route::post('/payment/generate-khqr', [SettingsController::class, 'generateKhqr'])
        ->name('payment.generateKhqr');

    Route::get('/payment/check-status/{md5}', [SettingsController::class, 'checkPaymentStatus'])
        ->name('payment.checkStatus');
});


/*
|--------------------------------------------------------------------------
| NOTIFICATION ROUTES
|--------------------------------------------------------------------------
| Available to all authenticated users.
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->prefix('notifications')->group(function () {

    Route::get('/', [NotificationController::class, 'index'])
        ->name('notifications.index');

    Route::post('/{id}/read', [NotificationController::class, 'markAsRead'])
        ->name('notifications.read');

    Route::post('/read-all', [NotificationController::class, 'markAllAsRead'])
        ->name('notifications.readAll');

    Route::get('/unread-count', [NotificationController::class, 'unreadCount'])
        ->name('notifications.unreadCount');
});


/*
|--------------------------------------------------------------------------
| APPOINTMENT REMINDER
|--------------------------------------------------------------------------
| Role: cashier
|
| Cashier reminds patients about appointments.
|--------------------------------------------------------------------------
*/

Route::middleware([
    'auth',
    '2fa',
    'role:cashier'
])->prefix('appointment-reminders')->group(function () {

    Route::get('/', [AppointmentReminderController::class, 'index'])
        ->name('appointment.reminders');

    Route::post('/{id}/called', [AppointmentReminderController::class, 'markCalled'])
        ->name('appointment.reminders.called');
});