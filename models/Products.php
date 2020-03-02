<?php

namespace app\models;

use app\engine\Db;

class Products extends DbModel
{
    private $name;
    private $description;
    private $price;

    public $props = [
        'name' => false,
        'description' => false,
        'price' => false,
    ];
//TODO придумать как перенести методы в родительский класс чтобы работало.

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

    public function __construct($name = null, $description = null, $price = null)
    {
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
    }


    public static function getTableName()
    {
        return "products";
    }


}
