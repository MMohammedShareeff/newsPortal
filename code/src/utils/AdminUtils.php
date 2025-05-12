<?php
namespace App\utils;
require_once __DIR__ . '/../includes/db.php';

function approveNews($id) {
    global $conn;
    $stmt = $conn->prepare("UPDATE news SET status='published' WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}

function rejectNews($id) {
    global $conn;
    $stmt = $conn->prepare("DELETE FROM news WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}

function deleteUser($id) {
    global $conn;
    $stmt = $conn->prepare("DELETE FROM users WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}

function updateNews($id, $title, $content) {
    global $conn;
    $stmt = $conn->prepare("UPDATE news SET title=?, content=? WHERE id=?");
    $stmt->bind_param("ssi", $title, $content, $id);
    $stmt->execute();
    $stmt->close();
}

function updateUser($id, $username, $role) {
    global $conn;
    $stmt = $conn->prepare("UPDATE users SET username=?, role=? WHERE id=?");
    $stmt->bind_param("ssi", $username, $role, $id);
    $stmt->execute();
    $stmt->close();
}
?>
