<?php namespace Anomaly\DocumentationModule\Project\Contract;

use Anomaly\DocumentationModule\Documentation\Contract\DocumentationInterface;
use Anomaly\Streams\Platform\Addon\Extension\Extension;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;

/**
 * Interface ProjectInterface
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\DocumentationModule\Project\Contract
 */
interface ProjectInterface extends EntryInterface
{

    /**
     * Return the reference for a version.
     *
     * @param        $version
     * @return string
     */
    public function reference($version);

    /**
     * Get the slug.
     *
     * @return string
     */
    public function getSlug();

    /**
     * Get the name.
     *
     * @return string
     */
    public function getName();

    /**
     * Get the enabled flag.
     *
     * @return bool
     */
    public function isEnabled();

    /**
     * Get the versions.
     *
     * @return array
     */
    public function getVersions();

    /**
     * Get the documentation.
     *
     * @return Extension|DocumentationInterface
     */
    public function getDocumentation();
}
