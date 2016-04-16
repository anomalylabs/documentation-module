<?php namespace Anomaly\DocumentationModule\Documentation\Form;

/**
 * Class DocumentationFormSections
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\DocumentationModule\Documentation\Form
 */
class DocumentationFormSections
{

    /**
     * Handle the command.
     *
     * @param DocumentationFormBuilder $builder
     */
    public function handle(DocumentationFormBuilder $builder)
    {
        $project       = $builder->getChildForm('project');
        $configuration = $builder->getChildForm('configuration');

        $builder->setSections(
            [
                'project'       => [
                    'context' => 'primary',
                    'title'   => 'anomaly.module.documentation::form.section.project',
                    'fields'  => array_map(
                        function ($slug) {
                            return 'project_' . $slug;
                        },
                        $project->getFormFieldSlugs()
                    )
                ],
                'configuration' => [
                    'context' => 'danger',
                    'title'   => 'anomaly.module.configuration::form.section.configuration',
                    'fields'  => array_map(
                        function ($slug) {
                            return 'configuration_' . $slug;
                        },
                        $configuration->getFormFieldSlugs()
                    )
                ]
            ]
        );
    }
}
