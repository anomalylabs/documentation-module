<?php namespace Anomaly\DocumentationModule\Version;

use Anomaly\DocumentationModule\Version\Contract\VersionInterface;
use Anomaly\Streams\Platform\Entry\EntryCollection;

class VersionCollection extends EntryCollection
{

    /**
     * Return only enabled versions.
     *
     * @return VersionCollection
     */
    public function enabled()
    {
        return $this->filter(function($version) {

            /* @var VersionInterface $version */
            return $version->isEnabled();
        });
    }
}
