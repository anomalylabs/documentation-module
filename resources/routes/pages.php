<?php

return [
    'admin/documentation/pages/{version}'           => 'Anomaly\DocumentationModule\Http\Controller\Admin\PagesController@index',
    'admin/documentation/pages/{version}/choose'    => 'Anomaly\DocumentationModule\Http\Controller\Admin\PagesController@choose',
    'admin/documentation/pages/{version}/create'    => 'Anomaly\DocumentationModule\Http\Controller\Admin\PagesController@create',
    'admin/documentation/pages/{version}/edit/{id}' => 'Anomaly\DocumentationModule\Http\Controller\Admin\PagesController@edit'
];
