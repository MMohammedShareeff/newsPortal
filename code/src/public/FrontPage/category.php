<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo "Step 1: before require<br>";

require_once '../../../../vendor/autoload.php';

echo "Step 2: after require<br>";

use App\config\DatabaseConnection;

echo "Step 3: after use<br>";

$pdo = DatabaseConnection::getConnection();

echo "Step 4: after db connection<br>";

?>
<!DOCTYPE html>
<html dir="rtl" lang="ar">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>News Portal</title>
  <link rel="stylesheet" href="./css/style.css" />
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
  
 
  <?php
  $categoryName = $_GET['category'] ?? null;

   if ($categoryName !== null) {
    $stmt = $pdo->prepare("
        SELECT news.*, category.name AS category_name 
         FROM news 
         JOIN category ON news.category_id = category.id 
         WHERE category.name = ?
       ORDER BY news.date_posted DESC
     ");

     $stmt->execute([$categoryName]);
     $news = $stmt->fetchAll(PDO::FETCH_ASSOC);

     $arabicNames = [
       'sport' => 'رياضة',
      'politics' => 'سياسة',
      'health' => 'صحة',
     'economy' => 'اقتصاد',
   ];

    $arabicCategoryName = $arabicNames[$categoryName] ?? $categoryName;

   echo '
   <div class="container3 category sport">
      <h1 style="width: fit-content" class="pt-3">' . $arabicCategoryName . '</h1>
      <hr />
      <div class="section mainSection row">
   ';

    if (!empty($news)) {
      $first = array_shift($news);
      echo '
       <div class="col-sm-8">
           <div class="card-body">
                 <img src="' . $first['image_url'] . '" alt="image" class="card-img-top" />
                <div class="mb-3 mt-2">' . $arabicCategoryName . ' - ' . $first['country'] . '</div>
               <div class="content card-text">
                    <h2 class="pb-4">' . $first['title'] . '</h2>
                   <p>' . $first['body'] . '</p>
               </div>
            </div>
       </div>
        ';
    }

    echo '<div class="col-sm-4">';
    for ($i = 0; $i < 2 && !empty($news); $i++) {
      $item = array_shift($news);
      echo '
        <div class="card-body">
             <img src="' . $item['image_url'] . '" alt="image" class="card-img-top" />
            <div class="mb-3 mt-2">' . $item['country'] . ' - ' . $arabicCategoryName . '</div>
            <div class="content card-text">
                <h2 class="pb-4">' . $item['title'] . '</h2>
                <p>' . $item['body'] . '</p>
             </div>
         </div>
        ';
     }

     for ($i = 0; $i < 2 && !empty($news); $i++) {
       $item = array_shift($news);
      echo '
        <div class="card">
             <div class="row card-body">
                <img class="col-sm-6" src="' . $item['image_url'] . '" alt="photo" />
                 <div class="col-sm-6">
                    <div class="text-muted mb-1">' . $arabicCategoryName . '</div>
                   <p class="card-text">' . mb_substr($item['body'], 0, 100) . '...</p>
               </div>
           </div>
       </div>
        ';
   }
   echo '</div></div>';

    echo '<div class="otherNews row"><div class="col-sm-8">';
   for ($i = 0; $i < 3 && !empty($news); $i++) {
      $item = array_shift($news);
      echo '
        <div class="card">
             <div class="row card-body">
              <img class="col-sm-4" src="' . $item['image_url'] . '" alt="photo" />
              <div class="col-sm-6">
                   <div class="text-muted mb-2 pt-2">' . $arabicCategoryName . '</div>
                  <div class="card-text">
                      <h5 class="pb-2">' . $item['title'] . '</h5>
                      <p>' . mb_substr($item['body'], 0, 100) . '...</p>
                  </div>
             </div>
         </div>
       </div>
         ';
    }
   echo '</div>';

    echo '
    <div class="col-sm-4">
       <div class="adsArea pt-5">
           <div class="card">
               <div class="card-body">
                   <img src="./images/sunsetWallpaper.jpg" alt="image" class="card-img-bottom some" />
                   <div class="imgDesc bg-light text-center">AD</div>
              </div>
           </div>
       </div>
    </div>
    </div></div>';
  } else {
    echo '<div class="container3 pt-5"><h2 class="text-danger">لم يتم تحديد القسم</h2></div>';
  } 

  ?>

  <!-- <div class="container3 category sport">
    <h1 style="width: fit-content" class="pt-3">رياضة</h1>
    <hr />

    <div class="section mainSection row">
      <div class="col-sm-8">
        <div class="card-body">
          <img
            src="./images/sunsetWallpaper.jpg"
            alt="image"
            class="card-img-top" />
          <div class="mb-3 mt-2">رياضة - فلسطين</div>
          <div class="content card-text">
            <h2 class="pb-4">
              هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة
            </h2>
            <p class="">
              هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد
              هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو
              العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها
              التطبيق.
            </p>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="card-body">
          <img
            src="./images/sunsetWallpaper.jpg"
            alt="image"
            class="card-img-top" />
          <div class="mb-3 mt-2">فلسطين - رياضة</div>
          <div class="content card-text">
            <h2 class="pb-4">
              هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة
            </h2>
            <p class="">
              هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد
              هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو
              العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها
              التطبيق.
            </p>
          </div>
        </div>
        <div class="card">
          <div class="row card-body">
            <img
              class="col-sm-6"
              src="./images/sunsetWallpaper.jpg"
              alt="photo" />
            <div class="col-sm-6">
              <div class="text-muted mb-1">رياضة</div>
              <p class="card-text">
                هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم
                توليد هذا النص من مولد النص العربى،
              </p>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="row card-body">
            <img
              class="col-sm-6"
              src="./images/sunsetWallpaper.jpg"
              alt="photo" />
            <div class="col-sm-6">
              <div class="text-muted mb-1">رياضة</div>
              <p class="card-text">
                هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم
                توليد هذا النص من مولد النص العربى،
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="otherNews row">
      <div class="col-sm-8">
        <div class="card">
          <div class="row card-body">
            <img
              class="col-sm-4"
              src="./images/sunsetWallpaper.jpg"
              alt="photo" />
            <div class="col-sm-6">
              <div class="text-muted mb-2 pt-2">رياضة</div>
              <div class="card-text">
                <h5 class="pb-2">
                  هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة
                </h5>
                <p>
                  هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم
                  توليد هذا النص من مولد النص العربى،
                </p>
              </div>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="row card-body">
            <img
              class="col-sm-4"
              src="./images/sunsetWallpaper.jpg"
              alt="photo" />
            <div class="col-sm-6">
              <div class="text-muted mb-2 pt-2">رياضة</div>
              <div class="card-text">
                <h5 class="pb-2">
                  هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة
                </h5>
                <p>
                  هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم
                  توليد هذا النص من مولد النص العربى،
                </p>
              </div>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="row card-body">
            <img
              class="col-sm-4"
              src="./images/sunsetWallpaper.jpg"
              alt="photo" />
            <div class="col-sm-6">
              <div class="text-muted mb-2 pt-2">رياضة</div>
              <div class="card-text">
                <h5 class="pb-2">
                  هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة
                </h5>
                <p>
                  هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم
                  توليد هذا النص من مولد النص العربى،
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="adsArea pt-5">
          <div class="card">
            <div class="card-body">
              <img
                src="./images/sunsetWallpaper.jpg"
                alt="image"
                class="card-img-bottom some" />
              <div class="imgDesc bg-light text-center">AD</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="container3 category politics">
    <h1 style="width: fit-content" class="pt-3">سياسة</h1>
    <hr />

    <div class="section mainSection row">
      <div class="col-sm-8">
        <div class="card-body">
          <img
            src="./images/sunsetWallpaper.jpg"
            alt="image"
            class="card-img-top" />
          <div class="mb-3 mt-2">سياسة - فلسطين</div>
          <div class="content card-text">
            <h2 class="pb-4">
              هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة
            </h2>
            <p class="">
              هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد
              هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو
              العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها
              التطبيق.
            </p>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="card-body">
          <img
            src="./images/sunsetWallpaper.jpg"
            alt="image"
            class="card-img-top" />
          <div class="mb-3 mt-2">سياسة - فلسطين</div>
          <div class="content card-text">
            <h2 class="pb-4">
              هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة
            </h2>
            <p class="">
              هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد
              هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو
              العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها
              التطبيق.
            </p>
          </div>
        </div>
        <div class="card">
          <div class="row card-body">
            <img
              class="col-sm-6"
              src="./images/sunsetWallpaper.jpg"
              alt="photo" />
            <div class="col-sm-6">
              <div class="text-muted mb-1">سياسة</div>
              <p class="card-text">
                هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم
                توليد هذا النص من مولد النص العربى،
              </p>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="row card-body">
            <img
              class="col-sm-6"
              src="./images/sunsetWallpaper.jpg"
              alt="photo" />
            <div class="col-sm-6">
              <div class="text-muted mb-1">سياسة</div>
              <p class="card-text">
                هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم
                توليد هذا النص من مولد النص العربى،
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="otherNews row">
      <div class="col-sm-8">
        <div class="card">
          <div class="row card-body">
            <img
              class="col-sm-4"
              src="./images/sunsetWallpaper.jpg"
              alt="photo" />
            <div class="col-sm-6">
              <div class="text-muted mb-2 pt-2">سياسة</div>
              <div class="card-text">
                <h5 class="pb-2">
                  هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة
                </h5>
                <p>
                  هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم
                  توليد هذا النص من مولد النص العربى،
                </p>
              </div>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="row card-body">
            <img
              class="col-sm-4"
              src="./images/sunsetWallpaper.jpg"
              alt="photo" />
            <div class="col-sm-6">
              <div class="text-muted mb-2 pt-2">سياسة</div>
              <div class="card-text">
                <h5 class="pb-2">
                  هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة
                </h5>
                <p>
                  هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم
                  توليد هذا النص من مولد النص العربى،
                </p>
              </div>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="row card-body">
            <img
              class="col-sm-4"
              src="./images/sunsetWallpaper.jpg"
              alt="photo" />
            <div class="col-sm-6">
              <div class="text-muted mb-2 pt-2">سياسة</div>
              <div class="card-text">
                <h5 class="pb-2">
                  هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة
                </h5>
                <p>
                  هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم
                  توليد هذا النص من مولد النص العربى،
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="adsArea pt-5">
          <div class="card">
            <div class="card-body">
              <img
                src="./images/sunsetWallpaper.jpg"
                alt="image"
                class="card-img-bottom some" />
              <div class="imgDesc bg-light text-center">AD</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="container3 category health">
    <h1 style="width: fit-content" class="pt-3">صحة</h1>
    <hr />

    <div class="section mainSection row">
      <div class="col-sm-8">
        <div class="card-body">
          <img
            src="./images/sunsetWallpaper.jpg"
            alt="image"
            class="card-img-top" />
          <div class="mb-3 mt-2">فلسطين - صحة</div>
          <div class="content card-text">
            <h2 class="pb-4">
              هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة
            </h2>
            <p class="">
              هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد
              هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو
              العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها
              التطبيق.
            </p>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="card-body">
          <img
            src="./images/sunsetWallpaper.jpg"
            alt="image"
            class="card-img-top" />
          <div class="mb-3 mt-2">فلسطين - صحة</div>
          <div class="content card-text">
            <h2 class="pb-4">
              هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة
            </h2>
            <p class="">
              هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد
              هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو
              العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها
              التطبيق.
            </p>
          </div>
        </div>
        <div class="card">
          <div class="row card-body">
            <img
              class="col-sm-6"
              src="./images/sunsetWallpaper.jpg"
              alt="photo" />
            <div class="col-sm-6">
              <div class="text-muted mb-1">صحة</div>
              <p class="card-text">
                هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم
                توليد هذا النص من مولد النص العربى،
              </p>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="row card-body">
            <img
              class="col-sm-6"
              src="./images/sunsetWallpaper.jpg"
              alt="photo" />
            <div class="col-sm-6">
              <div class="text-muted mb-1">صحة</div>
              <p class="card-text">
                هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم
                توليد هذا النص من مولد النص العربى،
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="otherNews row">
      <div class="col-sm-8">
        <div class="card">
          <div class="row card-body">
            <img
              class="col-sm-4"
              src="./images/sunsetWallpaper.jpg"
              alt="photo" />
            <div class="col-sm-6">
              <div class="text-muted mb-2 pt-2">صحة</div>
              <div class="card-text">
                <h5 class="pb-2">
                  هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة
                </h5>
                <p>
                  هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم
                  توليد هذا النص من مولد النص العربى،
                </p>
              </div>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="row card-body">
            <img
              class="col-sm-4"
              src="./images/sunsetWallpaper.jpg"
              alt="photo" />
            <div class="col-sm-6">
              <div class="text-muted mb-2 pt-2">صحة</div>
              <div class="card-text">
                <h5 class="pb-2">
                  هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة
                </h5>
                <p>
                  هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم
                  توليد هذا النص من مولد النص العربى،
                </p>
              </div>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="row card-body">
            <img
              class="col-sm-4"
              src="./images/sunsetWallpaper.jpg"
              alt="photo" />
            <div class="col-sm-6">
              <div class="text-muted mb-2 pt-2">صحة</div>
              <div class="card-text">
                <h5 class="pb-2">
                  هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة
                </h5>
                <p>
                  هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم
                  توليد هذا النص من مولد النص العربى،
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="adsArea pt-5">
          <div class="card">
            <div class="card-body">
              <img
                src="./images/sunsetWallpaper.jpg"
                alt="image"
                class="card-img-bottom some" />
              <div class="imgDesc bg-light text-center">AD</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="container3 category economy">
    <h1 style="width: fit-content" class="pt-3">اقتصاد</h1>
    <hr />

    <div class="section mainSection row">
      <div class="col-sm-8">
        <div class="card-body">
          <img
            src="./images/sunsetWallpaper.jpg"
            alt="image"
            class="card-img-top" />
          <div class=" mb-3 mt-2">فلسطين - اقتصاد</div>
          <div class="content card-text">
            <h2 class="pb-4">
              هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة
            </h2>
            <p class="">
              هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد
              هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو
              العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها
              التطبيق.
            </p>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="card-body">
          <img
            src="./images/sunsetWallpaper.jpg"
            alt="image"
            class="card-img-top" />
          <div class=" mb-3 mt-2">فلسطين - اقتصاد</div>
          <div class="content card-text">
            <h2 class="pb-4">
              هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة
            </h2>
            <p class="">
              هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد
              هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو
              العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها
              التطبيق.
            </p>
          </div>
        </div>
        <div class="card">
          <div class="row card-body">
            <img
              class="col-sm-6"
              src="./images/sunsetWallpaper.jpg"
              alt="photo" />
            <div class="col-sm-6">
              <div class=" text-muted mb-1">اقتصاد</div>
              <p class="card-text">
                هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم
                توليد هذا النص من مولد النص العربى،
              </p>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="row card-body">
            <img
              class="col-sm-6"
              src="./images/sunsetWallpaper.jpg"
              alt="photo" />
            <div class="col-sm-6">
              <div class=" text-muted mb-1">اقتصاد</div>
              <p class="card-text">
                هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم
                توليد هذا النص من مولد النص العربى،
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="otherNews row">
      <div class="col-sm-8">
        <div class="card">
          <div class="row card-body">
            <img
              class="col-sm-4"
              src="./images/sunsetWallpaper.jpg"
              alt="photo" />
            <div class="col-sm-6">
              <div class=" text-muted mb-2 pt-2">اقتصاد</div>
              <div class="card-text">
                <h5 class="pb-2">
                  هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة
                </h5>
                <p>
                  هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم
                  توليد هذا النص من مولد النص العربى،
                </p>
              </div>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="row card-body">
            <img
              class="col-sm-4"
              src="./images/sunsetWallpaper.jpg"
              alt="photo" />
            <div class="col-sm-6">
              <div class=" text-muted mb-2 pt-2">اقتصاد</div>
              <div class="card-text">
                <h5 class="pb-2">
                  هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة
                </h5>
                <p>
                  هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم
                  توليد هذا النص من مولد النص العربى،
                </p>
              </div>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="row card-body">
            <img
              class="col-sm-4"
              src="./images/sunsetWallpaper.jpg"
              alt="photo" />
            <div class="col-sm-6">
              <div class=" text-muted mb-2 pt-2">اقتصاد</div>
              <div class="card-text">
                <h5 class="pb-2">
                  هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة
                </h5>
                <p>
                  هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم
                  توليد هذا النص من مولد النص العربى،
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="adsArea pt-5">
          <div class="card">
            <div class="card-body">
              <img
                src="./images/sunsetWallpaper.jpg"
                alt="image"
                class="card-img-bottom some" />
              <div class="imgDesc bg-light text-center">AD</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div> -->

   <script src="./categorySelector.js"></script>
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