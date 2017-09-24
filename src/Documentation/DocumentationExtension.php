<?php namespace Anomaly\DocumentationModule\Documentation;

use Anomaly\DocumentationModule\Project\Contract\ProjectInterface;
use Anomaly\Streams\Platform\Addon\Extension\Extension;

/**
 * Class DocumentationExtension
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
abstract class DocumentationExtension extends Extension
{

    /**
     * Return the documentation structure object.
     *
     * @param ProjectInterface $project
     * @param                  $reference
     * @return array
     */
    abstract public function structure(ProjectInterface $project, $reference);

    /**
     * Return the composer json object.
     *
     * @param ProjectInterface $project
     * @param                  $reference
     * @return \stdClass
     */
    abstract public function composer(ProjectInterface $project, $reference);

    /**
     * Return the page content for a project.
     *
     * @param ProjectInterface $project
     * @param                  $reference
     * @param                  $page
     * @return string
     */
    abstract public function content(ProjectInterface $project, $reference, $page);
}
