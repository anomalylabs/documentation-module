<?php namespace Anomaly\DocumentationModule;

use Anomaly\DocumentationModule\Plugin\CodeTokenParser;
use Anomaly\Streams\Platform\Addon\Plugin\Plugin;

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
     * Get the token parsers.
     *
     * @return array
     */
    public function getTokenParsers()
    {
        return [
            new CodeTokenParser()
        ];
    }

    /**
     * Get the functions.
     *
     * @return array
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction(
                'code',
                function ($language, $code) {
                    return '<code class="language-' . $language . '">' . $code . '</code>';
                },
                [
                    'is_safe' => ['html']
                ]
            )
        ];
    }
}
