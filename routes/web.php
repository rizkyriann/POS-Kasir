<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MenuCategoryController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('dashboard'));

Route::middleware('guest')->group(function (): void {
    Route::get('/login', [AuthController::class, 'create'])->name('login');
    Route::post('/login', [AuthController::class, 'store'])->name('login.store');
});

Route::middleware('auth')->group(function (): void {
    Route::post('/logout', [AuthController::class, 'destroy'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::view('/pos', 'pos.index')->middleware('role:owner,admin,kasir')->name('pos');

    Route::resource('menu-categories', MenuCategoryController::class)
        ->except('show')
        ->middleware('role:owner,admin');

    Route::resource('menus', MenuController::class)
        ->except('show')
        ->middleware('role:owner,admin');

    Route::resource('users', UserController::class)
        ->except('show')
        ->middleware('role:owner,admin');

    Route::get('/orders', [OrderController::class, 'index'])->middleware('role:owner,admin,kasir')->name('orders.index');
    Route::get('/transactions', [TransactionController::class, 'index'])->middleware('role:owner,admin,kasir')->name('transactions.index');
    Route::get('/transactions/{transaction}', [TransactionController::class, 'show'])->middleware('role:owner,admin,kasir')->name('transactions.show');
    Route::get('/transactions/{transaction}/receipt', [TransactionController::class, 'receipt'])->middleware('role:owner,admin,kasir')->name('transactions.receipt');
    Route::get('/reports', [ReportController::class, 'index'])->middleware('role:owner,admin')->name('reports.index');
    Route::get('/settings', [SettingController::class, 'edit'])->middleware('role:owner,admin')->name('settings.edit');
    Route::put('/settings', [SettingController::class, 'update'])->middleware('role:owner,admin')->name('settings.update');
});
