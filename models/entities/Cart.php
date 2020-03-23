<?php
namespace app\models\entities;


use app\models\Model;

class Cart extends Model
{
    protected $id_good;
    protected $session_id;
    protected $qty;
    protected $user;

    public $props = [
        'id_good' => false,
        'session_id' => false,
        'qty' => false,
        'user' => false
    ];


    public function __construct($id_good = null, $session_id = null, $user = null, $qty = 1, $id = null)
    {
        $this->id_good = $id_good;
        $this->session_id = $session_id;
        $this->user = $user;
        $this->qty = $qty;
        $this->id = $id;
    }

}