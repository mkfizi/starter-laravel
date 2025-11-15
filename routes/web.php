<?php

use App\Http\Controllers\DashboardController as Dashboard;
use App\Http\Controllers\ProfileController as Profile;
use Illuminate\Support\Facades\Route;

Route::name('web.')->group(function () {
    Route::get('/', function () {
        return view('web.index');
    })->name('index');

    Route::get('/readme', function () {
        return view('web.readme');
    })->name('readme');
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

        Route::prefix('pages')->name('pages.')->group(function () {
            Route::get('/styleguide', fn() => view('dashboard.pages.styleguide'))->name('styleguide');
            Route::get('/blank', fn() => view('dashboard.pages.blank'))->name('blank');
            Route::get('/404', fn() => view('dashboard.pages.404'))->name('404');
        });

        Route::prefix('layouts')->name('layouts.')->group(function () {
            Route::get('/collapsible', fn() => view('dashboard.layouts.collapsible'))->name('collapsible');
            Route::get('/navbar', fn() => view('dashboard.layouts.navbar'))->name('navbar');
            Route::get('/404', fn() => view('dashboard.pages.404'))->name('404');
        });

        Route::prefix('components')->name('components.')->group(function () {
            Route::get('/alert', fn() => view('dashboard.components.alert'))->name('alert');
            Route::get('/button', fn() => view('dashboard.components.button'))->name('button');
            Route::get('/dropdown', fn() => view('dashboard.components.dropdown'))->name('dropdown');
            Route::get('/modal', fn() => view('dashboard.components.modal'))->name('modal');
            Route::get('/typography', fn() => view('dashboard.components.typography'))->name('typography');
            Route::get('/offcanvas', fn() => view('dashboard.components.offcanvas'))->name('offcanvas'); 
        });
    });
});