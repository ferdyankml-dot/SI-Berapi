<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VolcanoController;
use App\Http\Controllers\MissingPersonController;
use App\Http\Controllers\DisasterHistoryController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;

// ==========================================
// PUBLIC USER ROUTES
// ==========================================
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix('gunung')->name('volcanoes.')->group(function () {
    Route::get('/', [VolcanoController::class, 'index'])->name('index');
    Route::get('/{id}', [VolcanoController::class, 'show'])->name('show');
});

Route::prefix('orang-hilang')->name('missing_persons.')->group(function () {
    Route::get('/', [MissingPersonController::class, 'index'])->name('index');
    Route::post('/', [MissingPersonController::class, 'store'])->name('store');
});

Route::get('/riwayat', [DisasterHistoryController::class, 'index'])->name('disasters.index');
Route::get('/edukasi', [EducationController::class, 'index'])->name('education.index');
Route::get('/kontak', [ContactController::class, 'index'])->name('contact.index');

// ==========================================
// AUTHENTICATION ROUTES
// ==========================================
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ==========================================
// PROTECTED ADMIN PANEL ROUTES
// ==========================================
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Volcanoes CRUD
    Route::prefix('volcanoes')->name('volcanoes.')->group(function () {
        Route::get('/', [AdminController::class, 'volcanoesIndex'])->name('index');
        Route::get('/create', [AdminController::class, 'volcanoesCreate'])->name('create');
        Route::post('/', [AdminController::class, 'volcanoesStore'])->name('store');
        Route::get('/{id}/edit', [AdminController::class, 'volcanoesEdit'])->name('edit');
        Route::put('/{id}', [AdminController::class, 'volcanoesUpdate'])->name('update');
        Route::delete('/{id}', [AdminController::class, 'volcanoesDestroy'])->name('destroy');
    });

    // Missing Persons Moderation
    Route::prefix('missing-persons')->name('missing.')->group(function () {
        Route::get('/', [AdminController::class, 'missingIndex'])->name('index');
        Route::post('/{id}/toggle-status', [AdminController::class, 'missingToggleStatus'])->name('toggle_status');
        Route::post('/{id}/toggle-approval', [AdminController::class, 'missingToggleApproval'])->name('toggle_approval');
        Route::delete('/{id}', [AdminController::class, 'missingDestroy'])->name('destroy');
    });

    // Disaster Histories CRUD
    Route::prefix('histories')->name('histories.')->group(function () {
        Route::get('/', [AdminController::class, 'historyIndex'])->name('index');
        Route::get('/create', [AdminController::class, 'historyCreate'])->name('create');
        Route::post('/', [AdminController::class, 'historyStore'])->name('store');
        Route::get('/{id}/edit', [AdminController::class, 'historyEdit'])->name('edit');
        Route::put('/{id}', [AdminController::class, 'historyUpdate'])->name('update');
        Route::delete('/{id}', [AdminController::class, 'historyDestroy'])->name('destroy');
    });

    // Education Content CRUD
    Route::prefix('education')->name('education.')->group(function () {
        Route::get('/', [AdminController::class, 'educationIndex'])->name('index');
        Route::get('/create', [AdminController::class, 'educationCreate'])->name('create');
        Route::post('/', [AdminController::class, 'educationStore'])->name('store');
        Route::get('/{id}/edit', [AdminController::class, 'educationEdit'])->name('edit');
        Route::put('/{id}', [AdminController::class, 'educationUpdate'])->name('update');
        Route::delete('/{id}', [AdminController::class, 'educationDestroy'])->name('destroy');
    });
});
