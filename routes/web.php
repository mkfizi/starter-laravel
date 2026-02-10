<?php

use App\Http\Controllers\Dashboard\DashboardController as Dashboard;
use App\Http\Controllers\Dashboard\ProfileController as Profile;
use App\Http\Controllers\Dashboard\SettingsController as Settings;
use App\Http\Controllers\Dashboard\Admin\UsersController as Users;
use App\Http\Controllers\Dashboard\Admin\RolesController as Roles;
use App\Http\Controllers\Dashboard\Admin\Audit\ActivityLogController as ActivityLog;
use App\Http\Controllers\Dashboard\Admin\Audit\SessionHistoryController as SessionHistory;
use Illuminate\Support\Facades\Route;

/**
 * Web Routes
 * 
 * Defines all HTTP routes for the application.
 * Routes are organized into groups:
 * - Public web routes (homepage, readme)
 * - Authenticated dashboard routes
 * - User profile and settings
 * - Admin management (users, roles, audit logs)
 */

// ============================================================================
// Public Routes
// ============================================================================

Route::name('web.')->group(function () {
    // Homepage
    Route::get('/', function () {
        return view('web.index');
    })->name('index');

    // Documentation/Readme page
    Route::get('/readme', function () {
        return view('web.readme');
    })->name('readme');
});

// ============================================================================
// Authenticated Routes
// Routes requiring authentication, email verification, and password change
// ============================================================================

Route::middleware(['auth', 'verified', 'password.changed'])->group(function () {
    // Main dashboard page
    Route::get('/dashboard', [Dashboard::class, 'index'])->name('dashboard');
    
    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        // User profile page
        Route::get('/profile', [Profile::class, 'index'])->name('profile');

        // ====================================================================
        // User Settings Routes
        // ====================================================================
        Route::prefix('settings')->name('settings.')->group(function () {
            // Account settings page
            Route::get('/account', [Settings::class, 'account'])->name('account');
            
            // Password management (allows access even if password must be changed)
            Route::get('/password', [Settings::class, 'password'])->name('password')->withoutMiddleware('password.changed');
            
            // Two-factor authentication settings
            Route::get('/two-factor', [Settings::class, 'twoFactor'])->name('two-factor');
            
            // Update profile information (requires password confirmation)
            Route::put('/update-profile', [Settings::class, 'updateProfile'])->name('update-profile')->middleware('password.confirm');
            
            // Update password (allows access even if password must be changed)
            Route::put('/update-password', [Settings::class, 'updatePassword'])->name('update-password')->withoutMiddleware('password.changed');
            
            // Delete account
            Route::delete('/destroy', [Settings::class, 'destroy'])->name('destroy');
        });

        // ====================================================================
        // Admin Routes
        // Permission-based routes for administrative functions
        // ====================================================================
        Route::prefix('admin')->name('admin.')->group(function () {
            // User management (CRUD operations)
            Route::resource('users', Users::class);
            
            // Role management (CRUD operations)
            Route::resource('roles', Roles::class);

            // Audit & Security Monitoring
            Route::prefix('audit')->name('audit.')->group(function () {
                // Activity log routes (requires 'activity-logs:read' permission)
                Route::prefix('activity-log')->name('activity-log.')->middleware('can:activity-logs:read')->group(function () {
                    Route::get('/', [ActivityLog::class, 'index'])->name('index');
                    Route::get('/{activity}', [ActivityLog::class, 'show'])->name('show');
                }); 

                // Session history (requires 'session-history:read' permission)
                Route::get('/session-history', [SessionHistory::class, 'index'])->name('session-history')->middleware('can:session-history:read');
            });
        });

        // ====================================================================
        // Layout Examples
        // Demo pages showcasing different layout options
        // ====================================================================
         Route::prefix('layouts')->name('layouts.')->group(function () {
            // Collapsed sidebar layout
            Route::get('/collapse', fn() => view('dashboard.layouts.collapse'))->name('collapse');
            
            // Stacked layout
            Route::get('/stacked', fn() => view('dashboard.layouts.stacked'))->name('stacked');
        });
    });
});