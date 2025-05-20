<!DOCTYPE html>
<html dir="rtl" lang="ar">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>News Portal</title>
    <link rel="stylesheet" href="./css/style.css" />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
    />
  </head>
  <body>
    <nav
      class="navbar navbar-expand-lg bg-dark border-bottom border-body"
      data-bs-theme="dark"
    >
      <div class="container">
        <a class="navbar-brand" href="#">
          <img
            src="./images/ubuntu-logo-rounded-ubuntu-logo-free-png.webp"
            alt="Logo"
            class="logo navbar-brand"
          />
        </a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <div class="rigthSectoin col-sm-8">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a
                  class="nav-link active text-white"
                  aria-current="page"
                  href="index.php"
                  >الرئيسية</a
                >
              </li>
              <li class="nav-item">
                <a
                  class="nav-link text-white"
                  href="./category.php?category=politics"
                  >سياسة</a
                >
              </li>
              <li class="nav-item">
                <a
                  class="nav-link text-white"
                  href="./category.php?category=economy"
                  >اقتصاد</a
                >
              </li>
              <li class="nav-item">
                <a
                  class="nav-link text-white"
                  href="./category.php?category=health"
                  >صحة</a
                >
              </li>
              <li class="nav-item">
                <a
                  class="nav-link text-white"
                  href="./category.php?category=sport"
                  >رياضة</a
                >
              </li>
            </ul>
          </div>
          <div class="leftSection col-sm-4">
            <form class="d-flex" role="search">
              <input
                class="form-control me-2 bg-white"
                type="search"
                placeholder="ادخل كلمة للبحث"
                aria-label="Search"
              />
            </form>
          </div>
        </div>
      </div>
    </nav>

    <div class="container2">
      <div class="mainSection section mt-4">
        <div class="row">
          <div class="col-sm-5">
            <div class="card bg-dark" style="height: 100%">
              <img
                src="./images/sunsetWallpaper.jpg"
                alt="image"
                class="card-img-top"
              />
              <div class="card-body">
                <div class="category text-light mb-3 mt-2">سياسة - فلسطين</div>
                <div class="content text-white card-text">
                  <h2 class="pb-4">
                    هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة
                  </h2>
                  <p class="">
                    هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم
                    توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل
                    هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد
                    الحروف التى يولدها التطبيق.
                  </p>
                </div>
              </div>
            </div>
          </div>

          <div class="col-sm-7">
            <div class="row">
              <div class="col-sm-6">
                <div class="card">
                  <img
                    src="./images/sunsetWallpaper.jpg"
                    alt="image"
                    class="card-img-top"
                  />
                  <div class="card-body">
                    <div class="category text-muted mb-1">سياسة</div>
                    <p class="card-text">
                      هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم
                      توليد هذا النص من مولد النص العربى،
                    </p>
                  </div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="card">
                  <img
                    src="./images/sunsetWallpaper.jpg"
                    alt="image"
                    class="card-img-top"
                  />
                  <div class="card-body">
                    <div class="category text-muted mb-1">سياسة</div>
                    <p class="card-text">
                      هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم
                      توليد هذا النص من مولد النص العربى،
                    </p>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6">
                <div class="card">
                  <img
                    src="./images/sunsetWallpaper.jpg"
                    alt="image"
                    class="card-img-top"
                  />
                  <div class="card-body">
                    <div class="category text-muted mb-1">سياسة</div>
                    <p class="card-text">
                      هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم
                      توليد هذا النص من مولد النص العربى،
                    </p>
                  </div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="card">
                  <img
                    src="./images/sunsetWallpaper.jpg"
                    alt="image"
                    class="card-img-top"
                  />

                  <div class="card-body">
                    <div class="category text-muted mb-1">سياسة</div>
                    <p class="card-text">
                      هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم
                      توليد هذا النص من مولد النص العربى،
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="secondSection row section mt-4">
        <div class="col-sm-5 mostReaded">
          <div style="width: fit-content">
            <h3>الأكثر قراءة</h3>
          </div>
          <hr />
          <ul class="mostReadedList ps-0">
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
        <div class="col-sm-7 moreNewsSection">
          <div class="row">
            <div class="titlesBorder col" style="width: fit-content">
              <h3 style="width: fit-content">المزيد من الأخبار</h3>
            </div>
            <div class="col text-start">
              <a href="./details-page.html">المزيد</a>
            </div>
          </div>
          <hr />
          <div class="row">
            <div class="col-sm-5">
              <div class="card">
                <img
                  class="card-img-top"
                  src="./images/sunsetWallpaper.jpg"
                  alt="Card image cap"
                />
                <div class="card-body">
                  <div class="category text-muted mb-1">سياسة</div>
                  <p class="card-text">
                    هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم
                    توليد هذا النص من مولد النص العربى،
                  </p>
                </div>
              </div>
            </div>
            <div class="col-sm-3">
              <div class="card">
                <div class="card-body">
                  <div class="category text-muted mb-1">سياسة</div>
                  <p class="card-text">
                    هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة،
                  </p>
                </div>
                <img
                  class="card-img-bottom mx-3"
                  style="width: 50%"
                  src="./images/sunsetWallpaper.jpg"
                  alt="Card image cap"
                />
              </div>
              <div class="card">
                <div class="card-body">
                  <div class="category text-muted mb-1">سياسة</div>
                  <p class="card-text">
                    هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة،
                  </p>
                </div>
                <img
                  class="card-img-bottom mx-3"
                  style="width: 50%"
                  src="./images/sunsetWallpaper.jpg"
                  alt="Card image cap"
                />
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="politicsSectoin row section mt-4">
        <div class="col" style="width: fit-content">
          <h3 style="width: fit-content">سياسة</h3>
        </div>
        <div class="col text-start">
          <a href="./details-page.html">المزيد</a>
        </div>
        <hr />
        <div class="col-sm-6 mianSectoinNew">
          <div class="card" style="width: 100%; height: 100%">
            <img
              src="./images/sunsetWallpaper.jpg"
              alt="image"
              class="card-img-top"
            />
            <div class="card-body">
              <div class="category text-muted mb-1">سياسة</div>
              <p class="card-text">
                هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد
                هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو
                العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها
                التطبيق.
              </p>
            </div>
          </div>
        </div>
        <div class="col-sm-6 subSectoinNew">
          <div class="row">
            <div class="col-sm-6">
              <div class="card" style="width: 100%">
                <img
                  src="./images/sunsetWallpaper.jpg"
                  alt="image"
                  class="card-img-top midImageNew"
                />
                <div class="card-body">
                  <div class="category text-muted mb-1">سياسة</div>
                  <p class="card-text">
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                    Reiciendis nisi nam officiis
                  </p>
                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="card" style="width: 100%">
                <img
                  src="./images/sunsetWallpaper.jpg"
                  alt="image"
                  class="card-img-top midImageNew"
                />
                <div class="card-body">
                  <div class="category text-muted mb-1">سياسة</div>
                  <p class="card-text">
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                    Reiciendis nisi nam officiis
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <div class="card" style="width: 100%">
                <img
                  src="./images/sunsetWallpaper.jpg"
                  alt="image"
                  class="card-img-top midImageNew"
                />
                <div class="card-body">
                  <div class="category text-muted mb-1">سياسة</div>
                  <p class="card-text">
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                    Reiciendis nisi nam officiis
                  </p>
                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="card" style="width: 100%">
                <img
                  src="./images/sunsetWallpaper.jpg"
                  alt="image"
                  class="card-img-top midImageNew"
                />
                <div class="card-body">
                  <div class="category text-muted mb-1">سياسة</div>
                  <p class="card-text">
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                    Reiciendis nisi nam officiis
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="economySectoin row section mt-4">
        <div class="col" style="width: fit-content">
          <h3 style="width: fit-content">اقتصاد</h3>
        </div>
        <div class="col text-start">
          <a href="./details-page.html">المزيد</a>
        </div>
        <hr />
        <div class="col-sm-6 mianSectoinNew">
          <div class="card" style="width: 100%; height: 100%">
            <img
              src="./images/sunsetWallpaper.jpg"
              alt="image"
              class="card-img-top bigImageNew"
            />
            <div class="card-body">
              <div class="category text-muted mb-1">سياسة</div>
              <p class="card-text">
                هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد
                هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو
                العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها
                التطبيق.
              </p>
            </div>
          </div>
        </div>
        <div class="col-sm-6 subSectoinNew">
          <div class="row">
            <div class="col-sm-6">
              <div class="card" style="width: 100%">
                <img
                  src="./images/sunsetWallpaper.jpg"
                  alt="image"
                  class="card-img-top midImageNew"
                />
                <div class="card-body">
                  <div class="category text-muted mb-1">سياسة</div>
                  <p class="card-text">
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                    Reiciendis nisi nam officiis
                  </p>
                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="card" style="width: 100%">
                <img
                  src="./images/sunsetWallpaper.jpg"
                  alt="image"
                  class="card-img-top midImageNew"
                />
                <div class="card-body">
                  <div class="category text-muted mb-1">سياسة</div>
                  <p class="card-text">
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                    Reiciendis nisi nam officiis
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <div class="card" style="width: 100%">
                <img
                  src="./images/sunsetWallpaper.jpg"
                  alt="image"
                  class="card-img-top midImageNew"
                />
                <div class="card-body">
                  <div class="category text-muted mb-1">سياسة</div>
                  <p class="card-text">
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                    Reiciendis nisi nam officiis
                  </p>
                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="card" style="width: 100%">
                <img
                  src="./images/sunsetWallpaper.jpg"
                  alt="image"
                  class="card-img-top midImageNew"
                />
                <div class="card-body">
                  <div class="category text-muted mb-1">سياسة</div>
                  <p class="card-text">
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                    Reiciendis nisi nam officiis
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="sportSectoin row section mt-4">
        <div class="col" style="width: fit-content">
          <h3 style="width: fit-content">رياضة</h3>
        </div>
        <div class="col text-start">
          <a href="./details-page.html">المزيد</a>
        </div>
        <hr />

        <div class="col-sm-6 mianSectoinNew">
          <div class="card" style="width: 100%; height: 100%">
            <img
              src="./images/sunsetWallpaper.jpg"
              alt="image"
              class="card-img-top bigImageNew"
            />
            <div class="card-body">
              <div class="category text-muted mb-1">سياسة</div>
              <p class="card-text">
                هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد
                هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو
                العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها
                التطبيق.
              </p>
            </div>
          </div>
        </div>
        <div class="col-sm-6 subSectoinNew">
          <div class="row">
            <div class="col-sm-6">
              <div class="card" style="width: 100%">
                <img
                  src="./images/sunsetWallpaper.jpg"
                  alt="image"
                  class="card-img-top midImageNew"
                />
                <div class="card-body">
                  <div class="category text-muted mb-1">سياسة</div>
                  <p class="card-text">
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                    Reiciendis nisi nam officiis
                  </p>
                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="card" style="width: 100%">
                <img
                  src="./images/sunsetWallpaper.jpg"
                  alt="image"
                  class="card-img-top midImageNew"
                />
                <div class="card-body">
                  <div class="category text-muted mb-1">سياسة</div>
                  <p class="card-text">
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                    Reiciendis nisi nam officiis
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <div class="card" style="width: 100%">
                <img
                  src="./images/sunsetWallpaper.jpg"
                  alt="image"
                  class="card-img-top midImageNew"
                />
                <div class="card-body">
                  <div class="category text-muted mb-1">سياسة</div>
                  <p class="card-text">
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                    Reiciendis nisi nam officiis
                  </p>
                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="card" style="width: 100%">
                <img
                  src="./images/sunsetWallpaper.jpg"
                  alt="image"
                  class="card-img-top midImageNew"
                />
                <div class="card-body">
                  <div class="category text-muted mb-1">سياسة</div>
                  <p class="card-text">
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                    Reiciendis nisi nam officiis
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="healthSectoin row section mt-4">
        <div class="col" style="width: fit-content">
          <h3 style="width: fit-content">صحة</h3>
        </div>
        <div class="col text-start">
          <a href="./details-page.html">المزيد</a>
        </div>
        <hr />
        <div class="col-sm-6 mianSectoinNew">
          <div class="card" style="width: 100%; height: 100%">
            <img
              src="./images/sunsetWallpaper.jpg"
              alt="image"
              class="card-img-top bigImageNew"
            />
            <div class="card-body">
              <div class="category text-muted mb-1">سياسة</div>
              <p class="card-text">
                هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد
                هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو
                العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها
                التطبيق.
              </p>
            </div>
          </div>
        </div>
        <div class="col-sm-6 subSectoinNew">
          <div class="row">
            <div class="col-sm-6">
              <div class="card" style="width: 100%">
                <img
                  src="./images/sunsetWallpaper.jpg"
                  alt="image"
                  class="card-img-top midImageNew"
                />
                <div class="card-body">
                  <div class="category text-muted mb-1">سياسة</div>
                  <p class="card-text">
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                    Reiciendis nisi nam officiis
                  </p>
                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="card" style="width: 100%">
                <img
                  src="./images/sunsetWallpaper.jpg"
                  alt="image"
                  class="card-img-top midImageNew"
                />
                <div class="card-body">
                  <div class="category text-muted mb-1">سياسة</div>
                  <p class="card-text">
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                    Reiciendis nisi nam officiis
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <div class="card" style="width: 100%">
                <img
                  src="./images/sunsetWallpaper.jpg"
                  alt="image"
                  class="card-img-top midImageNew"
                />
                <div class="card-body">
                  <div class="category text-muted mb-1">سياسة</div>
                  <p class="card-text">
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                    Reiciendis nisi nam officiis
                  </p>
                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="card" style="width: 100%">
                <img
                  src="./images/sunsetWallpaper.jpg"
                  alt="image"
                  class="card-img-top midImageNew"
                />
                <div class="card-body">
                  <div class="category text-muted mb-1">سياسة</div>
                  <p class="card-text">
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                    Reiciendis nisi nam officiis
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>
  </body>
  <div class="footer bg-light border-top" style="padding: 0; margin: 0">
    <div class="container2">
      <footer class="row row-cols-5 py-5">
        <div class="col">
          <img
            src="./images/ubuntu-logo-rounded-ubuntu-logo-free-png.webp"
            alt="logo"
            class="logo"
          />
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
              <a href="./politicsPage.html" class="nav-link p-0 text-muted"
                >سياسة</a
              >
            </li>
            <li class="nav-item mb-2">
              <a href="./economyPage.html" class="nav-link p-0 text-muted"
                >اقنصاد</a
              >
            </li>
            <li class="nav-item mb-2">
              <a href="#" class="nav-link p-0 text-muted">فن وثقافة</a>
            </li>
            <li class="nav-item mb-2">
              <a href="./sportPage.html" class="nav-link p-0 text-muted"
                >رياضة</a
              >
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
            viewBox="0 0 16 16"
          >
            <circle cx="8" cy="8" r="8" />
          </svg>
          <svg
            xmlns="http://www.w3.org/2000/svg"
            width="16"
            height="16"
            fill="currentColor"
            class="bi bi-circle-fill"
            viewBox="0 0 16 16"
          >
            <circle cx="8" cy="8" r="8" />
          </svg>
          <svg
            xmlns="http://www.w3.org/2000/svg"
            width="16"
            height="16"
            fill="currentColor"
            class="bi bi-circle-fill"
            viewBox="0 0 16 16"
          >
            <circle cx="8" cy="8" r="8" />
          </svg>
          <svg
            xmlns="http://www.w3.org/2000/svg"
            width="16"
            height="16"
            fill="currentColor"
            class="bi bi-circle-fill"
            viewBox="0 0 16 16"
          >
            <circle cx="8" cy="8" r="8" />
          </svg>
          <svg
            xmlns="http://www.w3.org/2000/svg"
            width="16"
            height="16"
            fill="currentColor"
            class="bi bi-circle-fill"
            viewBox="0 0 16 16"
          >
            <circle cx="8" cy="8" r="8" />
          </svg>
          <svg
            xmlns="http://www.w3.org/2000/svg"
            width="16"
            height="16"
            fill="currentColor"
            class="bi bi-circle-fill"
            viewBox="0 0 16 16"
          >
            <circle cx="8" cy="8" r="8" />
          </svg>
        </div>
      </footer>
    </div>
  </div>
</html>
