<?php

namespace app\models;

use app\engine\Db;
use app\interfaces\IModel;

abstract class Model implements IModel
{




    public static function getOne($id)
    {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = :id";
        return DB::getInstance()->queryObj($sql, ['id' => $id], static::class);
    }

    public static function getAll()
    {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName}";
        return DB::getInstance()->queryAll($sql);
    }

    public function insert()
    {
        $params = [];
        $columns = '';
        $values = '';
        foreach ($this as $key => $value) {
            if ($key != 'id' && $key != 'db') {
                $params += [$key => $value];
                $columns .= "{$key}, ";
                $values .= ":{$key}, ";
            }
        }
        $columns = mb_substr($columns, 0, -2);
        $values = mb_substr($values, 0, -2);

        $sql = "INSERT INTO {$this->getTableName()}($columns) VALUES ($values)";
        $this->db->execute($sql, $params);
        $this->id = $this->db->getLustInsertId();
    }

    public function delete()
    {
        $sql = "DELETE FROM {$this->getTableName()} WHERE id = :id";
        $this->db->execute($sql, ['id' => $this->id]);
    }

    public function update()
    {
        $params = [];
        $columns = [];
        var_dump($this->props);
        foreach ($this->props as $key => $value) {
            if ($value == true) {
                $params[":{$key}"] = $this->$key;
                $columns[] = "`$key`";
                $this->props[$key] = false;
            }
        }
        $columns = implode(", ", $columns);
        $values = implode(", ", array_keys($params));

        var_dump($params);
        var_dump($this->props);
        die();

        $sql = "UPDATE {$this->getTableName()} SET ({$columns}) VALUES ({$values})";
        Db::getInstance()->execute($sql, $params);

    }


    abstract public static function getTableName();
}