<?php
require_once '../../../../vendor/autoload.php';
session_start();

use App\config\DatabaseConnection;
use App\utils\AppConstants;
use App\category\Category;
use App\user\User;
use App\news\News;


if (!isset($_SESSION['role'])) {
    header("Location: /news-portal/code/src/public/login.php");
    exit();
}

$conn = DatabaseConnection::getConnection();
$action = $_POST['action'] ?? $_GET['action'] ?? '';

switch ($action) {
    case 'create_news':
        if (!in_array($_SESSION['role'], ['AUTHOR', 'EDITOR'])) {
            die('غير مسموح بالوصول');
        }
        $category_name = $_POST['category_name'] ?? '';
        if (empty($category_name)) {
            die('الفئة مطلوبة');
        }
        $category_id = Category::getIdByName($category_name);
        if (!$category_id) {
            die('اسم الفئة غير صالح');
        }
        $title = $_POST['title'] ?? '';
        $body = $_POST['body'] ?? '';
        $status = $_POST['status'] ?? AppConstants::STATUS_PENDING;
        $image_url = $_POST['image_url'] ?? null;
        if (empty($title) || empty($body)) {
            die('العنوان والمحتوى مطلوبان');
        }
        $news = new News($title, $body, $_SESSION['user_id'], $category_id, $status, $image_url);
        if (!$news->createNews()) {
            die('فشل في إنشاء الأخبار');
        }
        break;

    case 'update_news':
        if ($_SESSION['role'] !== 'EDITOR') {
            die('غير مسموح بالوصول');
        }
        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        if ($id === false || $id <= 0) {
            die('معرف الأخبار غير صالح');
        }
        $title = $_POST['title'] ?? '';
        $body = $_POST['body'] ?? '';
        $category_name = $_POST['category_name'] ?? '';
        $status = $_POST['status'] ?? '';
        $image_url = $_POST['image_url'] ?? null;
        if (empty($title) || empty($body) || empty($category_name) || empty($status)) {
            die('جميع الحقول المطلوبة يجب أن تكون موجودة');
        }
        $category_id = Category::getIdByName($category_name);
        if (!$category_id) {
            die('اسم الفئة غير صالح');
        }
        if (!News::updateNews($id, $title, $body, $status, $category_id, $image_url)) {
            die('فشل في تحديث الأخبار');
        }
        break;

    case 'delete_news':
        if (!in_array($_SESSION['role'], ['AUTHOR', 'EDITOR'])) {
            die('غير مسموح بالوصول');
        }
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if ($id === false || $id <= 0) {
            die('معرف الأخبار غير صالح');
        }
        if (!News::deleteNews($id)) {
            die('فشل في حذف الأخبار');
        }
        break;

    case 'approve_news':
        if ($_SESSION['role'] !== 'EDITOR') {
            die('غير مسموح بالوصول');
        }
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if ($id === false || $id <= 0) {
            die('معرف الأخبار غير صالح');
        }
        if (!News::approveNews($id)) {
            die('فشل في الموافقة على الأخبار');
        }
        break;

    case 'reject_news':
        if ($_SESSION['role'] !== 'EDITOR') {
            die('غير مسموح بالوصول');
        }
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if ($id === false || $id <= 0) {
            die('معرف الأخبار غير صالح');
        }
        if (!News::rejectNews($id)) {
            die('فشل في رفض الأخبار');
        }
        break;

    case 'activate_user':
        if ($_SESSION['role'] !== 'ADMIN') {
            die('غير مسموح بالوصول');
        }
        $email = filter_input(INPUT_GET, 'email', FILTER_VALIDATE_EMAIL);
        if ($email === false) {
            die('البريد الإلكتروني غير صالح');
        }
        if (!User::activateAccount($email)) {
            die('فشل في تفعيل المستخدم');
        }
        break;

    case 'delete_user':
        if ($_SESSION['role'] !== 'ADMIN') {
            die('غير مسموح بالوصول');
        }
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if ($id === false || $id <= 0) {
            die('معرف المستخدم غير صالح');
        }
        if (!User::deleteUser($id)) {
            die('فشل في حذف المستخدم');
        }
        break;

    case 'update_user':
        if ($_SESSION['role'] !== 'ADMIN') {
            die('غير مسموح بالوصول');
        }
        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        if ($id === false || $id <= 0) {
            die('معرف المستخدم غير صالح');
        }
        $name = $_POST['name'] ?? '';
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $role = $_POST['role'] ?? '';
        $status = $_POST['status'] ?? '';
        if (empty($name) || !$email || empty($role) || empty($status)) {
            die('جميع حقول المستخدم مطلوبة');
        }
        if (!User::updateUser($id, $name, $email, $role, $status)) {
            die('فشل في تحديث المستخدم');
        }
        break;

    case 'create_category':
        if ($_SESSION['role'] !== 'ADMIN') {
            die('غير مسموح بالوصول');
        }
        $name = $_POST['name'] ?? '';
        $description = $_POST['description'] ?? '';
        if (empty($name)) {
            die('اسم الفئة مطلوب');
        }
        try {
            $category = new Category($name, $description);
            if (!$category->create()) {
                die('فشل في إنشاء الفئة');
            }
        } catch (Exception $e) {
            die('خطأ: ' . $e->getMessage());
        }
        break;

    case 'update_category':
        if ($_SESSION['role'] !== 'ADMIN') {
            die('غير مسموح بالوصول');
        }
        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        if ($id === false || $id <= 0) {
            die('معرف الفئة غير صالح');
        }
        $name = $_POST['name'] ?? '';
        $description = $_POST['description'] ?? '';
        if (empty($name)) {
            die('اسم الفئة مطلوب');
        }
        try {
            $category = Category::getById($id);
            if (!$category) {
                die('الفئة غير موجودة');
            }
            $category = new Category($name, $description, $id);
            if (!$category->update()) {
                die('فشل في تحديث الفئة');
            }
        } catch (Exception $e) {
            die('خطأ: ' . $e->getMessage());
        }
        break;

    case 'delete_category':
        if ($_SESSION['role'] !== 'ADMIN') {
            die('غير مسموح بالوصول');
        }
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if ($id === false || $id <= 0) {
            die('معرف الفئة غير صالح');
        }
        try {
            $category = Category::getById($id);
            if ($category) {
                $conn->prepare("UPDATE news SET category_id = NULL WHERE category_id = ?")->execute([$id]);
                if (!$category->delete()) {
                    die('فشل في حذف الفئة');
                }
            }
        } catch (Exception $e) {
            die('خطأ: ' . $e->getMessage());
        }
        break;
}

header('Location: ../dashboard.php');
exit();
?>