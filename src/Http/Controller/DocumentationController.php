<?php namespace Anomaly\DocumentationModule\Http\Controller;

use Anomaly\DocumentationModule\Project\Contract\ProjectRepositoryInterface;
use Anomaly\DocumentationModule\Project\ProjectDocumentation;
use Anomaly\Streams\Platform\Http\Controller\PublicController;
use Anomaly\Streams\Platform\Support\Template;
use Michelf\Markdown;

/**
 * Class DocumentationController
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\DocumentationModule\Http\Controller
 */
class DocumentationController extends PublicController
{

    /**
     * View a documentation page.
     *
     * @param ProjectRepositoryInterface $projects
     * @param ProjectDocumentation       $documentation
     * @param Template                   $template
     * @param Markdown                   $markdown
     * @param                            $project
     * @param                            $version
     * @param null                       $page
     * @return \Illuminate\Contracts\View\View|mixed
     */
    public function view(
        ProjectRepositoryInterface $projects,
        ProjectDocumentation $documentation,
        Template $template,
        Markdown $markdown,
        $project,
        $version,
        $page = null
    ) {
        $project = $projects->findBySlug($project);

        /**
         * Get the version based on the page presence.
         */
        $version = $page ? $version : $page;

        /**
         * Determine the page.
         */
        $page = $this->request->segment(4, $this->request->segment(3));

        /**
         * Get the real reference from
         * the version or default to master.
         */

        $reference = $project->reference($version);

        /**
         * Grab all of the information, structure and
         * page content for this project / doc we need.
         */
        try {
            $content = $documentation->content($project, $reference, $page ?: $version);
        } catch (\RuntimeException $e) {
            return $this->redirect->to('documentation/' . $project->getSlug());
        }

        $structure = $documentation->structure($project, $reference);
        $composer  = $documentation->composer($project, $reference);
        $page      = $documentation->page($project, $reference);

        /**
         * Add our meta information.
         */
        $this->template->set('project', $project);
        $this->template->set('meta_title', $project->getName());
        $this->template->set('documentation', compact('structure', 'content'));
        $this->breadcrumbs->add('anomaly.module.documentation::breadcrumb.documentation', 'documentation');
        $this->breadcrumbs->add($project->getName(), 'documentation/' . $project->getSlug());
        $this->breadcrumbs->add($page->title, $this->request->fullUrl());

        /**
         * Get the content of the doc
         * and parse / render it.
         */
        $content = $markdown->transform($template->render($content, compact('project', 'composer')));

        return $this->view->make(
            'anomaly.module.documentation::documentation/view',
            compact(
                'project',
                'composer',
                'structure',
                'content',
                'page'
            )
        );
    }
}
