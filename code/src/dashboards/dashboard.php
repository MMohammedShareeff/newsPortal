<?php

declare(strict_types=1);

namespace App\dashboards;

require_once '../../../vendor/autoload.php';

use App\dashboards\DashboardController;
use App\config\DatabaseConnection;

session_start();

if (!isset($_SESSION['user_id']) || !isset($_SESSION['role'])) {
    header("Location: /login.php");
    exit();
}

$role = $_SESSION['role'];
$userId = $_SESSION['user_id'];
$data = DashboardController::getDashboardData($role, $userId);

$formAction = $_GET['form'] ?? null;
$editId = $_GET['edit'] ?? null;
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>لوحة تحكم <?= ucfirst(strtolower($role)) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h1 class="mb-4 text-center">لوحة تحكم <?= ucfirst(strtolower($role)) ?></h1>

    <?php if ($formAction === 'add_news' || ($formAction === 'edit_news' && $editId)): ?>
        <?php include __DIR__ . '/templates/NewsForm.php'; ?>
    <?php endif; ?>

    <?php if ($formAction === 'edit_user' && $editId): ?>
        <?php include __DIR__ . '/templates/UserForm.php'; ?>
    <?php endif; ?>

    <?php if ($role === 'ADMIN'): ?>
        <h3>إدارة المستخدمين</h3>
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>الاسم</th><th>البريد الإلكتروني</th><th>الحالة</th><th>الدور</th><th>الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['users'] as $user): ?>
                    <tr>
                        <td><?= htmlspecialchars($user['name']) ?></td>
                        <td><?= htmlspecialchars($user['email']) ?></td>
                        <td><?= htmlspecialchars($user['status']) ?></td>
                        <td><?= htmlspecialchars($user['role']) ?></td>
                        <td>
                            <form action="actions/handle.php" method="GET" class="d-inline">
                                <input type="hidden" name="action" value="activate_user">
                                <input type="hidden" name="email" value="<?= htmlspecialchars($user['email']) ?>">
                                <button class="btn btn-success btn-sm">تفعيل</button>
                            </form>
                            <a href="?form=edit_user&id=<?= $user['id'] ?>" class="btn btn-warning btn-sm">تعديل</a>
                            <form action="actions/handle.php" method="GET" class="d-inline">
                                <input type="hidden" name="action" value="delete_user">
                                <input type="hidden" name="id" value="<?= $user['id'] ?>">
                                <button class="btn btn-danger btn-sm">حذف</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <h3 class="mt-5">أخباري</h3>
    <a href="?form=add_news" class="btn btn-primary mb-2">إضافة خبر</a>
    <table class="table table-bordered table-striped align-middle">
        <thead class="table-primary">
            <tr>
                <th>العنوان</th><th>الحالة</th><th>تاريخ النشر</th><th>الإجراءات</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data['myNews'] as $news): ?>
                <tr>
                    <td><?= htmlspecialchars($news['title']) ?></td>
                    <td><?= htmlspecialchars($news['status']) ?></td>
                    <td><?= htmlspecialchars($news['date_posted']) ?></td>
                    <td>
                        <a href="?form=edit_news&edit=<?= $news['id'] ?>" class="btn btn-outline-primary btn-sm">تعديل</a>
                        <form action="actions/handle.php" method="GET" class="d-inline">
                            <input type="hidden" name="action" value="delete_news">
                            <input type="hidden" name="id" value="<?= $news['id'] ?>">
                            <button class="btn btn-outline-danger btn-sm">حذف</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <?php if (in_array($role, ['EDITOR', 'ADMIN'])): ?>
        <h3 class="mt-5">الأخبار المعلقة</h3>
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-warning">
                <tr>
                    <th>العنوان</th><th>رقم الكاتب</th><th>التاريخ</th><th>الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['pendingNews'] as $news): ?>
                    <tr>
                        <td><?= htmlspecialchars($news['title']) ?></td>
                        <td><?= htmlspecialchars($news['author_id']) ?></td>
                        <td><?= htmlspecialchars($news['date_posted']) ?></td>
                        <td>
                            <form action="actions/handle.php" method="GET" class="d-inline">
                                <input type="hidden" name="action" value="approve_news">
                                <input type="hidden" name="id" value="<?= $news['id'] ?>">
                                <button class="btn btn-success btn-sm">قبول</button>
                            </form>
                            <a href="?form=edit_news&edit=<?= $news['id'] ?>" class="btn btn-warning btn-sm">تعديل</a>
                            <form action="actions/handle.php" method="GET" class="d-inline">
                                <input type="hidden" name="action" value="reject_news">
                                <input type="hidden" name="id" value="<?= $news['id'] ?>">
                                <button class="btn btn-danger btn-sm">رفض</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

</div>
</body>
</html>
