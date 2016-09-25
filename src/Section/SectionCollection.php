<?php namespace Anomaly\DocumentationModule\Section;

use Anomaly\DocumentationModule\Section\Contract\SectionInterface;
use Anomaly\Streams\Platform\Entry\EntryCollection;

/**
 * Class SectionCollection
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class SectionCollection extends EntryCollection
{

    /**
     * Return the home section.
     *
     * @return SectionInterface|null
     */
    public function home()
    {
        return $this->first(
            function ($section) {

                /* @var SectionInterface $section */
                return $section->isHome();
            }
        );
    }

    /**
     * Return only top level sections.
     *
     * @return SectionCollection
     */
    public function top()
    {
        return $this->filter(
            function ($item) {

                /* @var SectionInterface $item */
                return !$item->getParentId();
            }
        );
    }

    /**
     * Find a section by it's path.
     *
     * @param $path
     * @return SectionInterface|null
     */
    public function findByPath($path)
    {
        return $this->first(
            function ($section) use ($path) {

                /* @var SectionInterface $section */
                return ltrim($section->getPath(), '/') == $path;
            }
        );
    }

    /**
     * Return only enabled sections.
     *
     * @return SectionCollection
     */
    public function enabled()
    {
        return $this->filter(
            function ($section) {

                /* @var SectionInterface $section */
                return $section->isEnabled();
            }
        );
    }

    /**
     * Return the current section.
     *
     * @return SectionInterface|null
     */
    public function current()
    {
        return $this->first(
            function ($section) {

                /* @var SectionInterface $section */
                return $section->isCurrent();
            }
        );
    }

    /**
     * Return only children of the provided item.
     *
     * @param $parent
     * @return SectionCollection
     */
    public function children($parent)
    {
        /* @var SectionInterface $parent */
        return $this->filter(
            function ($item) use ($parent) {

                /* @var SectionInterface $item */
                return $item->getParentId() == $parent->getId();
            }
        );
    }

    /**
     * Return only active sections.
     *
     * @param  bool $active
     * @return SectionCollection
     */
    public function active($active = true)
    {
        return $this->filter(
            function ($item) use ($active) {

                /* @var SectionInterface $item */
                return $item->isActive() == $active;
            }
        );
    }
}
