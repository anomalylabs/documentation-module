<?php namespace Anomaly\DocumentationModule\Page;

use Anomaly\DocumentationModule\Page\Contract\PageInterface;
use Anomaly\Streams\Platform\Entry\EntryPresenter;

/**
 * Class PagePresenter
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class PagePresenter extends EntryPresenter
{

    /**
     * The decorated object.
     *
     * @var PageInterface
     */
    protected $object;

    /**
     * Route __get to the page's data.
     *
     * @param  string $key
     * @return mixed
     */
    public function __get($key)
    {
        if ($this->object->hasData($key)) {
            return $this->object->getData($key);
        }

        return parent::__get($key);
    }
}
