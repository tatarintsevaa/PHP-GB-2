<?php


namespace app\engine;


class Session
{
    protected $session_id;

    public function __construct()
    {
        session_start();
        $this->session_id = session_id();
    }


    public function getSessionId()
    {
        return $this->session_id;
    }


    public function setSessionId($session_id)
    {
        $this->session_id = $session_id;
    }








}