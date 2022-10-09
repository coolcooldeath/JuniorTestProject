<?php
include_once "classes/Crud.php";
include_once "classes/Validation.php";
include_once "classes/UserContract.php";
include_once "classes/CryptoClass.php";
include_once "classes/AuthClass.php";

class SignupClass
{

    static function signup()
    { //Метод регистрации

        $validation = new Validation();
        $array_error_messages = $validation->validateAllSignup($_POST, 'email', 'login', 'name',
            'password', 'password_repeat'); // возвращается ассоциативный массив с именами полей и ошибками в них

        if (empty($array_error_messages)) { // ошибок нет

            $emailVal = preg_replace('/\s\s+/', '', htmlspecialchars($_POST['email'])); //htmlspecialchars минимальная защита от инъекций
            $loginVal = preg_replace('/\s\s+/', '', htmlspecialchars($_POST['login']));
            $nameVal = preg_replace('/\s\s+/', '', htmlspecialchars($_POST['name']));
            $passwVal = preg_replace('/\s\s+/', '', htmlspecialchars($_POST['password']));

            $userByLogin = Crud::getUserByLogin($loginVal);
            $userByEmail = Crud::getUserByEmail($emailVal);
            if ($userByLogin != null)
                return json_encode(['login' => Validation::$login_unique_error]);
            else if ($userByEmail != null)
                return json_encode(['email' => Validation::$email_unique_error]);
            else {
                $user = new UserContract($nameVal, $loginVal, $emailVal, $passwVal);/*создание юзера,
                пароль шифруется при создании, вообще надо бы чтобы методы Crud возвращали объект User, однако уже нет времени(
 */
                if (Crud::insert($user->getArray())) {

                    setcookie("login", $user->getLogin(), time() + 3600, "/", $_SERVER['SERVER_NAME']); // создание куки и сессии, надо было бы сделать отдельный класс но уже не успеваю
                    setcookie("password", $user->getPassword(), time() + 3600, "/", $_SERVER['SERVER_NAME']);
                    setcookie("name", $user->getName(), time() + 3600, "/", $_SERVER['SERVER_NAME']);
                    $_SESSION['id'] = $user->getId();
                    return json_encode($array_error_messages);

                } else
                    return json_encode(['email' => "Какая то ошибка! Попробуйте еще раз"]);
            }
        } else
            return json_encode($array_error_messages);

    }
}