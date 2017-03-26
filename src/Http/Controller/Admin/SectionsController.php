<?php namespace Anomaly\DocumentationModule\Http\Controller\Admin;

use Anomaly\DocumentationModule\Entry\Form\EntryFormBuilder;
use Anomaly\DocumentationModule\Section\Contract\SectionInterface;
use Anomaly\DocumentationModule\Section\Contract\SectionRepositoryInterface;
use Anomaly\DocumentationModule\Section\Form\SectionEntryFormBuilder;
use Anomaly\DocumentationModule\Section\Form\SectionFormBuilder;
use Anomaly\DocumentationModule\Section\Tree\SectionTreeBuilder;
use Anomaly\DocumentationModule\Type\Contract\TypeInterface;
use Anomaly\DocumentationModule\Type\Contract\TypeRepositoryInterface;
use Anomaly\DocumentationModule\Version\Contract\VersionInterface;
use Anomaly\DocumentationModule\Version\Contract\VersionRepositoryInterface;
use Anomaly\Streams\Platform\Http\Controller\AdminController;

/**
 * Class SectionsController
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\DocumentationModule\Http\Controller\Admin
 */
class SectionsController extends AdminController
{

    /**
     * Display an index of existing entries.
     *
     * @param SectionTreeBuilder         $tree
     * @param VersionRepositoryInterface $versions
     * @param                            $version
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(SectionTreeBuilder $tree, VersionRepositoryInterface $versions, $version)
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
     * @param SectionFormBuilder         $form
     * @param VersionRepositoryInterface $versions
     * @param SectionRepositoryInterface $sections
     * @param                            $version
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(
        SectionEntryFormBuilder $form,
        EntryFormBuilder $entry,
        SectionFormBuilder $section,
        VersionRepositoryInterface $versions,
        SectionRepositoryInterface $sections,
        TypeRepositoryInterface $types,
        $version
    ) {
        /* @var SectionInterface $parent */
        if ($parent = $sections->find($this->request->get('parent'))) {
            $section->setParent($parent);
        }

        /* @var VersionInterface $version */
        $version = $versions->find($version);

        $section->setVersion($version);

        /* @var TypeInterface $type */
        $type = $types->find($this->request->get('type'));

        $section->setType($type);

        $entry->setModel($type->getEntryModelName());

        $form->addForm('entry', $entry);
        $form->addForm('section', $section);

        return $form->render();
    }

    /**
     * Edit an existing entry.
     *
     * @param SectionEntryFormBuilder    $form
     * @param EntryFormBuilder           $entry
     * @param SectionFormBuilder         $section
     * @param SectionRepositoryInterface $sections
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(
        SectionEntryFormBuilder $form,
        EntryFormBuilder $entry,
        SectionFormBuilder $section,
        SectionRepositoryInterface $sections
    ) {
        /* @var SectionInterface $row */
        $row = $sections->find($this->route->parameter('id'));

        $form->addForm('entry', $entry->setEntry($row->getEntry()));
        $form->addForm('section', $section->setEntry($row));

        return $form->render();
    }

    /**
     * Redirect to a section's URL.
     *
     * @param SectionRepositoryInterface $sections
     * @return \Illuminate\Http\RedirectResponse
     */
    public function view(SectionRepositoryInterface $sections)
    {
        /* @var SectionInterface $section */
        $section = $sections->find($this->route->parameter('id'));

        if (!$section->isEnabled()) {
            return $this->redirect->to('documentation/preview/' . $section->getStrId());
        }

        return $this->redirect->to($section->route('view'));
    }
}
