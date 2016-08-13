<?php namespace Anomaly\DocumentationModule\Page\Contract;

use Anomaly\DocumentationModule\Page\PageCollection;
use Anomaly\DocumentationModule\Project\Contract\ProjectInterface;
use Anomaly\DocumentationModule\Type\Contract\TypeInterface;
use Anomaly\DocumentationModule\Version\Contract\VersionInterface;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Http\Response;

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
     * Get the response.
     *
     * @return Response|null
     */
    public function getResponse();

    /**
     * Set the response.
     *
     * @param $response
     * @return $this
     */
    public function setResponse(Response $response);

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
