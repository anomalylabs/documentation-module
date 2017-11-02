<?php namespace Anomaly\DocumentationModule\Page\Tree;

use Anomaly\Streams\Platform\Ui\Tree\TreeBuilder;

class PageTreeBuilder extends TreeBuilder
{

    /**
     * The tree segments.
     *
     * @var array|string
     */
    protected $segments = [];

    /**
     * The tree buttons.
     *
     * @var array|string
     */
    protected $buttons = [];

    /**
     * The tree options.
     *
     * @var array
     */
    protected $options = [];

    /**
     * The tree assets.
     *
     * @var array
     */
    protected $assets = [];

}
