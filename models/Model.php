<?php


namespace app\models;


abstract class Model
{
    protected $id = null;

    public function __set($name, $value)
    {
        if (property_exists($this, $name)) {
            $this->$name = $value;
            $this->props[$name] = true;
        }
    }

    public function __get($name)
    {
        if (property_exists($this, $name)) {
            return $this->$name;
        }
    }

    public function __isset($name)
    {
        return isset($this->$name);
    }

}

