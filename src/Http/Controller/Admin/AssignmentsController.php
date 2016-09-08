<?php namespace Anomaly\DocumentationModule\Http\Controller\Admin;

use Anomaly\DocumentationModule\Type\Contract\TypeInterface;
use Anomaly\DocumentationModule\Type\Contract\TypeRepositoryInterface;
use Anomaly\Streams\Platform\Assignment\Form\AssignmentFormBuilder;
use Anomaly\Streams\Platform\Assignment\Table\AssignmentTableBuilder;
use Anomaly\Streams\Platform\Field\Contract\FieldRepositoryInterface;
use Anomaly\Streams\Platform\Http\Controller\AdminController;

/**
 * Class AssignmentsController
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\DocumentationModule\Http\Controller\Admin
 */
class AssignmentsController extends AdminController
{

    /**
     * Return an index of existing assignments.
     *
     * @param AssignmentTableBuilder  $table
     * @param TypeRepositoryInterface $types
     * @param                         $type
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(AssignmentTableBuilder $table, TypeRepositoryInterface $types, $type)
    {
        /* @var TypeInterface $type */
        $type = $types->find($type);

        return $table->setStream($type->getEntryStream())->render();
    }

    /**
     * Return the modal for choosing a field to assign.
     *
     * @param FieldRepositoryInterface $fields
     * @param TypeRepositoryInterface  $types
     * @param                          $type
     * @return \Illuminate\Contracts\View\View|mixed
     */
    public function choose(FieldRepositoryInterface $fields, TypeRepositoryInterface $types, $type)
    {
        /* @var TypeInterface $type */
        $type = $types->find($type);

        $fields = $fields
            ->findAllByNamespace('documentation')
            ->notAssignedTo($type->getEntryStream())
            ->unlocked();

        return $this->view->make('module::admin/assignments/choose', compact('fields', 'type'));
    }

    /**
     * Create a new assignment.
     *
     * @param AssignmentFormBuilder    $builder
     * @param TypeRepositoryInterface  $types
     * @param FieldRepositoryInterface $fields
     * @param                          $type
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(
        AssignmentFormBuilder $builder,
        TypeRepositoryInterface $types,
        FieldRepositoryInterface $fields,
        $type
    ) {
        /* @var TypeInterface $type */
        $type = $types->find($type);

        return $builder
            ->setField($fields->find($this->request->get('field')))
            ->setStream($type->getEntryStream())
            ->render();
    }

    /**
     * Edit an existing assignment.
     *
     * @param AssignmentFormBuilder   $builder
     * @param TypeRepositoryInterface $types
     * @param                         $type
     * @param                         $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(
        AssignmentFormBuilder $builder,
        TypeRepositoryInterface $types,
        $type,
        $id
    ) {
        /* @var TypeInterface $type */
        $type = $types->find($type);

        return $builder
            ->setStream($type->getEntryStream())
            ->render($id);
    }
}