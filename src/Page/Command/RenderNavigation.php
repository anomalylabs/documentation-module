<?php namespace Anomaly\DocumentationModule\Page\Command;

use Anomaly\DocumentationModule\Project\Command\GetProject;
use Anomaly\DocumentationModule\Project\Contract\ProjectInterface;
use Anomaly\Streams\Platform\Support\Collection;
use Anomaly\Streams\Platform\View\ViewTemplate;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class RenderNavigation
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class RenderNavigation
{

    use DispatchesJobs;

    /**
     * The rendering options.
     *
     * @var Collection
     */
    protected $options;

    /**
     * Create a new RenderNavigation instance.
     *
     * @param Collection $options
     */
    public function __construct(Collection $options)
    {
        $this->options = $options;
    }

    /**
     * Handle the command.
     *
     * @param Factory $view
     * @return string
     */
    public function handle(Factory $view, ViewTemplate $template)
    {
        $options = $this->options;

        /* @var ProjectInterface $project */
        $project = $this->dispatch(new GetProject($this->options->get('project')));

        $pages = $project
            ->getPages($template->get('reference'))
            ->keyBy('id');

        $this->dispatch(new SetCurrentPage($pages));
        $this->dispatch(new SetActivePages($pages));

        // After modifying set the relations.
        $this->dispatch(new SetParentRelations($pages));
        $this->dispatch(new SetChildrenRelations($pages));

        return $view->make(
            $options->get('view', 'anomaly.module.documentation::structure'),
            compact('pages', 'options')
        )->render();
    }
}
