<?php
use App\dashboards\DashboardController;
use App\category\Category;

if (!isset($_SESSION['role']) || !in_array($_SESSION['role'], ['AUTHOR', 'EDITOR'])) {
    header("Location: /dashboard.php");
    exit();
}

$isEdit = isset($_GET['form']) && $_GET['form'] === 'edit_news' && isset($_GET['edit']);
$news = $isEdit ? DashboardController::getNewsById($_GET['edit']) : ['title' => '', 'body' => '', 'status' => 'PENDING', 'image_url' => '', 'category_name' => ''];
if ($isEdit && !$news) {
    echo '<p class="text-danger">الخبر غير موجود.</p>';
    exit();
}
?>

<h4><?= $isEdit ? 'تعديل الخبر' : 'إضافة خبر' ?></h4>

<form action="actions/handle.php" method="POST">
    <input type="hidden" name="action" value="<?= $isEdit ? 'update_news' : 'create_news' ?>">
    <?php if ($isEdit): ?>
        <input type="hidden" name="id" value="<?= htmlspecialchars($news['id'] ?? '') ?>">
    <?php endif; ?>

    <div class="mb-3">
        <label class="form-label">العنوان</label>
        <input type="text" name="title" class="form-control" value="<?= htmlspecialchars($news['title'] ?? '') ?>"
            required>
    </div>

    <div class="mb-3">
        <label class="form-label">المحتوى</label>
        <textarea name="body" class="form-control" rows="4"
            required><?= htmlspecialchars($news['body'] ?? '') ?></textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">رابط الصورة</label>
        <input type="url" name="image_url" class="form-control"
            value="<?= htmlspecialchars($news['image_url'] ?? '') ?>" placeholder="https://example.com/image.jpg">
    </div>

    <div class="mb-3">
        <label class="form-label">الفئة</label>
        <select name="category_name" class="form-select" required>
            <option value="" disabled <?= empty($news['category_name']) ? 'selected' : '' ?>>اختر فئة</option>
            <?php
            $categories = Category::getAll();
            foreach ($categories as $cat): ?>
                <option value="<?= htmlspecialchars($cat['name'] ?? '') ?>" <?= ($news['category_name'] ?? '') === $cat['name'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($cat['name'] ?? '') ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <?php if ($_SESSION['role'] === 'EDITOR'): ?>
        <div class="mb-3">
            <label class="form-label">الحالة</label>
            <select name="status" class="form-select">
                <option value="PENDING" <?= ($news['status'] ?? 'PENDING') === 'PENDING' ? 'selected' : '' ?>>قيد المراجعة
                </option>
                <option value="APPROVED" <?= ($news['status'] ?? 'PENDING') === 'APPROVED' ? 'selected' : '' ?>>موافق عليه
                </option>
            </select>
        </div>
    <?php else: ?>
        <input type="hidden" name="status" value="PENDING">
    <?php endif; ?>

    <button type="submit" class="btn btn-primary">
        <?= $isEdit ? 'تحديث الخبر' : 'إنشاء الخبر' ?>
    </button>
</form>