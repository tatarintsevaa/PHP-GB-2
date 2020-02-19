<?php
include "../engine/Autoload.php";

//use app\models\{Products, Users};
//use app\engine\Autoload;

spl_autoload_register([new Autoload(), 'loadClass']);

//TODO подумать как избавиться от дублирования new Db()
$product = new Products(new Db());
$user = new Users(new Db());

function foo(IModel $model) {
    var_dump($model instanceof Model);
}

//echo $product->getOne(2);
echo $user->getOne(1);

//echo $product->getAll();

