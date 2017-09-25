<?php namespace Anomaly\DocumentationModule\Documentation;

use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class DocumentationProcessor
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class DocumentationProcessor
{

    use DispatchesJobs;

    /**
     * Process the pages.
     *
     * @param array $pages
     * @return array
     */
    public function process(array $pages)
    {
        return $pages;
    }

    /**
     * @param array $structure
     * @param array $pages
     */
    public function sort(array $structure, array &$pages)
    {
        $pages = array_filter(array_merge(array_flip(array_keys($structure)), $pages));

        foreach ($pages as $name => &$page) {
            if ($order = array_get($structure, $name)) {
                $this->sort($order, $page);
            }
        }
    }
}
