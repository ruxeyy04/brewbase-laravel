<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>BrewBase - My Order</title>
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
                    <h1 class="page_title text-black wow fadeInUp" data-wow-delay=".1s">My order</h1>
                    <ul class="breadcrumb_nav ul_li wow fadeInUp" data-wow-delay=".2s">
                        <li><a href="index.html" class="text-secondary"><i class="fas fa-home"></i> Home</a></li>
                        <li>my order</li>
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
            <!-- myorder_section - start
				================================================== -->
            <section class="myorder_section sec_ptb_120 bg_default_gray">
                <div class="container">
                    <ul class="ordercat filters-button-group style_3 ul_li_center wow fadeInUp" data-wow-delay=".1s">
                        <li><button class="button text-uppercase active" data-filter="*">all</button></li>
                        <li><button class="button text-uppercase" data-filter=".pending">pending</button></li>
                        <li><button class="button text-uppercase" data-filter=".ontheway">on the way</button></li>
                        <li><button class="button text-uppercase" data-filter=".toreceive">to receive</button></li>
                        <li><button class="button text-uppercase" data-filter=".completed">completed</button></li>
                        <li><button class="button text-uppercase" data-filter=".cancelled">cancelled</button></li>
                    </ul>
                    <div class="myorder_row grid wow fadeIn" style="height: 1000px;" data-wow-delay=".2s">
                    </div>
                    <!-- <ul class="ul_li_center" id="loading">
                        <li><button class="btn btn_secondary loadMore">Load More</button></li>
                    </ul> -->
                </div>
            </section>
            <!-- myorder_section - end
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
    <script src="js/pages_js/order_page.js"></script>
    <!-- END Script -->
</body>

</html>