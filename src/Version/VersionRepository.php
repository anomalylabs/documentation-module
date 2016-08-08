<?php namespace Anomaly\DocumentationModule\Version;

use Anomaly\DocumentationModule\Version\Contract\VersionRepositoryInterface;
use Anomaly\Streams\Platform\Entry\EntryRepository;

class VersionRepository extends EntryRepository implements VersionRepositoryInterface
{

    /**
     * The entry model.
     *
     * @var VersionModel
     */
    protected $model;

    /**
     * Create a new VersionRepository instance.
     *
     * @param VersionModel $model
     */
    public function __construct(VersionModel $model)
    {
        $this->model = $model;
    }
}
