<?php

use app\models\entities\Products;

class ProductsTest extends \PHPUnit\Framework\TestCase {
    /**
     * @dataProvider providerProducts
     */
    public function testProducts($a, $b) {
        $product = new Products($a);
        $this->assertEquals($b, $product->name);
    }

    public function providerProducts() {
        return array (
            array ('sdkjfhksdjfh', 'sdkjfhksdjfh'),
            array ('#_MD8798', '#_MD8798')
        );
    }


    //strpos(Product::class, "app\\") === 0
    //array_slice(explode("\\", get_class(new Product())), 1, 1)===['models']
    //substr_count(Product::class, "\\" ) === 3
}