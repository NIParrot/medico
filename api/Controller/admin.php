<?php
class admin
{
    public static function PostOrgType(array $args)
    {
        $valedator = [
            'name' => 'string',
            'create_from' => 'string',
            'secret' => 'string'
        ];
        $valed_data = NI_request::API_validate($args, $valedator);
        if ($valed_data['secret'] !== md5('medicomanger')) {
            NI_Api::$response['status'] = 404;
            NI_Api::$response['data'] = [
                'msg' => 'some thing went wrong,secret dose not match'
            ];
        }
        $new = model\org_type::create($valed_data);
        if ($new) {
            NI_Api::$response['status'] = 200;
            NI_Api::$response['data'] = [
                'msg' => 'add sucssfully'
            ];
        } else {
            NI_Api::$response['status'] = 404;
            NI_Api::$response['data'] = [
                'msg' => 'some thing went wrong'
            ];
        }
    }

    public static function DeleteOrgType(array $args)
    {
        $valedator = [
            'id' => 'int',
            'secret' => 'string'
        ];
        $valed_data = NI_request::API_validate($args, $valedator);
        $new = model\org_type::delete($valed_data['id']);
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

    public static function UpdateOrgType(array $data)
    {
        $valedator = [
            'id' => 'int',
            'secret' => 'string',
            'name' => 'string'
        ];
        $valed_data = NI_request::API_validate($data, $valedator);
        if ($valed_data['secret'] !== md5('medicomanger')) {
            NI_Api::$response['status'] = 404;
            NI_Api::$response['data'] = [
                'msg' => 'some thing went wrong,secret dose not match'
            ];
        }

        $org_type = model\org_type::update($valed_data);
        if ($org_type) {
            NI_Api::$response['status'] = 200;
            NI_Api::$response['data'] = [
                'msg' => 'org_type updated sucssfully'
            ];
        } else {
            NI_Api::$response['status'] = 404;
            NI_Api::$response['data'] = [
                'msg' => 'some thing went wrong'
            ];
        }
    }


    public static function PostEmployeeType(array $args)
    {
        $valedator = [
            'name' => 'string',
            'create_from' => 'string',
            'secret' => 'string'
        ];
        $valed_data = NI_request::API_validate($args, $valedator);
        $new = model\employee_type::create($valed_data);
        if ($new) {
            NI_Api::$response['status'] = 200;
            NI_Api::$response['data'] = [
                'msg' => 'add sucssfully'
            ];
        } else {
            NI_Api::$response['status'] = 404;
            NI_Api::$response['data'] = [
                'msg' => 'some thing went wrong'
            ];
        }
    }

    public static function DeleteEmployeeType(array $args)
    {
        $valedator = [
            'id' => 'int',
            'secret' => 'string'
        ];
        $valed_data = NI_request::API_validate($args, $valedator);
        $new = model\employee_type::delete($valed_data['id']);
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

    public static function UpdateEmployeeType(array $args)
    {
        $valedator = [
            'id' => 'int',
            'secret' => 'string',
            'name' => 'string'
        ];
        $valed_data = NI_request::API_validate($args, $valedator);
        if ($valed_data['secret'] !== md5('medicomanger')) {
            NI_Api::$response['status'] = 404;
            NI_Api::$response['data'] = [
                'msg' => 'some thing went wrong,secret dose not match'
            ];
        }

        $employee_type = model\employee_type::update($valed_data);
        if ($employee_type) {
            NI_Api::$response['status'] = 200;
            NI_Api::$response['data'] = [
                'msg' => 'employee_type updated sucssfully'
            ];
        } else {
            NI_Api::$response['status'] = 404;
            NI_Api::$response['data'] = [
                'msg' => 'some thing went wrong'
            ];
        }
    }
}
