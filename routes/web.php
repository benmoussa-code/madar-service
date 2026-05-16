<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\AnnouncementController;

Route::get('/lang/{locale}', [LanguageController::class, 'switch'])->name('lang.switch');

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
// Authenticated Routes
Route::middleware('auth')->group(function () {
    Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
    Route::get('/services/{service}', [ServiceController::class, 'show'])->name('services.show');
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Dashboard Redirection
    Route::get('/dashboard', function () {
        $role = auth()->user()->role;
        if ($role === 'admin') return redirect()->route('admin.dashboard');
        if ($role === 'provider') return redirect()->route('provider.dashboard');
        return view('dashboard'); // Client default dashboard
    })->name('dashboard');

    // Client Routes
    Route::post('/services/{service}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::post('/messages', [MessageController::class, 'store'])->name('messages.store');

    // Announcements (Job Requests)
    Route::get('/announcements', [AnnouncementController::class, 'index'])->name('announcements.index');
    Route::get('/announcements/create', [AnnouncementController::class, 'create'])->name('announcements.create');
    Route::post('/announcements', [AnnouncementController::class, 'store'])->name('announcements.store');

    // Provider Routes
    Route::middleware('role:provider')->prefix('provider')->name('provider.')->group(function () {
        Route::get('/dashboard', [ProviderController::class, 'index'])->name('dashboard');
        Route::resource('services', ServiceController::class)->except(['index', 'show']);
        Route::patch('/reviews/{review}/reply', [ReviewController::class, 'reply'])->name('reviews.reply');
    });

    // Admin Routes
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
        Route::get('/users', [AdminController::class, 'users'])->name('users');
        Route::get('/providers/{user}', [AdminController::class, 'showProvider'])->name('providers.show');
        Route::delete('/users/{user}', [AdminController::class, 'destroyUser'])->name('users.destroy');
        Route::delete('/services/{service}', [AdminController::class, 'destroyService'])->name('services.destroy');
        Route::delete('/announcements/{announcement}', [AdminController::class, 'destroyAnnouncement'])->name('announcements.destroy');
        Route::patch('/services/{service}/status', [AdminController::class, 'updateServiceStatus'])->name('services.status');
        Route::get('/categories', [AdminController::class, 'categories'])->name('categories');
    });
});

require __DIR__.'/auth.php';
