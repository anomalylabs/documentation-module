<?php namespace Anomaly\DocumentationModule\Http\Controller\Admin;

use Anomaly\DocumentationModule\Category\Contract\CategoryInterface;
use Anomaly\DocumentationModule\Category\Contract\CategoryRepositoryInterface;
use Anomaly\DocumentationModule\Category\Form\CategoryFormBuilder;
use Anomaly\DocumentationModule\Category\Table\CategoryTableBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;

class CategoriesController extends AdminController
{

    /**
     * Display an index of existing entries.
     *
     * @param CategoryTableBuilder $table
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(CategoryTableBuilder $table)
    {
        return $table->render();
    }

    /**
     * Create a new entry.
     *
     * @param CategoryFormBuilder $form
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(CategoryFormBuilder $form)
    {
        return $form->render();
    }

    /**
     * Edit an existing entry.
     *
     * @param CategoryFormBuilder $form
     * @param                     $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(CategoryFormBuilder $form, $id)
    {
        return $form->render($id);
    }

    /**
     * Redirect to the view for a category.
     *
     * @param CategoryRepositoryInterface $categories
     * @param                             $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function view(CategoryRepositoryInterface $categories, $id)
    {
        /* @var CategoryInterface $category */
        $category = $categories->find($id);

        return $this->redirect->route(
            'anomaly.module.documentation::categories.view',
            [
                'category' => $category->getSlug(),
            ]
        );
    }
}
