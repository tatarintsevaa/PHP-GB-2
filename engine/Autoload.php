<?php

//namespace app\engine;

class Autoload
{
    public function loadClass($className)
    {
        $path = str_replace("\\", "/" , $className);
        $filename = "../{$path}.php";
        if (file_exists($filename)) {
            include $filename;
        }
    }
}