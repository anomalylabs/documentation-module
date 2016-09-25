<?php namespace Anomaly\DocumentationModule\Section\Command;

use Anomaly\DocumentationModule\Section\Contract\SectionInterface;
use Anomaly\DocumentationModule\Section\SectionCollection;
use Anomaly\Streams\Platform\View\ViewTemplate;


/**
 * Class SetCurrentSection
 *
 * @section          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class SetCurrentSection
{

    /**
     * The section collection.
     *
     * @var SectionCollection
     */
    protected $sections;

    /**
     * Create a new SetCurrentSection instance.
     *
     * @param SectionCollection $sections
     */
    public function __construct(SectionCollection $sections)
    {
        $this->sections = $sections;
    }

    /**
     * Handle the command.
     */
    public function handle(ViewTemplate $template)
    {
        /* @var SectionInterface $section */
        if (!$section = $template->get('section')) {
            return;
        }

        /* @var SectionInterface $current */
        if ($current = $this->sections->find($section->getId())) {
            $current->setCurrent(true);
        }
    }
}
