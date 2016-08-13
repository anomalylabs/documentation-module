<?php namespace Anomaly\DocumentationModule\Http\Controller;

use Anomaly\DocumentationModule\Page\Command\MakePage;
use Anomaly\DocumentationModule\Page\Contract\PageRepositoryInterface;
use Anomaly\DocumentationModule\Project\Contract\ProjectInterface;
use Anomaly\DocumentationModule\Project\Contract\ProjectRepositoryInterface;
use Anomaly\Streams\Platform\Http\Controller\PublicController;

/**
 * Class PagesController
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\DocumentationModule\Http\Controller
 */
class PagesController extends PublicController
{

    /**
     * @param ProjectRepositoryInterface $projects
     * @param PageRepositoryInterface    $pages
     * @return \Illuminate\Http\RedirectResponse
     */
    public function view(ProjectRepositoryInterface $projects, PageRepositoryInterface $pages)
    {
        /* @var ProjectInterface $project */
        $project = $projects->findBySlug($this->route->parameter('project'));

        $version = $project->getVersion($this->route->parameter('version'));

        $page = $pages->findByVersionAndPath($version, $this->route->parameter('path'));

        $this->dispatch(new MakePage($page));

        return $page->getResponse();
    }
}
