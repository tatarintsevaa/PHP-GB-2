<?php


namespace app\controllers;

use app\engine\App;
use app\engine\Render;
use app\interfaces\IRenderer;
use app\models\Users;


abstract class Controller
{
    private $action;
    private $defaultAction = 'index';
    private $layout = 'main';
    private $useLayout = true;
    private $renderer;


    public function __construct(IRenderer $renderer)
    {
        $this->renderer = $renderer;
    }


    public function runAction($action = null)
    {
        $this->action = $action ?: $this->defaultAction;
        $method = "action" . ucfirst($this->action);
        if (method_exists($this, $method)) {
            $this->$method();
        } else {
           echo $this->render('error');
        }
    }


    public function render($templates, $params = [])
    {
        if ($this->useLayout) {
            return $this->renderTemplate("layouts/{$this->layout}", [
                'header' => $this->renderTemplate('header', [
                    'cartBtn' => $this->renderTemplate('cartBtn', [
                        'auth' => App::call()->usersRepository->isAuth(),
                        'username' => App::call()->usersRepository->getName(),
                    ])
                ]),
                'menu' => $this->renderTemplate('menu'),
                'content' => $this->renderTemplate($templates, $params)
            ]);
        } else {
            $this->renderTemplate($templates, $params);
        }
    }

    public function renderTemplate($templates, $params = [])
    {
        return $this->renderer->renderTemplate($templates, $params);
    }
}