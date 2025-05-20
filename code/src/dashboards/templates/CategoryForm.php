<?php
use App\category\Category;

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'ADMIN') {
    header("Location: /dashboard.php");
    exit();
}

$isEdit = isset($_GET['form']) && $_GET['form'] === 'edit_category' && isset($_GET['edit']);
$category = $isEdit ? Category::getById($_GET['edit']) : ['id' => '', 'name' => '', 'description' => ''];
if ($isEdit && !$category) {
    echo '<p class="text-danger">الفئة غير موجودة.</p>';
    exit();
}
?>

<h4><?= $isEdit ? 'تعديل الفئة' : 'إضافة فئة' ?></h4>

<form action="actions/handle.php" method="POST">
    <input type="hidden" name="action" value="<?= $isEdit ? 'update_category' : 'create_category' ?>">
    <?php if ($isEdit): ?>
        <input type="hidden" name="id" value="<?= htmlspecialchars($category['id'] ?? '') ?>">
    <?php endif; ?>

    <div class="mb-3">
        <label class="form-label">اسم الفئة</label>
        <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($category['name'] ?? '') ?>"
            required>
    </div>

    <div class="mb-3">
        <label class="form-label">الوصف</label>
        <textarea name="description" class="form-control"
            rows="4"><?= htmlspecialchars($category['description'] ?? '') ?></textarea>
    </div>

    <button type="submit" class="btn btn-primary">
        <?= $isEdit ? 'تحديث الفئة' : 'إنشاء الفئة' ?>
    </button>
</form>