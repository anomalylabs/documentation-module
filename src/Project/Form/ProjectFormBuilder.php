<?php namespace Anomaly\DocumentationModule\Project\Form;

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
     * The form sections.
     *
     * @var array
     */
    protected $sections = [
        'project' => [
            'fields' => [
                'name',
                'slug',
                'description',
            ]
        ],
        'options' => [
            'fields' => [
                'enabled',
                'allowed_roles'
            ]
        ],
    ];
}
