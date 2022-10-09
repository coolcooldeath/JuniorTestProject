<?php

include_once "classes/CryptoClass.php";

class UserContract
{

    private $name, $login, $email, $password, $id, $salt;

    function __construct($name, $login, $email, $password)
    {
        $this->name = $name;
        $this->login = $login;
        $this->email = $email;
        $this->id = time();
        $this->salt = CryptoClass::generateRandomString();
        $this->password = CryptoClass::encryptSHA1($password, $this->salt);

    }

    /**
     * @param mixed $login
     */
    public function setLogin($login)
    {
        $this->login = $login;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getArray()
    {
        return ['id' => $this->getId(), 'name' => $this->getName(), 'email' => $this->getEmail(),
            'login' => $this->getLogin(), 'password' => $this->getPassword(), 'salt' => $this->getSalt()];
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return false|string
     */
    public function getSalt()
    {
        return $this->salt;
    }


}
