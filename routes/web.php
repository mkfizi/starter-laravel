<?php

use Illuminate\Support\Facades\Route;

Route::name('web.')->group(function () {
    Route::get('/', function () {
        return view('web.index');
    })->name('home');

    Route::get('/styleguide', function () {
        return view('web.styleguide');
    })->name('styleguide');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [Dashboard::class, 'index'])->name('dashboard');
    
    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        // Additional dashboard routes can be defined here
    });
});