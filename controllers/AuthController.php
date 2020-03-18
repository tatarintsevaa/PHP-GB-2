<?php


namespace app\controllers;


use app\engine\App;

class AuthController extends Controller
{
    public function actionIndex()
    {
        echo $this->render('auth');
    }

    public function actionLogin()
    {
        $login = App::call()->request->getParams()['login'];
        $pass = App::call()->request->getParams()['pass'];
        $save = App::call()->request->getParams()['save'];
        if (App::call()->usersRepository->auth($login, $pass)) {
            if (isset($save)) {
                App::call()->usersRepository->updateHash();
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