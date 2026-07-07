<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminEntryController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\QRCodeController;
use App\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/register', [RegistrationController::class, 'index'])->name('register.index');
Route::post('/register', [RegistrationController::class, 'store'])->name('register.store');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'create'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'store'])->name('login.store');

    Route::middleware('ensure.admin.authenticated')->group(function () {
        Route::post('/logout', [AdminAuthController::class, 'destroy'])->name('logout');
        Route::get('/entries', [AdminEntryController::class, 'index'])->name('entries.index');
        Route::get('/entries/export', [AdminEntryController::class, 'export'])->name('entries.export');
    });
});

Route::middleware('ensure.player.registered')->group(function () {
    Route::get('/game', [GameController::class, 'index'])->name('game.index');
    Route::get('/scan/{store:slug}', [QRCodeController::class, 'show'])->name('scan.show');
    Route::get('/complete', [GameController::class, 'complete'])->name('game.complete');
});
