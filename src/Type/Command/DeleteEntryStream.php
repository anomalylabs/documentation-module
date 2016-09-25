<?php namespace Anomaly\DocumentationModule\Type\Command;

use Anomaly\DocumentationModule\Type\Contract\TypeInterface;
use Anomaly\Streams\Platform\Stream\Contract\StreamRepositoryInterface;


/**
 * Class DeleteEntryStream
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\DocumentationModule\Type\Command
 */
class DeleteEntryStream
{

    /**
     * The product type instance.
     *
     * @var TypeInterface
     */
    protected $type;

    /**
     * Create a new DeleteEntryStream instance.
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
     * @param StreamRepositoryInterface $streams
     */
    public function handle(StreamRepositoryInterface $streams)
    {
        if (!$this->type->isForceDeleting()) {
            return;
        }

        $streams->delete($streams->findBySlugAndNamespace($this->type->getSlug() . '_sections', 'documentation'));
    }
}
