<?php namespace Anomaly\DocumentationModule\Section\Form;

use Anomaly\DocumentationModule\Section\SectionModel;
use Anomaly\Streams\Platform\Addon\FieldType\FieldType;

/**
 * Class SectionEntryFormSections
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\DocumentationModule\Section\Form
 */
class SectionEntryFormSections
{

    /**
     * Handle the form sections.
     *
     * @param SectionEntryFormBuilder $builder
     */
    public function handle(SectionEntryFormBuilder $builder)
    {
        $builder->setSections(
            [
                'general' => [
                    'fields' => [
                        'section_title',
                        'section_slug',
                    ],
                ],
                'fields'  => [
                    'fields' => function (SectionEntryFormBuilder $builder) {
                        return array_map(
                            function (FieldType $field) {
                                return 'entry_' . $field->getField();
                            },
                            array_filter(
                                $builder->getFormFields()->base()->all(),
                                function (FieldType $field) {
                                    return (!$field->getEntry() instanceof SectionModel);
                                }
                            )
                        );
                    },
                ],
                'options' => [
                    'fields' => [
                        'section_enabled',
                    ],
                ],
            ]
        );
    }
}
