<?php namespace Anomaly\DocumentationModule\Page\Contract;

use Anomaly\DocumentationModule\Page\PageCollection;
use Anomaly\DocumentationModule\Version\Contract\VersionInterface;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Interface PageInterface
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\DocumentationModule\Page\Contract
 */
interface PageInterface extends EntryInterface
{

    /**
     * Get the path.
     *
     * @return string
     */
    public function getPath();

    /**
     * Get the slug.
     *
     * @return string
     */
    public function getSlug();

    /**
     * Get the string ID.
     *
     * @return string
     */
    public function getStrId();

    /**
     * Get the home flag.
     *
     * @return bool
     */
    public function isHome();

    /**
     * Get the enabled flag.
     *
     * @return bool
     */
    public function isEnabled();

    /**
     * Get the parent.
     *
     * @return PageInterface|null
     */
    public function getParent();

    /**
     * Return the parent relation.
     *
     * @return BelongsTo
     */
    public function parent();

    /**
     * Get the version.
     *
     * @return VersionInterface|null
     */
    public function getVersion();

    /**
     * Return the version relation.
     *
     * @return BelongsTo
     */
    public function version();

    /**
     * Get the related children pages.
     *
     * @return PageCollection
     */
    public function getChildren();

    /**
     * Return the children pages relationship.
     *
     * @return HasMany
     */
    public function children();
}
