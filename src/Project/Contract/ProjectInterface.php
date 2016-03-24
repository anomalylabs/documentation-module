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
     * Get the slug.
     *
     * @return string
     */
    public function getSlug();

    /**
     * Get the documentation.
     *
     * @return Extension|DocumentationInterface
     */
    public function getDocumentation();
}
