<?php
namespace App\dashboards;
session_start();

if (!isset($_SESSION['user_id']) || !isset($_SESSION['role'])) {
    header("Location: login.php");
    exit();
}

$role = $_SESSION['role']; 

use App\config\DatabaseConnection;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<h1><?= $role?> dashborad </h1>

</body>
</html>
