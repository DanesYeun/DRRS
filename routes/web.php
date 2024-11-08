<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

Route::get('/', function () {
    return view('pages.users.view');
});;


Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'index');
    Route::post('/user-login', 'login')->name('login');
});
