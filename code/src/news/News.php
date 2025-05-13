<?php

namespace App\news;

use App\config\DatabaseConnection;
use PDO;

class News {
    
    private $id;
    private $title;
    private $body;
    private $imageURL;
    private $categoryId;
    private $authorId;
    private static $conn;

    public function __construct($title, $body, $imageURL, $categoryId, $authorId) {
        if (!self::$conn) {
            self::$conn = DatabaseConnection::getConnection();
        }

        $this->title = $title;
        $this->body = $body;
        $this->imageURL = $imageURL;
        $this->categoryId = $categoryId;
        $this->authorId = $authorId;
    }

    public function publish(): bool {
        if (!self::$conn) {
            self::$conn = DatabaseConnection::getConnection();
        }

        $sql = "INSERT INTO news (title, body, imageURL, datePosted, categoryId, authorId, status)
                VALUES (:title, :body, :imageURL, NOW(), :categoryId, :authorId, 'pending')";

        $stmt = self::$conn->prepare($sql);
        return $stmt->execute([
            ':title' => $this->title,
            ':body' => $this->body,
            ':imageURL' => $this->imageURL,
            ':categoryId' => $this->categoryId,
            ':authorId' => $this->authorId
        ]);
    }

    public static function deleteNews($id): bool {
        if (!self::$conn) {
            self::$conn = DatabaseConnection::getConnection();
        }

        $stmt = self::$conn->prepare("DELETE FROM news WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }

    public static function updateNews($id, $title, $body, $imageURL, $categoryId): bool {
        if (!self::$conn) {
            self::$conn = DatabaseConnection::getConnection();
        }

        $sql = "UPDATE news SET title = :title, body = :body, imageURL = :imageURL, categoryId = :categoryId WHERE id = :id";
        $stmt = self::$conn->prepare($sql);
        return $stmt->execute([
            ':title' => $title,
            ':body' => $body,
            ':imageURL' => $imageURL,
            ':categoryId' => $categoryId,
            ':id' => $id
        ]);
    }

    public static function getNewsById($id): ?array {
        if (!self::$conn) {
            self::$conn = DatabaseConnection::getConnection();
        }

        $stmt = self::$conn->prepare("SELECT * FROM news WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $news = $stmt->fetch(PDO::FETCH_ASSOC);
        return $news ?: null;
    }
}
