<?php

class employee
{
    public static function register(array $data)
    {
        $valedator = [
            'user' => 'string',
            'password' => 'string',
            'manger_id' => 'int',
            'employee_type_id' => 'int',
            'create_from' => 'string'
        ];
        $valed_data = NI_request::API_validate($data, $valedator);
    
        if (!NI_JWT::MangerAuth() || $valed_data['manger_id'] != NI_JWT::MangerAuth()[1]) {
            NI_Api::$response['status'] = 404;
            NI_Api::$response['data'] = [
                'msg' => 'token not valed'
            ];
            return;
        }
        $valed_data['password'] = sha1($valed_data['password']);
        if (model\employee::uniqregister($valed_data)) {
            $employee = model\employee::create($valed_data);
            if ($employee) {
                NI_Api::$response['status'] = 200;
                NI_Api::$response['data'] = [
                    'msg'=> 'employee register sucssfully',
                    'token' => NI_JWT::CreateToken($valed_data),
                    'key' => 'employee',
                    'type' => $valed_data['employee_type_id']
                ];
            }
        } else {
            NI_Api::$response['status'] = 404;
            NI_Api::$response['data'] = [
                'msg'=> 'data muste nuiqe',
                'data' => $valed_data
            ];
        }
        
    }

    public static function update(array $data)
    {
        $valedator = [
            'id'=>'int',
            'user' => 'string',
            'password' => 'string',
            'employee_type_id' => 'int',
            'create_from' => 'string'
        ];
        $valed_data = NI_request::API_validate($data, array_intersect_key($valedator, $data));
        if (!NI_JWT::employeeAuth() || $valed_data['id'] != NI_JWT::employeeAuth()[1]) {
            NI_Api::$response['status'] = 404;
            NI_Api::$response['data'] = [
                'msg' => 'token not valed'
            ];
            return;
        }
        if (isset($valed_data['password'])) {
            $valed_data['password'] = sha1($valed_data['password']);
        }
        if (model\employee::uniquser($valed_data)) {
            $employee = model\employee::update($valed_data);
            if ($employee) {
                NI_Api::$response['status'] = 200;
                NI_Api::$response['data'] = [
                    'msg'=> 'employee updated sucssfully'
                ];
            } else {
                NI_Api::$response['status'] = 404;
                NI_Api::$response['data'] = [
                    'msg' => 'some thing went wrong'
                ];
            }
        } else {
            NI_Api::$response['status'] = 404;
            NI_Api::$response['data'] = [
                'msg'=> 'data muste nuiqe',
                'data' => $valed_data
            ];
        }
    }

    public static function delete(array $args)
    {
        $valedator = [
            'id' => 'int',
            'manger_id' => 'int'
        ];
        $valed_data = NI_request::API_validate($args, $valedator);
        if (!NI_JWT::MangerAuth() || $valed_data['manger_id'] != NI_JWT::MangerAuth()[1]) {
            NI_Api::$response['status'] = 404;
            NI_Api::$response['data'] = [
                'msg' => 'token not valed'
            ];
            return;
        }
        $new = model\employee::delete($valed_data['id']);
        if ($new) {
            NI_Api::$response['status'] = 200;
            NI_Api::$response['data'] = [
                'msg' => 'delete sucssfully'
            ];
        } else {
            NI_Api::$response['status'] = 404;
            NI_Api::$response['data'] = [
                'msg' => 'some thing went wrong'
            ];
        }
    }
}
