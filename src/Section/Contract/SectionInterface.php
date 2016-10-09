<?php namespace Anomaly\DocumentationModule\Section\Contract;

use Anomaly\DocumentationModule\Project\Contract\ProjectInterface;
use Anomaly\DocumentationModule\Section\SectionCollection;
use Anomaly\DocumentationModule\Type\Contract\TypeInterface;
use Anomaly\DocumentationModule\Version\Contract\VersionInterface;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * Interface SectionInterface
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\DocumentationModule\Section\Contract
 */
interface SectionInterface extends EntryInterface
{

    /**
     * Return the section level.
     *
     * @param null $ceiling
     * @return int
     */
    public function level($ceiling = null);

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
     * @return SectionInterface|null
     */
    public function getParent();

    /**
     * Get the parent ID.
     *
     * @return int|null
     */
    public function getParentId();

    /**
     * Return the parent relation.
     *
     * @return BelongsTo
     */
    public function parent();

    /**
     * Get the version.
     *
     * @return VersionInterface
     */
    public function getVersion();

    /**
     * Return the version relation.
     *
     * @return BelongsTo
     */
    public function version();

    /**
     * Get the related version.
     *
     * @return ProjectInterface
     */
    public function getProject();

    /**
     * Get the related children sections.
     *
     * @return SectionCollection
     */
    public function getChildren();

    /**
     * Return the children sections relationship.
     *
     * @return HasMany
     */
    public function children();

    /**
     * Get the content.
     *
     * @return null|string
     */
    public function getContent();

    /**
     * Set the content.
     *
     * @param $content
     * @return $this
     */
    public function setContent($content);

    /**
     * Get the meta title.
     *
     * @return string
     */
    public function getMetaTitle();

    /**
     * Get the meta keywords.
     *
     * @return string
     */
    public function getMetaKeywords();

    /**
     * Get the meta description.
     *
     * @return string
     */
    public function getMetaDescription();

    /**
     * Get the type.
     *
     * @return TypeInterface
     */
    public function getType();

    /**
     * Get the type entry model name.
     *
     * @return string
     */
    public function getTypeEntryModelName();

    /**
     * Return the type relation.
     *
     * @return BelongsTo
     */
    public function type();

    /**
     * Get the related entry.
     *
     * @return null|EntryInterface
     */
    public function getEntry();

    /**
     * Get the related entry ID.
     *
     * @return null|int
     */
    public function getEntryId();

    /**
     * Return the entry relationship.
     *
     * @return MorphTo
     */
    public function entry();
}
