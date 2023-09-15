<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\adminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\mainController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\Concern;
use App\Http\Controllers\ManageWebAppContoller;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Route middleware for log-in using sanctum
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/userDashboard', [mainController::class, 'user_Dashboard'])->name('userDashboard');
    Route::get('/userDashboardProfile', [mainController::class, 'user_Dashboard_Profile'])->name('userDashboard_Profile');
    Route::get('/userDashboardTransaction', [mainController::class, 'user_Dashboard_Transaction'])->name('userDashboard_Transaction');
    Route::get('/signout', [AuthController::class, 'signout'])->name('signout');
    Route::get('/admin/dashboard', [adminController::class, 'dashboard'])->name('adminDashboard');
    Route::get('/addbarangayemployee', [adminController::class, 'addEmployee'])->name('addEmployee');
    Route::get('/listbarangayemployee', [adminController::class, 'listemployee'])->name('listemployee');
    Route::get('/listresident', [adminController::class, 'listresident'])->name('listresident');
    Route::get('/deactlistbarangayemployee', [adminController::class, 'deact_listemployee'])->name('deact_listemployee');
    Route::get('/deactlistresident', [adminController::class, 'deact_listresident'])->name('deact_listresident');
    Route::post('/deact', [adminController::class, 'deact'])->name('deact');
    Route::get('/viewEmployee/{id}', [adminController::class, 'view_Employee'])->name('viewEmployee');
    Route::get('/viewResident/{id}', [adminController::class, 'view_Resident'])->name('viewResident');
    Route::get('/editEmployee/{id}', [adminController::class, 'edit_Employee'])->name('editEmployee');

    Route::post('/modifyEmail', [mainController::class, 'modifyEmail']);
    Route::post('/updateID', [mainController::class, 'updateID']);

    Route::get('viewUser/{id}', [mainController::class, 'viewUser']);
    Route::get('deleteUser/{id}', [mainController::class, 'deleteUser']);
    Route::post('/changeNumber', [mainController::class, 'changeNumber']);
    Route::post('/changePassword', [mainController::class, 'changePassword']);

    Route::post('/registerAdmin', [adminController::class, 'addAdmin']);

    Route::post('/updateEmployee', [adminController::class, 'updateEmployee'])->name('updateEmployee');
    Route::post('/resetPassword', [adminController::class, 'resetPassword']);
    Route::get('/requestType', [adminController::class, 'requestType'])->name('requestType');
    Route::post('/updateRequestType', [adminController::class, 'updateRequestType'])->name('updateRequestType');
    Route::get('/myAccount', [adminController::class, 'myAccount'])->name('myAccount');
    Route::post('/submit-request', [RequestController::class, 'submit_request'])->name('submit_request');
    Route::post('/submit-business-request', [RequestController::class, 'submit_business_request'])->name('submit_business_request');
    Route::get('/request-barangay-id', [mainController::class, 'request_barangay_id'])->name('request_barangay_ID');
    Route::get('/request-barangay-clearance', [mainController::class, 'request_barangay_clearance'])->name('request_barangay_clearance');
    Route::get('/request-barangay-cedula', [mainController::class, 'request_barangay_cedula'])->name('request_barangay_cedula');
    Route::get('/request-barangay-certification', [mainController::class, 'request_barangay_certification'])->name('request_barangay_certification');
    Route::get('/request-business-clearance', [mainController::class, 'request_business_clearance'])->name('request_business_clearance');
    Route::get('/transactionhistory', [mainController::class, 'transaction_history'])->name('transaction_history');
    Route::get('/view-request-list', [adminController::class, 'view_request_list'])->name('view_request_list');
    Route::get('/viewRequest/{id}', [adminController::class, 'viewRequest']);
    Route::post('/changeProfilePic', [adminController::class, 'changeProfilePic']);
    Route::post('/modifyAdminEmail', [adminController::class, 'modifyAdminEmail']);
    Route::post('/modifyAdminPassword', [adminController::class, 'modifyAdminPassword']);
    Route::post('/modifyAdminMobile', [adminController::class, 'modifyAdminMobile']);
    Route::get('/processRequest', [adminController::class, 'processRequest'])->name('processRequest');
    Route::get('/process-pending/{id}', [adminController::class, 'process_pending'])->name('process_pending');
    Route::get('/reassignrequest/{id}', [adminController::class, 'reassignrequest'])->name('reassignrequest');
    Route::post('/denyrequest', [RequestController::class, 'denyrequest'])->name('denyrequest');
    Route::post('/acceptrequest', [RequestController::class, 'acceptrequest'])->name('acceptrequest');
    Route::get('/process_RFP/{id}', [adminController::class, 'process_RFP'])->name('process_RFP');
    Route::post('/readyToClaim', [RequestController::class, 'readyToClaim'])->name('readyToClaim');
    Route::get('/create-concern', [mainController::class, 'create_concern'])->name('create_concern-concern');
    Route::post('/submit-concern', [Concern::class, 'submit_concern'])->name('submit_concern');
    Route::get('/viewRequestdoc/{id}', [mainController::class, 'viewRequestdoc'])->name('viewRequestdoc');
    Route::get('/view-concern-list', [adminController::class, 'view_concern_list'])->name('view_concern_list');
    Route::get('/viewconcern/{id}', [adminController::class, 'viewconcern']);
    Route::get('/processConcern', [adminController::class, 'processConcern'])->name('processConcern');
    Route::get('/process-concern-pending/{id}', [adminController::class, 'process_concern_pending'])->name('process_concern_pending');
    Route::get('/reassignconcern/{id}', [adminController::class, 'reassignconcern'])->name('reassignconcern');
    Route::post('/denyconcern', [Concern::class, 'denyconcern'])->name('denyconcern');
    Route::post('/updateConcern', [Concern::class, 'updateConcern'])->name('updateConcern');
    Route::post('/closeConcern', [Concern::class, 'closeConcern'])->name('closeConcern');
    Route::get('/viewConcernuser/{id}', [mainController::class, 'viewConcernuser'])->name('viewConcernuser');
    Route::get('/manageWebApp', [adminController::class, 'manageWebApp'])->name('manageWebApp');
    Route::post('/updateOfficial', [ManageWebAppContoller::class, 'updateOfficial'])->name('updateOfficial');
    Route::post('/updateDemography', [ManageWebAppContoller::class, 'updateDemography'])->name('updateDemography');
    Route::post('/updateBanner', [ManageWebAppContoller::class, 'updateBanner'])->name('updateBanner');
    Route::post('/updateContact', [ManageWebAppContoller::class, 'updateContact'])->name('updateContact');
    Route::post('/deact_admin', [adminController::class, 'deact_admin'])->name('deact_admin');
    Route::get('/dashboard-resident', [adminController::class, 'dashboard_resident'])->name('dashboard_resident');
    Route::get('/dashboard-employee', [adminController::class, 'dashboard_employee'])->name('dashboard_employee');
});

