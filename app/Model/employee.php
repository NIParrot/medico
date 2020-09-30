<?php
namespace model;

class employee
{
    public static function create(array $data)
    {
        $new = \ORM::for_table("employee")->create();
        
        $new->manger_id = $data["manger_id"];
            
        $new->employee_type_id = $data["employee_type_id"];
            
        $new->user = $data["user"];
            
        $new->password = $data["password"];
            
        $new->create_from = $data["create_from"];
            
        if ($new->save()) {
            return true;
        } else {
            return false;
        }
    }

    public static function check(array $data)
    {
        $employee = \ORM::for_table('employee')->where(
            array('user' => $data['user'], 'password' => $data['password'])
        )
            ->find_one();
        return $employee;
    }
    public static function uniquser(array $data)
    {
        $check = \ORM::for_table('employee')->where('user', $data['user'])->where_not_equal('id', $data['id'])->find_one();

        if (empty($check)) {
            return true;
        } else {
            return false;
        }
    }
    public static function uniqregister(array $data)
    {
        $check = \ORM::for_table('employee')->where('user', $data['user'])->find_one();

        if (empty($check)) {
            return true;
        } else {
            return false;
        }
    }

    public static function update(array $data)
    {
        $employee = \ORM::for_table("employee")->findOne([$data['id']]);
        foreach ($data as $key => $value) {
            if ($key == 'id') {
                continue;
            }
            $employee->set($key, $value);
        }
        if ($employee->save()) {
            return true;
        } else {
            return false;
        }
    }

    public static function delete($id)
    {
        $employee = \ORM::for_table("employee")->findOne([$id]);
        if ($employee->delete()) {
            return true;
        } else {
            return false;
        }
    }

    public static function select()
    {
        return \ORM::for_table("employee")->findArray();
    }

    public static function getemployee($id)
    {
        return \ORM::for_table("employee")->where('manger_id', $id)->findArray();
    }
}
