<?php
NI_Api_route::post('user/register', function () {
    NI_Api_Controller::run('user@register');
});
NI_Api_route::post('user/update', function () {
    NI_Api_Controller::run('user@update');
});
NI_Api_route::post('user/delete', function () {
    NI_Api_Controller::run('user@delete');
});
NI_Api_route::get('getpharmacy', function () {
    NI_Api_Controller::run('user@getpharmacy');
});
