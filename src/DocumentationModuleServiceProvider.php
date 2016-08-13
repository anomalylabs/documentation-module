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
     * The addon singletons.
     *
     * @var array
     */
    protected $singletons = [
        'Anomaly\DocumentationModule\Page\Contract\PageRepositoryInterface'       => 'Anomaly\DocumentationModule\Page\PageRepository',
        'Anomaly\DocumentationModule\Type\Contract\TypeRepositoryInterface'       => 'Anomaly\DocumentationModule\Type\TypeRepository',
        'Anomaly\DocumentationModule\Project\Contract\ProjectRepositoryInterface' => 'Anomaly\DocumentationModule\Project\ProjectRepository',
        'Anomaly\DocumentationModule\Version\Contract\VersionRepositoryInterface' => 'Anomaly\DocumentationModule\Version\VersionRepository',
    ];

    /**
     * The addon routes.
     *
     * @var array
     */
    protected $routes = [
        'documentation'                                          => [
            'as'   => 'anomaly.module.documentation::projects.index',
            'uses' => 'Anomaly\DocumentationModule\Http\Controller\ProjectsController@index',
        ],
        'documentation/{project}'                                => [
            'as'   => 'anomaly.module.documentation::projects.view',
            'uses' => 'Anomaly\DocumentationModule\Http\Controller\ProjectsController@view',
        ],
        'documentation/{project}/{version}'                      => [
            'as'   => 'anomaly.module.documentation::versions.view',
            'uses' => 'Anomaly\DocumentationModule\Http\Controller\VersionsController@view',
        ],
        'documentation/{project}/{version}/{path}'               => [
            'as'          => 'anomaly.module.documentation::pages.view',
            'uses'        => 'Anomaly\DocumentationModule\Http\Controller\PagesController@view',
            'constraints' => [
                'path' => '(.*)',
            ],
        ],
        'admin/documentation/fields'                             => 'Anomaly\DocumentationModule\Http\Controller\Admin\FieldsController@index',
        'admin/documentation/fields/choose'                      => 'Anomaly\DocumentationModule\Http\Controller\Admin\FieldsController@choose',
        'admin/documentation/fields/create'                      => 'Anomaly\DocumentationModule\Http\Controller\Admin\FieldsController@create',
        'admin/documentation/fields/edit/{id}'                   => 'Anomaly\DocumentationModule\Http\Controller\Admin\FieldsController@edit',
        'admin/documentation/types/assignments/{type}'           => 'Anomaly\DocumentationModule\Http\Controller\Admin\AssignmentsController@index',
        'admin/documentation/types/assignments/{type}/choose'    => 'Anomaly\DocumentationModule\Http\Controller\Admin\AssignmentsController@choose',
        'admin/documentation/types/assignments/{type}/create'    => 'Anomaly\DocumentationModule\Http\Controller\Admin\AssignmentsController@create',
        'admin/documentation/types/assignments/{type}/edit/{id}' => 'Anomaly\DocumentationModule\Http\Controller\Admin\AssignmentsController@edit',
    ];
}
