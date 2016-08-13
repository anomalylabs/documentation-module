<?php namespace Anomaly\DocumentationModule\Page;

use Anomaly\DocumentationModule\Page\Contract\PageInterface;
use Anomaly\DocumentationModule\Page\Contract\PageRepositoryInterface;
use Anomaly\DocumentationModule\Version\Contract\VersionInterface;
use Anomaly\Streams\Platform\Entry\EntryRepository;

/**
 * Class PageRepository
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\DocumentationModule\Page
 */
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
     * Find a page by it's version and path.
     *
     * @param VersionInterface $version
     * @param                  $path
     * @return PageInterface|null
     */
    public function findByVersionAndPath(VersionInterface $version, $path)
    {
        return $this->model
            ->where('version_id', $version->getId())
            ->where('path', '/' . ltrim($path, '/'))
            ->first();
    }
}
