<?php


namespace app\engine;


class Session
{
    private $session_id;

    public function __construct()
    {
        session_start();
        $this->session_id = session_id();
    }

}