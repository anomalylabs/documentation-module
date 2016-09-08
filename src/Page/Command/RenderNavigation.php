<?php namespace Anomaly\DocumentationModule\Page\Command;

use Anomaly\DocumentationModule\Page\Contract\PageInterface;
use Anomaly\DocumentationModule\Page\PageCollection;
use Anomaly\Streams\Platform\Support\Collection;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\View\Factory;

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
     * @return PageInterface|null
     */
    public function handle(Factory $view)
    {
        $options = $this->options;

        $pages = $this->dispatch(new GetPages($options));

        /* @var PageCollection $pages */
        $pages = $pages->enabled();

        $this->dispatch(new SetCurrentPage($pages));
        $this->dispatch(new SetActivePages($pages));
        $this->dispatch(new SetParentRelations($pages));
        $this->dispatch(new SetChildrenRelations($pages));

        if ($options->has('root')) {
            if ($page = $this->dispatch(new GetPage($options->get('root')))) {
                $options->put('parent', $page);
            }
        }

        return $view->make(
            $options->get('view', 'anomaly.module.documentation::pages/structure'),
            compact('pages', 'options')
        )->render();
    }
}
