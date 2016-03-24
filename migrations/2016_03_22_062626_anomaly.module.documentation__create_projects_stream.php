<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

/**
 * Class AnomalyModuleDocumentationCreateProjectsStream
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class AnomalyModuleDocumentationCreateProjectsStream extends Migration
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
        'trashable'    => true
    ];

    /**
     * The stream assignments.
     *
     * @var array
     */
    protected $assignments = [
        'name'        => [
            'required'     => true,
            'translatable' => true
        ],
        'slug'        => [
            'required' => true,
            'unique'   => true
        ],
        'description' => [
            'translatable' => true
        ],
        'source'      => [
            'required' => true
        ],
    ];

}
