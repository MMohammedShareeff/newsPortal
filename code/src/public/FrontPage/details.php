<?php
require_once '../../../../vendor/autoload.php';

use App\config\DatabaseConnection;
use App\news\News;
$pdo = DatabaseConnection::getConnection();

if (!isset($_GET['news_id']) || !is_numeric($_GET['news_id'])) {
  die("معرّف الخبر غير صالح.");
}

$news_id = $_GET['news_id'];
$news = News::getNewsById($news_id);

News::incrementViews($news_id);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = isset($_POST['commenterName']) ? trim($_POST['commenterName']) : 'ضيف';
  $comment = isset($_POST['commentText']) ? trim($_POST['commentText']) : '';

  if ($comment !== '') {
    $stmt = $pdo->prepare("INSERT INTO comments (commenter_name, comment_text, news_id) VALUES (?, ?, ?)");
    $stmt->execute([$name, $comment, $_GET['news_id'] ?? 1]);

    header("Location: " . $_SERVER['PHP_SELF'] . "?news_id=" . urlencode($news_id));
    exit;
  }
}

?>

<!DOCTYPE html>
<html dir="rtl" lang="ar">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Bootstrap Grid Example</title>
  <link rel="stylesheet" href="./css/style.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" />
</head>

<body>
  <nav class="navbar navbar-expand-lg bg-dark border-bottom border-body" data-bs-theme="dark">
    <div class="container">
      <a class="navbar-brand" href="#">
        <img src="./images/ubuntu-logo-rounded-ubuntu-logo-free-png.webp" alt="Logo" class="logo navbar-brand" />
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <div class="rigthSectoin col-sm-8">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active text-white" aria-current="page" href="index.php">الرئيسية</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="./category.php?category=politics">سياسة</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="./category.php?category=economy">اقتصاد</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="./category.php?category=health">صحة</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="./category.php?category=sport">رياضة</a>
            </li>
          </ul>
        </div>
        <div class="leftSection col-sm-4">
          <form class="d-flex" role="search">
            <input class="form-control me-2 bg-white" type="search" placeholder="ادخل كلمة للبحث" aria-label="Search" />
          </form>
        </div>
      </div>
    </div>
  </nav>

  <div class="container3">
    <div class="row">
      <div class="col-sm-8">
        <div class="category mb-3 mt-2">سياسة - فلسطين</div>
        <div class="content card-text">
          <div class="imgDesc fw-bold fs-4">
            <?= $news['title']; ?>
          </div>
          <p>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar"
              viewBox="0 0 16 16">
              <path
                d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z" />
            </svg>
            6 مارس 2025
          </p>

          <div class="row">
            <div class="col-sm-6 text-end">
              <h4 style="width: fit-content">شارك القصة</h4>
            </div>
            <div class="social-icons col-sm-6">
              <a href="#" class="social-circle"><i class="bi bi-facebook"></i></a>
              <a href="#" class="social-circle"><i class="bi bi-twitter"></i></a>
              <a href="#" class="social-circle"><i class="bi bi-instagram"></i></a>
              <a href="#" class="social-circle"><i class="bi bi-linkedin"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-sm-8">
        <div class="card">
          <div class="card-body">
            <img src=" <?= htmlspecialchars($news['image_url']); ?>" alt="image" class="card-img-bottom some" />
          </div>
        </div>

        <div class="content">
          <div class="fontController">
            <svg id="inc-btn" xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor"
              class="bi bi-plus-circle" viewBox="0 0 16 16">
              <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
              <path
                d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
            </svg>
            <span style="font-size: 22px"> الخط </span>

            <svg id="dec-btn" xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor"
              class="bi bi-dash-circle" viewBox="0 0 16 16">
              <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
              <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8" />
            </svg>
          </div>
          <div class="mainParagraph" id="main-text">
            <p>
              <?= htmlspecialchars($news['body']) ?>
            </p>
          </div>
        </div>
        <div class="comments mt-5 card">
          <h4 class="mb-4">التعليقات</h4>

          <?php
          $newsId = $_GET['news_id'] ?? 1;
          $stmt = $pdo->prepare("SELECT commenter_name, comment_text, created_at FROM comments WHERE news_id = ? ORDER BY created_at DESC");
          $stmt->execute([$newsId]);
          $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
          ?>

          <table class="table table-bordered table-hover">
            <thead class="table-light">
              <tr>
                <th>الاسم </th>
                <th>التعليق</th>
                <th>التاريخ</th>
              </tr>
            </thead>
            <tbody class="">
              <?php foreach ($comments as $c): ?>
                <tr>
                  <td><?= htmlspecialchars($c['commenter_name']) ?></td>
                  <td><?= htmlspecialchars($c['comment_text']) ?></td>
                  <td><?= date('Y-m-d H:i', strtotime($c['created_at'])) ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">أضف تعليقًا</h5>
              <form id="comments-form" method="post" action="">
                <div class="mb-3">
                  <label for="commenterName" class="form-label">الاسم</label>
                  <input type="text" name="commenterName" class="form-control" id="commenterName" placeholder="اسمك" />
                </div>
                <div class="mb-3">
                  <label for="commentText" class="form-label">التعليق</label>
                  <textarea name="commentText" class="form-control" id="commentText" rows="3"
                    placeholder="اكتب تعليقك هنا..."></textarea>
                </div>
                <button type="submit" class="btn btn-primary mb-5">إرسال</button>
              </form>
            </div>
          </div>
        </div>

        <?php
        $latest_news = News::getLatestNews($news['category_id']);
        ?>
        <div class="readMore">
          <div style="width: fit-content">
            <h3 class="pb-2">اقرأ أيضًا</h3>
          </div>
          <hr />
          <ul class="mostReadedList ps-0">
            <?php foreach ($latest_news as $item): ?>
              <li class="list-group-item">
                <a href="details.php?news_id=<?= urlencode($item['id']) ?>" class="text-decoration-none">
                  <?= htmlspecialchars($item['title']) ?>
                </a>
              </li>
              <hr />
            <?php endforeach; ?>
          </ul>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="moreFrom">
          <h3 class="pb-2" style="width: fit-content">المزيد من فلسطين</h3>
          <ul class="mostReadedList ps-0 border-top">
            <li class="list-group-item">
              هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد
              هذا النص من مولد النص العربى،
            </li>
            <hr />
            <li class="list-group-item">
              هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد
              هذا النص من مولد النص العربى،
            </li>
            <hr />
            <li class="list-group-item">
              هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد
              هذا النص من مولد النص العربى،
            </li>
          </ul>
        </div>
        <hr />
        <div class="adsArea pt-5">
          <div class="card">
            <div class="card-body">
              <img src="./images/sunsetWallpaper.jpg" alt="image" class="card-img-bottom some" />
              <div class="imgDesc bg-light text-center">AD</div>
            </div>
          </div>
        </div>
        <div class="relatedInfo">
          <div class="card">
            <div class="row card-body">
              <img class="col-sm-6" src="./images/sunsetWallpaper.jpg" alt="photo" />
              <div class="col-sm-6">
                <div class="category text-muted mb-1">سياسة</div>
                <p class="card-text">
                  هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم
                  توليد هذا النص من مولد النص العربى،
                </p>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="row card-body">
              <img class="col-sm-6" src="./images/sunsetWallpaper.jpg" alt="photo" />
              <div class="col-sm-6">
                <div class="category text-muted mb-1">سياسة</div>
                <p class="card-text">
                  هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم
                  توليد هذا النص من مولد النص العربى،
                </p>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="row card-body">
              <img class="col-sm-6" src="./images/sunsetWallpaper.jpg" alt="photo" />
              <div class="col-sm-6">
                <div class="category text-muted mb-1">سياسة</div>
                <p class="card-text">
                  هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم
                  توليد هذا النص من مولد النص العربى،
                </p>
              </div>
            </div>
          </div>
        </div>
        <div class="adsArea pt-5">
          <div class="card">
            <div class="card-body">
              <img src="./images/sunsetWallpaper.jpg" alt="image" class="card-img-bottom some" />
              <div class="imgDesc bg-light text-center">AD</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
  <script src="js/font.js"></script>
