<?php

include_once "php/classes/AuthClass.php";
session_start();
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$segments = explode('/', trim($uri, '/'));
if ($segments[2] === 'login') {

    include 'login.php';
} else if ($segments[2] === 'registry') {

    include 'signup.php';
} else if ($segments[2] === 'hello_user' && AuthClass::isAuth())
    include 'hello_user.php';
else if ($segments[2] === 'hello_user')
    include 'login.php';
else if ($segments[2] === 'php')
    include 'login.php';
else
    include 'error404.php';


