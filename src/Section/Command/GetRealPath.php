<?php namespace Anomaly\DocumentationModule\Section\Command;

use Anomaly\DocumentationModule\Section\Contract\SectionInterface;


/**
 * Class GetRealPath
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class GetRealPath
{

    /**
     * The section instance.
     *
     * @var SectionInterface
     */
    protected $section;

    /**
     * Create a new GetRealPath instance.
     *
     * @param SectionInterface $section
     */
    public function __construct(SectionInterface $section)
    {
        $this->section = $section;
    }

    /**
     * Handle the command.
     */
    public function handle()
    {
        if ($parent = $this->section->getParent()) {
            if ($parent->isHome()) {
                return $parent->getSlug() . '/' . $this->section->getSlug();
            } else {
                return $parent->getPath() . '/' . $this->section->getSlug();
            }
        } else {
            return $this->section->getSlug();
        }
    }
}
