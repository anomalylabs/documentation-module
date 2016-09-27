<?php namespace Anomaly\DocumentationModule\Http\Controller\Admin\Project;

use Anomaly\Streams\Platform\Assignment\Form\AssignmentFormBuilder;
use Anomaly\Streams\Platform\Assignment\Table\AssignmentTableBuilder;
use Anomaly\Streams\Platform\Field\Contract\FieldInterface;
use Anomaly\Streams\Platform\Field\Contract\FieldRepositoryInterface;
use Anomaly\Streams\Platform\Http\Controller\AdminController;
use Anomaly\Streams\Platform\Stream\Contract\StreamRepositoryInterface;

/**
 * Class AssignmentsController
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class AssignmentsController extends AdminController
{

    /**
     * Return an index of existing assignments.
     *
     * @param AssignmentTableBuilder    $table
     * @param StreamRepositoryInterface $streams
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(AssignmentTableBuilder $table, StreamRepositoryInterface $streams)
    {
        return $table
            ->setStream($streams->findBySlugAndNamespace('projects', 'documentation'))
            ->render();
    }

    /**
     * Return the modal for choosing a field to assign.
     *
     * @param FieldRepositoryInterface  $fields
     * @param StreamRepositoryInterface $streams
     * @return \Illuminate\Contracts\View\View|mixed
     */
    public function choose(FieldRepositoryInterface $fields, StreamRepositoryInterface $streams)
    {
        $fields = $fields
            ->findAllByNamespace('documentation')
            ->notAssignedTo($streams->findBySlugAndNamespace('projects', 'documentation'))
            ->unlocked();

        return $this->view->make('module::admin/assignments/choose', compact('fields'));
    }

    /**
     * Create a new assignment.
     *
     * @param AssignmentFormBuilder     $builder
     * @param FieldRepositoryInterface  $fields
     * @param StreamRepositoryInterface $streams
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(
        AssignmentFormBuilder $builder,
        FieldRepositoryInterface $fields,
        StreamRepositoryInterface $streams
    ) {
        /* @var FieldInterface $field */
        $field = $fields->find($this->request->get('field'));

        return $builder
            ->setField($field)
            ->setStream($streams->findBySlugAndNamespace('projects', 'documentation'))
            ->render();
    }

    /**
     * Edit an existing assignment.
     *
     * @param AssignmentFormBuilder     $builder
     * @param StreamRepositoryInterface $streams
     * @param                           $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(AssignmentFormBuilder $builder, StreamRepositoryInterface $streams, $id)
    {
        return $builder
            ->setStream($streams->findBySlugAndNamespace('projects', 'documentation'))
            ->render($id);
    }
}
