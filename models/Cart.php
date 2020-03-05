<?php
namespace app\models;


use app\engine\Db;

class Cart extends DbModel
{
    protected $session_id;
    protected $goods_id;

    public $props = [
        'session_id' => false,
        'goods_id' => false,
    ];


    public function __construct($session_id = null, $goods_id = null)
    {
        $this->session_id = $session_id;
        $this->goods_id = $goods_id;
    }

    public static function getQty($session_id)
    {
        $sql = "SELECT cart.qty FROM cart WHERE session_id = :session_id";
        $result = DB::getInstance()->queryAll($sql, ['session_id' => $session_id]);
        return array_sum(array_column($result, 'qty'));
    }


    public static function getTableName()
    {
        return "basket";
    }

}