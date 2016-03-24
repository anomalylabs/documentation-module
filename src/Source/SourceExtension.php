<?php namespace Anomaly\DocumentationModule\Source;

use Anomaly\DocumentationModule\Source\Contract\SourceInterface;
use Anomaly\Streams\Platform\Addon\Extension\Extension;

/**
 * Class SourceExtension
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\DocumentationModule\Source
 */
class SourceExtension extends Extension implements SourceInterface
{

    /**
     * Return the file's content.
     *
     * @param $section
     * @param $file
     * @return string
     */
    public function content($section, $file)
    {
        throw new \Exception('You must implement the [content] method.');
    }
}
