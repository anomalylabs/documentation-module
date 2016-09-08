<?php

return [
    'name'             => [
        'name'         => 'Name',
        'instructions' => [
            'projects' => 'What is the name of this project?',
            'versions' => 'What is the version name?',
            'types'    => 'Specify a short descriptive name for this page type.',
        ],
        'placeholder'  => [
            'versions' => 'v3.1',
        ],
    ],
    'slug'             => [
        'name'         => 'Slug',
        'instructions' => [
            'projects' => 'The slug is used in building the project\'s URL.',
            'pages'    => 'The slug is used in building the page\'s URL.',
            'types'    => 'The slug is used in making the database table for pages of this type.',
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
            'types'    => 'Briefly describe this page type.',
        ],
    ],
    'layout'           => [
        'name'         => 'Layout',
        'instructions' => 'The layout is used for displaying the page\'s content.',
    ],
    'enabled'          => [
        'name'         => 'Enabled',
        'label'        => [
            'projects' => [
                'projects' => 'Is this project enabled?',
                'pages'    => 'Is this page enabled?',
            ],
        ],
        'instructions' => 'If disabled, you can still access pages via a secure preview link.',
        'warning'      => [
            'projects' => 'This project must be enabled before it can be viewed <strong>publicly</strong>.',
            'versions' => 'This version must be enabled before it can be viewed <strong>publicly</strong>.',
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
