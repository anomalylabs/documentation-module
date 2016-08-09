<?php namespace Anomaly\DocumentationModule\Page;

use Anomaly\DocumentationModule\Page\Contract\PageInterface;
use Anomaly\DocumentationModule\Version\Contract\VersionInterface;
use Anomaly\DocumentationModule\Version\VersionCollection;
use Anomaly\DocumentationModule\Version\VersionModel;
use Anomaly\Streams\Platform\Model\Documentation\DocumentationPagesEntryModel;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class PageModel
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\DocumentationModule\Page
 */
class PageModel extends DocumentationPagesEntryModel implements PageInterface
{

    /**
     * Get the path.
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Get the slug.
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Get the string ID.
     *
     * @return string
     */
    public function getStrId()
    {
        return $this->str_id;
    }

    /**
     * Get the home flag.
     *
     * @return bool
     */
    public function isHome()
    {
        return $this->home;
    }

    /**
     * Get the enabled flag.
     *
     * @return bool
     */
    public function isEnabled()
    {
        return $this->enabled;
    }

    /**
     * Get the parent.
     *
     * @return PageInterface|null
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Get the version.
     *
     * @return VersionInterface|null
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Get the related children pages.
     *
     * @return PageCollection
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * Return the children pages relationship.
     *
     * @return HasMany
     */
    public function children()
    {
        return $this->hasMany('Anomaly\DocumentationModule\Page\PageModel', 'parent_id', 'id')
            ->orderBy('sort_order', 'ASC');
    }
}
