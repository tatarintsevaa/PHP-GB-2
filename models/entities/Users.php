<?php

namespace app\models\entities;

use app\models\Model;

class Users extends Model
{
    protected $id;
    protected $login;
    protected $pass;
    protected $hash;
    protected $role;

    protected $props = [
        'login' => false,
        'pass' => false,
        'hash' => false,
        'role' => false
    ];


    public function __construct($login = null, $pass = null, $hash = '', $role = 2)
    {
        $this->login = $login;
        $this->pass = $pass;
        $this->hash = $hash;
        $this->role = $role;
    }




}