<?php namespace Anomaly\DocumentationModule\Documentation\Contract;

use Anomaly\DocumentationModule\Project\Contract\ProjectInterface;

/**
 * Interface DocumentationInterface
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\DocumentationModule\Documentation\Contract
 */
interface DocumentationInterface
{

    /**
     * Return the documentation structure object.
     *
     * @param ProjectInterface $project
     * @param                  $version
     * @return \stdClass
     */
    public function structure(ProjectInterface $project, $version);

    /**
     * Return the composer json object.
     *
     * @param ProjectInterface $project
     * @param                  $version
     * @return \stdClass
     */
    public function composer(ProjectInterface $project, $version);

    /**
     * Return the file content for a project.
     *
     * @param ProjectInterface $project
     * @param                  $version
     * @param                  $file
     * @return string
     */
    public function content(ProjectInterface $project, $version, $file);
}