</body>

<div class="footer bg-light border-top" style="padding: 0; margin: 0">
  <div class="container2">
    <footer class="row row-cols-5 py-5">
      <div class="col">
        <img src="./images/ubuntu-logo-rounded-ubuntu-logo-free-png.webp" alt="logo" class="logo" />
        <div class="" style="padding-top: 30px">
          <p class="">
            تغطية اخبارية شاملة ومتعددة الوسائط للأحداث العربية والعالمية
            ويتيح الوصول إلى شبكة منوعة من البرامج السياسية والاجتماعية
          </p>
        </div>
      </div>

      <div class="col"></div>

      <div class="col">
        <h5>روابط</h5>
        <ul class="nav flex-column">
          <li class="nav-item mb-2">
            <a href="./politicsPage.html" class="nav-link p-0 text-muted">سياسة</a>
          </li>
          <li class="nav-item mb-2">
            <a href="./economyPage.html" class="nav-link p-0 text-muted">اقنصاد</a>
          </li>
          <li class="nav-item mb-2">
            <a href="#" class="nav-link p-0 text-muted">فن وثقافة</a>
          </li>
          <li class="nav-item mb-2">
            <a href="./sportPage.html" class="nav-link p-0 text-muted">رياضة</a>
          </li>
          <li class="nav-item mb-2">
            <a href="#" class="nav-link p-0 text-muted">منوعات</a>
          </li>
        </ul>
      </div>

      <div class="col">
        <h5>عن الموقع</h5>
        <ul class="nav flex-column">
          <li class="nav-item mb-2">
            <a href="#" class="nav-link p-0 text-muted">من نحن</a>
          </li>
          <li class="nav-item mb-2">
            <a href="#" class="nav-link p-0 text-muted">أعلن معنا</a>
          </li>
        </ul>
      </div>

      <div class="col">
        <h5>اتصل بنا</h5>
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-circle-fill"
          viewBox="0 0 16 16">
          <circle cx="8" cy="8" r="8" />
        </svg>
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-circle-fill"
          viewBox="0 0 16 16">
          <circle cx="8" cy="8" r="8" />
        </svg>
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-circle-fill"
          viewBox="0 0 16 16">
          <circle cx="8" cy="8" r="8" />
        </svg>
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-circle-fill"
          viewBox="0 0 16 16">
          <circle cx="8" cy="8" r="8" />
        </svg>
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-circle-fill"
          viewBox="0 0 16 16">
          <circle cx="8" cy="8" r="8" />
        </svg>
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-circle-fill"
          viewBox="0 0 16 16">
          <circle cx="8" cy="8" r="8" />
        </svg>
      </div>
    </footer>
  </div>
</div>

</html>