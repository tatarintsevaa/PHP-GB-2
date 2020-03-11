<?php
namespace app\models;


use app\engine\Db;

class Cart extends DbModel
{
    protected $id_good;
    protected $session_id;
    protected $qty;

    public $props = [
        'id_good' => false,
        'session_id' => false,
        'qty' => false
    ];


    public function __construct($id_good = null, $session_id = null, $qty = 1, $id = null)
    {
        $this->id_good = $id_good;
        $this->session_id = $session_id;
        $this->qty = $qty;
        $this->id = $id;

    }

    public static function getQty($session_id)
    {
        $sql = "SELECT cart.qty FROM cart WHERE session_id = :session_id";
        $result = DB::getInstance()->queryAll($sql, ['session_id' => $session_id]);
        return array_sum(array_column($result, 'qty'));
    }

    public static function getOneCartItem($id_good, $session_id)
    {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id_good = :id_good AND session_id = :session_id";
        return DB::getInstance()->queryObj($sql, ['id_good' => $id_good, 'session_id' => $session_id], static::class);
    }


    public static function getTableName()
    {
        return "cart";
    }

}