<?php namespace Anomaly\DocumentationModule\Project;

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
    public function __construct(Cache $cache, Config $config)
    {
        $this->cache  = $cache;
        $this->config = $config;
    }

    /**
     * Return the documentation composer object.
     *
     * @param ProjectInterface $project
     * @param                  $version
     * @return \stdClass
     */
    public function structure(ProjectInterface $project, $version)
    {
        $documentation = $project->getDocumentation();

        if ($this->config->get('app.debug')) {
            return $documentation->structure($project, $version);
        }

        return $this->cache->remember(
            $documentation->getNamespace($project->getSlug() . '.structure'),
            $this->config->get('anomaly.module.documentation::config.cache', 0),
            function () use ($documentation, $project, $version) {
                return $documentation->structure($project, $version);
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
            $documentation->getNamespace($project->getSlug() . '.composer'),
            $this->config->get('anomaly.module.documentation::config.cache', 0),
            function () use ($documentation, $project, $version) {
                return $documentation->composer($project, $version);
            }
        );
    }

    /**
     * Return the documentation file content.
     *
     * @param ProjectInterface $project
     * @param                  $version
     * @param                  $file
     * @return string
     */
    public function content(ProjectInterface $project, $version, $file)
    {
        $documentation = $project->getDocumentation();

        if ($this->config->get('app.debug')) {
            return $documentation->content($project, $version, $file);
        }

        return $this->cache->remember(
            $documentation->getNamespace($project->getSlug() . '.content'),
            $this->config->get('anomaly.module.documentation::config.cache', 0),
            function () use ($documentation, $project, $version, $file) {
                return $documentation->content($project, $version, $file);
            }
        );
    }
}
