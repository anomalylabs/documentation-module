<?php namespace Anomaly\DocumentationModule\Category;

use Anomaly\DocumentationModule\Category\Contract\CategoryInterface;
use Anomaly\DocumentationModule\Project\ProjectCollection;
use Anomaly\Streams\Platform\Model\Documentation\DocumentationCategoriesEntryModel;

/**
 * Class CategoryModel
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\DocumentationModule\Category
 */
class CategoryModel extends DocumentationCategoriesEntryModel implements CategoryInterface
{

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
     * Return the projects relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function projects()
    {
        return $this->hasMany('Anomaly\DocumentationModule\Project\ProjectModel', 'category_id');
    }
}
