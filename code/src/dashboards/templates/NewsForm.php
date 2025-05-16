<?php
use App\dashboards\DashboardController;

$isEdit = isset($_GET['form']) && $_GET['form'] === 'edit_news' && isset($_GET['edit']);
$news = $isEdit ? DashboardController::getNewsById($_GET['edit']) : ['title' => '', 'body' => '', 'status' => 'DRAFT'];
?>

<h4><?= $isEdit ? 'تعديل الخبر' : 'إضافة خبر' ?></h4>

<form action="actions/handle.php" method="POST">
    <input type="hidden" name="action" value="<?= $isEdit ? 'update_news' : 'create_news' ?>">
    <?php if ($isEdit): ?>
        <input type="hidden" name="id" value="<?= htmlspecialchars($news['id']) ?>">
    <?php endif; ?>

    <div class="mb-3">
        <label class="form-label">العنوان</label>
        <input type="text" name="title" class="form-control" value="<?= htmlspecialchars($news['title']) ?>" required>
    </div>

    <div class="mb-3">
        <label class="form-label">المحتوى</label>
        <textarea name="body" class="form-control" rows="4" required><?= htmlspecialchars($news['body'] ?? '') ?></textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">الحالة</label>
        <select name="status" class="form-select">
            <option value="PENDING" <?= $news['status'] === 'PENDING' ? 'selected' : '' ?>>قيد المراجعة</option>
            <option value="APPROVED" <?= $news['status'] === 'APPROVED' ? 'selected' : '' ?>>موافق عليه</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">
        <?= $isEdit ? 'تحديث الخبر' : 'إنشاء الخبر' ?>
    </button>
</form>
