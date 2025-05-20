<?php

namespace App\utils;
require_once '../../../vendor/autoload.php';

use App\config\DatabaseConnection;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(dirname(__DIR__, 3));
$dotenv->load();

class Utils
{

    private static $conn;

    private static function ensureConnection()
    {
        if (!self::$conn) {
            self::$conn = DatabaseConnection::getConnection();
        }
    }

    public static function readDatabaseInfo()
    {
        return [
            'host' => $_ENV['DB_HOST'],
            'db' => $_ENV['DB_NAME'],
            'user' => $_ENV['DB_USER'],
            'password' => $_ENV['DB_PASSWORD']
        ];
    }

    private static function readAdminInfo()
    {
        return [
            'name' => $_ENV['ADMIN_NAME'],
            'password' => $_ENV['ADMIN_PASSWORD'],
            'email' => $_ENV['ADMIN_EMAIL']
        ];
    }

    public static function createAdminIfNotExists(): bool
    {
        self::ensureConnection();

        $stmt = self::$conn->prepare("SELECT COUNT(*) FROM user WHERE role = 'ADMIN'");
        $stmt->execute();
        $count = $stmt->fetchColumn();

        if ($count == 0) {
            $adminInfo = self::readAdminInfo();

            $stmt = self::$conn->prepare("INSERT INTO user (name, email, password, role, status)
                                    VALUES (:name, :email, :password, :role, :status)");

            return $stmt->execute([
                ':name' => $adminInfo['name'],
                ':email' => $adminInfo['email'],
                ':password' => password_hash($adminInfo['password'], PASSWORD_BCRYPT),
                ':role' => 'ADMIN',
                ':status' => 'مفعل'
            ]);
        }
        return false;
    }
}
