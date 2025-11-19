<?php

return [
    /**
     * Default users for initial seeding.
     */
    'users' => [
        [
            'name' => 'Super Admin',
            'email' => 'admin@email.com',
            'password' => 'admin123',
            'role' => 'Super Admin',
        ],
    ],
    
    /**
     * Seeder settings for roles and permissions.
     */
    'role_permission' => [
        'permissions' => [
            [
                'module' => 'Dashboard',
                'permissions' => [
                    'dashboard:admin',
                    'dashboard:user',
                ]
            ],
            [
                'module' => 'Task Management',
                'permissions' => [
                    'task-management:create',
                    'task-management:read',
                    'task-management:update',
                    'task-management:delete',
                ]
            ],
            [
                'module' => 'Role Management',
                'permissions' => [
                    'role-management:create',
                    'role-management:read',
                    'role-management:update',
                    'role-management:delete',
                ]
            ],
            [
                'module' => 'Activity Logs',
                'permissions' => [
                    'activity-logs:read',
                ]
            ],
            [
                'module' => 'Session History',
                'permissions' => [
                    'session-history:read',
                ]
            ]
        ],
        'roles' => [
            [
                'name' => 'User',
                'permissions' => [
                    'dashboard:admin',
                    'task-management:create',
                    'task-management:read',
                    'task-management:update',
                    'task-management:delete',
                ]
            ]
        ]
    ]
];