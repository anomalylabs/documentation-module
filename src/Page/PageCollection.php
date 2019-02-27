<?php namespace Anomaly\DocumentationModule\Page;

use Anomaly\DocumentationModule\Page\Contract\PageInterface;
use Anomaly\Streams\Platform\Entry\EntryCollection;

/**
 * Class PageCollection
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class PageCollection extends EntryCollection
{

    /**
     * Alias for $this->top()
     *
     * @return PageCollection
     */
    public function root()
    {
        return $this->top();
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
     * Return the parent of the child.
     *
     * @param $child
     * @return PageInterface
     */
    public function parent(PageInterface $child)
    {
        /* @var PageInterface $parent */
        return $this->first(
            function ($item) use ($child) {

                /* @var PageInterface $item */
                return $child->getParentId() == $item->getId();
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
        /* @var PageInterface $item */
        foreach ($this->items as $item) {

            if ($item->isCurrent()) {
                return $item;
            }
        }

        return null;
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

    /**
     * Return only visible items.
     *
     * @return PageCollection
     */
    public function visible()
    {
        return $this->filter(
            function ($item) {

                /* @var PageInterface $item */
                return $item->data('hidden', false) == false;
            }
        );
    }
}
