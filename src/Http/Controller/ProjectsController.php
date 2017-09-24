<?php namespace Anomaly\DocumentationModule\Http\Controller;

use Anomaly\DocumentationModule\Command\AddDocumentationBreadcrumb;
use Anomaly\DocumentationModule\Command\SetDocumentationMetaTitle;
use Anomaly\DocumentationModule\Documentation\DocumentationExtension;
use Anomaly\DocumentationModule\Project\Contract\ProjectRepositoryInterface;
use Anomaly\GithubDocumentationExtension\Command\GetContent;
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
     * @param                             $slug
     * @return string
     */
    public function latest(ProjectRepositoryInterface $projects, $slug)
    {
        if (!$project = $projects->findBySlug($slug)) {
            abort(404);
        }

//        if (!$latest = $project->getLatestVersion()) {
//            abort(404);
//        }

        return $this->redirect->to($project->route('latest'));
    }

    /**
     * Return the project documentation for a version.
     *
     * @param  ProjectRepositoryInterface $projects
     * @return string
     */
    public function view(ProjectRepositoryInterface $projects, $project, $version = null, $page = null)
    {
        $project = $project ?: $version;

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


        /* @var DocumentationExtension $extension */
        $extension = $project->extension;

        if ($version == 'latest') {
            $version = $project->getDefaultVersion();
        }

        if (!$version) {
            abort(404);
        }

        $this->template->put('version', $version);

        $content = $this->dispatch(new GetContent($project, $version, $page));

        return $this->view->make(
            'anomaly.module.documentation::projects/view',
            compact('project', 'version', 'content')
        );
    }
}
