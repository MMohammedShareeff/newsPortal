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

if ($_SERVER["REQUEST_METHOD"] === 'POST') {
    if ($mode === 'login') {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = User::getUserByEmail($email);
        if ($user['status'] !== 'ACTIVE') {
            echo 'the admin did not activate your account yet!!';
        } elseif ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['username'] = $user['username'];
            header("Location: ../dashboards/Dashboard.php");
            exit();
        } else {
            echo "Invalid email or password";
        }

    } elseif ($mode === 'register') {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $role = $_POST['account-type'];

        $user = new User($name, $email, $password, $role);
        if (!$user->registerUser()) {
            echo 'something wrong happend, failed to register your account';
        } else {
            header("Location: login.php");
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title><?= ucfirst($mode) ?> | بوابة الأخبار</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <link rel="stylesheet" href="FrontPage/css/login.css">
</head>

<body>

    <div class="container">
        <div class="auth-card">
            <h2 class="auth-title"><?= $mode === 'register' ? 'تسجيل حساب جديد' : 'تسجيل الدخول' ?></h2>

            <?php if ($mode === 'register'): ?>
                <form method="POST">
                    <input type="hidden" name="action" value="register">

                    <div class="mb-3">
                        <label class="form-label">الاسم</label>
                        <input type="text" name="name" class="form-control" placeholder="الاسم الكامل" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">البريد الإلكتروني</label>
                        <input type="email" name="email" class="form-control" placeholder="email@example.com" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">كلمة المرور</label>
                        <input type="password" name="password" class="form-control" placeholder="********" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">نوع الحساب</label>
                        <select name="account-type" class="form-select" required>
                            <option value="" disabled selected>اختر النوع</option>
                            <option value="author">كاتب</option>
                            <option value="editor">محرر</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">تسجيل</button>
                    <a href="?mode=login" class="switch-link">هل لديك حساب؟ تسجيل الدخول</a>
                </form>

            <?php else: ?>
                <form method="POST">
                    <input type="hidden" name="action" value="login">

                    <div class="mb-3">
                        <label class="form-label">البريد الإلكتروني</label>
                        <input type="email" name="email" class="form-control" placeholder="email@example.com" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">كلمة المرور</label>
                        <input type="password" name="password" class="form-control" placeholder="********" required>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 ">دخول</button>
                    <a href="?mode=register" class="switch-link">ليس لديك حساب؟ أنشئ حسابًا الآن</a>
                </form>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>