<?php namespace Anomaly\DocumentationModule\Source\Form;

use Anomaly\ConfigurationModule\Configuration\Form\ConfigurationFormBuilder;
use Anomaly\DocumentationModule\Project\Contract\ProjectInterface;
use Anomaly\DocumentationModule\Project\Form\ProjectFormBuilder;
use Anomaly\Streams\Platform\Ui\Form\Multiple\MultipleFormBuilder;

/**
 * Class SourceFormBuilder
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\DocumentationModule\Source\Form
 */
class SourceFormBuilder extends MultipleFormBuilder
{

    /**
     * Fired just before saving the configuration.
     */
    public function onSavingConfiguration()
    {
        /* @var ProjectFormBuilder $project */
        $project = $this->forms->get('project');

        /* @var ProjectInterface $entry */
        $entry = $project->getFormEntry();

        /* @var ConfigurationFormBuilder $configuration */
        $configuration = $this->forms->get('configuration');

        if (!$configuration->getScope()) {
            $configuration->setScope($entry->getSlug());
        }
    }
}
