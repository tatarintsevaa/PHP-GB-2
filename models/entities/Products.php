<?php

namespace app\models\entities;

use app\engine\Db;
use app\models\Model;

class Products extends Model
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





}
