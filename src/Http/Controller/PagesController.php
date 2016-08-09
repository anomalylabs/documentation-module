<?php namespace Anomaly\DocumentationModule\Http\Controller;

use Anomaly\DocumentationModule\Page\Contract\PageRepositoryInterface;
use Anomaly\DocumentationModule\Project\Contract\ProjectRepositoryInterface;
use Anomaly\DocumentationModule\Version\Contract\VersionRepositoryInterface;
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

    public function view(
        ProjectRepositoryInterface $projects,
        VersionRepositoryInterface $versions,
        PageRepositoryInterface $pages,
        $project,
        $version = null,
        $path = null
    ) {
        $project = $projects->findBySlug($project);

        if (!$version) {

            $version = $project->getLatestVersion();

            return $this->redirect->to('documentation/' . $project->getSlug() . '/' . $version->getName());
        }

        $version = $versions->findBySlug($version);

        if (!$path) {

            $version = $project->getLatestVersion();
            $page    = $version->getHomePage();

            return $this->redirect->to(
                'documentation/' . $project->getSlug() . '/' . $version->getName() . $page->getPath()
            );
        }

        $pages = $version->getPages();

        dd($pages->findByPath($path));
    }
}
