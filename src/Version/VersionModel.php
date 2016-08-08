<?php namespace Anomaly\DocumentationModule\Version;

use Anomaly\DocumentationModule\Project\Contract\ProjectInterface;
use Anomaly\DocumentationModule\Version\Contract\VersionInterface;
use Anomaly\Streams\Platform\Model\Documentation\DocumentationVersionsEntryModel;

/**
 * Class VersionModel
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\DocumentationModule\Version
 */
class VersionModel extends DocumentationVersionsEntryModel implements VersionInterface
{

    /**
     * Get the project.
     *
     * @return ProjectInterface
     */
    public function getProject()
    {
        return $this->project;
    }
}
