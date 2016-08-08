<?php namespace Anomaly\DocumentationModule\Version\Contract;

use Anomaly\DocumentationModule\Project\Contract\ProjectInterface;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Interface VersionInterface
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\DocumentationModule\Version\Contract
 */
interface VersionInterface extends EntryInterface
{

    /**
     * Get the project.
     *
     * @return ProjectInterface
     */
    public function getProject();

    /**
     * Return the project relation.
     *
     * @return BelongsTo
     */
    public function project();
}
