<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ReportController;


Route::get('/', function () {
    return redirect()->route('login');
});


/*
|--------------------------------------------------------------------------
| Login
|--------------------------------------------------------------------------
*/

Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.process');

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');


/*
|--------------------------------------------------------------------------
| Semua User yang sudah Login
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');


    /*
    |--------------------------------------------------------------------------
    | ADMIN
    |--------------------------------------------------------------------------
    */

Route::middleware('role:admin')->group(function () {

    Route::resource(
        'categories',
        CategoryController::class
    );

    Route::resource(
        'products',
        ProductController::class
    );

    Route::resource(
        'users',
        UserController::class
    );

    Route::get(
        '/reports',
        [ReportController::class, 'index']
    )->name('reports.index');

});

    /*
    |--------------------------------------------------------------------------
    | ADMIN + KASIR
    |--------------------------------------------------------------------------
    */

    Route::middleware('role:admin,kasir')->group(function () {

    Route::get(
        '/transactions',
        [TransactionController::class, 'index']
    )->name('transactions.index');

    Route::get(
        '/transactions/create',
        [TransactionController::class, 'create']
    )->name('transactions.create');

    Route::post(
        '/transactions',
        [TransactionController::class, 'store']
    )->name('transactions.store');

    Route::get(
        '/transactions/{transaction}',
        [TransactionController::class, 'show']
    )->name('transactions.show');

});

});