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