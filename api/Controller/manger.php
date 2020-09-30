<?php
class manger
{
    public static function register(array $data)
    {
        $valedator = [
            'user' => 'string',
            'password' => 'string',
            'name' => 'string',
            'org_name' => 'string',
            'job' => 'string',
            'org_phone' => 'string',
            'location' => 'string',
            'org_type_id' => 'int'
        ];
        $valed_data = NI_request::API_validate($data, $valedator);
        $valed_data['password'] = sha1($valed_data['password']);
        if (model\manger::uniqregister($valed_data)) {
            $user = model\manger::create($valed_data);
            if ($user) {
                NI_Api::$response['status'] = 200;
                NI_Api::$response['data'] = [
                    'msg'=> 'manger register sucssfully',
                    'token' => NI_JWT::CreateToken($valed_data),
                    'key' => 'manger'
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
            'name' => 'string',
            'org_name' => 'string',
            'job' => 'string',
            'org_phone' => 'string',
            'location' => 'string',
            'org_type_id' => 'int'
        ];
        $valed_data = NI_request::API_validate($data, array_intersect_key($valedator, $data));
        if (!NI_JWT::MangerAuth() || $valed_data['id'] != NI_JWT::MangerAuth()[1]) {
            NI_Api::$response['status'] = 404;
            NI_Api::$response['data'] = [
                'msg' => 'token not valed'
            ];
            return;
        }
        if (isset($valed_data['password'])) {
            $valed_data['password'] = sha1($valed_data['password']);
        }
        if (model\manger::uniquser($valed_data)) {
            $user = model\manger::update($valed_data);
            if ($user) {
                NI_Api::$response['status'] = 200;
                NI_Api::$response['data'] = [
                    'msg'=> 'user updated sucssfully'
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
            'id' => 'int'
        ];
        $valed_data = NI_request::API_validate($args, $valedator);
        if (!NI_JWT::MangerAuth() || $valed_data['id'] != NI_JWT::MangerAuth()[1]) {
            NI_Api::$response['status'] = 404;
            NI_Api::$response['data'] = [
                'msg' => 'token not valed'
            ];
            return;
        }
        $new = model\manger::delete($valed_data['id']);
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

    public static function getemployee(array $data)
    {
        $valedator = [
            'manger_id' => 'int'
        ];
        $valed_data = NI_request::API_validate($data, $valedator);
        $data = model\employee::getemployee($valed_data['manger_id']);
        if (!NI_JWT::MangerAuth() || $valed_data['manger_id'] != NI_JWT::MangerAuth()[1]) {
            NI_Api::$response['status'] = 404;
            NI_Api::$response['data'] = [
                'msg' => 'token not valed'
            ];
            return;
        } else {
            NI_Api::$response['status'] = 200;
            NI_Api::$response['data'] = $data ?? null;
        }
    }
}
