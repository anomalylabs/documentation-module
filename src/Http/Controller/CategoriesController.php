<?php namespace Anomaly\DocumentationModule\Http\Controller;

use Anomaly\DocumentationModule\Category\Contract\CategoryRepositoryInterface;
use Anomaly\DocumentationModule\Command\AddDocumentationBreadcrumb;
use Anomaly\Streams\Platform\Http\Controller\PublicController;

/**
 * Class CategoriesController
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class CategoriesController extends PublicController
{

    /**
     * View an existing category.
     *
     * @param CategoryRepositoryInterface $categories
     * @return \Illuminate\Contracts\View\View|mixed
     */
    public function view(CategoryRepositoryInterface $categories)
    {
        if (!$category = $categories->findBySlug($this->route->parameter('slug'))) {
            abort(404);
        }

        $this->dispatch(new AddDocumentationBreadcrumb());

        $this->breadcrumbs->add($category->getName(), $this->request->path());
        $this->template->put('meta_title', $category->getName());
        $this->template->put('meta_description', $category->getDescription());

        return $this->view->make(
            'anomaly.module.documentation::categories/view',
            compact('category')
        );
    }
}
