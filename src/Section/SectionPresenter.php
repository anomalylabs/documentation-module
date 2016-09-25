<?php namespace Anomaly\DocumentationModule\Section;

use Anomaly\DocumentationModule\Section\Contract\SectionInterface;
use Anomaly\Streams\Platform\Entry\EntryPresenter;
use Anomaly\Streams\Platform\Support\Decorator;

/**
 * Class SectionPresenter
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\DocumentationModule\Section
 */
class SectionPresenter extends EntryPresenter
{

    /**
     * The decorated object.
     *
     * @var SectionInterface
     */
    protected $object;

    /**
     * Return the edit URL.
     *
     * @return string
     */
    public function editUrl()
    {
        return url(
            implode(
                '/',
                array_filter(
                    [
                        'admin',
                        'documentation',
                        'sections',
                        $this->object->getVersion()->getId(),
                        'edit',
                        $this->object->getId(),
                    ]
                )
            )
        );
    }

    /**
     * Catch calls to fields on
     * the section's related entry.
     *
     * @param string $key
     * @return mixed
     */
    public function __get($key)
    {
        $entry = $this->object->getEntry();

        if ($entry && $entry->hasField($key)) {
            return (New Decorator())->decorate($entry)->{$key};
        }

        return parent::__get($key);
    }
}
