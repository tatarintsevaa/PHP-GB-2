<?php

class ProductList
{
    public $products;

    /**
     * ProductList constructor.
     * @param $products
     */
    public function __construct($products = [])
    {
        $this->products = $products;
    }

    public function render()
    {
        foreach ($this->products as $product) {
            echo "<div>{$product['name']} <strong>Цена {$product['price']} $</strong></div>";
        }
        echo "<hr>";
    }

}

class Cart extends ProductList
{
    public $clientName;


    public function __construct($products = [], $clientName = null)
    {
        parent::__construct($products);
        $this->clientName = $clientName;
    }

    public function render() {
        echo "<div>Корзина клиента {$this->clientName}</div>";
        parent::render();
    }

}

$products = [
    ['name' => 'Телевизор', 'price' => 100],
    ['name' => 'Телефон', 'price' => 50],
    ['name' => 'Плеер', 'price' => 25]
];

function displayProductList(ProductList $list) {
    $list->render();
}

$catalog = new ProductList($products);
$cart = new Cart($products, "Иван Васильевич");
displayProductList($catalog);
displayProductList($cart);
?>

<ul>
    <li><a href="/task5.php">Задание 5</a></li>
</ul>
//$catalog = new ProductList($products);
//$catalog->render();
//
//$cart = new Cart($products, "Иван Васильевич");
//$cart->render();







