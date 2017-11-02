<?php namespace Anomaly\DocumentationModule\Page\Contract;

use Anomaly\DocumentationModule\Project\Contract\ProjectInterface;
use Anomaly\Streams\Platform\Entry\Contract\EntryRepositoryInterface;

/**
 * Interface PageRepositoryInterface
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
interface PageRepositoryInterface extends EntryRepositoryInterface
{

    /**
     * Find a page by it's source information.
     *
     * @param ProjectInterface $project
     * @param                  $reference
     * @param                  $path
     * @return PageInterface|null
     */
    public function findByIdentifiers(ProjectInterface $project, $reference, $path);

}
