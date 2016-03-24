<?php namespace Anomaly\DocumentationModule\Source\Contract;

/**
 * Interface SourceInterface
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\DocumentationModule\Source\Contract
 */
interface SourceInterface
{

    /**
     * Return the file's content.
     *
     * @param $section
     * @param $file
     * @return string
     */
    public function content($section, $file);
}
