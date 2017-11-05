<?php namespace Anomaly\DocumentationModule;

use Anomaly\Streams\Platform\Addon\Module\Module;

/**
 * /**
 * Class DocumentationModule
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class DocumentationModule extends Module
{

    /**
     * The addon icon.
     *
     * @var string
     */
    protected $icon = 'fa fa-book';

    /**
     * The addon plugins.
     *
     * @var array
     */
    protected $plugins = [
        DocumentationModulePlugin::class,
    ];

    /**
     * The module sections.
     *
     * @var array
     */
    protected $sections = [
        'projects'   => [
            'buttons'  => [
                'new_project' => [
                    'data-toggle' => 'modal',
                    'data-target' => '#modal',
                    'href'        => 'admin/documentation/choose',
                ],
            ],
            'sections' => [
                'project_assignments' => [
                    'hidden'  => false,
                    'href'    => 'admin/documentation/assignments/projects',
                    'title'   => 'anomaly.module.documentation::section.assignments.title',
                    'buttons' => [
                        'assign_fields' => [
                            'data-toggle' => 'modal',
                            'data-target' => '#modal',
                            'href'        => 'admin/documentation/assignments/projects/choose',
                        ],
                    ],
                ],
            ],
        ],
        'categories' => [
            'buttons'  => [
                'new_category',
            ],
            'sections' => [
                'category_assignments' => [
                    'href'    => 'admin/documentation/assignments/categories',
                    'title'   => 'anomaly.module.documentation::section.assignments.title',
                    'buttons' => [
                        'assign_fields' => [
                            'data-toggle' => 'modal',
                            'data-target' => '#modal',
                            'href'        => 'admin/documentation/assignments/categories/choose',
                        ],
                    ],
                ],
            ],
        ],
        'fields'     => [
            'buttons' => [
                'new_field' => [
                    'data-toggle' => 'modal',
                    'data-target' => '#modal',
                    'href'        => 'admin/documentation/fields/choose',
                ],
            ],
        ],
    ];
}
