<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'loginForm')->name('login');
    Route::post('/login', 'authenticate');
    Route::get('/register', 'registerForm')->name('register');
    Route::post('/register', 'register');
    Route::post('/logout', 'logout')->name('logout');
});

Route::middleware(['auth'])->group(function () {
    // Profile Routes
    Route::get('/profile', [\App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');

    // User Routes
    Route::middleware(['is.user'])->group(function () {
        Route::get('/user/dashboard', [DashboardController::class, 'index'])->name('user.dashboard');
        Route::post('/borrow/{book}', [DashboardController::class, 'borrow'])->name('borrow.book');
        Route::get('/user/borrowings', [DashboardController::class, 'borrowings'])->name('user.borrowings');
        Route::post('/return/{borrowing}', [DashboardController::class, 'returnBook'])->name('return.book');
    });

    // Admin Routes
    Route::middleware(['is.admin'])->group(function () {
        Route::get('/admin/dashboard', [DashboardController::class, 'adminDashboard'])->name('admin.dashboard');
        Route::resource('admin/books', BookController::class)->names([
            'index' => 'admin.books.index',
            'create' => 'admin.books.create',
            'store' => 'admin.books.store',
            'edit' => 'admin.books.edit',
            'update' => 'admin.books.update',
            'destroy' => 'admin.books.destroy',
        ]);
        Route::get('/admin/transactions', [DashboardController::class, 'transactions'])->name('admin.transactions');
        Route::get('/admin/print', [DashboardController::class, 'print'])->name('admin.print');
        Route::resource('admin/categories', \App\Http\Controllers\CategoryController::class)->names([
            'index' => 'admin.categories.index',
            'store' => 'admin.categories.store',
            'update' => 'admin.categories.update',
            'destroy' => 'admin.categories.destroy',
        ])->only(['index', 'store', 'update', 'destroy']);
    });
});
