<?php

use app\models\entities\Products;
use PHPUnit\Framework\TestCase;

class ProductsTest extends TestCase {
    /**
     * @dataProvider providerProducts
     * @param $name
     * @param $description
     * @param $price
     */
    public function testProducts($name, $description, $price) {
        $product = new Products($name, $description, $price);
        $this->assertEquals($name, $product->name);
        $this->assertEquals($description, $product->description);
        $this->assertEquals($price, $product->price);
        $this->assertEquals(strpos(Products::class, "app\\"), 0);
        $this->assertEquals(array_slice(explode("\\", get_class(new Products())), 1, 1), ['models']);
        $this->assertEquals(substr_count(Products::class, "\\" ), 3);


    }

    public function providerProducts() {
        return [
            ['Ч@й' , 'с лимоном', 12],
            ['#_MD8798', '#_MD879sadsa s 8', 16E-6],
        ];
    }

}