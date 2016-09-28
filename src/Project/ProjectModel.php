<?php namespace Anomaly\DocumentationModule\Project;

use Anomaly\DocumentationModule\Category\Contract\CategoryInterface;
use Anomaly\DocumentationModule\Project\Contract\ProjectInterface;
use Anomaly\DocumentationModule\Section\SectionCollection;
use Anomaly\DocumentationModule\Section\SectionModel;
use Anomaly\DocumentationModule\Version\Contract\VersionInterface;
use Anomaly\DocumentationModule\Version\VersionCollection;
use Anomaly\DocumentationModule\Version\VersionModel;
use Anomaly\Streams\Platform\Model\Documentation\DocumentationProjectsEntryModel;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class ProjectModel
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
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
     * Get the related sections.
     *
     * @return SectionCollection
     */
    public function getSections()
    {
        return $this->sections;
    }

    /**
     * Return the sections relation.
     *
     * @return HasMany
     */
    public function sections()
    {
        return $this->hasMany(SectionModel::class, 'project_id');
    }

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
     * Get the related version by name.
     *
     * @param $name
     * @return VersionInterface|null
     */
    public function getVersion($name)
    {
        $versions = $this->getVersions();

        return $versions->findBy('name', $name);
    }

    /**
     * Get the latest version.
     *
     * @return VersionInterface|null
     */
    public function getLatestVersion()
    {
        $versions = $this->getVersions();

        return $versions
            ->enabled()
            ->first();
    }

    /**
     * Return the versions relation.
     *
     * @return HasMany
     */
    public function versions()
    {
        return $this->hasMany(VersionModel::class, 'project_id')
            ->orderBy('sort_order', 'ASC');
    }

    /**
     * Return the related category.
     *
     * @return CategoryInterface
     */
    public function getCategory()
    {
        return $this->category;
    }
}
