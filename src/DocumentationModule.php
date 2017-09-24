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
            'buttons' => [
                'new_project' => [
                    'data-toggle' => 'modal',
                    'data-target' => '#modal',
                    'href'        => 'admin/documentation/choose',
                ],
            ],
        ],
        'categories' => [
            'buttons' => [
                'new_category',
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
