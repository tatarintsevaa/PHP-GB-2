<?php

namespace app\models;

class Users extends DbModel
{
    protected $id;
    protected $login;
    protected $pass;
    protected $hash;

    protected $props = [
        'login' => false,
        'pass' => false,
        'hash' => false
    ];


    public function __construct($login = null, $pass = null)
    {
        $this->login = $login;
        $this->pass = $pass;
    }

    public static function isAuth()
    {
        if (isset($_COOKIE["hash"])) {
            $hash = $_COOKIE["hash"];
            $user = static::getOneWhere('hash', $hash);
            $userName = $user->login;
            if (!empty($userName)) {
                $_SESSION['login'] = $userName;
            }
        }
        return isset($_SESSION['login']);
    }

    public static function getName()
    {
        return $_SESSION['login'];
    }

    public static function auth($login, $pass)
    {
        $user = static::getOneWhere('login', $login);
        if (password_verify($pass, $user->pass)) {
            $_SESSION['login'] = $login;
            return true;
        } else {
            return false;
        }
    }

    public static function updateHash($login)
    {
        /**
         * @var DbModel $user
         */
        $user = static::getOneWhere('login', $login);
        $hash = uniqid(rand(), true);
        $user->__set('hash', $hash);
        $user->save();
        setcookie("hash", $hash, time() + 3600);
    }


    public static function getTableName()
    {
        return "users";
    }


}