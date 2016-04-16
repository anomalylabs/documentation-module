<?php namespace Anomaly\DocumentationModule\Http\Controller;

use Anomaly\DocumentationModule\Project\Contract\ProjectInterface;
use Anomaly\DocumentationModule\Project\Contract\ProjectRepositoryInterface;
use Anomaly\DocumentationModule\Project\ProjectDocumentation;
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
     * Return an index of projects.
     *
     * @param ProjectRepositoryInterface $projects
     */
    public function index(ProjectRepositoryInterface $projects)
    {
        $projects = $projects->enabled();

        $this->template->set('meta_title', trans('anomaly.module.documentation::breadcrumb.documentation'));
        $this->breadcrumbs->add('anomaly.module.documentation::breadcrumb.documentation', $this->request->fullUrl());

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

        $structure = $documentation->structure($project, array_get(array_values($project->getVersions()), 0));

        return $this->redirect->to(
            'documentation/' . $project->getSlug() . '/' . ($project->getHome() ?: array_keys(
                array_shift($structure)['pages']
            )[0])
        );
    }
}
