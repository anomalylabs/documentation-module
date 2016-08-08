<?php namespace Anomaly\DocumentationModule\Page\Tree;

use Anomaly\DocumentationModule\Version\Contract\VersionInterface;
use Anomaly\Streams\Platform\Ui\Tree\TreeBuilder;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class PageTreeBuilder
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\DocumentationModule\Page\Tree
 */
class PageTreeBuilder extends TreeBuilder
{

    /**
     * The version instance.
     *
     * @var null|VersionInterface
     */
    protected $version = null;

    /**
     * The tree buttons.
     *
     * @var array
     */
    protected $buttons = [
        'add'    => [
            'data-toggle' => 'modal',
            'data-target' => '#modal',
            'text'        => 'anomaly.module.documentation::button.create_child_page',
            'href'        => 'admin/documentation/pages/{request.route.parameters.version}/choose?parent={entry.id}'
        ],
        'view'   => [
            'target' => '_blank'
        ],
        'prompt' => [
            'href' => 'admin/documentation/pages/delete/{entry.id}'
        ]
    ];

    /**
     * Fired when the builder is ready to build.
     *
     * @throws \Exception
     */
    public function onReady()
    {
        if (!$this->getVersion()) {
            throw new \Exception('The $version parameter is required.');
        }
    }

    /**
     * Fired just before starting the query.
     *
     * @param Builder $query
     */
    public function onQuerying(Builder $query)
    {
        $version = $this->getVersion();

        $query->where('version_id', $version->getId());
    }

    /**
     * Get the version.
     *
     * @return VersionInterface|null
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Set the version.
     *
     * @param $version
     * @return $this
     */
    public function setVersion(VersionInterface $version)
    {
        $this->version = $version;

        return $this;
    }
}