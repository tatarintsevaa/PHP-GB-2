<?php

namespace app\models;

use app\engine\App;
use app\engine\Db;
use app\interfaces\IModel;
use app\models\Model;

abstract class Repository implements IModel
{

    public function getOne($id)
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = :id";
        return App::call()->db->queryObj($sql, ['id' => $id], $this->getEntityClass());
    }

    public  function getAll()
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName}";
        return App::call()->db->queryAll($sql);
    }

    public function save(Model $entity)
    {
        if (is_null($entity->id)) {
            $this->insert($entity);
        } else {
            return $this->update($entity);
        }
    }



    private function insert(Model $entity)
    {
        $params = [];
        $columns = '';
        $values = '';
        foreach ($entity->props as $key => $value) {
            $params["$key"] = $entity->$key;
            $columns .= "{$key}, ";
            $values .= ":{$key}, ";
        }

        $columns = mb_substr($columns, 0, -2);
        $values = mb_substr($values, 0, -2);
        $tableName = $this->getTableName();
        $sql = "INSERT INTO {$tableName} ($columns) VALUES ($values)";
//        var_dump($sql);
//        var_dump($params);
        App::call()->db->execute($sql, $params);
        $entity->id = App::call()->db->getLustInsertId();
    }

    public function delete(Model $entity)
    {
        $tableName = $this->getTableName();
        $sql = "DELETE FROM {$tableName} WHERE id = :id";
        return App::call()->db->execute($sql, ['id' => $entity->id]);
    }

    private function update(Model $entity)
    {
        $params = [];
        $str = '';
        foreach ($entity->props as $key => $value) {
            if (!$entity->props[$key]) continue;
            $params["$key"] = $entity->$key;
            $str .= "{$key} = :{$key}, ";
        }
        $str = mb_substr($str, 0, -2);
        $tableName = $this->getTableName();
        $sql = "UPDATE {$tableName} SET ";
        $sql .= $str;
        $params['id'] = $entity->id;
        $sql .= " WHERE id = :id";
        return App::call()->db->execute($sql, $params);
    }



    public function showLimit($page, $itemCount = null) {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE 1 LIMIT ?";
        if (!is_null($itemCount)) {
            $sql .= ", ?";
        }
        return App::call()->db->executeLimit($sql, $page, $itemCount);
    }



    public function getOneWhere($field, $value) {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE `$field`=:value";
        return App::call()->db->queryObj($sql, ["value" => $value], $this->getEntityClass());
    }

}