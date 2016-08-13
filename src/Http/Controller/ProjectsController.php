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
     * @param                            $project
     * @return string
     */
    public function view(ProjectRepositoryInterface $projects, $project)
    {
        if (!$project = $projects->findBySlug($project)) {
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
