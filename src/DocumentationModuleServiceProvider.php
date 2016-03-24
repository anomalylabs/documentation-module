<?php namespace Anomaly\DocumentationModule;

use Anomaly\Streams\Platform\Addon\AddonServiceProvider;

/**
 * Class DocumentationModuleServiceProvider
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\DocumentationModule
 */
class DocumentationModuleServiceProvider extends AddonServiceProvider
{

    /**
     * The addon routes.
     *
     * @var array
     */
    protected $routes = [
        'admin/documentation'                      => 'Anomaly\DocumentationModule\Http\Controller\Admin\ProjectsController@index',
        'admin/documentation/choose'               => 'Anomaly\DocumentationModule\Http\Controller\Admin\ProjectsController@choose',
        'admin/documentation/create'               => 'Anomaly\DocumentationModule\Http\Controller\Admin\ProjectsController@create',
        'admin/documentation/edit/{id}'            => 'Anomaly\DocumentationModule\Http\Controller\Admin\ProjectsController@edit',
        'documentation/{project}/{version}/{file?}' => 'Anomaly\DocumentationModule\Http\Controller\ProjectsController@file',
    ];

    /**
     * The addon singletons.
     *
     * @var array
     */
    protected $singletons = [
        'Anomaly\DocumentationModule\Project\Contract\ProjectRepositoryInterface' => 'Anomaly\DocumentationModule\Project\ProjectRepository'
    ];

}
