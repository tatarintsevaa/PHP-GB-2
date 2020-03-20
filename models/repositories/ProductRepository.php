<?php
namespace app\models\repositories;

use app\engine\App;
use app\models\Repository;
use app\engine\Db;
use app\models\entities\Products;

class ProductRepository extends Repository
{

    public function getPagesCount() {
        $sql = "SELECT COUNT(*) FROM products";
        $itemsCount = App::call()->db->queryOne($sql);
        return round($itemsCount['COUNT(*)'] / App::call()->config['qty_displayed_items']);
    }

    public function getTableName()
    {
        return "products";
    }

    public function getEntityClass() {
        return Products::class;
    }

}