<?php

use App\Http\Controllers\DashboardController as Dashboard;
use App\Http\Controllers\ProfileController as Profile;
use App\Http\Controllers\SettingsController as Settings;
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
        Route::get('/profile', [Profile::class, 'index'])->name('profile');

        Route::prefix('settings')->name('settings.')->group(function () {
            Route::get('/account', [Settings::class, 'account'])->name('account');
            Route::get('/password', [Settings::class, 'password'])->name('password');
            Route::get('/two-factor', [Settings::class, 'twoFactor'])->name('two-factor');
            Route::put('/update-profile', [Settings::class, 'updateProfile'])->name('update-profile')->middleware('password.confirm');
            Route::put('/update-password', [Settings::class, 'updatePassword'])->name('update-password');
            Route::delete('/destroy', [Settings::class, 'destroy'])->name('destroy');
        });

        Route::prefix('layouts')->name('layouts.')->group(function () {
            Route::get('/collapse', fn() => view('dashboard.layouts.collapse'))->name('collapse');
            Route::get('/stacked', fn() => view('dashboard.layouts.stacked'))->name('stacked');
        });

        Route::prefix('ui')->name('ui.')->group(function () {
            Route::get('/typography', fn() => view('dashboard.ui.styleguide'))->name('typography');
            Route::get('/element', fn() => view('dashboard.ui.element'))->name('element');
            Route::get('/form', fn() => view('dashboard.ui.form'))->name('form');
            
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
});