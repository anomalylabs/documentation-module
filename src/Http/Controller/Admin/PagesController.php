<?php namespace Anomaly\DocumentationModule\Http\Controller\Admin;

use Anomaly\DocumentationModule\Entry\Form\EntryFormBuilder;
use Anomaly\DocumentationModule\Page\Contract\PageInterface;
use Anomaly\DocumentationModule\Page\Contract\PageRepositoryInterface;
use Anomaly\DocumentationModule\Page\Form\PageEntryFormBuilder;
use Anomaly\DocumentationModule\Page\Form\PageFormBuilder;
use Anomaly\DocumentationModule\Page\Tree\PageTreeBuilder;
use Anomaly\DocumentationModule\Type\Contract\TypeInterface;
use Anomaly\DocumentationModule\Type\Contract\TypeRepositoryInterface;
use Anomaly\DocumentationModule\Version\Contract\VersionInterface;
use Anomaly\DocumentationModule\Version\Contract\VersionRepositoryInterface;
use Anomaly\Streams\Platform\Http\Controller\AdminController;
use Anomaly\Streams\Platform\Support\Authorizer;

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
        PageEntryFormBuilder $form,
        EntryFormBuilder $entry,
        PageFormBuilder $page,
        VersionRepositoryInterface $versions,
        PageRepositoryInterface $pages,
        TypeRepositoryInterface $types,
        $version
    ) {
        /* @var PageInterface $parent */
        if ($parent = $pages->find($this->request->get('parent'))) {
            $page->setParent($parent);
        }

        /* @var VersionInterface $version */
        $version = $versions->find($version);

        $page->setVersion($version);

        /* @var TypeInterface $type */
        $type = $types->find($this->request->get('type'));

        $page->setType($type);

        $entry->setModel($type->getEntryModelName());

        $form->addForm('entry', $entry);
        $form->addForm('page', $page);

        return $form->render();
    }

    /**
     * Edit an existing entry.
     *
     * @param PageEntryFormBuilder    $form
     * @param EntryFormBuilder        $entry
     * @param PageFormBuilder         $page
     * @param PageRepositoryInterface $pages
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(
        PageEntryFormBuilder $form,
        EntryFormBuilder $entry,
        PageFormBuilder $page,
        PageRepositoryInterface $pages
    ) {
        /* @var PageInterface $row */
        $row = $pages->find($this->route->parameter('id'));

        $form->addForm('entry', $entry->setEntry($row->getEntry()));
        $form->addForm('page', $page->setEntry($row));

        return $form->render();
    }

    /**
     * Redirect to a page's URL.
     *
     * @param PageRepositoryInterface $pages
     * @return \Illuminate\Http\RedirectResponse
     */
    public function view(PageRepositoryInterface $pages)
    {
        /* @var PageInterface $page */
        $page = $pages->find($this->route->parameter('id'));

        if (!$page->isEnabled()) {
            return $this->redirect->to('documentation/preview/' . $page->getStrId());
        }

        return $this->redirect->to($page->route('view'));
    }

    /**
     * Delete a page and go back.
     *
     * @param PageRepositoryInterface $pages
     * @param Authorizer              $authorizer
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(PageRepositoryInterface $pages, Authorizer $authorizer)
    {
        $authorizer->authorize('anomaly.module.documentation::pages.delete');

        $pages->delete($page = $pages->find($this->route->parameter('id')));

        $page->entry->delete();

        return $this->redirect->back();
    }
}
