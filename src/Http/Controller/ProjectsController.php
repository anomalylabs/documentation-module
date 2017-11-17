<?php namespace Anomaly\DocumentationModule\Http\Controller;

use Anomaly\DocumentationModule\Command\AddDocumentationBreadcrumb;
use Anomaly\DocumentationModule\Command\SetDocumentationMetaTitle;
use Anomaly\DocumentationModule\Documentation\DocumentationStructure;
use Anomaly\DocumentationModule\Project\Contract\ProjectRepositoryInterface;
use Anomaly\Streams\Platform\Console\Kernel;
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
     * Sync a project by it's string ID.
     *
     * @param ProjectRepositoryInterface $projects
     * @param Kernel                     $artisan
     * @param                            $id
     */
    public function sync(ProjectRepositoryInterface $projects, Kernel $artisan, $id)
    {
        if (!$project = $projects->findByStrId($id)) {
            abort(404);
        }

        $artisan->call(
            'documentation:sync',
            [
                'project' => $project->getSlug(),
            ]
        );
    }
}
