<?php namespace Anomaly\DocumentationModule\Documentation;

use Anomaly\ConfigurationModule\Configuration\Form\ConfigurationFormBuilder;
use Anomaly\DocumentationModule\Project\Contract\ProjectInterface;
use Anomaly\Streams\Platform\Addon\Extension\Extension;

/**
 * Class DocumentationExtension
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
abstract class DocumentationExtension extends Extension
{

    /**
     * The project instance.
     *
     * @var ProjectInterface
     */
    protected $project;

    /**
     * Return the available locales.
     *
     * @param $reference
     * @return array
     */
    abstract public function locales($reference);

    /**
     * Return the documentation structure.
     *
     * @param $reference
     * @param $locale
     * @return array
     */
    abstract public function structure($reference, $locale);

    /**
     * Return a documentation page.
     *
     * @param $reference
     * @return array
     */
    abstract public function page($reference, $locale, $path);

    /**
     * Validate the configuration.
     *
     * @param ConfigurationFormBuilder $builder
     * @return bool
     */
    abstract public function validate(ConfigurationFormBuilder $builder);

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
     * Get the project ID.
     *
     * @return int|null
     */
    public function getProjectId()
    {
        if (!$project = $this->getProject()) {
            return null;
        }

        return $project->getId();
    }

    /**
     * Set the project.
     *
     * @param ProjectInterface $project
     * @return $this
     */
    public function setProject(ProjectInterface $project)
    {
        $this->project = $project;

        return $this;
    }
}
