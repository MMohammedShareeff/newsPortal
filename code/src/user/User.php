<?php

namespace App\user;

use App\config\DatabaseConnection;
use PDO;

class User {
    
    private $id;
    
    private $name;
    
    private $email;
    
    private $password;
    
    private $role;
    
    private $created_at;

    private static $conn;

    public function __construct($name, $email, $password, $role) {
        self::ensureConnection();

        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
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

    public static function getAll() {
        self::ensureConnection();
        
        $stmt = self::$conn->query("SELECT * FROM user ORDER BY created_at DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getById($id) {
        self::ensureConnection();
        
        $sql = "SELECT * FROM user WHERE id = ?";
        $stmt = self::$conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function getUserByEmail($email) {
        self::ensureConnection();
        
        $sql = "SELECT * FROM user WHERE email = ?";
        $stmt = self::$conn->prepare($sql);
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id): bool {
        $sql = "UPDATE user
                    SET name = :name, email = :email, role = :role
                    WHERE id = :id";

        $stmt = self::$conn->prepare($sql);
        return $stmt->execute([
            ':name' => $this->name,
            ':email' => $this->email,
            ':role' => $this->role,
            ':id' => $id
        ]);
    }

    public static function delete($id): bool {
        self::ensureConnection();
        
        $sql = "DELETE FROM user WHERE id = ?";
        $stmt = self::$conn->prepare($sql);
        return $stmt->execute([$id]);
    }
    private static function ensureConnection() {
        if (!self::$conn) {
            self::$conn = DatabaseConnection::getConnection();
        }
    }
}
