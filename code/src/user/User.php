<?php
namespace App\user;

use App\config\DatabaseConnection;
use PDO;
use App\Utils\AppConstants;

class User {
    
    private $id;
    private $name;
    private $email;
    private $password;
    private $role;
    private $created_at;
    private static $conn;

    public function __construct($name, $email, $password, $role, $id = null) {
        self::ensureConnection();
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
        $this->id = $id;
    }

    public function registerUser(): bool {
        $sql = "INSERT INTO user (name, email, password, role, created_at)
                VALUES (:name, :email, :password, :role, NOW())";
        $stmt = self::$conn->prepare($sql);
        return $stmt->execute([
            ':name' => $this->name,
            ':email' => $this->email,
            ':password' => password_hash($this->password, PASSWORD_BCRYPT),
            ':role' => $this->role
        ]);
    }

    public static function getUserByEmail($email) {
        self::ensureConnection();
        $sql = "SELECT * FROM user WHERE email = ?";
        $stmt = self::$conn->prepare($sql);
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function updateUser(int $id, string $name, string $email, string $role, string $status): bool {
        self::ensureConnection();
        $sql = "UPDATE user SET name = :name, email = :email, role = :role, status = :status WHERE id = :id";
        $stmt = self::$conn->prepare($sql);
        return $stmt->execute([
            ':name' => $name,
            ':email' => $email,
            ':role' => $role,
            ':status' => $status,
            ':id' => $id
        ]);
    }

    public static function deleteUser(int $id): bool {
        self::ensureConnection();
        $sql = "DELETE FROM user WHERE id = :id";
        $stmt = self::$conn->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }

    public static function activateAccount(string $email): bool
    {
        self::ensureConnection();
        $sql = "UPDATE user SET status = :status WHERE email = :email";
        $stmt = self::$conn->prepare($sql);
        return $stmt->execute([
            ':status' => AppConstants::STATUS_ACTIVE,
            ':email' => $email
        ]);
    }


    private static function ensureConnection() {
        if (!self::$conn) {
            self::$conn = DatabaseConnection::getConnection();
        }
    }
}