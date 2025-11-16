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
        [
            'route' => 'web.index', 
            'title' => 'Home'
        ],
        [
            'href' => 'https://github.com/mkfizi/starter-laravel/blob/main/README.md', 
            'title' => 'Readme' 
        ],
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
            'title' => 'Dashboard'
        ],
        [
            'route' => 'dashboard',
            'title' => 'Home'
        ],
        [
            'route' => 'dashboard.layouts.collapse',
            'title' => 'Collapse'
        ],
        [
            'route' => 'dashboard.layouts.stacked',
            'title' => 'Stacked'
        ],
        [
            'title' => 'UI'
        ],
        [
            'route' => 'dashboard.ui.styleguide',
            'title' => 'Styleguide'
        ],
        [
            'route' => 'dashboard.ui.components.',
            'title' => 'Components',
            'links' => [
                [
                    'route' => 'dashboard.ui.components.alert',
                    'title' => 'Alert'
                ],
                [
                    'route' => 'dashboard.ui.components.dropdown',
                    'title' => 'Dropdown'
                ],
                [
                    'route' => 'dashboard.ui.components.modal',
                    'title' => 'Modal'
                ]
            ],
        ],
    ],
];