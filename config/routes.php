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
            'route' => 'dashboard.layouts.collapsible',
            'title' => 'Collapsible'
        ],
        [
            'route' => 'dashboard.layouts.navbar',
            'title' => 'Navbar'
        ],
        [
            'title' => 'Pages'
        ],
        [
            'route' => 'dashboard.pages.styleguide',
            'title' => 'Styleguide'
        ],
        [
            'route' => 'dashboard.pages.blank',
            'title' => 'Blank'
        ],
        [
            'route' => 'dashboard.components.',
            'title' => 'Components',
            'links' => [
                [
                    'route' => 'dashboard.components.alert',
                    'title' => 'Alert'
                ],
                [
                    'route' => 'dashboard.components.button',
                    'title' => 'Button'
                ],
                [
                    'route' => 'dashboard.components.dropdown',
                    'title' => 'Dropdown'
                ],
                [
                    'route' => 'dashboard.components.modal',
                    'title' => 'Modal'
                ],
                [
                    'route' => 'dashboard.components.typography',
                    'title' => 'Typography'
                ],
                [
                    'route' => 'dashboard.components.offcanvas',
                    'title' => 'Offcanvas'
                ],
            ],
        ],
    ],
];