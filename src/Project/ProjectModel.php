<?php namespace Anomaly\DocumentationModule\Project;

use Anomaly\DocumentationModule\Project\Contract\ProjectInterface;
use Anomaly\DocumentationModule\Version\VersionCollection;
use Anomaly\DocumentationModule\Version\VersionModel;
use Anomaly\Streams\Platform\Model\Documentation\DocumentationProjectsEntryModel;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
     * Get the related versions.
     *
     * @return VersionCollection
     */
    public function getVersions()
    {
        return $this->versions;
    }

    /**
     * Return the versions relation.
     *
     * @return HasMany
     */
    public function versions()
    {
        return $this->hasMany(VersionModel::class, 'project_id');
    }
}
