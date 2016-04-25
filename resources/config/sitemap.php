<?php

use Anomaly\DocumentationModule\Project\Contract\ProjectInterface;
use Anomaly\DocumentationModule\Project\Contract\ProjectRepositoryInterface;
use Anomaly\DocumentationModule\Project\ProjectCollection;
use Carbon\Carbon;

return [
    'lastmod' => function () {

        return (new Carbon())->createFromTimestamp(strtotime('-1 month'))->toAtomString();
    },
    'entries' => function (ProjectRepositoryInterface $projects) {

        /* @var ProjectCollection $projects */
        $projects = $projects->all();

        return $projects->enabled();
    },
    'handler' => function (\Roumen\Sitemap\Sitemap $sitemap, ProjectInterface $entry) {

        $documentation = $entry->getDocumentation();

        foreach ($documentation->structure($entry, 'master') as $section) {
            foreach ($section['pages'] as $slug => $page) {
                $sitemap->add(
                    url('documentation/' . $entry->getSlug() . '/' . $slug),
                    $entry->lastModified()->toAtomString(),
                    0.5,
                    'weekly'
                );
            }
        }
    }
];
