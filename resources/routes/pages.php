<?php

return [
    'admin/documentation/pages/{version}'             => 'Anomaly\DocumentationModule\Http\Controller\Admin\PagesController@index',
    'admin/documentation/pages/{version}/choose'      => 'Anomaly\DocumentationModule\Http\Controller\Admin\PagesController@choose',
    'admin/documentation/pages/{version}/create'      => 'Anomaly\DocumentationModule\Http\Controller\Admin\PagesController@create',
    'admin/documentation/pages/{version}/edit/{id}'   => 'Anomaly\DocumentationModule\Http\Controller\Admin\PagesController@edit',
    'admin/documentation/pages/{version}/view/{id}'   => 'Anomaly\DocumentationModule\Http\Controller\Admin\PagesController@view',
    'admin/documentation/pages/{version}/delete/{id}' => 'Anomaly\DocumentationModule\Http\Controller\Admin\PagesController@delete',
];
