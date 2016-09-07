<?php namespace Anomaly\DocumentationModule\Project\Contract;

use Anomaly\DocumentationModule\Page\PageCollection;
use Anomaly\DocumentationModule\Version\Contract\VersionInterface;
use Anomaly\DocumentationModule\Version\VersionCollection;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Interface ProjectInterface
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\DocumentationModule\Project\Contract
 */
interface ProjectInterface extends EntryInterface
{

    /**
     * Get the slug.
     *
     * @return string
     */
    public function getSlug();

    /**
     * Get the enabled flag.
     *
     * @return bool
     */
    public function isEnabled();

    /**
     * Get the related pages.
     *
     * @return PageCollection
     */
    public function getPages();

    /**
     * Return the pages relation.
     *
     * @return HasMany
     */
    public function pages();

    /**
     * Get the related versions.
     *
     * @return VersionCollection
     */
    public function getVersions();

    /**
     * Get the related version by name.
     *
     * @param $name
     * @return VersionInterface|null
     */
    public function getVersion($name);

    /**
     * Get the latest version.
     *
     * @return VersionInterface|null
     */
    public function getLatestVersion();

    /**
     * Return the versions relation.
     *
     * @return HasMany
     */
    public function versions();
}
