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
            function ($index, $page) {

                /* @var PageInterface $page */
                return $page->isHome();
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
            function ($index, $page) use ($path) {

                /* @var PageInterface $page */
                return ltrim($page->getPath(), '/') == $path;
            }
        );
    }
}
