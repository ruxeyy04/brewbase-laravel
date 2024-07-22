<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>BrewBase - About Us</title>
  <link rel="shortcut icon" href="logo/brewbase.ico" />
  <link rel="stylesheet" href="css/bootstrap.min.css" />
  <link rel="stylesheet" type="text/css" href="css/all.min.css" />
  <link rel="stylesheet" type="text/css" href="css/animate.css" />
  <link rel="stylesheet" type="text/css" href="css/slick.css" />
  <link rel="stylesheet" type="text/css" href="css/slick-theme.css" />
  <link rel="stylesheet" type="text/css" href="css/magnific-popup.css" />
  <link rel="stylesheet" type="text/css" href="css/jquery-ui.min.css" />
  <link rel="stylesheet" type="text/css" href="css/style.css" />
  <link rel="stylesheet" type="text/css" href="css/jquery.mCustomScrollbar.min.css" />
</head>

<body>
  <!-- body_wrap - start -->
  <div class="body_wrap">

    <!-- backtotop - start -->
    <div class="backtotop">
      <a href="#" class="scroll">
        <i class="fa-sharp fa-solid fa-arrow-up"></i>
        <i class="fa-sharp fa-solid fa-arrow-up"></i>
      </a>
    </div>
    <!-- backtotop - end -->

    <!-- preloader - start -->
    <div id="preloader"></div>
    <!-- preloader - end -->

        <!-- header_section - start
            ================================================== -->
            <header class="header_section style_3">
            <div class="content_wrap">
                <div class="container maxw_1720">
                    <div class="row align-items-center">

                        <div class="col-lg-2 col-md-5 col-5">
                            <div class="brand_logo">
                                <a class="brand_link" href="/">
                                    <img src="logo/brewbase-blck.png" alt="logo_not_found">
                                </a>
                            </div>
                        </div>

                        @include('layout\navigation')


                    </div>
                </div>
            </div>

            <!-- collapse search - start -->
            @include('layout\searchbar')
            <!-- collapse search - end -->
        </header>
        <!-- header_section - end ================================================== -->

        <!-- main body - start ================================================== -->
        <main>
            <!-- user_sidebar - start ================================================== -->
            @include('layout\usersidebar')
            <!-- user_sidebar - end ================================================== -->
            <!-- cart_sidebar - start  ================================================== -->
            @include('layout\cartsidebar')
            <!-- cart_sidebar - end ================================================== -->

      <!-- breadcrumb_section - start
				================================================== -->
      <section class="breadcrumb_section text-uppercase" style="background-image: url(img/headerall.png)">
        <div class="container">
          <h1 class="page_title text-black wow fadeInUp" data-wow-delay=".1s">about us</h1>
          <ul class="breadcrumb_nav ul_li wow fadeInUp" data-wow-delay=".2s">
            <li><a href="index.html" class="text-secondary"><i class="fas fa-home"></i> Home</a></li>
            <li>about us</li>
          </ul>
        </div>
        <div class="breadcrumb_icon_wrap">
          <div class="container">
            <div class="breadcrumb_icon wow fadeInUp" data-wow-delay=".3s">
              <img src="images/icon_01_1.png" alt="icon_not_found">
              <span class="bg_shape"></span>
            </div>
          </div>
        </div>
      </section>
      <!-- breadcrumb_section - end
				================================================== -->

      <!-- about_section - start
        ================================================== -->
      <section class="about_section sec_ptb_120">
        <div class="container">
          <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-6 col-md-6 order-last">
              <div class="about_image1 wow fadeInRight" data-wow-delay=".1s">
                <img src="logo/brewbase.png" alt="image_not_found">
              </div>
            </div>

            <div class="col-lg-5 col-md-5">
              <div class="about_content">
                <div class="section_title text-uppercase">
                  <h2 class="small_title wow fadeInUp" data-wow-delay=".1s"><i class="fas fa-coffee"></i> About Us</h2>
                  <h3 class="big_title wow fadeInUp" data-wow-delay=".2s">
                    Learn More About Brewbase
                  </h3>
                </div>
                <p class="wow fadeInUp" data-wow-delay=".3s">
                  At Brewbase, we're passionate about coffee and the culture surrounding it. Our coffeehouses are
                  designed to be social hubs where people can gather to enjoy great coffee, converse, read, write, or
                  simply relax alone or with friends.
                </p>
                <ul class="about_info ul_li_block">
                  <li class="wow fadeInUp" data-wow-delay=".4s">
                    <h4 class="text-uppercase"><i class="fa-regular fa-circle"></i></i> Our BrewBase Coffee</h4>
                    <p class="mb-0">
                      At our BrewBase coffee, we source high-quality green coffee beans and carefully roast them to
                      perfection over hot coals. This ensures that our coffee has an amazing aroma and taste that you'll
                      love. We invite you to come and try it for yourself!
                    </p>
                  </li>
                  <li class="wow fadeInUp" data-wow-delay=".5s">
                    <h4 class="text-uppercase"><i class="fa-regular fa-circle"></i> The Coffee-Brewing Process</h4>
                    <p class="mb-0">
                      After roasting the coffee beans, we grind them to the perfect consistency and brew them using
                      specialized equipment to extract the best possible flavor. Each cup of coffee is carefully
                      prepared by our expert baristas to ensure that you get a delicious and satisfying experience every
                      time you visit our coffeehouses.
                    </p>
                  </li>
                </ul>
                <ul class="btns_group ul_li wow fadeInUp ul_li_right" data-wow-delay=".6s">
                  <li>
                    <div class="chip_item">
                      <div class="chip_thumbnail">
                        <img src="img/mepic.png" alt="image_not_found">
                      </div>
                      <div class="chip_content text-uppercase">
                        <h5 class="chip_name">Ruxe Pasok</h5>
                        <span class="chip_title">Founder</span>
                      </div>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </div>

          <div class="our_history_area">
            <div class="row align-items-center">
              <div class="col-lg-2 col-md-2">
                <div class="item_icon wow fadeInUp" data-wow-delay=".1s">
                  <img src="images/icon_01_1.png" alt="icon_not_found">
                  <span class="bg_shape"></span>
                </div>
              </div>
              <div class="col-lg-5 col-md-5 order-first wow fadeInUp" data-wow-delay=".2s">
                <h3 class="item_title text-uppercase">HIstory of brewbase</h3>
              </div>
              <div class="col-lg-5 col-md-5">
                <p class="wow fadeInUp" data-wow-delay=".3s">
                  BrewBase is a specialty store established in the early 2022, with a focus on providing customers with
                  a wide variety of tea and drinks such as frappes. The store quickly gained popularity among tea
                  enthusiasts and expanded its product line to include unique and exotic tea varieties sourced from
                  different parts of the world. BrewBase's commitment to quality and innovation has also led to the
                  introduction of popular drinks such as frappes. Today, BrewBase is known for its exceptional tea
                  blends and innovative drink creations, making it a go-to destination for those who appreciate quality
                  beverages.
                </p>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-3 col-md-4 col-sm-6">
              <div class="feature_primary wow fadeInUp" data-wow-delay=".1s">
                <div class="item_icon">
                  <span class="item_serial"><i class="fa-solid fa-1"></i></span>
                  <img src="img/tea-icon.png" alt="icon_not_found">
                </div>
                <h3 class="item_title text-uppercase">awesomae aroma</h3>
                <p class="mb-0">
                  Experience the irresistible allure of our awesome aromatic blends.
                </p>
              </div>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-6">
              <div class="feature_primary wow fadeInUp" data-wow-delay=".2s">
                <div class="item_icon">
                  <span class="item_serial"><i class="fa-solid fa-2"></i></span>
                  <img src="img/medal-icon.png" alt="icon_not_found">
                </div>
                <h3 class="item_title text-uppercase">high quality</h3>
                <p class="mb-0">
                  Experience excellence with our high-quality products.
                </p>
              </div>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-6">
              <div class="feature_primary wow fadeInUp" data-wow-delay=".3s">
                <div class="item_icon">
                  <span class="item_serial"><i class="fa-solid fa-3"></i></span>
                  <img src="img/bean-icon.png" alt="icon_not_found">
                </div>
                <h3 class="item_title text-uppercase">pure grades</h3>
                <p class="mb-0">
                  Experience the purest grades of coffee, sip perfection every time.
                </p>
              </div>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-6">
              <div class="feature_primary wow fadeInUp" data-wow-delay=".4s">
                <div class="item_icon">
                  <span class="item_serial"><i class="fa-solid fa-4"></i></span>
                  <img src="img/frappe-icon.png" alt="icon_not_found" width="36" height="35">
                </div>
                <h3 class="item_title text-uppercase">Frappe</h3>
                <p class="mb-0">
                  Indulge your taste buds in a diverse range of offerings, beyond the realm of just coffee,
                </p>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- about_section - end
        ================================================== -->

    </main>
    <!-- main body - end
      ================================================== -->

        <!-- footer_section - start
      ================================================== -->
      @include('layout\footer')
        <!-- footer_section - end
      ================================================== -->

  </div>
  <!-- body_wrap - end -->
  <!-- All Script -->
  <script src="js/jquery.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/wow.min.js"></script>
  <script src="js/slick.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/isotope.pkgd.min.js"></script>
  <script src="js/jquery-ui.min.js"></script>
  <script src="js/jquery.mCustomScrollbar.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="js/jquery.cookie.min.js"></script>
  <script src="js/main.js"></script>
  <!-- END Script -->
</body>

</html>