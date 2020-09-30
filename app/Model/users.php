<?php

namespace model;

class users
{
    public static function create(array $data)
    {
        $new = \ORM::for_table("users")->create();

        $new->user = $data["user"];

        $new->name = $data["name"];

        $new->phone = $data["phone"];

        $new->email = $data["email"];

        $new->password = $data["password"];

        if ($new->save()) {
            return true;
        } else {
            return false;
        }
    }

    public static function update(array $data)
    {
        $user = \ORM::for_table("users")->findOne([$data['id']]);
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
        $new = \ORM::for_table("users")->findOne([$id]);
        if ($new->delete()) {
            return true;
        } else {
            return false;
        }
    }

    public static function select()
    {
        return \ORM::for_table("users")->findArray();
    }
    public static function check(array $data)
    {
        $users = \ORM::for_table('users')->where(
            array('user' => $data['user'], 'password' => $data['password'])
        )
            ->find_one();
        return $users;
    }

    public static function uniquser(array $data)
    {
        $check = \ORM::for_table('users')->where_any_is(
            array(
                array('user' => $data['user']),
                array('phone' => $data['phone']),
                array('email' => $data['email'])
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
        $check = \ORM::for_table('users')->where_any_is(
            array(
                array('user' => $data['user']),
                array('phone' => $data['phone']),
                array('email' => $data['email'])
            )
        )->find_one();

        if (empty($check)) {
            return true;
        } else {
            return false;
        }
    }
}
