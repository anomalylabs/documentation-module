<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

/**
 * Class AnomalyModuleDocumentationCreateSectionsStream
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class AnomalyModuleDocumentationCreateSectionsStream extends Migration
{

    /**
     * The stream definition.
     *
     * @var array
     */
    protected $stream = [
        'slug'         => 'sections',
        'title_column' => 'title',
        'translatable' => true,
        'searchable'   => true,
        'trashable'    => true,
        'sortable'     => true,
    ];

    /**
     * The stream assignments.
     *
     * @var array
     */
    protected $assignments = [
        'str_id'           => [
            'required' => true,
        ],
        'title'            => [
            'translatable' => true,
            'required'     => true,
        ],
        'slug'             => [
            'required' => true,
            'config'   => [
                'slugify' => 'title',
                'type'    => '-',
            ],
        ],
        'path'             => [
            'required' => true,
        ],
        'type'             => [
            'required' => true,
        ],
        'entry'            => [
            'required' => true,
        ],
        'parent',
        'enabled',
        'home',
        'meta_title'       => [
            'translatable' => true,
        ],
        'meta_description' => [
            'translatable' => true,
        ],
        'meta_keywords'    => [
            'translatable' => true,
        ],
        'version'          => [
            'required' => true,
        ],
    ];
}
