<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('lang')->group(function () {
    Route::prefix('admin')->as('admin.')->group(function () {

        Route::controller(AuthController::class)->group(function () {
            Route::get('/login', 'login')->name('login');
            Route::post('/authenticate', 'authenticate')->name('authenticate');
            Route::get('/logout', 'logout')->name('logout');

        });

        Route::middleware(['auth'])->group(function () {

            Route::controller(AdminController::class)->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/change-lang/{lang}', 'changeLang')->name('changeLang');
                Route::get('/dark-toggle', 'darkToggle')->name('darkToggle');
            });
            
            Route::resource('users', UserController::class);

        });
    });
});
