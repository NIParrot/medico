<?php
namespace model;

class order
{
    public static function create(array $data)
    {
        $new = \ORM::for_table("order")->create();
        
        $new->manger_id = $data["manger_id"];
            
        $new->user_id = $data["user_id"];
            
        $new->products_id = $data["products_id"];
            
        $new->create_from = $data["create_from"];
            
        if ($new->save()) {
            return true;
        } else {
            return false;
        }
    }

    public static function update()
    {
    }

    public static function delete()
    {
    }

    public static function select()
    {
        return \ORM::for_table("order")->findArray();
    }
}
