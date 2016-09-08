<?php namespace Anomaly\DocumentationModule\Page;

use Anomaly\DocumentationModule\Command\AddDocumentationBreadcrumb;
use Anomaly\DocumentationModule\Page\Contract\PageInterface;
use Anomaly\DocumentationModule\Project\Command\AddProjectBreadcrumb;
use Anomaly\Streams\Platform\Ui\Breadcrumb\BreadcrumbCollection;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class PageBreadcrumb
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\DocumentationModule\Page
 */
class PageBreadcrumb
{

    use DispatchesJobs;

    /**
     * The breadcrumb collection.
     *
     * @var BreadcrumbCollection
     */
    protected $breadcrumbs;

    /**
     * Create a new PageBreadcrumb instance.
     *
     * @param BreadcrumbCollection $breadcrumbs
     */
    public function __construct(BreadcrumbCollection $breadcrumbs)
    {
        $this->breadcrumbs = $breadcrumbs;
    }

    /**
     * Make the page breadcrumbs.
     *
     * @param PageInterface $page
     */
    public function make(PageInterface $page)
    {
        $breadcrumbs = [
            $page->getTitle() => $page->getPath()
        ];

        $this->loadParent($page, $breadcrumbs);

        $this->dispatch(new AddDocumentationBreadcrumb());
        $this->dispatch(new AddProjectBreadcrumb($page->getProject()));

        foreach (array_reverse($breadcrumbs) as $key => $url) {
            $this->breadcrumbs->add($key, $url);
        }
    }

    /**
     * Load the parent breadcrumbs.
     *
     * @param PageInterface $page
     * @param array         $breadcrumbs
     */
    protected function loadParent(PageInterface $page, array &$breadcrumbs)
    {
        if ($parent = $page->getParent()) {

            $breadcrumbs[$parent->getTitle()] = $parent->getPath();

            $this->loadParent($parent, $breadcrumbs);
        }
    }
}