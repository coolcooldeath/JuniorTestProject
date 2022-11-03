<?php
include_once "classes/AuthClass.php";
/*ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);*/
session_start();
setcookie("login", "");
setcookie("password", "");
setcookie("name", "");
unset($_SESSION['id']);
header("location: login.php");



