<?php

namespace Home\Solid\Database;

use PDO;
use PDOException;
use Dotenv\Dotenv;

class Connection
{
    private static ?PDO $pdo = null;
    public static function getConnection(): PDO{

        if (!getenv('DB_HOST')) {
            $dotenv = Dotenv::createImmutable(__DIR__ . '/../../..'); // adjust path as needed
            $dotenv->load();
        }
        $host = $_ENV['DB_HOST'] ?? getenv('DB_HOST');
        $dbname = $_ENV['DB_NAME'] ?? getenv('DB_NAME');
        $user = $_ENV['DB_USER'] ?? getenv('DB_USER');
        $pass = $_ENV['DB_PASS'] ?? getenv('DB_PASS');
        $port = $_ENV['DB_PORT'] ?? getenv('DB_PORT') ?: 3306;

        
        
        if(self::$pdo === null) {
            try{
                $dsn = 'mysql:host=' . $host . 
                       ';port=' . $port . 
                       ';dbname=' . $dbname;
                       self::$pdo = new PDO($dsn, $user, $pass);
                       self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }catch (PDOException $e) {
                die('Database connection error: ' . $e->getMessage());
            }
        }
        return self::$pdo;
    }
}