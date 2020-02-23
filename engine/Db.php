<?php

namespace app\engine;

use app\traits\Tsingletone;
use http\Params;

class Db
{
    private $config = [
        'driver' => 'mysql',
        'host' => 'localhost',
        'login' => 'root',
        'password' => '',
        'database' => 'shop',
        'charset' => 'utf8'
    ];

    use Tsingletone;

    private $connection = null;

    private function getConnection() {
        if (is_null($this->connection)) {
            //var_dump("Подключаюсь К БД");
            $this->connection = new \PDO(
                $this->prepareDSNString(),
                $this->config['login'],
                $this->config['password']
            );
            $this->connection->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
        }
        return $this->connection;
    }
    private function prepareDSNString() {
        return sprintf("%s:host=%s;dbname=%s;charset=%s",
            $this->config['driver'],
            $this->config['host'],
            $this->config['database'],
            $this->config['charset']
        );
    }

//"SELECT * FROM products WHERE id = :id;", ["id" => 1]
    private function query($sql, $params){
        $pdoStatement = $this->getConnection()->prepare($sql);
        $pdoStatement->execute($params);
        return $pdoStatement;
    }
    private function queryObj($sql, $params){
        $pdoStatement = $this->getConnection()->prepare($sql);
        $pdoStatement->setFetchMode(\PDO::FETCH_OBJ);
// А так ругаеться на драйвер. Почему?
//        $pdoStatement->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_OBJ);
        $pdoStatement->execute($params);
        return $pdoStatement;
    }

    public function execute($sql, $params) {
        $this->query($sql, $params);
        return true;
    }


    public function queryOne($sql, $params = []) {
        return $this->queryObj($sql, $params)->fetch();
//        return $this->queryObj($sql, $params)->fetchObject(); А ведь можно на прямую...разве так не проще? В чем разница?
    }

    public function queryAll($sql, $params = []) {
        return $this->query($sql, $params)->fetchAll();
    }

    public function getLustInsertId() {
        return $this->getConnection()->lastInsertId();
    }

    public function __toString()
    {
        return "Db";
    }
}