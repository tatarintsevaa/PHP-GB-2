<?php


namespace app\models;


class Cart extends Model
{
    public $id;
    public $name;
    public $qty;
    public $price;

    public function getTableName()
    {
        return "cart";
    }

}