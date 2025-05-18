<?php
use App\dashboards\DashboardController;

$user = DashboardController::getUserById($_GET['id']);
?>

<h4>Edit User</h4>

<form action="actions/handle.php" method="POST">
    <input type="hidden" name="action" value="update_user">
    <input type="hidden" name="id" value="<?= htmlspecialchars($user['id']) ?>">

    <div class="mb-3">
        <label class="form-label">Name</label>
        <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($user['name']) ?>" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($user['email']) ?>" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Role</label>
        <select name="role" class="form-select">
            <option value="AUTHOR" <?= $user['role'] === 'AUTHOR' ? 'selected' : '' ?>>Author</option>
            <option value="EDITOR" <?= $user['role'] === 'EDITOR' ? 'selected' : '' ?>>Editor</option>
            <option value="ADMIN" <?= $user['role'] === 'ADMIN' ? 'selected' : '' ?>>Admin</option>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Status</label>
        <select name="status" class="form-select">
            <option value="ACTIVE" <?= $user['status'] === 'ACTIVE' ? 'selected' : '' ?>>Active</option>
            <option value="INACTIVE" <?= $user['status'] === 'INACTIVE' ? 'selected' : '' ?>>Inactive</option>
        </select>
    </div>

    <button type="submit" class="btn btn-warning">Update User</button>
</form>