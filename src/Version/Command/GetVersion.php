<?php namespace Anomaly\DocumentationModule\Version\Command;

use Anomaly\DocumentationModule\Version\Contract\VersionInterface;
use Anomaly\DocumentationModule\Version\Contract\VersionRepositoryInterface;
use Anomaly\DocumentationModule\Version\VersionPresenter;
use Anomaly\Streams\Platform\Model\EloquentModel;
use Anomaly\Streams\Platform\View\ViewTemplate;


/**
 * Class GetVersion
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class GetVersion
{

    /**
     * The identifier.
     *
     * @var mixed
     */
    protected $identifier;

    /**
     * Create a new GetVersion instance.
     *
     * @param $identifier
     */
    public function __construct($identifier = null)
    {
        $this->identifier = $identifier;
    }

    /**
     * Handle the command.
     *
     * @param  VersionRepositoryInterface $versions
     * @param  ViewTemplate            $template
     * @return VersionInterface|EloquentModel|null
     */
    public function handle(VersionRepositoryInterface $versions, ViewTemplate $template)
    {
        if (is_null($this->identifier)) {
            $this->identifier = $template->get('version');
        }

        if (is_numeric($this->identifier)) {
            return $versions->find($this->identifier);
        }

        if (is_string($this->identifier)) {
            return $versions->findBySlug($this->identifier);
        }

        if ($this->identifier instanceof VersionInterface) {
            return $this->identifier;
        }

        if ($this->identifier instanceof VersionPresenter) {
            return $this->identifier->getObject();
        }

        return null;
    }
}
