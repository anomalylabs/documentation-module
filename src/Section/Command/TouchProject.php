<?php namespace Anomaly\DocumentationModule\Section\Command;

use Anomaly\DocumentationModule\Project\Contract\ProjectInterface;
use Anomaly\DocumentationModule\Project\Contract\ProjectRepositoryInterface;
use Anomaly\DocumentationModule\Section\Contract\SectionInterface;
use Anomaly\Streams\Platform\Model\EloquentModel;


/**
 * Class TouchProject
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\DocumentationModule\Section\Command
 */
class TouchProject
{

    /**
     * The section instance.
     *
     * @var SectionInterface
     */
    protected $section;

    /**
     * Create a new TouchProject instance.
     *
     * @param SectionInterface $section
     */
    public function __construct(SectionInterface $section)
    {
        $this->section = $section;
    }

    /**
     * Handle the command.
     *
     * @param ProjectRepositoryInterface $projects
     */
    public function handle(ProjectRepositoryInterface $projects)
    {
        /* @var ProjectInterface|EloquentModel $project */
        $project = $this->section->getProject();

        $projects->save($project);
    }
}
