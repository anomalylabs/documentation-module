<?php namespace Anomaly\DocumentationModule\Project\Contract;

use Anomaly\DocumentationModule\Category\Contract\CategoryInterface;
use Anomaly\DocumentationModule\Documentation\DocumentationExtension;
use Anomaly\DocumentationModule\Page\PageCollection;
use Anomaly\DocumentationModule\Section\SectionCollection;
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
     * Return the related category.
     *
     * @return CategoryInterface
     */
    public function getCategory();

    /**
     * Get the versions.
     *
     * @return array
     */
    public function getVersions();

    /**
     * Get the version references.
     *
     * @return array
     */
    public function getReferences();

    /**
     * Get the default version reference.
     *
     * @return string
     */
    public function getDefaultReference();

    /**
     * Get the documentation extension.
     *
     * @return DocumentationExtension
     */
    public function getDocumentation();

    /**
     * Return the project's documentation.
     *
     * @return DocumentationExtension
     */
    public function documentation();

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
}
