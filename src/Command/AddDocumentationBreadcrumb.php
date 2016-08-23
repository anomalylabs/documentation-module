<?php namespace Anomaly\DocumentationModule\Command;

use Anomaly\Streams\Platform\Routing\UrlGenerator;
use Anomaly\Streams\Platform\Ui\Breadcrumb\BreadcrumbCollection;
use Illuminate\Contracts\Bus\SelfHandling;

/**
 * Class AddDocumentationBreadcrumb
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\DocumentationModule\Command
 */
class AddDocumentationBreadcrumb implements SelfHandling
{

    /**
     * Handle the command.
     *
     * @param BreadcrumbCollection $breadcrumbs
     * @param UrlGenerator         $url
     */
    public function handle(BreadcrumbCollection $breadcrumbs, UrlGenerator $url)
    {
        $breadcrumbs->add(
            'anomaly.module.documentation::breadcrumb.documentation',
            $url->route('anomaly.module.documentation::projects.index')
        );
    }
}
