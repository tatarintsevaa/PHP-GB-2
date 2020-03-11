<?php

namespace app\models;

use app\engine\Db;

class Products extends DbModel
{
    protected $name;
    protected $description;
    protected $price;

    public $props = [
        'name' => false,
        'description' => false,
        'price' => false,
    ];

    public function __construct($name = null, $description = null, $price = null)
    {
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
    }

    public static function getPagesCount() {
        $sql = "SELECT COUNT(*) FROM products";
        $itemsCount = Db::getInstance()->queryOne($sql);
        return round($itemsCount['COUNT(*)'] / PAGINATION_ITEM_COUNT);
    }


    public static function getTableName()
    {
        return "products";
    }


}
