<?php namespace Anomaly\DocumentationModule\Project;

use Anomaly\DocumentationModule\Project\Contract\ProjectInterface;
use Anomaly\Streams\Platform\Entry\EntryCollection;

/**
 * Class ProjectCollection
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\DocumentationModule\Project
 */
class ProjectCollection extends EntryCollection
{

    /**
     * Return only enabled projects.
     *
     * @return ProjectCollection
     */
    public function enabled()
    {
        return $this->filter(
            function ($project) {

                /* @var ProjectInterface $project */
                return $project->isEnabled();
            }
        );
    }
}
