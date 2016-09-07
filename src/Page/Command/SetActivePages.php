<?php namespace Anomaly\DocumentationModule\Page\Command;

use Anomaly\DocumentationModule\Page\Contract\PageInterface;
use Anomaly\DocumentationModule\Page\PageCollection;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class SetActivePages
 *
 * @page          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class SetActivePages
{

    use DispatchesJobs;

    /**
     * The page collection.
     *
     * @var PageCollection
     */
    protected $pages;

    /**
     * Create a new SetActivePages instance.
     *
     * @param PageCollection $pages
     */
    public function __construct(PageCollection $pages)
    {
        $this->pages = $pages;
    }

    /**
     * Handle the command.
     */
    public function handle()
    {
        if (!$current = $this->pages->current()) {
            return;
        }

        if (!$current->getParentId()) {
            return;
        }

        /* @var PageInterface $page */
        foreach ($this->pages as $page) {

            /*
             * Already flagged.
             */
            if ($page->isActive() || $page->isCurrent()) {
                continue;
            }

            /*
             * Set active if the direct
             * parent of current page.
             */
            if ($page->getId() == $current->getParentId()) {
                $page->setActive(true);
            }

            /*
             * If the active page is in the children
             * of this page then mark it active too.
             */
            if (!$this->pages->children($page)->active()->isEmpty()) {

                $page->setActive(true);

                $this->dispatch(new SetActivePages($this->pages));
            }
        }
    }
}
