<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HRController;
use App\Http\Controllers\MissionVisionController;
use App\Http\Controllers\ObjectiveController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\WhyChooseController;
use App\Http\Controllers\EmployeeReimbursementController;
use App\Http\Controllers\HrReimbursementController;
use App\Http\Controllers\ContactController;
use App\Models\HeroBanner;
use App\Models\MissionVision;
use App\Models\Objective;
use App\Models\Service;
use App\Models\WhyChoose;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/**
 * Sidebar helpers
 */
function set_active($route)
{
    $current = request()->path();

    if (is_array($route)) {
        return in_array($current, $route, true) ? 'active' : '';
    }

    return $current === $route ? 'active' : '';
}

function set_show($route)
{
    $current = request()->path();

    if (is_array($route)) {
        return in_array($current, $route, true) ? 'show' : '';
    }

    return $current === $route ? 'show' : '';
}


// ==================== PUBLIC LANDING PAGE ====================

Route::get('/', function () {

    $objectives = Objective::all();
    $banner     = HeroBanner::first();
    $mission    = MissionVision::first();
    $why        = WhyChoose::first();
    $services   = Service::all();

    return view('landing.index', compact('objectives', 'banner', 'mission', 'why', 'services'));
});


// ==================== AUTH ROUTES (LOGIN / REGISTER / RESET) ====================

Auth::routes();

// Custom auth routes
Route::group(['namespace' => 'App\Http\Controllers\Auth'], function () {

    // login
    Route::controller(LoginController::class)->group(function () {
        Route::get('/login', 'login')->name('login');
        Route::post('/login', 'authenticate');
        Route::get('/logout', 'logout')->name('logout');
        Route::get('logout/page', 'logoutPage')->name('logout/page');
    });

    // register
    Route::controller(RegisterController::class)->group(function () {
        Route::get('/register', 'register')->name('register');
        Route::post('/register', 'storeUser')->name('register');
    });

    // forget password
    Route::controller(ForgotPasswordController::class)->group(function () {
        Route::get('forget-password', 'getEmail')->name('forget-password');
        Route::post('forget-password', 'postEmail')->name('forget-password');
    });

    // reset password
    Route::controller(ResetPasswordController::class)->group(function () {
        Route::get('reset-password/{token}', 'getPassword');
        Route::post('reset-password', 'updatePassword');
    });
});


// ==================== ROLE-BASED HOME REDIRECT ====================
//
// /home → depende sa role_name:
//  - HR, Admin, Superadmin → HR dashboard
//  - Employee, Normal User → Employee dashboard
//  - else → 403
//

Route::get('/home', function () {

    $user     = Auth::user();
    $roleName = $user->role_name ?? null;

    if (in_array($roleName, ['HR', 'Admin', 'Superadmin', 'Super Admin'], true)) {
        return redirect()->route('hr.dashboard');
    }

    if (in_array($roleName, ['Employee', 'Normal User'], true)) {
        return redirect()->route('employee.dashboard');
    }

    abort(403, 'Unauthorized.');
})->middleware('auth')->name('home');


// ==================== DASHBOARDS ====================

// EMPLOYEE DASHBOARD
Route::middleware('auth')->get('/employee/dashboard', function () {

    $user     = Auth::user();
    $roleName = $user->role_name ?? null;

    // Employee / Normal User / HR / Admin / Superadmin / Super Admin → allowed
    if (! in_array($roleName, [
        'Employee',
        'Normal User',
        'HR',
        'Admin',
        'Superadmin',
        'Super Admin',
    ], true)) {
        abort(403, 'Unauthorized.');
    }

    // dummy data para hindi mag-error yung Blade
    $todayAttendance      = null;
    $highPriorityTasks    = collect([]);
    $completedTodayCount  = 0;
    $pendingTodayCount    = 0;

    return view('dashboard.employee', compact(
        'todayAttendance',
        'highPriorityTasks',
        'completedTodayCount',
        'pendingTodayCount'
    ));

})->name('employee.dashboard');

