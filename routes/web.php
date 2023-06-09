<?php

use Illuminate\Support\Facades\Route;

// import controller
use App\Http\Controllers\SendMailController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\FoodAndBaverageController;
use App\Http\Controllers\VisitorManagementController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DevicesControlController;
use App\Http\Controllers\DigitalSignageController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\PurposeController;
use App\Http\Controllers\PurposeDeviceController;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\LockerController;
use App\Http\Controllers\ToolsController;
use App\Http\Controllers\SecretaryController;
use App\Http\Controllers\PurchasingController;
use App\Http\Controllers\ParameterController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\FacConfigurationsController;
use App\Http\Controllers\ReportCotrollers;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\LatePandaController;
use App\Http\Controllers\ProjectApprovedController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\VisitorProjectController;
use App\Http\Controllers\EmployeeProjectController;
use App\Http\Controllers\GaController;
// use App\Http\Controllers\VisitorController;
use App\Http\Controllers\SpecialGuestController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CheckInController;
use App\Http\Controllers\SmartOffice\VisitorController;

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
Route::get('visitorList', [VisitorController::class, 'listVisitors'])->name('visitorList');
//Admin visitors routes

Route::get('/login', [AuthController::class, 'showFormLogin'])->name('loginForm');
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::get('register', [AuthController::class, 'showFormRegister'])->name('register');
Route::post('register', [AuthController::class, 'register']);

Route::get('forgot', [AuthController::class, 'showForgotPasword'])->name('forgot');
Route::post('forgot/reset', [AuthController::class, 'updateForgotPass'])->name('resetPass');

Route::get('visitor/view', [VisitorManagementController::class, 'view'])->name('visitorView');
Route::get('attendance-ofline', [AttendanceController::class, '_oflineAttendance'])->name('offlineAttendance');
Route::get('today-visitor', [VisitorManagementController::class, '_getVisitor'])->name('todayVisitor');
Route::get('get-visitor', [VisitorManagementController::class, '_getVisitorDataForFac'])->name('facVisitor');
Route::get('get-visitor-img', [VisitorManagementController::class, '_getVisitorDataForFacImg'])->name('facVisitorImg');
Route::get('is-visitor-deleted', [VisitorManagementController::class, '_updateVisitorDelStatus'])->name('updateVisitor');

Route::get('user-get-directorate', [UsersController::class, '_getDirectorate'])->name('userGetDirectorate');
Route::get('user-get-division', [UsersController::class, '_getDivision'])->name('userGetDivision');
Route::get('user-get-department', [UsersController::class, '_getDepartment'])->name('userGetDepartment');

Route::get('get-self-attendance-all', [AttendanceController::class, '_getSelfAttendanceAll'])->name('getSelfAttendanceAll');



