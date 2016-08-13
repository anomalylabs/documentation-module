<?php namespace Anomaly\DocumentationModule\Version\Table;

use Anomaly\Streams\Platform\Ui\Table\TableBuilder;

/**
 * Class VersionTableBuilder
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\DocumentationModule\Version\Table
 */
class VersionTableBuilder extends TableBuilder
{

    /**
     * The table columns.
     *
     * @var array
     */
    protected $columns = [
        'name',
        'entry.enabled.label'
    ];

    /**
     * The table buttons.
     *
     * @var array|string
     */
    protected $buttons = [
        'edit',
        'pages' => [
            'icon' => 'file',
            'type' => 'primary',
            'href' => 'admin/documentation/pages/{entry.id}',
        ]
    ];

    /**
     * The table actions.
     *
     * @var array|string
     */
    protected $actions = [
        'delete',
    ];
}
