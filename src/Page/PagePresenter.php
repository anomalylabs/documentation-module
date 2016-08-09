<?php namespace Anomaly\DocumentationModule\Page;

use Anomaly\DocumentationModule\Page\Contract\PageInterface;
use Anomaly\Streams\Platform\Entry\EntryPresenter;

/**
 * Class PagePresenter
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\DocumentationModule\Page
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
                        'pages',
                        $this->object->getVersion()->getId(),
                        'edit',
                        $this->object->getId()
                    ]
                )
            )
        );
    }

}
