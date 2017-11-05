<?php namespace Anomaly\DocumentationModule\Console;

use Anomaly\DocumentationModule\Page\Contract\PageInterface;
use Anomaly\DocumentationModule\Page\Contract\PageRepositoryInterface;
use Anomaly\DocumentationModule\Project\Contract\ProjectInterface;
use Anomaly\DocumentationModule\Project\Contract\ProjectRepositoryInterface;
use Anomaly\Streams\Platform\Model\EloquentModel;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;

/**
 * Class SyncDocumentation
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class SyncDocumentation extends Command
{

    /**
     * The command name.
     *
     * @var string
     */
    protected $name = 'documentation:sync';

    /**
     * Handle the command.
     *
     * @param ProjectRepositoryInterface $projects
     * @param PageRepositoryInterface    $pages
     */
    public function handle(ProjectRepositoryInterface $projects, PageRepositoryInterface $pages)
    {
        /* @var ProjectInterface $project */
        if (!$project = $projects->findBySlug($this->argument('project'))) {

            $this->error('Project [' . $this->argument('project') . '] not found!');

            return;
        }

        $documentation = $project->documentation();

        foreach ($project->getReferences() as $reference) {

            $locales = $documentation->locales($reference);

            $trash = $project
                ->getPages($reference)
                ->keyBy('id');

            foreach ($locales as $locale) {

                $structure = $documentation->structure($reference, $locale);

                foreach ($structure as $order => $path) {

                    $attributes = $documentation->page($reference, $locale, $path);

                    /**
                     * First see if we can find out page by
                     * identifying attributes. If no page
                     * is found then spin up a new one.
                     */
                    if (!$page = $pages->findByIdentifiers($project, $reference, $attributes['path'])) {
                        $page = $pages->newInstance();
                    }

                    /**
                     * Update our page with the attributes
                     * from the documentation source.
                     */
                    $page->fill(
                        [
                            $locale      => [
                                'title'            => array_pull($attributes, 'title'),
                                'meta_title'       => array_pull($attributes, 'meta_title'),
                                'meta_description' => array_pull($attributes, 'meta_description'),
                            ],
                            'path'       => array_pull($attributes, 'path'),
                            'content'    => array_pull($attributes, 'content'),
                            'data'       => array_pull($attributes, 'data'),
                            'reference'  => $reference,
                            'project'    => $project,
                            'sort_order' => $order + 1,
                        ]
                    );

                    /**
                     * Check and see if the parent already
                     * exists in the system and associate it.
                     *
                     * @var PageInterface $parent
                     */
                    if (dirname($page->getPath()) !== '/' && $parent = $pages->findByPath(dirname($page->getPath()))) {
                        $page->parent = $parent;
                    }

                    $pages->save($page);

                    /**
                     * We're going to trash everything
                     * we don't find or create so
                     * remove this from trash.
                     */
                    $trash->forget($page->getId());

                    /**
                     * Let everyone know
                     * how awesome we are.
                     */
                    $this->info('Synced: ' . $project->getSlug() . '/' . $reference . '/' . $locale . $path);
                }
            }

            /**
             * Empty our trash.
             */
            $trash->each(
                function (PageInterface $page) use ($pages) {

                    /* @var PageInterface|EloquentModel $page */
                    $pages->delete($page);
                }
            );
        }
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['project', InputArgument::REQUIRED, 'The projects\'s stream slug.'],
        ];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            //['pretend', null, InputOption::VALUE_NONE, 'Perform a dry run without deleting.'],
        ];
    }
}
