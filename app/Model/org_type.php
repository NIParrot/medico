<?php
namespace model;

class org_type
{
    public static function create(array $data)
    {
        $new = \ORM::for_table("org_type")->create();
        
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
        $org_type = \ORM::for_table("org_type")->findOne([$data['id']]);
        if (empty($org_type)) {
            return false;
        }
        foreach ($data as $key => $value) {
            if ($key == 'id') {
                continue;
            }
            if ($key == 'secret') {
                continue;
            }
            $org_type->set($key, $value);
        }
        if ($org_type->save()) {
            return true;
        } else {
            return false;
        }
    }

    public static function delete($id)
    {
        $new = \ORM::for_table("org_type")->findOne([$id]);
        if ($new->delete()) {
            return true;
        } else {
            return false;
        }
    }

    public static function select()
    {
        return \ORM::for_table("org_type")->findArray();
    }
}
