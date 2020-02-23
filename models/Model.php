<?php

namespace app\models;

use app\engine\Db;
use app\interfaces\IModel;

abstract class Model implements IModel
{
    protected $db;

    public function __construct()
    {
        $this->db = Db::getInstance();
    }


    public function getOne($id)
    {
        $sql = "SELECT * FROM {$this->getTableName()} WHERE id = :id";
        return $this->db->queryOne($sql, ['id' => $id]);
    }

    public function getAll()
    {
        $sql = "SELECT * FROM {$this->getTableName()}";
        return $this->db->queryAll($sql);
    }

    public function insert()
    {
        $params = [];
        $rows = '';
        $values = '';
        foreach ($this as $key => $value) {
            if ($key != 'id' && $key != 'db') {
                $params += [$key => $value];
                $rows .= "{$key}, ";
                $values .= ":{$key}, ";
            }
        }
        $rows = mb_substr($rows, 0, -2);
        $values = mb_substr($values, 0, -2);

        $sql = "INSERT INTO {$this->getTableName()}($rows) VALUES ($values)";
        $this->db->execute($sql, $params);
        $this->id = $this->db->getLustInsertId();
    }

    public function delete() {
        $sql = "DELETE FROM {$this->getTableName()} WHERE id = :id";
        $this->db->execute($sql,['id' => $this->id]);
    }

    abstract public function getTableName();
}