<?php
class product
{
    public static function create(array $data)
    {
        $valedator = [
            'manger_id' => 'int',
            'employee_id' => 'int',
            'name' => 'string',
            'price' => 'int',
            'create_from' => 'string'
        ];
        $valed_data = NI_request::API_validate($data, $valedator);
        if (!NI_JWT::employeeAuth() || $valed_data['employee_id'] != NI_JWT::employeeAuth()[1]) {
            NI_Api::$response['status'] = 404;
            NI_Api::$response['data'] = [
                'msg' => 'token not valed'
            ];
            return;
        }
        $product = model\product::create($valed_data);
        if ($product) {
            NI_Api::$response['status'] = 200;
            NI_Api::$response['data'] = [
                'msg' => 'product add sucssfully',
                'data' => $valed_data
            ];
        } else {
            NI_Api::$response['status'] = 404;
            NI_Api::$response['data'] = [
                'msg' => 'something wend wrong',
                'data' => $valed_data
            ];
        }
    }

    public static function update(array $data)
    {
        $valedator = [
            'id' => 'int',
            'employee_id' => 'int',
            'name' => 'string',
            'price' => 'int'
        ];
        $valed_data = NI_request::API_validate($data, array_intersect_key($valedator, $data));
        if (!NI_JWT::employeeAuth() || $valed_data['employee_id'] != NI_JWT::employeeAuth()[1]) {
            NI_Api::$response['status'] = 404;
            NI_Api::$response['data'] = [
                'msg' => 'token not valed'
            ];
            return;
        }
        $product = model\product::update($valed_data);
        if ($product) {
            NI_Api::$response['status'] = 200;
            NI_Api::$response['data'] = [
                'msg' => 'product update sucssfully',
                'data' => $valed_data
            ];
        } else {
            NI_Api::$response['status'] = 404;
            NI_Api::$response['data'] = [
                'msg' => 'something wend wrong',
                'data' => $valed_data
            ];
        }
    }

    public static function delete(array $args)
    {
        $valedator = [
            'id' => 'int',
            'employee_id' => 'int'
        ];
        $valed_data = NI_request::API_validate($args, $valedator);
        if (!NI_JWT::employeeAuth() || $valed_data['employee_id'] != NI_JWT::employeeAuth()[1]) {
            NI_Api::$response['status'] = 404;
            NI_Api::$response['data'] = [
                'msg' => 'token not valed'
            ];
            return;
        }
        $new = model\product::delete($valed_data['id']);
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

    public static function get()
    {
        $data = model\product::select();
        NI_Api::$response['status'] = 200;
        NI_Api::$response['data'] = [
            'data' => $data ?? null
        ];
    }

    public static function find(array $data)
    {
        $valedator = [
            'manger_id' => 'int'
        ];
        $valed_data = NI_request::API_validate($data, $valedator);
        $data = model\product::find($valed_data['manger_id']);
        NI_Api::$response['status'] = 200;
        NI_Api::$response['data'] = $data ?? null;
    }
}
