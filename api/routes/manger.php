<?php
NI_Api_route::post('manger/register', function () {
    NI_Api_Controller::run('manger@register');
});
NI_Api_route::post('manger/update', function () {
    NI_Api_Controller::run('manger@update');
});
NI_Api_route::post('manger/delete', function () {
    NI_Api_Controller::run('manger@delete');
});
NI_Api_route::post('manger/getemployee', function () {
    NI_Api_Controller::run('manger@getemployee');
});
