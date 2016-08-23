<?php namespace Anomaly\DocumentationModule\Http\Controller;

use Anomaly\DocumentationModule\Version\Contract\VersionRepositoryInterface;
use Anomaly\Streams\Platform\Http\Controller\PublicController;

/**
 * Class VersionsController
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\DocumentationModule\Http\Controller
 */
class VersionsController extends PublicController
{

    /**
     * Redirect to the version's home page.
     *
     * @param VersionRepositoryInterface $versions
     * @return \Illuminate\Http\RedirectResponse
     */
    public function view(VersionRepositoryInterface $versions)
    {
        if (!$version = $versions->findBySlug($this->route->getParameter('name'))) {
            abort(404);
        }

        $page = $version->getHomePage();

        return $this->redirect->to($page->route('view'));
    }
}
