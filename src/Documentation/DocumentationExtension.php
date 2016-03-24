<?php namespace Anomaly\DocumentationModule\Documentation;

use Anomaly\DocumentationModule\Documentation\Contract\DocumentationInterface;
use Anomaly\DocumentationModule\Project\Contract\ProjectInterface;
use Anomaly\Streams\Platform\Addon\Extension\Extension;

/**
 * Class DocumentationExtension
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\DocumentationModule\Documentation
 */
class DocumentationExtension extends Extension implements DocumentationInterface
{

    /**
     * Return the documentation structure object.
     *
     * @param ProjectInterface $project
     * @param                  $reference
     * @return object
     */
    public function structure(ProjectInterface $project, $reference)
    {
        throw new \Exception('You must implement the [structure] method.');
    }

    /**
     * Return the composer json object.
     *
     * @param ProjectInterface $project
     * @param                  $reference
     * @return object
     */
    public function composer(ProjectInterface $project, $reference)
    {
        throw new \Exception('You must implement the [composer] method.');
    }

    /**
     * Return the file content for a project.
     *
     * @param ProjectInterface $project
     * @param                  $reference
     * @param                  $file
     * @return string
     */
    public function content(ProjectInterface $project, $reference, $file)
    {
        throw new \Exception('You must implement the [content] method.');
    }
}
