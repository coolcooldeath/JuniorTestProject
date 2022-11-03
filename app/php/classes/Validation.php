<?php
/*ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);*/

class Validation
{
    static $email_incorrect_message = 'Электронная почта неккоректна';
    static $empty_field_message = 'Поле обязательно для заполнения';
    static $min_count_char_message = 'Минимальное количество символов - ';
    static $max_count_char_message = 'Максимальное количество символов - ';
    static $password_error_message = 'Пароль должен содержать латинские буквы и цифры';
    static $name_error_message = 'Имя может содержать только буквы';
    static $password_repeat_error_message = 'Пароли должны совпадать';
    static $login_unique_error = 'Такой логин уже существует';
    static $email_unique_error = 'Такой email уже существует';
    static $space_error = 'Поле содержит пробелы!';

    public function validateAllSignup($data, $email, $login, $name, $passw, $repeat_passw)
    {
        $validate = new Validation();
        $msg = [];
       /* $emailVal = preg_replace('/\s\s+/', '', $data[$email]);// вместо валидации пробелов, решил их просто вырезать
        $loginVal = preg_replace('/\s\s+/', '', $data[$login]);
        $nameVal = preg_replace('/\s\s+/', '', $data[$name]);
        $passwVal = preg_replace('/\s\s+/', '', $data[$passw]);
        $repeat_passwVal = preg_replace('/\s\s+/', '', $data[$repeat_passw]);*/
        $emailVal =  $data[$email];
       $loginVal =$data[$login];
       $nameVal = $data[$name];
       $passwVal = $data[$passw];
       $repeat_passwVal = $data[$repeat_passw];

        if (empty($emailVal))
            $msg += [$email => Validation::$empty_field_message];
        else if (!$validate->isEmailValid($emailVal))
            $msg += [$email => Validation::$email_incorrect_message];



        if (empty($loginVal))
            $msg += [$login => Validation::$empty_field_message];
        else if (!$validate->isCountSymbols($loginVal, 6))
            $msg += [$login => Validation::$min_count_char_message . 6];
        else if(preg_match("|\s|", $loginVal))
            $msg += [$login => Validation::$space_error];


        if (empty($nameVal))
            $msg += [$name => Validation::$empty_field_message];
        else if (mb_strlen($nameVal) > 2)
            $msg += [$name => Validation::$max_count_char_message . 2];
        else if(preg_match("|\s|", $nameVal))
            $msg += [$name => Validation::$space_error];
        else if(!preg_match('/^[a-zа-яё\s]+$/iu',$nameVal))
            $msg += [$name => Validation::$name_error_message];


        if (empty($repeat_passwVal))
            $msg += [$repeat_passw => Validation::$empty_field_message];


        if (empty($passwVal))
            $msg += [$passw => Validation::$empty_field_message];
        else if (!$validate->isCountSymbols($passwVal, 6))
            $msg += [$passw => Validation::$min_count_char_message . 6];
        else if (!preg_match('/[a-zA-Z]/',$passwVal) || !preg_match('/\d/',$passwVal))
            $msg += [$passw => Validation::$password_error_message];
        else if (!($repeat_passwVal === $passwVal))
            $msg += [$repeat_passw => Validation::$password_repeat_error_message];


        return $msg;
    }

    public function isEmailValid($email)
    {

        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }

    public function isCountSymbols($str, $count)
    {
        if (strlen($str) >= $count)
            return true;
        else
            return false;
    }

   /* public function isSpace($str, $count)
    {
        if ()
            return true;
        else
            return false;
    }*/

    public function validateAllLogin($data, $login, $passw)
    {
        /*$loginVal = preg_replace('/\s\s+/', '', $data[$login]);
        $passwVal = preg_replace('/\s\s+/', '', $data[$passw]);*/
        $loginVal = $data[$login];
        $passwVal = $data[$passw];
        $msg = [];
        if (empty($loginVal))
            $msg += [$login => Validation::$empty_field_message];

        if (empty($passwVal))
            $msg += [$passw => Validation::$empty_field_message];

        return $msg;
    }

}

