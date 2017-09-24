<?php namespace Anomaly\DocumentationModule\Http\Controller\Admin;

use Anomaly\Streams\Platform\Addon\FieldType\FieldTypeCollection;
use Anomaly\Streams\Platform\Field\Form\FieldFormBuilder;
use Anomaly\Streams\Platform\Stream\Contract\StreamRepositoryInterface;

/**
 * Class FieldsController
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class FieldsController extends \Anomaly\Streams\Platform\Http\Controller\FieldsController
{

    /**
     * The stream namespace.
     *
     * @var string
     */
    protected $namespace = 'documentation';

    /**
     * The stream repository.
     *
     * @var StreamRepositoryInterface $streams
     */
    protected $streams;

    /**
     * Create a new FieldsController instance.
     *
     * @param StreamRepositoryInterface $streams
     */
    public function __construct(StreamRepositoryInterface $streams)
    {
        $this->streams = $streams;

        parent::__construct();
    }

    /**
     * Return a form to create a new field.
     *
     * @param FieldFormBuilder    $form
     * @param FieldTypeCollection $fieldTypes
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(FieldFormBuilder $form, FieldTypeCollection $fieldTypes)
    {
        $form
            ->setStream($this->streams->findBySlugAndNamespace('projects', $this->namespace))
            ->setOption('auto_assign', true);

        return parent::create($form, $fieldTypes);
    }


}
