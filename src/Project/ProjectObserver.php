<?php namespace Anomaly\DocumentationModule\Project;

use Anomaly\DocumentationModule\Project\Command\SetStrId;
use Anomaly\DocumentationModule\Project\Contract\ProjectInterface;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Entry\EntryObserver;

/**
 * Class ProjectObserver
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class ProjectObserver extends EntryObserver
{

    /**
     * Fired before saving the entry.
     *
     * @param EntryInterface|ProjectInterface $entry
     */
    public function saving(EntryInterface $entry)
    {
        $this->dispatch(new SetStrid($entry));

        parent::saving($entry);
    }
}
