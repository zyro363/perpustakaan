<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\DashboardController;

Route::get('/', [\App\Http\Controllers\WelcomeController::class, 'index'])->name('welcome');

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
        Route::get('/book/{id}', [BookController::class, 'show'])->name('user.book.show');
        Route::post('/book/{id}/review', [App\Http\Controllers\ReviewController::class, 'store'])->name('book.review');
        Route::post('/borrow/{book}', [DashboardController::class, 'borrow'])->name('borrow.book');
        Route::get('/user/borrowings', [DashboardController::class, 'borrowings'])->name('user.borrowings');
        Route::get('/user/borrowings', [DashboardController::class, 'borrowings'])->name('user.borrowings');
        Route::post('/return/{borrowing}', [DashboardController::class, 'returnBook'])->name('return.book');

        // Favorites
        Route::get('/user/favorites', [App\Http\Controllers\FavoriteController::class, 'index'])->name('user.favorites');
        Route::post('/favorite/{bookId}', [App\Http\Controllers\FavoriteController::class, 'toggle'])->name('favorite.toggle');
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
        Route::get('/admin/export', [DashboardController::class, 'export'])->name('admin.export');
        Route::get('/admin/print', [DashboardController::class, 'print'])->name('admin.print');
        Route::resource('admin/categories', \App\Http\Controllers\CategoryController::class)->names([
            'index' => 'admin.categories.index',
            'store' => 'admin.categories.store',
            'update' => 'admin.categories.update',
            'destroy' => 'admin.categories.destroy',
        ])->only(['index', 'store', 'update', 'destroy']);

        Route::resource('admin/users', \App\Http\Controllers\UserController::class)->names([
            'index' => 'admin.users.index',
            'edit' => 'admin.users.edit',
            'update' => 'admin.users.update',
            'destroy' => 'admin.users.destroy',
        ])->only(['index', 'edit', 'update', 'destroy']);

        // Settings Routes
        Route::get('admin/settings', [\App\Http\Controllers\SettingController::class, 'index'])->name('admin.settings.index');
        Route::put('admin/settings', [\App\Http\Controllers\SettingController::class, 'update'])->name('admin.settings.update');

        // Fine Payment Route
        Route::post('admin/transactions/{id}/pay', [\App\Http\Controllers\DashboardController::class, 'markAsPaid'])->name('admin.transactions.pay');
    });
});
