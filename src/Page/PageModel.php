<?php namespace Anomaly\DocumentationModule\Page;

use Anomaly\DocumentationModule\Page\Contract\PageInterface;
use Anomaly\DocumentationModule\Project\Contract\ProjectInterface;
use Anomaly\Streams\Platform\Model\Documentation\DocumentationPagesEntryModel;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class PageModel
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class PageModel extends DocumentationPagesEntryModel implements PageInterface
{

    /**
     * Always eager load these.
     *
     * @var array
     */
    protected $with = [
        'translations',
        'project',
    ];

    /**
     * The cascaded relations.
     *
     * @var array
     */
    protected $cascades = [
        'children',
    ];

    /**
     * The active flag.
     *
     * @var bool
     */
    protected $active = false;

    /**
     * The current flag.
     *
     * @var bool
     */
    protected $current = false;

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
     * Check if data exists.
     *
     * @param $key
     * @return boolean
     */
    public function hasData($key)
    {
        return array_key_exists($key, $this->data);
    }

    /**
     * Get the data.
     *
     * @param null $key
     * @param null $default
     * @return array
     */
    public function getData($key = null, $default = null)
    {
        if ($key) {
            return array_get($this->data, $key, $default);
        }

        return $this->data;
    }

    /**
     * Get the reference.
     *
     * @return string
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * Get the meta title.
     *
     * @return string
     */
    public function getMetaTitle()
    {
        if (!$this->meta_title) {
            return $this->getTitle();
        }

        return $this->meta_title;
    }

    /**
     * Get the meta description.
     *
     * @return string
     */
    public function getMetaDescription()
    {
        return $this->meta_description;
    }

    /**
     * Return if the page is
     * the home page or not.
     *
     * @return bool
     */
    public function isHome()
    {
        return $this->sort_order === 0 && $this->getParentId() === null;
    }

    /**
     * Get the related parent page.
     *
     * @return null|PageInterface
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Get the parent ID.
     *
     * @return int|null
     */
    public function getParentId()
    {
        return $this->parent_id;
    }

    /**
     * Get the content.
     *
     * @return null|string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Get the current flag.
     *
     * @return bool
     */
    public function isCurrent()
    {
        return $this->current;
    }

    /**
     * Set the current flag.
     *
     * @param $current
     * @return $this
     */
    public function setCurrent($current)
    {
        $this->current = $current;

        return $this;
    }

    /**
     * Get the active flag.
     *
     * @return bool
     */
    public function isActive()
    {
        return $this->active;
    }

    /**
     * Set the active flag.
     *
     * @param $active
     * @return $this
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get the related project.
     *
     * @return ProjectInterface
     */
    public function getProject()
    {
        return $this->project;
    }

    /**
     * Get the related project ID.
     *
     * @return int
     */
    public function getProjectId()
    {
        return $this
            ->getProject()
            ->getId();
    }

    /**
     * Get the related project slug.
     *
     * @return string
     */
    public function getProjectSlug()
    {
        return $this
            ->getProject()
            ->getSlug();
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
     * Return the children relationship.
     *
     * @return HasMany
     */
    public function children()
    {
        return $this->hasMany(PageModel::class, 'parent_id', 'id')
            ->orderBy('sort_order', 'ASC');
    }

    /**
     * Get the related sibling pages.
     *
     * @return PageCollection
     */
    public function getSiblings()
    {
        return $this->siblings;
    }

    /**
     * Return the siblings relationship.
     *
     * @return HasMany
     */
    public function siblings()
    {
        return $this->hasMany(PageModel::class, 'parent_id', 'parent_id')
            ->orderBy('sort_order', 'ASC');
    }

    /**
     * Return the routable array.
     *
     * @return array
     */
    public function toRoutableArray()
    {
        $array = parent::toRoutableArray();

        $array['path'] = ltrim($this->getPath(), '/');

        $array['project'] = $this->getProjectSlug();

        return $array;
    }
}
