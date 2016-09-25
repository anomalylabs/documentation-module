<?php namespace Anomaly\DocumentationModule\Type\Contract;

use Anomaly\DocumentationModule\Section\SectionCollection;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Stream\Contract\StreamInterface;

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
     * Get the related entry stream.
     *
     * @return StreamInterface
     */
    public function getEntryStream();

    /**
     * Get the related entry model name.
     *
     * @return string
     */
    public function getEntryModelName();

    /**
     * Get the related sections.
     *
     * @return SectionCollection
     */
    public function getSections();

    /**
     * Return the section relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sections();
}
