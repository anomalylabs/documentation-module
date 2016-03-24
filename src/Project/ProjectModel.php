<?php namespace Anomaly\DocumentationModule\Project;

use Anomaly\DocumentationModule\Project\Contract\ProjectInterface;
use Anomaly\Streams\Platform\Model\Documentation\DocumentationProjectsEntryModel;

/**
 * Class ProjectModel
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\DocumentationModule\Project
 */
class ProjectModel extends DocumentationProjectsEntryModel implements ProjectInterface
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
}
