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
        [
            'name' => 'Dashboard', 
            'href' => '/dashboard'
        ],
        [
            'name' => 'Module',
        ],
        [
            'name' => 'Module 1', 
            'href' => '#'
        ],
        [
            'name' => 'Module 2', 
            'href' => '#'
        ],
        [
            'name' => 'Module 3', 
            'href' => '#'
        ],
        [
            'name' => 'Module Menu',
            'links' => [
                [
                    'name' => 'Link 1', 
                    'href' => '#'
                ],
                [
                    'name' => 'Link 2', 
                    'href' => '#'
                ],
                [
                    'name' => 'Link 3', 
                    'href' => '#'
                ],
            ],
        ],
    ],
];