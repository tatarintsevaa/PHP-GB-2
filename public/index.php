<?php
include "../engine/Autoload.php";

use app\models\{Products, Users, Model};
use app\engine\{Autoload, Db};
use app\interfaces\IModel;

spl_autoload_register([new Autoload(), 'loadClass']);

//TODO подумать как избавиться от дублирования new Db()
$product = new Products(new Db());
$user = new Users(new Db());



//echo $product->getOne(2);
echo $user->getOne(1);

//echo $product->getAll();

