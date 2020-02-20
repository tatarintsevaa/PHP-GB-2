<?php


namespace app\models;

class Orders extends Model
{
    public $id;
    public $user;
    public $status;


    public function getTableName() {
        return 'orders';
    }
}