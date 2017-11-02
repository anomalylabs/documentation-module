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

        return (new Yaml())->parse($pieces[1]);
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

    /**
     * Return the resource path
     * without the numbering scheme.
     *
     * @param        $name
     * @param string $separator
     * @return mixed
     */
    public function path($name, $separator = '/')
    {
        $path = str_replace($separator . 'index', '', preg_replace('/([0-9]{2}\.)/', '', $name));

        return $path ?: '/';
    }
}
