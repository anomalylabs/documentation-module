<?php namespace Anomaly\DocumentationModule\Section\Command;

use Anomaly\DocumentationModule\Section\Contract\SectionInterface;
use Anomaly\DocumentationModule\Section\SectionCollection;
use Anomaly\Streams\Platform\Model\EloquentModel;


/**
 * Class SetChildrenRelations
 *
 * @section          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class SetChildrenRelations
{

    /**
     * The section collection.
     *
     * @var SectionCollection
     */
    protected $sections;

    /**
     * Create a new SetChildrenRelations instance.
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
            $section->setRelation('children', $this->sections->children($section));
        }
    }
}
