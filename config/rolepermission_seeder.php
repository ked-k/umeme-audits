<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_users' => env('LARATRUST_CREATE_USERS', false),

    /**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => env('LARATRUST_TRUNCATE_TABLES', false),

    /**
     * Control if all the laratrust pivot tables should be truncated before running the seeder.
     */
    'truncate_pivot_tables' => env('LARATRUST_TRUNCATE_PIVOT_TABLES', false),

    /**
     * Control if default roles other than Admin should be created after seeding.
     */
    'seed_default_roles' => env('LARATRUST_SEED_DEFAULT_ROLES', false),

    'roles_structure' => [
        'Admin' => [
            'User Management' => [
                'access_user_management_module',

                'create_user',
                'view_user',
                'update_user',
                'delete_user',

                'create_role',
                'view_role',
                'update_role',
                'delete_role',
                'view_permission',
                'update_permission',
                'assign_role',
                'assign_permission',

                'view_login_activity',
                'view_activity_trail',
                'generate_user_management_reports',
            ],

        ],
    ],

    //Configure Default Roles and Permissions
    'default_roles' => [
        //TRAINING MANAGEMENT
        // 'Training Coordinator' => [
        //     'access_training_module',
        //     'access_workshops_centre',
        //     'access_technical_support_centre',
        //     'add_training_partner',
        //     'view_training',
        //     'view_trainer',
        //     'view_nominee',
        // ],
    ],

];
