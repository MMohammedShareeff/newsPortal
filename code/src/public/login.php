<?php

namespace App\public;
require_once '../../../vendor/autoload.php';
    
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
    
use App\user\User;
use App\utils\Utils;

Utils::createAdminIfNotExists();

$mode = $_GET['mode'] ?? 'login'; 

if($_SERVER["REQUEST_METHOD"] === 'POST'){
    if ($mode === 'login') {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = User::getUserByEmail($email);
        if($user['status'] !== 'ACTIVE'){
            echo 'the admin did not activate your account yet!!';
        }
        elseif($user && password_verify($password, $user['password'])){
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['username'] = $user['username']; 
            header("Location: ../dashboards/Dashboard.php");
            exit();
        }
        else{
            echo "Invalid email or password";
        }
        
    } elseif ($mode === 'register') {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $role = $_POST['account-type'];

        $user = new User($name, $email, $password, $role);
        if($user->registerUser()){
            if(isset($role)){
                header('location: ../dashboards/Dashboard.php');
                exit();     
            }
            else{
                header('location: index.php');
                exit();
            }
        }
        echo "Registering $name";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title><?= ucfirst($mode) ?></title>
</head>
<body>
    <h1><?= ucfirst($mode) ?> Page</h1>

    <?php if ($mode === 'register'): ?>
        <form method="POST">
            <input type="hidden" name="action" value="register">
            <input type="text" name="name" placeholder="Name" required><br>
            <input type="email" name="email" placeholder="Email" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <label for="account-type">choose account type</label>
            <select name="account-type" id="account-type">
                <option value="" disabled>role</option>
                <option value="author" selected>author</option>
                <option value="editor">editor</option>
            </select>
            <button type="submit">Register</button>
        </form>
        <p>Already have an account? <a href="?mode=login">Login here</a></p>

    <?php else: ?>
        <form method="POST">
            <input type="hidden" name="action" value="login">
            <input type="email" name="email" placeholder="Email" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <button type="submit">Login</button>
        </form>
        <p>No account? <a href="?mode=register">Register here</a></p>
    <?php endif; ?>
</body>
</html>
