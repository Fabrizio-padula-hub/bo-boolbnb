<?php

use App\Http\Controllers\Admin\ApartmentController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\SponsorshipController;
use App\Http\Controllers\Admin\VisitController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::middleware(['auth', 'verified'])
    ->name('admin.')
    ->prefix('admin')
    ->group(function () {
        Route::get('/dashboard', [VisitController::class, 'index'])->name('dashboard');
        Route::resource('apartments', ApartmentController::class)->parameters([
            'apartments' => 'apartment:slug'
        ]);
        Route::get('/messages', [MessageController::class, 'index'])->name('message');
        Route::get('/sponsorships', [SponsorshipController::class, 'index'])->name('sponsorships');
        Route::get('/deleted', [ApartmentController::class, 'showSoftDeletedApartments'])->name('deleted');
        Route::get('/restore/{apartment}', [ApartmentController::class, 'restoreApartment'])->name('restore');
        Route::get('/autocomplete', [ApartmentController::class, 'autocomplete'])->name('apartments.autocomplete');
        Route::post('/save', [ApartmentController::class, 'save'])->name('apartments.save');
    });

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
