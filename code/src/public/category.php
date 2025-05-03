<!DOCTYPE html>
<html lang="ar">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>المنصة الاخبارية</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"/>  
    <link rel="stylesheet" href="../assets/styles/style.css" />
    <link rel="icon" href="../assets/icons/portal-icon.png" type="image/png"/>
  </head>
  <body dir="rtl">
    <div class="container-fluid">
      <div id="categoryTitle" class="title">سياسة</div>
      <hr />
      <div id="newsContent">
        <div class="row m-5">
          <div class="col-lg-8 col-12 my-card">
            <div class="row">
              <img
                src="https://picsum.photos/300/150"
                class="col-12"
                alt="Featured news"
                id="mainCardImage"
              />

              <div class="my-card col-12">
                <div class="my-card-body">
                  <div class="card-cat" id="mainCardCat">فلسطين</div>
                  <h5 class="my-card-title" id="mainCardTitle">
                    عنوان الخبر الرئيسي هنا
                  </h5>
                  <p class="my-card-text" id="mainCardText">
                    نص الخبر الرئيسي هنا مع المزيد من التفاصيل
                    <a href="#">اقرأ المزيد</a>
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-12">
            <div class="row">
              <div class="my-card col-lg-12 col-md-6 col-12">
                <div class="row">
                  <img
                    src="https://picsum.photos/300/150"
                    class="col-12"
                    alt="News"
                    id="secondaryCardImage"
                  />
                  <div class="col-12">
                    <div class="my-card-body row">
                      <div class="card-cat" id="secondaryCardCat">فلسطين</div>
                      <h5 class="my-card-title" id="secondaryCardTitle">
                        عنوان الخبر الثانوي هنا
                      </h5>
                      <p class="my-card-text" id="secondaryCardText">
                        نص الخبر الثانوي هنا مع المزيد من التفاصيل
                        <a href="#">اقرأ المزيد</a>
                      </p>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-lg-12 col-md-6 col-12">
                <div class="row">
                  <div class="col-12 my-card">
                    <div class="row">
                      <img
                        src="https://picsum.photos/300/150"
                        alt="News"
                        class="col-6"
                        id="smallCard1Image"
                      />

                      <div class="col-6">
                        <div class="my-card-body">
                          <div class="card-cat" id="smallCard1Cat">فلسطين</div>
                          <h5 class="my-card-title" id="smallCard1Title">
                            عنوان الخبر المصغر هنا
                          </h5>
                        </div>
                      </div>
                    </div>
                  </div>
                  
                  <div class="col-12 my-card mt-2">
                    <div class="row">
                      <img
                        src="https://picsum.photos/300/150"
                        alt="News"
                        class="col-6"
                        id="smallCard2Image"
                      />

                      <div class="col-6">
                        <div class="my-card-body">
                          <div class="card-cat" id="smallCard2Cat">فلسطين</div>
                          <h5 class="my-card-title" id="smallCard2Title">
                            عنوان الخبر المصغر هنا
                          </h5>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <div class="row m-5">
          <div class="col-md-8 col-sm-12">
            <div class="row mt-3 my-card">
              <img
                src="https://picsum.photos/300/150"
                class="col-md-4 col-sm-12"
                alt="News"
                id="horizontalCard1Image"
              />

              <div class="col-md-8">
                <div class="my-card-body">
                  <div class="card-cat" id="horizontalCard1Cat">فلسطين</div>
                  <h5 class="my-card-title" id="horizontalCard1Title">
                    عنوان الخبر الأفقي هنا
                  </h5>
                  <p class="my-card-text" id="horizontalCard1Text">
                    نص الخبر الأفقي هنا مع المزيد من التفاصيل
                    <a href="#">اقرأ المزيد</a>
                  </p>
                </div>
              </div>
            </div>
            <div class="row mt-3 my-card">
              <img
                src="https://picsum.photos/300/150"
                class="col-md-4 col-sm-12"
                alt="News"
                id="horizontalCard2Image"
              />

              <div class="col-md-8">
                <div class="my-card-body">
                  <div class="card-cat" id="horizontalCard2Cat">فلسطين</div>
                  <h5 class="my-card-title" id="horizontalCard2Title">
                    عنوان الخبر الأفقي هنا
                  </h5>
                  <p class="my-card-text" id="horizontalCard2Text">
                    نص الخبر الأفقي هنا مع المزيد من التفاصيل
                    <a href="#">اقرأ المزيد</a>
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <iframe
              src="https://ad-url.com"
              width="250"
              height="300"
              frameborder="0"
              scrolling="no"
            ></iframe>
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
</html>