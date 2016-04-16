<?php

return [
    'name'          => [
        'name'         => 'Name',
        'instructions' => 'Specify a short descriptive name for this project.'
    ],
    'slug'          => [
        'name'         => 'Slug',
        'instructions' => 'The slug is used in building the documentation\'s URL.'
    ],
    'description'   => [
        'name'         => 'Description',
        'instructions' => 'Briefly describe this project.',
    ],
    'category'      => [
        'name'         => 'Category',
        'instructions' => 'Specify the project category.',
    ],
    'versions'      => [
        'name'         => 'Versions',
        'instructions' => 'Enter versions below in a <strong>version: reference</strong> format. Enter each option on a new line.',
    ],
    'home'          => [
        'name'         => 'Home',
        'label'        => 'Home Page',
        'instructions' => 'Specify the home page of the documentation.',
        'warning'      => 'If not specified, the first page of the first section will be used.'
    ],
    'enabled'       => [
        'name'         => 'Enabled',
        'label'        => 'Is this project enabled?',
        'instructions' => 'If disabled, you can still access a secure preview link in the control panel.',
        'warning'      => 'This project must be enabled before it can be viewed <strong>publicly</strong>.'
    ],
    'documentation' => [
        'name' => 'Documentation'
    ],
    'status'        => [
        'name'   => 'Status',
        'option' => [
            'live'  => 'Live',
            'draft' => 'Draft'
        ]
    ]
];
