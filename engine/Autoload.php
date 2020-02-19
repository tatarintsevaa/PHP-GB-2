<?php

//namespace app\engine;

class Autoload
{
    //TODO Переписать автозагрузчик через пространство имен
    private $path = [
        'models',
        'interfaces',
        'engine'
    ];

    public function loadClass($className) {
        //TODO убрать цикл и построить из $className правильный путь к классу (.php)
        foreach ($this->path as $path) {
            $fileName = "../{$path}/{$className}.php";
            //var_dump($className);
            if (file_exists($fileName)) {
                include $fileName;
                break;
            }
          }
    }
}