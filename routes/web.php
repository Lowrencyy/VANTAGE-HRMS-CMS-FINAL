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
use App\Models\HeroBanner;
use App\Models\MissionVision;
use App\Models\Objective;
use App\Models\Service;
use App\Models\WhyChoose;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeReimbursementController;
use App\Http\Controllers\HrReimbursementController;




/** for side bar menu active */
function set_active($route) {
    if (is_array($route)){
        return in_array(Request::path(), $route) ? 'active' : '';
    }
    return Request::path() == $route ? 'active' : '';
}

/** for side bar menu show */
function set_show($route) {
    if (is_array($route)){
        return in_array(Request::path(), $route) ? 'show' : '';
    }
    return Request::path() == $route ? 'show' : '';
}


// Public Routes
Route::get('/', function () {

    $objectives = Objective::all();
    $banner = HeroBanner::first();
    $mission = MissionVision::first(); // ← THIS IS WHAT YOU NEED
    $why= WhyChoose::first();
    $services=Service::all();

    return view('landing.index', compact('objectives', 'banner', 'mission', 'why' , 'services' ));
});


// Auth Routes
Auth::routes();

// Authenticated Routes
Route::group(['middleware'=>'auth'], function() {

    // Home Dashboard
    Route::get('home', function() {
        return view('dashboard.home');
    });

    // User Account Details
    Route::get('page/account/{user_id}', [AccountController::class, 'profileDetail']);

    // HR Routes (Example: Employee Management, Leaves, etc.)
    Route::middleware('auth')->prefix('hr/')->group(function () {
        Route::controller(HRController::class)->group(function () {
            Route::get('employee/list', 'employeeList')->name('hr/employee/list');
            Route::post('employee/save', 'employeeSaveRecord')->name('hr/employee/save'); // save employee record
            Route::post('employee/update', 'employeeUpdateRecord')->name('hr/employee/update'); // update employee record
            Route::post('employee/delete', 'employeeDeleteRecord')->name('hr/employee/delete'); // delete employee record
            
            Route::get('holidays/page', 'holidayPage')->name('hr/holidays/page');
            Route::post('holidays/save', 'holidaySaveRecord')->name('hr/holidays/save'); // save or update record
            Route::post('holidays/delete', 'holidayDeleteRecord')->name('hr/holidays/delete'); // delete record
            
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

    // Admin Routes for Objectives CRUD


});
// objective route for admin CMS
// Display the list of objectives


#############################################################################################
###########################  THIS IS THE ROUTE FOR CMS DASHBOARD ############################
#############################################################################################

// Display the list of objectives
Route::get('/admin/objectives', [ObjectiveController::class, 'index'])->name('admin.objectives')->middleware('auth');



// route for banner 
Route::middleware('auth')->group(function () {
    Route::get('/admin/banner', [BannerController::class, 'index'])
    ->name('admin.hero');
    
    Route::put('/admin/banner/update', [BannerController::class, 'update'])
        ->name('admin.hero.update');
});

// Mission & Vision (Edit Only)
Route::get('/admin/mission-vision', [MissionVisionController::class, 'index'])
->name('admin.mission')->middleware('auth');

Route::post('/admin/mission-vision/update', [MissionVisionController::class, 'update'])
->name('admin.mission.update')->middleware('auth');


// Mission & Vision (Edit Only)

Route::get('/admin/mission-vision', [MissionVisionController::class, 'index'])
    ->name('admin.mission')
    ->middleware('auth');

Route::put('/admin/mission-vision/update', [MissionVisionController::class, 'update'])
    ->name('admin.mission.update')
    ->middleware('auth');

    // why choose editable 

Route::middleware('auth')->group(function () {

    Route::prefix('admin')->group(function () {

        Route::get('/whychoose', [WhyChooseController::class, 'index'])
            ->name('admin.whychoose');

        Route::put('/whychoose/update', [WhyChooseController::class, 'update'])
            ->name('admin.whychoose.update');
    });

});

// Services 








// LIST (dashboard) – CMS/services.blade.php
Route::get('/admin/services', [ServiceController::class, 'index'])
    ->name('services.index')
    ->middleware('auth');

// CREATE page
Route::get('/admin/services/create', [ServiceController::class, 'create'])
    ->name('services.create')
    ->middleware('auth');

// STORE
Route::post('/admin/services', [ServiceController::class, 'store'])
    ->name('services.store')
    ->middleware('auth');

// EDIT page
Route::get('/admin/services/{id}/edit', [ServiceController::class, 'edit'])
    ->name('services.edit')
    ->middleware('auth');

// UPDATE
Route::put('/admin/services/{id}', [ServiceController::class, 'update'])
    ->name('services.update')
    ->middleware('auth');

// DELETE
Route::delete('/admin/services/{id}', [ServiceController::class, 'destroy'])
    ->name('services.destroy')
    ->middleware('auth');


// Single Services

Route::get('/services/{id}', [ServiceController::class, 'show'])
    ->name('services.show');


// Show the form to create a new objective (MUST come BEFORE {id} routes)
Route::get('/admin/objectives/create', [ObjectiveController::class, 'create'])->name('admin.objectives.create')->middleware('auth');

// Store a new objective in the database
Route::post('/admin/objectives', [ObjectiveController::class, 'store'])->name('admin.objectives.store')->middleware('auth');

// Update an existing objective in the database
Route::put('/admin/objectives/{id}', [ObjectiveController::class, 'update'])->name('admin.objectives.update')->middleware('auth');

// Delete an existing objective
Route::delete('/admin/objectives/{id}', [ObjectiveController::class, 'destroy'])->name('admin.objectives.destroy')->middleware('auth');

// objectives single 

Route::get('/objectives/{id}', [ObjectiveController::class, 'show'])
    ->name('objectives.show');

// Note: No edit route needed since we're using modals in the blade file

// Authentication Routes
Route::group(['namespace' => 'App\Http\Controllers\Auth'],function() {
    // -----------------------------login----------------------------------------//
    Route::controller(LoginController::class)->group(function () {
        Route::get('/login', 'login')->name('login');
        Route::post('/login', 'authenticate');
        Route::get('/logout', 'logout')->name('logout');
        Route::get('logout/page', 'logoutPage')->name('logout/page');
    });

    // ------------------------------ register ----------------------------------//
    Route::controller(RegisterController::class)->group(function () {
        Route::get('/register', 'register')->name('register');
        Route::post('/register','storeUser')->name('register');    
    });

    // ----------------------------- forget password ----------------------------//
    Route::controller(ForgotPasswordController::class)->group(function () {
        Route::get('forget-password', 'getEmail')->name('forget-password');
        Route::post('forget-password', 'postEmail')->name('forget-password');    
    });

    // ----------------------------- reset password -----------------------------//
    Route::controller(ResetPasswordController::class)->group(function () {
        Route::get('reset-password/{token}', 'getPassword');
        Route::post('reset-password', 'updatePassword');    
    });
});

// EMPLOYEE routes
Route::middleware(['auth', 'role:Employee'])->group(function () {
    Route::get('/employee/reimbursements', [EmployeeReimbursementController::class, 'index'])
        ->name('employee.reimbursements.index');

    Route::get('/employee/reimbursements/create', [EmployeeReimbursementController::class, 'create'])
        ->name('employee.reimbursements.create');

    Route::post('/employee/reimbursements', [EmployeeReimbursementController::class, 'store'])
        ->name('employee.reimbursements.store');

    Route::get('/employee/reimbursements/{reimbursement}', [EmployeeReimbursementController::class, 'show'])
        ->name('employee.reimbursements.show');
});

// REIMBURSEMENT
Route::middleware(['auth'])->group(function () {

    // HR REIMBURSEMENTS
    Route::get('/hr/reimbursements', [HRReimbursementController::class, 'index'])
        ->name('hr.reimbursements.index');

    // optional pa rin kung gusto mo direct approve/deny
    Route::post('/hr/reimbursements/{reimbursement}/approve', [HRReimbursementController::class, 'approve'])
        ->name('hr.reimbursements.approve');

    Route::post('/hr/reimbursements/{reimbursement}/deny', [HRReimbursementController::class, 'deny'])
        ->name('hr.reimbursements.deny');

    // ✅ NEW – modal “Edit Status”
    Route::post('/hr/reimbursements/{reimbursement}/update-status', [HRReimbursementController::class, 'updateStatus'])
        ->name('hr.reimbursements.updateStatus');

    // EMPLOYEE reimbursements (yung ginawa na natin)
    Route::get('/employee/reimbursements', [EmployeeReimbursementController::class, 'index'])
        ->name('employee.reimbursements.index');

    Route::post('/employee/reimbursements', [EmployeeReimbursementController::class, 'store'])
        ->name('employee.reimbursements.store');
});

Route::group(['namespace' => 'App\Http\Controllers'],function()
{
    // -------------------------- main dashboard ----------------------//
    Route::controller(HomeController::class)->group(function () {
        Route::get('/home', 'index')->middleware('auth')->name('home');
    });

    // -------------------------- pages ----------------------//
    Route::controller(AccountController::class)->group(function () {
        Route::get('page/account/{user_id}', 'profileDetail')->middleware('auth');
    });
}

// reimbursment HR 



);
