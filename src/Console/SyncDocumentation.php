<?php namespace Anomaly\DocumentationModule\Console;

use Anomaly\DocumentationModule\Page\Contract\PageInterface;
use Anomaly\DocumentationModule\Page\Contract\PageRepositoryInterface;
use Anomaly\DocumentationModule\Project\Contract\ProjectInterface;
use Anomaly\DocumentationModule\Project\Contract\ProjectRepositoryInterface;
use Illuminate\Console\Command;
use Illuminate\Contracts\Config\Repository;
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
     * @param Repository                 $config
     */
    public function handle(ProjectRepositoryInterface $projects, PageRepositoryInterface $pages, Repository $config)
    {
        /* @var ProjectInterface $project */
        if (!$project = $projects->findBySlug($this->argument('project'))) {

            $this->error('Project [' . $this->argument('project') . '] not found!');

            return;
        }

        $pages->truncate();

        $documentation = $project->documentation();

        foreach ($project->getReferences() as $reference) {
            foreach ($config->get('streams::locales.enabled', []) as $locale) {

                $structure = $documentation->structure($reference, $locale);

                foreach ($structure as $path) {

                    $attributes = $documentation->page($reference, $locale, $path);

                    if (!$page = $pages->findByIdentifiers($project, $reference, $attributes['path'])) {
                        $page = $pages->newInstance();
                    }

                    $page->fill(
                        [
                            $locale     => [
                                'title'            => array_pull($attributes, 'title'),
                                'meta_title'       => array_pull($attributes, 'meta_title'),
                                'meta_description' => array_pull($attributes, 'meta_description'),
                            ],
                            'path'      => array_pull($attributes, 'path'),
                            'content'   => array_pull($attributes, 'content'),
                            'data'      => array_pull($attributes, 'data'),
                            'reference' => $reference,
                            'project'   => $project,
                        ]
                    );

                    /* @var PageInterface $parent */
                    if (dirname($page->getPath()) !== '/' && $parent = $pages->findByPath(dirname($page->getPath()))) {
                        $page->parent = $parent;
                    }

                    $pages->save($page);
                }
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
            ['project', InputArgument::REQUIRED, 'The projects\'s stream slug.'],
        ];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
//    protected function getArguments()
//    {
//        return [
//            ['pretend', null, InputOption::VALUE_NONE, 'Perform a dry run without deleting.'],
//        ];
//    }
}
