<?php namespace Anomaly\DocumentationModule\Documentation\Guesser;

use Illuminate\Routing\Route;

/**
 * Class CurrentGuesser
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\DocumentationModule\Documentation\Guesser
 */
class CurrentGuesser
{

    /**
     * The route object.
     *
     * @var Route
     */
    protected $route;

    /**
     * Create a new DocumentationInput instance.
     *
     * @param Route $route
     */
    public function __construct(Route $route)
    {
        $this->route = $route;
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

        foreach ($structure as &$section) {
            foreach ($section['pages'] as $page => &$documentation) {
                $documentation['current'] = ($current == $page);
            }
        }

        return $structure;
    }
}
