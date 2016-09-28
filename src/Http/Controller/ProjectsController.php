<?php namespace Anomaly\DocumentationModule\Http\Controller;

use Anomaly\DocumentationModule\Command\AddDocumentationBreadcrumb;
use Anomaly\DocumentationModule\Command\SetDocumentationMetaTitle;
use Anomaly\DocumentationModule\Project\Contract\ProjectRepositoryInterface;
use Anomaly\Streams\Platform\Http\Controller\PublicController;
use Illuminate\Http\Response;

/**
 * Class ProjectsController
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class ProjectsController extends PublicController
{

    /**
     * Return an index of existing projects.
     *
     * @return Response
     */
    public function index()
    {
        $this->dispatch(new SetDocumentationMetaTitle());
        $this->dispatch(new AddDocumentationBreadcrumb());

        return $this->view->make('anomaly.module.documentation::projects/index');
    }

    /**
     * Return the home section of a project.
     *
     * @param  ProjectRepositoryInterface $projects
     * @return string
     */
    public function version(ProjectRepositoryInterface $projects)
    {
        if (!$project = $projects->findBySlug($this->route->getParameter('slug'))) {
            abort(404);
        }

        if (!$latest = $project->getLatestVersion()) {
            abort(404);
        }

        return $this->redirect->to($latest->route('view'));
    }

    /**
     * Return the project documentation for a version.
     *
     * @param  ProjectRepositoryInterface $projects
     * @return string
     */
    public function view(ProjectRepositoryInterface $projects)
    {
        if (!$project = $projects->findBySlug($this->route->getParameter('project'))) {
            abort(404);
        }

        $category = $project->getCategory();

        $this->dispatch(new AddDocumentationBreadcrumb());

        if ($category) {
            $this->breadcrumbs->add($category->getTitle(), $category->route('view'));
        }

        $this->breadcrumbs->add($project->getTitle(), $this->request->path());

        $versions = $project->getVersions();

        $version = $versions->findByName($this->route->getParameter('name'));

        if (!$version && !$version = $project->getLatestVersion()) {
            abort(404);
        }

        $this->template->put('version', $version);

        return $this->view->make(
            'anomaly.module.documentation::projects/view',
            compact('project', 'version')
        );
    }
}
