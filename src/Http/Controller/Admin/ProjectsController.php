<?php

namespace Anomaly\DocumentationModule\Http\Controller\Admin;

use Anomaly\ConfigurationModule\Configuration\Form\ConfigurationFormBuilder;
use Anomaly\DocumentationModule\Documentation\DocumentationExtension;
use Anomaly\DocumentationModule\Project\Contract\ProjectInterface;
use Anomaly\DocumentationModule\Project\Contract\ProjectRepositoryInterface;
use Anomaly\DocumentationModule\Project\Form\ProjectConfigurationFormBuilder;
use Anomaly\DocumentationModule\Project\Form\ProjectFormBuilder;
use Anomaly\DocumentationModule\Project\Table\ProjectTableBuilder;
use Anomaly\Streams\Platform\Addon\Extension\ExtensionCollection;
use Anomaly\Streams\Platform\Console\Kernel;
use Anomaly\Streams\Platform\Http\Controller\AdminController;

/**
 * Class ProjectsController
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
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
     * Return documentation source options.
     *
     * @return \Illuminate\View\View
     */
    public function choose(ExtensionCollection $extensions)
    {
        return view(
            'module::admin/projects/choose',
            [
                'extensions' => $extensions
                    ->search('anomaly.module.documentation::documentation.*')
                    ->enabled(),
            ]
        );
    }

    /**
     * Create a new entry.
     *
     * @param ProjectConfigurationFormBuilder $builder
     * @param ProjectFormBuilder $project
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(
        ExtensionCollection $extensions,
        ProjectConfigurationFormBuilder $builder,
        ProjectFormBuilder $project
    ) {
        /* @var DocumentationExtension $extension */
        $extension = $extensions->get($this->request->get('documentation'));

        $builder->addForm('project', $project);
        $builder->addForm('configuration', $configuration);

        $project->setDocumentation($extension);
        $configuration->setEntry($extension->getNamespace());

        $project->on(
            'saved',
            function () use ($configuration, $extension, $project) {
                $configuration->setScope($project->getFormEntryId());
            }
        );

        return $builder->render();
    }

    /**
     * Edit an existing entry.
     *
     * @param ExtensionCollection $extensions
     * @param ProjectConfigurationFormBuilder $builder
     * @param ConfigurationFormBuilder $configuration
     * @param ProjectFormBuilder $project
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(
        ExtensionCollection $extensions,
        ProjectConfigurationFormBuilder $builder,
        ConfigurationFormBuilder $configuration,
        ProjectFormBuilder $project,
        $id
    ) {
        $builder->addForm('project', $project->setEntry($id));
        $builder->addForm('configuration', $configuration);

        $project->on(
            'built',
            function () use ($configuration, $project) {

                $entry = $project->getFormEntry();

                $configuration
                    ->setEntry($entry->documentation->getNamespace())
                    ->setScope($entry->getId());
            }
        );

        return $builder->render();
    }

    /**
     * Redirect to the view for a project.
     *
     * @param ProjectRepositoryInterface $projects
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function view(ProjectRepositoryInterface $projects, $id)
    {
        /* @var ProjectInterface $project */
        $project = $projects->find($id);

        return $this->redirect->route(
            'anomaly.module.documentation::projects.view',
            [
                'project' => $project->getSlug(),
            ]
        );
    }

    /**
     * Sync the project.
     *
     * @param ProjectRepositoryInterface $projects
     * @param Kernel $artisan
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sync(ProjectRepositoryInterface $projects, Kernel $artisan, $id)
    {
        /* @var ProjectInterface $project */
        $project = $projects->find($id);

        try {

            $artisan->call(
                'documentation:sync',
                [
                    'project' => $project->getSlug(),
                ]
            );

            $this->messages->success(
                trans(
                    'anomaly.module.documentation::message.sync_success',
                    ['name' => $project->getName()]
                )
            );
        } catch (\Exception $exception) {
            $this->messages->error($exception->getMessage());
        }

        return $this->redirect->back();
    }
}
