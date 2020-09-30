<?php

namespace model;

class product
{
    public static function create(array $data)
    {
        $new = \ORM::for_table("product")->create();

        $new->manger_id = $data["manger_id"];

        $new->employee_id = $data["employee_id"];

        $new->name = $data["name"];

        $new->price = $data["price"];

        $new->create_from = $data["create_from"];

        if ($new->save()) {
            return true;
        } else {
            return false;
        }
    }

    public static function update(array $data)
    {
        $employee = \ORM::for_table("product")->findOne([$data['id']]);
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
        $employee = \ORM::for_table("product")->findOne([$id]);
        if ($employee->delete()) {
            return true;
        } else {
            return false;
        }
    }

    public static function select()
    {
        return \ORM::for_table("product")->findArray();
    }
    public static function find($id)
    {
        return \ORM::for_table("product")->where('manger_id', $id)->findArray();
    }
}
