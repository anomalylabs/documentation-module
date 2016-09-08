<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

/**
 * Class AnomalyModuleDocumentationCreateTypesStream
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class AnomalyModuleDocumentationCreateTypesStream extends Migration
{

    /**
     * The stream definition.
     *
     * @var array
     */
    protected $stream = [
        'slug'         => 'types',
        'title_column' => 'name',
        'translatable' => true,
        'trashable'    => true,
        'sortable'     => true,
    ];

    /**
     * The stream assignments.
     *
     * @var array
     */
    protected $assignments = [
        'name'         => [
            'translatable' => true,
            'required'     => true,
            'unique'       => true,
            'config'       => [
                'max' => 50,
            ],
        ],
        'slug'         => [
            'required' => true,
            'unique'   => true,
            'config'   => [
                'slugify' => 'name',
                'type'    => '_',
                'max'     => 50,
            ],
        ],
        'description'  => [
            'translatable' => true,
        ],
        'layout'       => [
            'required' => true,
        ],
    ];
}
