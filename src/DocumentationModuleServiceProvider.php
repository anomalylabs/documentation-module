<?php namespace Anomaly\DocumentationModule;

use Anomaly\DocumentationModule\Page\Contract\PageRepositoryInterface;
use Anomaly\DocumentationModule\Page\PageModel;
use Anomaly\DocumentationModule\Page\PageRepository;
use Anomaly\DocumentationModule\Project\Contract\ProjectRepositoryInterface;
use Anomaly\DocumentationModule\Project\ProjectModel;
use Anomaly\DocumentationModule\Project\ProjectRepository;
use Anomaly\DocumentationModule\Type\Contract\TypeRepositoryInterface;
use Anomaly\DocumentationModule\Type\TypeRepository;
use Anomaly\DocumentationModule\Version\Contract\VersionRepositoryInterface;
use Anomaly\DocumentationModule\Version\VersionRepository;
use Anomaly\Streams\Platform\Addon\AddonServiceProvider;
use Anomaly\Streams\Platform\Model\Documentation\DocumentationPagesEntryModel;
use Anomaly\Streams\Platform\Model\Documentation\DocumentationProjectsEntryModel;

/**
 * Class DocumentationModuleServiceProvider
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class DocumentationModuleServiceProvider extends AddonServiceProvider
{

    /**
     * The addon plugins.
     *
     * @var array
     */
    protected $plugins = [
        DocumentationModulePlugin::class,
    ];

    /**
     * The addon bindings.
     *
     * @var array
     */
    protected $bindings = [
        DocumentationPagesEntryModel::class    => PageModel::class,
        DocumentationProjectsEntryModel::class => ProjectModel::class,
    ];

    /**
     * The addon singletons.
     *
     * @var array
     */
    protected $singletons = [
        PageRepositoryInterface::class    => PageRepository::class,
        TypeRepositoryInterface::class    => TypeRepository::class,
        VersionRepositoryInterface::class => VersionRepository::class,
        ProjectRepositoryInterface::class => ProjectRepository::class,
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
        'documentation/{slug}'                                   => [
            'as'   => 'anomaly.module.documentation::projects.view',
            'uses' => 'Anomaly\DocumentationModule\Http\Controller\ProjectsController@view',
        ],
        'documentation/{project}/{name}'                         => [
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