//Default homepage
Route::get('/', function () {
    return redirect()->route('home');
});

//Route for web-app
Route::get('home', [mainController::class, 'home'])->name('home');
Route::get('requirements', [mainController::class, 'requirements']);
Route::get('safetySection', [mainController::class, 'safetySection']);
Route::get('aboutUs', [mainController::class, 'aboutUs']);
Route::get('contact', [mainController::class, 'contact']);
Route::get('login', [mainController::class, 'login'])->name('login');
Route::get('registration', [mainController::class, 'registration']);
Route::post('registerUser', [mainController::class, 'addUser']);
Route::get('/table', [mainController::class, 'table'])->name('table');
Route::get('/track', [mainController::class, 'track'])->name('track');

Route::post('/searchRequest', [mainController::class, 'searchRequest']);
//Route for changing/modify value in dbs


//Route for log-in
Route::post('loginUser', [AuthController::class, 'loginUser'])->name('loginUser');


//Route for admin side


Route::get('/adminportal', [adminController::class, 'adminPortal'])->name('adminPortal');
Route::post('/loginAdmin', [adminController::class, 'loginAdmin'])->name('loginAdmin');

//Route for getting DBS for employees


Route::get('/verifyEmail', [AuthController::class, 'verifyEmail'])->name('verifyEmail');
Route::get('/forgetpasswordpage', [AuthController::class, 'forgetpasswordpage'])->name('forgetpasswordpage');
Route::post('/forgetpassword', [AuthController::class, 'forgetpassword'])->name('forgetpassword');
Route::get('/forgetpassword_enter_page', [AuthController::class, 'forgetpassword_enter_page'])->name('forgetpassword_enter_page');
Route::post('/changing_password', [AuthController::class, 'changing_password'])->name('changing_password');
Route::get('/policy', [mainController::class, 'policy'])->name('policy');
Route::get('/terms', [mainController::class, 'terms'])->name('terms');
Route::get('/registration_id', [mainController::class, 'registration_id'])->name('registration_id');


Route::get('/file', [RequestController::class, 'file'])->name('file');
