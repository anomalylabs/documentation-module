<?php namespace Anomaly\DocumentationModule\Page\Form;

use Anomaly\DocumentationModule\Page\PageModel;
use Anomaly\Streams\Platform\Addon\FieldType\FieldType;

/**
 * Class PageEntryFormSections
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\DocumentationModule\Page\Form
 */
class PageEntryFormSections
{

    /**
     * Handle the form sections.
     *
     * @param PageEntryFormBuilder $builder
     */
    public function handle(PageEntryFormBuilder $builder)
    {
        $builder->setSections(
            [
                'general' => [
                    'fields' => [
                        'page_title',
                        'page_slug',
                    ],
                ],
                'fields'  => [
                    'fields' => function (PageEntryFormBuilder $builder) {
                        return array_map(
                            function (FieldType $field) {
                                return 'entry_' . $field->getField();
                            },
                            array_filter(
                                $builder->getFormFields()->base()->all(),
                                function (FieldType $field) {
                                    return (!$field->getEntry() instanceof PageModel);
                                }
                            )
                        );
                    },
                ],
                'seo'     => [
                    'fields' => [
                        'page_meta_title',
                        'page_meta_keywords',
                        'page_meta_description',
                    ],
                ],
                'options' => [
                    'fields' => [
                        'page_enabled',
                        'page_home',
                    ],
                ],
            ]
        );
    }
}