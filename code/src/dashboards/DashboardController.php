<?php

namespace App\dashboards;

use App\config\DatabaseConnection;
use PDO;

class DashboardController{
    private static $conn;

    public static function getDashboardData($role, $userId)
    {
        self::ensureConnection();
        $data = [];

        $data['myNews'] = self::getNewsByAuthor($userId);

        if ($role === 'ADMIN') {
            $data['users'] = self::getAllUsers();
            $data['allNews'] = self::getAllNews();
            $data['pendingNews'] = self::getPendingNews();
        }

        if ($role === 'EDITOR') {
            $data['pendingNews'] = self::getPendingNews();
        }

        return $data;
    }

    public static function getNewsById($id)
    {
        self::ensureConnection();
        $stmt = self::$conn->prepare("SELECT * FROM news WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function getUserById($id)
    {
        self::ensureConnection();
        $stmt = self::$conn->prepare("SELECT * FROM user WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    private static function getAllUsers()
    {
        $stmt = self::$conn->query("SELECT * FROM user ORDER BY created_at DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    private static function getAllNews()
    {
        $stmt = self::$conn->query("SELECT * FROM news ORDER BY date_posted DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    private static function getPendingNews()
    {
        $stmt = self::$conn->prepare("SELECT * FROM news WHERE status = 'PENDING'");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    private static function getNewsByAuthor($authorId)
    {
        $stmt = self::$conn->prepare("SELECT * FROM news WHERE author_id = :author_id");
        $stmt->execute([':author_id' => $authorId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    private static function ensureConnection()
    {
        if (!self::$conn) {
            self::$conn = DatabaseConnection::getConnection();
        }
    }
}