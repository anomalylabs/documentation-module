<?php namespace Anomaly\DocumentationModule\Page;

use Anomaly\DocumentationModule\Page\Contract\PageInterface;
use Anomaly\Streams\Platform\Entry\EntryCollection;

/**
 * Class PageCollection
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\DocumentationModule\Page
 */
class PageCollection extends EntryCollection
{

    /**
     * Return the home page.
     *
     * @return PageInterface|null
     */
    public function home()
    {
        return $this->first(
            function ($page) {

                /* @var PageInterface $page */
                return $page->isHome();
            }
        );
    }

    /**
     * Return only top level pages.
     *
     * @return PageCollection
     */
    public function top()
    {
        return $this->filter(
            function ($item) {

                /* @var PageInterface $item */
                return !$item->getParentId();
            }
        );
    }
    
    /**
     * Find a page by it's path.
     *
     * @param $path
     * @return PageInterface|null
     */
    public function findByPath($path)
    {
        return $this->first(
            function ($page) use ($path) {

                /* @var PageInterface $page */
                return ltrim($page->getPath(), '/') == $path;
            }
        );
    }

    /**
     * Return only enabled pages.
     *
     * @return PageCollection
     */
    public function enabled()
    {
        return $this->filter(
            function ($page) {

                /* @var PageInterface $page */
                return $page->isEnabled();
            }
        );
    }

    /**
     * Return the current page.
     *
     * @return PageInterface|null
     */
    public function current()
    {
        return $this->first(
            function ($page) {

                /* @var PageInterface $page */
                return $page->isCurrent();
            }
        );
    }

    /**
     * Return only children of the provided item.
     *
     * @param $parent
     * @return PageCollection
     */
    public function children($parent)
    {
        /* @var PageInterface $parent */
        return $this->filter(
            function ($item) use ($parent) {

                /* @var PageInterface $item */
                return $item->getParentId() == $parent->getId();
            }
        );
    }

    /**
     * Return only active pages.
     *
     * @param  bool $active
     * @return PageCollection
     */
    public function active($active = true)
    {
        return $this->filter(
            function ($item) use ($active) {

                /* @var PageInterface $item */
                return $item->isActive() == $active;
            }
        );
    }
}
