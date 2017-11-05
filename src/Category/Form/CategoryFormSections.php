<?php namespace Anomaly\DocumentationModule\Category\Form;

/**
 * Class CategoryFormSections
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class CategoryFormSections
{

    /**
     * Handle the command.
     *
     * @param CategoryFormBuilder $builder
     */
    public function handle(CategoryFormBuilder $builder)
    {
        $stream = $builder->getFormStream();

        $builder->setSections(
            [
                'category' => [
                    'fields' => $stream
                        ->getLockedAssignments()
                        ->fieldSlugs(),
                ],
                'fields'   => [
                    'fields' => $stream
                        ->getUnlockedAssignments()
                        ->fieldSlugs(),
                ],
            ]
        );
    }
}
