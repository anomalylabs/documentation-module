<?php namespace Anomaly\DocumentationModule\Section\Command;

use Anomaly\DocumentationModule\Section\Contract\SectionInterface;
use Anomaly\DocumentationModule\Section\SectionCollection;
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
     * @return SectionInterface|null
     */
    public function handle(Factory $view)
    {
        $options = $this->options;

        $sections = $this->dispatch(new GetSections($options));

        /* @var SectionCollection $sections */
        $sections = $sections->enabled();

        $this->dispatch(new SetParentRelations($sections));
        $this->dispatch(new SetChildrenRelations($sections));

        if ($options->has('root')) {
            if ($section = $this->dispatch(new GetSection($options->get('root')))) {
                $options->put('parent', $section);
            }
        }

        return $view->make(
            $options->get('view', 'anomaly.module.documentation::sections/structure'),
            compact('sections', 'options')
        )->render();
    }
}
