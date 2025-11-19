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
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="icons-tabler-outline icon icon-tabler icon-tabler-home"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l-2 0l9 -9l9 9l-2 0" /><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" /><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" /></svg>',
            'route' => 'dashboard',
            'active' => 'dashboard',
            'title' => 'Home'
        ],
        [
            'title' => 'Admin',
        ],
        [
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="icons-tabler-outline icon icon-tabler icon-tabler-users"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" /><path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /><path d="M16 3.13a4 4 0 0 1 0 7.75" /><path d="M21 21v-2a4 4 0 0 0 -3 -3.85" /></svg>',
            'route' => 'dashboard.admin.user',
            'active' => 'dashboard.admin.user.*',
            'title' => 'Users'
        ],
        [
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="icons-tabler-outline icon icon-tabler icon-tabler-topology-star"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 18a2 2 0 1 0 -4 0a2 2 0 0 0 4 0z" /><path d="M20 6a2 2 0 1 0 -4 0a2 2 0 0 0 4 0z" /><path d="M8 6a2 2 0 1 0 -4 0a2 2 0 0 0 4 0z" /><path d="M20 18a2 2 0 1 0 -4 0a2 2 0 0 0 4 0z" /><path d="M14 12a2 2 0 1 0 -4 0a2 2 0 0 0 4 0z" /><path d="M7.5 7.5l3 3" /><path d="M7.5 16.5l3 -3" /><path d="M13.5 13.5l3 3" /><path d="M16.5 7.5l-3 3" /></svg>',
            'route' => 'dashboard.admin.roles.index',
            'active' => 'dashboard.admin.roles.*',
            'title' => 'Roles'
        ],
        [
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="icons-tabler-outline icon icon-tabler icon-tabler-run"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M13 4m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /><path d="M4 17l5 1l.75 -1.5" /><path d="M15 21l0 -4l-4 -3l1 -6" /><path d="M7 12l0 -3l5 -1l3 3l3 1" /></svg>',
            'route' => 'dashboard.admin.activity-logs',
            'active' => 'dashboard.admin.activity-logs.*',
            'title' => 'Activity Log'
        ],
        [
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="icons-tabler-outline icon icon-tabler icon-tabler-stopwatch"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 13a7 7 0 1 0 14 0a7 7 0 0 0 -14 0z" /><path d="M14.5 10.5l-2.5 2.5" /><path d="M17 8l1 -1" /><path d="M14 3h-4" /></svg>',
            'route' => 'dashboard.admin.session-history',
            'title' => 'Session History'
        ],
        [
            'title' => 'Layouts'
        ],
        [
            'route' => 'dashboard.layouts.collapse',
            'active' => 'dashboard.layouts.collapse',
            'title' => 'Collapse'
        ],
        [
            'route' => 'dashboard.layouts.stacked',
            'active' => 'dashboard.layouts.stacked',
            'title' => 'Stacked'
        ],
        [
            'title' => 'UI'
        ],
        [
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
            'route' => 'dashboard.ui.components.',
            'title' => 'Components',
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="icons-tabler-outline icon icon-tabler icon-tabler-categories"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 4h6v6h-6z" /><path d="M14 4h6v6h-6z" /><path d="M4 14h6v6h-6z" /><path d="M14 14h6v6h-6z" /></svg>'
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