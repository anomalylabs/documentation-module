<?php namespace Anomaly\DocumentationModule\Section\Contract;

use Anomaly\DocumentationModule\Version\Contract\VersionInterface;
use Anomaly\Streams\Platform\Entry\Contract\EntryRepositoryInterface;

/**
 * Interface SectionRepositoryInterface
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\DocumentationModule\Section\Contract
 */
interface SectionRepositoryInterface extends EntryRepositoryInterface
{

    /**
     * Find a section by it's version and path.
     *
     * @param VersionInterface $version
     * @param                  $path
     * @return SectionInterface|null
     */
    public function findByVersionAndPath(VersionInterface $version, $path);
}
