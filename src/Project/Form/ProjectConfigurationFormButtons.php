<?php namespace Anomaly\DocumentationModule\Project\Form;

/**
 * Class ProjectConfigurationFormButtons
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class ProjectConfigurationFormButtons
{

    /**
     * Handle the command.
     *
     * @param ProjectConfigurationFormBuilder $builder
     */
    public function handle(ProjectConfigurationFormBuilder $builder)
    {
        $builder->setButtons(
            [
                'cancel',
                'view' => [
                    'enabled' => 'edit',
                    'target'  => '_blank',
                    'href'    => 'admin/documentation/view/' . $builder->getChildFormEntryId('project'),
                ],
                'sync' => [
                    'enabled' => 'edit',
                    'icon'    => 'refresh',
                    'type'    => 'primary',
                ],
            ]
        );
    }
}
