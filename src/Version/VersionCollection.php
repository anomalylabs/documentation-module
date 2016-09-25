<?php namespace Anomaly\DocumentationModule\Version;

use Anomaly\DocumentationModule\Version\Contract\VersionInterface;
use Anomaly\Streams\Platform\Entry\EntryCollection;

/**
 * Class VersionCollection
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class VersionCollection extends EntryCollection
{

    /**
     * Return only enabled versions.
     *
     * @return VersionCollection
     */
    public function enabled()
    {
        return $this->filter(
            function ($version) {

                /* @var VersionInterface $version */
                return $version->isEnabled();
            }
        );
    }

    /**
     * Find a version by name.
     *
     * @param $name
     * @return VersionInterface|null
     */
    public function findByName($name)
    {
        return $this->first(
            function ($version) use ($name) {

                /* @var VersionInterface $version */
                return $version->getName() == $name;
            }
        );
    }
}
