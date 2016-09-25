<?php namespace Anomaly\DocumentationModule\Section\Tree;

use Anomaly\DocumentationModule\Section\Contract\SectionInterface;

/**
 * Class SectionTreeSegments
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class SectionTreeSegments
{

    /**
     * Handle the tree segments.
     *
     * @param SectionTreeBuilder $builder
     */
    public function handle(SectionTreeBuilder $builder)
    {
        $builder->setSegments(
            [
                'entry.edit_link',
                [
                    'class' => 'text-faded',
                    'value' => function (SectionInterface $entry) {
                        return '<span class="small" style="padding-right:10px;">' . $entry->getType()->getName(
                        ) . '</span>';
                    },
                ],
                [
                    'data-toggle' => 'tooltip',
                    'class'       => 'text-success',
                    'value'       => '<i class="fa fa-home"></i>',
                    'attributes'  => [
                        'title' => 'module::message.home',
                    ],
                    'enabled'     => function (SectionInterface $entry) {
                        return $entry->isHome();
                    },
                ],
                [
                    'data-toggle' => 'tooltip',
                    'class'       => 'text-danger',
                    'value'       => '<i class="fa fa-ban"></i>',
                    'attributes'  => [
                        'title' => 'module::message.disabled',
                    ],
                    'enabled'     => function (SectionInterface $entry) {
                        return !$entry->isEnabled();
                    },
                ],
            ]
        );
    }
}
