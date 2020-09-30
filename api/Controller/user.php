<?php
class user
{
    public static function register(array $data)
    {
        $valedator = [
            'user' => 'string',
            'name' => 'string',
            'phone' => 'string',
            'email' => 'email',
            'password' => 'string'
        ];
        $valed_data = NI_request::API_validate($data, $valedator);
        $valed_data['password'] = sha1($valed_data['password']);


        if (model\users::uniqregister($valed_data)) {
            $user = model\users::create($valed_data);
            if ($user) {
                NI_Api::$response['status'] = 200;
                NI_Api::$response['data'] = [
                    'msg'=> 'user register sucssfully',
                    'token' => NI_JWT::CreateToken($valed_data),
                    'key' => 'user'
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
            'name' => 'string',
            'phone' => 'string',
            'email' => 'email',
            'password' => 'string'
        ];
        $valed_data = NI_request::API_validate($data, array_intersect_key($valedator, $data));
        if (!NI_JWT::userAuth() || $valed_data['id'] != NI_JWT::userAuth()[1]) {
            NI_Api::$response['status'] = 404;
            NI_Api::$response['data'] = [
                'msg' => 'token not valed'
            ];
            return;
        }
        if (isset($valed_data['password'])) {
            $valed_data['password'] = sha1($valed_data['password']);
        }
        if (model\users::uniquser($valed_data)) {
            $user = model\users::update($valed_data);
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
        if (!NI_JWT::userAuth() || $valed_data['id'] != NI_JWT::userAuth()[1]) {
            NI_Api::$response['status'] = 404;
            NI_Api::$response['data'] = [
                'msg' => 'token not valed'
            ];
            return;
        }
        $new = model\users::delete($valed_data['id']);
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

    public static function getpharmacy()
    {
        $data = model\manger::getpharmacy();
        NI_Api::$response['status'] = 200;
        NI_Api::$response['data'] = [
            'data' => $data ?? null
        ];
    }
}
