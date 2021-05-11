<?php

namespace app\services;

use PDOException;

class Db 
{   
    private $connection = null;
    

    public function getConnection()
    {
        if(is_null($this->connection))
        {
            // $user='3789586_test';
            // $password='NOloveever123';
            // try {
            //     $this->connection = new \PDO
            //     (
            //     'mysql:host=fdb29.awardspace.net;dbname=3789586_test',
            //     $user, 
            //     $password  
            //     );
            // } catch (PDOException $e) {
            //     echo $e->getMessage();
            // }

            try {
                $this->connection = new \PDO('sqlite:F:\HeidiSQL\test');
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
        return $this->connection;
    }

    public function execute($sql, $params = [])
    {
        return $this->query($sql, $params)->rowCount();
    }

    public function query($sql, $params = [])
    {
        $pdoStatement = $this->getConnection()->prepare($sql);
        $pdoStatement->execute($params);
        return $pdoStatement;
    }

    public function queryAll($sql, $params = [])
    {
        $pdoStatement = $this->query($sql, $params);
        $pdoStatement->setFetchMode(\PDO::FETCH_ASSOC);
        return  $pdoStatement->fetchAll();
        
    }

    public function queryOne($sql, $params = [])
    {
        return $this->queryAll($sql, $params)[0];
    }
}