// HR DASHBOARD
Route::middleware('auth')->get('/hr/dashboard', function () {

    $user     = Auth::user();
    $roleName = $user->role_name ?? null;

    // HR + Admin + Superadmin
    if (! in_array($roleName, ['HR', 'Admin', 'Superadmin', 'Super Admin'], true)) {
        abort(403, 'Unauthorized.');
    }

    return view('dashboard.hr');
})->name('hr.dashboard');


// ==================== AUTHENTICATED GROUP (COMMON) ====================

Route::group(['middleware' => 'auth'], function () {

    // User Account Details
    Route::get('page/account/{user_id}', [AccountController::class, 'profileDetail']);

    // HR Routes (Employee Management, Leaves, etc.)
    Route::prefix('hr')->group(function () {
        Route::controller(HRController::class)->group(function () {
            Route::get('employee/list', 'employeeList')->name('hr/employee/list');
            Route::post('employee/save', 'employeeSaveRecord')->name('hr/employee/save');
            Route::post('employee/update', 'employeeUpdateRecord')->name('hr/employee/update');
            Route::post('employee/delete', 'employeeDeleteRecord')->name('hr/employee/delete');

            Route::get('holidays/page', 'holidayPage')->name('hr/holidays/page');
            Route::post('holidays/save', 'holidaySaveRecord')->name('hr/holidays/save');
            Route::post('holidays/delete', 'holidayDeleteRecord')->name('hr/holidays/delete');

            Route::get('leave/employee/page', 'leaveEmployee')->name('hr/leave/employee/page');
            Route::get('create/leave/employee/page', 'createLeaveEmployee')->name('hr/create/leave/employee/page');
            Route::post('create/leave/employee/save', 'saveRecordLeave')->name('hr/create/leave/employee/save');
            Route::get('view/detail/leave/employee/{staff_id}', 'viewDetailLeave');

            Route::get('leave/hr/page', 'leaveHR')->name('hr/leave/hr/page');
            Route::get('attendance/page', 'attendance')->name('hr/attendance/page');
            Route::get('create/leave/hr/page', 'createLeaveHR')->name('hr/create/leave/hr/page');

            Route::post('get/information/leave', 'getInformationLeave')->name('hr/get/information/leave');

            Route::get('attendance/main/page', 'attendanceMain')->name('hr/attendance/main/page');
            Route::get('department/page', 'department')->name('hr/department/page');
            Route::post('department/save', 'saveRecorddepartment')->name('hr/department/save');
            Route::post('department/delete', 'deleteRecorddepartment')->name('hr/department/delete');
        });
    });

});


// ==================== CMS: OBJECTIVES / BANNER / MISSION-VISION / WHYCHOOSE / SERVICES ====================

// CMS routes (admin side) – lahat naka-auth lang muna
Route::middleware('auth')->group(function () {

    // OBJECTIVES (CMS)
    Route::get('/admin/objectives', [ObjectiveController::class, 'index'])
        ->name('admin.objectives');

    Route::get('/admin/objectives/create', [ObjectiveController::class, 'create'])
        ->name('admin.objectives.create');

    Route::post('/admin/objectives', [ObjectiveController::class, 'store'])
        ->name('admin.objectives.store');

    Route::put('/admin/objectives/{id}', [ObjectiveController::class, 'update'])
        ->name('admin.objectives.update');

    Route::delete('/admin/objectives/{id}', [ObjectiveController::class, 'destroy'])
        ->name('admin.objectives.destroy');

    // BANNER (Hero)
    Route::get('/admin/banner', [BannerController::class, 'index'])
        ->name('admin.hero');

    Route::put('/admin/banner/update', [BannerController::class, 'update'])
        ->name('admin.hero.update');

    // Mission & Vision
    Route::get('/admin/mission-vision', [MissionVisionController::class, 'index'])
        ->name('admin.mission');

    Route::put('/admin/mission-vision/update', [MissionVisionController::class, 'update'])
        ->name('admin.mission.update');

    // WHY CHOOSE (CMS)
    Route::prefix('admin')->group(function () {
        Route::get('/whychoose', [WhyChooseController::class, 'index'])
            ->name('admin.whychoose');

        Route::put('/whychoose/update', [WhyChooseController::class, 'update'])
            ->name('admin.whychoose.update');
    });

    // SERVICES (CMS CRUD)
    Route::get('/admin/services', [ServiceController::class, 'index'])
        ->name('services.index');

    Route::get('/admin/services/create', [ServiceController::class, 'create'])
        ->name('services.create');

    Route::post('/admin/services', [ServiceController::class, 'store'])
        ->name('services.store');

    Route::get('/admin/services/{id}/edit', [ServiceController::class, 'edit'])
        ->name('services.edit');

    Route::put('/admin/services/{id}', [ServiceController::class, 'update'])
        ->name('services.update');

    Route::delete('/admin/services/{id}', [ServiceController::class, 'destroy'])
        ->name('services.destroy');
});

