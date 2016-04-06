<?php namespace Anomaly\DocumentationModule\Project;

use Anomaly\DocumentationModule\Documentation\DocumentationInput;
use Anomaly\DocumentationModule\Project\Contract\ProjectInterface;
use Illuminate\Contracts\Cache\Repository as Cache;
use Illuminate\Contracts\Config\Repository as Config;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class ProjectDocumentation
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\DocumentationModule\Project
 */
class ProjectDocumentation
{

    use DispatchesJobs;

    /**
     * The documentation input reader.
     *
     * @var DocumentationInput
     */
    protected $input;

    /**
     * The cache repository.
     *
     * @var Cache
     */
    protected $cache;

    /**
     * The config repository.
     *
     * @var Config
     */
    protected $config;

    /**
     * Create a new ProjectDocumentation instance.
     *
     * @param Cache  $cache
     * @param Config $config
     */
    public function __construct(DocumentationInput $input, Cache $cache, Config $config)
    {
        $this->input  = $input;
        $this->cache  = $cache;
        $this->config = $config;
    }

    /**
     * Return the current page composer object.
     *
     * @param ProjectInterface $project
     * @param                  $version
     * @return \stdClass|null
     */
    public function page(ProjectInterface $project, $version)
    {
        $structure = $this->structure($project, $version);

        foreach ($structure as $section) {
            foreach ($section['pages'] as $page) {
                if (array_get($page, 'current')) {
                    return (object)$page;
                }
            }
        }

        return null;
    }

    /**
     * Return the documentation composer object.
     *
     * @param ProjectInterface $project
     * @param                  $version
     * @return array
     */
    public function structure(ProjectInterface $project, $version)
    {
        $documentation = $project->getDocumentation();

        if ($this->config->get('app.debug')) {
            return $this->input->read($documentation->structure($project, $version));
        }

        return $this->cache->remember(
            $documentation->getNamespace($project->getSlug() . '.structure.' . $version),
            $this->config->get('anomaly.module.documentation::config.cache', 60),
            function () use ($documentation, $project, $version) {
                return $this->input->read($documentation->structure($project, $version));
            }
        );
    }

    /**
     * Return the composer json object.
     *
     * @param ProjectInterface $project
     * @param                  $version
     * @return \stdClass
     */
    public function composer(ProjectInterface $project, $version)
    {
        $documentation = $project->getDocumentation();

        if ($this->config->get('app.debug')) {
            return $documentation->composer($project, $version);
        }

        return $this->cache->remember(
            $documentation->getNamespace($project->getSlug() . '.composer.' . $version),
            $this->config->get('anomaly.module.documentation::config.cache', 60),
            function () use ($documentation, $project, $version) {
                return $documentation->composer($project, $version);
            }
        );
    }

    /**
     * Return the documentation page content.
     *
     * @param ProjectInterface $project
     * @param                  $version
     * @param                  $page
     * @return string
     */
    public function content(ProjectInterface $project, $version, $page)
    {
        $documentation = $project->getDocumentation();

        if ($this->config->get('app.debug')) {
            return $documentation->content($project, $version, $page);
        }

        return $this->cache->remember(
            $documentation->getNamespace($project->getSlug() . '.content.' . $page),
            $this->config->get('anomaly.module.documentation::config.cache', 60),
            function () use ($documentation, $project, $version, $page) {
                return $documentation->content($project, $version, $page);
            }
        );
    }
}
