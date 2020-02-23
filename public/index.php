<?php
include realpath("../config/config.php");
include realpath("../engine/Autoload.php");

use app\models\{Products, Users, Basket};
use app\engine\{Autoload, Db};

spl_autoload_register([new Autoload(), 'loadClass']);


$product = new Products("Кофе", "Крепкий", 12);
var_dump($product->getOne(2));

//$product->insert();
//var_dump($product);

//$user = new Users('user1', 123);
//$user->insert();
//var_dump($user->getAll());

//var_dump($product);

//($product->getOne(1));

//var_dump($product->getAll());

//echo $product->getAll();
//$product->delete();

//var_dump($product->getAll());
