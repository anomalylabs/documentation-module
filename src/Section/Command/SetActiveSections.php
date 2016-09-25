<?php namespace Anomaly\DocumentationModule\Section\Command;

use Anomaly\DocumentationModule\Section\Contract\SectionInterface;
use Anomaly\DocumentationModule\Section\SectionCollection;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class SetActiveSections
 *
 * @section          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class SetActiveSections
{

    use DispatchesJobs;

    /**
     * The section collection.
     *
     * @var SectionCollection
     */
    protected $sections;

    /**
     * Create a new SetActiveSections instance.
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
    public function handle()
    {
        if (!$current = $this->sections->current()) {
            return;
        }

        if (!$current->getParentId()) {
            return;
        }

        /* @var SectionInterface $section */
        foreach ($this->sections as $section) {

            /*
             * Already flagged.
             */
            if ($section->isActive() || $section->isCurrent()) {
                continue;
            }

            /*
             * Set active if the direct
             * parent of current section.
             */
            if ($section->getId() == $current->getParentId()) {
                $section->setActive(true);
            }

            /*
             * If the active section is in the children
             * of this section then mark it active too.
             */
            if (!$this->sections->children($section)->active()->isEmpty()) {

                $section->setActive(true);

                $this->dispatch(new SetActiveSections($this->sections));
            }
        }
    }
}
