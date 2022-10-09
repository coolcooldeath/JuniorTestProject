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
    <title>TestProject</title>
    <link rel="stylesheet" type="text/css" href="css/style.css"/>

</head>

<body>

<div class="wrapper">
    <section class="form signup">
        <header>Регистрация</header>
        <form action="#" method="POST" enctype="multipart/form-data" autocomplete="on">

            <div class="login-details">
                <div class="field input">
                    <input type="text" maxlength="40" name="name" placeholder="Введите ваше имя">
                    <div id="name-error-text" class="error-text"></div>
                </div>
            </div>

            <div class="login-details">
                <div class="field input">
                    <input type="text" maxlength="40" name="login" placeholder="Введите логин">
                    <label id="login-error-text" class="error-text"></label>
                </div>
            </div>

            <div class="field input">
                <input type="text" maxlength="45" name='email' placeholder="Введите почту">
                <label id="email-error-text" class="error-text"></label>
            </div>
            <div class="field input">
                <input type="password" maxlength="40" name="password" placeholder="Введите пароль">
                <label id="password-error-text" class="error-text"></label>

            </div>
            <div class="field input">
                <input type="password" maxlength="40" name="password_repeat" placeholder="Подтвердите пароль">
                <label id="password-repeat-error-text" class="error-text"></label>
            </div>
            <div class="field button">
                <input type="submit" name="submit" value="Регистрация">
            </div>
        </form>
        <div class="link">Уже зарегистрированы? <a href="login">Войти</a></div>
    </section>
</div>


<script src="js/signup.js"></script>
</body>
</html>