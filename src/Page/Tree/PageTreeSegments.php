<?php namespace Anomaly\DocumentationModule\Page\Tree;

use Anomaly\DocumentationModule\Page\Contract\PageInterface;

/**
 * Class PageTreeSegments
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class PageTreeSegments
{

    /**
     * Handle the tree segments.
     *
     * @param PageTreeBuilder $builder
     */
    public function handle(PageTreeBuilder $builder)
    {
        $builder->setSegments(
            [
                'entry.edit_link',
                [
                    'class' => 'text-faded',
                    'value' => function (PageInterface $entry) {
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
                    'enabled'     => function (PageInterface $entry) {
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
                    'enabled'     => function (PageInterface $entry) {
                        return !$entry->isEnabled();
                    },
                ],
            ]
        );
    }
}
