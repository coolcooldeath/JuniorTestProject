<?php
session_start();
error_reporting(E_ERROR | E_PARSE);
include_once "php/classes/AuthClass.php";
if (!AuthClass::isAuth()) {
    header("location: login.php");
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
        <header><?php echo "Hello " . " " . $_COOKIE['name'] ?> </header>

        <form action="#" method="POST" enctype="multipart/form-data">

            <div class="field button">
                <input type="submit" name="submit" value="Выход">
            </div>
        </form>

    </section>
</div>
<script src="js/logout.js"></script>
</body>
</html>