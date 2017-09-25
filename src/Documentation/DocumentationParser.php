<?php namespace Anomaly\DocumentationModule\Documentation;

use Symfony\Component\Yaml\Yaml;

/**
 * Class DocumentationParser
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class DocumentationParser
{

    /**
     * The YAML parser.
     *
     * @var Yaml
     */
    protected $yaml;

    /**
     * Create a new DocumentationParser instance.
     *
     * @param Yaml $yaml
     */
    public function __construct(Yaml $yaml)
    {
        $this->yaml = $yaml;
    }

    /**
     * Parse the content's front matter attributes.
     *
     * @param $content
     * @return array
     */
    public function attributes($content)
    {
        if (!preg_match('/^-{3}(?:\n|\r)(.+?)-{3}(.*)$/ms', $content, $pieces)) {
            return [];
        }

        return $this->yaml->parse($pieces[1]);
    }

    /**
     * Remove the content's front matter attributes.
     *
     * @param $content
     * @return string
     */
    public function content($content)
    {
        return ltrim(preg_replace('~^[-]{3}[\r\n|\n]+(.*)[\r\n|\n]+[-]{3}~s', '', $content, 1));
    }
}
