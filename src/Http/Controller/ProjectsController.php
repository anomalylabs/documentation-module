<?php namespace Anomaly\DocumentationModule\Http\Controller;

use Anomaly\DocumentationModule\Project\Contract\ProjectRepositoryInterface;
use Anomaly\GithubDocumentationExtension\GithubDocumentationExtension;
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

    public function file(GithubDocumentationExtension $extension, ProjectRepositoryInterface $projects, Template $template, Markdown $markdown, $project, $section, $file)
    {
        $project = $projects->findBySlug($project);

        $content = $markdown->transform(base64_decode($extension->content($section, $file)['content']));

        $content = $template->render($content);

        return $this->view->make('anomaly.module.documentation::file', compact('project', 'content'));
    }
}
