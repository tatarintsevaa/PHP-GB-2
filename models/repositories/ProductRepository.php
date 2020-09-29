<?php

namespace app\models\repositories;

use app\engine\App;
use app\models\Repository;
use app\models\entities\Products;

class ProductRepository extends Repository
{

    public function getPagesCount()
    {
        $sql = "SELECT COUNT(*) FROM products";
        $itemsCount = App::call()->db->queryOne($sql);
        $pageCount = $itemsCount['COUNT(*)'] / App::call()->config['qty_displayed_items'];
        if (gettype($pageCount) !== 'integer') {
            return ($pageCount % 10) + 1;
        }
        return $pageCount;
    }

    public function getTableName()
    {
        return "products";
    }

    public function getEntityClass()
    {
        return Products::class;
    }

}