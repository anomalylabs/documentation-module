<?php namespace Anomaly\DocumentationModule\Page\Command;

use Anomaly\DocumentationModule\Page\Contract\PageInterface;
use Anomaly\DocumentationModule\Page\Contract\PageRepositoryInterface;
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
     * @param  PageRepositoryInterface $pages
     * @return null|PageInterface
     */
    public function handle(PageRepositoryInterface $pages, Factory $view)
    {
        $options = $this->options;

        /* @var PageCollection $pages */
        $pages = $pages->sorted();
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
            $options->get('view', 'anomaly.module.documentation::structure'),
            compact('pages', 'options')
        )->render();
    }
}
