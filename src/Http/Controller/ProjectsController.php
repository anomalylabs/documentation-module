<?php namespace Anomaly\DocumentationModule\Http\Controller;

use Anomaly\DocumentationModule\Project\Contract\ProjectInterface;
use Anomaly\DocumentationModule\Project\Contract\ProjectRepositoryInterface;
use Anomaly\DocumentationModule\Project\ProjectDocumentation;
use Anomaly\Streams\Platform\Http\Controller\PublicController;
use Anomaly\Streams\Platform\Support\Authorizer;
use Anomaly\Streams\Platform\Support\Template;

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
     * Return an index of projects.
     *
     * @param ProjectRepositoryInterface $projects
     */
    public function index(ProjectRepositoryInterface $projects)
    {
        $projects = $projects->enabled();

        return $this->view->make('anomaly.module.documentation::projects/index', compact('projects'));
    }

    /**
     * View a project documentation.
     *
     * @param ProjectRepositoryInterface $projects
     * @param                            $project
     */
    public function view(ProjectRepositoryInterface $projects, ProjectDocumentation $documentation, $project)
    {
        /* @var ProjectInterface $project */
        $project = $projects->findBySlug($project);

        $structure = $documentation->structure($project, array_values($project->getVersions())[0]);

        return $this->redirect->to(
            'documentation/' . $project->getSlug() . '/' . array_keys(array_shift($structure)['documentation'])[0]
        );
    }
}
