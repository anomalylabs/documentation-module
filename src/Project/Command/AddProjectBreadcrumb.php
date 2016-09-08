<?php namespace Anomaly\DocumentationModule\Project\Command;

use Anomaly\DocumentationModule\Project\Contract\ProjectInterface;
use Anomaly\Streams\Platform\Ui\Breadcrumb\BreadcrumbCollection;


/**
 * Class AddProjectBreadcrumb
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\DocumentationModule\Project\Command
 */
class AddProjectBreadcrumb
{

    /**
     * The project interface.
     *
     * @var ProjectInterface
     */
    protected $project;

    /**
     * Create a new AddProjectBreadcrumb instance.
     *
     * @param ProjectInterface $project
     */
    public function __construct(ProjectInterface $project)
    {
        $this->project = $project;
    }

    /**
     * Handle the command.
     *
     * @param BreadcrumbCollection $breadcrumb
     */
    public function handle(BreadcrumbCollection $breadcrumb)
    {
        $breadcrumb->add($this->project->getTitle(), $this->project->route('view'));
    }
}
