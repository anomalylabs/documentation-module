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
        'projects'   => [
            'buttons' => [
                'new_project' => [
                    'data-toggle' => 'modal',
                    'data-target' => '#modal',
                    'href'        => 'admin/documentation/choose'
                ]
            ]
        ],
        'categories' => [
            'buttons' => [
                'new_category'
            ]
        ]
    ];

}
