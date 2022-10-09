<?php
session_start();
include_once "php/classes/AuthClass.php";
if (AuthClass::isAuth()) {
    header("location: hello_user");
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Логин</title>
    <link href="css/style.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="wrapper">
    <section class="form login">
        <header>Войти</header>
        <form action="#" method="POST" enctype="multipart/form-data" autocomplete="off">
            <div class="field input">
                <input type="text" name="login" maxlength="40" placeholder="Введите логин">
                <label id="login-error-text" class="error-text"></label>
            </div>
            <div class="field input">

                <input type="password" name="password" maxlength="40" placeholder="Введите пароль">
                <label id="password-error-text" class="error-text"></label>
            </div>
            <div class="field button">
                <input type="submit" name="submit" value="Войти">
            </div>
        </form>
        <div class="link">Не зарегистрированы? <a href="registry">Регистрация</a></div>
    </section>
</div>


<script src="js/login.js"></script>


</body>
</html>
