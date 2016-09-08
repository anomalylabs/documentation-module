<?php

return [
    'name'             => [
        'name'         => 'Name',
        'instructions' => [
            'projects' => 'What is the name of this project?',
        ],
    ],
    'slug'             => [
        'name'         => 'Slug',
        'instructions' => [
            'projects' => 'The slug is used in building the project\'s URL.',
            'pages'    => 'The slug is used in building the page\'s URL.',
        ],
    ],
    'title'            => [
        'name'         => 'Title',
        'instructions' => 'Specify a short descriptive name for this page.',
    ],
    'description'      => [
        'name'         => 'Description',
        'instructions' => [
            'projects' => 'Briefly describe this project.',
        ],
    ],
    'layout'           => [
        'name' => 'Layout',
    ],
    'allowed_roles'    => [
        'name'         => 'Allowed Roles',
        'instructions' => 'Specify which user roles can access this project.',
        'warning'      => 'If no roles are specified then everyone can access this project.',
    ],
    'enabled'          => [
        'name'         => 'Enabled',
        'label'        => [
            'projects' => [
                'projects' => 'Is this project enabled?',
                'pages'    => 'Is this page enabled?',
            ],
        ],
        'instructions' => 'If disabled, you can still access a secure preview link in the control panel.',
        'warning'      => [
            'projects' => 'This project must be enabled before it can be viewed <strong>publicly</strong>.',
            'pages'    => 'This page must be enabled before it can be viewed <strong>publicly</strong>.',
        ],
    ],
    'home'             => [
        'name'         => 'Home Page',
        'label'        => 'Is this the home page?',
        'instructions' => 'The home page is the default landing page for your project documentation.',
    ],
    'meta_title'       => [
        'name'         => 'Meta Title',
        'instructions' => 'Specify the SEO title.',
        'warning'      => 'The page title will be used by default.',
    ],
    'meta_description' => [
        'name'         => 'Meta Description',
        'instructions' => 'Specify the SEO description.',
    ],
    'meta_keywords'    => [
        'name'         => 'Meta Keywords',
        'instructions' => 'Specify the SEO keywords.',
    ],
];
