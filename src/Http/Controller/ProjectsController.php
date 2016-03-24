<?php namespace Anomaly\DocumentationModule\Http\Controller;

use Anomaly\DocumentationModule\Project\Contract\ProjectRepositoryInterface;
use Anomaly\DocumentationModule\Project\ProjectDocumentation;
use Anomaly\DocumentationModule\Project\ProjectTranslator;
use Anomaly\Streams\Platform\Http\Controller\PublicController;
use Anomaly\Streams\Platform\Support\Template;
use Michelf\Markdown;

/**
 * Class ProjectsController
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\DocumentationModule\Http\Controller
 */
class ProjectsController extends PublicController
{

    /**
     * Render a documentation file.
     *
     * @param ProjectRepositoryInterface   $projects
     * @param ProjectDocumentation         $documentation
     * @param ProjectTranslator            $translator
     * @param Template                     $template
     * @param Markdown                     $markdown
     * @param                              $project
     * @param                              $version
     * @param                              $file
     * @return \Illuminate\Contracts\View\View|mixed|object
     * @internal param GithubDocumentationExtension $extension
     */
    public function file(
        ProjectRepositoryInterface $projects,
        ProjectDocumentation $documentation,
        ProjectTranslator $translator,
        Template $template,
        Markdown $markdown,
        $project,
        $version,
        $file = null
    ) {
        $project = $projects->findBySlug($project);

        $reference = $file ? $project->reference($version) : array_values($project->getVersions())[0];

        $composer  = $documentation->composer($project, $reference);
        $structure = $documentation->structure($project, $reference);
        $content   = $documentation->content($project, $reference, basename($file ?: $version));

        $structure = $translator->translate($structure);
        $content   = $template->render($markdown->transform($content), compact('project', 'composer'));

        return $this->view->make(
            'anomaly.module.documentation::file',
            compact(
                'project',
                'composer',
                'structure',
                'content'
            )
        );
    }
}
