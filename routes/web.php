<?php

use App\Http\Controllers\DashboardController as Dashboard;
use App\Http\Controllers\ProfileController as Profile;
use Illuminate\Support\Facades\Route;

Route::name('web.')->group(function () {
    Route::get('/', function () {
        return view('web.index');
    })->name('index');

    Route::get('/styleguide', function () {
        return view('web.styleguide');
    })->name('styleguide');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [Dashboard::class, 'index'])->name('dashboard');
    
    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::prefix('profile')->name('profile.')->group(function () {
            Route::get('/', [Profile::class, 'index'])->name('index');
            Route::get('/edit', [Profile::class, 'edit'])->name('edit');
            Route::put('/update', [Profile::class, 'update'])->name('update');
            Route::delete('/destroy', [Profile::class, 'destroy'])->name('destroy');
        });
    });
});

Route::get('/test', function () {
    return view('auth.confirm-password');
})->name('test');