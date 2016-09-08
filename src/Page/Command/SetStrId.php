<?php namespace Anomaly\DocumentationModule\Page\Command;

use Anomaly\DocumentationModule\Page\Contract\PageInterface;


/**
 * Class SetStrId
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\DocumentationModule\Page\Command
 */
class SetStrId
{

    /**
     * The page instance.
     *
     * @var PageInterface
     */
    protected $page;

    /**
     * Create a new SetStrId instance.
     *
     * @param PageInterface $page
     */
    public function __construct(PageInterface $page)
    {
        $this->page = $page;
    }

    /**
     * Handle the command.
     */
    public function handle()
    {
        if (!$this->page->getStrId()) {
            $this->page->str_id = str_random(24);
        }
    }
}
