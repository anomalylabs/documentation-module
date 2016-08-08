<?php namespace Anomaly\DocumentationModule\Type\Contract;

use Anomaly\DocumentationModule\Page\PageCollection;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;

/**
 * Interface TypeInterface
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\DocumentationModule\Type\Contract
 */
interface TypeInterface extends EntryInterface
{

    /**
     * Get the slug.
     *
     * @return string
     */
    public function getSlug();

    /**
     * Get the name.
     *
     * @return string
     */
    public function getName();

    /**
     * Get the description.
     *
     * @return string
     */
    public function getDescription();

    /**
     * Get the related pages.
     *
     * @return PageCollection
     */
    public function getPages();

    /**
     * Return the page relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pages();
}
