<?php


namespace app\controllers;


abstract class Controller
{
    private $action;
    private $defaultAction = 'index';
    private $layout = 'main';
    private $useLayout = true;

    public function runAction($action = null)
    {
        $this->action = $action ?: $this->defaultAction;
        $method = "action" . ucfirst($this->action);
//        var_dump($method);
        if (method_exists($this, $method)) {
            $this->$method();
        } else die("404 - controller");
    }

    public function render($templates, $params = [])
    {
        if ($this->useLayout) {
            return $this->renderTemplate("layouts/{$this->layout}", [
                'header' => $this->renderTemplate('header', [
                    'cart' => $this->renderTemplate('cart', $params)
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
        ob_start();
        extract($params);
        $templatesPath = TEMPLATES_DIR . $templates . ".php";
        if (file_exists($templatesPath)) {
            include $templatesPath;
        }
        return ob_get_clean();
    }
}