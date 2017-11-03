<?php namespace Anomaly\DocumentationModule\Http\Controller;

use Anomaly\DocumentationModule\Command\AddDocumentationBreadcrumb;
use Anomaly\DocumentationModule\Page\Contract\PageRepositoryInterface;
use Anomaly\DocumentationModule\Project\Contract\ProjectRepositoryInterface;
use Anomaly\Streams\Platform\Http\Controller\PublicController;

/**
 * Class PagesController
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class PagesController extends PublicController
{

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

        if ($reference == 'latest') {
            return $this->redirect->to($project->route('view') . '/' . $project->getDefaultReference() . '/' . $path);
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

        $next     = $pages->next($page);
        $previous = $pages->previous($page);

        /**
         * Save the relevant pages for
         * accessing later if needed.
         */
        $this->template->set('page', $page);
        $this->template->set('next', $next);
        $this->template->set('previous', $previous);

        return $this->view->make(
            'anomaly.module.documentation::projects/view',
            compact(
                'previous',
                'project',
                'version',
                'page',
                'next'
            )
        );
    }
}
