<?php

use App\Http\Controllers\DashboardController as Dashboard;
use App\Http\Controllers\ProfileController as Profile;
use App\Http\Controllers\SettingsController as Settings;
use App\Http\Controllers\RolesController as Roles;
use App\Http\Controllers\SessionHistoryController as SessionHistory;
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

        Route::prefix('admin')->name('admin.')->group(function () {
            Route::get('/user', fn() => view('dashboard.admin.user'))->name('user');
            Route::prefix('roles')->name('roles.')->group(function () {
                Route::get('/', [Roles::class, 'index'])->name('index');
                Route::get('/show/{id}', [Roles::class, 'show'])->name('show');
                Route::get('/create', [Roles::class, 'create'])->name('create');
                Route::post('/store', [Roles::class, 'store'])->name('store');
                Route::get('/edit/{id}', [Roles::class, 'edit'])->name('edit');
                Route::put('/update/{id}', [Roles::class, 'update'])->name('update');
                Route::delete('/destroy/{id}', [Roles::class, 'destroy'])->name('destroy');
            });
            Route::get('/activity-logs', fn() => view('dashboard.admin.activity-logs'))->name('activity-logs');
            Route::get('/session-history', [SessionHistory::class, 'index'])->name('session-history');
        });

        Route::prefix('layouts')->name('layouts.')->group(function () {
            Route::get('/collapse', fn() => view('dashboard.layouts.collapse'))->name('collapse');
            Route::get('/stacked', fn() => view('dashboard.layouts.stacked'))->name('stacked');
        });

        Route::prefix('ui')->name('ui.')->group(function () {
            Route::get('/styleguide', fn() => view('dashboard.ui.styleguide'))->name('styleguide');
            
            Route::prefix('components')->name('components.')->group(function () {
                Route::get('/alert', fn() => view('dashboard.ui.components.alert'))->name('alert');
                Route::get('/dropdown', fn() => view('dashboard.ui.components.dropdown'))->name('dropdown');
                Route::get('/modal', fn() => view('dashboard.ui.components.modal'))->name('modal');
                Route::get('/typography', fn() => view('dashboard.ui.components.typography'))->name('typography');
                Route::get('/offcanvas', fn() => view('dashboard.ui.components.offcanvas'))->name('offcanvas');
            });
        });
    });
});