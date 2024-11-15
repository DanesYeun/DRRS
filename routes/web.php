<?php

use App\Http\Controllers\HazardMapController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\LogoutController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ResponseRecordController;
use App\Http\Controllers\IncidentReportController;
use App\Http\Controllers\AdminDashBoardController;
use App\Http\Controllers\PatientCareReportController;
use App\Http\Controllers\FamilyAssistanceController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\SecretaryController;

use App\Http\Middleware\CheckPasswordUpdate;


Route::controller(LandingPageController::class)->group(function() {
    Route::get('/', 'index')->name('landingPage');
});

Route::controller(HomeController::class)->group(function() {
    Route::get('/home', 'index')->name('home')->middleware(CheckPasswordUpdate::class);
});

Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'index')->name('loginPage');
    Route::post('/user-login', 'login')->name('login');
});

Route::controller(LogoutController::class)->group(function() {
    Route::post('/logout', 'logout')->name('logout');
});

Route::controller(UserController::class)->group(function () {
    Route::get('/users', 'show')->name('users')->middleware(CheckPasswordUpdate::class);
    Route::get('/add-user', 'show_addUser')->name('users.create');
    Route::get('/users-details/{id}', 'details')->name('users.details');
    Route::post('/add-user', 'store')->name('users.add');
    Route::post('/edit-user/{id}', 'edit')->name('users.edit');
    Route::post('/disable-user/{id}', 'disable')->name('users.disable');

    Route::get('update-password', 'update_user_password')->name('update.password');
    Route::post('update-password', 'save_password')->name('save.password');
});

Route::controller(ResponseRecordController::class)->group(function () {
    Route::get('/response-records', 'index')->name('response_records.index')->middleware(CheckPasswordUpdate::class);
    Route::get('/response-records/create', 'create')->name('response_records.create');
    Route::post('/response-records/store', 'store')->name('response_records.store'); //create response
    Route::get('/response-records/{id}/edit', 'edit')->name('response_records.edit');
    Route::post('/response-records/{id}', 'update')->name('response_records.update');
    Route::get('/response-records/{id}/download', 'download')->name('response_records.download');
    Route::post('/response-records/monthly-report', 'generateMonthlyReport')->name('response_records.monthly_report');

    Route::get('/incident/{case}/{id}/response/create', 'incident_response_create')->name('response_records.incident.create');
    Route::get('/patient-care/{id}/response/create', 'patient_care_response_create')->name('response_records.patient_care.create');
});

Route::controller(IncidentReportController::class)->group(function () {
    Route::post('/incident-reports/{case}/{id}', 'delete')->name('incident_report.delete');
    Route::get('/incident-reports', 'showAllReports')->name('incident_report.show_all');
    Route::get('/incident-report/{case}/{id}', 'showReport')->name('incident_report.show');

    Route::get('/incident-report', 'create')->name('incident_report.create');
    Route::post('/incident-report', 'store')->name('incident_report.store');
    
    
});

Route::controller(PatientCareReportController::class)->group(function () {
    Route::get('/patient-care', 'index')->name('patient_care.index')->middleware(CheckPasswordUpdate::class);
    Route::post('/patient-care', 'store')->name('patient_care.store');
    Route::get('/patient-care/{id}', 'show')->name('patient_care.show');
});

Route::controller(HazardMapController::class)->group(function() {
    Route::get('/hazard-map', 'index')->name('hazard_map.index')->middleware(CheckPasswordUpdate::class);
    Route::get('/hazard-map/create', 'create')->name('hazard_map.create');
    Route::post('/hazard-map/create', 'store')->name('hazard_map.store');
    Route::get('/hazard-map/{id}', 'edit')->name('hazard_map.edit');
    Route::post('/hazard-map/{id}/update', 'update')->name('hazard_map.update');
    Route::post('/disable-hazard/{id}', 'updateHazardStatus')->name('hazard_map.disable');
    Route::get('/shelter/create', 'shelterCreate')->name('shelter.create');
    Route::post('/shelter/create', 'shelterStore')->name('shelter.store');
    Route::get('/shelter/{id}', 'shelter_edit')->name('shelter.edit');
    Route::post('/shelter/{id}/update', 'shelter_update')->name('shelter.update');
    Route::post('/shelter/{id}/delete', 'shelterDelete')->name('shelter.delete');
    Route::get('/hazards-shelters', 'view')->name('hazard_map.shelter');
});

Route::controller(AdminDashBoardController::class)->group(function () {
    Route::get('/admin-dashboard', 'index');
});

Route::controller(FamilyAssistanceController::class)->group(function () {
    Route::get('/family-assistance-records', 'index')->name('family.assistance.records')->middleware(CheckPasswordUpdate::class);
    Route::get('/family-assistance-record/{id}', 'view')->name('family.assistance.record');

    Route::get('/family-assistance', 'create')->name('request.family.assistance');
    Route::post('/family-assistance', 'store')->name('store.family.assistance');
});

Route::controller(DonationController::class)->group(function () {

    Route::get('/donations', 'index')->name('donations')->middleware(CheckPasswordUpdate::class);
    Route::get('donation/{type}/{id}', 'view')->name('view.donation');
    Route::post('pick-donation/{type}/{id}', 'pickup_donation')->name('pickup.donation');
    Route::get('print/donation/{type}/{id}', 'print_donation_report')->name('print.donation');

    Route::get('/donor-form', 'create')->name('create.donation');
    Route::post('/donor-form', 'store')->name('store.donation');
});

// Route::controller(SecretaryController::class)->group(function () {
//     Route::get('/donations', 'index')->name('donations')->middleware(CheckPasswordUpdate::class);
//     Route::get('donation/{type}/{id}', 'view')->name('view.donation');
//     Route::post('pick-donation/{type}/{id}', 'pickup_donation')->name('pickup.donation');
    

//     Route::get('print/donation/{type}/{id}', 'print_donation_report')->name('print.donation');
//     // Route::post('/donor-form', 'store')->name('store.donation');
// });






