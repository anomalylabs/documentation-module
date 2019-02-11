<?php namespace Anomaly\DocumentationModule\Page\Contract;

use Anomaly\DocumentationModule\Page\PageCollection;
use Anomaly\DocumentationModule\Project\Contract\ProjectInterface;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Interface PageInterface
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
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
     * Check if data exists.
     *
     * @param $key
     * @return boolean
     */
    public function hasData($key);

    /**
     * Return data for a given key.
     *
     * @param $key
     * @param null $default
     * @return array
     */
    public function data($key, $default = null);

    /**
     * Get the data.
     *
     * @param null $key
     * @param null $default
     * @return array
     */
    public function getData($key = null, $default = null);

    /**
     * Get the reference.
     *
     * @return string
     */
    public function getReference();

    /**
     * Get the meta title.
     *
     * @return string
     */
    public function getMetaTitle();

    /**
     * Get the meta description.
     *
     * @return string
     */
    public function getMetaDescription();

    /**
     * Return if the page is
     * the home page or not.
     *
     * @return bool
     */
    public function isHome();

    /**
     * Get the related parent page.
     *
     * @return null|PageInterface
     */
    public function getParent();

    /**
     * Get the parent ID.
     *
     * @return int|null
     */
    public function getParentId();

    /**
     * Get the content.
     *
     * @return null|string
     */
    public function getContent();

    /**
     * Get the current flag.
     *
     * @return bool
     */
    public function isCurrent();

    /**
     * Set the current flag.
     *
     * @param $current
     * @return $this
     */
    public function setCurrent($current);

    /**
     * Get the active flag.
     *
     * @return bool
     */
    public function isActive();

    /**
     * Set the active flag.
     *
     * @param $active
     * @return $this
     */
    public function setActive($active);

    /**
     * Get the related project.
     *
     * @return ProjectInterface
     */
    public function getProject();

    /**
     * Get the related project ID.
     *
     * @return int
     */
    public function getProjectId();

    /**
     * Get the related project slug.
     *
     * @return string
     */
    public function getProjectSlug();

    /**
     * Get the related children pages.
     *
     * @return PageCollection
     */
    public function getChildren();

    /**
     * Return the children relationship.
     *
     * @return HasMany
     */
    public function children();

    /**
     * Get the related sibling pages.
     *
     * @return PageCollection
     */
    public function getSiblings();

    /**
     * Return the siblings relationship.
     *
     * @return HasMany
     */
    public function siblings();

}
