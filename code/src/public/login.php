<?php

namespace App\public;
use App\user\User;

$mode = $_GET['mode'] ?? 'login'; 

if($_SERVER["REQUEST_METHOD"] === 'POST'){
    if ($mode === 'login') {
        $email = $_POST['email'];
        $password = $_POST['password'];
        echo "Logging in $email";
    } elseif ($mode === 'register') {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $role = $_POST['account-type'];

        $user = User::registerUser($name, $email, $password, $role);
        if(user){
            if(isset($role)){
                header('location: ../dashboards/Dashboard.php');     
            }
            else{
                header('location: index.php');
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
