<?php
namespace app\models\entities;


use app\models\Model;

class Cart extends Model
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

}