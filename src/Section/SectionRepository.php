<?php namespace Anomaly\DocumentationModule\Section;

use Anomaly\DocumentationModule\Section\Contract\SectionInterface;
use Anomaly\DocumentationModule\Section\Contract\SectionRepositoryInterface;
use Anomaly\DocumentationModule\Version\Contract\VersionInterface;
use Anomaly\Streams\Platform\Entry\EntryRepository;

/**
 * Class SectionRepository
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\DocumentationModule\Section
 */
class SectionRepository extends EntryRepository implements SectionRepositoryInterface
{

    /**
     * The entry model.
     *
     * @var SectionModel
     */
    protected $model;

    /**
     * Create a new SectionRepository instance.
     *
     * @param SectionModel $model
     */
    public function __construct(SectionModel $model)
    {
        $this->model = $model;
    }

    /**
     * Find a section by it's version and path.
     *
     * @param VersionInterface $version
     * @param                  $path
     * @return SectionInterface|null
     */
    public function findByVersionAndPath(VersionInterface $version, $path)
    {
        return $this->model
            ->where('version_id', $version->getId())
            ->where('path', '/' . ltrim($path, '/'))
            ->first();
    }
}
