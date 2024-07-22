<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>BrewBase - Contact Us</title>
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
                    <h1 class="page_title text-black wow fadeInUp" data-wow-delay=".1s">Contact us</h1>
                    <ul class="breadcrumb_nav ul_li wow fadeInUp" data-wow-delay=".2s">
                        <li><a href="index.html" class="text-secondary"><i class="fas fa-home"></i> Home</a></li>
                        <li>contact Us</li>
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

            <!-- contact_section - start
        ================================================== -->
            <section class="contact_section sec_ptb_120 bg_default_gray">
                <div class="container">
                    <div class="contact_form bg_white wow fadeInUp" data-wow-delay=".1s">
                        <div class="main_contact_info_wrap">
                            <div class="contact_info_item">
                                <div class="item_icon"><i class="fa fa-envelope"></i></div>
                                <div class="item_content">
                                    <h3 class="item_title text-uppercase">Email Adress</h3>
                                    <p>brewbase@brewbase.logiclynxz</p>
                                </div>
                            </div>
                            <div class="contact_info_item">
                                <div class="item_icon"><i class="fa fa-map-marker-alt"></i></div>
                                <div class="item_content">
                                    <h3 class="item_title text-uppercase">Our Location</h3>
                                    <p>Ozamiz City, Misamis Occidental</p>
                                    <p>Philippines 7200</p>
                                </div>
                            </div>
                            <div class="contact_info_item">
                                <div class="item_icon"><i class="fa fa-phone"></i></div>
                                <div class="item_content">
                                    <h3 class="item_title text-uppercase">Phone Number</h3>
                                    <p>(+63) 983787822</p>
                                    <p>(889) 521-9883</p>
                                </div>
                            </div>
                        </div>
                        <form action="#">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form_item">
                                        <input type="text" name="name" placeholder="Your name:">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form_item">
                                        <input type="email" name="email" placeholder="Your Mail:">
                                    </div>
                                </div>
                            </div>
                            <div class="form_item">
                                <input type="text" name="subject" placeholder="Enter Your Subject:">
                            </div>
                            <div class="form_item">
                                <textarea name="message" placeholder="Your Massage:"></textarea>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn_primary text-uppercase">Send massage</button>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
            <!-- contact_section - end
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