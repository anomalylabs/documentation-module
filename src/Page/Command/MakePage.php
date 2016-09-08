<?php namespace Anomaly\DocumentationModule\Page\Command;

use Anomaly\DocumentationModule\Page\Contract\PageInterface;
use Anomaly\DocumentationModule\Page\PageAuthorizer;
use Anomaly\DocumentationModule\Page\PageBreadcrumb;
use Anomaly\DocumentationModule\Page\PageContent;
use Anomaly\DocumentationModule\Page\PageLoader;
use Anomaly\DocumentationModule\Page\PageResponse;


/**
 * Class MakePage
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\DocumentationModule\Page\Command
 */
class MakePage
{

    /**
     * The page instance.
     *
     * @var PageInterface
     */
    protected $page;

    /**
     * Create a new MakePage instance.
     *
     * @param PageInterface $page
     */
    public function __construct(PageInterface $page)
    {
        $this->page = $page;
    }

    /**
     * Handle the command.
     *
     * @param PageLoader     $loader
     * @param PageContent    $content
     * @param PageResponse   $response
     * @param PageAuthorizer $authorizer
     * @param PageBreadcrumb $breadcrumb
     */
    public function handle(
        PageLoader $loader,
        PageContent $content,
        PageResponse $response,
        PageAuthorizer $authorizer,
        PageBreadcrumb $breadcrumb
    ) {
        $authorizer->authorize($this->page);
        $breadcrumb->make($this->page);
        $loader->load($this->page);

        $content->make($this->page);
        $response->make($this->page);
    }
}
