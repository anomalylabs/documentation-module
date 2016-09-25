<?php

return [
    'admin/documentation/sections/{version}'             => 'Anomaly\DocumentationModule\Http\Controller\Admin\SectionsController@index',
    'admin/documentation/sections/{version}/choose'      => 'Anomaly\DocumentationModule\Http\Controller\Admin\SectionsController@choose',
    'admin/documentation/sections/{version}/create'      => 'Anomaly\DocumentationModule\Http\Controller\Admin\SectionsController@create',
    'admin/documentation/sections/{version}/edit/{id}'   => 'Anomaly\DocumentationModule\Http\Controller\Admin\SectionsController@edit',
    'admin/documentation/sections/{version}/view/{id}'   => 'Anomaly\DocumentationModule\Http\Controller\Admin\SectionsController@view',
    'admin/documentation/sections/{version}/delete/{id}' => 'Anomaly\DocumentationModule\Http\Controller\Admin\SectionsController@delete',
];
