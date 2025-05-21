<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require_once '../../../../vendor/autoload.php';

use App\config\DatabaseConnection;

$pdo = DatabaseConnection::getConnection();



$mainStmt = $pdo->prepare("
    SELECT news.*, category.name AS category_name
    FROM news
    JOIN category ON news.category_id = category.id
    ORDER BY news.date_posted DESC
    LIMIT 1
");
$mainStmt->execute();
$mainNews = $mainStmt->fetch(PDO::FETCH_ASSOC);

$categoryStmt = $pdo->prepare("
    SELECT n.*, c.name AS category_name
    FROM category c
    JOIN news n 
      ON n.id = (
        SELECT id 
        FROM news 
        WHERE category_id = c.id 
              AND id != :mainId
        ORDER BY date_posted DESC
        LIMIT 1
      )
    ORDER BY n.date_posted DESC
    LIMIT 4
");

$categoryStmt->execute(['mainId' => $mainNews['id']]);
$categoryNews = $categoryStmt->fetchAll(PDO::FETCH_ASSOC);

$mostStmt = $pdo->prepare("
  SELECT title, id 
  FROM news 
  ORDER BY total_views DESC 
  LIMIT 5
");
$mostStmt->execute();
$mostRead = $mostStmt->fetchAll(PDO::FETCH_ASSOC);


$mostCommentedStmt = $pdo->prepare("
  SELECT n.title, n.id
  FROM news n
  LEFT JOIN comments c ON c.news_id = n.id
  GROUP BY n.id
  ORDER BY COUNT(c.id) DESC
  LIMIT 5
");
$mostCommentedStmt->execute();
$mostCommented = $mostCommentedStmt->fetchAll(PDO::FETCH_ASSOC);

$arabicNames = [
  'sport' => 'رياضة',
 'politics' => 'سياسة',
 'health' => 'صحة',
'economy' => 'اقتصاد',
];

function limitWords($text, $limit = 50) {
  $words = explode(' ', $text);
  if (count($words) <= $limit) {
      return $text;
  }
  return implode(' ', array_slice($words, 0, $limit)) . '…';
}

?>
<!DOCTYPE html>
<html dir="rtl" lang="ar">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>News Portal</title>
  <link rel="stylesheet" href="./css/style.css"/>
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" />
</head>

<body>
  <nav
    class="navbar navbar-expand-lg bg-dark border-bottom border-body"
    data-bs-theme="dark">
    <div class="container">
      <a class="navbar-brand" href="#">
        <img
          src="./images/ubuntu-logo-rounded-ubuntu-logo-free-png.webp"
          alt="Logo"
          class="logo navbar-brand" />
      </a>
      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent"
        aria-expanded="false"
        aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <div class="rigthSectoin col-sm-8">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a
                class="nav-link active text-white"
                aria-current="page"
                href="index.php">الرئيسية</a>
            </li>
            <li class="nav-item">
              <a
                class="nav-link text-white"
                href="./category.php?category=politics">سياسة</a>
            </li>
            <li class="nav-item">
              <a
                class="nav-link text-white"
                href="./category.php?category=economy">اقتصاد</a>
            </li>
            <li class="nav-item">
              <a
                class="nav-link text-white"
                href="./category.php?category=health">صحة</a>
            </li>
            <li class="nav-item">
              <a
                class="nav-link text-white"
                href="./category.php?category=sport">رياضة</a>
            </li>
          </ul>
        </div>
        <div class="leftSection col-sm-4">
          <form class="d-flex" role="search">
            <input
              class="form-control me-2 bg-white"
              type="search"
              placeholder="ادخل كلمة للبحث"
              aria-label="Search" />
          </form>
        </div>
      </div>
    </div>
  </nav>

  <div class="container2">

  <div class="mainSection section mt-4">
    <div class="row">
      <div class="col-sm-5">
        <a href="details-page.php?news_id=<?= urlencode($mainNews['id']) ?>" class="text-decoration-none; color: inherit;">
          <div class="card bg-dark" style="height: 100%">
            <img
              src="<?= htmlspecialchars($mainNews['image_url']) ?>"
              alt="image"
              class="card-img-top" />
            <div class="card-body">
              <div class="category text-light mb-3 mt-2">
                <?= htmlspecialchars($arabicNames[$mainNews['category_name']]) ?>
              </div>
              <div class="content text-white card-text">
                <h2 class="pb-4"><?= htmlspecialchars($mainNews['title']) ?></h2>
                
                <p><?= nl2br(htmlspecialchars(limitWords($mainNews['body'], 80))) ?></p>
              </div>
            </div>
          </div>
        </a>
      </div>

      <div class="col-sm-7">
        <div class="row">
          <?php
              foreach ($categoryNews as $index => $news) {
                if ($index === 2) {
                  echo '</div><div class="row">';
                }
                $limitedBody = limitWords($news['body'], 20);
                echo '
                  <div class="col-sm-6">
                    <a href="details-page.php?id=' . urlencode($news['id']) . '" style="text-decoration: none; color: inherit;">
                      <div class="card">
                        <img src="' . $news['image_url'] . '" alt="image" class="card-img-top" />
                        <div class="card-body">
                          <div class="category text-muted mb-1">' . htmlspecialchars($arabicNames[$news['category_name']]) . ' - ' . htmlspecialchars($news['country']) . '</div>
                          <p class="card-text truncate-lines">' . htmlspecialchars($limitedBody) . '</p>
                        </div>
                      </div>
                    </a>
                  </div>
                ';
              }
          ?>

        </div>
      </div>
    </div>
  </div>

  <div class="secondSection row section mt-4">
    <div class="col-sm-6 mostReaded mt-3">
      <div style="width: fit-content"><h3>الأكثر قراءة</h3></div>
      <hr />
      <ul class="mostReadedList ps-0">
        <?php foreach ($mostRead as $i => $item): ?>
            <li class="list-group-item">
              <a href="details-page.php?news_id=<?= urlencode($item['id']) ?>" class="text-decoration-none; color: inherit;">
                <?= htmlspecialchars(limitWords($item['title'], 20)) ?>
              </a>
            </li>
          <?php if ($i < count($mostRead) - 1): ?><hr /><?php endif; ?>
        <?php endforeach; ?>
      </ul>
    </div>

    <div class="col-sm-6 mostReaded mt-3">
      <div style="width: fit-content"><h3>الأكثر تعليقا</h3></div>
      <hr />
      <ul class="mostReadedList ps-0">
        <?php foreach ($mostCommented as $i => $item): ?>
          <li class="list-group-item">
            <a href="details-page.php?news_id=<?= urlencode($item['id']) ?>" class="text-decoration-none; color: inherit;">
              <?= htmlspecialchars(limitWords($item['title'], 20)) ?>
            </a>
          </li>
          <?php if ($i < count($mostCommented) - 1): ?><hr /><?php endif; ?>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>


<!-- Politics Section -->
  <?php
    $stmt = $pdo->prepare("
        SELECT n.*, c.name AS category_name
        FROM news n
        JOIN category c ON n.category_id = c.id
        WHERE c.name = ?
        ORDER BY n.date_posted DESC
        LIMIT 5
    ");
    $stmt->execute(['politics']);
    $politicsNews = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo '<div class="politicsSectoin row section mt-4">';
    echo '  <div class="col" style="width: fit-content"><h3 style="width: fit-content">سياسة</h3></div>';
    echo '  <div class="col text-start"><a href="category.php?category=politics">المزيد</a></div>';
    echo '  <hr />';

    if (!empty($politicsNews)) {
        $first = array_shift($politicsNews);
        echo '
          <div class="col-sm-6 mianSectoinNew">
            <a href="details-page.php?id=' . urlencode($first['id']) . '" style="text-decoration: none; color: inherit;">
              <div class="card" style="width: 100%; height: 100%">
                <img
                  src="' . htmlspecialchars($first['image_url']) . '"
                  alt="image"
                  class="card-img-top" />
                <div class="card-body">
                  <div class="category text-muted mb-1">سياسة</div>
                  <p class="card-text">' . htmlspecialchars(limitWords($first['body'], 100)) . '</p>
                </div>
              </div>
            </a>
          </div>
        ';
    }

    echo '<div class="col-sm-6 subSectoinNew">';
    foreach (array_chunk($politicsNews, 2) as $row) {
        echo '<div class="row">';
        foreach ($row as $item) {
            echo '
              <div class="col-sm-6">
                <a href="details-page.php?id=' . urlencode($item['id']) . '" style="text-decoration: none; color: inherit;">
                  <div class="card" style="width: 100%">
                    <img
                      src="' . htmlspecialchars($item['image_url']) . '"
                      alt="image"
                      class="card-img-top midImageNew" />
                    <div class="card-body">
                      <div class="category text-muted mb-1">سياسة</div>
                      <p class="card-text">' . htmlspecialchars(limitWords($item['body'], 20)) . '</p>
                    </div>
                  </div>
                </a>
              </div>
            ';
        }
        echo '</div>';
    }
    echo '</div>';   
    echo '</div>';  

  ?>

<!-- Economy Section -->
  <?php
    $stmt = $pdo->prepare("
        SELECT n.*, c.name AS category_name
        FROM news n
        JOIN category c ON n.category_id = c.id
        WHERE c.name = ?
        ORDER BY n.date_posted DESC
        LIMIT 5
    ");
    $stmt->execute(['economy']);
    $economyNews = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo '<div class="economySectoin row section mt-4">';
    echo '  <div class="col" style="width: fit-content"><h3 style="width: fit-content">اقتصاد</h3></div>';
    echo '  <div class="col text-start"><a href="category.php?category=economy">المزيد</a></div>';
    echo '  <hr />';

    if (!empty($economyNews)) {
        $first = array_shift($economyNews);
        echo '
          <div class="col-sm-6 mianSectoinNew">
            <a href="details-page.php?id=' . urlencode($first['id']) . '" style="text-decoration: none; color: inherit;">
              <div class="card" style="width: 100%; height: 100%">
                <img
                  src="' . htmlspecialchars($first['image_url']) . '"
                  alt="image"
                  class="card-img-top bigImageNew" />
                <div class="card-body">
                  <div class="category text-muted mb-1">اقتصاد</div>
                  <p class="card-text">' . htmlspecialchars(limitWords($first['body'], 100)) . '</p>
                </div>
              </div>
            </a>
          </div>
        ';
    }

    echo '<div class="col-sm-6 subSectoinNew">';
    foreach (array_chunk($economyNews, 2) as $row) {
        echo '<div class="row">';
        foreach ($row as $item) {
            echo '
              <div class="col-sm-6">
                <a href="details-page.php?id=' . urlencode($item['id']) . '" style="text-decoration: none; color: inherit;">
                  <div class="card" style="width: 100%">
                    <img
                      src="' . htmlspecialchars($item['image_url']) . '"
                      alt="image"
                      class="card-img-top midImageNew" />
                    <div class="card-body">
                      <div class="category text-muted mb-1">اقتصاد</div>
                      <p class="card-text">' . htmlspecialchars(limitWords($item['body'], 20)) . '</p>
                    </div>
                  </div>
                </a>
              </div>
            ';
        }
        echo '</div>';
    }
    echo '</div>';   
    echo '</div>'; 
  ?>

<!-- Sport Section -->
  <?php
    $stmt = $pdo->prepare("
        SELECT n.*, c.name AS category_name
        FROM news n
        JOIN category c ON n.category_id = c.id
        WHERE c.name = ?
        ORDER BY n.date_posted DESC
        LIMIT 5
    ");
    $stmt->execute(['sport']);
    $sportNews = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo '<div class="sportSectoin row section mt-4">';
    echo '  <div class="col" style="width: fit-content"><h3 style="width: fit-content">رياضة</h3></div>';
    echo '  <div class="col text-start"><a href="category.php?category=sport">المزيد</a></div>';
    echo '  <hr />';

    if (!empty($sportNews)) {
        $first = array_shift($sportNews);
        echo '
          <div class="col-sm-6 mianSectoinNew">
            <a href="details-page.php?id=' . urlencode($first['id']) . '" style="text-decoration: none; color: inherit;">
              <div class="card" style="width: 100%; height: 100%">
                <img
                  src="' . htmlspecialchars($first['image_url']) . '"
                  alt="image"
                  class="card-img-top bigImageNew" />
                <div class="card-body">
                  <div class="category text-muted mb-1">رياضة</div>
                  <p class="card-text">' . htmlspecialchars(limitWords($first['body'], 100)) . '</p>
                </div>
              </div>
            </a>
          </div>
        ';
    }

    echo '<div class="col-sm-6 subSectoinNew">';
    foreach (array_chunk($sportNews, 2) as $row) {
        echo '<div class="row">';
        foreach ($row as $item) {
            echo '
              <div class="col-sm-6">
                <a href="details-page.php?id=' . urlencode($item['id']) . '" style="text-decoration: none; color: inherit;">
                  <div class="card" style="width: 100%">
                    <img
                      src="' . htmlspecialchars($item['image_url']) . '"
                      alt="image"
                      class="card-img-top midImageNew" />
                    <div class="card-body">
                      <div class="category text-muted mb-1">رياضة</div>
                      <p class="card-text">' . htmlspecialchars(limitWords($item['body'], 20)) . '</p>
                    </div>
                  </div>
                </a>
              </div>
            ';
        }
        echo '</div>';
    }
    echo '</div>';
    echo '</div>';
  ?>

<!-- Health Section -->
  <?php
    $stmt = $pdo->prepare("
        SELECT n.*, c.name AS category_name
        FROM news n
        JOIN category c ON n.category_id = c.id
        WHERE c.name = ?
        ORDER BY n.date_posted DESC
        LIMIT 5
    ");
    $stmt->execute(['health']);
    $healthNews = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo '<div class="healthSectoin row section mt-4">';
    echo '  <div class="col" style="width: fit-content"><h3 style="width: fit-content">صحة</h3></div>';
    echo '  <div class="col text-start"><a href="category.php?category=health">المزيد</a></div>';
    echo '  <hr />';

    if (!empty($healthNews)) {
        $first = array_shift($healthNews);
        echo '
          <div class="col-sm-6 mianSectoinNew">
            <a href="details-page.php?id=' . urlencode($first['id']) . '" style="text-decoration: none; color: inherit;">
              <div class="card" style="width: 100%; height: 100%">
                <img
                  src="' . htmlspecialchars($first['image_url']) . '"
                  alt="image"
                  class="card-img-top bigImageNew" />
                <div class="card-body">
                  <div class="category text-muted mb-1">صحة</div>
                  <p class="card-text">' . htmlspecialchars(limitWords($first['body'], 100)) . '</p>
                </div>
              </div>
            </a>
          </div>
        ';
    }

    echo '<div class="col-sm-6 subSectoinNew">';
    foreach (array_chunk($healthNews, 2) as $row) {
        echo '<div class="row">';
        foreach ($row as $item) {
            echo '
              <div class="col-sm-6">
                <a href="details-page.php?id=' . urlencode($item['id']) . '" style="text-decoration: none; color: inherit;">
                  <div class="card" style="width: 100%">
                    <img
                      src="' . htmlspecialchars($item['image_url']) . '"
                      alt="image"
                      class="card-img-top midImageNew" />
                    <div class="card-body">
                      <div class="category text-muted mb-1">صحة</div>
                      <p class="card-text">' . htmlspecialchars(limitWords($item['body'], 20)) . '</p>
                    </div>
                  </div>
                </a>
              </div>
            ';
        }
        echo '</div>';
    }
    echo '</div>';   
    echo '</div>';
  ?>



  </div>

  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>
<div class="footer bg-light border-top" style="padding: 0; margin: 0">
  <div class="container2">
    <footer class="row row-cols-5 py-5">
      <div class="col">
        <img
          src="./images/ubuntu-logo-rounded-ubuntu-logo-free-png.webp"
          alt="logo"
          class="logo" />
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
        <svg
          xmlns="http://www.w3.org/2000/svg"
          width="16"
          height="16"
          fill="currentColor"
          class="bi bi-circle-fill"
          viewBox="0 0 16 16">
          <circle cx="8" cy="8" r="8" />
        </svg>
        <svg
          xmlns="http://www.w3.org/2000/svg"
          width="16"
          height="16"
          fill="currentColor"
          class="bi bi-circle-fill"
          viewBox="0 0 16 16">
          <circle cx="8" cy="8" r="8" />
        </svg>
        <svg
          xmlns="http://www.w3.org/2000/svg"
          width="16"
          height="16"
          fill="currentColor"
          class="bi bi-circle-fill"
          viewBox="0 0 16 16">
          <circle cx="8" cy="8" r="8" />
        </svg>
        <svg
          xmlns="http://www.w3.org/2000/svg"
          width="16"
          height="16"
          fill="currentColor"
          class="bi bi-circle-fill"
          viewBox="0 0 16 16">
          <circle cx="8" cy="8" r="8" />
        </svg>
        <svg
          xmlns="http://www.w3.org/2000/svg"
          width="16"
          height="16"
          fill="currentColor"
          class="bi bi-circle-fill"
          viewBox="0 0 16 16">
          <circle cx="8" cy="8" r="8" />
        </svg>
        <svg
          xmlns="http://www.w3.org/2000/svg"
          width="16"
          height="16"
          fill="currentColor"
          class="bi bi-circle-fill"
          viewBox="0 0 16 16">
          <circle cx="8" cy="8" r="8" />
        </svg>
      </div>
    </footer>
  </div>
</div>

</html>


