<?php

return [
    'name'             => [
        'name'         => 'Name',
        'instructions' => [
            'projects'   => 'What is the name of this project?',
            'versions'   => 'What is the version name?',
            'types'      => 'Specify a short descriptive name for this section type.',
            'categories' => 'Specify a short descriptive name for this category.',
        ],
        'placeholder'  => [
            'versions' => 'v3.1',
        ],
    ],
    'slug'             => [
        'name'         => 'Slug',
        'instructions' => [
            'projects'   => 'The slug is used in building the project\'s URL.',
            'sections'   => 'The slug is used in building the section\'s URL.',
            'categories' => 'The slug is used in building the category\'s URL.',
            'types'      => 'The slug is used in making the database table for sections of this type.',
        ],
    ],
    'title'            => [
        'name'         => 'Title',
        'instructions' => 'Specify a short descriptive name for this section.',
    ],
    'description'      => [
        'name'         => 'Description',
        'instructions' => [
            'projects'   => 'Briefly describe this project.',
            'categories' => 'Briefly describe this category.',
            'types'      => 'Briefly describe this section type.',
        ],
    ],
    'layout'           => [
        'name'         => 'Layout',
        'instructions' => 'The layout is used for displaying the section\'s content.',
    ],
    'enabled'          => [
        'name'         => 'Enabled',
        'label'        => [
            'projects' => [
                'projects' => 'Is this project enabled?',
                'sections' => 'Is this section enabled?',
            ],
        ],
        'instructions' => 'If disabled, you can still access sections via a secure preview link.',
        'warning'      => [
            'projects' => 'This project must be enabled before it can be viewed <strong>publicly</strong>.',
            'versions' => 'This version must be enabled before it can be viewed <strong>publicly</strong>.',
            'sections' => 'This section must be enabled before it can be viewed <strong>publicly</strong>.',
        ],
    ],
    'home'             => [
        'name'         => 'Home Section',
        'label'        => 'Is this the home section?',
        'instructions' => 'The home section is the default landing section for your project documentation.',
    ],
    'meta_title'       => [
        'name'         => 'Meta Title',
        'instructions' => 'Specify the SEO title.',
        'warning'      => 'The section title will be used by default.',
    ],
    'meta_description' => [
        'name'         => 'Meta Description',
        'instructions' => 'Specify the SEO description.',
    ],
    'meta_keywords'    => [
        'name'         => 'Meta Keywords',
        'instructions' => 'Specify the SEO keywords.',
    ],
    'category'         => [
        'name'         => 'Category',
        'instructions' => 'Specify the category to place this documentation in.',
    ],
];
