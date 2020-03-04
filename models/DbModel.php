<?php

namespace app\models;

use app\engine\Db;

abstract class DbModel extends Model
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

    public function save()
    {
        if (is_null($this->id)) {
            $this->insert();
        } else {
            return $this->update();
        }
    }

    private function insert()
    {
        $params = [];
        $columns = '';
        $values = '';
        foreach ($this->props as $key => $value) {
            $params["$key"] = $this->$key;
            $columns .= "{$key}, ";
            $values .= ":{$key}, ";
        }
        $columns = mb_substr($columns, 0, -2);
        $values = mb_substr($values, 0, -2);
        $sql = "INSERT INTO {$this->getTableName()} ($columns) VALUES ($values)";
        DB::getInstance()->execute($sql, $params);
        $this->id = DB::getInstance()->getLustInsertId();
    }

    public function delete()
    {
        $sql = "DELETE FROM {$this->getTableName()} WHERE id = :id";
        return DB::getInstance()->execute($sql, ['id' => $this->id]);
    }

    private function update()
    {
        $params = [];
        $str = '';
        foreach ($this->props as $key => $value) {
            if (!$this->props[$key]) continue;
            $params["$key"] = $this->$key;
            $str .= "{$key} = :{$key}, ";
        }
        $str = mb_substr($str, 0, -2);
        $sql = "UPDATE {$this->getTableName()} SET ";
        $sql .= $str;
        $params['id'] = $this->id;
        $sql .= " WHERE id = :id";
        return Db::getInstance()->execute($sql, $params);
    }

    public static function getAllFeedback($id)
    {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id_good = :id ORDER BY id DESC";
        return DB::getInstance()->queryAll($sql, ['id' => $id]);
    }

    public static function showLimit($page) {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE 1 LIMIT ?, 2";
        return Db::getInstance()->executeLimit($sql, $page);
    }


    abstract public static function getTableName();
}