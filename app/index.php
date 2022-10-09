<?php

include_once "php/classes/AuthClass.php";
session_start();
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$segments = explode('/', trim($uri, '/'));
if ($segments[2] === 'login'&&empty($segments[3]))
    include 'login.php';
else if ($segments[2] === 'registry'&&empty($segments[3]))
    include 'signup.php';
else if (empty($segments[2]))
    include 'signup.php';
else if ($segments[2] === 'hello_user' && AuthClass::isAuth() &&empty($segments[3]))
    include 'hello_user.php';
else if ($segments[2] === 'hello_user' &&empty($segments[3]))
    include 'login.php';
else if ($segments[2] === 'php' &&empty($segments[3]))
    include 'login.php';
else
    include 'error404.php';


