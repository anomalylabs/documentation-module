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
     * @param                  $reference
     * @return \stdClass
     */
    public function structure(ProjectInterface $project, $reference);

    /**
     * Return the composer json object.
     *
     * @param ProjectInterface $project
     * @param                  $reference
     * @return array
     */
    public function composer(ProjectInterface $project, $reference);

    /**
     * Return the page content for a project.
     *
     * @param ProjectInterface $project
     * @param                  $reference
     * @param                  $page
     * @return string
     */
    public function content(ProjectInterface $project, $reference, $page);
}
