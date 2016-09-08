<?php namespace Anomaly\DocumentationModule\Page\Form;

use Anomaly\DocumentationModule\Page\Contract\PageInterface;
use Illuminate\Foundation\Bus\DispatchesJobs;

class PageFormFields
{

    use DispatchesJobs;

    /**
     * Handle the page fields.
     *
     * @param PageFormBuilder $builder
     */
    public function handle(PageFormBuilder $builder)
    {
        $parent  = $builder->getParent();
        $version = $builder->getVersion();

        /* @var PageInterface $entry */
        if ($entry = $builder->getFormEntry()) {
            $version = $entry->getVersion();
        }

        /* @var PageInterface $entry */
        if (!$parent && $entry = $builder->getFormEntry()) {
            $parent = $entry->getParent();
        }

        $builder->setFields(
            [
                '*',
                'slug' => [
                    'config' => [
                        'prefix' => url(($parent ? $parent->route('view') : $version->route('view'))) . '/',
                    ],
                ],
            ]
        );
    }
}
