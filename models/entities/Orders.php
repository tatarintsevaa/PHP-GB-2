<?php


namespace app\models\entities;


use app\models\Model;

class Orders extends Model
{
    protected $session_id;
    protected $name;
    protected $phone;
    protected $status;
    protected $price;
    protected $user;

    public $props = [
        'session_id' => false,
        'name' => false,
        'phone' => false,
        'price' => false,
        'status' => false,
        'user' => false
    ];

    public function __construct($session_id = null, $name = null, $phone = null, $price = null, $status = 1, $user = 'guest')
    {
        $this->session_id = $session_id;
        $this->name = $name;
        $this->phone = $phone;
        $this->price = $price;
        $this->status = $status;
        $this->user = $user;
    }


}