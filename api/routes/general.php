<?php
NI_Api_route::get('general/org_type',function(){
    NI_Api_Controller::run('general@GetOrgType');
});


NI_Api_route::get('general/employeetype',function(){
    NI_Api_Controller::run('general@EmployeeType');
});


NI_Api_route::post('login',function(){
    NI_Api_Controller::run('general@login');
});

NI_Api_route::post('employee/login',function(){
    NI_Api_Controller::run('general@employeelogin');
});
