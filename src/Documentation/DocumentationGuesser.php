<?php namespace Anomaly\DocumentationModule\Documentation;

use Anomaly\DocumentationModule\Documentation\Guesser\CurrentGuesser;
use Anomaly\DocumentationModule\Documentation\Guesser\PathGuesser;

/**
 * Class DocumentationGuesser
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\DocumentationModule\Project
 */
class DocumentationGuesser
{

    /**
     * The path guesser.
     *
     * @var PathGuesser
     */
    protected $path;

    /**
     * The current flag guesser.
     *
     * @var CurrentGuesser
     */
    protected $current;

    /**
     * Create a new DocumentationGuesser instance.
     *
     * @param PathGuesser    $path
     * @param CurrentGuesser $current
     */
    public function __construct(PathGuesser $path, CurrentGuesser $current)
    {
        $this->path    = $path;
        $this->current = $current;
    }

    /**
     * Guess the structure properties.
     *
     * @param array $structure
     * @return array
     */
    public function guess(array $structure)
    {
        $structure = $this->path->guess($structure);
        $structure = $this->current->guess($structure);

        return $structure;
    }
}
