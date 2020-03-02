<?php


namespace app\models;


class Feedback extends DbModel
{
    private $name;
    private $feedback;
    private $id_good;

    public $props = [
        'name' => false,
        'feedback' => false,
        'id_good' => false,
    ];



    public function __construct($name = null, $feedback = null, $id_good = null)
    {
        $this->name = $name;
        $this->feedback = $feedback;
        $this->id_good = $id_good;
    }


    public static function getTableName()
    {
        return "feedback";
    }


}