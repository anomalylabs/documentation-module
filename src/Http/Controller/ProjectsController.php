<?php namespace Anomaly\DocumentationModule\Http\Controller;

use Anomaly\DocumentationModule\Project\Contract\ProjectRepositoryInterface;
use Anomaly\Streams\Platform\Http\Controller\PublicController;

/**
 * Class ProjectsController
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\DocumentationModule\Http\Controller
 */
class ProjectsController extends PublicController
{

    /**
     * Return the home page of a project.
     *
     * @param ProjectRepositoryInterface $projects
     * @return string
     */
    public function view(ProjectRepositoryInterface $projects)
    {
        if (!$project = $projects->findBySlug($this->route->getParameter('slug'))) {
            abort(404);
        }

        if (!$latest = $project->getLatestVersion()) {
            abort(404);
        }

        if (!$home = $latest->getHomePage()) {
            abort(404);
        }

        return $this->redirect->to($home->route('view'));
    }
}
