<?php
session_start();
include realpath("../config/config.php");
include realpath("../engine/Autoload.php");

use app\models\{Products, Users, Cart};
use app\engine\{Autoload, Render, TwigRender, Request};

spl_autoload_register([new Autoload(), 'loadClass']);

include realpath("../vendor/Autoload.php");


$request = new Request();

$controllerName = $request->getControllerName();
$actionName = $request->getActionName();

//var_dump($controllerName, $actionName);


$controllerClass = CONTROLLER_NAMESPACE . ucfirst($controllerName) . "Controller";
//var_dump("Controller" . "-" . $controllerClass);
//var_dump("Action" . "-" .$actionName);

if (class_exists($controllerClass)) {
    $controller = new $controllerClass(new Render());
    $controller->runAction($actionName);
//    $request = new Request(); возможо здесь нужно создать
} else die("404 - index");





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
