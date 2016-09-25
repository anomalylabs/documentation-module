<?php namespace Anomaly\DocumentationModule\Section\Command;

use Anomaly\DocumentationModule\Section\Contract\SectionInterface;
use Anomaly\DocumentationModule\Section\Contract\SectionRepositoryInterface;


/**
 * Class UpdatePaths
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\DocumentationModule\Section\Command
 */
class UpdatePaths
{

    /**
     * The section instance.
     *
     * @var SectionInterface
     */
    protected $section;

    /**
     * Create a new UpdatePaths instance.
     *
     * @param SectionInterface $section
     */
    public function __construct(SectionInterface $section)
    {
        $this->section = $section;
    }

    /**
     * Handle the command.
     *
     * @param SectionRepositoryInterface $sections
     */
    public function handle(SectionRepositoryInterface $sections)
    {
        foreach ($this->section->getChildren() as $section) {
            if ($section instanceof SectionInterface && $section->isEnabled()) {
                $sections->save($section->setAttribute('path', $this->section->getPath() . '/' . $section->getSlug()));
            }
        }
    }
}
