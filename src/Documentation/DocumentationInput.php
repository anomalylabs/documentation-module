<?php namespace Anomaly\DocumentationModule\Documentation;

/**
 * Class DocumentationInput
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\DocumentationModule\Project
 */
class DocumentationInput
{

    /**
     * The documentation guesser.
     *
     * @var DocumentationGuesser
     */
    protected $guesser;

    /**
     * The documentation normalizer.
     *
     * @var DocumentationNormalizer
     */
    protected $normalizer;

    /**
     * The documentation translator.
     *
     * @var DocumentationTranslator
     */
    protected $translator;

    /**
     * Create a new DocumentationInput instance.
     *
     * @param DocumentationGuesser    $guesser
     * @param DocumentationNormalizer $normalizer
     * @param DocumentationTranslator $translator
     */
    public function __construct(
        DocumentationGuesser $guesser,
        DocumentationNormalizer $normalizer,
        DocumentationTranslator $translator
    ) {
        $this->guesser    = $guesser;
        $this->normalizer = $normalizer;
        $this->translator = $translator;
    }

    /**
     * Read the project structure.
     *
     * @param array $structure
     * @return array
     */
    public function read(array $structure)
    {
        $structure = $this->normalizer->normalize($structure);
        $structure = $this->translator->translate($structure);
        $structure = $this->guesser->guess($structure);

        return $structure;
    }
}
