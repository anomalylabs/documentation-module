<?php namespace Anomaly\DocumentationModule\Http\Controller\Admin;

use Anomaly\DocumentationModule\Page\Contract\PageInterface;
use Anomaly\DocumentationModule\Page\Contract\PageRepositoryInterface;
use Anomaly\DocumentationModule\Page\Form\PageFormBuilder;
use Anomaly\DocumentationModule\Page\Tree\PageTreeBuilder;
use Anomaly\DocumentationModule\Type\Contract\TypeRepositoryInterface;
use Anomaly\DocumentationModule\Version\Contract\VersionInterface;
use Anomaly\DocumentationModule\Version\Contract\VersionRepositoryInterface;
use Anomaly\Streams\Platform\Http\Controller\AdminController;
use Anomaly\Streams\Platform\Support\Authorizer;
use Illuminate\Routing\Redirector;

/**
 * Class PagesController
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\DocumentationModule\Http\Controller\Admin
 */
class PagesController extends AdminController
{

    /**
     * Display an index of existing entries.
     *
     * @param PageTreeBuilder            $tree
     * @param VersionRepositoryInterface $versions
     * @param                            $version
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(PageTreeBuilder $tree, VersionRepositoryInterface $versions, $version)
    {
        /* @var VersionInterface $version */
        $version = $versions->find($version);

        return $tree
            ->setVersion($version)
            ->render();
    }

    /**
     * Return a selection of versions.
     *
     * @param TypeRepositoryInterface    $types
     * @param VersionRepositoryInterface $versions
     * @param                            $version
     * @return \Illuminate\View\View
     */
    public function choose(TypeRepositoryInterface $types, VersionRepositoryInterface $versions, $version)
    {
        return view(
            'module::admin/types/choose',
            [
                'types'   => $types->all(),
                'version' => $versions->find($version),
            ]
        );
    }

    /**
     * Create a new entry.
     *
     * @param PageFormBuilder            $form
     * @param VersionRepositoryInterface $versions
     * @param PageRepositoryInterface    $pages
     * @param                            $version
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(
        PageFormBuilder $form,
        VersionRepositoryInterface $versions,
        PageRepositoryInterface $pages,
        $version
    ) {
        /* @var PageInterface $parent */
        if ($parent = $pages->find($this->request->get('parent'))) {
            $form->setParent($parent);
        }

        /* @var VersionInterface $version */
        $version = $versions->find($version);

        $form->setVersion($version);

        return $form->render();
    }

    /**
     * Edit an existing entry.
     *
     * @param PageFormBuilder $form
     * @param                 $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(PageFormBuilder $form, $id)
    {
        return $form->render($id);
    }

    /**
     * Redirect to a page's URL.
     *
     * @param PageRepositoryInterface $pages
     * @param Redirector              $redirect
     * @param                         $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function view(PageRepositoryInterface $pages, Redirector $redirect, $id)
    {
        /* @var PageInterface $page */
        $page = $pages->find($id);

        if (!$page->isEnabled()) {
            return $redirect->to('documentation/preview/' . $page->getStrId());
        }

        if ($page->isHome()) {
            return $redirect->to('PAGE');
        }

        return $redirect->to($page->getPath());
    }

    /**
     * Delete a page and go back.
     *
     * @param PageRepositoryInterface $pages
     * @param Authorizer              $authorizer
     * @param                         $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(PageRepositoryInterface $pages, Authorizer $authorizer, $id)
    {
        $authorizer->authorize('anomaly.module.documentation::pages.delete');

        $pages->delete($page = $pages->find($id));

        $page->entry->delete();

        return $this->redirect->back();
    }
}
