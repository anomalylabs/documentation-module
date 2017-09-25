<?php namespace Anomaly\DocumentationModule\Http\Controller;

use Anomaly\DocumentationModule\Command\AddDocumentationBreadcrumb;
use Anomaly\DocumentationModule\Command\SetDocumentationMetaTitle;
use Anomaly\DocumentationModule\Documentation\DocumentationProcessor;
use Anomaly\DocumentationModule\Project\Contract\ProjectRepositoryInterface;
use Anomaly\Streams\Platform\Http\Controller\PublicController;
use Illuminate\Contracts\Config\Repository;
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
     * @param DocumentationProcessor     $processor
     * @param Repository                 $config
     * @param                            $project
     * @param null                       $version
     * @param null                       $path
     * @return string
     * @internal param null $page
     */
    public function view(
        ProjectRepositoryInterface $projects,
        DocumentationProcessor $processor,
        Repository $config,
        $project,
        $version = null,
        $path = null
    ) {
        $version = $version ?: 'latest';

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

        if ($version == 'latest') {
            $version = $project->getDefaultVersion();
        }

        if (!$version) {
            abort(404);
        }

        $this->template->put('version', $version);

        $pages = $processor->process(
            $project
                ->documentation()
                ->pages($version)
        );

        $path = $path ?: 'index';

        $locale   = $config->get('app.locale');
        $fallback = $config->get('app.fallback_locale');

        $match = str_replace('/', '.', $path);
        $index = str_replace('/', '.', $path) . '.index';

        /**
         * Try and get the content in
         * the current local first.
         */
        if (!$page = array_get($pages, $locale . '.' . $index)) {
            $page = array_get($pages, $locale . '.' . $match);
        }

        /**
         * If content is empty then try
         * getting the content in the
         * fallback locale.
         */
        if (!$page && !$page = array_get($pages, $fallback . '.' . $index)) {
            $page = array_get($pages, $fallback . '.' . $match);
        }

        /**
         * We must be lost if
         * there is no page.
         */
        if ($page === null) {
            abort(404);
        }

        return $this->view->make(
            'anomaly.module.documentation::projects/view',
            compact('project', 'version', 'pages', 'page')
        );
    }
}
