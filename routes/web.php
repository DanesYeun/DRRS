<?php

use App\Http\Controllers\HazardMapController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ResponseRecordController;
use App\Http\Controllers\IncidentReportController;
use App\Http\Controllers\AdminDashBoardController;
use App\Http\Controllers\PatientCareController;


Route::get('/', function () {

    return view('pages.landingPage.view');
})->name('landingPage');

Route::get('/home', function () {

    return view('pages.home.homepage');
})->name('home');

Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'index');
    Route::post('/user-login', 'login')->name('login');

    
    Route::post('/logout', 'logout')->name('logout');
});

Route::controller(UserController::class)->group(function () {
    Route::get('/users', 'show')->name('users');
    Route::get('/add-user', 'show_addUser')->name('show.addUser');
    Route::get('/users-details/{id}', 'details')->name('details');
    Route::post('/add-user', 'store')->name('add-user');
    Route::post('/edit-user/{id}', 'edit')->name('edit-user');
    Route::post('/disable-user/{id}', 'disable')->name('disable-user-account');
});

Route::controller(ResponseRecordController::class)->group(function () {
    Route::get('/response-records', 'index')->name('response_records.index');
    Route::get('/response-records/create', 'create')->name('response_records.create');
    Route::post('/response-records/store', 'store')->name('response_records.store'); //create response
    Route::get('/response-records/{id}/edit', 'edit')->name('response_records.edit');
    Route::post('/response-records/{id}', 'update')->name('response_records.update');
    Route::get('/response-records/{id}/download', 'download')->name('response_records.download');
    Route::post('/response-records/monthly-report', 'generateMonthlyReport')->name('response_records.monthly_report');
});

Route::controller(IncidentReportController::class)->group(function () {
    Route::post('/incident-reports/{id}', 'delete')->name('delete-incident-report');
    Route::get('/incident-reports', 'showAllReports')->name('validate-incident-report');
    Route::get('/incident-report/{id}', 'showReport')->name('create-response');
});

Route::controller(PatientCareController::class)->group(function () {
    Route::get('/patient-care', 'index')->name('patient_care.index');
    Route::post('/patient-care', 'store')->name('patient_care.store');
    Route::get('/patient-care/{id}', 'show')->name('patient_care.show');
});

Route::controller(HazardMapController::class)->group(function() {
    Route::get('/hazard-map', 'index')->name('map');
    Route::get('/hazard-map/create', 'create')->name('hazard_map.create');
    Route::post('/hazard-map/create', 'store')->name('hazard_map.store');
    Route::get('/hazard-map/{id}', 'edit')->name('hazard_map.edit');
    Route::post('/hazard-map/{id}/update', 'update')->name('hazard_map.update');
    Route::post('/disable-hazard/{id}', 'updateHazardStatus')->name('hazard_map.disable');
    Route::get('/shelter/create', 'shelterCreate')->name('shelter.create');
    Route::post('/shelter/create', 'shelterStore')->name('shelter.store');
    Route::post('/shelter/{id}/delete', 'shelterDelete')->name('shelter.delete');
    Route::get('/hazards-shelters', 'view')->name('hazards-shelters');
});

Route::controller(AdminDashBoardController::class)->group(function () {
    Route::get('/admin-dashboard', 'index');
});




