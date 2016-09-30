<?php namespace Anomaly\DocumentationModule\Version;

use Anomaly\DocumentationModule\Project\Contract\ProjectInterface;
use Anomaly\DocumentationModule\Section\Contract\SectionInterface;
use Anomaly\DocumentationModule\Section\SectionCollection;
use Anomaly\DocumentationModule\Section\SectionModel;
use Anomaly\DocumentationModule\Version\Contract\VersionInterface;
use Anomaly\Streams\Platform\Model\Documentation\DocumentationVersionsEntryModel;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
     * Get the name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the enabled flag.
     *
     * @return bool
     */
    public function isEnabled()
    {
        return $this->enabled;
    }

    /**
     * Get the project.
     *
     * @return ProjectInterface
     */
    public function getProject()
    {
        return $this->project;
    }

    /**
     * Get the sections.
     *
     * @return SectionCollection
     */
    public function getSections()
    {
        return $this->sections;
    }

    /**
     * Get the home section.
     *
     * @return SectionInterface|null
     */
    public function getHomeSection()
    {
        $sections = $this->getSections();

        return $sections->home() ?: $sections->first();
    }

    /**
     * Return the related sections.
     *
     * @return HasMany
     */
    public function sections()
    {
        return $this->hasMany(SectionModel::class, 'version_id')
            ->orderBy('parent_id', 'ASC')
            ->orderBy('sort_order', 'ASC');
    }

    /**
     * Return the routable data.
     *
     * @return array
     */
    public function toRoutableArray()
    {
        $routable = parent::toRoutableArray();

        $project = $this->getProject();

        $routable['project'] = $project->getSlug();

        return $routable;
    }
}
