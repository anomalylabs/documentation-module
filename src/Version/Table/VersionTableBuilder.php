<?php namespace Anomaly\DocumentationModule\Version\Table;

use Anomaly\DocumentationModule\Project\Contract\ProjectInterface;
use Anomaly\Streams\Platform\Ui\Table\TableBuilder;
use Illuminate\Database\Eloquent\Builder;

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
     * The project instance.
     *
     * @var null|ProjectInterface
     */
    protected $project = null;

    /**
     * The table columns.
     *
     * @var array
     */
    protected $columns = [
        'name',
        'entry.enabled.label',
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

    /**
     * Fired just before querying.
     *
     * @param Builder $query
     */
    public function onQuerying(Builder $query)
    {
        if ($project = $this->getProject()) {
            $query->where('project_id', $project->getId());
        }
    }

    /**
     * Get the project.
     *
     * @return ProjectInterface|null
     */
    public function getProject()
    {
        return $this->project;
    }

    /**
     * Set the project.
     *
     * @param ProjectInterface $project
     * @return $this
     */
    public function setProject(ProjectInterface $project)
    {
        $this->project = $project;

        return $this;
    }
}
