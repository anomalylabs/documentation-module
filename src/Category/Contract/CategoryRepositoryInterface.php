<?php namespace Anomaly\DocumentationModule\Category\Contract;

use Anomaly\Streams\Platform\Entry\Contract\EntryRepositoryInterface;

/**
 * Interface CategoryRepositoryInterface
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
interface CategoryRepositoryInterface extends EntryRepositoryInterface
{

    /**
     * Find a category by slug.
     *
     * @param $slug
     * @return CategoryInterface|null
     */
    public function findBySlug($slug);
}
