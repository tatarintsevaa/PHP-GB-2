<?php
namespace app\models;


class Basket extends Model
{
    public $id;
    public $session_id;
    public $goods_id;


    public function __construct($session_id, $goods_id)
    {
        parent::__construct();
        $this->session_id = $session_id;
        $this->goods_id = $goods_id;
    }


    public function getTableName()
    {
        return "basket";
    }

}