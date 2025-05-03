<?php

namespace App\config;
require_once dirname(__DIR__, 3) . '/vendor/autoload.php';

use Dotenv\Dotenv;
use PDO;
use PDOException;

class DatabaseConnection {
    private static ?PDO $pdo = null;

    public static function getConnection() {
        if (self::$pdo === null) {
            $dotenv = Dotenv::createImmutable(dirname(__DIR__, 3));
            $dotenv->load();
        
            $host = $_ENV['DB_HOST'];
            $db = $_ENV['DB_NAME'];
            $user = $_ENV['DB_USER'];
            $password = $_ENV['DB_PASSWORD'];
        
            $dsn = "mysql:host=$host;dbname=$db";
        
            try {
                self::$pdo = new PDO($dsn, $user, $password); 
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch(PDOException $exception) {
                die("Connection failed: " . $exception->getMessage());
            }
        }

        return self::$pdo;
    }
}
