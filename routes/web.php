<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    return redirect(route('users.dashboard'));
});

Route::group(['prefix' => 'users'], function() {
    Route::get('/sign-in', [\App\Http\Controllers\User\Auth\LoginController::class, 'signInForm'])->name('users.sign-in-form');
    Route::post('/sign-in', [\App\Http\Controllers\User\Auth\LoginController::class, 'signIn'])->name('users.sign-in');

    Route::group(['middleware' => 'auth:users-web'], function() {
        Route::get('/dashboard', [\App\Http\Controllers\User\HomeController::class, 'index'])->name('users.dashboard');
    });
});

Route::group(['prefix' => 'administrator'], function() {
    Route::get('/sign-in', [\App\Http\Controllers\Admin\Auth\LoginController::class, 'signInForm'])->name('administrator.sign-in-form');
    Route::post('/sign-in', [\App\Http\Controllers\Admin\Auth\LoginController::class, 'signIn'])->name('administrator.sign-in');

    Route::group(['middleware' => 'auth:administrator-web'], function() {
        Route::get('/sign-out', function() {
            return redirect(route('administrator.dashboard'));
        })->name('administrator.sign-out');

        Route::post('/sign-out', [\App\Http\Controllers\Admin\Auth\LoginController::class, 'signOut'])->name('administrator.sign-out');

        // Menu Routes
        Route::get('/dashboard', [\App\Http\Controllers\Admin\HomeController::class, 'index'])->name('administrator.dashboard');
        Route::get('/users', [\App\Http\Controllers\Admin\UserController::class, 'index'])->name('administrator.users.list');
    });
});