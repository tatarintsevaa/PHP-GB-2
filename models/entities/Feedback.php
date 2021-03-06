<?php


namespace app\models\entities;


use app\models\Model;

class Feedback extends Model
{
    protected $name;
    protected $feedback;
    protected $id_good;

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

}