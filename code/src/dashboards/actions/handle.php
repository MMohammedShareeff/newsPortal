<?php

require_once '../../../../vendor/autoload.php';
session_start();

use App\config\DatabaseConnection;

$conn = DatabaseConnection::getConnection();
$action = $_POST['action'] ?? $_GET['action'] ?? '';

switch ($action) {
    case 'create_news':
        $stmt = $conn->prepare("INSERT INTO news (title, body, status, author_id, date_posted) VALUES (?, ?, ?, ?, NOW())");
        $stmt->execute([
            $_POST['title'],
            $_POST['body'], 
            $_POST['status'],
            $_SESSION['user_id']
        ]);
        break;

    case 'update_news':
        $stmt = $conn->prepare("UPDATE news SET title=?, body=?, status=? WHERE id=?");
        $stmt->execute([
            $_POST['title'],
            $_POST['body'],
            $_POST['status'],
            $_POST['id']
        ]);
        break;

    case 'delete_news':
        $stmt = $conn->prepare("DELETE FROM news WHERE id=?");
        $stmt->execute([$_GET['id']]);
        break;

    case 'approve_news':
        $stmt = $conn->prepare("UPDATE news SET status='APPROVED' WHERE id=?");
        $stmt->execute([$_GET['id']]);
        break;

    case 'reject_news':
        $stmt = $conn->prepare("UPDATE news SET status='REJECTED' WHERE id=?");
        $stmt->execute([$_GET['id']]);
        break;

    case 'activate_user':
        $stmt = $conn->prepare("UPDATE user SET status='ACTIVE' WHERE email=?");
        $stmt->execute([$_GET['email']]);
        break;

    case 'delete_user':
        $stmt = $conn->prepare("DELETE FROM user WHERE id=?");
        $stmt->execute([$_GET['id']]);
        break;

    case 'update_user':
        $stmt = $conn->prepare("UPDATE user SET name=?, email=?, role=?, status=? WHERE id=?");
        $stmt->execute([
            $_POST['name'],
            $_POST['email'],
            $_POST['role'],
            $_POST['status'],
            $_POST['id']
        ]);
        break;
}

header('Location: ../dashboard.php');
exit;