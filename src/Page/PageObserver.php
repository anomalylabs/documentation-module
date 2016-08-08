<?php namespace Anomaly\DocumentationModule\Page;

use Anomaly\DocumentationModule\Page\Command\SetPath;
use Anomaly\DocumentationModule\Page\Command\SetStrId;
use Anomaly\DocumentationModule\Page\Command\UpdatePaths;
use Anomaly\DocumentationModule\Page\Contract\PageInterface;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Entry\EntryModel;
use Anomaly\Streams\Platform\Entry\EntryObserver;

/**
 * Class PageObserver
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\DocumentationModule\Page
 */
class PageObserver extends EntryObserver
{

    /**
     * Fired before saving the page.
     *
     * @param EntryInterface|PageInterface|EntryModel $entry
     */
    public function saving(EntryInterface $entry)
    {
        $this->dispatch(new SetStrid($entry));
        $this->dispatch(new SetPath($entry));

        parent::saving($entry);
    }

    /**
     * Fired after saving the page.
     *
     * @param EntryInterface|PageInterface|EntryModel $entry
     */
    public function saved(EntryInterface $entry)
    {
        $this->dispatch(new UpdatePaths($entry));

        parent::saved($entry);
    }

    /**
     * Fired after a page is deleted.
     *
     * @param EntryInterface|PageInterface $entry
     */
    /*public function deleted(EntryInterface $entry)
    {
        $this->dispatch(new DeleteChildren($entry));
        $this->dispatch(new DeleteEntry($entry));

        parent::deleted($entry);
    }*/
}
