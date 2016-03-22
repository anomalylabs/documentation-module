<?php namespace Anomaly\DocumentationModule\Project;

use Anomaly\DocumentationModule\Project\Contract\ProjectRepositoryInterface;
use Anomaly\Streams\Platform\Entry\EntryRepository;

/**
 * Class ProjectRepository
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\DocumentationModule\Project
 */
class ProjectRepository extends EntryRepository implements ProjectRepositoryInterface
{

    /**
     * The entry model.
     *
     * @var ProjectModel
     */
    protected $model;

    /**
     * Create a new ProjectRepository instance.
     *
     * @param ProjectModel $model
     */
    public function __construct(ProjectModel $model)
    {
        $this->model = $model;
    }
}
