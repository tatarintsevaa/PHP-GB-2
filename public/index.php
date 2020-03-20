<?php
session_start();

use app\engine\App;
use app\engine\Autoload;

//include realpath("../engine/Autoload.php");


$config = include __DIR__ . "/../config/config.php";

//spl_autoload_register([new Autoload(), 'loadClass']);

include realpath("../vendor/Autoload.php");



//$product = (new ProductRepository())->getOne(1);
//$product->price = 125;
//(new ProductRepository())->save($product);
//var_dump($_SESSION);
//
//die();

try {
    App::call()->run($config);
} catch (\PDOException $e) {
    $controller = new ProductController(new Render());
    echo $controller->render('error', ['message' => $e->getMessage()]);
//    echo $e->getMessage();
} catch (\Exception $e) {
    var_dump($e);
}





///**
// * @var Products $product
// */
//$product = Products::getOne(2);
//var_dump($product);
//$product->price = 120;
//var_dump($product);
//$product->save();
//$product = new Products("Кофе", "Крепкий", 12);
//var_dump($product->getOne(2));
//var_dump($product::getAll());
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
