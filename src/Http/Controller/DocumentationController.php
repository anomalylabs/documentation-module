<?php namespace Anomaly\DocumentationModule\Http\Controller;

use Anomaly\DocumentationModule\Documentation\DocumentationReader;
use Anomaly\DocumentationModule\Documentation\DocumentationTranslator;
use Anomaly\DocumentationModule\Project\Contract\ProjectRepositoryInterface;
use Anomaly\DocumentationModule\Project\ProjectDocumentation;
use Anomaly\DocumentationModule\Project\ProjectTranslator;
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
     * @param ProjectTranslator            $translator
     * @param Template                     $template
     * @param Markdown                     $markdown
     * @param                              $project
     * @param                              $version
     * @param                              $page
     * @return \Illuminate\Contracts\View\View|mixed|object
     * @internal param GithubDocumentationExtension $extension
     */
    public function view(
        ProjectRepositoryInterface $projects,
        ProjectDocumentation $documentation,
        DocumentationTranslator $translator,
        DocumentationReader $reader,
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
         * Get the real reference from
         * the version or default to master.
         */
        $reference = $page ? $project->reference($version) : array_values($project->getVersions())[0];

        /**
         * Grab all of the information, structure and
         * page content for this project / doc we need.
         */
        $composer  = $documentation->composer($project, $reference);
        $structure = $documentation->structure($project, $reference);
        $content   = $documentation->content($project, $reference, basename($page ?: $version));

        /**
         * Read the structure input
         * and prepare it for the view.
         */
        $structure = $translator->translate($structure);
        $structure = $reader->read($structure);

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