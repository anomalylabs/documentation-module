<?php namespace Anomaly\DocumentationModule\Section\Form;

use Anomaly\DocumentationModule\Section\Contract\SectionInterface;
use Illuminate\Foundation\Bus\DispatchesJobs;

class SectionFormFields
{

    use DispatchesJobs;

    /**
     * Handle the section fields.
     *
     * @param SectionFormBuilder $builder
     */
    public function handle(SectionFormBuilder $builder)
    {
        $parent  = $builder->getParent();
        $version = $builder->getVersion();

        /* @var SectionInterface $entry */
        if (!$version && $entry = $builder->getFormEntry()) {
            $version = $entry->getVersion();
        }

        /* @var SectionInterface $entry */
        if (!$parent && $entry = $builder->getFormEntry()) {
            $parent = $entry->getParent();
        }

        $builder->setFields(
            [
                '*',
                'slug' => [
                    'config' => [
                        //'prefix' => url(($parent ? $parent->route('view') : $version->route('view'))) . '/',
                    ],
                ],
            ]
        );
    }
}
