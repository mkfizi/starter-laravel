<?php

use App\Http\Controllers\DashboardController as Dashboard;
use App\Http\Controllers\ProfileController as Profile;
use App\Http\Controllers\SettingsController as Settings;
use App\Http\Controllers\Admin\UsersController as Users;
use App\Http\Controllers\Admin\RolesController as Roles;
use App\Http\Controllers\Admin\ActivityLogController as ActivityLog;
use App\Http\Controllers\Admin\SessionHistoryController as SessionHistory;
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
            Route::resource('users', Users::class);
            Route::resource('roles', Roles::class);

            Route::prefix('audit')->name('audit.')->group(function () {
                Route::prefix('activity-log')->name('activity-log.')->middleware('can:activity-logs:read')->group(function () {
                    Route::get('/', [ActivityLog::class, 'index'])->name('index');
                    Route::get('/{activity}', [ActivityLog::class, 'show'])->name('show');
                }); 

                Route::get('/session-history', [SessionHistory::class, 'index'])->name('session-history')->middleware('can:session-history:read');
            });
        });

         Route::prefix('layouts')->name('layouts.')->group(function () {
            Route::get('/collapse', fn() => view('dashboard.layouts.collapse'))->name('collapse');
            Route::get('/stacked', fn() => view('dashboard.layouts.stacked'))->name('stacked');
        });
    });
});