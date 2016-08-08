<?php namespace Anomaly\DocumentationModule\Type\Command;

use Anomaly\DocumentationModule\Page\Contract\PageRepositoryInterface;
use Anomaly\DocumentationModule\Product\Contract\ProductRepositoryInterface;
use Anomaly\DocumentationModule\Type\Contract\TypeInterface;
use Illuminate\Contracts\Bus\SelfHandling;

/**
 * Class DeletePages
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\DocumentationModule\Type\Command
 */
class DeletePages implements SelfHandling
{

    /**
     * The product type instance.
     *
     * @var TypeInterface
     */
    protected $type;

    /**
     * Create a new DeletePages instance.
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
     * @param PageRepositoryInterface $pages
     */
    public function handle(PageRepositoryInterface $pages)
    {
        foreach ($this->type->getPages() as $page) {
            $pages->delete($page);
        }
    }
}
