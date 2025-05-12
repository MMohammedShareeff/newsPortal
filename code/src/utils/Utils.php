<?php

namespace App\utils;
require_once '../../../vendor/autoload.php';

use App\config\DatabaseConnection;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(dirname(__DIR__, 3));
$dotenv->load();

class Utils{

    private static $conn;

    public static function initConnection() {
        if (!self::$conn) {
            self::$conn = DatabaseConnection::getConnection();
        }
    }

    public static function readDatabaseInfo(){
        return [
            'host' => $_ENV['DB_HOST'],      
            'db' => $_ENV['DB_NAME'],
            'user' => $_ENV['DB_USER'],
            'password' => $_ENV['DB_PASSWORD']
        ];
    }

    private static function readAdminInfo(){
        // echo '<pre>';
        // print_r($_ENV);
        // echo '</pre>';
        return [
            'name' => $_ENV['ADMIN_NAME'],      
            'password' => $_ENV['ADMIN_PASSWORD'],
            'email' => $_ENV['ADMIN_EMAIL']
        ];
    }

    public static function createAdminIfNotExists(): bool {
        self::initConnection();

        $stmt = self::$conn->prepare("SELECT COUNT(*) FROM user WHERE role = 'ADMIN'");
        $stmt->execute();
        $count = $stmt->fetchColumn();

        if ($count == 0) {
            $adminInfo = self::readAdminInfo(); 

            $stmt = $conn->prepare("INSERT INTO user (name, email, password, role)
                                    VALUES (:name, :email, :password, :role)");

            return $stmt->execute([                  
                ':name' => $adminInfo['name'],
                ':email' => $adminInfo['email'],
                ':password' => password_hash($adminInfo['password'], PASSWORD_BCRYPT), 
                ':role' => 'ADMIN'
            ]);
        }
        return false;
    }
}
