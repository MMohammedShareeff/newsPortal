<?php
namespace App\category;

use App\config\DatabaseConnection;
use PDO;
use RuntimeException;

class Category
{
    private $id;
    private $name;
    private $description;
    private static $conn;

    public function __construct(string $name, ?string $description = null, ?int $id = null)
    {
        self::ensureConnection();
        $this->name = $name;
        $this->description = $description;
        $this->id = $id;
    }

    public static function getAll(){
        self::ensureConnection();
        return self::$conn->query("SELECT * FROM category")->fetchAll(PDO::FETCH_BOTH);
    }

    public function create(): bool
    {
        self::ensureConnection();
        $sql = "INSERT INTO category (name, description) VALUES (:name, :description)";
        $stmt = self::$conn->prepare($sql);
        return $stmt->execute([
            ':name' => $this->name,
            ':description' => $this->description
        ]);
    }

    public function update(): bool
    {
        self::ensureConnection();
        if (!$this->id) {
            throw new RuntimeException('Category ID is required for update');
        }
        $sql = "UPDATE category SET name = :name, description = :description WHERE id = :id";
        $stmt = self::$conn->prepare($sql);
        $result = $stmt->execute([
            ':name' => $this->name,
            ':description' => $this->description,
            ':id' => $this->id
        ]);
        if (!$result) {
            throw new RuntimeException('Failed to update category');
        }
        return $result;
    }

    public function delete(): bool
    {
        self::ensureConnection();
        if (!$this->id) {
            throw new RuntimeException('Category ID is required for deletion');
        }
        $sql = "DELETE FROM category WHERE id = :id";
        $stmt = self::$conn->prepare($sql);
        return $stmt->execute([':id' => $this->id]);
    }

    public static function getById(int $id)
    {
        self::ensureConnection();
        $sql = "SELECT * FROM category WHERE id = :id";
        $stmt = self::$conn->prepare($sql);
        $stmt->execute([':id' => $id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            return new self($result['name'], $result['description'], $result['id']);
        }
        return null;
    }

    public static function getIdByName(string $name): ?int
    {
        self::ensureConnection();
        $sql = "SELECT id FROM category WHERE name = :name";
        $stmt = self::$conn->prepare($sql);
        $stmt->execute([':name' => $name]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? (int) $result['id'] : null;
    }

    private static function ensureConnection(): void
    {
        if (!self::$conn) {
            self::$conn = DatabaseConnection::getConnection();
            if (!self::$conn) {
                throw new RuntimeException('Failed to establish database connection');
            }
        }
    }
}