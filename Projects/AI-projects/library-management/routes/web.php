<?php

use Illuminate\Support\Facades\Route;
use App\Models\Book;
use App\Models\Category;
use App\Models\Author;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\IssueController;
use App\Http\Controllers\FineController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\AuthController;

Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login'])->name('login.post');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('forgot-password', [AuthController::class, 'showForgotForm'])->name('password.request');
Route::post('forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');
Route::get('reset-password/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
Route::post('reset-password', [AuthController::class, 'resetPassword'])->name('password.update');

Route::middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('issues', [IssueController::class, 'index'])->name('issues.index');

    // Admin only routes
    Route::middleware(['role:admin'])->group(function () {
        Route::resource('students', StudentController::class);
        Route::get('students/{student}/reset-password', [StudentController::class, 'showResetPasswordForm'])->name('students.reset-password');
        Route::post('students/{student}/reset-password', [StudentController::class, 'resetPassword'])->name('students.reset-password.update');
        
        Route::resource('authors', AuthorController::class)->except(['index', 'show']);
        Route::resource('categories', CategoryController::class)->except(['index', 'show']);
        
        Route::resource('books', BookController::class);
        
        Route::get('issues/create', [IssueController::class, 'create'])->name('issues.create');
        Route::post('issues', [IssueController::class, 'store'])->name('issues.store');
        Route::post('issues/{issue}/return', [IssueController::class, 'returnBook'])->name('issues.return');

        // Renewal Admin Routes
        Route::post('issues/{issue}/approve-renewal', [IssueController::class, 'approveRenewal'])->name('issues.approve-renewal');
        Route::post('issues/{issue}/reject-renewal', [IssueController::class, 'rejectRenewal'])->name('issues.reject-renewal');
        Route::post('issues/{issue}/admin-renew', [IssueController::class, 'adminRenew'])->name('issues.admin-renew');

        // Fines Admin Routes
        Route::get('fines', [FineController::class, 'index'])->name('fines.index');
        Route::post('fines/{fine}/pay', [FineController::class, 'markAsPaid'])->name('fines.pay');
        Route::delete('fines/{fine}', [FineController::class, 'destroy'])->name('fines.destroy');
    });

    // Student/User shared routes
    Route::post('issues/{issue}/request-renewal', [IssueController::class, 'requestRenewal'])->name('issues.request-renewal');
    Route::get('my-fines', [FineController::class, 'index'])->name('fines.my-fines');

    // Reservations
    Route::get('reservations', [ReservationController::class, 'index'])->name('reservations.index');
    Route::post('reservations', [ReservationController::class, 'store'])->name('reservations.store');
    Route::delete('reservations/{reservation}', [ReservationController::class, 'destroy'])->name('reservations.destroy');

    // Shared Viewing
    Route::resource('authors', AuthorController::class)->only(['index', 'show']);
    Route::resource('categories', CategoryController::class)->only(['index', 'show']);
});
