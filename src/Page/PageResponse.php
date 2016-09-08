<?php namespace Anomaly\DocumentationModule\Page;

use Anomaly\DocumentationModule\Page\Contract\PageInterface;
use Illuminate\Routing\ResponseFactory;

/**
 * Class PageResponse
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\DocumentationModule\Page
 */
class PageResponse
{

    /**
     * The response factory.
     *
     * @var ResponseFactory
     */
    protected $container;

    /**
     * Create a new PageResponse instance.
     *
     * @param ResponseFactory $response
     */
    function __construct(ResponseFactory $response)
    {
        $this->response = $response;
    }

    /**
     * Make the page response.
     *
     * @param PageInterface $page
     */
    public function make(PageInterface $page)
    {
        if (!$page->getResponse()) {
            $page->setResponse(
                $this->response->view(
                    'anomaly.module.documentation::pages/view',
                    [
                        'page'    => $page,
                        'project' => $page->getProject(),
                        'version' => $page->getVersion(),
                        'content' => $page->getContent(),
                    ]
                )
            );
        }
    }
}
