<?php namespace Anomaly\DocumentationModule\Documentation;

use Anomaly\Streams\Platform\Support\Translator;
use Illuminate\Contracts\Config\Repository;

/**
 * Class DocumentationTranslator
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\DocumentationModule\Project
 */
class DocumentationTranslator
{

    /**
     * The config repository.
     *
     * @var Repository
     */
    protected $config;

    /**
     * The translation utility.
     *
     * @var Translator
     */
    protected $translator;

    /**
     * Create a new DocumentationTranslator instance.
     *
     * @param Repository $config
     * @param Translator $translator
     */
    public function __construct(Repository $config, Translator $translator)
    {
        $this->config     = $config;
        $this->translator = $translator;
    }

    /**
     * Translate the project structure.
     *
     * @param array $structure
     * @return array
     */
    public function translate(array $structure)
    {
        $locale   = $this->config->get('app.locale');
        $fallback = $this->config->get('app.fallback_locale');

        foreach ($structure as &$section) {

            if (isset($section['title'][$locale])) {
                $section['title'] = $section['title'][$locale];
            } else {
                $section['title'] = $section['title'][$fallback];
            }

            foreach ($section['documentation'] as &$documentation) {
                if (isset($documentation['title'][$locale])) {
                    $documentation['title'] = $documentation['title'][$locale];
                } else {
                    $documentation['title'] = $documentation['title'][$fallback];
                }
            }
        }

        return $structure;
    }
}
