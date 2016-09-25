<?php namespace Anomaly\DocumentationModule\Section\Command;

use Anomaly\DocumentationModule\Version\Command\GetVersion;
use Anomaly\DocumentationModule\Version\Contract\VersionInterface;
use Anomaly\Streams\Platform\Support\Collection;
use Anomaly\Streams\Platform\View\ViewTemplate;
use Illuminate\Foundation\Bus\DispatchesJobs;

class GetSections
{

    use DispatchesJobs;

    /**
     * The option collection.
     *
     * @var Collection
     */
    protected $options;

    /**
     * Create a new GetSections instance.
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
     * @param ViewTemplate $template
     * @return \Anomaly\DocumentationModule\Section\SectionCollection|null
     */
    public function handle(ViewTemplate $template)
    {
        if (!$version = $this->options->get('version', $template->get('version'))) {
            return null;
        }

        /* @var VersionInterface $version */
        $version = $this->dispatch(new GetVersion($version));

        return $version->getSections();
    }
}
