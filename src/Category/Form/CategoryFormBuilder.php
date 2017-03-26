<?php namespace Anomaly\DocumentationModule\Category\Form;

use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

/**
 * Class CategoryFormBuilder
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class CategoryFormBuilder extends FormBuilder
{

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

}
