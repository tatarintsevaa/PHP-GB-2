<?php

namespace app\engine;

class Autoload
{
    public function loadClass($className)
    {
        $path = str_replace(['app', '\\'], ['','/'] , $className);
        $filename = "..{$path}.php";
        if (file_exists($filename)) {
            include $filename;
        }
    }
}