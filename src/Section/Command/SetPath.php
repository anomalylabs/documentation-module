<?php namespace Anomaly\DocumentationModule\Section\Command;

use Anomaly\DocumentationModule\Section\Contract\SectionInterface;


/**
 * Class SetPath
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\DocumentationModule\Section\Command
 */
class SetPath
{

    /**
     * The section instance.
     *
     * @var SectionInterface
     */
    protected $section;

    /**
     * Create a new SetPath instance.
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
        if (!$this->section->isEnabled()) {
            $path = 'sections/preview/' . $this->section->getStrId();
        } else {
            if ($parent = $this->section->getParent()) {
                $path = $parent->getPath() . '/' . $this->section->getSlug();
            } else {
                $path = '/' . $this->section->getSlug();
            }
        }

        $this->section->setAttribute('path', $path);
    }
}
