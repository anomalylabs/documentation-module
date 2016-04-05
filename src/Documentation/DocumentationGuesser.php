<?php namespace Anomaly\DocumentationModule\Documentation;

use Anomaly\DocumentationModule\Documentation\Guesser\CurrentGuesser;

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
     * The current flag guesser.
     *
     * @var CurrentGuesser
     */
    protected $current;

    /**
     * Create a new DocumentationGuesser instance.
     *
     * @param CurrentGuesser $current
     */
    public function __construct(CurrentGuesser $current)
    {
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
        $structure = $this->current->guess($structure);

        return $structure;
    }
}
