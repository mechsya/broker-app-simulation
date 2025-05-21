<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BalanceController;
use App\Http\Controllers\Admin\DownloadController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\PackageInvestmentController;
use App\Http\Controllers\Admin\TestimoniController;
use App\Http\Controllers\Admin\UserController;
use App\Models\Bank;
use Illuminate\Support\Facades\Route;

Route::prefix('dashboard')->group(function () {
    Route::get('home', [HomeController::class, 'index'])->name('dashboard.home');

    Route::prefix('users')->controller(UserController::class)->group(function () {
        Route::get('', [UserController::class, 'index'])->name('dashboard.users');
        Route::get('{id}/view', [UserController::class, 'edit'])->name('dashboard.users.view');
     
        Route::post('{id}/update/password', [UserController::class, 'updatePassword'])->name('dashboard.users.update-password');
        
        Route::post('{id}/update', [UserController::class, 'updateData'])->name('dashboard.users.update-data');
        
        Route::put('{id}/verification', [UserController::class, 'update'])->name('dashboard.users.update');

        Route::put('{id}/add-balance', [UserController::class, 'putBalance'])->name('dashboard.users.update.balance');

        Route::get('request', [UserController::class, 'requestUser'])->name('dashboard.users.request');
    });

    Route::prefix('investments')->group(function () {
        Route::get('create', [PackageInvestmentController::class, 'index'])->name('dashboard.investments.create');
        Route::post('store', [PackageInvestmentController::class, 'store'])->name('dashboard.investments.store');
        Route::delete('{id}', [PackageInvestmentController::class, 'destroy'])->name('dashboard.investments.destroy');

        Route::get('requests', [PackageInvestmentController::class, 'requestInvestment'])->name('dashboard.investments.requests');
        Route::put('requests/{id}/approve', [PackageInvestmentController::class, 'approveInvestment'])->name('dashboard.investments.requests.approve');
    });

    Route::prefix('testimonials')->group(function () {
        Route::get('', [TestimoniController::class, 'index'])->name('dashboard.testimonials.index');
        Route::put('{id}/approve/{method}', [TestimoniController::class, 'update'])->name('dashboard.testimonials.update');
    });

    Route::prefix('download')->group(function () {
        Route::get('', [DownloadController::class, 'index'])->name('download.index');
        Route::post('', [DownloadController::class, 'store'])->name('download.store');
        Route::delete('{id}/destroy', [DownloadController::class, 'destroy'])->name('download.destroy');
    });

    Route::prefix('news')->group(function () {
        Route::get('', [NewsController::class, 'index'])->name('news.index');
        Route::post('', [NewsController::class, 'store'])->name('news.store');
        Route::delete('{id}/destroy', [NewsController::class, 'destroy'])->name('news.destroy');
    });

    Route::prefix('balances')->group(function () {
        Route::get('requests', [BalanceController::class, 'requestBalance'])->name('dashboard.balances.requests');
        Route::put('requests/{id}/approve/{userId}', [BalanceController::class, 'approveBalance'])->name('dashboard.balances.requests.approve');
        Route::get('withdrawals', [BalanceController::class, 'requestWithdraw'])->name('dashboard.balances.withdrawals');
        Route::put('withdrawals/{id}/update/{method}', [BalanceController::class, 'updateWithdrawal'])->name('dashboard.balances.withdrawals.update');
    });

    Route::prefix('admin')->group(function () {
        Route::view('bank-accounts', 'admin.admin.add-account-bank', ['page' => 'admin', 'banks' => Bank::where('role', 'admin')->get()])->name('dashboard.admin.bank-accounts');
        Route::post('bank-accounts', [AdminController::class, 'addAccountBank'])->name('dashboard.admin.bank-accounts.store');
        Route::delete('bank-accounts/{id}', [AdminController::class, 'deleteAccountBank'])->name('dashboard.admin.bank-accounts.destroy');
    });
});
