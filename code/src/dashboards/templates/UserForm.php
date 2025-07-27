<?php
use App\dashboards\DashboardController;

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'ADMIN') {
    header("Location: /dashboard.php");
    exit();
}

if (!isset($_GET['edit'])) {
    echo '<p class="text-danger">No user ID provided.</p>';
    exit();
}

$user = DashboardController::getUserById($_GET['edit']);
if (!$user) {
    echo '<p class="text-danger">User not found.</p>';
    exit();
}
?>

<h4>تعديل المستخدم</h4>

<form action="actions/handle.php" method="POST">
    <input type="hidden" name="action" value="update_user">
    <input type="hidden" name="id" value="<?= htmlspecialchars($user['id'] ?? '') ?>">

    <div class="mb-3">
        <label class="form-label">الاسم</label>
        <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($user['name'] ?? '') ?>"
            required>
    </div>

    <div class="mb-3">
        <label class="form-label">البريد الإلكتروني</label>
        <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($user['email'] ?? '') ?>"
            required>
    </div>

    <div class="mb-3">
        <label class="form-label">الدور</label>
        <select name="role" class="form-select">
            <option value="AUTHOR" <?= ($user['role'] ?? '') === 'AUTHOR' ? 'selected' : '' ?>>مؤلف</option>
            <option value="EDITOR" <?= ($user['role'] ?? '') === 'EDITOR' ? 'selected' : '' ?>>محرر</option>
            <option value="ADMIN" <?= ($user['role'] ?? '') === 'ADMIN' ? 'selected' : '' ?>>مدير</option>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">الحالة</label>
        <select name="status" class="form-select">
            <option value="ACTIVE" <?= ($user['status'] ?? '') === 'ACTIVE' ? 'selected' : '' ?>>نشط</option>
            <option value="INACTIVE" <?= ($user['status'] ?? '') === 'INACTIVE' ? 'selected' : '' ?>>غير نشط</option>
        </select>
    </div>

    <button type="submit" class="btn btn-warning">تحديث المستخدم</button>
</form>