<?php namespace Anomaly\DocumentationModule\Http\Controller\Admin;

use Anomaly\DocumentationModule\Project\Contract\ProjectRepositoryInterface;
use Anomaly\DocumentationModule\Project\Form\ProjectFormBuilder;
use Anomaly\DocumentationModule\Project\Table\ProjectTableBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;

class ProjectsController extends AdminController
{

    /**
     * Display an index of existing entries.
     *
     * @param ProjectTableBuilder $table
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(ProjectTableBuilder $table)
    {
        return $table->render();
    }

    /**
     * Return a selection of projects.
     *
     * @param ProjectRepositoryInterface $projects
     * @return \Illuminate\View\View
     */
    public function choose(ProjectRepositoryInterface $projects)
    {
        return $this->view->make(
            'module::admin/projects/choose',
            [
                'projects' => $projects->all()
            ]
        );
    }

    /**
     * Create a new entry.
     *
     * @param ProjectFormBuilder $form
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(ProjectFormBuilder $form)
    {
        return $form->render();
    }

    /**
     * Edit an existing entry.
     *
     * @param ProjectFormBuilder $form
     * @param                    $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(ProjectFormBuilder $form, $id)
    {
        return $form->render($id);
    }
}
