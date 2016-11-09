<?php

use Anomaly\DocumentationModule\Project\Contract\ProjectInterface;
use Anomaly\DocumentationModule\Project\Contract\ProjectRepositoryInterface;
use Roumen\Sitemap\Sitemap;

return [
    'lastmod' => function (ProjectRepositoryInterface $projects) {

        if (!$project = $projects->lastModified()) {
            return null;
        }

        return $project->lastModified()->toAtomString();
    },
    'entries' => function (ProjectRepositoryInterface $projects) {
        return $projects->all();
    },
    'handler' => function (Sitemap $sitemap, ProjectInterface $entry) {

        $sitemap->add(
            url($entry->route('view')),
            $entry->lastModified()->toAtomString(),
            0.5,
            'monthly'
        );
    },
];
