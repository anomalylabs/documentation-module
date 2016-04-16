<?php namespace Anomaly\DocumentationModule\Project\Contract;

use Anomaly\DocumentationModule\Project\ProjectCollection;
use Anomaly\Streams\Platform\Entry\Contract\EntryRepositoryInterface;

/**
 * Interface ProjectRepositoryInterface
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\DocumentationModule\Project\Contract
 */
interface ProjectRepositoryInterface extends EntryRepositoryInterface
{

    /**
     * Return only enabled projects.
     *
     * @return ProjectCollection
     */
    public function enabled();

    /**
     * Find a project by it's slug.
     *
     * @param $slug
     * @return ProjectInterface|null
     */
    public function findBySlug($slug);
}
