<?php
namespace app\models;


class Basket extends DbModel
{
    private $id;
    private $session_id;
    private $goods_id;


    public function __construct($session_id = null, $goods_id = null)
    {
        $this->session_id = $session_id;
        $this->goods_id = $goods_id;
    }


    public static function getTableName()
    {
        return "basket";
    }

}