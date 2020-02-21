<?php
include "../engine/Autoload.php";

use app\models\{Products, Users, Model};
use app\engine\{Autoload, Db};
use app\interfaces\IModel;

spl_autoload_register([new Autoload(), 'loadClass']);

$db = new Db();
$product = new Products($db);
$user = new Users($db);



//echo $product->getOne(2);
echo $user->getOne(1);

//echo $product->getAll();

