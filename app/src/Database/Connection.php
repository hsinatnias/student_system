<?php

namespace Home\Solid\Database;

use PDO;
use PDOException;

class Connection
{
    private static ?PDO $pdo = null;
    public static function getConnection(): PDO{
        if(self::$pdo === null) {
            try{
                $dsn = 'mysql:host=' . $_ENV['DB_HOST'] . 
                       ';port=' . $_ENV['DB_PORT'] . 
                       ';dbname=' . $_ENV['DB_NAME'];
                       self::$pdo = new PDO($dsn, $_ENV['DB_USER'], $_ENV['DB_PASSWORD']);
                       self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }catch (PDOException $e) {
                die('Database connection error: ' . $e->getMessage());
            }
        }
        return self::$pdo;
    }
}