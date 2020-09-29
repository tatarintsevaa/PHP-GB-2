<?php


namespace app\models\repositories;


use app\models\entities\Orders;
use app\models\Repository;

class OrdersRepository extends Repository
{

    public function getTableName()
    {
        return "orders";
    }

    public function getEntityClass() {
        return Orders::class;
    }
}