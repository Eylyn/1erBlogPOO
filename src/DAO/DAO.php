<?php

namespace App\src\DAO;

use PDO;
use Exception;


abstract class DAO
{
    const DB_HOST = 'mysql:host=localhost;dbname=blogpoo;charset=utf8';
    const DB_USER = 'root';
    const DB_PASS = 'root';

    private $connection;

    private function checkConnection()
    {
        //Vérifie si la connexion est nulle et fait appel à getConnection()
        if($this->connection === null) {
            return $this->getConnection();
        }
        //Si la connexion existe, elle est renvoyée, inutile de refaire une connexion
        return $this->connection;
    }

    private function getConnection()
    {
        //Tentative de connexion à la base de données
        try {
            $this->connection = new PDO(self::DB_HOST, self::DB_USER, self::DB_PASS);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //On renvoie la connexion
            return $this->connection;
        }
        //On lève une erreur si la connexion échoue
        catch (Exception $errorConnection) {
            die('Erreur de connection :' . $errorConnection->getMessage());
        }
    }
    protected function createQuery($sql, $parameters = null)
    {
        if($parameters)
        {
            $result = $this->checkConnection()->prepare($sql);
            $result->setFetchMode(PDO::FETCH_CLASS, static::class);
            $result->execute($parameters);
            return $result;
        }
        $result = $this->checkConnection()->query($sql);
        $result->setFetchMode(PDO::FETCH_CLASS, static::class);
        return $result;
    }
}
