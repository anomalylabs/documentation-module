<?php

return [
    'admin/documentation'           => 'Anomaly\DocumentationModule\Http\Controller\Admin\ProjectsController@index',
    'admin/documentation/choose'    => 'Anomaly\DocumentationModule\Http\Controller\Admin\ProjectsController@choose',
    'admin/documentation/create'    => 'Anomaly\DocumentationModule\Http\Controller\Admin\ProjectsController@create',
    'admin/documentation/edit/{id}' => 'Anomaly\DocumentationModule\Http\Controller\Admin\ProjectsController@edit',
    'admin/documentation/view/{id}' => 'Anomaly\DocumentationModule\Http\Controller\Admin\ProjectsController@view',
    'admin/documentation/sync/{id}' => 'Anomaly\DocumentationModule\Http\Controller\Admin\ProjectsController@sync',
];
