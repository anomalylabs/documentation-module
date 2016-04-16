<?php namespace Anomaly\DocumentationModule\Project;

use Anomaly\DocumentationModule\Documentation\Contract\DocumentationInterface;
use Anomaly\DocumentationModule\Project\Contract\ProjectInterface;
use Anomaly\Streams\Platform\Addon\Extension\Extension;
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
     * Return the reference for a version.
     *
     * @param        $version
     * @return string
     */
    public function reference($version)
    {
        if (!$version) {
            return null;
        }

        return array_get($this->getVersions(), $version);
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
     * Get the home page.
     *
     * @return string|null
     */
    public function getHome()
    {
        return $this->home;
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
     * Get the enabled flag.
     *
     * @return bool
     */
    public function isEnabled()
    {
        return $this->enabled;
    }

    /**
     * Get the versions.
     *
     * @return array
     */
    public function getVersions()
    {
        $lines = array_filter(explode("\n", $this->versions));

        if (!$lines) {
            return [];
        }

        return array_combine(
            array_map(
                function ($line) {
                    return trim(explode(':', $line)[0]);
                },
                $lines
            ),
            array_map(
                function ($line) {
                    return trim(explode(':', $line)[1]);
                },
                $lines
            )
        );
    }

    /**
     * Get the documentation.
     *
     * @return Extension|DocumentationInterface
     */
    public function getDocumentation()
    {
        return $this->documentation;
    }
}
