<?php
namespace App\news;

use App\config\DatabaseConnection;
use App\utils\AppConstants;

class News
{
    private $id;
    private $title;
    private $body;
    private $status;
    private $author_id;
    private $category_id;
    private $date_posted;
    private $image_url;
    private static $conn;

    public function __construct(
        string $title,
        string $body,
        int $author_id,
        int $category_id,
        string $status = AppConstants::STATUS_PENDING,
        ?string $image_url = null,
        ?int $id = null
    ) {
        self::ensureConnection();
        $this->title = $title;
        $this->body = $body;
        $this->author_id = $author_id;
        $this->category_id = $category_id;
        $this->status = $status;
        $this->image_url = $image_url;
        $this->id = $id;
    }

    public function createNews(): bool
    {
        $sql = "INSERT INTO news (title, body, status, author_id, category_id, date_posted, image_url)
                VALUES (:title, :body, :status, :author_id, :category_id, NOW(), :image_url)";
        $stmt = self::$conn->prepare($sql);
        return $stmt->execute([
            ':title' => $this->title,
            ':body' => $this->body,
            ':status' => $this->status,
            ':author_id' => $this->author_id,
            ':category_id' => $this->category_id,
            ':image_url' => $this->image_url
        ]);
    }

    public static function updateNews(
        int $id,
        string $title,
        string $body,
        string $status,
        int $category_id,
        ?string $image_url
    ): bool {
        self::ensureConnection();
        $sql = "UPDATE news SET title = :title, body = :body, status = :status, category_id = :category_id, image_url = :image_url WHERE id = :id";
        $stmt = self::$conn->prepare($sql);
        return $stmt->execute([
            ':title' => $title,
            ':body' => $body,
            ':status' => $status,
            ':category_id' => $category_id,
            ':image_url' => $image_url,
            ':id' => $id
        ]);
    }

    public static function deleteNews(int $id): bool
    {
        self::ensureConnection();
        $sql = "DELETE FROM news WHERE id = :id";
        $stmt = self::$conn->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }

    public static function approveNews(int $id): bool
    {
        self::ensureConnection();
        $sql = "UPDATE news SET status = :status WHERE id = :id";
        $stmt = self::$conn->prepare($sql);
        return $stmt->execute([
            ':status' => AppConstants::STATUS_PUBLISHED,
            ':id' => $id
        ]);
    }

    public static function rejectNews(int $id): bool
    {
        self::ensureConnection();
        $sql = "UPDATE news SET status = :status WHERE id = :id";
        $stmt = self::$conn->prepare($sql);
        return $stmt->execute([
            ':status' => AppConstants::STATUS_REJECTED,
            ':id' => $id
        ]);
    }

    private static function ensureConnection(): void
    {
        if (!self::$conn) {
            self::$conn = DatabaseConnection::getConnection();
        }
    }
}