Route::group(['middleware' => 'auth'], function () {
    // DASHBOARD
    Route::get('dashboard', [DashboardController::class, 'index'])->name('Dashboard');
    Route::get('dashboard-visitor-api', [DashboardController::class, 'listVisitorApi'])->name('listVisitor');
    Route::get('dashboard-roomuse-api', [DashboardController::class, 'listRoomIUsedApi'])->name('listRoomIUsed');
    Route::get('dashboard-today-attendace-api', [DashboardController::class, 'listTodayAttendance'])->name('listTodayAttendance');
    Route::get('dashboard-all-chart', [DashboardController::class, 'allChart'])->name('allChart');
    Route::get('dashboard-favorite-room', [DashboardController::class, 'favoriteRoom'])->name('favoriteRoom');


    //location
    Route::get('locations', [LocationController::class, 'index'])->name('locations');
    // Route::get ('locationSelect2', [LocationController::class, 'getLocationSelect2'])->name('getLocationSelect2');
    Route::get('locations/add-new', [LocationController::class, 'addLocation'])->name('locationAdd');
    Route::post('locations/add-new', [LocationController::class, 'storeLocation'])->name('locationStore');
    Route::get('locations-get', [LocationController::class, 'getAllLocations'])->name('getAllLocations');
    Route::get('locations-get/{id}', [LocationController::class, 'getLocationById'])->name('getLocationById');
    Route::post('locations/edit/{id}', [LocationController::class, 'editLocation'])->name('locationEdit');
    Route::post('location/update/{id}', [LocationController::class, 'updateLocation'])->name('locationUpdate');;
    Route::delete('location/{id}', [LocationController::class, 'deleteLocation'])->name('locationDelete');

    //area
    Route::get('areas', [AreaController::class, 'index'])->name('areas');
    Route::get('areas/add-new', [AreaController::class, 'addArea'])->name('areaAdd');
    // Route::get ('areaSelect2', [AreaController::class, 'getAreaSelect2'])->name('getAreaSelect2');
    Route::post('areas/add-new', [AreaController::class, 'storeArea'])->name('areaStore');
    Route::get('areas-get', [AreaController::class, 'getAllAreas'])->name('getAllAreas');
    Route::get('areas-get/{id}', [AreaController::class, 'getAreaById'])->name('getAreaById');
    Route::post('areas/edit/{id}', [AreaController::class, 'editArea'])->name('areaEdit');
    Route::post('areas/update/{id}', [AreaController::class, 'updateArea'])->name('areaUpdate');;
    Route::delete('areas/{id}', [AreaController::class, 'deleteArea'])->name('areaDelete');

    //device
    Route::get ('device', [DeviceController::class, 'index'])->name('device');
    Route::get('device-get/{id}', [DeviceController::class, 'getDeviceById'])->name('getDeviceById');
    Route::get('device-get', [DeviceController::class, 'getAllDevice'])->name('getAllDevice');
    Route::get('device/add-new', [DeviceController::class, 'addDevice'])->name('deviceAdd');
    Route::post('device/add-new', [DeviceController::class, 'storeDevice'])->name('deviceStore');
    Route::post('device/edit/{id}', [DeviceController::class, 'editDevice'])->name('deviceEdit');;
    Route::post('device/update/{id}', [DeviceController::class, 'updateDevice'])->name('deviceUpdate');;
    Route::delete('device/{id}', [DeviceController::class, 'deleteDevice'])->name('deviceDelete');

    //Supplier
    Route::get ('suppliers', [SupplierController::class, 'index'])->name('suppliers');
    Route::get('suppliers-get/{id}', [SupplierController::class, 'getSupplierById'])->name('getSupplierById');
    Route::get('suppliers-get', [SupplierController::class, 'getAllSuppliers'])->name('getAllSupplier');
    Route::get('suppliers/add-new', [SupplierController::class, 'addSupplier'])->name('suppliersAdd');
    Route::post('suppliers/add-new', [SupplierController::class, 'storeSupplier'])->name('suppliersStore');
    Route::get('suppliers/edit/{id}', [SupplierController::class, 'editSupplier'])->name('suppliersEdit');
    Route::post('suppliers/update/{id}', [SupplierController::class, 'updateSupplier'])->name('suppliersUpdate');
    Route::delete('suppliers/{id}', [SupplierController::class, 'deleteSupplier'])->name('suppliersDelete');

    //Purpose
    Route::get ('purpose', [PurposeController::class, 'index'])->name('purpose');
    Route::get('purpose/add-new', [PurposeController::class, 'addPurpose'])->name('purposeAdd');
    Route::post('purpose/add-new', [PurposeController::class, 'storePurpose'])->name('purposeStore');
    Route::get('purpose/edit/{id}', [PurposeController::class, 'editPurpose'])->name('purposeEdit');
    Route::put('purpose/update/{id}', [PurposeController::class, 'updatePurpose'])->name('purposeUpdate');
    Route::delete('purpose/{id}', [PurposeController::class, 'deletePurpose'])->name('purposeDelete');

    Route::get('digital-signage', [DigitalSignageController::class, 'index'])->name('digitalSignage');
    Route::get('digital-signage/edit/{id}', [DigitalSignageController::class, 'edit'])->name('viewDigitalSignage');
    Route::post('digital-signage/update', [DigitalSignageController::class, 'store'])->name('storeDigitalSignage');
    Route::post('digital-signage/delete/{id}', [DigitalSignageController::class, 'delete'])->name('dsDelete');
    Route::get('digital-signage/{id}', [DigitalSignageController::class, 'view'])->name('viewDgitalSignage');
    Route::get('check-data-api', [DigitalSignageController::class, 'checkParty'])->name('checkParty');

    // purpose device
    Route::get ('purpose-device', [PurposeDeviceController::class, 'index'])->name('purposeDevice');
    Route::get ('purpose-device/list', [PurposeDeviceController::class, 'getList'])->name('getList');

    //tools
    Route::get ('tools', [ToolsController::class, 'index'])->name('tools');
    Route::get ('toolsSelect2', [ToolsController::class, 'getToolsSelect2'])->name('getToolsSelect2');
    Route::get('tools-get/{id}', [ToolsController::class, 'getToolById'])->name('getToolById');
    Route::get('tools-get', [ToolsController::class, 'getAllTools'])->name('getAllTools');
    Route::get('tools/add-new', [ToolsController::class, 'addTool'])->name('toolAdd');
    Route::post('tools/add-new', [ToolsController::class, 'storeTool'])->name('toolStore');
    Route::post('tools/edit/{id}', [ToolsController::class, 'editTool'])->name('toolEdit');;
    Route::post('tools/update/{id}', [ToolsController::class, 'updateTool'])->name('toolUpdate');;
    Route::delete('tools/{id}', [ToolsController::class, 'deleteTool'])->name('toolDelete');

    //High Risk Tools
    Route::get ('high-risk', [\App\Http\Controllers\HighRiskToolsController::class, 'index'])->name('highRisk');

    Route::get('high-risk/{id}', [\App\Http\Controllers\HighRiskToolsController::class, 'getHighRiskById'])->name('getHighRiskById');
    Route::get('high-risk-get', [\App\Http\Controllers\HighRiskToolsController::class, 'getAllHighRisk'])->name('getAllHighRisk');
    Route::get('highrisk/add', [\App\Http\Controllers\HighRiskToolsController::class, 'addHighRisk'])->name('highRiskAdd');
    Route::post('highrisk/add-new', [\App\Http\Controllers\HighRiskToolsController::class, 'storeHighRisk'])->name('highriskStore');
    Route::get('high-risk/edit/{id}', [\App\Http\Controllers\HighRiskToolsController::class, 'editHighRisk'])->name('highRiskEdit');;
    Route::post('high-risk/update/{id}', [\App\Http\Controllers\HighRiskToolsController::class, 'updateHighRisk'])->name('highRiskUpdate');;
    Route::delete('high-risk/{id}', [\App\Http\Controllers\HighRiskToolsController::class, 'deleteHighRisk'])->name('highRiskDelete');

    //site
    // Route::get ('sitesSelect2', [SiteController::class, 'getSiteSelect2'])->name('getsitesSelect2');
    Route::get ('sites', [SiteController::class, 'index'])->name('sites');
    Route::get('sites-get/{id}', [SiteController::class, 'getSiteById'])->name('getSiteById');
    Route::get('sites-get', [SiteController::class, 'getAllSite'])->name('getAllSite');
    Route::get('sites/add-new', [SiteController::class, 'addSite'])->name('siteAdd');
    Route::post('sites/add-new', [SiteController::class, 'storeSite'])->name('siteStore');
    Route::post('sites/edit/{id}', [SiteController::class, 'editSite'])->name('siteEdit');;
    Route::post('sites/update/{id}', [SiteController::class, 'updateSite'])->name('siteUpdate');;
    Route::delete('sites/{id}', [SiteController::class, 'deleteSite'])->name('siteDelete');

    // VISITOR
    Route::get('visitor', [VisitorManagementController::class, 'index'])->name('visitor');
    // Route::get('visitor/view', [VisitorManagementController::class, 'view'])->name('visitorView');
    Route::post('visitor/add', [VisitorManagementController::class, 'store'])->name('visitorStore');
    Route::post('visitor/addInvitation', [VisitorManagementController::class, 'storeInvitation'])->name('visitorStoreInvitation');
    Route::get('visitor-api', [VisitorManagementController::class, 'CheckVisitor'])->name('visitorApi');
    Route::get('visitor-help', [VisitorManagementController::class, 'helpApi'])->name('visitorHelpApi');


    // REPORT
    Route::get('report', function () {
        return view('Report.index');
    });
    Route::get('report/attendance/online', [ReportCotrollers::class, 'reportAttendanceOnline'])->name('reportAttendanceOnline');
    Route::get('report/attendance/offline', [ReportCotrollers::class, 'reportAttendanceOffline'])->name('reportAttendanceOffline');
    Route::get('report/attendance', [ReportCotrollers::class, 'reportAttendance'])->name('reportAttendance');
    Route::get('report/locker', [ReportCotrollers::class, 'reportLocker'])->name('reportLocker');
    Route::get('report/participant', [ReportCotrollers::class, 'reportParticipant'])->name('reportParticipant');
    Route::get('report/fnb', [ReportCotrollers::class, 'reportFnB'])->name('reportFnB');
    Route::get('report/frontdesk', [ReportCotrollers::class, 'reportFrontdesk'])->name('reportFrontdesk');
    Route::get('report/secretary', [ReportCotrollers::class, 'reportSecretary'])->name('reportSecretary');
    Route::get('report/visitor', [ReportCotrollers::class, 'reportVisitor'])->name('reportVisitor');
    Route::get('report/visitor/view/{id}', [ReportCotrollers::class, 'viewReport'])->name('viewReport');
    Route::get('report/logAdministrator', [ReportCotrollers::class, 'reportAdministrator'])->name('reportAdministrator');

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

    // EXPORT
    Route::get('visitor-export', [ExportController::class, 'exportVisitor'])->name('exportVisitor');
    Route::get('locker-export', [ExportController::class, 'exportLocker'])->name('exportLocker');
    Route::get('attendanceOnline-export', [ExportController::class, 'attendanceOnlineExport'])->name('attendanceOnlineExport');
    Route::get('fnb-export', [ExportController::class, 'fnbExport'])->name('fnbExport');
    Route::get('frontdesk-export', [ExportController::class, 'frontdeskExport'])->name('frontdeskExport');
    Route::get('secretary-export', [ExportController::class, 'secretaryExport'])->name('secretaryExport');
    Route::get('participant-export', [ExportController::class, 'participantExport'])->name('participantExport');

    //purchasing
    Route::get('purchasing', [PurchasingController::class, 'index'])->name('purchasing');
    Route::get('purchasing/email_template', [PurchasingController::class, 'emailTemplate'])->name('emailTemplate');
    Route::get('purchasing-get', [PurchasingController::class, 'getAllPurchasing'])->name('getAllPurchasing');
    Route::get('purchasing/register', [PurchasingController::class, 'addPurchasing'])->name('purchasingAdd');
    Route::post('autocomplete', [PurchasingController::class, 'autocomplete'])->name('autocomplete');
    Route::post('purchasing/add-new', [PurchasingController::class, 'storePurchasing'])->name('purchasingStore');
    Route::get('project-get/{id}', [PurchasingController::class, 'getProjectDetail'])->name('getProjectDetail');
    Route::post('purchasing/finish/{id}', [PurchasingController::class, 'purchasingFinishProject'])->name('purchasingFinishProject');;
    Route::delete('sites/{id}', [SiteController::class, 'deleteSite'])->name('siteDelete');

    //NDA
    Route::get('nda', [\App\Http\Controllers\NDAController::class, 'index'])->name('nda');
    Route::get('nda-get', [\App\Http\Controllers\NDAController::class, 'getAllNDA'])->name('getAllNDA');
//    Route::get('purchasing-get', [PurchasingController::class, 'getAllPurchasing'])->name('getAllPurchasing');
//    Route::get('purchasing/register', [PurchasingController::class, 'addPurchasing'])->name('purchasingAdd');
//    Route::post('purchasing/add-new', [PurchasingController::class, 'storePurchasing'])->name('purchasingStore');
//    Route::get('project-get/{id}', [PurchasingController::class, 'getProjectDetail'])->name('getProjectDetail');
    Route::get('nda-project-get/{id}', [\App\Http\Controllers\NDAController::class, 'getProjectDetail'])->name('getProjectDetailNDA');
    Route::post('nda/approve/{id}', [\App\Http\Controllers\NDAController::class, 'ndaApproveProject'])->name('ndaApproveProject');;
//    Route::delete('sites/{id}', [SiteController::class, 'deleteSite'])->name('siteDelete');

    //FactoryDirector
    Route::get('factory-director', [\App\Http\Controllers\FactoryDirectorController::class, 'index'])->name('FactoryDirector');
    Route::get('factory-director-get', [\App\Http\Controllers\FactoryDirectorController::class, 'getAllFactoryDirector'])->name('getAllFactoryDirector');
//    Route::get('purchasing-get', [PurchasingController::class, 'getAllPurchasing'])->name('getAllPurchasing');
//    Route::get('purchasing/register', [PurchasingController::class, 'addPurchasing'])->name('purchasingAdd');
//    Route::post('purchasing/add-new', [PurchasingController::class, 'storePurchasing'])->name('purchasingStore');
//    Route::get('project-get/{id}', [PurchasingController::class, 'getProjectDetail'])->name('getProjectDetail');
    Route::get('factory-director-project-get/{id}', [\App\Http\Controllers\FactoryDirectorController::class, 'getProjectDetail'])->name('getProjectDetailFactoryDirector');
    Route::post('factory-director/approve/{id}', [\App\Http\Controllers\FactoryDirectorController::class, 'factoryDirectorApproveProject'])->name('factoryDirectorApproveProject');;
//    Route::delete('sites/{id}', [SiteController::class, 'deleteSite'])->name('siteDelete');

    // PARAMETERIZE
    Route::get('vms-parameter', [ParameterController::class, 'vmsParamerter'])->name('vmsParamerter');
    Route::post('vms-parameter/update/{id}', [ParameterController::class, 'vmsParamerterUpdate'])->name('vmsParamerterUpdate');
    Route::post('vms-parameter2/update/{id}', [ParameterController::class, 'vmsParamerterUpdate2'])->name('vmsParamerterUpdate2');
    Route::get('set-reminder-parameter', [ParameterController::class, 'setReminder'])->name('setReminder');
    Route::post('set-reminder-parameter/update/{id}', [ParameterController::class, 'setReminderUpdate'])->name('setReminderUpdate');
    Route::get('set-fac-attendance', [ParameterController::class, 'setFac'])->name('setFac');
    Route::post('set-fac-attendance/update/{id}', [ParameterController::class, 'updateFac'])->name('updateFac');
    //
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');

    // Route::post('rooms/edit/{id}', [RoomController::class, 'editRoom']);
    // Route::get('configuration-fac/edit',[R])

    Route::get('project-approved/{id_project}/{id_project_location}', [ProjectApprovedController::class, 'index'])->name('projectApprovedIndex');
    Route::get('project-approved/visitor/{id_project}/{id_project_location}', [ProjectApprovedController::class, 'indexVisitorForm'])->name('projectApprovedIndexVisitorForm');
    Route::post('project-approved/update-visitor-form/{id_project}/{id_project_location}', [ProjectApprovedController::class, 'updateVisitorForm'])->name('projectApprovedUpdateVisitorForm');
    Route::get('project-approved/nda/{id_project}/{id_project_location}', [ProjectApprovedController::class, 'indexNDAForm'])->name('projectApprovedIndexNDAForm');
    Route::post('project-approved/update-nda-form/{id_project}/{id_project_location}', [ProjectApprovedController::class, 'updateNDAForm'])->name('projectApprovedUpdateNDAForm');
    Route::resource('company', CompanyController::class);
    Route::resource('visitor-project', VisitorProjectController::class);
    Route::resource('employee-project', EmployeeProjectController::class);
    Route::get('visitor-project/show-by-id-project/{id}', [VisitorProjectController::class, 'showByIdProject'])->name('visitorProjectShowByIdProject');
    Route::get('employee-project/show-by-id-project/{id}', [EmployeeProjectController::class, 'showByIdProject'])->name('employeeProjectShowByIdProject');


    Route::get('getCompany', [CompanyController::class, 'getCompanySelect2'])->name('getCompanySelect2');
    Route::get('getVisitor', [VisitorController::class, 'getVisitorSelect2'])->name('getVisitorSelect2');

    Route::get('ga-security', [GaController::class, 'index'])->name('gaIndex');
    Route::get('ga-get-list', [GaController::class, 'getList'])->name('ga.getList');
    Route::get('ga-security/visitor-detail/{id}', [GaController::class, 'getDetails'])->name('ga.getDetails');
    Route::post('ga-approve', [GaController::class, 'approve'])->name('ga.approve');
});

Route::get('project-approved/{id_project}/{id_project_location}', [ProjectApprovedController::class, 'index'])->name('projectApprovedIndex');
Route::get ('areaSelect2', [AreaController::class, 'getAreaSelect2'])->name('getAreaSelect2');
Route::get ('sitesSelect2', [SiteController::class, 'getSiteSelect2'])->name('getsitesSelect2');
Route::get ('locationSelect2', [LocationController::class, 'getLocationSelect2'])->name('getLocationSelect2');
Route::get ('highRiskSelect2', [\App\Http\Controllers\HighRiskToolsController::class, 'getHighRiskSelect2'])->name('getHighRiskSelect2');
Route::get('specialGuest', [SpecialGuestController::class, 'index'])->name('spc.index');
Route::post('visitor/find', [VisitorController::class, 'autocomplete'])->name('visitorAutoComplete');
Route::post('postCompanyName', [SpecialGuestController::class, 'autocomplete'])->name('postCompanyName');
Route::post('specialGuest/add-new', [SpecialGuestController::class, 'store'])->name('spc.store');
