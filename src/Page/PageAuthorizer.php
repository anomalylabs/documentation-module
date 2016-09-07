<?php namespace Anomaly\DocumentationModule\Page;

use Anomaly\DocumentationModule\Page\Contract\PageInterface;
use Anomaly\Streams\Platform\Support\Authorizer;
use Anomaly\UsersModule\User\Contract\UserInterface;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Routing\ResponseFactory;

/**
 * Class PageAuthorizer
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class PageAuthorizer
{

    /**
     * The authorization utility.
     *
     * @var Guard
     */
    protected $guard;

    /**
     * The config repository.
     *
     * @var Repository
     */
    protected $config;

    /**
     * The response factory.
     *
     * @var ResponseFactory
     */
    protected $response;

    /**
     * The authorizer utility.
     *
     * @var Authorizer
     */
    protected $authorizer;

    /**
     * Create a new PageAuthorizer instance.
     *
     * @param Guard           $guard
     * @param Repository      $config
     * @param Authorizer      $authorizer
     * @param ResponseFactory $response
     */
    public function __construct(Guard $guard, Repository $config, Authorizer $authorizer, ResponseFactory $response)
    {
        $this->guard      = $guard;
        $this->config     = $config;
        $this->response   = $response;
        $this->authorizer = $authorizer;
    }

    /**
     * Authorize the page.
     *
     * @param PageInterface $page
     */
    public function authorize(PageInterface $page)
    {
        /* @var UserInterface $user */
        $user = $this->guard->user();

        $project = $page->getProject();

        /*
         * If the project is not enabled and
         * we are not logged in then 404.
         */
        if (!$project->isEnabled() && !$user) {
            abort(404);
        }

        /*
         * If the page is not enabled and we are
         * logged in then make sure we have permission.
         */
        if (!$project->isEnabled() && !$this->authorizer->authorize('anomaly.module.documentation::view_drafts')) {
            abort(403);
        }

        /*
         * If the page is not enabled and we
         * are not logged in then 404.
         */
        if (!$page->isEnabled() && !$user) {
            abort(404);
        }

        /*
         * If the page is not enabled and we are
         * logged in then make sure we have permission.
         */
        if (!$page->isEnabled() && !$this->authorizer->authorize('anomaly.module.documentation::view_drafts')) {
            abort(403);
        }
    }
}
