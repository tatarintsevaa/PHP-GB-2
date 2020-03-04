<?php


namespace app\models;


use app\interfaces\IModel;

abstract class Model implements IModel
{
    protected $id = null;

    public function __set($name, $value)
    {
        if (isset($this->props[$name])) {
            $this->$name = $value;
            $this->props[$name] = true;
        }
    }

    public function __get($name)
    {
        return $this->$name;
    }

}

