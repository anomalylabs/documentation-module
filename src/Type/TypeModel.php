<?php namespace Anomaly\DocumentationModule\Type;

use Anomaly\DocumentationModule\Section\SectionCollection;
use Anomaly\DocumentationModule\Type\Command\GetEntryStream;
use Anomaly\DocumentationModule\Type\Contract\TypeInterface;
use Anomaly\Streams\Platform\Model\Documentation\DocumentationTypesEntryModel;
use Anomaly\Streams\Platform\Stream\Contract\StreamInterface;

/**
 * Class TypeModel
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\DocumentationModule\Type
 */
class TypeModel extends DocumentationTypesEntryModel implements TypeInterface
{

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
     * Get the name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the description.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->direction;
    }

    /**
     * Get the related entry stream.
     *
     * @return StreamInterface
     */
    public function getEntryStream()
    {
        return $this->dispatch(new GetEntryStream($this));
    }

    /**
     * Get the related entry model name.
     *
     * @return string
     */
    public function getEntryModelName()
    {
        $stream = $this->getEntryStream();

        return $stream->getEntryModelName();
    }

    /**
     * Get the related sections.
     *
     * @return SectionCollection
     */
    public function getSections()
    {
        return $this->sections;
    }

    /**
     * Return the section relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sections()
    {
        return $this->hasMany('Anomaly\DocumentationModule\Section\SectionModel', 'type_id')
            ->orderBy('parent_id', 'ASC')
            ->orderBy('sort_order', 'ASC');
    }
}
