<?php


namespace app\engine;


use app\interfaces\IRenderer;

class Render implements IRenderer
{
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