<?php

use App\Http\Controllers\Admin\BookController as AdminBookController;
use App\Http\Controllers\Admin\BorrowController as AdminBorrowController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\BookController as UserBookController;
use App\Http\Controllers\User\BorrowController as UserBorrowController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('dashboard')
        : redirect()->route('login');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/books', [UserBookController::class, 'index'])->name('books.index');
    Route::get('/books/{book}', [UserBookController::class, 'show'])->name('books.show');
    Route::post('/books/{book}/borrow', [UserBorrowController::class, 'store'])->name('books.borrow');

    Route::get('/my-borrows', [UserBorrowController::class, 'index'])->name('borrows.index');

    Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
        Route::resource('books', AdminBookController::class)->except(['show']);
        Route::resource('categories', AdminCategoryController::class)->except(['show']);
        Route::resource('users', AdminUserController::class)->except(['show']);

        Route::get('/borrows', [AdminBorrowController::class, 'index'])->name('borrows.index');
        Route::patch('/borrows/{borrow}/approve', [AdminBorrowController::class, 'approve'])->name('borrows.approve');
        Route::patch('/borrows/{borrow}/reject', [AdminBorrowController::class, 'reject'])->name('borrows.reject');
        Route::patch('/borrows/{borrow}/return', [AdminBorrowController::class, 'returnBook'])->name('borrows.return');
        Route::delete('/borrows/{borrow}', [AdminBorrowController::class, 'destroy'])->name('borrows.destroy');
    });
});
