<?php namespace Anomaly\DocumentationModule;

use Anomaly\DocumentationModule\Category\CategoryModel;
use Anomaly\DocumentationModule\Page\Contract\PageRepositoryInterface;
use Anomaly\DocumentationModule\Page\PageRepository;
use Anomaly\Streams\Platform\Model\Documentation\DocumentationPagesEntryModel;
use Anomaly\DocumentationModule\Page\PageModel;
use Anomaly\DocumentationModule\Category\CategoryRepository;
use Anomaly\DocumentationModule\Category\Contract\CategoryRepositoryInterface;
use Anomaly\DocumentationModule\Http\Controller\Admin\FieldsController;
use Anomaly\DocumentationModule\Project\Contract\ProjectRepositoryInterface;
use Anomaly\DocumentationModule\Project\ProjectModel;
use Anomaly\DocumentationModule\Project\ProjectRepository;
use Anomaly\Streams\Platform\Addon\AddonServiceProvider;
use Anomaly\Streams\Platform\Field\FieldRouter;
use Anomaly\Streams\Platform\Model\Documentation\DocumentationCategoriesEntryModel;
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
        DocumentationPagesEntryModel::class => PageModel::class,
        DocumentationProjectsEntryModel::class   => ProjectModel::class,
        DocumentationCategoriesEntryModel::class => CategoryModel::class,
    ];

    /**
     * The addon singletons.
     *
     * @var array
     */
    protected $singletons = [
        PageRepositoryInterface::class => PageRepository::class,
        ProjectRepositoryInterface::class  => ProjectRepository::class,
        CategoryRepositoryInterface::class => CategoryRepository::class,
    ];

    /**
     * The addon routes.
     *
     * @var array
     */
    protected $routes = [
        'admin/documentation/pages'           => 'Anomaly\DocumentationModule\Http\Controller\Admin\PagesController@index',
        'admin/documentation/pages/create'    => 'Anomaly\DocumentationModule\Http\Controller\Admin\PagesController@create',
        'admin/documentation/pages/edit/{id}' => 'Anomaly\DocumentationModule\Http\Controller\Admin\PagesController@edit',
        'documentation'                            => [
            'as'   => 'anomaly.module.documentation::projects.index',
            'uses' => 'Anomaly\DocumentationModule\Http\Controller\ProjectsController@index',
        ],
        'documentation/categories/{slug}'          => [
            'as'   => 'anomaly.module.documentation::categories.view',
            'uses' => 'Anomaly\DocumentationModule\Http\Controller\CategoriesController@view',
        ],
        'documentation/{slug}'                     => [
            'as'   => 'anomaly.module.documentation::projects.view',
            'uses' => 'Anomaly\DocumentationModule\Http\Controller\ProjectsController@latest',
        ],
        'documentation/{slug}/latest'              => [
            'as'   => 'anomaly.module.documentation::projects.latest',
            'uses' => 'Anomaly\DocumentationModule\Http\Controller\ProjectsController@view',
        ],
        'documentation/{project}/{version}'        => [
            'as'   => 'anomaly.module.documentation::projects.version',
            'uses' => 'Anomaly\DocumentationModule\Http\Controller\ProjectsController@view',
        ],
        'documentation/{project}/{version}/{page}' => [
            'as'          => 'anomaly.module.documentation::projects.page',
            'uses'        => 'Anomaly\DocumentationModule\Http\Controller\ProjectsController@view',
            'constraints' => [
                'page' => '(.*)',
            ],
        ],
    ];

    /**
     * Map the addon.
     *
     * @param FieldRouter $fields
     */
    public function map(FieldRouter $fields)
    {
        $fields->route($this->addon, FieldsController::class);
    }
}
