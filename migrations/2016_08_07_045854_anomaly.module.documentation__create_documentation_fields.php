<?php

use Anomaly\DocumentationModule\Category\CategoryModel;
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
        'str_id'           => 'anomaly.field_type.text',
        'name'             => 'anomaly.field_type.text',
        'title'            => 'anomaly.field_type.text',
        'slug'             => 'anomaly.field_type.slug',
        'description'      => 'anomaly.field_type.textarea',
        'meta_title'       => 'anomaly.field_type.text',
        'meta_description' => 'anomaly.field_type.textarea',
        'tags'             => 'anomaly.field_type.tags',
        'versions'         => 'anomaly.field_type.textarea',
        'enabled'          => [
            'type'   => 'anomaly.field_type.boolean',
            'config' => [
                'default_value' => true,
            ],
        ],
        'extension'        => [
            'type'   => 'anomaly.field_type.addon',
            'config' => [
                'search' => 'anomaly.module.documentation::documentation.*',
            ],
        ],
        'category'         => [
            'type'   => 'anomaly.field_type.relationship',
            'config' => [
                'related' => CategoryModel::class,
            ],
        ],
    ];

}
