<?php

return [
    'name' => 'Content',

     /*
     * Default prefix to the dashboard.
     */
    'route_prefix' => config('core.admin_uri') . 'content',

    'file_path'    =>  base_path('resources/content'),

    /*
     * Default permission user should have to access the dashboard.
     */
    'security' => [
        'protected'          => true,
        'middleware'         => ['web', 'access.routeNeedsPermission:manage-content'],
        'permission_name'    => 'manage-content',
    ],

    'permissions' => [
        'view' => [
            'name' => 'manage-content',
            'display_name' => 'Manage Content'
        ],
        'create' => [
            'name' => 'create-content',
            'display_name' => 'Create Content'
        ],
        'edit' => [
            'name' => 'edit-content',
            'display_name' => 'Edit Content'
        ],
        'delete' => [
            'name' => 'delete-content',
            'display_name' => 'Delete Content'
        ],

        'translation-create' => [
            'name' => 'create-translation-content',
            'display_name' => 'Create Content Translation'
        ],
        'translation-edit' => [
            'name' => 'edit-translation-content',
            'display_name' => 'Edit Content Translation'
        ],
        'translation-delete' => [
            'name' => 'delete-translation-content',
            'display_name' => 'Delete Content Translation'
        ],
    ],
    /*
     * Default url used to redirect user to front/admin of your the system.
     */
   'system_url' => config('core.redirect_url'),

      'default' => [
        'name'       => 'English',
        'short_name' => 'en',
    ],
];
