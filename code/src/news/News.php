<?php

namespace App\news;
use App\config\DatabaseConnection;
use PDO;

class News {
    
    private $id;

    private $title;

    private $body;

    private $image_url;

    private $date_posted;

    private $category_id;

    private $author_id;

    private $status;

    private static $conn;

    public function __construct ($title, $body, $image_url, $category_id, $author_id){
        self::ensureConnection();

        $this->title = $title;
        $this->body = $body;
        $this->image_url = $image_url;
        $this->category_id = $category_id;
        $this->author_id = $author_id;
    }

    
    public function create() {
        $stmt = self::$conn->prepare("INSERT INTO news (title, body, image_url, category_id, author_id, date_posted)
                                      VALUES (:title, :body, :image_url, :category_id, :author_id, NOW())");
    
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':body', $this->body);
        $stmt->bindParam(':image_url', $this->image_url);
        $stmt->bindParam(':category_id', $this->category_id);
        $stmt->bindParam(':author_id', $this->author_id);
    
        return $stmt->execute();
    }

    public static function getAll() {
        self::ensureConnection();
        
        $stmt = self::$conn->query("SELECT * FROM news ORDER BY date_posted DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getById($id) {
        self::ensureConnection();
        
        $stmt = self::$conn->prepare("SELECT * FROM news WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id) {
        $stmt = self::$conn->prepare("UPDATE news
                                        SET title = :title, body = :body, image_url = :image_url, category_id = :category_id, status = :status
                                        WHERE id = :id");
        
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':body', $this->body);
        $stmt->bindParam(':image_url', $this->image_url);
        $stmt->bindParam(':category_id', $this->category_id);
        $stmt->bindParam(':status', $this->status);
        $stmt->bindParam(':id', $id);
        
        return $stmt->execute();
    }

    public static function delete($id) {
        self::ensureConnection();
        
        $stmt = self::$conn->prepare("DELETE FROM news WHERE id = :id");
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    private static function ensureConnection(){
        if (!self::$conn) {
            self::$conn = DatabaseConnection::getConnection();
        }
    }
}
