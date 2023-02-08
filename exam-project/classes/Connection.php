<?php

namespace classes;

use PDO;

class Connection
{
    const HOST = 'localhost';

    const USERNAME = 'root';

    const PASSWORD = 'password';
    const PORT = '3306';

    const DATABASE_NAME = 'project';

    public $pdo;

    public function __construct()
    {
        $options = [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        ];

        $host    = self::HOST;
        $dbName  = self::DATABASE_NAME;
        $port    = self::PORT;

        $dsn = "mysql:host=$host;dbname=$dbName;port=$port;charset=utf8mb4";

        try {
            $this->pdo = new \PDO($dsn, self::USERNAME, self::PASSWORD, $options);
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int) $e->getCode());
        }
    }

    public function run($sql, $args = null)
    {
        if (!$args) {
            return $this->pdo->query($sql);
        }
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($args);
        return $stmt->fetchAll();
    }


}


$connect = new Connection();
