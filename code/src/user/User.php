<?php

namespace App\user;
use App\config\DatabaseConnection;

class User {
    
    private $id;

    private $name;

    private $email;

    private $password;

    private $role;

    public function __construct ($name, $email, $password, $role){
        $this->conn = DatabaseConnection::getConnection();
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
    }

    public static function registerUser($name, $email, $password, $role):bool {
        $conn = DatabaseConnection::getConnection();
        $sql = "INSERT INTO user (name, email, password, role) VALUES(:name, :email, :password, :role)";
        $stmt = $conn->prepare($sql);
        return $stmt->execute([
            ':name' => $this->name,
            ':email' => $this->email,
            ':password' => $this->password,
            ':role' => $this->role
        ]);
    }
}
