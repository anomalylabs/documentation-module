<?php namespace Anomaly\DocumentationModule\Http\Controller\Admin;

use Anomaly\ConfigurationModule\Configuration\Form\ConfigurationFormBuilder;
use Anomaly\DocumentationModule\Project\Form\ProjectFormBuilder;
use Anomaly\DocumentationModule\Project\Table\ProjectTableBuilder;
use Anomaly\DocumentationModule\Documentation\Form\DocumentationFormBuilder;
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
     * Return an ajax modal to choose the documentation
     * of the documentation to use for creating a new disk.
     *
     * @param ExtensionCollection $extensions
     * @return \Illuminate\View\View
     */
    public function choose(ExtensionCollection $extensions)
    {
        return view(
            'module::ajax/choose_documentation',
            [
                'documentations' => $extensions->search('anomaly.module.documentation::documentation.*')->enabled()
            ]
        );
    }

    /**
     * Create a new entry.
     *
     * @param DocumentationFormBuilder $form
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(DocumentationFormBuilder $form, ProjectFormBuilder $project, ConfigurationFormBuilder $configuration, ExtensionCollection $extensions)
    {
        $project->setDocumentation($extensions->get($this->request->get('documentation')));
        $configuration->setEntry($this->request->get('documentation'));

        $form->addForm('project', $project);
        $form->addForm('configuration', $configuration);

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
