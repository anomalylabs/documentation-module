<?php namespace Anomaly\DocumentationModule\Project;

use Anomaly\DocumentationModule\Project\Contract\ProjectInterface;
use Anomaly\Streams\Platform\Entry\EntryPresenter;

/**
 * Class ProjectPresenter
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\DocumentationModule\Project
 */
class ProjectPresenter extends EntryPresenter
{

    /**
     * The project instance.
     *
     * @var ProjectInterface
     */
    protected $object;

    /**
     * Return the status.
     *
     * @return string
     */
    public function status()
    {
        return $this->object->isEnabled() ? 'live' : 'draft';
    }

    /**
     * Return the status label.
     *
     * @return string
     */
    public function statusLabel()
    {
        if ($this->object->isEnabled()) {
            return $this->label(trans('anomaly.module.documentation::message.live'), 'success');
        } else {
            return $this->label(trans('anomaly.module.documentation::message.draft'));
        }
    }
}
