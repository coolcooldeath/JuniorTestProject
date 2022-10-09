<?php


class CryptoClass
{


    static function encryptSHA1($password, $salt)
    {
        return sha1($password . $salt);
    }

    static function generateRandomString($length = 8) // генерация соли
    {
        $alpha_numeric = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        return substr(str_shuffle(str_repeat($alpha_numeric, $length)), 0, $length);
    }
}