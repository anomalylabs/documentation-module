<?php namespace Anomaly\DocumentationModule\Http\Controller;

use Anomaly\DocumentationModule\Documentation\DocumentationInput;
use Anomaly\DocumentationModule\Project\Contract\ProjectRepositoryInterface;
use Anomaly\DocumentationModule\Project\ProjectDocumentation;
use Anomaly\Streams\Platform\Http\Controller\PublicController;
use Anomaly\Streams\Platform\Support\Authorizer;
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
     * Render a documentation page.
     *
     * @param ProjectRepositoryInterface   $projects
     * @param ProjectDocumentation         $documentation
     * @param DocumentationInput           $input
     * @param Authorizer                   $authorizer
     * @param Template                     $template
     * @param Markdown                     $markdown
     * @param                              $project
     * @param                              $version
     * @param                              $page
     * @return \Illuminate\Contracts\View\View|mixed|object
     */
    public function view(
        ProjectRepositoryInterface $projects,
        ProjectDocumentation $documentation,
        DocumentationInput $input,
        Authorizer $authorizer,
        Template $template,
        Markdown $markdown,
        $project,
        $version,
        $page = null
    ) {
        $project = $projects->findBySlug($project);

        if (!$authorizer->authorize('anomaly.module.users::*')) {
            abort(404);
        }

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
        $composer  = $documentation->composer($project, $reference);
        $structure = $documentation->structure($project, $reference);
        $content   = $documentation->content($project, $reference, $page ?: $version);
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
        $content = $template->render($markdown->transform($content), compact('project', 'composer'));

        return $this->view->make(
            'anomaly.module.documentation::documentation/view',
            compact(
                'project',
                'composer',
                'structure',
                'content'
            )
        );
    }
}
