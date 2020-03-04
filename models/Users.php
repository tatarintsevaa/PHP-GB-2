<?php

namespace app\models;

class Users extends DbModel
{
    protected $login;
    protected $pass;


    public function __construct($login = null, $pass = null)
    {
        $this->login = $login;
        $this->pass = $pass;
    }


    public static function getTableName()
    {
        return "users";
    }


}