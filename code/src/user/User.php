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

    private static $conn;

    public function __construct ($name, $email, $password, $role){
        if (!self::$conn) {
            self::$conn = DatabaseConnection::getConnection();
        }

        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
    }

    public static function getUserByEmail($email) {
        if (!self::$conn) {
            self::$conn = DatabaseConnection::getConnection();
        }

        $sql = "SELECT * FROM user WHERE email = ?";
        $stmt = self::$conn->prepare($sql);
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function registerUser():bool {
        if (!self::$conn) {
            self::$conn = DatabaseConnection::getConnection();
        }
        
        $sql = "INSERT INTO user (name, email, password, role) VALUES(:name, :email, :password, :role)";
        $stmt = self::$conn->prepare($sql);
        return $stmt->execute([
            ':name' => $this->name,
            ':email' => $this->email,
            ':password' => password_hash($this->password, PASSWORD_BCRYPT), 
            ':role' => $this->role
        ]);
    }
}
