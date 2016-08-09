<?php namespace Anomaly\DocumentationModule\Version\Contract;

use Anomaly\Streams\Platform\Entry\Contract\EntryRepositoryInterface;

/**
 * Interface VersionRepositoryInterface
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\DocumentationModule\Version\Contract
 */
interface VersionRepositoryInterface extends EntryRepositoryInterface
{

    /**
     * Find a version by it's slug.
     *
     * @param $slug
     * @return VersionInterface|null
     */
    public function findBySlug($slug);
}
