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
     * Get the next page.
     *
     * @param PageInterface $page
     * @return null|PageInterface
     */
    public function next(PageInterface $page)
    {
        return $this->model
            ->where('project_id', $page->getProjectId())
            ->where('reference', $page->getReference())
            ->where('sort_order', $page->getSortOrder() + 1)
            ->first();
    }

    /**
     * Get the previous page.
     *
     * @param PageInterface $page
     * @return null|PageInterface
     */
    public function previous(PageInterface $page)
    {
        return $this->model
            ->where('project_id', $page->getProjectId())
            ->where('reference', $page->getReference())
            ->where('sort_order', $page->getSortOrder() - 1)
            ->first();
    }

    /**
     * Find a page by it's path.
     *
     * @param $path
     * @return null|PageInterface
     */
    public function findByPath($path)
    {
        return $this->model->where('path', $path)->first();
    }

    /**
     * Find a page by it's source information.
     *
     * @param ProjectInterface $project
     * @param                  $reference
     * @param                  $path
     * @return PageInterface|null
     */
    public function findByIdentifiers(ProjectInterface $project, $reference, $path = null)
    {
        $query = $this->model
            ->where('project_id', $project->getId())
            ->where('reference', $reference);

        if ($path) {
            $query = $query->where('path', $path);
        }

        return $query->first();
    }

}
