<?php namespace Anomaly\DocumentationModule\Section;

use Anomaly\DocumentationModule\Section\Command\SetPath;
use Anomaly\DocumentationModule\Section\Command\SetStrId;
use Anomaly\DocumentationModule\Section\Command\TouchProject;
use Anomaly\DocumentationModule\Section\Command\UpdatePaths;
use Anomaly\DocumentationModule\Section\Contract\SectionInterface;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Entry\EntryModel;
use Anomaly\Streams\Platform\Entry\EntryObserver;

/**
 * Class SectionObserver
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\DocumentationModule\Section
 */
class SectionObserver extends EntryObserver
{

    /**
     * Fired before saving the section.
     *
     * @param EntryInterface|SectionInterface|EntryModel $entry
     */
    public function saving(EntryInterface $entry)
    {
        $this->dispatch(new SetStrid($entry));
        $this->dispatch(new SetPath($entry));

        parent::saving($entry);
    }

    /**
     * Fired after saving the section.
     *
     * @param EntryInterface|SectionInterface|EntryModel $entry
     */
    public function saved(EntryInterface $entry)
    {
        $this->dispatch(new UpdatePaths($entry));
        $this->dispatch(new TouchProject($entry));

        parent::saved($entry);
    }

    /**
     * Fired after a section is deleted.
     *
     * @param EntryInterface|SectionInterface $entry
     */
    /*public function deleted(EntryInterface $entry)
    {
        $this->dispatch(new DeleteChildren($entry));
        $this->dispatch(new DeleteEntry($entry));

        parent::deleted($entry);
    }*/
}
