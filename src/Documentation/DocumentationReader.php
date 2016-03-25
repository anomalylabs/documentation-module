<?php namespace Anomaly\DocumentationModule\Documentation;

use Illuminate\Http\Request;
use Illuminate\Routing\Route;

/**
 * Class DocumentationReader
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\DocumentationModule\Project
 */
class DocumentationReader
{

    /**
     * The route object.
     *
     * @var Route
     */
    protected $route;

    /**
     * The request object.
     *
     * @var Request
     */
    protected $request;

    /**
     * Create a new DocumentationReader instance.
     *
     * @param Route   $route
     * @param Request $request
     */
    public function __construct(Route $route, Request $request)
    {
        $this->route   = $route;
        $this->request = $request;
    }

    /**
     * Read the project structure.
     *
     * @param array $structure
     * @return array
     */
    public function read(array $structure)
    {
        $parameters = $this->route->parameters();

        $current = array_pop($parameters);

        foreach ($structure as &$section) {
            foreach ($section['documentation'] as $slug => &$documentation) {

                $documentation['current'] = ($current == $slug);

                $documentation['path'] = '/documentation/' . implode('/', $parameters) . '/' . $slug;
            }
        }

        return $structure;
    }
}
