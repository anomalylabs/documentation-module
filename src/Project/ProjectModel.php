<?php namespace Anomaly\DocumentationModule\Project;

use Anomaly\DocumentationModule\Category\Contract\CategoryInterface;
use Anomaly\DocumentationModule\Documentation\DocumentationExtension;
use Anomaly\DocumentationModule\Page\PageCollection;
use Anomaly\DocumentationModule\Page\PageModel;
use Anomaly\DocumentationModule\Project\Contract\ProjectInterface;
use Anomaly\Streams\Platform\Model\Documentation\DocumentationProjectsEntryModel;
use Illuminate\Database\Eloquent\Collection;
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
     * Get the data attribute.
     *
     * @param $value
     * @return \stdClass
     */
    public function getDataAttribute($value)
    {
        return json_decode($value);
    }

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
     * Get the name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the string ID.
     *
     * @return string
     */
    public function getStrId()
    {
        return $this->str_id;
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
     * Return the related category.
     *
     * @return CategoryInterface
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Get the versions.
     *
     * @return array
     */
    public function getVersions()
    {
        $versions = [];

        foreach (explode("\n", $this->versions) as $option) {

            // Split on the first ":"
            if (str_is('*:*', $option)) {
                $option = explode(':', $option, 2);
            } else {
                $option = [$option, $option];
            }

            $key   = array_shift($option);
            $value = $option ? array_shift($option) : $key;

            $versions[ltrim(trim($key, "\r\n "), "\r\n ")] = ltrim(trim($value, "\r\n "), "\r\n ");
        }

        return $versions;
    }

    /**
     * Get the version references.
     *
     * @return array
     */
    public function getReferences()
    {
        return array_keys($this->getVersions());
    }

    /**
     * Get the default version reference.
     *
     * @return string
     */
    public function getDefaultReference()
    {
        $references = $this->getReferences();

        return reset($references);
    }

    /**
     * Get the documentation extension.
     *
     * @return DocumentationExtension
     */
    public function getDocumentation()
    {
        return $this->documentation;
    }

    /**
     * Return the project's documentation.
     *
     * @return DocumentationExtension
     */
    public function documentation()
    {
        return $this
            ->getDocumentation()
            ->setProject($this);
    }

    /**
     * Get the related pages.
     *
     * @param $reference
     * @return PageCollection|Collection
     */
    public function getPages($reference)
    {
        return $this
            ->pages($reference)
            ->get();
    }

    /**
     * Return the pages relation.
     *
     * @param $reference
     * @return HasMany
     */
    public function pages($reference)
    {
        return $this
            ->hasMany(PageModel::class, 'project_id')
            ->where('reference', $reference);
    }
}
