<?php namespace Anomaly\DocumentationModule;

use Anomaly\DocumentationModule\Category\CategoryModel;
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
        DocumentationProjectsEntryModel::class   => ProjectModel::class,
        DocumentationCategoriesEntryModel::class => CategoryModel::class,
    ];

    /**
     * The addon singletons.
     *
     * @var array
     */
    protected $singletons = [
        ProjectRepositoryInterface::class  => ProjectRepository::class,
        CategoryRepositoryInterface::class => CategoryRepository::class,
    ];

    /**
     * The addon routes.
     *
     * @var array
     */
    protected $routes = [
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
            'as'   => 'anomaly.module.documentation::sections.view',
            'uses' => 'Anomaly\DocumentationModule\Http\Controller\ProjectsController@view',
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
