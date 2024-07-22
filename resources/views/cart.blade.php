<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>BrewBase - Cart</title>
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
                    <h1 class="page_title text-black wow fadeInUp" data-wow-delay=".1s">cart</h1>
                    <ul class="breadcrumb_nav ul_li wow fadeInUp" data-wow-delay=".2s">
                        <li><a href="/" class="text-secondary"><i class="fas fa-home"></i> Home</a></li>
                        <li>cart</li>
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

            <!-- cart_section - start
				================================================== -->
            <style>
                .dd-container {
                    width: 228px !important;
                }

                .dd-options li {
                    margin-right: 0 !important;
                }

                .dd-option-image,
                .dd-selected-image {
                    width: 40px !important;
                    height: 40px !important;
                }

                .dd-container {
                    font-family: "Oswald", sans-serif !important;
                }

                .dd-selected {
                    padding: 3.5px !important;
                }

                .dd-selected-text,
                .dd-selected {
                    color: #1b1b1b !important;
                }

                .dd-selected-image {
                    margin-top: 3px !important;
                }

                .dd-select {
                    background-color: rgb(255 255 255 / 76%) !important;
                    border: 0 !important;
                    border-radius: 0 !important;
                    width: 177px !important;
                }

                .dd-options {
                    width: 185px !important;
                }
            </style>
            <section class="cart_section sec_ptb_120 bg_default_gray">
                <div class="container">
                    <div class="cart_table">
                        <table class="table cart_table_html">
                            <thead class="text-uppercase wow fadeInUp" data-wow-delay=".1s">
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Add-ons</th>
                                    <th>Added On</th>
                                    <th>subtotal</th>
                                </tr>
                            </thead>
                            <tbody class="cart_data">
                            </tbody>
                        </table>

                    </div>

                    <ul class="carttable_footer ul_li_right wow fadeInUp" data-wow-delay=".1s">
                        <li id="cartTotalitems">
                            <div class="total_price text-uppercase">
                                <span>total</span>
                                <span class="totalprice">₱ </span>
                            </div>
                        </li>
                        <li id="cartBtnCheckout">
                            <a class="btn btn_primary text-uppercase" href="checkout">procced to checkout</a>
                        </li>
                    </ul>
                </div>

            </section>
            <!-- cart_section - end
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="js/jquery.cookie.min.js"></script>
    <script src="js/jquery.ddslick.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/pages_js/cart.js"></script>


</body>

</html>