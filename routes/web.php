<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

Route::get('/home', function () {
    return view('pages.responseRecords.addResponse');
})->name('home');


Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'index');
    Route::post('/user-login', 'login')->name('login');
});
