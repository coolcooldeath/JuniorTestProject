<?php

class Crud
{
    private static $jsonFile = "database/data.json";

    static function getUserByLogin($login)
    {
        $users = Crud::getUsers();
        if (!empty($users)) {
            foreach ($users as $user) {
                if ($user['login'] == $login) {
                    return $user;
                }
            }
        }

        return null;
    }

    static function getUsers()
    {
        return json_decode(file_get_contents(Crud::$jsonFile), true);
    }

    static function getUserById($id)
    {
        $users = Crud::getUsers();
        if (!empty($users)) {
            foreach ($users as $user) {
                if ($user['id'] == $id) {
                    return $user;
                }
            }
        }

        return null;
    }

    static function getUserByEmail($email)
    {
        $users = Crud::getUsers();
        if (!empty($users)) {
            foreach ($users as $user) {
                if ($user['email'] == $email) {
                    return $user;
                }
            }
        }
        return null;
    }


    static function insert($newData)
    {

        if (!empty($newData)) {
            $jsonData = file_get_contents(Crud::$jsonFile);
            $data = json_decode($jsonData, true);

            $data = !empty($data) ? array_filter($data) : $data;
            if (!empty($data)) {
                array_push($data, $newData);
            } else {
                $data[] = $newData;
            }
            $insert = file_put_contents(Crud::$jsonFile, json_encode($data));

            return $insert ? true : false;
        } else {
            return false;
        }
    }

}