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
    'versions'      => [
        'name'         => 'Versions',
        'instructions' => 'Enter versions below in a <strong>version: reference</strong> format. Enter each option on a new line.',
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
