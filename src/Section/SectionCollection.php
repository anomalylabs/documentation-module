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
}
