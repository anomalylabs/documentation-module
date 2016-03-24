<?php namespace Anomaly\DocumentationModule\Project;

use Anomaly\Streams\Platform\Support\Translator;
use Illuminate\Contracts\Config\Repository;

/**
 * Class ProjectTranslator
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\DocumentationModule\Project
 */
class ProjectTranslator
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
     * Create a new ProjectTranslator instance.
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
     * @param \stdClass $structure
     * @return \stdClass
     */
    public function translate(\stdClass $structure)
    {
        $locale   = $this->config->get('app.locale');
        $fallback = $this->config->get('app.fallback_locale');

        foreach ($structure as &$section) {

            if (isset($section->title->{$locale})) {
                $section->title = $section->title->{$locale};
            } else {
                $section->title = $section->title->{$fallback};
            }

            foreach ($section->documentation as &$documentation) {
                if (isset($documentation->{$locale})) {
                    $documentation = $documentation->{$locale};
                } else {
                    $documentation = $documentation->{$fallback};
                }
            }
        }

        return $structure;
    }
}
