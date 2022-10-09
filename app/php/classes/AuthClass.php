<?php
include_once "Crud.php";

/*ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);*/

class AuthClass
{
    static function isAuth()
    { //Проверка по куки + сессия
        session_start();
        if (isset($_SESSION['id'])) { // если есть сессия проверяются куки
            if (isset($_COOKIE['login']) && isset($_COOKIE['password'])) { //если есть куки, они продлеваются
                setcookie("login", $_COOKIE['login'], time() + 3600, '/', $_SERVER['SERVER_NAME']);
                setcookie("password", $_COOKIE['password'], time() + 3600, '/', $_SERVER['SERVER_NAME']);
                return true;

            } else { // нету куки, ищем по id и добавляем в куки

                if($user = Crud::getUserById($_SESSION['id'])!=null){
                    setcookie("login", $user['login'], time() + 3600, "/", $_SERVER['SERVER_NAME']);
                    setcookie("password", $user['password'], time() + 3600, "/", $_SERVER['SERVER_NAME']);
                    setcookie("name", $user['name'], time() + 3600, "/", $_SERVER['SERVER_NAME']);
                    $_SESSION['id'] = $user['id'];
                    return true;
                }
                else return false;



            }


        } else if (isset($_COOKIE['login']) && isset($_COOKIE['password'])) { //нету id ищем по логину и паролю
            $user = Crud::getUserByLogin($_COOKIE['login']);
            if (!empty($user) && $user['password'] == $_COOKIE['password']){
                $_SESSION['id'] = $user['id'];
                return true;
            }

            else { // обнуляем
                setcookie("login", "", time() - 360000, '/', $_SERVER['SERVER_NAME']);
                setcookie("password", "", time() - 360000, '/', $_SERVER['SERVER_NAME']);
                setcookie("name", "", time() - 360000, '/', $_SERVER['SERVER_NAME']);
                unset($_SESSION['id']);
                return false;
            }

        } else
            return false;
    }
}