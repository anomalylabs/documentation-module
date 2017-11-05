<?php

return [
    'name'             => [
        'name'         => 'Name',
        'instructions' => [
            'projects'   => 'What is the name of this project?',
            'categories' => 'Specify a short descriptive name for this category.',
        ],
    ],
    'slug'             => [
        'name'         => 'Slug',
        'instructions' => [
            'projects'   => 'The slug is used in building the project\'s URL.',
            'categories' => 'The slug is used in building the category\'s URL.',
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
        ],
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
        'warning'      => 'This project must be enabled before it can be viewed <strong>publicly</strong>.',
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
    'category'         => [
        'name'         => 'Category',
        'instructions' => 'Specify the category to place this documentation in.',
    ],
    'tags'             => [
        'name'         => 'Tags',
        'instructions' => 'Specify any organizational tags to help group your project with others',
    ],
    'versions'         => [
        'name'         => 'Versions',
        'instructions' => 'Enter versions below in a <strong>key: Value</strong> or <strong>Value</strong> only format. Enter each option on a new line.',
        'warning'      => 'The first version will be used as your default/latest version.',
    ],
];
