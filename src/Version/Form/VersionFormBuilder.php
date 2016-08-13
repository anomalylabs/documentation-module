<?php namespace Anomaly\DocumentationModule\Version\Form;

use Anomaly\DocumentationModule\Project\Contract\ProjectInterface;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

/**
 * Class ProjectFormBuilder
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\DocumentationModule\Version\Form
 */
class VersionFormBuilder extends FormBuilder
{

    /**
     * The project instance.
     *
     * @var ProjectInterface
     */
    protected $project = null;

    /**
     * The skipped fields.
     *
     * @var array
     */
    protected $skips = [
        'project'
    ];

    /**
     * Fired when the builder is ready to build.
     *
     * @throws \Exception
     */
    public function onReady()
    {
        if (!$this->getProject() && !$this->getEntry()) {
            throw new \Exception('The $project parameter is required when creating a page.');
        }
    }

    /**
     * Fired just before saving the entry.
     */
    public function onSaving()
    {
        $entry = $this->getFormEntry();

        if (!$entry->project_id && $project = $this->getProject()) {
            $entry->project_id = $project->getId();
        }
    }

    /**
     * Get the project page.
     *
     * @return null|ProjectInterface
     */
    public function getProject()
    {
        return $this->project;
    }

    /**
     * Set the project page.
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
