<?php namespace Anomaly\DocumentationModule\Project\Form;

use Anomaly\DocumentationModule\Documentation\Contract\DocumentationInterface;
use Anomaly\Streams\Platform\Addon\Extension\Extension;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

/**
 * Class ProjectFormBuilder
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\DocumentationModule\Project\Form
 */
class ProjectFormBuilder extends FormBuilder
{

    /**
     * The storage documentation.
     *
     * @var Extension|DocumentationInterface|null
     */
    protected $documentation = null;

    /**
     * The fields to skip.
     *
     * @var array
     */
    protected $skips = [
        'documentation'
    ];

    /**
     * Fired just before
     * saving the form entry.
     */
    public function onSaving()
    {
        $entry         = $this->getFormEntry();
        $documentation = $this->getDocumentation();

        $entry->documentation = $documentation->getNamespace();
    }

    /**
     * Get the documentation.
     *
     * @return Extension|DocumentationInterface|null
     */
    public function getDocumentation()
    {
        return $this->documentation;
    }

    /**
     * Set the documentation.
     *
     * @param DocumentationInterface $documentation
     * @return $this
     */
    public function setDocumentation(DocumentationInterface $documentation)
    {
        $this->documentation = $documentation;

        return $this;
    }
}
