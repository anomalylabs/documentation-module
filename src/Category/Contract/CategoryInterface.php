<?php namespace Anomaly\DocumentationModule\Category\Contract;

use Anomaly\DocumentationModule\Project\ProjectCollection;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;

/**
 * Interface CategoryInterface
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\DocumentationModule\Category\Contract
 */
interface CategoryInterface extends EntryInterface
{

    /**
     * Get the related projects.
     *
     * @return ProjectCollection
     */
    public function getProjects();

    /**
     * Return the projects relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function projects();
}
