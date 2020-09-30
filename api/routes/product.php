<?php
NI_Api_route::post('product/create', function () {
    NI_Api_Controller::run('product@create');
});
NI_Api_route::post('product/update', function () {
    NI_Api_Controller::run('product@update');
});
NI_Api_route::post('product/delete', function () {
    NI_Api_Controller::run('product@delete');
});
NI_Api_route::post('product/find', function () {
    NI_Api_Controller::run('product@find');
});
NI_Api_route::get('product/get', function () {
    NI_Api_Controller::run('product@get');
});
