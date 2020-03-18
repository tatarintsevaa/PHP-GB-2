<?php


namespace app\engine;


use app\interfaces\IRenderer;

class Render implements IRenderer
{
    public function renderTemplate($templates, $params = [])
    {
        ob_start();
        extract($params);
        $templatesPath = App::call()->config['templates_dir'] . $templates . ".php";
        if (file_exists($templatesPath)) {
            include $templatesPath;
        }
        return ob_get_clean();
    }
}