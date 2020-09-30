<?php
namespace model;

class employee_type
{
    public static function create(array $data)
    {
        $new = \ORM::for_table("employee_type")->create();
        
        $new->name = $data["name"];
            
        $new->create_from = $data["create_from"];
            
        if ($new->save()) {
            return true;
        } else {
            return false;
        }
    }

    public static function update(array $data)
    {
        $employee_type = \ORM::for_table("employee_type")->findOne([$data['id']]);
        if (empty($employee_type)) {
            return false;
        }
        foreach ($data as $key => $value) {
            if ($key == 'id') {
                continue;
            }
            if ($key == 'secret') {
                continue;
            }
            $employee_type->set($key, $value);
        }
        if ($employee_type->save()) {
            return true;
        } else {
            return false;
        }
    }

    public static function delete($id)
    {
        $new = \ORM::for_table("employee_type")->findOne([$id]);
        if ($new->delete()) {
            return true;
        } else {
            return false;
        }
    }

    public static function select()
    {
        return \ORM::for_table("employee_type")->findArray();
    }
}
