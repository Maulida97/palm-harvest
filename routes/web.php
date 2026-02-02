<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\Officer;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

// Redirect authenticated users to their dashboard based on role
Route::get('/dashboard', function () {
    if (auth()->user()->isAdmin()) {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('officer.dashboard');
})->middleware(['auth'])->name('dashboard');

// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [Admin\DashboardController::class, 'index'])->name('dashboard');
    
    // Blocks management
    Route::resource('blocks', Admin\BlockController::class);
    
    // Officers management
    Route::resource('officers', Admin\OfficerController::class);
    
    // Harvests management
    Route::get('harvests', [Admin\HarvestController::class, 'index'])->name('harvests.index');
    Route::get('harvests/{harvest}', [Admin\HarvestController::class, 'show'])->name('harvests.show');
    Route::post('harvests/{harvest}/verify', [Admin\HarvestController::class, 'verify'])->name('harvests.verify');
    Route::delete('harvests/{harvest}', [Admin\HarvestController::class, 'destroy'])->name('harvests.destroy');
    
    // Reports
    Route::get('reports', [Admin\ReportController::class, 'index'])->name('reports.index');
    Route::get('reports/export', [Admin\ReportController::class, 'export'])->name('reports.export');
    
    // BAP / Input QC
    Route::get('bap', [Admin\BapController::class, 'index'])->name('bap.index');
    Route::get('bap/create', [Admin\BapController::class, 'create'])->name('bap.create');
    Route::post('bap', [Admin\BapController::class, 'store'])->name('bap.store');
    Route::get('bap/{bap}', [Admin\BapController::class, 'show'])->name('bap.show');
    Route::get('bap/{bap}/edit', [Admin\BapController::class, 'edit'])->name('bap.edit');
    Route::put('bap/{bap}', [Admin\BapController::class, 'update'])->name('bap.update');
    Route::delete('bap/{bap}', [Admin\BapController::class, 'destroy'])->name('bap.destroy');
    
    // Hold QC
    Route::get('holdqc', [Admin\HoldQcController::class, 'index'])->name('holdqc.index');
    Route::post('holdqc/{holdqc}/approve', [Admin\HoldQcController::class, 'approve'])->name('holdqc.approve');
    Route::post('holdqc/{holdqc}/reject', [Admin\HoldQcController::class, 'reject'])->name('holdqc.reject');
    Route::delete('holdqc/{holdqc}', [Admin\HoldQcController::class, 'destroy'])->name('holdqc.destroy');
    
    // Kebersihan Ancak Panen & TPH
    Route::resource('ancak', Admin\AncakInspectionController::class);
    
    // Internal Memo routes
    Route::prefix('memo')->name('memo.')->group(function () {
        Route::get('{type}', [Admin\InternalMemoController::class, 'index'])->name('index')->where('type', 'agronomi|pabrik');
        Route::get('{type}/create', [Admin\InternalMemoController::class, 'create'])->name('create')->where('type', 'agronomi|pabrik');
        Route::post('{type}', [Admin\InternalMemoController::class, 'store'])->name('store')->where('type', 'agronomi|pabrik');
        Route::get('{type}/{memo}', [Admin\InternalMemoController::class, 'show'])->name('show')->where('type', 'agronomi|pabrik');
        Route::delete('{type}/{memo}', [Admin\InternalMemoController::class, 'destroy'])->name('destroy')->where('type', 'agronomi|pabrik');
    });
});

// Officer Routes
Route::middleware(['auth', 'role:officer'])->prefix('officer')->name('officer.')->group(function () {
    Route::get('/dashboard', [Officer\DashboardController::class, 'index'])->name('dashboard');
    
    // Harvests - only create and view own
    Route::get('harvests', [Officer\HarvestController::class, 'index'])->name('harvests.index');
    Route::get('harvests/create', [Officer\HarvestController::class, 'create'])->name('harvests.create');
    Route::post('harvests', [Officer\HarvestController::class, 'store'])->name('harvests.store');
});

// Profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
