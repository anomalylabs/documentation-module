<?php namespace Anomaly\DocumentationModule\Project\Table;

use Anomaly\Streams\Platform\Ui\Table\TableBuilder;

/**
 * Class ProjectTableBuilder
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\DocumentationModule\Project\Table
 */
class ProjectTableBuilder extends TableBuilder
{

    /**
     * The table columns.
     *
     * @var array
     */
    protected $columns = [
        'name',
        'description',
    ];

    /**
     * The table buttons.
     *
     * @var array|string
     */
    protected $buttons = [
        'edit',
        'versions' => [
            'icon' => 'code-fork',
            'type' => 'primary',
        ],
        'view'     => [
            'target' => '_blank'
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
