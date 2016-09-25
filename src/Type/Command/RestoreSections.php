<?php namespace Anomaly\DocumentationModule\Type\Command;

use Anomaly\DocumentationModule\Section\Contract\SectionRepositoryInterface;
use Anomaly\DocumentationModule\Type\Contract\TypeInterface;


/**
 * Class RestoreSections
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\DocumentationModule\Type\Command
 */
class RestoreSections
{

    /**
     * The product type instance.
     *
     * @var TypeInterface
     */
    protected $type;

    /**
     * Create a new RestoreSections instance.
     *
     * @param TypeInterface $type
     */
    public function __construct(TypeInterface $type)
    {
        $this->type = $type;
    }

    /**
     * Handle the command.
     *
     * @param SectionRepositoryInterface $sections
     */
    public function handle(SectionRepositoryInterface $sections)
    {
        foreach ($this->type->sections()->onlyTrashed()->get() as $section) {
            $sections->restore($section);
        }
    }
}
