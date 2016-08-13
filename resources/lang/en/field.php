<?php

return [
    'name'          => [
        'name'         => 'Name',
        'instructions' => [
            'projects' => 'What is the name of this project?',
        ],
    ],
    'slug'          => [
        'name'         => 'Slug',
        'instructions' => [
            'projects' => 'The slug is used in the project\'s URL.',
        ],
    ],
    'title'         => [
        'name' => 'Title',
    ],
    'description'   => [
        'name'         => 'Description',
        'instructions' => [
            'projects' => 'Briefly describe this project.',
        ]
    ],
    'layout'        => [
        'name' => 'Layout',
    ],
    'theme_layout'  => [
        'name' => 'Theme Layout',
    ],
    'allowed_roles' => [
        'name'         => 'Allowed Roles',
        'instructions' => 'Specify which user roles can access this project.',
        'warning'      => 'If no roles are specified then everyone can access this project.'
    ],
    'enabled'       => [
        'name'         => 'Enabled',
        'label'        => [
            'projects' => [
                'projects' => 'Is this project enabled?',
                'pages'    => 'Is this page enabled?',
            ],
        ],
        'instructions' => [
            'projects' => 'If disabled, you can still access a secure preview link in the control panel.'
        ],
        'warning'      => [
            'projects' => 'This project must be enabled before it can be viewed <strong>publicly</strong>.'
        ]
    ],
];
