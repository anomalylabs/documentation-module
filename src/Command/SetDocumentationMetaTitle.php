<?php namespace Anomaly\DocumentationModule\Command;

use Anomaly\Streams\Platform\Routing\UrlGenerator;
use Anomaly\Streams\Platform\Ui\Breadcrumb\BreadcrumbCollection;
use Anomaly\Streams\Platform\View\ViewTemplate;


/**
 * Class SetDocumentationMetaTitle
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\DocumentationModule\Command
 */
class SetDocumentationMetaTitle
{

    /**
     * Handle the command.
     *
     * @param ViewTemplate $template
     */
    public function handle(ViewTemplate $template)
    {
        $template->set('meta_title', 'anomaly.module.documentation::breadcrumb.documentation');
    }
}
