<?php namespace Anomaly\DocumentationModule;

use Anomaly\Streams\Platform\Addon\Module\Module;

class DocumentationModule extends Module
{

    /**
     * The navigation icon.
     *
     * @var string
     */
    protected $icon = 'addon';

    /**
     * The module sections.
     *
     * @var array
     */
    protected $sections = [
        'example'
    ];

}
