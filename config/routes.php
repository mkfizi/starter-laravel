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
            'title' => 'Home',
            'route' => 'web.index'
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
            'title' => 'Home',
            'route' => 'dashboard',
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="icons-tabler-outline icon icon-tabler icon-tabler-home"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l-2 0l9 -9l9 9l-2 0" /><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" /><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" /></svg>'
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
            'route' => 'dashboard.ui.components.',
            'title' => 'Components',
            'links' => [
                [
                    'route' => 'dashboard.ui.components.alert',
                    'title' => 'Alert'
                ],
                [
                    'route' => 'dashboard.ui.components.dropdown',
                    'title' => 'Collapse'
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
        [
            'title' => 'External'
        ],
        [
            'href' => 'https://github.com/mkfizi/starter-laravel',
            'title' => 'Github'
        ],
        [
            'href' => 'https://github.com/mkfizi/starter-laravel/blob/main/README.md',
            'title' => 'Readme'
        ],
    ],
];