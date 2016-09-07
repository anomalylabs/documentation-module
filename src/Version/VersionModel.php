<?php namespace Anomaly\DocumentationModule\Version;

use Anomaly\DocumentationModule\Page\Contract\PageInterface;
use Anomaly\DocumentationModule\Page\PageCollection;
use Anomaly\DocumentationModule\Page\PageModel;
use Anomaly\DocumentationModule\Project\Contract\ProjectInterface;
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
     * Get the pages.
     *
     * @return PageCollection
     */
    public function getPages()
    {
        return $this->pages;
    }

    /**
     * Get the home page.
     *
     * @return PageInterface|null
     */
    public function getHomePage()
    {
        $pages = $this->getPages();

        return $pages->home() ?: $pages->first();
    }

    /**
     * Return the related pages.
     *
     * @return HasMany
     */
    public function pages()
    {
        return $this->hasMany(PageModel::class, 'version_id');
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
