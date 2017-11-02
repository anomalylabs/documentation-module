<?php

use Anomaly\DocumentationModule\Category\CategoryModel;
use Anomaly\DocumentationModule\Page\PageModel;
use Anomaly\DocumentationModule\Project\ProjectModel;
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
        'reference'        => 'anomaly.field_type.text',
        'path'             => 'anomaly.field_type.text',
        'content'          => 'anomaly.field_type.markdown',
        'data'             => [
            'type'   => 'anomaly.field_type.textarea',
            'config' => [
                'storage' => 'json',
            ],
        ],
        'enabled'          => [
            'type'   => 'anomaly.field_type.boolean',
            'config' => [
                'default_value' => true,
            ],
        ],
        'documentation'    => [
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
        'project'          => [
            'type'   => 'anomaly.field_type.relationship',
            'config' => [
                'related' => ProjectModel::class,
            ],
        ],
        'parent'           => [
            'type'   => 'anomaly.field_type.relationship',
            'config' => [
                'related' => PageModel::class,
            ],
        ],
    ];

}
