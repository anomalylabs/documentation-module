<?php namespace Anomaly\DocumentationModule\Page;

use Anomaly\DocumentationModule\Page\Contract\PageInterface;
use Anomaly\Streams\Platform\Entry\EntryRouter;

/**
 * Class PageRouter
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class PageRouter extends EntryRouter
{

    /**
     * The router entry.
     *
     * @var PageInterface
     */
    protected $entry;

    /**
     * Return the view route.
     */
    public function view()
    {
        $project = $this->entry->getProject();

        if (request()->route()->parameter('reference') == 'latest' && $project->getDefaultReference() == $this->entry->getReference()) {
            $array['reference'] = 'latest';
        }

        parent::make('anomaly.module.documentation::pages.view');
    }
}
