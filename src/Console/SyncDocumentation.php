<?php namespace Anomaly\DocumentationModule\Console;

use Anomaly\DocumentationModule\Page\Contract\PageInterface;
use Anomaly\DocumentationModule\Page\Contract\PageRepositoryInterface;
use Anomaly\DocumentationModule\Project\Contract\ProjectInterface;
use Anomaly\DocumentationModule\Project\Contract\ProjectRepositoryInterface;
use Anomaly\Streams\Platform\Model\EloquentModel;
use Illuminate\Bus\Queueable;
use Illuminate\Console\Command;
use Illuminate\Contracts\Queue\ShouldQueue;
use Symfony\Component\Console\Input\InputArgument;

/**
 * Class SyncDocumentation
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class SyncDocumentation extends Command implements ShouldQueue
{

    use Queueable;

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
     * @param PageRepositoryInterface $pages
     */
    public function handle(ProjectRepositoryInterface $projects, PageRepositoryInterface $pages)
    {
        $projects = $projects->all();

        /**
         * Limit to the desired project
         * if we've had one passed along.
         */
        if ($this->argument('project')) {
            $projects = $projects->filter(
                function (ProjectInterface $project) {
                    return $project->getSlug() == $this->argument('project');
                }
            );
        }

        /* @var ProjectInterface $project */
        foreach ($projects as $project) {

            $documentation = $project->documentation();

            $references = $project->getReferences();

            /**
             * Limit to the desired reference
             * if we've had one passed along.
             */
            if ($this->argument('reference')) {
                $references = array_filter(
                    $references,
                    function ($value) {
                        return $value == $this->argument('reference');
                    }
                );
            }

            foreach ($references as $reference) {

                $locales = $documentation->locales($reference);

                $trash = $project
                    ->getPages($reference)
                    ->keyBy('id');

                foreach ($locales as $locale) {

                    $structure = $documentation->structure($reference, $locale);

                    foreach ($structure as $index => $path) {

                        try {
                            $attributes = $documentation->page($reference, $locale, $path);
                        } catch (\Exception $exception) {

                            $this->error(
                                $project->getSlug() . '/' . $reference . '/' . $locale . $path
                                . ' - ' . $exception->getMessage()
                            );

                            continue;
                        }

                        /**
                         * First see if we can find out page by
                         * identifying attributes. If no page
                         * is found then spin up a new one.
                         */
                        if (!$page = $pages->findByIdentifiers($project, $reference, $attributes['path'])) {
                            $page = $pages->newInstance();
                        }

                        /**
                         * Order the directories.
                         */
                        if (str_is('/*/01.index', $path)) {

                            $segments = array_filter(explode('/', $path));

                            array_pop($segments); // Remove trailing index.

                            $parent = array_pop($segments);

                            $parts = explode('.', $parent);

                            array_set($attributes, 'sort_order', (int)array_shift($parts) + 1);
                        }

                        /**
                         * Update our page with the attributes
                         * from the documentation source.
                         */
                        $page->fill(
                            [
                                $locale      => [
                                    'data'             => array_pull($attributes, 'data'),
                                    'title'            => array_pull($attributes, 'title'),
                                    'meta_title'       => array_pull($attributes, 'meta_title'),
                                    'meta_description' => array_pull($attributes, 'meta_description'),
                                ],
                                'path'       => array_pull($attributes, 'path'),
                                'content'    => array_pull($attributes, 'content'),
                                'sort_order' => array_pull($attributes, 'sort_order'),
                                'reference'  => $reference,
                                'project'    => $project,
                            ]
                        );

                        /**
                         * Check and see if the parent already
                         * exists in the system and associate it.
                         *
                         * @var PageInterface $parent
                         */
                        if (dirname($page->getPath()) !== '/' && $parent = $pages->findByIdentifiers(
                                $project,
                                $reference,
                                dirname($page->getPath())
                            )
                        ) {
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
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['project', InputArgument::OPTIONAL, 'The projects\'s stream slug.'],
            ['reference', InputArgument::OPTIONAL, 'The projects\'s reference.'],
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
