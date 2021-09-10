<?php

namespace App\Src\DAO;

use PDO;
use Exception;

abstract class DAO
{
    private $connection;

    private function checkConnection()
    {
        if ($this->connection === null) {
            return $this->getConnection();
        }
        return $this->connection;
    }

    private function getConnection()
    {
        try {
            $this->connection = new PDO($_ENV["DB_HOST"], $_ENV["DB_USER"], $_ENV["DB_PASSWORD"]);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return  $this->connection;
        } catch (Exception $errorConnection) {
            die("Erreur de connection :" . $errorConnection->getMessage());
        }
    }

    protected function createQuery($sql, $parameters = null)
    {
        if ($parameters) {
            $result = $this->checkConnection()->prepare($sql);
            $result->execute($parameters);
            return $result;
        } else {
            $result = $this->checkConnection()->query($sql);
            return $result;
        }
    }
}