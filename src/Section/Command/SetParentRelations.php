<?php namespace Anomaly\DocumentationModule\Section\Command;

use Anomaly\DocumentationModule\Section\Contract\SectionInterface;
use Anomaly\DocumentationModule\Section\SectionCollection;
use Anomaly\Streams\Platform\Model\EloquentModel;


/**
 * Class SetParentRelations
 *
 * @section          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class SetParentRelations
{

    /**
     * The section collection.
     *
     * @var SectionCollection
     */
    protected $sections;

    /**
     * Create a new SetParentRelations instance.
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
        /* @var SectionInterface|EloquentModel $section */
        foreach ($this->sections as $section) {

            /* @var SectionInterface $parent */
            if (($id = $section->getParentId()) && $parent = $this->sections->find($id)) {
                $section->setRelation('parent', $parent);
            }
        }
    }
}
