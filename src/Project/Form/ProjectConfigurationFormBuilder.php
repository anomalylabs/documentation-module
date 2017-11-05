<?php namespace Anomaly\DocumentationModule\Project\Form;

use Anomaly\Streams\Platform\Ui\Form\Multiple\MultipleFormBuilder;

/**
 * Class ProjectConfigurationFormBuilder
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class ProjectConfigurationFormBuilder extends MultipleFormBuilder
{

    /**
     * Get the contextual ID.
     *
     * @return int|null
     */
    public function getContextualId()
    {
        return $this->getChildFormEntryId('project');
    }

}
