<?php namespace Anomaly\DocumentationModule\Type;

use Anomaly\DocumentationModule\Page\PageCollection;
use Anomaly\DocumentationModule\Type\Contract\TypeInterface;
use Anomaly\Streams\Platform\Model\Documentation\DocumentationTypesEntryModel;

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
     * Get the related pages.
     *
     * @return PageCollection
     */
    public function getPages()
    {
        return $this->pages;
    }

    /**
     * Return the page relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pages()
    {
        return $this->hasMany('Anomaly\DocumentationModule\Page\PageModel', 'type_id');
    }
}
