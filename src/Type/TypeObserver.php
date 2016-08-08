<?php namespace Anomaly\DocumentationModule\Type;

use Anomaly\DocumentationModule\Type\Command\CreateEntryStream;
use Anomaly\DocumentationModule\Type\Command\DeleteEntryStream;
use Anomaly\DocumentationModule\Type\Command\DeletePages;
use Anomaly\DocumentationModule\Type\Command\RestorePages;
use Anomaly\DocumentationModule\Type\Contract\TypeInterface;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Entry\EntryObserver;

/**
 * Class TypeObserver
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\DocumentationModule\Type
 */
class TypeObserver extends EntryObserver
{

    /**
     * Fired after a product type is created.
     *
     * @param EntryInterface|TypeInterface $entry
     */
    public function created(EntryInterface $entry)
    {
        $this->commands->dispatch(new CreateEntryStream($entry));

        parent::created($entry);
    }

    /**
     * Fired after a product type is deleted.
     *
     * @param EntryInterface|TypeInterface $entry
     */
    public function deleted(EntryInterface $entry)
    {
        $this->commands->dispatch(new DeletePages($entry));
        $this->commands->dispatch(new DeleteEntryStream($entry));

        parent::deleted($entry);
    }

    /**
     * Fired after a product type is restored.
     *
     * @param EntryInterface|TypeInterface $entry
     */
    public function restored(EntryInterface $entry)
    {
        $this->commands->dispatch(new RestorePages($entry));

        parent::restored($entry);
    }
}
