<?php namespace Anomaly\DocumentationModule\Project\Command;

use Anomaly\DocumentationModule\Project\Contract\ProjectInterface;

/**
 * Class SetStrId
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class SetStrId
{

    /**
     * The project instance.
     *
     * @var ProjectInterface
     */
    protected $project;

    /**
     * Create a new SetStrId instance.
     *
     * @param ProjectInterface $project
     */
    public function __construct(ProjectInterface $project)
    {
        $this->project = $project;
    }

    /**
     * Handle the command.
     */
    public function handle()
    {
        if (!$this->project->getStrId()) {
            $this->project->str_id = str_random(24);
        }
    }
}
