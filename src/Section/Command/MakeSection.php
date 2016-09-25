<?php namespace Anomaly\DocumentationModule\Section\Command;

use Anomaly\DocumentationModule\Section\Contract\SectionInterface;
use Anomaly\DocumentationModule\Section\SectionContent;


/**
 * Class MakeSection
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\DocumentationModule\Section\Command
 */
class MakeSection
{

    /**
     * The section instance.
     *
     * @var SectionInterface
     */
    protected $section;

    /**
     * Create a new MakeSection instance.
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
     * @param SectionContent $content
     */
    public function handle(SectionContent $content)
    {
        $content->make($this->section);

        return $this->section;
    }
}
