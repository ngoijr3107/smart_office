<?php

use Illuminate\Support\Facades\Route;

// import controller
use App\Http\Controllers\SendMailController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PurposeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CheckInController;
use App\Http\Controllers\SmartOffice\VisitorController;
use App\Http\Controllers\DepartmentController;
use App\Models\Department;

// function index() {
//     return view('home');
// };

// Route::get('/', return view:home);
Route::get('/', [HomeController::class, 'index'])->name('home');

// Check-in routes
Route::get('check_in', [CheckInController::class, 'checkIn'])->name('checkIn');
Route::post('check_in2', [CheckInController::class, 'checkInFinal'])->name('checkInFinal');
Route::post('saveCheckin', [CheckInController::class, 'saveCheckIn'])->name('saveCheckIn');
// Check-in routes

//Check-out routes
Route::get('checkOut', [CheckInController::class, 'checkOut'])->name('checkOut');
Route::get('checkOutItem/{id}', [CheckInController::class, 'checkOutItem'])->name('checkOutItem');
Route::put('checkOutConfirm/{visitor}', [CheckInController::class, 'checkOutConfirm'])->name('checkOutConfirm');
//Check-out routes

//Admin visitors routes
Route::get('visitor', [VisitorController::class, 'listVisitors'])->name('visitor');
//Admin visitors routes

Route::get('/login', [AuthController::class, 'showFormLogin'])->name('loginForm');
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::get('register', [AuthController::class, 'showFormRegister'])->name('register');
Route::post('register', [AuthController::class, 'register']);

Route::get('forgot', [AuthController::class, 'showForgotPasword'])->name('forgot');
Route::post('forgot/reset', [AuthController::class, 'updateForgotPass'])->name('resetPass');



Route::group(['middleware' => 'auth'], function () {
    // DASHBOARD
    Route::get('dashboard', [DashboardController::class, 'index'])->name('Dashboard');


    //Purpose
    Route::get ('purpose', [PurposeController::class, 'index'])->name('purpose');
    Route::get('purpose/add-new', [PurposeController::class, 'addPurpose'])->name('purposeAdd');
    Route::post('purpose/add-new', [PurposeController::class, 'storePurpose'])->name('purposeStore');
    Route::get('purpose/edit/{id}', [PurposeController::class, 'editPurpose'])->name('purposeEdit');
    Route::put('purpose/update/{id}', [PurposeController::class, 'updatePurpose'])->name('purposeUpdate');
    Route::delete('purpose/{id}', [PurposeController::class, 'deletePurpose'])->name('purposeDelete');

    //Department
    Route::get ('department', [DepartmentController::class, 'index'])->name('department');
    Route::get('department/add-new', [DepartmentController::class, 'add'])->name('departmentAdd');
    Route::post('department/add-new', [DepartmentController::class, 'store'])->name('departmentStore');
    Route::get('department/edit/{id}', [DepartmentController::class, 'edit'])->name('departmentEdit');
    Route::put('department/update/{id}', [DepartmentController::class, 'update'])->name('departmentUpdate');
    Route::delete('department/{id}', [DepartmentController::class, 'delete'])->name('departmentDelete');


    // UTILITIES
    Route::get('my-profile', [ProfileController::class, 'index'])->name('myProfile');
    Route::post('my-profile/update', [ProfileController::class, 'update'])->name('updateProfile');
    Route::get('my-profile/change-password', [ProfileController::class, 'changePass'])->name('changePassword');
    Route::post('my-profile/change-password/update', [ProfileController::class, 'updatePassword'])->name('updatePassword');
    // USERS
    Route::get('user', [UsersController::class, 'index'])->name('user');
    Route::get('userAdd', [UsersController::class, 'add'])->name('userAdd');
    Route::post('userAdd', [UsersController::class, 'store']);
    Route::get('user-get/{id}', [UsersController::class, 'getUserByIdEmployee'])->name('getUserByEmployeeId');
    Route::get('user-get', [UsersController::class, 'getAllUsers'])->name('getAllUsers');
    Route::get('userEdit/{id}', [UsersController::class, 'edit'])->name('userEdit');
    Route::post('userUpdate/{id}', [UsersController::class, 'update']);

    Route::post('user/change-password/{id}', [UsersController::class, 'changePassword'])->name('passwordChange');
    Route::get('user-change', [UsersController::class, 'change'])->name('change');

    Route::delete('user/{id}', [UsersController::class, 'delete'])->name('userDelete');

    Route::post('send-email/approve/{id}', [SendMailController::class, 'sendConfirm'])->name('sendEmailApprove');
    Route::post('send-email/rejectapprove/{id}', [SendMailController::class, 'sendRejectConfirm'])->name('sendEmailRejectApprove');
    Route::post('send-email/reject/{id}', [SendMailController::class, 'sendReject'])->name('sendEmailReject');


    //
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');

    // Route::post('rooms/edit/{id}', [RoomController::class, 'editRoom']);
    // Route::get('configuration-fac/edit',[R])

});
