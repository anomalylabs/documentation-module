<?php

return [
    'admin/documentation/versions/{project}'           => 'Anomaly\DocumentationModule\Http\Controller\Admin\VersionsController@index',
    'admin/documentation/versions/{project}/choose'    => 'Anomaly\DocumentationModule\Http\Controller\Admin\VersionsController@choose',
    'admin/documentation/versions/{project}/create'    => 'Anomaly\DocumentationModule\Http\Controller\Admin\VersionsController@create',
    'admin/documentation/versions/{project}/edit/{id}' => 'Anomaly\DocumentationModule\Http\Controller\Admin\VersionsController@edit'
];
