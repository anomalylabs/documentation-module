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
