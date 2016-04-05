<?php namespace Anomaly\DocumentationModule\Documentation\Guesser;

use Illuminate\Http\Request;
use Illuminate\Routing\Route;

class CurrentGuesser
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
     * Create a new DocumentationInput instance.
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
    public function guess(array $structure)
    {
        $parameters = $this->route->parameters();

        $current = array_pop($parameters);

        foreach ($structure as $slug => &$section) {

            $section['slug'] = $slug;

            foreach ($section['pages'] as $page => &$documentation) {

                $documentation['slug']    = $page;
                $documentation['current'] = ($current == $page);
                $documentation['path']    = '/documentation/' . implode('/', $parameters) . '/' . $page;
            }
        }

        return $structure;
    }
}
