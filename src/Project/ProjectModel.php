<?php namespace Anomaly\DocumentationModule\Project;

use Anomaly\DocumentationModule\Category\Contract\CategoryInterface;
use Anomaly\DocumentationModule\Documentation\DocumentationExtension;
use Anomaly\DocumentationModule\Project\Contract\ProjectInterface;
use Anomaly\Streams\Platform\Model\Documentation\DocumentationProjectsEntryModel;

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
     * Get the default version.
     *
     * @return string
     */
    public function getDefaultVersion()
    {
        $versions = array_keys($this->getVersions());

        return end($versions);
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
}
