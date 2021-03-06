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
     * @param PageRepositoryInterface $pages
     * @param                            $project
     * @param null $version
     * @param null $path
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

        if ($reference == 'latest') {
            $reference = $project->getDefaultReference();
        }

        if (!$reference) {
            abort(404);
        }

        $this->breadcrumbs->add($project->getTitle(), $project->route('view'));

        /**
         * Try and locate the page now
         * that we have all the identifiers.
         */
        if (!$page = $pages->findByIdentifiers($project, $reference, '/' . $path)) {

            $parts = explode('/', $path);

            while ($parts) {

                if ($page = $pages->findByIdentifiers($project, $reference, '/' . implode('/', $parts))) {
                    return redirect($page->route('view'));
                }

                array_pop($parts);
            }

            $page = $pages->findByIdentifiers($project, $reference);
        }

        /**
         * If the page can't be found then 404.
         */
        if (!$page) {
            abort(404);
        }

        /**
         * If the page is a redirect
         * then return the redirect.
         */
        if ($redirect = $page->getData('redirect')) {

            $hint = $pages->findByIdentifiers($project, $reference, '/' . $redirect);

            return $this->redirect->to($hint ? $hint->route('view') : $redirect);
        }

        /**
         * Setup the SEO
         */
        $this->template->set('meta_title', $page->getData('meta_title', $page->getTitle()));

        $this->breadcrumbs->add($page->getTitle(), $page->route('view'));

        /**
         * Get the next and previous pages
         * to stash for later if desired.
         */
        $next     = $pages->next($page);
        $previous = $pages->previous($page);

        /**
         * Save the relevant pages for
         * accessing later if needed.
         */
        $this->template->set('page', $page);
        $this->template->set('next', $next);
        $this->template->set('project', $project);
        $this->template->set('previous', $previous);
        $this->template->set('reference', $reference);

        return $this->view->make(
            'anomaly.module.documentation::pages/view',
            compact(
                'reference',
                'previous',
                'project',
                'page',
                'next'
            )
        );
    }
}
