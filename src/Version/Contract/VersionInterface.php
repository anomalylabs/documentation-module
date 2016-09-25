<?php namespace Anomaly\DocumentationModule\Version\Contract;

use Anomaly\DocumentationModule\Section\Contract\SectionInterface;
use Anomaly\DocumentationModule\Section\SectionCollection;
use Anomaly\DocumentationModule\Project\Contract\ProjectInterface;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Interface VersionInterface
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\DocumentationModule\Version\Contract
 */
interface VersionInterface extends EntryInterface
{

    /**
     * Get the name.
     *
     * @return string
     */
    public function getName();

    /**
     * Get the enabled flag.
     *
     * @return bool
     */
    public function isEnabled();

    /**
     * Get the project.
     *
     * @return ProjectInterface
     */
    public function getProject();

    /**
     * Return the project relation.
     *
     * @return BelongsTo
     */
    public function project();

    /**
     * Get the sections.
     *
     * @return SectionCollection
     */
    public function getSections();

    /**
     * Get the home section.
     *
     * @return SectionInterface|null
     */
    public function getHomeSection();

    /**
     * Return the related sections.
     *
     * @return HasMany
     */
    public function sections();
}
