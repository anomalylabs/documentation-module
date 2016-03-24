<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

/**
 * Class AnomalyModuleDocumentationCreateDocumentationFields
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class AnomalyModuleDocumentationCreateDocumentationFields extends Migration
{

    /**
     * The addon fields.
     *
     * @var array
     */
    protected $fields = [
        'name'          => 'anomaly.field_type.text',
        'slug'          => [
            'type'   => 'anomaly.field_type.slug',
            'config' => [
                'slugify' => 'name',
                'type'    => '-'
            ]
        ],
        'description'   => 'anomaly.field_type.textarea',
        'versions'      => 'anomaly.field_type.textarea',
        'documentation' => [
            'type'   => 'anomaly.field_type.addon',
            'config' => [
                'type'   => 'extensions',
                'search' => 'anomaly.module.documentation::documentation.*'
            ]
        ]
    ];
}
