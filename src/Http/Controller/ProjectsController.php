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
    public function latest(ProjectRepositoryInterface $projects)
    {
        if (!$project = $projects->findBySlug($this->route->parameter('slug'))) {
            abort(404);
        }

        if (!$latest = $project->getLatestVersion()) {
            abort(404);
        }

        return $this->redirect->to($project->route('latest'));
    }

    /**
     * Return the project documentation for a version.
     *
     * @param  ProjectRepositoryInterface $projects
     * @return string
     */
    public function view(ProjectRepositoryInterface $projects)
    {
        $project = $this->route->parameter('project', $this->route->parameter('slug'));

        if (!$project = $projects->findBySlug($project)) {
            abort(404);
        }

        $category = $project->getCategory();

        $this->dispatch(new AddDocumentationBreadcrumb());

        if ($category) {
            $this->breadcrumbs->add($category->getTitle(), $category->route('view'));
        }

        $this->template->set('meta_title', $project->getTitle());
        $this->breadcrumbs->add($project->getTitle(), $this->request->path());

        $versions = $project->getVersions();

        $version = $versions->findByName($this->route->parameter('name', 'latest'));

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
