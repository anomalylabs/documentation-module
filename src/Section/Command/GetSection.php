<?php namespace Anomaly\DocumentationModule\Section\Command;

use Anomaly\DocumentationModule\Section\Contract\SectionInterface;
use Anomaly\DocumentationModule\Section\Contract\SectionRepositoryInterface;
use Anomaly\DocumentationModule\Section\SectionPresenter;
use Anomaly\Streams\Platform\Model\EloquentModel;
use Anomaly\Streams\Platform\View\ViewTemplate;


/**
 * Class GetSection
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class GetSection
{

    /**
     * The identifier.
     *
     * @var mixed
     */
    protected $identifier;

    /**
     * Create a new GetSection instance.
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
     * @param  SectionRepositoryInterface $sections
     * @param  ViewTemplate            $template
     * @return SectionInterface|EloquentModel|null
     */
    public function handle(SectionRepositoryInterface $sections, ViewTemplate $template)
    {
        if (is_null($this->identifier)) {
            $this->identifier = $template->get('section');
        }

        if (is_numeric($this->identifier)) {
            return $sections->find($this->identifier);
        }

        if (is_string($this->identifier)) {
            return $sections->findByVersionAndPath($template->get('version'), $this->identifier);
        }

        if ($this->identifier instanceof SectionInterface) {
            return $this->identifier;
        }

        if ($this->identifier instanceof SectionPresenter) {
            return $this->identifier->getObject();
        }

        return null;
    }
}
