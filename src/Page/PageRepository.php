<?php namespace Anomaly\DocumentationModule\Page;

use Anomaly\DocumentationModule\Page\Contract\PageInterface;
use Anomaly\DocumentationModule\Page\Contract\PageRepositoryInterface;
use Anomaly\DocumentationModule\Project\Contract\ProjectInterface;
use Anomaly\Streams\Platform\Entry\EntryRepository;

class PageRepository extends EntryRepository implements PageRepositoryInterface
{

    /**
     * The entry model.
     *
     * @var PageModel
     */
    protected $model;

    /**
     * Create a new PageRepository instance.
     *
     * @param PageModel $model
     */
    public function __construct(PageModel $model)
    {
        $this->model = $model;
    }

    /**
     * Find a page by it's source information.
     *
     * @param ProjectInterface $project
     * @param                  $reference
     * @param                  $path
     * @return PageInterface|null
     */
    public function findByIdentifiers(ProjectInterface $project, $reference, $path)
    {
        return $this->model
            ->where('project_id', $project->getId())
            ->where('reference', $reference)
            ->where('path', $path)
            ->first();
    }

}
