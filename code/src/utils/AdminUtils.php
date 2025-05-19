<?php

namespace App\utils;

use App\config\DatabaseConnection;
use PDO;
use App\utils\AppConstants;

class AdminUtils {

    private static $conn;

    private static function ensureConnection(): void {
        if (!self::$conn) {
            self::$conn = DatabaseConnection::getConnection();
        }
    }

    public static function approveNews(int $id): bool {
        self::ensureConnection();
        $sql = "UPDATE news SET status = :status WHERE id = :id";
        $stmt = self::$conn->prepare($sql);
        return $stmt->execute([
            ':status' => AppConstants::STATUS_PUBLISHED,
            ':id' => $id
        ]);
    }

    public static function updateNews(int $id, string $title, string $content): bool {
        self::ensureConnection();
        $sql = "UPDATE news SET title = :title, body = :content WHERE id = :id";
        $stmt = self::$conn->prepare($sql);
        return $stmt->execute([
            ':title' => $title,
            ':content' => $content,
            ':id' => $id
        ]);
    }

    public static function rejectNews(int $id): bool {
        self::ensureConnection();
        $sql = "DELETE FROM news WHERE id = :id";
        $stmt = self::$conn->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }

    public static function activateAccount(string $email): bool {
        self::ensureConnection();
        $sql = "UPDATE user SET status = :status WHERE email = :email";
        $stmt = self::$conn->prepare($sql);
        return $stmt->execute([
            ':status' => AppConstants::STATUS_ACTIVE,
            ':email' => $email
        ]);
    }

    public static function deleteUser(int $id): bool {
        self::ensureConnection();
        $sql = "DELETE FROM user WHERE id = :id";
        $stmt = self::$conn->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }

    public static function updateUser(int $id, string $name, string $role): bool {
        self::ensureConnection();
        $sql = "UPDATE user SET name = :name, role = :role WHERE id = :id";
        $stmt = self::$conn->prepare($sql);
        return $stmt->execute([
            ':name' => $name,
            ':role' => $role,
            ':id' => $id
        ]);
    }
}
