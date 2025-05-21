<?php

namespace App\dashboards;

use App\config\DatabaseConnection;
use PDO;

class DashboardController
{
    private static $conn;

    public static function getDashboardData($role, $userId)
    {
        self::ensureConnection();
        $data = [];

        if ($role === 'ADMIN') {
            $data['users'] = self::getAllUsers();
        } elseif ($role === 'AUTHOR') {
            $data['myNews'] = self::getNewsByAuthor($userId);
        } elseif ($role === 'EDITOR') {
            $data['pendingNews'] = self::getPendingNews();
            $data['allNews'] = self::getAllNews();
        }

        return $data;
    }

    public static function getNewsById($id)
    {
        self::ensureConnection();
        $stmt = self::$conn->prepare("SELECT n.id, n.title, n.body, n.status, n.author_id, n.date_posted, n.image_url, n.category_id, c.name AS category_name 
                                      FROM news n 
                                      LEFT JOIN category c ON n.category_id = c.id 
                                      WHERE n.id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function getUserById($id)
    {
        self::ensureConnection();
        $stmt = self::$conn->prepare("SELECT id, name, email, status, role FROM user WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    private static function getAllUsers()
    {
        self::ensureConnection();
        $stmt = self::$conn->query("SELECT id, name, email, status, role FROM user WHERE role != 'ADMIN' ORDER BY created_at DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    private static function getAllNews()
    {
        self::ensureConnection();
        $stmt = self::$conn->query("SELECT n.id, n.title, n.author_id, n.date_posted, n.status, n.image_url, n.category_id, c.name AS category_name 
                                    FROM news n 
                                    LEFT JOIN category c ON n.category_id = c.id 
                                    ORDER BY n.date_posted DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    private static function getPendingNews()
    {
        self::ensureConnection();
        $stmt = self::$conn->query("SELECT n.id, n.title, n.author_id, n.date_posted, n.status, n.image_url, n.category_id, c.name AS category_name 
                                    FROM news n 
                                    LEFT JOIN category c ON n.category_id = c.id 
                                    WHERE n.status = 'PENDING' 
                                    ORDER BY n.date_posted DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    private static function getNewsByAuthor($authorId)
    {
        self::ensureConnection();
        $stmt = self::$conn->prepare("SELECT n.id, n.title, n.author_id, n.date_posted, n.status, n.image_url, n.category_id, c.name AS category_name 
                                      FROM news n 
                                      LEFT JOIN category c ON n.category_id = c.id 
                                      WHERE n.author_id = ? 
                                      ORDER BY n.date_posted DESC");
        $stmt->execute([$authorId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    private static function ensureConnection()
    {
        if (!self::$conn) {
            self::$conn = DatabaseConnection::getConnection();
        }
    }
}