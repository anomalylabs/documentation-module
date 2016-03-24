<?php namespace Anomaly\DocumentationModule\Project\Form;

use Anomaly\DocumentationModule\Source\Contract\SourceInterface;
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
     * The storage source.
     *
     * @var Extension|SourceInterface|null
     */
    protected $source = null;

    /**
     * The fields to skip.
     *
     * @var array
     */
    protected $skips = [
        'source'
    ];

    /**
     * Fired just before
     * saving the form entry.
     */
    public function onSaving()
    {
        $entry  = $this->getFormEntry();
        $source = $this->getSource();

        $entry->source = $source->getNamespace();
    }

    /**
     * Get the source.
     *
     * @return Extension|SourceInterface|null
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * Set the source.
     *
     * @param SourceInterface $source
     * @return $this
     */
    public function setSource(SourceInterface $source)
    {
        $this->source = $source;

        return $this;
    }
}
