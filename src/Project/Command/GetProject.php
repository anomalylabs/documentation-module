<?php namespace Anomaly\DocumentationModule\Project\Command;

use Anomaly\DocumentationModule\Project\Contract\ProjectInterface;
use Anomaly\DocumentationModule\Project\Contract\ProjectRepositoryInterface;
use Anomaly\DocumentationModule\Project\ProjectPresenter;
use Anomaly\Streams\Platform\Model\EloquentModel;
use Anomaly\Streams\Platform\View\ViewTemplate;


/**
 * Class GetProject
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class GetProject
{

    /**
     * The identifier.
     *
     * @var mixed
     */
    protected $identifier;

    /**
     * Create a new GetProject instance.
     *
     * @param $identifier
     */
    public function __construct($identifier = null)
    {
        $this->identifier = $identifier;
    }

    /**
     * Handle the command.
     *
     * @param  ProjectRepositoryInterface $projects
     * @param  ViewTemplate            $template
     * @return ProjectInterface|EloquentModel|null
     */
    public function handle(ProjectRepositoryInterface $projects, ViewTemplate $template)
    {
        if (is_null($this->identifier)) {
            $this->identifier = $template->get('project');
        }

        if (is_numeric($this->identifier)) {
            return $projects->find($this->identifier);
        }

        if (is_string($this->identifier)) {
            return $projects->findBySlug($this->identifier);
        }

        if ($this->identifier instanceof ProjectInterface) {
            return $this->identifier;
        }

        if ($this->identifier instanceof ProjectPresenter) {
            return $this->identifier->getObject();
        }

        return null;
    }
}
