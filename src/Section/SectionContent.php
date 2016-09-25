<?php namespace Anomaly\DocumentationModule\Section;

use Anomaly\DocumentationModule\Section\Contract\SectionInterface;
use Anomaly\EditorFieldType\EditorFieldType;
use Illuminate\View\Factory;
use Robbo\Presenter\Decorator;

/**
 * Class SectionContent
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class SectionContent
{

    /**
     * The view factory.
     *
     * @var Factory
     */
    protected $view;

    /**
     * The decorator utility.
     *
     * @var Decorator
     */
    protected $decorator;

    /**
     * Create a new SectionContent instance.
     *
     * @param Factory   $view
     * @param Decorator $decorator
     */
    public function __construct(Factory $view, Decorator $decorator)
    {
        $this->view      = $view;
        $this->decorator = $decorator;
    }

    /**
     * Make the view content.
     *
     * @param SectionInterface $section
     */
    public function make(SectionInterface $section)
    {
        $project = $section->getProject();
        $version = $section->getVersion();
        $type    = $section->getType();

        /* @var EditorFieldType $layout */
        $layout = $type->getFieldType('layout');

        $section->setContent(
            $this->view->make(
                $layout->getViewPath(),
                compact('section', 'project', 'version')
            )->render()
        );
    }
}
