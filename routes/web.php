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
            Route::get('/blank', function () {
                return view('dashboard.pages.blank');
            })->name('blank');

            Route::get('/404', function () {
                return view('dashboard.pages.404');
            })->name('404');
        });

        Route::prefix('components')->name('components.')->group(function () {
            Route::get('/alert', function () {
                return view('dashboard.components.alert');
            })->name('alert');
            Route::get('/button', function () {
                return view('dashboard.components.button');
            })->name('button');
            Route::get('/dropdown', function () {
                return view('dashboard.components.dropdown');
            })->name('dropdown');
            Route::get('/modal', function () {
                return view('dashboard.components.modal');
            })->name('modal');
            Route::get('/typography', function () {
                return view('dashboard.components.typography');
            })->name('typography');
            Route::get('/offcanvas', function () {
                return view('dashboard.components.offcanvas');
            })->name('offcanvas');
        });
    });
});

Route::get('/test', function () {
    return view('auth.confirm-password');
})->name('test');