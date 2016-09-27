<?php

return [
    'admin/documentation'                                => 'Anomaly\DocumentationModule\Http\Controller\Admin\Project\ProjectsController@index',
    'admin/documentation/choose'                         => 'Anomaly\DocumentationModule\Http\Controller\Admin\Project\ProjectsController@choose',
    'admin/documentation/create'                         => 'Anomaly\DocumentationModule\Http\Controller\Admin\Project\ProjectsController@create',
    'admin/documentation/edit/{id}'                      => 'Anomaly\DocumentationModule\Http\Controller\Admin\Project\ProjectsController@edit',
    'admin/documentation/view/{id}'                      => 'Anomaly\DocumentationModule\Http\Controller\Admin\Project\ProjectsController@view',
    'admin/documentation/projects/assignments'           => 'Anomaly\DocumentationModule\Http\Controller\Admin\Project\AssignmentsController@index',
    'admin/documentation/projects/assignments/choose'    => 'Anomaly\DocumentationModule\Http\Controller\Admin\Project\AssignmentsController@choose',
    'admin/documentation/projects/assignments/create'    => 'Anomaly\DocumentationModule\Http\Controller\Admin\Project\AssignmentsController@create',
    'admin/documentation/projects/assignments/edit/{id}' => 'Anomaly\DocumentationModule\Http\Controller\Admin\Project\AssignmentsController@edit',
];
