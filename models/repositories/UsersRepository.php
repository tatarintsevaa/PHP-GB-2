<?php
namespace app\models\repositories;

use app\engine\App;
use app\models\Repository;
use app\models\entities\Users;

class UsersRepository extends Repository
{
    public function isAuth()
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

    public function getName()
    {
        return $_SESSION['login'];
    }

    public function isAdmin() {
        $login = $this->getName();
        $user = static::getOneWhere('login', $login);
        return $user->role == 1 ? true : false;
    }

    public function auth($login, $pass)
    {
        $user = static::getOneWhere('login', $login);
        if (password_verify($pass, $user->pass)) {
            $_SESSION['login'] = $login;
            $_SESSION['id'] = $user->id;
            return true;
        } else {
            return false;
        }
    }

    public function updateHash()
    {
        $id = (int)$_SESSION['id'];
        $user = App::call()->usersRepository->getOneWhere('id', $id);
        $hash = uniqid(rand(), true);
//        $user->__set('hash', $hash);
        $user->hash = $hash;
        App::call()->usersRepository->save($user);
        setcookie("hash", $hash, time() + 3600, "/");
    }

    public function getTableName()
    {
        return "users";
    }

    public function getEntityClass() {
        return Users::class;
    }

}