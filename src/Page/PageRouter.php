<?php namespace Anomaly\DocumentationModule\Page;

use Anomaly\DocumentationModule\Page\Contract\PageInterface;
use Anomaly\Streams\Platform\Entry\EntryRouter;

/**
 * Class PageRouter
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\DocumentationModule\Page
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
     * Return the view path.
     *
     * @return mixed|null|string
     */
    public function view()
    {
        $version = $this->entry->getVersion();
        $project = $this->entry->getProject();

        $variables = [
            'project' => $project->getSlug(),
            'version' => $version->getName(),
            'path'    => ltrim($this->entry->getPath(), '/'),
        ];

        return $this->url->make('anomaly.module.documentation::pages.view', $variables);
    }
}