// objectives single (frontend)
Route::get('/objectives/{id}', [ObjectiveController::class, 'show'])
    ->name('objectives.show');

// Single Service (frontend)
Route::get('/services/{id}', [ServiceController::class, 'show'])
    ->name('services.show');


// ==================== REIMBURSEMENTS ====================

// Contact Editable 

/* LANDING */
Route::get('/', [ContactController::class, 'index'])->name('landing');

/* CONTACT FORM SUBMIT */
Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');

/* CMS (Contact Us editor) */
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/contact-us', [ContactController::class, 'cmsEdit'])->name('admin.contactus.edit');
    Route::put('/contact-us', [ContactController::class, 'cmsUpdate'])->name('admin.contactus.update');
});


// Faq Connected to contact below 
Route::middleware(['auth'])->prefix('admin')->group(function () {

    // FAQ CMS PAGE
    Route::get('/faq', [ContactController::class, 'faqCMS'])->name('admin.faq');

    // SAVE FAQ HEADER
    Route::post('/faq/settings', [ContactController::class, 'faqSettingsSave'])->name('admin.faq.settings');

    // ADD FAQ ITEM (THIS FIXES SUBMIT)
    Route::post('/faq/add', [ContactController::class, 'faqSave'])->name('admin.faq.add');

    // DELETE FAQ
    Route::delete('/faq/delete/{id}', [ContactController::class, 'faqDelete'])->name('admin.faq.delete');

});
// contact end 
// EMPLOYEE reimbursements (auth lang muna)
Route::middleware(['auth'])->group(function () {
    Route::get('/employee/reimbursements', [EmployeeReimbursementController::class, 'index'])
        ->name('employee.reimbursements.index');

    Route::get('/employee/reimbursements/create', [EmployeeReimbursementController::class, 'create'])
        ->name('employee.reimbursements.create');

    Route::post('/employee/reimbursements', [EmployeeReimbursementController::class, 'store'])
        ->name('employee.reimbursements.store');

    Route::get('/employee/reimbursements/{reimbursement}', [EmployeeReimbursementController::class, 'show'])
        ->name('employee.reimbursements.show');
});



// HR REIMBURSEMENTS (auth lang muna)
Route::middleware(['auth'])->group(function () {

    Route::get('/hr/reimbursements', [HrReimbursementController::class, 'index'])
        ->name('hr.reimbursements.index');

    Route::post('/hr/reimbursements/{reimbursement}/approve', [HrReimbursementController::class, 'approve'])
        ->name('hr.reimbursements.approve');

    Route::post('/hr/reimbursements/{reimbursement}/deny', [HrReimbursementController::class, 'deny'])
        ->name('hr.reimbursements.deny');

    Route::post('/hr/reimbursements/{reimbursement}/update-status', [HrReimbursementController::class, 'updateStatus'])
        ->name('hr.reimbursements.updateStatus');
});


// ==================== EMPLOYEE ATTENDANCE (BUTTONS SA DASHBOARD) ====================

Route::middleware('auth')->group(function () {

    // EMPLOYEE ATTENDANCE – SIGN IN
    Route::post('/employee/attendance/signin', function (Request $request) {

        $user = Auth::user();

        // TODO: real Attendance logic (DB save)

        return back()->with('success', 'You have signed in successfully.');
    })->name('employee.attendance.signin');

    // EMPLOYEE ATTENDANCE – SIGN OUT
    Route::post('/employee/attendance/signout', function (Request $request) {

        $user = Auth::user();

        // TODO: update latest attendance record sign_out_at

        return back()->with('success', 'You have signed out successfully.');
    })->name('employee.attendance.signout');
});
