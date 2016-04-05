<?php namespace Anomaly\DocumentationModule\Documentation;

use Illuminate\Contracts\Config\Repository;

/**
 * Class DocumentationNormalizer
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\DocumentationModule\Project
 */
class DocumentationNormalizer
{

    /**
     * The config repository.
     *
     * @var Repository
     */
    protected $config;

    /**
     * Create a new DocumentationNormalizer instance.
     *
     * @param Repository $config
     */
    public function __construct(Repository $config)
    {
        $this->config = $config;
    }

    /**
     * Translate the project structure.
     *
     * @param array $structure
     * @return array
     */
    public function normalize(array $structure)
    {
        $fallback = $this->config->get('app.fallback_locale');

        foreach ($structure as &$section) {

            if (!is_array($section['title'])) {
                $section['title'] = [
                    $fallback => $section['title']
                ];
            }

            foreach ($section['pages'] as &$page) {

                if (is_string($page)) {
                    $page = [
                        'title' => $page
                    ];
                }

                if (is_string($page['title'])) {
                    $page['title'] = [
                        $fallback => $page['title']
                    ];
                }
            }
        }

        return $structure;
    }
}
