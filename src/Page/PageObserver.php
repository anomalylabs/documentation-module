<?php namespace Anomaly\DocumentationModule\Page;

use Anomaly\DocumentationModule\Page\Command\SetPath;
use Anomaly\DocumentationModule\Page\Contract\PageInterface;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Entry\EntryObserver;

/**
 * Class PageObserver
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class PageObserver extends EntryObserver
{

    /**
     * Fired just before saving.
     *
     * @param EntryInterface|PageInterface $entry
     */
    public function saving(EntryInterface $entry)
    {
        $this->dispatch(new SetPath($entry));

        parent::saving($entry);
    }

}
