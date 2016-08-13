<?php namespace Anomaly\DocumentationModule\Page\Contract;

use Anomaly\DocumentationModule\Version\Contract\VersionInterface;
use Anomaly\Streams\Platform\Entry\Contract\EntryRepositoryInterface;

/**
 * Interface PageRepositoryInterface
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\DocumentationModule\Page\Contract
 */
interface PageRepositoryInterface extends EntryRepositoryInterface
{

    /**
     * Find a page by it's version and path.
     *
     * @param VersionInterface $version
     * @param                  $path
     * @return PageInterface|null
     */
    public function findByVersionAndPath(VersionInterface $version, $path);
}
