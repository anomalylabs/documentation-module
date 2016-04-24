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
        'admin/documentation'                        => 'Anomaly\DocumentationModule\Http\Controller\Admin\ProjectsController@index',
        'admin/documentation/choose'                 => 'Anomaly\DocumentationModule\Http\Controller\Admin\ProjectsController@choose',
        'admin/documentation/create'                 => 'Anomaly\DocumentationModule\Http\Controller\Admin\ProjectsController@create',
        'admin/documentation/edit/{id}'              => 'Anomaly\DocumentationModule\Http\Controller\Admin\ProjectsController@edit',
        'admin/documentation/view/{id}'              => 'Anomaly\DocumentationModule\Http\Controller\Admin\ProjectsController@view',
        'admin/documentation/categories'             => 'Anomaly\DocumentationModule\Http\Controller\Admin\CategoriesController@index',
        'admin/documentation/categories/create'      => 'Anomaly\DocumentationModule\Http\Controller\Admin\CategoriesController@create',
        'admin/documentation/categories/edit/{id}'   => 'Anomaly\DocumentationModule\Http\Controller\Admin\CategoriesController@edit',
        'documentation'                              => 'Anomaly\DocumentationModule\Http\Controller\ProjectsController@index',
        'documentation/{project}'                    => 'Anomaly\DocumentationModule\Http\Controller\ProjectsController@view',
        'documentation/{project}/{version?}/{page?}' => 'Anomaly\DocumentationModule\Http\Controller\DocumentationController@view',
    ];

    /**
     * The addon bindings.
     *
     * @var array
     */
    protected $bindings = [
        'Anomaly\Streams\Platform\Model\Documentation\DocumentationProjectsEntryModel'   => 'Anomaly\DocumentationModule\Project\ProjectModel',
        'Anomaly\Streams\Platform\Model\Documentation\DocumentationCategoriesEntryModel' => 'Anomaly\DocumentationModule\Category\CategoryModel'
    ];

    /**
     * The addon singletons.
     *
     * @var array
     */
    protected $singletons = [
        'Anomaly\DocumentationModule\Project\Contract\ProjectRepositoryInterface'   => 'Anomaly\DocumentationModule\Project\ProjectRepository',
        'Anomaly\DocumentationModule\Category\Contract\CategoryRepositoryInterface' => 'Anomaly\DocumentationModule\Category\CategoryRepository'
    ];

}
