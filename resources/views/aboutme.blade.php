<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>BrewBase - About Me</title>
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
                    <h1 class="page_title text-black wow fadeInUp" data-wow-delay=".1s">About Me</h1>
                    <ul class="breadcrumb_nav ul_li wow fadeInUp" data-wow-delay=".2s">
                        <li><a href="index.html" class="text-secondary"><i class="fas fa-home"></i> Home</a></li>
                        <li>About me</li>
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

            <!-- admin_section - start
        ================================================== -->
            <section class="admin_section sec_ptb_120 bg_gray">
                <div class="container">
                    <div class="row justify-content-lg-between justify-content-md-between justify-content-sm-center">
                        <div class="col-lg-5 col-md-6 col-sm-8">
                            <div class="admin_image wow fadeInUp" data-wow-delay=".1s">
                                <img src="img/mepic.png" alt="image_not_found">
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-8">
                            <div class="admin_content">
                                <h2 class="admin_name text-uppercase wow fadeInUp" data-wow-delay=".2s">Ruxe Pasok</h2>
                                <p class="wow fadeInUp" data-wow-delay=".3s">
                                    Misamis University is a leading educational institution in the region, offering a diverse range of undergraduate and graduate programs to students from various backgrounds. As a 3rd year college student pursuing a degree in BSIT, Ruxe E. Pasok is taking advantage of the university's state-of-the-art facilities and experienced faculty to acquire the skills and knowledge needed for a successful career in the field of information technology. Located at H.T Feliciano St, Ozamiz City, the university provides a conducive learning environment that fosters academic excellence and personal growth. Ruxe E. Pasok is proud to be a part of the Misamis University community and is committed to making the most of the opportunities available to achieve their academic and career goals.
                                </p>
                                <div class="admin_info_wrap wow fadeInUp" data-wow-delay=".3s">
                                    <ul class="social_links social_icons ul_li">
                                        <li><a href="#!"><i class="fab fa-facebook-f"></i></a></li>
                                        <li><a href="#!"><i class="fab fa-twitter"></i></a></li>
                                        <li><a href="#!"><i class="fab fa-instagram"></i></a></li>
                                        <li><a href="#!"><i class="fab fa-youtube"></i></a></li>
                                        <li><a href="#!"><i class="fab fa-behance"></i></a></li>
                                    </ul>
                                    <ul class="info_list ul_li_block">
                                        <li><strong>Personal Info:</strong> Student</li>
                                        <li><strong>Year Level:</strong> 3rd Year</li>
                                        <li><strong>Email:</strong> ruxepasok356@gmail.com</li>
                                        <li><strong>Phone:</strong> 091289733</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- admin_section - end
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