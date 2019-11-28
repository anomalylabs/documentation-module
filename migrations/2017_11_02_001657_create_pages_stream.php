<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

/**
 * Class CreatePagesStream
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class CreatePagesStream extends Migration
{

    /**
     * The stream definition.
     *
     * @var array
     */
    protected $stream = [
        'slug'         => 'pages',
        'title_column' => 'title',
        'translatable' => true,
        'searchable'   => true,
        'sortable'     => true,
    ];

    /**
     * The stream assignments.
     *
     * @var array
     */
    protected $assignments = [
        'title'            => [
            'translatable' => true,
            'required'     => true,
        ],
        'path'             => [
            'required' => true,
        ],
        'project'          => [
            'required' => true,
        ],
        'reference'        => [
            'required' => true,
        ],
        'content'          => [
            'translatable' => true,
        ],
        'parent',
        'data'             => [
            'translatable' => true,
        ],
        'meta_title'       => [
            'translatable' => true,
        ],
        'meta_description' => [
            'translatable' => true,
        ],
    ];
}
