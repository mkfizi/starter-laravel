<?php

use App\Http\Controllers\DashboardController as Dashboard;
use App\Http\Controllers\ProfileController as Profile;
use App\Http\Controllers\SettingsController as Settings;
use App\Http\Controllers\RolesController as Roles;
use App\Http\Controllers\SessionHistoryController as SessionHistory;
use App\Http\Controllers\UsersController as Users;
use App\Http\Controllers\ActivityLogController as ActivityLog;
use Illuminate\Support\Facades\Route;

Route::name('web.')->group(function () {
    Route::get('/', function () {
        return view('web.index');
    })->name('index');

    Route::get('/readme', function () {
        return view('web.readme');
    })->name('readme');
});

Route::middleware(['auth', 'verified', 'password.changed'])->group(function () {
    Route::get('/dashboard', [Dashboard::class, 'index'])->name('dashboard');
    
    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::get('/profile', [Profile::class, 'index'])->name('profile');

        Route::prefix('settings')->name('settings.')->group(function () {
            Route::get('/account', [Settings::class, 'account'])->name('account');
            Route::get('/password', [Settings::class, 'password'])->name('password')->withoutMiddleware('password.changed');
            Route::get('/two-factor', [Settings::class, 'twoFactor'])->name('two-factor');
            Route::put('/update-profile', [Settings::class, 'updateProfile'])->name('update-profile')->middleware('password.confirm');
            Route::put('/update-password', [Settings::class, 'updatePassword'])->name('update-password')->withoutMiddleware('password.changed');
            Route::delete('/destroy', [Settings::class, 'destroy'])->name('destroy');
        });

        Route::prefix('admin')->name('admin.')->group(function () {
            // Users resource routes with specific permissions
            Route::resource('users', Users::class)->only(['index', 'show'])->middleware('can:user-management:read');
            Route::resource('users', Users::class)->only(['create', 'store'])->middleware('can:user-management:create');
            Route::resource('users', Users::class)->only(['edit', 'update'])->middleware('can:user-management:update');
            Route::resource('users', Users::class)->only(['destroy'])->middleware('can:user-management:delete');

            // Roles resource routes with specific permissions
            Route::resource('roles', Roles::class)->only(['index', 'show'])->middleware('can:roles:read');
            Route::resource('roles', Roles::class)->only(['create', 'store'])->middleware('can:roles:create');
            Route::resource('roles', Roles::class)->only(['edit', 'update'])->middleware('can:roles:update');
            Route::resource('roles', Roles::class)->only(['destroy'])->middleware('can:roles:delete');

            Route::get('/session-history', [SessionHistory::class, 'index'])->name('session-history')->middleware('can:session-history:read');
            
            Route::prefix('activity-log')->name('activity-log.')->middleware('can:activity-logs:read')->group(function () {
                Route::get('/', [ActivityLog::class, 'index'])->name('index');
                Route::get('/{activity}', [ActivityLog::class, 'show'])->name('show');
            }); 
        });

        // Route::prefix('activity-log')->name('activity-log.')->middleware('can:dashboard-admin:read')->group(function () {
        //     Route::get('/', [ActivityLog::class, 'index'])->name('index');
        //     Route::get('/{activity}', [ActivityLog::class, 'show'])->name('show');
        // });

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