<?php


namespace app\controllers;


use app\engine\App;
use app\models\entities\Users;

class AuthController extends Controller
{
    public function actionSignIn()
    {
        echo $this->render('auth', ['action' => 'signIn',
            'backpath' => App::call()->request->getParams()['backpath']]);
    }

    public function actionSignUp()
    {
        echo $this->render('auth', ['action' => 'signUp',
                                              'message' => App::call()->request->getParams()['message'],
                                              'backpath' => App::call()->request->getParams()['backpath']]);
    }

    public function actionLogin()
    {
        $login = App::call()->request->getParams()['login'];
        $pass = App::call()->request->getParams()['pass'];
        $save = App::call()->request->getParams()['save'];

        $backpath = App::call()->request->getParams()['backpath'];
        if (App::call()->usersRepository->auth($login, $pass)) {
            if (isset($save)) {
                App::call()->usersRepository->updateHash();
            }
            header("Location: {$backpath}");
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

    public function actionRegistration()
    {
        $login = App::call()->request->getParams()['login'];
        $pass = App::call()->request->getParams()['pass'];
        $backpath = App::call()->request->getParams()['backpath'];
        if (!App::call()->usersRepository->getOneWhere('login', $login)) {
            $user = new Users($login,password_hash($pass, PASSWORD_DEFAULT));
            App::call()->usersRepository->save($user);
            header("Location: /auth/signIn/?backpath={$backpath}");
        } else {
            $message = "Имя {$login} уже занято";
//            header("Location: {$_SERVER['HTTP_REFERER']}?message = Имя {$login} уже занято");
            header("Location: /auth/signUp/?message={$message}&backpath={$backpath}");
        }
    }

}