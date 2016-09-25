<?php namespace Anomaly\DocumentationModule\Section\Command;

use Anomaly\DocumentationModule\Section\Contract\SectionInterface;


/**
 * Class SetStrId
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\DocumentationModule\Section\Command
 */
class SetStrId
{

    /**
     * The section instance.
     *
     * @var SectionInterface
     */
    protected $section;

    /**
     * Create a new SetStrId instance.
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
        if (!$this->section->getStrId()) {
            $this->section->str_id = str_random(24);
        }
    }
}
