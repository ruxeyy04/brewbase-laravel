<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>BrewBase - Product Details</title>
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
                    <h1 class="page_title text-black wow fadeInUp" data-wow-delay=".1s">product details</h1>
                    <ul class="breadcrumb_nav ul_li wow fadeInUp" data-wow-delay=".2s">
                        <li><a href="index.html" class="text-secondary"><i class="fas fa-home"></i> Home</a></li>
                        <li>product details</li>
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

            <!-- details_section - start
        ================================================== -->
            <section class="details_section shop_details sec_ptb_120 bg_default_gray">
                <div class="container">
                    <div class="row justify-content-lg-between justify-content-md-center justify-content-sm-center">
                        <div class="col-lg-6 col-md-7">
                            <div class="details_image_wrap wow fadeInUp mb-5" data-wow-delay=".1s">
                                <img id="product_img" src="productimg/product-626f489b14a288.67485309.png" alt="">
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-7">
                            <div class="details_content wow fadeInUp" data-wow-delay=".2s">
                                <div class="details_flex_title">
                                    <h2 class="product_name text-uppercase">Almond Coffee Tea</h2>
                                </div>
                                <div class="prod_info">
                                    <div class="prod_date">
                                        <i class="fa-solid fa-calendar-days mr-2"></i><span class="date_text">Date:
                                            April 23, 2023</span>
                                    </div>
                                    <div class="prod_cat">
                                        <i class="fa-solid fa-list mr-1"></i> <span class="category_text">Category:
                                            <span class="category_name">Almond</span></span>
                                    </div>
                                </div>
                                <div class="details_price">
                                    <strong class="price_text"><i class="fa-solid fa-peso-sign"></i><span id="product_price">25.00</span></strong>
                                    <span class="in_stuck product_status"><i class="fa fa-check"></i> Available</span>
                                </div>
                                <ul class="btns_group ul_li">
                                    <li>
                                        <div class="quantity_input quantity_boxed">
                                            <h4 class="quantity_title text-uppercase">Quantity</h4>
                                            <form action="#">
                                                <button type="button" class="input_number_decrement">–</button>
                                                <input class="input_number quantity_val" type="number" value="1" min="1" readonly>
                                                <button type="button" class="input_number_increment">+</button>
                                            </form>
                                        </div>
                                    </li>
                                    <style>
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
                                        }
                                    </style>
                                    <li>
                                        <select name="" id="addons"></select>
                                    </li>
                                </ul>
                                <button class="btn btn_secondary mb-3 add_cart" data-prodno>ADD TO CART</button>
                                <div class="details_wishlist_btn">
                                    <a href="#!" id="add_wishlist"><i class="fa-regular fa-heart"></i> Add to
                                        Wishlist</a>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="product_description_wrap wow fadeInUp" data-wow-delay=".3s">
                        <ul class="tabs_nav ul_li nav" role="tablist">
                            <li>
                                <button class="active" data-toggle="tab" data-target="#product_description" type="button" role="tab" aria-selected="true">Product Details</button>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="product_description" role="tabpanel">
                                <p class="mb-0 product_detail">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Ex laboriosam perferendis
                                    dolorem placeat inventore magni sapiente repudiandae. Error vitae similique eius?
                                    Laboriosam dicta eius possimus sapiente eos dolorem ab neque?
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="related_products">
                        <h4 class="area_title text-uppercase mb-0 wow fadeInUp" data-wow-delay=".1s">Related Product
                        </h4>
                        <div class="row product_related">
                        </div>
                    </div>

                </div>
            </section>
            <!-- details_section - end
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
    <script src="js/jquery.ddslick.min.js"></script>
    <script src="js/pages_js/productdetails.js"></script>
    <!-- END Script -->
</body>

</html>