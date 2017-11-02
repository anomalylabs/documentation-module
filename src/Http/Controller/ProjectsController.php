<?php namespace Anomaly\DocumentationModule\Http\Controller;

use Anomaly\DocumentationModule\Command\AddDocumentationBreadcrumb;
use Anomaly\DocumentationModule\Command\SetDocumentationMetaTitle;
use Anomaly\DocumentationModule\Documentation\DocumentationStructure;
use Anomaly\DocumentationModule\Page\Contract\PageRepositoryInterface;
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
     * @param                             $slug
     * @return string
     */
    public function latest(ProjectRepositoryInterface $projects, $slug)
    {
        if (!$project = $projects->findBySlug($slug)) {
            abort(404);
        }

        return $this->redirect->to($project->route('latest'));
    }

    /**
     * Return the project documentation for a version.
     *
     * @param ProjectRepositoryInterface $projects
     * @param PageRepositoryInterface    $pages
     * @param                            $project
     * @param null                       $version
     * @param null                       $path
     * @return string
     */
    public function view(
        ProjectRepositoryInterface $projects,
        PageRepositoryInterface $pages,
        $project,
        $reference = null,
        $path = null
    ) {
        $reference = $reference ?: 'latest';

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

        if ($reference == 'latest') {
            $reference = $project->getDefaultReference();
        }

        if (!$reference) {
            abort(404);
        }

        /**
         * Try and locate the page now
         * that we have all the identifiers.
         */
        if (!$page = $pages->findByIdentifiers($project, $reference, '/' . $path)) {
            abort(404);
        }

        /**
         * Set the current page to
         * access later if needed.
         */
        $this->template->set('page', $page);

        return $this->view->make(
            'anomaly.module.documentation::projects/view',
            compact(
                'project',
                'version',
                'page'
            )
        );
    }
}
