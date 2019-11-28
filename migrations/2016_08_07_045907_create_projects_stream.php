<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

/**
 * Class CreateProjectsStream
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class CreateProjectsStream extends Migration
{

    /**
     * The stream definition.
     *
     * @var array
     */
    protected $stream = [
        'slug'         => 'projects',
        'title_column' => 'name',
        'translatable' => true,
        'searchable'   => true,
        'trashable'    => true,
    ];

    /**
     * The stream assignments.
     *
     * @var array
     */
    protected $assignments = [
        'str_id'        => [
            'required' => true,
            'unique'   => true,
        ],
        'name'          => [
            'translatable' => true,
            'required'     => true,
        ],
        'slug'          => [
            'required' => true,
            'unique'   => true,
        ],
        'documentation' => [
            'required' => true,
        ],
        'versions'      => [
            'required' => true,
        ],
        'description'   => [
            'translatable' => true,
        ],
        'enabled',
        'category',
        'tags',
        'meta_title',
        'meta_description',
    ];
}
