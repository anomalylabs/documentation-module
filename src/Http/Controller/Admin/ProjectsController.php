<?php namespace Anomaly\DocumentationModule\Http\Controller\Admin;

use Anomaly\ConfigurationModule\Configuration\Form\ConfigurationFormBuilder;
use Anomaly\DocumentationModule\Documentation\Form\DocumentationFormBuilder;
use Anomaly\DocumentationModule\Project\Contract\ProjectInterface;
use Anomaly\DocumentationModule\Project\Contract\ProjectRepositoryInterface;
use Anomaly\DocumentationModule\Project\Form\ProjectFormBuilder;
use Anomaly\DocumentationModule\Project\ProjectDocumentation;
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
     * @param ProjectFormBuilder       $project
     * @param ConfigurationFormBuilder $configuration
     * @param ExtensionCollection      $extensions
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(
        DocumentationFormBuilder $form,
        ProjectFormBuilder $project,
        ConfigurationFormBuilder $configuration,
        ExtensionCollection $extensions
    ) {
        $project->setDocumentation($extensions->get($this->request->get('documentation')));
        $configuration->setEntry($this->request->get('documentation'));

        $form->addForm('project', $project);
        $form->addForm('configuration', $configuration);

        return $form->render();
    }

    /**
     * Edit an existing entry.
     *
     * @param DocumentationFormBuilder $form
     * @param ProjectRepositoryInterface $projects
     * @param ProjectFormBuilder $project
     * @param ConfigurationFormBuilder $configuration
     * @param                            $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(
        DocumentationFormBuilder $form,
        ProjectRepositoryInterface $projects,
        ProjectFormBuilder $project,
        ConfigurationFormBuilder $configuration,
        $id
    ) {
        /* @var ProjectInterface $entry */
        $entry = $projects->find($id);

        $configuration->setEntry($this->request->get('documentation'));

        $form->addForm('project', $project->setEntry($id));
        $form->addForm(
            'configuration',
            $configuration->setEntry($entry->getDocumentation()->getNamespace())->setScope($entry->getSlug())
        );

        return $form->render();
    }

    /**
     * View a project documentation.
     *
     * @param ProjectRepositoryInterface $projects
     * @param                            $id
     */
    public function view(ProjectRepositoryInterface $projects, ProjectDocumentation $documentation, $id)
    {
        /* @var ProjectInterface $project */
        $project = $projects->find($id);

        $structure = $documentation->structure($project, array_values($project->getVersions())[0]);

        return $this->redirect->to(
            'documentation/' . $project->getSlug() . '/' . array_keys(array_shift($structure)['documentation'])[0]
        );
    }
}
