<?php namespace Anomaly\DocumentationModule\Type\Command;

use Anomaly\DocumentationModule\Section\Contract\SectionRepositoryInterface;
use Anomaly\DocumentationModule\Product\Contract\ProductRepositoryInterface;
use Anomaly\DocumentationModule\Type\Contract\TypeInterface;


/**
 * Class DeleteSections
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\DocumentationModule\Type\Command
 */
class DeleteSections
{

    /**
     * The product type instance.
     *
     * @var TypeInterface
     */
    protected $type;

    /**
     * Create a new DeleteSections instance.
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
        foreach ($this->type->getSections() as $section) {
            $sections->delete($section);
        }
    }
}
