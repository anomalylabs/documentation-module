<?php namespace Anomaly\DocumentationModule\Project\Form;

use Anomaly\DocumentationModule\Documentation\DocumentationExtension;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

/**
 * Class ProjectFormBuilder
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class ProjectFormBuilder extends FormBuilder
{

    /**
     * The documentation extension.
     *
     * @var DocumentationExtension
     */
    protected $documentation;

    /**
     * @var array
     */
    protected $skips = [
        'documentation',
    ];

    /**
     * The form buttons.
     *
     * @var array
     */
    protected $buttons = [
        'cancel',
        'view' => [
            'enabled' => 'edit',
            'target'  => '_blank',
        ],
    ];

    /**
     * Fired just before saving.
     */
    public function onSaving()
    {
        $entry = $this->getFormEntry();

        if ($documentation = $this->getDocumentation()) {
            $entry->documentation = $documentation;
        }
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
     * Set the documentation extension.
     *
     * @param DocumentationExtension $documentation
     * @return $this
     */
    public function setDocumentation(DocumentationExtension $documentation)
    {
        $this->documentation = $documentation;

        return $this;
    }
}
