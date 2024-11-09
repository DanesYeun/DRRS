<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ResponseRecordController;
use App\Http\Controllers\IncidentReportController;

Route::get('/home', function () {
    return view('pages.responseRecords.addResponse');
})->name('home');


Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'index');
    Route::post('/user-login', 'login')->name('login');
});


Route::controller(UserController::class)->group(function () {
    Route::get('/users', 'show')->name('users');
    Route::get('/users-details/{id}', 'details')->name('details');
    Route::post('/add-user', 'store')->name('add-user');
    Route::post('/edit-user/{id}', 'edit')->name('edit-user');
    Route::post('/delete-user/{id}', 'delete')->name('delete-user');
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
    Route::delete('/incident-reports/{id}', 'delete')->name('delete-incident-report');
    Route::get('/incident-reports', 'showAllReports')->name('validate-incident-report');
    Route::get('/incident-report/{id}', 'showReport')->name('create-response');
});


