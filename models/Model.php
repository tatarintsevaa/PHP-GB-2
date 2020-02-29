<?php


namespace app\models;


use app\interfaces\IModel;

abstract class Model implements IModel
{
    protected $id = null;
    public function __get($name)
    {
        return $this->$name;
    }

}