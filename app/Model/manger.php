<?php

namespace model;

class manger
{
    public static function create(array $data)
    {
        $new = \ORM::for_table("manger")->create();

        $new->user = $data["user"];

        $new->org_name = $data["org_name"];

        $new->name = $data["name"];

        $new->org_phone = $data["org_phone"];

        $new->password = $data["password"];

        $new->job = $data["job"];

        $new->location = $data["location"];

        $new->org_type_id = $data["org_type_id"];

        if ($new->save()) {
            return true;
        } else {
            return false;
        }
    }

    public static function update(array $data)
    {
        $user = \ORM::for_table("manger")->findOne([$data['id']]);
        foreach ($data as $key => $value) {
            if ($key == 'id') {
                continue;
            }
            $user->set($key, $value);
        }
        if ($user->save()) {
            return true;
        } else {
            return false;
        }
    }

    public static function delete($id)
    {
        $new = \ORM::for_table("manger")->findOne([$id]);
        if ($new->delete()) {
            return true;
        } else {
            return false;
        }
    }

    public static function select()
    {
        return \ORM::for_table("manger")->findArray();
    }

    public static function getpharmacy()
    {
        return \ORM::for_table("manger")->select_many('id','org_name','location')->findArray();
    }

    public static function check(array $data)
    {
        $manger = \ORM::for_table('manger')->where(
            array('user' => $data['user'], 'password' => $data['password'])
        )
            ->find_one();
        return $manger;
    }
    public static function uniquser(array $data)
    {
        $check = \ORM::for_table('manger')->where_any_is(
            array(
                array('user' => $data['user']),
                array('org_phone' => $data['org_phone'])
            )
        )->where_not_equal('id', $data['id'])->find_one();

        if (empty($check)) {
            return true;
        } else {
            return false;
        }
    }
    public static function uniqregister(array $data)
    {
        $check = \ORM::for_table('manger')->where_any_is(
            array(
                array('user' => $data['user']),
                array('org_phone' => $data['org_phone'])
            )
        )->find_one();

        if (empty($check)) {
            return true;
        } else {
            return false;
        }
    }
}
