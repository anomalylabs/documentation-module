<?php namespace Anomaly\DocumentationModule\Version\Contract;

use Anomaly\DocumentationModule\Page\Contract\PageInterface;
use Anomaly\DocumentationModule\Page\PageCollection;
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
     * Get the pages.
     *
     * @return PageCollection
     */
    public function getPages();

    /**
     * Get the home page.
     *
     * @return PageInterface|null
     */
    public function getHomePage();

    /**
     * Return the related pages.
     *
     * @return HasMany
     */
    public function pages();
}
