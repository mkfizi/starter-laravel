<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Web Routes
    |--------------------------------------------------------------------------
    |
    | Here you may define all of the routes for web layout navigation.
    |
    */

    'web' => [
        ['name' => 'Home', 'href' => '/'],
        ['name' => 'Styleguide', 'href' => '/styleguide'],
    ],

    /*
    |--------------------------------------------------------------------------
    | Dashboard Routes
    |--------------------------------------------------------------------------
    |
    | Here you may define all of the routes for dashboard layout navigation.
    |
    */

    'dashboard' => [
        ['name' => 'Overview', 'href' => '/dashboard'],
        ['name' => 'Settings', 'href' => '/dashboard/settings'],
    ],
];