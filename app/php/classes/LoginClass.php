<?php
include_once "classes/Crud.php";
include_once "classes/Validation.php";
include_once "classes/UserContract.php";
include_once "classes/CryptoClass.php";
include_once "classes/AuthClass.php";

/*ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);*/

class LoginClass
{

    static function login()
    {

        $validation = new Validation();
        $array_error_messages = $validation->validateAllLogin($_POST, 'login', 'password');

        if (empty($array_error_messages)) {
/*
            $loginVal = preg_replace('/\s\s+/', '', htmlspecialchars($_POST['login']));
            $passwVal = preg_replace('/\s\s+/', '', htmlspecialchars($_POST['password']));*/

            $loginVal = htmlspecialchars($_POST['login']);
            $passwVal = htmlspecialchars($_POST['password']);

            $userByLogin = Crud::getUserByLogin($loginVal);// надо бы чтобы возвращал User, но уже не успеваю
            if ($userByLogin != null)
                $encrypt_passw = CryptoClass::encryptSHA1($passwVal, $userByLogin['salt']);
            else
                return json_encode(['login' => "Пользователь не найден!"]);
            if ($userByLogin['password'] == $encrypt_passw) {

                setcookie("login", $userByLogin['login'], time() + 3600, "/", $_SERVER['SERVER_NAME']);
                setcookie("password", $userByLogin['password'], time() + 3600, "/", $_SERVER['SERVER_NAME']);
                setcookie("name", $userByLogin['name'], time() + 3600, "/", $_SERVER['SERVER_NAME']);
                $_SESSION['id'] = $userByLogin['id'];
                return json_encode($array_error_messages);
            } else
                return json_encode(['password' => "Пароль неверный!"]);

        } else
            return json_encode($array_error_messages);

    }


}