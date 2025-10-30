<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;



Route::group(['prefix' => env('ADMIN_URL_PREFIX')], function () {
    
  //----------------- Users Auth -------------//
  Route::get('/login', [App\Http\Controllers\AdminControllers\AuthAdminController::class, 'login'])->name('login');
  Route::post('/login', [App\Http\Controllers\AdminControllers\AuthAdminController::class, 'loginValidate']);
  Route::get('/logout', [App\Http\Controllers\AdminControllers\AuthAdminController::class, 'logout'])->name('logout.perform');

  Route::get('/', [App\Http\Controllers\AdminControllers\HomeController::class, 'dashboard'])->middleware('auth');
  Route::get('/dashboard', [App\Http\Controllers\AdminControllers\HomeController::class, 'dashboard'])->middleware('auth');

  //---------- Admin User Section --------------// 
  Route::get('/admin-users', [App\Http\Controllers\AdminControllers\AdminUsersController::class, 'listAdminUsers'])->middleware('auth');
  Route::post('/admin-user-ajax-load', [App\Http\Controllers\AdminControllers\AdminUsersController::class, 'loadAdminUserList'])->middleware('auth');
  Route::get('/admin-user-add', [App\Http\Controllers\AdminControllers\AdminUsersController::class, 'viewAdminUserAddPage'])->middleware('auth');
  Route::post('/admin-user-add', [App\Http\Controllers\AdminControllers\AdminUsersController::class, 'addAdminUser'])->middleware('auth');
  Route::get('/admin-user-edit/{id}', [App\Http\Controllers\AdminControllers\AdminUsersController::class, 'viewAdminUserEditPage'])->middleware('auth');
  Route::post('/admin-user-edit', [App\Http\Controllers\AdminControllers\AdminUsersController::class, 'editAdminUser'])->middleware('auth');
  Route::get('/admin-user-delete/{id}', [App\Http\Controllers\AdminControllers\AdminUsersController::class, 'deleteAdminUser'])->middleware('auth');
  

  //----------- Students Section ------------//
  Route::get('/applicants', [App\Http\Controllers\AdminControllers\ApplicantController::class, 'listApplicants'])->middleware('auth');
  Route::post('/applicant-ajax-load', [App\Http\Controllers\AdminControllers\ApplicantController::class, 'ajaxLoadApplicantList'])->middleware('auth');
  Route::get('/applicant-add', [App\Http\Controllers\AdminControllers\ApplicantController::class, 'viewApplicantAddPage'])->middleware('auth');
  Route::post('/applicant-add', [App\Http\Controllers\AdminControllers\ApplicantController::class, 'save'])->middleware('auth');
  Route::get('/applicant-edit/{id}', [App\Http\Controllers\AdminControllers\ApplicantController::class, 'viewApplicantEditPage'])->middleware('auth');
  Route::post('/applicant-edit/{id}', [App\Http\Controllers\AdminControllers\ApplicantController::class, 'update'])->middleware('auth');

  Route::get('/applicant-upload-result/{id}', [App\Http\Controllers\AdminControllers\ApplicantController::class, 'uploadResultView'])->middleware('auth');
  Route::post('/applicant-upload-result', [App\Http\Controllers\AdminControllers\ApplicantController::class, 'uploadResult'])->middleware('auth');
 
  Route::get('/applicant-status-edit/{id}', [App\Http\Controllers\AdminControllers\ApplicantController::class, 'updateApplicantStatus'])->middleware('auth');
  Route::post('/applicant-status-update/{id}', [App\Http\Controllers\AdminControllers\ApplicantController::class, 'updateApplicantStatusAction'])->middleware('auth');
});


Route::get('/', [App\Http\Controllers\FrontControllers\AuthApplicantController::class, 'login']);
Route::get('/applicant-login', [App\Http\Controllers\FrontControllers\AuthApplicantController::class, 'login']);
Route::post('/applicant-login', [App\Http\Controllers\FrontControllers\AuthApplicantController::class, 'loginValidate']);
Route::get('/applicant-logout', [App\Http\Controllers\FrontControllers\AuthApplicantController::class, 'logout']);

Route::get('/applicant-dashboard', [App\Http\Controllers\FrontControllers\HomeController::class, 'dashboard'])->middleware('auth:applicant');

Route::get('/request-for-pharmacist-registration', [App\Http\Controllers\FrontControllers\HomeController::class, 'requestForPharmacistRegistration'])->middleware('auth:applicant');
Route::get('/required-documents/{filename}', [App\Http\Controllers\FrontControllers\HomeController::class, 'downloadDocumentPdf'])->middleware('auth:applicant');
Route::get('/view-application-status/{id}', [App\Http\Controllers\FrontControllers\HomeController::class, 'viewAppStatus'])->middleware('auth:applicant');


