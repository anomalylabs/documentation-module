<?php namespace Anomaly\DocumentationModule\Http\Controller\Admin;

use Anomaly\DocumentationModule\Project\Contract\ProjectInterface;
use Anomaly\DocumentationModule\Project\Contract\ProjectRepositoryInterface;
use Anomaly\DocumentationModule\Version\Form\VersionFormBuilder;
use Anomaly\DocumentationModule\Version\Table\VersionTableBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;

/**
 * Class VersionsController
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\DocumentationModule\Http\Controller\Admin
 */
class VersionsController extends AdminController
{

    /**
     * Display an index of existing entries.
     *
     * @param VersionTableBuilder $table
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(VersionTableBuilder $table)
    {
        return $table->render();
    }

    /**
     * Return a menu to choose the project version.
     *
     * @param ProjectRepositoryInterface $projects
     * @param                            $project
     */
    public function choose(ProjectRepositoryInterface $projects, $project)
    {
        /* @var ProjectInterface $project */
        $project = $projects->find($project);

        return $this->view->make(
            'module::admin/versions/choose',
            [
                'versions' => $project->getVersions()
            ]
        );
    }

    /**
     * Create a new entry.
     *
     * @param VersionFormBuilder $form
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(VersionFormBuilder $form)
    {
        return $form->render();
    }

    /**
     * Edit an existing entry.
     *
     * @param VersionFormBuilder $form
     * @param                    $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(VersionFormBuilder $form, $id)
    {
        return $form->render($id);
    }
}
