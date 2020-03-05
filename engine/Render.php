<?php


namespace app\engine;


class Render
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