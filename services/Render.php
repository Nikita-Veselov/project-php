<?php

namespace app\services;

class Render 
{
    public function render($template, $params = []) 
    {
        ob_start();
        $templatePath = __DIR__ . "/../views/" . $template . ".php";
        extract($params);
        require $templatePath;
        return ob_get_clean();
    }
}
