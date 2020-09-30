<?php
class general
{
    public static function GetOrgType()
    {
        $data = model\org_type::select();
        NI_Api::$response['status'] = 200;
        NI_Api::$response['data'] = [
            'data' => $data ?? null
        ];
    }
    public static function EmployeeType()
    {
        $data = model\employee_type::select();
        NI_Api::$response['status'] = 200;
        NI_Api::$response['data'] = [
            'data' => $data ?? null
        ];
    }
    
    public static function login(array $data)
    {
        $valedator = [
            'user' => 'string',
            'password' => 'string'
        ];
        $valed_data = NI_request::API_validate($data, $valedator);
        $valed_data['password'] = sha1($valed_data['password']);
        $user = model\users::check($valed_data);
        $manger = model\manger::check($valed_data);
        if (empty($user) && empty($manger)) {
            NI_Api::$response['status'] = 404;
            NI_Api::$response['data'] = [
                'msg' => 'wrong username or password'
            ];
        }
        if (!empty($user)) {
            NI_Api::$response['status'] = 200;
            NI_Api::$response['data'] = [
                'msg' => 'login sucssfully',
                'token' => NI_JWT::CreateToken($valed_data),
                'key' => 'user',
                'data' => [
                    'id' => $user->id,
                    'user' => $user->user,
                    'name' => $user->name,
                    'phone' => $user->phone,
                    'email' => $user->email
                ]
                
            ];
        }
        if (!empty($manger)) {
            NI_Api::$response['status'] = 200;
            NI_Api::$response['data'] = [
                'msg' => 'login sucssfully',
                'token' => NI_JWT::CreateToken($valed_data),
                'key' => 'manger',
                'data' =>[
                    "id" => $manger->id,
                    "user" => $manger->user,
                    "org_name" => $manger->org_name,
                    "name" => $manger->name,
                    "org_phone" => $manger->org_phone,
                    "job" => $manger->job,
                    "location" => $manger->location,
                    "org_type_id" => $manger->org_type_id
                ]
            ];
        }
    }


    public static function employeelogin(array $data)
    {
        $valedator = [
            'user' => 'string',
            'password' => 'string'
        ];
        $valed_data = NI_request::API_validate($data, $valedator);
        $valed_data['password'] = sha1($valed_data['password']);
        $employee = model\employee::check($valed_data);
        if (empty($employee)) {
            NI_Api::$response['status'] = 404;
            NI_Api::$response['data'] = [
                'msg' => 'wrong username or password'
            ];
        }
        if (!empty($employee)) {
            NI_Api::$response['status'] = 200;
            NI_Api::$response['data'] = [
                'msg' => 'login sucssfully',
                'token' => NI_JWT::CreateToken($valed_data),
                'key' => 'employee',
                'type' => $employee->employee_type_id,
                'manger_id' => $employee->manger_id,
                'user' => $employee->user,
                'employee_id' => $employee->id
            ];
        }
    }
}
