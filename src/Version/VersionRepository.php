<?php namespace Anomaly\DocumentationModule\Version;

use Anomaly\DocumentationModule\Version\Contract\VersionInterface;
use Anomaly\DocumentationModule\Version\Contract\VersionRepositoryInterface;
use Anomaly\Streams\Platform\Entry\EntryRepository;

/**
 * Class VersionRepository
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\DocumentationModule\Version
 */
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

    /**
     * Find a version by it's slug.
     *
     * @param $slug
     * @return VersionInterface|null
     */
    public function findBySlug($slug)
    {
        return $this->model->where('name', $slug)->first();
    }
}
