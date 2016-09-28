<?php namespace Anomaly\DocumentationModule\Section;

use Anomaly\DocumentationModule\Project\Contract\ProjectInterface;
use Anomaly\DocumentationModule\Section\Command\MakeSection;
use Anomaly\DocumentationModule\Section\Contract\SectionInterface;
use Anomaly\DocumentationModule\Type\Contract\TypeInterface;
use Anomaly\DocumentationModule\Version\Contract\VersionInterface;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Model\Documentation\DocumentationSectionsEntryModel;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class SectionModel
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class SectionModel extends DocumentationSectionsEntryModel implements SectionInterface
{

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
     * The section's content.
     *
     * @var null|string
     */
    protected $content = null;

    /**
     * Make the section.
     *
     * @return View
     */
    public function make()
    {
        $this->dispatch(new MakeSection($this));

        return $this;
    }

    /**
     * Return the section level.
     *
     * @return array|int
     */
    public function level()
    {
        $level = explode('/', trim($this->getPath(), '/'));

        return (!$level) ? 1 : count($level);
    }

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
     * @return SectionInterface|null
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
     * Get the version.
     *
     * @return VersionInterface|null
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Get the related version.
     *
     * @return ProjectInterface
     */
    public function getProject()
    {
        $version = $this->getVersion();

        return $version->getProject();
    }

    /**
     * Get the related children sections.
     *
     * @return SectionCollection
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * Return the children sections relationship.
     *
     * @return HasMany
     */
    public function children()
    {
        return $this->hasMany('Anomaly\DocumentationModule\Section\SectionModel', 'parent_id', 'id')
            ->orderBy('sort_order', 'ASC');
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
     * Get the meta keywords.
     *
     * @return array
     */
    public function getMetaKeywords()
    {
        return $this->meta_keywords;
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
     * Get the content.
     *
     * @return null|string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set the content.
     *
     * @param $content
     * @return $this
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get the type.
     *
     * @return TypeInterface
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Get the type entry model name.
     *
     * @return string
     */
    public function getTypeEntryModelName()
    {
        $type = $this->getType();

        return $type->getEntryModelName();
    }

    /**
     * Get the related entry.
     *
     * @return null|EntryInterface
     */
    public function getEntry()
    {
        return $this->entry;
    }

    /**
     * Get the related entry ID.
     *
     * @return null|int
     */
    public function getEntryId()
    {
        return $this->entry_id;
    }

    /**
     * Return the searchable array.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        $array = parent::toArray();

        if ($entry = $this->getEntry()) {
            $array = array_merge($entry->toArray(), $array);
        }

        unset($array['path']);

        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $array[$key] = implode(', ', $value);
            }
        }

        return $array;
    }

    /**
     * Return the routable data.
     *
     * @return array
     */
    public function toRoutableArray()
    {
        $routable = parent::toRoutableArray();

        $version = $this->getVersion();
        $project = $this->getProject();

        $routable['project'] = $project->getSlug();
        $routable['version'] = $version->getName();
        $routable['path']    = ltrim($this->getPath(), '/');

        return $routable;
    }
}
