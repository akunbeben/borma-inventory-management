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
        Route::get('/', function () { return redirect(route('administrator.dashboard')); })->name('administrator.root');
        
        Route::get('/sign-out', function() {
            return redirect(route('administrator.dashboard'));
        })->name('administrator.sign-out');
        Route::post('/sign-out', [\App\Http\Controllers\Admin\Auth\LoginController::class, 'signOut'])->name('administrator.sign-out');

        Route::get('/dashboard', [\App\Http\Controllers\Admin\HomeController::class, 'index'])->name('administrator.dashboard');

        // Users Management Routes
        Route::get('/users', [\App\Http\Controllers\Admin\UserController::class, 'index'])->name('administrator.users.list');
        Route::get('/users/create', [\App\Http\Controllers\Admin\UserController::class, 'create'])->name('administrator.users.create');
        Route::post('/users/create', [\App\Http\Controllers\Admin\UserController::class, 'store'])->name('administrator.users.store');
        Route::get('/users/{uuid}', [\App\Http\Controllers\Admin\UserController::class, 'show'])->name('administrator.users.show');
        Route::delete('/users/{uuid}', [\App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('administrator.users.destroy');
        Route::get('/users/{uuid}/edit', [\App\Http\Controllers\Admin\UserController::class, 'edit'])->name('administrator.users.edit');
        Route::put('/users/{uuid}/edit', [\App\Http\Controllers\Admin\UserController::class, 'update'])->name('administrator.users.update');
        Route::post('/users/{uuid}/reset-password', [\App\Http\Controllers\Admin\UserController::class, 'resetPassword'])->name('administrator.users.password-reset');

        // Suppliers
        Route::get('/suppliers', [\App\Http\Controllers\Admin\SupplierController::class, 'index'])->name('administrator.suppliers.list');
        Route::get('/suppliers/create', [\App\Http\Controllers\Admin\SupplierController::class, 'create'])->name('administrator.suppliers.create');
        Route::post('/suppliers/create', [\App\Http\Controllers\Admin\SupplierController::class, 'store'])->name('administrator.suppliers.store');
        Route::get('/suppliers/{uuid}', [\App\Http\Controllers\Admin\SupplierController::class, 'show'])->name('administrator.suppliers.show');
        Route::delete('/suppliers/{uuid}', [\App\Http\Controllers\Admin\SupplierController::class, 'destroy'])->name('administrator.suppliers.destroy');
        Route::get('/suppliers/{uuid}/edit', [\App\Http\Controllers\Admin\SupplierController::class, 'edit'])->name('administrator.suppliers.edit');
        Route::put('/suppliers/{uuid}/edit', [\App\Http\Controllers\Admin\SupplierController::class, 'update'])->name('administrator.suppliers.update');
    });
});