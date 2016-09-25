<?php namespace Anomaly\DocumentationModule;

use Anomaly\Streams\Platform\Addon\Module\Module;

/**
 * Class DocumentationModule
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\DocumentationModule
 */
class DocumentationModule extends Module
{

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
        'projects' => [
            'buttons'  => [
                'new_project',
            ],
            'sections' => [
                'versions' => [
                    'data-toggle' => 'modal',
                    'data-target' => '#modal',
                    'permalink'   => 'admin/documentation/versions/{request.route.parameters.project}',
                    'href'        => 'admin/documentation/choose',

                    'buttons' => [
                        'new_version',
                    ],
                ],
            ],
        ],
        'sections'    => [
            'data-toggle' => 'modal',
            'data-target' => '#modal',
            'permalink'   => 'admin/documentation/sections/{request.route.parameters.version}',
            'href'        => 'admin/documentation/choose',

            'buttons' => [
                'new_section' => [
                    'data-toggle' => 'modal',
                    'data-target' => '#modal',
                    'href'        => 'admin/documentation/sections/{request.route.parameters.version}/choose',
                ],
            ],
        ],
        'types'    => [
            'buttons'  => [
                'new_type',
            ],
            'sections' => [
                'assignments' => [
                    'href'    => 'admin/documentation/types/assignments/{request.route.parameters.type}',
                    'buttons' => [
                        'assign_fields' => [
                            'data-toggle' => 'modal',
                            'data-target' => '#modal',
                            'href'        => 'admin/documentation/types/assignments/{request.route.parameters.type}/choose',
                        ],
                    ],
                ],
            ],
        ],
        'fields'   => [
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
