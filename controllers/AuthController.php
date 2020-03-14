<?php


namespace app\controllers;


use app\engine\Request;
use app\models\Users;

class AuthController extends Controller
{
    public function actionIndex()
    {
        echo $this->render('auth');
    }

    public function actionLogin()
    {
        $login = (new Request())->getParams()['login'];
        $pass = (new Request())->getParams()['pass'];
        $save = (new Request())->getParams()['save'];
        if (Users::auth($login, $pass)) {
            if (isset($save)) {
                Users::updateHash($login);
            }
            header("Location: /");
        } else {
            Die("Не верный пароль!");
        };
    }

    public function actionLogout()
    {
        session_destroy();
        setcookie("hash", "", time() - 3600, "/");
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    }

}