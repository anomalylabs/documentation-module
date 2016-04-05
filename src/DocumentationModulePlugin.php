<?php namespace Anomaly\DocumentationModule;

use Anomaly\Streams\Platform\Addon\Module\Module;
use Anomaly\Streams\Platform\Addon\Plugin\Plugin;
use Anomaly\Streams\Platform\Support\Decorator;

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
     * Get the functions.
     *
     * @return array
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction(
                'documentation',
                function () {
                    return (new Decorator())->decorate('Test');
                },
                [
                    'is_safe' => ['html']
                ]
            )
        ];
    }
}
