<?php namespace Anomaly\DocumentationModule\Project\Form;

use Anomaly\Streams\Platform\Routing\UrlGenerator;

/**
 * Class ProjectFormFields
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\DocumentationModule\Project\Form
 */
class ProjectFormFields
{

    /**
     * Handle the command.
     *
     * @param ProjectFormBuilder $builder
     */
    public function handle(ProjectFormBuilder $builder, UrlGenerator $url)
    {
        $builder->setFields(
            [
                '*',
                'slug' => [
                    'config' => [
                        'prefix' => $url->route('anomaly.module.documentation::projects.index') . '/'
                    ]
                ]
            ]
        );
    }
}
