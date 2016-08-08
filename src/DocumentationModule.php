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
     * The module sections.
     *
     * @var array
     */
    protected $sections = [
        'projects' => [
            'buttons'  => [
                'new_project'
            ],
            'sections' => [
                'versions' => [
                    'data-toggle' => 'modal',
                    'data-target' => '#modal',
                    'permalink'   => 'admin/documentation/versions/{request.route.parameters.project}',
                    'href'        => 'admin/documentation/choose',

                    'buttons' => [
                        'new_version',
                    ]
                ],
            ]
        ],
        'pages'    => [
            'data-toggle' => 'modal',
            'data-target' => '#modal',
            'permalink'   => 'admin/documentation/pages/{request.route.parameters.version}',
            'href'        => 'admin/documentation/choose',

            'buttons' => [
                'new_page' => [
                    'data-toggle' => 'modal',
                    'data-target' => '#modal',
                    'href'        => 'admin/documentation/pages/{request.route.parameters.version}/choose'
                ]
            ]
        ],
        'types'    => [
            'buttons' => [
                'new_type'
            ]
        ],
        'fields'   => [
            'buttons' => [
                'new_field' => [
                    'data-toggle' => 'modal',
                    'data-target' => '#modal',
                    'href'        => 'admin/documentation/fields/choose',
                ]
            ]
        ]
    ];
}
