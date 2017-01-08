<?php namespace Anomaly\DocumentationModule\Category;

use Anomaly\DocumentationModule\Category\Contract\CategoryInterface;
use Anomaly\DocumentationModule\Project\ProjectCollection;
use Anomaly\DocumentationModule\Project\ProjectModel;
use Anomaly\Streams\Platform\Model\Documentation\DocumentationCategoriesEntryModel;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class CategoryModel
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class CategoryModel extends DocumentationCategoriesEntryModel implements CategoryInterface
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
        return $this->description;
    }

    /**
     * Get the related projects.
     *
     * @return ProjectCollection
     */
    public function getProjects()
    {
        return $this->projects;
    }

    /**
     * Return the project relation.
     *
     * @return HasMany
     */
    public function projects()
    {
        return $this->hasMany(ProjectModel::class, 'category_id');
    }
}
