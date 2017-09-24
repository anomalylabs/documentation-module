<?php namespace Anomaly\DocumentationModule\Project\Form;

class ProjectConfigurationFormSections
{

    public function handle(ProjectConfigurationFormBuilder $builder)
    {
        $stream        = $builder->getChildFormStream('project');
        $configuration = $builder->getChildForm('configuration');

        $builder->setSections(
            [
                'project'       => [
                    'tabs' => [
                        'project' => [
                            'title'  => 'anomaly.module.documentation::tab.project',
                            'fields' => [
                                'project_name',
                                'project_slug',
                                'project_description',
                                'project_versions',
                            ],
                        ],
                        'seo'     => [
                            'title'  => 'anomaly.module.documentation::tab.seo',
                            'fields' => [
                                'project_meta_title',
                                'project_meta_description',
                            ],
                        ],
                        'options' => [
                            'title'  => 'anomaly.module.documentation::tab.options',
                            'fields' => [
                                'project_category',
                                'project_tags',
                                'project_enabled',
                            ],
                        ],
                    ],
                ],
                'configuration' => [
                    'fields' => $configuration->getFormFieldSlugs('configuration_'),
                ],
                'custom'        => [
                    'fields' => $stream
                        ->getUnlockedAssignments()
                        ->fieldSlugs('project_'),
                ],
            ]
        );
    }
}
