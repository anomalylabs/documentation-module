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
        'name'         => [
            'type' => 'anomaly.field_type.text',
        ],
        'title'        => [
            'type' => 'anomaly.field_type.text',
        ],
        'slug'         => [
            'type' => 'anomaly.field_type.slug',
        ],
        'description'  => [
            'type' => 'anomaly.field_type.textarea',
        ],
        'enabled'      => [
            'type' => 'anomaly.field_type.boolean',
        ],
        'image'        => [
            'type' => 'anomaly.field_type.file',
        ],
        'parent'       => [
            'type'   => 'anomaly.field_type.relationship',
            'config' => [
                'related' => 'Anomaly\DocumentationModule\Page\PageModel'
            ]
        ],
        'project'      => [
            'type'   => 'anomaly.field_type.relationship',
            'config' => [
                'related' => 'Anomaly\DocumentationModule\Project\ProjectModel'
            ]
        ],
        'version'      => [
            'type'   => 'anomaly.field_type.relationship',
            'config' => [
                'related' => 'Anomaly\DocumentationModule\Version\VersionModel'
            ]
        ],
        'theme_layout' => [
            'type'   => 'anomaly.field_type.select',
            'config' => [
                'default_value' => 'theme::layouts/default.twig',
                'handler'       => 'layouts',
            ]
        ],
        'layout'       => [
            'type'   => 'anomaly.field_type.editor',
            'config' => [
                'default_value' => '<h1>{{ project.name }}</h1>',
                'mode'          => 'twig'
            ]
        ],
    ];

}
