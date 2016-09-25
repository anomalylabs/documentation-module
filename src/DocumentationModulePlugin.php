<?php namespace Anomaly\DocumentationModule;

use Anomaly\DocumentationModule\Section\Command\RenderNavigation;
use Anomaly\Streams\Platform\Addon\Plugin\Plugin;
use Anomaly\Streams\Platform\Addon\Plugin\PluginCriteria;
use Anomaly\Streams\Platform\Support\Collection;

/**
 * Class DocumentationModulePlugin
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\DocumentationModule
 */
class DocumentationModulePlugin extends Plugin
{

    /**
     * Get the plugin functions.
     *
     * @return array
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction(
                'documentation',
                function ($root = null) {
                    return new PluginCriteria(
                        'render',
                        function (Collection $options) use ($root) {

                            if ($root) {
                                $options->put('root', $root);
                            }

                            return $this->dispatch(new RenderNavigation($options));
                        }
                    );
                },
                [
                    'is_safe' => ['html'],
                ]
            ),
        ];
    }
}
