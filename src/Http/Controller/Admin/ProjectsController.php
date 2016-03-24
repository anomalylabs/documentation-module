<?php namespace Anomaly\DocumentationModule\Http\Controller\Admin;

use Anomaly\DocumentationModule\Project\Form\ProjectFormBuilder;
use Anomaly\DocumentationModule\Project\Table\ProjectTableBuilder;
use Anomaly\Streams\Platform\Addon\Extension\ExtensionCollection;
use Anomaly\Streams\Platform\Http\Controller\AdminController;

/**
 * Class ProjectsController
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\DocumentationModule\Http\Controller\Admin
 */
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
     * Return an ajax modal to choose the source
     * of the documentation to use for creating a new disk.
     *
     * @param ExtensionCollection $extensions
     * @return \Illuminate\View\View
     */
    public function choose(ExtensionCollection $extensions)
    {
        return view(
            'module::ajax/choose_source',
            [
                'sources' => $extensions->search('anomaly.module.documentation::source.*')->enabled()
            ]
        );
    }

    /**
     * Create a new entry.
     *
     * @param ProjectFormBuilder $form
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(ProjectFormBuilder $form, ExtensionCollection $extensions)
    {
        $form->setSource($extensions->get($this->request->get('source')));

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
